<?php
$salas = [
    0 => "Sala Inicio - Pista C1: Primer número es 1",
    1 => "Sala 1 - Pista C1: Segundo número es 2", 
    2 => "Sala 2 - Pista C1: Tercer número es 3",
    3 => "Sala 3 - Pista C2: Primer número es 4",
    4 => "Sala 4 - Pista C2: Segundo número es 5",
    5 => "Sala 5 - Pista C2: Tercer número es 6",
    6 => "Sala Final - ¡Felicidades!"
];

foreach ($salas as $numero => $texto) {
    $imagen = imagecreate(400, 300);
    $fondo = imagecolorallocate($imagen, 0, 0, 0);
    $textoColor = imagecolorallocate($imagen, 255, 0, 0);
    
    imagestring($imagen, 5, 50, 150, $texto, $textoColor);
    imagejpeg($imagen, "sala{$numero}.jpg");
    imagedestroy($imagen);
}
echo "Imágenes creadas!";
?>