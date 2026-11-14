<?php
$frase = $_POST["frase"] ?? "";
$accion = $_POST["accion"] ?? "";

if (!is_string($frase)) {
    http_response_code(400);
    exit("Solicitud no válida.");
}

$palabras = preg_split('/[\s-]+/u', $frase);
if ($palabras === false) {
    http_response_code(400);
    exit("La frase contiene texto no válido.");
}

$iniciales = [];
foreach ($palabras as $palabra) {
    if (preg_match('/\p{L}/u', $palabra, $coincidencia) === 1) {
        $inicial = strtr($coincidencia[0], [
            "ñ" => "Ñ",
        ]);
        $iniciales[] = strtoupper($inicial);
    }
}

header("Location: ../paginas/acronomos.php?resultado="
    . urlencode(implode("", $iniciales)));
exit;
