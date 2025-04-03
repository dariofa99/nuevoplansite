<?php
	if(!isset($_SESSION["session_username"])) {
		header("location:login.php");
	} else {
	?>

<?php
		echo '<center>';
				$datos=mysqli_query($con, "SELECT * FROM  m_inscritas");
				$row = mysqli_fetch_array($datos);
				if(mysqli_num_rows($datos)>0){
					$limpiar=mysqli_query($con, "DELETE FROM m_inscritas");
					echo '<p >Eliminados todos los datos de preincripci&oacute;n. Se inicia proceso para el nuevo semestre.</p>';
					$actualizar=mysqli_query($con, "UPDATE estudiantes SET  preinscribe = 0 WHERE 1");
					echo '<p >Los estudiantes pueden volver a preinscribir para el nuevo semestre. </p>';
				}else{
					echo 'No hay datos de preinscripciones';
				}
				
				
		echo '</center>';
		}
?>