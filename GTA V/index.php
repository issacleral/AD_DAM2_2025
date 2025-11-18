<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.cdnfonts.com/css/pricedown" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">
    <title>GTA V Escape Room</title>
</head>
<body>
    <div class="gta-container">
        <div class="gta-header">
            <h1>GRAND THEFT AUTO V</h1>
            <h2>ESCAPE ROOM - LOS SANTOS</h2>
        </div>
        
        <div class="gta-content">
            <p>Estás atrapado en una misión de GTA V.<br>
               Tienes que escapar de 7 localizaciones<br>
               resolviendo 5 códigos de 3 dígitos.<br>
               ¡Buena suerte, criminal! 🚗💨</p>

            <div class="gta-button">
                <form action="game.php" method="post">
                    <button type="submit" class="gta-btn">INICIAR MISIÓN</button>
                </form>
            </div>
        </div>
        
        <div class="gta-footer">
            <p>ROCKSTAR GAMES PRESENTS</p>
        </div>
    </div>
</body>
</html>