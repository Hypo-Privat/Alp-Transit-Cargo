<?php
$_SESSION['angemeldet'] = 1; // muss sein für quick register
echo gettext('glob_titel') . gettext('tourkfz_new_head') . gettext('glob_titel_end');
echo gettext('glob_typ1') . gettext('tourkfz_new_text') . gettext('glob_typ1_end');

echo "<form name = 'tour_neu' id = 'tour_neu'
	onSubmit='return validate(this,var_1)'
	ACTION='menue_call.php?go=ttourkfz.php&dir=includes&func=tour_tbnew'
	METHOD='POST'>";
?>

<table  align="center">
	<tr>
		<td width='350' align="center">
		<?php
$typ = ab;
kalender($typ);
?>

		</td>
		<td width='350' align="center">

		<?php
$typ = an;
//kalender($typ);
?>
		</td>
	</tr>


	<tr>
		<td>
		<TABLE width='350'>
			<TR>
				<td >
				<?php


$typ = 'ab';
require_once 'includes/ttourkfz_data.inc';
tourkfz_reg_q($typ);
?></td>
			</TR>
		</TABLE>
		</td>

		<td>
		<TABLE width='350'>
			<TR>
				<td >
				<?php


$typ = 'an';
tourkfz_reg_q($typ);
?>
	 		</td>
			</TR>
		</TABLE>
		</td>
	</tr>
</table>
<TABLE >
	<tr><td>
		<?php


require 'includes/tkfz_data.inc';
kfz_reg_q();
?>
		</td></tr>
</TABLE>

<TABLE >
	<tr><td>
		<?php


require 'includes/tcontacts_data.inc';
user_reg_q();
?><td></tr>
</TABLE>
<br>
<table align="center">
	<tr>
		<td width='350'><INPUT TYPE="submit" VALUE="absenden"
			NAME="senden" id=button></td>
		<td width='350'><INPUT TYPE="reset" VALUE="abbrechen"
			NAME="CANCEL" id=button></td>
	</tr>
</table>

</form>



