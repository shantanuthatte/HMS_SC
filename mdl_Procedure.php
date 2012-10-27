<?php
class Procedure
{	
	private $procedureName, $comments;
	
	function __construct()
	{
	}
	
	function setDetails($procedureName, $comments)
	{
		$this->procedureName = $procedureName;
		$this->comments = $comments;
		
	}
	
	public function getDetails($id)
	{
		include("Connections/HMS.php");
		$query = "SELECT * FROM `procedure` WHERE procedureId = $id;";
		mysql_select_db($database_HMS, $HMS);
		$procedure = mysql_query($query, $HMS) or die(mysql_error());
		$row_procedure = mysql_fetch_assoc($procedure);
		$totalRows_procedure = mysql_num_rows($procedure);
		if($totalRows_procedure >1)
		{
			die(mysql_error());
		}
		$this->procedureName = $row_procedure['procedureName'];
		$this->comments = $row_procedure['comments'];
		$data = array("procedureId"=>$id,"procedureName"=>$this->procedureName,
		"comments"=>$this->comments);
		return $data;
	}
	
	public function insertProcedure()
	{
		include("Connections/HMS.php");
		$insertSQL = "INSERT INTO `procedure`(procedureName, comments) VALUES ($this->procedureName,$this->comments);";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($insertSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function updateProcedure($id)
	{
		include("Connections/HMS.php");
		$updateSQL = "UPDATE `procedure` SET procedureName=$this->procedureName, comments=$this->comments WHERE procedureId = $id";
		//echo $updateSQL;
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($updateSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function deleteProcedure($id)
	{
		include("Connections/HMS.php");
		$deleteSQL = "DELETE FROM `procedure` WHERE procedureId=$id";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($deleteSQL, $HMS) or die(mysql_error());
		return true;
	}
}

?>