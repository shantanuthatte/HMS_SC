<?php require_once('Connections/HMS.php'); ?>
<?php
include 'header.php';
if(isset($_POST['personId']))
{
	$formAction = "update";
}
else
{
	$formAction = "insert";
}
if($formAction == "update")
{
	$query = "SELECT * FROM person WHERE personId = ".$_POST['personId'].";";
	mysql_select_db($database_HMS, $HMS);
	$personRS = mysql_query($query, $HMS) or die(mysql_error());
	$row_personRS = mysql_fetch_assoc($personRS);
	$totalRows_personRS = mysql_num_rows($personRS);
	if($totalRows_personRS >1)
	{
		die(mysql_error());
	}
}

?>
<script src="Calendar/popcalendar.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">
 
    function fnOpenCalendar(id1)
    {        
		//alert("Opens the calendar");
        var ctl1=document.getElementById(id1);
        var ctl2=document.getElementById(id1);
        popUpCalendar(ctl1,ctl2,'dd/mm/yyyy');
        return true;
    }
</script>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Person</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>
<body> 
<div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">

<form action="cntrl_Person.php" method="post" name="form1" id="form1">
  <div id="page-heading"><h1>Person Details</h1></div>

  <table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
<tr>
	<th rowspan="3" class="sized"><img src="images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
	<th class="topleft"></th>
	<td id="tbl-border-top">&nbsp;</td>
	<th class="topright"></th>
	<th rowspan="3" class="sized"><img src="images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
</tr>
<tr>
	<td id="tbl-border-left"></td>
	<td>
	<!--  start content-table-inner -->
	<div id="content-table-inner">
    <!-- starting table contents -->
    <table border="0" cellpadding="5" cellspacing="5"  id="id-form">
 
    <tr>
      <th>First Name:</th>
      <td>
      <input type="text" name="fName" size="32" class="inp-form-error" value="<?php if($formAction == "update") echo $row_personRS['fName']; ?>"/>
      </td>
   		</tr>
        <tr>
      <th>Middle Name:</th>
      <td><input type="text" name="mName" size="32" class="inp-form" value="<?php if($formAction == "update") echo $row_personRS['mName']; ?>" /></td>
   		</tr>
        <tr>
      <th>Last Name:</th>
      <td><input type="text" name="lName" size="32" class="inp-form" value="<?php if($formAction == "update") echo $row_personRS['lName']; ?>" /></td>
    </tr>
    <tr>
      <th>Address:</th>
      <td><textarea rows="3" name="address" size="32" class="inp-form"><?php if($formAction == "update") echo $row_personRS['address']; ?></textarea></td>
    </tr>
    <tr>
      <th>Residence Phone:</th>
      <td><input type="text" name="rPhone" size="32" class="inp-form" value="<?php if($formAction == "update") echo $row_personRS['rPhone']; ?>" /></td>
    </tr>
    <tr>
      <th>Mobile:</th>
      <td><input type="text" name="mobile" size="32" class="inp-form" value="<?php if($formAction == "update") echo $row_personRS['mobile']; ?>"/></td>
    </tr>
    <tr>
      <th valign="top">Registration No:</th>
      <td><input type="text" name="registrationNo" size="32" class="inp-form" value="<?php if($formAction == "update") echo $row_personRS['registrationNo']; ?>"/></td>
    </tr>
    <tr>
      <th>Gender:</th>
      <td><select name="gender" class="styledselect_form_1">
        <option value="Male" <?php if($formAction == "update")
									{
										if($row_personRS['gender'] == "Male") {echo "SELECTED";}
									}
									if($formAction == "insert")
									{
										if (!(strcmp("Male", ""))) {echo "SELECTED";}
									}
							 ?>>Male</option>
        <option value="Female" <?php if($formAction == "update")
									{
										if($row_personRS['gender'] == "Female") {echo "SELECTED";}
									}
									if($formAction == "insert")
									{
										if (!(strcmp("Female", ""))) {echo "SELECTED";}
									}
							 ?>>Female</option>
      </select></td>
    </tr>
    <tr>
      <th>Date Of Birth:</th>
      <td><input id="txtDate1" type="text" name="DOB" value="<?php if($formAction == "update") echo $row_personRS['DOB']; ?>" size="32" class="inp-form" />
      </td>
      <td><img alt="" src="Calendar/calender.gif"  style="float:right" onClick=" fnOpenCalendar('txtDate1');"/>
      </td>
    </tr>
    <tr>
      <th>Email:</th>
      <td>
      <input type="text" name="email" value="<?php if($formAction == "update") echo $row_personRS['email']; ?>" size="32" class="inp-form"/>
      </td>
    </tr> 
    <tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="submit" value="" class="form-submit" />
			<input type="reset" value="" class="form-reset"  />
		</td>
		<td></td>
	</tr>
  </table>
  <!-- ending table contents -->
    
    <div class="clear"></div>
 

</div>
<!--  end content-table-inner  -->
</td>
<td id="tbl-border-right"></td>
</tr>
<tr>
	<th class="sized bottomleft"></th>
	<td id="tbl-border-bottom">&nbsp;</td>
	<th class="sized bottomright"></th>
</tr>
</table>
  <input type="hidden" name="formAction" value="<?php echo $formAction ?>" />
  <input type="hidden" name="personId" value="<?php if($formAction == "update") echo $row_personRS['personId']; ?>" />
</form>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"], minChars:2});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "email", {validateOn:["blur", "change"]});
</script>
</body>
</html>