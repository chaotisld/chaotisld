<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "sistemaing";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

//Entidad profesor

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $conn->real_escape_string($_POST['Usuario']);
    $password = $conn->real_escape_string($_POST['pass']);

    $sql = "SELECT * FROM Profesor WHERE Usuario = '$usuario' AND pass = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        header("Location: menuProfesor.php");
        exit();
    } else {
        echo "<script>
                alert('Usuario, contraseña o código incorrectos.');
                window.location.href = 'indexProfesor.php';
              </script>";
    }
}

$conn->close();

?>