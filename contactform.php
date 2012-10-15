<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body> 
 <center>  
  <form action="ViewPerson" method="get" id="contactForm" name="contactForm">
    <table><tr><th colspan="2">Simple Contact Form</th></tr>
      <tr><td>First Name: </td><td><input id="fname" name="fname" /></td></tr>
      <tr><td>Last Name: </td><td><input id="lname" name="lname" /></td></tr>
      <tr><td>E-mail: </td><td><input id="email" name="email" /></td></tr>
      <tr>
      <td>Comments:</td><td><textarea name="text" id="text" cols="45" rows="5"></textarea></td></tr>
      <tr><td colspan="2"><p>
        <input type="submit" value="Submit" />
      </p>
      <p>Submit Form for
        
more Information          more Information</p></td></tr>
    </table>  
  </form>
</center><?php

  // Get the search variable from URL

  $var = @$_GET['q'] ;
  $trimmed = trim($var); //trim whitespace from the stored variable

// rows to return
$limit=10; 

// check for an empty string and display a message.
if ($trimmed == "")
  {
  echo "<p>Please enter a search...</p>";
  exit;
  }

// check for a search parameter
if (!isset($var))
  {
  echo "<p>We dont seem to have a search parameter!</p>";
  exit;
  }

//connect to your database ** EDIT REQUIRED HERE **
mysql_connect("localhost","ROOT",""); //(host, username, password)

//specify database ** EDIT REQUIRED HERE **
mysql_select_db("HMS") or die("Unable to select database"); //select which database we're using

// Build SQL Query  
$query = "select * from Person where fname=vikram"; // EDIT HERE and specify your table and field names for the SQL query

 $numresults=mysql_query($query);
 $numrows=mysql_num_rows($numresults);
if ($numrows == 0)
  {
  echo "<h4>Results</h4>";
  echo "<p>Sorry, your search: &quot;" . $trimmed . "&quot; returned zero results</p>";
  }

// next determine if s has been passed to script, if not use 0
  if (empty($s)) {
  $s=0;
  }

// get results
  $query .= " limit $s,$limit";
  $result = mysql_query($query) or die("Couldn't execute query");

// display what the person searched for
echo "<p>You searched for: &quot;" . $var . "&quot;</p>";

// begin to show results set
echo "Results";
$count = 1 + $s ;

// now you can display the results returned
  while ($row= mysql_fetch_array($result)) {
  $title = $row["1st_field"];

  echo "$count.)&nbsp;$title" ;
  $count++ ;
  }

$currPage = (($s/$limit) + 1);?>
</body>
</html>