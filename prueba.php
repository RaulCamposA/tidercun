<!DOCTYPE html>
<html>
	<head>
		<meta lang="es">
		<meta charset="utf-8">
		<title>Subir Imagen</title>
	</head>
	<body>
 
		<!-- Formulario para subir la imagen -->
		<form enctype="multipart/form-data" action="upimg.php" method="post" name="form1">
			<table align="center">
				<tr>
					<td>Archivo</td>
					<td><input type="file" name="miArchivo"></td>
				</tr> 
				<tr>
					<td>&nbsp;</td>
					<td><input type="submit" value="UPLOAD"></td>
				</tr>	
			</table>
		</form>
	</body>
</html>