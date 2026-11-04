<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acrónimos</title>
    <link rel="stylesheet" href="../Style_css/style_base.css">

</head>
<body>
    <div>
        <h1>Convertir a Acrónimos</h1>
    </div>
    <form action="../operaciones/acronomos.php" method="post">
        <div>
            <label for="frase">Frase</label>
            <input type="text" id="frase" name="frase" required>
        </div>

        <div>
            <button id="convertir" type="submit" name="accion" value="convertir">Convertir</button>
        </div>

        <div>
            <label for="acronimo">Acrónimo</label>
            <input type="text" id="acronimo" name="acronimo"
            value="<?php echo htmlspecialchars($_GET["resultado"] ?? "", ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8"); ?>" readonly>
        </div>
    </form>
    <?php if (isset($_GET["mensaje"])): ?>
        <p role="status"><?php echo htmlspecialchars($_GET["mensaje"], ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8"); ?></p>
    <?php endif; ?>

    <div>
        <a href="../index.html">Volver</a>
    </div>

</body>
</html>