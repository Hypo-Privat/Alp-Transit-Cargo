<?php function dbconnect($verbose) {

	$dbname = 'SAMPLE';
	$username = 'db2inst1';
	$password = 'db2admin';
	// db2_connect returns 0 if the connection attempt fails
	// otherwise it returns a connection ID used by other functions
	$pconn = db2_pconnect($dbname, $username, $password);
	if ($pconn) {
		//echo "Persistent connection succeeded.";
	}
	else {
		$SQLState = db2_conn_error();
		echo("<B>Persistent Connection to Sample failed.</B><BR>$SQLState<BR>");
		$sql = db2_conn_errormsg();
		get_db2_conn_errormsg($sql);
		//printf("%s\n", $sql);
	}
	return($pconn);
}
?>
