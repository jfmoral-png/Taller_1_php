<?php

class Calculadora
{
    public function operar($numero1, $numero2, $operador)
    {
        switch ($operador) {
            case "suma":
                return $numero1 + $numero2;
            case "resta":
                return $numero1 - $numero2;
            case "multiplicacion":
                return $numero1 * $numero2;
            case "division":
                if ($numero2 == 0) {
                    return "Error: División por cero";
                }
                return $numero1 / $numero2;
            default:
                return "Error: Operación no válida";
        }
    
    }
}

$accion = $_POST["accion"] ?? "";
$numero1 = $_POST["numero1"] ?? "";
$numero2 = $_POST["numero2"] ?? "";
$operador = $_POST["operaciones"] ?? "";
$historial = $_POST["historial"] ?? $_GET["historial"] ?? "";

$calculadora = new Calculadora();

$resultado = $calculadora->operar($numero1, $numero2, $operador);
$operador = match ($operador) {
    "suma" => "+",
    "resta" => "-",
    "multiplicacion" => "*",
    "division" => "/",
    default => $operador,
};

$historial .= ($historial === "" ? "" : "\n") . "$numero1 $operador $numero2 = $resultado";

header("Location: ../paginas/calculadora.php?" . http_build_query([
    "resultado" => $resultado,
    "historial" => $historial
]));
exit;
