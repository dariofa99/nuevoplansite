<html>
<meta content="text/html;"  charset="utf-8;">
<link rel="stylesheet" href="simulador.css" type="text/css">
<link href="info.ico" rel="shortcut icon">
<head>
<title>
Estudio acad�mico actual - Lic. Inform�tica
</title>
<script> 
function marcar(obj) { 
    elem=obj.elements; 
    for (i=0;i<elem.length;i++) 
        if (elem[i].type=="checkbox") 
            elem[i].checked=true; 
} 
</script> 
</head>
<body bgcolor=#BDC3CD>
<center>
<table border=0 width=85% cellpadding="0" cellspacing="5" bgcolor="white">
<tr>
<td align="center" width=25%><img src="logou.jpg" width=130 height=120 ></td>
<td  align="center" width=50%><h2>FORMULARIO DE AN&Aacute;LISIS DE SITUACI&Oacute;N ACAD&Eacute;MICA ACTUAL</h2></td>
<td align="center"width=25%><img src="logo.jpg" width=120 height=90 ></td>
</tr>
<tr> 
<td colspan=3 >
 
<form name="Fsimular" method="POST" action="analisis.php">
<table width=80% border=1 cellpadding="1" cellspacing="1" align="center" bordercolor=#BDC3CD>
  <tr>
   <td width="10" colspan="3" align="center"><b>Seleccione las asignaturas que ha cursado y aprobado en su plan actual - - - -</b> <input type="button" value="chequear todo" onclick="marcar(this.form)" /> - - - -<input type="reset" name="cancelar" value="Cancelar"> </td>
   </tr>
<?php
require_once("admin/includes/connection.php");
//include("conexion.php");
$largo=mysqli_query($con, "SELECT COUNT(sema2017) FROM  materias WHERE ca2017 ='OBLIGATORIA'");
$count = mysqli_fetch_array($largo); 
$j=0;	
$fila=0;
for ($i=1;$i<=10;$i++){
	$result=mysqli_query($con, "SELECT COUNT( sema2017 ) FROM  materias WHERE (ca2017 =  'OBLIGATORIA' AND sema2017 ='$i')");
	$count2 = mysqli_fetch_array($result); 
	$materias=mysqli_query($con, "SELECT a2017 FROM  materias WHERE ca2017 =  'OBLIGATORIA' AND sema2017 ='$i'");
	echo '<tr>';
	if ($fila==0){
		echo '<td rowspan=',$count2[0]+1,'> SEMESTRE ',$i,'</td>';
		$fila=1;
		while ($row = mysqli_fetch_row($materias)){
		
		foreach($row as $clave) {
			echo '<tr>';
			echo '<td>',$clave,'</td>';
			if($j<=$count[0]){$j=$j+1;}else{$j=0;}
			$nombre='a2010'.$j;
			if ($j<10){
				$valor='a0'.$j;
				}else{
				$valor='a'.$j;
				}
			echo '<td><input type="checkbox" name="',$nombre,'" value="',$valor,'"></td> ';
			echo '</tr>';	
			
			}
		
		}
	echo '</tr>';
	}else{
		echo '<td rowspan=',$count2[0]+1,' bgcolor=#BDC3CD> SEMESTRE ',$i,'</td>';
		$fila=0;
	
	while ($row = mysqli_fetch_row($materias)){
		
		foreach($row as $clave) {
			echo '<tr>';
			echo '<td bgcolor=#BDC3CD>',$clave,'</td>';
			if($j<=$count[0]){$j=$j+1;}else{$j=0;}
			$nombre='a2010'.$j;
			if ($j<10){
				$valor='a0'.$j;
				}else{
				$valor='a'.$j;
				}
			echo '<td bgcolor=#BDC3CD><input type="checkbox" name="',$nombre,'" value="',$valor,'"></td> ';
			echo '</tr>';	
			
			}
		
		}
	echo '</tr>';
	}
	}
	
 ?>
  
<tr>
<?php
$num_electivas=mysqli_query($con, "SELECT * FROM electivas");
$contar_elec=mysqli_num_rows($num_electivas);

?>
 <td rowspan=<?php echo $contar_elec+1; ?>>ELECTIVAS</td>

<?php 
$electivas=mysqli_query($con, "SELECT * FROM electivas");
	while($elec=mysqli_fetch_array($electivas)){
	echo "<tr><td>";
	echo $elec["asignatura"];
	echo "</td><td><input type='checkbox'></td></tr>";

	}
?>





</tr>
 
 
 <td rowspan=8>ASIG. GLOBALES</td>
	<td >Formaci&oacute;n Human&iacute;stica 1 (2c)</td>
	<td><input type="checkbox" name="a201031" value="a31"></td>
<tr>
	<td >Formaci&oacute;n Human&iacute;stica 2 (2c)</td>
	<td><input type="checkbox" name="a201032" value="a32"></td>
</tr>
<tr>
	<td >Formaci&oacute;n Human&iacute;stica 3 (2c)</td>
	<td><input type="checkbox" name="a201033" value="a33"></td>
</tr>
<tr>
	<td >Formaci&oacute;n Human&iacute;stica 4 (2c)</td>
	<td><input type="checkbox" name="a201034" value="a34"></td>
</tr>
</tr>	
 <tr>
	<td >Lectura y producci&oacute;n de textos 1 (1c)</td>
	<td><input type="checkbox" name="a201035" value="a35"></td>
</tr>
<tr>
	<td >Lectura y producci&oacute;n de textos 2 (1c)</td>
	<td><input type="checkbox" name="a201036" value="a36"></td>
 </tr>
 </tr>
  
  <tr>
	<td >Idioma extranjero 1 (4c)</td>
	<td><input type="checkbox" name="a201037" value="a37"></td>
</tr>
<tr>
	<td >Idioma extranjero 2 (4c)</td>
	<td><input type="checkbox" name="a201038" value="a38"></td>
</tr>
  </tr>
	
 
  <tr>
   <td colspan="3" align="center"><input type="submit" name="enviar" value="Enviar" ><input type="reset" name="cancelar" value="Cancelar"><input type="button" value="chequear todo" onclick="marcar(this.form)" /> </td>
  </tr>
 <input type="hidden" name="tipof" value="nuevo">
</table>
</form>

</td>
</tr>
</table>
<center><P class="Estilolpie"> Dise&ntilde;o del simulador: Jos&eacute; Luis Romo G. - Coord. Licenciatura en Inform&aacute;tica <br> cel:3156610274<br>mail:rhomojose@yahoo.es</P></center>


</center>
</body>
</html>
