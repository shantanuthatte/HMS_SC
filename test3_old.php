<?php require_once('Connections/HMS.php');


mysql_select_db($database_HMS,$HMS);
$query_BpVisit = "SELECT v.visitId AS visitId, v.patientId AS patientId, v.visitDate AS visitDate, ex.bpSys AS bpSys, ex.bpDia AS bpDia 
FROM examination AS ex, visit AS v
WHERE v.visitId = ex.visitId
AND v.patientId=4". $_GET['patientId']; 
//echo($_GET['patientId']);
$BpVisit = mysql_query($query_BpVisit, $HMS) or die(mysql_error());
$row_visit = mysql_fetch_assoc($BpVisit);
$totalRows_BpVisit = mysql_num_rows($BpVisit);
?>
<html>
  <head>
  
    
  
  
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
     google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
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
        data.addRows([
		<?php 
		do{
				echo "['".$row_visit['visitDate']."',".$row_visit['bpSys'].",".$row_visit['bpDia']."],";
			} while($row_visit = mysql_fetch_assoc($BpVisit));
			echo "]);";
		?>

        // Set chart options
        var options = {'title':'Trend in BP Sys / Dia',
                       'width':400,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.LineChart(document.getElementById('chart_div');
    chart.draw(data, options);
	
	
	/*var divToPrint = document.getElementById('chart_div');
	
	return divToPrint ;*/
	
//$(".chart_div").load("ViewVisits.dialog-form.php");
	      }
    </script>
  </head>

  <body>
    <!--Div that will hold the pie chart-->
    
    <div id="chart_div" ></div>

    
  </body>
</html>