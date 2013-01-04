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
	header('Location:ViewUserRegistrationlink.php');
}
unset($_SESSION['data']);

mysql_select_db($database_HMS, $HMS);
$query_user = "SELECT * FROM users";
$user = mysql_query($query_user, $HMS) or die(mysql_error());
$row_user = mysql_fetch_assoc($user);
$totalRows_user = mysql_num_rows($user);

mysql_select_db($database_HMS, $HMS);
$query_registration = "SELECT * FROM webregistration";
$registration = mysql_query($query_registration, $HMS) or die(mysql_error());
$row_registration = mysql_fetch_assoc($registration);
$totalRows_registration = mysql_num_rows($registration);

?>

<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
 	
	$(document).ready(function(e) {
				
        $("#form1").validate({
			rules:{
			registrationId:{
				required: true,
					},
			userId:{
				required: true,
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


<form action="cntrl_UserRegistrationlink.php" method="post" name="form1" id="form1">
  <div id="page-heading"><h1>Registration Details</h1></div>

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
      <th>RegistrationId:</th>
      <td><select id="registrationId" name="registrationId" class="styledselect_form_1">
        <?php 
do {  
?>

        <option value="<?php echo $row_registration['registrationId']?>" <?php if (!(strcmp($row_registration['registrationId'], $row_registration['registrationId']))) {echo "SELECTED";} ?>><?php echo $row_registration['name'];?></option>
        <?php
} while ($row_registration = mysql_fetch_assoc($registration));
?>
      </select>
   		</td> <td id="invalid-registrationId" class="error-left" hidden="true"></tr>
        <tr>
      <th>UserId:</th>
      <td><select id="userId" name="userId" class="styledselect_form_1">
        <?php 
do {  
?>

        <option value="<?php echo $row_user['userId']?>" <?php if (!(strcmp($row_user['userId'], $row_user['userId']))) {echo "SELECTED";} ?>><?php echo $row_user['userName'];?></option>
        <?php
} while ($row_user = mysql_fetch_assoc($user));
?>
      </select>
   		</td> <td id="invalid-userId" class="error-left" hidden="true"></tr>
        <tr>
      
    <tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="submit" value="Submit" class="form-submit" />
			<input type="reset" value="Reset" class="form-reset"  />
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
  <input type="hidden" name="formAction" value="<?php if ($formAction == "update") echo "commit"; else echo "insert"; ?>" />
  <input type="hidden" name="userRegLinkId" value="<?php if($formAction == "update") echo $data['userRegLinkId']; ?>" />
</form>
<p>&nbsp;</p>

</body>
</html>