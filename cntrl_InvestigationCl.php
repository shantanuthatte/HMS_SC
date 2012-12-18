<?php require_once('Connections/HMS.php');
include('mdl_InvestigationCl.php');

$flag=0;
function serverValidation()
{
		$count=0;
		$retVal=0;
		$check1="";
		$groupId =  GetSQLValueString($_POST['grId'], "text");
		if(empty($groupId)) 
		{
			$count = $count+1;
			$check1= $count.". Select Group Id.,";
			$retVal=1;
		}
		if(empty($_POST['className']))
		{
			$count=$count+1;
			$check1= $check1.$count. ". Class Name is required.,";
			$retVal=1;
		}
		else if(strlen($_POST['className'])<3)
		{
				$count=$count+1;
				$check1= $check1.$count. ". Class Name requires at least 3 characters.,";
			$retVal=1;
		}
		
		if($retVal==1)
		{
		session_start();
		$_SESSION['Error'] = $check1;
		header("Location: AddInvestigationCl.php");
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

$invstcl = new InvestigationCl();

if($_POST['formAction'] == "insert")
{	
	$flag= serverValidation();
	if($flag==0)
	{
	$invstcl->setDetails(GetSQLValueString($_POST['grId'], "text"),
						GetSQLValueString($_POST['classId'], "text"),
                       GetSQLValueString($_POST['className'], "text"));
	if(!$invstcl->insertinvestigationcl())
		die(mysql_error());
	else
		header('Location: ViewInvestigationCl.php');
	}
}
elseif($_POST['formAction'] == "update")
{	
	session_start();
	$data = $invstcl->getDetails($_POST['grId'], $_POST['classId']);
	$_SESSION['data'] = $data;
	//echo "Hello update";
	//var_dump($_SESSION['data']);
	header('Location: AddInvestigationCl.php?Mode=update');
	
}
elseif($_POST['formAction'] == "commit")
{
	$flag= serverValidation();
	if($flag==0)
	{
	$invstcl->setDetails(GetSQLValueString($_POST['grId'], "text"),
					GetSQLValueString($_POST['classId'], "text"),
                       GetSQLValueString($_POST['className'], "text"));
	if(!$invstcl->updateinvestigationcl($_POST['grId'], $_POST['classId']))
		die(mysql_error());
	else
		header('Location: ViewInvestigationCl.php');
	}
}
elseif($_POST['formAction'] == "delete")
{
	if(!$invstcl->deleteinvestigationcl($_POST['grId'], $_POST['classId']))
		die(mysql_error());
	else
		header('Location: ViewInvestigationCl.php');
}
?>