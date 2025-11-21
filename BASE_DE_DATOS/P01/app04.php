<?php
require_once("dbutils.php");
$miConexion = conectarDB();
$total_juegos = contarTodosJuegos($miConexion);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST["nombre"] ?? "");
    $descripcion = trim($_POST["descripcion"] ?? "");
    $categoria = trim($_POST["categoria"] ?? "");

    if ($nombre !== "" && $descripcion !== "" && $categoria !== "") {

        insertarJuego($miConexion, $nombre, $descripcion, $categoria);
        header("Location: app05.php?ok=1");
        exit;

    } else {
        $mensaje = "Rellena todos los campos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

    <h2>EL NÚMERO TOTAL DE JUEGOS ACTUALMENTE ES: <?php echo $total_juegos; ?></h2>

    <form method="POST">
        <input type="text" name="nombre" placeholder="Nombre"><br><br>
        <input type="text" name="descripcion" placeholder="Descripción"><br><br>
        <input type="text" name="categoria" placeholder="Categoría"><br><br>

        <button type="submit">Insertar</button>
    </form>

    <?php if (!empty($mensaje)): ?>
        <p><?php echo $mensaje; ?></p>
    <?php endif; ?>

</body>
</html>



