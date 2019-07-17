<?php
{

	$_SESSION['ENV'] = 'env';
	$_SESSION['LANG'] = 'de';
	$_SESSION['ZEIT'] = time();
	$_SESSION['DB'] = 'MY'; 	//DB2 oder MY = MYSQL
	$_SESSION['SCEMA'] = '' ; 	//'ATC.' oder MY = ''
	$_SESSION['FETCH']= 'mysqli_fetch_array' ; // DB2 = db2_fetch_array
	//$_SESSION['DB'] = 'DB2'; 	//DB2 oder MY = MYSQL

	//db connect einbinden
	require'includes/connATC.inc';
	//include other functions
	require 'includes/selectlist.inc';
	require 'includes/gettext.php';
	//echo 'test cal mail versand <br>';
	//db connect einbinden
	$z = 0;

	//sende mail an altkunden trapo = suffix ,firma,
	$sql = " SELECT distinct Emailaddress, suffix, Firstname, Lastname, Companyname, Eigenschaft
	FROM   {$_SESSION['SCEMA']}TCLACONTACTS
	where Emailaddress like '%@%'";

	//where Eigenschaft <> 'Musiker/in' 	and Emailaddress like '%@%'" ;
	// Eigenschaft = 'Musiker/in' and Emailaddress like '%@%'
	//or email = 'she1@bluewin.ch' and abteilung = 'Firmen' where (email = 'facebook@a-t-c.ch' and abteilung = 'Firmen'  )
	//ausgabe tourdaten
	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect($sql) ;
		$result = mysqli_query($_SESSION ['CONNECT'], $sql);
	}else {
		get_DB2_connect($sql) ;
	}

	echo $sql;
	echo 'result ' .$result;
	while ($row = $_SESSION['FETCH']($result))	{
		$z = $z + 1;
		text_olduser($row[0],$row[1],$row[2],$row[3],$row[4],$row[5], $z) ;
		//echo "$row[0],$row[1],$row[2],$row[3]";
	}

}

function text_olduser( $email, $suffix, $first,$last,$company,$eigen, $z){
	//suffix ,firma,  email, abteilung
	//print_r($_SESSION) ;
	require 'includes/gettext.php';

	$Empfaenger = $email;
	$Betreff .= gettext('cal_gast-e_head');

	/*	if ($eigen == "Helfer"){
		$Betreff .= gettext('cal_hand_head');
		}elseif ($eigen == "Musiker/in"){
		$Betreff .= gettext('cal_musik-e_head');
		}elseif ($eigen == "Gast"){
		$Betreff .= gettext('cal_gast_head');
		}elseif ($eigen == "Presse"){
		$Betreff .= gettext('cal_gast_head');
		}else {
		$Betreff .= gettext('cal_allgem_head');
		}
		*/

	//$Betreff = 'Ihr Firmenevent bei Classic au Lac 28.08.2009 - 30.08.2009 am Z�richsee' ;

	//Trennzeichenfolge
	$Trenner = strtoupper(md5(uniqid(time())));

	$Header = "From: office@classicaulac.ch";

	$Trenner = md5(uniqid(time()));
	$Header .= "\n";
	$Header .= "MIME-Version: 1.0";
	$Header .= "\n";
	$Header .= "Content-Type: multipart/mixed; boundary=$Trenner";
	$Header .= "\n\n";
	$Header .= "This is a multi-part message in MIME format";
	$Header .= "\n";
	$Header .= "--$Trenner";
	$Header .= "\n";
	$Header .= "Content-type: text/html; charset=iso-8859-1\n";
	$Header .= "Content-Transfer-Encoding: 7bit";
	$Header .= "\n\n";
	/*
	 if ($eigen == "Helfer") {
		$Header .= 'Hallo '.$first.' '.$last.'. <br><br>';
		//	$Header .= gettext('cal_hand_head');
		$Header .= "\n\n";
		$Header .= gettext('cal_hand');

		}elseif ($eigen == "Gast"){
		//$Header .= gettext('cal_gast_head');
		$Header .= 'Sehr geehrte/r '.$suffix.' '.$last.'. <br><br>';
		$Header .= "\n\n";
		$Header .= gettext('cal_gast');
		}elseif ($eigen == "Musiker/in"){
		//$Header .= gettext('cal_gast_head');
		$Header .= 'Sehr geehrte/r '.$suffix.' '.$last.'. <br><br>';
		$Header .= "\n\n";
		$Header .= gettext('cal_musik-e');
		}elseif ($eigen == "Presse"){
		//$Header .= gettext('cal_gast_head');
		$Header .= 'Sehr geehrte/r '.$suffix.' '.$last.'. <br><br>';
		$Header .= "\n\n";
		$Header .= gettext('cal_gast');
		}else {
		$Header .= gettext('cal_allgem_head');
		$Header .= "\n\n";
		$Header .= gettext('cal_allgem');
		}

		*/
	$Header .= 'Sehr geehrte/r '.$suffix.' '.$last.'. <br>';
	$Header .= "\n\n";
	$Header .= gettext('weihnacht_head');
	$Header .= "\n\n";
	$Header .= gettext('cal_sign');


	mail($Empfaenger, $Betreff, "", $Header);
	echo  '<br>' .$z.' '.$email.' '.$first, $last ;
	return ;
}
?>

