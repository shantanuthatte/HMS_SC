<?php require_once('Connections/HMS.php'); ?>
<?php
include 'header.php';


mysql_select_db($database_HMS, $HMS);
$query_person = "SELECT * FROM person";
$person = mysql_query($query_person, $HMS) or die(mysql_error());
$row_person = mysql_fetch_assoc($person);
$totalRows_person = mysql_num_rows($person);

$query_clinicalTest = "SELECT * FROM clinicaltest";
$clinicalTest = mysql_query($query_clinicalTest, $HMS) or die(mysql_error());
$row_clinicalTest = mysql_fetch_assoc($clinicalTest);
$totalRows_clinicalTest = mysql_num_rows($clinicalTest);

?>

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


<div id="page-heading"><h1>Prescribe Tests</h1></div>

<!-- start content table -->
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
	
    <!--  start table-content  -->
   
   <table border="0" cellpadding="5" cellspacing="5"  id="id-form">
   <tr>
   <th> Patient: </th>
   	<td><select name="patientId" class="styledselect_form_1">
        <?php do {  ?>
        <option value="<?php echo $row_person['personId']?>" <?php if (!(strcmp($row_person['personId'], $row_person['personId']))) {echo "SELECTED";} ?>><?php echo $row_person['fName']." ".$row_person['lName'];?></option>
        <?php 
		} while ($row_person = mysql_fetch_assoc($person));
		mysql_data_seek($person, 0);?></select></td>
   </tr>
   <tr>
   <th> Doctor: </th>
   <td><select name="doctorId" class="styledselect_form_1">
        <?php do {  ?>
        <option value="<?php echo $row_person['personId']?>" <?php if (!(strcmp($row_person['personId'], $row_person['personId']))) {echo "SELECTED";} ?>><?php echo $row_person['fName']." ".$row_person['lName'];?></option>
        <?php 
		} while ($row_person = mysql_fetch_assoc($person));
		?></select></td>
   </tr>
   <tr>
      <th>TestDate:</th>
      <td><input id="txtDate1" type="text" name="testDate" value="" size="32" class="inp-form" /></td>
      <td><img alt="" src="Calendar/calender.gif"  style="float:left" onClick=" fnOpenCalendar('txtDate1');"/>
      </td>
    </tr>
    <tr>
      <th>DoctorName:</th>
      <td><input type="text" name="doctorName" value="" size="32" class="inp-form" /></td>
    </tr>
    <tr>
    <th>Test:</th>
    <td><select name="testId"  class="styledselect_form_1" >
        <?php do {  ?>
        <option value="<?php echo $row_clinicalTest['testId']?>" <?php if (!(strcmp($row_clinicalTest['testId'], $row_clinicalTest['testId']))) {echo "SELECTED";} ?>><?php echo $row_clinicalTest['name'];?></option>
        <?php 
		} while ($row_clinicalTest = mysql_fetch_assoc($clinicalTest));?></select></td>
    </tr>
    <tr>
    <th>Report Details:</th>
    <td><textarea rows="" cols="" class="form-textarea"></textarea></td>
    </tr>
    <tr>
    <th>Files:</th>
    <td><input type="file" class="file_1" /></td>
	<td>
	<div class="bubble-left"></div>
	<div class="bubble-inner">JPEG, GIF 5MB max per image</div>
	<div class="bubble-right"></div>
	</td>
    </tr>
    <tr>
    <th>Summary:</th>
    <td><textarea rows="" cols="" class="form-textarea"></textarea></td>
    </tr>
    <tr>
    <tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="submit" value="" class="form-submit" />
			<input type="reset" value="" class="form-reset"  />
		</td>
		<td></td>
	</tr>
   </table>
   
   
<!-- end table content -->    
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
</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer........................................................END -->

<div class="clear">&nbsp;</div>
    
<!-- start footer -->         
<div id="footer">
	<!--  start footer-left -->
	<div id="footer-left">
	
	Admin Skin &copy; Copyright Internet Dreams Ltd. <span id="spanYear"></span> <a href="">www.netdreams.co.uk</a>. All rights reserved.</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
 
</body>
</html>
