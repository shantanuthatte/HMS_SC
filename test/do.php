<?php
require_once('../Connections/HMS.php');
mysql_select_db($database_HMS, $HMS);
if(isset($_GET['param']))
	if($_GET['param'] == "xyz")
	{
		
	
	$query_personRS = "SELECT * FROM person WHERE fName LIKE '".mysql_real_escape_string($_GET['fname'])."'";
	$personRS = mysql_query($query_personRS, $HMS) or die(mysql_error());
	$row_personRS = mysql_fetch_assoc($personRS);
	$totalRows_personRS = mysql_num_rows($personRS);
	
	echo $query_personRS; ?>
	<table border="1">
                <tr>               
                    <td>Name</td>
                    <td>mobile</td>             
                    <td>DOB</td>                
               </tr>
               <?php 
				do{ ?>
				<tr>
                  <td><?php echo $row_personRS['fName']; ?></td>
                  <td><?php echo $row_personRS['mobile']; ?></td>
                  <td><?php echo $row_personRS['DOB']; ?></td>
			    </tr>
                <?php }while ($row_personRS = mysql_fetch_assoc($personRS)); ?> 
            </table>
	<?php
    }
	else
	{
		echo "Error, XYZ";	
	}
?>