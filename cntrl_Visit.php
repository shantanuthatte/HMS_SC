<?php require_once('Connections/HMS.php');
include('mdl_Visit.php');
include('mdl_Examination.php');
include('mdl_Prescription.php');

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
		$examination = new Examination();
		$examination->setDetails(GetSQLValueString($visitId, "text"),
                       GetSQLValueString($_POST['examination'], "text"),
					   GetSQLValueString($_POST['habit'], "text"),
					   GetSQLValueString($_POST['pulse'], "text"),
					   GetSQLValueString($_POST['bpDia'], "text"),
					   GetSQLValueString($_POST['bpSys'], "text"),
					   GetSQLValueString($_POST['RR'], "text"),
					   GetSQLValueString($_POST['height'], "text"),
					   GetSQLValueString($_POST['weight'], "text"),
					   GetSQLValueString($_POST['finalDiagnosis'], "text"),
					   GetSQLValueString($_POST['patientComplain'], "text"),
                       GetSQLValueString($_POST['comments'], "text"));
		if(!$examination->insertexamination())
			die(mysql_error());
		
		$prescription = new Prescription();
		$count = $_POST['medicineCount'];
		for($i=1;$i<=$count;$i++)
		{
			$medicineName = "medicine-".$i;
			$dosage = "dosage-".$i;
			$duration = "duration-".$i;
			$instruction = "instruction-".$i;
			if(GetSQLValueString($_POST[$medicineName], "text") != "NULL")
			{
				$prescription->setDetails(GetSQLValueString($visitId, "text"),
                       GetSQLValueString($_POST[$medicineName], "text"),
					   GetSQLValueString($_POST[$dosage], "text"),
					   GetSQLValueString($_POST[$instruction], "text"),
					   GetSQLValueString($_POST[$duration], "text"),
                       GetSQLValueString($i, "text"));
				if(!$prescription->insertprescription())
					die(mysql_error());
			}
		}
	}
}
elseif($_POST['formAction'] == "update")
{
	session_start();
	$data = $visit->getDetails($_POST['visitId']);
	$_SESSION['data'] = $data;
	//echo "Hello update";
	//var_dump($_SESSION['data']);
	header('Location: AddVisit.php?Mode=update');
}
elseif($_POST['formAction'] == "commit")
{
	$visit->setDetails(GetSQLValueString($_POST['patientId'], "text"),
	                   GetSQLValueString($_POST['registrationId'], "text"),
					   GetSQLValueString($_POST['consultingDoctorId'], "text"),
                       GetSQLValueString($_POST['visitNo'], "text"),
					   GetSQLValueString($_POST['visitDate'], "text"),
					   GetSQLValueString($_POST['referringDoctorId'], "text"));
	if(!$visit->updatevisit($_POST['visitId']))
		die(mysql_error());
	else
		header('Location: ViewVisit.php');
}
elseif($_POST['formAction'] == "delete")
{
	if(!$visit->deletevisit($_POST['visitId']))
		die(mysql_error());
	else
		header('Location: ViewVisit.php');
}
?>