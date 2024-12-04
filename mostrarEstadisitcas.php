<?php
include("conexion.php");

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$sqlEdad = "SELECT edad, COUNT(*) as cantidad FROM Alumno GROUP BY edad ORDER BY edad";
$resultEdad = mysqli_query($conn, $sqlEdad);

//EntidadEstadisticas
$sqlDeportes = "
    SELECT 
        SUM(natacion) as natacion,
        SUM(basquetball) as basquetball,
        SUM(futbol) as futbol,
        SUM(voleibol) as voleibol,
        SUM(box) as box,
        SUM(tenis) as tenis,
        SUM(karate) as karate
    FROM Disciplinas_inscripcion";
$resultDeportes = mysqli_query($conn, $sqlDeportes);
$deportes = mysqli_fetch_assoc($resultDeportes);

$sqlTotalEstudiantes = "SELECT COUNT(*) as total FROM Alumno";
$resultTotalEstudiantes = mysqli_query($conn, $sqlTotalEstudiantes);
$totalEstudiantes = mysqli_fetch_assoc($resultTotalEstudiantes)['total'];

$sqlConProblemasSalud = "SELECT COUNT(*) as con_salud FROM Alumno WHERE problema_salud = 1";
$resultConProblemasSalud = mysqli_query($conn, $sqlConProblemasSalud);
$conProblemasSalud = mysqli_fetch_assoc($resultConProblemasSalud)['con_salud'];

$sqlSinProblemasSalud = "SELECT COUNT(*) as sin_salud FROM Alumno WHERE problema_salud = 0";
$resultSinProblemasSalud = mysqli_query($conn, $sqlSinProblemasSalud);
$sinProblemasSalud = mysqli_fetch_assoc($resultSinProblemasSalud)['sin_salud'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas de Edad, Salud y Deportes</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 20px 0;
        }

        .container {
            margin: 20px auto;
            width: 90%;
            max-width: 1200px;
        }

        h3, h4 {
            font-size: 1.6em;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .nav-container {
            text-align: center;
            margin-top: 20px;
        }

        .nav-container a {
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1.2em;
        }

        .nav-container a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h3>Estadísticas de Edad, Salud y Deportes</h3>
    </header>
    <div class="container">
        <h4>Estadísticas por Edad</h4>
        <table>
            <thead>
                <tr>
                    <th>Edad</th>
                    <th>Cantidad de Personas</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($resultEdad) > 0) {
                    while ($row = mysqli_fetch_assoc($resultEdad)) {
                        echo "<tr><td>" . $row['edad'] . "</td><td>" . $row['cantidad'] . "</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No hay datos disponibles.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <h4>Estadísticas por Deportes</h4>
        <table>
            <thead>
                <tr>
                    <th>Deporte</th>
                    <th>Cantidad de Personas</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>Natación</td><td><?php echo $deportes['natacion']; ?></td></tr>
                <tr><td>Basquetball</td><td><?php echo $deportes['basquetball']; ?></td></tr>
                <tr><td>Fútbol</td><td><?php echo $deportes['futbol']; ?></td></tr>
                <tr><td>Voleibol</td><td><?php echo $deportes['voleibol']; ?></td></tr>
                <tr><td>Box</td><td><?php echo $deportes['box']; ?></td></tr>
                <tr><td>Tenis</td><td><?php echo $deportes['tenis']; ?></td></tr>
                <tr><td>Karate</td><td><?php echo $deportes['karate']; ?></td></tr>
            </tbody>
        </table>

        <h4>Estadísticas de Salud</h4>
        <table>
            <thead>
                <tr>
                    <th>Condición de Salud</th>
                    <th>Cantidad de Personas</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>Con Problemas de Salud</td><td><?php echo $conProblemasSalud; ?></td></tr>
                
            </tbody>
        </table>

        <h4>Total de Estudiantes</h4>
        <table>
            <thead>
                <tr>
                    <th>Total de Estudiantes</th>
                </tr>
            </thead>
            <tbody>
                <tr><td><?php echo $totalEstudiantes; ?></td></tr>
            </tbody>
        </table>
    </div>

    <div class="nav-container">
        <a href="menuADM.php"><h4>Salir</h4></a>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>
