<?php
require_once "../../db/conection.php";

$db = new Database();
$conn = $db->conectar();

$documento_receptor = $_POST['documento_receptor'];
$monto = $_POST['monto'];


$sql = "SELECT * FROM usuarios WHERE documento = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$documento_receptor]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "<h2>Error: El usuario receptor no existe.</h2>";
    echo "<a href='indexx.php'>Volver</a>";
    exit;
}


$sql2 = "UPDATE usuarios SET saldo = saldo + ? WHERE documento = ?";
$stmt2 = $conn->prepare($sql2);
$stmt2->execute([$monto, $documento_receptor]);


$sql3 = "INSERT INTO transacciones(documento, tipo, monto) VALUES (?, 'Consignación', ?)";
$stmt3 = $conn->prepare($sql3);
$stmt3->execute([$documento_receptor, $monto]);

echo "<h2>Consignación realizada correctamente</h2>";
echo "<a href='indexx.php'>Volver</a>";
