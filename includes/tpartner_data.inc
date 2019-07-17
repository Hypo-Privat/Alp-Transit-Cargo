<?php
function part_list() {
	//update partner daten
	if ($_SESSION['angemeldet'] == 1) {
		$link_open = "<A href='menue_call.php?go=tpartner_data.inc&dir=includes";
		$link_opendel = "<A href='menue_call.php?go=tpartner.php&dir=includes";

		$linkend = "</a>";

		//registrieren neues fahrzeug
		$sql = "SELECT  c.lastname, c.firstname, part_indexkey
				FROM   {$_SESSION['SCEMA']}TPARTNER  c
				WHERE   c.indexkey = '{$_SESSION['INDEXKEY']}'
				and c.DRV_DATE > '1111-01-01' ORDER by c.lastname, c.firstname";

		//echo ' part_list - '.$sql ;
		IF ($_SESSION['DB'] == 'MY') {
			get_MY_connect($sql);
			$result = mysqli_query($_SESSION ['CONNECT'], $sql);
		} else {
			get_DB2_connect($sql);
			$result = db2_execute($stmt);
		}
		echo gettext('glob_titel') . gettext('partner_upd_head') . gettext('glob_titel_end');
		echo gettext('glob_typ1') . gettext('partner_upd_text') . gettext('glob_typ1_end');
		echo "<table>";

		while ($row = $_SESSION['FETCH']($result)) {
			echo "<tr><td class='typ2' width='600'>";
			echo gettext("{$row[0]} {$row[1]}  ");
			echo "</td><td class='green' width='50'>";
			//ausgabe liste aller fahrzeuge des users
			echo "$link_open&func=part_upd&value=$row[2]'>";
			echo gettext("glob_aendern");
			echo "$linkend    ";
			echo "</td><td class='red' width='50'>";
			echo "$link_opendel&func=partner_tbdel&value=$row[2]'>";
			echo gettext("glob_loeschen");
			echo "$linkend";
			//$partnerdel = partner_upd($row[4]);
			echo "</td></tr>";
		}
	} else {
		echo gettext('glob_nicht_eingelogged');
	}
	echo "</table>";
}// function

function part_new() {

	if ($_SESSION['angemeldet'] == 1) {
		//	session daten l?schen
		//require 'includes/session_clear.php';
		//	field check javascript
		require "includes/user_reg_error.js";

		//registrieren als neuer User
		$sql = "SELECT (s.tblcol), s.varstring, substr(s.vartype,1,2) as vartyp , (s.tbl)
			FROM  {$_SESSION['SCEMA']}TVARSTRINGS s
			WHERE s.maske='partner'	or s.maske='alle'ORDER by s.pos";

		IF ($_SESSION['DB'] == 'MY') {
			get_MY_connect($sql);
			$result = mysqli_query($_SESSION ['CONNECT'], $sql);
		} else {
			get_DB2_connect($sql);
		}

		echo gettext('glob_titel') . gettext('partner_new_head') . gettext('glob_titel_end');
		echo gettext('glob_typ1') . gettext('partner_new_hinweis') . gettext('glob_typ1_end');

		echo "<table><tr>";
		echo "<form name='partner' id='part_new' onSubmit='return validate(this,var_1)' ACTION='menue_call.php?go=tpartner.php&dir=includes&func=part_tbnew' METHOD='POST'>";

		//echo 'part_new - '.$sql ;
		while ($row = $_SESSION['FETCH']($result)) {

			// get formular daten
			if (!empty($row[0])) {
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

			if ($row[2] == 'sl') {
				echo "{$row[1]}  ";
				echo $data;
				$country = get_country();
				echo "</select> </td></tr>";
			} elseif ($row[2] == 'sp') {
				echo " {$row[1]}   ";
				echo $data;
				$province = get_province($_SESSION['LANG']);
				echo "</select></td></tr>";
			} elseif ($row[2] == 'sg') {
				echo " {$row[1]}  ";
				echo $data;
				$language = get_language($_SESSION['LANG']);
				echo "</select></td></tr>";
			} elseif ($row[2] == 'sa') {
				echo " {$row[1]}   ";
				echo $data;
				$language = get_prefix($_SESSION['LANG']);
				echo "</select></td></tr>";
			} elseif (SUBSTR($row[2], 0, 1) == 'd') {
				if (SUBSTR($row[2], 1, 1) == '1') {
					$w = 1;
				} elseif (SUBSTR($row[2], 1, 1) == '2') {
					$w = 2;
				}

				$y = substr($_SESSION['Value'], 0, 4);
				$m = substr($_SESSION['Value'], 5, 2);
				$d = substr($_SESSION['Value'], 8, 2);

				get_date($d, $m, $y, $w); ;
				//	echo "</td></tr>";
			} elseif ($row[2] == 'tx') {
				echo " {$row[1]} $data </td></tr>"; ;
			} else {
				get_fomularend($row[1], $row[2]);
				echo $_SESSION['formdataend'];
				//echo " {$row[1]} </td></tr>";
			}

		}
		echo "</form> ";
	} else {
		echo gettext('glob_nicht_eingelogged');
	}
	echo "</table>";
	//while
}// function

function part_upd($part_indexkey) {

	if ($_SESSION['angemeldet'] == 1) {
		//registrieren neues fahrzeug
		$sql = "SELECT (s.tblcol), s.varstring, substr(s.vartype,1,2) as vartyp , (s.tbl)
				FROM  {$_SESSION['SCEMA']}TVARSTRINGS s
				WHERE s.maske='partner' or s.maske='alle'ORDER by s.pos";

		IF ($_SESSION['DB'] == 'MY') {
			get_MY_connect($sql);
			$result = mysqli_query($_SESSION ['CONNECT'], $sql);
		} else {
			get_DB2_connect($sql);
		}

		echo gettext('glob_titel') . gettext('partner_upd_head') . gettext('glob_titel_end');
		echo gettext('glob_typ1') . gettext('partner_upd_text') . gettext('glob_typ1_end');

		echo "<table><tr>";
		echo "<form name='partner_upd' id='partner_upd' onSubmit='return validate(this,var_1)'
			ACTION='menue_call.php?go=tpartner.php&dir=includes&func=partner_tbupd' METHOD='POST'>";

		// ausgeben des selects
		$_SESSION['PART_INDEXKEY'] = $part_indexkey;

		//echo 'part_upd - '.$sql ;
		while ($row = $_SESSION['FETCH']($result)) {
			// get formular daten
			if (!empty($row[0])) {
				// daten zu jeweiligen Formularvariabelen holen
				$where = "where indexkey = '{$_SESSION['INDEXKEY']}' and part_indexkey = '$part_indexkey'";
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
			} elseif ($row[2] == 'sp') {
				echo " {$row[1]}   ";
				echo $data;
				$province = get_province($_SESSION['LANG']);
				echo "</select></td></tr>";
			} elseif ($row[2] == 'sg') {
				echo " {$row[1]}  ";
				echo $data;
				$language = get_language($_SESSION['LANG']);
				echo "</select></td></tr>";
			} elseif ($row[2] == 'sa') {
				echo " {$row[1]}   ";
				echo $data;
				$language = get_prefix($_SESSION['LANG']);
				echo "</select></td></tr>";
			} elseif (SUBSTR($row[2], 0, 1) == 'd') {
				if (SUBSTR($row[2], 1, 1) == '1') {
					$w = 1;
				} elseif (SUBSTR($row[2], 1, 1) == '2') {
					$w = 2;
				}
				$y = substr($_SESSION['Value'], 0, 4);
				$m = substr($_SESSION['Value'], 5, 2);
				$d = substr($_SESSION['Value'], 8, 2);

				get_date($d, $m, $y, $w);
				//	echo "</td></tr>";
			} else {
				get_fomularend($row[1], $row[2]);
				echo $_SESSION['formdataend'];
			}
		}
		echo "</form> ";
	} else {
		echo gettext('glob_nicht_eingeloggt');
	}
	echo "</table>";
} // function
?>
