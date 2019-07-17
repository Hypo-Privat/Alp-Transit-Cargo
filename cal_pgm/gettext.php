<?php {
	//Listing 3: index_gettext.php
	//include_once 'includes/lang_get.php';
	// Set language to German
	/*Listing 3: index_gettext.php
	LC_CTYPE (0)f�r die Klassifizierung und Umwandlung von Zeichen (z.B. strtouper('a') == 'A').
	LC_NUMERIC (1) f�r dezimale Zahlenformatierungen (bspw. 3,14 oder 3.14).
	LC_TIME (2) f�r Datums- und Zeitformatierungen (bspw. '05. November' oder '11/05').
	LC_COLLATE (3) f�r Vergleiche von Zeichenketten (z.B. 'Apfel' < 'Birne', da A vor B kommt).
	LC_MONETARY (4) f�r monet�re Zahlenformatierungen (bpsw. 1'999,95 � oder 1,999.95 �).
	LC_MESSAGES (5) f�r Textausgaben (bspw. 'Hallo' oder 'Hello').
	LC_ALL (6) f�r alle oben genannten Werte. 
	*/
	//include_once 'includes/lang_get.php';

	if($_SESSION['LANG'] == 'de') {	$lang1 = 'de_DE';}
	elseif ($_SESSION['LANG'] == 'fr') {$lang1 = 'fr_FR';}
	elseif ($_SESSION['LANG'] == 'it') {$lang1 = 'it_IT';}
	elseif ($_SESSION['LANG'] == 'en') {$lang1 = 'en_GB';}
	elseif ($_SESSION['LANG'] == 'es') {$lang1 = 'es_ES';}

	// Set language to Lang
	putenv("LANG=$lang1");
	// teilt gettext die Sprache mit
	setlocale(LC_ALL,  $lang1);

	$locale = $lang1; // setzt die Sprache auf Deutsch
	//$domain = 'a-t-c'.$_SESSION['LANG']; // setzt die Dom?ne
	$domain = 'a-t-c_'.$_SESSION['LANG'] ;
	$encoding = 'ISO-8859-1'; // setzt die Zeichenkodierung
	
	// teilt gettext die Sprache mit
	setlocale(LC_MESSAGES, $locale);

	// teilt gettext mit, wo es die ?bersetzungen suchen soll
	bindtextdomain($domain , "./locale/");
	// teilt gettext die zu verwendene Zeichenkodierung mit
	bind_textdomain_codeset($domain, $encoding);

	// weist gettext an, die definierte Dom?ne zu verwenden
	textdomain($domain);

	// gettext erwartet die ?bersetzung nun in
	//./de/LC_MESSAGES/A-T-C.mo
	//echo " $locale ,$domain , $encoding <br>";

}?>