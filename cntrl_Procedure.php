<?php require_once('Connections/HMS.php');
include('mdl_Procedure.php');

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

$procedure = new Procedure();

if($_POST['formAction'] == "insert")
{
	$procedure->setDetails(GetSQLValueString($_POST['procedure'], "text"),
                       GetSQLValueString($_POST['comments'], "text"));
	if(!$procedure->insertProcedure())
		die(mysql_error());
	else
		header('Location: ViewProcedure.php');
}
elseif($_POST['formAction'] == "update")
{
	session_start();
	$data = $procedure->getDetails($_POST['procedureId']);
	$_SESSION['data'] = $data;
	//echo "Hello";
	//var_dump($_SESSION['data']);
	header('Location: AddProcedure.php?Mode=update');
}
elseif($_POST['formAction'] == "commit")
{
	$procedure->setDetails(GetSQLValueString($_POST['procedure'], "text"),
                       GetSQLValueString($_POST['comments'], "text"));
	if(!$procedure->updateProcedure($_POST['procedureId']))
		die(mysql_error());
	else
		header('Location: ViewProcedure.php');
}
elseif($_POST['formAction'] == "delete")
{
	if(!$procedure->deleteProcedure($_POST['procedureId']))
		die(mysql_error());
	else
		header('Location: ViewProcedure.php');
}
?>