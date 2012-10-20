<?php require_once('Connections/HMS.php');
include('mdl_Frequency.php');
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

$frequency = new Frequency();

if($_POST['formAction'] == "insert")
{
	$frequency->setDetails(GetSQLValueString($_POST['frequency'], "text"));
	if(!$frequency->insertfrequency())
		die(mysql_error());
	else
		header('Location: ViewFrequency.php');
}
elseif($_POST['formAction'] == "update")
{
	session_start();
	$data = $frequency->getDetails($_POST['frequencyId']);
	$_SESSION['data'] = $data;
	//echo "Hello";
	//var_dump($_SESSION['data']);
	header('Location: AddFrequency.php?Mode=update');
}
elseif($_POST['formAction'] == "commit")
{
	$frequency->setDetails(GetSQLValueString($_POST['frequency'], "text"));
	if(!$frequency->updatefrequency($_POST['frequencyId']))
		die(mysql_error());
	else
		header('Location: ViewFrequency.php');
}
elseif($_POST['formAction'] == "delete")
{
	if(!$frequency->deleteFrequency($_POST['frequencyId']))
		die(mysql_error());
	else
		header('Location: ViewFrequency.php');
}
?>