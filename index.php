<?php require_once('Connections/HMS.php'); ?>
<?php
	//include 'scripts.php';	
	//if(isset($_POST["username"]))
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{		
		$username=addslashes($_POST['username']); 
		$password=addslashes($_POST['password']); 
		
		if(isset($username) && isset($password) )
		{
			mysql_select_db($database_HMS, $HMS);
			$query = "SELECT * FROM users WHERE userName = '$username' and password='".md5($password)."'";
			$result = mysql_query($query, $HMS) or die(mysql_error());
			$totalRows = mysql_num_rows($result);			
			if($totalRows == 1)
			{										
				session_start();
				$_SESSION['userId']= $result['userId'];
				$_SESSION['userName']= $_POST['username'];
				$_SESSION['type']= $result['type'];
				$_SESSION['permission']= $result['permission'];
				mysql_free_result($result);
				//header("Refresh:1; URL=firstpage.php");
				header("location: Welcome.php");
			}
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Hospital Management</title>
<link rel="stylesheet" href="css/login.css" type="text/css" title="default" />

<!-- Including web fonts -->
<script src="http://use.edgefonts.net/crete-round.js"></script>

<!--  jquery/ui core -->
<link href="css/dot-luv/jquery-ui-1.9.0.custom.css" rel="stylesheet">
<script src="js/jquery-1.8.2.js"></script>
<script src="js/jquery-ui-1.9.0.custom.js"></script>
<script src="js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>

<!-- Custom jquery scripts -->
<script src="js/jquery/custom_jquery.js" type="text/javascript"></script>

<!-- Image panel jquery script -->
<script src="js/jquery/jquery.panelgallery.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
	$('#gallery').panelGallery({
	sections:21,
	imageTransitionDelay :3000,
	startDelay:3000,
	sectionTransitionDelay : 33
	});
	
});
</script>

<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
<script src="js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$(document).pngFix( );
});
</script>
</head>
<body background="images/login/login_bg.jpg"> 
 
<!-- Start: login-holder -->
<div id="login-holder">
<img src="images/login/Untitled-24.png" />
	<!-- start logo -->
    
	<div class="clear"></div>
	<div id="logo-login"></div>
	<!-- end logo -->
	
	<div class="clear"></div>
	
	<!--  start loginbox ................................................................................. -->
	<div>
    
    <!-- start loginbox left.............................................................................. -->
    <div id="loginbox-left">
    <!-- Gallery plugin -->
    <div id="gallery">
    <img src="images/login/image1.jpg" alt="image-1" width="350" height="233" />
    <img src="images/login/image2.jpg" alt="image-2"width="350" height="233" />
    <img src="images/login/image3.jpg" alt="image-3"width="350" height="233" />
    <img src="images/login/image4.jpg" alt="image-4"width="350" height="233" />
    <img src="images/login/image5.jpg" alt="image-5"width="350" height="233" />
    <img src="images/login/image6.jpg" alt="image-6"width="350" height="233" />
    <img src="images/login/image7.jpg" alt="image-7"width="350" height="233" />
    </div>
    <!-- Text information -->
    <div id="login-text"> Focusing on maintaining data of every individual under one traceable<br />
Identification (Smart Card). Hence the Unique Identification remains<br />
constant throughout his / her life and across all healthcare organizations.
	</div>
    
    <!-- End loginbox left -->
    </div>
    
    <!-- Start loginbox right .................................................................... -->
	<div id="loginbox-right">
	
	<!--  start login-inner -->
	<div id="login-inner">
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<th>Username</th>
			<td><input type="text" name="username"  class="login-inp" /></td>
		</tr>
		<tr>
			<th>Password</th>
			<td><input type="password" name="password" value=""  onfocus="this.value=''" class="login-inp" /></td>
		</tr>
		<tr>
			<th></th>
			<td valign="top"><input type="checkbox" class="checkbox-size" id="login-check" /><label for="login-check">Remember me</label></td>
		</tr>
		<tr>
			<th></th>
			<td><input type="submit" class="submit-login"  /></td>
		</tr>
        <div class="clear"><a href="" class="forgot-pwd">Forgot Password?</a></div>
		</table>
    </form>
	</div>
 	<!--  end login-inner -->
	
    <!-- End loginbox right -->
  </div>
  
 <!--  end loginbox -->
 </div>
	<!--  start forgotbox ................................................................................... -->
    
	<div id="forgotbox">
		<div id="forgotbox-text">Please send us your email and we'll reset your password.</div>
		<!--  start forgot-inner -->
        <form method="post" action="<?=$_SERVER['PHP_SELF']?>" id="forgot-form">
		<div id="forgot-inner">
                        
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<th>Email address:</th>
			<td><input type="text" value="" name="emailId" class="login-inp" id="forgot-email" /></td>
		</tr>
		<tr>
			<th> </th>
			<td><input type="submit" class="submit-login" /></td>
		</tr>
		</table>
		</div>
        </form>
		<!--  end forgot-inner -->
		<div class="clear"></div>
		<a href="" class="back-login">Back to login</a>
	</div>
	<!--  end forgotbox -->
	</div>
<!-- End: login-holder -->
<div 
</body>
</html>