<?php
	if(!isset($_SESSION["session_username"])) {
		header("location:login.php");
	} else {
		echo '<center>';
				echo '<h2>Consulta por asignatura, para semestre: '.$semactual.$anio.'</h2>';
				if(!isset($_POST['box'])){
					$checked[]='';
				}else{
					$checked=$_POST['box'];
				}
				$h=0;
				$total=0;
				$inscritos=0;
				$fecha=date("Y-m-d h:i:s");
				echo '<table border=0 width=100%>';
				echo '<tr> <th class="Estilot">Asignatura</th><th class="Estilot">Cr&eacute;ditos</th><th class="Estilot">Cred. Pr&aacute;c. Ped.</th><th class="Estilot">Condici&oacute;n</th><th class="Estilot">Inscritos</th></tr>';
				if (!isset($_POST['box'])){
					
					$inscritas=mysqli_query($con, "SELECT asignatura,creditos,creditospp,condicion,COUNT(*) as numero FROM m_inscritas GROUP BY asignatura, creditos, creditospp, condicion order by numero desc");
					if(mysqli_num_rows($inscritas)>0){
						while ($row = mysqli_fetch_row($inscritas)){
							echo '<tr>';
							foreach($row as $clave) {
								echo '<td class="Estilol">'.$clave.'</td>';
							}
							//echo '<td class="Estilol"> '.$cadauna[0].'</td>';
							echo '</tr>';	
							//$inscritos=$cadauna[0]+$inscritos;
						}
					}				
				}else{
				
					foreach($checked as $d){
					$inscritas=mysqli_query($con, "SELECT asignatura,creditos,creditospp,condicion,COUNT(*) as numero FROM m_inscritas WHERE asignatura='$d' GROUP BY asignatura, creditos, creditospp, condicion order by numero desc");
					//$cantidad=mysqli_query($con, "SELECT COUNT(asignatura) as numero FROM m_inscritas WHERE asignatura='$d' order by numero desc");
					//$cadauna = mysqli_fetch_array($cantidad); 
					if(mysqli_num_rows($inscritas)>0){
						while ($row = mysqli_fetch_row($inscritas)){
							echo '<tr>';
							foreach($row as $clave) {
								echo '<td class="Estilol">'.$clave.'</td>';
							}
							//echo '<td class="Estilol"> '.$cadauna[0].'</td>';
							echo '</tr>';	
							//$inscritos=$cadauna[0]+$inscritos;
						}
					}				
					}
				}
				$estudinscritos=mysqli_query($con, "SELECT estudiante, COUNT(1) AS total FROM m_inscritas GROUP BY estudiante HAVING COUNT(1) > 0");
				$totale= mysqli_num_rows($estudinscritos);
				$usuarios = mysqli_query($con,"SELECT * FROM estudiantes WHERE activo=1");
				//Contamos la cantidad de filas entregadas por la consulta, de esta forma sabemos cuantos registros fueron retornados por la consulta.
				$total_usuarios = mysqli_num_rows($usuarios)-1		; 
				echo '<tr><td class="Estilot" colspan=5 align="right"> Inscritos en total: '.$totale.' de '.$total_usuarios.' estudiantes.';
				echo '</table>';
		echo '</center>';
	}
?>
