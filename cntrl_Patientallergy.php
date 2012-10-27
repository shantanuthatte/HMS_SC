<?php require_once('Connections/HMS.php');
include('mdl_Patientallergy.php');

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

$patientallergy = new Patientallergy();

if($_POST['formAction'] == "insert")
{
	$patientallergy->setDetails(GetSQLValueString($_POST['patientId'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['allergy'], "text"),
                       GetSQLValueString($_POST['comments'], "text"));
	if(!$patientallergy->insertPatientallergy())
		die(mysql_error());
	else
		header('Location: ViewPatientallergy.php');
}
elseif($_POST['formAction'] == "update")
{
	session_start();
	$data = $patientallergy->getDetails($_POST['allergyId']);
	$_SESSION['data'] = $data;
	//echo "Hello";
	//var_dump($_SESSION['data']);
	header('Location: AddPatientallergy.php?Mode=update');
}
elseif($_POST['formAction'] == "commit")
{
	$patientallergy->setDetails(GetSQLValueString($_POST['patientId'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['allergy'], "text"),
                       GetSQLValueString($_POST['comments'], "text"));
	if(!$patientallergy->updatePatientallergy($_POST['allergyId']))
		die(mysql_error());
	else
		header('Location: ViewPatientallergy.php');
}
elseif($_POST['formAction'] == "delete")
{
	if(!$patientallergy->deletePatientallergy($_POST['allergyId']))
		die(mysql_error());
	else
		header('Location: ViewPatientallergy.php');
}
?>