<?php
include 'conexion.php';

if (isset($_GET['eliminar'])) {
    $id_eliminar = $_GET['eliminar'];
    $sql_delete = "DELETE FROM users WHERE id = ?";
    $stmt_del = $conn->prepare($sql_delete);
    $stmt_del->bind_param("i", $id_eliminar);
    $stmt_del->execute();
    $stmt_del->close();
}

$sql = "SELECT id, usuario, contrasena, tipo_usuario FROM users";
$resultado = $conn->query($sql);
?>

<h2 class="section-title">VER USUARIOS</h2>
<hr class="section-divider">
<div class="center-text">
    <a href="dashboard.php?vista=usuarios" class="btn-dark"><< REGRESAR</a>
</div>

<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Usuario</th>
            <th>Contraseña</th>
            <th>Tipo de Usuario</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($resultado->num_rows > 0) {
            while($row = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["usuario"] . "</td>";
                echo "<td>" . $row["contrasena"] . "</td>";
                echo "<td>" . $row["tipo_usuario"] . "</td>";
                
                echo "<td><a href='dashboard.php?vista=ver_usuarios&eliminar=" . $row["id"] . "' onclick=\"return confirm('¿Estás seguro de que deseas eliminar al usuario " . $row["usuario"] . "?');\" style='color: red; text-decoration: none; font-weight: bold;'>Eliminar</a></td>";
                
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No hay usuarios registrados</td></tr>";
        }
        ?>
    </tbody>
</table>