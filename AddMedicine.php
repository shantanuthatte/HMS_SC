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
	header('Location:ViewMedicine.php');
}
unset($_SESSION['data']);

mysql_select_db($database_HMS, $HMS);
$query_class = "SELECT * FROM medicineclass";
$class = mysql_query($query_class, $HMS) or die(mysql_error());
$row_class = mysql_fetch_assoc($class);
$totalRows_class = mysql_num_rows($class);

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Medicine</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>
<body> 
<div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">

<form action="cntrl_Medicine.php" method="post" name="form1" id="form1">
  <div id="page-heading">
    <h1>Medicine Details</h1></div>

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
      <th>Medicine Name:</th>
      <td>
      <input type="text" name="medicineNm" size="32" class="inp-form-error" value="<?php if($formAction == "update") echo $data['medicineNm']; ?>"/>
      </td>
   		</tr>
        <tr>
      <th>Indications:</th>
      <td><input type="text" name="indications" size="32" class="inp-form" value="<?php if($formAction == "update") echo $data['indications']; ?>" /></td>
   		</tr>
        <tr>
      <th>Contra Indications:</th>
      <td><input type="text" name="contraIndications" size="32" class="inp-form" value="<?php if($formAction == "update") echo $data['contraIndications']; ?>" /></td>
    </tr>
    <tr>
      <th>Adverse Effects:</th>
      <td><textarea rows="3" name="adverseEffects" size="32" class="inp-form"><?php if($formAction == "update") echo $data['adverseEffects']; ?></textarea></td>
    </tr>
    
    <th>Drug Interaction:</th>
      <td><textarea rows="3" name="drugInteractions" size="32" class="inp-form"><?php if($formAction == "update") echo $data['drugInteractions']; ?></textarea></td>
    </tr>    
    <th>Special Precautions:</th>
      <td><textarea rows="3" name="specialPrecautions" size="32" class="inp-form"><?php if($formAction == "update") echo $data['specialPrecautions']; ?></textarea></td>
    </tr>       
    <tr>
        <th>Over60:</th>
      <td>
		<select name="over60" class="styledselect_form_1">
			<option value="S" <?php if($formAction == "update" && $data['over60'] == "S") echo "SELECTED"; ?>>Safe</option>
			<option value="C" <?php if($formAction == "update" && $data['over60'] == "C") echo "SELECTED"; ?>>Use with Caution</option>
			<option value="D" <?php if($formAction == "update" && $data['over60'] == "D") echo "SELECTED"; ?>>Do not Use</option>
			
			</select>
		</td>
        <tr>
        <th>Paediatrics:</th>
      <td>
		<select name="paediatrics" class="styledselect_form_1">
			<option value="S" <?php if($formAction == "update" && $data['paediatrics'] == "S") echo "SELECTED"; ?>>Safe</option>
			<option value="C" <?php if($formAction == "update" && $data['paediatrics'] == "C") echo "SELECTED"; ?>>Use with Caution</option>
			<option value="D" <?php if($formAction == "update" && $data['paediatrics'] == "D") echo "SELECTED"; ?>>Do not Use</option>
			
			</select>
            </td>
            </tr>
            <tr>
            <th>Pregnancy:</th>
      <td>
		<select name="pregnancy" class="styledselect_form_1">
			<option value="S" <?php if($formAction == "update" && $data['pregnancy'] == "S") echo "SELECTED"; ?>>Safe</option>
			<option value="C" <?php if($formAction == "update" && $data['pregnancy'] == "C") echo "SELECTED"; ?>>Use with Caution</option>
			<option value="D" <?php if($formAction == "update" && $data['pregnancy'] == "D") echo "SELECTED"; ?>>Do not Use</option>
			
			</select>
            </tr>
            <tr>
            <th>Breast Feeding:</th>
      <td>
		<select name="breastFeeding" class="styledselect_form_1">
			<option value="S" <?php if($formAction == "update" && $data['breastFeeding'] == "S") echo "SELECTED"; ?>>Safe</option>
			<option value="C" <?php if($formAction == "update" && $data['breastFeeding'] == "C") echo "SELECTED"; ?>>Use with Caution</option>
			<option value="D" <?php if($formAction == "update" && $data['breastFeeding'] == "D") echo "SELECTED"; ?>>Do not Use</option>
			
			</select>
            </tr>
       <tr>
      <th>ClassId:</th>
      <td><select name="classId" class="styledselect_form_1">
      <?php 
		do {  
		?>    
      <option value="<?php echo $row_class['classId']?>" 
	  <?php if (($formAction == "update") && (!strcmp($row_class['classId'], $data['classId']))) {echo "SELECTED";} ?>>
      <?php echo $row_class['className'];?></option>
      <?php
		} while ($row_class = mysql_fetch_assoc($class));
		?>        
      </select>
   		</tr>
        <tr>
      <th>Comments:</th>
      <td><textarea rows="3" name="comments" size="32" class="inp-form"><?php if($formAction == "update") echo $data['comments']; ?></textarea></td>
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
  <input type="hidden" name="formAction" value="<?php if ($formAction == "update") echo "commit"; else echo "insert"; ?>" />
  <input type="hidden" name="medicineId" value="<?php if($formAction == "update") echo $data['medicineId']; ?>" />
</form>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"], minChars:2});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "email", {validateOn:["blur", "change"]});
</script>
</body>
</html>