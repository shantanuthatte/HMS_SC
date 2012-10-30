<?php
class MedicineClass
{	
	private $classId, $className;
	
	function __construct()
	{
	}
	
	function setDetails($classId, $className)
	{
        $this->classId = $classId;
		$this->className = $className;
		
		
		}
	
	public function getDetails($id)
	{
		include("Connections/HMS.php");
		$query = "SELECT * FROM medicineclass WHERE classId = '$id';";
		mysql_select_db($database_HMS, $HMS);
		$mediclass = mysql_query($query, $HMS) or die(mysql_error());
		$row_mediclass = mysql_fetch_assoc($mediclass);
		$totalRows_mediclass = mysql_num_rows($mediclass);
		if($totalRows_mediclass >1)
		{
			die(mysql_error());
		}
		$this->classId = $row_mediclass['classId'];
		$this->className = $row_mediclass['className'];
		$data = array("classId"=>$id,"classId"=>$this->classId, "className"=>$this->className);
		return $data;
	}
	
	public function insertmedicineclass()
	{
		include("Connections/HMS.php");
		$insertSQL = "INSERT INTO medicineclass(classId, className) VALUES ($this->classId,$this->className);";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($insertSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function updatemedicineclass($id)
	{
		include("Connections/HMS.php");
		$updateSQL = "UPDATE medicineclass SET classId=$this->classId, className=$this->className WHERE classId = '$id'";
		echo $updateSQL;
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($updateSQL, $HMS) or die(mysql_error());
		return true;
	}
	
	public function deletemedicineclass($id)
	{
		include("Connections/HMS.php");
		$deleteSQL = "DELETE FROM medicineclass WHERE classId='$id'";
		mysql_select_db($database_HMS, $HMS);
		$Result1 = mysql_query($deleteSQL, $HMS) or die(mysql_error());
		return true;
	}
}

?>