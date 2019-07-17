<?php

echo "<script type='text/JavaScript'>  " ;
echo 'var var_1 = new Array()' ;
//print_r($_SESSION);
if ($_SESSION['LANG'] == 'de') {
		echo " ;
var_1[0] = new Array('EMAILADDRESS','m','ist keine gueltige Emailadresse','');
var_1[0] = new Array('EMAILADDRESS','e','Sie haben keine gueltige Emailadresse eingegeben','');
var_1[1] = new Array('PWD','e','Sie haben keine Password eingegeben','');
var_1[1] = new Array('PWD','r','Das Password muss aus mind 8 Zeichen bestehen',/\w{8}/);
var_1[2] = new Array('PWD1','e','Mit Password2 Password1 bestÃ¤tigen','');
var_1[2] = new Array('PWD1','r','Password 2 muss identisch mit Password 1 sein',/\w{8}/);
";
}elseif ($_SESSION['LANG'] == 'it') {
		echo "
var_1[0] = new Array('EMAILADDRESS','m','non c'non è nessun email address valido','');
var_1[0] = new Array('EMAILADDRESS','e','voi che un email address valido li abbia entrati','');
var_1[1] = new Array('PWD','e','per non avere parole d'accesso abbia digitato','');
var_1[1] = new Array('PWD','r','la parola d'accesso debba fuori occuparsi di 8 indicazioni esista',/\w{8}/);
var_1[2] = new Array('PWD1','e','con Password2 Password1 per confermare','');
var_1[2] = new Array('PWD1','r','il mosto di parola d'accesso 2 alla parola d'accesso 1 sia identico',/\w{8}/); 
";
}elseif ($_SESSION['LANG'] == 'fr') {
		echo "
var_1[0] = new Array('EMAILADDRESS','m','aucune adresse d'émail valable n'est','');
var_1[0] = new Array('EMAILADDRESS','e','vous a d'adresse d'émail valable suggéré','');
var_1[1] = new Array('PWD','e','vous a pas de mots de passe suggéré','');
var_1[1] = new Array('PWD','r','le mot de passe doit mind 8 signes réussir',/\w{8}/);
var_1[2] = new Array('PWD1','e','avec Password2 Password1 confirmer','');
var_1[2] = new Array('PWD1','r','le mot de passe 2 doit au mot de passe 1 être identique',/\w{8}/);
 ";
}elseif ($_SESSION['LANG'] == 'en') {
		echo "
var_1[0] = new Array('EMAILADDRESS','m','no valid email address is not','');
var_1[0] = new Array('EMAILADDRESS','e','no valid email address entered','');
var_1[1] = new Array('PWD','e','you  have no passwords entered','');
var_1[1] = new Array('PWD','r','the password must out mind 8 indications exist',/\w{8}/);
var_1[2] = new Array('PWD1','e','with Password2 Password1 to confirm','');
var_1[2] = new Array('PWD1','r','password 2 must to password 1 be identical',/\w{8}/); 
";
} // ende sprach check

//} //ende session user

// javascript check eingaben
include 'includes/contacts_js_check.js';
?>
