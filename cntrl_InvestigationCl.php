<?php require_once('Connections/HMS.php');
include('mdl_InvestigationCl.php');

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

$invstcl = new InvestigationCl();

if($_POST['formAction'] == "insert")
{
	$invstcl->setDetails(GetSQLValueString($_POST['className'], "text"));
	if(!$invstcl->insertinvestigationcl())
		die(mysql_error());
	else
		header('Location: ViewInvestigationCl.php');
}
elseif($_POST['formAction'] == "update")
{
	session_start();
	$data = $invstcl->getDetails($_POST['grId']);
	$_SESSION['data'] = $data;
	//echo "Hello update";
	//var_dump($_SESSION['data']);
	header('Location: AddInvestigationCl.php?Mode=update');
}
elseif($_POST['formAction'] == "commit")
{
	$invstcl->setDetails(GetSQLValueString($_POST['className'], "text"));
	if(!$invstcl->updateinvestigationcl($_POST['grId']))
		die(mysql_error());
	else
		header('Location: ViewInvestigationCl.php');
}
elseif($_POST['formAction'] == "delete")
{
	if(!$invstcl->deleteinvestigationcl($_POST['grId']))
		die(mysql_error());
	else
		header('Location: ViewInvestigationCl.php');
}
?>