<?php
require_once('Connections/HMS.php');
mysql_select_db($database_HMS, $HMS);
	$query_allergy = "SELECT * FROM patientallergy WHERE patientId = " . $_GET['patientId'];
	$allergy = mysql_query($query_allergy, $HMS) or die(mysql_error());
$row_allergy = mysql_fetch_assoc($allergy);
$totalRows_allergy = mysql_num_rows($allergy);
	
	 ?>
	<table border="1" cellspacing="50" cellpadding="10" bordercolor="#D6D6D6"  class="ui-widget" id="users-contain">
        <thead>
            <tr class="ui-widget-header ">
               
    <th class="table-header-repeat line-left"><a href="">Type</a></th>
    <th class="table-header-repeat line-left"><a href="">Allergy</a></th>
    <th class="table-header-repeat line-left"><a href="">Comments</a></th>
   
            </tr>
        </thead>
        <tbody>
            <tr><?php
  $even=1;
   do {
    if($even == 1)
	{
		echo '<tr>';
		$even=0;
	}
	else
	{
		echo '<tr class="alternate-row">';
		$even=1;
	}
    ?>
                
      <td><?php echo $row_allergy['type']; ?></td>
      <td><?php echo $row_allergy['allergy']; ?></td>
      <td><?php echo $row_allergy['comments']; ?></td>
            </tr>
        </tbody>
        <?php } while ($row_allergy = mysql_fetch_assoc($allergy)); ?>
    </table>
	