<?php
class InvestigationCl
{	
	private $grId, $classId, $className;
	
	function __construct()
	{
	}
	
	function setDetails($grId, $classId, $className)
	{
		$this->grId = $grId;	
		$this->classId = $classId;		
		$this->className = $className;
	}
	
	public function getDetails($classId)
	{
		include("Connections/HMS.php");
		$query = "SELECT * FROM investigationcl WHERE classId = $classId ;";
		mysql_select_db($database_HMS, $HMS);
		$invstcl = mysql_query($query, $HMS) or die(mysql_error());
		$row_invstcl = mysql_fetch_assoc($invstcl);
		$totalRows_invstcl = mysql_num_rows($invstcl);
		if($totalRows_invstcl >1)
		{
			die(mysql_error());
		}
		$this->grId = $row_invstcl['grId'];
		$this->classId = $row_invstcl['classId'];
		$this->className = $row_invstcl['className'];
		$data = array("grId"=>$this->grId, "classId"=>$this->classId, "className"=>$this->className);
		return $data;
	}
	
	public function insertinvestigationcl()
	{
		include("Connections/HMS.php");		
		$insertSQL = "INSERT INTO investigationcl(grId,className) VALUES ($this->grId, $this->className);";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($insertSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function updateinvestigationcl($clId)
	{
		include("Connections/HMS.php");
		$updateSQL = "UPDATE investigationcl SET className=$this->className  WHERE classId = $clId" ;
		echo $updateSQL;
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($updateSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function deleteinvestigationcl($clId)
	{
		include("Connections/HMS.php");
		$deleteSQL = "DELETE FROM investigationcl WHERE classId = $clId";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($deleteSQL, $HMS) or die(mysql_error());
		return true;
	}
}

?>