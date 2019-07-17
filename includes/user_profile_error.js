<?php

echo "<script type='text/JavaScript'> " ;
echo 'var var_1 = new Array()' ;
// print_r($_SESSION);

// ausgabe der fehlermeldung nach sprache
if ($_SESSION['LANG'] == 'de') {
		echo "
var_1[0] = new Array('FIRSTNAME','e','Sie haben keinen Vornamen angegeben','');
var_1[1] = new Array('LASTNAME','e','Sie haben keinen Nachnamen angegeben','');
var_1[2] = new Array('CITY','e','Sie haben keinen Ort angegeben','');
var_1[3] = new Array('ADDRESS','e','Sie haben keine Strasse angegeben','');
var_1[4] = new Array('ADDRESSNUMBER','e','Sie haben keine Hausnummer angegeben','');
var_1[5] = new Array('OFFICEPHONE','n','ist keine gueltige Telefonnummer','');
var_1[5] = new Array('OFFICEPHONE','r','Telefonnummer zu kurz ungueltig',/\w{6}/);
var_1[6] = new Array('FAXPHONE','n','ist keine gueltige Faxnummer','');
var_1[6] = new Array('FAXPHONE','r','Faxnummer zu kurz  ungueltig',/\w{6}/);
var_1[7] = new Array('CELLULARPHONE','n','ist keine gueltige Mobilenummer','');
var_1[7] = new Array('CELLULARPHONE','r','Mobilenummer zu kurz ungueltig',/\w{6}/);
 ";
}elseif ($_SESSION['LANG'] == 'it') {
		echo "
var_1[0] = new Array('FIRSTNAME','e','Non hanno indicato nomi','');
var_1[1] = new Array('LASTNAME','e','Non hanno cognome hanno indicato','');
var_1[2] = new Array('CITY','e','per non avere posto avete indicato ','');
var_1[3] = new Array('ADDRESS','e','per non avere strada avete indicato che','');
var_1[4] = new Array('ADDRESSNUMBER','e','non fare numero di casa indicare','');
var_1[5] = new Array('OFFICEPHONE','n','siete numero di telefono valido','');
var_1[5] = new Array('OFFICEPHONE','r','di numero di telefono troppo brevemente non valido',/\w{6}/);
var_1[6] = new Array('FAXPHONE','n','siete numero di fax valido','');
var_1[6] = new Array('FAXPHONE','r','di numero di fax troppo brevemente non valido',/\w{6}/);
var_1[7] = new Array('CELLULARPHONE','n','siete numero mobile valido','');
var_1[7] = new Array('CELLULARPHONE','r','il numero mobile troppo brevemente non valido',/\w{6}/);
 ";
}elseif ($_SESSION['LANG'] == 'en') {
		echo "
var_1[0] = new Array('FIRSTNAME','e','They indicated no first names','');
var_1[1] = new Array('LASTNAME','e','you do not have no surname indicated','');
var_1[2] = new Array('CITY','e','you have no place indicated','');
var_1[3] = new Array('ADDRESS','e','you have no road indicated','');
var_1[4] = new Array('ADDRESSNUMBER','e','you have no house number indicated ','');
var_1[5] = new Array('OFFICEPHONE','n','are no valid telephone number','');
var_1[5] = new Array('OFFICEPHONE','r','telephone number too briefly invalidly',/\w{6}/);
var_1[6] = new Array('FAXPHONE','n','are no valid fax number','');
var_1[6] = new Array('FAXPHONE','r','fax number too briefly invalidly',/\w{6}/);
var_1[7] = new Array('CELLULARPHONE','n','are no valid mobile number','');
var_1[7] = new Array('CELLULARPHONE','r','mobile number too briefly invalidly',/\w{6}/);
 ";
}elseif ($_SESSION['LANG'] == 'fr') {
		echo "
var_1[0] = new Array('FIRSTNAME','e','Ils n'ont pas indiqué de prénom','');
var_1[1] = new Array('LASTNAME','e','Ils n'ont pas de nom de famille indiqué','');
var_1[2] = new Array('CITY','e','vous ont pas de place indiqué ','');
var_1[3] = new Array('ADDRESS','e','vous ont pas de route indiqué','');
var_1[4] = new Array('ADDRESSNUMBER','e','vous ont pas de numéro de l immeuble sont indiqués ','');
var_1[5] = new Array('OFFICEPHONE','n','pas de numéro de téléphone numéro de téléphone','');
var_1[5] = new Array('OFFICEPHONE','r','valable brièvement invalide',/\w{6}/);
var_1[6] = new Array('FAXPHONE','n','sont pas de numéro de télécopie numéro de télécopie','');
var_1[6] = new Array('FAXPHONE','r','valable brièvement invalide',/\w{6}/);
var_1[7] = new Array('CELLULARPHONE','n','sont pas de numéro mobile numéro mobile','');
var_1[7] = new Array('CELLULARPHONE','r','valable brièvement invalide',/\w{6}/);
 ";
}

// javascript check eingaben
include 'includes/contacts_js_check.js';
?>
