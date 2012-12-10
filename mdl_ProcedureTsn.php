<?php
class ProcedureTsn
{	
	private $procedureId, $PreopD, $PostopD, $dateOfOperation,$timeOfOperation, $surgeon, $Anesthesiologist, $typeOfAnesthesia, $comments;
	
	function __construct()
	{
	}
	
	function setDetails($procedureId, $PreopD, $PostopD, $dateOfOperation,$timeOfOperation, $surgeon, $Anesthesiologist, $typeOfAnesthesia, $comments)
	{
	    
		$this->procedureId = $procedureId;
		$this->PreopD = $PreopD;
		$this->PostopD = $PostopD;
		$this->dateOfOperation = $dateOfOperation;
		$this->timeOfOperation = $timeOfOperation;
		$this->surgeon = $surgeon;
		$this->Anesthesiologist = $Anesthesiologist;
		$this->typeOfAnesthesia = $typeOfAnesthesia;
		$this->comments = $comments;
		
     }
	public function getDetails($id)
	{
		include("Connections/HMS.php");
		$query = "SELECT * FROM proceduretsn WHERE procedureTsnID = $id;";
		mysql_select_db($database_HMS, $HMS);
		$ailment = mysql_query($query, $HMS) or die(mysql_error());
		$row_proceduretsn = mysql_fetch_assoc($proceduretsn);
		$totalRows_proceduretsn = mysql_num_rows($proceduretsn);
		if($totalRows_proceduretsn >1)
		{
			die(mysql_error());
		}
		$this->procedureId = $row_proceduretsn['procedureId'];
		$this->PreopD = $row_proceduretsn['PreopD'];
		$this->PostopD = $row_proceduretsn['PostopD'];
		$this->dateOfOperation = $row_proceduretsn['dateOfOperation'];
		$this->timeOfOperation = $row_proceduretsn['timeOfOperation'];
		$this->surgeon = $row_proceduretsn['surgeon'];
		$this->Anesthesiologist = $row_proceduretsn['Anesthesiologist'];
		$this->typeOfAnesthesia = $row_proceduretsn['typeOfAnesthesia'];
		$this->comments = $row_proceduretsn['comments'];
		$data = array("procedureTsnID"=>$id,"procedureId"=>$this->procedureId,"PreopD"=>$this->PreopD,"PostopD"=>$this->PostopD,"dateOfOperation"=>$this->dateOfOperation,"timeOfOperation"=>$this->timeOfOperation,"surgeon"=>$this->surgeon,"Anesthesiologist"=>$this->Anesthesiologist,"typeOfAnesthesia"=>$this->typeOfAnesthesia,"comments"=>$this->comments);
		return $data;
	}
	
	
	public function insertproceduretsn()
	{
		echo "test";
		include("Connections/HMS.php");
		$query = "INSERT INTO proceduretsn(procedureId,Pre-op Diagnosis, Post-op Diagnosis, dateOfOperation, timeOfOperation, surgeon, Anesthesiologist,typeOfAnesthesia,comments) VALUES ($this->procedureId,$this->PreopD,$this->PostopD,$this->dateOfOperation,$this->timeOfOperation,$this->surgeon,$this->Anesthesiologist,$this->typeOfAnesthesia,$this->comments)";
		mysql_select_db($database_HMS, $HMS);
		$result1 = mysql_query($query, $HMS) or die(mysql_error());
		return true;
		}
	
	}
?>