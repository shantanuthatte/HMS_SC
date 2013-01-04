<?php 
require_once('Connections/HMS.php');

			$temp = $_GET['name'];
			$name = $temp.'%';
			
			if(!isset($_GET['rows'])){
				$rows = 10;
			} else {
				$rows = $_GET['rows'];
			}		
			
			$totalCnt = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM person where type=1 AND fName LIKE '".$name."' OR lName LIKE '".$name."'"),0);
			// Getting the total number of pages. Always round up using ceil() 
		$total_pages = ceil($totalCnt / $rows);
			
			
			if(($_GET['page'] > 0) && ($_GET['page'] < $total_pages))
				$from = (($_GET['page']*10)-10);
			else
				$from = 0;
				

			$query = "SELECT medicineId,medicineNm, indications, pregnancy, breastfeeding, paediatrics, over60 FROM `medicine` ORDER BY medicineNm LIMIT $from, 10;";
			$rows = mysql_query($query, $HMS) or die(mysql_error());
			$row = mysql_fetch_assoc($rows);
			$totalRows = mysql_num_rows($rows);
			echo '<table border="1" cellspacing="50" cellpadding="10" bordercolor="#D6D6D6" class="ui-widget" id="users-contain">
					<tr>
					<th class="head" width="3%">Select</th>
					<th class="head" width="20%">Name</th>
					<th class="head" width="37%">indications</th>
					<th class="head" width="10%">pregnancy</th>
					<th class="head" width="10%">breastfeeding</th>
					<th class="head" width="10%">paediatrics</th>
					<th class="head" width="10%">over60</th>
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
				echo '<td><input type="radio" name="medicine" value="'.$row['medicineId'].'"></td>';
				echo "<td>".$row['medicineNm']."</td><td>".$row['indications']."</td>";
				echo "<td>".$row['pregnancy']."</td><td>".$row['breastfeeding']."</td>";
				echo "<td>".$row['paediatrics']."</td><td>".$row['over60']."</td>";
			}while($row = mysql_fetch_assoc($rows));
			echo '<input type="text" id="pageNumber" name="pageNumber" hidden="true" value="'.$_GET['page'].'" /></table>';
			echo '<div style="float:right"><a onclick="prevPage()" class="page-left"></a>
				<div id="page-info">Page <strong>'.$_GET['page'].'</strong> /'  .$total_pages. '</div>
				<a onclick="nextPage()" class="page-right"></a></div>';
			echo '<input type="button" id="confirm" onclick="confirm()" value="Submit" style="margin-left:45%" class="form-submit" />';
			echo '<script type="text/javascript">
						function nextPage()
						{
							$.ajax({
								url: "AjaxVisit.php",
								data: "action=medicineNames&page='.($_GET['page']+1).'&num='.$_GET['num'].'",
								success: function(data) {
									$("#dialog-form").html(data);
									$("#dialog-form").dialog( "option", "title", "Medicine Names" );
									$("#dialog-form").dialog("open");
								}
							});
						}
						function prevPage()
						{
							$.ajax({
								url: "AjaxVisit.php",
								data: "action=medicineNames&page='.($_GET['page']-1).'&num='.$_GET['num'].'",
								success: function(data) {
									$("#dialog-form").html(data);
									$("#dialog-form").dialog( "option", "title", "Medicine Names" );
									$("#dialog-form").dialog("open");
								}
							});
						}
						function confirm()
						{
							var id = $("input[type=\'radio\']:checked").val();
							var name = $("input[type=\'radio\']:checked").parent().next().html();
							//alert( id + name);
							document.getElementById("medicineId-'.$_GET['num'].'").value=id;
							document.getElementById("medicine-'.$_GET['num'].'").value=name;
							$("#dialog-form").dialog("close");
						}
					</script>';
			exit(0);
		


?>