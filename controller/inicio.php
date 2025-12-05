<?php
session_start();
require_once("../db/conection.php");

$db = new Database();
$con = $db->conectar();


if (isset($_POST["inicio"])) {

    $usuario = $_POST["usuario"];
    $clave = $_POST["clave"];

    $sql = $con->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $sql->execute([$usuario]);
    $fila = $sql->fetch(PDO::FETCH_ASSOC);


    if ($fila && password_verify($clave, $fila['password'])) {

 
        $_SESSION['doc_user'] = $fila['documento'];
        $_SESSION['tipo'] = $fila['rol_id'];
        $_SESSION['usuario'] = $fila['usuario'];

     
        if ($_SESSION['tipo'] == 1) {
            header("Location: ../model/admin/indexx.php");
            exit();
        } elseif ($_SESSION['tipo'] == 2) {
            header("Location: ../model/user/index.php");
            exit();
        }

    } else {
        echo '<script>alert("Usuario o contraseña incorrectos"); window.location="../login.php";</script>';
        exit();
    }
}


header("Location: ../login.php");
exit();
?>
