<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_busybee = "localhost";
$database_busybee = "busybee";
$username_busybee = "root";
$password_busybee = "";
$busybee = mysql_pconnect($hostname_busybee, $username_busybee, $password_busybee) or trigger_error(mysql_error(),E_USER_ERROR); 
?>