<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "sistemaing"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM pagos";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Pagos</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:300);

        .login-page {
            width: 360px;
            padding: 8% 0 0;
            margin: auto;
        }

        .form {
            position: relative;
            z-index: 1;
            background: rgb(141, 194, 111);
            max-width: 700px;
            margin: 0 auto 100px;
            padding: 45px;
            text-align: center;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }

        .form input {
            font-family: "Roboto", sans-serif;
            outline: 0;
            background: #f2f2f2;
            width: 100%;
            border: 0;
            margin: 0 0 15px;
            padding: 15px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .form button {
            font-family: "Roboto", sans-serif;
            text-transform: uppercase;
            outline: 0;
            background: #ffffff;
            width: 100%;
            border: 0;
            padding: 15px;
            color: #000000;
            font-size: 14px;
            -webkit-transition: all 0.3 ease;
            transition: all 0.3 ease;
            cursor: pointer;
        }

        .form button:hover, .form button:active, .form button:focus {
            background: #74b577;
        }

        .additional-inputs,
        .additional-salud {
            display: none;
            margin-top: 15px;
        }

        input[type="radio"] {
            margin: 0 5px 0 0;
            cursor: pointer;
        }

        .disciplinas-container {
            text-align: left;
            margin-top: 15px;
        }

        .disciplinas-container p {
            margin: 10px 0;
        }

        .table-container {
            margin: 20px auto;
            max-width: 800px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 16px;
            background-color: #fff;
            text-align: left;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        table th, table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
        }

        table th {
            background-color: rgb(141, 194, 111);
            color: #fff;
            text-transform: uppercase;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f3f3f3;
        }

        table tr:hover {
            background-color: #d1e7d0;
        }

        .nav-container {
            text-align: center;
            margin-top: 20px;
        }

        .nav-container a {
            color: #74b577;
            font-size: 16px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <header>
        <div class="header">
            <h3>S I S T E M A</h3>
        </div>
    </header>
    <br><br>

    <div class="form">
        <h3>Lista de Pagos Registrados</h3> <br> <br>

        <?php
        if ($result->num_rows > 0) {
            echo "<div class='table-container'>";
            echo "<table>";
            echo "<tr><th>Id Alumno</th><th>Nombre del alumno</th><th>Fecha de Pago</th><th>Paquete/Clase</th><th>Banco</th><th>Folio</th><th>Comprobante</th></tr>";

            while($row = $result->fetch_assoc()) {
                $paquete_o_clase = ($row['paquete_o_clase'] == 1) ? 'Paquete' : 'Clase';
                echo "<tr>
                        <td>" . $row['id_alumno'] . "</td>
                        <td>" . $row['nombre_alumno'] . "</td>
                        <td>" . $row['fecha_pago'] . "</td>
                        <td>" . $paquete_o_clase . "</td>
                        <td>" . $row['banco'] . "</td>
                        <td>" . $row['folio'] . "</td>
                        <td><a href='" . $row['comprobante_pago'] . "' target='_blank'>Ver Comprobante</a></td>
                    </tr>";
            }

            echo "</table>";
            echo "</div>";
        } else {
            echo "No hay pagos registrados.";
        }

        $conn->close();
        ?>
    </div>

    <div class="nav-container">
        <a href="menuADM.php"><h4>Salir</h4></a>
    </div>
</body>
</html>
