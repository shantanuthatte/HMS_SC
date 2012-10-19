<?php
class Person
{	
	private $fName, $mName, $lName, $address, $rPhone, $mobile, $registrationNo, $gender, $DOB, $email;
	
	function __construct()
	{
	}
	
	function setDetails($fName, $mName, $lName, $address, $rPhone, $mobile, $registrationNo, $gender, $DOB, $email)
	{
		$this->fName = $fName;
		$this->mName = $mName;
		$this->lName = $lName;
		$this->address = $address;
		$this->rPhone = $rPhone;
		$this->mobile = $mobile;
		$this->gender = $gender;
		$this->registrationNo = $registrationNo;
		$this->DOB = $DOB;
		$this->email = $email;
	}
	
	public function getDetails($id)
	{
		include("Connections/HMS.php");
		$query = "SELECT * FROM person WHERE personId = $id;";
		mysql_select_db($database_HMS, $HMS);
		$personRS = mysql_query($query, $HMS) or die(mysql_error());
		$row_personRS = mysql_fetch_assoc($personRS);
		$totalRows_personRS = mysql_num_rows($personRS);
		if($totalRows_personRS >1)
		{
			die(mysql_error());
		}
		$this->fName = $row_personRS['fName'];
		$this->mName = $row_personRS['mName'];
		$this->lName = $row_personRS['lName'];
		$this->address = $row_personRS['address'];
		$this->rPhone = $row_personRS['rPhone'];
		$this->mobile = $row_personRS['mobile'];
		$this->gender = $row_personRS['gender'];
		$this->registrationNo = $row_personRS['registrationNo'];
		$this->DOB = $row_personRS['DOB'];
		$this->email = $row_personRS['email'];
		$data = array("personId"=>$id,"fName"=>$this->fName,"mName"=>$this->mName,"lName"=>$this->lName,"address"=>$this->address,
		"rPhone"=>$this->rPhone,"mobile"=>$this->mobile,"gender"=>$this->gender,"registrationNo"=>$this->registrationNo,
		"DOB"=>$this->DOB,"email"=>$this->email);
		return $data;
	}
	
	public function insertPerson()
	{
		include("Connections/HMS.php");
		$insertSQL = "INSERT INTO person(fName, mName, lName, address, rPhone, mobile, registrationNo, gender, DOB, email) VALUES ($this->fName,$this->mName,$this->lName,$this->address,$this->rPhone,$this->mobile,$this->registrationNo,$this->gender,$this->DOB,$this->email);";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($insertSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function updatePerson($id)
	{
		include("Connections/HMS.php");
		$updateSQL = "UPDATE person SET fName=$this->fName, mName=$this->mName, lName=$this->lName, address=$this->address, rPhone=$this->rPhone, mobile=$this->mobile, registrationNo=$this->registrationNo, gender=$this->gender, DOB=$this->DOB, email=$this->email WHERE personId = $id";
		//echo $updateSQL;
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($updateSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function deletePerson($id)
	{
		include("Connections/HMS.php");
		$deleteSQL = "DELETE FROM person WHERE personId=$id";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($deleteSQL, $HMS) or die(mysql_error());
		return true;
	}
}

?>