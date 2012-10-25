<?php require_once('Connections/HMS.php');
include('mdl_UserRegistrationlink.php');

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

$userreglink = new UserRegistrationlink();

if($_POST['formAction'] == "insert")
{
	$userreglink->setDetails(GetSQLValueString($_POST['registrationId'], "text"),
                       GetSQLValueString($_POST['userId'], "text"));
	if(!$userreglink->insertUserRegistrationlink())
		die(mysql_error());
	else
		header('Location: ViewUserRegistrationlink.php');
}
elseif($_POST['formAction'] == "update")
{
	session_start();
	$data = $userreglink->getDetails($_POST['userRegLinkId']);
	$_SESSION['data'] = $data;
	//echo "Hello";
	//var_dump($_SESSION['data']);
	header('Location: AddUserRegistrationlink.php?Mode=update');
}
elseif($_POST['formAction'] == "commit")
{
	$userreglink->setDetails(GetSQLValueString($_POST['registrationId'], "text"),
                       GetSQLValueString($_POST['userId'], "text"));
	if(!$userreglink->updateUserRegistrationlink($_POST['userId']))
		die(mysql_error());
	else
		header('Location: ViewUserRegistrationlink.php');
}
elseif($_POST['formAction'] == "delete")
{
	if(!$userreglink->deleteUserRegistrationlink($_POST['userId']))
		die(mysql_error());
	else
		header('Location: ViewUserRegistrationlink.php');
}
?>