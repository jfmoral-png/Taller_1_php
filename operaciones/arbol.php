<?php
function parseTraversal($value, string $name): array
{
    if (!is_string($value)) {
        throw new InvalidArgumentException("El recorrido de " . $name . " no tiene un formato válido.");
    }

    $value = trim($value);
    if ($value === "") {
        return [];
    }

    $nodes = preg_split('/\s*(?:,|→|->|\r\n|\r|\n)\s*/u', $value);
    if ($nodes === false || in_array("", $nodes, true)) {
        throw new InvalidArgumentException("Separa los nodos de " . $name . " con comas, flechas o saltos de línea.");
    }

    if (count(array_unique($nodes, SORT_STRING)) !== count($nodes)) {
        throw new InvalidArgumentException("Los valores de los nodos deben ser únicos.");
    }

    return $nodes;
}

function createTreeNode(string $value): array
{
    return ["value" => $value, "left" => null, "right" => null];
}

function buildFromPreorderAndInorder(array $preorder, array $inorder): ?array
{
    $index = 0;
    $build = function (int $start, int $end) use (&$build, &$index, $preorder, $inorder): ?array {
        if ($start > $end) {
            return null;
        }

        if (!isset($preorder[$index])) {
            throw new InvalidArgumentException("Los recorridos no corresponden al mismo árbol.");
        }

        $value = $preorder[$index++];
        $position = array_search($value, $inorder, true);
        if ($position === false || $position < $start || $position > $end) {
            throw new InvalidArgumentException("Los recorridos no corresponden al mismo árbol.");
        }

        $node = createTreeNode($value);
        $node["left"] = $build($start, $position - 1);
        $node["right"] = $build($position + 1, $end);
        return $node;
    };

    $tree = $build(0, count($inorder) - 1);
    if ($index !== count($preorder)) {
        throw new InvalidArgumentException("Los recorridos no corresponden al mismo árbol.");
    }

    return $tree;
}

function buildFromInorderAndPostorder(array $inorder, array $postorder): ?array
{
    $index = count($postorder) - 1;
    $build = function (int $start, int $end) use (&$build, &$index, $inorder, $postorder): ?array {
        if ($start > $end) {
            return null;
        }

        if ($index < 0 || !isset($postorder[$index])) {
            throw new InvalidArgumentException("Los recorridos no corresponden al mismo árbol.");
        }

        $value = $postorder[$index--];
        $position = array_search($value, $inorder, true);
        if ($position === false || $position < $start || $position > $end) {
            throw new InvalidArgumentException("Los recorridos no corresponden al mismo árbol.");
        }

        $node = createTreeNode($value);
        $node["right"] = $build($position + 1, $end);
        $node["left"] = $build($start, $position - 1);
        return $node;
    };

    $tree = $build(0, count($inorder) - 1);
    if ($index !== -1) {
        throw new InvalidArgumentException("Los recorridos no corresponden al mismo árbol.");
    }

    return $tree;
}

function buildFromPreorderAndPostorder(
    array $preorder,
    array $postorder,
    int $preStart,
    int $preEnd,
    int $postStart,
    int $postEnd
): ?array {
    if ($preStart > $preEnd) {
        return null;
    }

    if ($preorder[$preStart] !== $postorder[$postEnd]) {
        throw new InvalidArgumentException("Los recorridos no corresponden al mismo árbol.");
    }

    $node = createTreeNode($preorder[$preStart]);
    if ($preStart === $preEnd) {
        return $node;
    }

    $leftRootPosition = array_search($preorder[$preStart + 1], $postorder, true);
    if ($leftRootPosition === false || $leftRootPosition < $postStart || $leftRootPosition >= $postEnd) {
        throw new InvalidArgumentException("Los recorridos no corresponden al mismo árbol.");
    }

    $leftSize = $leftRootPosition - $postStart + 1;
    $node["left"] = buildFromPreorderAndPostorder(
        $preorder,
        $postorder,
        $preStart + 1,
        $preStart + $leftSize,
        $postStart,
        $leftRootPosition
    );

    if ($leftSize < $preEnd - $preStart) {
        $node["right"] = buildFromPreorderAndPostorder(
            $preorder,
            $postorder,
            $preStart + $leftSize + 1,
            $preEnd,
            $leftRootPosition + 1,
            $postEnd - 1
        );
    }

    return $node;
}

function collectTraversals(?array $node, array &$preorder, array &$inorder, array &$postorder): void
{
    if ($node === null) {
        return;
    }

    $preorder[] = $node["value"];
    collectTraversals($node["left"], $preorder, $inorder, $postorder);
    $inorder[] = $node["value"];
    collectTraversals($node["right"], $preorder, $inorder, $postorder);
    $postorder[] = $node["value"];
}

function renderTree(?array $node): string
{
    if ($node === null) {
        return "";
    }

    $html = "<li>" . htmlspecialchars($node["value"], ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
    if ($node["left"] !== null || $node["right"] !== null) {
        $html .= "<ul>";
        if ($node["left"] !== null) {
            $html .= renderTree($node["left"]);
        }
        if ($node["right"] !== null) {
            $html .= renderTree($node["right"]);
        }
        $html .= "</ul>";
    }

    return $html . "</li>";
}

if (($_SERVER["REQUEST_METHOD"] ?? "GET") !== "POST") {
    header("Location: ../paginas/arbolBinario.php");
    exit;
}

$rawTraversals = [
    "preorden" => $_POST["preorden"] ?? "",
    "inorden" => $_POST["inorden"] ?? "",
    "postorden" => $_POST["postorden"] ?? "",
];
$tree = null;
$treeHtml = "";
$calculated = null;
$error = "";
$constructionMethod = "";
$provided = [];

try {
    $traversals = [];
    foreach ($rawTraversals as $name => $value) {
        $traversals[$name] = parseTraversal($value, $name);
    }

    $provided = array_filter($traversals, static function (array $nodes): bool {
        return count($nodes) > 0;
    });

    if (count($provided) < 2) {
        throw new InvalidArgumentException("Ingresa por lo menos dos recorridos.");
    }

    $reference = reset($provided);
    sort($reference, SORT_STRING);
    foreach ($provided as $nodes) {
        $sortedNodes = $nodes;
        sort($sortedNodes, SORT_STRING);
        if ($sortedNodes !== $reference) {
            throw new InvalidArgumentException("Todos los recorridos deben contener los mismos nodos.");
        }
    }

    if (isset($provided["preorden"], $provided["inorden"])) {
        $tree = buildFromPreorderAndInorder($traversals["preorden"], $traversals["inorden"]);
        $constructionMethod = "preorden e inorden";
    } elseif (isset($provided["preorden"], $provided["postorden"])) {
        $tree = buildFromPreorderAndPostorder(
            $traversals["preorden"],
            $traversals["postorden"],
            0,
            count($traversals["preorden"]) - 1,
            0,
            count($traversals["postorden"]) - 1
        );
        $constructionMethod = "preorden y postorden";
    } else {
        $tree = buildFromInorderAndPostorder($traversals["inorden"], $traversals["postorden"]);
        $constructionMethod = "inorden y postorden";
    }

    $calculated = ["preorden" => [], "inorden" => [], "postorden" => []];
    collectTraversals(
        $tree,
        $calculated["preorden"],
        $calculated["inorden"],
        $calculated["postorden"]
    );

    foreach ($provided as $name => $nodes) {
        if ($nodes !== $calculated[$name]) {
            throw new InvalidArgumentException("Los recorridos ingresados son inconsistentes.");
        }
    }

    $treeHtml = renderTree($tree);
} catch (InvalidArgumentException $exception) {
    $error = $exception->getMessage();
    $tree = null;
    $calculated = null;
}

require __DIR__ . "/../paginas/arbolBinario.php";