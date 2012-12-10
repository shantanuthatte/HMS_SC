<?php require_once('Connections/HMS.php'); ?>
<?php
include 'header.php';
$err="";
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
	header('Location:ViewPatientallergy.php');
}
unset($_SESSION['data']);

mysql_select_db($database_HMS, $HMS);
$query_patient = "SELECT * FROM users";
$patient = mysql_query($query_patient, $HMS) or die(mysql_error());
$row_patient = mysql_fetch_assoc($patient);
$totalRows_patient = mysql_num_rows($patient);
?>

<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
 	
	$(document).ready(function(e) {
				
        $("#form1").validate({
			rules:{
			patientId:{
				   required: function(element) {
                return $("#patientId").val() == '';
                                                 }
						},
			type:{
				   required: function(element) {
                return $("#type").val() == '';
                                                 }
						},
			allergy:{
				required: true,
				minlength: 3
				},
			comments:{
				minlength: 3
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


<form action="cntrl_Patientallergy.php" method="post" name="form1" id="form1">
  <div id="page-heading">
    <h1>Patient Allergy Details</h1>
      </div>
      <span style="float:right; margin-right:50px; " ><a href="ViewPatientallergy.php" ><img title="Back to List" src="images/back1.gif"  /></a></span>

  <table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
<tr>
	<th rowspan="3" class="sized"><img src="file:///C|/Documents and Settings/sharad03/Desktop/images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
	<th class="topleft"></th>
	<td id="tbl-border-top">&nbsp;</td>
	<th class="topright"></th>
	<th rowspan="3" class="sized"><img src="file:///C|/Documents and Settings/sharad03/Desktop/images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
</tr>
<tr>
	<td id="tbl-border-left"></td>
	<td>
	<!--  start content-table-inner -->
	<div id="content-table-inner">
    <!-- starting table contents -->
    <table border="0" cellpadding="5" cellspacing="5"  id="id-form">
 
    <tr>
      <th>PatientId:</th>
      <td><select id="patientId" name="patientId" class="styledselect_form_1">
      <option value="" selected="selected">.....Select.....</option>
        <?php 
do {  
?>

        <option value="<?php echo $row_patient['userId']?>" <?php /*if (!(strcmp($row_patient['userId'], $row_patient['userId']))) {echo "SELECTED";} */?>><?php echo $row_patient['userName'];?></option>
        <?php
} while ($row_patient = mysql_fetch_assoc($patient));
?>
<?php if($formAction == "update") echo $data['patientId']; ?>
      </select>
      </td>
      <td id="invalid-patientId" class="error-left" hidden="true">
   		</tr>
        <tr>
      <th>Allergy Type:</th>
      <td><select id="type" name="type" class="styledselect_form_1">
      <option value="" selected="selected">.....Select.....</option>
			<option value="D" <?php if($formAction == "update" && $data['type'] == "D") echo "SELECTED"; ?>>Drug</option>
			<option value="F" <?php if($formAction == "update" && $data['type'] == "F") echo "SELECTED"; ?>>Food</option>
			<option value="T" <?php if($formAction == "update" && $data['type'] == "T") echo "SELECTED"; ?>>Drug Text</option>
			<option value="O" <?php if($formAction == "update" && $data['type'] == "O") echo "SELECTED"; ?>>Other</option>
			</select>
</td>
<td id="invalid-type" class="error-left" hidden="true">
    <tr>
      <th>Allergy:</th>
      <td><input type="text" id="allergy" name="allergy" size="32" class="inp-form" value="<?php if($formAction == "update") echo $data['allergy']; ?>" /></td>
      <td id="invalid-allergy" class="error-left" hidden="true">
    </tr>
    <tr>
      <th>Comments:</th>
      <td><input type="text" id="comments" name="comments" size="32" class="inp-form" value="<?php if($formAction == "update") echo $data['comments']; ?>"/></td>
      <td id="invalid-comments" class="error-left" hidden="true">
    </tr>
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
  <input type="hidden" name="allergyId" value="<?php if($formAction == "update") echo $data['allergyId']; ?>" />
</form>
<p>&nbsp;</p>
<div id="check" class="red-left-s">
<?php
if(isset($_SESSION['Error']))
	{
		$err = $_SESSION['Error'];
		
		unset($_SESSION['Error']);
		$explodedstring = explode(",", $err);
foreach($explodedstring as $err)
 echo $err.'<br />';
 		 
	}
?>
</div>
</body>
</html>