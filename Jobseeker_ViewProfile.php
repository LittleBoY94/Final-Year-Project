<?php require_once('Connections/busybee.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "Homepage.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
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
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset1 = $_SESSION['MM_Username'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset1 = sprintf("SELECT * FROM jobseeker WHERE Username = %s", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $busybee) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset2 = $_SESSION['MM_Username'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset2 = sprintf("SELECT * FROM education_level natural join jobseeker WHERE Username=%s", GetSQLValueString($colname_Recordset2, "text"));
$Recordset2 = mysql_query($query_Recordset2, $busybee) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$colname_Recordset3 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset3 = $_SESSION['MM_Username'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset3 = sprintf("SELECT * FROM jobseeker_experiences natural join jobseeker WHERE Username=%s", GetSQLValueString($colname_Recordset3, "text"));
$Recordset3 = mysql_query($query_Recordset3, $busybee) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

$colname_Recordset4 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset4 = $_SESSION['MM_Username'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset4 = sprintf("SELECT * FROM education_level natural join jobseeker WHERE Username=%s", GetSQLValueString($colname_Recordset4, "text"));
$Recordset4 = mysql_query($query_Recordset4, $busybee) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);

$colname_Recordset5 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset5 = $_SESSION['MM_Username'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset5 = sprintf("SELECT * FROM jobseeker_experiences natural join jobseeker WHERE Username=%s", GetSQLValueString($colname_Recordset5, "text"));
$Recordset5 = mysql_query($query_Recordset5, $busybee) or die(mysql_error());
$row_Recordset5 = mysql_fetch_assoc($Recordset5);
$totalRows_Recordset5 = mysql_num_rows($Recordset5);

$colname_Recordset6 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset6 = $_SESSION['MM_Username'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset6 = sprintf("SELECT applyjob.Applyjob_ID, Apply_Date, Time, Date, Time_Post, Job_Description, Job_Salary, Job_Title, TypeOfEmployment, Job_Category, Education_Level, Languages, postjob.Benefits, postjob.Conditions, Company_Name, Company_Email, Company_PhoneNumber, Location, jobseeker.Username FROM applyjob natural join jobseeker natural join postjob left outer join employer on postjob.Employer_ID = employer.Employer_ID WHERE jobseeker.Username=%s", GetSQLValueString($colname_Recordset6, "text"));
$Recordset6 = mysql_query($query_Recordset6, $busybee) or die(mysql_error());
$row_Recordset6 = mysql_fetch_assoc($Recordset6);
$totalRows_Recordset6 = mysql_num_rows($Recordset6);

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
	<title>Jobseeker's Profile Page</title>
	 
	<link href="css/bootstrap.css" rel="stylesheet">
	 
	<link href="css/main.css" rel="stylesheet">
 
	
 
	<link rel="shortcut icon" href="images\Icons\Batch-master\PNG\32x32\newspaper.png">
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
	<div class="preloader"></div>
	
    	
<main id="top" class="masthead" role="main">
  <div class="container">
			<div class="logo"><img class="logotitle" src="images/BusyBee.png" alt="logo"></a>
			</div>
 
	<h1 class= "fontstyle" style="text-shadow: 2px 2px #000;">Welcome<strong> <?php echo $row_Recordset1['Username']; ?>!<br>
	</h1>
 
			<div class="row"></div>
  </div>
</main>
 

<main class="footercta" role="main" id="menubar">    	
<div class="container" id="explore">
	  <section class="row heroimg breath">
		  <div class="col-md-12 text-center"><div id="cssmenu">
<ul>
   <li class='active'><a href='Jobseeker_JobPage.php'>Home</a></li>
   <li><a href='Jobseeker_MainSearch.php'>Search</a></li>
   <li><a href='Jobseeker_ViewProfile.php'>Profile</a></li>
   <li><a href='<?php echo $logoutAction ?>'>LOGOUT</a></li>
</ul>
</div></div>
	  </section></div></main>
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
						echo '<img height="400" width="300" src=data:image;base64,'.$row_Recordset1['Pictures'];
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
                              <td width="142" height="32"><div align="right">Previous Company:</div></td>
                              <td width="228"><div align="left"><?php echo $row_Recordset3['Ex_Company']; ?></div></td>
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
<section class="row faq breath" id="button">
<div class="container">
     
			<section class="row breath">
              <div align="center" style="margin: 15px;">
                <input type="submit" style="margin:30px;" name="btnupdate" class="btn btn-success btn-lg buttonstyle  fontstyle2" onClick="window.location.href='Jobseeker_Homepage.php#stay1'" id="btnupdate" value="Edit Profile">
                <input type="submit" style="margin:30px;" name="btnupdate" class="btn btn-success btn-lg buttonstyle  fontstyle2" onClick="window.print() " id="btnupdate" value="Print Resume" >
                <input type="submit" style="margin:30px;" name="btnupdate" class="btn btn-success btn-lg buttonstyle  fontstyle2" onClick="window.location.href='Jobseeker_ViewProfile.php#popup1'" id="btnupdate" value="Jobs Application">
              </div>
            </section>
		</div>
</section>
 
</div></div>

          			<div class="col-md-12 footerlinks footercta" role="main" id="footer">
					<p style="text-shadow: 2px 2px #000;">&copy; 2016 BusyBee.co. All Rights Reserved</p>
			</div>
            
            <div id="popup1" class="overlay">
	<div class="popup popupstyle">
		<h2 align="center">Job Applications</h2>
		<div align="center"><a class="close" href="Jobseeker_ViewProfile.php#stay1">&times;</a>
	  </div>
		<div class="content" style="overflow-y:scroll; height:700px;">
        
		  <div align="center">
		    <?php do { ?>
  <table class="tablecolor" style="margin-top:40px;" align="center" width="889" height="262" border="1">
    <tr>
      <td align="center" colspan="3"><h3><?php echo $row_Recordset6['Job_Title']; ?></h3></td>
      <td width="245" style="padding:10px;">Date Posted: <?php echo $row_Recordset6['Time_Post']; ?></td>
    </tr>
    <tr>
      <td width="135" style="padding:10px;" >Job Availability:</td>
      <td width="220" style="padding:10px;" ><?php echo $row_Recordset6['Date']; ?></td>
      <td width="168" style="padding:10px;" >Type of Employment: </td>
      <td style="padding:10px;" ><?php echo $row_Recordset6['TypeOfEmployment']; ?></td>
    </tr>
    <tr>
      <td height="28" style="padding:10px;" >Vacancy Position: </td>
      <td style="padding:10px;" ><?php echo $row_Recordset6['Job_Category']; ?></td>
      <td style="padding:10px;" >Required Education:</td>
      <td style="padding:10px;" ><?php echo $row_Recordset6['Education_Level']; ?></td>
    </tr>
    <tr>
      <td style="padding:10px;" >Job Salary: </td>
      <td style="padding:10px;" ><?php echo $row_Recordset6['Job_Salary']; ?></td>
      <td style="padding:10px;" >Required Langauge(s): </td>
      <td style="padding:10px;" ><?php echo $row_Recordset6['Languages']; ?></td>
    </tr>
    <tr>
      <td style="padding:10px;" >Job Description: </td>
      <td style="padding:10px;" ><?php echo $row_Recordset6['Job_Description']; ?></td>
      <td style="padding:10px;" >Conditions:</td>
      <td style="padding:10px;" ><?php echo $row_Recordset6['Conditions']; ?></td>
    </tr>
    <tr>
      <td style="padding:10px;" >Benefits: </td>
      <td colspan="3" style="padding:10px;" ><?php echo $row_Recordset6['Benefits']; ?></td>
    </tr>
    <tr>
      <td style="padding:10px;" >Date  Applied:</td>
      <td style="padding:10px;" ><?php echo $row_Recordset6['Apply_Date']; ?></td>
      <td style="padding:10px;" >Company Name:</td>
      <td style="padding:10px;" ><?php echo $row_Recordset6['Company_Name']; ?></td>
    </tr>
    <tr>
      <td style="padding:10px;" >Time Applied:</td>
      <td style="padding:10px;" ><?php echo $row_Recordset6['Time']; ?></td>
      <td style="padding:10px;" >Company Email:</td>
      <td style="padding:10px;" ><?php echo $row_Recordset6['Company_Email']; ?></td>
    </tr>
  </table>
  <input type="submit" name="btnupdate" class="btn btn-success btn-lg buttonstyle  fontstyle2" style="margin:10px;" onclick="window.location.href='testingdeletejob.php?Applyjob_ID=<?php echo $row_Recordset6['Applyjob_ID']; ?>'" id="btnupdate" value="Cancel Request">

  <?php } while ($row_Recordset6 = mysql_fetch_assoc($Recordset6)); ?>
	      </div>
	    </div>
</div></div>

<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);

mysql_free_result($Recordset4);

mysql_free_result($Recordset5);

mysql_free_result($Recordset6);
?>
