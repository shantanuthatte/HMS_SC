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
$total_rows = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM medicine"),0);

// Getting the total number of pages. Always round up using ceil() 
$total_pages = ceil($total_rows / $rows);

$prev = $page-1; //previous page
$next = $page+1; //next page

/* Figure out the limit for the query based
 on the current page number.*/
$from = (($page * $rows) - $rows);

    
mysql_select_db($database_HMS, $HMS);
$query_medicine = "SELECT * FROM medicine LIMIT $from,$rows";
$medicine = mysql_query($query_medicine, $HMS) or die(mysql_error());
$row_medicine = mysql_fetch_assoc($medicine);
$totalRows_medicine = mysql_num_rows($medicine);

echo '<script type="text/javascript">
       function delete_confirm(medicineId)
       {
           if(confirm("Are you sure you want to delete?")==true)
           {
				document.getElementById("medicineId_delete").value=medicineId;
				document.forms["delete_form"].submit();
		   }
       }
	   function update_submit(medicineId)
	   {
		  	document.getElementById("medicineId_update").value=medicineId;
			document.forms["update_form"].submit();  
	   }
	   function populate(event) 
		{
			var number = this.options[this.selectedIndex].text;
			var url = "ViewMedicine.php?rows="+number+"&page=1";
			window.location.href = url;
		}
   </script>';  
?>
<div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading"><h1>Medicine</h1></div>

<!-- start content table -->
<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
<tr>
<a href="AddMedicine.php">Add Medicine</a>
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

<form id="delete_form" action="cntrl_Medicine.php" method="post">
<input id="medicineId_delete" name="medicineId" value="" type="hidden" />
<input id="formAction" name="formAction" value="delete" type="hidden" />
</form>

<form id="update_form" action="cntrl_Medicine.php" method="post">
<input id="medicineId_update" name="medicineId" value="" type="hidden" />
<input id="formAction" name="formAction" value="update" type="hidden" />
</form>

<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
  <tr>
    <th class="table-header-repeat line-left"><a href="">Medicine Name</a></th>
    <th class="table-header-repeat line-left"><a href="">Indications</a></th>
    <th class="table-header-repeat line-left"><a href="">Contra Indications</a></th>
    <th class="table-header-repeat line-left"><a href="">Adverse Effects</a></th>
    <th class="table-header-repeat line-left"><a href="">Drug Interactions</a></th>
    <th class="table-header-repeat line-left"><a href="">Special Precautions</a></th>
    <th class="table-header-repeat line-left"><a href="">BreastFeeding</a></th>
    <th class="table-header-repeat line-left"><a href="">Pregnancy</a></th>
    <th class="table-header-repeat line-left"><a href="">Paediatrics</a></th>
    <th class="table-header-repeat line-left"><a href="">Over60</a></th>
    <th class="table-header-repeat line-left"><a href="">ClassId</a></th>
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
      <td><?php echo $row_medicine['medicineNm']; ?></td>
      <td><?php echo $row_medicine['indications']; ?></td>
      <td><?php echo $row_medicine['contraIndications']; ?></td>
      <td><?php echo $row_medicine['adverseEffects']; ?></td>
      <td><?php echo $row_medicine['drugInteractions']; ?></td>
      <td><?php echo $row_medicine['specialPrecautions']; ?></td>
      <td><?php echo $row_medicine['breastFeeding']; ?></td>
      <td><?php echo $row_medicine['pregnancy']; ?></td>
      <td><?php echo $row_medicine['paediatrics']; ?></td>
      <td><?php echo $row_medicine['over60']; ?></td>
      <td><?php echo $row_medicine['classId']; ?></td>
      <td><?php echo $row_medicine['comments']; ?></td>
      <td class="options-width">
			<a title="Edit" onclick="update_submit(<?php echo $row_medicine['medicineId'];?>)" class="icon-1 info-tooltip"></a>
			<a title="Delete" onclick="delete_confirm(<?php echo $row_medicine['medicineId'];?>);" class="icon-2 info-tooltip"></a>
          </td>
    </tr>
    <?php } while ($row_medicine = mysql_fetch_assoc($medicine)); ?>
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
				<a href="ViewMedicine.php?rows=<?php echo $rows; ?>&page=1" class="page-far-left"></a>
				<a href="ViewMedicine.php?rows=<?php echo $rows; ?>&page=<?php if($prev>0) echo $prev; else echo 1; ?>" class="page-left"></a>
				<div id="page-info">Page <strong><?php echo $page; ?></strong> / <?php echo $total_pages; ?></div>
				<a href="ViewMedicine.php?rows=<?php echo $rows; ?>&page=<?php if($next>1) echo $next; else echo 1; ?>" class="page-right"></a>
				<a href="ViewMedicine.php?rows=<?php echo $rows; ?>&page=<?php if($total_pages>1) echo $total_pages; else echo 1; ?>" class="page-far-right"></a>
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
mysql_free_result($medicine);
?>
