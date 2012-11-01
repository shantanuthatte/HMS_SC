<?php require_once('Connections/HMS.php'); ?>
<?php
include 'header.php';

if(empty($_GET))
{
	header('Location:ViewPerson.php');
}
elseif($_GET['Mode']=="update")
{
	$data = $_SESSION['data'];
	$formAction = "update";
}
elseif($_GET['Mode']=="create")
{
	$formAction = "create";
	$personId = $_SESSION['newUserPersonId'];
	unset($_SESSION['newUserPersonId']);
}
if(isset($_SESSION['data']))
	unset($_SESSION['data']);

if(isset($formAction))
{
?>

<div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">

<form action="cntrl_Users.php" method="post" name="form1" id="form1">
<div id="page-heading"><h1>User Details</h1></div>

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
      <th >UserName:</th>
      <td><input type="text" name="userName" value="<?php  if($formAction == "update") echo $data['userName'] ?>" size="32" class="inp-form"/></td>
    </tr>
    <?php if($formAction != "update")
    echo '<tr >
      <th>Password:</th>
      <td><input type="text" id="password" name="password" value="" size="32" class="inp-form"/></td>
    </tr>'
	?>
    <tr >
      <th>Type:</th>
      <td><input type="text" name="type" value="<?php  if($formAction == "update") echo $data['type'] ?>" size="32" class="inp-form"/></td>
    </tr>
    <tr >
      <th>RecoveryEmail:</th>
      <td><input type="text" name="recoveryEmail" value="<?php  if($formAction == "update") echo $data['recoveryEmail'] ?>" size="32" class="inp-form"/></td>
    </tr>
    <tr >
      <th >Permission:</th>
      <td><input type="text" name="permission" value="<?php  if($formAction == "update") echo $data['permission'] ?>" size="32" class="inp-form" /></td>
    </tr>
    <tr> 
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
  <input type="hidden" id="formAction" name="formAction" value="<?php if ($formAction == "update") echo "commit"; else echo "insert"; ?>" />
  <input type="hidden" name="personId" value="<?php if($formAction == "update") echo $data['personId']; else echo $personId; ?>" />
  <input type="hidden" name="userId" value="<?php if($formAction == "update") echo $data['userId'];?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
}
?>
