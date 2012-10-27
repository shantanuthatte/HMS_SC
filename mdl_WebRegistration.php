<?php
class WebRegistration
{	
	private $registrationType, $registrationDate, $name,$authorityId, $comments;
	
	function __construct()
	{
	}
	
	function setDetails($registrationType, $registrationDate, $name,$authorityId, $comments)
	{
		//echo $authorityId ;
		$this->registrationType = $registrationType;
		$this->registrationDate = $registrationDate;
		$this->name = $name;
		$this->authorityId = $authorityId;
		$this->comments = $comments;
		
	}
	
	public function getDetails($id)
	{
		include("Connections/HMS.php");
		$query = "SELECT * FROM webregistration WHERE registrationId = $id;";
		mysql_select_db($database_HMS, $HMS);
		$webRS = mysql_query($query, $HMS) or die(mysql_error());
		$row_webRS = mysql_fetch_assoc($webRS);
		$totalRows_webRS = mysql_num_rows($webRS);
		if($totalRows_webRS >1)
		{
			die(mysql_error());
		}
		$this->registrationType = $row_webRS['registrationType'];
		$this->registrationDate = $row_webRS['registrationDate'];
		$this->name = $row_webRS['name'];
		$this->authorityId = $row_webRS['authorityId'];
		$this->comments = $row_webRS['comments'];
		$data = array("registrationId"=>$id,"registrationType"=>$this->registrationType,"registrationDate"=>$this->registrationDate,"name"=>$this->name,"authorityId"=>$this->authorityId,
		"comments"=>$this->comments);
		return $data;
	}
	
	public function insertWebregistration()
	{
		include("Connections/HMS.php");
		$insertSQL = "INSERT INTO webregistration(registrationType, registrationDate, name, authorityId, comments) VALUES ($this->registrationType,$this->registrationDate,$this->name,$this->authorityId,$this->comments);";
		//echo $insertSQL ;
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($insertSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function updateWebregistration($id)
	{
		include("Connections/HMS.php");
		$updateSQL = "UPDATE webregistration SET registrationType=$this->registrationType, registrationDate=$this->registrationDate, name=$this->name, authorityId=$this->authorityId, comments=$this->comments WHERE registrationId = $id";
		echo $updateSQL;
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($updateSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function deleteWebregistration($id)
	{
		include("Connections/HMS.php");
		$deleteSQL = "DELETE FROM webregistration WHERE registrationId=$id";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($deleteSQL, $HMS) or die(mysql_error());
		return true;
	}
}

?>