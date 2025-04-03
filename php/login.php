<?php
session_start();
include 'conexion.php'; // Conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        echo "<script>alert('Por favor, completa todos los campos.'); window.location='login.php';</script>";
        exit();
    }

    // Preparar consulta segura
    $stmt = $conn->prepare("SELECT id_cliente, nombre, password FROM clientes WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if ($password === $user['password']) { // Comparación sin hash
            $_SESSION['id_cliente'] = $user['id_cliente'];
            $_SESSION['nombre'] = $user['nombre'];
            $_SESSION['email'] = $email;

            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Contraseña incorrecta.'); window.location='../login.html';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Correo electrónico no registrado.'); window.location='../login.html';</script>";
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
