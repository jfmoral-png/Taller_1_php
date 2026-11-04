<?php

class Calculadora {
    public function operar($valor1, $valor2, $operador){
        switch ($operador){
            case "+":
                return $valor1 + $valor2;
            case "-" :
                return $valor1 - $valor2;
            case "*" :
                return $valor1 * $valor2;
            case "/" :
                return $valor1 / $valor2;
            case "%" :
                return fmod($valor1, $valor2);
        }

        return $valor1;
    }
}

$accion = $_POST["accion"] ?? "";
$pantalla = $_POST["pantalla"] ?? "";
$numero = $_POST["numero"] ?? "";

if (!is_string($accion) || !is_string($pantalla) || !is_string($numero)) {
    http_response_code(400);
    exit("Solicitud no válida.");
}

if ($accion === "AC" || $accion === "C") {
    $pantalla = "";
} elseif ($accion === "del") {
    $pantalla = substr($pantalla, 0, -1);
} elseif ($numero !== "") {
    $pantalla .= $numero;
} elseif ($accion === ".") {
    $partes = preg_split('/[+\-*\/%]/', $pantalla);
    $ultimoNumero = end($partes);
    if (strpos($ultimoNumero, ".") === false) {
        $pantalla .= $ultimoNumero === "" ? "0." : ".";
    }
} elseif (in_array($accion, ["%", "/", "*", "-", "+"], true)) {
    if (preg_match('/[\d.]$/', $pantalla) === 1) {
        $pantalla .= $accion;
    } elseif (preg_match('/[+\-*\/%]$/', $pantalla) === 1) {
        $pantalla = substr($pantalla, 0, -1) . $accion;
    }
}

if ($accion === "=") {
    $patron = '/^(\d+(?:\.\d*)?|\.\d+)([+\-*\/%])(\d+(?:\.\d*)?|\.\d+)$/';
    if (preg_match($patron, $pantalla, $coincidencias) === 1) {
        $valor1 = (float) $coincidencias[1];
        $operador = $coincidencias[2];
        $valor2 = (float) $coincidencias[3];

        if (($operador === "/" || $operador === "%") && $valor2 == 0) {
            $pantalla = "Error: no se puede dividir entre cero";
        } else {
            $calculadora = new Calculadora();
            $pantalla = (string) $calculadora->operar($valor1, $valor2, $operador);
        }
    }
}

header("Location: ../paginas/calculadora.php?" . http_build_query([
    "pantalla" => $pantalla
]));
exit;
