<?php require_once('Connections/HMS.php'); ?>


<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
function jqsub() {
//alert("hi1");
/*if ($("#city").val() == '')
    {
      alert("Please select anyone");
    }
*/



var id = $('#comments').val();
var e = $('#email').val();
var city = $('#email').val();

//alert(id);
$.ajax({
		url: "AjaxProcedure.php",
		data: "action=procedure&comments="+id+"&email="+e+"city="+city,
		success: function(data) {
		alert(data);
			$('#comments').val(data);
			
			
		}
	});
	
	alert("2- end");
	}
</script>




<form  method="post" name="form1" id="form1">
  <div id="page-heading"><h1>Procedure Details</h1></div>

  
    <table border="0" cellpadding="5" cellspacing="5"  id="id-form">
 
    <tr>
      <th>Procedure Name*:</th>
      <td>
      <input type="text" id="procedureName" name="procedureName" size="32" class="inp-form-error" value=""/></td>
      
    </tr>
     <tr>
      <th>Comments:</th>
      <td>
      <input type="text" id="comments" name="comments" value="" size="32" class="inp-form"/>
      </td>
    </tr> 
    <tr>
      <th>email:</th>
      <td>
      <input type="text" id="email" name="email" value="" size="32" class="inp-form"/>
      </td>
    </tr> 
    <tr>
      <th></th>
      <td>
      <select name="city" id="city">
        <option selected="selected" value=""  >Select </option>
        <option value="Pune">Pune</option>
        <option value="Stara">Stara</option>
        <option value="Sangali">Sangali</option>
        <option value="Mumbai">Mumbai</option>
      </select>
      </td>
    </tr>
    <tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="submit" value="Submit" class="form-submit" onclick ="jqsub()" />
			<input type="reset" value="Reset" class="form-reset"  />
		</td>
		<td></td>
	</tr>
  </table>
  <!-- ending table contents -->
      

  
</form>
<p>&nbsp;</p>

</body>
</html>