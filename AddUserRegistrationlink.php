<?php require_once('Connections/HMS.php'); ?>
<?php
include 'header.php';
if(empty($_GET))
{
	$formAction = "insert";
}
elseif($_GET['Mode']=="update")
{
	$data = $_SESSION['data'];
	$formAction = "update";
}
else
{
	header('Location:ViewUserRegistrationlink.php');
}
unset($_SESSION['data']);
?>

mysql_select_db($database_HMS, $HMS);
$query_user = "SELECT * FROM users";
$user = mysql_query($query_user, $HMS) or die(mysql_error());
$row_user = mysql_fetch_assoc($user);
$totalRows_user = mysql_num_rows($user);

mysql_select_db($database_HMS, $HMS);
$query_registration = "SELECT * FROM webregistration";
$registration = mysql_query($query_registration, $HMS) or die(mysql_error());
$row_registration = mysql_fetch_assoc($registration);
$totalRows_registration = mysql_num_rows($registration);

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add UserRegistration</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>
<body> 
<div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">

<form action="cntrl_UserRegistration.php" method="post" name="form1" id="form1">
  <div id="page-heading"><h1>Registration Details</h1></div>

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
    <!-- starting table contents -->
    <table border="0" cellpadding="5" cellspacing="5"  id="id-form">
 
    
      <tr>
      <th>RegistrationId:</th>
      <td><select name="registrationId" class="styledselect_form_1">
        <?php 
do {  
?>

        <option value="<?php echo $row_registration['registrationId']?>" <?php if (!(strcmp($row_registration['registrationId'], $row_registration['registrationId']))) {echo "SELECTED";} ?>><?php echo $row_registration['name'];?></option>
        <?php
} while ($row_registration = mysql_fetch_assoc($registration));
?>
      </select>
   		</tr>
        <tr>
      <th>UserId:</th>
      <td><select name="userId" class="styledselect_form_1">
        <?php 
do {  
?>

        <option value="<?php echo $row_user['userId']?>" <?php if (!(strcmp($row_user['userId'], $row_user['userId']))) {echo "SELECTED";} ?>><?php echo $row_user['userName'];?></option>
        <?php
} while ($row_user = mysql_fetch_assoc($user));
?>
      </select>
   		</tr>
        <tr>
      
    <tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="submit" value="" class="form-submit" />
			<input type="reset" value="" class="form-reset"  />
		</td>
		<td></td>
	</tr>
  </table>
  <!-- ending table contents -->
    
    <div class="clear"></div>
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
  <input type="hidden" name="formAction" value="<?php if ($formAction == "update") echo "commit"; else echo "insert"; ?>" />
  <input type="hidden" name="personId" value="<?php if($formAction == "update") echo $data['personId']; ?>" />
</form>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"], minChars:2});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "email", {validateOn:["blur", "change"]});
</script>
</body>
</html>