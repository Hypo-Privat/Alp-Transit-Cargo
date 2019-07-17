
<?php
global $zeilenr;

function such_list($value) {
	//echo 'hallo : toursuchen_dat.inc ' . $value;
	
	date_default_timezone_set ( 'Europe/Berlin' );
	
	// Date zentral machen
	// date_default_timezone_set("UTC") ;
	$timestamp = time ();
	$ya = date ( "Y", $timestamp );
	$ma = date ( "m", $timestamp );
	$da = date ( "d", $timestamp );
	// value liefert was gesucht wird und sortierung
	// kfz_ab_plz_d = suche fahrzeug sortiere descending ab_plz_d
	$suche = substr ( $value, 0, 3 );
	$value = substr ( $value, 4, 10 );
	//echo $suche, $value;
	// $termin[] = '' ;
	// echo $ya.'-'.$ma.'-'.$da ;
	
	/*
	$db = mysqli_connect ( "server12.hostfactory.ch", "db2inst1", "DB2admin", "a-t-c" );
	// $db = mysqli_connect ( "www.jamfinder.info", "jamfinder_usr", "Name0815", "jamfinder" );
	if (mysqli_connect_errno ()) {
		printf ( "Verbindung fehlgeschlagen: %s", mysqli_connect_error () );
		exit ();
	}
	
	mysqli_query ( $db, "SET NAMES 'utf8'" );
	*/
	if ($suche == 'kfz') {
		// registrieren neues fahrzeug
		$sql = "SELECT
		t.INDEXKEY, TOUR_INDEXKEY,
		AB_DAT, AB_LAND, AB_PLZ, AB_ORT ,
		AN_DAT, AN_LAND, AN_PLZ, AN_ORT,
		GEWICHT, VOLUMEN, NOTE,
		concat(fz_art , ' ' , fz_marke , ' ') as KFZ_INDEXKEY, PART_INDEXKEY
		FROM  {$_SESSION['SCEMA']}TTOURKFZ  t , {$_SESSION['SCEMA']}TKFZ z
		WHERE   an_dat >= ab_dat
		and an_dat > '1111-01-01'
		and an_dat >= '$ya-$ma-$da'
		and( KFZ_INDEXKEY = z.FZ_INDEXKEY 	and t.INDEXKEY = z.INDEXKEY)";
	}
	
	if ($suche == 'lad') {
		// registrieren neues ladung
		$sql = "SELECT
		INDEXKEY, LADUNG_INDEXKEY,
		AB_DAT, AB_LAND, AB_PLZ, AB_ORT ,
		AN_DAT, AN_LAND, AN_PLZ, AN_ORT,
		GEWICHT, VOLUMEN, NOTE,
		ANZAHL, PACKART, KFZ_ART
		FROM  {$_SESSION['SCEMA']}TTOURLAD  t
		WHERE  an_dat >= ab_dat
		and an_dat > '1111-01-01'
		and an_dat >= '$ya-$ma-$da'";
	}
	if ($suche == 'umz') {
		// registrieren neues fahrzeug
		$sql = "SELECT
		t.INDEXKEY, umz_INDEXKEY,
		AB_DAT, AB_LAND, AB_PLZ, AB_ORT ,
		AN_DAT, AN_LAND, AN_PLZ, AN_ORT,
		ab_zimmer, ab_etage, ab_aufz,
		an_zimmer, an_etage, an_aufz,
		kart_glas, kart_buch, kart_kleid, NOTE	
		FROM  {$_SESSION['SCEMA']}TUMZUG  t
		WHERE   an_dat > '1111-01-01'
		and an_dat >= '$ya-$ma-$da'
		and an_dat >= ab_dat
		";
	}
	
	// echo 'such_list - '.$sql ;
	IF ($_SESSION ['DB'] == 'MY') {
		get_MY_connect($sql) ;
		$result = mysqli_query ( $_SESSION ['CONNECT'], $sql );
	} else {
		get_DB2_connect ( $sql );
		$result = db2_execute ( $stmt );
	}
	
	if ($suche == 'kfz') {
		echo gettext ( 'glob_titel' ) . gettext ( 'suche_kfz_head' ) . gettext ( 'glob_titel_end' );
		echo gettext ( 'glob_typ1' ) . gettext ( 'suche_kfz_text' ) . gettext ( 'glob_typ1_end' );
	}
	if ($suche == 'lad') {
		echo gettext ( 'glob_titel' ) . gettext ( 'suche_lad_head' ) . gettext ( 'glob_titel_end' );
		echo gettext ( 'glob_typ1' ) . gettext ( 'suche_lad_text' ) . gettext ( 'glob_typ1_end' );
	}
	if ($suche == 'umz') {
		echo gettext ( 'glob_titel' ) . gettext ( 'suche_umz_head' ) . gettext ( 'glob_titel_end' );
		echo gettext ( 'glob_typ1' ) . gettext ( 'suche_umz_text' ) . gettext ( 'glob_typ1_end' );
	}
	
	// echo 'such_list - '.$sql ;
	while ( $row = $_SESSION ['FETCH'] ( $result ) ) {
		$linkend = "</a>";
		$tour_value = $row [0] . $suche . $row [1];
		$link_contact = "<A href=\"javascript:show('output.php?go=toursuchen.php&dir=includes&func=outp&value=$tour_value')\">";
		$contact = $link_contact . gettext ( 'link_contact' ) . $linkend;
		
		if ($suche == 'kfz') {
			$termin [] = array (
					gettext ( "AB_DAT" ) => $row [2],
					gettext ( "AB_LAND" ) => $row [3],
					gettext ( "AB_PLZ" ) => $row [4],
					gettext ( "AB_ORT" ) => $row [5],
					gettext ( "AN_DAT" ) => $row [6],
					gettext ( "AN_LAND" ) => $row [7],
					gettext ( "AN_PLZ" ) => $row [8],
					gettext ( "AN_ORT" ) => $row [9],
					gettext ( "GEWICHT" ) => $row [10],
					gettext ( "VOLUMEN" ) => $row [11],
					gettext ( "NOTE" ) => $row [12],
					gettext ( "KFZ_INDEXKEY" ) => $row [13],
					gettext ( "PART_INDEXKEY" ) => $row [14],
					gettext ( "link_contact" ) => $contact 
			);
		}
		if ($suche == 'lad') {
			$termin [] = array (
					gettext ( "AB_DAT" ) => $row [2],
					gettext ( "AB_LAND" ) => $row [3],
					gettext ( "AB_PLZ" ) => $row [4],
					gettext ( "AB_ORT" ) => $row [5],
					gettext ( "AN_DAT" ) => $row [6],
					gettext ( "AN_LAND" ) => $row [7],
					gettext ( "AN_PLZ" ) => $row [8],
					gettext ( "AN_ORT" ) => $row [9],
					gettext ( "GEWICHT" ) => $row [10],
					gettext ( "VOLUMEN" ) => $row [11],
					gettext ( "NOTE" ) => $row [12],
					gettext ( "ANZAHL" ) => $row [13],
					gettext ( "PACKART" ) => $row [14],
					gettext ( "KFZ_ART" ) => $row [15],
					gettext ( "link_contact" ) => $contact 
			);
		}
		if ($suche == 'umz') {
			$termin [] = array (
					gettext ( "AB_DAT" ) => $row [2],
					gettext ( "AB_LAND" ) => $row [3],
					gettext ( "AB_PLZ" ) => $row [4],
					gettext ( "AB_ORT" ) => $row [5],
					gettext ( "AN_DAT" ) => $row [6],
					gettext ( "AN_LAND" ) => $row [7],
					gettext ( "AN_PLZ" ) => $row [8],
					gettext ( "AN_ORT" ) => $row [9],
					gettext ( "AB_ZIMMER" ) => $row [10],
					gettext ( "AB_ETAGE" ) => $row [11],
					gettext ( "AB_AUFZ" ) => $row [12],
					gettext ( "AN_ZIMMER" ) => $row [13],
					gettext ( "AN_ETAGE" ) => $row [14],
					gettext ( "AN_AUFZ" ) => $row [15],
					gettext ( "link_contact" ) => $contact 
			);
		}
	}
	// print_r($_SESSION);
	sort_tabelle ( $termin, $suche, $value );
}
function sort_tabelle($termin, $suche, $value) {
	foreach ( $termin as $nr => $inhalt ) { // print_r($termin) ;
		$ab_dat [$nr] = strtolower ( $inhalt [gettext ( 'AB_DAT' )] );
		$ab_land [$nr] = strtolower ( $inhalt [gettext ( 'AB_LAND' )] );
		$ab_plz [$nr] = strtolower ( $inhalt [gettext ( 'AB_PLZ' )] );
		$ab_ort [$nr] = strtolower ( $inhalt [gettext ( 'AB_ORT' )] );
		// an
		$an_dat [$nr] = strtolower ( $inhalt [gettext ( 'AN_DAT' )] );
		$an_land [$nr] = strtolower ( $inhalt [gettext ( 'AN_LAND' )] );
		$an_plz [$nr] = strtolower ( $inhalt [gettext ( 'AN_PLZ' )] );
		$an_ort [$nr] = strtolower ( $inhalt [gettext ( 'AN_ORT' )] );
		// echo $ab_dat[$nr];
	}
	if ($value == 'ab_dat_a') {
		// Sortierung nach Datum und Ort aufsteigend
		array_multisort ( $ab_dat, SORT_ASC, $ab_land, SORT_ASC, $termin );
	} elseif ($value == 'ab_plz_a') {
		// Sortierung nach Ort aufsteigend
		array_multisort ( $ab_plz, SORT_ASC, $termin );
	} elseif ($value == 'ab_land_a') {
		// Sortierung nach Ort aufsteigend
		array_multisort ( $ab_land, SORT_ASC, $termin );
	} elseif ($value == 'ab_ort_a') {
		// Sortierung nach Ort aufsteigend
		array_multisort ( $ab_ort, SORT_ASC, $termin );
		
		// ab desc
	} elseif ($value == 'ab_plz_d') {
		// Sortierung nach Ort aufsteigend
		array_multisort ( $ab_plz, SORT_DESC, $termin );
	} elseif ($value == 'ab_ort_d') {
		// Sortierung nach Ort aufsteigend
		array_multisort ( $ab_ort, SORT_DESC, $termin );
	} elseif ($value == 'ab_land_d') {
		// Sortierung nach Ort aufsteigend
		array_multisort ( $ab_land, SORT_DESC, $termin );
	} elseif ($value == 'ab_dat_d') {
		// Sortierung nach Ort aufsteigend
		array_multisort ( $ab_dat, SORT_DESC, $termin );
		// an asc
	} elseif ($value == 'an_dat_a') {
		// Sortierung nach Datum und Ort aufsteigend
		array_multisort ( $an_dat, SORT_ASC, $ab_land, SORT_ASC, $termin );
	} elseif ($value == 'an_plz_a') {
		// Sortierung nach Ort aufsteigend
		array_multisort ( $an_plz, SORT_ASC, $termin );
	} elseif ($value == 'an_land_a') {
		// Sortierung nach Ort aufsteigend
		array_multisort ( $an_land, SORT_ASC, $termin );
	} elseif ($value == 'an_ort_a') {
		// Sortierung nach Ort aufsteigend
		array_multisort ( $an_ort, SORT_ASC, $termin );
		
		// an desc
	} elseif ($value == 'an_plz_d') {
		// Sortierung nach Ort aufsteigend
		array_multisort ( $an_plz, SORT_DESC, $termin );
	} elseif ($value == 'an_ort_d') {
		// Sortierung nach Ort aufsteigend
		array_multisort ( $an_ort, SORT_DESC, $termin );
	} elseif ($value == 'an_land_d') {
		// Sortierung nach Ort aufsteigend
		array_multisort ( $an_land, SORT_DESC, $termin );
	} elseif ($value == 'an_dat_d') {
		// Sortierung nach Ort aufsteigend
		array_multisort ( $an_dat, SORT_DESC, $termin );
	} else {
		// Sortierung nach Datum
		array_multisort ( $ab_dat, SORT_ASC, $ab_land, SORT_ASC, $termin );
	}
	ausgabe_tabelle ( $termin, $suche );
}

function ausgabe_tabelle($termin, $suche) {
	
	$link_sort = "<a href='menue_call.php?go=toursuchen_data.inc&dir=includes&func=such_list&value=" . $suche;
	
	// echo 'function ausgabe_tabelle' ;
	echo '<table width="700" border="1" cellpadding="6" cellspacing="0" >';
	
	// Kopf fuer sortierung
	echo '<tr>';
	
	echo '<td class="head">';
	echo gettext ( "AB_DAT" ), '<BR>';
	echo $link_sort, "_ab_dat_d'><img border='0' src='../images/down.gif'></a>";
	echo ' ';
	echo $link_sort, "_ab_dat_a'><img border='0' src='../images/up.gif'></a>";
	echo '</td>';
	
	echo '<td class="head">';
	echo gettext ( "AB_LAND" ), '<BR>';
	echo $link_sort, "_ab_land_d'><img border='0' src='../images/down.gif'></a>";
	echo ' ';
	echo $link_sort, "_ab_land_a'><img border='0' src='../images/up.gif'></a>";
	echo '</td>';
	
	echo '<td class="head">';
	echo gettext ( "AB_ORT" ), '<BR>';
	echo $link_sort, "_ab_ort_d'><img border='0' src='../images/down.gif'></a>";
	echo ' ';
	echo $link_sort, "_ab_ort_a'><img border='0' src='../images/up.gif'></a>";
	echo '</td>';
	echo '<td class="head">';
	echo gettext ( "AB_PLZ" ), '<BR>';
	echo $link_sort, "_ab_plz_d'><img border='0' src='../images/down.gif'></a>";
	echo ' ';
	echo $link_sort, "_ab_plz_a'><img border='0' src='../images/up.gif'></a>";
	echo '</td>';
	// an
	echo '<td class="head">';
	echo gettext ( "AN_DAT" ), '<BR>';
	echo $link_sort, "_an_dat_d'><img border='0' src='../images/down.gif'></a>";
	echo ' ';
	echo $link_sort, "_an_dat_a'><img border='0' src='../images/up.gif'></a>";
	echo '</td>';
	
	echo '<td class="head">';
	echo gettext ( "AN_LAND" ), '<BR>';
	echo $link_sort, "_an_land_d'><img border='0' src='../images/down.gif'></a>";
	echo ' ';
	echo $link_sort, "_an_land_a'><img border='0' src='../images/up.gif'></a>";
	echo '</td>';
	
	echo '<td class="head">';
	echo gettext ( "AN_ORT" ), '<BR>';
	echo $link_sort, "_an_ort_d'><img border='0' src='../images/down.gif'></a>";
	echo ' ';
	echo $link_sort, "_an_ort_a'><img border='0' src='../images/up.gif'></a>";
	echo '</td>';
	
	echo '<td class="head">';
	echo gettext ( "AN_PLZ" ), '<BR>';
	echo $link_sort, "_an_plz_d'><img border='0' src='../images/down.gif'></a>";
	echo ' ';
	echo $link_sort, "_an_plz_a'><img border='0' src='../images/up.gif'></a>";
	echo '</td>';
	
	echo '<td class="head">';
	echo "<img border='0' src='../images/info_mouseover.gif'>";
	echo '</td>';
	
	echo '</tr>';
	$zeilenr ;
	foreach ( $termin as $inhalt ) {
		$zeilenr ++;
		echo '<tr';
		echo farbwechsel ( $zeilenr );
		echo '>';
		
		echo '<td>';
		echo datum_deutsch ( $inhalt [gettext ( "AB_DAT" )] );
		// echo datum_deutsch($inhalt['Datum']);
		echo '</td>';
		
		echo '<td>';
		echo $inhalt [gettext ( "AB_LAND" )];
		echo '</td>';
		
		echo '<td>';
		echo $inhalt [gettext ( "AB_ORT" )];
		echo '</td>';
		
		echo '<td>';
		echo $inhalt [gettext ( "AB_PLZ" )];
		echo '</td>';
		
		// an
		
		echo '<td>';
		echo datum_deutsch ( $inhalt [gettext ( "AN_DAT" )] );
		// echo datum_deutsch($inhalt['Datum']);
		echo '</td>';
		
		echo '<td>';
		echo $inhalt [gettext ( "AN_LAND" )];
		echo '</td>';
		
		echo '<td>';
		echo $inhalt [gettext ( "AN_ORT" )];
		echo '</td>';
		
		echo '<td>';
		echo $inhalt [gettext ( "AN_PLZ" )];
		echo '</td>';
		echo '<td>';
		echo $inhalt [gettext ( "link_contact" )];
		echo '</td>';
		
		echo '</tr>';
		
		// zeile 2 IF $SUCH = LAD
		echo '<tr';
		echo farbwechsel ( $zeilenr );
		echo '>';
		
		echo '<td colspan="9">';
		
		if ($suche == 'lad') {
			echo ' - ' . gettext ( "GEWICHT" ) . ': ' . $inhalt [gettext ( "GEWICHT" )];
			echo ' - ' . gettext ( "VOLUMEN" ) . ': ' . $inhalt [gettext ( "VOLUMEN" )];
			echo ' - ' . gettext ( "ANZAHL" ) . ': ' . $inhalt [gettext ( "ANZAHL" )];
			echo ' - ' . gettext ( "PACKART" ) . ': ' . $inhalt [gettext ( "PACKART" )];
			echo ' - ' . gettext ( "KFZ_ART" ) . ': ' . $inhalt [gettext ( "KFZ_ART" )];
		}
		if ($suche == 'kfz') {
			echo ' - ' . gettext ( "GEWICHT" ) . ': ' . $inhalt [gettext ( "GEWICHT" )];
			echo ' - ' . gettext ( "VOLUMEN" ) . ': ' . $inhalt [gettext ( "VOLUMEN" )];
			echo ' - ' . gettext ( "KFZ_INDEXKEY" ) . ': ' . $inhalt [gettext ( "KFZ_INDEXKEY" )];
			// echo $inhalt[gettext("PART_INDEXKEY")];
		}
		
		if ($suche == 'umz') {
			echo ' - ' . gettext ( "AB_ZIMMER" ) . ': ' . $inhalt [gettext ( "AB_ZIMMER" )];
			echo ' - ' . gettext ( "AB_ETAGE" ) . ': ' . $inhalt [gettext ( "AB_ETAGE" )];
			echo ' - ' . gettext ( "AB_AUFZ" ) . ': ' . $inhalt [gettext ( "AB_AUFZ" )];
			echo ' - ' . gettext ( "AN_ZIMMER" ) . ': ' . $inhalt [gettext ( "AN_ZIMMER" )];
			echo ' - ' . gettext ( "AN_ETAGE" ) . ': ' . $inhalt [gettext ( "AN_ETAGE" )];
			echo ' - ' . gettext ( "AN_AUFZ" ) . ': ' . $inhalt [gettext ( "AN_AUFZ" )];
			echo ' - ' . gettext ( "KART_GLAS" ) . ': ' . $inhalt [gettext ( "KART_GLAS" )];
			echo ' - ' . gettext ( "KART_BUCH" ) . ': ' . $inhalt [gettext ( "KART_BUCH" )];
			echo ' - ' . gettext ( "KART_KLEID" ) . ': ' . $inhalt [gettext ( "KART_KLEID" )];
		}
		// ende zeile 2
		echo ' - ' . gettext ( "NOTE" ) . ': ' . $inhalt [gettext ( "NOTE" )];
		echo '</td></tr>';
	}
	echo '</table>';
}


function datum_deutsch($ab_dat) {
	// echo "hier datum_deutsch";
	$jahr = substr ( $ab_dat, 0, 4 );
	$monat = substr ( $ab_dat, 5, 2 );
	$tag = substr ( $ab_dat, 8, 2 );
	$datum_deutsch = $tag . "." . $monat . "." . $jahr;
	return ($datum_deutsch);
}
function farbwechsel($zeilenr) {
	//(bcmod( $zeilenr, '2' ) == 0)
	//echo $zeilenr ;
	if (( $zeilenr) == 1){
		$hintergrundfarbe = ' bgcolor="#6696bc" ';
	} else {
		$hintergrundfarbe = ' bgcolor="#EFEFEF" ';
	}
	return ($hintergrundfarbe);
}

?>
