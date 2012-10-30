<?php require_once('Connections/HMS.php'); ?>
<?php
include 'header.php';
echo '<script type="text/javascript">
       function delete_confirm(medicalHisId)
       {
           if(confirm("Are you sure you want to delete?")==true)
           {
				document.getElementById("medicalHisId_delete").value=medicalHisId;
				document.forms["delete_form"].submit();
		   }
       }
	   function update_submit(medicalHisId)
	   {
		  	document.getElementById("medicalHisId_update").value=medicalHisId;
			document.forms["update_form"].submit();  
	   }
	   function display_medical(Id)
	   {
			document.getElementById("medicalHisId_display").value=Id;
			document.forms["medical_form"].submit();
		}
   </script>';  
    
mysql_select_db($database_HMS, $HMS);
$query_medicalHId = "SELECT * FROM medicalhistory";
$medicalHId = mysql_query($query_medicalHId, $HMS) or die(mysql_error());
$row_medicalHId = mysql_fetch_assoc($medicalHId);
$totalRows_medicalHId = mysql_num_rows($medicalHId);
?>
<div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading"><h1>Medical History</h1></div>

<!-- start content table -->
<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
<tr>
<a href="AddMedicalHistory.php">Add Medical History</a>
</tr>
<tr>
	<th rowspan="3" class="sized"><img src="images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
	<th class="topleft"></th>
	<td id="tbl-border-top">&nbsp;</td>
	<th class="topright"></th>
	<th rowspan="3" class="sized"><img src="images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
</tr>
<tr>
	<td id="tbl-border-left"></td>
	<td>
	<!--  start content-table-inner -->
	<div id="content-table-inner">
	
    <!--  start table-content  -->
    <div id="table-content">

<form id="delete_form" action="cntrl_MedicalHistory.php" method="post">
<input id="medicalHisId_delete" name="medicalHisId" value="" type="hidden" />
<input id="formAction" name="formAction" value="delete" type="hidden" />
</form>

<form id="update_form" action="cntrl_MedicalHistory.php" method="post">
<input id="medicalHisId_update" name="medicalHisId" value="" type="hidden" />
<input id="formAction" name="formAction" value="update" type="hidden" />
</form>

<form id="medical_form" action="ViewMedicalHistory.php" method="post">
<input id="medicalHisId_user" name="medicalHisId" value="" type="hidden" />
</form>

<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
  <tr>
    <th class="table-header-repeat line-left"><a href="">PatientId</a></th>
    <th class="table-header-repeat line-left"><a href="">AilmentId</a></th>
    <th class="table-header-repeat line-left"><a href="">DiagnosisDate</a></th>
    <th class="table-header-repeat line-left"><a href="">Symptoms</a></th>
    <th class="table-header-repeat line-left"><a href="">Comments</a></th>
    <th class="table-header-repeat line-left"><a href="">Options</a></th>
  </tr>
  <?php
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
      <td><?php echo $row_medicalHId['patientId']; ?></td>
      <td><?php echo $row_medicalHId['ailmentId']; ?></td>
      <td><?php echo $row_medicalHId['diagnosisDate']; ?></td>
      <td><?php echo $row_medicalHId['symptoms']; ?></td>
      <td><?php echo $row_medicalHId['comments']; ?></td>
      <td class="options-width">
			<a title="Edit" onclick="update_submit(<?php echo $row_medicalHId['medicalHisId'];?>)" class="icon-1 info-tooltip"></a>
			<a title="Delete" onclick="delete_confirm(<?php echo $row_medicalHId['medicalHisId'];?>);" class="icon-2 info-tooltip"></a>
            
      </td>
    </tr>
    <?php } while ($row_medicalHId = mysql_fetch_assoc($medicalHId)); ?>
</table>


	</div>
<!-- end table content -->    
    </div>
<!--  end content-table-inner  -->
</td>
<td id="tbl-border-right"></td>
</tr>
<tr>
	<th class="sized bottomleft"></th>
	<td id="tbl-border-bottom">&nbsp;</td>
	<th class="sized bottomright"></th>
</tr>
</table>
</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer........................................................END -->

<div class="clear">&nbsp;</div>
    
<!-- start footer -->         
<div id="footer">
	<!--  start footer-left -->
	<div id="footer-left">
	
	Admin Skin &copy; Copyright Internet Dreams Ltd. <span id="spanYear"></span> <a href="">www.netdreams.co.uk</a>. All rights reserved.</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
 
</body>
</html>
<?php
mysql_free_result($medicalHId);
?>