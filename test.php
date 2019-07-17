<?php

session_start() ;
var_dump($_SESSION);		
echo " <br>vor  $locale , $domain , $encoding <br>";
setlocale (LC_ALL, 'de_DE');
echo strftime ("%A %e %B %Y", mktime (0, 0, 0, 13, 02, 2011));
?>
<br>
<br>
<?php
setlocale (LC_ALL, 'es_ES');
echo strftime ("%A %e %B %Y", mktime (0, 0, 0, 13, 02, 2011));
?>
<br>
<br>
<?php
setlocale (LC_ALL, 'fr_FR');
echo strftime ("%A %e %B %Y", mktime (0, 0, 0, 13, 02, 2011));
?>
<br>
<br>
<?php
setlocale (LC_ALL, 'it_IT');
echo strftime ("%A %e %B %Y", mktime (0, 0, 0, 13, 02, 2011));
?>
<br>
<br>
<?php
setlocale (LC_ALL, 'en_GB');
echo strftime ("%A %e %B %Y", mktime (0, 0, 0, 13, 02, 2011));

print_r($_SESSION);

?>
<br>
<br>
