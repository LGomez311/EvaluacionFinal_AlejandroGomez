<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Retirar</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <div class="container">
        <h2>Retirar dinero</h2>

        <form action="procesar_retirar.php" method="POST">
            <label>Documento usuario:</label>
            <input type="number" name="documento" required>

            <label>Monto:</label>
            <input type="number" name="monto" required>

            <button type="submit">Retirar</button>
            <br><br>
            <div class="a">
                <?php echo "<a href='indexx.php'>Volver</a>"; ?>
            </div>
    </div>
    </form>

</body>

</html>