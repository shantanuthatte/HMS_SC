<?php require_once('Connections/HMS.php'); ?>
<?php include 'header.php';
if(!isset($_POST['formAction']))
{
	echo'
	<div class="clear"></div>
	<div id="content-outer">
	<!-- start content -->
	<div id="content">
		<div id="message-red">
			<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="red-left">Error. Irregular navigation! <a href="ViewPerson.php">Go back Home.</a></td>
					<td class="red-right"><a class="close-red"><img src="images/table/icon_close_red.gif"   alt="" /></a></td>
				</tr>
			</table>
		</div>
	</div>
	</div>';
	echo "Hello";
}

else if($_POST['formAction'] == "insert")
{
	$userId = $_POST['userId'];
	$currdate = date("Y-m-d");


	mysql_select_db($database_HMS, $HMS);
	$query_person = "SELECT person.fName AS fName, person.mName AS mName, person.lName AS lName, person.registrationNo AS registrationNo FROM person,users WHERE users.userId = '$userId'	AND person.personId = users.personId;";
	$person = mysql_query($query_person, $HMS) or die(mysql_error());
	$row_person = mysql_fetch_assoc($person);
	
	mysql_select_db($database_HMS, $HMS);
	$query_num = "SELECT MAX(visitNo) AS visitNo
						FROM visit
						WHERE patientId = '$userId';";
	$num = mysql_query($query_num, $HMS) or die(mysql_error());
	$row_num = mysql_fetch_assoc($num);
	$visitNo = $row_num['visitNo'] + 1;
	
	mysql_select_db($database_HMS, $HMS);
	$query_doc = "SELECT person.fName, person.mName, person.lName, users.userId FROM person,users WHERE users.personId = person.personId;";
	$doc = mysql_query($query_doc, $HMS) or die(mysql_error());
	$row_doc = mysql_fetch_assoc($doc);	
	
	mysql_select_db($database_HMS, $HMS);
$query_procedure = "SELECT * FROM `procedure`";
$procedure = mysql_query($query_procedure, $HMS) or die(mysql_error());
$row_procedure = mysql_fetch_assoc($procedure);
$totalRows_procedure = mysql_num_rows($procedure);
?>

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

<div id="message-green" hidden="true">
			<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td id="green-left" class="green-left"></td>
					<td class="green-right"><a class="close-green"><img src="images/table/icon_close_green.gif"   alt="" /></a></td>
				</tr>
			</table>
</div>

<div id="message-red" hidden="true">
			<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td id="red-left" class="red-left"></td>
					<td class="red-right"><a class="close-red"><img src="images/table/icon_close_red.gif"   alt="" /></a></td>
				</tr>
			</table>
</div>

  <div id="page-heading"><h1>Visit Details</h1></div>

<table border="0" width="100%" cellpadding="0" cellspacing="0" >
<tr>
<td width="80%">
<form id="form-visit" action="cntrl_ProcedureTsn.php" method="post">
<div id="accordion-resizer" class="ui-widget-content">
<div id="accordion">
    <h3>Visit</h3>
    <div id="content-table-inner">
        <table style="margin-top:5%" border="0" width="100%" cellpadding="5" cellspacing="5">
   		<tr>
        	<th align="right">
            Date:
        	</th>
            <td align="center">
            <input type="text" id="visitDate" name="visitDate" readonly="readonly" style="background-color:#EEFFDD" class="inp-form" value="<?php echo $currdate; ?>" />
        	</td>
            <th align="right">
            Patient Name:
        	</th>
            <td align="center">
            <input type="text" class="inp-form" style="background-color:#EEFFDD" readonly="readonly" value="<?php echo $row_person['fName']." ".$row_person['mName']." ".$row_person['lName']; ?>" />
        	</td>
     <th align="right">
            Visit No:
        	</th>
            <td align="center">
            <input type="text" id="visitNo" name="visitNo" class="inp-form" style="background-color:#EEFFDD" readonly="readonly" value="<?php echo $visitNo; ?>" />
        	</td>
        </tr>
        <tr style="height:auto">
        <td></td><td></td>
        <th align="right">Referring Doctor:</th>
        <td align="center"><select id="referringDoctorId" name="referringDoctorId" class="styledselect_form_1">
        <option selected="selected" value=""></option>
        <?php 
			do{
				echo'<option value="'.$row_doc["userId"].'">';
				echo $row_doc["fName"].' '.$row_doc["mName"].' '.$row_doc["lName"].'</option>';
			}while ($row_doc = mysql_fetch_assoc($doc));
		?>
        </select>
        </td>
        <td></td><td></td>
        </tr>
        <input type="hidden" name="patientId" id="patientId" value="<?php echo $userId; ?>" />
        <input type="hidden" name="registrationId" id="registrationId" value="<?php echo $row_person['registrationNo']; ?>" />
        <input type="hidden" name="consultingDoctorId" id="consultingDoctorId" value="<?php echo $_SESSION['userId']; ?>" />        
        <input type="hidden" name="formAction" id="formAction" value="insert" />  
        </table>
        <table style="margin-top:6%" border="0" width="100%" cellpadding="5" cellspacing="5">
        
        <tr>
        <td align="center">
        <img src="images/arrow.png" height="128" width="128" style="opacity:0.7" />
        </td>
        </tr>
        </table>
    </div>
    <p><strong>Procedure Details</strong></p>
    <div id="content-table-inner">
        <table border="0" width="100%" cellpadding="5" cellspacing="5">
        <tr>
        	<th align="right">
            ProcedureId:
        	</th>
            <td><select name="procedureId" id="procedureId" class="styledselect_form_1">
        <?php 
do {  
?>
        <option value="<?php echo $row_procedure['procedureId']?>" <?php if (!(strcmp($row_procedure['procedureId'], $row_procedure['procedureId']))) {echo "SELECTED";} ?>><?php echo $row_procedure['procedureName'];?></option>
        <?php
} while ($row_procedure = mysql_fetch_assoc($procedure));
?>


      </select></td>
        </tr>
        <tr bgcolor="#EEFFDD">
        	<th align="right">
            Pre-op Diagnosis:
        	</th>
            <td>
            <input id="PreopD" name="PreopD" type="text" class="inp-form" value="" /> 
        	 </td>
        	
        </tr>
        <tr bgcolor="#EEFFDD">
        	<th align="right">
            Post-op Diagnosis:
        	</th>
            <td>
            <input id="PostopD" name="PostopD" type="text" class="inp-form" value="" />
        	</td>
        	
        </tr>
        <tr>
        	<th align="right">
            Date Of Operation:
        	</th>
          <td><input id="txtDate1" type="text" name="dateOfOperation"/></td>
     <td><img alt="" src="Calendar/calender.gif"  style="float:right" onClick=" fnOpenCalendar('txtDate1');"/> </td>
        </tr>
        <tr bgcolor="#EEFFDD">
        <tr>
        	<th align="right">
            Time Of Operation:
        	</th>
          <td><input id="timeOfOperation" type="text" name="timeOfOperation"/></td>
    </tr>
        	<th align="right">
            Surgeon:
        	</th>
            <td>
            <input id="surgeon" name="surgeon" type="text" class="inp-form" value="" />
        	</td>
        	
        </tr>
        <tr bgcolor="#EEFFDD">
        	<th align="right">
            Anesthesiologist:
        	</th>
            <td>
            <input id="Anesthesiologist" name="Anesthesiologist" type="text" class="inp-form" value="" />
        	</td>
        	
        </tr>
        <tr bgcolor="#EEFFDD">
        	<th align="right">
            Type Of Anesthesia:
        	</th>
            <td>
            <input id="typeOfAnesthesia" name="typeOfAnesthesia" type="text" class="inp-form" value="" />
        	</td>
            <th></th>
            <td></td>
        </tr>
        <tr>
        	<th align="right">
            Comments:
        	</th>
            <td>
            <textarea id="comments" name="comments" class="form-textarea" style="height:60px;" value="" ></textarea>
        	</td>
        	
        </tr>
      </table>
      <input type="submit" id="submit" value="Submit" style="margin-left:45%" class="form-submit" />
</div>   
</form>
</td>
<td>

<!--  start related-act-bar -->
	<div id="related-activities">
		
		<!--  start related-act-top -->
		<div id="related-act-top">
		<img src="images/forms/header_related_act.gif" width="271" height="43" alt="" />
		</div>
		<!-- end related-act-top -->
		
		<!--  start related-act-bottom -->
		<div id="related-act-bottom" style="height:540px">
		
			<!--  start related-act-inner --> 
			<div id="related-act-inner"> 
			<div class="left" id="details-icon"><a href=""><img src="images/forms/icon_edit.gif" width="21" height="21" alt="" /></a></div>
            <div class="right" id="details">
            
            </div> 
			<!-- end related-act-inner -->
		
		</div>
		<!-- end related-act-bottom -->
	
	</div>
	<!-- end related-activities -->

</td>
</tr><!-- End Content -->
	<style>
		 body { font-size: 62.5%; }
		 fieldset { padding:0; border:0; margin-top:25px; }
		div#users-contain { width: 350px; margin: 20px 0; }
		div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
		div#users-contain table td, div#users-contain table th { border: 1px solid #eee; table-layout:fixed; overflow:hidden; padding: .6em 10px; text-align: left; }
		.ui-dialog .ui-state-error { padding: .3em; }
		.validateTips { border: 1px solid transparent; padding: 0.3em; }
		.head { background-color:#97B82F;}
		.alt {background-color:#EEFFDD;}
    </style>
	<div id="dialog-form">
		
    </div>
 <!-- End Content Outer -->
</body>
</html>
<?php } ?>