<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Transferir dinero</title>
    <link rel="stylesheet" href="../../css/estilos.css">
</head>

<body>
    <div class="container">
        <h2>Transferencia entre usuarios</h2>

        <form action="procesar_transferencia.php" method="POST">

            <label>Documento del remitente (quien envía):</label>
            <input type="number" name="documento_envia" required>

            <label>Documento del receptor (quien recibe):</label>
            <input type="number" name="documento_recibe" required>

            <label>Monto a transferir:</label>
            <input type="number" name="monto" required>

            <button type="submit">Realizar transferencia</button>

            <br><br>
            <div class="a">
                <?php echo "<a href='indexx.php'>Volver</a>"; ?>
            </div>

        </form>
    </div>

</body>

</html>