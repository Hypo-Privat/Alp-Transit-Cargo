<?php function part_tbnew() {
	if (isset($_SESSION['angemeldet'])) {
		$timestamp = time();
		$datum = date("Ymd", $timestamp);
		$uhrzeit = date("His", $timestamp);
		//echo $datum," - ",$uhrzeit," Uhr";
		//echo   $datum = date("d.m.Y",$timestamp);
		//print_r($_SESSION);
		$_REQUEST['INDEXKEY'] = $_SESSION['INDEXKEY'];
		$_REQUEST['PART_INDEXKEY'] = $timestamp;
		if (!$_REQUEST['1_yy']) {
			$_REQUEST['BIRTHDATE'] = $_REQUEST['AB_DATE'];
		} else {
			$_REQUEST['BIRTHDATE'] = ("{$_REQUEST['1_yy']}-{$_REQUEST['1_mm']}-{$_REQUEST['1_dd']}");
		}
		if (!$_REQUEST['2_yy']) {
			$_REQUEST['DRV_DATE'] = $_REQUEST['AB_DATE'];
		} else {
			$_REQUEST['DRV_DATE'] = ("{$_REQUEST['2_yy']}-{$_REQUEST['2_mm']}-{$_REQUEST['2_dd']}");
		}
		$_REQUEST['NOTE']  = normalize($_REQUEST['NOTE'] );
		$_REQUEST['NOTE'] = substr($_REQUEST['NOTE'], 0, 250);

		//print_r($_REQUEST);
		$sql = "INSERT INTO  {$_SESSION['SCEMA']}TPARTNER
		(INDEXKEY, PART_INDEXKEY, PREFIX, FIRSTNAME, LASTNAME, SUFFIX, ADDRESS,
		ADDRESSNUMBER, CITY, STATEPROVINCE, POSTALCODE, COUNTRY,  HOMEPHONE, CELLULARPHONE,
		LANG , EMAILADDRESS,  BIRTHDATE , DRV_LIZENZ, DRV_BEHOERDE, DRV_DATE, NOTE)
		VALUES(
		'" . $_REQUEST['INDEXKEY'] . "',
		'" . $_REQUEST['PART_INDEXKEY'] . "',
		'" . $_REQUEST['PREFIX'] . "',
	'" . $_REQUEST['FIRSTNAME'] . "',
	'" . $_REQUEST['LASTNAME'] . "',
	'" . $_REQUEST['SUFFIX'] . "',
	'" . $_REQUEST['ADDRESS'] . "',
	'" . $_REQUEST['ADDRESSNUMBER'] . "',
	'" . $_REQUEST['CITY'] . "',
	'" . $_REQUEST['STATEPROVINCE'] . "',
	'" . $_REQUEST['POSTALCODE'] . "',
	'" . $_REQUEST['COUNTRY'] . "',
	'" . $_REQUEST['HOMEPHONE'] . "',
	'" . $_REQUEST['CELLULARPHONE'] . "',
	'" . $_REQUEST['LANG'] . "' ,
	'" . $_REQUEST['EMAILADDRESS'] . "',
	'" . $_REQUEST['BIRTHDATE'] . "' ,
	'" . $_REQUEST['DRV_LIZENZ'] . "',
	'" . $_REQUEST['DRV_BEHOERDE'] . "',
	'" . $_REQUEST['DRV_DATE'] . "',
	'" . $_REQUEST['NOTE'] . "')";

		IF ($_SESSION['DB'] == 'MY'){
			get_MY_connect($sql) ;
			$result = mysqli_query($_SESSION ['CONNECT'], $sql);
			if (!$result) {
				get_db2_stmt_errormsg($sql);
			} else {
				echo gettext("glob_meldung") . gettext("partner_new_ok") . gettext("glob_meldung_end");
			}

		}else {
			get_DB2_connect($sql) ;
			if (!$result) {
				get_db2_stmt_errormsg($sql);
			} else {
				echo gettext("glob_meldung") . gettext("partner_new_ok") . gettext("glob_meldung_end");
			}
		}
		
	}

}


function partner_tbupd() {

	$_REQUEST['BIRTHDATE'] = ("{$_REQUEST['1_yy']}-{$_REQUEST['1_mm']}-{$_REQUEST['1_dd']}");
	$_REQUEST['DRV_DATE'] = ("{$_REQUEST['2_yy']}-{$_REQUEST['2_mm']}-{$_REQUEST['2_dd']}");
	$_REQUEST['NOTE']  = normalize($_REQUEST['NOTE'] );
	$_REQUEST['NOTE'] = substr($_REQUEST['NOTE'], 0, 250);

	IF ($_SESSION['DB'] == 'DB2'){
		$sql = "update  {$_SESSION['SCEMA']}TPARTNER
			set (  PREFIX, FIRSTNAME, LASTNAME, SUFFIX, ADDRESS,
			ADDRESSNUMBER, CITY, STATEPROVINCE, POSTALCODE, COUNTRY,  HOMEPHONE, CELLULARPHONE,
			LANG , EMAILADDRESS,  BIRTHDATE , DRV_LIZENZ, DRV_BEHOERDE, DRV_DATE, NOTE )
			=	(
			'" . $_REQUEST['PREFIX'] . "',
		'" . $_REQUEST['FIRSTNAME'] . "',
		'" . $_REQUEST['LASTNAME'] . "',
		'" . $_REQUEST['SUFFIX'] . "',
		'" . $_REQUEST['ADDRESS'] . "',
		'" . $_REQUEST['ADDRESSNUMBER'] . "',
		'" . $_REQUEST['CITY'] . "',
		'" . $_REQUEST['STATEPROVINCE'] . "',
		'" . $_REQUEST['POSTALCODE'] . "',
		'" . $_REQUEST['COUNTRY'] . "',
		'" . $_REQUEST['HOMEPHONE'] . "',
		'" . $_REQUEST['CELLULARPHONE'] . "',
		'" . $_REQUEST['LANG'] . "' ,
		'" . $_REQUEST['EMAILADDRESS'] . "',
		'" . $_REQUEST['BIRTHDATE'] . "' ,
		'" . $_REQUEST['DRV_LIZENZ'] . "',
		'" . $_REQUEST['DRV_BEHOERDE'] . "',
		'" . $_REQUEST['DRV_DATE'] . "',
		'" . $_REQUEST['NOTE'] . "'
			)
			WHERE	indexkey = '{$_SESSION['INDEXKEY']}'
			and part_indexkey  = '{$_SESSION['PART_INDEXKEY']}'";
	}


	IF ($_SESSION['DB'] == 'MY'){
		$sql = "update  {$_SESSION['SCEMA']}TPARTNER
			set 
			PREFIX = '" . $_REQUEST['PREFIX'] . "',
			FIRSTNAME = '" . $_REQUEST['FIRSTNAME'] . "',
			LASTNAME = '" . $_REQUEST['LASTNAME'] . "',
			SUFFIX = '" . $_REQUEST['SUFFIX'] . "',
			ADDRESS = '" . $_REQUEST['ADDRESS'] . "',
			ADDRESSNUMBER = '" . $_REQUEST['ADDRESSNUMBER'] . "',
			CITY = '" . $_REQUEST['CITY'] . "',
			STATEPROVINCE = '" . $_REQUEST['STATEPROVINCE'] . "',
			POSTALCODE  = '" . $_REQUEST['POSTALCODE'] . "',
			COUNTRY = '" . $_REQUEST['COUNTRY'] . "',
			HOMEPHONE = '" . $_REQUEST['HOMEPHONE'] . "',
			CELLULARPHONE = '" . $_REQUEST['CELLULARPHONE'] . "',
			LANG = '" . $_REQUEST['LANG'] . "' ,
			EMAILADDRESS = '" . $_REQUEST['EMAILADDRESS'] . "',
			BIRTHDATE = '" . $_REQUEST['BIRTHDATE'] . "' ,
			DRV_LIZENZ = '" . $_REQUEST['DRV_LIZENZ'] . "',
			DRV_BEHOERDE = '" . $_REQUEST['DRV_BEHOERDE'] . "',
			DRV_DATE = '" . $_REQUEST['DRV_DATE'] . "',
			NOTE = '" . $_REQUEST['NOTE'] . "'
			
			WHERE	indexkey = '{$_SESSION['INDEXKEY']}'
			and part_indexkey  = '{$_SESSION['PART_INDEXKEY']}'";
	}
	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect($sql) ;
		$result = mysqli_query($_SESSION ['CONNECT'], $sql) ;
		if (!$result) {
			get_db2_stmt_errormsg($sql);
		} else {
			echo gettext("glob_meldung") . $_REQUEST['FIRSTNAME'] . $_REQUEST['LASTNAME'] . gettext("partner_tbupd_ok") . gettext("glob_meldung_end");
		}
	}else {
		get_DB2_connect($sql) ;
		if (!$result) {
			get_db2_stmt_errormsg($sql);
		} else {
			echo gettext("glob_meldung") . $_REQUEST['FIRSTNAME'] . $_REQUEST['LASTNAME'] . gettext("partner_tbupd_ok") . gettext("glob_meldung_end");
		}
	}

}


function partner_tbdel($value) {

	$_REQUEST['DRV_DATE'] = ("1111-01-01");

	$sql = "update  {$_SESSION['SCEMA']}TPARTNER
			set (  DRV_DATE )=	('" . $_REQUEST['DRV_DATE'] . "' )
			WHERE	indexkey = '{$_SESSION['INDEXKEY']}'
			and part_indexkey  = '$value'";

	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect($sql) ;
		$result = mysqli_query($_SESSION ['CONNECT'], $sql);
		if (!$result) {
			get_db2_stmt_errormsg($sql);
		} else {
			echo gettext("glob_meldung") . gettext("partner_tbdel_ok") . gettext("glob_meldung_end");
		}
	}else {
		get_DB2_connect($sql) ;
		if (!$result) {
			get_db2_stmt_errormsg($sql);
		} else {
			echo gettext("glob_meldung") . gettext("partner_tbdel_ok") . gettext("glob_meldung_end");
		}
	}
}
?>

