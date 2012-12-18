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
$query_BpVisit = "SELECT v.visitId AS visitId, v.patientId AS patientId, v.visitDate AS visitDate, ex.bpSys AS bpSys, ex.bpDia AS bpDia 
FROM examination AS ex, visit AS v
WHERE v.visitId = ex.visitId
AND v.patientId=4" ;

$BpVisit = mysql_query($query_BpVisit, $HMS) or die(mysql_error());
$row_visit = mysql_fetch_assoc($BpVisit);
$totalRows_BpVisit = mysql_num_rows($BpVisit);

?>

    <!--Load the AJAX API-->
	<script type='text/javascript' src='https://www.google.com/jsapi'></script>

    <script type='text/javascript'>
      google.load('visualization', '1.0', {'packages':['corechart']});
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Date');
        data.addColumn('number', 'BP Sys');
        data.addColumn('number', 'BP Dia');
        //data.addRows(["
				 
		<?php do{
			echo "data.addRow(['{$row_visit['v.visitDate']}', {$row_visit['ex.bpSys']},{$row_visit['ex.bpDia']}]);";
				//echo "['".GetSQLValueString($row_visit['v.visitDate'],date)."',".GetSQLValueString($row_visit['ex.bpSys'],int).",".GetSQLValueString($row_visit['ex.bpDia'],int)."],";
			} while($row_visit = mysql_fetch_assoc($BpVisit));
			//echo "]);"
			?>

 var options = {'title':'Trend in BP Sys / Dia',
                       'width':400,
                       'height':300};
	 
        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
	  }
</script>

<body >
<div></div>
<div id='chart_div'></div>
</body>