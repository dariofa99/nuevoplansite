<?php
	if(!isset($_SESSION["session_username"])) {
		header("location:login.php");
	} else {
		echo '<center>';
			if(!isset($_POST['codigoed'])){
				$checked[]='';
			}else{
				$checked=$_POST['codigoed'];
			}
				echo '<h2>Edici&oacute;n de usuario	 </h2>';
				$ide=$_POST['id'];
				$codigoe=$_POST['codigoe'];
				$documentoe=$_POST['documentoe'];
				$documentoee=MD5($_POST['documentoe']);
				$semestree=$_POST['semestree'];
				$nombree=$_POST['nombree'];
				$preinscribee=$_POST['preinscribee'];
				$activoe=$_POST['activoe'];
				$role=$_POST['role'];
				$estudiantes=mysqli_query($con, "SELECT * FROM  estudiantes WHERE id='$ide'");
				$row = mysqli_fetch_array($estudiantes);
				if($_POST['eliminar']==1){
					$borrar=mysqli_query($con, "DELETE FROM estudiantes WHERE id='$ide'");
					echo '<p class="Estilot">Eliminado usuario: '.$_POST['codigoe'].'</p>';
				}else{
				if(mysqli_num_rows($estudiantes)>0){
					if($documentoe==$row['documento']){$documentoe=$_POST['documentoe'];}else{$documentoe=MD5($_POST['documentoe']);}
					$actual=mysqli_query($con, "UPDATE estudiantes SET codigo = '$codigoe', documento = '$documentoe', semestre = '$semestree', nombre= '$nombree', preinscribe = '$preinscribee', activo = '$activoe', rol = '$role' WHERE id='$ide'");
					echo '<p class="Estilot">Actualizado usuario: '.$_POST['codigoe'].'</p>';
				}else{
					$agregar=mysqli_query($con, "INSERT INTO estudiantes (codigo, documento, semestre, nombre, preinscribe, activo, rol) VALUES ('$codigoe', '$documentoee', '$semestree', '$nombree', '$preinscribee', '$activoe', '$role')");
					echo '<p class="Estilot">Agregado usuario: '.$_POST['codigoe'].'</p>';
				}
				}
		echo '</center>';
		}
?>