
<?php function kfz_list () {

	if ($_SESSION['angemeldet'] == 1) {
		$link_open = "<A href='menue_call.php?go=tkfz_data.inc&dir=includes";
		$link_opendel = "<A href='menue_call.php?go=tkfz.php&dir=includes";

		$linkend = "</a>";

		//registrieren neues fahrzeug
		$sql = "SELECT  (c.fz_kennz), c.fz_marke, c.fz_type ,c.FZ_INDEXKEY
		FROM  {$_SESSION['SCEMA']}TKFZ  c
		WHERE c.indexkey = '{$_SESSION['INDEXKEY']}'
		and c.FZ_ERSTZULASSUNG > '1111-01-01' ORDER by c.fz_kennz" ;

		IF ($_SESSION['DB'] == 'MY'){
			  get_MY_connect($sql) ;
			  $result = mysqli_query($_SESSION ['CONNECT'], $sql);
		}else {
			    get_DB2_connect($sql) ;
		}

		echo  gettext('glob_titel').gettext('kfz_upd_head').gettext('glob_titel_end') ;
		echo  gettext('glob_typ1').gettext('kfz_upd_text').gettext('glob_typ1_end') ;

		echo "<table>";

		
		
		//echo 'kfz_list - '.$sql ;
		while ($row = $_SESSION['FETCH']($result))	{
			echo "<tr><td class='typ2' width='600'>";
			//echo "{$row[0]}";
			echo gettext("{$row[0]} {$row[1]} {$row[2]} ") ;
			echo "</td><td class='green' width='50'>";
			//ausgabe liste aller fahrzeuge des users
			echo "$link_open&func=kfz_upd&value=$row[0]'>";
			echo gettext("glob_aendern");
			echo "$linkend    ";
			echo "</td><td class='red' width='50'>";
			echo "$link_opendel&func=kfz_tbdel&value=$row[0]'>";
			echo gettext("glob_loeschen");
			echo "$linkend";
			//$kfzdel = kfz_upd($row[4]);
			echo "</td></tr>";
		}
	}else  {
		echo  gettext('glob_nicht_eingelogged');
	}echo "</table>" ;
}// function


function kfz_reg () {
	if ($_SESSION['angemeldet'] == 1) {
		//registrieren neues fahrzeug
		$sql = "SELECT (s.tblcol), s.varstring, substr(s.vartype,1,2) as vartyp , (s.tbl)
		FROM  {$_SESSION['SCEMA']}TVARSTRINGS s
		WHERE (s.maske='kfz' or s.maske='alle' )ORDER by s.pos" ;

		$_SESSION['FZ_INDEXKEY'] = time();
		$_SESSION['VALUE'] = '';

		IF ($_SESSION['DB'] == 'MY'){
			  get_MY_connect($sql) ;
			  $result = mysqli_query($_SESSION ['CONNECT'], $sql);
		}else {
			    get_DB2_connect($sql) ;
		}

		echo  gettext('glob_titel').gettext('kfz_registrieren_head').gettext('glob_titel_end') ;
		echo  gettext('glob_typ1').gettext('kfz_registrieren_text').gettext('glob_typ1_end') ;

		echo "<form name='kfz_neu' id='kfz_neu' onSubmit='return validate(this,var_1)'
				ACTION='menue_call.php?go=tkfz.php&dir=includes&func=kfz_tbnew' METHOD='POST'>" ;

		echo "<table>" ;

		$_SESSION['VALUE'] = '';

		
		
		//echo 'kfz_reg - '.$sql ;
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

			if($row[2]== 'sl') {
				echo "{$row[1]}  ";
				echo $data ;
				$country = get_country();
				echo "</select> </td></tr>";
			} elseif ($row[2] == 'se') {
				echo " {$row[1]} ";
				echo $data ;
				$fzeuro = get_fzeuro($_SESSION['LANG']);
				echo "</select></td></tr>";
			} elseif ($row[2] == 'sm') {
				echo " {$row[1]}  ";
				echo $data ;
				$fzmarke = get_fzmarke($_SESSION['LANG']);
				echo "</select></td></tr>";
			} elseif ($row[2] == 'st') {
				echo " {$row[1]}   ";
				echo $data ;
				$fztyp = get_fztyp($_SESSION['LANG']);
				echo "</select></td></tr>";
			} elseif ($row[2] == 'sa') {
				echo " {$row[1]}   ";
				echo $data ;
				$fzart = get_fzart($_SESSION['LANG']);
				echo "</select></td></tr>";
			}   elseif (SUBSTR($row[2],0,1) == 'd') {
				if (SUBSTR($row[2],1,1) == '1') {$w = 1;}
				elseif(SUBSTR($row[2],1,1) == '2') {$w = 2;}

				$y = substr($_SESSION['Value'], 0, 4) ;
				$m = substr($_SESSION['Value'], 5, 2) ;
				$d = substr($_SESSION['Value'], 8, 2) ;

				$gebdate = get_date($d, $m, $y, $w);

			} else {
				get_fomularend($row[1],$row[2]);
				echo $_SESSION['formdataend'];
			}
		}echo "</form> ";
	}else  {
		echo  gettext('glob_nicht_eingelogged');
	}echo "</table>" ;
}// function

function kfz_reg_q () {
	if ($_SESSION['angemeldet'] == 1) {
		//registrieren neues fahrzeug
		$sql = "SELECT (s.tblcol), s.varstring, substr(s.vartype,1,2) as vartyp , (s.tbl)
		FROM  {$_SESSION['SCEMA']}TVARSTRINGS s
		WHERE (s.maske='kfz' and s.tbl='TKFZ' )ORDER by s.pos" ;

		$_SESSION['FZ_INDEXKEY'] = time();
		$_SESSION['VALUE'] = '';

		IF ($_SESSION['DB'] == 'MY'){
			  get_MY_connect($sql) ;
			  $result = mysqli_query($_SESSION ['CONNECT'], $sql);
		}else {
			    get_DB2_connect($sql) ;
		}

		//echo  gettext('glob_titel').gettext('kfz_registrieren_head').gettext('glob_titel_end') ;
		//echo  gettext('glob_typ1').gettext('kfz_registrieren_text').gettext('glob_typ1_end') ;
		$_SESSION['VALUE'] = '';

		
		
		//echo 'fz_reg_q - '.$sql ;
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

			if($row[2]== 'sl') {
				echo "{$row[1]}  ";
				echo $data ;
				$country = get_country();
				echo "</select> </td></tr>";
			} elseif ($row[2] == 'se') {
				echo " {$row[1]} ";
				echo $data ;
				$fzeuro = get_fzeuro($_SESSION['LANG']);
				echo "</select></td></tr>";
			} elseif ($row[2] == 'sm') {
				echo " {$row[1]}  ";
				echo $data ;
				$fzmarke = get_fzmarke($_SESSION['LANG']);
				echo "</select></td></tr>";
			} elseif ($row[2] == 'st') {
				echo " {$row[1]}   ";
				echo $data ;
				$fztyp = get_fztyp($_SESSION['LANG']);
				echo "</select></td></tr>";
			} elseif ($row[2] == 'sa') {
				echo " {$row[1]}   ";
				echo $data ;
				$fzart = get_fzart($_SESSION['LANG']);
				echo "</select></td></tr>";
			}   elseif (SUBSTR($row[2],0,1) == 'd') {
				if (SUBSTR($row[2],1,1) == '1') {$w = 1;}
				elseif(SUBSTR($row[2],1,1) == '2') {$w = 2;}

				$y = substr($_SESSION['Value'], 0, 4) ;
				$m = substr($_SESSION['Value'], 5, 2) ;
				$d = substr($_SESSION['Value'], 8, 2) ;

				$gebdate = get_date($d, $m, $y, $w);

			} else {
				get_fomularend($row[1],$row[2]);
				echo $_SESSION['formdataend'];
			}
		}
	}
}// function

function kfz_upd($fz_kennz) {
	//echo "kfz_upd" ;
	if ($_SESSION['angemeldet'] == 1) {
		//registrieren neues fahrzeug
		$sql = "SELECT (s.tblcol), s.varstring, substr(s.vartype,1,2) as vartyp , (s.tbl)
		FROM  {$_SESSION['SCEMA']}TVARSTRINGS s
		WHERE s.maske='kfz' or s.maske='alle' ORDER by s.pos" ;

		IF ($_SESSION['DB'] == 'MY'){
			  get_MY_connect($sql) ;
			  $result = mysqli_query($_SESSION ['CONNECT'], $sql);
		}else {
			    get_DB2_connect($sql) ;
		}

		echo  gettext('glob_titel').gettext('kfz_registrieren_head').gettext('glob_titel_end') ;
		echo  gettext('glob_typ1').gettext('kfz_registrieren_text').gettext('glob_typ1_end') ;

		echo "<form name='kfz_upd' id='kfz_upd' onSubmit='return validate(this,var_1)'
	ACTION='menue_call.php?go=tkfz.php&dir=includes&func=kfz_tbupd' METHOD='POST'>" ;

		echo "<table>" ;
		
		
		//echo 'kfz_upd - '.$sql ;
		while ($row = $_SESSION['FETCH']($result))	{
			// get formular daten
			if (!empty($row[0])){
				// daten zu jeweiligen Formularvariabelen holen
				$where = "where indexkey = '{$_SESSION['INDEXKEY']}' and fz_kennz = '$fz_kennz'";
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
			} elseif ($row[2] == 'se') {
				echo " {$row[1]} ";
				echo $data ;
				$fzeuro = get_fzeuro($_SESSION['LANG']);
				echo "</select></td></tr>";
			} elseif ($row[2] == 'sm') {
				echo " {$row[1]}  ";
				echo $data ;
				$fzmarke = get_fzmarke($_SESSION['LANG']);
				echo "</select></td></tr>";
			} elseif ($row[2] == 'st') {
				echo " {$row[1]}   ";
				echo $data ;
				$fztyp = get_fztyp($_SESSION['LANG']);
				echo "</select></td></tr>";
			} elseif ($row[2] == 'sa') {
				echo " {$row[1]}   ";
				echo $data ;
				$fzart = get_fzart($_SESSION['LANG']);
				echo "</select></td></tr>";
			} elseif (SUBSTR($row[2],0,1) == 'd') {
				if (SUBSTR($row[2],1,1) == '1') {$w = 1;}
				elseif(SUBSTR($row[2],1,1) == '2') {$w = 2;}

				$y = substr($_SESSION['Value'], 0, 4) ;
				$m = substr($_SESSION['Value'], 5, 2) ;
				$d = substr($_SESSION['Value'], 8, 2) ;

				$gebdate = get_date($d, $m, $y, $w);;

			}else {
				get_fomularend($row[1],$row[2]);
				echo $_SESSION['formdataend'];
			}
		}echo "</form> ";
	}else  {
		echo  gettext('glob_nicht_eingelogged');
	}echo "</table>" ;
}// function

function get_fzeuro () {
	// ausgabe emmisionsklassen EURO
	//echo "hier euro" ;

	$sql = "SELECT fz_text FROM {$_SESSION['SCEMA']}TREFKFZ where fz_info = 'euro'
	and ( lang = '{$_SESSION['LANG']}' or lang = 'al' ) order by 1" ;

	IF ($_SESSION['DB'] == 'MY'){
		  get_MY_connect($sql) ;
		  $result = mysqli_query($_SESSION ['CONNECT'], $sql);
	}else {
		    get_DB2_connect($sql) ;
	}
	
	
	//echo 'get_fzeuro - '.$sql ;
	while ($row = $_SESSION['FETCH']($result))	{
		$l = htmlentities($row[0]);
		echo "<OPTION value='$row[0]'>$l</OPTION>";
	}
}


function get_fzmarke () {
	// ausgabe Fahrzeug marken

	$sql = "SELECT fz_text FROM {$_SESSION['SCEMA']}TREFKFZ where fz_info = 'marke'
	and ( lang = '{$_SESSION['LANG']}' or lang = 'al' ) order by 1" ;
	IF ($_SESSION['DB'] == 'MY'){
		  get_MY_connect($sql) ;
		  $result = mysqli_query($_SESSION ['CONNECT'], $sql);
	}else {
		    get_DB2_connect($sql) ;
	}

	
	
	//echo 'get_fzmarke - '.$sql ;
	while ($row = $_SESSION['FETCH']($result))	{
		$l = htmlentities($row[0]);
		echo "<OPTION value='$row[0]'>$l</OPTION>";
	}
}

function get_fztyp () {
	// ausgabe fahrzeugtyp

	$sql = "SELECT fz_text FROM {$_SESSION['SCEMA']}TREFKFZ where fz_info = 'typ'
	and ( lang = '{$_SESSION['LANG']}' or lang = 'al' ) order by 1" ;

	IF ($_SESSION['DB'] == 'MY'){
		  get_MY_connect($sql) ;
		  $result = mysqli_query($_SESSION ['CONNECT'], $sql);
	}else {
		    get_DB2_connect($sql) ;
	}

	
	
	echo 'get_fztyp - '.$sql ;
	while ($row = $_SESSION['FETCH']($result))	{
		$l = htmlentities($row[0]);
		echo "<OPTION value='$row[0]'>$l</OPTION>";
	}
}

function get_fzart () {
	// ausgabe emmisionsklassen EURO

	$sql = "SELECT fz_text FROM {$_SESSION['SCEMA']}TREFKFZ where fz_info = 'art'
	and ( lang = '{$_SESSION['LANG']}' or lang = 'al' ) order by 1" ;

	IF ($_SESSION['DB'] == 'MY'){
		  get_MY_connect($sql) ;
		  $result = mysqli_query($_SESSION ['CONNECT'], $sql);
	}else {
		    get_DB2_connect($sql) ;
	}

	
	
	//echo 'get_fzart - '.$sql ;
	while ($row = $_SESSION['FETCH']($result))	{
		$l = htmlentities($row[0]);
		echo "<OPTION value='$row[0]'>$l</OPTION>";
	}

}
?>