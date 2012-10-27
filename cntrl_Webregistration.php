<?php require_once('Connections/HMS.php');
include('mdl_WebRegistration.php');

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

$webregistration = new WebRegistration();

if($_POST['formAction'] == "insert")
{
	echo "AuthorityID";
	echo $_POST['authorityId'] ;
	$webregistration->setDetails(GetSQLValueString($_POST['registrationType'], "text"),
                       GetSQLValueString($_POST['registrationDate'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['authorityId'], "text"),
                       GetSQLValueString($_POST['comments'], "text"));
	if(!$webregistration->insertWebRegistration())
		die(mysql_error());
	else
		header('Location: ViewWebRegistration.php');
}
elseif($_POST['formAction'] == "update")
{
	session_start();
	$data = $webregistration->getDetails($_POST['registrationId']);
	$_SESSION['data'] = $data;
	//echo "Hello";
	//var_dump($_SESSION['data']);
	header('Location: AddWebRegistration.php?Mode=update');
}
elseif($_POST['formAction'] == "commit")
{
	$webregistration->setDetails(GetSQLValueString($_POST['registrationType'], "text"),
                       GetSQLValueString($_POST['registrationDate'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['authorityId'], "text"),
                       GetSQLValueString($_POST['comments'], "text"));
	if(!$webregistration->updateWebRegistration($_POST['registrationId']))
		die(mysql_error());
	else
		header('Location: ViewWebRegistration.php');
}
elseif($_POST['formAction'] == "delete")
{
	if(!$webregistration->deleteWebRegistration($_POST['registrationId']))
		die(mysql_error());
	else
		header('Location: ViewWebRegistration.php');
}
?>