<?php
class Person
{	
	private $fName, $mName, $lName, $address, $area, $city, $state, $pin, $rPhone, $mobile, $registrationNo, $gender, $DOB, $maritalStatus, $bloodGroup, $occupation, $email, $type;
	
	function __construct()
	{
	}
	
	function setDetails($fName, $mName, $lName, $address, $area, $city, $state, $pin, $rPhone, $mobile, $registrationNo, $gender, $DOB, $maritalStatus, $bloodGroup, $occupation, $email, $type)
	{
		$this->fName = $fName;
		$this->mName = $mName;
		$this->lName = $lName;
		$this->address = $address;
		$this->area = $area;
		$this->city = $city;
		$this->state = $state;
		$this->pin = $pin;
		$this->rPhone = $rPhone;
		$this->mobile = $mobile;
		$this->gender = $gender;
		$this->registrationNo = $registrationNo;
		$this->DOB = $DOB;
		$this->maritalStatus = $maritalStatus;
		$this->bloodGroup = $bloodGroup;
		$this->occupation = $occupation;
		$this->email = $email;
		$this->type = $type;
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
		$this->address = $row_personRS['address1'];
		$this->area = $row_personRS['address2'];
		$this->city = $row_personRS['city'];
		$this->state = $row_personRS['state'];
		$this->pin = $row_personRS['pin'];
		$this->rPhone = $row_personRS['rPhone'];
		$this->mobile = $row_personRS['mobile'];
		$this->gender = $row_personRS['gender'];
		$this->registrationNo = $row_personRS['registrationNo'];
		$this->DOB = $row_personRS['DOB'];
		$this->maritalStatus = $row_personRS['maritalStatus'];
		$this->bloodGroup = $row_personRS['bloodGroup'];
		$this->occupation = $row_personRS['occupation'];
		$this->email = $row_personRS['email'];
		$this->type = $row_personRS['type'];
		
		$data = array("personId"=>$id,"fName"=>$this->fName,"mName"=>$this->mName,"lName"=>$this->lName,"address"=>$this->address,
		"area"=>$this->area,"city"=>$this->city,"state"=>$this->state,"pin"=>$this->pin,"rPhone"=>$this->rPhone,
		"mobile"=>$this->mobile,"gender"=>$this->gender,"registrationNo"=>$this->registrationNo,
		"DOB"=>$this->DOB,"maritalStatus"=>$this->maritalStatus,"bloodGroup"=>$this->bloodGroup,"occupation"=>$this->occupation,
		"email"=>$this->email,"type"=>$this->type);
		return $data;
	}
	public function PersonExists()
	{
		include("Connections/HMS.php");
		mysql_select_db($database_HMS, $HMS);
	$query_personRS = "SELECT count(*) FROM person where fName=".$this->fName." AND lName=".$this->lName." AND email=".$this->email." AND mobile=".$this->mobile.";";
	$personRS = mysql_query($query_personRS, $HMS) or die(mysql_error());

$totalRows_personRS = mysql_num_rows($personRS);
	if($totalRows_personRS == 0)
	{
		return  false;
		}
		else
		{
			return true;
			}
		}
	
	public function insertPerson()
	{
		include("Connections/HMS.php");
		
		$insertSQL = "INSERT INTO person(fName, mName, lName, address1, address2, city, state, pin, rPhone, mobile, registrationNo, gender, DOB, maritalStatus, bloodGroup, occupation, email,type) VALUES ($this->fName,$this->mName,$this->lName,$this->address,$this->area,$this->city,$this->state,$this->pin,$this->rPhone,$this->mobile,$this->registrationNo,$this->gender,$this->DOB,$this->maritalStatus,$this->bloodGroup,$this->occupation,$this->email,$this->type);";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($insertSQL, $HMS) or die(mysql_error());
		
		$query = "SELECT personId FROM person where fName=".$this->fName." AND lName=".$this->lName." AND email=".$this->email." AND mobile=".$this->mobile.";";
		
		echo $query;
	 
		mysql_select_db($database_HMS, $HMS);
		$res = mysql_query($query, $HMS);
	
  		if($res != NULL)
  		{
  			$row_res = mysql_fetch_assoc($res);
  			$personId = $row_res['personId'];
			return $personId;
		}
		
		return true;
	}
	//$today = date("Y-m-d H:i:s"); 
	//convertTime('%Y-%m-%d','%d.%m.%Y',$this->DOB);
	public function updatePerson($id)
	{
		include("Connections/HMS.php");
		$updateSQL = "UPDATE person SET fName=$this->fName, mName=$this->mName, lName=$this->lName, address1=$this->address, address2=$this->area, city=$this->city, state=$this->state, pin=$this->pin, rPhone=$this->rPhone, mobile=$this->mobile, registrationNo=$this->registrationNo, gender=$this->gender, DOB=$this->DOB, maritalStatus=$this->maritalStatus, bloodGroup=$this->bloodGroup, occupation=$this->occupation, email=$this->email WHERE personId = $id";
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