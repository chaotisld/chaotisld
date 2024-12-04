<?php
// Configuración de conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$dbname = "sistemaing";

// Crear conexión a la base de datos
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $conn->real_escape_string($_POST['usuario']);
    $password = $conn->real_escape_string($_POST['contapass']);

    // Consulta SQL
    $sql = "SELECT * FROM usuario_alumno WHERE usuario = '$usuario' AND contapass = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Usuario autenticado: redirigir al menú
        header("Location: menuAlumno.php");
        exit();
    } else {
        echo "<script>
                alert('Usuario, contraseña o código incorrectos.');
                window.location.href = 'indexAlumno.php';
              </script>";
    }
}

// Cerrar conexión
$conn->close();
?>
