<?php function user_new() {

	$timestamp = time();
	$datum = date("Ymd",$timestamp);
	$uhrzeit = date("His",$timestamp);
	//echo $datum," - ",$uhrzeit," Uhr";
	//echo   $datum = date("d.m.Y",$timestamp);
	//echo 'post ' , '<br>';
	//var_dump($_POST);
	//echo 'session ' , '<br>';
	//var_dump($_SESSION);
	if (!empty($_SESSION['INDEXKEY'])){
		$_POST['INDEXKEY'] = $_SESSION['INDEXKEY'] ;
	} else  { $_POST['INDEXKEY'] = $timestamp ; }

	if (empty($_POST['LANG'])){
		$_POST['LANG'] = $_SESSION['LANG'] ;}

		$sql = "INSERT INTO  {$_SESSION['SCEMA']}TCONTACTS
			( EMAILADDRESS , INDEXKEY, PWD, LANG, AGB )
		VALUES(	'".$_POST['EMAILADDRESS']."' , '".$_POST['INDEXKEY']."', '".$_POST['PWD']."' ,
					'".$_POST['LANG']."', '".$_POST['AGB']."')";

		IF ($_SESSION['DB'] == 'DB2'){
			//echo 'New-user - DB2  '.$sql ;
			get_DB2_connect($sql) ;
			$result = db2_execute($stmt);
		}else {
			//echo 'New-user - MY '.$sql ;
			get_MY_connect($sql) ;
			$result = mysqli_query($_SESSION ['CONNECT'], $sql);
		}

		$_SESSION['INDEXKEY'] = $_POST['INDEXKEY'] ;
		$_SESSION['EMAILADDRESS'] = $_POST['EMAILADDRESS'] ;
		$_SESSION['LANG'] = $_POST['LANG'] ;
		//$_SESSION['angemeldet'] = true;
		// jetzt kann usere sein profil bearbeiten
		//echo ' user_new 2 ***$_SESSION[LANG] = ' ,  $_SESSION['LANG'];
		echo "<table width='700'><tr><td class='titel'>";
		echo  gettext('glob_eingelogged_head');
		echo "	</td></tr>	<tr><td class='typ1'>";
		echo  gettext('glob_eingelogged_text').gettext('glob_eingelogged_help');
		echo "	</td></tr>	</table>";

		$m = mail_reguser($_POST);
		mail('facebook@a-t-c.ch',  $sql, "From: new-kunde@a-t-c.ch");

}


function user_upd(){
	//print_r($_POST);

	$_POST['BIRTHDATE'] = ("{$_POST['1_yy']}-{$_POST['1_mm']}-{$_POST['1_dd']}") ;
	$_POST['NOTE']  = normalize($_POST['NOTE'] );
	$_POST['NOTE'] = substr($_POST['NOTE'], 0, 250);


	//echo 'user_upd - '.$sql ;
	IF ($_SESSION['DB'] == 'MY'){
		$sql = "update  {$_SESSION['SCEMA']}TCONTACTS
	set
	PREFIX	= '".$_POST['PREFIX']."',
	FIRSTNAME = '".$_POST['FIRSTNAME']."',
	LASTNAME = '".$_POST['LASTNAME']."',
	SUFFIX = '".$_POST['SUFFIX']."',
	COMPANYNAME = '".$_POST['COMPANYNAME']."',
	ADDRESS = '".$_POST['ADDRESS']."',
	CITY = '".$_POST['CITY']."',
	STATEPROVINCE = '".$_POST['STATEPROVINCE']."',
	POSTALCODE = '".$_POST['POSTALCODE']."',
	COUNTRY = '".$_POST['COUNTRY']."',
	OFFICEPHONE = '".$_POST['OFFICEPHONE']."',
	HOMEPHONE = '".$_POST['HOMEPHONE']."',
	FAXPHONE = '".$_POST['FAXPHONE']."',
	CELLULARPHONE = '".$_POST['CELLULARPHONE']."',
	PAGERPHONE = '".$_POST['PAGERPHONE']."',
	BIRTHDATE = '".$_POST['BIRTHDATE']."' ,
	URL = '".$_POST['URL']."',
	NOTE = '".$_POST['NOTE']."',
	ADDRESSNUMBER = '".$_POST['ADDRESSNUMBER']."',
	LANG = '".$_POST['LANG']."' ,
	AGB = '".$_POST['AGB']."'
	WHERE	indexkey = '{$_SESSION['INDEXKEY']}'
	and emailaddress = '{$_SESSION['EMAILADDRESS']}'";

	}

	IF ($_SESSION['DB'] == 'DB2') {
		$sql = "update  {$_SESSION['SCEMA']}TCONTACTS
	set (PREFIX, FIRSTNAME, LASTNAME, SUFFIX, COMPANYNAME, ADDRESS,
	CITY, STATEPROVINCE, POSTALCODE, COUNTRY, OFFICEPHONE, HOMEPHONE,
	FAXPHONE, CELLULARPHONE, PAGERPHONE,  BIRTHDATE , URL, NOTE,  ADDRESSNUMBER, LANG, AGB)
	= (	'".$_POST['PREFIX']."',
		'".$_POST['FIRSTNAME']."',
		'".$_POST['LASTNAME']."',
		'".$_POST['SUFFIX']."',
		'".$_POST['COMPANYNAME']."',
		'".$_POST['ADDRESS']."',
		'".$_POST['CITY']."',
		'".$_POST['STATEPROVINCE']."',
		'".$_POST['POSTALCODE']."',
		'".$_POST['COUNTRY']."',
		'".$_POST['OFFICEPHONE']."',
		'".$_POST['HOMEPHONE']."',
		'".$_POST['FAXPHONE']."',
		'".$_POST['CELLULARPHONE']."',
		'".$_POST['PAGERPHONE']."',
		'".$_POST['BIRTHDATE']."' ,
		'".$_POST['URL']."',
		'".$_POST['NOTE']."',
		'".$_POST['ADDRESSNUMBER']."',
		'".$_POST['LANG']."' ,
		'".$_POST['AGB']."')
	WHERE	indexkey = '{$_SESSION['INDEXKEY']}'
	and emailaddress = '{$_SESSION['EMAILADDRESS']}'";
	}

	//echo 'user_upd - '.$sql ;
	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect($sql) ;
		$result = mysqli_query($_SESSION ['CONNECT'], $sql);
		if (!$result) {
			get_db2_conn_errormsg($sql);
		}else{
			echo gettext("glob_meldung").gettext("cont_upd_ok").gettext("glob_meldung_end") ;
		}
	}else {
		get_DB2_connect($sql) ;
		$result = db2_execute($stmt);
		if (!$result) {
			get_db2_conn_errormsg($sql);
		}else{
			echo gettext("glob_meldung").gettext("cont_upd_ok").gettext("glob_meldung_end") ;
		}
	}

}

function user_upd_pwd(){
	//print_r($_POST);
	IF ($_SESSION['DB'] == 'DB2') {
		$sql = "update  {$_SESSION['SCEMA']}TCONTACTS
	set (PWD) = ('".$_POST['PWD']."')
	WHERE	indexkey = '{$_SESSION['INDEXKEY']}'
	and emailaddress = '{$_SESSION['EMAILADDRESS']}'";
	}

	IF ($_SESSION['DB'] == 'MY'){
		$sql = "update  {$_SESSION['SCEMA']}TCONTACTS
	set PWD = '".$_POST['PWD']."'
	WHERE	indexkey = '{$_SESSION['INDEXKEY']}'
	and emailaddress = '{$_SESSION['EMAILADDRESS']}'";
	}

	echo 'user_upd_pwd- '.$sql ;

	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect($sql) ;
		$result = mysqli_query($_SESSION ['CONNECT'], $sql);
		if (!$result) {
			get_db2_conn_errormsg($sql);
		}else{
			echo gettext("glob_meldung").gettext("cont_upd_ok").gettext("glob_meldung_end") ;
		}
	}else {
		get_DB2_connect($sql) ;
		$result = db2_execute($stmt);
		if (!$result) {
			get_db2_conn_errormsg($sql);
		}else{
			echo gettext("glob_meldung").gettext("cont_upd_ok").gettext("glob_meldung_end") ;
		}
	}

}
?>