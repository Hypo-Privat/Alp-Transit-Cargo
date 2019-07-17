<?php { $_SESSION['LANG'] = 'de';

	//db connect einbinden
	require'includes/connATC.inc';
	//include other functions
	require 'includes/selectlist.inc';
	require 'includes/gettext.php';
	echo 'hier';
	//db connect einbinden
	$z = 0;
    $_SESSION['LANG'] = 'de' ;

	$_SESSION['ZEIT'] = time();
	$_SESSION['DB'] = 'MY'; 	//DB2 oder MY = MYSQL
	$_SESSION['SCEMA'] = '' ; 	//'ATC.' oder MY = ''
$_SESSION['FETCH']= 'mysqli_fetch_array' ; // DB2 = db2_fetch_array

    echo "<pre>";
	echo "Session\n";
	var_dump($_SESSION);


	//sende mail an altkunden trapo
	$sql = " SELECT distinct  suffix ,firstname, lastname, emailaddress
	FROM   {$_SESSION['SCEMA']}TCALCONTACTS where  emailaddress = 'gert.dorn@a-t-c.ch' " ;

//echo 'such_list - '.$sql ;
	IF ($_SESSION['DB'] == 'MY'){
		 get_MY_connect($sql) ;
		$result = mysqli_query($sql);
	}else {
		    get_DB2_connect($sql) ;
		$result = db2_execute($stmt);
	}


	echo $sql;
while ($row = $_SESSION['FETCH']($result))	{
		//upd_contacts($row[3]);
		text_olduser($row[0],$row[1],$row[2],$row[3]) ;
		echo "$row[0],$row[1],$row[2]";
		$z = $z + 1;
		$_SESSION['LANG'] = $row[4] ;
	}
}
?>


<?php function upd_contacts($email){
	$verbose = TRUE;
	$dbconn = dbconnect($verbose);
	$sql1 = "update  atc.tclacontacts
	set (  contactdate, NOTE )
	=   (current timestamp, 'gesendet' )
	WHERE	emailaddress = '$email'
	";
	$stmt1 = db2_prepare($dbconn, $sql1);
	$result1 = db2_execute($stmt1);
	if (!$result1) {
	get_db2_stmt_errormsg($sql1);
	}else{
	echo "update :".$email  ;
	}

}
?>


<?php function text_olduser($prev, $first, $last, $email, $z){
	//print_r($_SESSION) ;
	require 'includes/gettext.php';


$Empfaenger = $email;
$Betreff = 'Test Mailversand Classic au Lac' ;

$Dateiname = "stat/demo_Registrieren.pdf";
$DateinameMail = "Transit_Registration.pdf";
//filecontent
$Dateiinhalt = fread(fopen($Dateiname,"r"),filesize($Dateiname));
$Dateiinhalt = chunk_split(base64_encode($Dateiinhalt));
fclose($Dateiname);

//Trennzeichenfolge
$Trenner = strtoupper(md5(uniqid(time())));

$Header = "From: gert.dorn@a-t-c.ch";

$Header .= "\nMIME-Version: 1.0\r\n";
$Header .= "\nContent-Type: multipart/mixed;\n\boundary=$Trenner";
$Header .= "\n--$Trenner";

$Header .= "\n\nThis is a multi-part message in MIME format";
$Header .= "\nContent-type: text/html; charset=iso-8859-1\n";
$Header .= "Content-Transfer-Encoding: 8bit";
$Header .= "\n\n";
$Header .= gettext('cal_kirche_head').gettext('glob_sign');
$Header .= "\n\n";
//$Header .= ('Guten Tag '.$prev.' '.$first.' '.$last);
//$Header .= "\n\n";
$Header .= gettext('cal_kirche').gettext('cal_sign');
$Header .= "\n--$Trenner\n";

//attachment
$header .= "Content-Type: application/pdf;\r\n";
$header .= "\n name=\'$Dateiinhalt\'";
$header .= "\nContent-Transfer-Encoding: base64";
$header .= "\nContent-Disposition: attachment";
$header .= "\n\n filename=\'$DateinameMail\'\r\n";
$header .= "\n--$Trenner--";
mail($Empfaenger, $Betreff, "", $Header);
echo $z.' '.$email.$Header.'<br>'  ;
	return ;
}
?>
