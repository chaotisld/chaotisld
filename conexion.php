<?php
$host = "localhost";
$usuario = "root"; // Cambia según tu configuración
$clave = ""; // Cambia según tu configuración
$baseDatos = "sistemaing";

$conn = new mysqli($host, $usuario, $clave, $baseDatos);

// Verificar conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}
?>
