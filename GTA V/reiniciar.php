<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Misión Reiniciada</title>
</head>
<body>
    <video style="width: 100%;" src="video/gtav_1.mp4" autoplay muted loop></video>
    <script>
        setTimeout(() => {
            window.location.href = 'index.php';
        }, 10000);
    </script>

</body>
</html>
