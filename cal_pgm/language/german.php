<?php
if (!defined("INTERN_CALL")) die("<p><b>DIRECT ACCESS DENIED!</b></p>");

$Lang['DefaultGuestbookName'] = "Mein G�stebuch";

$Lang['TextCutMark'] = "... (Text wurde gek�rzt!)";

$Lang['BackToGB'] = "Zur�ck zum G�stebuch";

$Lang['PostAddNewTitle'] = "Neuen G�stebucheintrag hinzuf�gen";
$Lang['PostAddNewEntry'] = "Neuen G�stebucheintrag hinzuf�gen";

$Lang['PostError'] = "Fehler:";
if ($FormalText) {
  $Lang['PostErrNoName'] = "Bitte geben Sie Ihren Namen an.";
  $Lang['PostErrInvalidMailAddr'] = "Bitte geben Sie eine g�ltige Mail-Adresse an (z.B.: vorname.nachname@provider.at).";
  $Lang['PostErrInvalidUrl'] = "Bitte geben Sie eine g�ltige URL an (z.B.: http://www.seite.at/).";
  $Lang['PostErrNoText'] = "Bitte geben Sie einen Text ein.";
  $Lang['PostErrNoCode'] = "Bitte geben Sie den Sicherheitscode ein.";
  $Lang['PostErrWrongCode'] = "Bitte geben Sie den richtigen Sicherheitscode ein.";
} else {
  $Lang['PostErrNoName'] = "Bitte gib Deinen Namen an.";
  $Lang['PostErrInvalidMailAddr'] = "Bitte gib eine g�ltige Mail-Adresse an (z.B.: vorname.nachname@provider.tld).";
  $Lang['PostErrInvalidUrl'] = "Bitte gib eine g�ltige URL an (z.B.: http://www.webseite.tld/).";
  $Lang['PostErrNoText'] = "Bitte gib einen Text ein.";
  $Lang['PostErrNoCode'] = "Bitte gib den Sicherheitscode ein.";
  $Lang['PostErrWrongCode'] = "Bitte bib den richtigen Sicherheitscode ein.";
}
$Lang['RuleTextMatch'] = "Der Text des G�stebucheintrages enth�lt unerw�nschte Inhalte (%s1%).";
$Lang['RuleNameMatch'] = "Der Name enth�lt unerw�nschte Inhalte (%s1%).";
$Lang['RuleMailMatch'] = "Die Mail-Adresse enth�lt unerw�nschte Inhalte (%s1%).";
$Lang['RuleHomeMatch'] = "Die URL der Webseite enth�lt unerw�nschte Inhalte (%s1%).";

if ($FormalText) {
  $Lang['PostFormName'] = "Ihr Name:";
  $Lang['PostFormMail'] = "Ihre Mail-Adresse:";
  $Lang['PostFormHome'] = "Ihre Homepage:";
} else {
  $Lang['PostFormName'] = "Dein Name:";
  $Lang['PostFormMail'] = "Deine Mail-Adresse:";
  $Lang['PostFormHome'] = "Deine Homepage:";
}
$Lang['PostFormText'] = "Text:";
$Lang['PostFormTextMax'] = "(max. 1.000 Zeichen,<br>keine HTML-Tags)";
$Lang['PostFormCode'] = "Sicherheitscode:";
$Lang['PostFormCodeQuery'] = "Sicherheitsabfrage:";
if ($FormalText) {
  $Lang['PostFormCodeQueryInfo'] = "Bitte geben Sie den 6-stelligen Sicherheitscode ein.";
} else {
  $Lang['PostFormCodeQueryInfo'] = "Bitte gib den 6-stelligen Sicherheitscode ein.";
}
$Lang['PostFormCalc'] = "Wie viel ist:";
$Lang['PostFormCalcStr'] = "%s1% ?";
$Lang['PostFormCalcQuery'] = "Ergebnis:";
if ($FormalText) {
  $Lang['PostFormCalcQueryInfo'] = "Bitte geben Sie das Ergebnis der Addition ein.";
} else {
  $Lang['PostFormCalcQueryInfo'] = "Bitte gib das Ergebnis der Addition ein.";
}
$Lang['PostFormSmilies'] = "SMILIES:";
$Lang['PostFormEmoticons'] = "EMOTICONS:";
$Lang['PostFormTags'] = "TAGS:";
$Lang['PostFormTagAnd'] = "und";
$Lang['PostFormTagBold'] = "f�r <b>fett</b>";
$Lang['PostFormTagItalic'] = "f�r <i>kursiv</i>";
$Lang['PostFormTagUnderline'] = "f�r <u>unterstrichen</u>";

$Lang['PostFormOptFields'] = " = optionale Felder";
$Lang['PostFormSubmit'] = "Senden";
$Lang['PostFormReset'] = "Zur�cksetzen";

$Lang['NotifyCharset'] = "iso-8859-1";
$Lang['NotifySubject'] = "Neuer G�stebucheintrag";
$Lang['NotifyText'] = "Neuer Eintrag am <b>%s1%</b> Uhr:<br>\n".
                      "Von: <b>%s2%</b> &lt;<a href=\"mailto:%s3%\">%s3%</a>&gt;".
                      " (<a href=\"%s4%\">%s4%</a>)<br>\n<br>\n";

if ($FormalText) {
  $Lang['PostThankYou'] = "Danke f�r Ihren Eintrag!";
} else {
  $Lang['PostThankYou'] = "Danke f�r Deinen Eintrag!";
}

$Lang['AdminAuthTitle'] = "Administration";
$Lang['AdminAuthText'] = "Authentifizierung erforderlich!";
$Lang['AdminLinkTitle'] = "Administration:";
$Lang['AdminLink'] = "Login";
$Lang['AdminDelete'] = "Eintrag l�schen";

$Lang['ViewPostings'] = "Postings:";
$Lang['NavPageLast'] = "Letzte";
$Lang['NavPageFirst'] = "Erste";

$Lang['ItemWebsiteVisit'] = "Webseite von %s1% besuchen";
$Lang['ItemWebsiteAlt'] = "Webseite";
$Lang['ItemEMailSend'] = "E-Mail an %s1% senden";
$Lang['ItemEMailAlt'] = "E-Mail";
$Lang['ItemInfo'] = "Eintrag #%s1% vom %s2% Uhr";

?>