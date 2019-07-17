<?php

function get_slothead() {
	$so = gettext ( 'glob_tag_so' );
	$mo = gettext ( 'glob_tag_mo' );
	$di = gettext ( 'glob_tag_di' );
	$mi = gettext ( 'glob_tag_mi' );
	$do = gettext ( 'glob_tag_do' );
	$fr = gettext ( 'glob_tag_fr' );
	$sa = gettext ( 'glob_tag_sa' );
	$wo = gettext ( 'glob_woche' );
	$tg = gettext ( 'glob_tag' );
	$std = gettext ( 'glob_stunde' );
	$land = gettext ( 'glob_land' );
	$route = gettext ( 'glob_route' );
	$pr = gettext ( 'glob_preis' );
	$anz = gettext ( 'glob_anzahl' );
	
	$ya = date ( "Y" );
	$ma = date ( "m" );
	$da = date ( "d" );
	
	if (empty ( $_POST ['1_yy'] )) {
		$_POST ['1_yy'] = $ya;
	}
	if (empty ( $_POST ['1_mm'] )) {
		$_POST ['1_mm'] = $ma;
	}
	if (empty ( $_POST ['1_dd'] )) {
		$_POST ['1_dd'] = $da;
	}
	$_POST ['SLOTDATE'] = ("{$_POST['1_yy']}-{$_POST['1_mm']}-{$_POST['1_dd']}");
	
	// print_r($_POST);
	
	$sql = "SELECT DISTINCT ''  ,'$wo ' , WEEK(date('{$_POST['SLOTDATE']}')) ,  '' {$_SESSION['SCEMA']}FROM TUMZUG";
	IF ($_SESSION ['DB'] == 'MY') {
		get_MY_connect ( $sql );
		$result = mysqli_query ( $_SESSION ['CONNECT'] ,  $sql );
		if (! $result) {
			echo $sql;
			die ( 'Ungueltige Abfrage Transit line1 : ' . db2_conn_errormsg () );
		}
	} else {
		get_DB2_connect ( $sql );
		
		if (! $result) {
			echo $sql;
			die ( 'Ungueltige Abfrage Transit line1 : ' . db2_conn_errormsg () );
		}
	}
	
	// Ausgabe line1
	// Format ausgabe table
	$vo = "<b><td class='head' nowrap align='center' valign='middle'>";
	$hi = "</td></b>";
	
	// echo 'week slothead- '.$sql ;
	while ( $row = $_SESSION ['FETCH'] ( $result ) ) {
		echo "$vo $row[0] $hi";
		echo "$vo $row[1] $hi";
		echo "$vo $row[2] $hi";
	}
	// ausgabe tagesdatum
	$anz = 0;
	$max = 8;
	$day = 0;
	
	while ( $day < $max ) {
		
		IF ($_SESSION ['DB'] == 'MY') {
			$sql = "	SELECT distinct
						CASE when DAYOFWEEK(DATE_ADD( '{$_POST['SLOTDATE']}', INTERVAL $day day )) =  2 THEN '$mo'
			 		 	WHEN DAYOFWEEK(DATE_ADD( '{$_POST['SLOTDATE']}', INTERVAL $day day )) =  3 then '$di'
					  	WHEN DAYOFWEEK(DATE_ADD( '{$_POST['SLOTDATE']}', INTERVAL $day day )) =  4 then '$mi'
					  	WHEN DAYOFWEEK(DATE_ADD( '{$_POST['SLOTDATE']}', INTERVAL $day day )) =  5 then '$do'
			 			WHEN DAYOFWEEK(DATE_ADD( '{$_POST['SLOTDATE']}', INTERVAL $day day )) =  6 then '$fr'	
						end			
						, DAYOFWEEK(DATE_ADD( '{$_POST['SLOTDATE']}', INTERVAL $day day ))   as dayoweek
		   			    FROM {$_SESSION['SCEMA']}TUMZUG";
			get_MY_connect ( $sql );
			$result = mysqli_query ( $_SESSION ['CONNECT'],  $sql );
			if (! $result) {
				echo $sql;
				die ( 'Ungueltige Abfrage Transit line1 : ' . db2_conn_errormsg () );
			}
		} else {
			$sql = "	SELECT distinct
						CASE when DAYOFWEEK(date('{$_POST['SLOTDATE']}') + $day day) =  2 THEN '$mo'
			 		 	WHEN DAYOFWEEK(date('{$_POST['SLOTDATE']}') + $day day) =  3 then '$di'
					  	WHEN DAYOFWEEK(date('{$_POST['SLOTDATE']}') + $day day) =  4 then '$mi'
					  	WHEN DAYOFWEEK(date('{$_POST['SLOTDATE']}') + $day day) =  5 then '$do'
			 			WHEN DAYOFWEEK(date('{$_POST['SLOTDATE']}') + $day day) =  6 then '$fr'	
						end			
						, DAYOFWEEK(date('{$_POST['SLOTDATE']}') + $day day)  as dayoweek
		   			    FROM {$_SESSION['SCEMA']}TUMZUG";
			get_DB2_connect ( $sql );
			if (! $result) {
				echo $sql;
				die ( 'Ungueltige Abfrage Transit line1 : ' . db2_conn_errormsg () );
			}
		}
		
		// echo 'dayofweek - '.$sql ;
		while ( $row = $_SESSION ['FETCH'] ( $result ) ) {
			// echo "$vo $row[0] $hi";
			if (in_array ( $row [1], range ( 2, 6 ) )) {
				echo "$vo $row[0] $hi";
			}
		}
		$day ++;
	}
	echo "</tr>";
	// generieren
	
	echo "$vo $land $hi";
	echo "$vo $route $hi";
	echo "$vo  Anz/$pr $hi"; // $anz/$pr
	                         
	// ausgabe tagesdatum
	$anz = 0;
	$max = 8;
	$day = 0;
	
	while ( $day < $max ) {
		
		IF ($_SESSION ['DB'] == 'MY') {
			$sql = "	SELECT distinct
						 case WHEN DAYOFWEEK(DATE_ADD( '{$_POST['SLOTDATE']}', INTERVAL $day day ))  > 1
			 			  and  DAYOFWEEK(DATE_ADD( '{$_POST['SLOTDATE']}', INTERVAL $day day ))  <= 6
								then	date(DATE_ADD( '{$_POST['SLOTDATE']}', INTERVAL $day day ))
		          		 end
						, DAYOFWEEK(DATE_ADD( '{$_POST['SLOTDATE']}', INTERVAL $day day ))  as dayoweek
		   				 FROM {$_SESSION['SCEMA']}TUMZUG";
			get_MY_connect ( $sql );
			$result = mysqli_query ($_SESSION ['CONNECT'], $sql );
			if (! $result) {
				echo $sql;
				die ( 'Ungueltige Abfrage Transit line2 : ' . db2_conn_errormsg () );
			}
		} else {
			$sql = "	SELECT distinct
						 case WHEN DAYOFWEEK(date('{$_POST['SLOTDATE']}')+ $day day )  > 1
			 			  and  DAYOFWEEK(date('{$_POST['SLOTDATE']}')+ $day day )  <= 6
								then	date('{$_POST['SLOTDATE']}') + $day day
		          		 end
						, DAYOFWEEK(date('{$_POST['SLOTDATE']}') + $day day)  as dayoweek
		   				 FROM {$_SESSION['SCEMA']}TUMZUG";
			get_DB2_connect ( $sql );
			if (! $result) {
				echo $sql;
				die ( 'Ungueltige Abfrage Transit line2 : ' . db2_conn_errormsg () );
			}
		}
		
		// echo 'tagesdatum line2 - '.$sql ;
		while ( $row = $_SESSION ['FETCH'] ( $result ) ) {
			if (in_array ( $row [1], range ( 2, 6 ) )) {
				echo "$vo $row[0] $hi";
			}
		}
		$day ++;
	}
	echo "</tr> ";
	
	get_route ();
}
function get_route() {
	// include ("../includes/connATC.inc");
	$sql = " Select DISTINCT l_iso_cd, transit_route, concat(von, ' --> ' , nach),
			slot_cost, value , route_nr, quantity	from {$_SESSION['SCEMA']}TREFSLOTCOST order by 1, 2  ";
	
	IF ($_SESSION ['DB'] == 'MY') {
		get_MY_connect ( $sql );
		$result = mysqli_query ($_SESSION ['CONNECT'], $sql );
		if (! $result) {
			echo $sql;
			get_db2_conn_errormsg ( $sql );
		}
	} else {
		get_DB2_connect ( $sql );
		if (! $result) {
			echo $sql;
			get_db2_conn_errormsg ( $sql );
		}
	}
	
	// Ausgabe line1
	// Format ausgabe table
	$vo = "<td class='gray'	nowrap align='left' valign='middle'>";
	$hi = "</td>";
	
	// echo 'get_route - '.$sql ;
	while ( $row = $_SESSION ['FETCH'] ( $result ) ) {
		echo "<tr>";
		echo "$vo $row[0] $hi";
		echo "$vo $row[1] $hi";
		echo "$vo $row[2] $hi";
		$slot_cost = $row [3];
		$value = $row [4];
		$route_nr = $row [5];
		$quantity = $row [6];
		get_slotday ( $slot_cost, $value, $route_nr, $quantity );
		echo "</tr>";
	} // while
}
function get_slotday($slot_cost, $value, $route_nr, $quantity) {
	
	// Format ausgabe table
	
	// $vo = "<td class='typ1'>";
	// $hi = "</td>";
	
	// rot ff0033 gruen 66ff66 <a href="javascript:show('datei.htm')">Verweis</a>
	// $link_sort = "<a href='output.php?go=toursuchen_data.inc&dir=includes&func=such_list&value=".$suche;
	$link_open = "<td align='center' class='blue'>
	<A href=\"javascript:show('output.php?go=trans_buy.php&dir=dyn&func=outp";
	
	// $link_open = "<td align='center' bgcolor='#66ff66'> <A href=\"javascript:show('../dyn/trans_buy.php";
	$linkend = "</a></font></td>";
	$link_closed = "<td align='center' class='red'> ";
	$linkend_closed = "</font></td>";
	
	// ausgabe pro tag
	$anz = 0;
	$max = 8;
	$day = 0;
	
	while ( $day < $max ) {
		
		IF ($_SESSION ['DB'] == 'MY') {
			$sql = "
			SELECT distinct
						 case WHEN DAYOFWEEK(DATE_ADD( '{$_POST['SLOTDATE']}', INTERVAL $day day ))  > 1
			 			  and  DAYOFWEEK(DATE_ADD( '{$_POST['SLOTDATE']}', INTERVAL $day day )) <= 6
								then	$anz + ($quantity - sold.anz)
		          		 end
						, DAYOFWEEK(DATE_ADD( '{$_POST['SLOTDATE']}', INTERVAL $day day ))  as dayoweek
		                , date(DATE_ADD( '{$_POST['SLOTDATE']}', INTERVAL $day day ))  as sldate
		   	FROM 	{$_SESSION['SCEMA']}TREFSLOTCOST  a
			left join
			(select DISTINCT
		           count(*) as anz
		         , slot_date
		         , route_nr
		         from  {$_SESSION['SCEMA']}TSLOTSOLD
		     where route_nr = $route_nr
		     and   (slot_date = date(DATE_ADD( '{$_POST['SLOTDATE']}', INTERVAL $day day ))
		     or indexkey = '1')
		     group by
		               slot_date
		             ,route_nr
			) sold
			 on  a.route_nr = sold.route_nr	
			 and  sold.slot_date = date(DATE_ADD( '{$_POST['SLOTDATE']}', INTERVAL $day day ))
			 where a.route_nr = $route_nr
		     and   slot_type = 'TG'
			";
			get_MY_connect ( $sql );
			$result = mysqli_query ($_SESSION ['CONNECT'], $sql );
			if (! $result) {
				echo $sql;
				get_db2_conn_errormsg ( $sql );
			}
		} else {
			$sql = "
			SELECT distinct
						 case WHEN DAYOFWEEK(date('{$_POST['SLOTDATE']}')+ $day day )  > 1
			 			  and  DAYOFWEEK(date('{$_POST['SLOTDATE']}')+ $day day )  <= 6
								then	$anz + ($quantity - sold.anz)
		          		 end
						, DAYOFWEEK(date('{$_POST['SLOTDATE']}') + $day day)  as dayoweek
		                , date('{$_POST['SLOTDATE']}') + $day day  as sldate
		   	FROM 	{$_SESSION['SCEMA']}TREFSLOTCOST  a
			left join
			(select
		           count(*) as anz
		         , slot_date
		         , route_nr
		         from  {$_SESSION['SCEMA']}TSLOTOLD
		     where route_nr = $route_nr
		     and   slot_date = date('{$_POST['SLOTDATE']}') + $day day
		     or indexkey = '1'
		     group by
		               slot_date
		             ,route_nr
			) sold
			 on  a.route_nr = sold.route_nr	
			 and  sold.slot_date = date('{$_POST['SLOTDATE']}') + $day day
			 where a.route_nr = $route_nr
		     and   slot_type = 'TG'
			";
			get_DB2_connect ( $sql );
			if (! $result) {
				echo $sql;
				get_db2_conn_errormsg ( $sql );
			}
		}
		
		// echo 'get_slotday - '.$sql ;
		while ( $row = $_SESSION ['FETCH'] ( $result ) ) {
			$sldate = '';
			$sldate = $row [2];
			$slroute = 1;
			$sltime = 5;
			// $werte = "?sldatum='$sldate'?slroute='$slroute'?sltime='$sltime'";
			
			if (in_array ( $row [1], range ( 2, 6 ) )) {
				$formslday = "&value=$row[2]21$route_nr')\"><font color='#FFFFFF'>";
				
				// zuweisen der variabelen
				if (empty ( $row [0] )) {
					echo "$link_open$formslday$slot_cost � $linkend ";
				} else {
					if ($row [0] == 0) {
						echo "$link_closed$formslday$row[0]/$slot_cost � $linkend_closed  ";
					} else {
						echo "$link_open$formslday$row[0]/$slot_cost � $linkend  ";
					}
				}
				;
			}
		} // while slot
		$day ++;
	} // while max days
}
?>


