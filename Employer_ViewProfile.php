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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO shortlisted (Applyjob_ID) VALUES (%s)",
                       GetSQLValueString($_POST['Jobseeker_ID'], "int"));

  mysql_select_db($database_busybee, $busybee);
  $Result1 = mysql_query($insertSQL, $busybee) or die(mysql_error());

  $insertGoTo = "Employer_ViewProfile.php#popup1";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '')) ? "&" : "";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}


$colname_Recordset1 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset1 = $_SESSION['MM_Username'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset1 = sprintf("SELECT * FROM employer WHERE Username = %s", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $busybee) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset6 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset6 = $_SESSION['MM_Username'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset6 = sprintf("SELECT Applyjob_ID, Jobseeker_ID, Job_ID, Apply_Date, Time, Date, Time_Post, Job_Description, Job_Salary, Job_Title, TypeOfEmployment, Job_Category, Education_Level, Languages, postjob.Benefits, postjob.Conditions, Company_Name, Company_Email, Company_PhoneNumber, Location, employer.Username, jobseeker.First_Name, jobseeker.Last_Name, jobseeker.Jobseeker_PhoneNumber, jobseeker.Jobseeker_Email FROM applyjob natural join jobseeker natural join postjob left outer join employer on postjob.Employer_ID = employer.Employer_ID WHERE employer.Username=%s and NOT EXISTS (SELECT * FROM shortlisted WHERE shortlisted.Applyjob_ID = applyjob.Applyjob_ID) ", GetSQLValueString($colname_Recordset6, "text"));
$Recordset6 = mysql_query($query_Recordset6, $busybee) or die(mysql_error());
$row_Recordset6 = mysql_fetch_assoc($Recordset6);
$totalRows_Recordset6 = mysql_num_rows($Recordset6);

$colname_Recordset2 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset2 = $_SESSION['MM_Username'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset2 = sprintf("SELECT  Shortlisted_ID, Jobseeker_ID, Job_ID, Apply_Date, Time, Date, Time_Post, Job_Description, Job_Salary, Job_Title, TypeOfEmployment, Job_Category, Education_Level, Languages, postjob.Benefits, postjob.Conditions, Company_Name, Company_Email, Company_PhoneNumber, Location, employer.Username, jobseeker.First_Name, jobseeker.Last_Name, jobseeker.Jobseeker_PhoneNumber, jobseeker.Jobseeker_Email FROM applyjob natural join jobseeker natural join shortlisted natural join postjob left outer join employer on postjob.Employer_ID = employer.Employer_ID WHERE employer.Username=%s", GetSQLValueString($colname_Recordset2, "text"));
$Recordset2 = mysql_query($query_Recordset2, $busybee) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$colname_Recordset3 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset3 = $_SESSION['MM_Username'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset3 = sprintf("SELECT *  FROM postjob natural join employer WHERE Username=%s", GetSQLValueString($colname_Recordset3, "text"));
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
	<title>Employer's Profile Page</title>
	 
	<link href="css/bootstrap.css" rel="stylesheet">
	 
	<link href="css/main.css" rel="stylesheet">
 
	
 
	<link rel="shortcut icon" href="images\Icons\Batch-master\PNG\32x32\book-lines.png">
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
    </style>
</head>	

<body>	
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
 

<main class="footercta" role="main">    	
<div class="container" id="explore">
	  <section class="row heroimg breath">
		  <div class="col-md-12 text-center"><div id="cssmenu">
<ul>
   <li class='active'><a href='Employer_JobPage.php'>Home</a></li>
   <li><a href='Employer_MainSearch.php'>Search</a></li>
   <li><a href='Employer_ViewProfile.php'>Profile</a></li>
   <li><a href='<?php echo $logoutAction ?>'>LOGOUT</a></li>
</ul>
</div></div>
	  </section></div></main>
   <div class="container" id="explore">
	 <div class="section-title" id="stay1">
		  <div class="content">
		    <h2 align="center"> <?php echo $row_Recordset1['Username']; ?>'s Profile</h2>
	      </div>
		  <p>&nbsp;</p>
			  <div class="col-md-box" style="margin:auto; position:relative;">
				  <div class="boxheight fontcolor2">
				    <div class="content">
                        <div class="content">
                        <?php
						echo '<img height="200" width="200" src=data:image;base64,'.$row_Recordset1['Company_Pictures'];
						?>
                        </div>
                      <div align="center">
                        <h3>Company's Information</h3>
                          <table class="tablecolor tabletext" width="1170" height="261" border="0">
  <tr>
    <td width="131" height="59"><div align="right">Company Name:</div></td>
    <td width="200"><?php echo $row_Recordset1['Company_Name']; ?></td>
    <td width="170"><div align="right">Company's Email:</div></td>
    <td width="237"><?php echo $row_Recordset1['Company_Email']; ?></td>
    <td width="126"><div align="right">City:</div></td>
    <td width="274"><?php echo $row_Recordset1['City']; ?></td>
  </tr>
  <tr>
    <td><div align="right">SSM Number:</div></td>
    <td><?php echo $row_Recordset1['SSM_No']; ?></td>
    <td><div align="right">Company's Phone Number:</div></td>
    <td><?php echo $row_Recordset1['Company_PhoneNumber']; ?></td>
    <td><div align="right">State:</div></td>
    <td><?php echo $row_Recordset1['States']; ?></td>
  </tr>
  <tr>
    <td><div align="right">Establishment:</div></td>
    <td><?php echo $row_Recordset1['Establishment']; ?></td>
    <td><div align="right">Company's Address:</div></td>
    <td><?php echo $row_Recordset1['Company_Address']; ?></td>
    <td><div align="right">Country:</div></td>
    <td><?php echo $row_Recordset1['Country']; ?></td>
  </tr>
  <tr>
    <td><div align="right">Industries:</div></td>
    <td><?php echo $row_Recordset1['Industries']; ?></td>
    <td><div align="right">Post Code:</div></td>
    <td><?php echo $row_Recordset1['Post_Code']; ?></td>
    <td><div align="right">Company's Website:</div></td>
    <td><?php echo $row_Recordset1['Company_Websites']; ?></td>
  </tr>
  <tr>
    <td><div style="vertical-align:top;" align="right">Company's Detail:</div></td>
    <td colspan="3"><?php echo $row_Recordset1['Company_Details']; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

                      </div>
                    </div> </div>
                    <div class="content" style="float:none;">
                    <div align="center">
                      <h3>Hiring Information</h3>	
                   <table class="tablecolor tabletext" width="859" height="138"  border="0">
  <tr>
    <td width="160" height="43"><div align="right">Looking for:</div></td>
    <td width="291"><?php echo $row_Recordset1['Type_of_Employment']; ?></td>
    <td width="119"><div align="right">Location:</div></td>
    <td width="261"><?php echo $row_Recordset1['Location']; ?></td>
  </tr>
  <tr>
    <td><div align="right">Requirement skills: </div></td>
    <td><?php echo $row_Recordset1['Hiring_Skills']; ?></td>
    <td><div align="right">Hiring Details: </div></td>
    <td><?php echo $row_Recordset1['Hiring_Details']; ?></td>
  </tr>
</table> 
                  </div>
                    </div>
	   </div>                  
     </div>
     
</div>
   </div>
   <p>&nbsp;</p>
<section class="row faq breath">
<div class="container">
     
			<section class="row breath">
              <div align="center" style="margin: 15px;">
                <input type="submit" style="margin:30px;" name="btnupdate" class="btn btn-success btn-lg buttonstyle  fontstyle2" onClick="window.location.href='Employer_Homepage.php#stay1'" id="btnupdate" value="Edit Profile">
                <input type="submit" style="margin:30px;" name="btnupdate" class="btn btn-success btn-lg buttonstyle  fontstyle2" onClick="window.location.href='Employer_ViewProfile.php#popup1'" id="btnupdate" value="Jobs Application">
                <input type="submit" style="margin:30px;" name="btnupdate" class="btn btn-success btn-lg buttonstyle  fontstyle2" onClick="window.location.href='Employer_ViewProfile.php#popup2'" id="btnupdate" value="Short Listing">
                <input type="submit" style="margin:30px;" name="btnupdate" class="btn btn-success btn-lg buttonstyle  fontstyle2" onClick="window.location.href='Employer_ViewProfile.php#popup3'" id="btnupdate" value="Job Posted History">
              </div>
            </section>
		</div>
</section>
 
</div></div>
          			<div class="col-md-12 footerlinks footercta" role="main">
					<p style="text-shadow: 2px 2px #000;">&copy; 2016 BusyBee.co. All Rights Reserved</p>
			</div>
             <div id="popup1" class="overlay">
	<div class="popup popupstyle">
		<h2 align="center">Job Applications</h2>
		<div align="center"><a class="close" href="Employer_ViewProfile.php#stay1">&times;</a>
	  </div><div class="content" style="overflow-y:scroll; height:700px;">
        
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
      <td style="padding:10px;" >Applicant:</td>
      <td style="padding:10px;" ><?php echo $row_Recordset6['First_Name']; ?> <?php echo $row_Recordset6['Last_Name']; ?></td>
      <td style="padding:10px;" >Applicant Phone Number:</td>
      <td style="padding:10px;" ><?php echo $row_Recordset6['Jobseeker_PhoneNumber']; ?></td>
      </tr>
    <tr>
      <td style="padding:10px;" >Time Applied:</td>
      <td style="padding:10px;" ><?php echo $row_Recordset6['Time']; ?></td>
      <td style="padding:10px;" >Applicant Email:</td>
      <td style="padding:10px;" ><?php echo $row_Recordset6['Jobseeker_Email']; ?></td>
      </tr>
  </table>
  
  <input type="submit" name="btnupdate" class="btn btn-success btn-lg buttonstyle  fontstyle2"  onclick="window.location.href='employer_deleteapplicant.php?Applyjob_ID=<?php echo $row_Recordset6['Applyjob_ID']; ?>'"style="margin:20px 30px 20px 200px; float:left;" id="btnupdate" value="Delete Applicant">

  <form method="POST" name="form1" id="form1" action="<?php echo $editFormAction; ?>">
  <input type="hidden" name="Jobseeker_ID" value="<?php echo $row_Recordset6['Applyjob_ID']; ?>">

<input type="submit" name="btnupdate" class="btn btn-success btn-lg buttonstyle  fontstyle2" style="margin:20px 30px 20px 20px; float:left;" id="btnupdate" value="Shortlist">
<input type="hidden" name="MM_insert" value="form1">
  </form>
   <form name="form2" method="post" action="javascript: void(0)" onclick="window.open('Employer_ViewJobseeker.php?id=<?php echo $row_Recordset6['Jobseeker_ID']; ?>', 
  'windowname1', 
  'width=auto, height=auto'); 
   return false;" style="margin: 20px; float:left;">
                              <input type="submit" class="btn btn-success btn-lg buttonstyle" name="btnview" id="btnview" value="View Profile">
                            </form>
<?php } while ($row_Recordset6 = mysql_fetch_assoc($Recordset6)); ?>

	      </div>
	    </div>
</div></div>
<div id="popup2" class="overlay">
	<div class="popup popupstyle">
		<h2 align="center">Short Listed Jobseekers</h2>
		<div align="center"><a class="close" href="Employer_ViewProfile.php#stay1">&times;</a>
	  </div><div class="content" style="overflow-y:scroll; height:700px;">
        
		  <div align="center">
		   
            <?php do { ?>
              <table class="tablecolor" style="margin-top:40px;" align="center" width="889" height="262" border="1">
                <tr>
                  <td align="center" colspan="3"><h3><?php echo $row_Recordset2['Job_Title']; ?></h3></td>
                  <td width="245" style="padding:10px;">Date Posted: <?php echo $row_Recordset2['Time_Post']; ?></td>
                </tr>
                <tr>
                  <td width="135" style="padding:10px;" >Job Availability:</td>
                  <td width="220" style="padding:10px;" ><?php echo $row_Recordset2['Date']; ?></td>
                  <td width="168" style="padding:10px;" >Type of Employment: </td>
                  <td style="padding:10px;" ><?php echo $row_Recordset2['TypeOfEmployment']; ?></td>
                </tr>
                <tr>
                  <td height="28" style="padding:10px;" >Vacancy Position: </td>
                  <td style="padding:10px;" ><?php echo $row_Recordset2['Job_Category']; ?></td>
                  <td style="padding:10px;" >Required Education:</td>
                  <td style="padding:10px;" ><?php echo $row_Recordset2['Education_Level']; ?></td>
                </tr>
                <tr>
                  <td style="padding:10px;" >Job Salary: </td>
                  <td style="padding:10px;" ><?php echo $row_Recordset2['Job_Salary']; ?></td>
                  <td style="padding:10px;" >Required Langauge(s): </td>
                  <td style="padding:10px;" ><?php echo $row_Recordset2['Languages']; ?></td>
                </tr>
                <tr>
                  <td style="padding:10px;" >Job Description: </td>
                  <td style="padding:10px;" ><?php echo $row_Recordset2['Job_Description']; ?></td>
                  <td style="padding:10px;" >Conditions:</td>
                  <td style="padding:10px;" ><?php echo $row_Recordset2['Conditions']; ?></td>
                </tr>
                <tr>
                  <td style="padding:10px;" >Benefits: </td>
                  <td colspan="3" style="padding:10px;" ><?php echo $row_Recordset2['Benefits']; ?></td>
                </tr>
                <tr>
                  <td style="padding:10px;" >Applicant:</td>
                  <td style="padding:10px;" ><?php echo $row_Recordset2['First_Name']; ?> <?php echo $row_Recordset2['Last_Name']; ?></td>
                  <td style="padding:10px;" >Applicant Phone Number:</td>
                  <td style="padding:10px;" ><?php echo $row_Recordset2['Jobseeker_PhoneNumber']; ?></td>
                </tr>
                <tr>
                  <td style="padding:10px;" >Time Applied:</td>
                  <td style="padding:10px;" ><?php echo $row_Recordset2['Time']; ?></td>
                  <td style="padding:10px;" >Applicant Email:</td>
                  <td style="padding:10px;" ><?php echo $row_Recordset2['Jobseeker_Email']; ?></td>
                </tr>
              </table>
              <input type="submit" name="btnupdate" class="btn btn-success btn-lg buttonstyle  fontstyle2" style="margin:10px;" onclick="window.location.href='employer_deletelisted.php?Shortlisted_ID=<?php echo $row_Recordset2['Shortlisted_ID']; ?>'" id="btnupdate" value="Remove Listed">
              <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>



        </div>
	    </div>
</div></div>
<div id="popup3" class="overlay">
	<div class="popup popupstyle">
		<h2 align="center">Job Posted History</h2>
		<div align="center"><a class="close" href="Employer_ViewProfile.php#stay1">&times;</a>
	  </div><div class="content" style="overflow-y:scroll; height:700px;">
        
		  <div align="center">
		    <?php do { ?>
	        <table class="tablecolor" style="margin-top:30px;" align="center" width="889" height="262" border="1">
		        <tr>
		          <td align="center" colspan="3"><h3><?php echo $row_Recordset3['Job_Title']; ?></h3></td>
		          <td width="245">Date Posted: <?php echo $row_Recordset3['Time_Post']; ?></td>
		          </tr>
		        <tr>
		          <td width="135">Job Availability:</td>
		          <td width="220"><?php echo $row_Recordset3['Date']; ?></td>
		          <td width="168">Type of Employment: </td>
		          <td><?php echo $row_Recordset3['TypeOfEmployment']; ?></td>
		          </tr>
		        <tr>
		          <td height="28">Vacancy Position: </td>
		          <td><?php echo $row_Recordset3['Job_Category']; ?></td>
		          <td>Required Education:</td>
		          <td><?php echo $row_Recordset3['Education_Level']; ?></td>
		          </tr>
		        <tr>
		          <td>Job Salary: </td>
		          <td><?php echo $row_Recordset3['Job_Salary']; ?></td>
		          <td>Required Langauge(s): </td>
		          <td><?php echo $row_Recordset3['Languages']; ?></td>
		          </tr>
		        <tr>
		          <td>Job Description: </td>
		          <td style="padding:10px;"><?php echo $row_Recordset3['Job_Description']; ?></td>
		          <td>Conditions:</td>
		          <td><?php echo $row_Recordset3['Conditions']; ?></td>
		          </tr>
		        <tr>
		          <td>Benefits: </td>
		          <td colspan="3" style="padding:10px;"><?php echo $row_Recordset3['Benefits']; ?></td>
		          </tr>
		        </table>
		      
<input type="submit" name="btnupdate" class="btn btn-success btn-lg buttonstyle  fontstyle2" style="margin:10px;" onclick="window.location.href='employer_deletepostedjob.php?Job_ID=<?php echo $row_Recordset3['Job_ID']; ?>'" id="btnupdate" value="Delete Post">
           
<?php } while ($row_Recordset3 = mysql_fetch_assoc($Recordset3)); ?>

        </div>
	    </div>
</div></div>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset6);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
?>
