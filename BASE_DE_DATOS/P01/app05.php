<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

<?php
if (isset($_GET["ok"]) && $_GET["ok"] == 1) {
    echo "<h3>Juego insertado correctamente.</h3>";
} else {
    echo "<h3>No se ha insertado ningún juego.</h3>";
}
?>

<br>
<a href="app04.php">Volver</a>

</body>
</html>
