<?php
require_once('Connections/HMS.php');
$validator = new FormValidator();
$validator->addValidation("name","req","Please fill in Name");
$validator->addValidation("email","email","The input for Email should be a valid email value");
$validator->addValidation("email","req","Please fill in Email");
if(!$validator->ValidateForm())
{
    echo "<B>Validation Errors:</B>";

    $error_hash = $validator->GetErrors();
    foreach($error_hash as $inpname => $inp_err)
    {
        echo "<p>$inpname : $inp_err</p>\n";
    }      
}

$host = "localhost";
$user = "root";
$db_name= "HMS";
$pass= "";

$con = mysql_connect($host, $user, $pass);

if (!$con)
{
die('Could not connect: ' . mysql_error());
}
mysql_select_db("HMS", $con); //Replace with your MySQL DB Name
$name=mysql_real_escape_string($_POST['fname']); //This value has to be the same as in the HTML form file
$email=mysql_real_escape_string($_POST['email']); //This value has to be the same as in the HTML form file
$sql="INSERT INTO Mailing_list (fname) VALUES ('$name')"; /*form_data is the name of the MySQL table where the form data will be saved.
name and email are the respective table fields*/
if (!mysql_query($sql,$con)) {
die('Error: ' . mysql_error());
}
echo "The form data was successfully added to your database.";
mysql_close($con);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>