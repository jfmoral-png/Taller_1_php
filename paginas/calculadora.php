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
    <div class="calculadora">
        <svg width="300" height="400" xmlns="http://www.w3.org/2000/svg">
            <rect class="fondo" />
            <text x="20" y="40" fill="white" font-size="24">Calculadora</text>
            <rect class="pantalla" />
            //primeros fila borrar borradoes
            <rect class="tecla" x="10" y="140" width="50" height="40" rx="5" fill="#b8b3b3" />
            <rect class="tecla" x="80" y="140" width="50" height="40" rx="5" fill="#b8b3b3" />
            <rect class="tecla" x="150" y="140" width="50" height="40" rx="5" fill="#b8b3b3" />
            <rect class="tecla" x="220" y="140" width="50" height="40" rx="5" fill="#b8b3b3" />
            //segunda fila 7 8 9 /
            <rect class="tecla" x="10" y="190" width="50" height="40" rx="5" fill="#b8b3b3" />
            <rect class="tecla" x="80" y="190" width="50" height="40" rx="5" fill="#b8b3b3" />
            <rect class="tecla" x="150" y="190" width="50" height="40" rx="5" fill="#b8b3b3" />
            <rect class="tecla" x="220" y="190" width="50" height="40" rx="5" fill="#b8b3b3" />
            //tercera fila 4 5 6 *
            <rect class="tecla" x="10" y="240" width="50" height="40" rx="5" fill="#b8b3b3" />
            <rect class="tecla" x="80" y="240" width="50" height="40" rx="5" fill="#b8b3b3" />
            <rect class="tecla" x="150" y="240" width="50" height="40" rx="5" fill="#b8b3b3" />
            <rect class="tecla" x="220" y="240" width="50" height="40" rx="5" fill="#b8b3b3" />
            //cuarta fila 1 2 3 -
            <rect class="tecla" x="10" y="290" width="50" height="40" rx="5" fill="#b8b3b3" />
            <rect class="tecla" x="80" y="290" width="50" height="40" rx="5" fill="#b8b3b3" />
            <rect class="tecla" x="150" y="290" width="50" height="40" rx="5" fill="#b8b3b3" />
            <rect class="tecla" x="220" y="290" width="50" height="40" rx="5" fill="#b8b3b3" />
            //quinta fila 0 . = +
            <rect class="tecla" x="10" y="340" width="50" height="40" rx="5" fill="#b8b3b3" />
            <rect class="tecla" x="80" y="340" width="50" height="40" rx="5" fill="#b8b3b3" />
            <rect class="tecla" x="150" y="340" width="50" height="40" rx="5" fill="#b8b3b3" />
            <rect class="tecla" x="220" y="340" width="50" height="40" rx="5" fill="#b8b3b3" />
        </svg>

        

    <form action="../operaciones/calculadora.php" method="post">
        <div class="pantallaReal">
            <input type="text" id="pantalla" name="pantalla"
            value="<?php echo htmlspecialchars($_GET["pantalla"] ?? "", ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8"); ?>" readonly>
        </div>
        <div class="teclado">
            <button type="submit" name="accion" value="AC">AC</button>
            <button type="submit" name="accion" value="del">DEL</button>
            <button type="submit" name="accion" value="C">C</button>
            <button type="submit" name="accion" value="%">%</button>

            <button type="submit" name="numero" value="7">7</button>
            <button type="submit" name="numero" value="8">8</button>
            <button type="submit" name="numero" value="9">9</button>
            <button type="submit" name="accion" value="/">/</button>

            <button type="submit" name="numero" value="4">4</button>
            <button type="submit" name="numero" value="5">5</button>
            <button type="submit" name="numero" value="6">6</button>
            <button type="submit" name="accion" value="*">*</button>

            <button type="submit" name="numero" value="1">1</button>
            <button type="submit" name="numero" value="2">2</button>
            <button type="submit" name="numero" value="3">3</button>
            <button type="submit" name="accion" value="-">-</button>

            <button type="submit" name="accion" value=".">.</button>
            <button type="submit" name="numero" value="0">0</button>
            <button type="submit" name="accion" value="=">=</button>
            <button type="submit" name="accion" value="+">+</button>
        </div>
    </form>
    </div>
    
    <div class="volver">
        <a href="../index.html">Volver</a>
    </div>
    
</body>
</html>