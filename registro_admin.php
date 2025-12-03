<?php
include("db/conection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $doc = $_POST['doc'];
    $usuario = $_POST['usuario'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);


    $db = new Database();
    $pdo = $db->conectar();

    $sql = "INSERT INTO admin (doc, usuario, password) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$doc, $usuario, $password]);

    echo "<script>alert('Administrador registrado correctamente'); window.location='login.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Admin</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<div class="container">
    <h2>Registrar Administrador</h2>

    <form method="POST">

        <label>Documento:</label>
        <input type="number" name="doc" required>

        <label>Usuario:</label>
        <input type="text" name="usuario" required>

        <label>Contraseña:</label>
        <input type="password" name="password" required>

        <button type="submit">Registrar</button>
    </form>

</div>

</body>
</html>
