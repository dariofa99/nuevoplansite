<?php
session_start();
if(!isset($_SESSION["session_username"])) {
		header("location:login.php");
	} else {
		include('includes/connection.php');
		$query = "SELECT * FROM estudiantes ORDER BY semestre ";
		$result = mysqli_query($con, $query) or die("database error:". mysqli_error($con));
		$records = array();
		while( $rows = mysqli_fetch_assoc($result) ) {
			$records[] = $rows;
		}
		$csv_file = "Backup_usuarios".date('Ymd') . ".csv";
		header("Content-Type: text/csv");
		header("Content-Disposition: attachment; filename=$csv_file");
		header('Pragma:no-cache');
		header('Expires:0');
		$fh = fopen( 'php://output', 'w' );
		$is_coloumn = true;
		if(!empty($records)) {
			foreach($records as $record) {
			if($is_coloumn) {
				fputcsv($fh, array_keys($record));
				$is_coloumn = false;
			}
			fputcsv($fh, array_values($record));
			}
		fpassthru($fh);
		fclose($fh);
		}
		exit;
}
?>
