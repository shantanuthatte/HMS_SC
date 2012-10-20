<?php require_once('Connections/HMS.php');
include('mdl_Ailment.php');

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

$ailment = new Ailment();

if($_POST['formAction'] == "insert")
{
	$ailment->setDetails(GetSQLValueString($_POST['ailmentName'], "text"),
                       GetSQLValueString($_POST['symptoms'], "text"),
                       GetSQLValueString($_POST['comments'], "text"));
	if(!$ailment->insertAilment())
		die(mysql_error());
	else
		header('Location: ViewAilment.php');
}
elseif($_POST['formAction'] == "update")
{
	session_start();
	$data = $ailment->getDetails($_POST['ailmentId']);
	$_SESSION['data'] = $data;
	//echo "Hello update";
	//var_dump($_SESSION['data']);
	header('Location: AddAilment.php?Mode=update');
}
elseif($_POST['formAction'] == "commit")
{
	$ailment->setDetails(GetSQLValueString($_POST['ailmentName'], "text"),
                       GetSQLValueString($_POST['symptoms'], "text"),
                       GetSQLValueString($_POST['comments'], "text"));
	if(!$ailment->updateailment($_POST['ailmentId']))
		die(mysql_error());
	else
		header('Location: ViewAilment.php');
}
elseif($_POST['formAction'] == "delete")
{
	if(!$ailment->deleteailment($_POST['ailmentId']))
		die(mysql_error());
	else
		header('Location: ViewAilment.php');
}
?>