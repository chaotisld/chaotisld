<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "sistemaing"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

//entidadPagos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_alumno = $_POST['id_alumno'];
    $nombre = $_POST['nombre_alumno'];
    $fecha_pago = $_POST['fecha_pago'];
    $paquete_o_clase = $_POST['paquete_o_clase'];
    $banco = $_POST['banco'];
    $folio = $_POST['folio'];
    
    $comprobante_pago = $_FILES['comprobante_pago']['name'];
    $comprobante_tmp = $_FILES['comprobante_pago']['tmp_name'];
    $comprobante_dir = "uploads/" . basename($comprobante_pago);

    if (!move_uploaded_file($comprobante_tmp, $comprobante_dir)) {
        echo "Error al cargar el archivo de comprobante.";
    } else {
        $sql = "INSERT INTO pagos (id_alumno, nombre_alumno, fecha_pago, paquete_o_clase, banco, folio, comprobante_pago) 
                VALUES ('$id_alumno','$nombre','$fecha_pago', '$paquete_o_clase', '$banco', '$folio', '$comprobante_dir')";

        if ($conn->query($sql) === TRUE) {
            echo '<script> alert("Pago registrado correctamente"); window.location.href="registrarPagosAlumno.php"; </script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
