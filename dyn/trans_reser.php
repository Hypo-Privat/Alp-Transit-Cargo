
<?php

//in menue_call eingebunden
//in texte ist die Sprachsteuerung übergabe mitgettext
//selectlist enthalt basisfunktionen wie Datum ect.
//include 'includes/selectlist.inc';

//slotlist steuer die transit reservierungstabellen
include 'includes/trans_slotlist.inc';

//tab_head
echo "<table width='700' ><tr><td class='titel' >";
echo gettext('trans_reser.php_titel');
echo "</td></tr></table>";
//end _head
//tab1
echo "<table align='center'><tr><td>
<A  href=\"javascript:Foto('http://a-t-c.ch/images/transit2.jpg')\">
<img  style=width='350' height='150' src='images/transit2.jpg'></a></td>";

//tab rechts
echo "<form name='slot' ACTION='menue_call.php?go=trans_reser&dir=dyn/' METHOD='POST'>" ;
echo "<td class='typ1'>";
echo gettext('trans_reser.php_text2') ,'<br><br>',gettext('glob_datum') ,'  ',get_date(32, 0, 0, 1),'  ',gettext('senden') ;
//echo '<br><br>' ,gettext('trans_slotlist.inc_get_route_anzeigetxt1');
echo "</td></form></tr></table>"; //end rechts

// hier die neue Tabelle einbauen
echo "<table width='700' border = '0'>";
get_slothead();
echo "</table> " // ende tabelle 3 hier ende ausgeben
?>
