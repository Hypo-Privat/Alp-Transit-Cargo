<?php


//	session daten l�schen
//include 'includes/session_clear.php';

//session_set_save_handler("oeffne", "schliesse", "lese", "schreibe", "loesche", "gc");
//session_id();

//session_name(localhost);
//	save_logout();

//register_globals (Sie k�nnen Ihre Variablen demnach nicht
// mehr mit "$var" ansprechen, sondern m�ssen $_POST["var"], $_GET["var"], etc. nutzen.)

//require_once 'includes/vars.php';

$_SESSION['ENV'] = 'env';
$_SESSION['LANG'] = 'de';
$_SESSION['ZEIT'] = time();
$_SESSION['DB'] = 'MY'; 	//DB2 oder MY = MYSQL
$_SESSION['SCEMA'] = '' ; 	//'ATC.' oder MY = ''
$_SESSION['FETCH']= 'mysqli_fetch_array' ; // DB2 = db2_fetch_array

// user bekommt registrierungsmaske
// nach erfolgreichem login aendert Status in 'profile'
$_SESSION['angemeldet'] = false;	// default
//var_dump($_SESSION);
//print_r($_SESSION);
header('Location:includes/lang_get.php');
exit;
?>