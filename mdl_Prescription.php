<?php
class Prescription
{	
	private $visitId, $medicineName, $Dosage, $Instruction, $Duration, $lineId ;
	
	function __construct()
	{
	}
	
	function setDetails($visitId, $medicineName, $Dosage, $Instruction, $Duration, $lineId )
	{
		$this->visitId = $visitId;
		$this->medicineName = $medicineName;
		$this->Dosage = $Dosage;
		$this->Instruction = $Instruction;
		$this->Duration = $Duration;
		$this->lineId = $lineId;
		
		}
	
	public function getDetails($id)
	{
		include("Connections/HMS.php");
		$query = "SELECT * FROM prescription WHERE prescriptionId = $id;";
		mysql_select_db($database_HMS, $HMS);
		$prescription = mysql_query($query, $HMS) or die(mysql_error());
		$row_prescription = mysql_fetch_assoc($prescription);
		$totalRows_prescription = mysql_num_rows($prescription);
		if($totalRows_prescription >1)
		{
			die(mysql_error());
		}
		$this->visitId = $row_prescription['visitId'];
		$this->medicineName = $row_prescription['medicineName'];
		$this->Dosage = $row_prescription['Dosage'];
		$this->Instruction = $row_prescription['Instruction'];
		$this->Duration = $row_prescription['Duration'];
		$this->lineId = $row_prescription['lineId'];
		$data = array("prescriptionId"=>$id,"visitId"=>$this->visitId,"medicineName"=>$this->medicineName,"Dosage"=>$this->Dosage,"Instruction"=>$this->Instruction,"Duration"=>$this->Duration,"lineId"=>$this->lineId);
		return $data;
	}
	
	public function insertprescription()
	{
		include("Connections/HMS.php");
		$insertSQL = "INSERT INTO prescription(visitId, medicineName, Dosage, Instruction, Duration,  lineId) VALUES ($this->visitId,$this->medicineName,$this->Dosage,$this->Instruction,$this->Duration,$this->lineId);";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($insertSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function updateprescription($id)
	{
		include("Connections/HMS.php");
		$updateSQL = "UPDATE prescription SET visitId=$this->visitId, medicineName=$this->medicineName, Dosage=$this->Dosage, Instruction=$this->Instruction, Duration=$this->Duration, lineId=$this->lineId WHERE prescriptionId = $id";
		echo $updateSQL;
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($updateSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function deleteprescription($id)
	{
		include("Connections/HMS.php");
		$deleteSQL = "DELETE FROM prescription WHERE prescriptionId =$id";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($deleteSQL, $HMS) or die(mysql_error());
		return true;
	}
}

?>