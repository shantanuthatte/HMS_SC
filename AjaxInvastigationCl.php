<?php require_once('Connections/HMS.php'); ?>
<?php 
$temp = $_GET['name'];
$rows = $_GET['rows'];
$page = $_GET['page'];
$name = $temp.'%';
mysql_select_db($database_HMS, $HMS);
$total_rows  = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM investigationcl c , investigationgr g where c.grId = g.groupId AND (c.className LIKE '".$name."' OR g.groupName LIKE '".$name."')"),0);

// Getting the total number of pages. Always round up using ceil() 
$total_pages = ceil($total_rows / $rows);

$prev = $page-1; //previous page
$next = $page+1; //next page

/* Figure out the limit for the query based
 on the current page number.*/
$from = (($page * $rows) - $rows);
mysql_select_db($database_HMS, $HMS);
$query_invstcl = "SELECT c.grId, c.className,c.classId,g.groupName
 FROM investigationcl c , investigationgr g 
WHERE c.grId = g.groupId AND (g.groupName  LIKE '".$name."'
OR c.className LIKE'".$name."') LIMIT $from,$rows";
$invstcl = mysql_query($query_invstcl, $HMS) or die(mysql_error());
$row_invstcl = mysql_fetch_assoc($invstcl);
$total_rows  = mysql_num_rows($invstcl);

echo '
<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
  <tr>    
     <th class="table-header-repeat line-left"><a href="">Group Name</a></th>
    <th class="table-header-repeat line-left"><a href="">Class Name</a></th>
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
		
		 echo '<td>'.$row_invstcl['groupName'].'</td>';
		 echo '<td>'.$row_invstcl['className'].'</td>';
		 
      	 echo '<td class="options-width">
		 	
			<a title="Edit" onclick="update_submit('.$row_invstcl['classId'].')" class="icon-1 info-tooltip"></a>
			<a title="Delete" onclick="delete_confirm('.$row_invstcl['classId'].')" class="icon-2 info-tooltip"></a>
      </td>
    </tr>';
    } while ($row_invstcl = mysql_fetch_assoc($invstcl));
	
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