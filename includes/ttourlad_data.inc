<?php function tourlad_list() {
	//update fahrzeug daten
	if ($_SESSION['angemeldet'] == 1) {
		$link_open = "<A href='menue_call.php?go=ttourlad_data.inc&dir=includes";
		$link_opendel = "<A href='menue_call.php?go=ttourlad.php&dir=includes";

		$linkend = "</a>";

		//registrieren neues fahrzeug
		$sql = "SELECT  LADUNG_INDEXKEY,  AB_DAT, AB_LAND, AB_PLZ, AB_ORT ,
							 AN_DAT, AN_LAND, AN_PLZ, AN_ORT, GEWICHT, VOLUMEN, ANZAHL, PACKART, KFZ_ART, NOTE
								FROM  {$_SESSION['SCEMA']}TTOURLAD  t
								WHERE t.indexkey = '{$_SESSION['INDEXKEY']}'
								and an_dat > '1111-01-01' ORDER by ab_dat, an_dat";

		//ECHO 'tourlad_list - '.$sql ;
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

		echo gettext('glob_titel') . gettext('tour_upd_head') . gettext('glob_titel_end');
		echo gettext('glob_typ1') . gettext('tour_upd_text') . gettext('glob_typ1_end');
		echo "<table>";

		while ($row = $_SESSION['FETCH']($result)) {
			$_SESSION['LADUNG_INDEXKEY'] = $row[0];
			echo "<tr><td class='typ2' width='600'>";
			//echo "{$row[0]}";
			echo gettext(" {$row[2]}  {$row[3]} {$row[4]} {$row[5]} {$row[6]} {$row[7]} {$row[8]} {$row[9]} {$row[1]} ");
			echo "</td><td class='green' width='50'>";
			//ausgabe liste aller fahrzeuge des users
			echo "$link_open&func=tour_upd&value=$row[0]'>";
			echo gettext("glob_aendern");
			echo "$linkend    ";
			echo "</td><td class='red' width='50'>";
			echo "$link_opendel&func=tour_tbdel&value=$row[0]'>";
			echo gettext("glob_loeschen");
			echo "$linkend";
			echo "</td></tr>";
		}
	} else {
		echo "<table  ><tr><td class='titel'   > ";
		echo gettext('glob_nicht_eingelogged');
		echo "	</td></tr></table>";
	}
	echo "</table>";
} // function


function tourlad_reg($value) {
	if ($_SESSION['angemeldet'] == false) {
		$_SESSION['quick'] = 1;
		$sql = "SELECT (s.tblcol), s.varstring, substr(s.vartype,1,2) as vartyp , (s.tbl), pos
								FROM  {$_SESSION['SCEMA']}TVARSTRINGS s
								WHERE (s.maske='tourlad'  )
								
								union all
								SELECT (s.tblcol), s.varstring, substr(s.vartype,1,2) as vartyp , (s.tbl), pos
								FROM  {$_SESSION['SCEMA']}TVARSTRINGS s	WHERE s.pos in (  150, 180, 210, 222, 999)
									and (s.maske='reguser'	or  s.maske = 'alle')
								order by 4, 5 ";
	} else {
		$sql = "SELECT (s.tblcol), s.varstring, substr(s.vartype,1,2) as vartyp , (s.tbl)
								FROM  {$_SESSION['SCEMA']}TVARSTRINGS s
								WHERE (s.maske='tourlad' or s.maske = 'alle' )
								order by pos";
	}

	//if ($_SESSION['angemeldet'] == 1) {
	//registrieren neue tour

	$_SESSION['LADUNG_INDEXKEY'] = time();

	//echo 'tourlad_reg - '.$sql ;
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
	echo gettext('glob_titel') . gettext('tourlad_new_head') . gettext('glob_titel_end');
	echo gettext('glob_typ1') . gettext('tourlad_new_text') . gettext('glob_typ1_end');

	echo "<form name='tour_neu' id='tour_neu' onSubmit='return validate(this,var_1)'
							ACTION='menue_call.php?go=ttourlad.php&dir=includes&func=tour_tbnew' METHOD='POST'>";

	echo "<table>";

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
			$country = get_country();
			echo "</select> </td></tr>";
		}
		elseif ($row[2] == 'st') {
			echo " {$row[1]}   ";
			echo $data;
			$fzart = get_fzart($_SESSION['LANG']);
			echo "</select></td></tr>";
		}
		elseif (SUBSTR($row[2], 0, 1) == 'd') {
			if (SUBSTR($row[2], 1, 1) == '1') {
				$w = 1;
			}
			elseif (SUBSTR($row[2], 1, 1) == '2') {
				$w = 2;
			}
			//$w = "{(SUBSTR($row[2],1,1)}" ;
			$y = substr($_SESSION['Value'], 0, 4);
			$m = substr($_SESSION['Value'], 5, 2);
			$d = substr($_SESSION['Value'], 8, 2);

			get_date(32, $m, $y, $w);

		} else {
			get_fomularend($row[1], $row[2]);
			echo $_SESSION['formdataend'];
		}
	}
	echo "</form> ";
	/*	} else {
		echo "<table  ><tr><td class='titel'   > ";
		echo gettext('glob_nicht_eingelogged');
		echo "	</td></tr></table>";
		}*/
	echo "</table>";
} // function

function tour_upd($ladung_indexkey) {
	//echo "tour_upd" ;
	if ($_SESSION['angemeldet'] == 1) {
		//registrieren neues fahrzeug
		$sql = "SELECT (s.tblcol), s.varstring, substr(s.vartype,1,2) as vartyp , (s.tbl)
								FROM  {$_SESSION['SCEMA']}TVARSTRINGS s
								where (s.maske='tourlad' or s.maske = 'alle' ) ORDER by s.pos";

		//echo 'tourlad_reg - '.$sql ;
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
		echo gettext('glob_titel') . gettext('tour_upd_head') . gettext('glob_titel_end');
		echo gettext('glob_typ1') . gettext('tour_upd_text') . gettext('glob_typ1_end');

		echo "<form name='tour_upd' id='tour_upd' onSubmit='return validate(this,var_1)'
							ACTION='menue_call.php?go=ttourlad.php&dir=includes&func=tour_tbupd' METHOD='POST'>";

		echo "<table >";

		while ($row = $_SESSION['FETCH']($result)) {
			// get formular daten
			if (!empty ($row[0])) {
				// daten zu jeweiligen Formularvariabelen holen
				$where = "where indexkey = '{$_SESSION['INDEXKEY']}' and ladung_indexkey = '$ladung_indexkey' ";
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
				$country = get_country();
				echo "</select> </td></tr>";
			}
			elseif ($row[2] == 'st') {
				echo " {$row[1]}   ";
				//ausgabe momentan fahrzeug typ
				echo $data;
				$where = "	where fz_indexkey = '{$_SESSION['Value']}' ";

				$fzart = get_fzart($_SESSION['LANG']);
				echo "</select></td></tr>";
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
				get_date($d, $m, $y, $w);

			} else {
				get_fomularend($row[1], $row[2]);
				echo $_SESSION['formdataend'];
			}
		}
		echo "</form> ";
	} else {
		echo "<table  ><tr><td class='titel'   > ";
		echo gettext('glob_nicht_eingelogged');
		echo "	</td></tr></table>";
	}
	echo "</table>";
} // function

function get_fzart($where) {
	// ausgabe fahrzeugtyp

	$sql = "SELECT fz_text FROM {$_SESSION['SCEMA']}TREFKFZ
				where fz_info = 'art'
				and ( lang = '{$_SESSION['LANG']}' or lang = 'al' ) order by 1";

	//echo 'get_fzart - '.$sql ;
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

	while ($row = $_SESSION['FETCH']($result)) {
		$l = htmlentities($row[0]);
		echo "<OPTION value='$row[0]'>$l</OPTION>";
	}
}
?>


