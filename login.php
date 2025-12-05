<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<div class="container">
    <h2>Iniciar Sesión</h2>


    <form action="controller/inicio.php" method="POST">

        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" required>

        <label for="clave">Contraseña:</label>
        <input type="password" name="clave" required>

        <button type="submit" name="inicio">Ingresar</button>
    </form>

    <br>


    <a href="registro.php">Registrarse</a>
</div>

</body>
</html>
