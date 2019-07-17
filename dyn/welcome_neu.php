<?php
echo gettext('glob_titel') . gettext('glob_eingelogged_head') . gettext('glob_titel_end');
echo '<table width=" 700 " border = " 1 ">';

echo '<TR  align="center">
			<TD class="typ2"></TD>
			<TD class="typ2">' .gettext('suchen'). '</TD>
			<TD class="typ2">' .gettext('angebot'). '</TD>
		</TR>
		<TR  align="center">
			<TD class="typ1">'.gettext('fracht').'</TD>
			<TD><A href="http://a-t-c.ch/menue_call.php?go=toursuchen_data.inc&func=such_list&value=lad&dir=includes"
				target="_self"><IMG border="0" src="../images/fracht-beiladung.jpg" width="100"height="80"></TD>
			<TD><A href="http://a-t-c.ch/menue_call.php?go=ttourlad_data.inc&func=tourlad_reg&value=quick&dir=includes"
				target="_self"><IMG border="0" src="../images/Cargo_Versand.jpg" width="100"
				height="80"></TD>
		</TR>
		<TR  align="center">
			<TD class="typ1">'.gettext('fahrzeug').'</TD>
			<TD><A href="http://a-t-c.ch/menue_call.php?go=toursuchen_data.inc&func=such_list&value=kfz&dir=includes"
				target="_self"><IMG border="0" src="../images/truck-leer.jpg"
				width="100"height="80"></TD>
			<TD><a href="http://a-t-c.ch/menue_call.php?go=ttourkfz_data.inc&func=tourkfz_reg&value=quick&dir=includes"
				target="_self"><IMG border="0"
				src="../images/lkw-leer.jpg" width="100"height="80"></A></TD>
		</TR>
		<TR  align="center">
			<TD class="typ1">'.gettext('umzug').'</TD>
			<TD ><A href="http://a-t-c.ch/menue_call.php?go=toursuchen_data.inc&func=such_list&value=umz&dir=includes"
				target="_self"><IMG border="0" src="../images/Umz-beiladung.jpg"
				width="100"height="80"></TD>
			<TD ><A href="http://a-t-c.ch/menue_call.php?go=tumz_data.inc&func=umz_reg&value=quick&dir=includes"
				target="_self"><IMG border="0" src="../images/umzug-offer.jpg"
					width="100" height="80"></TD>
		</TR>';
echo gettext('glob_typ1') . gettext('bahn-tip') . "<br>
<IMG border='0' src='../images/zug.gif'	width='700' height='40'><br>" . gettext('glob_eingelogged_help') . gettext('glob_sign') . gettext('glob_typ1_end');
echo '</table>';
?>
