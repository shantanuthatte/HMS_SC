<?php require_once('Connections/HMS.php'); ?>
<?php
include 'header.php';
?>
<script type="text/javascript">

		var intervalSpan = 800;
		$(document).ready(function(e) {
            implementSearch();
        });
		
		function display_visit(Id)
	   	{
			document.getElementById("userId_visit").value=Id;
			document.forms["visit_form"].submit();			
		}
        function populate(event) 
		{
			var name = $("#key").val();
			
			if(name == "Search")
				name="";
			var rows = this.options[this.selectedIndex].text;
			$("#fill").animate({height:'toggle'},intervalSpan).empty();
			$.ajax({
				url:"AjaxPatients.php",
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
				url:"AjaxPatients.php",
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
				url:"AjaxPatients.php",
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

<div id="page-heading"><h1>Patients</h1></div>
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

<form id="visit_form" action="ViewVisits.php" method="post">
<input id="userId_visit" name="userId" value="" type="hidden" />
</form>
<div id="fill">
</div>

			

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
	Medical Soft &copy; Copyright Sharad Consultants <span id="spanYear"></span> <a href="">www.sharadconsultants.com</a>. All rights reserved.</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
 
</body>
</html>
