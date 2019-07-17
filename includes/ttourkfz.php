<?php function tour_tbnew() {
	if (isset($_SESSION['angemeldet'])){
		$timestamp = time();
		// wenn user quick angebot eingibt
		if ($_SESSION['quick'] == 1) {
			require_once 'quick_save.inc';
			quick_kunde();
			quick_kfztour();

		} // ende bei quick insert

		$_REQUEST['INDEXKEY'] = $_SESSION['INDEXKEY'];
		$_REQUEST['TOUR_INDEXKEY'] = $timestamp;
		$_REQUEST['AB_DAT'] = ("{$_REQUEST['1_yy']}-{$_REQUEST['1_mm']}-{$_REQUEST['1_dd']}");
		$_REQUEST['AN_DAT'] = ("{$_REQUEST['2_yy']}-{$_REQUEST['2_mm']}-{$_REQUEST['2_dd']}");

		$_REQUEST['NOTE']  = normalize($_REQUEST['NOTE'] );
		$_REQUEST['NOTE'] = substr($_REQUEST['NOTE'], 0, 250);

		$sql = "INSERT INTO  {$_SESSION['SCEMA']}TTOURKFZ
						( TOUR_INDEXKEY, INDEXKEY, KFZ_INDEXKEY, PART_INDEXKEY,	AB_DAT, AB_LAND, AB_PLZ, AB_ORT ,
						 AN_DAT, AN_LAND, AN_PLZ, AN_ORT, GEWICHT, VOLUMEN, NOTE)
						values	(
						'" . $_REQUEST['TOUR_INDEXKEY'] . "' ,
					 	'" . $_REQUEST['INDEXKEY'] . "',
					 	'" . $_REQUEST['KFZ_INDEXKEY'] . "' ,
					 	'" . $_REQUEST['PART_INDEXKEY'] . "' ,
					 	'" . $_REQUEST['AB_DAT'] . "' ,
					 	'" . $_REQUEST['AB_LAND'] . "',
					 	'" . $_REQUEST['AB_PLZ'] . "' ,
					 	'" . $_REQUEST['AB_ORT'] . "',
					 	'" . $_REQUEST['AN_DAT'] . "' ,
					 	'" . $_REQUEST['AN_LAND'] . "',
					 	'" . $_REQUEST['AN_PLZ'] . "' ,
					 	'" . $_REQUEST['AN_ORT'] . "',
					 	'" . $_REQUEST['GEWICHT'] . "' ,
					 	'" . $_REQUEST['VOLUMEN'] . "',
					 	'" . $_REQUEST['NOTE'] . "' )";

		//echo 'tour_tbnew - '.$sql ;
		IF ($_SESSION['DB'] == 'MY'){
			get_MY_connect($sql) ;
			$result = mysqli_query($_SESSION ['CONNECT'], $sql);
			if (!$result) {
				get_db2_stmt_errormsg($sql);
			} else {
				//     echo $sql;
				mail('facebook@a-t-c.ch',  $sql, "From: new-kfz@a-t-c.ch");
				echo gettext("glob_meldung") . gettext("tour_tbins_ok") . gettext("glob_meldung_end");
			}

		}else {
			get_DB2_connect($sql) ;
			if (!$result) {
				get_db2_stmt_errormsg($sql);
			} else {
				//     echo $sql;
				mail('facebook@a-t-c.ch',  $sql, "From: new-kfz@a-t-c.ch");
				echo gettext("glob_meldung") . gettext("tour_tbins_ok") . gettext("glob_meldung_end");
			}
		}
	}


}

function tour_tbupd() {

	$_REQUEST['AB_DAT'] = ("{$_REQUEST['1_yy']}-{$_REQUEST['1_mm']}-{$_REQUEST['1_dd']}");
	$_REQUEST['AN_DAT'] = ("{$_REQUEST['2_yy']}-{$_REQUEST['2_mm']}-{$_REQUEST['2_dd']}");
	$_REQUEST['NOTE']  = normalize($_REQUEST['NOTE'] );
	$_REQUEST['NOTE'] = substr($_REQUEST['NOTE'], 0, 250);

	IF ($_SESSION['DB'] == 'DB2'){
		$sql = "update  {$_SESSION['SCEMA']}TTOURKFZ
						set (  KFZ_INDEXKEY, PART_INDEXKEY,	AB_DAT, AB_LAND, AB_PLZ, AB_ORT ,
						 AN_DAT, AN_LAND, AN_PLZ, AN_ORT, GEWICHT, VOLUMEN, NOTE )=
						(
						 '" . $_REQUEST['KFZ_INDEXKEY'] . "' ,
					 	'" . $_REQUEST['PART_INDEXKEY'] . "' ,
					 	'" . $_REQUEST['AB_DAT'] . "' ,
					 	'" . $_REQUEST['AB_LAND'] . "',
					 	'" . $_REQUEST['AB_PLZ'] . "' ,
					 	'" . $_REQUEST['AB_ORT'] . "',
					 	'" . $_REQUEST['AN_DAT'] . "' ,
					 	'" . $_REQUEST['AN_LAND'] . "',
					 	'" . $_REQUEST['AN_PLZ'] . "' ,
					 	'" . $_REQUEST['AN_ORT'] . "',
					 	'" . $_REQUEST['GEWICHT'] . "' ,
					 	'" . $_REQUEST['VOLUMEN'] . "',
					 	'" . $_REQUEST['NOTE'] . "' 	)
						WHERE	indexkey = '{$_SESSION['INDEXKEY']}'
						and TOUR_INDEXKEY= '{$_SESSION['TOUR_INDEXKEY']}'";
	}
	IF ($_SESSION['DB'] == 'MY'){
		$sql = "update  {$_SESSION['SCEMA']}TTOURKFZ
						set 
						KFZ_INDEXKEY = '" . $_REQUEST['KFZ_INDEXKEY'] . "' ,
					 	PART_INDEXKEY = '" . $_REQUEST['PART_INDEXKEY'] . "' ,
					 	AB_DAT = '" . $_REQUEST['AB_DAT'] . "' ,
					 	AB_LAND = '" . $_REQUEST['AB_LAND'] . "',
					 	AB_PLZ = '" . $_REQUEST['AB_PLZ'] . "' ,
					 	AB_ORT ='" . $_REQUEST['AB_ORT'] . "',
					 	 AN_DAT = '" . $_REQUEST['AN_DAT'] . "' ,
					 	AN_LAND = '" . $_REQUEST['AN_LAND'] . "',
					 	AN_PLZ = '" . $_REQUEST['AN_PLZ'] . "' ,
					 	 AN_ORT ='" . $_REQUEST['AN_ORT'] . "',
					 	GEWICHT = '" . $_REQUEST['GEWICHT'] . "' ,
					 	VOLUMEN = '" . $_REQUEST['VOLUMEN'] . "',
					 	NOTE = '" . $_REQUEST['NOTE'] . "' 	
						WHERE	indexkey = '{$_SESSION['INDEXKEY']}'
						and TOUR_INDEXKEY= '{$_SESSION['TOUR_INDEXKEY']}'";
	}

	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect($sql) ;
		$result = mysqli_query($_SESSION ['CONNECT'], $sql) ;
		if (!$result) {
			get_db2_stmt_errormsg($sql);
		} else {
			echo gettext("glob_meldung") . gettext("tour_tbupd_ok") . gettext("glob_meldung_end");	}
	}else {
		get_DB2_connect($sql) ;
		if (!$result) {
			get_db2_stmt_errormsg($sql);
		} else {
			echo gettext("glob_meldung") . gettext("tour_tbupd_ok") . gettext("glob_meldung_end");
		}
	}

}



function tour_tbdel($value) {

	//Status delete wenn an_dat = "01-01-1111"

	$_REQUEST['TOUR_INDEXKEY'] = $value;
	$_REQUEST['AN_DAT'] = ("1111-01-01");

	IF ($_SESSION['DB'] == 'DB2'){
		$sql = "update  {$_SESSION['SCEMA']}TTOURKFZ
						set (  AN_DAT )=	('" . $_REQUEST['AN_DAT'] . "' )
						WHERE	indexkey = '{$_SESSION['INDEXKEY']}'
						and TOUR_INDEXKEY = '{$_REQUEST['TOUR_INDEXKEY']}'";
	}

	IF ($_SESSION['DB'] == 'MY'){
		$sql = "update  {$_SESSION['SCEMA']}TTOURKFZ
						set   AN_DAT =	'" . $_REQUEST['AN_DAT'] . "' 
						WHERE	indexkey = '{$_SESSION['INDEXKEY']}'
						and TOUR_INDEXKEY = '{$_REQUEST['TOUR_INDEXKEY']}'";
	}

	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect($sql) ;
		$result = mysqli_query($_SESSION ['CONNECT'], $sql);
		if (!$result) {
			get_db2_stmt_errormsg($sql);
		} else {
			echo gettext("glob_meldung") . gettext("tour_tbdel_ok") . gettext("glob_meldung_end");
		}
	}else {
		get_DB2_connect($sql) ;
		if (!$result) {
			get_db2_stmt_errormsg($sql);
		} else {
			echo gettext("glob_meldung") . gettext("tour_tbdel_ok") . gettext("glob_meldung_end");
		}
	}

}
?>

