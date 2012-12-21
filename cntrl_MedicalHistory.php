<?php require_once('Connections/HMS.php');
include('mdl_MedicalHistory.php');

$flag=0;
function serverValidation()
{
	$count=0;
	$retVal=0;
	$check1="";
	if(empty($_POST['patientId']))
		{
			$count = $count+1;
		$check1= $count.". Enter Patient.,";
		$retVal=1;
		}
	if(empty($_POST['diagnosisDate']))
	{
		$count=$count+1;
		$check1= $check1.$count. ". Diagnosis Date is required.,";
		$retVal=1;
		}
	
		
		if($retVal==1)
		{
		session_start();
		$_SESSION['Error'] = $check1;
		header("Location: AddMedicalHistory.php");
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

$medical = new MedicalHistory();

if($_POST['formAction'] == "insert")
{
	$flag= serverValidation();
	if($flag==0)
	{
	$medical->setDetails(GetSQLValueString($_POST['patientId'], "text"),
                       GetSQLValueString($_POST['ailmentId'], "text"),
					   GetSQLValueString($_POST['diagnosisDate'], "text"),
					   GetSQLValueString($_POST['symptoms'], "text"),
                       GetSQLValueString($_POST['comments'], "text"));
	if(!$medical->insertmedicalhistory())
		die(mysql_error());
	else
		header('Location: ViewMedicalHistory.php');
	}
}
elseif($_POST['formAction'] == "update")
{
	session_start();
	$data = $medical->getDetails($_POST['medicalHisId']);
	$_SESSION['data'] = $data;
	header('Location: AddMedicalHistory.php?Mode=update');
}
elseif($_POST['formAction'] == "commit")
{
	$flag= serverValidation();
	if($flag==0)
	{
	$medical->setDetails(GetSQLValueString($_POST['patientId'], "text"),
                       GetSQLValueString($_POST['ailmentId'], "text"),
					   GetSQLValueString($_POST['diagnosisDate'], "text"),
					   GetSQLValueString($_POST['symptoms'], "text"),
                       GetSQLValueString($_POST['comments'], "text"));
	if(!$medical->updatemedicalhistory($_POST['medicalHisId']))
		die(mysql_error());
	else
		header('Location: ViewMedicalHistory.php');
	}
}
elseif($_POST['formAction'] == "delete")
{
	if(!$medical->deletemedicalhistory($_POST['medicalHisId']))
		die(mysql_error());
	else
		header('Location: ViewMedicalHistory.php');
}
?>