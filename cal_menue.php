<?php

//date_default_timezone_set("UTC") ;
date_default_timezone_set ( 'Europe/Berlin' );
//require_once 'cal_pgm/gettext.php';
//db connect einbinden
require_once 'cal_script/connATC.php';
//require_once 'cal_script/sendmail.php';
//$_SESSION['angemeldet'] = false; // default
require_once ('cal_pgm/kopf.html');


echo  " VAR - lang - "  , $lang  . "\n";;
echo  " - $_SESSION menue_call - nach includes --- "  . "\n";;
print_r($_SESSION);


if (empty ($dir)) {
	$_SESSION['DIR'] = '';
} else {
	$_SESSION['DIR'] = $dir;
}
if (empty ($go)) {
	$_SESSION['DIR'] = 'cal_pgm';
	$_SESSION['GO'] = 'main';
} else {
	$_SESSION['GO'] = $go;
}

if ($dir == 'cal_pgm') {
	$_SESSION['TYPE'] = '.html';
} else {
	if ($dir == 'cal_script')
	$_SESSION['TYPE'] = '.php';
}

//echo ($_SESSION['DIR'] . '/' .$_SESSION['GO'].$_SESSION['TYPE']);

$_SESSION['GO'] = $go;
$_SESSION['DIR'] = $dir;

//echo ($_SESSION['DIR'] . '/' .$_SESSION['GO'].$_SESSION['TYPE']);
if (!empty ($func)) {
	//echo ' func';
	require ($_SESSION['DIR'] . '/' .$_SESSION['GO'].$_SESSION['TYPE']);
	$func ($value); //<-- Funktion aufrufen
} else {
	//echo 'else func';
	require ($_SESSION['DIR'] . '/' .$_SESSION['GO'].$_SESSION['TYPE']);
}


//echo ($_SERVER['SERVER_NAME'] . '/' . $_SESSION['DIR'] . '/' . $go . $type);
require_once ('cal_pgm/fuss.html');
//<a href='main.php?skin=blue&go=inhalt2'>
?>
