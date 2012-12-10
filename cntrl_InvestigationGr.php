<?php require_once('Connections/HMS.php');
include('mdl_InvestigationGr.php');

$flag;
function serverValidation()
{
	if(empty($_POST['groupName']))
		{
		$check1= "Group Name is required.";
		session_start();
		$_SESSION['Error'] = $check1;
		
		header("Location: AddInvestigationGr.php");
		return 1;
		}
	else if(strlen($_POST['groupName'])<3)
		{
		$check1= "GroupName requires at least 3 characters.";
		session_start();
		$_SESSION['Error'] = $check1;
		header("Location: AddInvestigationGr.php");
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

$invstgr = new InvestigationGr();

if($_POST['formAction'] == "insert")
{
	$flag= serverValidation();
	if($flag==0)
	{
	$invstgr->setDetails(GetSQLValueString($_POST['groupName'], "text"));
	if(!$invstgr->insertinvestigationgr())
		die(mysql_error());
	else
		header('Location: ViewInvestigationGr.php');
	}
}
elseif($_POST['formAction'] == "update")
{
	session_start();
	$data = $invstgr->getDetails($_POST['groupId']);
	$_SESSION['data'] = $data;
	header('Location: AddInvestigationGr.php?Mode=update');
}
elseif($_POST['formAction'] == "commit")
{
	$flag= serverValidation();
	if($flag==0)
	{
	$invstgr->setDetails(GetSQLValueString($_POST['groupName'], "text"));
	if(!$invstgr->updateinvestigationgr($_POST['groupId']))
		die(mysql_error());
	else
		header('Location: ViewInvestigationGr.php');
	}
}
elseif($_POST['formAction'] == "delete")
{
	if(!$invstgr->deleteinvestigationgr($_POST['groupId']))
		die(mysql_error());
	else
		header('Location: ViewInvestigationGr.php');
}
?>