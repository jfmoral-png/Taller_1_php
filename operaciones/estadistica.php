<?php
class Estadistica {
    public function promedio($numeros) {
        $suma = array_sum($numeros);
        $promedio = $suma / count($numeros);
        return $promedio;
    }

    public function mediana($numeros) {
        sort($numeros, SORT_NUMERIC);
        $cantidad = count($numeros);
        $mitad = intdiv($cantidad, 2);

        if ($cantidad % 2 === 0) {
            $mediana = ($numeros[$mitad - 1] + $numeros[$mitad]) / 2;
        } else {
            $mediana = $numeros[$mitad];
        }

        return $mediana;
    }

    public function moda($numeros) {
        $frecuencias = array_count_values($numeros);
        $moda = array_search(max($frecuencias), $frecuencias);
        return $moda;
    }
}

$numeros = $_POST["numeros"] ?? [];
$accion = $_POST["accion"] ?? "";

if ($accion === "anadir") {
    $numero = $_POST["numero"] ?? "";
    if ($numero !== "" && is_numeric($numero)) {
        $numeros[] = $numero;
    }
} elseif ($accion === "calcular") {
    if (count($numeros) > 0) {
        $estadistica = new Estadistica();
        header("Location: ../paginas/estadistica.php?" . http_build_query([
            "numeros" => $numeros,
            "promedio" => $estadistica->promedio($numeros),
            "mediana" => $estadistica->mediana($numeros),
            "moda" => $estadistica->moda($numeros),
        ]));
        exit;
    }
}

header("Location: ../paginas/estadistica.php?" . http_build_query([
    "numeros" => $numeros,
]));
exit;
