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
	header('Location:ViewAilment.php');
}
unset($_SESSION['data']);
?>

<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
 	
	$(document).ready(function(e) {
				
        $("#form1").validate({
			rules:{
			
			ailmentName:{
				required: true,
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


<form action="cntrl_Ailment.php" method="post" name="form1" id="form1">
  <div id="page-heading"><h1>Add Ailment</h1></div>
  <span style="float:right; margin-right:50px; " ><a href="ViewAilment.php" ><img title="Back to List" src="images/back1.gif"  /></a></span>

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
 
    <tr >
      <th >Ailment Name*:</th>
      <td><input type="text" id="ailmentName" name="ailmentName" value="<?php  if($formAction == "update") echo $data['ailmentName'] ?>" size="32" class="inp-form"/></td>
      <td id="invalid-ailmentName" class="error-left" hidden="true">
    </tr>
        <tr>
      <th>Symptoms:</th>
      <td><input type="text" name="symptoms" size="32" class="inp-form" value="<?php if($formAction == "update") echo $data['symptoms']; ?>" /></td>
   		</tr>
        <tr>
      <th>Comments:</th>
      <td><input type="text" name="comments" size="32" class="inp-form" value="<?php if($formAction == "update") echo $data['comments']; ?>" /></td>
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
  <input type="hidden" name="ailmentId" value="<?php if($formAction == "update") echo $data['ailmentId']; ?>" />
</form>
<p>&nbsp;</p>


<div id="check" class="red-left" ><?php
if(isset($_SESSION['Error']))
	{
		$err = $_SESSION['Error'];
		unset($_SESSION['Error']);
 		 
	}
	echo $err; 
?></div>
<div class="clear"></div>
</body>
</html>