<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
    <link rel="stylesheet" href="../Style_css/style_base.css">
    <link rel="stylesheet" href="../Style_css/calculadora.css">

</head>

<body>
    <form action="../operaciones/calculadora.php" method="post">
        <div>
            <input type="number" id="numero1" placeholder="Diguite un numero" name="numero1" required>
            <label for="operaciones">Operaciones:</label>
            <select id="operaciones" name="operaciones">
                <option value="suma">Suma</option>
                <option value="resta">Resta</option>
                <option value="multiplicacion">Multiplicación</option>
                <option value="division">División</option>
            </select>
            <input type="num" id="numero2" placeholder="Diguite otro numero" name="numero2" required>
            <input type="hidden" name="historial"
                value="<?php echo htmlspecialchars($_GET['historial'] ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>">
        </div>
        <div>
            <button id="calcular" type="submit" name="accion">Calcular</button>
        </div>
    </form>

    <div class="resultado">
        <?php if (isset($_GET['resultado'])): ?>
            <p>Resultado: <?php echo htmlspecialchars($_GET['resultado'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></p>
        <?php endif; ?>
    </div>

    <div>
        <p>Historial de operaciones:</p>
        <textarea id="historial" placeholder="Historial de operaciones"
            readonly><?php echo htmlspecialchars($_GET['historial'] ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></textarea>
        <a href="calculadora.php" class="button-limpiar">Limpiar historial</a>
    </div>

    <div class="volver">
        <a href="../index.html" class="enlace-volver">Volver</a>
    </div>

</body>

</html>