<?php
require_once('Connections/HMS.php');
mysql_select_db($database_HMS, $HMS);
if(isset($_GET['param']))
	if($_GET['param'] == "xyz")
	{	
	$query_Recordset1 = "SELECT * FROM person WHERE fName LIKE '".mysql_real_escape_string($_GET['fname'])."'";
	$Recordset1 = mysql_query($query_Recordset1, $HMS) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($Recordset1);
	$totalRows_Recordset1 = mysql_num_rows($Recordset1);
	$even=1;
	
	echo <<<'EOT'
	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
    <tr>
					<th class="table-header-check"><a id="toggle-all" ></a> </th>
					<th class="table-header-repeat line-left"><a href="">First Name</a></th>
					<th class="table-header-repeat line-left"><a href="">Middle Name</a></th>
                    <th class="table-header-repeat line-left"><a href="">Last Name</a></th>
					<th class="table-header-repeat line-left"><a href="">Gender</a></th>
					<th class="table-header-repeat line-left"><a href="">DOB</a></th>
					<th class="table-header-repeat line-left"><a href="">Mobile</a></th>
					<th class="table-header-options line-left"><a href="">Options</a></th>
	</tr>
EOT;
	
	do
	{
		$fName = $row_Recordset1['fName'];
		$mName = $row_Recordset1['mName'];
		$lName = $row_Recordset1['lName'];
		$gender = $row_Recordset1['gender'];
		$DOB = $row_Recordset1['DOB'];
		$mobile = $row_Recordset1['mobile'];

		if($even == 1)
		{
			echo'<tr>';
		}
		else
		{
			echo'<tr class="alternate-row">';
		}
		echo <<<EOT
			<td><input  type="checkbox"/></td>
			<td>$fName</td>
			<td>$mName</td>
			<td>$lName</td>
			<td>$gender</td>
			<td>$DOB</td>
			<td>$mobile</td>
			<td class="options-width">
			<a href="" title="Edit" class="icon-1 info-tooltip"></a>
			<a href="" title="Edit" class="icon-2 info-tooltip"></a>
			</td>
			</tr>
EOT;
		if($even == 1)
			$even = 0;
		elseif($even == 0)
			$even = 1;
	}while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
	echo '</table>';
}
?>