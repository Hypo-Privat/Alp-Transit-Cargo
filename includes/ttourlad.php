<?php function tour_tbnew() {
	if (isset($_SESSION['angemeldet'])) {
		$timestamp = time();


		// wenn user quick angebot eingibt
		if ($_SESSION['quick'] == 1) {
			require_once 'quick_save.inc';
			quick_kunde();
		} // ende bei quick insert

		$_REQUEST['INDEXKEY'] = $_SESSION['INDEXKEY'] ;
		$_REQUEST['LADUNG_INDEXKEY'] = $timestamp ;
		$_REQUEST['AB_DAT'] = ("{$_REQUEST['1_yy']}-{$_REQUEST['1_mm']}-{$_REQUEST['1_dd']}") ;
		$_REQUEST['AN_DAT'] = ("{$_REQUEST['2_yy']}-{$_REQUEST['2_mm']}-{$_REQUEST['2_dd']}") ;
		$_REQUEST['NOTE']  = normalize($_REQUEST['NOTE'] );
		$_REQUEST['NOTE'] = substr($_REQUEST['NOTE'], 0, 250);


		$sql = "INSERT INTO  {$_SESSION['SCEMA']}TTOURLAD
	( LADUNG_INDEXKEY, INDEXKEY, AB_DAT, AB_LAND, AB_PLZ, AB_ORT ,
	 AN_DAT, AN_LAND, AN_PLZ, AN_ORT, GEWICHT, VOLUMEN, ANZAHL, PACKART, KFZ_ART, NOTE)
	values	(
	 '".$_REQUEST['LADUNG_INDEXKEY']."' ,
 	'".$_REQUEST['INDEXKEY']."' ,
 	'".$_REQUEST['AB_DAT']."' ,
 	'".$_REQUEST['AB_LAND']."',
 	'".$_REQUEST['AB_PLZ']."' ,
 	'".$_REQUEST['AB_ORT']."',
 	'".$_REQUEST['AN_DAT']."' ,
 	'".$_REQUEST['AN_LAND']."',
 	'".$_REQUEST['AN_PLZ']."' ,
 	'".$_REQUEST['AN_ORT']."',
 	'".$_REQUEST['GEWICHT']."' ,
 	'".$_REQUEST['VOLUMEN']."',
 	'".$_REQUEST['ANZAHL']."',
 	'".$_REQUEST['PAKART']."',
 	'".$_REQUEST['KFZ_ART']."',
 	'".$_REQUEST['NOTE']."' )";

		//echo 'tourlad_list - '.$sql ;
		IF ($_SESSION['DB'] == 'MY'){
			get_MY_connect($sql) ;
			$result = mysqli_query($_SESSION ['CONNECT'], $sql);
			if (!$result) {
				get_db2_stmt_errormsg($sql);
			}else{
				//     echo $sql;
				mail('facebook@a-t-c.ch',  $sql, "From: new-lad@a-t-c.ch");
				echo gettext("glob_meldung").gettext("tour_tbins_ok").gettext("glob_meldung_end") ;

			}
		}else {
			get_DB2_connect($sql) ;
			$result = db2_execute($stmt);
			if (!$result) {
				get_db2_stmt_errormsg($sql);
			}else{
				//     echo $sql;
				mail('facebook@a-t-c.ch',  $sql, "From: new-lad@a-t-c.ch");
				echo gettext("glob_meldung").gettext("tour_tbins_ok").gettext("glob_meldung_end") ;

			}
		}
	}
}

function tour_tbupd(){

	$_REQUEST['AB_DAT'] = ("{$_REQUEST['1_yy']}-{$_REQUEST['1_mm']}-{$_REQUEST['1_dd']}") ;
	$_REQUEST['AN_DAT'] = ("{$_REQUEST['2_yy']}-{$_REQUEST['2_mm']}-{$_REQUEST['2_dd']}") ;

	$_REQUEST['NOTE']  = normalize($_REQUEST['NOTE'] );
	$_REQUEST['NOTE'] = substr($_REQUEST['NOTE'], 0, 250);

	IF ($_SESSION['DB'] == 'DB2'){
		$sql = "update  {$_SESSION['SCEMA']}TTOURLAD
	set (  	AB_DAT, AB_LAND, AB_PLZ, AB_ORT , AN_DAT, AN_LAND, AN_PLZ, AN_ORT, 
			GEWICHT, VOLUMEN, ANZAHL, PACKART, KFZ_ART, NOTE )=
	(
 	'".$_REQUEST['AB_DAT']."' ,
 	'".$_REQUEST['AB_LAND']."',
 	'".$_REQUEST['AB_PLZ']."' ,
 	'".$_REQUEST['AB_ORT']."',
 	'".$_REQUEST['AN_DAT']."' ,
 	'".$_REQUEST['AN_LAND']."',
 	'".$_REQUEST['AN_PLZ']."' ,
 	'".$_REQUEST['AN_ORT']."',
 	'".$_REQUEST['GEWICHT']."' ,
 	'".$_REQUEST['VOLUMEN']."',
 	'".$_REQUEST['ANZAHL']."',
 	'".$_REQUEST['PACKART']."',
 	'".$_REQUEST['KFZ_ART']."',
 	'".$_REQUEST['NOTE']."' 	)
	WHERE	indexkey = '{$_SESSION['INDEXKEY']}'
	and LADUNG_INDEXKEY= '{$_SESSION['LADUNG_INDEXKEY']}'";
	}

	IF ($_SESSION['DB'] == 'MY'){
		$sql = "update  {$_SESSION['SCEMA']}TTOURLAD
	set 
 	AB_DAT = '".$_REQUEST['AB_DAT']."' ,
 	AB_LAND = '".$_REQUEST['AB_LAND']."',
 	AB_PLZ = '".$_REQUEST['AB_PLZ']."' ,
 	AB_ORT  = '".$_REQUEST['AB_ORT']."',
 	AN_DAT = '".$_REQUEST['AN_DAT']."' ,
 	AN_LAND = '".$_REQUEST['AN_LAND']."',
 	AN_PLZ = '".$_REQUEST['AN_PLZ']."' ,
 	AN_ORT = '".$_REQUEST['AN_ORT']."',
 	GEWICHT = '".$_REQUEST['GEWICHT']."' ,
 	VOLUMEN = '".$_REQUEST['VOLUMEN']."',
 	ANZAHL = '".$_REQUEST['ANZAHL']."',
 	PACKART = '".$_REQUEST['PACKART']."',
 	KFZ_ART = '".$_REQUEST['KFZ_ART']."',
 	NOTE = '".$_REQUEST['NOTE']."' 	
	WHERE	indexkey = '{$_SESSION['INDEXKEY']}'
	and LADUNG_INDEXKEY= '{$_SESSION['LADUNG_INDEXKEY']}'";
	}

	//echo 'tour_tbupd - '.$sql ;
	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect($sql) ;
		$result = mysqli_query($_SESSION ['CONNECT'], $sql);
		if (!$result) {
			get_db2_stmt_errormsg($sql);
		}else{
			//     echo $sql;
			echo gettext("glob_meldung").gettext("tour_tbupd_ok").gettext("glob_meldung_end") ;
		}
	}else {
		get_DB2_connect($sql) ;
		$result = db2_execute($stmt);
		if (!$result) {
			get_db2_stmt_errormsg($sql);
		}else{
			//     echo $sql;
			echo gettext("glob_meldung").gettext("tour_tbupd_ok").gettext("glob_meldung_end") ;
		}
	}
}
function tour_tbdel($value){

	//Status delete wenn an_dat = "01-01-1111"

	$_REQUEST['LADUNG_INDEXKEY'] = $value ;
	$_REQUEST['AN_DAT'] = ("1111-01-01") ;

	IF ($_SESSION['DB'] == 'MY'){
		$sql = "update  {$_SESSION['SCEMA']}TTOURLAD
			set   AN_DAT =	'".$_REQUEST['AN_DAT']."' 
			WHERE	indexkey = '{$_SESSION['INDEXKEY']}'
			and LADUNG_INDEXKEY = '{$_REQUEST['LADUNG_INDEXKEY']}'";
	}

	IF ($_SESSION['DB'] == 'DB2'){
		$sql = "update  {$_SESSION['SCEMA']}TTOURLAD
			set (  AN_DAT )=	('".$_REQUEST['AN_DAT']."' )
			WHERE	indexkey = '{$_SESSION['INDEXKEY']}'
			and LADUNG_INDEXKEY = '{$_REQUEST['LADUNG_INDEXKEY']}'";
	}
	//echo 'tour_tbupd - '.$sql ;
	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect($sql) ;
		$result = mysqli_query($_SESSION ['CONNECT'], $sql);
		if (!$result) {
			get_db2_stmt_errormsg($sql);
		}else{
			//     echo $sql;
			echo gettext("glob_meldung").gettext("tour_tbdel_ok").gettext("glob_meldung_end") ;

		}
	}else {
		get_DB2_connect($sql) ;
		$result = db2_execute($stmt);
		if (!$result) {
			get_db2_stmt_errormsg($sql);
		}else{
			//     echo $sql;
			echo gettext("glob_meldung").gettext("tour_tbdel_ok").gettext("glob_meldung_end") ;

		}
	}

}

?>

