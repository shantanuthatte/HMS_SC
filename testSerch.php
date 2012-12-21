<?php require_once('Connections/HMS.php'); ?>
<?php
	mysql_select_db($database_HMS, $HMS);
$query_personRS = "SELECT * FROM person";
$personRS = mysql_query($query_personRS, $HMS) or die(mysql_error());
$row_personRS = mysql_fetch_assoc($personRS);
$totalRows_personRS = mysql_num_rows($personRS);

$array = array();
while( $row_personRS = mysql_fetch_assoc($personRS) )
	{
		$array[]= $row_personRS;	
		
	}			 

?>

<html lang="en"><head>
    <meta charset="utf-8" />
    <title>jQuery UI Autocomplete - Scrollable results</title>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
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
			var availableTags =new Array();
			availableTags.push(
			<?php 
			$i=0;
			$names = array();
			foreach($array as $row )
			{
				$names[$i] = "'".$row['fName']." ".$row['lName']."- ".$row['DOB']."'";
				$i++;
			}
			echo(implode(",", $names));
			echo ");";
		
		?>
		var arrayForStorage =new Array();
			arrayForStorage.push(
			<?php 
			$i=0;
			$names = array();
			foreach($array as $row )
			{
				$names[$i] = "'".$row['personId']."'";
				$i++;
			}
			echo(implode(",", $names));
			echo ");";
		
		?>
		
		
        $( "#tags" ).autocomplete(
		{
			source: availableTags,
			select:function(event, ui) {
				
            alert(ui.item.value);
			var temp=ui.item.value;
			var t = availableTags.indexOf(temp);
			$( "#tags" ).val("check");
			alert(t);
			var firstArrayItem = arrayForStorage[t]
			document.getElementById('stored').value= firstArrayItem;
		
         }

		}
	
        );
		
    });
	
	
    </script>
</head>
<body>
<?php //var_dump($names); ?>
<div class="ui-widget">
    <label for="tags">Tags: </label>
    <input id="tags" />
    <input id="stored" />
</div>
 
 
</body>
</html>