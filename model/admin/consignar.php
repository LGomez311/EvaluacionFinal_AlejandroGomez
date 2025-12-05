<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Consignar</title>
    <link rel="stylesheet" href="../../css/estilos.css">
</head>

<body>
    <div class="container">
        <h2>Consignar dinero a un usuario</h2>

        <form action="procesar_consignar.php" method="POST">
            <label>Documento del usuario receptor:</label>
            <input type="number" name="documento_receptor" required>

            <label>Monto a consignar:</label>
            <input type="number" name="monto" required>

            <button type="submit">Consignar</button>
            <br><br>
            <div class="a">
                <?php echo "<a href='indexx.php'>Volver</a>"; ?>
            </div>
    </div>
    </form>

</body>

</html>