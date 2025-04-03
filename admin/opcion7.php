<?php
	if(!isset($_SESSION["session_username"])) {
		header("location:login.php");
	} else {
	?>

<?php
		echo '<center>';
			if(!isset($_POST['codigoed'])){
				$checked[]='';
			}else{
				$checked=$_POST['codigoed'];
			}
				echo '<h2>Edici&oacute;n de usuario </h2>';

				foreach($checked as $d){
				//$codigoed=$_POST['codigoed'];
				$estudiantes=mysqli_query($con, "SELECT * FROM  m_inscritas WHERE codigo='$d'");
				$row = mysqli_fetch_array($estudiantes);
				if(mysqli_num_rows($estudiantes)>0){
					$borrar=mysqli_query($con, "DELETE FROM m_inscritas WHERE codigo='$d'");
					echo '<p >Eliminados los datos de preincripci&oacute;n del usuario <b class="Estilot"> '.$d.'</b>. Vuelva a preinscribir.</p>';
					$actual=mysqli_query($con, "UPDATE estudiantes SET  preinscribe = 0 WHERE codigo='$d'");
					echo '<p >Actualizado usuario<b class="Estilot"> '.$d.'</b> para que vuelva a preinscribir </p>';
				}
				}
				
		echo '</center>';
		}
?>