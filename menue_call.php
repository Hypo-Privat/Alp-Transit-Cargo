<?php
session_start();
date_default_timezone_set("UTC");

//<!-- AUSGEBEN DER GANZEN SEITE kopf -->
//echo "hier" ;

//echo  " - $_SESSION menue_call - vor includes" , "<br />";
//print_r($_SESSION);
//$_SESSION['LANG'] = 'de' ;
//$lang = 'de';
//include_once("includes/vars.php");

include_once("analyticstracking.php");

//db connect einbinden
require_once 'includes/connATC.inc';
get_MY_connect('a') ;
//require_once 'includes/error_report.php' ;

require_once 'includes/gettext.php';

//include other functions
require_once 'includes/selectlist.inc';

//kalender einbinden
require_once 'includes/calendar.inc';

// ausgabe html block kopf
require_once 'includes/kopf.php';

//echo  " anfang - $lang - "   ,  $_GET['lang']  ,  "-----"  , $_GET['value'];
//echo  " - $_SESSION menue_call - nach includes" , ($_SESSION['LANG']) , "<br />";

$value = $_GET['value'];

//$_SESSION['LANG'] = $lang  ;
if (!isset($_GET['lang'] )) {
	$_GET['lang'] = $_SESSION['LANG']  ;
} else {$_SESSION['LANG'] = $_GET['lang'];}


if (!isset($_SESSION['LANG'])) {
	$_SESSION['LANG'] = 'en' ;
//$_SESSION['LANG'] = $lang  ;
} else { $_SESSION['LANG'] = $_GET['lang'];}

/*
print_r($_SESSION) ;
echo ( "\n");
print_r($_GET) ;
*/
//<!-- hier check logik einbauen welche seite angezeigt wird -->

if ($_GET['dir'] == 'stat') {
	// aufruf statische seiten
	$file = $_GET['dir']/$_GET['go']{$_SESSION['LANG']};
	//{$_SESSION['LANG']}
	$_SESSION['FILE'] = isset($_GET['go']);
	$_SESSION['DIR'] = isset($_GET['dir']);
	//echo " stat - ", $file;
} elseif ($_GET['dir'] == 'dyn') {
	// aufruf dynamische seiten
	$file = "{$dir}/{$go}";
	$_SESSION['FILE'] = ($_GET['go']);
	$_SESSION['DIR'] = ($_GET['dir']);
	//echo " dyn - ", $file;

} elseif ($_SESSION['DIR'] == 'dyn') {
	$file = "{$_SESSION['DIR']}/{$_SESSION['FILE']}";
	//echo " SESSION dyn - ", $file;

} elseif ($_SESSION['DIR'] == 'stat') {
	$file = "{$_SESSION['DIR']}/{$_SESSION['FILE']}{$_SESSION['LANG']}";
	//echo " SESSION stat - ", $file;

} else { 	$file = "dyn/welcome"; }

if (!empty($_GET['func'])) {
	//-- funktionsaufruf per Link: auf datei.php?action=add  -->
	$_SESSION['FILE'] = $_GET['go'] ;
	$_SESSION['DIR'] = $_GET['dir'] ;
	$_SESSION['FUNC'] = $_GET['func'] ;
	//	print_r($_SESSION);
	$file = "{$_SESSION['DIR']}/{$_SESSION['FILE']}";
//	echo ' --- $func - file --- value - ', $func, ' - ', $file , ' - ', $value;
	require ($file);
	$func($value);
	
	//<-- Funktion aufrufen

	require_once 'includes/fuss.php';
	exit ;
} else {

//echo  " ENDE - $lang - "  , $lang  ,  "<br />";

//Ausgabe der werte zum test
//echo "  file - " , $file  , "  " ;
//echo $_SESSION['LANG'] ;
//print_r($_SESSION);
require ($file . ".php");

//<!-- hier ende der logik AUSGABE FUSS -->
require_once ("includes/fuss.php");
//<!-- ENDE AUSGEBEN DER GANZEN SEITE -->
}
?>
