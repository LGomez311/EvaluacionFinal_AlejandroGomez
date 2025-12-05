<?php
require_once "../../db/conection.php";

$db = new Database();
$conn = $db->conectar();

$documento_envia = $_POST['documento_envia'];
$documento_recibe = $_POST['documento_recibe'];
$monto = $_POST['monto'];


$sql = "SELECT saldo FROM usuarios WHERE documento = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$documento_envia]);
$remitente = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$remitente) {
    echo "<h2>Error: El usuario remitente no existe.</h2>";
    echo "<a href='transferir.php'>Volver</a>";
    exit;
}


$sql2 = "SELECT saldo FROM usuarios WHERE documento = ?";
$stmt2 = $conn->prepare($sql2);
$stmt2->execute([$documento_recibe]);
$receptor = $stmt2->fetch(PDO::FETCH_ASSOC);

if (!$receptor) {
    echo "<h2>Error: El usuario receptor no existe.</h2>";
    echo "<a href='transferir.php'>Volver</a>";
    exit;
}


if ($remitente['saldo'] < $monto) {
    echo "<h2>Error: El usuario remitente no tiene saldo suficiente.</h2>";
    echo "<a href='transferir.php'>Volver</a>";
    exit;
}


$conn->beginTransaction();

try {

    $sql3 = "UPDATE usuarios SET saldo = saldo - ? WHERE documento = ?";
    $stmt3 = $conn->prepare($sql3);
    $stmt3->execute([$monto, $documento_envia]);

    $sql4 = "UPDATE usuarios SET saldo = saldo + ? WHERE documento = ?";
    $stmt4 = $conn->prepare($sql4);
    $stmt4->execute([$monto, $documento_recibe]);


    $sql5 = "INSERT INTO transacciones(documento, tipo, monto) 
             VALUES (?, 'Transferencia enviada', ?)";
    $stmt5 = $conn->prepare($sql5);
    $stmt5->execute([$documento_envia, $monto]);


    $sql6 = "INSERT INTO transacciones(documento, tipo, monto) 
             VALUES (?, 'Transferencia recibida', ?)";
    $stmt6 = $conn->prepare($sql6);
    $stmt6->execute([$documento_recibe, $monto]);

    $conn->commit();

    echo "<h2>Transferencia realizada exitosamente</h2>";
    echo "<a href='indexx.php'>Volver</a>";
} catch (Exception $e) {
    $conn->rollBack();
    echo "<h2>Error en la transferencia: " . $e->getMessage() . "</h2>";
    echo "<a href='transferir.php'>Volver</a>";
}
