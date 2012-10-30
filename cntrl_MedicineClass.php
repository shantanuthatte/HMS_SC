<?php require_once('Connections/HMS.php');
include('mdl_MedicineClass.php');

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

$mediclass = new MedicineClass();

if($_POST['formAction'] == "insert")
{
	$mediclass->setDetails(GetSQLValueString($_POST['classIId'], "text"),
                       GetSQLValueString($_POST['className'], "text"));
	if(!$mediclass->insertmedicineclass())
		die(mysql_error());
	else
		header('Location: ViewMedicineClass.php');
}
elseif($_POST['formAction'] == "update")
{
	session_start();
	$data = $mediclass->getDetails($_POST['classId']);
	$_SESSION['data'] = $data;
	//echo "Hello update";
	//var_dump($_SESSION['data']);
	header('Location: AddMedicineClass.php?Mode=update');
}
elseif($_POST['formAction'] == "commit")
{
	$mediclass->setDetails(GetSQLValueString($_POST['classId'], "text"),
                       GetSQLValueString($_POST['className'], "text"));
	if(!$mediclass->updatemedicineclass($_POST['classId']))
		die(mysql_error());
	else
		header('Location: ViewMedicineClass.php');
}
elseif($_POST['formAction'] == "delete")
{
	if(!$mediclass->deletemedicineclass($_POST['classId']))
		die(mysql_error());
	else
		header('Location: ViewMedicineClass.php');
}
?>