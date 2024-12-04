<?php
$servername = "localhost"; 
$username = "root";       
$password = "";            
$dbname = "sistemaing"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

//entidadGuardarComentarios
$id = $_POST['ID'];
$nombre = $_POST['Nombre'];
$disciplina = $_POST['Disciplina'];
$correo = $_POST['Correo'];
$comentarios = $_POST['Comentarios'];

$sql_check = "SELECT * FROM Comentarios WHERE ID = '$id' LIMIT 1";
$result = $conn->query($sql_check);

if ($result->num_rows > 0) {
    $sql = "INSERT INTO Comentarios (ID, Nombre, Disciplina, Correo, Comentario)
            VALUES ('$id', '$nombre', '$disciplina', '$correo', '$comentarios')";
} else {
    $sql = "INSERT INTO Comentarios (ID, Nombre, Disciplina, Correo, Comentario)
            VALUES ('$id', '$nombre', '$disciplina', '$correo', '$comentarios')";
}

if ($conn->query($sql) === TRUE) {
    echo '<script> alert("Comentarios guardados correctamente"); window.location.href="registrarAvanceProfesor.php"; </script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
