<?php
session_start();
include 'conexion.php'; // Conexión a la base de datos

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_cliente'])) {
    header("Location: login.php");
    exit();
}

// Verificar si se recibió un ID válido
if (isset($_GET['id'])) {
    $id_producto = $_GET['id'];

    // Eliminar el producto de la base de datos
    $query = "DELETE FROM productos WHERE id_producto = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_producto);

    if ($stmt->execute()) {
        $_SESSION['mensaje'] = "Producto eliminado correctamente.";
    } else {
        $_SESSION['error'] = "Error al eliminar el producto.";
    }

    header("Location: gestion_productos.php");
    exit();
} else {
    $_SESSION['error'] = "ID de producto no válido.";
    header("Location: gestion_productos.php");
    exit();
}
?>
