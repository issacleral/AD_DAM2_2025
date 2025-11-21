<?php
require_once("dbutils.php");

$miConexion = conectarDB();
$mensaje = "";
function modificarJuego($db, $nombre, $descripcionNueva, $categoriaNueva)
{
    try {
        $sql = "UPDATE JUEGOS 
                SET DESCRIPCION = :DESCRIPCION, CATEGORIA = :CATEGORIA 
                WHERE NOMBRE = :NOMBRE";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":DESCRIPCION", $descripcionNueva);
        $stmt->bindParam(":CATEGORIA", $categoriaNueva);
        $stmt->bindParam(":NOMBRE", $nombre);

        $stmt->execute();
        return $stmt->rowCount();
    } 
    catch (PDOException $ex) {
        return -1;
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $desc = trim($_POST["descripcion"] ?? "");
    $cat  = trim($_POST["categoria"] ?? "");
    $nom  = trim($_POST["nombre"] ?? "");

    if ($desc !== "" && $cat !== "" && $nom !== "") {

        $resultado = modificarJuego($miConexion, $nom, $desc, $cat);

        if ($resultado > 0) {
            $mensaje = "Juego '$nom' modificado correctamente.";
        } else if ($resultado === 0) {
            $mensaje = "No existe ningún juego con el nombre '$nom'.";
        } else {
            $mensaje = "Error al modificar el juego.";
        }

    } else {
        $mensaje = "Rellena todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>App06 - Modificar Juego</title>
</head>
<body>

<h2>Modificar un Juego</h2>

<form method="POST">
    <input type="text" name="descripcion" placeholder="Nueva descripción"><br><br>
    <input type="text" name="categoria" placeholder="Nueva categoría"><br><br>
    <input type="text" name="nombre" placeholder="Nombre del juego a modificar"><br><br>

    <button type="submit">Modificar</button>
</form>

<?php if (!empty($mensaje)): ?>
    <p><?php echo $mensaje; ?></p>
<?php endif; ?>

</body>
</html>
