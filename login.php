<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Administrador</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<div class="container">
    <h2>Login Administrador</h2>

    <form action="procesar_login_admin.php" method="POST">

        <label>Documento:</label>
        <input type="number" name="doc" required>

        <label>Usuario:</label>
        <input type="text" name="usuario" required>

        <label>Contraseña:</label>
        <input type="password" name="password" required>

        <button type="submit">Ingresar</button>
    </form>

    <br>
    <a href="registro_admin.php">Registrar nuevo administrador</a>
</div>

</body>
</html>
