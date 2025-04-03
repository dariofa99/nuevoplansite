<?php
if(!isset($_SESSION["session_username"])) {
		header("location:login.php");
} else {
?>
<script language="JavaScript"> 
function confirmation() {
    if(confirm("Realmente desea eliminar?"))
    {
        return true;
    }
    return false;
}
</script>
<?php	

	echo '<center>';
	//$registros nos entrega la cantidad de registros a mostrar.
	$registros = 25;
	$espacio= '-';
	//Contador de registros a mostrar.   
	$contador = 1;
	/**
	* Se inicia la paginación, si el valor de $pagina es 0 le asigna el valor 1 e $inicio entra con valor 0.
	* si no es la pagina 1 entonces $inicio sera igual al numero de pagina menos 1 multiplicado por la cantidad de registro
	*/
	if (!isset($_GET['pagina'])) { 
		$inicio = 0; 
		$_GET['pagina'] = 1; 
	} else { 
		$inicio = ($_GET['pagina'] - 1) * $registros; 
	} 
	
	
	
	//include('includes/connection.php');
	echo '<h2>Administraci&oacute;n de inscritos: '.$semactual.$anio.'</h2>';
			$estudinscritos=mysqli_query($con, "SELECT estudiante, COUNT(1) AS total FROM m_inscritas GROUP BY estudiante HAVING COUNT(1) > 0 ORDER BY estudiante");
			$totalei= mysqli_num_rows($estudinscritos);
			//$estindividual = mysqli_fetch_array($estudinscritos); 
			$usuarios = mysqli_query($con,"SELECT * FROM estudiantes WHERE activo=1");
			//Contamos la cantidad de filas entregadas por la consulta, de esta forma sabemos cuantos registros fueron retornados por la consulta.
			$total_usuarios = mysqli_num_rows($usuarios)-1		; 
			echo $totalei.' inscritos de '.$total_usuarios.' matriculados. <a href="administer.php?option=21">Ver Agrupados</a>';
	
	$resultados = mysqli_query($con,"SELECT * FROM m_inscritas ");
	//Contamos la cantidad de filas entregadas por la consulta, de esta forma sabemos cuantos registros fueron retornados por la consulta.
	$total_registros = mysqli_num_rows($resultados); 
	//Generamos otra consulta la cual creara en si la paginación, ordenando y creando un límite en las consultas.
	//$resultados = mysqli_query($con,"SELECT * FROM m_inscritas ORDER BY estudiante ASC LIMIT $inicio, $registros");  
	$regcon=ceil($total_registros/$registros);
	// Este ciclo se utiliza para almacenar los valores del registro inicial y final por página
			for ($o=1;$o<=$regcon;$o++){
				$limiteinf=(($o-1)*$registros);
				$limitesup=(($o)*$registros)-1;
				$primera[$o]= mysqli_query($con,"SELECT * FROM m_inscritas ORDER BY estudiante ASC LIMIT $limiteinf, 1");  
				$ultima[$o]= mysqli_query($con,"SELECT * FROM m_inscritas  ORDER BY estudiante ASC LIMIT $limitesup,1");  
				$primerap[$o]=mysqli_fetch_array($primera[$o], MYSQLI_ASSOC);
				$ultimap[$o]=mysqli_fetch_array($ultima[$o], MYSQLI_ASSOC);
				$primerapersona[$o]=$primerap[$o]['estudiante'];
				$ultimapersona[$o]=$ultimap[$o]['estudiante'];
			}
			//Con ceil redondearemos el resultado total de las paginas 4.53213 = 5
			$total_paginas = ceil($total_registros / $registros);                 
					
			echo '<form name="editar" method="POST" action="administer.php?option=7" onsubmit="return confirmation()"><table border=0 width=100%>';
			echo '<tr> <th class="Estilot">Estudiante</th><th class="Estilot">Asignatura</th><th class="Estilot">Cr&eacute;ditos</th><th class="Estilot">C. Pr&aacute;c. Ped.</th><th class="Estilot">Condici&oacute;n</th><th class="Estilot">Eliminar</th></tr>';			
			$cambio=0;
			$color='#ff0000';
			//$resultados = mysqli_query($con,"SELECT * FROM m_inscritas GROUP BY estudiante ORDER BY estudiante ASC LIMIT $inicio, $registros");  
			$resultadosm = mysqli_query($con,"SELECT * FROM m_inscritas estudiante ORDER BY estudiante ASC LIMIT $inicio, $registros");  
				// Si tenemos un retorno en la variable $total_registro iniciamos el ciclo para mostrar los datos.
				if ($total_registros) {
					while ($personas = mysqli_fetch_array($resultadosm)) {
						echo '<tr>';						
						echo '<td class="Estilol">'.$personas['estudiante'].'</td>';
						echo '<td class="Estilol">'.$personas['asignatura'].'</td>';
						echo '<td class="Estilol">'.$personas['creditos'].'</td>';
						echo '<td class="Estilol">'.$personas['creditospp'].'</td>';
						echo '<td class="Estilol">'.$personas['condicion'].'</td>';
						
						$eliminar=$personas['codigo'];
						
						echo '<td align="center"><input type="submit" name="codigoed[]" value="'.$eliminar.'" class="botoned" > </a></td>';
						echo '</tr>';			
					
						/**
						* La variable $contador es la misma que iniciamos arriba con valor 1, en cada ciclo sumara 1 a este valor.
						* $contador sirve para mostrar cuantos registros tenemos, es mas que nada una guía.
						*/
						$contador++;
					}
				} else {
						echo "<font color='darkgray'>(sin resultados)</font>";
				}
					
				//echo '</tr>';
			
			

			echo '</table> </form>';
			for ($o=1;$o<=$regcon;$o++){
				$ini[$o] = substr($primerapersona[$o], 0, 2);
				$fin[$o] = substr($ultimapersona[$o], 0, 2);
			}
			mysqli_free_result($resultados);    
			?>
		
	</table><br>
	<div class="optionmenu">   
    <?php
		if ($total_registros) {
			/**
			* Acá activamos o desactivamos la opción "< Anterior", si estamos en la pagina 1 nos dará como resultado 0 por ende NO
			* activaremos el primer if y pasaremos al else en donde se desactiva la opción anterior. Pero si el resultado es mayor
			* a 0 se activara el href del link para poder retroceder.
			*/
			if (($_GET['pagina'] - 1) > 0) {
				echo '<a href="administer.php?option=2&pagina='.($_GET['pagina']-1).'"> <button class="botoned"> << Anterior </button></a>';
			} else {
				echo '<a href="#"><button class="botoned"><< Anterior </button></a>';
			}
			// Generamos el ciclo para mostrar la cantidad de paginas que tenemos.
			for ($i = 1; $i <= $total_paginas; $i++) {
				if ($_GET['pagina'] == $i) {
					echo '<a href="#"> <button class="botoned">'. $_GET['pagina'] .' ('.$ini[$i].$espacio.$fin[$i].')'.'</button> </a> '; 
				} else {
					echo '<a href="administer.php?option=2&pagina='.$i.'"> <button class="botoned">'.$i. ' ('.($ini[$i].$espacio.$fin[$i]).')</button></a>'; 
				}   
			}
			/**
			* Igual que la opción primera de "< Anterior", pero acá para la opción "Siguiente >", si estamos en la ultima pagina no podremos
			* utilizar esta opción.
			*/
			if (($_GET['pagina'] + 1)<=$total_paginas) {
				echo '<a href="administer.php?option=2&pagina='.($_GET['pagina']+1).'" > <button class="botoned">Siguiente >></button></a>';
			} else {
				echo '<a href="#"> <button class="botoned">Siguiente >></button></a>';
			}        
		}
    ?>  
	</div> 
	<?php
		// Cerramos conexión con MySQLi.
		mysqli_close($con);
		echo '</center>';
	}
	?>