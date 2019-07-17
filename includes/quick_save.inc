<?php
function user_check() {
	$timestamp = time();
	$_SESSION['help'] = 1;

	$sql = " SELECT INDEXKEY , PREFIX, FIRSTNAME, LASTNAME, SUFFIX,
                        EMAILADDRESS , LANG, PWD
                        FROM {$_SESSION['SCEMA']}TCONTACTS
                        where emailaddress = '{$_POST['EMAILADDRESS']}' ";


	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect($sql) ;
		$result = mysqli_query($_SESSION ['CONNECT'], $sql);
		if (!$result) {
			get_db2_conn_errormsg($_SESSION ['CONNECT'], $sql);
		}
	}else {
		get_DB2_connect($sql) ;
		$result = db2_execute($stmt);
		if (!$result) {
			get_db2_conn_errormsg($sql);
		}
	}
	//echo 'user_check - '.$sql ;
	while ($row = $_SESSION['FETCH']($result)) {
		$_SESSION['INDEXKEY'] = $row[0];
		//kunde
		$_POST['INDEXKEY'] = $row[0];
		$_SESSION['PREFIX'] = $row[1];
		$_SESSION['FIRSTNAME'] = $row[2];
		$_SESSION['LASTNAME'] = $row[3];
		$_SESSION['SUFFIX'] = $row[4];
		$_SESSION['EMAILADDRESS'] = $row[5];
		$_SESSION['LANG'] = $row[6];
		$_SESSION['PWD'] = $row[7];
		$_SESSION['help'] = 2;
		$_SESSION['angemeldet'] = true;

	}
}

function quick_kunde() {
	$timestamp = time();
	// wenn user quick angebot eingibt
	user_check();
	//echo "quick_ladtour";
	//echo "OK = > " . $_SESSION['help'];
	if ($_SESSION['angemeldet'] == false) {
		//speicher neuer kunde

		$_POST['INDEXKEY'] = $timestamp;
		// belegen fuer quick tour damit verknuepfung bei abfrage stimmt
		//kunde
		$_POST['PWD'] = $_POST['INDEXKEY'];

		//tour

		//session vorbelegen
		$_SESSION['LANG'] = $_POST['LANG'];

		$_SESSION['INDEXKEY'] = $_POST['INDEXKEY'];
		$_SESSION['OFFICEPHONE'] = $_POST['OFFICEPHONE'];

		$_SESSION['EMAILADDRESS'] = $_POST['EMAILADDRESS'];
		$_SESSION['PWD'] = $_POST['INDEXKEY'];

		$sql = "INSERT INTO  {$_SESSION['SCEMA']}TCONTACTS ( OFFICEPHONE, EMAILADDRESS , INDEXKEY, PWD, LANG, AGB )
						  VALUES('" .$_POST['OFFICEPHONE']."' ,
							    '" . $_POST['EMAILADDRESS'] . "' ,
							     '" . $_POST['INDEXKEY'] . "',
							   '" . $_POST['PWD'] . "'  ,
							    '" . $_POST['LANG'] . "'  ,
							 '" . $_POST['AGB'] . "')";

		//echo 'quick_kunde - '.$sql ;
		IF ($_SESSION['DB'] == 'MY'){
			get_MY_connect($sql) ;
			$result = mysqli_query($_SESSION ['CONNECT'], $sql);
			if (!$result) {
				$_SESSION['angemeldet'] = false;
				$_SESSION['help'] = 0;

				get_db2_stmt_errormsg($_SESSION ['CONNECT'], $sql);
			} else {
				//echo $sql;
				include 'sendmail.inc';
				$m = mail_reguser($_POST);
				$_SESSION['angemeldet'] = true;
				$_SESSION['help'] = 0;
				echo gettext("glob_meldung") . $_SESSION['EMAILADDRESS'] . " " . gettext("quick_ok_text") . gettext("glob_meldung_end");
			}
		}else {
			get_DB2_connect($sql) ;
			$result = db2_execute($stmt);
			if (!$result) {
				$_SESSION['angemeldet'] = false;
				$_SESSION['help'] = 0;

				get_db2_stmt_errormsg($sql);
			} else {
				//echo $sql;
				include 'sendmail.inc';
				$m = mail_reguser($_POST);
				$_SESSION['angemeldet'] = true;
				$_SESSION['help'] = 0;
				echo gettext("glob_meldung") . $_SESSION['EMAILADDRESS'] . " " . gettext("quick_ok_text") . gettext("glob_meldung_end");
			}
		}

	} // ende bei quick insert



	function quick_kfztour() {
		$timestamp = time();

		// speichern KFZ DUMMY daten
		$_POST['KFZ_INDEXKEY'] = $timestamp; // f�r tour
		$_POST['FZ_INDEXKEY'] = $timestamp;
		$_POST['FZ_KENNZ'] = $timestamp;
		$_POST['FZ_ERSTZULASSUNG'] = ("{$_POST['1_yy']}-{$_POST['1_mm']}-{$_POST['1_dd']}");

		$sql = "INSERT INTO  {$_SESSION['SCEMA']}TKFZ
			( FZ_INDEXKEY, INDEXKEY, FZ_KENNZ, FZ_LAND,
			FZ_MARKE, FZ_TYPE, FZ_ERSTZULASSUNG,
			FZ_SCHADSTOFF, FZ_NOTIZ, FZ_ART)
			values	(
			'" . $_POST['FZ_INDEXKEY'] . "' ,
			'" . $_POST['INDEXKEY'] . "',
		 	'" . $_POST['FZ_KENNZ'] . "' ,
			'" . $_POST['FZ_LAND'] . "' ,
			'" . $_POST['FZ_MARKE'] . "' ,
			'" . $_POST['FZ_TYPE'] . "',
			'" . $_POST['FZ_ERSTZULASSUNG'] . "' ,
			'" . $_POST['FZ_SCHADSTOFF'] . "',
			'" . $_POST['FZ_NOTIZ'] . "' ,
			'" . $_POST['FZ_ART'] . "'
			)";

		//echo 'quick_kfztour - '.$sql ;
		IF ($_SESSION['DB'] == 'MY'){
			get_MY_connect($sql) ;
			$result = mysqli_query($_SESSION ['CONNECT'], $sql);
			if (!$result) {
				get_db2_conn_errormsg($_SESSION ['CONNECT'], $sql);
			}
		}else {
			get_DB2_connect($sql) ;
			$result = db2_execute($stmt);
			if (!$result) {
				get_db2_conn_errormsg($sql);
			}
		}

		//speicher partner
		$_POST['PART_INDEXKEY'] = $timestamp;
		$_POST['BIRTHDATE'] = ("{$_POST['1_yy']}-{$_POST['1_mm']}-{$_POST['1_dd']}");
		$_POST['DRV_DATE'] = ("{$_POST['2_yy']}-{$_POST['2_mm']}-{$_POST['2_dd']}");
		//print_r($_POST);
		$sql = "INSERT INTO  {$_SESSION['SCEMA']}TPARTNER(INDEXKEY, PART_INDEXKEY, PREFIX, FIRSTNAME, LASTNAME, SUFFIX, ADDRESS,
			ADDRESSNUMBER, CITY, STATEPROVINCE, POSTALCODE, COUNTRY,  HOMEPHONE, CELLULARPHONE,
			LANG , EMAILADDRESS,  BIRTHDATE , DRV_LIZENZ, DRV_BEHOERDE, DRV_DATE, NOTE)
			VALUES(
			'" . $_POST['INDEXKEY'] . "',
			'" . $_POST['PART_INDEXKEY'] . "',
			'" . $_POST['PREFIX'] . "',
			'" . $_POST['FIRSTNAME'] . "',
			'" . $_POST['LASTNAME'] . "',
			'" . $_POST['SUFFIX'] . "',
			'" . $_POST['ADDRESS'] . "',
			'" . $_POST['ADDRESSNUMBER'] . "',
			'" . $_POST['CITY'] . "',
			'" . $_POST['STATEPROVINCE'] . "',
			'" . $_POST['POSTALCODE'] . "',
			'" . $_POST['COUNTRY'] . "',
			'" . $_POST['HOMEPHONE'] . "',
			'" . $_POST['CELLULARPHONE'] . "',
			'" . $_POST['LANG'] . "' ,
			'" . $_POST['EMAILADDRESS'] . "',
			'" . $_POST['BIRTHDATE'] . "' ,
			'" . $_POST['DRV_LIZENZ'] . "',
			'" . $_POST['DRV_BEHOERDE'] . "',
			'" . $_POST['DRV_DATE'] . "',
			'" . $_POST['NOTE'] . "')";

		//echo 'quick_kfztour - '.$sql ;
		IF ($_SESSION['DB'] == 'MY'){
			get_MY_connect($sql) ;
			$result = mysqli_query($_SESSION ['CONNECT'], $sql);
			if (!$result) {
				get_db2_conn_errormsg($_SESSION ['CONNECT'], $sql);
			}
		}else {
			get_DB2_connect($sql) ;
			$result = db2_execute($stmt);
			if (!$result) {
				get_db2_conn_errormsg($sql);
			}
		}

	} // ende bei quick insert
}
?>