<?php require_once('Connections/HMS.php'); ?>
<?php 
$temp = $_GET['name'];
$rows = $_GET['rows'];
$page = $_GET['page'];
$name = $temp.'%';
mysql_select_db($database_HMS, $HMS);
$total_rows = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM person where type=1 AND fName LIKE '".$name."' OR lName LIKE '".$name."'"),0);

// Getting the total number of pages. Always round up using ceil() 
$total_pages = ceil($total_rows / $rows);

$prev = $page-1; //previous page
$next = $page+1; //next page

/* Figure out the limit for the query based
 on the current page number.*/
$from = (($page * $rows) - $rows);
   $type=1; 
mysql_select_db($database_HMS, $HMS);
$query_personRS = "SELECT person.personId as personId, person.fName AS fName, person.mName AS mName, person.lName AS lName, person.address1 AS address1, person.rPhone AS rPhone, person.mobile AS mobile, person.email AS email, users.userId AS userId FROM users INNER JOIN person ON person.personId = users.personId AND person.type = users.type AND users.type = 1 WHERE fName LIKE '".$name."' OR lName LIKE '".$name."' LIMIT $from,$rows";
$personRS = mysql_query($query_personRS, $HMS) or die(mysql_error());
$row_personRS = mysql_fetch_assoc($personRS);
$totalRows_personRS = mysql_num_rows($personRS);

echo '
<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
  <tr>    
    <th class="table-header-repeat line-left"><a href="">Name</a></th>
    <th class="table-header-repeat line-left"><a href="">Address</a></th>
    <th class="table-header-repeat line-left"><a href="">Phone</a></th>
    <th class="table-header-repeat line-left"><a href="">Mobile</a></th>
    <th class="table-header-repeat line-left"><a href="">Email</a></th>
    <th class="table-header-repeat line-left"><a href="">Options</a></th>
  </tr>';
  
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
		 echo '<td>'.$row_personRS['fName'].'&nbsp'.$row_personRS['mName'].'&nbsp'.$row_personRS['lName'].'</td>';
		 echo '<td>'.$row_personRS['address1'].'</td>';
		 echo '<td>'.$row_personRS['rPhone'].'</td>';
		 echo '<td>'.$row_personRS['mobile'].'</td>';
      	 echo '<td>'.$row_personRS['email'].'</td>';
      	 echo '<td class="options-width">
            <a title="View Visits" onclick="display_visit('.$row_personRS['userId'].')" class="icon-7 info-tooltip"></a>
      </td>
    </tr>';
    } while ($row_personRS = mysql_fetch_assoc($personRS));
	
	echo '</table>
	
	</div>
<!-- end table content -->    

<!--  start paging..................................................... -->

			<table border="0" cellpadding="0" cellspacing="0" id="paging-table">
			<tr>
            <td>Rows  </td>
			<td>
			<select name="rows" id="rows" onchange="populate.call(this, event)">
				<option '; if($rows == 10) echo "SELECTED"; echo 'value="10">10</option>
				<option '; if($rows == 20) echo "SELECTED"; echo 'value="20">20</option>
				<option '; if($rows == 30) echo "SELECTED"; echo 'value="30">30</option>
			</select>
			</td>';
			echo '<td>
				<a onclick="setPage(1)" class="page-far-left"></a>
				<a onclick="setPage('; if($prev>0) echo $prev; else echo 1; echo ')" class="page-left"></a>
				<div id="page-info">Page <strong>'.$page.'</strong> / '.$total_pages.'</div>
				<a onclick="setPage('; if($next>1) echo $next; else echo 1; echo ')" class="page-right"></a>
				<a onclick="setPage('; if($total_pages>1) echo $total_pages; else echo 1; echo ')" class="page-far-right"></a>
			</td>
			</tr>
			</table>
<!--  end paging................ -->
			';
?>