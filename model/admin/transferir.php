<?php
require_once "../../db/conection.php";

$db = new Database();
$conn = $db->conectar();


$sql = $conn->prepare("SELECT documento, nombre, usuario FROM usuarios WHERE rol_id=2  ORDER BY nombre ASC");
$sql->execute();
$usuarios = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

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

         
            <label>Seleccione quien envía:</label>
            <select name="documento_envia" required>
                <option value="">-- Selecciona un usuario --</option>
                <?php foreach ($usuarios as $u): ?>
                    <option value="<?= $u['documento'] ?>">
                        <?= $u['nombre'] . " (" . $u['usuario'] . ")" ?>
                    </option>
                <?php endforeach; ?>
            </select>

           
            <label>Seleccione quien recibe:</label>
            <select name="documento_recibe" required>
                <option value="">-- Selecciona un usuario --</option>
                <?php foreach ($usuarios as $u): ?>
                    <option value="<?= $u['documento'] ?>">
                        <?= $u['nombre'] . " (" . $u['usuario'] . ")" ?>
                    </option>
                <?php endforeach; ?>
            </select>

            
            <label>Monto a transferir:</label>
            <input type="number" name="monto" required min="100">

            <button type="submit">Realizar transferencia</button>

            <br><br>
            <div class="a">
                <a href="indexx.php">Volver</a>
            </div>

        </form>
    </div>

</body>

</html>
