<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Escape Room Online</title>
</head>
<body>
    <h1>Escape Room Online</h1>
    <p>Estás en una sala oscura en la cual<br>
        estás atrapado hasta que encuentres la salida.<br>
        Tienes que completar el escape room: hay 7 habitaciones<br>
        y 5 candados de 3 dígitos. ¡Bienvenido ☠️</p>

    <div id="botonInicial">
        <form action="game.php" method="post">
            <button type="submit">Comenzamos</button>
        </form>
    </div>
</body>
</html>