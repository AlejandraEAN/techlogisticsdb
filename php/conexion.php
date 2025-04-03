<?php
$servername = "localhost"; 
$username = "root"; 
$password_db = ""; 
$dbname = "techlogisticsdb"; 

// Crear conexión
$conn = new mysqli($servername, $username, $password_db, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
