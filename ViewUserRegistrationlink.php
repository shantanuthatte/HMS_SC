<?php require_once('Connections/HMS.php'); ?>
<?php
include 'header.php';
echo '<script type="text/javascript">
       function delete_confirm(userRegLinkId)
       {
           if(confirm("Are you sure you want to delete this person?")==true)
           {
				document.getElementById("userRegLinkId_delete").value=userRegLinkId;
				document.forms["delete_form"].submit();
		   }
       }
	   function update_submit(userRegLinkId)
	   {
		  	document.getElementById("userRegLinkId_update").value=userRegLinkId;
			document.forms["update_form"].submit();  
	   }
	   function display_user(Id)
	   {
			document.getElementById("userRegLinkId_user").value=Id;
			document.forms["user_form"].submit();
		}
   </script>';  
    
mysql_select_db($database_HMS, $HMS);
$query_userreglink = "SELECT * FROM userregistrationlink";
$userreglink = mysql_query($query_userreglink, $HMS) or die(mysql_error());
$row_userreglink = mysql_fetch_assoc($userreglink);
$totalRows_userreglink = mysql_num_rows($userreglink);
?>
<div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading"><h1>View User Registration</h1></div>

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

<form id="delete_form" action="cntrl_UserRegistrationlink.php" method="post">
<input id="userRegLinkId_delete" name="userRegLinkId" value="" type="hidden" />
<input id="formAction" name="formAction" value="delete" type="hidden" />
</form>

<form id="update_form" action="cntrl_UserRegistrationlink.php" method="post">
<input id="userRegLinkId_update" name="userRegLinkId" value="" type="hidden" />
<input id="formAction" name="formAction" value="update" type="hidden" />
</form>

<form id="reg_form" action="ViewUserRegistrationlink.php" method="post">
<input id="userRegLinkId_user" name="userRegLinkId" value="" type="hidden" />
</form>

<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
  <tr>
    <th class="table-header-repeat line-left"><a href="">RegistrationId</a></th>
    <th class="table-header-repeat line-left"><a href="">UserId</a></th>
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
      <td><?php echo $row_userreglink['registrationId']; ?></td>
      <td><?php echo $row_userreglink['userId']; ?></td>
      
      <td class="options-width">
			<a title="Edit" onclick="update_submit(<?php echo $row_userreglink['userRegLinkId'];?>)" class="icon-1 info-tooltip"></a>
			<a title="Delete" onclick="delete_confirm(<?php echo $row_userreglink['userRegLinkId'];?>);" class="icon-2 info-tooltip"></a>
           
      </td>
    </tr>
    <?php } while ($row_userreglink = mysql_fetch_assoc($userreglink)); ?>
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
	Medical Soft &copy; Copyright Sharad Consultants <span id="spanYear"></span> <a href="">www.sharadconsultants.com</a>. All rights reserved.</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
 
</body>
</html>
<?php
mysql_free_result($userreglink);
?>