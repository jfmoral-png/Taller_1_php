<?php
class Logica
{
    public function union($conjunto1, $conjunto2)
    {
        return array_values(array_unique(array_merge($conjunto1, $conjunto2)));
    }

    public function interseccion($conjunto1, $conjunto2)
    {
        return array_values(array_intersect($conjunto1, $conjunto2));
    }

    public function diferencia($conjunto1, $conjunto2)
    {
        return [
            "A-B" => array_values(array_diff($conjunto1, $conjunto2)),
            "B-A" => array_values(array_diff($conjunto2, $conjunto1)),
        ];
    }
}

$conjuntos = $_POST["conjuntos"] ?? [1 => [], 2 => []];
$conjuntos[1] = $conjuntos[1] ?? [];
$conjuntos[2] = $conjuntos[2] ?? [];

if (isset($_POST["agregar"])) {
    $elemento = $_POST["elemento"] ?? "";
    if ($elemento !== "") {
        $conjuntos[$_POST["agregar"]][] = $elemento;
    }

    header("Location: ../paginas/logica.php?" . http_build_query([
        "conjuntos" => $conjuntos,
    ]));
    exit;
}

$accion = $_POST["accion"] ?? "";
$logica = new Logica();

switch ($accion) {
    case "union":
        $resultado = $logica->union($conjuntos[1], $conjuntos[2]);
        break;
        $resultado = $logica->union($conjuntos[1], $conjuntos[2]);
    case "interseccion":
        $resultado = $logica->interseccion($conjuntos[1], $conjuntos[2]);
        break;
        $resultado = $logica->interseccion($conjuntos[1], $conjuntos[2]);
    case "diferencia":
        $resultado = $logica->diferencia($conjuntos[1], $conjuntos[2]);
        break;
        $resultado = $logica->diferencia($conjuntos[1], $conjuntos[2]);
    default:
        $resultado = [];
}


header("Location: ../paginas/logica.php?" . http_build_query([
    "conjuntos" => $conjuntos,
    "resultado" => $resultado,
]));
exit;
