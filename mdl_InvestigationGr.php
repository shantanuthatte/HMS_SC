<?php
class InvestigationGr
{	
	private $groupName;
	
	function __construct()
	{
	}
	
	function setDetails($groupName)
	{
		$this->groupName = $groupName;
		}
	
	public function getDetails($id)
	{
		include("Connections/HMS.php");
		$query = "SELECT * FROM investigationgr WHERE groupId = $id;";
		mysql_select_db($database_HMS, $HMS);
		$invstgr = mysql_query($query, $HMS) or die(mysql_error());
		$row_invstgr = mysql_fetch_assoc($invstgr);
		$totalRows_invstgr = mysql_num_rows($invstgr);
		if($totalRows_invstgr >1)
		{
			die(mysql_error());
		}
		$this->groupName = $row_invstgr['groupName'];
		$data = array("groupId"=>$id,"groupName"=>$this->groupName);
		return $data;
	}
	
	public function insertinvestigationgr()
	{
		include("Connections/HMS.php");
		$insertSQL = "INSERT INTO investigationgr(groupName) VALUES ($this->groupName);";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($insertSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function updateinvestigationgr($id)
	{
		include("Connections/HMS.php");
		$updateSQL = "UPDATE investigationgr SET groupName=$this->groupName  WHERE groupId = $id";
		echo $updateSQL;
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($updateSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function deleteinvestigationgr($id)
	{
		include("Connections/HMS.php");
		$deleteSQL = "DELETE FROM investigationgr WHERE groupId=$id";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($deleteSQL, $HMS) or die(mysql_error());
		return true;
	}
}

?>