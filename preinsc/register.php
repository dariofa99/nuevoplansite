<?php 
	session_start();
	if(!isset($_SESSION["session_username"])) {
		header("location:login.php");
	} else {
		include("../admin/includes/header_i.php");
		include("../admin/includes/connection.php");
		$username=$_SESSION['session_username'];
?>
<head>


</head>
	<?php 
		if(!isset($_GET['option'])) {
			$opcion=22;;
	} else {
		$opcion=$_GET['option'];
	}
		if (date("n")<8){$semactual='B';}else{$semactual='A';}
//		$semactual='B'; //modificacion temporal
		$aniomas= date("Y");//se agregó temporalmente
		$anio=date("Y"); //se quita temporalmente
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
			case 2
	?>
			<div id="welcome">	
	<?php
	$query =mysqli_query($con,"SELECT * FROM estudiantes "); 
	while($row=mysqli_fetch_assoc($query)){
					
					$dctrl=$row['ctrl'];
				}
				if($dctrl==1){
					include ('logout.php');
				}else{
	
		//$semactual='A';
				echo'
				<script src="jquery/jquery-1.4.2.min.js"></script>
				<script type="text/javascript" src="jquery/jquery.alerts.js"></script>
				<script src="jquery/jquery-1.12.2.min.js"></script>
				<script type="text/javascript" src="jquery/comprobarCreditos.js"></script>
				<link href="jquery/jquery.alerts.css" rel="stylesheet" type="text/css" />  
			';
			echo'
				<style type="text/css">
				.tip{
					background-color: #ffaa11;
					padding: 10px;
					display: none;
					position: absolute;
				}
				</style>
			';
				$materiasob=mysqli_query($con, "SELECT ida2017, a2017, cr2017, crpp, ca2017, prerrequisito FROM  materias WHERE semestre =  '$semactual' or semestre='BA' ORDER BY ca2017 DESC, a2017");
				$materiasel=mysqli_query($con, "SELECT ide, asignatura, creditos, creditospp FROM  electivas WHERE electivas.semestre =  '$semactual' AND electivas.asignatura not in (SELECT materias.a2017 from materias) ORDER BY asignatura");
				if(!isset($_GET['register'])){$codigo='';}else{$codigo=$_GET['register'];}
				
				//$docid=MD5($_POST['password']);
				$estudiante = mysqli_query ($con, "SELECT nombre, codigo FROM estudiantes WHERE codigo = '$codigo'");  
				$rowe = mysqli_fetch_row($estudiante);
				echo '<center><h3>Bienvenido (a)<b> '.$rowe[0].'</b>, este es el sistema de preinscripci&oacute;n de asignaturas para el semestre <b> '.$semactual.$anio.'</b>. Seleccione m&aacute;ximo 20 cr&eacute;ditos</h3>';
				echo '<form name="registrar" method="POST" action="register.php?option=1&vista=0"> <table border=0>';
				echo '<tr> <th class="Estilot">Asignatura</th><th class="Estilot">Cr&eacute;ditos</th><th class="Estilot">Cred. Pr&aacute;c. Ped.</th><th class="Estilot">Condici&oacute;n</th><th class="Estilot">Prerrequisito</th><th class="Estilot">Marcar</th></tr>';
				$j=0;
				$h=0;
				while ($row = mysqli_fetch_row($materiasob)){
					$j=$j+1;
					echo '<tr>';
					for ($i=1;$i<=5;$i++){
						echo '<td class="Estilol">',$row[$i],'</td>';
						$creditos=$row[2];
					}
					echo '<td><input type="checkbox" id="ch'.$j.'" name="box[]" value="'.$row[0].'" class="valorCreditoClass" valor-credito="'.$creditos.'"> </td> ';
					echo '<input type="hidden" id="total" name="total" value=0>';
					echo '<input type="hidden" value="'.$rowe[0].'" name="n_estudiante">';
					echo '<input type="hidden" value="'.$rowe[1].'" name="c_estudiante">';
					//$fechaGuardada = date("Y-n-j H:i:s"); 
					//echo '<input type="hidden" value="'.$fechaguardada.'" name="$ffechaguardada">';
					echo '<input type="hidden" value=0 name="vista">';
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
					echo '<td><input type="checkbox" id="ch'.$j.'" name="box[]" value="'.$row[0].'" class="valorCreditoClass" valor-credito="'.$creditos.'" > </td> ';
					echo '<input type="hidden" id="total" name="total" value=0 > ';
					echo '<input type="hidden" value="'.$rowe[0].'" name="n_estudiante">';
					echo '<input type="hidden" value="'.$rowe[1].'" name="c_estudiante">';
					echo '</tr>';	
				}
				echo '<tr><td colspan="6" align="center"><input type="submit" name="enviar" id ="enviar" value="Enviar" class="boton"> -- <input type="button" name="cancelar" id="cancelar" value="Cancelar" class="boton"></td>
					</tr>
					</table></form><center><a href="logout.php"><Button class="boton">Volver a Ingresar</button></a></center>';
				echo '<div class="tip" id="tip1">Esto es para explicar algo sobre el elemento1</div></center>';	
			}

	?>
			</div>
	<?php
				break;
				//la opcion 22 es la opcion de copia de seguridad pero no está activa
			case 22:
	
				echo '<h3></h3>' ;
				
					//include ('indexport.php');
					
	?>
				</div>
	<?php
				break;
			
		}
		include("../admin/includes/footer.php");
	}
	
?>
