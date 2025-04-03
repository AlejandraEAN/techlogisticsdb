<?php
session_start();
include 'conexion.php'; // Conexión a la base de datos

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_cliente'])) {
    echo "Error: No has iniciado sesión.";
    exit();
}

// Verificar si los datos fueron enviados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = trim($_POST['nombre_producto']);
    $descripcion = trim($_POST['descripcion']);
    $precio = floatval($_POST['precio']);

    // Validar que los campos no estén vacíos
    if (empty($nombre) || empty($descripcion) || $precio <= 0) {
        echo "Error: Todos los campos son obligatorios.";
        exit();
    }

    // Preparar la consulta
    $stmt = $conn->prepare("INSERT INTO productos (nombre_producto, descripcion, precio) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $nombre, $descripcion, $precio);

    // Ejecutar y verificar el resultado
    if ($stmt->execute()) {
        echo "Producto agregado exitosamente.";
    } else {
        echo "Error al agregar el producto.";
    }

    // Cerrar la consulta y la conexión
    $stmt->close();
    $conn->close();
} else {
    echo "Acceso denegado.";
}
?>
