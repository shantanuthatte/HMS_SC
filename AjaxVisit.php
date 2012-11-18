<?php require_once('Connections/HMS.php'); ?>
<?php 
mysql_select_db($database_HMS, $HMS);
if(isset($_GET['action']))
{
	if($_GET['action'] == "medicalDetails")
	{
		if(isset($_GET['userId']))
		{
			$query = "SELECT M.medicalHisId,M.diagnosisDate AS diagnosisDate, A.ailmentName AS ailmentName
						FROM medicalhistory AS M, ailment AS A
						WHERE M.ailmentId = A.ailmentId
						AND M.patientId = '".$_GET['userId']."'
						ORDER BY M.medicalHisId DESC";
			$rows = mysql_query($query, $HMS) or die(mysql_error());
			$row = mysql_fetch_assoc($rows);
			$totalRows = mysql_num_rows($rows);
			echo '<h5 style="color:#94B52C">Recent Medical History</h5>
					<table cellpadding="5">
					<tr>
					<th>Date</th>
					<th>Ailment</th>
					</tr>';
			do{
				echo "<tr><td>".$row['diagnosisDate']."</td><td>".$row['ailmentName']."</td></tr>";	
			}while($row = mysql_fetch_assoc($rows));
			echo '</table>';
			exit(0);
		}
	}
	else if($_GET['action'] == "allergyDetails")
	{
		if(isset($_GET['userId']))
		{
			$query = "SELECT allergy, type
						FROM patientallergy
						WHERE patientId = '".$_GET['userId']."';";
			$rows = mysql_query($query, $HMS) or die(mysql_error());
			$row = mysql_fetch_assoc($rows);
			$totalRows = mysql_num_rows($rows);
			echo '<h5 style="color:#94B52C">Allergy Details</h5>
					<table cellpadding="5">
					<tr>
					<th>Allergy</th>
					<th>Type</th>
					</tr>';
			do{
				echo "<tr><td>".$row['allergy']."</td>";
				if($row['type'] == "D" || $row['type'] == "T")
					echo "<td>Drug</td></tr>";
				else if($row['type'] == "F")
					echo "<td>Food</td></tr>";
				else if($row['type'] == "O")
					echo "<td>Other</td></tr>";
			}while($row = mysql_fetch_assoc($rows));
			echo '</table>';
			exit(0);
		}
	}
	else if($_GET['action'] == "familyDetails")
	{
		if(isset($_GET['userId']))
		{
			$query = "SELECT F.familyHisId,F.familyRelation AS familyRelation, A.ailmentName AS ailmentName
						FROM familyhistory AS F, ailment AS A
						WHERE F.ailmentId = A.ailmentId
						AND F.patientId = '".$_GET['userId']."'
						ORDER BY F.familyHisId DESC";
			$rows = mysql_query($query, $HMS) or die(mysql_error());
			$row = mysql_fetch_assoc($rows);
			$totalRows = mysql_num_rows($rows);
			echo '<h5 style="color:#94B52C">Family Details</h5>
					<table cellpadding="5">
					<tr>
					<th>Relation</th>
					<th>Ailment</th>
					</tr>';
			do{
				echo "<tr><td>".$row['familyRelation']."</td><td>".$row['ailmentName']."</td></tr>";
			}while($row = mysql_fetch_assoc($rows));
			echo '</table>';
			exit(0);
		}
	}
	else if($_GET['action'] == "examinationDetails")
	{
		if(isset($_GET['visitId']))
		{
			$query = "SELECT * FROM examination WHERE visitId = '".$_GET['visitId']."';";
			$rows = mysql_query($query, $HMS) or die(mysql_error());
			$row = mysql_fetch_assoc($rows);
			$totalRows = mysql_num_rows($rows);
			echo '<table border="1" cellspacing="50" cellpadding="10" bordercolor="#D6D6D6" class="ui-widget" id="users-contain">
					<tr>
					<th class="head">Complain</th>
					<td colspan="3">'.$row['patientComplain'].'</td>
					</tr>';
			echo '<tr>
					<th class="head">Pulse</th>
					<td>'.$row['pulse'].'</td>
					<th class="head">RR</th>
					<td>'.$row['RR'].'</td>
					</tr>';
			echo '<tr>
					<th class="head">BP Sys</th>
					<td>'.$row['bpSys'].'</td>
					<th class="head">BP Dia</th>
					<td>'.$row['bpDia'].'</td>
					</tr>';
			echo '<tr>
					<th class="head">Examination</th>
					<td colspan="3">'.$row['examination'].'</td>
					</tr>';
			echo '<tr>
					<th class="head">Height</th>
					<td>'.$row['height'].'</td>
					<th class="head">Weight</th>
					<td>'.$row['weight'].'</td>
					</tr>';
			echo '<tr>
					<th class="head">Habits</th>
					<td>'.$row['habit'].'</td>
					</tr>';
			echo '<tr>
					<th class="head">Diagnosis</th>
					<td>'.$row['finalDiagnosis'].'</td>
					<th class="head">Comments</th>
					<td>'.$row['comments'].'</td>
					</tr>';
			echo '</table>';
			exit(0);
		}
	}
	else if($_GET['action'] == "prescriptionDetails")
	{
		if(isset($_GET['visitId']))
		{
			$even = false;
			$query = "SELECT * FROM prescription WHERE visitId = '".$_GET['visitId']."';";
			$rows = mysql_query($query, $HMS) or die(mysql_error());
			$row = mysql_fetch_assoc($rows);
			$totalRows = mysql_num_rows($rows);
			echo '<table border="1" cellspacing="50" cellpadding="10" bordercolor="#D6D6D6" class="ui-widget" id="users-contain">
					<tr>
					<th class="head">Id</th>
					<th class="head">Medicine</th>
					<th class="head">Dosage</th>
					<th class="head">Duration</th>
					<th class="head">Instruction</th>
					</tr>';
			do{
				if($even == true)
				{
					echo '<tr class="alt">';
					$even = false;
				}
				else
				{
					echo '<tr>';
					$even = true;
				}
				echo "<td>".$row['lineId']."</td><td>".$row['medicineName']."</td><td>".$row['dosage']."</td>";
				echo "<td>".$row['duration']."</td><td>".$row['instruction']."</td></tr>";
			}while($row = mysql_fetch_assoc($rows));
			echo '</table>';
			exit(0);
		}
	}
	else if($_GET['action'] == "investigationNames")
	{
		if(isset($_GET['page'])&&(isset($_GET['num'])))
		{
			$even = false;
			if(($_GET['page'] > 0) && ($_GET['page'] < 36))
				$from = (($_GET['page']*10)-10);
			else
				$from = 0;
			$query = "SELECT invstId, invstName, info FROM investigationmst LIMIT $from, 10;";
			$rows = mysql_query($query, $HMS) or die(mysql_error());
			$row = mysql_fetch_assoc($rows);
			$totalRows = mysql_num_rows($rows);
			echo '<table border="1" cellspacing="50" cellpadding="10" bordercolor="#D6D6D6" class="ui-widget" id="users-contain">
					<tr>
					<th class="head" width="3%">Id</th>
					<th class="head" width="20%">Name</th>
					<th class="head" width="77%">Information</th>
					</tr>';
			do{
				if($even == true)
				{
					echo '<tr class="alt">';
					$even = false;
				}
				else
				{
					echo '<tr>';
					$even = true;
				}
				echo '<td><input type="radio" name="investigation" value="'.$row['invstId'].'"></td>';
				echo "<td>".$row['invstName']."</td><td>".$row['info']."</td>";
			}while($row = mysql_fetch_assoc($rows));
			echo '<input type="text" id="pageNumber" name="pageNumber" hidden="true" value="'.$_GET['page'].'" /></table>';
			echo '<div style="float:right"><a onclick="prevPage()" class="page-left"></a>
				<div id="page-info">Page <strong>'.$_GET['page'].'</strong> / 35 </div>
				<a onclick="nextPage()" class="page-right"></a></div>';
			echo '<input type="button" id="confirm" onclick="confirm()" value="Submit" style="margin-left:45%" class="form-submit" />';
			echo '<script type="text/javascript">
						function nextPage()
						{
							$.ajax({
								url: "AjaxVisit.php",
								data: "action=investigationNames&page='.($_GET['page']+1).'&num='.$_GET['num'].'",
								success: function(data) {
									$("#dialog-form").html(data);
									$("#dialog-form").dialog( "option", "title", "Investigation Names" );
									$("#dialog-form").dialog("open");
								}
							});
						}
						function prevPage()
						{
							$.ajax({
								url: "AjaxVisit.php",
								data: "action=investigationNames&page='.($_GET['page']-1).'&num='.$_GET['num'].'",
								success: function(data) {
									$("#dialog-form").html(data);
									$("#dialog-form").dialog( "option", "title", "Investigation Names" );
									$("#dialog-form").dialog("open");
								}
							});
						}
						function confirm()
						{
							var id = $("input[type=\'radio\']:checked").val();
							var name = $("input[type=\'radio\']:checked").parent().next().html();
							//alert( id + name);
							document.getElementById("investigationId-'.$_GET['num'].'").value=id;
							document.getElementById("investigationName-'.$_GET['num'].'").value=name;
							$("#dialog-form").dialog("close");
						}
					</script>';
			exit(0);
		}
	}
}

?>