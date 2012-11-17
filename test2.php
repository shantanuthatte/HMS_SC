<?php
include('phpgraphlib_v2.31/phpgraphlib.php');
$graph = new PHPGraphLib(650,200);


require_once('Connections/HMS.php');
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
$query_BpVisit = "SELECT v.visitId, v.patientId , v.visitDate as vd,ex.bpSys as bp, ex.bpDia
FROM examination ex, visit v
WHERE v.visitId = ex.visitId
AND v.patientId= 6";
$BpVisit = mysql_query($query_BpVisit, $HMS) or die(mysql_error());
$row_visit = mysql_fetch_assoc($BpVisit);
$totalRows_BpVisit = mysql_num_rows($BpVisit);

$i = -1;
do{
	 $t1 =(GetSQLValueString($row_visit['vd'],"text"));
	 $t2 =(GetSQLValueString($row_visit['bp'],"int"));
	 $data=array($t1=>$t2);
	$graph->addData($data);
$graph->setTitle('Bpsys Per Visit');
$graph->setBars(false);
$graph->setLine(true);
$graph->setDataPoints(true);
$graph->setDataPointColor('maroon');
$graph->setDataValues(true);
$graph->setDataValueColor('maroon');
$graph->setGoalLine(90);
$graph->setGoalLineColor('red');
$graph->createGraph();
	
	
//GetSQLValueString($row_visit['bp'],"int"));
  

    } while ($row_visit = mysql_fetch_assoc($BpVisit));

//var_dump($data);
/*

*/
/*

include('phpgraphlib_v2.31/phpgraphlib.php');
$graph = new PHPGraphLib(650,200);
$data = array("1" => .0032, "2" => .0028, "3" => .0021, "4" => .0033,
"5" => .0034, "6" => .0031, "7" => .0036, "8" => .0027, "9" => .0024,
"10" => .0021, "11" => .0026, "12" => .0024, "13" => .0036,
"14" => .0028, "15" => .0025);
$graph->addData($data);
$graph->setTitle('PPM Per Container');
$graph->setBars(false);
$graph->setLine(true);
$graph->setDataPoints(true);
$graph->setDataPointColor('maroon');
$graph->setDataValues(true);
$graph->setDataValueColor('maroon');
$graph->setGoalLine(.0025);
$graph->setGoalLineColor('red');
$graph->createGraph();*/
?>
