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
	header('Location:ViewInvestigationMst.php');
}
unset($_SESSION['data']);
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add InvstMst</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>
<body> 
<div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">

<form action="cntrl_InvestigationMst.php" method="post" name="form1" id="form1">
  <div id="page-heading"><h1>Investigation Details</h1></div>

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
      <th>Investigation Name:</th>
      <td>
      <input type="text" name="invstName" size="32" class="inp-form-error" value="<?php if($formAction == "update") echo $data['invstName']; ?>"/>
      </td>
   		</tr>
        <tr>
      <th>Information:</th>
      <td><textarea rows="3" name="info" size="32" class="inp-form"><?php if($formAction == "update") echo $data['info']; ?> </textarea></td>
   		</tr>
        <tr>
      <th>Sex:</th>
      <td><select name="sexFlag" class="styledselect_form_1">
			<option value="M" <?php if($formAction == "update" && $data['sexFlag'] == "M") echo "SELECTED"; ?>>Only Male</option>
			<option value="F" <?php if($formAction == "update" && $data['sexFlag'] == "F") echo "SELECTED"; ?>>Only Female</option>
			<option value="C" <?php if($formAction == "update" && $data['sexFlag'] == "C") echo "SELECTED"; ?>>Common</option>
			<option value="B" <?php if($formAction == "update" && $data['sexFlag'] == "B") echo "SELECTED"; ?>>Both</option>
			</select>
</td>
    </tr>
    <tr>
      <th>To Val1:</th>
      <td><input type="text" name="toVal1" size="32" class="inp-form" value="<?php if($formAction == "update") echo $data['toVal1']; ?>" /></td>
    </tr>
    <tr>
      <th>From Val1:</th>
      <td><input type="text" name="fromVal1" size="32" class="inp-form" value="<?php if($formAction == "update") echo $data['fromVal1']; ?>"/></td>
    </tr>
    <tr>
      <th>To Val2:</th>
      <td><input type="text" name="toVal2" size="32" class="inp-form" value="<?php if($formAction == "update") echo $data['toVal2']; ?>" /></td>
    </tr>
    <tr>
   <tr>
      <th>From Val2:</th>
      <td><input id="txtDate1" type="text" name="fromVal2" value="<?php if($formAction == "update") echo $data['fromVal2']; ?>" size="32" class="inp-form" />
      </td></tr>
    <tr>
      <th>Impression:</th>
      <td>
      <input type="text" name="impression" value="<?php if($formAction == "update") echo $data['impression']; ?>" size="32" class="inp-form"/>
      </td>
    </tr> 
    <tr>
      <th>Result:</th>
      <td>
      <input type="text" name="result" value="<?php if($formAction == "update") echo $data['result']; ?>" size="32" class="inp-form"/>
      </td>
    </tr> 
    <tr>
      <th>Unit:</th>
      <td>
      <input type="text" name="unit" value="<?php if($formAction == "update") echo $data['unit']; ?>" size="32" class="inp-form"/>
      </td>
    </tr> 
    <tr>
      <th>Charges:</th>
      <td>
      <input type="text" name="charges" value="<?php if($formAction == "update") echo $data['charges']; ?>" size="32" class="inp-form"/>
      </td>
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
  <input type="hidden" name="invstId" value="<?php if($formAction == "update") echo $data['invstId']; ?>" />
</form>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"], minChars:2});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "email", {validateOn:["blur", "change"]});
</script>
</body>
</html>