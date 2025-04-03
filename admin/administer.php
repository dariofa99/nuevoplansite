<?php 
	session_start();
	if(!isset($_SESSION["session_username"])) {
		header("location:login.php");
	} else {
		include("includes/header.php");
		include("includes/connection.php");
		$username=$_SESSION['session_username'];
?>
<head>


</head>
	<div class="menu_bar">
			<a href="#" class="bt-menu"><span class="icon-menu"></span>Menu</a>
	</div>
	<header>
	
		<div id="header">
			<nav>
				<ul class="navi" >
					
                    <li><a href="administer.php?option=1" class="icon-newspaper"> Consultar Asign. inscritas</a></li>
					<li><a href="administer.php?option=2" class="icon-users"> Consultar usuarios inscritos</a></li>
					<li><a href="administer.php?option=3&orden=nom" class="icon-wrench"> Administrar usuarios</a></li>
					<li><a href="#" class="icon-cog"> Men&uacute; <b><?php echo $username;?></b></a>
					<ul>						
							<li> <a href="bcinscritas.php">BackUp Inscritos </a></li>
							<li> <a href="bcusuarios.php">BackUp Usuarios</a></li>
							<li> <a href="bcobligatorias.php">BackUp Obligatorias </a> </li>
							<li> <a href="bcelectivas.php">BackUp Electivas</a></li>
							<li> <a href="administer.php?option=27" onClick ="return confirm('Seguro que quiere eliminar todos los datos inscritos?');">Limpiar BD</a></li>
							
							<?php 
							$query =mysqli_query($con,"SELECT * FROM estudiantes "); 
							while($row=mysqli_fetch_assoc($query)){
								$dctrl=$row['ctrl'];
							}?>
							<li> <a href="administer.php?option=28"> 
							<?php 
							if($dctrl==1){
								echo 'Poner Preinscr. Online';
							}else{
								echo 'Poner Preinscr. Offline';
							}	?>	
								</a>
							</li>
							
					
							<li> <a href="logout.php">Cerrar sesi&oacute;n</a></li>
						
					</ul>
					</li>
				</ul> 
			</nav>
		</div>
	</header>	

	<?php 
		if(!isset($_GET['option'])) {
			$opcion=22;;
	} else {
		$opcion=$_GET['option'];
	}
		if (date("n")<8){$semactual='B';}else{$semactual='A';}
	//$semactual='B'; //modificación temporal
	$anio=date("Y");
	$aniomas= date("Y");//se agregó temporalmente
      //$anio=date("Y"); //se quita temporalmente
         $anio = strtotime ("+1 year", strtotime($aniomas)); //se agregó temporalmente
        $anio= date("Y", $anio); //se agregó temporalmente

		switch ($opcion) {
			// opcion 1 es consultar asignaturas
			case 1: 
	?>
				<div id="welcome">	
	<?php				
			include('opcion1.php');
	?>	
				</div>
	<?php
				break;
			//Opcion 2 es administrar cada iscrito y borrarlo con opcion 7	
			case 2:
	?>
				<div id="welcome">	
	<?php
			
				include('opcion2.php');
			
	?>
				</div>
	<?php
				break;
			//Opcion 3 es administrar usuarios
			case 3:
	?>
				<div id="welcome">	
	<?php
				include('opcion3.php');
	?>
				</div>
	<?php
				break;
			//la opcion 4 es ver datos después de consultar en la opcion 1 de asig. inscritas
			case 4:
	?>
				<div id="welcome">	
	<?php
				include ('opcion4.php');
	?>
				</div>
	<?php
				break;
			//la opcion 5 es editar datos de usuarios después de consultar en la opcion 3
			case 5:
	?>
				<div id="welcome">	
	<?php
					include ('opcion5.php');
	?>
				</div>
	<?php
				break;
			//la opcion 6 es grabar - actualizar datos de usuarios después de entrar a editar en la opcion 5
			case 6:
	?>
				<div id="welcome">	
	<?php
					include ('opcion6.php');
					
	?>
				</div>
	<?php
				break;
			//la opcion 7 elimina un usuario de preinscripcion después de opcion 2 y actualiza tabla de estudiantes para que vuelva a preinscribir
			case 7:
	?>
				<div id="welcome">	
				
	<?php	
					include ('opcion7.php');
					
	?>
				</div>
	<?php
				break;
			//la opcion 21 es la opcion 2 pero agrupados
			case 21:
	?>
				<div id="welcome">	
	<?php
					include ('opcion2p.php');
					
	?>
				</div>
	<?php
				break;
			//la opcion 22 es la opcion de copia de seguridad pero no está activa
			case 22:
	?>
				<div id="welcome" align="center">	
	<?php
				echo '<h3>Exportar <a href=administer.php?option=23>Inscritos</a></h3>' ;
				echo '<h3>Exportar <a href=administer.php?option=24>Usuarios</a></h3>' ;
				echo '<h3>Exportar <a href=administer.php?option=25>Asignaturas Obligatorias</a></h3>' ;
				echo '<h3>Exportar <a href=administer.php?option=26>Asignaturas electivas</a></h3>' ;
				
					//include ('indexport.php');
					
	?>
				</div>
	<?php
				break;
			//la opcion 23 exporta m_inscritas
			case 23:
	?>
				<div id="welcome">	
	<?php
					include ('eminscritas.php');
					
	?>
				</div>
	<?php
				break;
			//la opcion 24 exporta estudiantes
			case 24:
	?>
				<div id="welcome">	
	<?php
					include ('eestudiantes.php');
					
	?>
				</div>
	<?php
				break;
			//la opcion 25 exporta obligatorias
			case 25:
	?>
				<div id="welcome">	
	<?php
					include ('eobligatorias.php');
					
	?>
				</div>
	<?php
				break;
			//la opcion 26 exporta electivas
			case 26:
	?>
				<div id="welcome">	
	<?php
					include ('eelectivas.php');
					
	?>
				</div>
	<?php
				break;
			//la opcion 27 borra la base de datos de inscritos
			case 27:
	?>
				<div id="welcome">	
	<?php
					include ('purgar.php');
					
	?>
				</div>
	<?php
				break;
			//la opcion 28 inicia o finaliza proceso de inscripción
			case 28:
	?>
				<div id="welcome">	
	<?php
					include ('proceso.php');
					
	?>
				</div>
	<?php
				break;
		}
		include("includes/footer.php");
	}
	
?>
