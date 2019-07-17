<?php

function normalize ($string) {
	$table = array('"'=>' ', "'"=>' '    );
	return strtr($string, $table);
}

//var_dump($_SESSION);

function user_login_check() {
	//echo "hier"; //echo " {$_REQUEST['EMAILADDRESS']} hi {$_REQUEST['PWD']}" ;

	$sql = " SELECT	INDEXKEY ,  FIRSTNAME, LASTNAME,	EMAILADDRESS , COMPANYNAME, SETTAG, SETNR , pwd, EIGENSCHAFT, suffix
				FROM {$_SESSION['SCEMA']}TCLACONTACTS	where (emailaddress = '{$_REQUEST['EMAILADDRESS']}' and pwd = '{$_REQUEST['PWD']}') ";
	//echo 'session '.$_SESSION['DB'] ;

	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect() ;
		//mysqli_pconnect("www.a-t-c.ch", "atc", "db2admin") or die(mysqli_error('Connected persistent to MySQL'));
		//echo "Connected persistent to MySQL<br />";
		//mysqli_select_db("CL12264_ATC") or die(mysqli_error('Connected to Database ATC'));
		//echo "Connected to Database ATC";
		$result = mysqli_query($sql);
		if (!$result) {
			get_db2_conn_errormsg($sql);
		}
	}else {
		$verbose = TRUE;
		$dbconn = dbconnect($verbose);
		$stmt = db2_prepare($dbconn, $sql);
		$result = db2_execute($stmt);
		if (!$result) {
			get_db2_conn_errormsg($sql);
		}
	}

	//echo $sql;

	//db2	$row = $fetch($stmt)
	//	IF ($_SESSION['DB'] == 'MY'){$row = mysqli_fetch_row($result)}
	//	IF ($_SESSION['DB'] == 'DB2'){$row = db2_fetch_array($stmt)}
	//echo " while ";
	while ($row = mysqli_fetch_row($result))	{
		$_SESSION['INDEXKEY'] = $row[0];
		$_SESSION['PWD'] = $row[7];
		//wird f&uuml;r r&uuml;cksprung gebraucht

		$_SESSION['FIRSTNAME'] = $row[1];
		$_SESSION['LASTNAME'] = $row[2];
		$_SESSION['EMAILADDRESS'] = $row[3];
		$_SESSION['COMPANYNAME'] = $row[4];
		$_SESSION['SETTAG'] = $row[5];
		$_SESSION['SETNR'] = $row[6];
		$_SESSION['EIGENSCHAFT'] = $row[8];
		// bestätigt das user angemeldet ist
		$_SESSION['angemeldet'] = true;
		$_REQUEST['COMPANYNAME'] = $_SESSION['COMPANYNAME'];
		//save_login();
		// jetzt kann usere neune musiker eingeben

		echo "<TABLE border='1'  width='600'> <TBODY> <TR>	<TD class='col1' colspan='6'>";
		echo "Guten Tag " . $row[9] . ' ' . $row[1] . ' ' . $row[2] . ' ' . $row[8] . ' ' . $row[4] . '. <br>Sie spielen am ' . $row[5] . ' Set ' . $row[6] .
		'<br> Bitte geben Sie hier die Daten der Musiker ein damit wir f&uuml;r diese Festivalausweise erstellen k&ouml;nnen.	Falls der Musiker mit einem PKW kommt bitte das Kennzeichen eingeben, damit wir einen Zufahrtausweis f&uuml;r das Parkhaus ausstellen k&ouml;nnen. ';
		echo "	</td></tr>";

		crew_new(); // Mitarbeiter erfassen

		//tabelle mit bereits registrierten musikern ausgeben inkl &auml;ndern und l&ouml;schen
		//officephone ist partnerkey von Musiker/in e-mailadresse abf&uuml;llen falls leer
		//funktion
		select_Musiker();
		echo "</TBODY></table>";

		exit;
	} //echo "hier" ;
	//echo "keinen datensatz gefunden";
	login_err();
}

function crew_new() {
	echo '<FORM enctype="multipart/form-data"	action="cal_menue.php?go=tclacontacts&dir=cal_script&func=musik_new"
				accept-charset="ISO-8859-1" method="post">';
	if ($_SESSION['INDEXKEY'] > 9) {
		echo '<tr><td>Suffix</td><td>Vorname</td><td>Nachname</td><td>Email</td><td>Kennzeichen</td><td>senden</td>	</tr>
							<tr><td><select name="SUFFIX" value = ""><OPTION value="Herr">Herr</option>
							<OPTION value="Frau">Frau</option></select /></td>
						<td><input id="id_FIRSTNAME" type="text" name="FIRSTNAME"	maxlength="64" /></td>
						<td><input id="id_LASTNAME" type="text" name="LASTNAME"maxlength="64" /></td>
						<td><input id="id_EMAILADDRESS" type="text" name="EMAILADDRESS"maxlength="64" /></td>
						<td><input id="id_KFZ" type="text" name="KFZ"	maxlength="12" />
						 <input type="hidden" name="EIGENSCHAFT" value="Musiker/in">
						 <input type="hidden" name="COMPANYNAME" value="'.$_REQUEST['COMPANYNAME'].'">
						</td>
						<td><input type="submit" name="senden" value="Abschicken" /></td>
							</tr>	';
	} else {
		//eingabe f&uuml;r cal
		echo '<tr>
		<td>Suffix</td><td>Vorname</td><td>Nachname</td><td>Firma</td><td>-</td>
		</tr>
		<tr>
						<td><select name="SUFFIX" value = ""><OPTION value="Herr">Herr</option>
						<OPTION value="Frau">Frau</option><OPTION value=""> </option></select /></td>
						<td><input id="id_FIRSTNAME" type="text" name="FIRSTNAME"	maxlength="64" /></td>
						<td><input id="id_LASTNAME" type="text" name="LASTNAME"maxlength="64" /></td>
						<td><input id="id_COMPANYNAME" type="text" name="COMPANYNAME"	maxlength="64" /></td>
						<td></td>
		</tr>
					<tr>
							<td>Strasse</td><td>Nr.</td><td>PLZ</td><td>Ort</td><td>-</td>
					</tr>
					<tr>
							<td><input id="id_ADDRESS" type="text" name="ADDRESS"maxlength="64" /></td>
						<td><input id="id_ADDRESSNUMBER" type="text" name="ADDRESSNUMBER"	maxlength="10" /></td>
						<td><input id="id_POSTALCODE" type="text" name="POSTALCODE" maxlength="64" /></td>
						<td><input id="id_City" type="text" name="CITY" maxlength="64" /></td>
					</tr>
					<tr>
							<td>Telefon</td><td>Notiz</td><td>Email</td><td>Eigenschaft</td><td>-</td>
					</tr>
					<tr>
							<td><input id="id_MOBILE" type="text" name="MOBILE"maxlength="64" /></td>
						<td><input id="id_NOTE" type="text" name="NOTE"	maxlength="100" /></td>
						<td><input id="id_EMAILADDRESS" type="text" name="EMAILADDRESS"maxlength="64" /></td>
						<td><select name="EIGENSCHAFT" value = "">
										<OPTION value="Futter">Futter</option>
										<OPTION value="Firmenevent">Firmenevent</option>
										<OPTION value="Produktion">Produktion</option>
										<OPTION value="G&ouml;nner">G&ouml;nner</option>
										<OPTION value="Sponsor">Sponsor</option>
										<OPTION value="Gast">Gast</option>
										<OPTION value="Presse">Presse</option>
										<OPTION value="Gemeinde">Gemeinde</option></select /></td>
						<td><input type="submit" name="senden" value="Abschicken" /></td>
					</tr>
					';
	}
	ECHO "</form>";
}

function select_Musiker() {


	$sql = "SELECT	 suffix,  FIRSTNAME, LASTNAME,	EMAILADDRESS , KFZ, companyname, INDEXKEY, officephone
				FROM {$_SESSION['SCEMA']}TCLACONTACTS	where (officephone = '{$_SESSION['INDEXKEY'] }' ) order by 6 , 3";
	IF ($_SESSION['DB'] == 'DB2'){
		$verbose = TRUE;
		$dbconn = dbconnect($verbose);
		$stmt = db2_prepare($dbconn, $sql);
		$result = db2_execute($stmt);

		if (!$result) {
			get_db2_stmt_errormsg($sql);
		}
	}else{
		//mysqli_pconnect("www.a-t-c.ch", "atc", "db2admin") or die(mysqli_error('Connected persistent to MySQL'));
		//echo "Connected persistent to MySQL<br />";
		//mysqli_select_db("CL12264_ATC") or die(mysqli_error('Connected to Database ATC'));
		//echo "Connected to Database ATC";
		$result = mysqli_query($sql);
		if (!$result) {
			get_db2_conn_errormsg($sql);
		}
	}
	//echo $sql;
	$link = "<A href='cal_menue.php?go=tclacontacts&dir=cal_script";

	$I = 1;
	//db2 $row = db2_fetch_array($stmt)
	while ($row = mysqli_fetch_row($result)) {
		//echo " while ";
		// ausgabe erfasster musiker
		if ($row[7]> 9) {
			echo '<tr><td>' . $row[0] . '</td><td >' . $row[1] . '</td><td >' . $row[2] . '</td><td >' . $row[3] . '</td><td >'. $row[4] . '</td><td >';
		}else{
			echo '<tr><td>' . $row[5] . '</td><td >' . $row[1] . '</td><td >' . $row[2] . '</td><td >' . $row[3] . '</td><td >';
		}
		//echo '<br>'. $link. '&func=del_crew&value=' . $row[5] . '>l&ouml;schen</a></td>';
		echo "$link&func=upd_crew&value=$row[6]'>" . $I . " &auml;ndern </a></td></tr>";
		$I = $I +1;
	}

}

function upd_crew($value) {
	//echo "upd_crew" . $value . '<br>';
	//unset($_REQUEST);
	//registrieren neues fahrzeug
	$sql = "SELECT	 SUFFIX,  FIRSTNAME, LASTNAME, COMPANYNAME,
					MOBILE,	 EMAILADDRESS , EIGENSCHAFT, KFZ,
					indexkey, officephone , pwd, ADDRESS
					,ADDRESSNUMBER	,City	,POSTALCODE

			FROM {$_SESSION['SCEMA']}TCLACONTACTS
			where INDEXKEY = '$value'";

	if ($_SESSION['DB'] =='DB2'){
		$verbose = TRUE;
		$dbconn = dbconnect($verbose);
		$stmt = db2_prepare($dbconn, $sql);
		$result = db2_execute($stmt);
		//echo $sql;
		if (!$result) {get_db2_conn_errormsg($sql);}
		$fetch = 'db2_fetch_array';
	}else
	{
		get_MY_connect() ;
		$result = mysqli_query($sql)	;
		if (!$result) {
			get_db2_conn_errormsg($sql);
		}
	}
	//db2 $row = $fetch ($stmt)
	while ($row = mysqli_fetch_row($result)) {
		// hier ausgabe des datensatzes zum &auml;ndern
		//print_r($row);
		// 0 SUFFIX,  1 FIRSTNAME, 2 LASTNAME, 3 COMPANYNAME, 4 MOBILE,
		// , 5 EMAILADDRESS , 6 EIGENSCHAFT, 7 KFZ, 8 indexkey,
		// 9 officephone , 10 pwd
		echo "<TABLE border='1'  width='600'> ";
		echo "<tr><td class='col0' colspan='6'>Bitte passen Sie die Daten an ! </td></tr>";
		echo '<tr><FORM enctype="multipart/form-data"	action="cal_menue.php?go=tclacontacts&dir=cal_script&func=upd_save"
				  accept-charset="ISO-8859-1" method="post">';
		if ($row[9]> 9) {

			echo '<td class="col1">Suffix</td><td>Vorname</td><td>Nachname</td><td>Email</td><td>Kennzeichen</td><td>senden</td>	</tr>
								<tr><td><select name="SUFFIX" ><OPTION value = "' . $row[0] . '">'. $row[0]. '</option>
										<OPTION value="Herr">Herr</option>
										<OPTION value="Frau">Frau</option><OPTION value=""> </option></select /></td>
									<td><input id="id_FIRSTNAME" type="text" name="FIRSTNAME" value = "' . $row[1] . '"	maxlength="64" /></td>
									<td><input id="id_LASTNAME" type="text" name="LASTNAME"	value = "' . $row[2] . '"	maxlength="64" /></td>
									<td><input id="id_EMAILADDRESS" type="text" name="EMAILADDRESS"	value = "' . $row[5] . '"	maxlength="64" /></td>
									<td><input id="id_KFZ" type="text" name="KFZ"value = "' . $row[7] . '"	maxlength="12" /></td>
									<td><input type="submit" name="senden" value="Abschicken" /></td>
										<input type="hidden" name="EIGENSCHAFT" value="Musiker/in">
										<input type="hidden" name="COMPANYNAME" value="'.$row[3].'">
									 	<input type="hidden" name="MOBIL" value="'.$row[4].'">
										<input type="hidden" name="INDEXKEY" value="'.$row[8].'">';
		} else { //eingabe f&uuml;r cal
			echo '<td>Suffix</td><td>Vorname</td><td>Nachname</td><td>Firma</td><td>-</td>	</tr>
								<tr><td><select name="SUFFIX" ><OPTION value = "' . $row[0] . '">'. $row[0]. '</option>
										<OPTION value="Herr">Herr</option>
										<OPTION value="Frau">Frau</option><OPTION value=""> </option></select /></td>
									<td><input id="id_FIRSTNAME" type="text" name="FIRSTNAME" value = "' . $row[1] . '"	maxlength="64" /></td>
									<td><input id="id_LASTNAME" type="text" name="LASTNAME"	value = "' . $row[2] . '"	maxlength="64" /></td>
									<td><input id="id_COMPANYNAME" type="text" name="COMPANYNAME" value = "' . $row[3] . '"	maxlength="64" /></td>
									<td></td></tr>

					<tr>
						<td>Strasse</td><td>Nr.</td><td>PLZ</td><td>Ort</td><td>-</td>
					</tr>
					<tr>
						<td><input id="id_ADDRESS" type="text" name="ADDRESS" value = "' . $row[11] . '" maxlength="64" /></td>
						<td><input id="id_ADDRESSNUMBER" type="text" name="ADDRESSNUMBER" value = "' . $row[12] . '"	maxlength="10" /></td>
						<td><input id="id_POSTALCODE" type="text" name="POSTALCODE" value = "' . $row[14] . '"maxlength="64" /></td>
						<td><input id="id_City" type="text" name="CITY" value = "' . $row[13] . '"maxlength="64" /></td>
					</tr>

					<tr>
						<td>Telefon</td><td>KFZ</td><td>Email</td><td>Eigenschaft</td><td>-</td></tr>
					<tr>
						<td><input id="id_MOBILE" type="text" name="MOBILE"	value = "' . $row[4] . '"	maxlength="64" /></td>
						<td><input id="id_KFZ" type="text" name="KFZ"value = "' . $row[7] . '"	maxlength="12" /></td>
						<td><input id="id_EMAILADDRESS" type="text" name="EMAILADDRESS"	value = "' . $row[5] . '"	maxlength="64" /></td>
						<td><select name="EIGENSCHAFT" >
							<OPTION value = "' . $row[6] . '">' . $row[6] . '</option>
							<OPTION value="Futter">Futter</option>
							<OPTION value="Firmenevent">Firmenevent</option>
							<OPTION value="Produktion">Produktion</option>
							<OPTION value="G&ouml;nner">G&ouml;nner</option>
							<OPTION value="Sponsor">Sponsor</option>
							<OPTION value="Gast">Gast</option>
							<OPTION value="Presse">Presse</option>
							<OPTION value="Gemeinde">Gemeinde</option>
							</select /></td>
						<td><input type="submit" name="senden" value="Abschicken" /></td>
							<input type="hidden" name="INDEXKEY" value="'.$row[8].'">
										';
		}
		echo "	</form></tr></table>";
	} //while

} // function

function upd_save() {
	//echo 'upd_save';

	$_REQUEST['NOTE']  = normalize($_REQUEST['NOTE'] );
	$_REQUEST['NOTE'] = substr($_REQUEST['NOTE'], 0, 250);

	//print_r($_REQUEST);
	if ($_SESSION['DB'] =='MY'){
		$sql = "update  {$_SESSION['SCEMA']}TCLACONTACTS
			set 
			suffix = '" . $_REQUEST['SUFFIX'] . "',
			FIRSTNAME = '" . $_REQUEST['FIRSTNAME'] . "',
			LASTNAME = '" . $_REQUEST['LASTNAME'] . "',
			COMPANYNAME = '" . $_REQUEST['COMPANYNAME'] . "',
			MOBILE = '" . $_REQUEST['MOBILE'] . "',
			NOTE = '" . $_REQUEST['NOTE'] . "',
			EMAILADDRESS = '" . $_REQUEST['EMAILADDRESS'] . "',
			EIGENSCHAFT = '" . $_REQUEST['EIGENSCHAFT'] ."' ,
			KFZ = '" . $_REQUEST['KFZ'] . "',
			ADDRESS = '" . $_REQUEST['ADDRESS'] ."' ,
			ADDRESSNUMBER = '" . $_REQUEST['ADDRESSNUMBER'] ."' ,
			City = '" . $_REQUEST['CITY'] ."' ,
			POSTALCODE = '" . $_REQUEST['POSTALCODE'] ."' 
			WHERE	indexkey = '{$_REQUEST['INDEXKEY']}'";

		get_MY_connect() ;
		$result =  mysqli_query($sql);
		//echo $sql;
		if (!$result) {
			get_db2_conn_errormsg($sql);
		} else {
			$_REQUEST['EMAILADDRESS'] = $_SESSION['EMAILADDRESS'];
			$_REQUEST['PWD'] = $_SESSION['PWD'];
			user_login_check();
		}
	}

	if ($_SESSION['DB'] =='DB2'){
		$sql = "update  {$_SESSION['SCEMA']}TCLACONTACTS
			set (suffix,  FIRSTNAME, LASTNAME, COMPANYNAME, MOBILE, NOTE, EMAILADDRESS , EIGENSCHAFT,
			KFZ , ADDRESS	,ADDRESSNUMBER	,City	,POSTALCODE)
			=(
			'" . $_REQUEST['SUFFIX'] . "',
			'" . $_REQUEST['FIRSTNAME'] . "',
			'" . $_REQUEST['LASTNAME'] . "',
			'" . $_REQUEST['COMPANYNAME'] . "',
			'" . $_REQUEST['MOBILE'] . "',
			'" . $_REQUEST['NOTE'] . "',
			'" . $_REQUEST['EMAILADDRESS'] . "',
			'" . $_REQUEST['EIGENSCHAFT'] ."' ,
			'" . $_REQUEST['KFZ'] . "',
			'" . $_REQUEST['ADDRESS'] ."' ,
			'" . $_REQUEST['ADDRESSNUMBER'] ."' ,
			'" . $_REQUEST['CITY'] ."' ,
			'" . $_REQUEST['POSTALCODE'] ."' )
			WHERE	indexkey = '{$_REQUEST['INDEXKEY']}'";

		$verbose = TRUE;
		$dbconn = dbconnect($verbose);
		$stmt = db2_prepare($dbconn, $sql);
		$result = db2_execute($stmt);
		// echo $sql;
		if (!result) {
			get_db2_stmt_errormsg($sql);
		} else {
			$_REQUEST['EMAILADDRESS'] = $_SESSION['EMAILADDRESS'];
			$_REQUEST['PWD'] = $_SESSION['PWD'];
			user_login_check();
		}
	}

}

function user_new() {

	$timestamp = time();
	$_REQUEST['NOTE']  = normalize($_REQUEST['NOTE'] );
	$_REQUEST['NOTE'] = substr($_REQUEST['NOTE'], 0, 250);
	$_REQUEST['INDEXKEY'] = $timestamp;

	//	print_r($_REQUEST);
	$sql = "INSERT INTO  {$_SESSION['SCEMA']}TCLACONTACTS
			(INDEXKEY ,	COMPANYNAME , FIRSTNAME ,	LASTNAME , SUFFIX ,	ADDRESS ,
			ADDRESSNUMBER ,	CITY ,	POSTALCODE ,	COUNTRY ,	OFFICEPHONE ,	MOBILE ,
			EMAILADDRESS ,	KFZ ,	HELFER ,	SETTAG ,	SETNR ,
			URL ,	NOTE ,	PWD ,	LANG, EIGENSCHAFT)
			VALUES(
			'" . $_REQUEST['INDEXKEY'] . "',
			'" . $_REQUEST['COMPANYNAME'] . "',
			'" . $_REQUEST['FIRSTNAME'] . "',
			'" . $_REQUEST['LASTNAME'] . "',
			'" . $_REQUEST['SUFFIX'] . "',
			'" . $_REQUEST['ADDRESS'] . "',
			'" . $_REQUEST['ADDRESSNUMBER'] . "',
			'" . $_REQUEST['CITY'] . "',
			'" . $_REQUEST['POSTALCODE'] . "',
			'" . $_REQUEST['COUNTRY'] . "',
			'" . $_REQUEST['OFFICEPHONE'] . "',
			'" . $_REQUEST['MOBILE'] . "',
			'" . $_REQUEST['EMAILADDRESS'] . "',
			'" . $_REQUEST['KFZ'] . "',
			'" . $_REQUEST['HELFER'] . "',
			'" . $_REQUEST['SETTAG'] . "',
			{$_REQUEST['SETNR']},
			'" . $_REQUEST['URL'] . "',
			'" . $_REQUEST['NOTE'] . "',
			'" . $_REQUEST['PWD'] . "',
			'" . $_REQUEST['LANG'] . "' ,
			'" . $_REQUEST['EIGENSCHAFT'] . "' )"
			;

			if ($_SESSION['DB'] =='DB2'){
				$verbose = TRUE;
				$dbconn = dbconnect($verbose);
				$stmt = db2_prepare($dbconn, $sql);
				$result = db2_execute($stmt);
				//echo $sql;
				//print_r ($_SESSION['angemeldet']);
				if (!$result) {
					get_db2_stmt_errormsg($sql);
				}else{
					if ($_SESSION['angemeldet'] == 0) {
			 		//echo 'musiker erfasst';
					}else{
			 		//echo 'sendet Mail f&uuml;r helfer';
			 		$m = mail_reguser($_REQUEST);
			 		mail('office@classicaula.ch', $sql, "From: new-insert-office@classicaula.ch");
			 		//echo "ok";
			 		exit;
					}
				}
			}

			if ($_SESSION['DB'] =='MY'){
				get_MY_connect() ;
				$result = mysqli_query($sql);

				if (!$result) {
					get_db2_stmt_errormsg($sql);
				} else {
					if ($_SESSION['angemeldet'] == 0) {
						//echo 'musiker erfasst';
					} else {
						//echo 'sendet Mail f&uuml;r helfer';
						$m = mail_reguser($_REQUEST);
						mail('office@classicaula.ch', $sql, "From: new-insert-office@classicaula.ch");
						//echo "ok";
						exit;
					}
				}
			}
}

function musik_new() {
	//echo 'musiknew';
	//echo '$_REQUEST[COMPANYNAME]'. $_REQUEST['COMPANYNAME'].' hier musik_new';
	$_REQUEST['SETTAG'] = $_SESSION['SETTAG'];
	$_REQUEST['SETNR'] = $_SESSION['SETNR'];
	$_REQUEST['OFFICEPHONE'] = $_SESSION['INDEXKEY'];

	user_new(); //schreiben neuen Datensatz
	//f&uuml;r r&uuml;cksprung
	$_REQUEST['EMAILADDRESS'] = $_SESSION['EMAILADDRESS'];
	$_REQUEST['PWD'] = $_SESSION['PWD'];
	user_login_check();
}

function hands_new() {

	//declariert getdatafile in connATC
	$_SESSION['angemeldet'] = 1;
	$timestamp = time();
	//echo 'get datafile' ;
	get_datafile($timestamp);

	$datum = date("Ymd", $timestamp);
	$uhrzeit = date("His", $timestamp);
	$_REQUEST['HELFER'] = '';
	$_REQUEST['SETTAG'] = ('2009-08-27');

	//fr&uuml;hester arbeitstag wird gespeichert
	if ($_REQUEST["mo"] == 'on') {
		$_REQUEST['SETTAG'] = ('2009-08-31');
		$_REQUEST['HELFER'] = ($_REQUEST['HELFER'] . 'mo,');
	}
	if ($_REQUEST["so"] == 'on') {
		$_REQUEST['SETTAG'] = ('2009-08-30');
		$_REQUEST['HELFER'] = ($_REQUEST['HELFER'] . 'so,');
	}
	if ($_REQUEST["sa"] == 'on') {
		$_REQUEST['SETTAG'] = ('2009-08-29');
		$_REQUEST['HELFER'] = ($_REQUEST['HELFER'] . 'sa,');
	}
	if ($_REQUEST["fr"] == 'on') {
		$_REQUEST['SETTAG'] = ('2009-08-28');
		$_REQUEST['HELFER'] = ($_REQUEST['HELFER'] . 'fr,');
	}
	if ($_REQUEST["do"] == 'on') {
		$_REQUEST['SETTAG'] = ('2009-08-27');
		$_REQUEST['HELFER'] = ($_REQUEST['HELFER'] . 'do,');
	}
	if ($_REQUEST['catering'] == 'on') {
		$_REQUEST['HELFER'] = ($_REQUEST['HELFER'] . 'catering,');
	}
	//alle infos des helfers
	if ($_REQUEST['info_stand'] == 'on') {
		$_REQUEST['HELFER'] = ($_REQUEST['HELFER'] . 'info_stand,');
	}
	if ($_REQUEST['bandbetreuung'] == 'on') {
		$_REQUEST['HELFER'] = ($_REQUEST['HELFER'] . 'bandbetreuung,');
	}
	if ($_REQUEST['allrounder'] == 'on') {
		$_REQUEST['HELFER'] = ($_REQUEST['HELFER'] . 'allrounder,');
	}
	if ($_REQUEST['security'] == 'on') {
		$_REQUEST['HELFER'] = ($_REQUEST['HELFER'] . 'security,');
	}
	if (!$_REQUEST['SETNR']) {
		$_REQUEST['SETNR'] = 0;
	}
	$_REQUEST['HELFER'] = ($_REQUEST['HELFER'] . $_REQUEST['SHIRT']);
	user_new();
}

function login_err() {
	$_SESSION['angemeldet'] = false;
	//echo "hier" ;
	echo "<TABLE border='1' width='600'>
				<TBODY>
				<TR>
			<TD class='col0'><font color='red'> Anmeldefehler </font></td>
				</tr>
				<TR>
			<TD class='col1'>
			<FORM
				action='cal_menue.php?go=tclacontacts&func=user_login_check&dir=cal_script'
				method='post'><input id='EMAILADDRESS' style='height: 20px'
				maxlength='64' size='15' name='EMAILADDRESS'> E-Mail <br>
			<input id='PWD' type='password' style='height: 20px' maxlength='30'
				size='15' name='PWD'> Passwort <br>
			<input type='submit' style='height: 20px' value='absenden'></form>

			</TD>
			<td class='col1'>Benutzername und/oder Passwort sind nicht
			korrekt.</td>
				</tr>
				<tr>
			<td class='col1'>
			<FORM id=PWD METHOD='POST'
				ACTION='cal_menue.php?go=tclacontacts&dir=cal_script&func=mail_pwd'
				name='PWD_SERVICE'><br>
			<input id='EMAILADDRESS' style='height: 20px' maxlength='64'
				size='20' name='EMAILADDRESS'> <input class='action'
				type='submit' value='absenden' name='senden'></FORM>
			</td>
			<td class='col1'>Wenn Sie Ihr Passwort oder Ihren Benutzernamen
			vergessen haben, geben Sie Ihre E-Mail-Adresse ein!</td>
				</tr>
				</table>";
}
?>