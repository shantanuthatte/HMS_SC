<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_HMS = "localhost";
$database_HMS = "hms";
$username_HMS = "root";
$password_HMS = "";
$HMS = mysql_connect($hostname_HMS, $username_HMS, $password_HMS) or trigger_error(mysql_error(),E_USER_ERROR); 
?>