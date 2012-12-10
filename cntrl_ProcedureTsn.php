<?php require_once('Connections/HMS.php');
include('mdl_Visit.php');
include('mdl_ProcedureTsn.php');


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

$visit = new Visit();

if($_POST['formAction'] == "insert")
{
	$visit->setDetails(GetSQLValueString($_POST['patientId'], "text"),
	                   GetSQLValueString($_POST['registrationId'], "text"),
					   GetSQLValueString($_POST['consultingDoctorId'], "text"),
                       GetSQLValueString($_POST['visitNo'], "text"),
					   GetSQLValueString($_POST['visitDate'], "text"),
					   GetSQLValueString($_POST['referringDoctorId'], "text"));
	$visitId = $visit->insertvisit();
	if($visitId == NULL)
		die(mysql_error());
	else
	{
		$proceduretsn = new ProcedureTsn();
		$proceduretsn->setDetails(GetSQLValueString($_POST['procedureId'], "text"),
					   GetSQLValueString($_POST['PreopD'], "text"),
					   GetSQLValueString($_POST['PostopD'], "text"),
					   GetSQLValueString($_POST['dateOfOperation'], "text"),
					   GetSQLValueString($_POST['timeOfOperation'], "text"),
					   GetSQLValueString($_POST['surgeon'], "text"),
					   GetSQLValueString($_POST['Anesthesiologist'], "text"),
					   GetSQLValueString($_POST['typeOfAnesthesia'], "text"),
					   
                       GetSQLValueString($_POST['comments'], "text"));
		if(!$proceduretsn->insertproceduretsn())
			die(mysql_error());
		
		
	}
}

?>