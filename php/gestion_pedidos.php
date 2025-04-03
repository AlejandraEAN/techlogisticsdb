<?php
session_start();
include 'conexion.php'; // Conexión a la base de datos

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_cliente'])) {
    header("Location: login.php");
    exit();
}

// Listar pedidos
$query = "SELECT * FROM pedidos";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/estilos_menu.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
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
    <div class="container mt-4">
        <h2 class="text-center">Gestión de Pedidos</h2>
        <div class="text-end mb-3">
            <a href="agregar_pedido.php" class="btn btn-success">➕ Agregar Pedido</a>
        </div>
        <table class="table table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id_pedido']; ?></td>
                        <td><?php echo $row['id_cliente']; ?></td>
                        <td><?php echo $row['fecha_pedido']; ?></td>
                        <td><?php echo $row['estado']; ?></td>
                        <td>
                            <a href="editar_pedido.php?id=<?php echo $row['id_pedido']; ?>" class="btn btn-warning btn-sm">✏️ Editar</a>
                            <a href="eliminar_pedido.php?id=<?php echo $row['id_pedido']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este pedido?');">🗑️ Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <footer class="footer bg-primary text-white text-center py-3 mt-4">
        <p>&copy; 2025 TechLogistics S.A. - Todos los derechos reservados</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>