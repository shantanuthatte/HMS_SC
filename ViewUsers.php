<?php require_once('Connections/HMS.php'); ?>
<?php
include 'header.php';

echo '<script type="text/javascript">
       function delete_confirm(userId)
       {
           if(confirm("Are you sure you want to delete this user?")==true)
           {
				document.getElementById("userId_delete").value=userId;
				document.forms["delete_form"].submit();
		   }
       }
	   function update_submit(userId)
	   {
		  	document.getElementById("userId_update").value=userId;
			document.forms["update_form"].submit();  
	   }	
	   function addUser()
		{
 			<?php 
				addUser(); 
			?>
 		}  
   </script>';  
   
if(!isset($_POST['personId'])) 
{
	echo "Error! Unexpected flow of navigation! Redirecting you back to the main page...";
	header('Location:ViewPerson.php');
}
else
{
	$personId = $_POST['personId'];
}
   
mysql_select_db($database_HMS, $HMS);
$query_usersRS = "SELECT * FROM users WHERE personId = $personId;";
$usersRS = mysql_query($query_usersRS, $HMS) or die(mysql_error());
$row_usersRS = mysql_fetch_assoc($usersRS);
$totalRows_usersRS = mysql_num_rows($usersRS);

if($totalRows_usersRS == 0)
{
	$_SESSION['newUserPersonId'] = $personId;
	header('Location:AddUser.php?Mode=create');
}

function addUser()
{	
	$_SESSION['newUserPersonId'] = $personId;
	header('Location:AddUser.php?Mode=create');	
}

?>
<div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading"><h1>Users</h1></div>
<div style="float:right; margin-right:50px;"><a onClick="addUser()"><img src="images/add.png" /></a></div>
<div style="float:right;"><a onClick="addUser()"><h3>Add New</h3></a></div>

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

<form id="delete_form" action="cntrl_Users.php" method="post">
<input id="userId_delete" name="userId" value="" type="hidden" />
<input id="formAction" name="formAction" value="delete" type="hidden" />
</form>

<form id="update_form" action="cntrl_Users.php" method="post">
<input id="userId_update" name="userId" value="" type="hidden" />
<input id="formAction" name="formAction" value="update" type="hidden" />
</form>

<form id="user_form" action="ViewUsers.php" method="post">
<input id="personId_user" name="personId" value="" type="hidden" />
</form>

<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
  <tr>   
    <th class="table-header-repeat line-left"><a href="">userName</a></th>
    <th class="table-header-repeat line-left"><a href="">password</a></th>
    <th class="table-header-repeat line-left"><a href="">type</a></th>
    <th class="table-header-repeat line-left"><a href="">recoveryEmail</a></th>
    <th class="table-header-repeat line-left"><a href="">permission</a></th>
    <th class="table-header-repeat line-left"><a href="">personId</a></th>
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
      <td><?php echo $row_usersRS['userName']; ?></td>
      <td><?php echo $row_usersRS['password']; ?></td>
      <td><?php echo $row_usersRS['type']; ?></td>
      <td><?php echo $row_usersRS['recoveryEmail']; ?></td>
      <td><?php echo $row_usersRS['permission']; ?></td>
      <td><?php echo $row_usersRS['personId']; ?></td>
      <td class="options-width">
			<a title="Edit" onclick="update_submit(<?php echo $row_usersRS['userId'];?>)" class="icon-1 info-tooltip"></a>
			<a title="Delete" onclick="delete_confirm(<?php echo $row_usersRS['userId'];?>);" class="icon-2 info-tooltip"></a>
      </td>
    </tr>
    <?php } while ($row_usersRS = mysql_fetch_assoc($usersRS)); ?>
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
//mysql_free_result($Users);
?>
