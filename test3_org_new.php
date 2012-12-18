<?php require_once('Connections/HMS.php');
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) 
  {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) 
  {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ?  $theValue  : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}


mysql_select_db($database_HMS,$HMS);
$query_BpVisit = "SELECT v.visitId AS visitId, v.patientId AS patientId, v.visitDate AS visitDate, ex.bpSys AS bpSys, ex.bpDia AS bpDia, ex.pulse as pulse, ex.rr as rr
FROM examination AS ex, visit AS v
WHERE v.visitId = ex.visitId
AND v.patientId=4"; 
$BpVisit = mysql_query($query_BpVisit, $HMS) or die(mysql_error());
$row_visit = mysql_fetch_assoc($BpVisit);
$totalRows_BpVisit = mysql_num_rows($BpVisit);
$array=array();
while ($row_visit = mysql_fetch_assoc($BpVisit)) {
  $array[]= $row_visit;
}

$PulseVisit = mysql_query($query_BpVisit, $HMS) or die(mysql_error());
$row_pulse_visit = mysql_fetch_assoc($PulseVisit);
$totalRows_PulseVisit = mysql_num_rows($PulseVisit);


$RRVisit = mysql_query($query_BpVisit, $HMS) or die(mysql_error());
$row_RRvisit = mysql_fetch_assoc($RRVisit);
$totalRows_RRVisit = mysql_num_rows($RRVisit);


?>
<html>
<head>

     <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
	 
      google.load('visualization', '1.0', {'packages':['corechart']});
      google.setOnLoadCallback(drawChart);
	  
      function drawChart() {

			var dataBp = new google.visualization.DataTable();
			
        dataBp.addColumn('string', 'Date');
        dataBp.addColumn('number', 'BP Sys');
        dataBp.addColumn('number', 'BP Dia');
        
        dataBp.addRows([
		<?php 
			
			foreach($array as $row )
			{
				echo "['".$row['visitDate']."',".$row['bpSys'].",".$row['bpDia']."],";
				
			}
			echo "]);";
		
		?>
        var options = {'title':"Bp Chart",
                       'width':550,
                       'height':350};
				var chartBp = new google.visualization.LineChart(document.getElementById('chart_div'));
                 chartBp.draw(dataBp, options);
	  }
                 
 </script>   
    
   

</head>

  <body>
  <!--Div that will hold the pie chart-->
 
  
   <div id="chart_div"> 
   </div>
   <div>
    My Division
   <?php 
foreach($array as $row )
{
	echo $row['visitId']."<br/>";
	}
	
	foreach($array as $row )
			{
				echo "['".$row['visitDate']."',".$row['bpSys'].",".$row['bpDia']."],"."<br/>";
			}
			
			do{
				echo "['".$row_pulse_visit['visitDate']."',".$row_pulse_visit['bpSys'].",".$row_pulse_visit['bpDia']."],";
				
			} while($row_pulse_visit = mysql_fetch_assoc($PulseVisit));
			echo "]);";
			
   ?>
 
   </div>
</body>
</html>
