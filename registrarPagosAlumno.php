<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Alumno</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:300);

        /* Estilos generales */
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

        .form input,
        .form select {
            font-family: "Roboto", sans-serif;
            outline: 0;
            background: #f2f2f2;
            width: 100%;
            border: 1px solid #ccc;
            margin: 0 0 15px;
            padding: 15px;
            box-sizing: border-box;
            font-size: 14px;
            border-radius: 5px; /* Bordes redondeados para inputs y selects */
        }

        .form select {
            -webkit-appearance: none; /* Eliminar el estilo predeterminado del select */
            -moz-appearance: none;
            appearance: none;
            background: url('https://imageURL.com/arrow-down.png') no-repeat right #f2f2f2; /* Flecha personalizada */
            background-size: 15px;
        }

        .form input:focus,
        .form select:focus {
            border: 1px solid #74b577; /* Cambio de color al enfocar */
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
            border-radius: 5px; /* Bordes redondeados para el botón */
        }

        .form button:hover, .form button:active, .form button:focus {
            background: #74b577;
        }

        .additional-inputs,
        .additional-salud {
            display: none;
            margin-top: 15px;
        }

        /* Estilo para los radios */
        input[type="radio"] {
            margin: 0 5px 0 0;
            cursor: pointer;
        }

        /* Estilo para los checkboxes en párrafos */
        .disciplinas-container {
            text-align: left;
            margin-top: 15px;
        }

        .disciplinas-container p {
            margin: 10px 0;
        }

        /* Estilo para la tabla */
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
        <h3>Registrar Pago</h3> <br> <br>
        <form action="almacenarPagos.php" method="POST" enctype="multipart/form-data">

            <label for="id_alumno">ID:</label> <br> <br>
           <input type="number" name="id_alumno" required><br>

           <label for="nombre_alumno">Nombre del Alumno:</label> <br> <br>
           <input type="text" name="nombre_alumno" required><br>


            <label for="fecha_pago">Fecha de Pago:</label> <br> <br>
            <input type="date" name="fecha_pago" required><br>

            <label for="paquete_o_clase">Paquete o Clase:</label> <br><br>
            <select name="paquete_o_clase" required>
                <option value="1">Paquete</option>
                <option value="0">Clase</option>
            </select><br><br>

            <label for="banco">Banco:</label> <br><br> 
            <input type="text" name="banco" required><br>

            <label for="folio">Número de Folio:</label>  <br><br> 
            <input type="text" name="folio" required><br>

            <label for="comprobante_pago">Comprobante de Pago:</label> <br><br> 
            <input type="file" name="comprobante_pago" required><br><br>

            <button type="submit">Registrar Pago</button>
        </form>
    </div>

    <div class="nav-container">
        <a href="menuAlumno.php"><h4>Salir</h4></a>
    </div>
</body>
</html>
