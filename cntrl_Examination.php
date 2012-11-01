<?php require_once('Connections/HMS.php');
include('mdl_Examination.php');

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

$examination = new Examination();

if($_POST['formAction'] == "insert")
{
	$examination->setDetails(GetSQLValueString($_POST['visitId'], "text"),
                       GetSQLValueString($_POST['Examination'], "text"),
					   GetSQLValueString($_POST['Habit'], "text"),
					   GetSQLValueString($_POST['pulse'], "text"),
					   GetSQLValueString($_POST['BpDia'], "text"),
					   GetSQLValueString($_POST['BpSys'], "text"),
					   GetSQLValueString($_POST['RR'], "text"),
					   GetSQLValueString($_POST['Height'], "text"),
					   GetSQLValueString($_POST['Weight'], "text"),
					   GetSQLValueString($_POST['FinalDiagnosis'], "text"),
					   GetSQLValueString($_POST['patientComplain'], "text"),
                       GetSQLValueString($_POST['comments'], "text"));
	if(!$examination->insertexamination())
		die(mysql_error());
	else
		header('Location: ViewExamination.php');
}
elseif($_POST['formAction'] == "update")
{
	session_start();
	$data = $examination->getDetails($_POST['examinationId']);
	$_SESSION['data'] = $data;
	//echo "Hello update";
	//var_dump($_SESSION['data']);
	header('Location: AddExamination.php?Mode=update');
}
elseif($_POST['formAction'] == "commit")
{
	$examination->setDetails(GetSQLValueString($_POST['visitId'], "text"),
                       GetSQLValueString($_POST['Examination'], "text"),
					   GetSQLValueString($_POST['Habit'], "text"),
					   GetSQLValueString($_POST['pulse'], "text"),
					   GetSQLValueString($_POST['BpDia'], "text"),
					   GetSQLValueString($_POST['BpSys'], "text"),
					   GetSQLValueString($_POST['RR'], "text"),
					   GetSQLValueString($_POST['Height'], "text"),
					   GetSQLValueString($_POST['Weight'], "text"),
					   GetSQLValueString($_POST['FinalDiagnosis'], "text"),
					   GetSQLValueString($_POST['patientComplain'], "text"),
                       GetSQLValueString($_POST['comments'], "text"));
	if(!$examination->updateexamination($_POST['examinationId']))
		die(mysql_error());
	else
		header('Location: ViewExamination.php');
}
elseif($_POST['formAction'] == "delete")
{
	if(!$examination->deleteexamination($_POST['examinationId']))
		die(mysql_error());
	else
		header('Location: ViewExamination.php');
}
?>