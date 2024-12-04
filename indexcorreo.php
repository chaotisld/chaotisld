<!DOCTYPE html>
<html>

<head>
	<title>Mail Form</title>
	<link rel="stylesheet" type="text/css" href="indexcorreo.css">
</head>
<body>
<form method="post">
	<input type="text" placeholder="nombre" name="name" required="">
	<input type="email" placeholder="email" name="email" required="">
        <input type="text" placeholder="telefono" name="telefono" required="">
	<input type="text" placeholder="asunto" name="asunto" required="">
		<textarea placeholder="mensaje" name="msg"></textarea>
	<input type="submit" name="enviar">
</form>
<?php
include("correo.php");
?>
</body>
</html>