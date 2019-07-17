<?php function outp($value) {
	//echo $value, "<br>" ;
	//print_r($_SESSION);
	//db connect einbinden
	//require 'includes/connATC.inc';

	echo  gettext('glob_titel').gettext('transbuy_head').gettext('glob_titel_end') ;
	echo  gettext('glob_typ1').gettext('transbuy_text').gettext('transbuy_rueck').gettext('glob_typ1_end') ;
	if ($_SESSION['angemeldet'] == 1) {

		//	echo "<form name='trans_buy' id='trans_buy' ACTION='output.php?go=barcode.php&dir=dyn' METHOD='POST'>" ;
		echo "<FORM METHOD=POST ACTION='output.php?go=barcode.php&dir=dyn&func=gen_barcode'>" ;
		echo "<table><tr>";
		//barcodetext=&barcode=6747&width=200&height=100

		//Kontactdaten fuer Rechung
		$sql = "SELECT
		PREFIX, FIRSTNAME, LASTNAME, SUFFIX, COMPANYNAME, COUNTRY, STATEPROVINCE,
		POSTALCODE, CITY, ADDRESS, ADDRESSNUMBER, OFFICEPHONE, EMAILADDRESS
		from {$_SESSION['SCEMA']}tcontactsc
		WHERE  c.indexkey = '{$_SESSION['INDEXKEY']}'" ;


		IF ($_SESSION['DB'] == 'MY'){
			get_MY_connect($sql) ;
			$result = mysqli_query($_SESSION ['CONNECT'], $sql);
			if (!$result) {
				get_db2_conn_errormsg($sql);
			}
		}else {
			get_DB2_connect($sql) ;
			if (!$result) {
				get_db2_conn_errormsg($sql);
			}
		}
		//echo 'outp - '.$sql ;
		while ($row = $_SESSION['FETCH']($result))	{
			echo gettext('glob_contact');
			echo gettext('rechnungsanschrift'),"<br>";
			echo $row[0] , ' ',$row[1] , ' ',$row[2] , ' ',$row[3] , ' ',$row[4] , ' ',$row[5] , ' ',$row[6] , ' ',$row[7] , ' ',$row[8] , '<br> ',$row[9] , ' ',$row[10]
			, ' ',$row[11] , ' ',$row[12]  ;

		}

		echo gettext('transbuy_wahl1'),substr($value,0,10);
		if(substr($value,10,2) <> '00') {
			echo gettext('transbuy_wahl2'),substr($value,10,2);
		}
		echo gettext('transbuy_wahl3'),get_route(substr($value,12,2)),gettext('transbuy_wahl4')  ;

		// werte f�r erzeugen von barcode
		echo '<INPUT TYPE="hidden" NAME="VAL" VALUE=',$value,'>' ;

		// auswahl tour und fahrzeug
		echo  gettext('transbuy_wahl5');

		//auswahl tour
		echo "<select name = 'TOUR_INDEXKEY' > ";
		get_tourlist($where);
		get_kfzlist($where);
		echo "</select><br>";

		//zollnr LSVA
		echo  gettext('transbuy_LSVA_text').gettext('transbuy_LSVA'),"<br>";

		echo gettext('senden')," ",gettext('cancel');
		echo gettext('glob_contact_end');
	}else  {
		echo "<table  ><tr><td class='titel'> ";
		echo  gettext('glob_nicht_eingelogged');
		echo "</td></tr></table>";
	}echo "</form> ";
}

function get_route($value){

	if (empty($_POST['SLOTWAHL'])){$_POST['SLOTWAHL'] = 1;}
	$sql =" SELECT distinct  transit_route ,  nach
	FROM {$_SESSION['SCEMA']}TREFSLOTCOST
	where  route_nr = $value " ;

	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect($sql) ;
		$result = mysqli_query($_SESSION ['CONNECT'], $sql);
		if (!$result) {
			get_db2_conn_errormsg($db ,$sql);
		}
	}else {
		get_DB2_connect($sql) ;
		if (!$result) {
			get_db2_conn_errormsg($sql);
		}
	}

	//echo 'get_route- '.$sql ;
	while ($row = $_SESSION['FETCH']($result))	{
		echo  ' ', $row[0],' --> ', $row[1];
	}

}
?>

