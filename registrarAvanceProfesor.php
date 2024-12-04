<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Registrar Comentarios</title>
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

        input[type="text"], input[type="email"], input[type="number"] {
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

        .add-student-container {
            text-align: center;
            margin-top: 20px;
        }

        .nav-container {
            text-align: center;
            margin-top: 20px;
        }

        .nav-container a h4 {
            text-decoration: none;
            color: #000;
        }

        /* Estilos para el botón "Agregar nuevo alumno" */
        .agregar-alumno-btn {
            background-color: #4CAF50; /* Color verde para el botón */
            color: white; /* Texto blanco */
            font-family: "Roboto", sans-serif;
            font-size: 16px; /* Tamaño de la fuente */
            padding: 12px 24px; /* Espaciado interno */
            border: none; /* Sin borde */
            border-radius: 5px; /* Bordes redondeados */
            cursor: pointer; /* Cambiar el cursor al pasar sobre el botón */
            transition: background-color 0.3s ease, transform 0.2s ease; /* Animaciones suaves */
            text-align: center; /* Alinear el texto al centro */
            width: auto; /* Ajuste automático del ancho */
        }

        .agregar-alumno-btn:hover {
            background-color: #45a049; /* Color verde más oscuro cuando pasa el ratón */
            transform: scale(1.05); /* Efecto de zoom al pasar el ratón */
        }

        .agregar-alumno-btn:active {
            background-color: #388e3c; /* Color aún más oscuro al hacer clic */
        }

        .agregar-alumno-btn:focus {
            outline: none; /* Eliminar el contorno del botón al hacer clic */
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

    <form action="guardar_comentarios.php" method="POST">
        <div class="table-container">
            <h3>Comentarios y sugerencias</h3>
            <table id="studentsTable">
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
                    <tr>
                        <td><input type="number" name="ID" placeholder="ID" required></td>
                        <td><input type="text" name="Nombre" placeholder="Nombre" required></td>
                        <td><input type="text" name="Disciplina" placeholder="Disciplina" required></td>
                        <td><input type="email" name="Correo" placeholder="Correo" required></td>
                        <td><input type="text" name="Comentarios" placeholder="Comentarios" required></td>
                    </tr>
                </tbody>
            </table>
            <input type="submit" value="Enviar">
            <div class="add-student-container">
                <button type="button" class="agregar-alumno-btn" onclick="addStudent()">Agregar nuevo alumno</button>
            </div>
        </div>
    </form>

    <div class="nav-container">
        <a href="menuProfesor.php"><h4>Salir</h4></a>
    </div>

    <script>
        function addStudent() {
            // Obtener el cuerpo de la tabla donde se agregarán las nuevas filas
            const tableBody = document.querySelector("#studentsTable tbody");

            // Crear una nueva fila
            const newRow = document.createElement("tr");

            // Crear las celdas de la tabla y agregar campos de entrada a ellas
            for (let i = 0; i < 5; i++) {
                const newCell = document.createElement("td");
                let input;

                if (i === 0) {  // Para ID
                    input = document.createElement("input");
                    input.type = "number";
                    input.name = "ID";
                    input.placeholder = "ID";
                    input.required = true;
                } else if (i === 1) {  // Para Nombre
                    input = document.createElement("input");
                    input.type = "text";
                    input.name = "Nombre";
                    input.placeholder = "Nombre";
                    input.required = true;
                } else if (i === 2) {  // Para Disciplina
                    input = document.createElement("input");
                    input.type = "text";
                    input.name = "Disciplina";
                    input.placeholder = "Disciplina";
                    input.required = true;
                } else if (i === 3) {  // Para Correo
                    input = document.createElement("input");
                    input.type = "email";
                    input.name = "Correo";
                    input.placeholder = "Correo";
                    input.required = true;
                } else {  // Para Comentarios
                    input = document.createElement("input");
                    input.type = "text";
                    input.name = "Comentarios";
                    input.placeholder = "Comentarios";
                    input.required = true;
                }

                newCell.appendChild(input);
                newRow.appendChild(newCell);
            }

            // Agregar la nueva fila al cuerpo de la tabla
            tableBody.appendChild(newRow);
        }
    </script>
</body>
</html>
