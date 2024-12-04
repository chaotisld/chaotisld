<?php
include("conexion.php");

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$sql = "
    SELECT 
        a.id, 
        a.nombre, 
        a.apellido_paterno, 
        a.apellido_materno, 
        a.edad, 
        a.domicilio, 
        a.telefono, 
        a.correo, 
        a.fecha_nacimiento, 
        a.lugar_nacimiento, 
        a.es_estudiante, 
        a.institucion, 
        a.carrera, 
        a.profesion, 
        a.lugar_profesion, 
        a.puesto, 
        a.grado_estudios, 
        a.tiene_problemas_salud, 
        a.problema_salud, 
        GROUP_CONCAT(DISTINCT dp.disciplina) AS disciplinas_practicadas,
        di.natacion, 
        di.basquetball, 
        di.futbol, 
        di.voleibol, 
        di.box, 
        di.tenis, 
        di.karate
    FROM Alumno a
    LEFT JOIN Disciplinas_practicadas dp ON a.id = dp.alumno_id
    LEFT JOIN Disciplinas_inscripcion di ON a.id = di.alumno_id
    GROUP BY a.id;
";

$result = $conn->query($sql);

if (!$result) {
    die("Error en la consulta: " . $conn->error);
}

function uploadFile($file, $target_dir) {
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'pdf'];
    $target_file = $target_dir . basename($file["name"]);
    $file_extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (in_array($file_extension, $allowed_extensions)) {
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            return false;
        }
    } else {
        return false;
    }
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Alumnos Registrados</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        /* Estilos generales */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #4CAF50;
            padding: 20px 0;
            text-align: center;
            color: white;
        }

        header h3 {
            margin: 0;
            font-size: 24px;
        }

        .form {
            margin: 20px auto;
            max-width: 1000px;
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form h3 {
            text-align: center;
            font-size: 20px;
            color: #333;
            margin-bottom: 20px;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
            margin-top: 20px;
        }

        table {
            width: auto;
            min-width: 100%;
            border-collapse: collapse;
            font-size: 16px;
            background-color: #fff;
            text-align: left;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #e8f5e1;
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

        .upload-btn {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            border: none;
            font-size: 14px;
            margin-top: 10px;
            text-align: center;
        }

        .upload-btn:hover {
            background-color: #45a049;
        }

        /* Estilo para input de tipo file */
        input[type="file"] {
            display: none; /* Ocultamos el input file original */
        }

        .upload-btn-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .upload-btn-wrapper button {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            margin: 0;
            font-size: 14px;
            cursor: pointer;
        }

        .form-file {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .file-col {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
    <header>
        <h3>S I S T E M A </h3>
    </header>

    <div class="form">
        <h3>Lista de Alumnos</h3>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Edad</th>
                        <th>Domicilio</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Lugar de Nacimiento</th>
                        <th>Es Estudiante</th>
                        <th>Institución</th>
                        <th>Carrera</th>
                        <th>Profesión</th>
                        <th>Lugar Profesión</th>
                        <th>Puesto</th>
                        <th>Grado de Estudios</th>
                        <th>Problemas de Salud</th>
                        <th>Detalles de Salud</th>
                        <th>Disciplinas Inscritas</th>
                        <th>Formato Firmado y Certificado médico</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $disciplinas_inscritas = [];
                            if ($row['natacion']) $disciplinas_inscritas[] = "Natación";
                            if ($row['basquetball']) $disciplinas_inscritas[] = "Basquetball";
                            if ($row['futbol']) $disciplinas_inscritas[] = "Futbol";
                            if ($row['voleibol']) $disciplinas_inscritas[] = "Voleibol";
                            if ($row['box']) $disciplinas_inscritas[] = "Box";
                            if ($row['tenis']) $disciplinas_inscritas[] = "Tenis";
                            if ($row['karate']) $disciplinas_inscritas[] = "Karate";
                            $disciplinas_inscritas_str = implode(", ", $disciplinas_inscritas) ?: "No inscrito";

                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['apellido_paterno']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['apellido_materno']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['edad']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['domicilio']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['telefono']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['correo']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['fecha_nacimiento']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['lugar_nacimiento']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['es_estudiante']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['institucion']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['carrera']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['profesion']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['lugar_profesion']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['puesto']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['grado_estudios']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['tiene_problemas_salud']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['problema_salud']) . "</td>";
                            echo "<td>" . $disciplinas_inscritas_str . "</td>";

                            echo "<td class='file-col'>";
                            echo "<form action='guardarArchivos.php' method='POST' enctype='multipart/form-data'>";
                            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                            echo "<label for='formato_firmado'>Formato Firmado:</label>";
                            echo "<input type='file' name='formato_firmado' accept='.jpg,.jpeg,.png,.pdf' required>";
                            echo "<input type='submit' value='Subir' class='upload-btn'>";
                            echo "</form>";
                            echo "</td>";
                            
                            echo "<td class='file-col'>";
                            echo "<form action='guardarArchivos.php' method='POST' enctype='multipart/form-data'>";
                            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                            echo "<label for='certificado_medico'>Certificado Médico:</label>";
                            echo "<input type='file' name='certificado_medico' accept='.jpg,.jpeg,.png,.pdf' required>";
                            echo "<input type='submit' value='Subir' class='upload-btn'>";
                            echo "</form>";
                            echo "</td>";
                            
                            
                        }
                    } else {
                        echo "<tr><td colspan='23'>No se encontraron registros.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="nav-container">
        <a href="menuADM.php"><h4>Salir</h4></a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
