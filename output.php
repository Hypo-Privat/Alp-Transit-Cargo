<!-- AUSGEBEN DER GANZEN SEITE kopf -->
<?php
ini_set("error_reporting", E_ERROR );

if (headers_sent() == false) {
	@session_start();
	// Nun erstellen wir in der Session ein Schl�ssel mit einen Wert
	$_SESSION['username'] = 'Guest';
	$_SESSION['ENV'] = 'env';
	$_SESSION['LANG'] = 'de';
	$_SESSION['ZEIT'] = time();
	$_SESSION['DB'] = 'MY'; 	//DB2 oder MY = MYSQL
	$_SESSION['SCEMA'] = '' ; 	//'ATC.' oder MY = ''
	$_SESSION['FETCH']= 'mysqli_fetch_array' ; // DB2 = db2_fetch_array
}

//echo "hier" ;
require 'includes/gettext.php';
//db connect einbinden
require 'includes/connATC.inc';
//include other functions
require 'includes/selectlist.inc';
// ausgabe html block kopf
require 'includes/kopf_small.php';

//$go = 'barcode.php';
//$dir = 'dyn';
//require ("includes/toursuchen.php?value=1196953709kfz1200858030");
//Ausgabe der werte zum test
$file = "$dir/$go" ;
//echo "$dir/$go" ;
//print_r($_SESSION);
//echo $file, $value ,$func ;
require ($file);
$func($value);
echo gettext('glob_close_window');
require ("includes/fuss_small.php");
?>
<!-- ENDE AUSGEBEN DER GANZEN SEITE -->