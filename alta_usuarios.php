<?php
include 'conexion.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['guardar_usuario'])) {
    $user = $_POST['usuario'];
    $pass = $_POST['contrasena'];
    $tipo = $_POST['tipo_usuario'];

    $sql = "INSERT INTO users (usuario, contrasena, tipo_usuario) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    $stmt->bind_param("sss", $user, $pass, $tipo);

    if ($stmt->execute()) {
        $mensaje = "<div style='color: green; text-align: center; margin-bottom: 15px;'>Usuario registrado exitosamente.</div>";
    } else {
        $mensaje = "<div style='color: red; text-align: center; margin-bottom: 15px;'>Error al registrar: " . $conn->error . "</div>";
    }

    $stmt->close();
}
?>

<h2 class="section-title">ALTA USUARIOS</h2>
<hr class="section-divider">
<div class="center-text">
    <a href="dashboard.php?vista=usuarios" class="btn-dark"><< REGRESAR</a>
</div>

<?php echo $mensaje; ?>

<div class="form-wrapper">
    <form action="dashboard.php?vista=alta_usuarios" method="POST">
        <div class="input-group">
            <input type="text" name="usuario" placeholder="Nombre de usuario" required>
        </div>
        <div class="input-group">
            <input type="password" name="contrasena" placeholder="Contraseña" required>
        </div>
        <div class="input-group">
            <select name="tipo_usuario" required>
                <option value="admin">Administrador</option>
                <option value="user">Usuario</option>
            </select>
        </div>
        <button type="submit" name="guardar_usuario" class="btn-maroon">Guardar Usuario</button>
    </form>
</div>