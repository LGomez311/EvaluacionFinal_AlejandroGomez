<?php
require_once "../../db/conection.php";

$db = new Database();
$conn = $db->conectar();

$sql = "SELECT * FROM transacciones ORDER BY fecha DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$movimientos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Historial transacciones</title>
    <link rel="stylesheet" href="../../css/estilos.css">
</head>

<body>
    <div class="container">
        <h2>Historial de transacciones</h2>

        <table border="1">
            <tr>
                <th>ID</th>
                <th>Documento</th>
                <th>Tipo</th>
                <th>Monto</th>
                <th>Fecha</th>
            </tr>

            <?php foreach ($movimientos as $m): ?>
                <tr>
                    <td><?= $m['id'] ?></td>
                    <td><?= $m['documento'] ?></td>
                    <td><?= $m['tipo'] ?></td>
                    <td>$<?= $m['monto'] ?></td>
                    <td><?= $m['fecha'] ?></td>
                </tr>
            <?php endforeach; ?>

        </table>

        <br><br>
        <div class="a">
            <?php echo "<a href='indexx.php'>Volver</a>"; ?>
        </div>
    </div>

</body>

</html>