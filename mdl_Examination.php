<?php
class Examination
{	
	private $visitId, $Examination, $Habit, $pulse, $BpDia, $BpSys, $RR, $Height, $Weight, $FinalDiagnosis, $patientComplain, $comments;
	
	function __construct()
	{
	}
	
	function setDetails($visitId, $Examination, $Habit, $pulse, $BpDia, $BpSys, $RR, $Height, $Weight, $FinalDiagnosis, $patientComplain, $comments)
	{
		$this->visitId = $visitId;
		$this->Examination = $Examination;
		$this->Habit = $Habit;
		$this->pulse = $pulse;
		$this->BpDia = $BpDia;
		$this->BpSys = $BpSys;
		$this->RR = $RR;
		$this->Height = $Height;
		$this->Weight = $Weight;
		$this->FinalDiagnosis = $FinalDiagnosis;
		$this->patientComplain = $patientComplain;
		$this->comments = $comments;
		
		}
	
	public function getDetails($id)
	{
		include("Connections/HMS.php");
		$query = "SELECT * FROM examination WHERE examinationId = $id;";
		mysql_select_db($database_HMS, $HMS);
		$examination = mysql_query($query, $HMS) or die(mysql_error());
		$row_examination = mysql_fetch_assoc($examination);
		$totalRows_examination = mysql_num_rows($examination);
		if($totalRows_examination >1)
		{
			die(mysql_error());
		}
		$this->visitId = $row_examination['visitId'];
		$this->Examination = $row_examination['Examination'];
		$this->Habit = $row_examination['Habit'];
		$this->pulse = $row_examination['pulse'];
		$this->BpDia = $row_examination['BpDia'];
		$this->BpSys = $row_examination['BpSys'];
		$this->RR = $row_examination['RR'];
		$this->Height = $row_examination['Height'];
		$this->Weight = $row_examination['Weight'];
		$this->FinalDiagnosis = $row_examination['FinalDiagnosis'];
		$this->patientComplain = $row_examination['patientComplain'];
		$this->comments = $row_examination['comments'];
		$data = array("examinationId"=>$id,"visitId"=>$this->visitId,"Examination"=>$this->Examination,"Habit"=>$this->Habit,"pulse"=>$this->pulse,"BpDia"=>$this->BpDia,"BpSys"=>$this->BpSys,"RR"=>$this->RR,"Height"=>$this->Height,"Weight"=>$this->Weight,"FinalDiagnosis"=>$this->FinalDiagnosis,"patientComplain"=>$this->patientComplain,"comments"=>$this->comments);
		return $data;
	}
	
	public function insertExamination()
	{
		include("Connections/HMS.php");
		$insertSQL = "INSERT INTO examination(visitId, Examination, Habit, pulse, BpDia, BpSys, RR, Height, Weight, FinalDiagnosis, patientComplain, comments ) VALUES ($this->visitId,$this->Examination,$this->Habit,$this->pulse,$this->BpDia,$this->BpSys,$this->RR,$this->Height,$this->Weight,$this->FinalDiagnosis,$this->patientComplain,$this->comments);";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($insertSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function updateexamination($id)
	{
		include("Connections/HMS.php");
		$updateSQL = "UPDATE examination SET visitId=$this->visitId, Examination=$this->Examination, Habit=$this->Habit, pulse=$this->pulse, BpDia=$this->BpDia, BpSys=$this->BpSys, RR=$this->RR,Height=$this->Height,Weight=$this->Weight,FinalDiagnosis=$this->FinalDiagnosis,patientComplain=$this->patientComplain,comments=$this->comments WHERE examinationId = $id";
		echo $updateSQL;
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($updateSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function deleteexamination($id)
	{
		include("Connections/HMS.php");
		$deleteSQL = "DELETE FROM examination WHERE examinationId=$id";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($deleteSQL, $HMS) or die(mysql_error());
		return true;
	}
}

?>