
<?php {
	
	echo "<table width='680' ><tr><td  align='center'>";
	echo "<FORM action='menue_call.php?go=tcontacts_data.inc&func=user_login_check&dir=includes' method='post'> ";
	echo "<input id='EMAILADDRESS' style='height: 18px' maxlength='64' size='10' name='EMAILADDRESS'> ";
	echo  gettext('glob_email');
	echo "	<input id='PWD' type='password' style='height: 18px' maxlength='30' size='10' name='PWD'> ";
	echo  gettext('glob_passwort');
	echo "	<input type='submit' 'height: 20px'  value='".gettext('glob_senden')."'> " ;
	//echo "<a href='menue_call.php?go=tcontacts_data.inc&func=user_login_check&dir=includes'> Passwort vergessen ?</a> ";
	echo  gettext('glob_passwort_lost');
	echo " </form></td></tr></table>";
}
?>
