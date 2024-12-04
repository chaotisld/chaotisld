<?php
include("conexion.php");

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

//EntidadReistrarAlumnosADM
$nombre = $_POST['Nombre'];
$apellido_paterno = $_POST['Apellido_paterno'];
$apellido_materno = $_POST['Apellido_materno'];
$edad = $_POST['Edad'];
$domicilio = $_POST['Domicilio'];
$telefono = $_POST['Telefono'];
$correo = $_POST['Correo'];
$fecha_nacimiento = $_POST['Fecha_nacimiento'];
$lugar_nacimiento = $_POST['Lugar_nacimiento'];
$es_estudiante = $_POST['es_estudiante'];
$institucion = $es_estudiante == 'si' ? $_POST['Institucion'] : null;
$carrera = $es_estudiante == 'si' ? $_POST['Carrera'] : null;
$profesion = $es_estudiante == 'no' ? $_POST['Profesion'] : null;
$lugar_profesion = $es_estudiante == 'no' ? $_POST['Lugar_profesion'] : null;
$puesto = $es_estudiante == 'no' ? $_POST['Puesto'] : null;
$grado_estudios = $es_estudiante == 'no' ? $_POST['Grado_estudios'] : null;
$tiene_problemas_salud = $_POST['salud'];
$problema_salud = $tiene_problemas_salud == 'si' ? $_POST['Problema_salud'] : null;

$sqlAlumno = "INSERT INTO Alumno (
    nombre, apellido_paterno, apellido_materno, edad, domicilio, telefono, correo, 
    fecha_nacimiento, lugar_nacimiento, es_estudiante, institucion, carrera, 
    profesion, lugar_profesion, puesto, grado_estudios, tiene_problemas_salud, problema_salud
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sqlAlumno);
if (!$stmt) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

$stmt->bind_param(
    "sssissssssssssssss",
    $nombre, $apellido_paterno, $apellido_materno, $edad, $domicilio, $telefono, $correo,
    $fecha_nacimiento, $lugar_nacimiento, $es_estudiante, $institucion, $carrera,
    $profesion, $lugar_profesion, $puesto, $grado_estudios, $tiene_problemas_salud, $problema_salud
);

if ($stmt->execute()) {
    $alumno_id = $stmt->insert_id;

    $disciplinas_practicadas = $_POST['Disciplinas'];
    $disciplinasArray = explode(",", $disciplinas_practicadas);
    foreach ($disciplinasArray as $disciplina) {
        $sqlDisciplina = "INSERT INTO Disciplinas_practicadas (alumno_id, disciplina) VALUES (?, ?)";
        $stmtDisciplina = $conn->prepare($sqlDisciplina);
        $stmtDisciplina->execute();
    }

    $natacion = isset($_POST['Natacion']) ? 1 : 0;
    $basquetball = isset($_POST['Basquetball']) ? 1 : 0;
    $futbol = isset($_POST['Futbol']) ? 1 : 0;
    $voleibol = isset($_POST['Voleibol']) ? 1 : 0;
    $box = isset($_POST['Box']) ? 1 : 0;
    $tenis = isset($_POST['Tenis']) ? 1 : 0;
    $karate = isset($_POST['Karate']) ? 1 : 0;

    $sqlInscripcion = "INSERT INTO Disciplinas_inscripcion (
        alumno_id, natacion, basquetball, futbol, voleibol, box, tenis, karate
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmtInscripcion = $conn->prepare($sqlInscripcion);
    $stmtInscripcion->bind_param("iiiiiiii", $alumno_id, $natacion, $basquetball, $futbol, $voleibol, $box, $tenis, $karate);
    $stmtInscripcion->execute();    

    echo '<script> alert("Datos guardados correctamente"); window.location.href="registrarAlumnoADM.php"; </script>';
} else {
    echo '<script> alert("Datos no almacenados"); window.location.href="registrarAlumnoADM.php"; </script>' . $conn->error;
}

$stmt->close();
$conn->close();

?>