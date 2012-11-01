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
	header('Location:ViewAilment.php');
}
unset($_SESSION['data']);
?>

<div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">

<form action="cntrl_Ailment.php" method="post" name="form1" id="form1">
  <div id="page-heading"><h1>Add Ailment</h1></div>

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
      <th>Ailment Name:</th>
      <td>
      <input type="text" name="ailmentName" size="32" class="inp-form-error" value="<?php if($formAction == "update") echo $data['ailmentName']; ?>"/>
      </td>
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

</body>
</html>