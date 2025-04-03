<?php
//session_start();
if(!isset($_SESSION["session_username"])) {
		header("location:login.php");
	} else {
		//include('includes/connection.php');
		$queryctrl =mysqli_query($con,"SELECT * FROM estudiantes "); 
		while($row=mysqli_fetch_assoc($queryctrl)){
			$dctrl=$row['ctrl'];
		}
		if ($dctrl==0){
			$queryf = mysqli_query($con,"UPDATE estudiantes SET ctrl=1 WHERE 1");
			//echo '<center>Proceso para preinscribir finalizado</center> ';
		}else{
			$queryf =mysqli_query($con, "UPDATE estudiantes SET ctrl=0 WHERE 1");
			//echo '<center>Proceso para preinscribir iniciado</center> ';
		}
			header("location:administer.php?option=2");
	}
?>
