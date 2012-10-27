<?php require_once('Connections/HMS.php');
include('mdl_InvestigationMst.php');

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

$invstmst = new InvestigationMaster();

if($_POST['formAction'] == "insert")
{
	$invstmst->setDetails(GetSQLValueString($_POST['invstName'], "text"),
                       GetSQLValueString($_POST['info'], "text"),
                       GetSQLValueString($_POST['sexFlag'], "text"),
                       GetSQLValueString($_POST['toVal1'], "text"),
					   GetSQLValueString($_POST['fromVal1'], "text"),
                       GetSQLValueString($_POST['toVal2'], "text"),
                       GetSQLValueString($_POST['fromVal2'], "text"),
                       GetSQLValueString($_POST['impression'], "text"),
                       GetSQLValueString($_POST['result'], "text"),
					   GetSQLValueString($_POST['unit'], "text"),
                       GetSQLValueString($_POST['charges'], "text"));
	if(!$invstmst->insertInvestigationmst())
		die(mysql_error());
	else
		header('Location: ViewInvestigationMst.php');
}
elseif($_POST['formAction'] == "update")
{
	session_start();
	$data = $invstmst->getDetails($_POST['invstId']);
	$_SESSION['data'] = $data;
	//echo "Hello";
	//var_dump($_SESSION['data']);
	header('Location: AddInvestigationmst.php?Mode=update');
}
elseif($_POST['formAction'] == "commit")
{
	$invstmst->setDetails(GetSQLValueString($_POST['invstName'], "text"),
                       GetSQLValueString($_POST['info'], "text"),
                       GetSQLValueString($_POST['sexFlag'], "text"),
                       GetSQLValueString($_POST['toVal1'], "text"),
					   GetSQLValueString($_POST['fromVal1'], "text"),
                       GetSQLValueString($_POST['toVal2'], "text"),
                       GetSQLValueString($_POST['fromVal2'], "text"),
                       GetSQLValueString($_POST['impression'], "text"),
                       GetSQLValueString($_POST['result'], "text"),
					   GetSQLValueString($_POST['unit'], "text"),
                       GetSQLValueString($_POST['charges'], "text"));
	if(!$invstmst->updateInvestigationmst($_POST['invstId']))
		die(mysql_error());
	else
		header('Location: ViewInvestigationMst.php');
}
elseif($_POST['formAction'] == "delete")
{
	if(!$invstmst->deleteInvestigationmst($_POST['invstId']))
		die(mysql_error());
	else
		header('Location: ViewInvestigationMst.php');
}
?>