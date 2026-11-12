<?php
class FiboBinario
{
    public function calcular(string $modo, int $numero)
    {
        switch ($modo) {
            case 'Fibonacci':
                return $this->fibonacci($numero);
            case 'Factorial':
                return $this->factorial($numero);
            case 'binario':
                return $this->decimalToBinary($numero);
            default:
                return "Modo no válido";
        }
    }

    public function decimalToBinary($number)
    {
        if ($number < 0) {
            return "Número inválido";
        }
        $result = '';
        $result = decbin($number);
        return $result;
    }

    public function fibonacci($n)
    {
        if ($n < 0) {
            return "Número inválido";
        }
        $sequence = [];
        for ($i = 0; $i < $n; $i++) {
            if ($i === 0) {
                $sequence[] = 0;
            } elseif ($i === 1) {
                $sequence[] = 1;
            } else {
                $sequence[] = $sequence[$i - 1] + $sequence[$i - 2];
            }
        }
        return implode(", ", $sequence);
    }

    public function factorial($n)
    {
        if ($n < 0) {
            return "Número inválido";
        }
        $result = 1;
        for ($i = 2; $i <= $n; $i++) {
            $result *= $i;
        }
        return $result;
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numero = filter_input(INPUT_POST, "numero", FILTER_VALIDATE_INT);
    $accion = $_POST["accion"] ?? "";

    if ($numero === false || $numero === null || $numero < 0) {
        exit("Ingresa un número entero igual o mayor que cero.");
    }

    $calculadora = new FiboBinario();
    $resultado = $calculadora->calcular($accion, $numero);
    $modo = $accion === "binario" ? "&modo=binario" : "";

    header(
        "Location: ../paginas/fibonacci_binario.php?resultado="
        . urlencode((string) $resultado)
        . $modo
    );
    exit;
}
?>