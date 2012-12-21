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

$users = new Users();

if($_POST['formAction'] == "insert")
{
	$users->setDetails(GetSQLValueString($_POST['userName'], "text"),
                       GetSQLValueString(md5($_POST['password']), "text"),
                       GetSQLValueString($_POST['personId'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['recoveryEmail'], "text"),
                       GetSQLValueString($_POST['permission'], "text"));
	if(!$users->insertUser())
		die(mysql_error());
	else
		header('Location: ViewPerson.php');
}
elseif($_POST['formAction'] == "update")
{
	session_start();
	$data = $users->getDetails($_POST['userId']);
	$_SESSION['data'] = $data;
	echo "Hello";
	var_dump($_SESSION['data']);
	header('Location: AddUser.php?Mode=update');
}
elseif($_POST['formAction'] == "commit")
{
	$users->setDetails(GetSQLValueString($_POST['userName'], "text"),
                       GetSQLValueString(md5($_POST['password']), "text"),
                       GetSQLValueString($_POST['personId'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['recoveryEmail'], "text"),
                       GetSQLValueString($_POST['permission'], "text"));
	if(!$users->updateUser($_POST['userId']))
		die(mysql_error());
	else
		header('Location: ViewPerson.php');
}
elseif($_POST['formAction'] == "delete")
{
	if(!$users->deleteUser($_POST['userId']))
		die(mysql_error());
	else
		header('Location: ViewPerson.php');
}

//header('Location: ViewUsers.php');
?>