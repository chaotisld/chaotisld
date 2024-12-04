<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Comentarios Alumno</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:300);

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

        
        input[type="text"] {
            font-family: "Roboto", sans-serif;
            outline: 0;
            background: #f2f2f2;
            width: 30%;  
            border: 1px solid #ddd;
            margin: 0 0 15px;
            padding: 10px;
            box-sizing: border-box;
            font-size: 14px;
            border-radius: 4px;  
        }

        input[type="submit"] {
            font-family: "Roboto", sans-serif;
            text-transform: uppercase;
            background-color: #74b577;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            font-size: 14px;
            border-radius: 4px;  
        }

        input[type="submit"]:hover {
            background-color: #5b9e63;
            transform: scale(1.05);
        }

        input[type="submit"]:active {
            background-color: #4a7c4f;
        }

        input[type="submit"]:focus {
            outline: none;
        }

        .add-student-container {
            text-align: center;
            margin-top: 20px;
        }

        .add-student-btn {
            font-family: "Roboto", sans-serif;
            text-transform: uppercase;
            background-color: #ffffff;
            color: #000;
            padding: 15px;
            border: 2px solid #74b577;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .add-student-btn:hover {
            background-color: #74b577;
            color: #fff;
        }

        .nav-container {
            text-align: center;
            margin-top: 20px;
        }

        .nav-container a h4 {
            text-decoration: none;
            color: #000;
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

    <div class="add-student-container">
        <h3>Introduce tu ID para ver los comentarios</h3> <br> <br> 
        <form method="POST">
            <input type="text" name="id" placeholder="Ingresa tu ID" required>
            <input type="submit" value="Ver comentarios">
        </form>
    </div>


    <div class="table-container">
        <h3>Comentarios del Alumno</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Alumno</th>
                    <th>Disciplina</th>
                    <th>Correo</th>
                    <th>Comentarios</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
                    $id = $_POST['id'];

                    $host = "localhost";
                    $user = "root";
                    $password = "";
                    $dbname = "sistemaing";

                    $conn = new mysqli($host, $user, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Error de conexión: " . $conn->connect_error);
                    }

                    $sql = "SELECT ID, Nombre, Disciplina, Correo, Comentario FROM Comentarios WHERE ID = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['ID'] . "</td>";
                            echo "<td>" . $row['Nombre'] . "</td>";
                            echo "<td>" . $row['Disciplina'] . "</td>";
                            echo "<td>" . $row['Correo'] . "</td>";
                            echo "<td>" . $row['Comentario'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Sin comentarios recientes.</td></tr>";
                    }

                    $conn->close();
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="nav-container">
        <a href="menuAlumno.php"><h4>Salir</h4></a>
    </div>
</body>
</html>
