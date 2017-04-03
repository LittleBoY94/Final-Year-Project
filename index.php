<html>
<head>
	<title>Upload an image</title>
<head>
<body>

<form action="index.php" method="POST" enctype="multipart/form-data">
	File:
    	<input type="file" name="Pictures"> <input type="submit" value="Upload">
        </form>
        <?php
		
		//connect to database
		mysql_connect("localhost","root","") or die (mysql_error());
		mysql_select_db("busybee") or die (mysql_error());
		
		//file properties
		$file = $_FILES['Pictures']['tmp_name'];
		
		if(!isset($file))
		echo "Please select an image.";
		else
		{
			$image = addslashes(file_get_contents($_FILES['Pictures']['tmp_name']));
			$image_name = addslashes($_FILES['Pictures']['name']);
			$image_size = getimagesize($_FILES['Pictures']['tmp_name']);
			
			if ($image_size==FALSE)
			echo "That is not an image.";
			else
			{
				if($insert = mysql_query("INSERT INTO jobseeker VALUES ('','$image_name','$image')"))
			echo "problem uploading image.";
			else
			{
				$lashid = mysql_insert_ID();
				echo "Image uploaded.<p />Your image:<p /><img src=get.php?id=$lastid>";	
			}
		}
		}
		
		?>
   
</body>
</html>