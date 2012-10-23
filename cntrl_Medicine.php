<?php require_once('Connections/HMS.php');
include('mdl_Medicine.php');

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

$medicine = new Medicine();

if($_POST['formAction'] == "insert")
{
	$medicine->setDetails(GetSQLValueString($_POST['medicineNm'], "text"),
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
	if(!$medicine->insertMedicine())
		die(mysql_error());
	else
		header('Location: ViewMedicine.php');
}
elseif($_POST['formAction'] == "update")
{
	session_start();
	$data = $medicine->getDetails($_POST['medicineId']);
	$_SESSION['data'] = $data;
	//echo "Hello";
	//var_dump($_SESSION['data']);
	header('Location: AddMedicine.php?Mode=update');
}
elseif($_POST['formAction'] == "commit")
{
	$medicine->setDetails(GetSQLValueString($_POST['medicineNm'], "text"),
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
	if(!$medicine->updateMedicine($_POST['medicineId']))
		die(mysql_error());
	else
		header('Location: ViewMedicine.php');
}
elseif($_POST['formAction'] == "delete")
{
	if(!$medicine->deleteMedicine($_POST['medicineId']))
		die(mysql_error());
	else
		header('Location: ViewMedicine.php');
}
?>