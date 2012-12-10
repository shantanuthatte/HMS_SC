<?php require_once('Connections/HMS.php');
include('mdl_Ailment.php');
$flag;
function serverValidation()
{
	if(empty($_POST['ailmentName']))
		{
		$check1= "Ailment Name is required.";
		session_start();
		$_SESSION['Error'] = $check1;
		
		header("Location: AddAilment.php");
		return 1;
		}
	else if(strlen($_POST['ailmentName'])<3)
		{
		$check1= "Ailment Name requires at least 3 characters.";
		session_start();
		$_SESSION['Error'] = $check1;
		header("Location: AddAilment.php");
		return 1;
		}
		else
		{
			return 0;
		}
	
	}
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
$error="Following are errors:\n";
if($_POST['formAction'] == "insert")
{ 
	$flag= serverValidation();
	if($flag==0)
	{	
	$ailment->setDetails(GetSQLValueString($_POST['ailmentName'], "text"),
                       GetSQLValueString($_POST['symptoms'], "text"),
                       GetSQLValueString($_POST['comments'], "text"));
	if(!$ailment->insertAilment())
		die(mysql_error());
	else
		header('Location: ViewAilment.php');
		
	}
		
}
elseif($_POST['formAction'] == "update")
{
		
	session_start();
	$data = $ailment->getDetails($_POST['ailmentId']);
	$_SESSION['data'] = $data;
	header('Location: AddAilment.php?Mode=update');
	
}
elseif($_POST['formAction'] == "commit")
{
	$flag= serverValidation();
	if($flag==0)
	{
	$ailment->setDetails(GetSQLValueString($_POST['ailmentName'], "text"),
                       GetSQLValueString($_POST['symptoms'], "text"),
                       GetSQLValueString($_POST['comments'], "text"));
	if(!$ailment->updateailment($_POST['ailmentId']))
		die(mysql_error());
	else
		header('Location: ViewAilment.php');
	}
}
elseif($_POST['formAction'] == "delete")
{
	if(!$ailment->deleteailment($_POST['ailmentId']))
		die(mysql_error());
	else
		header('Location: ViewAilment.php');
}
?>