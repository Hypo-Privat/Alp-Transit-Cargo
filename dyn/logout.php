
<?php {
	
	echo "<table width='700' ><tr><td align='center'>";
	echo gettext('glob_hallo')  ;
	echo " {$_SESSION['FIRSTNAME']} {$_SESSION['LASTNAME']} ";
	echo "<A href='index.php'>"  .gettext('glob_logout') ;
	echo "</td></tr></table>"; 
	
}
?>
