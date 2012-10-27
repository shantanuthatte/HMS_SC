<?php
class InvestigationMaster
{	
	private $invstName, $info, $sexFlag, $toVal1, $fromVal1, $toVal2,  $fromVal2, $impression, $result, $unit, $charges;
	
	function __construct()
	{
	}
	
	function setDetails($invstName, $info, $sexFlag, $toVal1, $fromVal1, $toVal2, $fromVal2, $impression, $result, $unit, $charges)
	{
		$this->invstName = $invstName;
		$this->info = $info;
		$this->sexFlag = $sexFlag;
		$this->toVal1 = $toVal1;
		$this->fromVal1 = $fromVal1;
		$this->toVal2 = $toVal2;
		$this->fromVal2 = $fromVal2;
		$this->impression = $impression;
		$this->result = $result;
		$this->unit = $unit;
		$this->charges = $charges;
	}
	
	public function getDetails($id)
	{
		include("Connections/HMS.php");
		$query = "SELECT * FROM investigationmst WHERE invstId = $id;";
		mysql_select_db($database_HMS, $HMS);
		$invst = mysql_query($query, $HMS) or die(mysql_error());
		$row_invst = mysql_fetch_assoc($invst);
		$totalRows_invst = mysql_num_rows($invst);
		if($totalRows_invst >1)
		{
			die(mysql_error());
		}
		$this->invstName = $row_invst['invstName'];
		$this->info = $row_invst['info'];
		$this->sexFlag = $row_invst['sexFlag'];
		$this->toVal1 = $row_invst['toVal1'];
		$this->fromVal1 = $row_invst['fromVal1'];
		$this->toVal2 = $row_invst['toVal2'];
	    $this->fromVal2 = $row_invst['fromVal2'];
		$this->impression = $row_invst['impression'];
		$this->result = $row_invst['result'];
		$this->unit = $row_personRS['unit'];
		$this->charges = $row_personRS['charges'];
		$data = array("invstId"=>$id,"invstName"=>$this->invstName,"info"=>$this->info,"sexFlag"=>$this->sexFlag,"toVal1"=>$this->toVal1,
		"toVal2"=>$this->toVal2,"fromVal1"=>$this->fromVal1,"fromVal2"=>$this->fromVal2,"impression"=>$this->impression,
		"result"=>$this->result,"unit"=>$this->unit,"charges"=>$this->charges);
		return $data;
	}
	
	public function insertinvestigationmst()
	{
		include("Connections/HMS.php");
		$insertSQL = "INSERT INTO investigationmst(invstName, info, sexFlag, toVal1, fromVal1, toVal2, , fromVal2, impression, result, unit, charges) VALUES ($this->invstName,$this->info,$this->sexFlag,$this->toVal1,$this->fromVal1,$this->toVal2,$this->fromVal2,$this->impression,$this->result,$this->unit,$this->charges);";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($insertSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function updateinvestigationmst($id)
	{
		include("Connections/HMS.php");
		$updateSQL = "UPDATE investigationmst SET invstName=$this->invstName, info=$this->info, sexFlag=$this->sexFlag, toVal1=$this->toVal1, fromVal1=$this->fromVal1, toVal2=$this->toVal2, fromVal2=$this->fromVal2, impression=$this->impression, result=$this->result, unit=$this->unit, charges=$this->charges WHERE invstId = $id";
		//echo $updateSQL;
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($updateSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function deleteinvestigationmst($id)
	{
		include("Connections/HMS.php");
		$deleteSQL = "DELETE FROM investigationmst WHERE invstId=$id";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($deleteSQL, $HMS) or die(mysql_error());
		return true;
	}
}

?>