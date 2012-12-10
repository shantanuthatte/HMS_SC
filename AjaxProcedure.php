<?php


if(isset($_GET['action']))
{
	$error= "following are errors:  ";
	if($_GET['action'] == "procedure")
	{
		
		
		
		if(empty($_GET['city']))
		{
			$error= $error . "\n\nCITY is empty";
			}
		
		if(empty($_GET['comments']))
		{
			$error = $error . "\n\ncomment is empty"
			
		 ;}
		else
		{//echo "  \n  ,value found";
		$error = $error . "\n\ncomment is found";
		
		}
		if(!filter_var($_GET['email'], FILTER_VALIDATE_EMAIL))
		{
			$error = $error . "\n\nemail found";
			//echo  "  ,email found";
		}
		else
		{
			$error = $error . "\n\nerror \nemail";
			//echo "  \n ,error \nemail";
		}
		if(strlen($_GET['comments'])<4)
		{//echo  "\nshort";
		$error = $error . "\n\nshort";
		 }
		else
		{//echo "\n,enogh";
		$error = $error . "\n\nlong";
		}
		if(is_string($_GET['comments'])==0)
		{
			$error = $error . "\n\ncorrect com";
			//echo  "\n,correct com";
		
		 ;}
		else
		{
			$error = $error . "\n\nwrong comment";
			//echo "\n,wrong comment";
		}
	}
	$k= filter_var($_GET['email'], FILTER_VALIDATE_EMAIL);
	echo $error.$k;	
	
	//echo $k;

}
/*
    ctype_digit() - Check for numeric character(s)
    is_bool() - Finds out whether a variable is a boolean
    is_null() - Finds whether a variable is NULL
    is_float() - Finds whether the type of a variable is float
    is_int() - Find whether the type of a variable is integer
    is_string() - Find whether the type of a variable is string
    is_object() - Finds whether a variable is an object
    is_array() - Finds whether a variable is an array

*/

?>