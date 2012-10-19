<?php
class Users
{	
	private $userName, $password, $personId, $type, $recoveryEmail, $permission;
	
	function __construct()
	{
	}
	
	function setDetails($userName, $password, $personId, $type, $recoveryEmail, $permission)
	{
		$this->uName = $userName;
		$this->password = $password;
		$this->personId = $ $personId;
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
		$this->uName = $userName;
		$this->password = $password;
		$this->personId = $personId;
		$this->type = $type;
		$this->recoveryEmail = $recoveryEmail;
		$this->permission = $permission;
		$data = array("userId"=>$id,"userName"=>$this->uName,"password"=>$this->password,"type"=>$this->type,"recoveryEmail"=>$this->recoveryEmail,
		"permission"=>$this->permission);
		return $data;
	}
	
	public function insertUser()
	{
		include("Connections/HMS.php");
		$insertSQL = "INSERT INTO users(userName, $password, $personId, $type, $recoveryEmail, $permission) VALUES ($this->uName,$this->password,$this->personId,$this->type,$this->recoveryEmail,$this->permission);";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($insertSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function updateUser($id)
	{
		include("Connections/HMS.php");
		$updateSQL = "UPDATE users SET userName=$this->uName, password=$this->password, type=$this->type, recoveryEmail=$this->recoveryEmail, permission=$this->permission WHERE userId = $id";
		echo $updateSQL;
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