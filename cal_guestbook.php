<?php

// ####################################
// ### Guestbook 2.8.1 Professional ###
// ####################################

define("INTERN_CALL", "1");

// *********************
// *** Einstellungen ***
// *********************

// Formelle Anrede (nur bei deutscher Sprachdatei relevant)
$FormalText = false;

include ("cal_pgm/language/http_sprache.php");

// Sprache / Language
if ($_SESSION['LANG'] == 'de') {
	include_once ("cal_pgm/language/german.php");
}
elseif ($_SESSION['LANG'] == 'en') {
	include_once ("cal_pgm/language/english.php");
} else {
	include_once ("cal_pgm/language/german.php");
}

// Sprache / Language
//include_once("language/german.php");
//include_once("language/english.php");

// Titel des Gästebuches, z.B.: $GuestbookTitle = "Mein Gästebuch";
$GuestbookTitle = GetLngStr("DefaultGuestbookName");

// Style des Gästebuches ("default" entspricht "default.css").
// (Die Stylesheet-Datei sollte an die eigene Seite angepasst werden.)
$GuestbookStyle = "cal_pgm/default";

// Relativer Pfad zu der Datei, in der die Daten gespeichert werden.
$DataFile = "cal_pgm/guestbook.dat";

// Relativer Pfad zum Verzeichnis, in dem sich die Bilder (space1.gif) befinden.
$ImagesPath = "cal_pics/";

// Relativer Pfad zum Verzeichnis, in dem sich die Smilies befinden.
// Ist kein Pfad angegeben, werden keine Smilies angezeigt.
$SmiliesPath = $ImagesPath . "smilies/";

// Anzahl der Beiträge pro Seite.
$PostsPerSite = 10;

// Anzahl der Seiten, die im Navigationsbereich vor und nach der aktuellen Seite
// angezeigt werden sollen. Wird $NavOverhead auf -1 gesetzt, werden alle Seiten
// angezeigt.
$NavOverhead = 3;

// E-Mail Adresse des Webmasters für die E-Mail-Benachrichtigung bei neuen
// Einträgen. Ist keine Adresse angegeben, wird keine Benachrichtigung gesendet.
$AdminNotifyMailTo = "office@classicaulac.ch";

// Captcha-Grafik (Sicherheitscode) benutzen?
$UseCaptcha = (extension_loaded("gd") && (function_exists("imagegif") || function_exists("imagepng") || function_exists("imagejpeg")));

// Eine einfache Addition an Stelle der Captcha-Grafik benutzen?
// Um die Addition als Captcha-Grafik anzuzeigen, muss $UseCaption und
// $UseCalculation auf TRUE gesetzt sein.
$UseCalculation = (!$UseCaptcha);

// Inhalts-Regeln
include_once ("cal_pgm/rules.php");

// Administration
$DisableAuth = false;
$AdminLogin = "classic au lac"; // BITTE ÄNDERN!
$AdminPasswd = "gert0815"; // BITTE ÄNDERN!

// Zeigt den Link zur Anmeldung als Administrator an.
$ShowAdminLink = true;

// ############################################################################

$CodeMD5 = "";
$ParamCode = GetParam("p_code", "P");
$ParamSID = GetParam("p_sid", "P");

if ($UseCaptcha || $UseCalculation) {
	$CodeValid = 0;
	if ($ParamCode != "") {
		if (md5(strtoupper($ParamCode)) == $ParamSID) {
			$CodeValid = 1;
		} else {
			$CodeValid = -1;
		}
	}
}

$action = substr(GetParam("g_action", "G"), 0, 5);
$entry = substr(GetParam("g_entry", "G"), 0, 14);
$first = intval(substr(GetParam("g_first", "G"), 0, 5));

$send = GetParam("p_send", "P");
$gb_name = GetParam("p_gb_name", "P");
$gb_mail = GetParam("p_gb_mail", "P");
$gb_home = GetParam("p_gb_home", "P");
$gb_text = GetParam("p_gb_text", "P");

if ($action == "login") {
	if (!$DisableAuth)
		AuthUser();
} else
	if ($action == "del") {
		if ($DisableAuth || ((GetParam("PHP_AUTH_USER", "S") == $AdminLogin) && (GetParam("PHP_AUTH_PW", "S") == $AdminPasswd))) {
			DelPosting($DataFile, $entry);
		}
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?=htmlspecialchars($GuestbookTitle)?></title>

<meta name="title" content="<?=htmlspecialchars($GuestbookTitle)?>">
<meta name="description" content="<?=htmlspecialchars($GuestbookTitle)?>">
<meta name="keywords" content="G&auml;stebuch, Guestbook">
<meta name="author" content="http://www.gaijin.at/">
<meta http-equiv="content-language" content="de-at">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link rel="stylesheet" href="<?=$GuestbookStyle?>.css" type="text/css">

<script language="javascript" type="text/javascript">
function InsertMailGB(mailnam,mailsvr) {
  document.write('<' + 'a href="mailto:' + mailnam + '@' + mailsvr + '">' + mailnam + '@' + mailsvr + '</' + 'a>');
}
function add_smilie(sn) {
  document.guestbook.p_gb_text.value = document.guestbook.p_gb_text.value + sn;
}
</script>

</head>
<body>

<!-- ########################### -->
<!-- ### Insert header here #### -->
<!-- ########################### -->


<table bgcolor="#5daeff" border="0" cellspacing="0" cellpadding="0" width="620"><tr><td>

<?php


$err_text = "";

if ($action == "post") {
	if (strlen($gb_text) > 1000) {
		$gb_text = substr($gb_text, 0, 1000) . GetLngStr("TextCutMark");
	}
	$gb_name = str_replace(chr(34), "''", $gb_name);
	$gb_name = stripslashes($gb_name);
	$gb_mail = strtolower(stripslashes($gb_mail));
	$gb_home = strtolower(stripslashes($gb_home));
	$gb_text = stripslashes(trim($gb_text));

	if (trim($gb_name == ""))
		$err_text .= GetLngStr("PostErrNoName") . "<br>\n";
	if (trim($gb_mail != "")) {
		if (!ereg("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,6})$", $gb_mail))
			$err_text .= GetLngStr("PostErrInvalidMailAddr") . "<br>\n";
	}
	if (trim($gb_home != "") && trim($gb_home != "http://")) {
		if ((!ereg("^http:\/\/(.{3,})\.(.{2,})", $gb_home)) || (ereg("\?", $gb_home)))
			$err_text .= GetLngStr("PostErrInvalidUrl") . "<br>\n";
	}

	if (trim($gb_text == ""))
		$err_text .= GetLngStr("PostErrNoText") . "<br>\n";

	if ($UseCaptcha || $UseCalculation) {
		if ($CodeValid == 0)
			$err_text .= GetLngStr("PostErrNoCode") . "<br>\n";
		if ($CodeValid == -1)
			$err_text .= GetLngStr("PostErrWrongCode") . "<br>\n";
	}

	// Inhalte prüfen
	if (isset ($TextRule)) {
		$ruleres = MatchRule($TextRule, $gb_text);
		if ($ruleres != "")
			$err_text .= GetLngStr("RuleTextMatch", $ruleres) . "<br>\n";
	}
	if (isset ($NameRule)) {
		$ruleres = MatchRule($NameRule, $gb_name);
		if ($ruleres != "")
			$err_text .= GetLngStr("RuleNameMatch", $ruleres) . "<br>\n";
	}
	if (isset ($MailRule)) {
		$ruleres = MatchRule($MailRule, $gb_mail);
		if ($ruleres != "")
			$err_text .= GetLngStr("RuleMailMatch", $ruleres) . "<br>\n";
	}
	if (isset ($HomeRule)) {
		$ruleres = MatchRule($HomeRule, $gb_home);
		if ($ruleres != "")
			$err_text .= GetLngStr("RuleHomeMatch", $ruleres) . "<br>\n";
	}

}

// ******************************
// *** Neuer Gästebucheintrag ***
// ******************************
if (($action == "new") or trim($err_text != "")) {

	echo '<h1>' . $GuestbookTitle . '</h1>' . "\n";
	echo '<h2>' . GetLngStr("PostAddNewTitle") . '</h2>' . "\n";

	if (($send == "1") && trim($err_text != "")) {
		echo '<div class="errorbox"><b class="red">' . GetLngStr("PostError") . '</b><br>';
		echo "$err_text</div>\n";
	}
	if (trim($gb_home == "") && (!$gb_home))
		$gb_home = "http://";
?>

<div class="formbox">
<form action="<?php echo GetParam("PHP_SELF", "S"); ?>?g_action=post" method="post" name="guestbook">

<?php

	$gb_name = str_replace("<", "&lt;", $gb_name);
	$gb_name = str_replace(">", "&gt;", $gb_name);
	$gb_name = str_replace("\"", "&quot;", $gb_name);

	$gb_home = ereg_replace("(<|>| |\(|\)|\||\"|\')", "", $gb_home);

	$gb_text = str_replace("<", "&lt;", $gb_text);
	$gb_text = str_replace(">", "&gt;", $gb_text);
	$gb_text = str_replace("\"", "&quot;", $gb_text);
?>

<table bgcolor="#5daeff" border=0 cellspacing=2 cellpadding=0 width="100%"><tr>
<td valign="top">

<table bgcolor="#5daeff" border=0 cellspacing=2 cellpadding=0 width="100%">
<tr><td nowrap align="right" class="formtext"><?=GetLngStr("PostFormName")?></td><td nowrap align=right>&nbsp;</td>
<td width="100%"><input type="text" name="p_gb_name" size=50 maxlength=25 value="<?=$gb_name?>"></td></tr>
<tr><td nowrap align="right" class="formtext"><?=GetLngStr("PostFormMail")?></td><td></td>
<td width="100%"><input type="text" name="p_gb_mail" size=50 maxlength=50 value="<?=$gb_mail?>"> <span class=red><b>*</b></span></td></tr>
<tr><td nowrap align="right" class="formtext"><?=GetLngStr("PostFormHome")?></td><td>&nbsp;</td>
<td width="100%"><input type="text" name="p_gb_home" size=50 maxlength=65 value="<?=$gb_home?>"> <span class=red><b>*</b></span></td></tr>
<tr><td nowrap align="right" class="formtext" style="vertical-align:top;"><?=GetLngStr("PostFormText")?><br><i><?=GetLngStr("PostFormTextMax")?></i></td><td></td>
<td width="100%"><textarea cols="50" rows="8" name="p_gb_text"><?=$gb_text?></textarea></td></tr>

<?php

	if ($UseCalculation) {
		echo '<tr><td nowrap align=right class="formtext">' . GetLngStr("PostFormCalc") . '</td><td>&nbsp;</td>' . "\n";
		if ($UseCaptcha) {
			echo '<td width="100%">' . CaptchaCalculationImageString($CodeMD5) . '</td></tr>' . "\n";
		} else {
			echo '<td width="100%">' . GetLngStr("PostFormCalcStr", CaptchaCalculationString($CodeMD5)) . '</td></tr>' . "\n";
		}
		echo '<tr><td nowrap align=right class="formtext">' . GetLngStr("PostFormCalcQuery") . '</td><td>&nbsp;</td>' . "\n";
		echo '<td width="100%"><input type=text size=10 maxlength=6 name="p_code" value=""></td></tr>' . "\n";
		echo '<tr><td nowrap align=right class="formtext">&nbsp;</td><td>&nbsp;</td>' . "\n";
		echo '<td width="100%" class="formtext">' . GetLngStr("PostFormCalcQueryInfo") . '</td></tr>' . "\n";
	} else
		if ($UseCaptcha) {
			echo '<tr><td nowrap align=right class="formtext">' . GetLngStr("PostFormCode") . '</td><td>&nbsp;</td>' . "\n";
			echo '<td width="100%">' . CaptchaImageString($CodeMD5) . '</td></tr>' . "\n";
			echo '<tr><td nowrap align=right class="formtext">' . GetLngStr("PostFormCodeQuery") . '</td><td>&nbsp;</td>' . "\n";
			echo '<td width="100%"><input type=text size=10 maxlength=6 name="p_code" value=""></td></tr>' . "\n";
			echo '<tr><td nowrap align=right class="formtext">&nbsp;</td><td>&nbsp;</td>' . "\n";
			echo '<td width="100%" class="formtext">' . GetLngStr("PostFormCodeQueryInfo") . '</td></tr>' . "\n";
		}
?>

<tr><td class="formtext" nowrap><span class=red><b>*</b></span><i><?=GetLngStr("PostFormOptFields")?></i></td><td></td><td>
<input type="hidden" name="p_sid" value="<?=$CodeMD5?>">
<input type="hidden" value="1" name="p_send">
<input type="submit" value="<?=GetLngStr("PostFormSubmit")?>" name="submit">
<input type="reset" value="<?=GetLngStr("PostFormReset")?>" name="reset">
</td></tr>
</table>

</td><td>&nbsp;&nbsp;</td><td width="100%" valign=top>

<?php

	if ($SmiliesPath) {
?>
<b><?=GetLngStr("PostFormSmilies")?></b><br>
<img src="<?=$ImagesPath?>space1.gif" width="1" height="3" alt="" border="0"><br>
<a href="javascript:add_smilie(':_smile_:');"><img src="<?=$SmiliesPath?>smile.gif" border=0 alt=":_smile_:"></a>&nbsp;
<a href="javascript:add_smilie(':_wink_:');"><img src="<?=$SmiliesPath?>wink.gif" border=0 alt=":_wink_:"></a>&nbsp;
<a href="javascript:add_smilie(':_happy_:');"><img src="<?=$SmiliesPath?>happy.gif" border=0 alt=":_happy_:"></a>&nbsp;
<a href="javascript:add_smilie(':_sad_:');"><img src="<?=$SmiliesPath?>sad.gif" border=0 alt=":_sad_:"></a>&nbsp;
<a href="javascript:add_smilie(':_puh_:');"><img src="<?=$SmiliesPath?>puh.gif" border=0 alt=":_puh_:"></a>&nbsp;
<a href="javascript:add_smilie(':_yummie_:');"><img src="<?=$SmiliesPath?>yummie.gif" border=0 alt=":_yummie_:"></a>&nbsp;
<a href="javascript:add_smilie(':_coool_:');"><img src="<?=$SmiliesPath?>coool.gif" border=0 alt=":_coool_:"></a><br>
<a href="javascript:add_smilie(':_pukey_:');"><img src="<?=$SmiliesPath?>pukey.gif" border=0 alt=":_pukey_:"></a>&nbsp;
<a href="javascript:add_smilie(':_devil_:');"><img src="<?=$SmiliesPath?>devil.gif" border=0 alt=">:->"></a>&nbsp;
<a href="javascript:add_smilie(':_frown_:');"><img src="<?=$SmiliesPath?>frown.gif" border=0 alt=":_frown_:"></a>&nbsp;
<a href="javascript:add_smilie(':_redface_:');"><img src="<?=$SmiliesPath?>redface.gif" border=0 alt=":_redface_:"></a>&nbsp;
<a href="javascript:add_smilie(':_clown_:');"><img src="<?=$SmiliesPath?>clown.gif" border=0 alt=":_clown_:"></a>&nbsp;
<a href="javascript:add_smilie(':_cry_:');"><img src="<?=$SmiliesPath?>cry.gif" border=0 alt=":_cry_:"></a>&nbsp;
<a href="javascript:add_smilie(':_idea_:');"><img src="<?=$SmiliesPath?>idea.gif" border=0 alt=":_idea_:"></a><br>
<a href="javascript:add_smilie(':_cwink_:');"><img src="<?=$SmiliesPath?>cwink.gif" border=0 alt=":_cwink_:"></a>&nbsp;
<a href="javascript:add_smilie(':_grrr_:');"><img src="<?=$SmiliesPath?>grrr.gif" border=0 alt=":_grrr_:"></a>&nbsp;
<a href="javascript:add_smilie(':_ill_:');"><img src="<?=$SmiliesPath?>ill.gif" border=0 alt=":_ill_:"></a>&nbsp;
<a href="javascript:add_smilie(':_tooth_:');"><img src="<?=$SmiliesPath?>tooth.gif" border=0 alt=":_tooth_:"></a>&nbsp;
<a href="javascript:add_smilie(':_psycho_:');"><img src="<?=$SmiliesPath?>psycho.gif" border=0 alt=":_psycho_:"></a>&nbsp;
<a href="javascript:add_smilie(':_monster_:');"><img src="<?=$SmiliesPath?>monster.gif" border=0 alt=":_monster_:"></a>&nbsp;
<a href="javascript:add_smilie(':_halt_:');"><img src="<?=$SmiliesPath?>halt.gif" border=0 alt=":_halt_:"></a><br>
<a href="javascript:add_smilie(':_glass_:');"><img src="<?=$SmiliesPath?>glass.gif" border=0 alt=":_glass_:"></a>&nbsp;
<a href="javascript:add_smilie(':_seek_:');"><img src="<?=$SmiliesPath?>seek.gif" border=0 alt=":_seek_:"></a>&nbsp;
<a href="javascript:add_smilie(':_super_:');"><img src="<?=$SmiliesPath?>super.gif" border=0 alt=":_super_:"></a>&nbsp;
<a href="javascript:add_smilie(':_help_:');"><img src="<?=$SmiliesPath?>help.gif" border=0 alt=":_help_:"></a>&nbsp;
<a href="javascript:add_smilie(':_boxer_:');"><img src="<?=$SmiliesPath?>boxer.gif" border=0 alt=":_boxer_:"></a><br>
<a href="javascript:add_smilie(':_dance_:');"><img src="<?=$SmiliesPath?>dance.gif" border=0 alt=":_dance_:"></a>&nbsp;
<a href="javascript:add_smilie(':_alcohol_:');"><img src="<?=$SmiliesPath?>alcohol.gif" border=0 alt=":_alcohol_:"></a><br>
<img src="<?=$ImagesPath?>space1.gif" width="1" height="10" alt="" border="0"><br>

<b><?=GetLngStr("PostFormEmoticons")?></b><br>
<img src="<?=$ImagesPath?>space1.gif" width="1" height="3" alt="" border="0"><br>
<a href="javascript:add_smilie('>:->');"><img src="<?=$SmiliesPath?>evilgrin.png" border=0 alt="Evil grin"></a>
<a href="javascript:add_smilie(':->');"><img src="<?=$SmiliesPath?>grin.png" border=0 alt="Grin"></a>
<a href="javascript:add_smilie(':-)))');"><img src="<?=$SmiliesPath?>happy.png" border=0 alt="Happy"></a>
<a href="javascript:add_smilie(':-)');"><img src="<?=$SmiliesPath?>smile.png" border=0 alt="Smile"></a>
<a href="javascript:add_smilie(':-O');"><img src="<?=$SmiliesPath?>surprised.png" border=0 alt="Surprised"></a>
<a href="javascript:add_smilie(':-P');"><img src="<?=$SmiliesPath?>tongue.png" border=0 alt="Tongue"></a>
<a href="javascript:add_smilie(':-(');"><img src="<?=$SmiliesPath?>unhappy.png" border=0 alt="Unhappy"></a>
<a href="javascript:add_smilie(';-)');"><img src="<?=$SmiliesPath?>wink.png" border=0 alt="Wink"></a><br>
<img src="<?=$ImagesPath?>space1.gif" width="1" height="10" alt="" border="0"><br>
<?php

	}
?>

<b><?=GetLngStr("PostFormTags")?></b><br>
<table bgcolor="#5daeff" border=0 cellspacing=0 cellpadding=0>
<tr><td align="center" class="formtext"><b class="red">:b:</b></td><td align="center" class="formtext">&nbsp;<?=GetLngStr("PostFormTagAnd")?>&nbsp;</td><td align="center" class="formtext"><b class="red">:/b:</b></td><td class="formtext" nowrap>&nbsp;<?=GetLngStr("PostFormTagBold")?></tr>
<tr><td align="center" class="formtext"><b class="red">:i:</b></td><td align="center" class="formtext">&nbsp;<?=GetLngStr("PostFormTagAnd")?>&nbsp;</td><td align="center" class="formtext"><b class="red">:/i:</b></td><td class="formtext" nowrap>&nbsp;<?=GetLngStr("PostFormTagItalic")?></tr>
<tr><td align="center" class="formtext"><b class="red">:u:</b></td><td align="center" class="formtext">&nbsp;<?=GetLngStr("PostFormTagAnd")?>&nbsp;</td><td align="center" class="formtext"><b class="red">:/u:</b></td><td class="formtext" nowrap>&nbsp;<?=GetLngStr("PostFormTagUnderline")?></tr>
</table>

</td>
</tr></table>

</form>
</div>

<?php

	echo '<center><span class="buttonborder"><a href="' . GetParam("PHP_SELF", "S") . '" class="button">' . GetLngStr("BackToGB") . '</a></span></center>';
	PrintPageBottom();
	exit;
}

// **************************
// *** Gästebuch anzeigen ***
// **************************

echo '<h1>' . $GuestbookTitle . '</h1>' . "\n";

// *** Wenn Posting "gesendet" wurde und kein Fehlertext ausgegeben wurde ***
if (($send == "1") && trim($err_text == "")) {
	$gb_date = date("YmdHis"); // Datum setzen
	$m_date = date("d.m.Y, H:i:s"); // Datum für E-Mail-Benachrichtigung
	$line = file($DataFile); // Daten in Array einlesen
	rsort($line); // Array in umgekehrter Reihenfolgen sortieren

	$gb_name = str_replace("<", "&lt;", $gb_name);
	$gb_name = str_replace(">", "&gt;", $gb_name);
	$gb_name = str_replace("\"", "&quot;", $gb_name);
	$gb_name = str_replace("~", "-", $gb_name);
	$gb_name = str_replace("  ", " &nbsp;", $gb_name);
	$gb_name = strip_tags($gb_name, "<b><i><u><a><img>");

	$gb_home = ereg_replace("(<|>| |\(|\)|\||\"|\')", "", $gb_home);
	$gb_home = str_replace("~", "-", $gb_home);
	$gb_home = urlencode($gb_home);
	if (trim($gb_home == "http://"))
		$gb_home = "";

	$gb_text = str_replace("<", "&lt;", $gb_text);
	$gb_text = str_replace(">", "&gt;", $gb_text);
	$gb_text = str_replace("\"", "&quot;", $gb_text);
	$gb_text = str_replace("~", "-", $gb_text);
	$gb_text = str_replace("  ", " &nbsp;", $gb_text);
	$gb_text = str_replace("\r\n", "<br>", $gb_text);
	$gb_text = urlencode($gb_text);
	$gb_text = strip_tags($gb_text, "<b><i><u><a><img>");

	// *** Datei öffnen und mit neuem Eintrag überschreiben ***
	$fp = fopen($DataFile, "w");
	flock($fp, 2);
	fputs($fp, "$gb_date|~#~|$gb_name|~#~|$gb_mail|~#~|$gb_home|~#~|$gb_text" . chr(13) . chr(10));

	// *** Alte Einträge anhängen ***
	for ($i = 0; $i < count($line); $i++) {
		fputs($fp, $line[$i]);
	}
	flock($fp, 3);
	fclose($fp);

	// *** Bei neuem Eintrag eine E-Mail an den Webmaster senden ***
	if ($AdminNotifyMailTo) {
		$m_txt = GetLngStr("NotifyText", $m_date . "\t" . $gb_name . "\t" . $gb_mail . "\t" . $gb_home);
		$m_txt .= $gb_text . "\n";
		$m_txt = urldecode($m_txt);
		$m_txt = stripslashes($m_txt);
		// *** Tags ersetzen ***
		$m_txt = eregi_replace("(:)(b|\/b)(:)", "<\\2>", $m_txt);
		$m_txt = eregi_replace("(:)(i|\/i)(:)", "<\\2>", $m_txt);
		$m_txt = eregi_replace("(:)(u|\/u)(:)", "<\\2>", $m_txt);

		$mail_date = gmdate("D, d M Y H:i:s") . " UTC";
		$header = "Date: " . $mail_date . "\n";
		$header .= "From: Guestbook <" . $AdminNotifyMailTo . ">\n";
		$header .= "X-Mailer: Guestbook FormMailer (www.gaijin.at)\n";
		$header .= "MIME-Version: 1.0\n";
		$header .= "Content-Type: text/html; charset=" . GetLngStr("NotifyCharset") . "\n";
		$header .= "Content-Transfer-Encoding: 8bit\n";
		$mail_text = "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">\n";
		$mail_text .= "<HTML><HEAD><TITLE></TITLE>\n</HEAD>\n<BODY>\n";
		$mail_text .= $m_txt;
		$mail_text .= "</BODY>\n</HTML>\n";
		@ mail($AdminNotifyMailTo, "=?" . GetLngStr("NotifyCharset") . "?B?" . base64_encode(GetLngStr("NotifySubject")) . "?=", $mail_text, $header); // keinen Fehler ausgeben
		$m_txt = "";
		$mail_text = "";
		$header = "";
		$mail_date = "";
	}

	echo '<p align="center" class="green"><big><b>' . GetLngStr("PostThankYou") . '</b></big></p><br>';

	$gb_name = "";
	$gb_mail = "";
	$gb_home = "";
	$gb_text = "";
	$send = "";
	$err_text = "";
}

echo '<center><span class="buttonborder"><a href="' . GetParam("PHP_SELF", "S") . '?g_action=new" class="button">' . GetLngStr("PostAddNewEntry") . '</a></span></center>';

$line = @ file($DataFile);
if ($line) {
	// *** Startwert überprüfen und ggf. setzen ***
	if ($first < 0)
		$first = 0;
	if ($first > count($line) - 1)
		$first = count($line) - 1;
	// *** Anzahl der Postings/Seite überprüfen und ggf. setzen ***
	if ($PostsPerSite > count($line))
		$PostsPerSite = count($line);

	// *** Postings nach Startwert und Anzahl/Seite anzeigen ***
	$c = $first + $PostsPerSite;
	if ($c > count($line))
		$c = count($line);
	echo '<div class="itemsbox">';
	for ($i = $first; $i < $c; $i++) {
		$p = explode("|~#~|", trim($line[$i]), 5);
		if ((isset ($p[0])) && ($i < count($line))) {
			PrintPosting(count($line) - $i, $p[1], $p[2], $p[3], $p[0], $p[4]);
			if ($i < $c -1)
				PrintPostingSpace();
		}
	}
	echo "</div>";

	// Navigationslinks generieren
	$i = count($line) + $PostsPerSite;
	$j = $i;
	echo '<div class="pagenavbox"><span class="pagenumbertext">' . GetLngStr("ViewPostings") . '</span> ';

	// Zum letzten Posting
	if (($NavOverhead > -1) && ($first > 0))
		echo '<a href="' . GetParam("PHP_SELF", "S") . '?g_first=0" class="pagenav">' . GetLngStr("NavPageLast") . '</a> <span class="pagenumberdelim">|</span> ';

	while ($j > 1) {
		// Startwert für Link
		$i -= $PostsPerSite;
		if ($i < 1)
			$i = 1;
		// Endwert für Link
		$j = $i - $PostsPerSite +1;
		if ($j < 1)
			$j = 1;
		// Umgekehrte Reihenfolge der Postings
		$k = count($line) - $i;

		// Links zu den Postings ausgeben
		if (($NavOverhead < 0) || (($k < ($first + ($PostsPerSite * ($NavOverhead +1)))) && ($k > ($first - ($PostsPerSite * ($NavOverhead +1)))))) {
			// Navigationslinks ausgeben
			echo '<span style="white-space:nowrap;">';
			if ($first == $k) {
				echo '<span class="pagenumbercurrent">';
				if ($i != $j)
					echo $i . "-" . $j;
				else
					echo $i;
				echo '</span>';
			} else {
				echo '<a href="' . GetParam("PHP_SELF", "S") . '?g_first=' . $k . '" class="pagenav">';
				if ($i != $j)
					echo $i . "-" . $j;
				else
					echo $i;
				echo "</a>";
			}
			if (($NavOverhead > -1) && ($j > 1) && ($k < ($first + ($PostsPerSite * $NavOverhead))))
				echo ' <span class="pagenumberdelim">|</span>';
			echo '</span> ';
		}
	}

	// Zum ersten Posting
	if (($NavOverhead > -1) && ($first != $k))
		echo '<span class="pagenumberdelim">|</span> <a href="' . GetParam("PHP_SELF", "S") . '?g_first=' . $k . '" class="pagenav">' . GetLngStr("NavPageFirst") . '</a>';

	echo "</div>";

	echo '<center><span class="buttonborder"><a href="' . GetParam("PHP_SELF", "S") . '?g_action=new" class="button">' . GetLngStr("PostAddNewEntry") . '</a></span></center>';
}

if (!$DisableAuth && $ShowAdminLink) {
	echo '<p align="center">' . GetLngStr("AdminLinkTitle") . ' <b><a href="' . GetParam("PHP_SELF", "S") . '?g_action=login">' . GetLngStr("AdminLink") . '</a></b><p>';
}

PrintPageBottom();
exit;

// ############################################################################

function PrintPosting($PostNo, $PostName, $PostMail, $PostHome, $PostTime, $PostMsg) {
	global $ImagesPath, $SmiliesPath;
	global $DisableAuth, $AdminLogin, $AdminPasswd;

	$OrigTime = $PostTime;
	$PostTime = substr($PostTime, 6, 2) . "." . substr($PostTime, 4, 2) . "." . substr($PostTime, 0, 4) . ", " . substr($PostTime, 8, 2) . ":" . substr($PostTime, 10, 2) . ":" . substr($PostTime, 12, 2);
	$PostHome = urldecode($PostHome);
	$PostMsg = urldecode($PostMsg);
	$PostMsg = stripslashes(trim($PostMsg));

	// Smilies ersetzen
	if ($SmiliesPath) {
		$PostMsg = eregi_replace("(\:\_)(.{1,8})(\_\:)", " <img src=\"" . $SmiliesPath . "\\2.gif\" border=\"\" alt=\"\\2\"> ", $PostMsg);
		$PostMsg = str_replace(":-)))", "<img src=\"" . $SmiliesPath . "happy.png\" border=\"\" alt=\"Happy\">", $PostMsg);
		$PostMsg = str_replace(":)))", "<img src=\"" . $SmiliesPath . "happy.png\" border=\"\" alt=\"Happy\">", $PostMsg);
		$PostMsg = str_replace(":-))", "<img src=\"" . $SmiliesPath . "grin.png\" border=\"\" alt=\"Grin\">", $PostMsg);
		$PostMsg = str_replace(":))", "<img src=\"" . $SmiliesPath . "grin.png\" border=\"\" alt=\"Grin\">", $PostMsg);
		$PostMsg = str_replace(":&gt;", "<img src=\"" . $SmiliesPath . "grin.png\" border=\"\" alt=\"Grin\">", $PostMsg);
		$PostMsg = str_replace(":-&gt;", "<img src=\"" . $SmiliesPath . "grin.png\" border=\"\" alt=\"Grin\">", $PostMsg);
		$PostMsg = str_replace(":-)", "<img src=\"" . $SmiliesPath . "smile.png\" border=\"\" alt=\"Smile\">", $PostMsg);
		$PostMsg = str_replace(":)", "<img src=\"" . $SmiliesPath . "smile.png\" border=\"\" alt=\"Smile\">", $PostMsg);
		$PostMsg = str_replace(";-)", "<img src=\"" . $SmiliesPath . "wink.png\" border=\"\" alt=\"Wink\">", $PostMsg);
		$PostMsg = str_replace(";)", "<img src=\"" . $SmiliesPath . "wink.png\" border=\"\" alt=\"Wink\">", $PostMsg);
		$PostMsg = str_replace(":-(", "<img src=\"" . $SmiliesPath . "unhappy.png\" border=\"\" alt=\"Unhappy\">", $PostMsg);
		$PostMsg = str_replace(":(", "<img src=\"" . $SmiliesPath . "unhappy.png\" border=\"\" alt=\"Unhappy\">", $PostMsg);
		$PostMsg = str_replace("&gt;:-&gt;", "<img src=\"" . $SmiliesPath . "evilgrin.png\" border=\"\" alt=\"Evil grin\">", $PostMsg);
		$PostMsg = str_replace("&gt;:&gt;", "<img src=\"" . $SmiliesPath . "evilgrin.png\" border=\"\" alt=\"Evil grin\">", $PostMsg);
		$PostMsg = str_replace(":-P", "<img src=\"" . $SmiliesPath . "tongue.png\" border=\"\" alt=\"Tongue\">", $PostMsg);
		$PostMsg = str_replace(":-p", "<img src=\"" . $SmiliesPath . "tongue.png\" border=\"\" alt=\"Tongue\">", $PostMsg);
		$PostMsg = str_replace(":P", "<img src=\"" . $SmiliesPath . "tongue.png\" border=\"\" alt=\"Tongue\">", $PostMsg);
		$PostMsg = str_replace(":p", "<img src=\"" . $SmiliesPath . "tongue.png\" border=\"\" alt=\"Tongue\">", $PostMsg);
		$PostMsg = str_replace(":-O", "<img src=\"" . $SmiliesPath . "surprised.png\" border=\"\" alt=\"Surprised\">", $PostMsg);
		$PostMsg = str_replace(":-o", "<img src=\"" . $SmiliesPath . "surprised.png\" border=\"\" alt=\"Surprised\">", $PostMsg);
		$PostMsg = str_replace(":O", "<img src=\"" . $SmiliesPath . "surprised.png\" border=\"\" alt=\"Surprised\">", $PostMsg);
		$PostMsg = str_replace(":o", "<img src=\"" . $SmiliesPath . "surprised.png\" border=\"\" alt=\"Surprised\">", $PostMsg);
	}
	// Tags ersetzen
	$PostMsg = eregi_replace("(:)(b|\/b)(:)", "<\\2>", $PostMsg);
	$PostMsg = eregi_replace("(:)(i|\/i)(:)", "<\\2>", $PostMsg);
	$PostMsg = eregi_replace("(:)(u|\/u)(:)", "<\\2>", $PostMsg);

	if ($PostMail != "") {
		$em = explode("@", $PostMail);
		$m = str_replace("@", " [at] ", $PostMail);
		$m = str_replace(".", " [dot] ", $m);
		$PostMail = "mailto:" . $m;
	}

	if ($PostHome == "http://")
		$PostHome = "";

	include ("cal_pgm/inc_item.php");

	if ($DisableAuth || ((GetParam("PHP_AUTH_USER", "S") == $AdminLogin) && (GetParam("PHP_AUTH_PW", "S") == $AdminPasswd))) {
		echo '<a href="' . GetParam("PHP_SELF", "S") . '?g_action=del&g_entry=' . $OrigTime . '" class="admin">' . GetLngStr("AdminDelete") . '</a><br>';
	}
}

// ############################################################################

function PrintPostingSpace() {
	global $ImagesPath;
	// HTML-Code der zwischen den Postings ausgegeben wird
}

// ############################################################################

function PrintPageBottom() {
	global $ImagesPath;

	// Das Entfernen des Copyright-Vermerkes oder des Links, sowie das Unkenntlichmachen
	// des Copyright-Vermerkes oder des Links, ist ein Verstoß gegen das Urheberrecht und
	// die Lizenzbestimmungen.

	// Für weitere Fragen sowie für eine Genehmigung zum Entfernen des Copyright-Vermerks
	// wenden Sie sich bitte an <info@gaijin.at>

	echo '<p align="center"><b>Copyright &copy; 2004-2008 <a href="http://www.gaijin.at/">www.gaijin.at</a></b></p>' . "\n";
	echo "</td></tr></table>\n";
	echo "\n</body>\n";
	echo "</html>\n";
}

// ############################################################################

function DelPosting($DataFile, $entry) {
	if (!file_exists($DataFile))
		return 0;
	$lines = file($DataFile);
	@ unlink($DataFile);
	$fp = fopen($DataFile, "w");
	flock($fp, 2);
	foreach ($lines as $line) {
		$l = explode("|~#~|", $line);
		if ((chop($line)) && ($l[0] != $entry))
			fputs($fp, $line);
	}
	flock($fp, 3);
	fclose($fp);
	return 1;
}

// ############################################################################

function CaptchaImageString(& $CodeMD5) {
	// Captcha-Einstellungen
	$ValidChars = "ABCEDFGHJKLMNPQRSTUVWXYZ123456789abcdefhknrstuvxz";
	$CodeLength = 6;
	// Code zusammenstellen
	mt_srand((double) microtime() * 1000000);
	$seed = mt_rand(5000, 1000000);
	mt_srand($seed);
	$code = "";
	for ($i = 0; $i < $CodeLength; $i++) {
		$code .= substr($ValidChars, mt_rand(0, strlen($ValidChars) - 1), 1);
	}
	$CodeMD5 = md5(strtoupper($code));
	return '<img src="captchaimg.php?t=i&s=' . $seed . '" alt="Captcha">';
}

function CaptchaCalculationString(& $CodeMD5) {
	// Captcha-Einstellungen
	$ValidChars = "123456789";
	// Code zusammenstellen
	mt_srand((double) microtime() * 1000000);
	$seed = mt_rand(5000, 1000000);
	mt_srand($seed);
	$iVal1 = intval(substr($ValidChars, mt_rand(0, strlen($ValidChars) - 1), 1));
	$iVal2 = intval(substr($ValidChars, mt_rand(0, strlen($ValidChars) - 1), 1));
	$CodeMD5 = md5($iVal1 + $iVal2);
	return "$iVal1 + $iVal2";
}

function CaptchaCalculationImageString(& $CodeMD5) {
	// Captcha-Einstellungen
	$ValidChars = "123456789";
	// Code zusammenstellen
	mt_srand((double) microtime() * 1000000);
	$seed = mt_rand(5000, 1000000);
	mt_srand($seed);
	$iVal1 = intval(substr($ValidChars, mt_rand(0, strlen($ValidChars) - 1), 1));
	$iVal2 = intval(substr($ValidChars, mt_rand(0, strlen($ValidChars) - 1), 1));
	$CodeMD5 = md5(strtoupper($iVal1 + $iVal2));
	return '<img src="captchaimg.php?t=c&s=' . $seed . '" alt="Captcha">';
}

// ############################################################################

function GetParam($ParamName, $Method = "P", $DefaultValue = "") {
	if ($Method == "P") {
		if (isset ($_POST[$ParamName]))
			return $_POST[$ParamName];
		else
			return $DefaultValue;
	} else
		if ($Method == "G") {
			if (isset ($_GET[$ParamName]))
				return $_GET[$ParamName];
			else
				return $DefaultValue;
		} else
			if ($Method == "S") {
				if (isset ($_SERVER[$ParamName]))
					return $_SERVER[$ParamName];
				else
					return $DefaultValue;
			}
}

// ############################################################################

function AuthUser() {
	global $AdminLogin;
	global $AdminPasswd;
	if ((GetParam("PHP_AUTH_USER", "S") != $AdminLogin) || (GetParam("PHP_AUTH_PW", "S") != $AdminPasswd)) {
		header('WWW-Authenticate: Basic realm="Gaijin Guestbook - ' . GetLngStr("AdminAuthTitle") . '"');
		header('HTTP/1.0 401 Unauthorized');
		echo '<html><head></head><body>' . GetLngStr("AdminAuthText") . '<br><br>';
		echo '<a href="' . GetParam("PHP_SELF", "S") . '">' . GetLngStr("BackToGB") . '</a><br></body></html>';
		exit;
	}
}

// ############################################################################

function MatchRule($aRules, $sField) {
	foreach ($aRules as $key => $rule) {
		if ($rule == "")
			continue;
		if (substr($rule, 0, 1) == "/") {
			if (preg_match($rule, $sField) > 0)
				return $key;
		} else {
			if (stristr($sField, $rule) !== false)
				return $key;
		}
	}
	return "";
}

// ############################################################################

function GetLngStr($sId, $sParams = "") {
	global $Lang;

	if (isset ($Lang[$sId]))
		$sResult = $Lang[$sId];
	else
		$sResult = "{Missing string \"" . $sId . "\"}";

	$aParams = split("\t", $sParams);
	for ($i = 0; $i < count($aParams); $i++) {
		$sResult = str_replace("%s" . ($i +1) . "%", $aParams[$i], $sResult);
	}

	return $sResult;
}

// ############################################################################
?>