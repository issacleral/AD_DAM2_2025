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
        'nombre' => 'VINEWOOD - PUNTO DE INICIO',
        'descripcion' => 'Estás en los estudios de Vinewood. Hay tres vehículos disponibles para moverte por Los Santos. PISTA: Necesitas un CAR para escapar.',
        'imagen' => 'img/sala0.png',
        'salas_accesibles' => [1, 2, 3]
    ],
    1 => [
        'nombre' => 'MIRADOR DEL GOLFO',
        'descripcion' => 'Vista panorámica del golfo. Puedes ver el océano y los yates de lujo. PISTA: Un CAR rápido te llevará lejos.',
        'imagen' => 'img/sala1.png',
        'salas_accesibles' => [0]
    ],
    2 => [
        'nombre' => 'AEROPUERTO INTERNACIONAL', 
        'descripcion' => 'Aeropuerto de Los Santos. Aviones despegando constantemente. PISTA: Para FLY necesitas escapar primero.',
        'imagen' => 'img/sala2.png',
        'salas_accesibles' => [0]
    ],
    3 => [
        'nombre' => 'BARRIO DE DAVIS',
        'descripcion' => 'Zona urbana de Los Santos. Grafitis en las paredes y ambiente callejero. PISTA: En el casino debes WIN para progresar.',
        'imagen' => 'img/sala3.png',
        'salas_accesibles' => [0]
    ],
    4 => [
        'nombre' => 'CASINO Y HOTEL',
        'descripcion' => 'Lujo y juegos de azar. El lugar perfecto para ganar dinero rápido. PISTA: En la base militar necesitas GUN.',
        'imagen' => 'img/sala4.png',
        'salas_accesibles' => [0]
    ],
    5 => [
        'nombre' => 'BASE MILITAR',
        'descripcion' => 'Zona de alta seguridad. ¡Cuidado con los militares! PISTA: Cuando todo falla, solo RUN.',
        'imagen' => 'img/sala5.png',
        'salas_accesibles' => [0]
    ],
    6 => [
        'nombre' => 'MISIÓN COMPLETADA',
        'descripcion' => '¡HAS ESCAPADO DE LOS SANTOS! Recompensa: $10,000,000',
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
    <link href="https://fonts.cdnfonts.com/css/pricedown" rel="stylesheet">
    <link rel="stylesheet" href="style/habitacion.css">
    <title><?php echo $habitacion['nombre']; ?></title>
</head>
<body>
    <div class="gta-hud">
        <div class="location-header">
            <h1><?php echo $habitacion['nombre']; ?></h1>
            <div class="wanted-level">⭐️⭐️⭐️</div>
        </div>
        
        <div class="location-content">
            <p><?php echo $habitacion['descripcion']; ?></p>
            
            <?php if (file_exists($habitacion['imagen'])): ?>
                <img src="<?php echo $habitacion['imagen']; ?>" alt="<?php echo $habitacion['nombre']; ?>">
            <?php else: ?>
                <div class="map-placeholder">
                    MAPA DE <?php echo $habitacion['nombre']; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="gta-nav">
            <h3>🚗 MOVERSE A:</h3>
            <?php foreach ($habitacion['salas_accesibles'] as $sala): ?>
                <form action="procesar.php" method="post">
                    <input type="hidden" name="accion" value="mover">
                    <input type="hidden" name="sala_destino" value="<?php echo $sala; ?>">
                    <button type="submit" class="nav-btn">📍 <?php echo $habitaciones[$sala]['nombre']; ?></button>
                </form>
            <?php endforeach; ?>
        </div>

        <div class="gta-codes">
            <h3>🔐 CÓDIGOS DE SEGURIDAD (3 LETRAS):</h3>
            
            <?php if (in_array($habitacion_actual, [0, 1, 2, 3]) && !in_array('C1', $candados_resueltos)): ?>
                <form action="procesar.php" method="post">
                    <input type="hidden" name="accion" value="candado">
                    <input type="hidden" name="candado_id" value="C1">
                    <label>Código Vehículo (C1): </label>
                    <input type="text" name="codigo" maxlength="3" placeholder="ABC" pattern="[A-Za-z]{3}" required>
                    <button type="submit" class="code-btn">PROBAR CÓDIGO</button>
                </form>
            <?php endif; ?>

            <?php if (in_array('C1', $candados_resueltos) && !in_array('C2', $candados_resueltos)): ?>
                <form action="procesar.php" method="post">
                    <input type="hidden" name="accion" value="candado">
                    <input type="hidden" name="candado_id" value="C2">
                    <label>Código Casino (C2): </label>
                    <input type="text" name="codigo" maxlength="3" placeholder="ABC" pattern="[A-Za-z]{3}" required>
                    <button type="submit" class="code-btn">PROBAR CÓDIGO</button>
                </form>
            <?php endif; ?>

            <?php if (in_array('C2', $candados_resueltos) && !in_array('C3', $candados_resueltos)): ?>
                <form action="procesar.php" method="post">
                    <input type="hidden" name="accion" value="candado">
                    <input type="hidden" name="candado_id" value="C3">
                    <label>Código Aeropuerto (C3): </label>
                    <input type="text" name="codigo" maxlength="3" placeholder="ABC" pattern="[A-Za-z]{3}" required>
                    <button type="submit" class="code-btn">PROBAR CÓDIGO</button>
                </form>
            <?php endif; ?>

            <?php if ($habitacion_actual == 4 && !in_array('C4', $candados_resueltos)): ?>
                <form action="procesar.php" method="post">
                    <input type="hidden" name="accion" value="candado">
                    <input type="hidden" name="candado_id" value="C4">
                    <label>Código Base (C4): </label>
                    <input type="text" name="codigo" maxlength="3" placeholder="ABC" pattern="[A-Za-z]{3}" required>
                    <button type="submit" class="code-btn">PROBAR CÓDIGO</button>
                </form>
            <?php endif; ?>

            <?php if ($habitacion_actual == 5 && !in_array('C5', $candados_resueltos)): ?>
                <form action="procesar.php" method="post">
                    <input type="hidden" name="accion" value="candado">
                    <input type="hidden" name="candado_id" value="C5">
                    <label>Código Final (C5) - Intentos: <?php echo $_SESSION['intentos_c5']; ?>/3: </label>
                    <input type="text" name="codigo" maxlength="3" placeholder="ABC" pattern="[A-Za-z]{3}" required>
                    <button type="submit" class="code-btn">PROBAR CÓDIGO</button>
                </form>
            <?php endif; ?>

            <?php if (empty($candados_resueltos) && !in_array($habitacion_actual, [0, 1, 2, 3])): ?>
                <p class="no-codes">No hay códigos disponibles aquí.</p>
            <?php endif; ?>
        </div>

        <?php if ($habitacion_actual == 6): ?>
    <div class="audio-container">
        <audio autoplay loop controls class="gta-audio">
            <source src="sounds/GTA 5 Mission Passed sound effect.mp3" type="audio/mpeg">
            <source src="sounds/GTA 5 Mission Passed sound effect.ogg" type="audio/ogg">
            Tu navegador no soporta audio HTML5.
        </audio>
    </div>
    
    <div class="mission-passed">
        <h2>MISIÓN SUPERADA! 🏆</h2>
        <p>+$10,000,000</p>
        <div class="reward">💰 RECOMPENSA COMPLETADA 💰</div>
        <p class="completion-message">¡Lograste escapar de Los Santos! Eres una leyenda.</p>
        <p class="audio-note">🎵 Sonido de victoria reproduciéndose</p>
    </div>
<?php endif; ?>

        <div class="gta-restart">
            <form action="reiniciar.php" method="post">
                <button type="submit" class="restart-btn">🔄 REINICIAR MISIÓN</button>
            </form>
        </div>

        <?php if (!empty($candados_resueltos)): ?>
            <div class="codes-completed">
                <h4>🔓 CÓDIGOS DESCIFRADOS:</h4>
                <?php foreach ($candados_resueltos as $candado): ?>
                    <span class="completed-code"><?php echo $candado; ?></span>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>