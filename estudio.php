<html>
<meta content="text/html;" charset="utf-8;">
<link rel="stylesheet" href="simulador.css" type="text/css">
<link href="info.ico" rel="shortcut icon">

<head>
	<title>
		Estudio acad�mico actual - Lic. Inform�tica
	</title>
	<script>
		function marcar(obj) {
			elem = obj.elements;
			for (i = 0; i < elem.length; i++)
				if (elem[i].type == "checkbox")
					elem[i].checked = true;
		}
	</script>
</head>

<body bgcolor=#BDC3CD>
	<center>
		<form name="Fsimular" method="POST" action="analisis.php">

			<table border=0 width=85% cellpadding="0" cellspacing="5" bgcolor="white">
				<tr>
					<td align="center" width=25%><img src="logou.jpg" width=130 height=120></td>
					<td align="center" width=50%>
						<h2>FORMULARIO DE AN&Aacute;LISIS DE SITUACI&Oacute;N ACAD&Eacute;MICA ACTUAL</h2>
					</td>
					<td align="center" width=25%><img src="logo.jpg" width=120 height=90></td>
				</tr>
				<tr>
					<td colspan=3>

						<table width=80% border=1 cellpadding="1" cellspacing="1" align="center" bordercolor=#BDC3CD>
							<tr>
								<td width="10" colspan="3" align="center"><b>Seleccione las asignaturas que ha cursado y aprobado en su plan actual - - - -</b> <input type="button" value="chequear todo" onclick="marcar(this.form)" /> - - - -<input type="reset" name="cancelar" value="Cancelar"> </td>
							</tr>
							<?php
							require_once("admin/includes/connection.php");
							//include("conexion.php");
							$largo = mysqli_query($con, "SELECT COUNT(sema2017) FROM  materias WHERE ca2017 ='OBLIGATORIA'");
							$count = mysqli_fetch_array($largo);
							$j = 0;
							$fila = 0;
							for ($i = 1; $i <= 10; $i++) {
								$result = mysqli_query($con, "SELECT COUNT( sema2017 ) FROM  materias WHERE (ca2017 =  'OBLIGATORIA' AND sema2017 ='$i')");
								$count2 = mysqli_fetch_array($result);
								$materias = mysqli_query($con, "SELECT a2017, id, sema2017 FROM  materias WHERE ca2017 =  'OBLIGATORIA' AND sema2017 ='$i'");
								echo '<tr >';
								$color = "#FFFFFF";
								if ($i % 2 == 0) $color = "#BDC3CD"; // Alternar color de fondo para cada semestre
								echo "<td  bgcolor={$color} rowspan='" . ($count2[0] + 1) . "'> SEMESTRE " . $i . "</td>";
								// Iteramos sobre cada materia obtenida
								while ($row = mysqli_fetch_assoc($materias)) {
									echo '<tr>'; // Nueva fila para cada materia
									echo "<td bgcolor={$color}>" . $row["a2017"] . '</td>';
									echo "<td bgcolor={$color}> <input name=oblig[] value='{$row["id"]}' type='checkbox'> </td>";
									echo '</tr>';
								}
								echo '</tr>';
							}
							?>

							<tr>
								<?php
								$num_electivas = mysqli_query($con, "SELECT * FROM electivas");
								$contar_elec = mysqli_num_rows($num_electivas);

								?>
								<td rowspan=<?php echo $contar_elec + 1; ?>>ELECTIVAS</td>

								<?php
								$electivas = mysqli_query($con, "SELECT * FROM electivas");
								while ($elec = mysqli_fetch_array($electivas)) {
									echo "<tr><td>";
									echo $elec["asignatura"];
									echo "</td><td><input name='elect[]' value='{$elec["id"]}' type='checkbox'></td></tr>";
								}
								?>
							</tr>

							<tr>
								<?php
								$matglobales = mysqli_query($con, "SELECT a2017, id, sema2017 FROM  materias 
								WHERE ca2017 =  'OBLIGATORIA' 
								AND (a2017 like 'Formacion%' or a2017 like '%Lectura%' or a2017 like '%Idioma%')");
										
								$contar_elec = mysqli_num_rows($matglobales);

								?>
								<td bgcolor='#BDC3CD' rowspan=<?php echo $contar_elec + 1; ?>>ASIG. GLOBALES</td>

								<?php
								
								while ($elec = mysqli_fetch_array($matglobales)) {
									echo "<tr><td bgcolor='#BDC3CD'>";
									echo $elec["a2017"];
									echo "</td><td bgcolor='#BDC3CD'><input name='oblig[]' value='{$elec["id"]}' type='checkbox'></td></tr>";
								}
								?>
							</tr>

						</table>
					</td>
				</tr>
				<tr>
					<td colspan="3" align="center"><input type="submit" name="enviar" value="Enviar"><input type="reset" name="cancelar" value="Cancelar"><input type="button" value="chequear todo" onclick="marcar(this.form)" /> </td>
				</tr>
				<input type="hidden" name="tipof" value="nuevo">
			</table>
		</form>

		<center>
			<P class="Estilolpie"> Dise&ntilde;o del simulador: Jos&eacute; Luis Romo G. - Coord. Licenciatura en Inform&aacute;tica <br> cel:3156610274<br>mail:rhomojose@yahoo.es</P>
		</center>


	</center>
</body>

</html>