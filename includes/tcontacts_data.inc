<?php function user_login_check(){
	//echo "hier";
	//echo " {$_POST['EMAILADDRESS']} hi {$_POST['PWD']}" ;
	print_r($_POST);
	$sql =" SELECT	INDEXKEY , PREFIX, FIRSTNAME, LASTNAME, SUFFIX,
	EMAILADDRESS , COMPANYNAME, ADDRESS, CITY, STATEPROVINCE,
	POSTALCODE, COUNTRY, ADDRESSNUMBER, LANG, PWD
	FROM {$_SESSION['SCEMA']}TCONTACTS
	where (emailaddress = '{$_POST['EMAILADDRESS']}' and pwd = '{$_POST['PWD']}') " ;
	
	//echo "  {$_SESSION['DB']} " , $_SESSION['DB'] ;
	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect($sql) ;
		$result = mysqli_query($_SESSION ['CONNECT'], $sql);
		$fetch = 'mysqli_fetch_array' ;
		//	return $result ;
	}else {
		get_DB2_connect($sql) ;

	}
	
	echo 'user_login_check - '.$sql ;
	while ($row = $_SESSION['FETCH']($result))	{
		if ($_SESSION['EMAILADDRESS'] = $row[5] and $_SESSION['PWD'] = $row[14]){
			//echo "hier $row[2] $row[3] $row[7] ";

			$_SESSION['INDEXKEY'] = $row[0] ;
			$_SESSION['PREFIX'] = $row[1] ;
			$_SESSION['FIRSTNAME'] = $row[2] ;
			$_SESSION['LASTNAME'] = $row[3] ;
			$_SESSION['SUFFIX'] = $row[4] ;
			$_SESSION['EMAILADDRESS'] = $row[5] ;
			$_SESSION['COMPANYNAME'] = $row[6] ;
			$_SESSION['ADDRESS'] = $row[7] ;
			$_SESSION['CITY'] = $row[8] ;
			$_SESSION['STATEPROVINCE'] = $row[9] ;
			$_SESSION['POSTALCODE'] = $row[10] ;
			$_SESSION['COUNTRY'] = $row[11] ;
			$_SESSION['ADDRESSNUMBER'] = $row[12] ;
			$_SESSION['LANG'] = $row[13] ;
			$_SESSION['PWD'] = $row[14] ;
			// best�tigt das user angemeldet ist
			$_SESSION['angemeldet'] = true;
			save_login();
			// jetzt kann usere sein profil bearbeiten
			echo "<table width='700'><tr><td class='titel'>";
			echo  gettext('glob_eingelogged_head');
			echo "	</td></tr>	<tr><td class='typ1'>";
			echo  gettext('glob_eingelogged_text').gettext('glob_eingelogged_help');
			echo "	</td></tr>	</table>";

			exit;
		} print_r($_SESSION);
	}
	echo "keinen datensatz gefunden";
	login_err() ;
}

function user_profile () {
	if ($_SESSION['angemeldet'] == 1) {
		// javacript ausgabe fehlermeldunge nach sprache
		require 'user_profile_error.js';
		//print_r($_SESSION);
		//registrieren als neuer User

		//bearbeiten bestehender user profile
		$sql = "SELECT (s.tblcol), s.varstring, substr(s.vartype,1,2) as vartyp , (s.tbl)
		FROM  {$_SESSION['SCEMA']}TVARSTRINGS s, {$_SESSION['SCEMA']}TCONTACTS c
		WHERE (s.maske='reguser' or s.maske='alle') and s.pos not in
		 (30, 75, 180, 190, 200, 220, 222)
		and (c.emailaddress = '{$_SESSION['EMAILADDRESS']}'and '{$_SESSION['INDEXKEY']}' = Indexkey ) ORDER by s.pos" ;

		IF ($_SESSION['DB'] == 'MY'){
			get_MY_connect($sql) ;
			$result = mysqli_query($_SESSION ['CONNECT'], $sql);
		}else {
			get_DB2_connect($sql) ;
		}

		echo  gettext('glob_titel').gettext('cont_profil_head').gettext('glob_titel_end') ;
		echo  gettext('glob_typ1').gettext('cont_profil_text').gettext('glob_typ1_end') ;

		echo "<table width='700'>" ;
		echo "<form name='Registrierung' id='register' onSubmit='return validate(this,var_1)' ACTION='menue_call.php?go=tcontacts.php&func=user_upd&dir=includes/' METHOD='POST'>" ;




		//echo 'user_profile - '.$sql ;
		while ($row = $_SESSION['FETCH']($result))	{
			// get formular daten
			if (!empty($row[0])){
				// daten zu jeweiligen Formularvariabelen holen
				$where = "where indexkey = '{$_SESSION['INDEXKEY']}' ";
				$value = get_value($where, $row[0], $row[3] , $row[2]);

				get_fomulartype($row[2]);
				$data = $_SESSION['formdata'];
			}

			echo "<tr><td class='typ2' width='300'>";
			//echo "{$row[0]}";
			echo gettext("{$row[0]}") ;
			echo "</td><td class='typ1' width='400'>";

			if($row[2]== 'sl') {
				echo "{$row[1]}  ";
				echo $data ;
				$country = get_country();
				echo "</select> </td></tr>";
			} elseif ($row[2] == 'sp') {
				echo " {$row[1]}   ";
				echo $data ;
				$province = get_province($_SESSION['LANG']);
				echo "</select></td></tr>";
			} elseif ($row[2] == 'sg') {
				echo " {$row[1]}  ";
				echo $data ;
				$language = get_language($_SESSION['LANG']);
				echo "</select></td></tr>";
			} elseif ($row[2] == 'ag') {
				echo " {$row[1]}   ";
				echo $data ;
				$agb = get_agb($_SESSION['LANG']);
				echo "</select></td></tr>";
			} elseif ($row[2] == 'sa') {
				echo " {$row[1]}   ";
				echo $data ;
				$language = get_prefix($_SESSION['LANG']);
				echo "</select></td></tr>";
			} elseif (SUBSTR($row[2],0,1) == 'd') {
				if (SUBSTR($row[2],1,1) == '1') {$w = 1;}
				elseif(SUBSTR($row[2],1,1) == '2') {$w = 2;}
				$y = substr($_SESSION['Value'], 0, 4) ;
				$m = substr($_SESSION['Value'], 5, 2) ;
				$d = substr($_SESSION['Value'], 8, 2) ;

				$gebdate = get_date($d, $m, $y, $w);
			} else {
				get_fomularend($row[1],$row[2]);
				echo $_SESSION['formdataend'] ;

			}
		}echo "</form> ";
	}else  {
		echo  gettext('glob_nicht_eingelogged');
	}echo "</table>" ;
}



function user_reg () {
	//echo '  ***$lang = ',  $lang;
	//echo ' ***$_SESSION[LANG] = ' ,  $_SESSION['LANG'];
	//echo "hier reg" ;
	//$lang = $_SESSION['LANG'];
	//	session daten l?schen
	//require 'session_clear.php';
	//	field check javascript
	require 'user_reg_error.js';

	//registrieren als neuer User
	$sql = "SELECT (s.tblcol), s.varstring, substr(s.vartype,1,2) as vartyp , (s.tbl)
	FROM  {$_SESSION['SCEMA']}TVARSTRINGS s
	WHERE s.pos in ( 180, 190, 200, 210, 222, 230, 999)
	and (s.maske='reguser'	or s.maske='alle')  ORDER by s.pos" ;

	$_SESSION['INDEXKEY'] = time();
	//echo 'user_reg - '.$sql ;
	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect($sql) ;
		$result = mysqli_query($_SESSION ['CONNECT'], $sql);
	}else {
		get_DB2_connect($sql) ;			
	}

	echo  gettext('glob_titel').gettext('glob_registrieren_head').gettext('glob_titel_end') ;
	echo  gettext('glob_typ1').gettext('glob_registrieren_hinweis').gettext('glob_typ1_end') ;

	echo "<form name='Registrierung' id='register' onSubmit='return validate(this,var_1)' ACTION='menue_call.php?go=tcontacts.php&dir=includes&func=user_new' METHOD='POST'>" ;
	echo "<table width='700'>" ;


	while ($row = $_SESSION['FETCH']($result))	{
		// get formular daten
		if (!empty($row[0])){
			// daten zu jeweiligen Formularvariabelen holen
			$where = "where indexkey = '' ";
			$value = get_value($where, $row[0], $row[3] , $row[2]);
			get_fomulartype($row[2]);
			$data = $_SESSION['formdata'];
		}
		echo "<tr><td class='typ2' width='300'>";
		//echo "{$row[0]}";
		echo gettext("{$row[0]}") ;
		echo "</td><td class='typ1' width='400'>";

		if ($row[2] == 'sg') {
			echo " {$row[1]}  ";
			echo $data ;
			$language = get_language($_SESSION['LANG']);
			echo "</select></td></tr>";
		} elseif ($row[2] == 'ag') {
			echo " {$row[1]}   ";
			echo $data ;
			$agb = get_agb($_SESSION['LANG']);
			echo "</select></td></tr>";
		} elseif ($row[2] == 'sa') {
			echo " {$row[1]}   ";
			echo $data ;
			$language = get_prefix($_SESSION['LANG']);
			echo "</select></td></tr>";
		}  elseif (SUBSTR($row[2],0,1) == 'd') {
			if (SUBSTR($row[2],1,1) == '1') {$w = 1;}
			elseif(SUBSTR($row[2],1,1) == '2') {$w = 2;}
			$y = substr($_SESSION['Value'], 0, 4) ;
			$m = substr($_SESSION['Value'], 5, 2) ;
			$d = substr($_SESSION['Value'], 8, 2) ;

			$gebdate = get_date($d, $m, $y, $w);;
			//	echo "</td></tr>";
		} else {
			get_fomularend($row[1],$row[2]);
			echo $_SESSION['formdataend'];
		}
	} echo "</form> "; echo "</table>"; //while
} // function

function user_reg_q () {
	//echo "hier quick register reg" ;
	//	session daten l?schen
	// require 'session_clear.php';
	//	field check javascript
	require 'user_reg_error.js';

	//registrieren als neuer User
	$sql = "SELECT (s.tblcol), s.varstring, substr(s.vartype,1,2) as vartyp , (s.tbl)
	FROM  {$_SESSION['SCEMA']}TVARSTRINGS s
	WHERE 	s.pos in ( 80, 180,  210, 222, 230)	
	and (s.maske='reguser')  ORDER by s.pos" ;

	$_SESSION['INDEXKEY'] = time();

	//echo 'user_reg_q - '.$sql ;
	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect($sql) ;
		$result = mysqli_query($_SESSION ['CONNECT'], $sql);
	}else {
		get_DB2_connect($sql) ;
	}

	//echo  gettext('glob_titel').gettext('glob_registrieren_head').gettext('glob_titel_end') ;
	//echo  gettext('glob_typ1').gettext('glob_registrieren_hinweis').gettext('glob_typ1_end') ;

	//echo "<form name='Registrierung' id='register' onSubmit='return validate(this,var_1)' ACTION='menue_call.php?go=tcontacts.php&dir=includes&func=user_new' METHOD='POST'>" ;
	//echo "<table width='700'>" ;




	//echo " while ";
	while ($row = $_SESSION['FETCH']($result))	{
		// get formular daten
		if (!empty($row[0])){
			// daten zu jeweiligen Formularvariabelen holen
			$where = "where indexkey = '' ";
			$value = get_value($where, $row[0], $row[3] , $row[2]);
			get_fomulartype($row[2]);
			$data = $_SESSION['formdata'];
		}
		echo "<tr><td class='typ2' width='300'>";
		//echo "{$row[0]}";
		echo gettext("{$row[0]}") ;
		echo "</td><td class='typ1' width='400'>";

		if ($row[2] == 'sg') {
			echo " {$row[1]}  ";
			echo $data ;
			$language = get_language($_SESSION['LANG']);
			echo "</select></td></tr>";
		} elseif ($row[2] == 'ag') {
			echo " {$row[1]}   ";
			echo $data ;
			$agb = get_agb($_SESSION['LANG']);
			echo "</select></td></tr>";
		} elseif ($row[2] == 'sa') {
			echo " {$row[1]}   ";
			echo $data ;
			$language = get_prefix($_SESSION['LANG']);
			echo "</select></td></tr>";
		}  elseif (SUBSTR($row[2],0,1) == 'd') {
			if (SUBSTR($row[2],1,1) == '1') {$w = 1;}
			elseif(SUBSTR($row[2],1,1) == '2') {$w = 2;}
			$y = substr($_SESSION['Value'], 0, 4) ;
			$m = substr($_SESSION['Value'], 5, 2) ;
			$d = substr($_SESSION['Value'], 8, 2) ;

			$gebdate = get_date($d, $m, $y, $w);;
			//	echo "</td></tr>";
		} else {
			get_fomularend($row[1],$row[2]);
			echo $_SESSION['formdataend'];
		}
	} // echo "</form> "; echo "</table>"; //while
} // function

function user_password () {

	//print_r($_SESSION);
	if ($_SESSION['angemeldet'] == 1) {
		require 'user_reg_error.js';

		//registrieren als neuer User
		$sql = "SELECT (s.tblcol), s.varstring, substr(s.vartype,1,2) as vartyp ,  (s.tbl)
		FROM  {$_SESSION['SCEMA']}TVARSTRINGS s , {$_SESSION['SCEMA']}TCONTACTS c
		WHERE s.pos in (  190, 200,  230, 999) and (s.maske='reguser' or s.maske='alle')
		and (c.emailaddress = '{$_SESSION['EMAILADDRESS']}' ) ORDER by s.pos" ;

		$data = $_SESSION['formdata'];

		//echo 'user_reg_q - '.$sql ;
		IF ($_SESSION['DB'] == 'MY'){
			get_MY_connect($sql) ;
			$result = mysqli_query($_SESSION ['CONNECT'], $sql);
		}else {
			get_DB2_connect($sql) ;
		}
		echo  gettext('glob_titel').gettext('cont_pwd_change_head').gettext('glob_titel_end') ;
		echo  gettext('glob_typ1').gettext('cont_pwd_change_text').gettext('glob_typ1_end') ;

		echo "<form name='Registrierung' id='register' onSubmit='return validate(this,var_1)' ACTION='menue_call.php?go=tcontacts.php&dir=includes&func=user_upd_pwd' METHOD='POST'>" ;
		echo "<table width='700'>" ;




		//echo 'user_password - '.$sql;
		while ($row = $_SESSION['FETCH']($result))	{
			$data = " >" ;
			// get formular daten
			get_fomulartype($row[2]);
			if (!empty($row[0])){
				// daten zu jeweiligen Formularvariabelen holen
				$where = "where indexkey = '{$_SESSION['INDEXKEY']}' and indexkey = '{$_SESSION['EMAILADDRESS']}'";
				$value = get_value($where, $row[0], $row[3] , $row[2]);

				if (SUBSTR($row[2],0,1) == 's') {
					$data = "<OPTION>{$_SESSION['Value']}</OPTION>" ;
				} elseif (SUBSTR($row[2],0,1) == 't') {
					$data = "style='height: 20px' value = '{$_SESSION['Value']}' >" ;
				} elseif (SUBSTR($row[2],0,1) == 'd') {
					$data = "style='height: 20px' value = '{$_SESSION['Value']}' >" ;
				}
			}
			echo "<tr><td class='typ2' width='300'>";
			echo gettext("{$row[0]}") ;
			//echo "{$row[0]}";
			echo "</td><td class='typ1' width='400'>";

			get_fomularend($row[1],$row[2]);
			echo $_SESSION['formdataend'];
		} echo "</table>"; //while
	}else  {
		echo  gettext('glob_nicht_eingelogged');
	}
} // function

function login_err(){
	$_SESSION['angemeldet'] = false;
	//echo "hier" ;
	echo "<table width='700' ><tr>";
	echo "<td class='titel'  width='350'  > ";
	echo "<font color='red'>".gettext('glob_login_error'),"</font>";
	echo "	</td></tr><tr><td class='typ1' > ";
	echo "<FORM action='menue_call.php?go=tcontacts_data.inc&func=user_login_check&dir=includes' method='post'> ";
	echo "<input id='EMAILADDRESS' style='height: 20px' maxlength='64' size='15' name='EMAILADDRESS'>  ";
	echo  gettext('glob_email');
	echo " <br>	<input id='PWD' type='password' style='height: 20px' maxlength='30' size='15' name='PWD'> ";
	echo  gettext('glob_passwort');
	echo " <br>	<input type='submit'style='height: 20px' value='";
	echo gettext('glob_senden');
	echo "'>	</form></TD>	<td class='typ2'>";
	echo gettext('glob_login_error_text');
	echo "</td></tr> ";
	echo "<tr><td class='typ1'>
	<FORM id=PWD METHOD='POST' ACTION='menue_call.php?go=sendmail.inc&dir=includes&func=mail_pwd' name='PWD_SERVICE'>
	<br><input id='EMAILADDRESS' style='height: 20px' maxlength='64' size='20' name='EMAILADDRESS'> <br>
	<input  class='action' type='submit' value='";	
	echo gettext('glob_senden');
	echo "'	name='senden'>	</FORM>	</td>	<td class='typ2'>";
	echo gettext('sendmail_passwort_send');
	echo "</td></tr> ";
	echo "<tr><td class='typ1'>";
	echo gettext('glob_registrieren_link');
	echo "</td>	<td class='typ2'>";
	echo gettext('glob_registrieren_text');
	echo "</td></tr></table>" ;
}
?>