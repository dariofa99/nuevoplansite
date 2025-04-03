<?php
	require("constants.php");
	$con =mysqli_connect(DB_SERVER,DB_USER, DB_PASS, DB_NAME) or die(mysqli_error());
        $con->set_charset("utf8");
	//mysql_select_db(DB_NAME) or die("Cannot select DB");
?>
