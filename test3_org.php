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
AND v.patientId=".$_GET['patientId']; 
$BpVisit = mysql_query($query_BpVisit, $HMS) or die(mysql_error());
$row_visit = mysql_fetch_assoc($BpVisit);
$totalRows_BpVisit = mysql_num_rows($BpVisit);
$rowArray=array();
			while ($row_visit = mysql_fetch_assoc($BpVisit)) 
			{
				$rowArray[]= $row_visit;
			}


?>
<html>
<head>
    <!--Load the AJAX API-->
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
			
			foreach($rowArray as $row )
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
				
					 
				 
		var dataPulse = new google.visualization.DataTable();
        dataPulse.addColumn('string', 'Date');
        dataPulse.addColumn('number', 'Pulse');
        dataPulse.addRows([
		<?php 		
			foreach($rowArray as $row )
			{
				echo "['".$row['visitDate']."',".$row['pulse']."],";
			}
				echo "]);";	
		
		?>
		 var options = {'title':"Pulse Chart",
                       'width':550,
                       'height':350};
        
				var chartPulse = new google.visualization.LineChart(document.getElementById('chart_div1'));
                 chartPulse.draw(dataPulse, options);
				 
				 var dataRR = new google.visualization.DataTable();
        dataRR.addColumn('string', 'Date');
        dataRR.addColumn('number', 'RR');
        dataRR.addRows([
		<?php 
		
		foreach($rowArray as $row )
			{
				echo "['".$row['visitDate']."',".$row['rr']."],";
			}
				echo "]);";	
		
		
		?>
		 var options = {'title':"RR Chart",
                       'width':550,
                       'height':350};
        
				var chartRR = new google.visualization.LineChart(document.getElementById('chart_div2'));
                 chartRR.draw(dataRR, options);
				 
				 
			document.getElementById('chart_div2').style.visibility="hidden";
			document.getElementById('chart_div1').style.visibility="hidden";
			
			document.getElementById('cel2').style.visibility="hidden";
			document.getElementById('cel3').style.visibility="hidden";
			document.getElementById('cel1').style.width=0;
			document.getElementById('cel1').style.height=0;
			
			document.getElementById('cel2').style.width=0;
			document.getElementById('cel2').style.height=0;
			
			document.getElementById('cel3').style.width=0;
			document.getElementById('cel3').style.height=0;
			
			document.getElementById('chart_div1').style.width=0;
			document.getElementById('chart_div1').style.height=0;
			
			document.getElementById('chart_div2').style.width=0;
			document.getElementById('chart_div2').style.height=0;
			  
      }
	  	
    </script>
    
    
   
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" /> 
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css" /> 
    <link href="css/screen.css" rel="stylesheet" type="text/css">
    <script>
    $(function() {
        $( "#radio" ).buttonset();
    });
	function loadGraph()
	{ 
			document.getElementById('chart_div1').style.visibility="hidden";
			document.getElementById('chart_div2').style.visibility="hidden";
			document.getElementById('chart_div').style.visibility="visible";
			
			document.getElementById('chart_div2').style.width=0;
			document.getElementById('chart_div2').style.height=0;
			
			document.getElementById('chart_div1').style.width=0;
			document.getElementById('chart_div1').style.height=0;
			
			document.getElementById('chart_div').style.width=550;
			document.getElementById('chart_div').style.height=350;
			document.getElementById('cel2').style.visibility="hidden";
			document.getElementById('cel3').style.visibility="hidden";
			document.getElementById('cel1').style.visibility="visible";
	}
		function loadGraph1()
	{	
			document.getElementById('chart_div').style.visibility="hidden";
			document.getElementById('chart_div2').style.visibility="hidden";
			document.getElementById('chart_div1').style.visibility="visible";
			
			document.getElementById('chart_div').style.width=0;
			document.getElementById('chart_div').style.height=0;
			
			document.getElementById('chart_div2').style.width=0;
			document.getElementById('chart_div2').style.height=0;
			
			document.getElementById('chart_div1').style.width=550;
			document.getElementById('chart_div1').style.height=350;
			
			document.getElementById('cel1').style.visibility="hidden";
			document.getElementById('cel3').style.visibility="hidden";
			document.getElementById('cel2').style.visibility="visible";
		}
		function loadGraph2()
	{	
			document.getElementById('chart_div').style.visibility="hidden";
			document.getElementById('chart_div1').style.visibility="hidden";
			document.getElementById('chart_div2').style.visibility="visible";
			
			document.getElementById('chart_div').style.width=0;
			document.getElementById('chart_div').style.height=0;
			
			document.getElementById('chart_div1').style.width=0;
			document.getElementById('chart_div1').style.height=0;
			
			document.getElementById('chart_div2').style.width=550;
			document.getElementById('chart_div2').style.height=350;
			
			
			document.getElementById('cel1').style.visibility="hidden";
			document.getElementById('cel2').style.visibility="hidden";
			document.getElementById('cel3').style.visibility="visible";
		}
    </script>
    
</head>
    
  </head>

  <body>
  <!--Div that will hold the pie chart-->
 
  <table width="100%"  height="440" border="1" style=" appearance:dialog"  >
  <tr >
  
  	<th colspan="3" style="border:hidden">
  <form>
    <div id="radio" >
        <input type="radio" id="radio1" name="radio" checked="true"  onClick="loadGraph()"/><label for="radio1"  style="height:40; width:70; font-size:10px ;background-color:#94B52C" onClick="loadGraph()">Bp Chart</label>
        <input type="radio" id="radio2" name="radio" onClick="loadGraph1()"  /><label  for="radio2" style=" height:40; width:90; font-size:10px">Pulse Chart</label>
        <input type="radio" id="radio3" name="radio" onClick="loadGraph2()" /><label for="radio3" style="height:40; width:90; font-size:10px">RR Chart</label>
    </div>

</form>
	</th>
    
    
    </tr>
    
    <tr align="center" >
    <!--<th>
<div >
<img src="images/shared/side_shadowleft.jpg" width="20" height="300" alt="" />
</div>
</th> -->
<th id="cel1" width="0"  style="border:hidden" >

<div id="chart_div">
   </div>
   </th>
   <th id="cel2" width="0" style="border:hidden" >
 
<div id="chart_div1"   > 
     </div></th>
     <th id="cel3" width="0" style="border:hidden" >
      <div id="chart_div2"  ></div>
     </th>
    <!-- <th>
  <div >
      <img src="images/shared/side_shadowright.jpg" width="20" height="300" alt="" />
   </div>
   </th> -->
   </tr>
   </table>
  
</body>
</html>
