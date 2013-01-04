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
	header('Location:ViewWebRegistration.php');
}
unset($_SESSION['data']);

mysql_select_db($database_HMS, $HMS);
$query_authority = "SELECT * FROM users";
$authority = mysql_query($query_authority, $HMS) or die(mysql_error());
$row_authority = mysql_fetch_assoc($authority);
$totalRows_authority = mysql_num_rows($authority);
?>


<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
 	
	$(document).ready(function(e) {
				
        $("#form1").validate({
			rules:{
			registrationType:{
				required: true,
					},
			authorityId:{
				required: true,
					},
			registrationDate:{
				required: true,
					},
			name:{
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

<form action="cntrl_WebRegistration.php" method="post" name="form1" id="form1">
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
      
      <th>Registration Type:</th>
      <td>
		<select id="registrationType" name="registrationType" class="styledselect_form_1">
			<option value="H"  <?php if($formAction == "update" && $data['registrationType'] == "H") echo "SELECTED"; ?>>Hospital</option>
			<option value="C" <?php if($formAction == "update" && $data['registrationType'] == "C") echo "SELECTED"; ?>>Clinic</option>
			<option value="I" <?php if($formAction == "update" && $data['registrationType'] == "I") echo "SELECTED"; ?>>Individual</option>
			</select>
      </td>
      <td></td>
      <td id="invalid-registrationType" class="error-left" hidden="true">
   		</tr>
   <tr>
      <th>Registration Date:</th>
      <td><input id="registrationDate" type="text" name="registrationDate" value="<?php if($formAction == "update") echo $data['registrationDate']; ?>" size="32" class="inp-form" />
      </td>
     
     <td><img alt="" src="Calendar/calender.gif"  style="float:right" onClick=" fnOpenCalendar('txtDate1');"
      -->
      </td>
       <td id="invalid-registrationDate" class="error-left" hidden="true">
    </tr>
    <tr>
      <th>Name:</th>
      <td>
      <input type="text" id="name" name="name" value="<?php if($formAction == "update") echo $data['name']; ?>" size="32" class="inp-form"/>
      </td>
      <td></td>
      <td id="invalid-name" class="error-left" hidden="true">
    </tr>
    <th>AuthorityId:</th>
     <td><select name="authorityId" class="styledselect_form_1">
        <?php 
		do {  
		?>
        <option value="<?php echo $row_authority['userId']?>" <?php if (($formAction == "update")&& (!strcmp($row_authority['userId'], $data['authorityId']))) {echo "SELECTED";} ?>><?php echo $row_authority['userName'];?></option>
        <?php
		} while ($row_authority = mysql_fetch_assoc($authority));
		?>
      </select>
       </td>
       <td></td>
       <td id="invalid-authorityId" class="error-left" hidden="true">
        
    </tr>
     
    <tr>
      <th>Comments:</th>
      <td>
      <input type="text" id="comments" name="comments" value="<?php if($formAction == "update") echo $data['comments']; ?>" size="32" class="inp-form"/>
      </td>
      <td></td>
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
  <input type="hidden" name="registrationId" value="<?php if($formAction == "update") echo $data['registrationId']; ?>" />
</form>
<p>&nbsp;</p>

</body>
</html>