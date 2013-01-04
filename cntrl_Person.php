<?php require_once('Connections/HMS.php');
include('mdl_Person.php');

function serverValidation()
{
	$count=0;
	$retVal=0;
	$check1="";
	if(empty($_POST['fName']))
		{
			$count = $count+1;
		$check1= $count.". First Name is required.,";
		$retVal=1;
		
		}
	else if(is_numeric($_POST['fName']))
	{
		$count = $count+1;
		$check1= $count.". Enter Alphabets in First Name.,";
		$retVal=1;
	}
		    
	else if(strlen($_POST['fName'])<3)
		{
			$count = $count+1;
		$check1= $check1.$count. ". First Name requires at least 3 characters.,";
		$retVal=1;
		}
		
	if(empty($_POST['lName']))
	{
		$count = $count+1;
		$check1= $check1. $count .". Last Name is required.,";
		$retVal=1;
		}
		else if(is_numeric($_POST['lName']))
	{
		$count = $count+1;
		$check1= $count.". Enter Alphabets in Last Name.,";
		$retVal=1;
	}
	else if(strlen($_POST['lName'])<3)
		{
			$count = $count+1;
		$check1= $check1. $count .". Last Name requires at least 3 characters.,";
		$retVal=1;
		}
		
	if(empty($_POST['email']))
	{
		$count = $count+1;
		$check1= $check1. $count .". Email is required.,";
		$retVal=1;
		}
	else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
		{
			$count = $count+1;
		$check1= $check1 . $count .". Enter a valid Email address.,";
		$retVal=1;
		}
		
		if(empty($_POST['pin']))
		{
			$count = $count+1;
		$check1= $check1 . $count .". PIN Code is required.,";
		$retVal=1;
		}
		else if(is_numeric($_POST['pin'])==false)
		{
			$count = $count+1;
		$check1= $check1. $count .". PIN Code requires at least 6 digits.,";
		$retVal=1;
		}
		else if(strlen((string)$_POST['pin'])<6)
		{
			$count = $count+1;
		$check1= $check1. $count .". PIN Code field requires at least 6 digits.,";
		$retVal=1;
		}
		
		if(empty($_POST['mobile']))
		{
			$count = $count+1;
		$check1= $check1. $count .". Mobile field is required.,";
		$retVal=1;
		}
		else if(is_numeric($_POST['mobile'])==false)
		{
			$count = $count+1;
		$check1= $check1. $count .". Mobile field requires at  digits.,";
		$retVal=1;
		}
		else if(strlen((string)$_POST['mobile'])<10)
		{
			$count = $count+1;
		$check1= $check1. $count .". Mobile field requires at  digits.,";
		$retVal=1;
		}
		
		if(empty($_POST['DOB']))
	   {
		   $count = $count+1;
		$check1= $check1. $count .". Date Of Birth is required.";
		$retVal=1;
		}
		
		
		
		if($retVal==1)
		{
		session_start();
		$_SESSION['Error'] = $check1;
			if($_POST['type'] == 0)
			{
			header('Location: AddDoctor.php');
			}
			else
			{
			header('Location: AddPerson.php');
			}
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

$person = new Person();

if($_POST['formAction'] == "insert")
{
	
	$flag= serverValidation();
	if($flag==0)
	{
		$insertdate= date_create($_POST['diagnosisDate']);
		$DOB = date_format ( $insertdate, "Y-m-d");
	$person->setDetails(GetSQLValueString($_POST['fName'], "text"),
                       GetSQLValueString($_POST['mName'], "text"),
                       GetSQLValueString($_POST['lName'], "text"),
                       GetSQLValueString($_POST['address'], "text"),
					   GetSQLValueString($_POST['area'], "text"),
					   GetSQLValueString($_POST['city'], "text"),
					   GetSQLValueString($_POST['state'], "text"),
					   GetSQLValueString($_POST['pin'], "text"),
                       GetSQLValueString($_POST['rPhone'], "text"),
                       GetSQLValueString($_POST['mobile'], "text"),
                       GetSQLValueString($_POST['registrationNo'], "text"),
                       GetSQLValueString($_POST['gender'], "text"),
                       GetSQLValueString($DOB, "date"),
					   GetSQLValueString($_POST['maritalStatus'], "text"),
					   GetSQLValueString($_POST['bloodGroup'], "text"),
					   GetSQLValueString($_POST['occupation'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
					   GetSQLValueString($_POST['type'], "int"));
					   
					   
			  

						if(!$person->insertPerson())
							die(mysql_error());
						else if($_POST['type'] == 0)
							{
							header('Location: ViewDoctor.php');
							}
						else
							header('Location: ViewPerson.php');
	}
	
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
	$flag= serverValidation();
	if($flag==0)
	{
		$insertdate= date_create($_POST['diagnosisDate']);
		$DOB = date_format ( $insertdate, "Y-m-d");
	$person->setDetails(GetSQLValueString($_POST['fName'], "text"),
                       GetSQLValueString($_POST['mName'], "text"),
                       GetSQLValueString($_POST['lName'], "text"),
                       GetSQLValueString($_POST['address'], "text"),
					   GetSQLValueString($_POST['area'], "text"),
					   GetSQLValueString($_POST['city'], "text"),
					   GetSQLValueString($_POST['state'], "text"),
					   GetSQLValueString($_POST['pin'], "text"),
                       GetSQLValueString($_POST['rPhone'], "text"),
                       GetSQLValueString($_POST['mobile'], "text"),
                       GetSQLValueString($_POST['registrationNo'], "text"),
                       GetSQLValueString($_POST['gender'], "text"),
                       GetSQLValueString($DOB, "date"),
					   GetSQLValueString($_POST['maritalStatus'], "text"),
					   GetSQLValueString($_POST['bloodGroup'], "text"),
					   GetSQLValueString($_POST['occupation'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
					   GetSQLValueString($_POST['type'], "int"));
	if(!$person->updatePerson($_POST['personId']))
		die(mysql_error());
	
	else if($_POST['type'] == 0)
	{
		header('Location: ViewDoctor.php');
	}
	else
		header('Location: ViewPerson.php');
	}
}
elseif($_POST['formAction'] == "delete")
{
	if(!$person->deletePerson($_POST['personId']))
		die(mysql_error());
	
	else if($_POST['type'] == 0)
	{
		header('Location: ViewDoctor.php');
	}
	else
		header('Location: ViewPerson.php');
}






?>