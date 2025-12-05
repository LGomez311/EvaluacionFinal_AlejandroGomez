<?php
require_once "../../db/conection.php";

$db = new Database();
$conn = $db->conectar();

$documento = $_POST['documento'];
$monto = $_POST['monto'];


$sql = "SELECT saldo FROM usuarios WHERE documento = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$documento]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($usuario['saldo'] >= $monto) {


    $sql2 = "UPDATE usuarios SET saldo = saldo - ? WHERE documento = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute([$monto, $documento]);


    $sql3 = "INSERT INTO transacciones(documento, tipo, monto) VALUES (?, 'Retiro', ?)";
    $stmt3 = $conn->prepare($sql3);
    $stmt3->execute([$documento, $monto]);

    echo "<h2>Retiro exitoso</h2>";
} else {
    echo "<h2>Error: saldo insuficiente</h2>";
}

echo "<a href='indexx.php'>Volver</a>";
