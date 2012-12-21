<?php
class InvestigationTrx
{	
	private $visitId, $patientId, $investigationId, $clsId, $reportDate,  $institution, $results, $value, $reportFileNm, $comments;
	
	function __construct()
	{
	}
	
	function setDetails($visitId, $patientId, $investigationId, $clsId, $reportDate,  $institution, $results, $value, $reportFileNm, $comments)
	{
		$this->visitId = $visitId;
		$this->patientId = $patientId;
		$this->investigationId = $investigationId;
		$this->clsId = $clsId;
		$this->reportDate = $reportDate;
		$this->institution = $institution;
		$this->results = $results;
		$this->value = $value;
		$this->reportFileNm = $reportFileNm;
		$this->comments = $comments;
	}
	
	public function getDetails($id)
	{
		include("Connections/HMS.php");
		$query = "SELECT * FROM investigationtrx WHERE investigationTrxId = $id;";
		mysql_select_db($database_HMS, $HMS);
		$invst = mysql_query($query, $HMS) or die(mysql_error());
		$row_invst = mysql_fetch_assoc($invst);
		$totalRows_invst = mysql_num_rows($invst);
		if($totalRows_invst >1)
		{
			die(mysql_error());
		}
		$this->investigationTrxId = $row_invst['investigationTrxId'];
		$this->visitId = $row_invst['visitId'];
		$this->patientId = $row_invst['patientId'];
		$this->investigationId = $row_invst['investigationId'];
		$this->clsId = $row_invst['clsId'];
		$this->reportDate = $row_invst['reportDate'];
	    $this->institution = $row_invst['institution'];
		$this->results = $row_invst['results'];
		$this->value = $row_invst['value'];
		$this->reportFileNm = $row_personRS['reportFileNm'];
		$this->comments = $row_personRS['comments'];
		$data = array("investigationTrxId"=>$this->investigationTrxId,"visitId"=>$this->visitId,"patientId"=>$this->patientId,"investigationId"=>$this->investigationId,"clsId"=>$this->clsId,
		"reportDate"=>$this->reportDate,"institution"=>$this->institution,"results"=>$this->results,"value"=>$this->value,
		"reportFileNm"=>$this->reportFileNm,"comments"=>$this->comments);
		return $data;
	}
	
	public function insertinvestigationtrx()
	{
		include("Connections/HMS.php");
		$insertSQL = "INSERT INTO investigationtrx(visitId, patientId, investigationId, clsId, reportDate, institution, results, value, reportFileNm, comments) VALUES ($this->visitId,$this->patientId,$this->investigationId,$this->clsId,$this->reportDate,$this->institution,$this->results,$this->value,$this->reportFileNm,$this->comments);";
		mysql_select_db($database_HMS, $HMS);
		var_dump($insertSQL);
		$Result1 = mysql_query($insertSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function updateinvestigationtrx($id)
	{
		include("Connections/HMS.php");
		$updateSQL = "UPDATE investigationtrx SET investigationId=$this->investigationId, clsId=$this->clsId, reportDate=$this->reportDate, institution=$this->institution, results=$this->results, value=$this->value, reportFileNm=$this->reportFileNm, comments=$this->comments WHERE investigationTrxId = $id";
		//echo $updateSQL;
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($updateSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function deleteinvestigationtrx($id)
	{
		include("Connections/HMS.php");
		$deleteSQL = "DELETE FROM investigationtrx WHERE investigationTrxId=$id";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($deleteSQL, $HMS) or die(mysql_error());
		return true;
	}
}

?>