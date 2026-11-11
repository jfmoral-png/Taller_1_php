<?php

$title = "Suceciones";
$subtitle = "Fibonacci y Factorial";
$button1 = "Fibonacci";
$button2 = "Factorial";
$result = "Secuencias";
$accion = "Fibonacci";

if (isset($_GET["modo"]) && $_GET["modo"] === "binario"){
    $title = "Binario";
    $subtitle = "Convertir a Binario";
    $button1 = "Convertir";
    $button2 = "";
    $result = "Número binario";
    $accion = "binario";    
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="../Style_css/style_base.css">

</head>
<body>
    <div>
        <h1><?php echo $subtitle; ?></h1>
    </div>
    <form action="../operaciones/fibo_binario.php" method="post">
        <div>
            <label for="numero">Ingrese un número:</label>
            <input type="number" id="numero" name="numero" required>
        </div>
        
        <div>
            <button type="submit" name="accion" value="<?php echo $accion; ?>"><?php echo $button1; ?></button>
            <?php if ($button2 !== ""): ?>
                <button type="submit" name="accion" value="Factorial"><?php echo $button2; ?></button>
            <?php endif; ?>
            <br>
        </div>

        <div id="secuencia">
            <label for="secuencia"><?php echo $result; ?>:</label>
            <input type="text" id="secuencia" name="secuencia" 
            value="<?php echo htmlspecialchars($_GET["resultado"] ?? ""); ?>" 
            readonly>
        </div>
    </form>
    
    <div>
        <a href="../index.html" class="enlace-volver">Volver</a>
    </div>
    
</body>
</html>