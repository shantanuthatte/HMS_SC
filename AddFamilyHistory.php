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
	header('Location:ViewFamilyHistory.php');
}
unset($_SESSION['data']);


mysql_select_db($database_HMS, $HMS);
$query_patient = "SELECT * FROM users";
$patient = mysql_query($query_patient, $HMS) or die(mysql_error());
$row_patient = mysql_fetch_assoc($patient);
$totalRows_patient = mysql_num_rows($patient);
mysql_select_db($database_HMS, $HMS);
$query_ailment = "SELECT * FROM ailment";
$ailment = mysql_query($query_ailment, $HMS) or die(mysql_error());
$row_ailment = mysql_fetch_assoc($ailment);
$totalRows_ailment = mysql_num_rows($ailment);
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
			familyRelation:{
				   required: function(element) {
                return $("#familyRelation").val() == '';
                                                 }
						},
				ailmentId:{
				   required: function(element) {
                return $("#ailmentId").val() == '';
                                                 }
						},
		    diagnosisDate:{
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

<form action="cntrl_FamilyHistory.php" method="post" name="form1" id="form1">
  <div id="page-heading"><h1>Add Family History</h1></div>
<span style="float:right; margin-right:50px; " ><a href="ViewFamilyHistory.php" ><img title="Back to List" src="images/back1.gif"  /></a></span>
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
      <th>PatientId:</th>
      <td><select name="patientId" id="patientId" class="styledselect_form_1">
       <option value="" selected="selected">.....Select.....</option>
        <?php 
do {  
?>
        <option value="<?php echo $row_patient['userId']?>" <?php/* if (!(strcmp($row_patient['userId'], $row_patient['userId']))) {echo "SELECTED";} */?><?php echo $row_patient['userName'];?></option>
        <?php
} while ($row_patient = mysql_fetch_assoc($patient));
?>
<?php if($formAction == "update") echo $data['patientId']; ?>

      </select></td><td>&nbsp;
      </td>
      <td id="invalid-patientId" class="error-left" hidden="true">
      </tr>
        <tr>
      <th>Family Realtion:</th>
      <td><select name="familyRelation" id="familyRelation" class="styledselect_form_1">
      <option value="" selected="selected">.....Select.....</option>
			<option value="Father" <?php if($formAction == "update" && $data['familyRelation'] == "Father") echo "SELECTED"; ?>>Father</option>
			<option value="Mother" <?php if($formAction == "update" && $data['familyRelation'] == "Mother") echo "SELECTED"; ?>>Mother</option>
			<option value="Grandfather" <?php if($formAction == "update" && $data['familyRelation'] == "Grandfather") echo "SELECTED"; ?>>Grandfather</option>
			<option value="Grandmother" <?php if($formAction == "update" && $data['familyRelation'] == "Grandmother") echo "SELECTED"; ?>>Grandmother</option>
            <option value="Brother" <?php if($formAction == "update" && $data['familyRelation'] == "Brother") echo "SELECTED"; ?>>Brother</option>
            <option value="Sister" <?php if($formAction == "update" && $data['familyRelation'] == "Sister") echo "SELECTED"; ?>>Sister</option>
			</select>
            </td>
            <td>&nbsp;
      </td>
      <td id="invalid-familyRelation" class="error-left" hidden="true">
      </tr>
           <tr>
      <th>Ailment:</th>
      
       <td><select name="ailmentId" id="ailmentId" class="styledselect_form_1">
       <option value="" selected="selected">.....Select.....</option>
        <?php 
do {  
?> <option value="<?php echo $row_ailment['ailmentId']?>" <?php/* if (!(strcmp($row_ailment['ailmentId'], $row_ailment['ailmentId']))) {echo "SELECTED";}*/ ?><?php echo $row_ailment['ailmentName'];?></option>
        <?php
} while ($row_ailment = mysql_fetch_assoc($ailment));
?>
<?php if($formAction == "update") echo $data['ailmentId']; ?>
      </select></td><td>&nbsp;
      </td>
      <td id="invalid-ailmentId" class="error-left" hidden="true">
      <tr>
      <th>Diagnosis Date:</th>
      <td><input id="txtDate1" type="text" name="diagnosisDate" value="<?php if($formAction == "update") echo $data['diagnosisDate']; ?>" size="32" class="inp-form" /></td>
     <td><img alt="" src="Calendar/calender.gif"  style="float:right" onClick=" fnOpenCalendar('txtDate1');"/> </td>
      <td id="invalid-txtDate1" class="error-left" hidden="true">
     
    </tr>
        <tr>
      <th>Symptoms:</th>
      <td><input type="text" name="symptoms" value="" size="32" class="inp-form"/>
      <?php if($formAction == "update") echo $data['symptoms']; ?></td>
   		</tr>
        <tr>
      <th>Comments:</th>
      <td><input type="text" name="comments" value="" size="32" class="inp-form"/>
   		<?php if($formAction == "update") echo $data['comments']; ?></td>
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
  <input type="hidden" name="familyHisId" value="<?php if($formAction == "update") echo $data['familyHisId']; ?>" />
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
