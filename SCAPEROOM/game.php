<?php
session_start();

if (!isset($_SESSION['habitacion_actual'])) {
    $_SESSION['habitacion_actual'] = 0;
    $_SESSION['salas_descubiertas'] = [0, 1, 2, 3];
    $_SESSION['candados_resueltos'] = [];
    $_SESSION['intentos_c5'] = 0;
    $_SESSION['pistas_encontradas'] = [];
}

header("Location: habitacion.php");
exit();
?>