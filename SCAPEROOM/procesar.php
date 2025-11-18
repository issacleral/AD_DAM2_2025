<?php
session_start();

$codigos_candados = [
    'C1' => '123', 
    'C2' => '456',
    'C3' => '789', 
    'C4' => '234',
    'C5' => '999'
];

if ($_POST['accion'] == 'mover') {
    $sala_destino = (int)$_POST['sala_destino'];
    $_SESSION['habitacion_actual'] = $sala_destino;
    
    if (!in_array($sala_destino, $_SESSION['salas_descubiertas'])) {
        $_SESSION['salas_descubiertas'][] = $sala_destino;
    }
}

if ($_POST['accion'] == 'candado') {
    $candado_id = $_POST['candado_id'];
    $codigo_introducido = $_POST['codigo'];
    
    if ($codigo_introducido == $codigos_candados[$candado_id]) {
        $_SESSION['candados_resueltos'][] = $candado_id;
        
        switch($candado_id) {
            case 'C1':
                $_SESSION['salas_descubiertas'][] = 4;
                $_SESSION['habitacion_actual'] = 4;
                break;
            case 'C2':
                $_SESSION['salas_descubiertas'][] = 5;
                $_SESSION['habitacion_actual'] = 5;
                break;
            case 'C3':
                $_SESSION['salas_descubiertas'][] = 6;
                $_SESSION['habitacion_actual'] = 6;
                break;
        }
    } else {
        if ($candado_id == 'C5') {
            $_SESSION['intentos_c5']++;
            
            if ($_SESSION['intentos_c5'] >= 3) {
                header("Location: reiniciar.php");
                exit();
            }
        }
    }
}

header("Location: habitacion.php");
exit();
?>