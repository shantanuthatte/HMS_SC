<?php require_once('Connections/HMS.php'); ?>
<?php
include 'header.php';

// Getting current page number,if not assign page number as 1 
if(!isset($_GET['page'])){
    $page = 1;
} else {
    $page = $_GET['page'];
 }
 
// Define the number of rows per page 
if(!isset($_GET['rows'])){
	$rows = 10;
} else {
	$rows = $_GET['rows'];
}

mysql_select_db($database_HMS, $HMS);
$total_rows = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM patientallergy"),0);

// Getting the total number of pages. Always round up using ceil() 
$total_pages = ceil($total_rows / $rows);

$prev = $page-1; //previous page
$next = $page+1; //next page

/* Figure out the limit for the query based
 on the current page number.*/
$from = (($page * $rows) - $rows); 
    
mysql_select_db($database_HMS, $HMS);
$query_allergyId = "SELECT us.userName , pa.type , pa.allergy, pa.allergyId
FROM patientallergy pa
INNER JOIN users us ON us.userId=pa.patientId LIMIT $from,$rows";
$allergyId = mysql_query($query_allergyId, $HMS) or die(mysql_error());
$row_allergyId = mysql_fetch_assoc($allergyId);
$totalRows_allergyId = mysql_num_rows($allergyId);

echo '<script type="text/javascript">
       function delete_confirm(allergyId)
       {
           if(confirm("Are you sure you want to delete?")==true)
           {
				document.getElementById("allergyId_delete").value=allergyId;
				document.forms["delete_form"].submit();
		   }
       }
	   function update_submit(allergyId)
	   {
		  	document.getElementById("allergyId_update").value=allergyId;
			document.forms["update_form"].submit();  
	   }
	   function display_allergy(Id)
	   {
			document.getElementById("allergyId_user").value=Id;
			document.forms["allergy_form"].submit();
		}
		function populate(event) 
		{
			var number = this.options[this.selectedIndex].text;
			var url = "ViewPatientAllergy.php?rows="+number+"&page=1";
			window.location.href = url;
		}
   </script>';  
    
?>
<div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading"><h1>Patient Allergy Details</h1></div>
<div style="float:right; margin-right:50px;"><a href="AddPatientAllergy.php"><img src="images/add.png" /></a></div>
<div style="float:right;"><a href="AddPatientAllergy.php"><h3>  Add New</h3></a></div>

<!-- start content table -->
<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">

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

<form id="delete_form" action="cntrl_Patientallergy.php" method="post">
<input id="allergyId_delete" name="allergyId" value="" type="hidden" />
<input id="formAction" name="formAction" value="delete" type="hidden" />
</form>

<form id="update_form" action="cntrl_Patientallergy.php" method="post">
<input id="allergyId_update" name="allergyId" value="" type="hidden" />
<input id="formAction" name="formAction" value="update" type="hidden" />
</form>


<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
  <tr>
    <th class="table-header-repeat line-left"><a href="">Patient Name</a></th>
    <th class="table-header-repeat line-left"><a href="">Type</a></th>
    <th class="table-header-repeat line-left"><a href="">Allergy</a></th>
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
      <td><?php echo $row_allergyId['userName']; ?></td>
      <td><?php echo $row_allergyId['type']; ?></td>
      <td><?php echo $row_allergyId['allergy']; ?></td>
      <td class="options-width">
			<a title="Edit" onclick="update_submit(<?php echo $row_allergyId['allergyId'];?>)" class="icon-1 info-tooltip"></a>
			<a title="Delete" onclick="delete_confirm(<?php echo $row_allergyId['allergyId'];?>);" class="icon-2 info-tooltip"></a>
            </td>
    </tr>
    <?php } while ($row_allergyId = mysql_fetch_assoc($allergyId)); ?>
</table>

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
				<a href="ViewPatientallergy.php?rows=<?php echo $rows; ?>&page=1" class="page-far-left"></a>
				<a href="ViewPatientallergy.php?rows=<?php echo $rows; ?>&page=<?php if($prev>0) echo $prev; else echo 1; ?>" class="page-left"></a>
				<div id="page-info">Page <strong><?php echo $page; ?></strong> / <?php echo $total_pages; ?></div>
				<a href="ViewPatientallergy.php?rows=<?php echo $rows; ?>&page=<?php if($next>1) echo $next; else echo 1; ?>" class="page-right"></a>
				<a href="ViewPatientallergy.php?rows=<?php echo $rows; ?>&page=<?php if($total_pages>1) echo $total_pages; else echo 1; ?>" class="page-far-right"></a>
			</td>
			</tr>
			</table>
<!--  end paging................ --> 


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
	Medical Soft &copy; Copyright Sharad Consultants <span id="spanYear"></span> <a href="">www.sharadconsultants.com</a>. All rights reserved.</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
 
</body>
</html>
<?php
mysql_free_result($allergyId);
?>