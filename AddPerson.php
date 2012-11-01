<?php require_once('Connections/HMS.php'); ?>
<?php
include 'header.php';
if(empty($_GET))
{
	$formAction = "insert";
}
elseif($_GET['Mode']=="update")
{
	$data = $_SESSION['data'];
	$formAction = "update";
}
else
{
	echo'
	<div class="clear"></div>
	<div id="content-outer">
	<!-- start content -->
	<div id="content">
		<div id="message-red">
			<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="red-left">Error. Irregular navigation! <a href="ViewPerson.php">Go back Home.</a></td>
					<td class="red-right"><a class="close-red"><img src="images/table/icon_close_red.gif"   alt="" /></a></td>
				</tr>
			</table>
		</div>
	</div>
	</div>';
}
unset($_SESSION['data']);
?>
<script src="Calendar/popcalendar.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
 
    function fnOpenCalendar(id1)
    {        
		//alert("Opens the calendar");
        var ctl1=document.getElementById(id1);
        var ctl2=document.getElementById(id1);
        popUpCalendar(ctl1,ctl2,'dd/mm/yyyy');
        return true;
    }
	
	$(document).ready(function(e) {
				
        $("#form1").validate({
			rules:{
			
			fName:{
				required: true,
				minlength: 3
				},
			lName:{
				required: true,
				minlength: 3
				},
			email:{
				required: true,
				email: true
				},
			pin:{
				required: true,
				minlength: 6,
				digits:true
				},
			mobile:{
				required: true,
				minlength: 10,
				digits:true
				},
			DOB:{
				required: true
				}
			},	
			invalidHandler: function(form, validator){
				var errors = validator.numberOfInvalids();
				if(errors)
				{
					var message = "There are "+errors+" errors in the data entered. Correct them before submitting.";
					$("#red-left").html(message);
					$("#message-red").show();
					$(".error-left").show();
				}
			},
			ignore:"ui-tabs-hide",
			errorElement: "div",
			wrapper: "div",
			errorPlacement: function(error,element){
				error.insertAfter('#invalid-' + element.attr('id'));
				error.addClass('error-inner');
			},
			highlight: function(element,errorClass){
				$(element).fadeOut(function() {
     			  $(element).fadeIn();
     			});
				$(element).parent().siblings(".error-left").show();
			},
			unhighlight: function(element,errorClass){
				$(element).parent().siblings(".error-left").hide();
			}
		})
    });
	
</script>

<div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">

<div id="message-red" hidden="true">
			<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td id="red-left" class="red-left"></td>
					<td class="red-right"><a class="close-red"><img src="images/table/icon_close_red.gif"   alt="" /></a></td>
				</tr>
			</table>
</div>
<form action="cntrl_Person.php" method="post" name="form1" id="form1">
  <div id="page-heading"><h1>Person Details</h1></div>


<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Personal Details</a></li>
        <li><a href="#tabs-2">Contact Details</a></li>
    </ul>
    <div id="tabs-1">
        <div id="content-table-inner">
    
    <table border="0" cellpadding="10" cellspacing="10" id="id-form">
    <tr>
      <th>First Name*:</th>
      <td>
      <input type="text" id="fName" name="fName" size="32" class="inp-form" value="<?php if($formAction == "update") echo $data['fName']; ?>"/>
      </td>
      <td></td>
      <td id="invalid-fName" class="error-left" hidden="true">
      </td>
   		</tr>
        <tr>
      <th>Middle Name:</th>
      <td><input type="text" name="mName" size="32" class="inp-form" value="<?php if($formAction == "update") echo $data['mName']; ?>" /></td>
   		</tr>
        <tr>
      <th>Last Name*:</th>
      <td><input id="lName" type="text" name="lName" size="32" class="inp-form" value="<?php if($formAction == "update") echo $data['lName']; ?>" /></td>
      <td></td>
      <td id="invalid-lName" class="error-left" hidden="true">
      </td>
    </tr>
    <tr>
      <th>Registration No:</th>
      <td><input type="text" name="registrationNo" size="32" class="inp-form" value="<?php if($formAction == "update") echo $data['registrationNo']; ?>"/></td>
    </tr>
    <tr>
      <th>Gender*:</th>
      <td><select id="gender" name="gender" class="styledselect_form_1">
        <option value="Male" <?php if($formAction == "update")
									{
										if($data['gender'] == "Male") {echo "SELECTED";}
									}
									if($formAction == "insert")
									{
										if (!(strcmp("Male", ""))) {echo "SELECTED";}
									}
							 ?>>Male</option>
        <option value="Female" <?php if($formAction == "update")
									{
										if($data['gender'] == "Female") {echo "SELECTED";}
									}
									if($formAction == "insert")
									{
										if (!(strcmp("Female", ""))) {echo "SELECTED";}
									}
							 ?>>Female</option>
      </select></td>
    </tr>
    <tr>
      <th>Date Of Birth*:</th>
      <td><input id="txtDate1" type="text" name="DOB" value="<?php if($formAction == "update") echo $data['DOB']; ?>" size="32" class="inp-form" />
      </td>
      <td><img alt="" src="Calendar/calender.gif"  style="float:left" onClick=" fnOpenCalendar('txtDate1');"/>
      </td>
      <td id="invalid-txtDate1" class="error-left" hidden="true">
      </td>
    </tr>
    <tr>
      <th>Marital Status*:</th>
      <td><select id="maritalStatus" name="maritalStatus" class="styledselect_form_1">
        <option value="Single" <?php if($formAction == "update")
									{
										if($data['maritalStatus'] == "Single") {echo "SELECTED";}
									}
									if($formAction == "insert")
									{
										if (!(strcmp("Single", ""))) {echo "SELECTED";}
									}
							 ?>>Single</option>
        <option value="Married" <?php if($formAction == "update")
									{
										if($data['maritalStatus'] == "Married") {echo "SELECTED";}
									}
									if($formAction == "insert")
									{
										if (!(strcmp("Married", ""))) {echo "SELECTED";}
									}
							 ?>>Married</option>
      </select></td>
    </tr>
    <tr>
      <th>Occupation:</th>
      <td><input type="text" name="occupation" size="32" class="inp-form" value="<?php if($formAction == "update") echo $data['occupation']; ?>" /></td>
    </tr>
    <tr>
      <th>Blood Group*:</th>
      <td><select id="bloodGroup" name="bloodGroup" class="styledselect_form_1">
        <option value="A+" <?php if($formAction == "update")
									{
										if($data['bloodGroup'] == "A+") {echo "SELECTED";}
									}
									if($formAction == "insert")
									{
										if (!(strcmp("A+", ""))) {echo "SELECTED";}
									}
							 ?>>A+</option>
        <option value="B+" <?php if($formAction == "update")
									{
										if($data['bloodGroup'] == "B+") {echo "SELECTED";}
									}
									if($formAction == "insert")
									{
										if (!(strcmp("B+", ""))) {echo "SELECTED";}
									}
							 ?>>B+</option>
        <option value="A-" <?php if($formAction == "update")
									{
										if($data['bloodGroup'] == "A-") {echo "SELECTED";}
									}
									if($formAction == "insert")
									{
										if (!(strcmp("A-", ""))) {echo "SELECTED";}
									}
							 ?>>A-</option>
        <option value="B-" <?php if($formAction == "update")
									{
										if($data['bloodGroup'] == "B-") {echo "SELECTED";}
									}
									if($formAction == "insert")
									{
										if (!(strcmp("B-", ""))) {echo "SELECTED";}
									}
							 ?>>B-</option>
        <option value="O+" <?php if($formAction == "update")
									{
										if($data['bloodGroup'] == "O+") {echo "SELECTED";}
									}
									if($formAction == "insert")
									{
										if (!(strcmp("O+", ""))) {echo "SELECTED";}
									}
							 ?>>O+</option>
        <option value="O-" <?php if($formAction == "update")
									{
										if($data['bloodGroup'] == "O-") {echo "SELECTED";}
									}
									if($formAction == "insert")
									{
										if (!(strcmp("O-", ""))) {echo "SELECTED";}
									}
							 ?>>O-</option>
      </select></td>
    </tr>
    </table>
    </div>
    </div>
    <div id="tabs-2">
        <div id="content-table-inner">
    
    <table border="0" cellpadding="10" cellspacing="10"  id="id-form">
    
    <tr>
      <th>Address:</th>
      <td><textarea rows="2" name="address" size="32" cols="1" class="form-textarea"><?php if($formAction == "update") echo $data['address']; ?></textarea></td>
    </tr>
    <tr>
      <th>Area:</th>
      <td><input type="text" name="area" size="32" class="inp-form" value="<?php if($formAction == "update") echo $data['area']; ?>" /></td>
    </tr>
    <tr>
      <th>City:</th>
      <td><input type="text" name="city" size="32" class="inp-form" value="<?php if($formAction == "update") echo $data['city']; ?>" /></td>
    </tr>
    <tr>
      <th>State:</th>
      <td><input type="text" name="state" size="32" class="inp-form" value="<?php if($formAction == "update") echo $data['state']; ?>" /></td>
    </tr>
    <tr>
      <th>PIN Code*:</th>
      <td><input id="pin" type="text" name="pin" size="32" class="inp-form" value="<?php if($formAction == "update") echo $data['pin']; ?>" /></td>
      <td></td>
      <td id="invalid-pin" class="error-left" hidden="true">
      </td>
    </tr>
    <tr>
      <th>Residence Phone:</th>
      <td><input type="text" name="rPhone" size="32" class="inp-form" value="<?php if($formAction == "update") echo $data['rPhone']; ?>" /></td>
    </tr>
    <tr>
      <th>Mobile*:</th>
      <td><input id="mobile" type="text" name="mobile" size="32" class="inp-form" value="<?php if($formAction == "update") echo $data['mobile']; ?>"/></td>
      <td></td>
      <td id="invalid-mobile" class="error-left" hidden="true">
      </td>
    </tr>
    
    <tr>
      <th>Email*:</th>
      <td>
      <input type="text" id="email" name="email" value="<?php if($formAction == "update") echo $data['email']; ?>" size="32" class="inp-form"/>
      </td>
      <td></td>
      <td id="invalid-email" class="error-left" hidden="true">
      </td>
    </tr>    
    <tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="submit" id="submit" value="Submit" class="form-submit" />
			<input type="reset" value="Reset" class="form-reset"  />
		</td>
		<td></td>
	</tr>
  </table>
  
    </div>
    </div>
</div> 
  

  <input type="hidden" name="formAction" value="<?php if ($formAction == "update") echo "commit"; else echo "insert"; ?>" />
  <input type="hidden" name="personId" value="<?php if($formAction == "update") echo $data['personId']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>