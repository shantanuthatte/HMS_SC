<?php require_once('Connections/HMS.php'); ?>
<?php
	mysql_select_db($database_HMS, $HMS);
$query_personRS = "SELECT * FROM person";
$personRS = mysql_query($query_personRS, $HMS) or die(mysql_error());
$row_personRS = mysql_fetch_assoc($personRS);
$totalRows_personRS = mysql_num_rows($personRS);

$data = array();
while( $row_personRS = mysql_fetch_assoc($personRS) )
	{
		$data[] = array(
			'value' => $row_personRS['fName']
		);
	}
echo $data;
flush();

 ?>