<?php
	if(!isset($_SESSION["session_username"])) {
		header("location:login.php");
	} else {
		?>
<script language="JavaScript"> 
function confirmation() {
    if(confirm("Realmente desea eliminar completamente al usuario?"))
    {
		document.getElementById("eliminar").value=1;
        document.editar.submit();
    }
    return false;
}
</script>
		<?php
		echo '<center>';
			if(!isset($_POST['codigoed'])){
					$checked[]='';
				}else{
					$checked=$_POST['codigoed'];
				}
					foreach($checked as $d){
						$estudiantes=mysqli_query($con, "SELECT * FROM  estudiantes WHERE codigo='$d'");
						echo '<font size=5 color=#626262><b>Edici&oacute;n de usuario</b></font> <font color=#f78d1d size=2>(Si agrega un nuevo usuario, deje el Id vac&iacute;o.) </font></h2>';
						echo'<form name="editar" method="POST" action="administer.php?option=6"><table border=0 >';
						$row = mysqli_fetch_array($estudiantes);
						echo '<tr><td class="Estilot">Id</td><td><input type "text" name="id" value="'.$row['id'].'" size="40" maxlength="40"></td></tr>';
						echo '<tr><td class="Estilot">Usuario</td><td><input type "text" name="codigoe" value="'.$row['codigo'].'" size="40" maxlength="40"></td></tr>';
						echo '<tr><td class="Estilot">Contrase&ntilde;a</td><td><input type="password" name="documentoe" value="'.$row['documento'].'" size= 40></td></tr>';
						echo '<tr><td class="Estilot">Semestre</td><td><input type "text" name="semestree" value="'.$row['semestre'].'" size="40" maxlength="40"></td></tr>';
						echo '<tr><td class="Estilot">Nombre</td><td><input type "text" name="nombree" value="'.$row['nombre'].'" size="40" maxlength="40"></td></tr>';
						echo '<tr><td class="Estilot">Preinscribe</td><td><input type "text" name="preinscribee" value="'.$row['preinscribe'].'" size="40" maxlength="40"></td></tr>';
						echo '<tr><td class="Estilot">Activo</td><td><input type "text" name="activoe" value="'.$row['activo'].'" size="40" maxlength="40"></td></tr>';
						echo '<tr><td class="Estilot">Rol</td><td><input type "text" name="role" value="'.$row['rol'].'" size="40" maxlength="40"></td></tr>';
						echo '<input type="hidden" id="eliminar" name="eliminar" value=0>';
						echo '</table><br><input type="submit" class="boton" value="Actualizar/Agregar"> <input type="Button" class="boton" value="Eliminar completamente" onClick="confirmation()"></form> ';
						
					}
		echo '</center>';
	}
?>