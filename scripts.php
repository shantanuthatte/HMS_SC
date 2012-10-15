<?php require_once('Connections/HMS.php');
	  mysql_select_db($database_HMS, $HMS);
 
	if ($HMS == NULL)
	{
  		die('Could not connect: ' . mysql_error());
  	}

	function sendRecoveryMail($emailId)
	{ 
		$query = "SELECT password FROM users WHERE emailId = '$emailId'";
		$password = mysql_query($query, $HMS) or die(mysql_error());
		$totalRows = mysql_num_rows($person);
		
		if($totalRows == 1)
		{
			$message = " 
			Your password for the HMS login has been recovered!
			The password is : 
			
			<strong> <? $password ?> </strong>
			 
			You can go ahead and use this password to login to our site.
			Have a good Day.
			
			-Admin
			HMS Webmaster
			";
			mail($emailId,"HMS Password Recovery",$message,"From:HMSAdmin <admin@hms.com>");
		}
	
		mysql_free_result($password);
	}

	function error($msg)
	{
		echo '<html>
		<head>
		<script language="JavaScript">
		<!--
		alert("';
		echo $msg;
		echo '");
		history.back();
		//-->
		</script>
		</head>
		<body>
		</body>
		</html>';
	}

function selectAll()
{
	if (!function_exists("GetSQLValueString"))
	{
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
	}
	$query_Recordset1 = "SELECT * FROM person";
	$Recordset1 = mysql_query($query_Recordset1, $HMS) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($Recordset1);
	$totalRows_Recordset1 = mysql_num_rows($Recordset1);
	$even=1;
	do
	{
		$fName = $row_Recordset1['fName'];
		$mName = $row_Recordset1['mName'];
		$lName = $row_Recordset1['lName'];
		$gender = $row_Recordset1['gender'];
		$DOB = $row_Recordset1['DOB'];
		$mobile = $row_Recordset1['mobile'];
		if($even == 1)
		{
			echo'<tr>';
		}
		else
		{
			echo'<tr class="alternate-row">';
		}
		echo <<<EOT
			<td><input  type="checkbox"/></td>
			<td>$fName</td>
			<td>$mName</td>
			<td>$lName</td>
			<td>$gender</td>
			<td>$DOB</td>
			<td>$mobile</td>
			<td class="options-width">
			<a href="" title="Edit" class="icon-1 info-tooltip"></a>
			<a href="" title="Edit" class="icon-2 info-tooltip"></a>
			</td>
			</tr>
EOT;
		if($even == 1)
			$even = 0;
		elseif($even == 0)
			$even = 1;
	}while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
}

?>