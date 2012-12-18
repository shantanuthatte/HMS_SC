<?php require_once('Connections/HMS.php'); ?>

<?php
	mysql_select_db($database_HMS, $HMS);
$query_personRS = "SELECT * FROM person";
$personRS = mysql_query($query_personRS, $HMS) or die(mysql_error());
$row_personRS = mysql_fetch_assoc($personRS);
$totalRows_personRS = mysql_num_rows($personRS);

$query_personRS1 = "SELECT * FROM person where personId=6"; 
$personRS1 = mysql_query($query_personRS, $HMS) or die(mysql_error());
$row_personRS1 = mysql_fetch_assoc($personRS1);
$totalRows_personRS1 = mysql_num_rows($personRS1);	

?>
<?php
function hello()
{
	global $a ;
 	$a = "Hello";
	echo $a;
 }
?>
 <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css" />
    <style>
    .ui-autocomplete {
        max-height: 100px;
        overflow-y: auto;
        /* prevent horizontal scrollbar */
        overflow-x: hidden;
    }
    /* IE 6 doesn't support max-height
     * we use height instead, but this forces the menu to always be this tall
     */
    * html .ui-autocomplete {
        height: 100px;
    }
    </style>

    <script>
    $(function() {
		var availableTags = ["
		<?php do {
			echo $row_personRS['fName'];
		}while($row_personRS = mysql_fetch_assoc($personRS));
			 ?>",
		
		];
		
        var availableTags = [
            "ActionScript",
            "AppleScript",
            "Asp",
            "BASIC",
            "C",
            "C++",
            "Clojure",
            "COBOL",
            "ColdFusion",
            "Erlang",
            "Fortran",
            "Groovy",
            "Haskell",
            "Java",
            "JavaScript",
            "Lisp",
            "Perl",
            "PHP",
            "Python",
            "Ruby",
            "Scala",
            "Scheme"
        ];
        $( "#tags" ).autocomplete({
            source: availableTags
        });
    });
    </script>


<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript">
$(function() {
				
	var height = $(document).height();
    var width = $(document).width();
	var spanHeight = $('.popup').height();
    var spanWidth = 500;
	
	$('.pop-up-link').click(function() { 
		
        $(this).next() 
		.css({ "top" :  height/2 - spanHeight/2 }) // Centre Pop Up
        .css({ "left" : width/2 - spanWidth/2 })	
		.fadeIn(500);
	});
	
    $(".close").click(function () {
    	$('.pop-up-link').next().fadeOut(500);
    });
});



function echoHello()
{
 alert("<?php hello(); ?>");
 }
			function performAction(action) {
				// ASSIGN THE ACTION
				var action = $('#fName').val();
 				alert("My First JavaScript" + action);
				//alert(action);
				var phone="12345678";
				var id="23";
				$.ajax({
  					url: 'testSerch.php?param=xyz&fname='+action,
  					success: function(data) {
    				$('#action1').html(data);
    				
  					}
				});
				
				function MyCheck(action) {
				// ASSIGN THE ACTION
				var action = $('#CheckName').val();
 				alert("My First JavaScript" + action);
				//alert(action);
				var phone="12345678";
				var id="23";
				$.ajax({
  					url: 'testSerch.php?param=checking&fname='+action,
  					success: function(data) {
    				$('#action1').html(data);
					
    				
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
		
		
		
// Project Notes Animation

</script>

<style>
/* notes */

h3 { margin:0; }
.popup {
	position: absolute;
	padding: 5px;
	background: #CCC;
	border: #666 1px solid;
	display: none;
	width: 500px;
	margin: 0 auto;
	min-height: 200px;
	
	height: 400px;
}
.close { float: right; position: relative; z-index: 99999; margin: 3px 6px 0; }
.pop-info {
	clear: both;
	overflow: scroll;
	height: 200px;
	width: 500px;
	padding-right: 2px;
	padding-bottom: 15px;
	padding-left: 2px;
	position: absolute;
	top: 170px;
}
.pop-heading { background: #7F7777; color: #FFF; overflow: hidden; padding: 0.5em; position: absolute; width: 487px; }
</style>

        
  




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<form id="adminform" action="" method="GET">
<body>
<table>
<td>
<input name="fName" id="fName" type="text" />
</td>
<td>
<input name="b1" type="button" onClick="performAction()" value="Testing ajax" />
</td>
<td>
</td></table>
<div id="action1">
</div>
















<!--<div class='popup'> <a href='#' title="Close" class='close'><img src='close.png' alt='close' height="20" width="20" /></a>
   <div class="pop-heading">

  <h3>List Show Up</h3>
      <table align="center">
    	<tr valign="baseline">
     		<td> First Name: <input  type="text" name="fName" size="32" /></td>    
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
                    <td width="300" align="center">Name</td>
                    <td width="300" align="center">mobile</td>             
                    <td width="300" align="center">DOB</td> </tr></table> 
    </div>
    <div class="pop-info">
      <p><table align="center">
   
      
               <?php while ($row_personRS = mysql_fetch_assoc($personRS))
				{ ?>
				<tr>
                  <td width="300" align="center"><?php echo $row_personRS['fName']; ?></td>
                  <td width="300" align="center"><?php echo $row_personRS['mobile']; ?></td>
                  <td width="300" align="center"><?php echo $row_personRS['DOB']; ?></td>
			    </tr>
                <?php } ?> 
            </table>
        </tr>
    </table>
   
</p>
</div>


<p><a class="pop-up-link" href="#" title="View Pop Up">
  
</a></p> -->
<div class="ui-widget">
    <label for="tags">Tags: </label>
    <input id="tags" />
</div>
</body>
</form>
</html>
