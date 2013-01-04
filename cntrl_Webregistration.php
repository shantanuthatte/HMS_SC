<?php require_once('Connections/HMS.php');
include('mdl_Person.php');
include('mdl_Users.php');
include('mdl_WebRegistration.php');

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

$person = new Person();
	$email1 = GetSQLValueString($_POST['email'], "text");
	$mobile = GetSQLValueString($_POST['mobile'], "text");
	$rPhone = GetSQLValueString($_POST['rPhone'], "text");
	$person->setDetails(GetSQLValueString($_POST['fName'], "text"),
                       GetSQLValueString($_POST['mName'], "text"),
                       GetSQLValueString($_POST['lName'], "text"),
                       GetSQLValueString($_POST['address'], "text"),
					   GetSQLValueString($_POST['area'], "text"),
					   GetSQLValueString($_POST['city'], "text"),
					   GetSQLValueString($_POST['state'], "text"),
					   GetSQLValueString($_POST['pin'], "text"),
                       GetSQLValueString($_POST['rPhone'], "text"),
                       GetSQLValueString($_POST['mobile'], "text"),
                       GetSQLValueString($_POST['registrationNo'], "text"),
                       GetSQLValueString($_POST['gender'], "text"),
                       GetSQLValueString($_POST['DOB'], "text"),
					   GetSQLValueString($_POST['maritalStatus'], "text"),
					   GetSQLValueString($_POST['bloodGroup'], "text"),
					   GetSQLValueString($_POST['occupation'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
					   2);
	$personId = $person->insertPerson();
	if($personId == NULL)
		die(mysql_error());
	else
	{		
		$users = new Users();
		$email2 = GetSQLValueString($_POST['recoveryEmail'], "text");
		$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10/*length*/);
		//echo $randomString;
		$users->setDetails(GetSQLValueString($_POST['userName'], "text"),
                       GetSQLValueString($randomString, "text")/*password*/,
                       $personId,
                       2/*type*/,
                       GetSQLValueString($_POST['recoveryEmail'], "text"),
                       1/*permission*/);
		$userId = $users->insertUser();
		echo "UserId: $userId";
		if($userId == NULL)
			die(mysql_error());
		else
		{
			$webregistration = new WebRegistration();
			$date = date("Y-m-d");
			$webregistration->setDetails(GetSQLValueString($_POST['registrationType'], "text"),
                       $date/*registration Date*/,
                       GetSQLValueString($_POST['registrationName'], "text"),
                       $userId/*authority Id*/,
                       GetSQLValueString($_POST['comments'], "text"));
			if(!$webregistration->insertWebRegistration())
			{
				echo 'An unknown error has occured. Please try again later.';
				die(mysql_error());
			}
			else
			{
				//insert mail code here and send the username and randomstring password to the admin mail
				$message = "There is a request for WebRegistration for which following entries have been created:
					NAME: ".$_POST['registrationName']."
					TYPE: ".$_POST['registrationType']."
					DATE: ".$date."
					PERSON ID: ".$personId."
					USER ID: ".$userId."
					Account Password:".$randomString."
					
					CONTACTS:
						Mobile: ".$mobile."
						Phone: ".$rPhone."
						Email-1: ".$email1."
						Email-2: ".$email2."
					Kindly get in contact with them regarding the further process";
					$emailId = 'anagha_sam@hotmail.com';
					echo 'message';
					mail($emailId,"HMS Registration Request",$message,"From:HMSAdmin <admin@hms.com>");
					echo("An email containing the password has been successfully sent to the admin. He will contact you shortly.");
					exit(0);
			}
		}
	}

/*
$webregistration = new WebRegistration();

if($_POST['formAction'] == "insert")
{
	echo "AuthorityID";
	echo $_POST['authorityId'] ;
	$webregistration->setDetails(GetSQLValueString($_POST['registrationType'], "text"),
                       GetSQLValueString($_POST['registrationDate'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['authorityId'], "text"),
                       GetSQLValueString($_POST['comments'], "text"));
	if(!$webregistration->insertWebRegistration())
		die(mysql_error());
	else
		header('Location: ViewWebRegistration.php');
}
elseif($_POST['formAction'] == "update")
{
	session_start();
	$data = $webregistration->getDetails($_POST['registrationId']);
	$_SESSION['data'] = $data;
	//echo "Hello";
	//var_dump($_SESSION['data']);
	header('Location: AddWebRegistration.php?Mode=update');
}
elseif($_POST['formAction'] == "commit")
{
	$webregistration->setDetails(GetSQLValueString($_POST['registrationType'], "text"),
                       GetSQLValueString($_POST['registrationDate'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['authorityId'], "text"),
                       GetSQLValueString($_POST['comments'], "text"));
	if(!$webregistration->updateWebRegistration($_POST['registrationId']))
		die(mysql_error());
	else
		header('Location: ViewWebRegistration.php');
}
elseif($_POST['formAction'] == "delete")
{
	if(!$webregistration->deleteWebRegistration($_POST['registrationId']))
		die(mysql_error());
	else
		header('Location: ViewWebRegistration.php');
}
*/
?>