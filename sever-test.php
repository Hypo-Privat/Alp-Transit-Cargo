<?php
error_reporting(E_ALL);
// wenn die nächste Zeile Probleme macht, einfach rausschmeißen
ini_set('display_errors', 1);
session_start();

$msg = '';
if ( !isset($_COOKIE['testcookie']) ) {
	$msg .= '<p class="error">testcookie war nicht vorhanden, neuer Wert: ' . session_id() . "</p>\n";

	if ( !setcookie('testcookie', session_id(), 0, '/') ) {
		$msg .= '<p class="error">testcookie konnte nicht gesetzt werden</p>';
	}
}
else if ($_COOKIE['testcookie'] != session_id() ) {
	$msg .='<p class="error">testcookie != session_id<br />['.$_COOKIE['testcookie'].'] != ['.session_id().']</p>';
}

if ( !isset($_SESSION['foo']) ) {
	$msg .='<p class="error">_SESSION[foo] nicht vorhanden</p>';
	$_SESSION['foo'] = time();
}
?>
<html>
<head>
<title>session test1</title>
<?php if (0===strlen($msg)) { ?>
<meta http-equiv="refresh" content="2" />
<?php } ?>
<style type="text/css">
.error {
	border: 1px solid red;
}
</style>
</head>
<body>
<?php if(0!==strlen($msg)) { echo $msg; } ?>
<p>jetzt: <?php echo date('d.m.Y H:i:s'); ?></p>
<pre>_SESSION=<?php var_dump($_SESSION); ?></pre>
<pre>_COOKIE=<?php var_dump($_COOKIE); ?></pre>
<a href="?<?php echo time(); ?>">reload</a>

<?php
//gert
/*echo "<pre>";
echo "Session\n";
var_dump($_SESSION);
echo "\n\nPost\n";
var_dump($_POST);
echo "\n\nGet\n";
var_dump($_GET);
echo "\n\nCookie\n";
var_dump($_COOKIE);
echo "</pre>";*/
?>

</body>
</html>
