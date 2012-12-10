<?php require_once('Connections/HMS.php');
include('mdl_InvestigationMst.php');

$flag=0;
function serverValidation()
{
	$count=0;
	$retVal=0;
	$check1="";
	if(empty($_POST['invstName']))
		{
			$count=$count+1;
		$check1= $count.". Investigation Name is required.,";
		$retVal=1;
		}
	else if(strlen($_POST['invstName'])<3)
		{
			$count=$count+1;
		$check1= $check1.$count. ". Investigation Name at least 3 characters.,";
		$retVal=1;
		}
	if(empty($_POST['toVal1']))
	{
		$count=$count+1;
		$check1= $check1.$count. ". To Val1 is required.,";
		$retVal=1;
		}
		else if(is_numeric($_POST['toVal1'])==false)
		{
			$count = $count+1;
		$check1= $check1. $count .". To Val 1 requires at least 6 digits.,";
		$retVal=1;
		}
	else if(strlen((string)$_POST['toVal1'])<2)
		{
			$count=$count+1;
		$check1= $check1.$count. ". To Val 1 requires at least 6 digits.,";
		$retVal=1;
		}
		
		
		
		if(empty($_POST['fromVal1']))
	{
		$count=$count+1;
		$check1= $check1.$count. ". From Val 1 is required.,";
		$retVal=1;
		}
		else if(is_numeric($_POST['fromVal1'])==false)
		{
			$count = $count+1;
		$check1= $check1. $count .". From Val 1 requires at least 6 digits.,";
		$retVal=1;
		}
	else if(strlen((string)$_POST['fromVal1'])<2)
		{
			$count=$count+1;
		$check1= $check1.$count. ". From Val 1 requires at least 6 digits.,";
		$retVal=1;
		}
		
		
		
		if(empty($_POST['toVal2']))
	{
		$count=$count+1;
		$check1= $check1.$count. ". To Val 2 is required.,";
		$retVal=1;
		}
		else if(is_numeric($_POST['toVal2'])==false)
		{
			$count = $count+1;
		$check1= $check1. $count .". To Val 2 requires at least 6 digits.,";
		$retVal=1;
		}
	else if(strlen((string)$_POST['toVal2'])<2)
		{
			$count=$count+1;
		$check1= $check1.$count. ". To Val 2 requires at least 6 digits.,";
		$retVal=1;
		}
		if(empty($_POST['fromVal2']))
	{
		$count=$count+1;
		$check1= $check1.$count. ". From Val 2 is required.,";
		$retVal=1;
		}
		else if(is_numeric($_POST['fromVal2'])==false)
		{
			$count = $count+1;
		$check1= $check1. $count .". From Val 2 requires at least 6 digits.,";
		$retVal=1;
		}
	else if(strlen((string)$_POST['fromVal2'])<2)
		{
			$count=$count+1;
		$check1= $check1.$count. ". From Val 2 requires at least 6 digits.,";
		$retVal=1;
		}
		
		if($retVal==1)
		{
		session_start();
		$_SESSION['Error'] = $check1;
		header("Location: AddInvestigationMst.php");
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

$invstmst = new InvestigationMaster();

if($_POST['formAction'] == "insert")
{
	$flag= serverValidation();
	if($flag==0)
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
	$flag= serverValidation();
	if($flag==0)
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
}
elseif($_POST['formAction'] == "delete")
{
	if(!$invstmst->deleteInvestigationmst($_POST['invstId']))
		die(mysql_error());
	else
		header('Location: ViewInvestigationMst.php');
}
?>