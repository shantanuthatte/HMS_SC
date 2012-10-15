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
  $insertSQL = sprintf("INSERT INTO familyhistory (patientId, familyRelation, ailmentId, diagnosisDate, symptoms, comments) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['patientId'], "text"),
					   GetSQLValueString($_POST['familyRelation'], "text"),
					   GetSQLValueString($_POST['ailmentId'], "text"),
					   GetSQLValueString($_POST['diagnosisDate'], "text"),
					   GetSQLValueString($_POST['symptoms'], "text"),
					   GetSQLValueString($_POST['comments'], "text"));


  mysql_select_db($database_HMS, $HMS);
  $Result1 = mysql_query($insertSQL, $HMS) or die(mysql_error());
}

mysql_select_db($database_HMS, $HMS);
$query_patient = "SELECT * FROM users";
$patient = mysql_query($query_patient, $HMS) or die(mysql_error());
$row_patient = mysql_fetch_assoc($patient);
$totalRows_patient = mysql_num_rows($patient);
?>
<script src="Calendar/popcalendar.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">
 
    function fnOpenCalendar(id1)
    {        
		//alert("Opens the calendar");
        var ctl1=document.getElementById(id1);
        var ctl2=document.getElementById(id1);
        popUpCalendar(ctl1,ctl2,'dd/mm/yyyy');
        return true;
    }
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add User</title>
</head>

<body>
<div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
<div id="page-heading"><h1>Add FamilyHistory</h1></div>

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
      <th>PatientId:</th>
      <td><select name="patientId" class="styledselect_form_1">
        <?php 
do {  
?>
        <option value="<?php echo $row_patient['userId']?>" <?php if (!(strcmp($row_patient['userId'], $row_patient['userId']))) {echo "SELECTED";} ?>><?php echo $row_patient['userName'];?></option>
        <?php
} while ($row_patient = mysql_fetch_assoc($patient));
?>
      </select>
      
      </td>
   		</tr>
        <tr>
      <th>Family Relation:</th>
      <td>
		<select name="familyRelation" class="styledselect_form_1">
			<option value="Father">Father</option>
			<option value="Mother">Mother</option>
			<option value="Grandfather">Grandfather</option>
			<option value="GrandMother">GrandMother</option>
			<option value="Brother">Brother</option>
            <option value="Sister">Sister</option>
		</select>
		</td>
   		</tr>
        <tr>
      <th>Ailment:</th>
      <td><input type="text" name="ailmentId" value="" size="32" class="inp-form"/></td>
   		</tr>
        <tr>
      <th>Diagnosis Date:</th>
      <td><input id="txtDate1" type="text" name="diagnosisDate" value="" size="32" class="inp-form"/></td>
   		<td><img alt="" src="Calendar/calender.gif"  style="float:right" onClick=" fnOpenCalendar('txtDate1');"/>
      </td>
        </tr>
        <tr>
      <th>Symptoms:</th>
      <td><input type="text" name="symptoms" value="" size="32" class="inp-form"/></td>
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
