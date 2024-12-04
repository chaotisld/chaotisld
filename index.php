<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Inicio ADM</title>
</head>
<body>
    <div class="login-page">
        <div class="form">
          <form action="loginADM.php" method="POST" class="login-form">
            <input type="text" name="Usuario" placeholder="Usuario" required />
            <input type="password" name="Contra" placeholder="Contraseña" required />
            <input type="number" name="Codigo" placeholder="Código acceso" required />
            <button type="submit">Ingresar</button>
          </form>
        </div>
    </div>
</body>
</html>
