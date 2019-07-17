<?php function dbconnect($verbose) {

	$dbname = 'ATC';
	$username = 'db2inst1';
	$password = 'db2admin';
	if ($_SESSION['DB'] =='DB2'){
		// db2_connect returns 0 if the connection attempt fails
		// otherwise it returns a connection ID used by other functions
		$pconn = db2_pconnect($dbname, $username, $password);
		if ($pconn) {
			//echo "Persistent connection succeeded.";
		}
		else {
			$SQLState = db2_conn_error();
			echo("<B>Persistent Connection to ATC failed.</B><BR>$SQLState<BR>");
			$sql = db2_conn_errormsg();
			get_db2_conn_errormsg($sql);
			//printf("%s\n", $sql);
			return($pconn);
		}
	}

	if ($_SESSION['DB'] =='MY'){
		mysqli_pconnect("www.a-t-c.ch", "atc", "db2admin") or die(mysqli_error());
		//echo "Connected persistent to MySQL<br />";
		mysqli_select_db("CL12264_ATC") or die(mysqli_error());
		//echo "Connected to Database ATC";
	}

}

function get_MY_connect() {
	mysqli_pconnect("www.a-t-c.ch", "atc", "db2admin") or die(mysqli_error('NOT Connected persistent to MySQL<br />'));
	//echo "Connected persistent to MySQL<br />";
	mysqli_select_db("CL12264_ATC") or die(mysqli_error('NOT Connected to Database ATC<br />'));
	//echo "Connected to Database ATC";
}


function get_db2_conn_errormsg($sql) {
	//echo gettext("glob_form_error");
	echo "Es ist ein Fehler beim speichern der Daten aufgetreten und wir wurden Informiert.";
	if ($_SESSION['DB'] =='DB2'){
		mail('office@classicaulac.ch', (' ' . db2_conn_errormsg()), $sql, "From: error-classi");
		die(' ' . db2_conn_errormsg());
	}else{
		mail('office@classicaulac.ch', (' MYSQL Error'), $sql);
	}
}



function get_db2_stmt_errormsg($sql) {
	//echo gettext("glob_form_error");
	echo "Es ist ein Fehler beim speichern der Daten aufgetreten und wir wurden Informiert.";
	if ($_SESSION['DB'] =='DB2'){
		mail('office@classicaulac.ch', (' ' . db2_stmt_errormsg()), $sql, "From: error-classi");
		die(' ' . db2_conn_errormsg());
	}else{
		mail('office@classicaulac.ch', (' MYSQL Error'), $sql);
	}
}


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