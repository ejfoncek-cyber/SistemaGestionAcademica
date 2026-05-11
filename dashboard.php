<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrativo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header id="main-header">PANEL ADMINISTRATIVO - Bienvenido, <?php echo $_SESSION['nombre_usuario']; ?></header>

    <div id="dashboard-screen" class="clearfix">
        <div class="sidebar">
            <ul class="menu-list">
                <li><a href="dashboard.php?vista=inicio">>> Inicio</a></li>
                <li><a href="dashboard.php?vista=usuarios">>> Usuarios</a></li>
                <li><a href="dashboard.php?vista=cursos">>> Cursos</a></li>
            </ul>
            <div class="sidebar-action">
                <form action="logout.php" method="POST">
                    <button type="submit" class="btn-red">X Cerrar Sesión</button>
                </form>
            </div>
        </div>

        <div class="content-area">
            <?php
            $vista = isset($_GET['vista']) ? $_GET['vista'] : 'inicio';
            $archivo = $vista . '.php';

            if (file_exists($archivo)) {
                include $archivo;
            } else {
                include 'inicio.php';
            }
            ?>
        </div>
    </div>
</body>
</html>