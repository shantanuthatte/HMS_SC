<?php require_once('Connections/HMS.php'); ?>
<?php
include 'header.php';
echo '<script type="text/javascript">
       function delete_confirm(personId)
       {
           if(confirm("Are you sure you want to delete this person?")==true)
           {
				document.getElementById("personId_delete").value=personId;
				document.forms["delete_form"].submit();
		   }
		   else
		   		window.location.reload();
       }
	   function update_submit(personId)
	   {
			document.getElementById("personId_update").value=personId;
			document.forms["update_form"].submit();   
	   }
   </script>';  
    
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_HMS, $HMS);
$query_personRS = "SELECT * FROM person";
$personRS = mysql_query($query_personRS, $HMS) or die(mysql_error());
$row_personRS = mysql_fetch_assoc($personRS);
$totalRows_personRS = mysql_num_rows($personRS);
?>
<div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading"><h1>View Person</h1></div>

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

<form id="delete_form" action="cntrl_Person.php" method="post">
<input id="personId_delete" name="personId" value="" type="hidden" />
<input id="formAction" name="formAction" value="delete" type="hidden" />
</form>

<form id="update_form" action="cntrl_Person.php" method="post">
<input id="personId_update" name="personId" value="" type="hidden" />
<input id="formAction" name="formAction" value="update" type="hidden" />
</form>

<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
  <tr>
    <th class="table-header-repeat line-left"><a href="">Id</a></th>
    <th class="table-header-repeat line-left"><a href="">First</a></th>
    <th class="table-header-repeat line-left"><a href="">Middle</a></th>
    <th class="table-header-repeat line-left"><a href="">Last</a></th>
    <th class="table-header-repeat line-left"><a href="">Address</a></th>
    <th class="table-header-repeat line-left"><a href="">Phone</a></th>
    <th class="table-header-repeat line-left"><a href="">Mobile</a></th>
    <th class="table-header-repeat line-left"><a href="">Gender</a></th>
    <th class="table-header-repeat line-left"><a href="">DOB</a></th>
    <th class="table-header-repeat line-left"><a href="">Email</a></th>
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
      <td><?php echo $row_personRS['personId']; ?></td>
      <td><?php echo $row_personRS['fName']; ?></td>
      <td><?php echo $row_personRS['mName']; ?></td>
      <td><?php echo $row_personRS['lName']; ?></td>
      <td><?php echo $row_personRS['address']; ?></td>
      <td><?php echo $row_personRS['rPhone']; ?></td>
      <td><?php echo $row_personRS['mobile']; ?></td>
      <td><?php echo $row_personRS['gender']; ?></td>
      <td><?php echo $row_personRS['DOB']; ?></td>
      <td><?php echo $row_personRS['email']; ?></td>
      <td class="options-width">
					<a title="Edit" onclick="update_submit(<?php echo $row_personRS['personId'];?>)" class="icon-1 info-tooltip"></a>
					<a title="Delete" onclick="delete_confirm(<?php echo $row_personRS['personId'];?>);" class="icon-2 info-tooltip"></a>
      </td>
    </tr>
    <?php } while ($row_personRS = mysql_fetch_assoc($personRS)); ?>
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
mysql_free_result($personRS);
?>
