<?php
/*echo "<pre>";
echo "Session\n";
var_dump($_SESSION);
*/
//echo 'sendmail ' ;
function mail_sms(){
	//print_r($_POST);
	//echo "hier" ;
	// Bitte passen Sie die folgenden Werte an, bevor Sie das Script benutzen!
	// An welche Adresse sollen die Mails gesendet werden?
	//$to  = $_POST['mobile'].'@msg.ecall.ch' ;
	$to  = 'message@eCall.ch' ;//noch einbauen

	// Welchen Betreff sollen die Mails erhalten?
	$subject = $_POST['mobile'] ;

	// Welche(s) Zeichen soll(en) zwischen dem Feldnamen und dem angegebenen Wert stehen?
	$strDelimiter  = ":\t";

	// message
	$message = 'Transit Reservierungscode: ' .$_POST['barcode'].' -'.$_POST['mobiletext'];

	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	$headers .= 'From: sms@a-t-c.ch' . "\r\n";
	//$headers .= 'Cc: ' . "\r\n";
	//$headers .= 'Bcc: ' . "\r\n";

	// Mail it
	mail($to, $subject, $message, $headers);
	echo "<table width='700'><tr><td class='titel'>";
	echo "SMS send to ".$_POST['mobile'].' '.$_POST['mobiletext'].' code '.$_POST['barcode'];
	echo "	</td></tr>	</table>";

	//betrag speichern insert_sms($_POST['mobile'], $_POST['barcode']) ;
}

function mail_pwd(){
	// gettext initialisieren
	//require '../includes/gettext.php';

	//bearbeiten bestehender user profile
	$sql = " SELECT   pwd, lang FROM {$_SESSION['SCEMA']}TCONTACTS where emailaddress = '{$_POST['EMAILADDRESS']}'" ;

	// Benutzername und Passwort in der DB werden ?berpr?ft
	//echo 'user_passw_q - '.$sql ;
	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect($sql) ;
		$result = mysqli_query($_SESSION ['CONNECT'], $sql);
	}else {
		get_DB2_connect($sql) ;
	}



	//echo " while ";
	while ($row = $_SESSION['FETCH']($result))	{
		$_POST['PWD'] = $row[0] ;
		$_SESSION['LANG'] = $row[1];
	}

	// Bitte passen Sie die folgenden Werte an, bevor Sie das Script benutzen!
	// An welche Adresse sollen die Mails gesendet werden?
	$to  = $_POST['EMAILADDRESS']; //noch einbauen
	//mehrere empfaenger
	//"Bcc: infos@infos24.de\r\nBcc:regionalportal@infos24.de\r\nfrom:schulungen@infos24.de\r\n");

	// Welchen Betreff sollen die Mails erhalten?
	$subject = gettext('sendmail_passwort_betreff');

	// Zu welcher Seite soll als "Danke-Seite" weitergeleitet werden?
	// Wichtig: Sie muessen hier eine gueltige HTTP-Adresse angeben!
	$strReturnhtml = "menue_call.php?go=welcome_&dir=stat";

	// Welche(s) Zeichen soll(en) zwischen dem Feldnamen und dem angegebenen Wert stehen?
	$strDelimiter  = ":\t";


	// message
	$message = '<br>'.gettext('sendmail_passwort_text');
	$message = $message."  Password : ".$_POST['PWD'].'<br>';
	$message = $message.gettext('glob_sign');

	//include "{$_SESSION['ENV']}stat/welcome_{$_SESSION['LANG']}.php";
	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// Additional headers
	$headers .= 'To:  ' .  "\r\n";
	// Welche Adresse soll als Absender angegeben werden?
	// (Manche Hoster lassen diese Angabe vor dem Versenden der Mail ueberschreiben)

	$headers .= 'From: Password-Service@a-t-c.ch' . "\r\n";
	//$headers .= 'Cc: ' . "\r\n";
	//$headers .= 'Bcc: ' . "\r\n";

	// Mail it
	mail($to, $subject, $message, $headers);
	echo "<table width='700'><tr><td class='titel'>";
	echo "Password mail send !";
	echo "	</td></tr>	</table>";
}

function mail_reguser() {

	// gettext initialisieren
	//require '../includes/gettext.php';

	// multiple recipients
	$to  = $_POST['EMAILADDRESS']; //noch einbauen
	//$to = 'd@f.no';

	// subject
	$subject = "Alp Transit Cargo User Registration";

	// message
	$message = gettext('sendmail_register_text');
	$message = $message."'E-Mail : '".$_POST['EMAILADDRESS']."'    Password : '".$_POST['PWD'];
	$message = $message.gettext('sendmail_register_text1');
	echo "<table width='700'><tr><td class='titel'>";
	echo gettext('sendmail_register_text');
	echo "	</td></tr>	<tr><td class='typ1'>";
	echo gettext('sendmail_register_text1');
	echo "	</td></tr>	</table>";

	//include "{$_SESSION['ENV']}stat/welcome_{$_SESSION['LANG']}.php";
	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// Additional headers
	$headers .= 'To:  ' .  "\r\n";
	$headers .= 'From: Registrierung@a-t-c.ch' . "\r\n";
	//$headers .= 'Cc: ' . "\r\n";
	//$headers .= 'Bcc: ' . "\r\n";

	// Mail it
	mail($to, $subject, $message, $headers);

}
?>


