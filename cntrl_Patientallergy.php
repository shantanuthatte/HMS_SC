<?php require_once('Connections/HMS.php');
include('mdl_Patientallergy.php');

$flag=0;
function serverValidation()
{
	$count=0;
	$retVal=0;
	$check1="";
		if(empty($_POST['patientId']))
		{
			$count = $count+1;
		$check1= $count.". Select Patient Id.,";
		$retVal=1;
		}
		if(empty($_POST['type']))
		{
			$count = $count+1;
		$check1=$check1. $count.". Select Allergy type.,";
		$retVal=1;
		}
		if(empty($_POST['allergy']))
		{
			$count = $count+1;
		$check1= $check1.$count.". Allergy is required.,";
		$retVal=1;
		}
		else if(strlen($_POST['allergy'])<3)
		{
			$count = $count+1;
		$check1= $check1.$count. ". Allergy requires at least 3 		characters.,";
		$retVal=1;
		}
	if(!empty($_POST['comments'])&& strlen($_POST['comments'])<3)
	{
		$count=$count+1;
		$check1= $check1.$count. ". Comments at least 3 characters.,";
		$retVal=1;
		}
	
		
		if($retVal==1)
		{
		session_start();
		$_SESSION['Error'] = $check1;
		header("Location: AddPatientallergy.php");
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

$patientallergy = new Patientallergy();

if($_POST['formAction'] == "insert")
{
	$flag= serverValidation();
	if($flag==0)
	{
	$patientallergy->setDetails(GetSQLValueString($_POST['patientId'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['allergy'], "text"),
                       GetSQLValueString($_POST['comments'], "text"));
	if(!$patientallergy->insertPatientallergy())
		die(mysql_error());
	else
		header('Location: ViewPatientallergy.php');
	}
}
elseif($_POST['formAction'] == "update")
{
	session_start();
	$data = $patientallergy->getDetails($_POST['allergyId']);
	$_SESSION['data'] = $data;
	//echo "Hello";
	//var_dump($_SESSION['data']);
	header('Location: AddPatientallergy.php?Mode=update');
	
}
elseif($_POST['formAction'] == "commit")
{
	$flag= serverValidation();
	if($flag==0)
	{
	$patientallergy->setDetails(GetSQLValueString($_POST['patientId'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['allergy'], "text"),
                       GetSQLValueString($_POST['comments'], "text"));
	if(!$patientallergy->updatePatientallergy($_POST['allergyId']))
		die(mysql_error());
	else
		header('Location: ViewPatientallergy.php');
	}
}
elseif($_POST['formAction'] == "delete")
{
	if(!$patientallergy->deletePatientallergy($_POST['allergyId']))
		die(mysql_error());
	else
		header('Location: ViewPatientallergy.php');
}
?>