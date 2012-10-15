<?php require_once('Connections/HMS.php'); ?>

<?php
	mysql_select_db($database_HMS, $HMS);
$query_personRS = "SELECT * FROM person";
$personRS = mysql_query($query_personRS, $HMS) or die(mysql_error());
$row_personRS = mysql_fetch_assoc($personRS);
$totalRows_personRS = mysql_num_rows($personRS);
	

?>
<?php
function hello()
{
	global $a ;
 	$a = "Hello";
	echo $a;
 }
?>
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript">

function echoHello()
{
 alert("<?php hello(); ?>");
 }
			function performAction(action) {
				// ASSIGN THE ACTION
				var action = $('#fName').val();
 				//alert("My First JavaScript");
				//alert(action);
				var phone="12345678";
				var id="23";
				$.ajax({
  					url: 'test/do.php?param=xyz&fname='+action,
  					success: function(data) {
    				$('#action1').html(data);
    				//alert('Load was performed.');
  					}
				});
				
				/*$("#action").load("prenos.php?number="+phone+"&id="+id,function() {
        var reciverParameters = $("#action").html();
        var parser = new Array();
        parser = reciverParameters.split(",");
        alert(parser);
                });*/
				
				// UPDATE THE HIDDEN FIELD
				//document.getElementById("action").value = action;
 				//alert("<?php hello(); ?>");
				// SUBMIT THE FORM
				//document.adminform.submit();
			}
		</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<form id="adminform" action="" method="GET">
<body>
	<table align="center">
    	<tr valign="baseline">
     		<td> First Name: <input id="fName" type="text" name="fName" size="32" /></td>    
	 		<td> Middle Name:<input type="text" name="mName" value="" size="32" /></td>    
     		<td> Last Name:<input type="text" name="lName" value="" size="32" /></td>
    	</tr>        
        <tr>
        	<td>
            <input type="button" onClick="performAction('showValue');" value="Search" />
            <input type="hidden" id="action" name="action"  value="" />
            </td>            
        </tr>
         <tr>
        	<td>
            <input type="button" onClick="echoHello();" value="Say Hello" />           
            </td>            
        </tr>
        <tr>       
            <table border="1">
                <tr>               
                    <td>Name</td>
                    <td>mobile</td>             
                    <td>DOB</td>                
               </tr>
               <?php while ($row_personRS = mysql_fetch_assoc($personRS))
				{ ?>
				<tr>
                  <td><?php echo $row_personRS['fName']; ?></td>
                  <td><?php echo $row_personRS['mobile']; ?></td>
                  <td><?php echo $row_personRS['DOB']; ?></td>
			    </tr>
                <?php } ?> 
            </table>
        </tr>
    </table>
    <div id="action1">
    Test
    </div>
    <script>
	/*$("#fName").bind('input', function() {
                    performAction('test');
					//alert(e);
                });
	</script>*/
</body>
</form>
</html>
