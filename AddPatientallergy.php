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
	header('Location:ViewPatientallergy.php');
}
unset($_SESSION['data']);

mysql_select_db($database_HMS, $HMS);
$query_patient = "SELECT * FROM users";
$patient = mysql_query($query_patient, $HMS) or die(mysql_error());
$row_patient = mysql_fetch_assoc($patient);
$totalRows_patient = mysql_num_rows($patient);
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Patient Allergy</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>
<body> 
<div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">

<form action="cntrl_Patientallergy.php" method="post" name="form1" id="form1">
  <div id="page-heading"><h1>Patient Allergy Details</h1></div>

  <table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
<tr>
	<th rowspan="3" class="sized"><img src="file:///C|/Documents and Settings/sharad03/Desktop/images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
	<th class="topleft"></th>
	<td id="tbl-border-top">&nbsp;</td>
	<th class="topright"></th>
	<th rowspan="3" class="sized"><img src="file:///C|/Documents and Settings/sharad03/Desktop/images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
</tr>
<tr>
	<td id="tbl-border-left"></td>
	<td>
	<!--  start content-table-inner -->
	<div id="content-table-inner">
    <!-- starting table contents -->
    <table border="0" cellpadding="5" cellspacing="5"  id="id-form">
 
    <tr>
      <th>PatientId:</th>
      <td><select name="patientId" class="styledselect_form_1">
        <?php 
do {  
?>

        <option value="<?php echo $row_patient['userId']?>" <?php if (!(strcmp($row_patient['userId'], $row_patient['userId']))) {echo "SELECTED";} ?>><?php echo $row_patient['userName'];?></option>
        <?php
} while ($row_patient = mysql_fetch_assoc($patient));
?>
<?php if($formAction == "update") echo $data['patientId']; ?>
      </select>
      </td>
   		</tr>
        <tr>
      <th>Allergy Type:</th>
      <td><select name="type" class="styledselect_form_1">
			<option value="D" <?php if($formAction == "update" && $data['type'] == "D") echo "SELECTED"; ?>>Drug</option>
			<option value="F" <?php if($formAction == "update" && $data['type'] == "F") echo "SELECTED"; ?>>Food</option>
			<option value="T" <?php if($formAction == "update" && $data['type'] == "T") echo "SELECTED"; ?>>Drug Text</option>
			<option value="O" <?php if($formAction == "update" && $data['type'] == "O") echo "SELECTED"; ?>>Other</option>
			</select>
</td>
    <tr>
      <th>Allergy:</th>
      <td><input type="text" name="allergy" size="32" class="inp-form" value="<?php if($formAction == "update") echo $data['allergy']; ?>" /></td>
    </tr>
    <tr>
      <th>Comments:</th>
      <td><input type="text" name="comments" size="32" class="inp-form" value="<?php if($formAction == "update") echo $data['comments']; ?>"/></td>
    </tr>
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
  <input type="hidden" name="allergyId" value="<?php if($formAction == "update") echo $data['allergyId']; ?>" />
</form>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"], minChars:2});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "email", {validateOn:["blur", "change"]});
</script>
</body>
</html>