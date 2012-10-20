<?php
class Ailment
{	
	private $ailmentName, $symptoms, $comments;
	
	function __construct()
	{
	}
	
	function setDetails($ailmentName, $symptoms, $comments)
	{
		$this->ailmentName = $ailmentName;
		$this->symptoms = $symptoms;
		$this->comments = $comments;
		
		}
	
	public function getDetails($id)
	{
		include("Connections/HMS.php");
		$query = "SELECT * FROM ailment WHERE ailmentId = $id;";
		mysql_select_db($database_HMS, $HMS);
		$ailment = mysql_query($query, $HMS) or die(mysql_error());
		$row_ailment = mysql_fetch_assoc($ailment);
		$totalRows_ailment = mysql_num_rows($ailment);
		if($totalRows_ailment >1)
		{
			die(mysql_error());
		}
		$this->ailmentName = $row_ailment['ailmentName'];
		$this->symptoms = $row_ailment['symptoms'];
		$this->comments = $row_ailment['comments'];
		$data = array("ailmentId"=>$id,"ailmentName"=>$this->ailmentName,"symptoms"=>$this->symptoms,"comments"=>$this->comments);
		return $data;
	}
	
	public function insertailment()
	{
		include("Connections/HMS.php");
		$insertSQL = "INSERT INTO ailment(ailmentName, symptoms, comments) VALUES ($this->ailmentName,$this->symptoms,$this->comments);";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($insertSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function updateailment($id)
	{
		include("Connections/HMS.php");
		$updateSQL = "UPDATE ailment SET ailmentName=$this->ailmentName, symptoms=$this->symptoms, comments=$this->comments WHERE ailmentId = $id";
		echo $updateSQL;
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($updateSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function deleteailment($id)
	{
		include("Connections/HMS.php");
		$deleteSQL = "DELETE FROM ailment WHERE ailmentId=$id";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($deleteSQL, $HMS) or die(mysql_error());
		return true;
	}
}

?>