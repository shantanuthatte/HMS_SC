<?php
class UserRegistrationlink
{	
	private $registrationId, $userId;
	
	function __construct()
	{
	}
	
	function setDetails($registrationId, $userId)
	{
		$this->registrationId = $registrationId;
		$this->userId = $userId;
		
		
	}
	
	public function getDetails($id)
	{
		include("Connections/HMS.php");
		$query = "SELECT * FROM userregistrationlink WHERE 'userRegLinkId' = $id;";
		mysql_select_db($database_HMS, $HMS);
		$userreglink = mysql_query($query, $HMS) or die(mysql_error());
		$row_userreglink = mysql_fetch_assoc($userreglink);
		$totalRows_userreglink = mysql_num_rows($userreglink);
		if($totalRows_userreglink >1)
		{
			die(mysql_error());
		}
		$this->registrationId = $row_webRS['registrationId'];
		$this->userId = $row_webRS['userId'];
		
		return $data;
	}
	
	public function insertUserRegistrationlink()
	{
		include("Connections/HMS.php");
		$insertSQL = "INSERT INTO userregistrationlink(registrationId, userId) VALUES ($this->registrationId,$this->userId);";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($insertSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function updateUserRegistrationlink($id)
	{
		include("Connections/HMS.php");
		$updateSQL = "UPDATE userregistrationlink SET registrationId=$this->registrationId, userId=$this->userId WHERE 'userRegLinkId' = $id";
		//echo $updateSQL;
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($updateSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function deleteUserRegistrationlink($id)
	{
		include("Connections/HMS.php");
		$deleteSQL = "DELETE FROM userregistrationlink WHERE 'userRegLinkId'=$id";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($deleteSQL, $HMS) or die(mysql_error());
		return true;
	}
}

?>