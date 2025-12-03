<?php
require_once "db/conection.php";

$db = new Database();
$conn = $db->conectar();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Consultar saldo</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <div class="container">
        <h2>Consultar saldo</h2>

        <form method="POST">
            <label>Documento:</label>
            <input type="number" name="documento" required>
            <button type="submit">Consultar</button>
            <br><br>
            <div class="a">
                <?php echo "<a href='indexx.php'>Volver</a>"; ?>
            </div>
        </form>
        </div>

        <?php
        if ($_POST) {
            $documento = $_POST['documento'];

            $sql = "SELECT nombre, saldo FROM usuarios WHERE documento = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$documento]);

            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                echo "<p><strong>Nombre:</strong> " . $data['nombre'] . "</p>";
                echo "<p><strong>Saldo:</strong> $" . $data['saldo'] . "</p>";
                echo "<a href='indexx.php'>Volver</a>";
            } else {
                echo "<p>No existe el usuario</p>";
            }
        }
        ?>

</body>

</html>