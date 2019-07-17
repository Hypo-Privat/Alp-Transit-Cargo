<?php

require ('http_sprache.php');

$allowed_langs = array ('de', 'en', 'it', 'fr', 'es');

$_SESSION['LANG'] = lang_getfrombrowser ($allowed_langs, 'de', null, false);

//$_SESSION['LANG'] = $lang ;
//echo "hier {$_SESSION['LANG']}" ;
// Ausgabe im HTML
//var_dump ($lang);
header('Location:../menue_call.php');
//return($lang);

?>