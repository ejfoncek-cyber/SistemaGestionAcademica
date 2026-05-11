<?php
include 'conexion.php';
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['guardar_curso'])) {
    $nombre_curso = $_POST['nombre_curso'];
    $nombre_docente = $_POST['nombre_docente'];
    $numero_horas = $_POST['numero_horas'];
    $horario = $_POST['horario'];
    $dias_curso = $_POST['dias_curso'];
    $objetivo = $_POST['objetivo'];

    $sql = "INSERT INTO cursos (nombre_curso, nombre_docente, numero_horas, horario, dias_curso, objetivo) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $nombre_curso, $nombre_docente, $numero_horas, $horario, $dias_curso, $objetivo);

    if ($stmt->execute()) {
        $mensaje = "<div style='color: green; text-align: center; margin-bottom: 15px;'>Curso guardado exitosamente.</div>";
    } else {
        $mensaje = "<div style='color: red; text-align: center; margin-bottom: 15px;'>Error: " . $conn->error . "</div>";
    }
    $stmt->close();
}
?>

<h2 class="section-title">ALTA CURSOS</h2>
<hr class="section-divider">
<div class="center-text">
    <a href="dashboard.php?vista=cursos" class="btn-dark"><< REGRESAR</a>
</div>

<?php echo $mensaje; ?>

<div class="form-wrapper">
    <form action="dashboard.php?vista=alta_cursos" method="POST">
        <div class="input-group">
            <input type="text" name="nombre_curso" placeholder="Nombre del curso" required>
        </div>
        <div class="input-group">
            <input type="text" name="nombre_docente" placeholder="Nombre del docente" required>
        </div>
        <div class="input-group">
            <select name="numero_horas" required>
                <option value="" disabled selected>Numero de horas del curso</option>
                <option value="20">20 horas</option>
                <option value="40">40 horas</option>
                <option value="60">60 horas</option>
            </select>
        </div>
        <div class="input-group">
            <select name="horario" required>
                <option value="" disabled selected>Horario del curso</option>
                <option value="08:00 - 10:00">08:00 - 10:00</option>
                <option value="10:00 - 12:00">10:00 - 12:00</option>
                <option value="16:00 - 18:00">16:00 - 18:00</option>
            </select>
        </div>
        <div style="background-color: #d9dce1; padding: 10px; text-align: center; font-weight: bold; margin-bottom: 15px;">Dias del curso</div>
        <div style="text-align: center; margin-bottom: 20px;">
            <input type="radio" name="dias_curso" value="Lunes, Miércoles y Viernes" required> Lunes, Miércoles y Viernes
            <input type="radio" name="dias_curso" value="Martes, Jueves y Sabado" required> Martes, Jueves y Sabado
            <input type="radio" name="dias_curso" value="Solo Sabados" required> Solo Sabados
        </div>
        <div class="input-group">
            <textarea name="objetivo" placeholder="Objetivo del curso" required style="width: 100%; min-height: 80px;"></textarea>
        </div>
        <button type="submit" name="guardar_curso" class="btn-maroon">Guardar Curso</button>
    </form>
</div>