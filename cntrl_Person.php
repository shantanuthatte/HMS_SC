<?php require_once('Connections/HMS.php');

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) 
  {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) 
  {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

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
	}
	
	public function setName($fName,$mName,$lName)
	{
		$this->fName = $fName;
		$this->mName = $mName;
		$this->lName = $lName;
	}
	
	public function setAddress($address)
	{
		$this->address = $address;
	}
	
	public function setPhone($rPhone,$mobile)
	{
		$this->rPhone = $rPhone;
		$this->mobile = $mobile;
	}
	
	public function setGender($gender)
	{
		$this->gender = $gender;
	}
	
	public function setDOB($DOB)
	{
		$this->DOB = $DOB;
	}
	
	public function setEmail($email)
	{
		$this->email = $email;
	}
	
	public function insertPerson($database_HMS, $HMS)
	{
		$insertSQL = "INSERT INTO person(fName, mName, lName, address, rPhone, mobile, registrationNo, gender, DOB, email) VALUES ($this->fName,$this->mName,$this->lName,$this->address,$this->rPhone,$this->mobile,$this->registrationNo,$this->gender,$this->DOB,$this->email);";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($insertSQL, $HMS) or die(mysql_error());
	}
	
	public function updatePerson($id,$database_HMS, $HMS)
	{
		$updateSQL = "UPDATE person SET fName=$this->fName, mName=$this->mName, lName=$this->lName, address=$this->address, rPhone=$this->rPhone, mobile=$this->mobile, registrationNo=$this->registrationNo, gender=$this->gender, DOB=$this->DOB, email=$this->email WHERE personId = $id";
		echo $updateSQL;
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($updateSQL, $HMS) or die(mysql_error());
	}
	
	public function deletePerson($id,$database_HMS, $HMS)
	{
		$deleteSQL = "DELETE FROM person WHERE personId=$id";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($deleteSQL, $HMS) or die(mysql_error());
	}
}

$person = new Person();
$person->setDetails(GetSQLValueString($_POST['fName'], "text"),
                       GetSQLValueString($_POST['mName'], "text"),
                       GetSQLValueString($_POST['lName'], "text"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['rPhone'], "text"),
                       GetSQLValueString($_POST['mobile'], "text"),
                       GetSQLValueString($_POST['registrationNo'], "text"),
                       GetSQLValueString($_POST['gender'], "text"),
                       GetSQLValueString($_POST['DOB'], "text"),
                       GetSQLValueString($_POST['email'], "text"));
if($_POST['formAction'] == "insert")
	$person->insertPerson($database_HMS, $HMS);
elseif($_POST['formAction'] == "update")
	$person->updatePerson($_POST['personId'],$database_HMS, $HMS);
elseif($_POST['formAction'] == "delete")
	$person->deletePerson($_POST['personId'],$database_HMS, $HMS);

header('Location: ViewPerson.php');
?>