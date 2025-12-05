<?php
require_once "../../db/conection.php";

$db = new Database();
$conn = $db->conectar();


$sql = $conn->prepare("SELECT documento, nombre, usuario 
                       FROM usuarios 
                       WHERE rol_id = 2 
                       ORDER BY nombre ASC");
$sql->execute();
$usuarios = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Retirar</title>
    <link rel="stylesheet" href="../../css/estilos.css">
</head>

<body>
    <div class="container">
        <h2>Retirar dinero</h2>

        <form action="procesar_retirar.php" method="POST">

            <label>Seleccione el usuario:</label>
            <select name="documento" required>
                <option value="">-- Selecciona un usuario --</option>
                <?php foreach ($usuarios as $u): ?>
                    <option value="<?= $u['documento'] ?>">
                        <?= $u['nombre'] . " (" . $u['usuario'] . ")" ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Monto:</label>
            <input type="number" name="monto" required>

            <button type="submit">Retirar</button>

            <br><br>
            <div class="a">
                <a href="indexx.php">Volver</a>
            </div>

        </form>
    </div>

</body>

</html>
