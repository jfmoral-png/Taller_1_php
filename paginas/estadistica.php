<?php
$numeros = $_GET["numeros"] ?? [];
if (!is_array($numeros)) {
    $numeros = [];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadística</title>
    <link rel="stylesheet" href="../Style_css/style_base.css">
</head>

<body>
    <form action="../operaciones/estadistica.php" method="post">
        <?php foreach ($numeros as $numero): ?>
            <input type="hidden" name="numeros[]"
                value="<?php echo htmlspecialchars((string) $numero, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8"); ?>">
        <?php endforeach; ?>

        <div>
            <label for="numero">Número:</label>
            <input type="number" id="numero" name="numero" step="any">
            <button type="submit" name="accion" value="anadir">Añadir</button>
            <a href="../paginas/estadistica.php" class="button-limpiar">Limpiar</a>
        </div>

        <div>
            <button type="submit" name="accion" value="calcular">Calcular</button>
        </div>

        <div>
            <label for="numeros">Números:</label>
            <input type="text" id="numeros"
                value="<?php echo htmlspecialchars(implode(", ", $numeros), ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8"); ?>"
                readonly>
        </div>

        <div>
            <label for="promedio">Promedio:</label>
            <input type="text" id="promedio"
                value="<?php echo htmlspecialchars($_GET["promedio"] ?? "", ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8"); ?>"
                readonly>
        </div>
        <div>
            <label for="mediana">Mediana:</label>
            <input type="text" id="mediana"
                value="<?php echo htmlspecialchars($_GET["mediana"] ?? "", ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8"); ?>"
                readonly>
        </div>
        <div>
            <label for="moda">Moda:</label>
            <input type="text" id="moda"
                value="<?php echo htmlspecialchars($_GET["moda"] ?? "", ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8"); ?>"
                readonly>
        </div>
    </form>

    <div>
        <a href="../index.html" class="enlace-volver">Volver</a>
    </div>
</body>

</html>