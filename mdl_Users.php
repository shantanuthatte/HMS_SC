<?php
class Users
{	
	private $userName, $password, $personId, $type, $recoveryEmail, $permission;
	
	function __construct()
	{
	}
	
	function setDetails($userName, $password, $personId, $type, $recoveryEmail, $permission)
	{
		echo "Problem";
		$this->userName = $userName;
		$this->password = $password;
		$this->personId = $personId;
		$this->type = $type;
		$this->recoveryEmail = $recoveryEmail;
		$this->permission = $permission;
	}
	
	public function getDetails($id)
	{
		include("Connections/HMS.php");
		$query = "SELECT * FROM users WHERE userId = $id;";
		mysql_select_db($database_HMS, $HMS);
		$Users = mysql_query($query, $HMS) or die(mysql_error());
		$row_Users = mysql_fetch_assoc($Users);
		$totalRows_Users = mysql_num_rows($Users);
		if($totalRows_Users >1)
		{
			die(mysql_error());
		}
		$this->userName = $row_Users['userName'];
		$this->password = $row_Users['password'];
		$this->personId = $row_Users['personId'];
		$this->type = $row_Users['type'];
		$this->recoveryEmail = $row_Users['recoveryEmail'];
		$this->permission = $row_Users['permission'];
		$data = array("userId"=>$id,"userName"=>$this->userName,"password"=>$this->password,"type"=>$this->type,"recoveryEmail"=>$this->recoveryEmail,
		"permission"=>$this->permission,"personId"=>$this->personId);
		return $data;
	}
	
	public function insertUser()
	{
		include("Connections/HMS.php");
		$insertSQL = "INSERT INTO users(userName, password, personId, type, recoveryEmail, permission) VALUES ($this->userName,$this->password,$this->personId,$this->type,$this->recoveryEmail,$this->permission);";
		echo $insertSQL;
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($insertSQL, $HMS) or die(mysql_error());
		
		$query = "SELECT userId FROM users where userName=".$this->userName." AND recoveryEmail=".$this->recoveryEmail." AND personId=".$this->personId.";";
		echo $query;
		mysql_select_db($database_HMS, $HMS);
		$res = mysql_query($query, $HMS);
  		if($res != NULL)
  		{
  			$row_res = mysql_fetch_assoc($res);
  			$userId = $row_res['userId'];
			return $userId;
		}
		return true;
	}
	
	public function updateUser($id)
	{
		include("Connections/HMS.php");
		$updateSQL = "UPDATE users SET userName=$this->userName, type=$this->type, recoveryEmail=$this->recoveryEmail, permission=$this->permission WHERE userId = $id";
		//echo $updateSQL;
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($updateSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function deleteUser($id)
	{
		include("Connections/HMS.php");
		$deleteSQL = "DELETE FROM users WHERE userId=$id";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($deleteSQL, $HMS) or die(mysql_error());
		return true;
	}
}

?>