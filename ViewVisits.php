<?php require_once('Connections/HMS.php'); ?>
<?php
include 'header.php';
  
if(!isset($_POST['personId'])) 
{
	echo "Error! Unexpected flow of navigation! Redirecting you back to the main page...";
	header('Location:ViewPerson.php');
}
else
{
	$personId = $_POST['personId'];
}

//get paging details
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

//end paging details

mysql_select_db($database_HMS, $HMS);
$query_person = "SELECT * FROM person WHERE personId = '$personId';";
$person = mysql_query($query_person, $HMS) or die(mysql_error());
$row_person = mysql_fetch_assoc($person);
$totalRows_person = mysql_num_rows($person);

mysql_select_db($database_HMS, $HMS);
$query_users = "SELECT userId FROM users WHERE personId = '$personId';";
$users = mysql_query($query_users, $HMS) or die(mysql_error());
$row_users = mysql_fetch_assoc($users);
$totalRows_users = mysql_num_rows($users);

$userId = $row_users['userId'];

//fetch row count and start calculations
mysql_select_db($database_HMS, $HMS);
$total_rows = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM visit WHERE patientId ='".$userId."';"),0);
$total_pages = ceil($total_rows / $rows);
$prev = $page-1; //previous page
$next = $page+1; //next page

$from = (($page * $rows) - $rows);
//end row calculations

mysql_select_db($database_HMS, $HMS);
$query_visits = 
"SELECT V.visitId AS visitId, V.visitNo AS visitNo, V.visitDate AS visitDate, C.userName AS consultingName, R.userName AS referringName
FROM visit AS V
LEFT JOIN users AS C ON C.userId = V.consultingDoctorId
LEFT JOIN users AS R ON R.userId = V.referringDoctorId
WHERE V.patientId =  '$userId'
ORDER BY V.visitNo DESC  
LIMIT $from,$rows;";
$visits = mysql_query($query_visits, $HMS) or die(mysql_error());
$row_visits = mysql_fetch_assoc($visits);
$totalRows_visits = mysql_num_rows($visits);

?>
<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="/resources/demos/external/jquery.bgiframe-2.1.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
	$( "#dialog-form" ).dialog({
            autoOpen: false,
            height: "auto",
            width: "auto",
			maxWidth:700,
            modal: true,
			resizable: false,
			show: "slow"
        });
	});

function show_examination(id) 
{
	$.ajax({
		url: "AjaxVisit.php",
		data: "action=examinationDetails&visitId="+id,
		success: function(data) {
			$('#dialog-form').html(data);
			$( "#dialog-form" ).dialog( "option", "title", "Examination" );
			$("#dialog-form").dialog("open");
		}
	});
}
				
function show_prescription(id) 
{
	$.ajax({
		url: "AjaxVisit.php",
		data: "action=prescriptionDetails&visitId="+id,
		success: function(data) {
			$('#dialog-form').html(data);
			$( "#dialog-form" ).dialog( "option", "title", "Prescription" );
			$("#dialog-form").dialog("open");
		}
	});
}
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
		.head { background-color:#97B82F;}
		.alt {background-color:#EEFFDD;}
</style>
    
	<script type="text/javascript">
       	function add_visit(Id)
       	{
           	document.getElementById("userId").value=Id;
			document.forms["visit_form"].submit();
       	}
		
		function populate(event) 
		{
			var number = this.options[this.selectedIndex].text;
			document.getElementById("personId").value="'.$personId.'";
			$("#page_form").attr("action","ViewVisits.php?rows="+number+"&page=1");
			document.forms["page_form"].submit();
		}
		
		function page_direct(row,page)
		{
			document.getElementById("personId").value="'.$personId.'";
			$("#page_form").attr("action","ViewVisits.php?rows="+row+"&page="+page);
			document.forms["page_form"].submit(); 
		}
   </script>

<div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading"><h1>Visits</h1></div>
<div style="float:right; margin-right:50px;"><a onClick="add_visit(<?php echo $userId ?>);"><img src="images/add.png" /></a></div>
<div style="float:right;"><a onClick="add_visit(<?php echo $userId ?>);"><h3>  Add New</h3></a></div>

<!-- start content table -->
<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
<tr>
	<th rowspan="3" class="sized"><img src="images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
	<th class="topleft"></th>
	<td colspan="2" id="tbl-border-top">&nbsp;</td>
	<th class="topright"></th>
	<th rowspan="3" class="sized"><img src="images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
</tr>
<tr>
	<td id="tbl-border-left"></td>
	<td valign="top">
	<!--  start content-table-inner -->
	<div id="content-table-inner">
	
    <!--  start table-content  -->
    <div id="table-content">

<form id="page_form" method="post">
<input id="personId" name="personId" value="" type="hidden" />
</form>

<form id="visit_form" action="AddVisit.php" method="post">
<input id="userId" name="userId" value="" type="hidden" />
<input id="formAction" name="formAction" value="insert" type="hidden" />
</form>

<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
  <tr>   
    <th class="table-header-repeat line-left"><a href="">Visit No</a></th>
    <th class="table-header-repeat line-left"><a href="">Date</a></th>
    <th class="table-header-repeat line-left"><a href="">Consulting Doctor</a></th>
    <th class="table-header-repeat line-left"><a href="">Referring Doctor</a></th>
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
      <td><?php echo $row_visits['visitNo']; ?></td>
      <td><?php echo $row_visits['visitDate']; ?></td>
      <td><?php echo $row_visits['consultingName']; ?></td>
      <td><?php echo $row_visits['referringName']; ?></td>
      <td class="options-width">
			<a title="Edit" onclick="update_submit(<?php echo $userId;?>)" class="icon-1 info-tooltip"></a>
			<a title="Delete" onclick="delete_confirm(<?php echo $userId;?>);" class="icon-2 info-tooltip"></a>
			<a title="Examination" id="pop_examination" onclick="show_examination(<?php echo $row_visits['visitId'];?>)" class="icon-3 info-tooltip"></a>
			<a title="Prescription" id="pop_prescription" onclick="show_prescription(<?php echo $row_visits['visitId'];?>);" class="icon-3 info-tooltip"></a>
      </td>
    </tr>
    <?php } while ($row_visits = mysql_fetch_assoc($visits)); ?>
    <tr style="border:none">
    <td style="border:none" colspan="5">
		<!-- start paging -->
		<table border="0" cellpadding="0" cellspacing="0" id="paging-table">
			<tr style="border:none">
            <td style="border:none">Rows  </td>
			<td style="border:none">
			<select name="rows" id="rows" onchange="populate.call(this, event)">
				<option <?php if($rows == 10) echo "SELECTED"; ?> value="10">10</option>
				<option <?php if($rows == 20) echo "SELECTED"; ?> value="20">20</option>
				<option <?php if($rows == 30) echo "SELECTED"; ?> value="30">30</option>
			</select>
            
			</td>
			<td style="border:none">
				<a onclick="page_direct(<?php echo $rows; ?>,1)" class="page-far-left"></a>
				<a onclick="page_direct(<?php echo $rows; ?>,<?php if($prev>0) echo $prev; else echo 1; ?>)" class="page-left"></a>
				<div id="page-info">Page <strong><?php echo $page; ?></strong> / <?php echo $total_pages; ?></div>
				<a onclick="page_direct(<?php echo $rows; ?>,<?php if($next<=$total_pages) echo $next; else echo 1; ?>)" class="page-right"></a>
				<a onclick="page_direct(<?php echo $rows; ?>,<?php if($total_pages>1) echo $total_pages; else echo 1; ?>)" class="page-far-right"></a>
			</td>
			</tr>
		</table>
		<!-- end paging -->
    </td>
    </tr>
</table>
</div>
<!-- end table content -->    
    </div>
<!--  end content-table-inner  -->
</td>

<td width="271">

<!--  start related-act-bar -->
	<div id="related-activities">
		
		<!--  start related-act-top -->
		<div id="related-act-top">
		<img src="images/forms/header_related_act.gif" width="271" height="43" alt="" />
		</div>
		<!-- end related-act-top -->
		
		<!--  start related-act-bottom -->
		<div id="related-act-bottom">
		
			<!--  start related-act-inner -->
			<div id="related-act-inner">
			
				<div class="left"><a href=""><img src="images/forms/icon_edit.gif" width="21" height="21" alt="" /></a></div>
				<div class="right">
					<h5 style="font-size:14px; color:#92b22c">Personal Details</h5>
                    <table cellpadding="5">
                    <tr>
                    <th align="left"> Name:  </th>
						<td><a href=""><?php echo $row_person['fName']." ".$row_person['mName']." ".$row_person['lName']; ?></a></td>
                    </tr>
                    <tr>
                    <th align="left"> Registry No:  </th>
						<td><a href=""><?php echo $row_person['registrationNo']; ?></a></td>
                    </tr>
                    <tr>
                    <th align="left"> Gender:  </th>
						<td><a href=""><?php echo $row_person['gender']; ?></a></td>
                    </tr>
                    <tr>
                    <th align="left"> DOB:  </th>
						<td><a href=""><?php echo $row_person['DOB']; ?></a></td>
                    </tr>
                    <tr>
                    <th align="left"> M Status:  </th>
						<td><a href=""><?php echo $row_person['maritalStatus']; ?></a></td>
                    </tr>
                    <tr>
                    <th align="left"> Occupation:  </th>
						<td><a href=""><?php echo $row_person['occupation']; ?></a></td>
                    </tr>
                    <tr>
                    <th align="left">Blood Group:  </th>
						<td><a href=""><?php echo $row_person['bloodGroup']; ?></a></td>
                    </tr>
                    </table>   
				</div>
				
				<div class="clear"></div>
				<div class="lines-dotted-short"></div>
				
				<div class="left"><a href=""><img src="images/forms/icon_edit.gif" width="21" height="21" alt="" /></a></div>
				<div class="right">
					<h5 style="font-size:14px; color:#92b22c">Contact Details</h5>
					<table cellpadding="5">
                    <tr>
                    <th align="left"> Address:  </th>
						<td><a href=""><?php echo $row_person['address1']; ?></a></td>
                    </tr>
                    <tr>
                    <th align="left"> Area:  </th>
						<td><a href=""><?php echo $row_person['address2']; ?></a></td>
                    </tr>
                    <tr>
                    <th align="left"> City:  </th>
						<td><a href=""><?php echo $row_person['city']; ?></a></td>
                    </tr>
                    <tr>
                    <th align="left"> State:  </th>
						<td><a href=""><?php echo $row_person['state']; ?></a></td>
                    </tr>
                    <tr>
                    <th align="left"> PIN Code:  </th>
						<td><a href=""><?php echo $row_person['pin']; ?></a></td>
                    </tr>
                    <tr>
                    <th align="left"> Residence:  </th>
						<td><a href=""><?php echo $row_person['rPhone']; ?></a></td>
                    </tr>
                    <tr>
                    <th align="left">Mobile:  </th>
						<td><a href=""><?php echo $row_person['mobile']; ?></a></td>
                    </tr>
                    <tr>
                    <th align="left">Email:  </th>
						<td><a href=""><?php echo $row_person['email']; ?></a></td>
                    </tr>
                    </table>    
				</div>
				<div class="clear"></div>
				
			</div>
			<!-- end related-act-inner -->
			<div class="clear"></div>
		
		</div>
		<!-- end related-act-bottom -->
	
	</div>
	<!-- end related-activities -->

</td>

<td id="tbl-border-right"></td>
</tr>
<tr>
	<th class="sized bottomleft"></th>
	<td colspan="2" id="tbl-border-bottom"></td>
	<th class="sized bottomright"></th>
</tr>
</table>
</div>
<!--  end content -->

<!-- popup div-->
<div id="dialog-form" name="dialog-form">
       
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
mysql_free_result($users);
mysql_free_result($visits);
mysql_free_result($person);
?>
