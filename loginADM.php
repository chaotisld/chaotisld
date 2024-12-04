<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "sistemaing";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

//EntidadADM
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $conn->real_escape_string($_POST['Usuario']);
    $password = $conn->real_escape_string($_POST['Contra']);
    $codigo = $conn->real_escape_string($_POST['Codigo']);

    $sql = "SELECT * FROM Administrador WHERE Usuario = '$usuario' AND Contra = '$password' AND Codigo = '$codigo'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        header("Location: menuADM.php");
        exit();
    } else {
        echo "<script>
                alert('Usuario, contraseña o código incorrectos.');
                window.location.href = 'indexADM.php';
              </script>";
    }
}

$conn->close();
?>
