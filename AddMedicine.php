<?php require_once('Connections/HMS.php'); ?>
<?php
include 'header.php';
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO medicine (medicineNm,  indications, contraIndications, adverseEffects,drugInteractions,  specialPrecautions, breastFeeding, pregnancy, paediatrics, over60, classId, comments) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",  
                       GetSQLValueString($_POST['medicineNm'], "text"),
					   GetSQLValueString($_POST['indications'], "text"),
					   GetSQLValueString($_POST['contraIndications'], "text"),
					   GetSQLValueString($_POST['adverseEffects'], "text"),
					   GetSQLValueString($_POST['drugInteractions'], "text"),
					   GetSQLValueString($_POST['specialPrecautions'], "text"),
					   GetSQLValueString($_POST['breastFeeding'], "text"),
					   GetSQLValueString($_POST['pregnancy'], "text"),
					   GetSQLValueString($_POST['paediatrics'], "text"),
					   GetSQLValueString($_POST['over60'], "text"),
					   GetSQLValueString($_POST['classId'], "text"),
					   GetSQLValueString($_POST['comments'], "text"));
					   
				
  

  mysql_select_db($database_HMS, $HMS);
  $Result1 = mysql_query($insertSQL, $HMS) or die(mysql_error());
  
}
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
</head>

<body>
<div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
<div id="page-heading"><h1>Add Medicine</h1></div>

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
      <td><input type="text" name="medicineNm" value="" size="32" class="inp-form"/></td>
   		</tr>
         <tr>
      <th>Indications:</th>
      
       <td><input type="text" name="indications" value="" size="32" class="inp-form"/></td>
      <tr>
      <th>Contra Indications:</th>
      <td><input type="text" name="contraIndications" value="" size="32" class="inp-form"/></td>
   		</tr>
        <tr>
      <th>Adverse Effects:</th>
      <td><input name="adverseEffects" value="" size="32" class="inp-form"/></td>
   		</tr>
        <tr>
      <th>Drug Interactions:</th>
      <td><input type="text" name="drugInteractions" value="" size="32" class="inp-form"/></td>
   		</tr>
        <tr>
      <th>Special Precautions:</th>
      <td><input type="text" name="specialPrecautions" value="" size="32" class="inp-form"/></td>
   		</tr>
        <tr>
        <th>Over60:</th>
      <td>
		<select name="over60" class="styledselect_form_1">
			<option value="S">Safe</option>
			<option value="C">Use with Caution</option>
			<option value="D">Do not Use</option>
			
			</select>
		</td>
        <tr>
        <th>Paediatrics:</th>
      <td>
		<select name="paediatrics" class="styledselect_form_1">
			<option value="S">Safe</option>
			<option value="C">Use with Caution</option>
			<option value="D">Do not Use</option>
			
			</select>
            </td>
            </tr>
            <tr>
            <th>Pregnancy:</th>
      <td>
		<select name="pregnancy" class="styledselect_form_1">
			<option value="S">Safe</option>
			<option value="C">Use with Caution</option>
			<option value="D">Do not Use</option>
			
			</select>
            </tr>
            <tr>
            <th>Breast Feeding:</th>
      <td>
		<select name="breastFeeding" class="styledselect_form_1">
			<option value="S">Safe</option>
			<option value="C">Use with Caution</option>
			<option value="D">Do not Use</option>
			
			</select>
            </tr>
            <tr>
      <th>ClassId:</th>
      <td><select name="classId" class="styledselect_form_1">
        <?php 
do {  
?>

        <option value="<?php echo $row_class['classId']?>" <?php if (!(strcmp($row_class['classId'], $row_class['classId']))) {echo "SELECTED";} ?>><?php echo $row_class['className'];?></option>
        <?php
} while ($row_class = mysql_fetch_assoc($class));
?>
      </select>
   		</tr>
        <tr>
      <th>Comments:</th>
      <td><input type="text" name="comments" value="" size="32" class="inp-form"/></td>
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
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>
