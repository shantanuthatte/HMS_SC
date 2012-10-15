<?php require_once('Connections/HMS.php'); ?>
<?php
include 'header.php';
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
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
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$maxRows_Users = 10;
$pageNum_Users = 0;
if (isset($_GET['pageNum_Users'])) {
  $pageNum_Users = $_GET['pageNum_Users'];
}
$startRow_Users = $pageNum_Users * $maxRows_Users;

mysql_select_db($database_HMS, $HMS);
$query_Users = "SELECT * FROM users";
$query_limit_Users = sprintf("%s LIMIT %d, %d", $query_Users, $startRow_Users, $maxRows_Users);
$Users = mysql_query($query_limit_Users, $HMS) or die(mysql_error());
$row_Users = mysql_fetch_assoc($Users);

if (isset($_GET['totalRows_Users'])) {
  $totalRows_Users = $_GET['totalRows_Users'];
} else {
  $all_Users = mysql_query($query_Users);
  $totalRows_Users = mysql_num_rows($all_Users);
}
$totalPages_Users = ceil($totalRows_Users/$maxRows_Users)-1;
?>
<div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading"><h1>View Users</h1></div>

<!-- start content table -->
<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
<tr>
	<th rowspan="3" class="sized"><img src="images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
	<th class="topleft"></th>
	<td id="tbl-border-top">&nbsp;</td>
	<th class="topright"></th>
	<th rowspan="3" class="sized"><img src="images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
</tr>
<tr>
	<td id="tbl-border-left"></td>
	<td>
	<!--  start content-table-inner -->
	<div id="content-table-inner">
	
    <!--  start table-content  -->
    <div id="table-content">

<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
  <tr>
    <th class="table-header-repeat line-left"><a href="">userId</a></th>
    <th class="table-header-repeat line-left"><a href="">userName</a></th>
    <th class="table-header-repeat line-left"><a href="">password</a></th>
    <th class="table-header-repeat line-left"><a href="">type</a></th>
    <th class="table-header-repeat line-left"><a href="">recoveryEmail</a></th>
    <th class="table-header-repeat line-left"><a href="">permission</a></th>
    <th class="table-header-repeat line-left"><a href="">personId</a></th>
  </tr>
  <?php 
  $even=1;
  do {
    if($even == 1)
	{
		echo '<tr>';
		$even=0;
	}
	else
	{
		echo '<tr class="alternate-row">';
		$even=1;
	} 
  ?>    
      <td><?php echo $row_Users['userId']; ?></td>
      <td><?php echo $row_Users['userName']; ?></td>
      <td><?php echo $row_Users['password']; ?></td>
      <td><?php echo $row_Users['type']; ?></td>
      <td><?php echo $row_Users['recoveryEmail']; ?></td>
      <td><?php echo $row_Users['permission']; ?></td>
      <td><?php echo $row_Users['personId']; ?></td>
    </tr>
    <?php } while ($row_Users = mysql_fetch_assoc($Users)); ?>
</table>
</div>
<!-- end table content -->    
    </div>
<!--  end content-table-inner  -->
</td>
<td id="tbl-border-right"></td>
</tr>
<tr>
	<th class="sized bottomleft"></th>
	<td id="tbl-border-bottom">&nbsp;</td>
	<th class="sized bottomright"></th>
</tr>
</table>
</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer........................................................END -->

<div class="clear">&nbsp;</div>
    
<!-- start footer -->         
<div id="footer">
	<!--  start footer-left -->
	<div id="footer-left">
	
	Admin Skin &copy; Copyright Internet Dreams Ltd. <span id="spanYear"></span> <a href="">www.netdreams.co.uk</a>. All rights reserved.</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
</body>
</html>
<?php
mysql_free_result($Users);
?>
