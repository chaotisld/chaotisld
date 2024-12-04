<?php
// Requiere PHPMailer
require 'C:\wamp64\www\proyecto_ing\PHPMailer-master\src\PHPMailer.php';

// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_correos";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Seleccionar los correos no enviados
$sql = "SELECT * FROM correos WHERE enviado = FALSE";
$result = $conn->query($sql);

// Verificar si hay correos para enviar
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $remitente = $row['remitente'];
        $destinatario = $row['destinatario'];
        $asunto = $row['asunto'];
        $cuerpo = $row['cuerpo'];
        
        // Configuración de PHPMailer
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.dominio.com';  // Cambia esto por el servidor SMTP de tu proveedor de correo
        $mail->SMTPAuth = true;
        $mail->Username = 'chaomendez1704@gmail.com';  // Tu correo de envío
        $mail->Password = 'tu_contraseña';  // Tu contraseña
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Configura el remitente y el destinatario
        $mail->setFrom($remitente, 'Nombre Remitente');
        $mail->addAddress($destinatario);  // Correo del destinatario

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body    = $cuerpo;

        // Enviar el correo
        if ($mail->send()) {
            // Marcar el correo como enviado en la base de datos
            $update_sql = "UPDATE correos SET enviado = TRUE WHERE id = " . $row['id'];
            $conn->query($update_sql);
            echo "Correo enviado a: " . $destinatario . "<br>";
        } else {
            echo "Error al enviar el correo a " . $destinatario . ": " . $mail->ErrorInfo . "<br>";
        }
    }
} else {
    echo "No hay correos para enviar.";
}

$conn->close();
?>
