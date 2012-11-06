<?php require_once('Connections/HMS.php'); ?>
<?php
include 'header.php';
if(!isset($_GET['page']))
{
	$page=1;
}
else
{
	$page=$_GET['page'];
}
if(!isset($_GET['rows']))
{
	$rows = 10;
} else 
{
	$rows = $_GET['rows'];
}	
mysql_select_db($database_HMS, $HMS);
$total_rows = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM visit"),0);

$total_pages = ceil($total_rows / $rows);
$prev = $page-1; //previous page
$next = $page+1; //next page

$from = (($page * $rows) - $rows);

mysql_select_db($database_HMS,$HMS);
$query_visit="SELECT * from visit LIMIT $from,$rows";
$visit=mysql_query($query_visit,$HMS) or die (mysql_error());
$row_visit = mysql_fetch_assoc($visit);
$totalRows_visit = mysql_num_rows($visit);

mysql_select_db($database_HMS,$HMS);
$query_medicalHId = "SELECT * FROM medicalhistory";
$medicalHId = mysql_query($query_medicalHId, $HMS) or die(mysql_error());
$row_medicalHId = mysql_fetch_assoc($medicalHId);
$totalRows_medicalHId = mysql_num_rows($medicalHId);



echo '<script type="text/javascript">
       function delete_confirm(visitId)
       {
           if(confirm("Are you sure you want to delete ?")==true)
           {
				document.getElementById("visitId_delete").value=visitId;
				document.forms["delete_form"].submit();
		   }
       }
	   function update_submit(visitId)
	   {
		  	document.getElementById("visitId_update").value=visitId;
			document.forms["update_form"].submit();  
	   }
	  
		function populate(event) 
		{
			var number = this.options[this.selectedIndex].text;
			var url = "ViewVisit.php?rows="+number+"&page=1";
			window.location.href = url;
		}
   </script>'; 
?>


<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="/resources/demos/external/jquery.bgiframe-2.1.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
<script>
$(document).ready(function(e) {
$( "#dialog-form" ).dialog({
            autoOpen: false,
            height: 300,
            width: 350,
            modal: true,
            
            
        });
 
        $( "#medicalHistory" )
            .button()
            .click(function() {
                $( "#dialog-form" ).dialog( "open" );
            });
			$( "#patientHistory" )
            .button()
            .click(function() {
                $( "#dialog-form" ).dialog( "open" );
            });
});

function medicalAction(action) {
				// ASSIGN THE ACTION
				//var action = $('#patientId').val();
 				//alert("My First JavaScript" + action);
				//alert(action);
				
				$.ajax({
					
  					url: 'MedicalHistoryPopup.php?param=xyz&patientId='+action,
  					success: function(data) {
						
    				$('#dialog-form').html(data);
    				
  					}
				});}
				
				function patientAction(action) {
				// ASSIGN THE ACTION
				//var action = $('#patientId').val();
 				//alert("My First JavaScript" + action);
				//alert(action);
				
				$.ajax({
					
  					url: 'PatientHistoryPopup.php?param=xyz&patientId='+action,
  					success: function(data) {
						
    				$('#dialog-form').html(data);
    				
  					}
				});}
				
    </script>


<style>
        body { font-size: 62.5%; }
        label, input { display:block; }
        input.text { margin-bottom:12px; width:95%; padding: .4em; }
        fieldset { padding:0; border:0; margin-top:25px; }
        h1 { font-size: 1.2em; margin: .6em 0; }
        div#users-contain { width: 350px; margin: 20px 0; }
        div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
        div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
        .ui-dialog .ui-state-error { padding: .3em; }
        .validateTips { border: 1px solid transparent; padding: 0.3em; }
    </style>

<div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading"><h1>Visit</h1></div>

<!-- start content table -->
<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
<tr>
<a href="AddAilment.php">Add Visit</a>
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

<form id="delete_form" action="cntrl_Visit.php" method="post">
<input id="visitId_delete" name="visitId" value="" type="hidden" />
<input id="formAction" name="formAction" value="delete" type="hidden" />
</form>

<form id="update_form" action="cntrl_Visit.php" method="post">
<input id="visitId_update" name="visitId" value="" type="hidden" />
<input id="formAction" name="formAction" value="update" type="hidden" />
</form>

<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
  <tr>
    <th class="table-header-repeat line-left"><a href="">patientId</a></th>
    <th class="table-header-repeat line-left"><a href="">registrationId</a></th>
    <th class="table-header-repeat line-left"><a href="">consultingDoctorId</a></th>
    <th class="table-header-repeat line-left"><a href="">visitNo</a></th>
        <th class="table-header-repeat line-left"><a href="">visitDate</a></th>

    <th class="table-header-repeat line-left"><a href="">referringDoctorId</a></th>

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
      <td><?php echo $row_visit['patientId']; ?></td>
      <td><?php echo $row_visit['registrationId']; ?></td>
      <td><?php echo $row_visit['consultingDoctorId']; ?></td>
      <td><?php echo $row_visit['visitNo']; ?></td>
      <td><?php echo $row_visit['visitDate']; ?></td>
      <td><?php echo $row_visit['referringDoctorId']; ?></td>
      <td class="options-width">
			<a title="Edit" onclick="update_submit(<?php echo $row_visit['visitId'];?>)" class="icon-1 info-tooltip"></a>
			<a title="Delete" onclick="delete_confirm(<?php echo $row_visit['visitId'];?>);" class="icon-2 info-tooltip"></a>
 <a title="Medical History" id="medicalHistory" onclick="medicalAction(<?php echo $row_visit['patientId'];?>);"class="icon-2 info-tooltip"></a>           
      <a title="Patient History" id="patientHistory" onclick="patientAction(<?php echo $row_visit['patientId'];?>);"class="icon-2 info-tooltip"></a>    
            
      </td>
    </tr>
    <?php } while ($row_visit = mysql_fetch_assoc($visit)); ?>
</table>


	</div>
<!-- end table content -->   

<!--  start paging..................................................... -->

			<table border="0" cellpadding="0" cellspacing="0" id="paging-table">
			<tr>
            <td>Rows  </td>
			<td>
			<select name="rows" id="rows" onchange="populate.call(this, event)">
				<option <?php if($rows == 10) echo "SELECTED"; ?> value="10">10</option>
				<option <?php if($rows == 20) echo "SELECTED"; ?> value="20">20</option>
				<option <?php if($rows == 30) echo "SELECTED"; ?> value="30">30</option>
			</select>
            
			</td>
			<td>
				<a href="ViewVisit.php?rows=<?php echo $rows; ?>&page=1" class="page-far-left"></a>
				<a href="ViewVisit.php?rows=<?php echo $rows; ?>&page=<?php if($prev>0) echo $prev; else echo 1; ?>" class="page-left"></a>
				<div id="page-info">Page <strong><?php echo $page; ?></strong> / <?php echo $total_pages; ?></div>
				<a href="ViewVisit.php?rows=<?php echo $rows; ?>&page=<?php if($next>1) echo $next; else echo 1; ?>" class="page-right"></a>
				<a href="ViewVisit.php?rows=<?php echo $rows; ?>&page=<?php if($total_pages>1) echo $total_pages; else echo 1; ?>" class="page-far-right"></a>
			</td>
			</tr>
			</table>
<!--  end paging................ -->
 
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

<!-- popup div-->
<div id="dialog-form" name="dialog-form"title="Patient History">
       
</div>
<!-- end popup div-->


<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer........................................................END -->

<div class="clear">&nbsp;</div>
    
<!-- start footer -->         
<div id="footer">
	<!--  start footer-left -->
	<div id="footer-left">	
	Medical Soft &copy; Copyright Sharad Consultants <span id="spanYear"></span> <a href="">www.sharadconsultants.com</a>. All rights reserved.</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer --> 
</body>
</html>
<?php
mysql_free_result($visit);
?>   
   
   