<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal - TechLogistics</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/estilos_menu.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">TechLogistics</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="gestion_pedidos.php">📦 Gestión de Pedidos</a></li>
                    <li class="nav-item"><a class="nav-link" href="gestion_productos.php">🛒 Gestión de Productos</a></li>
                    <li class="nav-item"><a class="nav-link" href="gestion_clientes.php">👥 Administración de Clientes</a></li>
                    <li class="nav-item"><a class="nav-link" href="gestion_transportistas.php">🚛 Gestión de Transportistas</a></li>
                    <li class="nav-item"><a class="nav-link" href="seguimiento_envios.php">📍 Seguimiento de Envíos</a></li>
                    <li class="nav-item"><a class="nav-link" href="reportes.php">📊 Reportes y Estadísticas</a></li>
                    <li class="nav-item"><a class="nav-link" href="configuracion.php">⚙️ Configuración</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="logout.php">🚪 Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4 text-center">
        <h1>Bienvenido al Sistema de Gestión de TechLogistics</h1>
        <img src="../img/gestionProductos.png" alt="TechLogistics Logo" class="img-fluid mt-3" style="max-width: 30%;height: auto;">
        <b><p>¿Qué acción deseas realizar hoy?</p></b>
    </div>

    <footer class="bg-primary text-white text-center py-3 mt-4">
        <p>&copy; 2025 TechLogistics S.A. - Todos los derechos reservados</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>