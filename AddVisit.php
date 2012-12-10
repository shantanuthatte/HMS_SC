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
	$query_doc = "SELECT person.fName, person.mName, person.lName, users.userId  FROM person,users WHERE users.personId = person.personId and person.type=0;";
	$doc = mysql_query($query_doc, $HMS) or die(mysql_error());
	$row_doc = mysql_fetch_assoc($doc);	
	//var_dump($userId);
	//var_dump($row_person['fName']);
?>

<script type="text/javascript">
	function addMedicine()
	{
		var count = document.getElementById("medicineCount").value;
		
		var row1 = new String('<tr bgcolor="#EEFFDD"><th align="right">Medicine Name:</th><td><input  name="medicine-0" id="medicine-0" type="text" class="inp-form" value="" style="width:85%" onclick="popMedicine(0)"/> <input type="text" id="medicineId-0" name="medicineId-0" hidden="true" value="" /></td>  <th align="right">Dosage:</th><td><input name="dosage-0" type="text" class="inp-form" value="" /></td></tr>        <tr bgcolor="#EEFFDD"><th align="right">Duration:</th><td><input name="duration-0" type="text" class="inp-form" value="" /></td>        <th align="right">Instruction:</th><td><input name="instruction-0" type="text" class="inp-form" value="" /></td></tr>');
		
		var row2 = new String('<tr><th align="right">Medicine Name:</th><td><input id="medicine-0" name="medicine-0" type="text" class="inp-form" value="" style="width:85%" onclick="popMedicine(0)"/> <input type="text" id="medicineId-0" name="medicineId-0" hidden="true" value="" /></td>      <th align="right">Dosage:</th><td><input name="dosage-0" type="text" class="inp-form" value="" /></td></tr>        <tr><th align="right">Duration:</th><td><input name="duration-0" type="text" class="inp-form" value="" /></td>        <th align="right">Instruction:</th><td><input name="instruction-0" type="text" class="inp-form" value="" /></td></tr>');
		
		count++;
		var content1 = row1.replace(/0/g,count);
		count++;
		var content2 = row2.replace(/0/g,count);
		var content = content1+content2;
		
		$('#add-medicine').before(content);
		document.getElementById("medicineCount").value=count;
	}
	
	function addInvestigation()
	{
		var count = document.getElementById("investigationCount").value;
		
		var row1 = new String('<tr><th align="right">Investigation Name:</th><td colspan="3"><input name="investigationName-0" id="investigationName-0" type="text" class="inp-form" value="" style="width:85%" onclick="popInvestigation(0)" /><input type="text" id="investigationId-0" name="investigationId-0" hidden="true" value="" /></td></tr>        <tr><th align="right">Report Date:</th><td><input name="reportDate-0" type="text" class="inp-form" value="" /></td><th align="right">Institution:</th><td><input name="institution-0" type="text" class="inp-form" value="" /></td></tr>        <tr><th align="right">Value:</th><td><input name="value-0" type="text" class="inp-form" value="" /></td><th align="right">Results:</th><td><input name="results-0" type="text" class="inp-form" value="" /></td></tr>');
		
		var row2 = new String('<tr bgcolor="#EEFFDD"><th align="right">Investigation Name:</th><td colspan="3"><input name="investigationName-0" id="investigationName-0" type="text" class="inp-form" value="" style="width:85%" onclick="popInvestigation(0)" /><input type="text" id="investigationId-0" name="investigationId-0" hidden="true" value="" /></td></tr>        <tr bgcolor="#EEFFDD"><th align="right">Report Date:</th><td><input name="reportDate-0" type="text" class="inp-form" value="" /></td><th align="right">Institution:</th><td><input name="institution-0" type="text" class="inp-form" value="" /></td></tr>        <tr bgcolor="#EEFFDD"><th align="right">Value:</th><td><input name="value-0" type="text" class="inp-form" value="" /></td><th align="right">Results:</th><td><input name="results-0" type="text" class="inp-form" value="" /></td></tr>');
		
		count++;
		var content1 = row1.replace(/0/g,count);
		count++;
		var content2 = row2.replace(/0/g,count);
		var content = content1+content2;
		
		$('#add-investigation').before(content);
		document.getElementById("investigationCount").value=count;
		
	}
	
	
</script>

<!-- Validation Scripts -->
<script src="js/jquery-1.8.2.js"></script>
<script src="js/jquery-ui-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script>
	$(document).ready(function(e) { 
	
	$(function() {
		
        $( "#accordion" ).accordion({ 
			heightStyle: "fill",
			activate: function(event, ui){
				var active = $(this).accordion("option","active");
				if(active == 0)
				{
					$.ajax({ url:"AjaxVisit.php",
						data:"action=familyDetails&userId=<?php echo $userId; ?>",
						success: function(data){ 
							$("#details").html("");
							$("#details").append(data);							
						}
					});
				}
				if(active == 1)
				{
					$.ajax({ url:"AjaxVisit.php",
						data:"action=medicalDetails&userId=<?php echo $userId; ?>",
						success: function(data){ 
							$("#details").html("");
							$("#details").append(data);							
						}
					});
				}
				else if(active == 2)
				{
					$.ajax({ url:"AjaxVisit.php",
						data:"action=allergyDetails&userId=<?php echo $userId; ?>",
						success: function(data){ 
							$("#details").html("");
							$("#details").append(data);							
						}
					});
				}
				else if(active == 3)
				{
					$.ajax({ url:"AjaxVisit.php",
						data:"action=medicalDetails&userId=<?php echo $userId; ?>",
						success: function(data){ 
							$("#details").html("");
							$("#details").append(data);							
						}
					});
				}
			}
		});
		
		$('#dialog-form').dialog({
            autoOpen: false,
            height: "auto",
            width: "auto",
			maxWidth:700,
            modal: true,
			resizable: false,
			show: "slow"
        });
		
    });
	
	  
	$('#form-visit').validate({
			rules:{
				visitDate:{
					required : true
				},
				patientId:{
					required: true
				},
				visitNo:{
					required:true
				},
				consultingDoctorId:{
					required:true	
				},
				patientComplain:{
					required:true
				},
				pulse:{
					required:true,
					digits:true	
				},
				examination:{
					required:true	
				},
				
				finalDiagnosis:{
					required:true	
				}
			},
			invalidHandler:function(form,validator){
				
				var errors = validator.numberOfInvalids();
				if(errors)
				{
					$("#accordion").accordion("activate", 1);
					var message = "There are "+errors+" errors in the Visit data. Correct them before submitting.";
					$("#red-left").html(message);
					$("#message-red").show();
				}
			},
			ignore: [],
			errorElement: "div",
			wrapper: "div",
			errorPlacement: function(error,element){
				element.addClass('inp-form-error');
				element.css({'border-color':'#F00'});
			},
			highlight: function(element,errorClass){
				$(element).fadeOut(function() {
     			  $(element).fadeIn();
     			});
			},
			unhighlight: function(element,errorClass){
				$(element).removeClass('inp-form-error');
				
			}
		});
    });
	
	function popInvestigation(num)
	{
		$.ajax({
			url: "AjaxVisit.php",
			data: "action=investigationNames&page=1&num="+num,
			success: function(data) {
				$('#dialog-form').html(data);
				$( "#dialog-form" ).dialog( "option", "title", "Investigation Names" );
				$("#dialog-form").dialog("open");
			}
		});
	}
	
	function popMedicine(num)
	{
		$.ajax({
			url: "AjaxVisit.php",
			data: "action=medicineNames&page=1&num="+num,
			success: function(data) {
				$('#dialog-form').html(data);
				$( "#dialog-form" ).dialog( "option", "title", "Medicine Names" );
				$("#dialog-form").dialog("open");
			}
		});
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
<span style="float:right; margin-right:50px; " ><a href="ViewVisits.php"  ><img title="Back to List" src="images/back1.gif" /></a></span>
<table border="0" width="100%" cellpadding="0" cellspacing="0" >
<tr>
<td width="80%">
<form id="form-visit" action="cntrl_Visit.php" method="post">
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
        <option selected="selected" value="">....Select....</option>
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
    <h3>Examination</h3>
    <div id="content-table-inner">
        <table border="0" width="100%" cellpadding="5" cellspacing="5">
        <tr>
        	<th align="right">
            Complain:
        	</th>
            <td colspan="3">
            <textarea id="patientComplain" name="patientComplain" class="form-textarea" style="width:84%; height:32px;" value="" ></textarea>
        	</td>
        </tr>
        <tr bgcolor="#EEFFDD">
        	<th align="right">
            Pulse:
        	</th>
            <td>
            <input id="pulse" name="pulse" type="text" class="inp-form" value="" />
        	</td>
        	<th align="right">
            RR:
        	</th>
            <td>
            <input id="RR" name="RR" type="text" class="inp-form" value="" />
        	</td>
        </tr>
        <tr bgcolor="#EEFFDD">
        	<th align="right">
            BP Sys:
        	</th>
            <td>
            <input id="bpSys" name="bpSys" type="text" class="inp-form" value="" />
        	</td>
        	<th align="right">
            BP Dia:
        	</th>
            <td>
            <input id="bpDia" name="bpDia" type="text" class="inp-form" value="" />
        	</td>
        </tr>
        <tr>
        	<th align="right">
            Examination:
        	</th>
            <td colspan="3">
            <textarea id="examination" name="examination" class="form-textarea" style="width:84%; height:32px;" value="" ></textarea>
        	</td>
        </tr>
        <tr bgcolor="#EEFFDD">
        	<th align="right">
            Hieght:
        	</th>
            <td>
            <input id="height" name="height" type="text" class="inp-form" value="" />
        	</td>
        	<th align="right">
            Wieght:
        	</th>
            <td>
            <input id="weight" name="weight" type="text" class="inp-form" value="" />
        	</td>
        </tr>
        <tr bgcolor="#EEFFDD">
        	<th align="right">
            Habits:
        	</th>
            <td>
            <input id="habit" name="habit" type="text" class="inp-form" value="" />
        	</td>
            <th></th>
            <td></td>
        </tr>
        <tr>
        	<th align="right">
            Final Diagnosis:
        	</th>
            <td>
            <textarea id="finalDiagnosis" name="finalDiagnosis" class="form-textarea" style="height:60px;" value="" ></textarea>
        	</td>
        	<th align="right">
            Comments:
        	</th>
            <td>
            <textarea id="comments" name="comments" class="form-textarea" style="height:60px;" value="" ></textarea>
        	</td>
        </tr>
        </table>
    </div>
    <h3>Prescription</h3>
    <div id="content-table-inner">
        <table border="0" width="100%" cellpadding="5" cellspacing="5">
        <tr>
        <th align="right">Medicine Name:
        </th>
        <td>
        <input id="medicine-1" name="medicine-1" type="text" class="inp-form" value=""  onclick="popMedicine(1)" />
        <input type="text" id="medicineId-1" name="medicineId-1" hidden="true" value="" />        
        </td>
        <th align="right">Dosage:
        </th>
        <td>
        <input name="dosage-1" type="text" class="inp-form" value="" />
        </td>
        </tr>
        <tr>
        <th align="right">Duration:
        </th>
        <td>
        <input name="duration-1" type="text" class="inp-form" value="" />
        </td>
        <th align="right">Instruction:
        </th>
        <td>
        <input name="instruction-1" type="text" class="inp-form" value="" />
        </td>
        </tr> 
        <tr bgcolor="#EEFFDD">
        <th align="right">Medicine Name:
        </th>
        <td>
        <input id="medicine-2" name="medicine-2" type="text" class="inp-form" value="" onclick="popMedicine(2)" />
        <input type="text" id="medicineId-2" name="medicineId-2" hidden="true" value="" />
        </td>
        <th align="right">Dosage:
        </th>
        <td>
        <input name="dosage-2" type="text" class="inp-form" value="" />
        </td>
        </tr>   
        <tr bgcolor="#EEFFDD">
        <th align="right">Duration:
        </th>
        <td>
        <input name="duration-2" type="text" class="inp-form" value="" />
        </td>
        <th align="right">Instruction:
        </th>
        <td>
        <input name="instruction-2" type="text" class="inp-form" value="" />
        </td>
        </tr>
        <tr>
        <th align="right">Medicine Name:
        </th>
        <td>
        <input id="medicine-3" name="medicine-3" type="text" class="inp-form" value="" onclick="popMedicine(3)" />
        <input type="text" id="medicineId-3" name="medicineId-3" hidden="true" value="" />
        </td>
        <th align="right">Dosage:
        </th>
        <td>
        <input name="dosage-3" type="text" class="inp-form" value="" />
        </td>
        </tr>
        <tr>
        <th align="right">Duration:
        </th>
        <td>
        <input name="duration-3" type="text" class="inp-form" value="" />
        </td>
        <th align="right">Instruction:
        </th>
        <td>
        <input name="instruction-3" type="text" class="inp-form" value="" />
        </td>
        </tr> 
        <tr id="add-medicine">
        <td colspan="4" id="add-icon" align="center"><img src="images/add.png" style="cursor:pointer" width="32" height="32" onclick="addMedicine()" /></td>
        <input type="text" id="medicineCount" name="medicineCount" hidden="true" value="3" />
        
         </tr>  
        </table>
    </div>
    <h3 >Investigation</h3>
    <div id="content-table-inner">
        <table border="0" width="100%" cellpadding="5" cellspacing="5">
        <tr>
        <th align="right">Investigation Name:
        </th>
        <td colspan="3">
        <input id="investigationName-1" name="investigationName-1" type="text" class="inp-form" value="" style="width:85%" onclick="popInvestigation(1)" />
        <input type="text" id="investigationId-1" name="investigationId-1" hidden="true" value="" />
        </td>
        </tr>
        <tr>
        <th align="right">Report Date:
        </th>
        <td>
        <input name="reportDate-1" type="text" class="inp-form" value="" />
        </td>
        <th align="right">Institution:
        </th>
        <td>
        <input name="institution-1" type="text" class="inp-form" value="" />
        </td>
        </tr>
        <tr>
        <th align="right">Value:
        </th>
        <td>
        <input name="value-1" type="text" class="inp-form" value="" />
        </td>
        <th align="right">Results:
        </th>
        <td>
        <input name="results-1" type="text" class="inp-form" value="" />
        </td>
        </tr>
        <tr bgcolor="#EEFFDD">
        <th align="right">Investigation Name:
        </th>
        <td colspan="3">
        <input id="investigationName-2" name="investigationName-2" type="text" class="inp-form" value="" style="width:85%" onclick="popInvestigation(2)" />
        <input type="text" id="investigationId-2" name="investigationId-2" hidden="true" value="" />
        </td>
        </tr>
        <tr bgcolor="#EEFFDD">
        <th align="right">Report Date:
        </th>
        <td>
        <input name="reportDate-2" type="text" class="inp-form" value="" />
        </td>
        <th align="right">Institution:
        </th>
        <td>
        <input name="institution-2" type="text" class="inp-form" value="" />
        </td>
        </tr>
        <tr bgcolor="#EEFFDD">
        <th align="right">Value:
        </th>
        <td>
        <input name="value-2" type="text" class="inp-form" value="" />
        </td>
        <th align="right">Results:
        </th>
        <td>
        <input name="results-2" type="text" class="inp-form" value="" />
        </td>
        </tr> 
        <tr id="add-investigation">
        <td colspan="4" id="add-icon" align="center"><img src="images/add.png" style="cursor:pointer" width="32" height="32" onclick="addInvestigation()" /></td>
        <input type="text" id="investigationCount" name="investigationCount" hidden="true" value="2" />
        </tr>  
        </table>
    </div>
</div>
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
</tr>
</div> 
<!-- End Content -->
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

 </div>
 <!-- End Content Outer -->
 
 <div><br />
 <br />
 <br />
 </div>
 
</body>
</html>
<?php } ?>