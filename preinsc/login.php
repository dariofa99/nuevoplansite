<?php
	session_start();
	require_once("../admin/includes/connection.php");
	include("../admin/includes/header_i.php");
	if(isset($_SESSION["session_username"])){
		// echo "Session is set"; // for testing purposes
		header("Location: register.php?option=2");
	}
	if(isset($_POST["login"])){
		if(!empty($_POST['username']) && !empty($_POST['password'])) {
			$username=$_POST['username'];
			$password=MD5($_POST['password']);
			$query =mysqli_query($con,"SELECT * FROM estudiantes WHERE codigo = '$username' AND documento = '$password' AND activo='1' AND rol='estudiante' AND preinscribe='0'"); 
			//$numrows=mysqli_num_rows($query);
			if(mysqli_num_rows($query)>0){
				while($row=mysqli_fetch_assoc($query)){
					$dbusername=$row['codigo'];
					$dbpassword=$row['documento'];
				}
				if($username == $dbusername && $password == $dbpassword){
					$_SESSION['session_username']=$username;
					/* Redirecciona sitio */
					header('Location: register.php?option=2&register='.$username);
				}
			} else {
				$message =  "Nombre de usuario o contrase&ntilde;a invalida o Ya hizo el proceso una vez.";
			}
		} else {
			$message = "Todos los campos son requeridos!";
		}
	}
?>
	<div class="container mlogin">
		<div id="login">
			<h1>Preinscripci&oacute;n</h1>
			<form name="loginform" id="loginform" action="" method="POST">
				<p>	<label for="user_login">Nombre De Usuario<br />
					<input type="text" name="username" id="username" class="input" value="" size="20" /></label>
				</p>
				<p>
					<label for="user_pass">Contrase&ntilde;a<br />
					<input type="password" name="password" id="password" class="input" value="" size="20" /></label>
				</p>
				<p class="submit">
					<input type="submit" name="login" class="button" value="Entrar" />
				</p>
				<!-- <p class="regtext">No estas registrado? <a href="register.php" >Registrate Aqu&iacute;</a>!</p> -->
			</form>
		</div>
    </div>
<?php 
	include("../admin/includes/footerc_i.php");
	if (!empty($message)) {echo '<p class="error">'.$message.'</p>';} 
?>
	