<?php require_once('Connections/HMS.php');
include('mdl_Prescription.php');

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

$prescription = new Prescription();

if($_POST['formAction'] == "insert")
{
	$prescription->setDetails(GetSQLValueString($_POST['visitId'], "text"),
                       GetSQLValueString($_POST['medicineName'], "text"),
					   GetSQLValueString($_POST['Dosage'], "text"),
					   GetSQLValueString($_POST['Instruction'], "text"),
					   GetSQLValueString($_POST['Duration'], "text"),
                       GetSQLValueString($_POST['lineId'], "text"));
	if(!$prescription->insertprescription())
		die(mysql_error());
	else
		header('Location: ViewPrescription.php');
}
elseif($_POST['formAction'] == "update")
{
	session_start();
	$data = $prescription->getDetails($_POST['prescriptionId']);
	$_SESSION['data'] = $data;
	//echo "Hello update";
	//var_dump($_SESSION['data']);
	header('Location: AddPrescription.php?Mode=update');
}
elseif($_POST['formAction'] == "commit")
{
	$prescription->setDetails(GetSQLValueString($_POST['visitId'], "text"),
                       GetSQLValueString($_POST['medicineName'], "text"),
					   GetSQLValueString($_POST['Dosage'], "text"),
					   GetSQLValueString($_POST['Instruction'], "text"),
					   GetSQLValueString($_POST['Duration'], "text"),
                       GetSQLValueString($_POST['lineId'], "text"));
	if(!$prescription->updateprescription($_POST['prescriptionId']))
		die(mysql_error());
	else
		header('Location: ViewPrescription.php');
}
elseif($_POST['formAction'] == "delete")
{
	if(!$prescription->deleteprescription($_POST['prescriptionId']))
		die(mysql_error());
	else
		header('Location: ViewPrescription.php');
}
?>