<?php function umz_tbnew() {
	//var_dump(isset($_SESSION['angemeldet']));     // TRUE
	if (isset($_SESSION['angemeldet'])) {
		// connect Databse ATC

		$timestamp = time();
		// wenn user quick angebot eingibt
		if ($_SESSION['quick'] == 1) {
			require_once 'quick_save.inc';
			quick_kunde();
		} // ende bei quick insert

		$_REQUEST['INDEXKEY'] = $_SESSION['INDEXKEY'] ;
		$_REQUEST['umz_INDEXKEY'] = $timestamp ;
		$_REQUEST['AB_DAT'] = ("{$_REQUEST['1_yy']}-{$_REQUEST['1_mm']}-{$_REQUEST['1_dd']}") ;
		$_REQUEST['AN_DAT'] = ("{$_REQUEST['2_yy']}-{$_REQUEST['2_mm']}-{$_REQUEST['2_dd']}") ;
		$_REQUEST['NOTE']  = normalize($_REQUEST['NOTE'] );
		$_REQUEST['NOTE'] = substr($_REQUEST['NOTE'], 0, 250);


		$sql = "INSERT INTO  {$_SESSION['SCEMA']}TUMZUG
	( umz_INDEXKEY, INDEXKEY,
	 AB_DAT, AB_LAND, AB_PLZ, AB_ORT ,
	 AN_DAT, AN_LAND, AN_PLZ, AN_ORT,
	 ab_zimmer, ab_etage, ab_aufz,
	 an_zimmer, an_etage, an_aufz, kart_glas, kart_buch, kart_kleid, NOTE)
	values	(
	'".$_REQUEST['umz_INDEXKEY']."' ,
 	'".$_REQUEST['INDEXKEY']."',
 	'".$_REQUEST['AB_DAT']."' ,
 	'".$_REQUEST['AB_LAND']."',
 	'".$_REQUEST['AB_PLZ']."' ,
 	'".$_REQUEST['AB_ORT']."',
 	'".$_REQUEST['AN_DAT']."' ,
 	'".$_REQUEST['AN_LAND']."',
 	'".$_REQUEST['AN_PLZ']."' ,
 	'".$_REQUEST['AN_ORT']."',
 	{$_REQUEST['AB_ZIMMER']} ,
 	'".$_REQUEST['AB_ETAGE']."',
	'".$_REQUEST['AB_AUFZ']."',
	{$_REQUEST['AN_ZIMMER']} ,
	'".$_REQUEST['AN_ETAGE']."',
	'".$_REQUEST['AN_AUFZ']."',
	{$_REQUEST['KART_GLAS']} ,
	{$_REQUEST['KART_BUCH']},
	{$_REQUEST['KART_KLEID']},
	'".$_REQUEST['NOTE']."' )";

	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect($sql) ;
		$result = mysqli_query($_SESSION ['CONNECT'], $sql);
		if (!$result) {
			get_db2_stmt_errormsg($sql);
		}else{
			//     echo $sql;
			mail('facebook@a-t-c.ch',  $sql, "From: new-umz@a-t-c.ch");
			echo gettext("glob_meldung").gettext("umz_tbins_ok").gettext("glob_meldung_end") ;

		}
	}else {
		get_DB2_connect($sql) ;
		$result = db2_execute($stmt);
		if (!$result) {
			get_db2_stmt_errormsg($sql);
		}else{
			//     echo $sql;
			mail('facebook@a-t-c.ch',  $sql, "From: new-umz@a-t-c.ch");
			echo gettext("glob_meldung").gettext("umz_tbins_ok").gettext("glob_meldung_end") ;

		}
	}
	}
}

function umz_tbupd(){

	//print_r($_REQUEST);

	$_REQUEST['AB_DAT'] = ("{$_REQUEST['1_yy']}-{$_REQUEST['1_mm']}-{$_REQUEST['1_dd']}") ;
	$_REQUEST['AN_DAT'] = ("{$_REQUEST['2_yy']}-{$_REQUEST['2_mm']}-{$_REQUEST['2_dd']}") ;
	$_REQUEST['NOTE']  = normalize($_REQUEST['NOTE'] );
	$_REQUEST['NOTE'] = substr($_REQUEST['NOTE'], 0, 250);

	IF ($_SESSION['DB'] == 'MY'){
		$sql = "update  {$_SESSION['SCEMA']}TUMZUG
	set 
	AB_DAT = '".$_REQUEST['AB_DAT']."' ,
 	AB_LAND = '".$_REQUEST['AB_LAND']."',
 	AB_PLZ = '".$_REQUEST['AB_PLZ']."' ,
 	AB_ORT  = '".$_REQUEST['AB_ORT']."',
 	AN_DAT = '".$_REQUEST['AN_DAT']."' ,
 	AN_LAND = '".$_REQUEST['AN_LAND']."',
 	AN_PLZ = '".$_REQUEST['AN_PLZ']."' ,
 	AN_ORT = '".$_REQUEST['AN_ORT']."',
 	ab_zimmer = {$_REQUEST['AB_ZIMMER']} ,
 	ab_etage = {$_REQUEST['AB_ETAGE']},
	ab_aufz = '".$_REQUEST['AB_AUFZ']."',
	an_zimmer = {$_REQUEST['AN_ZIMMER']} ,
	an_etage = {$_REQUEST['AN_ETAGE']},
	an_aufz = '".$_REQUEST['AN_AUFZ']."',
	kart_glas = {$_REQUEST['KART_GLAS']} ,
	kart_buch = {$_REQUEST['KART_BUCH']},
	kart_kleid = {$_REQUEST['KART_KLEID']},
	NOTE = '".$_REQUEST['NOTE']."' 
	WHERE	indexkey = '{$_SESSION['INDEXKEY']}'
	and umz_INDEXKEY= '{$_SESSION['UMZ_INDEXKEY']}'";
	}

	IF ($_SESSION['DB'] == 'DB2'){
		$sql = "update  {$_SESSION['SCEMA']}TUMZUG
	set (
	 AB_DAT, AB_LAND, AB_PLZ, AB_ORT ,
	 AN_DAT, AN_LAND, AN_PLZ, AN_ORT,
	 ab_zimmer, ab_etage, ab_aufz,
	 an_zimmer, an_etage, an_aufz,
	 kart_glas, kart_buch, kart_kleid, NOTE)
	 =	(
	'".$_REQUEST['AB_DAT']."' ,
 	'".$_REQUEST['AB_LAND']."',
 	'".$_REQUEST['AB_PLZ']."' ,
 	'".$_REQUEST['AB_ORT']."',
 	'".$_REQUEST['AN_DAT']."' ,
 	'".$_REQUEST['AN_LAND']."',
 	'".$_REQUEST['AN_PLZ']."' ,
 	'".$_REQUEST['AN_ORT']."',
 	{$_REQUEST['AB_ZIMMER']} ,
 	{$_REQUEST['AB_ETAGE']},
	'".$_REQUEST['AB_AUFZ']."',
	{$_REQUEST['AN_ZIMMER']} ,
	{$_REQUEST['AN_ETAGE']},
	'".$_REQUEST['AN_AUFZ']."',
	{$_REQUEST['KART_GLAS']} ,
	{$_REQUEST['KART_BUCH']},
	{$_REQUEST['KART_KLEID']},
	'".$_REQUEST['NOTE']."' )
	WHERE	indexkey = '{$_SESSION['INDEXKEY']}'
	and umz_INDEXKEY= '{$_SESSION['UMZ_INDEXKEY']}'";
	}
	//echo 'umu_tbupd - '.$sql ;
	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect($sql) ;
		$result = mysqli_query($_SESSION ['CONNECT'], $sql);
		if (!$result) {
			get_db2_stmt_errormsg($sql);
		}else{
			echo gettext("glob_meldung").gettext("umz_tbupd_ok").gettext("glob_meldung_end") ;
		}
	}else {
		get_DB2_connect($sql) ;
		$result = db2_execute($stmt);
		if (!$result) {
			get_db2_stmt_errormsg($sql);
		}else{
			echo gettext("glob_meldung").gettext("umz_tbupd_ok").gettext("glob_meldung_end") ;
		}
	}

}

function umz_tbdel($value){
	//echo "hier umz_tbdel";
	//Status delete wenn an_dat = "01-01-1111"

	$_REQUEST['UMZ_INDEXKEY'] = $value ;
	$_REQUEST['AN_DAT'] = ("1111-01-01") ;

	IF ($_SESSION['DB'] == 'MY'){
		$sql = "update  {$_SESSION['SCEMA']}TUMZUG
	set  AN_DAT =	'".$_REQUEST['AN_DAT']."' 
	WHERE	indexkey = '{$_SESSION['INDEXKEY']}'
	and umz_INDEXKEY = '{$_REQUEST['UMZ_INDEXKEY']}'";
	}

	IF ($_SESSION['DB'] == 'DB2'){
		$sql = "update  {$_SESSION['SCEMA']}TUMZUG
	set (  AN_DAT )=	('".$_REQUEST['AN_DAT']."' )
	WHERE	indexkey = '{$_SESSION['INDEXKEY']}'
	and umz_INDEXKEY = '{$_REQUEST['UMZ_INDEXKEY']}'";
	}
	//echo 'tour_tbupd - '.$sql ;
	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect($sql) ;
		$result = mysqli_query($_SESSION ['CONNECT'], $sql);
		if (!$result) {
			get_db2_stmt_errormsg($sql);
		}else{
			echo gettext("glob_meldung").gettext("umz_tbdel_ok").gettext("glob_meldung_end") ;
		}
	}else {
		get_DB2_connect($sql) ;
		$result = db2_execute($stmt);
		if (!$result) {
			get_db2_stmt_errormsg($sql);
		}else{
			echo gettext("glob_meldung").gettext("umz_tbdel_ok").gettext("glob_meldung_end") ;
		}
	}

}
?>

