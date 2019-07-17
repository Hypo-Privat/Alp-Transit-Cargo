
<?php
function umz_list() {
	//update fahrzeug daten
	if ($_SESSION['angemeldet'] == 1) {
		$link_open = "<A href='menue_call.php?go=tumz_data.inc&dir=includes";
		$link_opendel = "<A href='menue_call.php?go=tumz.php&dir=includes";

		$linkend = "</a>";

		//registrieren neues fahrzeug
		$sql = "SELECT   UMZ_INDEXKEY,
								AB_DAT, AB_LAND, AB_PLZ, AB_ORT ,
								AN_DAT, AN_LAND, AN_PLZ, AN_ORT
								FROM  {$_SESSION['SCEMA']}TUMZUG c
								WHERE c.indexkey = '{$_SESSION['INDEXKEY']}'
								and c.an_dat > '1111-01-01' ORDER by c.umz_indexkey";

		//ECHO 'umzlad_list - '.$sql ;
		IF ($_SESSION['DB'] == 'MY'){
			get_MY_connect($sql) ;
			$result = mysqli_query($_SESSION ['CONNECT'], $sql);
			if (!$result) {
				get_db2_conn_errormsg($sql);
			}
		}else {
			get_DB2_connect($sql) ;
			$result = db2_execute($stmt);
			if (!$result) {
				get_db2_conn_errormsg($sql);
			}
		}
		echo gettext('glob_titel') . gettext('umz_upd_head') . gettext('glob_titel_end');
		echo gettext('glob_typ1') . gettext('umz_upd_text') . gettext('glob_typ1_end');

		echo "<table>";

		while ($row = $_SESSION['FETCH']($result)) {
			echo "<tr><td class='typ2' width='600'>";
			//echo "{$row[0]}";
			echo gettext(" {$row[1]} {$row[2]}  {$row[3]} {$row[4]} {$row[5]} {$row[6]} {$row[7]} {$row[8]}  ");

			echo "</td><td class='green' width='50'>";
			//ausgabe liste aller fahrzeuge des users
			echo "$link_open&func=umz_upd&value=$row[0]'>";
			echo gettext("glob_aendern");
			echo "$linkend    ";
			echo "</td><td class='red' width='50'>";
			echo "$link_opendel&func=umz_tbdel&value=$row[0]'>";
			echo gettext("glob_loeschen");
			echo "$linkend";
			//$umzdel = umz_upd($row[4]);
			echo "</td></tr>";
		}
	} else {
		echo gettext('glob_nicht_eingelogged');
	}
	echo "</table>";
} // function

function umz_reg($value) {
	//echo $value;
	if ($_SESSION['angemeldet'] == false) {
		$_SESSION['quick'] = 1;


		$sql = "SELECT (s.tblcol), s.varstring, substr(s.vartype,1,2) as vartyp , (s.tbl), pos
												FROM  {$_SESSION['SCEMA']}TVARSTRINGS s 		WHERE s.maske='TUMZUG' 
						union all
						SELECT (s.tblcol), s.varstring, substr(s.vartype,1,2) as vartyp , (s.tbl), pos
												FROM  {$_SESSION['SCEMA']}TVARSTRINGS s	WHERE s.pos in (150,  180, 210, 222, 999)
												and (s.maske='reguser'	or  s.maske = 'alle')
						order by 4, 5 ";
	} else {
		$sql = "SELECT (s.tblcol), s.varstring, substr(s.vartype,1,2) as vartyp , (s.tbl)
								FROM  {$_SESSION['SCEMA']}TVARSTRINGS s
								WHERE (s.maske='TUMZUG' or s.maske='alle' )ORDER by s.pos";
	}

	//if ($_SESSION['angemeldet'] == 1) {
	//registrieren neues fahrzeug

	$_SESSION['UMZ_INDEXKEY'] = time();
	$_SESSION['VALUE'] = '';

	//echo 'umzlad_reg - '.$sql ;
	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect($sql) ;
		$result = mysqli_query($_SESSION ['CONNECT'], $sql);
		if (!$result) {
			get_db2_conn_errormsg($sql);
		}
	}else {
		get_DB2_connect($sql) ;
		$result = db2_execute($stmt);
		if (!$result) {
			get_db2_conn_errormsg($sql);
		}
	}
	echo gettext('glob_titel') . gettext('umz_registrieren_head') . gettext('glob_titel_end');
	echo gettext('glob_typ1') . gettext('umz_registrieren_text') . gettext('glob_typ1_end');

	echo "<form name='umz_neu' id='umz_neu' onSubmit='return validate(this,var_1)'
							ACTION='menue_call.php?go=tumz.php&dir=includes&func=umz_tbnew' METHOD='POST'>";

	echo "<table>";

	$_SESSION['VALUE'] = '';

	while ($row = $_SESSION['FETCH']($result)) {
		// get formular daten
		if (!empty ($row[0])) {
			// daten zu jeweiligen Formularvariabelen holen
			$where = "where indexkey = '' ";
			$value = get_value($where, $row[0], $row[3], $row[2]);
			get_fomulartype($row[2]);
			$data = $_SESSION['formdata'];
		}

		echo "<tr><td class='typ2' width='300'>";
		//echo "{$row[0]}";
		echo gettext("{$row[0]}");
		echo "</td><td class='typ1' width='400'>";

		if ($row[2] == 'sg') {
			echo " {$row[1]}  ";
			echo $data;
			$language = get_language($_SESSION['LANG']);
			echo "</select></td></tr>";
		}
		elseif ($row[2] == 'sl') {
			echo "{$row[1]}  ";
			echo $data;
			get_country();
			echo "</select> </td></tr>";
		}
		elseif ($row[2] == 'jn') {
			echo "{$row[1]}  ";
			echo $data;
			get_jn();
			echo "</select> </td></tr>";
		}
		elseif (SUBSTR($row[2], 0, 1) == 'd') {
			if (SUBSTR($row[2], 1, 1) == '1') {
				$w = 1;
			}
			elseif (SUBSTR($row[2], 1, 1) == '2') {
				$w = 2;
			}

			$y = substr($_SESSION['Value'], 0, 4);
			$m = substr($_SESSION['Value'], 5, 2);
			$d = substr($_SESSION['Value'], 8, 2);

			$gebdate = get_date(32, $m, $y, $w);

		} else {
			get_fomularend($row[1], $row[2]);
			echo $_SESSION['formdataend'];
		}
	}
	echo "</form> ";

	echo "</table>";
} // function

function umz_upd($umz_indexkey) {
	//echo "umz_upd" ;
	if ($_SESSION['angemeldet'] == 1) {
		//registrieren neues fahrzeug
		$_SESSION['UMZ_INDEXKEY'] = $umz_indexkey;
		$sql = "SELECT (s.tblcol), s.varstring, substr(s.vartype,1,2) as vartyp , (s.tbl)
								FROM  {$_SESSION['SCEMA']}TVARSTRINGS s
								WHERE s.maske='TUMZUG' or s.maske='alle' ORDER by s.pos";

		//echo 'umz_upd - '.$sql ;
		IF ($_SESSION['DB'] == 'MY'){
			get_MY_connect($sql) ;
			$result = mysqli_query($_SESSION ['CONNECT'], $sql);
			if (!$result) {
				get_db2_conn_errormsg($sql);
			}
		}else {
			get_DB2_connect($sql) ;
			$result = db2_execute($stmt);
			if (!$result) {
				get_db2_conn_errormsg($sql);
			}
		}
		echo gettext('glob_titel') . gettext('umz_registrieren_head') . gettext('glob_titel_end');
		echo gettext('glob_typ1') . gettext('umz_registrieren_text') . gettext('glob_typ1_end');

		echo "<form name='umz_upd' id='umz_upd' onSubmit='return validate(this,var_1)'
										ACTION='menue_call.php?go=tumz.php&dir=includes&func=umz_tbupd' METHOD='POST'>";

		echo "<table>";
		// f?r dateneingabe
		//echo $sql ;
		// ausgeben des selects

		while ($row = $_SESSION['FETCH']($result)) {
			// get formular daten
			if (!empty ($row[0])) {
				// daten zu jeweiligen Formularvariabelen holen
				$where = "where indexkey = '{$_SESSION['INDEXKEY']}'and umz_indexkey = '$umz_indexkey'  ";
				$value = get_value($where, $row[0], $row[3], $row[2]);

				get_fomulartype($row[2]);
				$data = $_SESSION['formdata'];
			}

			echo "<tr><td class='typ2' width='300'>";
			//echo "{$row[0]}";
			echo gettext("{$row[0]}");
			echo "</td><td class='typ1' width='400'>";

			if ($row[2] == 'sl') {
				echo "{$row[1]}  ";
				echo $data;
				get_country();
				echo "</select> </td></tr>";
			}
			elseif ($row[2] == 'jn') {
				echo "{$row[1]}  ";
				echo $data;
				get_jn();
				echo "</select> </td></tr>";
			}
			elseif (SUBSTR($row[2], 0, 1) == 'd') {
				if (SUBSTR($row[2], 1, 1) == '1') {
					$w = 1;
				}
				elseif (SUBSTR($row[2], 1, 1) == '2') {
					$w = 2;
				}

				$y = substr($_SESSION['Value'], 0, 4);
				$m = substr($_SESSION['Value'], 5, 2);
				$d = substr($_SESSION['Value'], 8, 2);

				$gebdate = get_date($d, $m, $y, $w);
				;

			} else {
				get_fomularend($row[1], $row[2]);
				echo $_SESSION['formdataend'];
			}
		}
		echo "</form> ";
	} else {
		echo gettext('glob_nicht_eingelogged');
	}
	echo "</table>";
} // function
?>

