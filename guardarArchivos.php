<?php

$host = 'localhost';
$usuario = 'root';   
$clave = '';        
$base_datos = 'sistemaing'; 

$conn = new mysqli($host, $usuario, $clave, $base_datos);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id']; 

    if (isset($_FILES['formato_firmado']) && $_FILES['formato_firmado']['error'] == 0) {
        $fileTmpPath = $_FILES['formato_firmado']['tmp_name'];
        $fileName = $_FILES['formato_firmado']['name'];
        $fileSize = $_FILES['formato_firmado']['size'];
        $fileType = $_FILES['formato_firmado']['type'];

        $fileContent = file_get_contents($fileTmpPath);

        $sql = "INSERT INTO archivos (id_usuario, nombre_archivo, tipo_archivo, archivo) VALUES (?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param('issb', $id, $fileName, $fileType, $fileContent);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "Error en la consulta: " . $conn->error;
        }
    }

    if (isset($_FILES['certificado_medico']) && $_FILES['certificado_medico']['error'] == 0) {
        $fileTmpPath = $_FILES['certificado_medico']['tmp_name'];
        $fileName = $_FILES['certificado_medico']['name'];
        $fileSize = $_FILES['certificado_medico']['size'];
        $fileType = $_FILES['certificado_medico']['type'];

        $fileContent = file_get_contents($fileTmpPath);

        $sql = "INSERT INTO archivos (id_usuario, nombre_archivo, tipo_archivo, archivo) VALUES (?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param('issb', $id, $fileName, $fileType, $fileContent);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "Error en la consulta: " . $conn->error;
        }
    }

    echo "Archivos subidos correctamente.";
}

$conn->close();
?>
