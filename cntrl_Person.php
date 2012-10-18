<?php require_once('Connections/HMS.php');
include('mdl_Person.php');

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

$person = new Person();

if($_POST['formAction'] == "insert")
{
	$person->setDetails(GetSQLValueString($_POST['fName'], "text"),
                       GetSQLValueString($_POST['mName'], "text"),
                       GetSQLValueString($_POST['lName'], "text"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['rPhone'], "text"),
                       GetSQLValueString($_POST['mobile'], "text"),
                       GetSQLValueString($_POST['registrationNo'], "text"),
                       GetSQLValueString($_POST['gender'], "text"),
                       GetSQLValueString($_POST['DOB'], "text"),
                       GetSQLValueString($_POST['email'], "text"));
	if(!$person->insertPerson())
		die(mysql_error());
}
elseif($_POST['formAction'] == "update")
{
	session_start();
	$data = $person->getDetails($_POST['personId']);
	$_SESSION['data'] = $data;
	//echo "Hello";
	//var_dump($_SESSION['data']);
	header('Location: AddPerson.php?Mode=update');
}
elseif($_POST['formAction'] == "commit")
{
	$person->setDetails(GetSQLValueString($_POST['fName'], "text"),
                       GetSQLValueString($_POST['mName'], "text"),
                       GetSQLValueString($_POST['lName'], "text"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['rPhone'], "text"),
                       GetSQLValueString($_POST['mobile'], "text"),
                       GetSQLValueString($_POST['registrationNo'], "text"),
                       GetSQLValueString($_POST['gender'], "text"),
                       GetSQLValueString($_POST['DOB'], "text"),
                       GetSQLValueString($_POST['email'], "text"));
	if(!$person->updatePerson($_POST['personId']))
		die(mysql_error());
}
elseif($_POST['formAction'] == "delete")
{
	if(!$person->deletePerson($_POST['personId']))
		die(mysql_error());
}

header('Location: ViewPerson.php');
?>