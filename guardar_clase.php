<?php
$servername = "localhost"; 
$username = "root";        
$password = "";            
$dbname = "sistemaing";         

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

//entidadClase
$alumno_id = $_POST['ID']; 
$nombre_alumno = $_POST['Nombre']; 
$disciplina = $_POST['Disciplina']; 
$horario = $_POST['Horario']; 

$stmt = $conn->prepare("INSERT INTO clases (alumno_id, nombre_alumno, disciplina, horario) 
                        VALUES (?, ?, ?, ?)");

$stmt->bind_param("isss", $alumno_id, $nombre_alumno, $disciplina, $horario);

if ($stmt->execute()) {
    echo "Reserva de clase registrada correctamente.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
