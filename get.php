<?php
	//connect to database
		mysql_connect("localhost","root","") or die (mysql_error());
		mysql_select_db("busybee") or die (mysql_error());
		


$id = addslashes($_REQUEST['id']);

$image = mysql_query("SELECT * FROM jobseeker WHERE id=$id");
$image = mysql_fetch_assoc($image);
$image = $image['Pictures'];

header("Content-type: image/jpeg");

echo $image;
?>