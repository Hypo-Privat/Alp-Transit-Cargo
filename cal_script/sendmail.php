<?php
function mail_reguser($_REQUEST) {

	// gettext initialisieren
	//require '../includes/gettext.php';

	// multiple recipients
	$to = $_REQUEST['EMAILADDRESS']; //noch einbauen
	//$to = 'd@f.no';

	// subject
	$subject = "Ihre Anmeldung bei Classic au Lac";

	// message
	$message = "Vielen Dank " . $_REQUEST['FIRSTNAME'] . " " . $_REQUEST['LASTNAME'] . " f�r Ihre Anmeldung als " . $_REQUEST['EIGENSCHAFT'] . " bei Classic au Lac," .
	"<br>Wir melden uns fr�hestens einen Monat vor der Veranstaltung bei Ihnen.<br> Ihr Classic au Lac Team";
	//$message = $message."'E-Mail : '".$_REQUEST['EMAILADDRESS']."'    Password : '".$_REQUEST['PWD'] . "' ";
	//$message = $message.gettext('sendmail_register_text1');
	echo "<h4>Vielen Dank " . $_REQUEST['FIRSTNAME'] . " " . $_REQUEST['LASTNAME'] . " f�r Ihre Anmeldung als " . $_REQUEST['EIGENSCHAFT'] . " bei Classic au Lac, <br> Sie erhalten in k�rze ein Mail.</h4>";
	//echo gettext('sendmail_register_text');
	//echo "	</td></tr>	<tr><td class='typ1'>";
	//echo gettext('sendmail_register_text1');
	//echo "	</td></tr>	</table>";

	//include "{$_SESSION['ENV']}stat/welcome_{$_SESSION['LANG']}.php";
	// To send HTML mail, the Content-type header must be set
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// Additional headers
	$headers .= 'To:  ' . "\r\n";
	$headers .= 'From: office@classicaulac.ch' . "\r\n";
	//$headers .= 'Cc: office@classicaulac.ch' . "\r\n";
	//$headers .= 'Bcc: ' . "\r\n";

	// Mail it
	mail($to, $subject, $message, $headers);

}

function mail_pwd() {
	//echo 'mail_pwd';
	//bearbeiten bestehender user profile
	$sql = " SELECT  distinct suffix, LASTNAME, FIRSTNAME,
	COMPANYNAME,	pwd, lang FROM {$_SESSION['SCEMA']}TCLACONTACTS 
	where emailaddress = '{$_REQUEST['EMAILADDRESS']}'";
	//echo $sql;
	// Benutzername und Passwort in der DB werden

	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect() ;
		//mysqli_pconnect("www.a-t-c.ch", "atc", "db2admin") or die(mysqli_error('Connected persistent to MySQL'));
		//echo "Connected persistent to MySQL<br />";
		//mysqli_select_db("CL12264_ATC") or die(mysqli_error('Connected to Database ATC'));
		//echo "Connected to Database ATC";
		$result = mysqli_query($sql);
		if (!$result) {
			get_db2_conn_errormsg($sql);
		}
	}else {
		$verbose = TRUE;
		$dbconn = dbconnect($verbose);
		$stmt = db2_prepare($dbconn, $sql);
		$result = db2_execute($stmt);
		if (!$result) {
			get_db2_conn_errormsg($sql);
		}
	}

	//	IF ($_SESSION['DB'] == 'MY'){$row = mysqli_fetch_row($result)}
	//	IF ($_SESSION['DB'] == 'DB2'){$row = db2_fetch_array($stmt)}
	//echo " while ";
	while ($row = mysqli_fetch_row($result))	{

		$_SESSION['SUFFIX'] = $row[0];
		$_SESSION['LASTNAME'] = $row[1];
		$_SESSION['FIRSTNAME'] = $row[2];
		$_SESSION['COMPANYNAME'] = $row[3];
		$_REQUEST['PWD'] = $row[4];
		$_SESSION['LANG'] = $row[5];
	}

	// Bitte passen Sie die folgenden Werte an, bevor Sie das Script benutzen!
	// An welche Adresse sollen die Mails gesendet werden?
	$to = $_REQUEST['EMAILADDRESS']; //noch einbauen
	//mehrere empfaenger
	//"Bcc: infos@infos24.de\r\nBcc:regionalportal@infos24.de\r\nfrom:schulungen@infos24.de\r\n");

	// Welchen Betreff sollen die Mails erhalten?
	$subject = 'Passwort Service f�r Orchester Classic au Lac';

	// Zu welcher Seite soll als "Danke-Seite" weitergeleitet werden?
	// Wichtig: Sie muessen hier eine gueltige HTTP-Adresse angeben!
	$strReturnhtml = "cal_menue.php";

	// Welche(s) Zeichen soll(en) zwischen dem Feldnamen und dem angegebenen Wert stehen?
	$strDelimiter = ":\t";

	// message
	$message = '<br>Hallo ' . $_SESSION['SUFFIX'] . ' '. $_SESSION['LASTNAME'] .  ' von ' . $_SESSION['COMPANYNAME'] .
	' <br> Anbei schicken wir Ihnen Ihr pers�nliches Passwort f�r die Erfassung der Musiker:';
	$message = $message . "<br>  Password : " . $_REQUEST['PWD'] . '<br><br>';
	$message = $message . 'Freundliche Gr�sse	 <br> Silvia Heimann und Gert Dorn';

	//include "{$_SESSION['ENV']}stat/welcome_{$_SESSION['LANG']}.php";
	// To send HTML mail, the Content-type header must be set
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// Additional headers
	$headers .= 'To:  ' . "\r\n";
	// Welche Adresse soll als Absender angegeben werden?
	// (Manche Hoster lassen diese Angabe vor dem Versenden der Mail ueberschreiben)

	$headers .= 'From: Password-Service@ClassicauLac.ch' . "\r\n";
	//$headers .= 'Cc: ' . "\r\n";
	//$headers .= 'Bcc: ' . "\r\n";

	// Mail it
	mail($to, $subject, $message, $headers);
	echo "<table width='600'><tr><td class='col1'>";
	echo "Sie erhalten in k�rze eine Mail mit dem Passwort !";
	echo "	</td></tr>	</table>";
}

function mail_sms() {
	//print_r($_REQUEST);
	//echo "hier" ;
	// Bitte passen Sie die folgenden Werte an, bevor Sie das Script benutzen!
	// An welche Adresse sollen die Mails gesendet werden?
	//$to  = $_REQUEST['mobile'].'@msg.ecall.ch' ;
	$to = 'message@eCall.ch'; //noch einbauen

	// Welchen Betreff sollen die Mails erhalten?
	$subject = $_REQUEST['mobile'];

	// Welche(s) Zeichen soll(en) zwischen dem Feldnamen und dem angegebenen Wert stehen?
	$strDelimiter = ":\t";

	// message
	$message = 'Transit Reservierungscode: ' . $_REQUEST['barcode'] . ' -' . $_REQUEST['mobiletext'];

	// To send HTML mail, the Content-type header must be set
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	$headers .= 'From: sms@a-t-c.ch' . "\r\n";
	//$headers .= 'Cc: ' . "\r\n";
	//$headers .= 'Bcc: ' . "\r\n";

	// Mail it
	mail($to, $subject, $message, $headers);
	echo "<table width='700'><tr><td class='titel'>";
	echo "SMS send to " . $_REQUEST['mobile'] . ' ' . $_REQUEST['mobiletext'] . ' code ' . $_REQUEST['barcode'];
	echo "	</td></tr>	</table>";

	//betrag speichern insert_sms($_REQUEST['mobile'], $_REQUEST['barcode']) ;
}
?>

