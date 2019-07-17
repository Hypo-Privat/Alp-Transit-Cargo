<?php function gen_barcode() {
	/*===========================================================================*/
	/*      PHP Barcode Image Generator v1.0 [9/28/2000]
	 Copyright (C)2000 by Charles J. Scheffold - cs@sid6581.net


	 ---
	 UPDATE 5/10/2005 by C.Scheffold
	 Changed FontHeight to -2 if no text is to be displayed (this eliminates
	 the whitespace at the bottom of the image)
	 ---
	 UPDATE 03/12/2005 by C.Scheffold
	 Added '-' character to translation table
	 ---
	 UPDATE 09/21/2002 by Laurent NAVARRO - ln@altidev.com - http://www.altidev.com
	 Updated to be compatible with register_globals = off and on
	 ---
	 UPDATE 4/6/2001 - Important Note! This script was written with the assumption
	 that "register_globals = On" is defined in your PHP.INI file! It will not
	 work as-is      and as described unless this is set. My PHP came with this
	 enabled by default, but apparently many people have turned it off. Either
	 turn it on or modify the startup code to pull the CGI variables in the old
	 fashioned way (from the HTTP* arrays). If you just want to use the functions
	 and pass the variables yourself, well then go on with your bad self.
	 ---

	 This code is hereby released into the public domain.
	 Use it, abuse it, just don't get caught using it for something stupid.


	 The only barcode type currently supported is Code 3 of 9. Don't ask about
	 adding support for others! This is a script I wrote for my own use. I do
	 plan to add more types as time permits but currently I only require
	 Code 3 of 9 for my purposes. Just about every scanner on the market today
	 can read it.


	 PARAMETERS:
	 -----------
	 $barcode        = [required] The barcode you want to generate


	 $type           = (default=0) It's 0 for Code 3 of 9 (the only one supported)

	 $width          = (default=160) Width of image in pixels. The image MUST be wide
	 enough to handle the length of the given value. The default
	 value will probably be able to display about 6 digits. If you
	 get an error message, make it wider!


	 $height         = (default=80) Height of image in pixels

	 $format         = (default=jpeg) Can be "jpeg", "png", or "gif"

	 $quality        = (default=100) For JPEG only: ranges from 0-100


	 $text           = (default=1) 0 to disable text below barcode, >=1 to enable


	 NOTE: You must have GD-1.8 or higher compiled into PHP
	 in order to use PNG and JPEG. GIF images only work with
	 GD-1.5 and lower. (http://www.boutell.com)


	 ANOTHER NOTE: If you actually intend to print the barcodes
	 and scan them with a scanner, I highly recommend choosing
	 JPEG with a quality of 100. Most browsers can't seem to print
	 a PNG without mangling it beyond recognition.


	 USAGE EXAMPLES FOR ANY PLAIN OLD HTML DOCUMENT:
	 -----------------------------------------------


	 <IMG SRC="barcode.php?barcode=HELLO&quality=75">


	 <IMG SRC="barcode.php?barcode=123456&width=320&height=200">


	 */
	/*=============================================================================*/

	//-----------------------------------------------------------------------------
	// Startup code
	//-----------------------------------------------------------------------------
	//ubergebene Variabele
	//print_r($_POST);

	$tour = trim($_POST['TOUR_INDEXKEY']);
	$lsva = trim($_POST['LSVA']);
	$slot_date = substr($_POST['VAL'],0,10);
	$j = substr($_POST['VAL'],0,4) ;
	$m = substr($_POST['VAL'],5,2) ;
	$t = substr($_POST['VAL'],8,2) ;
	$h = substr($_POST['VAL'],10,2) ;
	$r = substr($_POST['VAL'],12,2) ;

	$val = $m.$t.$h.$r ;
	//echo $_POST['VAL'];
	if(isset($_POST["text"])) $text=$_POST["text"];
	if(isset($_POST["format"])) $format=$_POST["format"];
	if(isset($_POST["quality"])) $quality=$_POST["quality"];
	if(isset($_POST["width"])) $width=$_POST["width"];
	if(isset($_POST["height"])) $height=$_POST["height"];
	if(isset($_POST["type"])) $type=$_POST["type"];
	if(isset($_POST["barcode"])) $barcode=$_POST["barcode"];

	//echo $_POST['KFZ_INDEXKEY'];
	//$_POST['LSVA'] 10 ,$_POST['VAL'] 8 ,$_SESSION['INDEXKEY'] 10
	$timestamp = time();
	$barcode = $_POST['LSVA'].'-'.$val.$timestamp;
	$width = 750;

	if (!isset ($text)) $text = 1;
	if (!isset ($type)) $type = 1;
	if (empty ($quality)) $quality = 100;
	if (empty ($width)) $width = 160;
	if (empty ($height)) $height = 80;
	if (!empty ($format)) $format = strtoupper ($format);
	else $format="PNG";
	//else $format="GIF";


	switch ($type)
	{
		default:
			$type = 1;
		case 1:
			Barcode39 ($barcode, $width, $height, $quality, $format, $text);
			// speichern barcode daten
			save_barcode($timestamp);
			break;
	}

} //ende function gen_barcode
//-----------------------------------------------------------------------------
// Generate a Code 3 of 9 barcode
//-----------------------------------------------------------------------------
function Barcode39 ($barcode, $width, $height, $quality, $format, $text)
{
	switch ($format)
	{ //Durch Verwendung der Funktion header() mit der "content-type"-Angabe "image/png" k�nnen Sie PHP-Skripte erstellen, welche die PNG-Ausgabe direkt vornehmen.
		default:
			$format = "JPEG";
		case "JPEG":
			//	header ("Content-type: image/jpeg");
			break;
		case "PNG":
			//	header ("Content-type: image/png");
			break;
		case "GIF":
			//		header ("Content-type: image/gif");
			break;
	}


	$im = ImageCreate ($width, $height)
	or die ("Cannot Initialize new GD image stream");
	$White = ImageColorAllocate ($im, 255, 255, 255);
	$Black = ImageColorAllocate ($im, 0, 0, 0);
	//ImageColorTransparent ($im, $White);
	ImageInterLace ($im, 1);



	$NarrowRatio = 20;
	$WideRatio = 55;
	$QuietRatio = 35;


	$nChars = (strlen($barcode)+2) * ((6 * $NarrowRatio) + (3 * $WideRatio) + ($QuietRatio));
	$Pixels = $width / $nChars;
	$NarrowBar = (int)(20 * $Pixels);
	$WideBar = (int)(55 * $Pixels);
	$QuietBar = (int)(35 * $Pixels);


	$ActualWidth = (($NarrowBar * 6) + ($WideBar*3) + $QuietBar) * (strlen ($barcode)+2);

	if (($NarrowBar == 0) || ($NarrowBar == $WideBar) || ($NarrowBar == $QuietBar) || ($WideBar == 0) || ($WideBar == $QuietBar) || ($QuietBar == 0))
	{
		ImageString ($im, 1, 0, 0, "Image is too small!", $Black);
		OutputImage ($im, $format, $quality);
		exit;
	}

	$CurrentBarX = (int)(($width - $ActualWidth) / 2);
	$Color = $White;
	$BarcodeFull = strtoupper ($barcode);
	//$BarcodeFull = "*In future you can print this barcode reservation or send it as SMS / MMS to your driver*";
	settype ($BarcodeFull, "string");

	$FontNum = 3;
	$FontHeight = ImageFontHeight ($FontNum);
	$FontWidth = ImageFontWidth ($FontNum);
	if ($text != 0)
	{
		$CenterLoc = (int)(($width-1) / 2) - (int)(($FontWidth * strlen($BarcodeFull)) / 2);
		ImageString ($im, $FontNum, $CenterLoc, $height-$FontHeight, "$BarcodeFull", $Black);
	}
	else
	{
		$FontHeight=-2;
	}


	for ($i=0; $i<strlen($BarcodeFull); $i++)
	{
		$StripeCode = Code39 ($BarcodeFull[$i]);


		for ($n=0; $n < 9; $n++)
		{
			if ($Color == $White) $Color = $Black;
			else $Color = $White;


			switch ($StripeCode[$n])
			{
				case '0':
					ImageFilledRectangle ($im, $CurrentBarX, 0, $CurrentBarX+$NarrowBar, $height-1-$FontHeight-2, $Color);
					$CurrentBarX += $NarrowBar;
					break;


				case '1':
					ImageFilledRectangle ($im, $CurrentBarX, 0, $CurrentBarX+$WideBar, $height-1-$FontHeight-2, $Color);
					$CurrentBarX += $WideBar;
					break;
			}
		}


		$Color = $White;
		ImageFilledRectangle ($im, $CurrentBarX, 0, $CurrentBarX+$QuietBar, $height-1-$FontHeight-2, $Color);
		$CurrentBarX += $QuietBar;
	}
	OutputImage ($im, $format, $quality, $barcode);
	show_barcode($barcode) ;
}


//-----------------------------------------------------------------------------
// Output an image to the browser
//-----------------------------------------------------------------------------
function OutputImage ($im, $format, $quality, $barcode)
{
	switch ($format)
	{
		case "JPEG":
			ImageJPEG ($im, "", $quality, "codes/$barcode.jpeg");
			break;
		case "PNG":
			ImagePNG ($im, "codes/$barcode.png" );
			break;
		case "GIF":
			ImageGIF ($im, "codes/$barcode.gif");
			break;
	}

}


//-----------------------------------------------------------------------------
// Returns the Code 3 of 9 value for a given ASCII character
//-----------------------------------------------------------------------------
function Code39 ($Asc)
{
	switch ($Asc)
	{
		case ' ':
			return "011000100";
		case '$':
			return "010101000";
		case '%':
			return "000101010";
		case '*':
			return "010010100"; // * Start/Stop
		case '+':
			return "010001010";
		case '|':
			return "010000101";
		case '.':
			return "110000100";
		case '/':
			return "010100010";
		case '-':
			return "010000101";
		case '0':
			return "000110100";
		case '1':
			return "100100001";
		case '2':
			return "001100001";
		case '3':
			return "101100000";
		case '4':
			return "000110001";
		case '5':
			return "100110000";
		case '6':
			return "001110000";
		case '7':
			return "000100101";
		case '8':
			return "100100100";
		case '9':
			return "001100100";
		case 'A':
			return "100001001";
		case 'B':
			return "001001001";
		case 'C':
			return "101001000";
		case 'D':
			return "000011001";
		case 'E':
			return "100011000";
		case 'F':
			return "001011000";
		case 'G':
			return "000001101";
		case 'H':
			return "100001100";
		case 'I':
			return "001001100";
		case 'J':
			return "000011100";
		case 'K':
			return "100000011";
		case 'L':
			return "001000011";
		case 'M':
			return "101000010";
		case 'N':
			return "000010011";
		case 'O':
			return "100010010";
		case 'P':
			return "001010010";
		case 'Q':
			return "000000111";
		case 'R':
			return "100000110";
		case 'S':
			return "001000110";
		case 'T':
			return "000010110";
		case 'U':
			return "110000001";
		case 'V':
			return "011000001";
		case 'W':
			return "111000000";
		case 'X':
			return "010010001";
		case 'Y':
			return "110010000";
		case 'Z':
			return "011010000";
		default:
			return "011000100";
	}
}


function save_barcode($timestamp) {

	//echo "save data reservation" ;


	$slot_date = substr($_POST['VAL'],0,10);
	$j = substr($_POST['VAL'],0,4) ;
	$m = substr($_POST['VAL'],5,2) ;
	$t = substr($_POST['VAL'],8,2) ;
	$h = substr($_POST['VAL'],10,2) ;
	$r = substr($_POST['VAL'],12,2) ;
	//preis
	$p = 0 ;
	$mms = 'N' ;

	$sql = "INSERT INTO  {$_SESSION['SCEMA']}TSLOTSOLD
	( SOLD_INDEXKEY, SLOT_VAL, SLOT_HOUR, INDEXKEY,	SOLD_PRICE, ROUTE_NR, MMS_SMS, SLOT_DATE, LSVA , TOUR)
	values	(
	'".$timestamp."' ,
 	'".$_POST['VAL']."',
 	$h ,
	'".$_SESSION['INDEXKEY']."' ,
	$p,
	$r,
	'".$mms."',
	'".$slot_date."' ,
	'".$_POST['LSVA']."' ,
	'".$_POST['TOUR_INDEXKEY']."'
	)";

	//echo 'BARCODE - '.$sql ;
	IF ($_SESSION['DB'] == 'MY'){
		get_MY_connect($sql) ;
		$result = mysqli_query($_SESSION ['CONNECT'], $sql);
		if (!$result) {
			get_db2_conn_errormsg($sql);
		}
	}else {
		get_DB2_connect($sql) ;
		$result = db2_execute($stmt);
		if (!$result) {
			get_db2_conn_errormsg($sql);
		}
	}
	return;
}
?>


<?php function show_barcode($barcode) {
	//ausgeben barcode mit text
	//echo "hier" ;
	// ausgabe html block kopf

	echo  gettext('glob_titel').gettext('barcode_head').gettext('glob_titel_end') ;
	echo  gettext('glob_typ1').gettext('barcode_text').gettext('glob_typ1_end') ;
	echo "<FORM METHOD=POST ACTION='output.php?go=sendmail.inc&dir=includes&func=mail_sms'>
	<INPUT TYPE='hidden' NAME='barcode' VALUE=$barcode> " ;
	echo "<table  width='750' ><tr><td  align='center'><br>
	<img  width='750' height='80' src='../codes/$barcode.png'><br></td></tr>
	</table>" ;
	echo gettext('glob_typ1').gettext('barcode_sms').gettext('glob_typ1_end');
}
?>
