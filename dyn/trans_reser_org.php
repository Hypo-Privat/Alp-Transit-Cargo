
<?php
//in menue_call eingebunden
//in texte ist die Sprachsteuerung übergabe mitgettext
//selectlist enthalt basisfunktionen wie Datum ect.
//include 'includes/selectlist.inc';

//slotlist steuer die transit reservierungstabellen
include 'includes/trans_slotlist.inc';

//tab_head
echo "<table width='700' align='center' ><tr><td class='titel' >";
echo  gettext('trans_reser.php_titel');
echo "</td></tr>";
echo " <tr><td class='typ1' >";
echo  gettext('trans_reser.php_text1');
echo "	<br></td></tr></table>" ;
//end _head
//tab1
echo "<table><tr><td  align='center'>
<A  href=\"javascript:Foto('http://a-t-c.ch/images/transit2.jpg')\">
<img  style=width='350' height='250' src='images/transit2.jpg'></a></td></tr></table>" ;//end tab1

// anweisung was zu tun ist
echo "<table width='700' align='center' ><tr><td class='typ2'>";
echo gettext('trans_reser.php_text2');
echo "</td></tr></table>" ;

echo "<form name='slot' ACTION='menue_call.php?go=trans_reser&dir=dyn/' METHOD='POST'>" ;
echo "<table  width='700' align='center'><tr>" ; //tab2

echo "<td class='typ1'>";
echo gettext('trans_reser.php_wahl_trade');
echo "<br>
<select name = 'SLOT' value = 'T' >";
echo gettext('trans_reser.php_sel_trade');
echo " </select></td>" ;

// Daten für transitauswahl holen
echo "<td class='typ1'> ";
echo gettext('glob_datum');
echo "  <br>" ;
$getdate = get_date(32, 0, 0, 1) ;
echo "</td> <td class='typ1'> ";
echo gettext('glob_route');
echo "  --> ";
echo gettext('glob_richtung');
echo " <br>" ;
$getrefslot = get_refslot() ;
echo "</td>" ;
echo "<td class='typ1'>go<br>
<input type='submit' name='slot' value='suchen'> </td> ";
echo "</tr>	</table></form> "; //tab2

$route = get_route() ;
//get_slothead() ;
//echo "<table width='700' align='center'><tr>" ; 	// tabelle 3 in get_slothead ?ffnen
echo "</table> "	// ende tabelle 3 hier ende ausgeben
?>
