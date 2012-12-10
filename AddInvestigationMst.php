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
	header('Location:ViewInvestigationMst.php');
}
unset($_SESSION['data']);
?>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
 	
	$(document).ready(function(e) {
				
        $("#form1").validate({
			rules:{
			
			invstName:{
				required: true,
				minlength: 3
				},
			charges:{
				required: false,
			    minlength: 2,
				digits:true
				},
			fromVal1:{
				required: true,
				minlength: 2,
				digits:true
				},
			toVal1:{
				required: true,
				minlength: 2,
				digits:true
				},
			fromVal2:{
				required: true,
				minlength: 2,
				digits:true
				},
			toVal2:{
				required: true,
				minlength: 2,
				digits:true
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

<form action="cntrl_InvestigationMst.php" method="post" name="form1" id="form1">
  <div id="page-heading"><h1>Investigation Details</h1></div>
<span style="float:right; margin-right:50px; " ><a href="ViewInvestigationMst.php" ><img title="Back to List" src="images/back1.gif"  /></a></span>
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
      <th>Investigation Name:</th>
      <td>
      <input type="text" id="invstName" name="invstName" size="32" class="inp-form-error" value="<?php if($formAction == "update") echo $data['invstName']; ?>"/></td>
      <td id="invalid-invstName" class="error-left" hidden="true">
   		</tr>
        <tr>
      <th>Information:</th>
      <td><textarea rows="3" name="info" size="32" class="inp-form"><?php if($formAction == "update") echo $data['info']; ?> </textarea></td>
   		</tr>
        <tr>
      <th>Sex:</th>
      <td><select name="sexFlag" class="styledselect_form_1">
			<option value="M" <?php if($formAction == "update" && $data['sexFlag'] == "M") echo "SELECTED"; ?>>Only Male</option>
			<option value="F" <?php if($formAction == "update" && $data['sexFlag'] == "F") echo "SELECTED"; ?>>Only Female</option>
			<option value="C" <?php if($formAction == "update" && $data['sexFlag'] == "C") echo "SELECTED"; ?>>Common</option>
			<option value="B" <?php if($formAction == "update" && $data['sexFlag'] == "B") echo "SELECTED"; ?>>Both</option>
			</select>
</td>
    </tr>
    <tr>
      <th>To Val1:</th>
      <td><input type="text" id="toVal1" name="toVal1" size="32" class="inp-form" value="<?php if($formAction == "update") echo $data['toVal1']; ?>" /></td>
      <td id="invalid-toVal1" class="error-left" hidden="true">
    </tr>
    <tr>
      <th>From Val1:</th>
      <td><input type="text" id="fromVal1" name="fromVal1" size="32" class="inp-form" value="<?php if($formAction == "update") echo $data['fromVal1']; ?>"/></td>
      <td id="invalid-fromVal1" class="error-left" hidden="true">
      
    </tr>
    <tr>
      <th>To Val2:</th>
      <td><input type="text" id="toVal2" name="toVal2" size="32" class="inp-form" value="<?php if($formAction == "update") echo $data['toVal2']; ?>" /></td>
      <td id="invalid-toVal2" class="error-left" hidden="true">
    </tr>
    <tr>
   <tr>
      <th>From Val2:</th>
      <td><input id="fromVal2" type="text" name="fromVal2" value="<?php if($formAction == "update") echo $data['fromVal2']; ?>" size="32" class="inp-form" /></td>
      <td id="invalid-fromVal2" class="error-left" hidden="true">
      </tr>
    <tr>
      <th>Impression:</th>
      <td>
      <input type="text" name="impression" value="<?php if($formAction == "update") echo $data['impression']; ?>" size="32" class="inp-form"/>
      </td>
    </tr> 
    <tr>
      <th>Result:</th>
      <td>
      <input type="text" name="result" value="<?php if($formAction == "update") echo $data['result']; ?>" size="32" class="inp-form"/>
      </td>
    </tr> 
    <tr>
      <th>Unit:</th>
      <td>
      <input type="text" name="unit" value="<?php if($formAction == "update") echo $data['unit']; ?>" size="32" class="inp-form"/>
      </td>
    </tr> 
    <tr>
      <th>Charges:</th>
      <td>
      <input type="text" id="charges" name="charges" value="<?php if($formAction == "update") echo $data['charges']; ?>" size="32" class="inp-form"/></td>
      <td id="invalid-charges" class="error-left" hidden="true">
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
  <input type="hidden" name="invstId" value="<?php if($formAction == "update") echo $data['invstId']; ?>" />
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