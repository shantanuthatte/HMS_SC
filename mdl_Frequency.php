<?php
class Frequency
{	
	private $frequency ;
	
	function __construct()
	{
	}
	
	function setDetails($frequency)
	{
		$this->frequency = $frequency;
		}
	
	public function getDetails($id)
	{
		include("Connections/HMS.php");
		$query = "SELECT * FROM frequency WHERE frequencyId = $id;";
		mysql_select_db($database_HMS, $HMS);
		$frequency = mysql_query($query, $HMS) or die(mysql_error());
		$row_frequency = mysql_fetch_assoc($frequency);
		$totalRows_frequency = mysql_num_rows($frequency);
		if($totalRows_frequency >1)
		{
			die(mysql_error());
		}
		$this->frequency = $row_frequency['frequency'];
		$data = array("frequencyId"=>$id,"frequency"=>$this->frequency);
		return $data;
	}
	
	public function insertfrequency()
	{
		include("Connections/HMS.php");
		$insertSQL = "INSERT INTO frequency(frequency) VALUES ($this->frequency);";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($insertSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function updatefrequency($id)
	{
		include("Connections/HMS.php");
		$updateSQL = "UPDATE frequency SET frequency=$this->frequency WHERE frequencyId = $id";
		//echo $updateSQL;
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($updateSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function deletefrequency($id)
	{
		include("Connections/HMS.php");
		$deleteSQL = "DELETE FROM frequency WHERE frequencyId=$id";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($deleteSQL, $HMS) or die(mysql_error());
		return true;
	}
}

?>