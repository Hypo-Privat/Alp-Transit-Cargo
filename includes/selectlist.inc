<?php function get_country() {
	// get l�nderauswahl

	$sql = "SELECT l_iso_bez, l_iso_num FROM {$_SESSION['SCEMA']}TISOCOUNTRY  order by 1";

	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect($sql) ;
		$result = mysqli_query($_SESSION ['CONNECT'], $sql);
	}else {
		get_DB2_connect($sql) ;
	}

	//  Feststellen aus welchen Land der user kommt ?
	// ist nach der Registrierung gelöst
	echo "<OPTION>Switzerland</OPTION>";


	//echo 'get_province - '.$sql ;
	while ($row = $_SESSION['FETCH']($result))	{
		$l = htmlentities($row[0]);
		echo "<OPTION value='$row[0]'>$l</OPTION>";
	}
}

function normalize ($string) {
	$table = array('"'=>' ', "'"=>' '    );
	return strtr($string, $table);
}

function get_province() {
	// get l�nderauswahl

	$lang = $_SESSION['LANG'];
	if ($_SESSION['LANG'] == es) {
		$lang = en;
	}


	$sql = "SELECT distinct l_gk_bez , l_iso_num  FROM {$_SESSION['SCEMA']}TISOPROVINCE where l_iso_lang = '$lang' order by 1";
	//and l_iso_num = '756'
	//echo 'get_province - '.$sql ;
	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect($sql) ;
		$result = mysqli_query($_SESSION ['CONNECT'], $sql);
	}else {
		get_DB2_connect($_SESSION ['CONNECT'], $sql) ;
	}



	//echo 'kfz_list - '.$sql ;
	while ($row = $_SESSION['FETCH']($result))	{
		$p = htmlentities($row[0]);
		echo "<OPTION value='$row[0]'>$p</OPTION>";
	}
}


function get_prefix() {

	if ($_SESSION['LANG'] == de) {
		$werte = array (
			"Frau",
			"Herr",
			"Firma"
			);
	}
	elseif ($_SESSION['LANG'] == en) {
		$werte = array (
			"Madam",
			"Lord",
			"company"
			);
	}
	elseif ($_SESSION['LANG'] == it) {
		$werte = array (
			"Donna",
			"signore",
			"azienda"
			);
	}
	elseif ($_SESSION['LANG'] == fr) {
		$werte = array (
			"Madame",
			"Monsieur",
			"soci�t�"
			);
	}
	elseif ($_SESSION['LANG'] == es) {
		$werte = array (
			"Mujer",
			"caballero",
			"compa��a"
			);
	} else {
		$werte = array (
			"Madam",
			"Lord",
			"company"
			);
	}
	$anzwert = count($werte);
	for ($i = 0; $i < $anzwert; $i++) {
		ECHO "<OPTION value='$werte[$i]'>$werte[$i]</option>";
	}
}


function get_language($lang) {
	// falls sprache notwendig einbauen
	$werte = array (
		"de",
		"fr",
		"en",
		"it",
		"es"
		);
		$anzwert = count($werte);
		for ($i = 0; $i < $anzwert; $i++) {
			ECHO "<OPTION  value='$werte[$i]'>$werte[$i]</option>";
		}
}



function get_jn() {
	if ($_SESSION['LANG'] == de) {
		$werte = array (
			"JA",
			"NEIN"
			);
	}
	elseif ($_SESSION['LANG'] == en) {
		$werte = array (
			"yes",
			"no"
			);
	}
	elseif ($_SESSION['LANG'] == it) {
		$werte = array (
			"S�",
			"NO"
			);
	}
	elseif ($_SESSION['LANG'] == fr) {
		$werte = array (
			"OUI",
			"NON"
			);
	}
	elseif ($_SESSION['LANG'] == es) {
		$werte = array (
			"Si",
			"No"
			);
	} else {
		$werte = array (
			"yes",
			"no"
			);
	}
	$anzwert = count($werte);
	for ($i = 0; $i < $anzwert; $i++) {
		ECHO "<OPTION value='$werte[$i]'>$werte[$i]</option>";
	}
}



function get_date($d, $m, $y, $w) {
	// um funktion auch für slot zu verwenden
	$timestamp = time();
	$ya = date("Y", $timestamp);
	$ma = date("m", $timestamp);
	$da = date("d", $timestamp);
	//bis hier slot

	$dd = array (
		"01",
		"02",
		"03",
		"04",
		"05",
		"06",
		"07",
		"08",
		"09",
		"10",
		"11",
		"12",
		"13",
		"14",
		"15",
		"16",
		"17",
		"18",
		"19",
		"20",
		"21",
		"21",
		"22",
		"23",
		"24",
		"25",
		"26",
		"27",
		"28",
		"29",
		"30",
		"31"
		);
		$ddwert = count($dd);
		$mm = array (
		"01",
		"02",
		"03",
		"04",
		"05",
		"06",
		"07",
		"08",
		"09",
		"10",
		"11",
		"12"
		);
		$mmwert = count($mm);

		if ($d == 32) {
			$d = $da;
			$m = $ma;
			$y = $ya;
			$min = $ya;
			$max = ($ya +2); //slot
		} else {
			$min = ($ya -60);
			$max = ($ya +2);
		} //gebdatum

		echo "<select name = '{$w}_dd' value = '01'>";
		if ($d == 0) {
			echo "<OPTION value='$da'>$da </option>";
		} //slot
		if (!empty ($d)) {
			echo "<OPTION value='$d'>$d </option>";
		}
		for ($i = 0; $i < $ddwert; $i++)
		ECHO "<OPTION value='$dd[$i]'>$dd[$i] </option>";

		echo "</select><select name= '{$w}_mm' value = ' 01 '>>";
		if ($d == 0) {
			echo "<OPTION value='$ma'>$ma </option>";
		} //slot
		if (!empty ($d)) {
			echo "<OPTION value='$m'>$m </option>";
		}
		for ($i = 0; $i < $mmwert; $i++)
		ECHO "<OPTION value='$mm[$i]'>$mm[$i] </option>";

		echo "</select><select name = '{$w}_yy' value = ' 2000 '>";
		if ($d == 0) {
			echo "<OPTION value='$ya'>$ya </option>";
		} //slot
		if (!empty ($d)) {
			echo "<OPTION value='$y'>$y </option>";
		}
		for ($wert = $min; $wert < $max; $wert++)
		ECHO "<OPTION value='$wert'>$wert </option>";
		echo "</select>";

}

function txt_translate($str_value) {

	// Beispiel Translation ;
	$trans = get_html_translation_table(HTML_ENTITIES);
	$encoded = strtr($str_value, $trans);
	return $encoded;
}



function get_value($where, $tblcol, $tbl, $vartype) {
	// gibt wert zur�ck, falls einer f�r die Abfrage existiert
	//echo $where, $tblcol , $tbl, $vartype ;
	$_SESSION['Value'] = '';
	$tbl = trim($tbl);
	if ($tbl == 'no') {
		//aussteigen wenn keine Tabelle gelesen werden muss
		$_SESSION['Value'] = $tblcol;
		return $_SESSION['Value'];
	}


	$sql = "SELECT distinct $tblcol	FROM {$_SESSION['SCEMA']}$tbl $where  group by $tblcol";

	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect($sql) ;
		$result = mysqli_query($_SESSION ['CONNECT'], $sql);
	}else {
		get_DB2_connect($sql) ;
	}



	//echo 'get_value - '.$sql ;
	while ($row = $_SESSION['FETCH']($result))	{
		$_SESSION['Value'] = htmlentities($row[0]);
	}
	$_SESSION['Value'] = trim($_SESSION['Value']);
	return $_SESSION['Value'];

}



function get_fomulartype($row2) {


	$_SESSION['formdata'] = '';
	if (SUBSTR($row2, 0, 1) == 's') {
		$data = "<OPTION>{$_SESSION['Value']}</OPTION>";
	}
	elseif (SUBSTR($row2, 0, 1) == 's') {
		$data = "<OPTION>{$_SESSION['Value']}</OPTION>";
	}
	elseif (SUBSTR($row2, 0, 1) == 'j') {
		$data = "<OPTION>{$_SESSION['Value']}</OPTION>";
	}
	elseif (SUBSTR($row2, 0, 2) == 'tx') {
		$data = "style='height: 20px' value = '{$_SESSION['Value']}' >";
	}
	elseif (SUBSTR($row2, 0, 1) == 'd') { // datum
		$data = "style='height: 20px' value = '{$_SESSION['Value']}' >";
	}
	elseif (SUBSTR($row2, 0, 2) == 'ta') {
		$data = " value = '{$_SESSION['Value']}' >";
	}
	elseif (SUBSTR($row2, 0, 1) == 'n') { // numerische werte smallint ect.
		if (empty ($_SESSION['Value'])) {
			$_SESSION['Value'] = 0;
		}
		$data = " value = {$_SESSION['Value']} >";
	} else
	$data = ">";

	$_SESSION['formdata'] = $data;
/*
	echo "<pre>";
	echo "Session\n";
	var_dump($_SESSION);
*/
	return $_SESSION['formdata'];
}


function get_fomularend($row1, $row2) {
	$_SESSION['formdataend'] = '';
	if ($row2 == 'tx') {
		$data = "{$row1}{$_SESSION['formdata']}</td></tr> ";
	}
	elseif ($row2 == 'ta') {
		$data = "{$row1}{$_SESSION['formdata']}{$_SESSION['Value']}</textarea></td></tr> ";
	}
	elseif ($row2 == 'no') { // numerische werte smallint ect.
		$data = "{$row1}{$_SESSION['formdata']} </td></tr> ";
	} else {
		$data = "{$row1}</td></tr> ";
	}
	//echo $data ;
	$_SESSION['formdataend'] = $data;
	return $_SESSION['formdataend'];
}




function save_login() {
	// save logindata
	// Userip lesen
	userIP();
	$sql = "INSERT INTO  {$_SESSION['SCEMA']}TLOGIN
				( EMAILADDRESS , INDEXKEY, IN_OUT )	VALUES(	'" . $_SESSION['EMAILADDRESS'] . "' , '" . $_SESSION['INDEXKEY'] . "', '" . $_SESSION['userip'] . "')";

	//echo 'save_login - '.$sql ;
	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect($sql) ;
		$result = mysqli_query($_SESSION ['CONNECT'], $sql);
	}else {
		get_DB2_connect($sql) ;

	}

}


function userIP() {
	//This returns the True IP of the client calling the requested page
	// Checks to see if HTTP_X_FORWARDED_FOR
	// has a value then the client is operating via a proxy
	$userIP = isset($_SERVER['HTTP_X_FORWARDED_FOR']);

	if ($userIP == "") {
		$userIP = $_SERVER['REMOTE_ADDR'];
	}
	// return the IP we've figured out:
	$_SESSION['userip'] = $userIP;
	//echo $userIP ;
	//return $userIP;

}



function get_tourlist($where) {

	$sql = "SELECT
			t.INDEXKEY, TOUR_INDEXKEY,
			AB_DAT, AB_LAND, AB_PLZ, AB_ORT ,
			AN_DAT, AN_LAND, AN_PLZ, AN_ORT
			FROM  {$_SESSION['SCEMA']}TTOURKFZ  t
			WHERE   an_dat > '1111-01-01'
			and  an_dat >= current date
			and t.indexkey = '{$_SESSION['INDEXKEY']}' order by 3, 7";

	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect($sql) ;
		$result = mysqli_query($_SESSION ['CONNECT'], $sql);
	}else {
		get_DB2_connect($sql) ;
	}


	//echo $sql;


	while ($row = $_SESSION['FETCH']($result))	{
		echo "<OPTION value='$row[1]'> $row[2] $row[3] $row[4] $row[5] --> $row[6] $row[7] $row[8] $row[9]</OPTION>";
	}
}


function get_partlist($where) {
	// ausgabe partner
	//echo "hier partner" ;

	if (!$where) {
		$sql = "SELECT distinct part_indexkey, firstname, lastname  FROM {$_SESSION['SCEMA']}TPARTNER
				        where indexkey = '{$_SESSION['INDEXKEY']}' ";
	} else {
		$sql = "SELECT distinct part_indexkey, firstname, lastname  FROM {$_SESSION['SCEMA']}TPARTNER  $where	 ";
	}

	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect($sql) ;
		$result = mysqli_query($_SESSION ['CONNECT'], $sql);
	}else {
		get_DB2_connect($sql) ;
	}


	//echo $sql;


	gettext('partner_no');
	while ($row = $_SESSION['FETCH']($result))	{
		echo "<OPTION value='$row[0]'>$row[1] $row[2]</OPTION>";
	}
}


function get_kfzlist($where) {
	// ausgabe emmisionsklassen EURO
	//echo "hier euro" ;

	if (!$where) {
		$sql = "SELECT fz_indexkey, fz_kennz, fz_art, fz_type, fz_marke
				FROM {$_SESSION['SCEMA']}TKFZ where indexkey = '{$_SESSION['INDEXKEY'] } '";
	} else {
		$sql = "SELECT  fz_indexkey, fz_kennz, fz_art, fz_type, fz_marke FROM {$_SESSION['SCEMA']}TKFZ  $where 	";
		//union SELECT  fz_indexkey, fz_kennz, fz_art, fz_type, fz_marke		FROM {$_SESSION['SCEMA']}TKFZ  where indexkey = '{$_SESSION['INDEXKEY'] }'

	}

	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect($sql) ;
		$result = mysqli_query($_SESSION ['CONNECT'], $sql);
	}else {
		get_DB2_connect($sql) ;
	}


	gettext('kfz_no');//echo $sql;


	while ($row = $_SESSION['FETCH']($result))	{
		echo "<OPTION value='$row[0]'>$row[1] $row[2] $row[3] $row[4]</OPTION>";
	}
}
?>
