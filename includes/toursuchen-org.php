<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE>Alp-Transit-Cargo A-T-C.CH</TITLE>
<link rel="stylesheet" type="text/css" href="../images/test.css">
</HEAD>
<body>
<?php
//print_r($_SESSION);
$_POST['SESSION_KEY'] = $_SESSION['INDEXKEY'] ;
$_POST['CONTACT_KEY'] = substr($value,0,10) ;
$_POST['TOUR_KEY'] = substr($value,13,10) ;
$_POST['TYPE'] = substr($value,10,3) ;

$sql = "INSERT INTO  {$_SESSION['SCEMA']}TSHOWCONTACT
(SESSION_KEY, CONTACT_KEY, TOUR_KEY, type)
VALUES(
'".$_POST['SESSION_KEY']."',
		'".$_POST['CONTACT_KEY']."',
		'".$_POST['TOUR_KEY']."',
		'".$_POST['TYPE']."'
		)";

require 'connATC.inc';
//echo "hier , $value";print_r($_POST);echo $sql;
$verbose = TRUE;
$dbconn = dbconnect($verbose);
$stmt = db2_prepare($dbconn, $sql);
$result = db2_execute($stmt);

//echo $sql ;

if (!$result) {
	echo $sql ;
	get_db2_conn_errormsg($sql);
}else{//echo "hier" ;
	//ECHO "CONTACT SAVE OPEN WINDOW MIT DATA" ;
	get_userdata();
}
?>
<?php  function get_userdata(){
	//echo "hier" ;
	if ($_SESSION['angemeldet'] == 1) {
		if ( $_POST['TYPE'] == 'kfz'){
			$feld = 'tour_indexkey';
			$sql = "SELECT
			AB_DAT, AB_LAND, AB_PLZ, AB_ORT ,
			AN_DAT, AN_LAND, AN_PLZ, AN_ORT,
			GEWICHT, VOLUMEN, NOTE,
			(fz_art) concat ' ' concat (fz_marke)concat ' ' as KFZ_INDEXKEY, PART_INDEXKEY
			FROM  {$_SESSION['SCEMA']}TTOURKFZ  t , {$_SESSION['SCEMA']}TKFZ z
			WHERE   an_dat > '1111-01-01'
			and ab_dat >= current date
			and an_dat >= current date
			and t.INDEXKEY  =  '{$_POST['CONTACT_KEY']}'
			and TOUR_INDEXKEY = '{$_POST['TOUR_KEY']}'
			and KFZ_INDEXKEY = z.FZ_INDEXKEY 	and t.INDEXKEY = z.INDEXKEY" ;
		}elseif( $_POST['TYPE'] == 'lad'){
			$feld = 'ladung_indexkey';
			$sql = "SELECT
			AB_DAT, AB_LAND, AB_PLZ, AB_ORT ,
			AN_DAT, AN_LAND, AN_PLZ, AN_ORT,
			GEWICHT, VOLUMEN, NOTE,
			ANZAHL, PACKART, KFZ_ART
			FROM  {$_SESSION['SCEMA']}TTOURLAD  t
			WHERE  an_dat > '1111-01-01'
			and ab_dat >= current date
			and an_dat >= current date
			and ladung_INDEXKEY  = '{$_POST['TOUR_KEY']}'
			and INDEXKEY = '{$_POST['CONTACT_KEY']}'	"  ;
		} ;

		//ausgabe tourdaten
		$verbose = TRUE;
		$dbconn = dbconnect($verbose);
		$stmt = db2_prepare($dbconn, $sql);
		$result = db2_execute($stmt);

		if (!$result) {
			get_db2_conn_errormsg($sql);
		}

		echo  gettext('glob_titel').gettext('contact_head').gettext('glob_titel_end') ;
		echo  gettext('glob_typ1').gettext('contact_text').gettext('glob_typ1_end') ;
		//echo $sql ;	// ausgeben des selects
		while ($row = $fetch($stmt)){
			echo gettext('glob_tour');
			echo $row[0] , ' ',$row[1] , ' ',$row[2] , ' ',$row[3] , ' ',$row[4] , ' ',$row[5] , ' ',$row[6] , ' ',$row[7] , ' ',$row[8] , '<br> ',$row[9] , ' ',$row[10]
			, ' ',$row[11] , ' ',$row[12] , ' ',$row[13] , ' ',$row[14]  ;
			echo gettext('glob_tour_end');
		}

		//echo "hier , $value";print_r($_POST);echo $sql;
		//ausgabe kontaktdaten
		$sql = "SELECT
		PREFIX, FIRSTNAME, LASTNAME, SUFFIX, COMPANYNAME, COUNTRY, STATEPROVINCE,
		POSTALCODE, CITY, ADDRESS, ADDRESSNUMBER,
		OFFICEPHONE, HOMEPHONE, FAXPHONE, CELLULARPHONE, PAGERPHONE,  EMAILADDRESS
		from {$_SESSION['SCEMA']}TCONTACTS c
		WHERE  c.indexkey = '{$_POST['CONTACT_KEY']}'" ;

		$stmt = db2_prepare($dbconn, $sql);
		$result = db2_execute($stmt);

		if (!$result) {
			get_db2_conn_errormsg($sql);
		}

		//echo $sql ;	// ausgeben des selects
		while ($row = $fetch($stmt)){
			echo gettext('glob_contact');
			echo $row[0] , ' ',$row[1] , ' ',$row[2] , ' ',$row[3] , ' ',$row[4] , ' ',$row[5] , ' ',$row[6] , ' ',$row[7] , ' ',$row[8] , '<br> ',$row[9] , ' ',$row[10]
			, ' ',$row[11] , ' ',$row[12] , ' ',$row[13] , ' ',$row[14] , ' ',$row[15]
			, '<br><a href="mailto:',$row[16],'?subject=',gettext('contact_anfrage'),$_POST['CONTACT_KEY'],'">',gettext('contact_mail'),'</a>' ;
			gettext('glob_contact_end');
		}

	}else  {
		echo "<table  ><tr><td class='titel'> ";
		echo  gettext('glob_nicht_eingelogged');
		echo "</td></tr></table>";
	}
}
?>
</body>
</html>
