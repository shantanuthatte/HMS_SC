<?php require_once('Connections/HMS.php'); ?>
<?php
mysql_select_db($database_HMS, $HMS);
if(isset($_GET['function']))
{
	if($_GET['function'] == "ForgotEmail")
	{
		if(isset($_GET['email']))
		{
			$query = "SELECT * FROM users WHERE recoveryEmail LIKE '".mysql_real_escape_string($_GET['email'])."'";
			$password = mysql_query($query, $HMS) or die(mysql_error());
			$totalRows = mysql_num_rows($password);
			if($totalRows == 1)
			{
				$row_password = mysql_fetch_assoc($password);
				$message = " 
Your password for the HMS login has been recovered!
The password is : 

<strong>".$row_password['password']."</strong>
 
You can go ahead and use this password to login to our site.
Have a good Day.

-Admin
HMS Webmaster";
				$emailId = $row_password['recoveryEmail'];
				mail($emailId,"HMS Password Recovery",$message,"From:HMSAdmin <admin@hms.com>");
				echo("Email containing the password successfully sent to $emailId");
				exit(0);
			}
			else
			{
				echo("The specified email id does not exist!");
				exit(0);
			}
			mysql_free_result($password);
		}
		else
		{
			echo("Insufficient parameters!");
		}
	}	
}
else
{
	echo("Invalid paramenters!");
}	
?>