<?php
class Medicine
{	
	private $medicineNm,  $indications, $contraIndications, $adverseEffects,$drugInteractions,  $specialPrecautions, $breastFeeding, $pregnancy, $paediatrics, $over60, $classId, $comments;
	
	function __construct()
	{
	}
	
	function setDetails($medicineNm,  $indications, $contraIndications, $adverseEffects,$drugInteractions,  $specialPrecautions, $breastFeeding, $pregnancy, $paediatrics, $over60, $classId, $comments)
	{
		$this->medicineNm = $medicineNm;
		$this->indications = $indications;
		$this->contraIndications = $contraIndications;
		$this->adverseEffects = $adverseEffects;
		$this->drugInteractions = $drugInteractions;
		$this->specialPrecautions = $specialPrecautions;
		$this->breastFeeding = $breastFeeding;
		$this->pregnancy = $pregnancy;
		$this->paediatrics = $paediatrics;
		$this->over60 = $over60;
		$this->classId = $classId;
		$this->comments = $comments;
	}
	
	public function getDetails($id)
	{
		include("Connections/HMS.php");
		$query = "SELECT * FROM medicine m LEFT JOIN  medicineclass c ON c.classId = m.classId WHERE
m.medicineId = $id;";
		mysql_select_db($database_HMS, $HMS);
		$medicine = mysql_query($query, $HMS) or die(mysql_error());
		$row_medicine = mysql_fetch_assoc($medicine);
		$totalRows_medicine = mysql_num_rows($medicine);
		if($totalRows_medicine >1)
		{
			die(mysql_error());
		}
		$this->medicineNm = $row_medicine['medicineNm'];
		$this->indications = $row_medicine['indications'];
		$this->contraIndications = $row_medicine['contraIndications'];
		$this->adverseEffects = $row_medicine['adverseEffects'];
		$this->drugInteractions = $row_medicine['drugInteractions'];
		$this->specialPrecautions = $row_medicine['specialPrecautions'];
		$this->breastFeeding = $row_medicine['breastFeeding'];
		$this->pregnancy = $row_medicine['pregnancy'];
		$this->paediatrics = $row_medicine['paediatrics'];
		$this->over60 = $row_medicine['over60'];
		$this->classId = $row_medicine['classId'];
		$this->comments = $row_medicine['comments'];
		$this->className = $row_medicine['className'];
		$data = array("medicineId"=>$id,"medicineNm"=>$this->medicineNm,"indications"=>$this->indications,"contraIndications"=>$this->contraIndications,"adverseEffects"=>$this->adverseEffects,
		"drugInteractions"=>$this->drugInteractions,"specialPrecautions"=>$this->specialPrecautions,"breastFeeding"=>$this->breastFeeding,"pregnancy"=>$this->pregnancy,"paediatrics"=>$this->paediatrics,"over60"=>$this->over60,"classId"=>$this->classId,"comments"=>$this->comments,"className"=>$this->className);
		return $data;
	}
	
	public function insertMedicine()
	{
		include("Connections/HMS.php");
		$insertSQL = "INSERT INTO medicine(medicineNm, indications, contraIndications, adverseEffects, drugInteractions, specialPrecautions, breastFeeding, pregnancy, paediatrics, over60, classId, comments) VALUES ($this->medicineNm,$this->indications,$this->contraIndications,$this->adverseEffects,$this->drugInteractions,$this->specialPrecautions,$this->breastFeeding,$this->pregnancy,$this->paediatrics,$this->over60,$this->classId,$this->comments);";
		//echo $insertSQL;
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($insertSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function updateMedicine($id)
	{
		include("Connections/HMS.php");
		$updateSQL = "UPDATE medicine SET medicineNm=$this->medicineNm, indications=$this->indications, contraIndications=$this->contraIndications, adverseEffects=$this->adverseEffects, drugInteractions=$this->drugInteractions, specialPrecautions=$this->specialPrecautions, breastFeeding=$this->breastFeeding, pregnancy=$this->pregnancy, paediatrics=$this->paediatrics, over60=$this->over60, classId=$this->classId,  comments=$this->comments WHERE medicineId = $id";
		//echo $updateSQL;
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($updateSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function deletemedicine($id)
	{
		include("Connections/HMS.php");
		$deleteSQL = "DELETE FROM medicine WHERE medicineId=$id";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($deleteSQL, $HMS) or die(mysql_error());
		return true;
	}
}

?>