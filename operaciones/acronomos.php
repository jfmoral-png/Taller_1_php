<?php
$frase = $_POST["frase"] ?? "";
$accion = $_POST["accion"] ?? "";

if ($_SERVER["REQUEST_METHOD"] !== "POST" || $accion !== "convertir" || !is_string($frase)) {
    http_response_code(400);
    exit("Solicitud no válida.");
}

$frase = trim($frase);
if ($frase === "") {
    header("Location: ../paginas/acronomos.php?mensaje=" . urlencode("Escribe una frase antes de convertir."));
    exit;
}

$palabras = preg_split('/\s+/u', $frase);
if ($palabras === false) {
    http_response_code(400);
    exit("La frase contiene texto no válido.");
}

$iniciales = [];
foreach ($palabras as $palabra) {
    if (preg_match('/\p{L}/u', $palabra, $coincidencia) === 1) {
        $inicial = strtr($coincidencia[0], [
            "á" => "Á", "é" => "É", "í" => "Í", "ó" => "Ó", "ú" => "Ú",
            "ü" => "Ü", "ñ" => "Ñ",
        ]);
        $iniciales[] = strtoupper($inicial);
    }
}

if ($iniciales === []) {
    header("Location: ../paginas/acronomos.php?mensaje=" . urlencode("Escribe una frase con letras."));
    exit;
}

header("Location: ../paginas/acronomos.php?resultado=" 
. urlencode(implode("", $iniciales)));
exit;
