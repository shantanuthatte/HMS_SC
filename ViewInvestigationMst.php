<?php require_once('Connections/HMS.php'); ?>
<?php
include 'header.php';
echo '<script type="text/javascript">
       function delete_confirm(invstId)
       {
           if(confirm("Are you sure you want to delete?")==true)
           {
				document.getElementById("invstId_delete").value=invstId;
				document.forms["delete_form"].submit();
		   }
       }
	   function update_submit(invstId)
	   {
		  	document.getElementById("invstId_update").value=invstId;
			document.forms["update_form"].submit();  
	   }
	   function display_invst(Id)
	   {
			document.getElementById("invstId_user").value=Id;
			document.forms["invst_form"].submit();
		}
   </script>';  
    
mysql_select_db($database_HMS, $HMS);
$query_invstmst = "SELECT * FROM investigationmst";
$invstmst = mysql_query($query_invstmst, $HMS) or die(mysql_error());
$row_invstmst = mysql_fetch_assoc($invstmst);
$totalRows_invstmst = mysql_num_rows($invstmst);
?>
<div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading"><h1>Investigation Master</h1></div>

<!-- start content table -->
<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
<tr>
<a href="AddInvestigationMst.php">Add Investigation</a>
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

<form id="delete_form" action="cntrl_InvestigationMst.php" method="post">
<input id="invstId_delete" name="invstId" value="" type="hidden" />
<input id="formAction" name="formAction" value="delete" type="hidden" />
</form>

<form id="update_form" action="cntrl_InvestigationMst.php" method="post">
<input id="invstId_update" name="invstId" value="" type="hidden" />
<input id="formAction" name="formAction" value="update" type="hidden" />
</form>

<form id="invst_form" action="ViewInvestigationMst.php" method="post">
<input id="invstId_user" name="invstId" value="" type="hidden" />
</form>

<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
  <tr>
    <th class="table-header-repeat line-left"><a href="">Invst Name</a></th>
    <th class="table-header-repeat line-left"><a href="">Information</a></th>
    <th class="table-header-repeat line-left"><a href="">Sex Flag</a></th>
    <th class="table-header-repeat line-left"><a href="">To Val1</a></th>
    <th class="table-header-repeat line-left"><a href="">From Val1</a></th>
    <th class="table-header-repeat line-left"><a href="">To Val2</a></th>
    <th class="table-header-repeat line-left"><a href="">From Val2</a></th>
    <th class="table-header-repeat line-left"><a href="">impression</a></th>
    <th class="table-header-repeat line-left"><a href="">result</a></th>
    <th class="table-header-repeat line-left"><a href="">unit</a></th>
    <th class="table-header-repeat line-left"><a href="">charges</a></th>
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
      <td><?php echo $row_invstmst['invstName']; ?></td>
      <td><?php echo $row_invstmst['info']; ?></td>
      <td><?php echo $row_invstmst['sexFlag']; ?></td>
      <td><?php echo $row_invstmst['toVal1']; ?></td>
      <td><?php echo $row_invstmst['fromVal1']; ?></td>
      <td><?php echo $row_invstmst['toVal2']; ?></td>
      <td><?php echo $row_invstmst['fromVal2']; ?></td>
      <td><?php echo $row_invstmst['impression']; ?></td>
      <td><?php echo $row_invstmst['result']; ?></td>
      <td><?php echo $row_invstmst['unit']; ?></td>
      <td><?php echo $row_invstmst['charges']; ?></td>
    <td class="options-width">
			<a title="Edit" onclick="update_submit(<?php echo $row_invstmst['invstId'];?>)" class="icon-1 info-tooltip"></a>
			<a title="Delete" onclick="delete_confirm(<?php echo $row_invstmst['invstId'];?>);" class="icon-2 info-tooltip"></a>
            </td>
    </tr>
    <?php } while ($row_invstmst = mysql_fetch_assoc($invstmst)); ?>
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
mysql_free_result($invstmst);
?>