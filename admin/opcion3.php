<?php
if(!isset($_SESSION["session_username"])) {
		header("location:login.php");
} else {
	echo '<center>';
	//$registros nos entrega la cantidad de registros a mostrar.
	$registros = 20;
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
	echo '<h2>Administraci&oacute;n de usuarios</h2>';
	$resultados = mysqli_query($con,"SELECT * FROM estudiantes ");
	//Contamos la cantidad de filas entregadas por la consulta, de esta forma sabemos cuantos registros fueron retornados por la consulta.
	$total_registros = mysqli_num_rows($resultados); 
	//Generamos otra consulta la cual creara en si la paginación, ordenando y creando un límite en las consultas.
	if($_GET['orden']=="sem"){
			$resultados = mysqli_query($con,"SELECT * FROM estudiantes  ORDER BY semestre ASC LIMIT $inicio, $registros");  
	}else if($_GET['orden']=="nom"){
		$resultados = mysqli_query($con,"SELECT * FROM estudiantes  ORDER BY nombre ASC LIMIT $inicio, $registros");  
	}else if($_GET['orden']=="pre"){
		$resultados = mysqli_query($con,"SELECT * FROM estudiantes  ORDER BY preinscribe ASC LIMIT $inicio, $registros");  
	}else if($_GET['orden']=="act"){
		$resultados = mysqli_query($con,"SELECT * FROM estudiantes  ORDER BY activo ASC LIMIT $inicio, $registros");  
	}
	
		
	$regcon=ceil($total_registros/$registros);
	// Este ciclo se utiliza para almacenar los valores del registro inicial y final por página
			for ($o=1;$o<=$regcon;$o++){
				$limiteinf=(($o-1)*$registros);
				$limitesup=(($o)*$registros)-1;
				if($_GET['orden']=="sem"){
					$primera[$o]= mysqli_query($con,"SELECT * FROM estudiantes  ORDER BY semestre ASC LIMIT $limiteinf, 1");  
					$ultima[$o]= mysqli_query($con,"SELECT * FROM estudiantes  ORDER BY semestre ASC LIMIT $limitesup,1");  
				}else if($_GET['orden']=="nom"){
					$primera[$o]= mysqli_query($con,"SELECT * FROM estudiantes  ORDER BY nombre ASC LIMIT $limiteinf, 1");  
					$ultima[$o]= mysqli_query($con,"SELECT * FROM estudiantes  ORDER BY nombre ASC LIMIT $limitesup,1");  
				}else if($_GET['orden']=="pre"){
					$primera[$o]= mysqli_query($con,"SELECT * FROM estudiantes  ORDER BY preinscribe ASC LIMIT $limiteinf, 1");  
					$ultima[$o]= mysqli_query($con,"SELECT * FROM estudiantes  ORDER BY preinscribe ASC LIMIT $limitesup,1");  
				}else if($_GET['orden']=="act"){
					$primera[$o]= mysqli_query($con,"SELECT * FROM estudiantes  ORDER BY activo ASC LIMIT $limiteinf, 1");  
					$ultima[$o]= mysqli_query($con,"SELECT * FROM estudiantes  ORDER BY activo ASC LIMIT $limitesup,1");  
					}
					
				$primerap[$o]=mysqli_fetch_array($primera[$o], MYSQLI_ASSOC);
				$ultimap[$o]=mysqli_fetch_array($ultima[$o], MYSQLI_ASSOC);
				
				if($_GET['orden']=="sem"){
					$primerapersona[$o]=$primerap[$o]['semestre'];
					$ultimapersona[$o]=$ultimap[$o]['semestre'];
				}else if($_GET['orden']=="nom"){
					$primerapersona[$o]=$primerap[$o]['nombre'];
					$ultimapersona[$o]=$ultimap[$o]['nombre'];
				}else if($_GET['orden']=="pre"){
					$primerapersona[$o]=$primerap[$o]['preinscribe'];
					$ultimapersona[$o]=$ultimap[$o]['preinscribe'];
				}else if($_GET['orden']=="act"){
					$primerapersona[$o]=$primerap[$o]['activo'];
					$ultimapersona[$o]=$ultimap[$o]['activo'];
				}
			}
			//Con ceil redondearemos el resultado total de las paginas 4.53213 = 5
			$total_paginas = ceil($total_registros / $registros);                 
			echo '<form name="editar" method="POST" action="administer.php?option=5"><table border=0 width=100%>';
			echo '<tr> <th class="Estilot"><a href="administer.php?option=3&orden=sem">Semestre</a></th><th class="Estilot"><a href="administer.php?option=3&orden=nom">Nombre</a></th><th class="Estilot"><a href="administer.php?option=3&orden=pre">Preinscribe</a></th><th class="Estilot"><a href="administer.php?option=3&orden=act">Activo</a></th><th class="Estilot">Rol</th><th class="Estilot">Editar</th></tr>';			
			// Si tenemos un retorno en la variable $total_registro iniciamos el ciclo para mostrar los datos.
			if ($total_registros) {
				while ($personas = mysqli_fetch_array($resultados, MYSQLI_ASSOC)) {
					echo '<tr>';
					echo '<td class="Estilol">'.$personas['semestre'].'</td>';
					echo '<td class="Estilol">'.$personas['nombre'].'</td>';
					echo '<td class="Estilol">'.$personas['preinscribe'].'</td>';
					echo '<td class="Estilol">'.$personas['activo'].'</td>';
					echo '<td class="Estilol">'.$personas['rol'].'</td>';
					echo '<td align="center"><input type="submit" id="'.$personas['codigo'].'" name="codigoed[]" value="'.$personas['codigo'].'" label="Ed" class="botoned"></button> </td> ';
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
			echo '</table></form> ';
	 
		
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
				echo '<a href="administer.php?option=3&pagina='.($_GET['pagina']-1).'&orden='.$_GET['orden'].'"> <button class="botoned"> << Anterior </button></a>';
			} else {
				echo '<a href="#"><button class="botoned"><< Anterior </button></a>';
			}
			// Generamos el ciclo para mostrar la cantidad de paginas que tenemos.
			for ($i = 1; $i <= $total_paginas; $i++) {
				if ($_GET['pagina'] == $i) {
					echo '<a href="#"> <button class="botoned">'. $_GET['pagina'] .' ('.$ini[$i].$espacio.$fin[$i].')'.'</button> </a> '; 
				} else {
					echo '<a href="administer.php?option=3&pagina='.$i.'&orden='.$_GET['orden'].'"> <button class="botoned">'.$i. ' ('.($ini[$i].$espacio.$fin[$i]).')</button></a>'; 
				}   
			}
			/**
			* Igual que la opción primera de "< Anterior", pero acá para la opción "Siguiente >", si estamos en la ultima pagina no podremos
			* utilizar esta opción.
			*/
			if (($_GET['pagina'] + 1)<=$total_paginas) {
				echo '<a href="administer.php?option=3&pagina='.($_GET['pagina']+1).'&orden='.$_GET['orden'].'" > <button class="botoned">Siguiente >></button></a>';
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