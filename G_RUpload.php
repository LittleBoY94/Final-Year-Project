<?php
  ini_set('mysql.connect_timeout', 300);
  ini_set('default_socket_timeout', 300);
?>
 <?php
    if(isset($_POST['sumit']))
      {
        if(getimagesize($_FILES['Pictures']['tmp_name']) == FALSE)
        {
          echo "Please select an image.";
        }
        else
        {
          $image= addslashes($_FILES['Pictures']['tmp_name']);
          $name= addslashes($_FILES['Pictures']['name']);
          $image= file_get_contents($image);
          $image= base64_encode($image);
      
        $con=mysql_connect("localhost", "root", "");
        mysql_select_db("busybee",$con);
$var1=1;      
$qry="UPDATE jobseeker SET Pictures='$image' WHERE Jobseeker_ID ='".$var1."'";
        $result=mysql_query($qry, $con);
        if($result)
        {
          echo "<br/>Successfully upload. Your payment will be confirm within 24 hours.";
        }
        else
        {
          echo "<br/>Not uploaded.";
        }
		
      }
	  }
      ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
<title>Picture</title>
 
</head>
<body >
<form method="post" enctype="multipart/form-data" class="file-input-wrapper">
                  <div align="center">
                    <input type="file" name="Pictures" class="filestyle"  data-buttonName="btn-primary">

                    <br/>
                    <input type="submit" name="sumit" value="Upload" class="btn btn-primary btn-lg buttonRegister registerbutton1 rpayment table2" />
                    </div>
               </form>
               
               </body>