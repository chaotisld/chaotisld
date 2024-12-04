<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Reservar Clase</title>
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

        input[type="text"], input[type="number"], input[type="email"], select {
            font-family: "Roboto", sans-serif;
            outline: 0;
            background: #f2f2f2;
            width: 100%;
            border: 0;
            margin: 0 0 15px;
            padding: 10px;
            box-sizing: border-box;
            font-size: 14px;
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
    </style>
</head>
<body>
    <header>
        <div class="header">
            <h3>Reservar Clase</h3>
        </div>
    </header>

    <form action="guardar_clase.php" method="POST">
        <div class="table-container">
            <h3>Reservar Clase para Alumno</h3>
            <table id="classReservationTable">
                <thead>
                    <tr>
                        <th>ID Alumno</th>
                        <th>Nombre</th>
                        <th>Disciplina</th>
                        <th>Horario</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="number" name="ID" placeholder="ID Alumno" required></td>
                        <td><input type="text" name="Nombre" placeholder="Nombre Alumno" required></td>
                        <td>
                            <select name="Disciplina" required>
                                <option value="">Selecciona una disciplina</option>
                                <option value="Natacion">Natación</option>
                                <option value="Basquetnall">Basquetball</option>
                                <option value="Futbol">Futbol</option>
                                <option value="Voleibol">Voleibol</option>
                                <option value="Box">Box</option>
                                <option value="Tenis">Tenis</option>
                                <option value="Karate">Karate</option>


                            </select>
                        </td>
                        <td><input type="datetime-local" name="Horario" required></td>
                    </tr>
                </tbody>
            </table>
            <input type="submit" value="Reservar Clase">
        </div>
    </form>

    <div class="nav-container">
        <a href="menuAlumno.php"><h4>Salir</h4></a>
    </div>
</body>
</html>
