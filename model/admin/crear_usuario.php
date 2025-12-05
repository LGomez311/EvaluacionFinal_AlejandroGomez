<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Usuario</title>
    <link rel="stylesheet" href="../../css/estilos.css">
</head>

<body>
    <div class="container">
        <h2>Crear nuevo usuario</h2>

        <form action="procesar_crear_usuario.php" method="POST">
            <label>Nombre:</label>
            <input type="text" name="nombre" required>

            <label>Documento:</label>
            <input type="number" name="documento" required>

            <button type="submit">Crear usuario</button>
        </form>
        <br>
        <div class="a">
            <?php echo "<a href='indexx.php'>Volver</a>"; ?>
        </div>
    </div>



</body>

</html>