<?php
function conectarDB()
{
    try
    {
        $cadenaConexion = "mysql:host=localhost;dbname=DB_JUEGOS";
        $usu="root";
        $pw="";
        $db = new PDO($cadenaConexion,$usu,$pw);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $db;
    }
    catch (PDOException $ex)
    {
        echo "Error conectando ".$ex->getMessage();
    }
}
function getTodosJuegos($db)
{
    $vectorTotal = array();
    try
    {
        $stmt = $db->query("SELECT * FROM JUEGOS");
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $vectorTotal[] = $fila;
        }
    }
    catch(PDOException $ex)
    {
        echo "Error en getTodosJuegos ".$ex->getMessage();
    }

    return $vectorTotal;
}
function getJuegosPorCategoria($db, $nombre_categoria)
{
    $vectorTotal = array();
    try
    {
        $query= "SELECT * FROM JUEGOS WHERE CATEGORIA=:CATEGORIA";
        $pstmt = $db->prepare($query,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $pstmt->execute(array(':CATEGORIA' => $nombre_categoria));
        while ($fila = $pstmt->fetch(PDO::FETCH_ASSOC))
        {
            $vectorTotal[] = $fila;
        }
    }
    catch(PDOException $ex)
    {
        echo "Error en getJuegosPorCategoria ".$ex->getMessage();
    }
    return $vectorTotal;
}
function getJuegosPorCategoriaYNombre($db, $nombre_categoria,$nombre_entrada)
{
    $vectorTotal = array();
    try
    {
        $query= "SELECT * FROM JUEGOS WHERE CATEGORIA=:CATEGORIA AND NOMBRE=:NOMBRE";
        $pstmt = $db->prepare($query,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $pstmt->execute(array(':CATEGORIA' => $nombre_categoria,':NOMBRE' => $nombre_entrada));
        while ($fila = $pstmt->fetch(PDO::FETCH_ASSOC))
        {
            $vectorTotal[] = $fila;
        }
    }
    catch(PDOException $ex)
    {
        echo "Error en getJuegosPorCategoria ".$ex->getMessage();
    }
    return $vectorTotal;
}
function contarTodosJuegos($db)
{
    try
    {
        $stmt = $db->query("SELECT COUNT(*) TOTAL FROM JUEGOS");
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    catch(PDOException $ex)
    {
        echo "Error en contarTodosJuegos ".$ex->getMessage();
    }
    return $fila['TOTAL'];
}

function insertarJuego($db,$nombre,$descripcion,$categoria)
{
    $sqlInsert = "INSERT INTO JUEGOS(NOMBRE, DESCRIPCION, CATEGORIA) 
                    VALUES (:NOMBRE, :DESCRIPCION, :CATEGORIA)";
    try
    {
        $stmt = $db->prepare($sqlInsert);
        $stmt->bindParam(":NOMBRE",$nombre);
        $stmt->bindParam(":DESCRIPCION",$descripcion);
        $stmt->bindParam(":CATEGORIA",$categoria);
        $stmt->execute();
    }
    catch(PDOException $ex)
    {
        echo "Error en insertarJuego ".$ex->getMessage();
    }
    return $db->lastInsertId();
}

?>