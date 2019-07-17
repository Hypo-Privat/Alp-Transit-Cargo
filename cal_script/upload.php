
<?php
function get_datafile($timestamp) {
	echo "get_datafile($timestamp)";
	//echo $_REQUEST;
	//if (isset ($_REQUEST['senden'])) {
	$fehler = FALSE;
	$max_file_size = "1048576";
	$userfile_dir = "cal_pics/foto";
	$userfile_extd = "jpeg";
	$userfile_name = $timestamp; //hier docname von POST indexkey
	$userfile_size = $_FILES['toProcess']['size'];
	$userfile_type = $_FILES['toProcess']['type'];

	if (!eregi($userfile_extd, $userfile_type)) {
		echo "Falscher Dateityp! Bitte nur ." . $userfile_dir . "/" . $userfile_name . "." . $userfile_extd . "<br>";
		$fehler = TRUE;
	} else {
		$fehler = FALSE;
	}
	if ($fehler) {
		echo "Datei wurde nicht hochgeladen!";
		die();
	}
	if ($userfile_size > $max_file_size) {
		echo "Maximale Dateigröße beträgt " . (($max_file_size / 1024) / 1024) . " MegaByte !<br>";
		$fehler = TRUE;
	} else {
		$fehler = FALSE;
	}
	if ($fehler) {
		echo "Datei	wurde nicht hochgeladen!";
		die();
	}
	if (!$fehler) {
		if (is_uploaded_file($_FILES['toProcess']['tmp_name'])) {
			move_uploaded_file($_FILES['toProcess']['tmp_name'], $userfile_name . "." . $userfile_extd);
			echo "Datei	wurde erfolgreich hochgeladen!" . $userfile_dir .
			$userfile_name . "." . $userfile_extd;
		}
	}
}

?>