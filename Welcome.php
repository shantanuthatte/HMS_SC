<?php
include('header.php');
//include('sidebar.php');
include('stepholder.php');
//include('scripts.php');
?>


<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript">

			function performAction() 
			{
				// ASSIGN THE ACTION
				var action = $('#fName').val();				
 				//alert("My First JavaScript");
				alert(action);
				
				$.ajax({
  					url: 'Search.php?param=xyz&fname='+action,
  					success: function(data) {
    				$('#action1').html(data);    				
  					}
				});								
			}
		</script>

 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading"><h1>Select Patient</h1></div>

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
    
	<table align="center">
    	<tr valign="baseline">
     		<td> First Name: <input id="fName" type="text" name="fName" size="32" /></td>    
	 		<td> Middle Name:<input type="text" name="mName" value="" size="32" /></td>    
     		<td> Last Name:<input type="text" name="lName" value="" size="32" /></td>
    	</tr>        
        <tr>
        	<td>
            <input type="button" onClick="performAction();" value="Search" />
            <input type="hidden" id="action" name="action"  value="" />
            </td>            
        </tr>
    <tr>
   	<!-- new row start -->
		<!-- start patient table -->
	
 	
	<tr>
	<td><img src="images/shared/blank.gif" width="695" height="1" alt="blank" /></td>
	<td></td>
	</tr>
	</table>
    <div id="action1">
    
    </div>
	<div class="clear"></div> 
	<!-- new row end -->
    </tr>
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









 





