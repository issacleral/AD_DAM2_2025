<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.cdnfonts.com/css/pricedown" rel="stylesheet">
    <link rel="stylesheet" href="style/reiniciar.css">
    <title>Misión Reiniciada</title>
</head>
<body>
    <div class="reset-container">
        <h1>MISIÓN REINICIADA</h1>
        <div class="wasted">WASTED</div>
        <p>Volviendo al punto de inicio...</p>
    </div>
    
    <script>
        setTimeout(function() {
            window.location.href = 'index.php';
        }, 3000);
    </script>
</body>
</html>