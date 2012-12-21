<?php
class MedicalHistory
{	
	private $patientId, $ailmentId, $diagnosisDate, $symptoms, $comments;
	
	function __construct()
	{
	}
	
	function setDetails($patientId, $ailmentId, $diagnosisDate, $symptoms, $comments)
	{
		$this->patientId = $patientId;
		$this->ailmentId = $ailmentId;
		$this->diagnosisDate = $diagnosisDate;
		$this->symptoms = $symptoms;
		$this->comments = $comments;
		
		}
	
	public function getDetails($id)
	{
		include("Connections/HMS.php");
		$query = "SELECT m.medicalHisId, m.diagnosisDate, m.symptoms, m.comments, m. patientId, m. ailmentId, p.fName, p.lName, a.ailmentName
FROM medicalhistory m,person p,ailment a,users u
WHERE u.userId=m.patientId AND  u.userId=p.personId AND m.ailmentId=a.ailmentId AND m.medicalHisId = $id;";
		mysql_select_db($database_HMS, $HMS);
		$medicalHId = mysql_query($query, $HMS) or die(mysql_error());
		$row_medicalHId = mysql_fetch_assoc($medicalHId);
		$totalRows_medicalHId = mysql_num_rows($medicalHId);
		if($totalRows_medicalHId >1)
		{
			die(mysql_error());
		}
		$patientName= $row_medicalHId['fName']." ".$row_medicalHId['lName'];
		$this->patientId = $row_medicalHId['patientId'];
		$this->ailmentId = $row_medicalHId['ailmentId'];
		$this->diagnosisDate = $row_medicalHId['diagnosisDate'];
		$this->symptoms = $row_medicalHId['symptoms'];
		$this->comments = $row_medicalHId['comments'];
		$this->patientName = $patientName;
		$this->ailmentName = $row_medicalHId['ailmentName'];
		
		$data = array("medicalHisId"=>$id,"patientId"=>$this->patientId,"ailmentId"=>$this->ailmentId,"diagnosisDate"=>$this->diagnosisDate,"symptoms"=>$this->symptoms,"comments"=>$this->comments ,"patientName"=>$this->patientName,"ailmentName"=>$this->ailmentName);
		return $data;
	}
	
	public function insertmedicalhistory()
	{
		include("Connections/HMS.php");
		$insertSQL = "INSERT INTO medicalhistory(patientId, ailmentId, diagnosisDate, symptoms, comments  ) VALUES ($this->patientId,$this->ailmentId,$this->diagnosisDate,$this->symptoms,$this->comments);";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($insertSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function updatemedicalhistory($id)
	{
		include("Connections/HMS.php");
		$updateSQL = "UPDATE medicalhistory SET patientId=$this->patientId, ailmentId=$this->ailmentId, diagnosisDate=$this->diagnosisDate, symptoms=$this->symptoms, comments=$this->comments WHERE medicalHisId = $id";
		//echo $updateSQL;
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($updateSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function deletemedicalhistory($id)
	{
		include("Connections/HMS.php");
		$deleteSQL = "DELETE FROM medicalhistory WHERE medicalHisId=$id";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($deleteSQL, $HMS) or die(mysql_error());
		return true;
	}
}

?>