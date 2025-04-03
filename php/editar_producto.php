<?php
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = mysqli_real_escape_string($conn, $_POST['id_producto']);
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre_producto']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    $precio = mysqli_real_escape_string($conn, $_POST['precio']);

    $query = "UPDATE productos SET nombre_producto='$nombre', descripcion='$descripcion', precio='$precio' WHERE id_producto='$id'";

    if (mysqli_query($conn, $query)) {
        echo "Producto actualizado correctamente";
    } else {
        echo "Error al actualizar el producto: " . mysqli_error($conn);
    }
}
?>
