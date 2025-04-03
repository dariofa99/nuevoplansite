<?php
if (!isset($_REQUEST['tipof'])) $_POST['tipof'] = "antiguo";
echo '<meta content="text/html;"  charset="utf-8;">';
header('Content-Type: text/html; charset=utf-8');
echo '<link rel="stylesheet" href="estiloA.css" type="text/css">';
echo '<link href="info.ico" rel="shortcut icon">';

if ($_POST['tipof'] == "antiguo") {
	echo '<title> Simulaci&oacute;n de paso a nuevo plan - Lic. Inform&aacute;tica </title>';
} else {
	echo '<title> An&aacute;lisis de la situaci&oacute;n Acad&eacute;mica - Lic. Inform&aacute;tica </title>';
}
require_once("admin/includes/connection.php");
//include("conexion.php");
$numerocreditosmateoblig = 126;
$numerocreditosmateelect = 34;
$numerocreditopracpedag = 50;

$credobligaprobados = 0;
$credoprpedgaprobados = 0;

$credobligpendientes = 0;
$credoprpedgpendientes = 0;

$credelectaprobados = 0;
$credelectprpedgaprobados = 0;

$ctotadatoscomp1 = 0;
$ctotadatoscomp2 = 0;
$ctotadatoscomp3 = 0;
//echo $_POST['a201049'];

if ($_POST['tipof'] == "antiguo") {
	$result = mysqli_query($con, "SELECT * from materias");
} else {
	if (isset($_POST['oblig']) && is_array($_POST['oblig']) && count($_POST['oblig']) > 0) {
		// Escapamos y convertimos el array a una cadena de valores separados por comas
		$ids = implode(",", array_map('intval', $_POST['oblig']));
		// Construimos la consulta con IN()
		$sql = "SELECT * FROM materias WHERE id IN ($ids)
		AND ca2017 = 'OBLIGATORIA' 
        ORDER BY semestre ASC, a2017 ASC";
		// Ejecutamos la consulta
		$obligatorias_cursadas = mysqli_query($con, $sql);
	} else {
	}
}
if ($_POST['tipof'] == "antiguo") {
	echo '<div align="center"><center><table border="0" cellpadding="10" cellspacing="0" width=80%><tr><td width=25% align="center"><img src="logou.jpg" width=130 height=120></td> <td width=50% align="center"><h2>ESTUDIO ORIENTATIVO DE SU HOJA DE VIDA ACAD&Eacute;MICA PARA CAMBIO DE PLAN </h2></td><td width=25% align="center"><img src="logo.gif" width=120 height=90></td> </tr></table> </center></div>';
} else {
	echo '<div align="center"><center><table border="0" cellpadding="10" cellspacing="0" width=80%><tr><td width=25% align="center"><img src="logou.jpg" width=130 height=120></td> <td width=50% align="center"><h2>AN&Aacute;LISIS DE SU VIDA ACAD&Eacute;MICA ACTUAL</h2></td><td width=25% align="center"><img src="logo.gif" width=120 height=90></td> </tr></table> </center></div>';
}

if ($_POST['tipof'] == "antiguo") {
	echo '<P ALIGN="CENTER" class="Estilotp" ><B><BR> ASIGNATURAS APROBADAS EN EL PLAN ANTERIOR</B></P>';
} else {
	echo '<P ALIGN="CENTER" class="Estilotp" ><B><BR> ASIGNATURAS OBLIGATORIAS APROBADAS AL MOMENTO</B></P>';
}
echo '<center>';
echo "<table border = '0' width=80% >";
echo '<tr > ';
echo '<td width=30% align="center" class="Estilot"><b> Asignatura</b></td> ';
echo '<td width=10% align="center" class="Estilot"><b> Estado</b></td> ';
echo '<td width=10% align="center" class="Estilot"><b> Tipo de Asignatura</b></td> ';
echo '<td width=10% align="center" class="Estilot"><b> Cr&eacute;ditos aprobados</b></td> ';
echo '<td width=10% align="center" class="Estilot"><b> Cr&eacute;ditos de prac. ped.</b></td> ';
echo '</tr> ';
if (isset($obligatorias_cursadas)) {
	while ($row = mysqli_fetch_assoc($obligatorias_cursadas)) {
		$credobligaprobados += intval($row['cr2017']);
		$credoprpedgaprobados += intval($row['crpp']);
		if ($row['componente'] == 'C1') $ctotadatoscomp1 += intval($row['cr2017']);
		if ($row['componente'] == 'C2') $ctotadatoscomp2 += intval($row['cr2017']);
		if ($row['componente'] == 'C3' || $row['componente'] == 'C4') $ctotadatoscomp3 += intval($row['cr2017']);

		echo '<tr > ';
		echo '<td class="Estilol">', $row['a2017'], '</td>';
		echo '<td class="Estilol">APROBADA</td>';
		echo '<td class="Estilol">', $row['ca2017'], '</td>';
		echo '<td class="Estilol">', $row['cr2017'], '</td>';
		echo '<td class="Estilol">', $row['crpp'], '</td>';
		echo '</tr> ';
		//var_dump($row);
	}
	echo '<tr> <td colspan=3 class="Estilot" align="right">Totales</td> <td class="Estilot">', $credobligaprobados, '</td> <td class="Estilot">', $credoprpedgaprobados, ' </td></tr>';
} else {
	echo "<td colspan='5' class='Estilol'> No se han marcado materias cursadas</td>";
}

echo '</table>';

echo '<P ALIGN="CENTER" class="Estilotp"><B><BR> <BR> ASIGNATURAS OBLIGATORIAS PENDIENTES</B></P>';

if (isset($_POST['oblig']) && is_array($_POST['oblig']) && count($_POST['oblig']) > 0) {
	// Escapamos y convertimos el array a una cadena de valores separados por comas
	$ids = implode(",", array_map('intval', $_POST['oblig']));
	// Construimos la consulta con IN()
	$sql = "SELECT * FROM materias 
        WHERE id NOT IN ($ids) 
        AND ca2017 = 'OBLIGATORIA' 
        ORDER BY semestre ASC, a2017 ASC";;
	// Ejecutamos la consulta
	$oblig_pend = mysqli_query($con, $sql);
} else {

	$sql = "SELECT * FROM materias 
        WHERE ca2017 = 'OBLIGATORIA' 
        ORDER BY semestre ASC, a2017 ASC";;
	// Ejecutamos la consulta
	$oblig_pend = mysqli_query($con, $sql);
}

echo '<center><table border = "0" width=80% >';
echo '<tr> ';
echo '<td width=30% align="center" class="Estilot"><b> Asignatura</b></td> ';
echo '<td width=15% align="center" class="Estilot"><b> Estado</b></td> ';
echo '<td width=15% align="center" class="Estilot"><b> Tipo de Asignatura</b></td> ';
echo '<td width=8% align="center" class="Estilot"><b> N&uacute;mero de Cr&eacute;ditos </b></td> ';
echo '<td width=8% align="center" class="Estilot"><b> Cr&eacute;ditos de prac. ped.</b></td> ';
echo '<td width=8% align="center" class="Estilot"><b> Semestre en que se ofrece</b></td> ';
echo '<td width=16% align="center" class="Estilot"><b> Prerrequisito</b></td> ';
echo '</tr> ';

while ($row = mysqli_fetch_assoc($oblig_pend)) {
	$credobligpendientes += intval($row['cr2017']);
	$credoprpedgpendientes += intval($row['crpp']);
	echo '<tr>';
	echo "<td class='Estilol'>{$row['a2017']}</td>";
	echo "<td class='Estilol'>PENDIENTE</td>";
	echo '<td class="Estilol">', $row['ca2017'], '</td>';
	echo '<td class="Estilol">', $row['cr2017'], '</td>';
	echo '<td class="Estilol">', $row['crpp'], '</td>';
	echo '<td class="Estilol">', $row['semestre'], '</td>';
	echo '<td class="Estilol">', $row['prerrequisito'], '</td>';
	echo '</tr>';
}
echo '<tr> <td colspan=3 class="Estilot" align="right">Totales</td> <td class="Estilot">', $credobligpendientes, '</td> <td class="Estilot">', $credoprpedgpendientes, ' </td><td colspan=2> </td></tr>';
echo '</table>';
///////////////////////ELECTIVAS///////////////////////////////////////////////////////////////////////
if ($_POST['tipof'] == "antiguo") {
	$result = mysqli_query($con, "SELECT * from electivas");
} else {
	if (isset($_POST['elect']) && is_array($_POST['elect']) && count($_POST['elect']) > 0) {
		// Escapamos y convertimos el array a una cadena de valores separados por comas
		$ids = implode(",", array_map('intval', $_POST['elect']));
		// Construimos la consulta con IN()
		$sql = "SELECT * FROM electivas WHERE id IN ($ids)";
		// Ejecutamos la consulta
		$electivas_cursadas = mysqli_query($con, $sql);
	}
	//$consulta = "SELECT * from materias where ca2017='OBLIGATORIA' order by ida2017";
	//$result = mysqli_query($con, $consulta);
	//var_dump($result);
}
if ($_POST['tipof'] == "antiguo") {
	echo '<P ALIGN="CENTER" class="Estilotp" ><B><BR> ASIGNATURAS APROBADAS EN EL PLAN ANTERIOR</B></P>';
} else {
	echo '<P ALIGN="CENTER" class="Estilotp" ><B><BR> ASIGNATURAS ELECTIVAS APROBADAS AL MOMENTO</B></P>';
}
echo '<center>';
echo "<table border = '0' width=80% >";
echo '<tr > ';
echo '<td width=30% align="center" class="Estilot"><b> Asignatura</b></td> ';
echo '<td width=10% align="center" class="Estilot"><b> Estado</b></td> ';
echo '<td width=10% align="center" class="Estilot"><b> Tipo de Asignatura</b></td> ';
echo '<td width=10% align="center" class="Estilot"><b> Cr&eacute;ditos aprobados</b></td> ';
echo '<td width=10% align="center" class="Estilot"><b> Cr&eacute;ditos de prac. ped.</b></td> ';
echo '</tr> ';
if (isset($electivas_cursadas)) {
	while ($row = mysqli_fetch_assoc($electivas_cursadas)) {
		$credelectaprobados += intval($row['creditos']);
		$credelectprpedgaprobados += intval($row['creditospp']);
		if ($row['componente'] == 'C1') $ctotadatoscomp1 += intval($row['creditos']);
		if ($row['componente'] == 'C2') $ctotadatoscomp2 += intval($row['creditos']);
		if ($row['componente'] == 'C3' || $row['componente'] == 'C4') $ctotadatoscomp3 += intval($row['creditos']);

		echo '<tr > ';
		echo '<td class="Estilol">', $row['asignatura'], '</td>';
		echo '<td class="Estilol">APROBADA</td>';
		echo '<td class="Estilol">ELECTIVA</td>';
		echo '<td class="Estilol">', $row['creditos'], '</td>';
		echo '<td class="Estilol">', $row['creditospp'], '</td>';
		echo '</tr> ';
		//var_dump($row);
	}
	echo '<tr> <td colspan=3 class="Estilot" align="right">Totales</td> <td class="Estilot">', $credelectaprobados, '</td> <td class="Estilot">', $credelectprpedgaprobados, ' </td></tr>';
} else {
	echo '<td colspan="5" class="Estilol">No se han marcado electivas cursadas</td>';
}

echo '</table>';

echo '<P ALIGN="CENTER" class="Estilotp"><B><BR> <BR>USTED TIENE LAS SIGUIENTES ELECTIVAS PARA ESCOGER</B></P>';
if ($_POST['tipof'] == "antiguo") {
	$resulttemp3 = mysqli_query($con, "SELECT asignatura,creditos,creditospp, semestre from electivas WHERE ide NOT IN (SELECT idc  FROM cursadas where validapor='ELECTIVA') ORDER BY semestre,asignatura");
} else {
	if (isset($_POST['elect']) && is_array($_POST['elect']) && count($_POST['elect']) > 0) {
		// Escapamos y convertimos el array a una cadena de valores separados por comas
		$ids = implode(",", array_map('intval', $_POST['elect']));
		// Construimos la consulta con IN()
		$sql = "SELECT * FROM electivas WHERE id not IN ($ids)";
		// Ejecutamos la consulta
		$electivas_pend = mysqli_query($con, $sql);
	} else {

		$sql = "SELECT * FROM electivas";
		// Ejecutamos la consulta
		$electivas_pend = mysqli_query($con, $sql);
	}
}

echo '<center><table border = "0" width=80%>';
echo '<tr > ';
echo '<td width=50% align="center" class="Estilot"><b> Asignatura</b></td> ';
echo '<td width=15% align="center" class="Estilot"><b> N&uacute;mero de Cr&eacute;ditos </b></td> ';
echo '<td width=15% align="center" class="Estilot"><b> Cr&eacute;ditos de prac. ped.</b></td> ';
echo '<td width=20% align="center" class="Estilot"><b> Semestre en que se ofrece</b></td> ';
echo '</tr> ';
while ($row = mysqli_fetch_assoc($electivas_pend)) {
	echo '<tr>';

	echo '<td class="Estilol">', $row['asignatura'], '</td>';
	echo '<td class="Estilol">', $row['creditos'], '</td>';
	echo '<td class="Estilol">', $row['creditospp'], '</td>';
	echo '<td class="Estilol">', $row['semestre'], '</td>';
}
echo '</table>';

echo '<p align="center"><font color=#332B66> <h3>RESUMEN DE SU ESTUDIO ORIENTATIVO </h3></font></p>';
if ($credobligaprobados == 0 and $credelectprpedgaprobados == 0) {

	echo ' <p class="Estilolp">No ha aprobado créditos obligatorios y tiene pendientes ' . $credobligpendientes . '<br>';
	echo 'No ha aprobado créditos electivos y tiene pendientes ' . $numerocreditosmateelect . '<br><br>';
	echo 'Seg&uacute;n el PEP 2017, el profesional de Licenciatura en Inform&aacute;tica debe aprobar 50 cr&eacute;ditos de pr&aacute;ctica pedag&oacute;gica, ellos hacen parte de los 160 del plan. <br><br>';
	echo '<b>Ud. ser&aacute; Bienvenido al Programa de Licenciatura en Inform&aacute;tica </b>';
} else {
	//Tablas de datos a presentar como resumen
	$credelectpendientes = (34 - $credelectaprobados);
	if($credelectaprobados>34) $credelectpendientes = 0;
	$credpracpedaprob = $credoprpedgaprobados + $credelectprpedgaprobados;
	if($credpracpedaprob >= 50){
		$credpracpedaprob = 50;
	}

	
	if($credelectprpedgaprobados>=5){
		$credelectprpedgaprobados = 5;
	}

	echo '<table>
					<tr><td class="Estilot" align="center">Tipo de Créditos</td><td class="Estilot" align="center">Num. Aprobados</td><td class="Estilot" align="center">Num. Pendientes</td></tr>
					<tr><td class="Estilot">Obligatorios</td><td class="Estilolp" align="center">', $credobligaprobados, '</td><td class="Estilolp" align="center">', $credobligpendientes, '</td></tr>
					<tr><td class="Estilot">Electivos</td><td class="Estilolp" align="center">', $credelectaprobados, '</td><td class="Estilolp" align="center">', ($credelectpendientes), '</td></tr>
					<tr><td class="Estilot">TOTAL</td><td class="Estilot" align="center">', $credobligaprobados + $credelectaprobados, '</td><td class="Estilot" align="center">', $credobligpendientes + ($credelectpendientes), '</td></tr>
			</table>';

	echo '<p class="Estilolp">Todo profesional de Licenciatura en Inform&aacute;tica debe aprobar 50 cr&eacute;ditos de pr&aacute;ctica pedag&oacute;gica, incluidos en el total de cr&eacute;ditos del Programa (PEP 2017).</p> <p class="estilotp">CR&Eacute;DITOS DE PR&Aacute;CTICA PEDAG&Oacute;GICA </p>';
	echo '<table>
					<tr><td class="Estilot" align="center">Aprobados </td><td class="Estilot" align="center">Pendientes</td></tr>
					<tr><td class="Estilot" align="center">', ($credoprpedgaprobados + $credelectprpedgaprobados), '</td><td class="Estilot" align="center">', (($numerocreditopracpedag - (($credoprpedgaprobados + $credelectprpedgaprobados))) > 0) ? (($numerocreditopracpedag - (($credoprpedgaprobados + $credelectprpedgaprobados)))) : "0" , ' (', (45 - $credoprpedgaprobados), ' en obligatorios y ', ((5 - $credelectprpedgaprobados) > 0) ? (5 - $credelectprpedgaprobados) : "0", ' en electivos)</td></tr>
			</table>';

	//C�digo de ubicaci�n en semestre

	/* $creditosubicados = $ctotaleso + $ctotalese;
	$mensajeubicacion = 'Ud. probablemente estar&aacute; matriculado(a) en el semestre';
	switch ($creditosubicados) {
		case ($creditosubicados <= 14):
			echo '<p align="center"><font color=#339900> <h4>' . $mensajeubicacion . ' 1</h4></font></p>';;
			break;
		case ($creditosubicados <= 28):
			echo '<p align="center"><font color=#339900> <h4>' . $mensajeubicacion . ' 2</h4></font></p>';;
			break;
		case ($creditosubicados <= 42):
			echo '<p align="center"><font color=##339900> <h4>' . $mensajeubicacion . ' 3</h4></font></p>';;
			break;
		case ($creditosubicados <= 56):
			echo '<p align="center"><font color=#339900> <h4>' . $mensajeubicacion . ' 4</h4></font></p>';;
			break;
		case ($creditosubicados <= 70):
			echo '<p align="center"><font color=#339900> <h4>' . $mensajeubicacion . ' 5</h4></font></p>';;
			break;
		case ($creditosubicados <= 84):
			echo '<p align="center"><font color=#339900> <h4>' . $mensajeubicacion . ' 6</h4></font></p>';;
			break;
		case ($creditosubicados <= 98):
			echo '<p align="center"><font color=#339900> <h4>' . $mensajeubicacion . ' 7</h4></font></p>';;
			break;
		case ($creditosubicados <= 112):
			echo '<p align="center"><font color=#339900> <h4>' . $mensajeubicacion . ' 8</h4></font></p>';;
			break;
		case ($creditosubicados <= 126):
			echo '<p align="center"><font color=#339900> <h4>' . $mensajeubicacion . ' 9</h4></font></p>';;
			break;
		case (($creditosubicados <= 160) or ($ctotalesp < 50) or ($obligatorias == 1)):
			echo '<p align="center"><font color=#339900> <h4>' . $mensajeubicacion . ' 10</h4></font></p>';;
			break;
		case (($creditosubicados >= 160) and ($ctotalesp >= 50) and ($obligatorias == 0)):
			echo '<p align="center"><font color=#339900> <h4> Ud. Ha egresado del Programa</h4></font></p>';;
			break;
	}
 */

	///CONTEO DE HUMANISTICA

	if ($_POST['tipof'] == "antiguo") {
		//$resulttemp3 = mysqli_query($con, "SELECT asignatura,creditos,creditospp, semestre from electivas WHERE ide NOT IN (SELECT idc  FROM cursadas where validapor='ELECTIVA') ORDER BY semestre,asignatura");
	} else {
		if (isset($_POST['globales']) && (is_array($_POST['globales']) && count($_POST['globales']) > 0)) {
			// Escapamos y convertimos el array a una cadena de valores separados por comas
			$ids = implode(",", array_map('intval', $_POST['globales']));
			// Construimos la consulta con IN()
			$sql = "SELECT * FROM materias WHERE id IN ($ids)
				AND ca2017 = 'OBLIGATORIA' 
        		ORDER BY semestre ASC, a2017 ASC";
			// Ejecutamos la consulta
			$humanisticas = mysqli_query($con, $sql);
		
			while ($row = mysqli_fetch_assoc($humanisticas)) {				
				if ($row['componente'] == 'C1') $ctotadatoscomp1 += intval($row['cr2017']);
				if ($row['componente'] == 'C2') $ctotadatoscomp2 += intval($row['cr2017']);
				if ($row['componente'] == 'C3' || $row['componente'] == 'C4') $ctotadatoscomp3 += intval($row['cr2017']);

				//var_dump($row);
			}
			//var_dump($humanisticas);
		}
	}



	echo '<p class="Estilotp">INFORMACI&Oacute;N DE CR&Eacute;DITOS POR COMPONENTES (Resoluci&oacute;n 18583 de 2017)</p> ';
	echo '<table>
					<tr><td class="Estilot" align="center">Cr&eacute;ditos por componente</td><td class="Estilot" align="center">Num. Aprobados</td></tr>
					<tr><td class="Estilot">Fundamentos generales</td><td class="Estilolp" align="center">', $ctotadatoscomp1, '</td></tr>
					<tr><td class="Estilot">Disciplinares</td><td class="Estilolp" align="center">', $ctotadatoscomp2, '</td></tr>
					<tr><td class="Estilot">Pedag&oacute;gicos y did&aacute;cticos</td><td class="Estilolp" align="center">', $ctotadatoscomp3, '</td></tr>
					<tr><td class="Estilot">TOTAL</td><td class="Estilot" align="center">', $ctotadatoscomp1 + $ctotadatoscomp2 + $ctotadatoscomp3, '</td></tr>
			</table>';
}

mysqli_close($con);
if ($_POST['tipof'] == "antiguo") {
	echo '</p><center><p class="Estilolpie"> Este estudio es s&oacute;lo de car&aacute;cter orientativo para su decisi&oacute;n y no es v&aacute;lido para su cambio al nuevo plan. El cambio s&oacute;lo podr&aacute; hacerse con Acuerdo del Departamento de Matem&aacute;ticas y Estad&iacute;stica, previa solicitud voluntaria por escrito de su parte. </p></center>';
} else {
	echo '</p><center><p class="Estilolpie"> Este estudio es s&oacute;lo de car&aacute;cter orientativo para su informaci&oacute;n y s&oacute;lo representa una ayuda para aproximar al usuario a la situaci&oacute;n acad&eacute;mica actual. Cualquier decisi&oacute;n es responsabilidad del usuario que consulta. </p></center>';
}
echo '</p><center><p class="Estilolpie"> Dise&ntilde;o del simulador: Jos&eacute; Luis Romo G. - Coord. Licenciatura en Inform&acute;tica <br> cel:3156610274<br>mail:rhomojose@yahoo.es</p></center>';
/*echo "<P><center> <a href='estudioa.php'> Regresar</a> </center> </P>";*/


echo "<P><center> <a href='estudioa.php'> <button>Analizar: estud. antiguos</button></a> ---- <a href='estudio.php'> <button>Analizar: estud. nuevos</button> </a> </center> </P>";



//segunda validaci�n de variables de cr�ditos cuando son nulas o negativas
