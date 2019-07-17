<?php
	//	session daten l�schen
	//print_r($_COOKIE);
	session_destroy();
	session_unset();
	//session_start();
	$_SESSION['angemeldet'] = false;
	$_SESSION['ZEIT'] = time();
	$_SESSION['DB'] = 'MY'; 	//oder MY = MYSQL
	$_SESSION['SCEMA'] = '' ; 	//oder MY = ''
	$_SESSION['LANG'] = 'de' ;
	//include 'includes/lang_get.php';

	//print_r($_SESSION);

?>