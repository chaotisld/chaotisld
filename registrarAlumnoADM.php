<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Alumno</title>
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
    </style>
</head>
<body>
    <header>
        <div class="header">
         <h3>S I S T E M A</h3>
        </div>
    </header> <br><br>
    <div class="form">
        <form action="guardar_datos.php" method="POST" class="login-form">
            <input type="text" name="Nombre" placeholder="Nombre"  />
            <input type="text" name="Apellido_paterno" placeholder="Apellido Paterno"/>
            <input type="text" name="Apellido_materno" placeholder="Apellido Materno" />
            <input type="number" name="Edad" placeholder="Edad" />

            <input type="address" name="Domicilio" placeholder="Domicilio">
            <input type="tel" name="Telefono" placeholder="Número telefónico" >
            <input type="email" name="Correo" placeholder="Correo electrónico" >Fecha de nacimiento <br> <br>
            <input type="date" name="Fecha_nacimiento" placeholder="Fecha de nacimiento" > 
            <input type="text" name="Lugar_nacimiento" placeholder="Lugar de nacimiento" > 

            ¿Es estudiante? <br>
            <input type="radio" name="es_estudiante" id="es_estudiante_si" value="si" >Sí
            <input type="radio" name="es_estudiante" id="es_estudiante_no" value="no" >No  <br>

            <div id="additional-inputs" class="additional-inputs">
                <input type="text" name="Institucion" placeholder="Institución educativa" >
                <input type="text" name="Carrera" placeholder="Carrera o grado escolar" >
            </div> <br>

            <div id="profesion-inputs">
                <input type="text" name="Profesion" placeholder="Profesión">
                <input type="text" name="Lugar_profesion" placeholder="Lugar donde ejerce su profesión">
                <input type="text" name="Puesto" placeholder="Puesto">
                <input type="text" name="Grado_estudios" placeholder="Máximo grado de estudios">
            </div>

            ¿Padece de algún problema de salud? <br>
            <input type="radio" name="salud" id="salud_si" value="si" >Sí
            <input type="radio" name="salud" id="salud_no" value="no" >No <br> <br> 

            <div id="additional-salud" class="additional-salud">
                <input type="text" name="Problema_salud" placeholder="Indique cuál" >
            </div> 

             Disciplina que practicará <br>
            <div class="disciplinas-container">
                <p><input type="checkbox" name="Natacion"> Natación</p>
                <p><input type="checkbox" name="Basquetball"> Basquetball</p>
                <p><input type="checkbox" name="Futbol"> Futbol</p>
                <p><input type="checkbox" name="Voleibol"> Voleibol</p>
                <p><input type="checkbox" name="Box"> Box</p>
                <p><input type="checkbox" name="Tenis"> Tenis</p>
                <p><input type="checkbox" name="Karate"> Karate</p>

              <br> <br> 
            <button type="submit">Registrar</button>
        </form>
        <br> <br> <br>
    </div>
    

    <div class="nav-container">
        <a href="menuADM.php"><h4>Salir</h4></a>
    </div>
    <script>
        const estudianteSi = document.getElementById("es_estudiante_si");
        const estudianteNo = document.getElementById("es_estudiante_no");
        const additionalInputs = document.getElementById("additional-inputs");
        const profesionInputs = document.getElementById("profesion-inputs");

        const saludSi = document.getElementById("salud_si");
        const saludNo = document.getElementById("salud_no");
        const additionalSalud = document.getElementById("additional-salud");

        estudianteSi.addEventListener("change", () => {
            if (estudianteSi.checked) {
                additionalInputs.style.display = "block";
                profesionInputs.style.display = "none";
            }
        });

        estudianteNo.addEventListener("change", () => {
            if (estudianteNo.checked) {
                additionalInputs.style.display = "none";
                profesionInputs.style.display = "block";
            }
        });

        saludSi.addEventListener("change", () => {
            if (saludSi.checked) {
                additionalSalud.style.display = "block";
            }
        });

        saludNo.addEventListener("change", () => {
            if (saludNo.checked) {
                additionalSalud.style.display = "none";
            }
        });
    </script>
</body>
</html>
