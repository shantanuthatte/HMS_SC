<?php require_once('Connections/HMS.php'); ?>
<?php

mysql_select_db($database_HMS, $HMS);
if(isset($_GET['visitId']))
		{
			$even = false;
			$query = "SELECT * FROM prescription WHERE visitId = '".$_GET['visitId']."';";
			$rows = mysql_query($query, $HMS) or die(mysql_error());
			$row = mysql_fetch_assoc($rows);
			$totalRows = mysql_num_rows($rows);
		}
		
		
		$query_visits = 
"SELECT V.visitId AS visitId, V.visitNo AS visitNo, V.visitDate AS visitDate, 
C.userName AS consultingName, 
R.userName AS referringName,
p.fName as fName , p.mName as mName, p.lName as lName
FROM person p ,visit AS V
LEFT JOIN users AS C ON C.userId = V.consultingDoctorId
LEFT JOIN users AS R ON R.userId = V.referringDoctorId
WHERE  p.personId=V.patientId  AND v.visitId='".$_GET['visitId']."';";
$visits = mysql_query($query_visits, $HMS) or die(mysql_error());
$row_visits = mysql_fetch_assoc($visits);
$totalRows_visits = mysql_num_rows($visits);



$query_Doctor = 
"SELECT V.visitId AS visitId, 
C.userName AS consultingName, 
R.userName AS referringName,
p.fName as fName, p.mName as mName, p.lName as lName, 
p.address1 as address,p.city as city ,p.pin as pin,p.rPhone as rPh,p.mobile as mob,p.email as email
FROM person p ,visit AS V
LEFT JOIN users AS C ON C.userId = V.consultingDoctorId
LEFT JOIN users AS R ON R.userId = V.referringDoctorId
WHERE  p.personId=V.consultingDoctorId AND visitId =
'".$_GET['visitId']."';";
$Doctor = mysql_query($query_Doctor, $HMS) or die(mysql_error());
$row_Doctor = mysql_fetch_assoc($Doctor);
$totalRows_Doctor = mysql_num_rows($Doctor);

?>




 <script type="text/javascript">     
        function PrintDiv() {    
           var divToPrint = document.getElementById('printDiv');
           var popupWin = window.open('', '_blank', 'width=300,height=300');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
     </script>
     
     
     
     

    <div class="clear"></div>
 
<!-- start content-outer -->




<div id="printDiv">
<div>
<span style="float:right; margin-right:50px; margin-top:00" ><h2 align="right">Dr. <?php echo $row_Doctor['fName']."".$row_Doctor['mName']."".$row_Doctor['lName'].""; ?> </h2>
<h5 ><?php echo $row_Doctor['address'] ?> <br> <?php echo $row_Doctor['city']." ".$row_Doctor['pin'] ?> 
<hr>

mob no: <?php echo $row_Doctor['mob'] ?><br>
Ph no :<?php echo $row_Doctor['rPh'] ?><br>
Email: <?php echo $row_Doctor['email'] ?>
</h5 >
</span>
</div>


<span style="alignment-adjust:hanging ; margin-left:10; margin-top:230; ">
<h4>&nbsp;</h4>
</span>
<div align="left" style="margin-top:110 ;"><span style="alignment-adjust:hanging ; ">
<h4>Date : <?php echo $row_visits['visitDate']; ?><br>
  Patient Name: <?php echo $row_visits['fName']." ".$row_visits['mName']."". $row_visits['lName']; ?></h4>
</span>
  <hr>
  <?php

			echo '<table  cellspacing="50" cellpadding="10"    width="100%">
					<tr>					
					<th align="left" >Medicine</th>
					<th align="left">Dosage</th>
					<th align="left">Duration</th>					
					</tr>';
			do{
				if($even == true)
				{
					echo '<tr class="alt" >';
					$even = false;
				}
				else
				{
					echo '<tr >';
					$even = true;
				}				
				echo "<td >".$row['medicineName']."</td><td>".$row['dosage']."</td>";
				echo "<td>".$row['duration']."</td></tr>";

			}while($row = mysql_fetch_assoc($rows));
			echo '</table>';
			
		
		?>
        <hr>
       <div class="clear">&nbsp;</div>
       <div class="clear">&nbsp;</div>
       <div class="clear">&nbsp;</div> 
  <span style="float:right; margin-right:100px; ">
    <h4>Signature:</h4>
       </span>
      </div>
        <div class="clear"></div>
  </div>
  </div>
  </div>
 <div class="clear"></div>
  <div id="BPrintDiv" align = "left" >
  
 <span   > <input type="button" value="Print" class="form-submit" onclick="PrintDiv();"/></span>

</div>
  <p>&nbsp;</p>
  
</body>
</html>