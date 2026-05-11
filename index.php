<?php
session_start();
include 'conexion.php';
/*EDUARDO JOSUE FONSECA TORRES 7SA */
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT id, usuario, tipo_usuario FROM users WHERE usuario = ? AND contrasena = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        
        $_SESSION['usuario_id'] = $fila['id'];
        $_SESSION['nombre_usuario'] = $fila['usuario'];
        $_SESSION['tipo_usuario'] = $fila['tipo_usuario'];
        
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header id="main-header">ESCUELA DE CURSOS DE CAPACITACION</header>

    <div id="login-screen">
        <h2>Acceso Panel Administrativo</h2>
        
        <?php if($error != "") { ?>
            <div style="color: red; margin-bottom: 15px; font-weight: bold;">
                <?php echo $error; ?>
            </div>
        <?php } ?>

        <form action="index.php" method="POST">
            <div class="input-group">
                <input type="text" name="username" placeholder="Usuario" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Contraseña" required>
            </div>
            <button type="submit" class="btn-maroon">Login</button>
        </form>
    </div>
</body>
</html>
