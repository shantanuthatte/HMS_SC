<?php
class Patientallergy
{	
	private $patientId, $type, $allergy, $comments;
	
	function __construct()
	{
	}
	
	function setDetails($patientId, $type, $allergy, $comments)
	{
		$this->patientId = $patientId;
		$this->type = $type;
		$this->allergy = $allergy;
		$this->comments = $comments;
		
	}
	
	public function getDetails($id)
	{
		include("Connections/HMS.php");
		$query = "SELECT * FROM patientallergy WHERE allergyId = $id;";
		mysql_select_db($database_HMS, $HMS);
		$patientallergy = mysql_query($query, $HMS) or die(mysql_error());
		$row_patientallergy = mysql_fetch_assoc($patientallergy);
		$totalRows_patientallergy = mysql_num_rows($patientallergy);
		if($totalRows_patientallergy >1)
		{
			die(mysql_error());
		}
		$this->patientId = $row_patientallergy['patientId'];
		$this->type = $row_patientallergy['type'];
		$this->allergy = $row_patientallergy['allergy'];
		$this->comments = $row_patientallergy['comments'];
		$data = array("allergyId"=>$id,"patientId"=>$this->patientId,"type"=>$this->type,"allergy"=>$this->allergy,"comments"=>$this->comments);
		return $data;
	}
	
	public function insertPatientallergy()
	{
		include("Connections/HMS.php");
		$insertSQL = "INSERT INTO patientallergy(patientId, type, allergy, comments) VALUES ($this->patientId,$this->type,$this->allergy,$this->comments);";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($insertSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function updatePatientallergy($id)
	{
		include("Connections/HMS.php");
		$updateSQL = "UPDATE patientallergy SET patientId=$this->patientId, type=$this->type, allergy=$this->allergy, comments=$this->comments WHERE allergyId = $id";
		//echo $updateSQL;
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($updateSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function deletePatientallergy($id)
	{
		include("Connections/HMS.php");
		$deleteSQL = "DELETE FROM patientallergy WHERE allergyId = $id";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($deleteSQL, $HMS) or die(mysql_error());
		return true;
	}
}

?>