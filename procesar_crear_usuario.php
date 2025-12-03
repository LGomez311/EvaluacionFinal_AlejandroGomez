<?php
require_once "db/conection.php";

$db = new Database();
$conn = $db->conectar();

$nombre = $_POST['nombre'];
$documento = $_POST['documento'];

$sql = "INSERT INTO usuarios(nombre, documento, saldo) VALUES(?, ?, 0)";
$stmt = $conn->prepare($sql);
$stmt->execute([$nombre, $documento]);

echo "<h2>Usuario creado correctamente</h2>";
echo "<a href='indexx.php'>Volver</a>";
