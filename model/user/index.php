<?php
session_start();
require_once("../../db/conection.php");

if (!isset($_SESSION['doc_user']) || $_SESSION['tipo'] != 2) {
    header("Location: ../../login.php");
    exit();
}

$db = new Database();
$con = $db->conectar();

$documento = $_SESSION['doc_user'];

$sql = $con->prepare("
    SELECT t.id, t.tipo, t.monto, t.fecha
    FROM transacciones t
    WHERE t.documento = ?
    ORDER BY t.fecha DESC
");
$sql->execute([$documento]);
$transacciones = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mis Transacciones</title>
    <link rel="stylesheet" href="../../css/estilos.css">

</head>

<body>

    <div class="container">
        
        <a href="../../controller/logout.php" class="btn-logout">Cerrar sesión</a>

        <h2>Mis Transacciones</h2>

        <table border="1">
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Monto</th>
                <th>Fecha</th>
            </tr>

            <?php if ($transacciones): ?>
                <?php foreach ($transacciones as $t): ?>
                    <tr>
                        <td><?php echo $t['id']; ?></td>
                        <td><?php echo ucfirst($t['tipo']); ?></td>
                        <td>$<?php echo number_format($t['monto'], 0, ',', '.'); ?></td>
                        <td><?php echo $t['fecha']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No tienes transacciones registradas.</td>
                </tr>
            <?php endif; ?>
        </table>

        
    </div>

</body>

</html>
