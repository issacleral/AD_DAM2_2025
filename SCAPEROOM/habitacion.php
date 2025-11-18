<?php
session_start();

if (!isset($_SESSION['habitacion_actual'])) {
    header("Location: index.php");
    exit();
}

$habitacion_actual = $_SESSION['habitacion_actual'];
$salas_descubiertas = $_SESSION['salas_descubiertas'];
$candados_resueltos = $_SESSION['candados_resueltos'];

$habitaciones = [
    0 => [
        'nombre' => 'Sala de Inicio',
        'descripcion' => 'Estás en una sala oscura. Hay puertas hacia el norte, este y oeste.',
        'imagen' => 'img/sala0.png',
        'salas_accesibles' => [1, 2, 3]
    ],
    1 => [
        'nombre' => 'Sala 1',
        'descripcion' => 'Una sala con paredes de piedra. Hay símbolos extraños en las paredes.',
        'imagen' => 'img/sala1.png',
        'salas_accesibles' => [0]
    ],
    2 => [
        'nombre' => 'Sala 2', 
        'descripcion' => 'Esta sala tiene un techo muy alto. Se escuchan ecos.',
        'imagen' => 'img/sala2.png',
        'salas_accesibles' => [0]
    ],
    3 => [
        'nombre' => 'Sala 3',
        'descripcion' => 'Una sala circular con mosaicos en el suelo.',
        'imagen' => 'img/sala3.png',
        'salas_accesibles' => [0]
    ],
    4 => [
        'nombre' => 'Sala 4',
        'descripcion' => 'Sala con candado C4. Has superado el primer candado.',
        'imagen' => 'img/sala4.png',
        'salas_accesibles' => [0]
    ],
    5 => [
        'nombre' => 'Sala 5',
        'descripcion' => 'Sala con candado C5. Cuidado, solo 3 intentos.',
        'imagen' => 'img/sala5.png',
        'salas_accesibles' => [0]
    ],
    6 => [
        'nombre' => 'Sala Final',
        'descripcion' => '¡Felicidades! Has escapado.',
        'imagen' => 'img/sala6.png',
        'salas_accesibles' => []
    ]
];

$habitacion = $habitaciones[$habitacion_actual];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/habitacion.css">
    <title><?php echo $habitacion['nombre']; ?></title>
</head>
<body>
    <h1><?php echo $habitacion['nombre']; ?></h1>
    
    <div class="habitacion-info">
        <p><?php echo $habitacion['descripcion']; ?></p>
        
        <?php if (file_exists($habitacion['imagen'])): ?>
            <img src="<?php echo $habitacion['imagen']; ?>" alt="<?php echo $habitacion['nombre']; ?>">
        <?php else: ?>
            <div class="placeholder-imagen">
                Imagen de <?php echo $habitacion['nombre']; ?> (<?php echo $habitacion['imagen']; ?>)
            </div>
        <?php endif; ?>
    </div>

    <div class="navegacion">
        <h3>Moverse a:</h3>
        <?php 
        foreach ($habitacion['salas_accesibles'] as $sala): 
        ?>
            <form action="procesar.php" method="post">
                <input type="hidden" name="accion" value="mover">
                <input type="hidden" name="sala_destino" value="<?php echo $sala; ?>">
                <button type="submit">Sala <?php echo $sala; ?></button>
            </form>
        <?php endforeach; ?>
    </div>

    <div class="candados">
        <h3>Candados:</h3>
        
        <?php if (in_array($habitacion_actual, [0, 1, 2, 3]) && !in_array('C1', $candados_resueltos)): ?>
            <form action="procesar.php" method="post">
                <input type="hidden" name="accion" value="candado">
                <input type="hidden" name="candado_id" value="C1">
                <label>Candado C1: </label>
                <input type="text" name="codigo" maxlength="3" placeholder="000" pattern="[0-9]{3}" required>
                <button type="submit">Probar código</button>
            </form>
        <?php endif; ?>

        <?php if (in_array('C1', $candados_resueltos) && !in_array('C2', $candados_resueltos)): ?>
            <form action="procesar.php" method="post">
                <input type="hidden" name="accion" value="candado">
                <input type="hidden" name="candado_id" value="C2">
                <label>Candado C2: </label>
                <input type="text" name="codigo" maxlength="3" placeholder="000" pattern="[0-9]{3}" required>
                <button type="submit">Probar código</button>
            </form>
        <?php endif; ?>

        <?php if (in_array('C2', $candados_resueltos) && !in_array('C3', $candados_resueltos)): ?>
            <form action="procesar.php" method="post">
                <input type="hidden" name="accion" value="candado">
                <input type="hidden" name="candado_id" value="C3">
                <label>Candado C3: </label>
                <input type="text" name="codigo" maxlength="3" placeholder="000" pattern="[0-9]{3}" required>
                <button type="submit">Probar código</button>
            </form>
        <?php endif; ?>

        <?php if ($habitacion_actual == 4 && !in_array('C4', $candados_resueltos)): ?>
            <form action="procesar.php" method="post">
                <input type="hidden" name="accion" value="candado">
                <input type="hidden" name="candado_id" value="C4">
                <label>Candado C4: </label>
                <input type="text" name="codigo" maxlength="3" placeholder="000" pattern="[0-9]{3}" required>
                <button type="submit">Probar código</button>
            </form>
        <?php endif; ?>

        <?php if ($habitacion_actual == 5 && !in_array('C5', $candados_resueltos)): ?>
            <form action="procesar.php" method="post">
                <input type="hidden" name="accion" value="candado">
                <input type="hidden" name="candado_id" value="C5">
                <label>Candado C5 (Intentos: <?php echo $_SESSION['intentos_c5']; ?>/3): </label>
                <input type="text" name="codigo" maxlength="3" placeholder="000" pattern="[0-9]{3}" required>
                <button type="submit">Probar código</button>
            </form>
        <?php endif; ?>

        <?php if (empty($candados_resueltos) && !in_array($habitacion_actual, [0, 1, 2, 3])): ?>
            <p>No hay candados disponibles aquí.</p>
        <?php endif; ?>
    </div>

    <?php if ($habitacion_actual == 6): ?>
        <div class="victoria">
            <h2>¡FELICIDADES! 🎉</h2>
            <p>Has completado el escape room y escapado con éxito.</p>
        </div>
    <?php endif; ?>

    <div class="reiniciar">
        <form action="reiniciar.php" method="post">
            <button type="submit">Reiniciar Juego</button>
        </form>
    </div>

</body>
</html>