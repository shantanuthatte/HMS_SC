<?php require_once('Connections/HMS.php'); ?>
<?php
include 'header.php';
echo '<script type="text/javascript">
       function delete_confirm(groupId)
       {
           if(confirm("Are you sure you want to delete this group?")==true)
           {
				document.getElementById("groupId_delete").value=groupId;
				document.forms["delete_form"].submit();
		   }
       }
	   function update_submit(groupId)
	   {
		  	document.getElementById("groupId_update").value=groupId;
			document.forms["update_form"].submit();  
	   }
	   function display_group(Id)
	   {
			document.getElementById("groupId_display").value=Id;
			document.forms["display_form"].submit();
		}
   </script>';  
    
mysql_select_db($database_HMS, $HMS);
$query_group = "SELECT * FROM investigationgr";
$group = mysql_query($query_group, $HMS) or die(mysql_error());
$row_group = mysql_fetch_assoc($group);
$totalRows_group = mysql_num_rows($group);
?>
<div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading"><h1>Investigation Group</h1></div>

<!-- start content table -->
<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
<tr>
<a href="AddInvestigationGr.php">Add Investigation Group </a>
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

<form id="delete_form" action="cntrl_InvestigationGr.php" method="post">
<input id="groupId_delete" name="groupId" value="" type="hidden" />
<input id="formAction" name="formAction" value="delete" type="hidden" />
</form>

<form id="update_form" action="cntrl_InvestigationGr.php" method="post">
<input id="groupId_update" name="groupId" value="" type="hidden" />
<input id="formAction" name="formAction" value="update" type="hidden" />
</form>

<form id="display_form" action="ViewAilment.php" method="post">
<input id="groupId_display" name="groupId" value="" type="hidden" />
</form>

<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
  <tr>
    <th class="table-header-repeat line-left"><a href="">Group Name</a></th>
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
      <td><?php echo $row_group['groupName']; ?></td>
     <td class="options-width">
			<a title="Edit" onclick="update_submit(<?php echo $row_group['groupId'];?>)" class="icon-1 info-tooltip"></a>
			<a title="Delete" onclick="delete_confirm(<?php echo $row_group['groupId'];?>);" class="icon-2 info-tooltip"></a>
            
      </td>
    </tr>
    <?php } while ($row_group = mysql_fetch_assoc($group)); ?>
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
mysql_free_result($group);
?>