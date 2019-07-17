<?php
//session daten loeschen
//include 'includes/session_clear.php';
session_start();
//session_set_save_handler("oeffne", "schliesse", "lese", "schreibe", "loesche", "gc");
session_id();
//session_name(localhost);
//	save_logout();
require_once 'cal_script/vars.php';
$_SESSION['ENV']='env';
$_SESSION['LANG']='de';
$_SESSION['ZEIT']=time();
$_SESSION['DB']='MY';
//DB2 oder MY = MYSQL
$_SESSION['SCEMA']='';
//'ATC.' oder MY = ''
// user bekommt registrierungsmaske
// nach erfolgreichem login aendert Status in 'profile'
$_SESSION['angemeldet']=false;
// default
//var_dump($_SESSION);
require_once ("cal_pgm/kopf.html");
IF(!$go) {
$go="cal_pgm/main";
}
include ($go.".html");
require_once ("cal_pgm/fuss.html");
//<a href="main.php?skin=blue&go=inhalt2">
?>