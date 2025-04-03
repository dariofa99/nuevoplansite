<script> 
		function marcar(obj) { 
			elem=obj.elements; 
			for (i=0;i<elem.length;i++) 
				if (elem[i].type=="checkbox") 
					elem[i].checked=true; 
		} 
</script>
<?php
	if(!isset($_SESSION["session_username"])) {
		header("location:login.php");
	} else {
		echo '<center>';
						$materiasob=mysqli_query($con, "SELECT ida2017, a2017, cr2017, crpp, ca2017, prerrequisito FROM  materias WHERE semestre =  '$semactual' or semestre='BA' ORDER BY ca2017 DESC, a2017");
						$materiasel=mysqli_query($con, "SELECT ide, asignatura, creditos, creditospp FROM  electivas WHERE electivas.semestre =  '$semactual' AND electivas.asignatura not in (SELECT materias.a2017 from materias) ORDER BY asignatura");
						echo '<h2>Bienvenido a consulta de asignaturas preinscritas: '.$semactual.$anio.'</h2><h4>Si no marca una opci&oacute;n, se ordenar&aacute;n por cantidad, sino se ordenan por condici&oacute;n. </h4>';
						echo '<form name="verdatos" method="POST" action="administer.php?option=4"> <input type="button" value="Chequear todo" onclick="marcar(this.form)" class="button" /><br><br><table border=0 width=100%>';
						echo '<tr> <th class="Estilot">Asignatura</th><th class="Estilot">Cr&eacute;ditos</th><th class="Estilot">Cred. Pr&aacute;c. Ped.</th><th class="Estilot">Condici&oacute;n</th><th class="Estilot">Prerrequisito</th><th class="Estilot">Marcar</th></tr>';
						$j=0;
						while ($row = mysqli_fetch_row($materiasob)){
							$j=$j+1;
							echo '<tr>';
							for ($i=1;$i<=5;$i++){
								echo '<td class="Estilol">',$row[$i],'</td>';
								$creditos=$row[2];
							}
							echo '<td><input type="checkbox" id="ch'.$j.'" name="box[]" value="'.$row[1].'"> </td> ';
							echo '</tr>';	
						}
						while ($row = mysqli_fetch_row($materiasel)){
							$j=$j+1;
							echo '<tr>';
							for ($i=1;$i<=3;$i++){
								echo '<td class="Estilol">',$row[$i],'</td>';
								$creditos=$row[2];
							}
							echo '<td class="Estilol"> ELECTIVA</td>';
							echo '<td></td>';
							echo '<td><input type="checkbox" id="ch'.$j.'" name="box[]" value="'.$row[1].'"  > </td> ';
							echo '</tr>';	
						}
						echo '<tr><td colspan="6" align="center"><input type="submit" name="enviar" id ="enviar" value="Consultar" class="boton"> -- <input type="reset" name="cancelar" id="cancelar" value="Cancelar" class="boton"></td>
							</tr>
							</table></form> ';
		echo '</center>';
	}
	?>	