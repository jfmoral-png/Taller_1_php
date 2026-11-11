<?php
$conjuntos = $_GET["conjuntos"] ?? [1 => [], 2 => []];
$conjunto1 = $conjuntos[1] ?? [];
$conjunto2 = $conjuntos[2] ?? [];
$resultado = $_GET["resultado"] ?? null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lógica de conjuntos</title>
    <link rel="stylesheet" href="../Style_css/style_base.css">
</head>
<body>
    
    <form action="../operaciones/logica.php" method="post">
        <?php foreach ($conjunto1 as $elemento): ?>
            <input type="hidden" name="conjuntos[1][]" value="<?php echo htmlspecialchars($elemento, ENT_QUOTES, "UTF-8"); ?>">
        <?php endforeach; ?>
        <?php foreach ($conjunto2 as $elemento): ?>
            <input type="hidden" name="conjuntos[2][]" value="<?php echo htmlspecialchars($elemento, ENT_QUOTES, "UTF-8"); ?>">
        <?php endforeach; ?>

        <div>
            <label for="elemento">Elemento:</label>
            <input type="text" id="elemento" name="elemento">
            <button type="submit" name="agregar" value="1">Añadir a Conjunto 1</button>
            <button type="submit" name="agregar" value="2">Añadir a Conjunto 2</button>
            <a href="../paginas/logica.php" class="button-limpiar">Limpiar</a>
        </div>

        <div>
            <label for="conjunto1">Conjunto 1: </label>
            <input type="text" id="conjunto1" value="<?php echo htmlspecialchars(implode(", ", $conjunto1), ENT_QUOTES, "UTF-8"); ?>" readonly>
        </div>
        <div>
            <label for="conjunto2">Conjunto 2: </label>
            <input type="text" id="conjunto2" value="<?php echo htmlspecialchars(implode(", ", $conjunto2), ENT_QUOTES, "UTF-8"); ?>" readonly>
        </div>

        <div>
            <button type="submit" name="accion" value="union">Unión</button>
            <button type="submit" name="accion" value="interseccion">Intersección</button>
            <button type="submit" name="accion" value="diferencia">Diferencia</button>
        </div>

        <div>
            <?php if (is_array($resultado) && isset($resultado["A-B"], $resultado["B-A"])): ?>
                <label for="a-b">A-B: </label>
                <input type="text" id="a-b" value="<?php echo htmlspecialchars(implode(", ", $resultado["A-B"]), ENT_QUOTES, "UTF-8"); ?>" readonly>
                <label for="b-a">B-A: </label>
                <input type="text" id="b-a" value="<?php echo htmlspecialchars(implode(", ", $resultado["B-A"]), ENT_QUOTES, "UTF-8"); ?>" readonly>
            <?php elseif (is_array($resultado)): ?>
                <label for="resultado">Resultado: </label>
                <input type="text" id="resultado" value="<?php echo htmlspecialchars(implode(", ", $resultado), ENT_QUOTES, "UTF-8"); ?>" readonly>
            <?php endif; ?>
        </div>
    </form>

    <div>
        <a href="../index.html" class="enlace-volver">Volver</a>
    </div>
    
</body>
</html>
