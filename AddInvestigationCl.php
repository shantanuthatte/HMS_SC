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
	header('Location:ViewInvestigationCl.php');
}
unset($_SESSION['data']);

mysql_select_db($database_HMS, $HMS);
$query_invstgr = "SELECT * FROM investigationgr";
$invstgr = mysql_query($query_invstgr, $HMS) or die(mysql_error());
$row_invstgr = mysql_fetch_assoc($invstgr);
$totalRows_invstgr = mysql_num_rows($invstgr);
?>

<div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">

<form action="cntrl_InvestigationCl.php" method="post" name="form1" id="form1">
  <div id="page-heading"><h1>Add Investigation Class</h1></div>

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
      <th>GroupId:</th>
      <td><select name="grId" class="styledselect_form_1">
        <?php 
do {  
?>

        <option value="<?php echo $row_invstgr['groupId']?>" <?php if (!(strcmp($row_invstgr['groupId'], $row_invstgr['groupId']))) {echo "SELECTED";} ?>><?php echo $row_invstgr['groupName'];?></option>
        <?php
} while ($row_invstgr = mysql_fetch_assoc($invstgr));
?>
<?php if($formAction == "update") echo $data['groupId']; ?>
      </select>
      </td>
   		</tr>
    <tr>
      <th>Class Name:</th>
      <td>
      <input type="text" name="className" size="32" class="inp-form-error" value="<?php if($formAction == "update") echo $data['className']; ?>"/>
      </td>
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
  <input type="hidden" name="grId" value="<?php if($formAction == "update") echo $data['grId']; ?>" />
</form>
<p>&nbsp;</p>

</body>
</html>