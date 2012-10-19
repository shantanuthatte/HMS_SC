<?php require_once('Connections/HMS.php');
include('mdl_Users.php');

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
if (!isset($_GET['userid'])) 
{
  die("Parameter is missing!");  
}


$users = new Users();

if($_POST['formAction'] == "insert")
{
	$users->setDetails(GetSQLValueString($_POST['userName'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['personId'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['recoveryEmail'], "text"),
                       GetSQLValueString($_POST['permission'], "text"));
	if(!$users->insertusers())
		die(mysql_error());
}
elseif($_POST['formAction'] == "update")
{
	session_start();
	$data = $users->getDetails($_POST['userId']);
	$_SESSION['data'] = $data;
	//echo "Hello";
	//var_dump($_SESSION['data']);
	header('Location: AddUsers.php?Mode=update');
}
elseif($_POST['formAction'] == "commit")
{
	$person->setDetails(GetSQLValueString($_POST['userName'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['personId'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['recoveryEmail'], "text"),
                       GetSQLValueString($_POST['permission'], "text"));
	if(!$users->updateusers($_POST['userId']))
		die(mysql_error());
}
elseif($_POST['formAction'] == "delete")
{
	if(!$users->deleteusers($_POST['userId']))
		die(mysql_error());
}

header('Location: ViewUsers.php');
?>