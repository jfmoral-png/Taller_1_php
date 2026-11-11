<?php
$rawTraversals = $rawTraversals ?? ["preorden" => "", "inorden" => "", "postorden" => ""];
$error = $error ?? "";
$tree = $tree ?? null;
$treeHtml = $treeHtml ?? "";
$calculated = $calculated ?? null;
$constructionMethod = $constructionMethod ?? "";
$provided = $provided ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Árbol binario</title>
    <link rel="stylesheet" href="../Style_css/style_base.css">
    <link rel="stylesheet" href="../Style_css/arbolBinario.css">
</head>
<body>
    <h1>Construir un árbol binario</h1>
    <p class="nota">Ingresa al menos dos recorridos. Separa los nodos con comas, flechas (→) o saltos de línea.</p>

    <form action="../operaciones/arbol.php" method="post">
        <div>
            <label for="preorden">Preorden:</label><br>
            <textarea id="preorden" name="preorden" placeholder="A, B, D, E, C"><?php echo htmlspecialchars(is_string($rawTraversals["preorden"] ?? null) ? $rawTraversals["preorden"] : "", ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8"); ?></textarea>
        </div>
        <div>
            <label for="inorden">Inorden:</label><br>
            <textarea id="inorden" name="inorden" placeholder="D, B, E, A, C"><?php echo htmlspecialchars(is_string($rawTraversals["inorden"] ?? null) ? $rawTraversals["inorden"] : "", ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8"); ?></textarea>
        </div>
        <div>
            <label for="postorden">Postorden:</label><br>
            <textarea id="postorden" name="postorden" placeholder="D, E, B, C, A"><?php echo htmlspecialchars(is_string($rawTraversals["postorden"] ?? null) ? $rawTraversals["postorden"] : "", ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8"); ?></textarea>
        </div>
        <div>
            <button type="submit">Construir árbol</button>
            <a href="arbolBinario.php" class="button-limpiar">Limpiar</a>
        </div>
    </form>

    <?php if ($error !== ""): ?>
        <div class="mensaje-error" role="alert"><?php echo htmlspecialchars($error, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8"); ?></div>
    <?php endif; ?>

    <?php if ($tree !== null && $calculated !== null): ?>
        <div>
            <h2>Árbol construido</h2>
            <p class="nota">Construido usando <?php echo htmlspecialchars($constructionMethod, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8"); ?>.</p>
            <?php if (isset($provided["preorden"], $provided["postorden"]) && !isset($provided["inorden"])): ?>
                <p class="nota">Con preorden y postorden solamente, el árbol puede no ser único; los nodos con un solo hijo se ubican a la izquierda.</p>
            <?php endif; ?>
            <ul class="arbol"><?php echo $treeHtml; ?></ul>
        </div>
        <div>
            <h2>Recorridos</h2>
            <?php foreach ($calculated as $name => $nodes): ?>
                <p class="nota"><strong><?php echo ucfirst($name); ?>:</strong> <?php echo htmlspecialchars(implode(" → ", $nodes), ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8"); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div>
        <a href="../index.html" class="enlace-volver">Volver</a>
    </div>
</body>
</html>
