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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO education_level (Jobseeker_ID, Education_Level, Institution_Name, Year1, Year2, Course_Name, Languages) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Jobseeker_ID'], "int"),
                       GetSQLValueString($_POST['Education_Level'], "text"),
                       GetSQLValueString($_POST['Institution_Name'], "text"),
                       GetSQLValueString($_POST['Year1'], "date"),
                       GetSQLValueString($_POST['Year2'], "date"),
                       GetSQLValueString($_POST['Course_Name'], "text"),
                       GetSQLValueString($_POST['Languages'], "text"));

  mysql_select_db($database_busybee, $busybee);
  $Result1 = mysql_query($insertSQL, $busybee) or die(mysql_error());

  $insertGoTo = "Jobseeker_Homepage.php#popup2";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '')) ? "&" : "";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}



if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form3")) {
  $updateSQL = sprintf("UPDATE jobseeker SET Job_Role=%s, Skills_Certificate=%s, Type_Of_Employment=%s, Salary=%s WHERE Jobseeker_ID=%s",
                       GetSQLValueString($_POST['Job_Role'], "text"),
                       GetSQLValueString($_POST['Skills_Certificate'], "text"),
                       GetSQLValueString($_POST['Type_Of_Employment'], "text"),
                       GetSQLValueString($_POST['Salary'], "double"),
                       GetSQLValueString($_POST['Jobseeker_ID'], "int"));

  mysql_select_db($database_busybee, $busybee);
  $Result1 = mysql_query($updateSQL, $busybee) or die(mysql_error());

  $updateGoTo = "Jobseeker_Homepage.php#popup3";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '')) ? "&" : "";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form6")) {
  $insertSQL = sprintf("INSERT INTO jobseeker_experiences (Experience_ID, Jobseeker_ID, Ex_Company, Ex_Year, Positions, Location, Details) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Experience_ID'], "int"),
                       GetSQLValueString($_POST['Jobseeker_ID'], "int"),
                       GetSQLValueString($_POST['Ex_Company'], "text"),
                       GetSQLValueString($_POST['Ex_Year'], "text"),
                       GetSQLValueString($_POST['Positions'], "text"),
                       GetSQLValueString($_POST['Location'], "text"),
                       GetSQLValueString($_POST['Details'], "text"));

  mysql_select_db($database_busybee, $busybee);
  $Result1 = mysql_query($insertSQL, $busybee) or die(mysql_error());

  $insertGoTo = "Jobseeker_Homepage.php#popup4";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}



if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form7")) {
  $updateSQL = sprintf("UPDATE jobseeker SET First_Name=%s, Last_Name=%s, DoB=%s, Gender=%s, Jobseeker_PhoneNumber=%s, Jobseeker_Address=%s, City=%s, `State`=%s, Post_Code=%s, Country=%s, Nationality=%s, About_Me=%s WHERE Jobseeker_ID=%s",
                       GetSQLValueString($_POST['First_Name'], "text"),
                       GetSQLValueString($_POST['Last_Name'], "text"),
                       GetSQLValueString($_POST['DoB'], "date"),
                       GetSQLValueString($_POST['Gender'], "text"),
                       GetSQLValueString($_POST['Jobseeker_PhoneNumber'], "text"),
                       GetSQLValueString($_POST['Jobseeker_Address'], "text"),
                       GetSQLValueString($_POST['City'], "text"),
                       GetSQLValueString($_POST['State'], "text"),
                       GetSQLValueString($_POST['Post_Code'], "int"),
                       GetSQLValueString($_POST['Country'], "text"),
                       GetSQLValueString($_POST['Nationality'], "text"),
                       GetSQLValueString($_POST['About_Me'], "text"),
                       GetSQLValueString($_POST['Jobseeker_ID'], "int"));

  mysql_select_db($database_busybee, $busybee);
  $Result1 = mysql_query($updateSQL, $busybee) or die(mysql_error());

  $updateGoTo = "Jobseeker_Homepage.php#popup1";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
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
if (isset($_GET['id'])) {
  $colname_Recordset2 = $_GET['id'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset2 = sprintf("SELECT * FROM education_level WHERE Education_ID = %s", GetSQLValueString($colname_Recordset2, "text"));
$Recordset2 = mysql_query($query_Recordset2, $busybee) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$colname_Recordset3 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset3 = $_GET['id'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset3 = sprintf("SELECT * FROM jobseeker_experiences WHERE Experience_ID = %s", GetSQLValueString($colname_Recordset3, "int"));
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
	<title>Jobseeker's Insert Profile</title>
	 
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
    </style>
</head>

<body>	
	<div class="preloader"></div>
	
    	
<main id="top" class="masthead" role="main">
  <div class="container">
			<div class="logo"><img class="logotitle" src="images/BusyBee.png" alt="logo"></a>
			</div>
 
	<h1 class= "fontstyle" >Welcome<strong> <?php echo $row_Recordset1['Username']; ?>!<br>
	</h1>
 
			<div class="row"></div>
  </div>
	</main>
 

<main class="footercta" role="main">    	
<div class="container" id="explore">
	  <section class="row heroimg breath">
		  <div class="col-md-12 text-center"><div id="cssmenu">
<ul>
   <li class='active'><a href='#'>Home</a></li>
   <li><a href='#'>Jobs</a></li>
   <li><a href='#'>Profile</a></li>
   <li><a href='<?php echo $logoutAction ?>'>LOGOUT</a></li>
</ul>
</div></div>
	  </section></div></main>
   <div class="container" id="explore">
		<div class="section-title">
 
			<div class="section-title" id="stay">
				<h2>Steps to be a Jobseeker! </h2>
				<h4>No contract. No risk. No credit card required. </h4>
				<h4>Be ready to be Hired!</h4>
			</div>
			<section class="row breath planpricing">
            
			   <div class="col-md-employer" style="float:none; margin: auto;">
			    <div class="pricing color1  boxheight fontstyle1">
			      <div class="planname">
			        <div align="center">upload your picture</div>
		          </div>
			      <div class="price">
			        <div align="center"><span class="curr"> picture</span><span class="per"></span></div>
		          </div>
			      <div class="billing">
			        <p align="center">Company Information</p>
		          </div>
			      <div align="center">
			        <input type="submit" name="btnupdate2" class="btn btn-success btn-lg buttonstyle" onclick="window.location.href='#popup1'" id="btnupdate2" value="Submit">
		          </div>
		        </div>
		      </div>
			  <p>&nbsp;</p>
			  <div  id= "stay" class="col-md-4">
				  <div class="pricing color1  boxheight fontstyle1">
						<div class="planname">Step 1</div>
						<div class="price"> <span class="curr">Personal Details</span><span class="per"></span></div>
						<div class="billing">
						  <p>Basic Information</p>
						</div>
			     
			            <input type="submit" name="btnupdate" class="btn btn-success btn-lg buttonstyle" onclick="window.location.href='#popup1'" id="btnupdate" value="Submit">
	            </div>
		  </div>
				
				<div id= "stay" class="col-md-4">
					<div class="pricing color2 boxheight fontstyle1">
						<div class="planname">Step 2</div>
						<div class="price"> <span class="curr">Education </span><span class="per"></span></div>
						<div class="billing">
						  <p>Education Details						</p>
						</div>
                        
                      <p>
                        <input type="submit" name="btnupdate" class="btn btn-success btn-lg buttonstyle" onclick="window.location.href='#popup2'" id="btnupdate" value="Submit">
                      </p>
					</div>
				</div>
				
				<div class="col-md-4">
					<div class="pricing color3 boxheight fontstyle1">
						<div class="planname">Step 3	</div>
						<div class="price"><span class="curr">Job Matching</span><span class="per"></span></div>                        
						<div class="billing">
						  <p>Job matching details</p>
						</div>
                        
                      <input type="submit" name="btnupdate" class="btn btn-success btn-lg buttonstyle" onclick="window.location.href='#popup3'" id="btnupdate" value="Submit">
					</div>
				</div>
                
                <div class="col-md-4">
					<div class="pricing color4 boxheight fontstyle1">
						<div class="planname">Step 4</div>
						<div class="price"> <span class="curr"> Professional Experiences</span><span class="per"></span></div>
						<div class="billing">
						  <p>Working experiences</p></div>
                        
                        <p>
                          <input type="submit" name="btnupdate" class="btn btn-success btn-lg buttonstyle" onclick="window.location.href='#popup4'" id="btnupdate" value="Submit">
                        </p>
					</div>
				</div>
                <p>&nbsp;</p>
                       
                <p></p>	
                <a href="Jobseeker_Homepage.php" class="btn btn-success btn-lg gototop buttonstyle">VIEW NOW!</a>
          <section class="row faq breath"></section>
 
</div></div>
          			<div class="col-md-12 footerlinks footercta" role="main">
					<p>&copy; 2016 BusyBee.co. All Rights Reserved</p>
			</div>
 
 
 
 
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/easing.js"></script>
<script src="js/nicescroll.js"></script>
 
 
<script>


 $(function() {
    $('.scrollto, .gototop').bind('click',function(event){
		 var $anchor = $(this);
		 $('html, body').stop().animate({
         scrollTop: $($anchor.attr('href')).offset().top
          }, 1500,'easeInOutExpo');
     event.preventDefault();
      });
  });
        

</script>

        <div id="popup1" class="overlay">
	<div class="popup">
		<h2 align="center">Personal Informations</h2>
		<a class="close" href="Jobseeker_Homepage.php#stay1">&times;</a>
		<div class="content">
			<form action="<?php echo $editFormAction; ?>" method="POST" name="form7" id="form7">
  <table width="462" height="436" align="center">
    <tr valign="baseline">
      <td width="195" align="right" nowrap="nowrap">First Name:</td>
      <td width="255"><input type="text"  placeholder="Eg. John, Albert, etc"name="First_Name" class="textfield" required style="color:#000;" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Last Name:</td>
      <td><input type="text" name="Last_Name" placeholder="Eg. Wick, Ng, etc" class="textfield" required style="color:#000;" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Date of Birth:</td>
      <td><input type="date" required name="DoB" style="color:#000;" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Gender:</td>
      <td valign="baseline"><table>
        <tr>
          <td><input type="radio" name="Gender" required value="Male"/>
            Male</td>
        </tr>
        <tr>
          <td><input type="radio" name="Gender" required value="Female"/>
            Female</td>
        </tr>
      </table></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Phone Number:</td>
      <td><input type="text" name="Jobseeker_PhoneNumber" placeholder="Eg. +60123456789"class="textfield" required style="color:#000;" value="" size="32" /></td>
    </tr>
     <tr valign="baseline">
      <td nowrap="nowrap" align="right">Address:</td>
      <td><input type="text" placeholder="Eg. No1, Taman ABC, Jalan ABC" name="Jobseeker_Address" class="textfield" required style="color:#000;" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">City:</td>
      <td><p>
        <input type="text" placeholder="Eg. Petaling Jaya, Puchong, etc " name="City" class="textfield" required style="color:#000;" value="" size="32" />
      </p></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">State:</td>
      <td><input type="text" placeholder="Eg. Johor, Selangor, etc" name="State" class="textfield" required style="color:#000;" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Post_Code:</td>
      <td><input type="text" name="Post_Code" placeholder="Eg. 47810, 84300, etc" class="textfield" required style="color:#000;" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Country:</td>
      <td><input type="text" placeholder="Eg. Malaysia, England, Singapore, etc" name="Country" required style="color:#000;" class="textfield" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nationality:</td>
      <td><input type="text" placeholder="Eg. Malaysian, Singaporean, etc" name="Nationality" class="textfield" required style="color:#000;" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">About Me:</td>
      <td><input type="text" name="About_Me" style="color:#000;" class="textfield" value="" size="32" /></td>
    </tr>
   
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" class="btn btn-success btn-lg buttonstyle" value="Add Details" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form7" />
  <input type="hidden" name="Jobseeker_ID" value="<?php echo $row_Recordset1['Jobseeker_ID']; ?>" />
</form>
		</div>
	</div></div>
   <div id="popup2" class="overlay">
	<div class="popup">
		<h2 align="center">Education Details</h2>
		<a class="close" href="Jobseeker_Homepage.php#stay1">&times;</a>
		<div class="content">
			<form action="<?php echo $editFormAction; ?>" method="POST" name="form2" id="form2">
    <table width="375" height="314" align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right">Education Level:</div></td>
      <td><select name="Education_Level" required>
        <option value="Completing High School" <?php if (!(strcmp("Completing High School", ""))) {echo "SELECTED";} ?>>Completing High School</option>
        <option value="Completed High School" <?php if (!(strcmp("Completed High School", ""))) {echo "SELECTED";} ?>>Completed High School</option>
        <option value="Completing Degree/Diploma" <?php if (!(strcmp("Completing Degree/Diploma", ""))) {echo "SELECTED";} ?>>Completing Degree/Diploma</option>
        <option value="Completed Degree/Diploma" <?php if (!(strcmp("Completed Degree/Diploma", ""))) {echo "SELECTED";} ?>>Completed Degree/Diploma</option>
        <option value="Completing Postgraduate" <?php if (!(strcmp("Completing Postgraduate", ""))) {echo "SELECTED";} ?>>Completing Postgraduate</option>
        <option value="Completed Postgraduate" <?php if (!(strcmp("Completed Postgraduate", ""))) {echo "SELECTED";} ?>>Completed Postgraduate</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right">Institution Name:</div></td>
      <td><input type="text" name="Institution_Name" placeholder="Eg. SEGi University, Multimedia University, etc" style="color:#000;" class="textfield" required value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right"> From Year:</div></td>
      <td><input type="text" name="Year1" style="color:#000;" class="textfield" required value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right">To Year:</div></td>
      <td><input type="text" name="Year2" style="color:#000;" class="textfield" required value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right">Course Name:</div></td>
      <td><input type="text" placeholder="Eg. Bachelor in Information Technology" name="Course_Name" required style="color:#000;" class="textfield" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="center">Main Languages:</div></td>
      <td valign="baseline"><table>
        <tr>
          <td><input type="radio" name="Languages" required value="English" />
            English</td>
        </tr>
        <tr>
          <td><input type="radio" name="Languages" required value="Bahasa Malaysia" />
            Bahasa Malaysia</td>
        </tr>
        <tr>
          <td><input type="radio" name="Languages" required value="Mandarin" />
            Mandarin</td>
        </tr>
      </table></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" class="btn btn-success btn-lg buttonstyle"value="Add Education " /></td>
    </tr>
  </table>
   <input type="hidden" name="Jobseeker_ID" value="<?php echo htmlentities($row_Recordset1['Jobseeker_ID'], ENT_COMPAT, 'utf-8'); ?>" />
   <input type="hidden" name="MM_insert" value="form2">
          </form>
		</div>
	</div></div>
     <div id="popup3" class="overlay">
	<div class="popup">
		<h2 align="center">Job Details</h2>
		<a class="close" href="Jobseeker_Homepage.php#stay1">&times;</a>
		<div class="content"><form action="<?php echo $editFormAction; ?>" method="POST" name="form3" id="form3">
  <table width="378" height="218" align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Job Role:</td>
      <td><input type="text" placeholder="Eg. Web Developer, etc" name="Job_Role" class="textfield" required style="color:#000;" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Skills &amp; Certificate:</td>
      <td><input type="text" placeholder="Eg. Java, PHP, MySQL, etc" name="Skills_Certificate" class="textfield" required style="color:#000;" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Type of Employment:</td>
      <td><select name="Type_Of_Employment" required>
        <option value="Full Time" <?php if (!(strcmp("Full Time", htmlentities($row_Recordset1['Type_Of_Employment'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Full Time</option>
        <option value="Part Time" <?php if (!(strcmp("Part Time", htmlentities($row_Recordset1['Type_Of_Employment'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Part Time</option>
        <option value="Internship" <?php if (!(strcmp("Internship", htmlentities($row_Recordset1['Type_Of_Employment'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Internship</option>
        <option value="Volunteer" <?php if (!(strcmp("Volunteer", htmlentities($row_Recordset1['Type_Of_Employment'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Volunteer</option>
        <option value="Freelance" <?php if (!(strcmp("Freelance", htmlentities($row_Recordset1['Type_Of_Employment'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Freelance</option>
        <option value="Fresh Graduate" <?php if (!(strcmp("Fresh Graduate", htmlentities($row_Recordset1['Type_Of_Employment'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Fresh Graduate</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td height="41" align="right" nowrap="nowrap">Salary:</td>
      <td><input type="text" placeholder="Eg. 1,000, 1,500, etc" name="Salary" class="textfield" required style="color:#000;" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td height="60" align="right" nowrap="nowrap">&nbsp;</td>
      <td><input type="submit" class="btn btn-success btn-lg buttonstyle" value="Add Details" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form3" />
  <input type="hidden" name="Jobseeker_ID" value="<?php echo $row_Recordset1['Jobseeker_ID']; ?>" />
		</form>
		</div>
	</div></div>
     <div id="popup4" class="overlay">
	<div class="popup">
		<h2 align="center">Experiences</h2>
		<a class="close" href="Jobseeker_Homepage.php#stay1">&times;</a>
		<div class="content">
			<form action="<?php echo $editFormAction; ?>" method="POST" name="form6" id="form6">
  <table width="361" height="240" align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Previous Company:</td>
      <td><input type="text" placeholder="Eg. Abc Sdn bhd" name="Ex_Company" class="textfield" required style="color:#000;" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Year Experiences:</td>
      <td><input type="text" placeholder="Eg. 6 years, etc" name="Ex_Year" class="textfield" required style="color:#000;" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Working Positions:</td>
      <td><input type="text" placeholder="Eg. IT Admin, Clerk, etc" name="Positions" class="textfield" required style="color:#000;" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Working Location:</td>
      <td><input type="text" placeholder="Eg. Selangor, Cyberjaya, etc" name="Location" class="textfield" required style="color:#000;" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Details:</td>
      <td><input type="text" name="Details" style="color:#000;" class="textfield" required value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"></td>
      <td><input type="submit" class="btn btn-success btn-lg buttonstyle"value="Add Experiences" /></td>
    </tr>
  </table
  ><input type="hidden" name="Experience_ID" value="" />
  <input type="hidden" name="Jobseeker_ID" value="<?php echo htmlentities($row_Recordset1['Jobseeker_ID'], ENT_COMPAT, 'utf-8'); ?>" />
  <input type="hidden" name="MM_insert" value="form6" />
</form>
		</div>
	</div>
	<p>&nbsp;</p>
    </div>
 
</body>
</html>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  
  <script>
  $(function() {
    $( "#from" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#to" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });
  </script>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
?>
