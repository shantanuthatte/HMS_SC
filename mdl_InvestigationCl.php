<?php
class InvestigationCl
{	
	private $grId, $classId, $classname;
	
	function __construct()
	{
	}
	
	function setDetails($grId, $classId, $classname)
	{
		$this->grId = $grId;
		$this->classId = $classId;
		$this->classname = $classname;
		}
	
	public function getDetails($id)
	{
		include("Connections/HMS.php");
		$query = "SELECT * FROM investigationcl WHERE grId = $id;";
		mysql_select_db($database_HMS, $HMS);
		$invstcl = mysql_query($query, $HMS) or die(mysql_error());
		$row_invstcl = mysql_fetch_assoc($invstcl);
		$totalRows_invstcl = mysql_num_rows($invstcl);
		if($totalRows_invstcl >1)
		{
			die(mysql_error());
		}
		$this->className = $row_invstcl['className'];
		$data = array("grId"=>$id,"className"=>$this->className);
		return $data;
	}
	
	public function insertinvestigationcl()
	{
		include("Connections/HMS.php");
		$insertSQL = "INSERT INTO investigationcl(className) VALUES ($this->className);";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($insertSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function updateinvestigationcl($id)
	{
		include("Connections/HMS.php");
		$updateSQL = "UPDATE investigationcl SET className=$this->className  WHERE grId = $id";
		echo $updateSQL;
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($updateSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function deleteinvestigationcl($id)
	{
		include("Connections/HMS.php");
		$deleteSQL = "DELETE FROM investigationcl WHERE grId=$id";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($deleteSQL, $HMS) or die(mysql_error());
		return true;
	}
}

?>