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
  $insertSQL = sprintf("INSERT INTO users (userName, password, type, recoveryEmail, permission, personId) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['userName'], "text"),
                       GetSQLValueString(md5($_POST['password']), "text"),
                       GetSQLValueString($_POST['type'], "int"),
                       GetSQLValueString($_POST['recoveryEmail'], "text"),
                       GetSQLValueString($_POST['permission'], "text"),
                       GetSQLValueString($_POST['personId'], "int"));

  mysql_select_db($database_HMS, $HMS);
  $Result1 = mysql_query($insertSQL, $HMS) or die(mysql_error());
}

mysql_select_db($database_HMS, $HMS);
$query_person = "SELECT * FROM person";
$person = mysql_query($query_person, $HMS) or die(mysql_error());
$row_person = mysql_fetch_assoc($person);
$totalRows_person = mysql_num_rows($person);
?>
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
<div id="page-heading"><h1>Add User</h1></div>

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
    <tr >
      <th >UserName:</th>
      <td><input type="text" name="userName" value="" size="32" class="inp-form"/></td>
    </tr>
    <tr >
      <th>Password:</th>
      <td><input type="text" name="password" value="" size="32" class="inp-form"/></td>
    </tr>
    <tr >
      <th>Type:</th>
      <td><input type="text" name="type" value="" size="32" class="inp-form"/></td>
    </tr>
    <tr >
      <th>RecoveryEmail:</th>
      <td><input type="text" name="recoveryEmail" value="" size="32" class="inp-form"/></td>
    </tr>
    <tr >
      <th >Permission:</th>
      <td><input type="text" name="permission" value="" size="32" class="inp-form" /></td>
    </tr>
    <tr >
      <th >PersonId:</th>
      <td><select name="personId" class="styledselect_form_1">
        <?php 
do {  
?>
        <option value="<?php echo $row_person['personId']?>" <?php if (!(strcmp($row_person['personId'], $row_person['personId']))) {echo "SELECTED";} ?>><?php echo $row_person['fName']." ".$row_person['lName'];?></option>
        <?php
} while ($row_person = mysql_fetch_assoc($person));
?>
      </select></td>
    </tr>
    <tr> </tr>    
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
<?php
mysql_free_result($person);
?>
