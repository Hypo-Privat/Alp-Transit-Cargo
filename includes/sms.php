<?php
//http://www.ecall.ch
//Ihre Partner ID lautet: GertDorn
//login gertdorn pw: face1234

//an 0041787720815@msg.ecall.ch
//betreff barcode

// text blabla

function sms($absender, $empfaenger, $text) {
  $url = 'http://www.anbieter.de/sms.php?
text=%TEXT%&emfaenger=%EMPFAENGER%&absender=%ABSENDER%';

  $placeholder = array(
    '%EMPFAENGER%' => $empfaenger,
    '%ABSENDER%'   => rawurlencode($absender),
    '%TEXT%'       => rawurlencode(substr($text, 0, 160)));

  $url = strtr($url, $placeholder);

  $fp=fopen($url, 'r')
    or die ('Connection failed');
}
?>
