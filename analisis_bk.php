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
$resultcc = mysqli_query($con, "CREATE TEMPORARY TABLE cursadas (idc text (5), asignatura text(100), convalidada text(100), estado text(50), validapor text(15), creditos numeric(2,0) default NULL, creditospp numeric(2,0) default NULL, componente text (5))");
$resultcc2 = mysqli_query($con, "CREATE TEMPORARY TABLE cursadas2 (idc text (5), asignatura text(100),  estado text(50), validapor text(15), creditos numeric(2,0) default NULL, creditospp numeric(2,0) default NULL, componente text (5))");
$resultcp = mysqli_query($con, "CREATE TEMPORARY TABLE pendientes (asignatura text(100), estado text(50), validapor text(15), creditos numeric(2,0) default NULL, creditospp numeric(2,0) default NULL, semestre text (2),prerrequisito text(100))");
$resultce = mysqli_query($con, "CREATE TEMPORARY TABLE electivasf (ide text (5), asignatura text(100),  creditos numeric(2,0) default NULL, creditospp numeric(2,0) default NULL, semestre text (5),componente text (5))");
$d = 0;
$c = "APROBADA";
$p = "PENDIENTE";
$o = "OBLIGATORIA";
$e = "ELECTIVA";
$cp = 50;
$de = 0;
$dec = 0;
if (!isset($_REQUEST['a20101'])) $_POST['a20101'] = "a01";
if (!isset($_REQUEST['a20102'])) $_POST['a20102'] = "a02";
if (!isset($_REQUEST['a20103'])) $_POST['a20103'] = "a03";
if (!isset($_REQUEST['a20104'])) $_POST['a20104'] = "a04";
if (!isset($_REQUEST['a20105'])) $_POST['a20105'] = "a05";
if (!isset($_REQUEST['a20106'])) $_POST['a20106'] = "a06";
if (!isset($_REQUEST['a20107'])) $_POST['a20107'] = "a07";
if (!isset($_REQUEST['a20108'])) $_POST['a20108'] = "a08";
if (!isset($_REQUEST['a20109'])) $_POST['a20109'] = "a09";
if (!isset($_REQUEST['a201010'])) $_POST['a201010'] = "a10";
if (!isset($_REQUEST['a201011'])) $_POST['a201011'] = "a11";
if (!isset($_REQUEST['a201012'])) $_POST['a201012'] = "a12";
if (!isset($_REQUEST['a201013'])) $_POST['a201013'] = "a13";
if (!isset($_REQUEST['a201014'])) $_POST['a201014'] = "a14";
if (!isset($_REQUEST['a201015'])) $_POST['a201015'] = "a15";
if (!isset($_REQUEST['a201016'])) $_POST['a201016'] = "a16";
if (!isset($_REQUEST['a201017'])) $_POST['a201017'] = "a17";
if (!isset($_REQUEST['a201018'])) $_POST['a201018'] = "a18";
if (!isset($_REQUEST['a201019'])) $_POST['a201019'] = "a19";
if (!isset($_REQUEST['a201020'])) $_POST['a201020'] = "a20";
if (!isset($_REQUEST['a201021'])) $_POST['a201021'] = "a21";
if (!isset($_REQUEST['a201022'])) $_POST['a201022'] = "a22";
if (!isset($_REQUEST['a201023'])) $_POST['a201023'] = "a23";
if (!isset($_REQUEST['a201024'])) $_POST['a201024'] = "a24";
if (!isset($_REQUEST['a201025'])) $_POST['a201025'] = "a25";
if (!isset($_REQUEST['a201026'])) $_POST['a201026'] = "a26";
if (!isset($_REQUEST['a201027'])) $_POST['a201027'] = "a27";
if (!isset($_REQUEST['a201028'])) $_POST['a201028'] = "a28";
if (!isset($_REQUEST['a201029'])) $_POST['a201029'] = "a29";
if (!isset($_REQUEST['a201030'])) $_POST['a201030'] = "a30";
if (!isset($_REQUEST['a201031'])) $_POST['a201031'] = "a31";
if (!isset($_REQUEST['a201032'])) $_POST['a201032'] = "a32";
if (!isset($_REQUEST['a201033'])) $_POST['a201033'] = "a33";
if (!isset($_REQUEST['a201034'])) $_POST['a201034'] = "a34";
if (!isset($_REQUEST['a201035'])) $_POST['a201035'] = "a35";
if (!isset($_REQUEST['a201036'])) $_POST['a201036'] = "a36";
if (!isset($_REQUEST['a201037'])) $_POST['a201037'] = "a37";
if (!isset($_REQUEST['a201038'])) $_POST['a201038'] = "a38";
if (!isset($_REQUEST['a201039'])) $_POST['a201039'] = "a39";
if (!isset($_REQUEST['a201040'])) $_POST['a201040'] = "a40";
if (!isset($_REQUEST['a201041'])) $_POST['a201041'] = "a41";
if (!isset($_REQUEST['a201042'])) $_POST['a201042'] = "a42";
if (!isset($_REQUEST['a201043'])) $_POST['a201043'] = "a43";
if (!isset($_REQUEST['a201044'])) $_POST['a201044'] = "a44";
if (!isset($_REQUEST['a201045'])) $_POST['a201045'] = "a45";
if (!isset($_REQUEST['a201046'])) $_POST['a201046'] = "a46";
if (!isset($_REQUEST['a201047'])) $_POST['a201047'] = "a47";
if (!isset($_REQUEST['a201048'])) $_POST['a201048'] = "a48";
if (!isset($_REQUEST['a201049'])) $_POST['a201049'] = "a49";
if (!isset($_REQUEST['a201050'])) $_POST['a201050'] = "a50";

if (!isset($_REQUEST['a201051'])) $_POST['a201051'] = "a51";
if (!isset($_REQUEST['a201052'])) $_POST['a201052'] = "a52";
if (!isset($_REQUEST['a201053'])) $_POST['a201053'] = "a53";
if (!isset($_REQUEST['a201054'])) $_POST['a201054'] = "a54";
if (!isset($_REQUEST['a201055'])) $_POST['a201055'] = "a55";



if (!isset($_REQUEST['e20171'])) $_POST['e20171'] = "e01";
if (!isset($_REQUEST['e20172'])) $_POST['e20172'] = "e02";
if (!isset($_REQUEST['e20173'])) $_POST['e20173'] = "e03";
if (!isset($_REQUEST['e20174'])) $_POST['e20174'] = "e04";
if (!isset($_REQUEST['e20175'])) $_POST['e20175'] = "e05";
if (!isset($_REQUEST['e20176'])) $_POST['e20176'] = "e06";
if (!isset($_REQUEST['e20177'])) $_POST['e20177'] = "e07";
if (!isset($_REQUEST['e20178'])) $_POST['e20178'] = "e08";
if (!isset($_REQUEST['e20179'])) $_POST['e20179'] = "e09";
if (!isset($_REQUEST['e201710'])) $_POST['e201710'] = "e10";
if (!isset($_REQUEST['e201711'])) $_POST['e201711'] = "e11";
if (!isset($_REQUEST['e201712'])) $_POST['e201712'] = "e12";
if (!isset($_REQUEST['e201713'])) $_POST['e201713'] = "e13";
if (!isset($_REQUEST['e201714'])) $_POST['e201714'] = "e14";
if (!isset($_REQUEST['e201715'])) $_POST['e201715'] = "e15";
if (!isset($_REQUEST['e201716'])) $_POST['e201716'] = "e16";
if (!isset($_REQUEST['e201717'])) $_POST['e201717'] = "e17";
if (!isset($_REQUEST['e201718'])) $_POST['e201718'] = "e18";
if (!isset($_REQUEST['e201719'])) $_POST['e201719'] = "e19";
if (!isset($_REQUEST['e201720'])) $_POST['e201720'] = "e20";
if (!isset($_REQUEST['e201721'])) $_POST['e201721'] = "e21";
if (!isset($_REQUEST['e201722'])) $_POST['e201722'] = "e22";
if (!isset($_REQUEST['e201723'])) $_POST['e201723'] = "e23";
if (!isset($_REQUEST['e201724'])) $_POST['e201724'] = "e24";

//echo $_POST['a201049'];

if ($_POST['tipof'] == "antiguo") {
	$result = mysqli_query($con, "SELECT * from materias");
} else {
	$consulta = "SELECT * from materias where ca2017='OBLIGATORIA' order by ida2017";
	$result = mysqli_query($con, $consulta);
}
while ($row = mysqli_fetch_row($result)) {
	$d = $d + 1;
	// validar si proviene de cambio o de actual aqu� si viene de cambio
	if ($_POST['tipof'] == "antiguo") {
		if (isset($_REQUEST['a2010' . $d])) {
			if ($_POST['a2010' . $d] == $row[1]) {

				$resultc = mysqli_query($con, "INSERT INTO cursadas (idc,asignatura,convalidada,estado,validapor, creditos, creditospp, componente) VALUES ('$row[3]','$row[2]', '$row[4]', '$c', '$row[8]', '$row[6]', '$row[7]', '$row[12]')");
			} else {
			}
		} else {

			if ($_POST['a2010' . $d] == $row[3]) {
				if ($row[8] == "ELECTIVA") {
				} else {
					$resultp = mysqli_query($con, "INSERT INTO pendientes (asignatura,estado,validapor, creditos, creditospp, semestre, prerrequisito) VALUES ('$row[4]', '$p', '$row[8]', '$row[6]', '$row[7]', '$row[10]', '$row[11]')");
				}
			} else {
				if ($row[8] == "ELECTIVA") {
				} else {
					$resultp = mysqli_query($con, "INSERT INTO pendientes (asignatura,estado,validapor, creditos, creditospp, semestre, prerrequisito) VALUES ('$row[4]', '$p', '$row[8]', '$row[6]', '$row[7]', '$row[10]', '$row[11]')");
				}
			}
		}
		// ahora de nuevo se valida pero si viene de actual
	} else {

		if (isset($_REQUEST['a2010' . $d])) {

			if ($_POST['a2010' . $d] == $row[3]) {
				$resultc = mysqli_query($con, "INSERT INTO cursadas2 (idc,asignatura,estado,validapor, creditos, creditospp, componente) VALUES ('$row[3]','$row[4]', '$c', '$row[8]', '$row[6]', '$row[7]', '$row[12]')");
			} else {
			}
		} else {
			if ($row[8] == "ELECTIVA") {
			} else {
				if ($_POST['a2010' . $d] == $row[3]) {
					if ($row[8] == "ELECTIVA") {
					} else {
						$resultp = mysqli_query($con, "INSERT INTO pendientes (asignatura,estado,validapor, creditos, creditospp, semestre, prerrequisito) VALUES ('$row[4]', '$p', '$row[8]', '$row[6]', '$row[7]', '$row[10]', '$row[11]')");
					}
				} else {
					if ($row[8] == "ELECTIVA") {
					} else {
						$resultp = mysqli_query($con, "INSERT INTO pendientes (asignatura,estado,validapor, creditos, creditospp, semestre, prerrequisito) VALUES ('$row[4]', '$p', '$row[8]', '$row[6]', '$row[7]', '$row[10]', '$row[11]')");
					}
				}
			}
		}
	}
}
if ($_POST['tipof'] == "nuevo") {
	$resultec = mysqli_query($con, "SELECT * from electivas order by ide");
	while ($rowec = mysqli_fetch_row($resultec)) {
		$dec = $dec + 1;
		if (isset($_REQUEST['e2017' . $dec])) {
			if ($_POST['e2017' . $dec] == $rowec[1]) {
				$resultecf = mysqli_query($con, "INSERT INTO cursadas2 (idc,asignatura,estado,validapor, creditos, creditospp, componente) VALUES ('$rowec[1]','$rowec[2]', '$c', '$e', '$rowec[3]', '$rowec[4]', '$rowec[6]')");
			} else {
			}
		} else {
		}
	}
}
// se presenta la tabla de asignaturas cursadas
if ($_POST['tipof'] == "antiguo") {
	$datosc = "SELECT SUM(creditos) as datos FROM cursadas";
} else {
	$datosc = "SELECT SUM(creditos) as datos FROM cursadas2";
}
$resultadodatos = mysqli_query($con, $datosc);
$datostc = mysqli_fetch_array($resultadodatos, MYSQLI_ASSOC);
$ctotadatosc = $datostc["datos"];
if ($_POST['tipof'] == "antiguo") {
	echo '<div align="center"><center><table border="0" cellpadding="10" cellspacing="0" width=80%><tr><td width=25% align="center"><img src="logou.jpg" width=130 height=120></td> <td width=50% align="center"><h2>ESTUDIO ORIENTATIVO DE SU HOJA DE VIDA ACAD&Eacute;MICA PARA CAMBIO DE PLAN </h2></td><td width=25% align="center"><img src="logo.gif" width=120 height=90></td> </tr></table> </center></div>';
} else {
	echo '<div align="center"><center><table border="0" cellpadding="10" cellspacing="0" width=80%><tr><td width=25% align="center"><img src="logou.jpg" width=130 height=120></td> <td width=50% align="center"><h2>AN&Aacute;LISIS DE SU VIDA ACAD&Eacute;MICA ACTUAL</h2></td><td width=25% align="center"><img src="logo.gif" width=120 height=90></td> </tr></table> </center></div>';
}
if ($_POST['tipof'] == "antiguo") {
	echo '<P ALIGN="CENTER" class="Estilotp" ><B><BR> ASIGNATURAS APROBADAS EN EL PLAN ANTERIOR</B></P>';
} else {
	echo '<P ALIGN="CENTER" class="Estilotp" ><B><BR> ASIGNATURAS APROBADAS AL MOMENTO</B></P>';
}
if ($ctotadatosc == 0) {
	echo '<p align="center"> <b>Usted no ha cursado alguna asignatura en el Programa </b> </p><br>';
	$ctotales = 0;
	$ctotaleso = 0;
	$ctotalese = 0;
	$ctotalesp = 0;
} else {
	//mostrar de cr�ditos aprobados para antiguo
	if ($_POST['tipof'] == "antiguo") {
		$resulttemp = mysqli_query($con, "SELECT asignatura, convalidada, estado, validapor, creditos, creditospp from cursadas order by validapor DESC");
		echo '<center><table border = "0" width=80% >';
		echo '<tr > ';
		echo '<td width=30% align="center" class="Estilot"><b> Asignatura Plan anterior</b></td> ';
		echo '<td width=30% align="center" class="Estilot"><b> Convalidada/Homologada con...</b></td> ';
		echo '<td width=10% align="center" class="Estilot"><b> Estado</b></td> ';
		echo '<td width=10% align="center" class="Estilot"><b> Tipo de Asignatura</b></td> ';
		echo '<td width=10% align="center" class="Estilot"><b> Cr&eacute;ditos aprobados</b></td> ';
		echo '<td width=10% align="center" class="Estilot"><b> Cr&eacute;ditos de prac. ped.</b></td> ';
		echo '</tr> ';
		while ($row = mysqli_fetch_row($resulttemp)) {
			echo '<tr>';
			foreach ($row as $clave) {
				echo '<td class="Estilol">', $clave, '</td>';
			}
		}
		echo '</table>';
		//mostrar de creditos aprobados para actual
	} else {
		$resulttemp = mysqli_query($con, "SELECT asignatura, estado, validapor, creditos, creditospp from cursadas2 order by validapor DESC");
		echo '<center><table border = "0" width=80% >';
		echo '<tr > ';
		echo '<td width=30% align="center" class="Estilot"><b> Asignatura</b></td> ';
		echo '<td width=10% align="center" class="Estilot"><b> Estado</b></td> ';
		echo '<td width=10% align="center" class="Estilot"><b> Tipo de Asignatura</b></td> ';
		echo '<td width=10% align="center" class="Estilot"><b> Cr&eacute;ditos aprobados</b></td> ';
		echo '<td width=10% align="center" class="Estilot"><b> Cr&eacute;ditos de prac. ped.</b></td> ';
		echo '</tr> ';
		while ($row = mysqli_fetch_row($resulttemp)) {
			echo '<tr>';
			foreach ($row as $clave) {
				echo '<td class="Estilol">', $clave, '</td>';
			}
		}
		echo '</table>';
	}
}
//C�lculo de cr�ditos cursados
if ($_POST['tipof'] == "antiguo") {
	$resulttotob = mysqli_query($con, "SELECT SUM(creditos) as totalo FROM cursadas where validapor='OBLIGATORIA'");
	$row = mysqli_fetch_array($resulttotob, MYSQLI_ASSOC);
	$ctotaleso = $row["totalo"];
	$resulttotel = mysqli_query($con, "SELECT SUM(creditos) as totale FROM cursadas where validapor='ELECTIVA'");
	$row = mysqli_fetch_array($resulttotel, MYSQLI_ASSOC);
	$ctotalese = $row['totale'];
	$resulttotpp = mysqli_query($con, "SELECT SUM(creditospp) as totalp FROM cursadas");
	$row = mysqli_fetch_array($resulttotpp, MYSQLI_ASSOC);
	$ctotalesp = $row['totalp'];
	$ctotales = $ctotaleso + $ctotalese;

	//C�lculo de cr�ditos cursados por componente
	$datoscomponente3 = 'SELECT SUM(creditos) as datoscomp3 FROM cursadas where componente="C3" OR componente = "C4"';
	$resultadocomp3 = mysqli_query($con, $datoscomponente3);
	$datostco3 = mysqli_fetch_array($resultadocomp3, MYSQLI_ASSOC);
	if ($datostco3["datoscomp3"] != null) {
		$ctotadatoscomp3 = $datostco3["datoscomp3"];
	} else {
		$ctotadatoscomp3 = 0;
	}
	$datoscomponente2 = 'SELECT SUM(creditos) as datoscomp2 FROM cursadas where componente="C2"';
	$resultadocomp2 = mysqli_query($con, $datoscomponente2);
	$datostco2 = mysqli_fetch_array($resultadocomp2, MYSQLI_ASSOC);
	if ($datostco2["datoscomp2"] != null) {
		$ctotadatoscomp2 = $datostco2["datoscomp2"];
	} else {
		$ctotadatoscomp2 = 0;
	}
	$datoscomponente1 = 'SELECT SUM(creditos) as datoscomp1 FROM cursadas where componente="C1"';
	$resultadocomp1 = mysqli_query($con, $datoscomponente1);
	$datostco1 = mysqli_fetch_array($resultadocomp1, MYSQLI_ASSOC);
	if ($datostco1["datoscomp1"] != null) {
		$ctotadatoscomp1 = $datostco1["datoscomp1"];
	} else {
		$ctotadatoscomp1 = 0;
	}
} //fin del if de antiguo
else {
	$resulttotob = mysqli_query($con, "SELECT SUM(creditos) as totalo FROM cursadas2 where validapor='OBLIGATORIA'");
	$row = mysqli_fetch_array($resulttotob, MYSQLI_ASSOC);
	$ctotaleso = $row["totalo"];
	$resulttotel = mysqli_query($con, "SELECT SUM(creditos) as totale FROM cursadas2 where validapor='ELECTIVA'");
	$row = mysqli_fetch_array($resulttotel, MYSQLI_ASSOC);
	$ctotalese = $row['totale'];
	$resulttotpp = mysqli_query($con, "SELECT SUM(creditospp) as totalp FROM cursadas2");
	$row = mysqli_fetch_array($resulttotpp, MYSQLI_ASSOC);
	$ctotalesp = $row['totalp'];
	$ctotales = $ctotaleso + $ctotalese;

	//C�lculo de cr�ditos cursados por componente
	$datoscomponente3 = 'SELECT SUM(creditos) as datoscomp3 FROM cursadas2 where componente="C3" OR componente = "C4"';
	$resultadocomp3 = mysqli_query($con, $datoscomponente3);
	$datostco3 = mysqli_fetch_array($resultadocomp3, MYSQLI_ASSOC);
	if ($datostco3["datoscomp3"] != null) {
		$ctotadatoscomp3 = $datostco3["datoscomp3"];
	} else {
		$ctotadatoscomp3 = 0;
	}
	$datoscomponente2 = 'SELECT SUM(creditos) as datoscomp2 FROM cursadas2 where componente="C2"';
	$resultadocomp2 = mysqli_query($con, $datoscomponente2);
	$datostco2 = mysqli_fetch_array($resultadocomp2, MYSQLI_ASSOC);
	if ($datostco2["datoscomp2"] != null) {
		$ctotadatoscomp2 = $datostco2["datoscomp2"];
	} else {
		$ctotadatoscomp2 = 0;
	}
	$datoscomponente1 = 'SELECT SUM(creditos) as datoscomp1 FROM cursadas2 where componente="C1"';
	$resultadocomp1 = mysqli_query($con, $datoscomponente1);
	$datostco1 = mysqli_fetch_array($resultadocomp1, MYSQLI_ASSOC);
	if ($datostco1["datoscomp1"] != null) {
		$ctotadatoscomp1 = $datostco1["datoscomp1"];
	} else {
		$ctotadatoscomp1 = 0;
	}
} //fin del else de actual
// c�lculo de cr�ditos pendientes
$resulttotob = mysqli_query($con, "SELECT SUM(creditos) as totalo FROM pendientes where validapor='OBLIGATORIA'");
$row = mysqli_fetch_array($resulttotob, MYSQLI_ASSOC);
$ctotalesop = $row["totalo"];
$resulttotel = mysqli_query($con, "SELECT SUM(creditos) as totale FROM pendientes where validapor='ELECTIVA'");
$row = mysqli_fetch_array($resulttotel, MYSQLI_ASSOC);
$ctotalesep = $row["totale"];
$resulttotpp = mysqli_query($con, "SELECT SUM(creditospp) as totalp FROM cursadas");
$row = mysqli_fetch_array($resulttotpp, MYSQLI_ASSOC);
$ctotalesep = $row["totalp"];
$ctotalespend = 160 - $ctotales;
$ctotaleselect = 34 - $ctotalese;
$ctotalespract = 50 - $ctotalesp;

//primera validaci�n de variables de cr�ditos cuando son nulas o negativas
if ($ctotaleso == null) {
	$ctotaleso = 0;
}
if ($ctotalese == null) {
	$ctotalese = 0;
}
if (($ctotalespract == null) or ($ctotalespract < 0)) {
	$ctotalespract = 0;
}
if (($ctotaleselect == null) or ($ctotaleselect < 0)) {
	$ctotaleselect = 0;
}
if ($ctotalesop == null) {
	$ctotalesop = 0;
}
if ($ctotalesp == null) {
	$ctotalesp = 0;
}
// se presenta la tabla de asignaturas pendientes
echo '<P ALIGN="CENTER" class="Estilotp"><B><BR> <BR> ASIGNATURAS OBLIGATORIAS PENDIENTES</B></P>';
$datosp = "SELECT SUM(creditos) as datos2 FROM pendientes";
$resultadodatosp = mysqli_query($con, $datosp);
$datostp = mysqli_fetch_array($resultadodatosp, MYSQLI_ASSOC);
$ctotadatosp = $datostp["datos2"];
$cdatoscpp = "SELECT SUM(creditospp) as datoscpp FROM pendientes";
$resultadocpp = mysqli_query($con, $cdatoscpp);
$datoscppp = mysqli_fetch_array($resultadocpp, MYSQLI_ASSOC);
$ctotalcppp = $datoscppp["datoscpp"];

//segunda validaci�n de variables de cr�ditos cuando son nulas o negativas
if ($ctotalcppp == null) {
	$ctotalcppp = 0;
}
//presentaci�n de datos cuando  ha cursado todo
if ($ctotadatosp == 0) {
	echo "Usted no tiene asignaturas obligatorias pendientes en el Programa <br>";
	$obligatorias = 0;
} else {
	$resulttemp2 = mysqli_query($con, "SELECT * from pendientes order by semestre,asignatura");
	$obligatorias = 1;
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
	while ($row = mysqli_fetch_row($resulttemp2)) {
		echo '<tr>';
		foreach ($row as $clave) {
			echo '<td class="Estilol">', $clave, '</td>';
		}
	}
	echo '<tr> <td colspan=3 class="Estilot" align="right">Totales</td> <td class="Estilot">', $ctotalesop, '</td> <td class="Estilot">', $ctotalcppp, ' </td><td colspan=2> </td></tr>';
	echo '</table>';
}
// se presenta la tabla de electivas posibles
if ($ctotalesp < 50) {
	echo '<P ALIGN="CENTER" class="Estilotp"><B><BR> <BR>USTED TIENE LAS SIGUIENTES ELECTIVAS PARA ESCOGER</B></P>';
	if ($_POST['tipof'] == "antiguo") {
		$resulttemp3 = mysqli_query($con, "SELECT asignatura,creditos,creditospp, semestre from electivas WHERE ide NOT IN (SELECT idc  FROM cursadas where validapor='ELECTIVA') ORDER BY semestre,asignatura");
	} else {
		$resulte = mysqli_query($con, "SELECT * from electivas order by ide");
		while ($rowe = mysqli_fetch_row($resulte)) {
			$de = $de + 1;
			if (isset($_REQUEST['e2017' . $de])) {
				if ($_POST['e2017' . $de] == $rowe[1]) {
					$resultet = mysqli_query($con, "INSERT INTO electivasf (ide,asignatura, creditos, creditospp, semestre, componente) VALUES ('$rowe[1]','$rowe[2]', '$rowe[3]',  '$rowe[4]', '$rowe[5]', '$rowe[6]')");
				} else {
				}
			} else {
			}
		}
		$resulttemp3 = mysqli_query($con, "SELECT asignatura,creditos,creditospp, semestre from electivas WHERE ide NOT IN (SELECT ide  FROM electivasf) ORDER BY semestre,asignatura");
	}
	if (mysqli_num_rows($resulttemp3) <= 0) {
		echo 'No tiene lista de electivas';
	} else {
		echo '<center><table border = "0" width=80%>';
		echo '<tr > ';
		echo '<td width=50% align="center" class="Estilot"><b> Asignatura</b></td> ';
		echo '<td width=15% align="center" class="Estilot"><b> N&uacute;mero de Cr&eacute;ditos </b></td> ';
		echo '<td width=15% align="center" class="Estilot"><b> Cr&eacute;ditos de prac. ped.</b></td> ';
		echo '<td width=20% align="center" class="Estilot"><b> Semestre en que se ofrece</b></td> ';
		echo '</tr> ';
		while ($row = mysqli_fetch_row($resulttemp3)) {
			echo '<tr>';
			foreach ($row as $clave) {
				echo '<td class="Estilol">', $clave, '</td>';
			}
		}
		echo '</table>';
	}
}
//presentaci�n de resumen de estudio con datos calculados
echo '<p align="center"><font color=#332B66> <h3>RESUMEN DE SU ESTUDIO ORIENTATIVO </h3></font></p>';
if ($ctotales == 0 and $ctotalese == 0 and $ctotalesp == 0) {

	echo ' <p class="Estilolp">No ha aprobado cr&eacute;ditos obligatorios y tiene pendientes ' . $ctotalesop . '<br>';
	echo 'No ha aprobado cr&eacute;ditos electivos y tiene pendientes  ' . $ctotaleselect . '<br><br>';
	echo 'Seg&uacute;n el PEP 2017, el profesional de Licenciatura en Inform&aacute;tica debe aprobar 50 cr&eacute;ditos de pr&aacute;ctica pedag&oacute;gica, ellos hacen parte de los 160 del plan. <br><br>';
	echo '<b>Ud. ser&aacute; Bienvenido al Programa de Licenciatura en Inform&aacute;tica </b>';
} else {
	//Tablas de datos a presentar como resumen

	echo '<table>
					<tr><td class="Estilot" align="center">Tipo de Cr&eacute;ditos</td><td class="Estilot" align="center">Num. Aprobados</td><td class="Estilot" align="center">Num. Pendientes</td></tr>
					<tr><td class="Estilot">Obligatorios</td><td class="Estilolp" align="center">', $ctotaleso, '</td><td class="Estilolp" align="center">', $ctotalesop, '</td></tr>
					<tr><td class="Estilot">Electivos</td><td class="Estilolp" align="center">', $ctotalese, '</td><td class="Estilolp" align="center">', $ctotaleselect, '</td></tr>
					<tr><td class="Estilot">TOTAL</td><td class="Estilot" align="center">', $ctotaleso + $ctotalese, '</td><td class="Estilot" align="center">', $ctotalesop + $ctotaleselect, '</td></tr>
			</table>';

	echo '<p class="Estilolp">Todo profesional de Licenciatura en Inform&aacute;tica debe aprobar 50 cr&eacute;ditos de pr&aacute;ctica pedag&oacute;gica, incluidos en el total de cr&eacute;ditos del Programa (PEP 2017).</p> <p class="estilotp">CR&Eacute;DITOS DE PR&Aacute;CTICA PEDAG&Oacute;GICA </p>';
	echo '<table>
					<tr><td class="Estilot" align="center">Aprobados </td><td class="Estilot" align="center">Pendientes</td></tr>
					<tr><td class="Estilot" align="center">', $ctotalesp, '</td><td class="Estilot" align="center">', $ctotalespract, ' (', $ctotalcppp, ' en obligatorios y ', $ctotalespract - $ctotalcppp, ' en electivos)</td></tr>
			</table>';

	//C�digo de ubicaci�n en semestre

	$creditosubicados = $ctotaleso + $ctotalese;
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
mysqli_free_result($result);
/*mysqli_free_result($resultt);*/
//mysqli_free_result($resulttemp);
