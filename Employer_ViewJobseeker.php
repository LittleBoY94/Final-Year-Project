<?php require_once('Connections/busybee.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_Recordset1 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset1 = $_GET['id'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset1 = sprintf("SELECT * FROM jobseeker WHERE Jobseeker_ID = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $busybee) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset2 = $_GET['id'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset2 = sprintf("SELECT * FROM education_level WHERE Jobseeker_ID = %s", GetSQLValueString($colname_Recordset2, "int"));
$Recordset2 = mysql_query($query_Recordset2, $busybee) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$colname_Recordset3 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset3 = $_GET['id'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset3 = sprintf("SELECT * FROM jobseeker_experiences WHERE Jobseeker_ID = %s", GetSQLValueString($colname_Recordset3, "int"));
$Recordset3 = mysql_query($query_Recordset3, $busybee) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);
?>
<!DOCTYPE html>
<html lang="en">
<head>
 
<head>
 
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="js/styles.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="js/script.js"></script>
    
	<meta name="description" content="">
	<title>Employer's View Jobseeker</title>
	 
	<link href="css/bootstrap.css" rel="stylesheet">
	 
	<link href="css/main.css" rel="stylesheet">
 
	
 
	<link rel="shortcut icon" href="images/favicon.png">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

	<script src="js/pace.js"></script>
    
    
 
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,600' rel='stylesheet' type='text/css'>
	<style type="text/css">
	#apDiv1 {
	position: absolute;
	width: 200px;
	height: 115px;
	z-index: 1;		
}
	
    </style>
	<link href="css/Style1.css" rel="stylesheet" type="text/css">
	<style type="text/css">
	body,td,th {
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
}
    </style>
</head>
	<style type="text/css">
	body,td,th {
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
}
#mainbox {
	width: 595px;
	height: auto;
	z-index: 1;
}
#border1 {
	width: 625px;
	z-index: 5;
	background-color: #000;
	height:3px;
	margin:auto;
	top: 20px;
	
}

#border2 {
	position: absolute;
	width: 625px;
	height: 1px;
	z-index: 1;
	padding:0;
	background-color: #f15c5c;
	top: 475px;
	left:9px;
}
#border3 {
	position: absolute;
	width: 625px;
	height: 1px;
	z-index: 1;
	padding:0;
	background-color: #f15c5c;
	top: 700	px;
	left:9px;
}
#mainbox {display:none;}


@media print
{#explore {display: none;}
#mainbox{display:block;}

#button{display:none;}
#top{display:none;}
#menubar{display:none;}
	}
    </style>


<body>	
<div style="border:1px solid #f15c5c; padding:15px; margin:auto;" id="mainbox">
  <div class="content">
                        
                        
  </div>
  <table width="557" height="154" border="0">
    <tr>
      <td width="200" height="200" rowspan="4">
      <?php
						echo '<img height="200" width="200" src=data:image;base64,'.$row_Recordset1['Pictures'];
						?>
      </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td class="tablefont" style="padding-left: 10px;" colspan="2"><?php echo $row_Recordset1['First_Name']; ?><?php echo $row_Recordset1['Last_Name']; ?></td>
    </tr>
    <tr>
      <td height ="5" class="tablefont2" style="padding-left: 10px;  border-right:1px solid #999;"><?php echo $row_Recordset1['Jobseeker_PhoneNumber']; ?></td>
      <td height ="5" class="tablefont2" style="padding-left: 10px;" ><?php echo $row_Recordset1['Jobseeker_Email']; ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <h2 align="center">Basic Information</h2>
  <table align="center" width="590" border="0">
    <tr>
      <td width="203">Date of Birth: <?php echo $row_Recordset1['DoB']; ?></td>
      <td width="377">Address: <?php echo $row_Recordset1['Jobseeker_Address']; ?></td>
    </tr>
    <tr>
      <td>Gender: <?php echo $row_Recordset1['Gender']; ?></td>
      <td>City: <?php echo $row_Recordset1['City']; ?></td>
    </tr>
    <tr>
      <td>Nationality: <?php echo $row_Recordset1['Nationality']; ?></td>
      <td>State: <?php echo $row_Recordset1['State']; ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Post Code: <?php echo $row_Recordset1['Post_Code']; ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Country: <?php echo $row_Recordset1['Country']; ?></td>
    </tr>
    <tr>
      <td style=" vertical-align:top;">Job Matching Details:</td>
      <td>I am currently looking for <?php echo $row_Recordset1['Job_Role']; ?> position as a <?php echo $row_Recordset1['Type_Of_Employment']; ?> employment  with the salary about RM <?php echo $row_Recordset1['Salary']; ?></td>
    </tr>
  </table>
  <h2 align="center">Education Details  </h2>
    <table style="margin-top: 15px;" width="592" border="0">
    <?php do { ?>
      <tr>
        <td width="205" rowspan="2"><?php echo $row_Recordset4['Year1']; ?> to <?php echo $row_Recordset4['Year2']; ?></td>
        <td width="438" class="tablefont2"><?php echo $row_Recordset4['Institution_Name']; ?></td>
      </tr>
      <tr>
        <td>
            <?php echo $row_Recordset4['Education_Level']; ?>
            
 In <?php echo $row_Recordset4['Course_Name']; ?></td>
      </tr>
      <?php } while ($row_Recordset4 = mysql_fetch_assoc($Recordset4)); ?>
    </table>
  <h2 align="center" >Job Experiences</h2>
    <table  style="margin-top:15px;" width="580" border="0">
      <?php do { ?>
      <tr>
        <td><p>I previously worked in <?php echo $row_Recordset5['Ex_Company']; ?> for the duration of <?php echo $row_Recordset5['Ex_Year']; ?> as a <?php echo $row_Recordset5['Positions']; ?> in <?php echo $row_Recordset5['Location']; ?>.
            </p>
          <p>Additional Details: <?php echo $row_Recordset5['Details']; ?></p></td>
      </tr>
        <?php } while ($row_Recordset5 = mysql_fetch_assoc($Recordset5)); ?>
    </table>
    

</div>
<div class="container" id="explore">
  <div class="section-title">
		  <div class="content">
		    <h2 align="center"> <?php echo $row_Recordset1['Username']; ?>'s Profile</h2>
	      </div>
		  <p>&nbsp;</p>
			  <div class="col-md-box" style="margin:auto; position:relative;" id="stay1">
				  <div class="boxheight fontcolor2">
				    <div class="content">
                        <div class="content">
                        <?php
						echo '<img height="200" width="200" src=data:image;base64,'.$row_Recordset1['Pictures'];
						?>
                        </div>
                      <div align="center">
                        <h3>Basic Information</h3>
                          
                            <table class="tablecolor tabletext" width="910" height="262" border="0">
                              <tr>
                                <td width="123" height="57" style="padding-left: 15px;"><div align="right">First Name: </div></td>
                                <td width="154"> <?php echo $row_Recordset1['First_Name']; ?></td>
                                <td width="118" style="padding-left: 15px;"><div align="right">Email Adddress:</div></td>
                                <td width="245"><?php echo $row_Recordset1['Jobseeker_Email']; ?></td>
                                <td width="87" style="padding-left: 15px;"><div align="right">State:</div></td>
                                <td width="155"><?php echo $row_Recordset1['State']; ?></td>
                              </tr>
                              <tr>
                                <td height="51" style="padding-left: 15px;"><div align="right">Last Name:</div></td>
                                <td><?php echo $row_Recordset1['Last_Name']; ?></td>
                                <td style="padding-left: 15px;"><div align="right">Phone Number:</div></td>
                                <td><?php echo $row_Recordset1['Jobseeker_PhoneNumber']; ?></td>
                                <td style="padding-left: 15px;"><div align="right">Post Code:</div></td>
                                <td><?php echo $row_Recordset1['Post_Code']; ?></td>
                              </tr>
                              <tr>
                                <td height="55" style="padding-left: 15px;"><div align="right">Date of Birth:</div></td>
                                <td><?php echo $row_Recordset1['DoB']; ?></td>
                                <td style="padding-left: 15px;"><div align="right">Address: </div></td>
                                <td><?php echo $row_Recordset1['Jobseeker_Address']; ?></td>
                                <td style="padding-left: 15px;"><div align="right">Country:</div></td>
                                <td><?php echo $row_Recordset1['Country']; ?></td>
                              </tr>
                              <tr>
                                <td height="40" style="padding-left: 15px;"><div align="right">Gender:</div></td>
                                <td><?php echo $row_Recordset1['Gender']; ?></td>
                                <td style="padding-left: 15px;"><div align="right">City: </div></td>
                                <td><?php echo $row_Recordset1['City']; ?></td>
                                <td style="padding-left: 15px;"><div align="right">Nationality:</div></td>
                                <td><?php echo $row_Recordset1['Nationality']; ?></td>
                              </tr>
                              <tr>
                                <td height="47" style="padding-left: 15px;"><div align="right">About Me:</div></td>
                                <td colspan="3"><?php echo $row_Recordset1['About_Me']; ?></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
  </table>
                      </div>
                    </div> </div>
                    <div class="content" style="float:none;">
                    <div align="center">
                      <h3>Job Details</h3>	
                      <table class="tablecolor tabletext" width="761" height="138" border="0">
  <tr>
    <td width="166" height="67"><div align="right">Job Role:</div></td>
    <td width="189"><?php echo $row_Recordset1['Job_Role']; ?></td>
    <td width="158"><div align="right">Type of Employment:</div></td>
    <td width="224"><?php echo $row_Recordset1['Type_Of_Employment']; ?></td>
  </tr>
  <tr>
    <td><div align="right">Skills &amp; Certificate:</div></td>
    <td><?php echo $row_Recordset1['Skills_Certificate']; ?></td>
    <td><div align="right">Salary:</div></td>
    <td>MYR <?php echo $row_Recordset1['Salary']; ?></td>
  </tr>
</table>


                  </div>
                    </div>
                <div class="content" style="float:left;">
                      <div align="center">
                      <h3>Education Details</h3>
                      <?php do { ?>
  <table class="tablecolor" width="449" height="170" align="center" style="margin-top:10px;" border="0">
    <tr>
      <td width="168"><div align="right">Education Level: </div></td>
      <td width="262"><?php echo $row_Recordset2['Education_Level']?></td>
    </tr>
    <tr>
      <td><div align="right">Institution Name:</div></td>
      <td><?php echo $row_Recordset2['Institution_Name']; ?></td>
    </tr>
    <tr>
      <td><div align="right">From: </div></td>
      <td><?php echo $row_Recordset2['Year1']; ?> - <?php echo $row_Recordset2['Year2']; ?></td>
    </tr>
    <tr>
      <td><div align="right">Course Name:</div></td>
      <td><?php echo $row_Recordset2['Course_Name']; ?></td>
    </tr>
    <tr>
      <td><div align="right">Main Language Spoken: </div></td>
      <td><?php echo $row_Recordset2['Languages']; ?></td>
    </tr>
  </table>
  
  <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
                  </div>
                </div> 
                    
                
                  <div class="content" style="float:right;">
                    <div align="center">
                      <h3>Job Experiences</h3>
                        <?php do { ?>
                          <table class="tablecolor tabletext" width="386" height="170" style="margin-top:10px;" border="0">
                            <tr>
                              <td width="200" height="32"><div align="right">Previous Company:</div></td>
                              <td width="170"><div align="left"><?php echo $row_Recordset3['Ex_Company']; ?></div></td>
                            </tr>
                            <tr>
                              <td height="29"><div align="right">Working Duration </div></td>
                              <td><div align="left"><?php echo $row_Recordset3['Ex_Year']; ?></div></td>
                            </tr>
                            <tr>
                              <td height="30"><div align="right">Working Position:</div></td>
                              <td><div align="left"><?php echo $row_Recordset3['Positions']; ?></div></td>
                            </tr>
                            <tr>
                              <td height="31"><div align="right">Details:</div></td>
                              <td><div align="left"><?php echo $row_Recordset3['Details']; ?></div></td>
                            </tr>
                            
                          </table>
                          <?php } while ($row_Recordset3 = mysql_fetch_assoc($Recordset3)); ?>
                    </div>
                </div>
       </div>                  
     </div>
     
</div></div>
<p>&nbsp;</p>
</div>
</div>
<?php
mysql_free_result($Recordset2);

mysql_free_result($Recordset3);


mysql_free_result($Recordset1);
?>
