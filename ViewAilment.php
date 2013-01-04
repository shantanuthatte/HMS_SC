<?php require_once('Connections/HMS.php'); ?>
<?php
include 'header.php';

// Getting current page number,if not assign page number as 1 
if(!isset($_GET['page'])){
    $page = 1;
} else {
    $page = $_GET['page'];
 }
 
// Define the number of rows per page 
if(!isset($_GET['rows'])){
	$rows = 10;
} else {
	$rows = $_GET['rows'];
}

mysql_select_db($database_HMS, $HMS);
$total_rows = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ailment"),0);

// Getting the total number of pages. Always round up using ceil() 
$total_pages = ceil($total_rows / $rows);

$prev = $page-1; //previous page
$next = $page+1; //next page

/* Figure out the limit for the query based
 on the current page number.*/
$from = (($page * $rows) - $rows);
    
mysql_select_db($database_HMS, $HMS);
$query_ailment = "SELECT * FROM ailment LIMIT $from,$rows";
$ailment = mysql_query($query_ailment, $HMS) or die(mysql_error());
$row_ailment = mysql_fetch_assoc($ailment);
$totalRows_personRS = mysql_num_rows($ailment);

echo '<script type="text/javascript">
       function delete_confirm(ailmentId)
       {
           if(confirm("Are you sure you want to delete this ailment?")==true)
           {
				document.getElementById("ailmentId_delete").value=ailmentId;
				document.forms["delete_form"].submit();
		   }
       }
	   function update_submit(ailmentId)
	   {
		  	document.getElementById("ailmentId_update").value=ailmentId;
			document.forms["update_form"].submit();  
	   }
	  
		
   </script>';  

?>


<script type="text/javascript">

		var intervalSpan = 800;
		$(document).ready(function(e) {
            
			implementSearch();
			
        });
		 function populate(event) 
		{
			var name = $("#key").val();
			if(name == "Search")
				name="";
			var rows = this.options[this.selectedIndex].text;
			$("#fill").animate({height:'toggle'},intervalSpan).empty();
			$.ajax({
				url:"AjaxAilment.php",
				data:"name="+name+"&rows="+rows+"&page=1",
				success: function(data){
					$("#fill").append(data);
				}
			});
			$("#fill").animate({height:'toggle'},intervalSpan);
    	}
		
		function setPage(page)
		{
			var name = $("#key").val();
			if(name == "Search")
				name="";
			var rows = $("#rows").val();
			$("#fill").animate({height:'toggle'},intervalSpan).empty();
			$.ajax({
				url:"AjaxAilment.php",
				data:"name="+name+"&rows="+rows+"&page="+page,
				success: function(data){
					$("#fill").append(data);
				}
			});
			$("#fill").animate({height:'toggle'},intervalSpan);
		}
		function implementSearch()
		{
			
			var name = $("#key").val();
			if(name == "Search")
				name="";
			var rows = $("#rows").val();
			$("#fill").animate({height:'toggle'},intervalSpan).empty();
			$.ajax({
				url:"AjaxAilment.php",
				data:"name="+name+"&rows=10&page=1",
				success: function(data){
					$("#fill").append(data);
				}
			});
			$("#fill").animate({height:'toggle'},intervalSpan);
		}
		
</script>

<div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading"><h1>Ailment</h1></div>
<div style="float:right; margin-right:50px;"><a href="AddAilment.php"><img src="images/add.png" /></a></div>
<div style="float:right;"><a href="AddAilment.php"><h3>  Add New</h3></a></div>

<!-- start content table -->
<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">

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

<form id="delete_form" action="cntrl_Ailment.php" method="post">
<input id="ailmentId_delete" name="ailmentId" value="" type="hidden" />
<input id="formAction" name="formAction" value="delete" type="hidden" />
</form>

<form id="update_form" action="cntrl_Ailment.php" method="post">
<input id="ailmentId_update" name="ailmentId" value="" type="hidden" />
<input id="formAction" name="formAction" value="update" type="hidden" />
</form>
<div id="fill">
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
	Medical Soft &copy; Copyright Sharad Consultants <span id="spanYear"></span> <a href="">www.sharadconsultants.com</a>. All rights reserved.</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer --> 
</body>
</html>
<?php
mysql_free_result($ailment);
?>