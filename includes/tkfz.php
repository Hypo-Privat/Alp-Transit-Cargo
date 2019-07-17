<?php function kfz_tbnew() {

	$timestamp = time();

	//echo $datum," - ",$uhrzeit," Uhr";
	//echo   $datum = date("d.m.Y",$timestamp);
	$_POST['INDEXKEY'] = $_SESSION['INDEXKEY'] ;
	$_POST['FZ_INDEXKEY'] = $timestamp ;
	if (!$_POST['1_yy']) {
		$_POST['FZ_ERSTZULASSUNG'] = $_POST['AB_DATE'];
	} else {
		$_POST['FZ_ERSTZULASSUNG'] = ("{$_POST['1_yy']}-{$_POST['1_mm']}-{$_POST['1_dd']}") ;
	}
	$_POST['FZ_NOTIZ']  = normalize($_POST['FZ_NOTIZ'] );
	$_POST['FZ_NOTIZ'] = substr($_POST['FZ_NOTIZ'], 0, 255);

	$sql = "INSERT INTO  {$_SESSION['SCEMA']}TKFZ
			( FZ_INDEXKEY, INDEXKEY, FZ_KENNZ, FZ_LAND,
			FZ_MARKE, FZ_TYPE, FZ_ERSTZULASSUNG,
			FZ_SCHADSTOFF, FZ_NOTIZ, FZ_ART)
			values	(
			'".$_POST['FZ_INDEXKEY']."' ,
 		'".$_POST['INDEXKEY']."',
 		'".$_POST['FZ_KENNZ']."' ,
 		'".$_POST['FZ_LAND']."' ,
 		'".$_POST['FZ_MARKE']."' ,
 		'".$_POST['FZ_TYPE']."',
 		'".$_POST['FZ_ERSTZULASSUNG']."' ,
 		'".$_POST['FZ_SCHADSTOFF']."',
 		'".$_POST['FZ_NOTIZ']."' ,
 		'".$_POST['FZ_ART']."'
		)";

	//echo 'kfz_tbnew - '.$sql ;
	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect($sql) ;
		$result = mysqli_query($_SESSION ['CONNECT'], $sql);
		echo gettext("glob_meldung").gettext("kfz_tbins_ok").gettext("glob_meldung_end") ;
	}else {
		get_DB2_connect($sql) ;
		$result = db2_execute($stmt);
		echo gettext("glob_meldung").gettext("kfz_tbins_ok").gettext("glob_meldung_end") ;
	}

}

function kfz_tbupd(){

	$_POST['FZ_ERSTZULASSUNG'] = ("{$_POST['1_yy']}-{$_POST['1_mm']}-{$_POST['1_dd']}") ;
	$_POST['FZ_NOTIZ']  = normalize($_POST['FZ_NOTIZ'] );
	$_POST['FZ_NOTIZ'] = substr($_POST['FZ_NOTIZ'], 0, 255);

	IF ($_SESSION['DB'] == 'MY'){
		$sql = "update  {$_SESSION['SCEMA']}TKFZ
		set
		FZ_LAND = '".$_POST['FZ_LAND']."' ,
 		FZ_MARKE = '".$_POST['FZ_MARKE']."' ,
 		FZ_TYPE = '".$_POST['FZ_TYPE']."',
 		FZ_ERSTZULASSUNG = '".$_POST['FZ_ERSTZULASSUNG']."' ,
 		FZ_SCHADSTOFF = '".$_POST['FZ_SCHADSTOFF']."',
 		FZ_NOTIZ = '".$_POST['FZ_NOTIZ']."' ,
 		FZ_ART = '".$_POST['FZ_ART']."'
		WHERE	indexkey = '{$_SESSION['INDEXKEY']}'
		and Fz_kennz = '{$_POST['FZ_KENNZ']}'";

	}

	IF ($_SESSION['DB'] == 'DB2'){
		$sql = "update  {$_SESSION['SCEMA']}TKFZ
		set (  FZ_LAND,	FZ_MARKE, FZ_TYPE, FZ_ERSTZULASSUNG, FZ_SCHADSTOFF, FZ_NOTIZ, FZ_ART )=
		(
		'".$_POST['FZ_LAND']."' ,
 		'".$_POST['FZ_MARKE']."' ,
 		'".$_POST['FZ_TYPE']."',
 		'".$_POST['FZ_ERSTZULASSUNG']."' ,
 		'".$_POST['FZ_SCHADSTOFF']."',
 		'".$_POST['FZ_NOTIZ']."' ,
 		'".$_POST['FZ_ART']."'
		)
		WHERE	indexkey = '{$_SESSION['INDEXKEY']}'
		and Fz_kennz = '{$_POST['FZ_KENNZ']}'";
	}

	//echo 'kfz_tbupd- '.$sql ;
	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect($sql) ;
		$result = mysqli_query($_SESSION ['CONNECT'], $sql);
		if (!$result) {
			get_db2_conn_errormsg($sql);
		}else{
			echo gettext("glob_meldung").$_POST['FZ_KENNZ'].gettext("kfz_tbupd_ok").gettext("glob_meldung_end") ;
		}
	}else {
		get_DB2_connect($sql) ;
		$result = db2_execute($stmt);
		if (!$result) {
			get_db2_conn_errormsg($sql);
		}else{
			echo gettext("glob_meldung").$_POST['FZ_KENNZ'].gettext("kfz_tbupd_ok").gettext("glob_meldung_end") ;
		}

	}
}

function kfz_tbdel($value){

	//Status delete wenn FZ_ERSTZULASSUNG = "01-01-1111"

	$_POST['FZ_KENNZ'] = $value ;
	$_POST['FZ_ERSTZULASSUNG'] = ("1111-01-01") ;

	IF ($_SESSION['DB'] == 'MY'){
		$sql = "update  {$_SESSION['SCEMA']}TKFZ
		set   FZ_ERSTZULASSUNG =	'".$_POST['FZ_ERSTZULASSUNG']."' 
		WHERE	indexkey = '{$_SESSION['INDEXKEY']}'
			and Fz_kennz = '{$_POST['FZ_KENNZ']}'";
	}
	IF ($_SESSION['DB'] == 'DB2'){
		$sql = "update  {$_SESSION['SCEMA']}TKFZ
		set (  FZ_ERSTZULASSUNG )=	('".$_POST['FZ_ERSTZULASSUNG']."' )
		WHERE	indexkey = '{$_SESSION['INDEXKEY']}'
			and Fz_kennz = '{$_POST['FZ_KENNZ']}'";
	}

	//echo 'kfz_tbdel- '.$sql ;
	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect($sql) ;
		$result = mysqli_query($_SESSION ['CONNECT'], $sql);
		if (!$result) {
			get_db2_conn_errormsg($sql);
		}else{
			echo gettext("glob_meldung").gettext("kfz_tbdel_ok").gettext("glob_meldung_end") ;
		}
	}else {
		get_DB2_connect($sql) ;
		$result = db2_execute($stmt);
		if (!$result) {
			get_db2_conn_errormsg($sql);
		}else{
			echo gettext("glob_meldung").gettext("kfz_tbdel_ok").gettext("glob_meldung_end") ;
		}
	}
}
?>

