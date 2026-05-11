<?php
include 'conexion.php';

if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $sql = "DELETE FROM cursos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

$resultado = $conn->query("SELECT * FROM cursos");
?>

<h2 class="section-title">VER CURSOS</h2>
<hr class="section-divider">
<div class="center-text">
    <a href="dashboard.php?vista=cursos" class="btn-dark"><< REGRESAR</a>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Curso</th>
            <th>Docente</th>
            <th>Horas</th>
            <th>Horario</th>
            <th>Días</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $resultado->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nombre_curso']; ?></td>
            <td><?php echo $row['nombre_docente']; ?></td>
            <td><?php echo $row['numero_horas']; ?></td>
            <td><?php echo $row['horario']; ?></td>
            <td><?php echo $row['dias_curso']; ?></td>
            <td><a href="dashboard.php?vista=ver_cursos&eliminar=<?php echo $row['id']; ?>" onclick="return confirm('¿Eliminar curso?')" style="color:red;">Eliminar</a></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>