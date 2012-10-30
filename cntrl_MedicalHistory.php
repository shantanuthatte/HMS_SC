<?php require_once('Connections/HMS.php');
include('mdl_MedicalHistory.php');

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) 
  {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) 
  {
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

$medical = new MedicalHistory();

if($_POST['formAction'] == "insert")
{
	$medical->setDetails(GetSQLValueString($_POST['patientId'], "text"),
                       GetSQLValueString($_POST['ailmentId'], "text"),
					   GetSQLValueString($_POST['diagnosisDate'], "text"),
					   GetSQLValueString($_POST['symptoms'], "text"),
                       GetSQLValueString($_POST['comments'], "text"));
	if(!$medical->insertmedicalhistory())
		die(mysql_error());
	else
		header('Location: ViewMedicalHistory.php');
}
elseif($_POST['formAction'] == "update")
{
	session_start();
	$data = $medical->getDetails($_POST['medicalHisId']);
	$_SESSION['data'] = $data;
	//echo "Hello update";
	//var_dump($_SESSION['data']);
	header('Location: AddMedicalHistory.php?Mode=update');
}
elseif($_POST['formAction'] == "commit")
{
	$medical->setDetails(GetSQLValueString($_POST['patientId'], "text"),
                       GetSQLValueString($_POST['ailmentId'], "text"),
					   GetSQLValueString($_POST['diagnosisDate'], "text"),
					   GetSQLValueString($_POST['symptoms'], "text"),
                       GetSQLValueString($_POST['comments'], "text"));
	if(!$medical->updatemedicalhistory($_POST['medicalHisId']))
		die(mysql_error());
	else
		header('Location: ViewMedicalHistory.php');
}
elseif($_POST['formAction'] == "delete")
{
	if(!$medical->deletemedicalhistory($_POST['medicalHisId']))
		die(mysql_error());
	else
		header('Location: ViewMedicalHistory.php');
}
?>