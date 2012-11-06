<?php
require_once('Connections/HMS.php');
mysql_select_db($database_HMS, $HMS);
	$query_medicalHId = "SELECT * FROM medicalhistory WHERE patientId = " . $_GET['patientId'];
	$medicalHId  = mysql_query($query_medicalHId, $HMS) or die(mysql_error());
	$row_medicalHId = mysql_fetch_assoc($medicalHId);
	$totalRows_medicalHId = mysql_num_rows($medicalHId);
	
	 ?>
	<table border="1" cellspacing="50" cellpadding="10" bordercolor="#D6D6D6"  class="ui-widget" id="users-contain">
        <thead>
            <tr class="ui-widget-header ">
               
    <th class="table-header-repeat line-left"><a href="">AilmentId</a></th>
    <th class="table-header-repeat line-left"><a href="">DiagnosisDate</a></th>
    <th class="table-header-repeat line-left"><a href="">Symptoms</a></th>
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
                
      <td><?php echo $row_medicalHId['ailmentId']; ?></td>
      <td><?php echo $row_medicalHId['diagnosisDate']; ?></td>
      <td><?php echo $row_medicalHId['symptoms']; ?></td>
      <td><?php echo $row_medicalHId['comments']; ?></td>
            </tr>
        </tbody>
        <?php } while ($row_medicalHId = mysql_fetch_assoc($medicalHId)); ?>
    </table>
	