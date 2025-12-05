<?php
session_start();
include("../../db/conection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $doc = $_POST['doc'];
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

  
    $db = new Database();
    $pdo = $db->conectar();

    
    $sql = "SELECT * FROM admin WHERE doc = ? AND usuario = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$doc, $usuario]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($password, $admin['password'])) {

   
        $_SESSION['admin_id'] = $admin['doc'];
        $_SESSION['admin_usuario'] = $admin['usuario'];

        header("Location: indexx.php");
        exit();
    } else {
        echo "<script>alert('Credenciales incorrectas'); window.location='login.php';</script>";
    }
}
?>
