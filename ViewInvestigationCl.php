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
$total_rows = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM investigationcl"),0);

// Getting the total number of pages. Always round up using ceil() 
$total_pages = ceil($total_rows / $rows);

$prev = $page-1; //previous page
$next = $page+1; //next page

/* Figure out the limit for the query based
 on the current page number.*/
$from = (($page * $rows) - $rows); 
    
mysql_select_db($database_HMS, $HMS);
$query_invstcl = "SELECT * FROM investigationcl LIMIT $from,$rows";
$invstcl = mysql_query($query_invstcl, $HMS) or die(mysql_error());
$row_invstcl = mysql_fetch_assoc($invstcl);
$totalRows_invstcl = mysql_num_rows($invstcl);

echo '<script type="text/javascript">
       function delete_confirm(grId)
       {
           if(confirm("Are you sure you want to delete?")==true)
           {
				document.getElementById("grId_delete").value=grId;
				document.forms["delete_form"].submit();
		   }
       }
	   
	   function update_submit(grId)
	   {		   
		  	document.getElementById("grId_update").value=grId;
			document.forms["update_form"].submit();  
	   }
	  
	   function display_invstcl(Id)
	   {
			document.getElementById("grId_display").value=Id;
			document.forms["display_form"].submit();
		}
		 function populate(event) 
		{
			var number = this.options[this.selectedIndex].text;
			var url = "ViewInvestigationCl.php?rows="+number+"&page=1";
			window.location.href = url;
		}
   </script>';  
?>
<div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading"><h1>Investigation Class</h1></div>

<!-- start content table -->
<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
<tr>
<a href="AddInvestigationCl.php">Add Investigation Class</a>
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

<form id="delete_form" action="cntrl_InvestigationCl.php" method="post">
<input id="grId_delete" name="grId" value="" type="hidden" />
<input id="formAction" name="formAction" value="delete" type="hidden" />
</form>

<form id="update_form" action="cntrl_InvestigationCl.php" method="post">
<input id="grId_update" name="grId" value="" type="hidden" />
<input id="formAction" name="formAction" value="update" type="hidden" />
</form>

<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
  <tr>
    <th class="table-header-repeat line-left"><a href="">Group Id</a></th>
    <th class="table-header-repeat line-left"><a href="">Class Id</a></th>
    <th class="table-header-repeat line-left"><a href="">Class Name</a></th>
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
      <td><?php echo $row_invstcl['grId']; ?></td>
      <td><?php echo $row_invstcl['classId']; ?></td>
      <td><?php echo $row_invstcl['className']; ?></td>      
      <td class="options-width">
			<a title="Edit" onclick="update_submit('<?php echo $row_invstcl['grId'];?>')" class="icon-1 info-tooltip"></a>
			<a title="Delete" onclick="delete_confirm('<?php echo $row_invstcl['grId'];?>');" class="icon-2 info-tooltip"></a>            
      </td>      
    </tr>
    <?php } while ($row_invstcl = mysql_fetch_assoc($invstcl)); ?>
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
				<a href="ViewInvestigationCl.php?rows=<?php echo $rows; ?>&page=1" class="page-far-left"></a>
				<a href="ViewInvestigationCl.php?rows=<?php echo $rows; ?>&page=<?php if($prev>0) echo $prev; else echo 1; ?>" class="page-left"></a>
				<div id="page-info">Page <strong><?php echo $page; ?></strong> / <?php echo $total_pages; ?></div>
				<a href="ViewInvestigationCl.php?rows=<?php echo $rows; ?>&page=<?php if($next>1) echo $next; else echo 1; ?>" class="page-right"></a>
				<a href="ViewInvestigationCl.php?rows=<?php echo $rows; ?>&page=<?php if($total_pages>1) echo $total_pages; else echo 1; ?>" class="page-far-right"></a>
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
mysql_free_result($invstcl);
?>