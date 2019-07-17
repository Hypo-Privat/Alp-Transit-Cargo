<?php 

session_start ();

// echo 'hallo : tJamContacts <br>';
header ( 'content-type: application/json; charset=utf-8' );
date_default_timezone_set ( 'Europe/Berlin' );

$timestamp = time ();
$datum = date ( "Y-m-d", $timestamp );
$uhrzeit = date ( "H:i:s", $timestamp );
echo $datum, " - ", $uhrzeit, " Uhr <br>";


$db = mysqli_connect ( "server12.hostfactory.ch",  "db2inst1", "DB2admin", "a-t-c");
//$db = mysqli_connect ("localhost", "phpmyadmin", "Name0815", "phpmyadmin");
// $db = mysqli_connect ( "www.jamfinder.info", "jamfinder_usr", "Name0815", "jamfinder" );
if (mysqli_connect_errno ()) {
	printf ( "Verbindung fehlgeschlagen: %s", mysqli_connect_error () );
	exit ();
} else { echo ( "Verbindung erfolgreich: %s"  );}

// http://www.schnatterente.net/webdesign/php-mysql-utf8
mysqli_query ( $db, "SET NAMES 'utf8'" );




function get_datafile($timestamp) {
	//echo "get_datafile($timestamp)";
	//echo $_REQUEST ;
	if (empty($_FILES['toProcess']['type'])) {}else{
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
			echo "Maximale Dateigr��e betr�gt " . (($max_file_size / 1024) / 1024) . " MegaByte !<br>";
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
				move_uploaded_file($_FILES['toProcess']['tmp_name'], $userfile_dir . "/" .$userfile_name . "." . $userfile_extd);
				$_REQUEST['BILD'] = $userfile_name . "." . $userfile_extd ;
				echo "Datei	wurde erfolgreich hochgeladen! " . $userfile_dir . "/" .$userfile_name . "." . $userfile_extd;
			}
		}
	}
}
?>
