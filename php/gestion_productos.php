<?php
session_start();
include 'conexion.php'; // Conexión a la base de datos

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_cliente'])) {
    header("Location: login.php");
    exit();
}

// Listar productos
$query = "SELECT * FROM productos";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/estilos_menu.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

    <div class="container mt-4">
        <h2 class="text-center">Gestión de Productos</h2>
        <div class="text-center">
            <img src="../img/gestion.png" alt="Gestión de Productos" class="img-fluid mb-4 rounded" style="max-width: 150px;">
        </div>
        <table class="table table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id_producto']; ?></td>
                        <td><?php echo $row['nombre_producto']; ?></td>
                        <td><?php echo $row['descripcion']; ?></td>
                        <td><?php echo "$" . number_format($row['precio'], 0); ?></td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editarProductoModal" 
                               data-id="<?php echo $row['id_producto']; ?>" data-nombre="<?php echo $row['nombre_producto']; ?>" 
                               data-descripcion="<?php echo $row['descripcion']; ?>" data-precio="<?php echo $row['precio']; ?>">
                               ✏️ Editar</a>
                            <a href="eliminar_producto.php?id=<?php echo $row['id_producto']; ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('¿Estás seguro de eliminar este producto?');">🗑️ Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="5" class="text-center">
                        <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregarProductoModal">➕ Agregar Producto</a>
                    </td>
                </tr>
            </tbody>
        </table>

    <div class="modal fade" id="agregarProductoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarProducto">
                        <div class="mb-3">
                            <label class="form-label">Nombre del Producto</label>
                            <input type="text" class="form-control" name="nombre_producto" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <input type="text" class="form-control" name="descripcion" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Precio</label>
                            <input type="number" class="form-control" name="precio" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editarProductoModal" tabindex="-1" aria-labelledby="editarProductoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditarProducto">
                        <input type="hidden" name="id_producto" id="edit_id_producto">
                        <div class="mb-3">
                            <label class="form-label">Nombre del Producto</label>
                            <input type="text" class="form-control" name="nombre_producto" id="edit_nombre_producto" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <input type="text" class="form-control" name="descripcion" id="edit_descripcion" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Precio</label>
                            <input type="number" class="form-control" name="precio" id="edit_precio" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#formAgregarProducto').submit(function(e){
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'agregar_producto.php',
                    data: $(this).serialize(),
                    success: function(response){
                        alert(response);
                        location.reload();
                    }
                });
            });

            $('#editarProductoModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var nombre = button.data('nombre');
                var descripcion = button.data('descripcion');
                var precio = button.data('precio');
                $('#edit_id_producto').val(id);
                $('#edit_nombre_producto').val(nombre);
                $('#edit_descripcion').val(descripcion);
                $('#edit_precio').val(precio);
            });

            $('#formEditarProducto').submit(function(e){
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'editar_producto.php',
                    data: $(this).serialize(),
                    success: function(response){
                        alert(response);
                        location.reload();
                    }
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 <footer class="bg-primary text-white text-center py-3 mt-4">
        <p>&copy; 2025 TechLogistics S.A. - Todos los derechos reservados</p>
    </footer>   
</body>
</html>


