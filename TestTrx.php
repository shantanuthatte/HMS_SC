<?php require_once('Connections/HMS.php'); ?>
<?php
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
	$testhuid = md5(uniqid().time());
  $insertSQL = sprintf("INSERT INTO clinicaltesth (patientId, doctorId, testDate, doctorName, testhuid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['patientId'], "int"),
                       GetSQLValueString($_POST['doctorId'], "int"),
                       GetSQLValueString($_POST['testDate'], "date"),
                       GetSQLValueString($_POST['doctorName'], "text"),
					   GetSQLValueString($testhuid, "text"));

  mysql_select_db($database_HMS, $HMS);
  $Result1 = mysql_query($insertSQL, $HMS) or die(mysql_error());
  $query = "SELECT * FROM clinicaltesth WHERE testhuid LIKE '$testhuid'";
  $res = mysql_query($query, $HMS);
  if($res != NULL)
  {
  $row_res = mysql_fetch_assoc($res);
  $testHId = $row_res['testHId'];
    echo "Result: ";
  var_dump($query, $res);

  $insertSQL = sprintf("INSERT INTO clinicaltestd (testHId, testId, reportDtl, fileNm, summary) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($testHId, "int"),
                       GetSQLValueString($_POST['testId'], "int"),
                       GetSQLValueString($_POST['reportDtl'], "text"),
                       GetSQLValueString($_POST['fileNm'], "text"),
                       GetSQLValueString($_POST['summary'], "text"));
  }
  else
  	die(mysql_error());
  mysql_select_db($database_HMS, $HMS);
  $Result1 = mysql_query($insertSQL, $HMS) or die(mysql_error());
  echo "Result: ";
  var_dump($insertSQL);
  //exit(0);
}

mysql_select_db($database_HMS, $HMS);
$query_person = "SELECT * FROM person";
$person = mysql_query($query_person, $HMS) or die(mysql_error());
$row_person = mysql_fetch_assoc($person);
$totalRows_person = mysql_num_rows($person);


$query_clinicalTest = "SELECT * FROM clinicaltest";
$clinicalTest = mysql_query($query_clinicalTest, $HMS) or die(mysql_error());
$row_clinicalTest = mysql_fetch_assoc($clinicalTest);
$totalRows_clinicalTest = mysql_num_rows($clinicalTest);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<p>&nbsp;</p>
<form action="TestTrx.php" method="post" name="form1" id="form1">
<table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Patient:</td>
      <td><select name="patientId">
        <?php do {  ?>
        <option value="<?php echo $row_person['personId']?>" <?php if (!(strcmp($row_person['personId'], $row_person['personId']))) {echo "SELECTED";} ?>><?php echo $row_person['fName']." ".$row_person['lName'];?></option>
        <?php 
		} while ($row_person = mysql_fetch_assoc($person));
		mysql_data_seek($person, 0);?></select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Doctor:</td>
      <td><select name="doctorId">
        <?php do {  ?>
        <option value="<?php echo $row_person['personId']?>" <?php if (!(strcmp($row_person['personId'], $row_person['personId']))) {echo "SELECTED";} ?>><?php echo $row_person['fName']." ".$row_person['lName'];?></option>
        <?php 
		} while ($row_person = mysql_fetch_assoc($person));
		?></select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">TestDate:</td>
      <td><input type="text" name="testDate" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">DoctorName:</td>
      <td><input type="text" name="doctorName" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />

<p>&nbsp;</p>

  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Test:</td>
      <td><select name="testId" >
        <?php do {  ?>
        <option value="<?php echo $row_clinicalTest['testId']?>" <?php if (!(strcmp($row_clinicalTest['testId'], $row_clinicalTest['testId']))) {echo "SELECTED";} ?>><?php echo $row_clinicalTest['name'];?></option>
        <?php 
		} while ($row_clinicalTest = mysql_fetch_assoc($clinicalTest));?></select></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap="nowrap" align="right">ReportDtl:</td>
      <td><textarea name= "ReportDtl" cols="" rows="3" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">FileNm:</td>
      <td><input type="text" name="fileNm" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Summary:</td>
      <td><textarea name="summary" value="" size="32" rows="3"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record" /></td>
    </tr>
  </table>  
</form>
<p>&nbsp;</p>
</body>
</html>