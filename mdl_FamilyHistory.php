<?php
class FamilyHistory
{	
	private $patientId, $familyRelation, $ailmentId, $diagnosisDate, $symptoms, $comments;
	
	function __construct()
	{
	}
	
	function setDetails($patientId, $familyRelation, $ailmentId, $diagnosisDate, $symptoms, $comments)
	{
		$this->patientId = $patientId;
		$this->familyRelation = $familyRelation;
		$this->ailmentId = $ailmentId;
		$this->diagnosisDate = $diagnosisDate;
		$this->symptoms = $symptoms;
		$this->comments = $comments;
		
	}
	
	public function getDetails($id)
	{
		include("Connections/HMS.php");
		$query = "SELECT f.familyHisId,f.familyRelation,f.patientId,f.ailmentId,f.diagnosisDate,f.comments,f.symptoms,p.fName,P.lName,a.ailmentName FROM 
familyhistory f,person p,ailment a,users u WHERE u.userId=f.patientId AND u.userId=p.personId AND f.ailmentId=a.ailmentId AND f.familyHisId=$id;";
		mysql_select_db($database_HMS, $HMS);
		$familyhid = mysql_query($query, $HMS) or die(mysql_error());
		$row_familyhid = mysql_fetch_assoc($familyhid);
		$totalRows_familyhid = mysql_num_rows($familyhid);
		if($totalRows_familyhid >1)
		{
			die(mysql_error());
		}
		$patientName= $row_familyhid['fName']." ".$row_familyhid['lName'];
		$this->patientId = $row_familyhid['patientId'];
		$this->familyRelation = $row_familyhid['familyRelation'];
		$this->ailmentId = $row_familyhid['ailmentId'];
		$this->diagnosisDate = $row_familyhid['diagnosisDate'];
		$this->symptoms = $row_familyhid['symptoms'];
		$this->comments = $row_familyhid['comments'];
		$this->patientName = $patientName;
		$this->ailmentName = $row_familyhid['ailmentName'];
	    $data = array("familyHisId"=>$id,"patientId"=>$this->patientId,"familyRelation"=>$this->familyRelation,"ailmentId"=>$this->ailmentId,"diagnosisDate"=>$this->diagnosisDate,"symptoms"=>$this->symptoms,"comments"=>$this->comments,"patientName"=>$this->patientName,"ailmentName"=>$this->ailmentName);
		return $data;
	}
	
	public function insertfamilyhistory()
	{
		include("Connections/HMS.php");
		$insertSQL = "INSERT INTO familyhistory(patientId, familyRelation, ailmentId, diagnosisDate, symptoms, comments) VALUES ($this->patientId,$this->familyRelation,$this->ailmentId,$this->diagnosisDate,$this->symptoms,$this->comments);";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($insertSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function updatefamilyhistory($id)
	{
		include("Connections/HMS.php");
		$updateSQL = "UPDATE familyhistory SET patientId=$this->patientId, familyRelation=$this->familyRelation, ailmentId=$this->ailmentId, diagnosisDate=$this->diagnosisDate, symptoms=$this->symptoms, comments=$this->comments WHERE familyHisId = $id";
		//echo $updateSQL;
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($updateSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function deletefamilyhistory($id)
	{
		include("Connections/HMS.php");
		$deleteSQL = "DELETE FROM familyhistory WHERE familyHisId = $id";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($deleteSQL, $HMS) or die(mysql_error());
		return true;
	}
}

?>