<?php
if(!isset($_SESSION["session_username"])) {
		header("location:login.php");
} else {
	
	?>
<script language="JavaScript"> 
function confirmation() {
	//var nom=document.getElementsByName('codigoe');
	//var nombre=nom.getAttribute("value");
	//var nombre=nom.value;
    if(confirm("Realmente desea eliminare? "))
    {
        return true;
    }
    return false;
}
</script>
<?php	
	echo '<center>';
	//include('includes/connection.php');
	echo '<h2>Administraci&oacute;n de inscritos: '.$semactual.$anio.' </h2>';
			$estudinscritos=mysqli_query($con, "SELECT estudiante, COUNT(1) AS total FROM m_inscritas GROUP BY estudiante HAVING COUNT(1) > 0 ORDER BY estudiante");
			$totalei= mysqli_num_rows($estudinscritos);
			//$estindividual = mysqli_fetch_array($estudinscritos); 
			$usuarios = mysqli_query($con,"SELECT * FROM estudiantes WHERE activo=1");
			//Contamos la cantidad de filas entregadas por la consulta, de esta forma sabemos cuantos registros fueron retornados por la consulta.
			$total_usuarios = mysqli_num_rows($usuarios)-1		; 
			echo $totalei.' inscritos de '.$total_usuarios.' matriculados. <a href="administer.php?option=2">Ver sin agrupar</a>';
			echo '<form name="editar" method="POST" action="administer.php?option=7" onsubmit="return confirmation();"><table border=0 width=100%>';
			echo '<tr> <th class="Estilot">Estudiante</th><th class="Estilot">Asignatura</th><th class="Estilot">Cr&eacute;ditos</th><th class="Estilot">C. Pr&aacute;c. Ped.</th><th class="Estilot">Condici&oacute;n</th><th class="Estilot">Eliminar</th></tr>';			
			$i=0;
			$cambio=0;
			$color='#ff0000';
			while ($estudiantes = mysqli_fetch_array($estudinscritos)) {
				$totalai= $estudiantes['total'];
				$i++;
				if($cambio==1){$cambio=0;}else{$cambio=1;};
				//$resultados = mysqli_query($con,"SELECT * FROM m_inscritas WHERE estudiante='$estudiantes[estudiante]' ORDER BY estudiante ASC LIMIT $inicio, $registros");  
				$resultados = mysqli_query($con,"SELECT * FROM m_inscritas WHERE estudiante='$estudiantes[estudiante]' ORDER BY estudiante ASC");  
				//$resultadosm = mysqli_query($con,"SELECT * FROM m_inscritas ORDER BY estudiante ASC LIMIT $inicio, $totalai");  
				// Si tenemos un retorno en la variable $total_registro iniciamos el ciclo para mostrar los datos.
				
					while ($personas = mysqli_fetch_array($resultados)) {
						echo '<tr>';
						if ($i==1){
							if ($cambio==1){$color='#eee';}else{$color='#fff';}
							echo '<td class="Estilol" rowspan='.$totalai.' bgcolor='.$color.'>'.$estudiantes['estudiante'].'</td>';
						}
						echo '<td class="Estilol">'.$personas['asignatura'].'</td>';
						echo '<td class="Estilol">'.$personas['creditos'].'</td>';
						echo '<td class="Estilol">'.$personas['creditospp'].'</td>';
						echo '<td class="Estilol">'.$personas['condicion'].'</td>';
						$eliminar=$personas['codigo'];
						$aeliminar[]=$personas['codigo'];
						if ($i==1){
							if ($cambio==1){$color='#eee';}else{$color='#fff';}
							echo '<td align="center" rowspan='.$totalai.' bgcolor='.$color.'><input type="submit" name="codigoed[]" value="'.$eliminar.'" class="botoned"></button> </td>';
							$i=0;
						}
						echo '</tr>';			
						/**
						* La variable $contador es la misma que iniciamos arriba con valor 1, en cada ciclo sumara 1 a este valor.
						* $contador sirve para mostrar cuantos registros tenemos, es mas que nada una guía.
						*/
				
					}
				
					
				//echo '</tr>';
				
			}
			echo '</table></form> ';
	
			mysqli_free_result($resultados);    
			?>
		
	</table><br>
	
	<?php
		// Cerramos conexión con MySQLi.
		mysqli_close($con);
		echo '</center>';
	}
	?>