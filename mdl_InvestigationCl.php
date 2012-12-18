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
	
	public function getDetails($grId, $classId)
	{
		include("Connections/HMS.php");
		$query = "SELECT * FROM investigationcl WHERE grId = $grId AND classId = $classId ;";
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
		mysql_select_db($database_HMS, $HMS);
		
		$query_num = "SELECT MAX(classId) AS clsId
						FROM investigationcl
						WHERE grId = $this->grId;";
		$num = mysql_query($query_num, $HMS) or die(mysql_error());
		$row_num = mysql_fetch_assoc($num);
		$clsId = $row_num['clsId'] + 1;		
		
		$this->classId = $clsId;
		$insertSQL = "INSERT INTO investigationcl(grId,classId,className) VALUES ($this->grId,$this->classId,$this->className);";
		
		$Result1 = mysql_query($insertSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function updateinvestigationcl($grId, $clId)
	{
		include("Connections/HMS.php");
		$updateSQL = "UPDATE investigationcl SET className=$this->className  WHERE grId = $grId AND classId = $clId" ;
		echo $updateSQL;
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($updateSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function deleteinvestigationcl($grId, $clId)
	{
		include("Connections/HMS.php");
		$deleteSQL = "DELETE FROM investigationcl WHERE grId=$grId AND classId = $clId";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($deleteSQL, $HMS) or die(mysql_error());
		return true;
	}
}

?>