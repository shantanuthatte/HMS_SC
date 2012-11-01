<?php
class Visit
{	
	private $patientId, $registrationId, $consultingDoctorId, $visitNo, $visitDate,$referringDoctorId;
	
	function __construct()
	{
	}
	
	function setDetails($patientId, $registrationId, $consultingDoctorId, $visitNo, $visitDate,$referringDoctorId)
	{
		$this->patientId = $patientId;
		$this->registrationId = $registrationId;
		$this->consultingDoctorId = $consultingDoctorId;
		$this->visitNo = $visitNo;
		$this->visitDate = $visitDate;
		$this->referringDoctorId = $referringDoctorId;
		
		}
	
	public function getDetails($id)
	{
		include("Connections/HMS.php");
		$query = "SELECT * FROM visit WHERE visitId = $id;";
		mysql_select_db($database_HMS, $HMS);
		$visit = mysql_query($query, $HMS) or die(mysql_error());
		$row_visit = mysql_fetch_assoc($visit);
		$totalRows_visit = mysql_num_rows($visit);
		if($totalRows_visit >1)
		{
			die(mysql_error());
		}
		$this->patientId = $row_visit['patientId'];
		$this->registrationId = $row_visit['registrationId'];
		$this->consultingDoctorId = $row_visit['consultingDoctorId'];
		$this->visitNo = $row_visit['visitNo'];
		$this->visitDate = $row_visit['visitDate'];
		$this->referringDoctorId = $row_visit['referringDoctorId'];
		$data = array("visitId"=>$id,"patientId"=>$this->patientId,"registrationId"=>$this->registrationId,"consultingDoctorId"=>$this->consultingDoctorId,"visitNo"=>$this->visitNo,"visitDate"=>$this->visitDate,"referringDoctorId"=>$this->referringDoctorId);
		return $data;
	}
	
	public function insertvisit()
	{
		include("Connections/HMS.php");
		$insertSQL = "INSERT INTO visit(patientId, registrationId, consultingDoctorId, visitNo, visitDate, referringDoctorId ) VALUES ($this->patientId,$this->registrationId,$this->consultingDoctorId,$this->visitNo,$this->visitDate,$this->referringDoctorId);";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($insertSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function updatevisit($id)
	{
		include("Connections/HMS.php");
		$updateSQL = "UPDATE visit SET patientId=$this->patientId, registrationId=$this->registrationId, consultingDoctorId=$this->consultingDoctorId, visitNo=$this->visitNo, visitDate=$this->visitDate, referringDoctorId=$this->referringDoctorId WHERE visitId = $id";
		echo $updateSQL;
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($updateSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function deletevisit($id)
	{
		include("Connections/HMS.php");
		$deleteSQL = "DELETE FROM visit WHERE visitId=$id";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($deleteSQL, $HMS) or die(mysql_error());
		return true;
	}
}

?>