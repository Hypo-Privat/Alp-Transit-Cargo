
<?php {
	

echo "<a class='col1' href='cal_menue.php?go=tclacontacts&dir=cal_script&func=login_err'> Passwort vergessen ?</a> <br>";
echo "Orchester Login  " ;	
	echo "<TABLE  width='600' align='center'>";
	echo "<FORM action='cal_menue.php?go=tclacontacts&dir=cal_script&func=user_login_check' method='post'> ";
	echo "<input id='EMAILADDRESS' style='height: 18px' maxlength='64' size='10' name='EMAILADDRESS'> ";
	echo  'E-Mail';
	echo "	<input id='PWD' type='password' style='height: 18px' maxlength='30' size='10' name='PWD'> ";
	echo  'Passwort';
	echo "	<input type='submit' 'height: 20px'  value='absenden'> " ;
	
	echo " </form></td></tr></table>";
}
?>


