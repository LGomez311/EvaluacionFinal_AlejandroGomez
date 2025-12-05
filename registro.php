<?php
session_start();
require_once("db/conection.php");

$db = new Database();
$con = $db->conectar();

if (isset($_POST["Validar"])) {

    $cedula  = $_POST['doc'];
    $nombre  = $_POST['names'];
    $usuario = $_POST['user'];
    $clave   = $_POST['pass'];
    $rol     = $_POST['rol'];

    $pass_cifrado = password_hash($clave, PASSWORD_DEFAULT);

    $sql = $con->prepare("SELECT * FROM usuarios WHERE documento = ? OR usuario = ?");
    $sql->execute([$cedula, $usuario]);
    $fila = $sql->fetchAll(PDO::FETCH_ASSOC);

    if ($fila) {
        echo '<script>alert("DOCUMENTO O USUARIO YA EXISTEN");</script>';
        echo '<script>window.location="registro.php"</script>';
        exit();
    }

    if (empty($cedula) || empty($nombre) || empty($usuario) || empty($clave) || empty($rol)) {
        echo '<script>alert("EXISTEN CAMPOS VACÍOS");</script>';
        echo '<script>window.location="registro.php"</script>';
        exit();
    }

    $insertSQL = $con->prepare("
        INSERT INTO usuarios (documento, nombre, usuario, password, saldo, rol_id)
        VALUES (?, ?, ?, ?, 0, ?)
    ");

    if ($insertSQL->execute([$cedula, $nombre, $usuario, $pass_cifrado, $rol])) {
        echo '<script>alert("REGISTRO EXITOSO");</script>';
        echo '<script>window.location="login.php"</script>';
    } else {
        echo '<script>alert("ERROR AL REGISTRAR USUARIO");</script>';
        echo '<script>window.location="registro.php"</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Registrarse</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>

    <div class="container">
        <h2>Crear Usuario</h2>

        <form method="POST">

            <label>Documento</label>
            <input type="number" name="doc">

            <label>Nombres</label>
            <input type="text" name="names">

            <label>Usuario</label>
            <input type="text" name="user">

            <label>Contraseña</label>
            <input type="password" name="pass">

            <label>Rol</label>
            <select class="select" name="rol">
                <option value="">Seleccione uno...</option>

                <?php
                $roles = $con->prepare("SELECT * FROM roles WHERE id = 2");
                $roles->execute();

                while ($tp = $roles->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . $tp['id'] . "'>" . $tp['nombre'] . "</option>";
                }
                ?>
            </select>

            <button type="submit" name="Validar">Registrar</button>

            <br><br>
            <div class="a">
                <?php echo "<a href='index.php'>Volver</a>"; ?>
            </div>

        </form>
    </div>

</body>
</html>
