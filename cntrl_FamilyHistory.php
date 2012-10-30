<?php require_once('Connections/HMS.php');
include('mdl_FamilyHistory.php');

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

$famhis = new FamilyHistory();

if($_POST['formAction'] == "insert")
{
	$famhis->setDetails(GetSQLValueString($_POST['patientId'], "text"),
					   GetSQLValueString($_POST['familyRelation'], "text"),
					   GetSQLValueString($_POST['ailmentId'], "text"),
					   GetSQLValueString($_POST['diagnosisDate'], "text"),
					   GetSQLValueString($_POST['symptoms'], "text"),
					   GetSQLValueString($_POST['comments'], "text"));
	if(!$famhis->insertfamilyhistory())
		die(mysql_error());
	else
		header('Location: ViewFamilyHistory.php');
}
elseif($_POST['formAction'] == "update")
{
	session_start();
	$data = $famhis->getDetails($_POST['familyHisId']);
	$_SESSION['data'] = $data;
	//echo "Hello update";
	//var_dump($_SESSION['data']);
	header('Location: AddFamilyHistory.php?Mode=update');
}
elseif($_POST['formAction'] == "commit")
{
	$famhis->setDetails(GetSQLValueString($_POST['patientId'], "text"),
					   GetSQLValueString($_POST['familyRelation'], "text"),
					   GetSQLValueString($_POST['ailmentId'], "text"),
					   GetSQLValueString($_POST['diagnosisDate'], "text"),
					   GetSQLValueString($_POST['symptoms'], "text"),
					   GetSQLValueString($_POST['comments'], "text"));
	if(!$famhis->updatefamilyhistory($_POST['familyHisId']))
		die(mysql_error());
	else
		header('Location: ViewFamilyHistory.php');
}
elseif($_POST['formAction'] == "delete")
{
	if(!$famhis->deletefamilyhistory($_POST['familyHisId']))
		die(mysql_error());
	else
		header('Location: ViewFamilyHistory.php');
}
?>