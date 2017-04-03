
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

$currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO postjob (Job_ID, Employer_ID, `Date`, Time_Post, Job_Description, Job_Salary, Job_Title, TypeOfEmployment, Job_Category, Education_Level, Languages, Benefits, Conditions) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Job_ID'], "int"),
                       GetSQLValueString($_POST['Employer_ID'], "int"),
                       GetSQLValueString($_POST['Date'], "date"),
                       GetSQLValueString($_POST['Time_Post'], "date"),
                       GetSQLValueString($_POST['Job_Description'], "text"),
                       GetSQLValueString($_POST['Job_Salary'], "double"),
                       GetSQLValueString($_POST['Job_Title'], "text"),
                       GetSQLValueString($_POST['TypeOfEmployment'], "text"),
                       GetSQLValueString($_POST['Job_Category'], "text"),
                       GetSQLValueString($_POST['Education_Level'], "text"),
                       GetSQLValueString($_POST['Languages'], "text"),
                       GetSQLValueString($_POST['Benefits'], "text"),
                       GetSQLValueString($_POST['Conditions'], "text"));

  mysql_select_db($database_busybee, $busybee);
  $Result1 = mysql_query($insertSQL, $busybee) or die(mysql_error());

  $insertGoTo = "Employer_JobPage.php#stay1";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "";
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

$maxRows_Recordset2 = 10;
$pageNum_Recordset2 = 0;
if (isset($_GET['pageNum_Recordset2'])) {
  $pageNum_Recordset2 = $_GET['pageNum_Recordset2'];
}
$startRow_Recordset2 = $pageNum_Recordset2 * $maxRows_Recordset2;

mysql_select_db($database_busybee, $busybee);
$query_Recordset2 = "SELECT * FROM postjob";
$query_limit_Recordset2 = sprintf("%s LIMIT %d, %d", $query_Recordset2, $startRow_Recordset2, $maxRows_Recordset2);
$Recordset2 = mysql_query($query_limit_Recordset2, $busybee) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);

if (isset($_GET['totalRows_Recordset2'])) {
  $totalRows_Recordset2 = $_GET['totalRows_Recordset2'];
} else {
  $all_Recordset2 = mysql_query($query_Recordset2);
  $totalRows_Recordset2 = mysql_num_rows($all_Recordset2);
}
$totalPages_Recordset2 = ceil($totalRows_Recordset2/$maxRows_Recordset2)-1;

$queryString_Recordset2 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset2") == false && 
        stristr($param, "totalRows_Recordset2") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset2 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset2 = sprintf("&totalRows_Recordset2=%d%s", $totalRows_Recordset2, $queryString_Recordset2);
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
	<title>Employer's Job Page</title>
	 
	<link href="css/bootstrap.css" rel="stylesheet">
	 
	<link href="css/main.css" rel="stylesheet">
 
	
 
	<link rel="shortcut icon" href="images\Icons\Batch-master\PNG\32x32\terminal.png">
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
      <?php
	  if($row_Recordset1['Employer_Status'] == 'VERIFIED'){?>
	  
   <div class="container" id="explore">
	 <div class="section-title">
		  <div class="content">
		    <h2 align="center"> View any jobs you desire!</h2>
		  </div>
		  <p>&nbsp;</p>
			  <div class="col-md-box" style="margin:auto; position:relative;">
			    <div class="boxheight fontcolor2">
				    <div class="content" id="stay1">
                        
                      <div align="right">
                        <h3><input type="submit" name="btnupdate" class="btn btn-success btn-lg buttonstyle  fontstyle2" onclick="window.location.href='#popup1'" id="btnupdate" value="Advertise Job"></h3>
                      </div>
                    </div> 
                    <div class="content">
                        
                      <div align="center">
                        <h3>List of Jobs Available</h3>
                      </div>
                      <?php do { ?>
                      <table class="tablecolor" style="margin-top:30px;" align="center" width="889" height="262" border="1">
                        <tr>
                          <td align="center" colspan="3"><h3><?php echo $row_Recordset2['Job_Title']; ?></h3></td>
                          <td width="245">Date Posted: <?php echo $row_Recordset2['Time_Post']; ?></td>
                        </tr>
                        <tr>
                          <td width="135">Job Availability:</td>
                          <td width="220"><?php echo $row_Recordset2['Date']; ?></td>
                          <td width="168">Type of Employment: </td>
                          <td><?php echo $row_Recordset2['TypeOfEmployment']; ?></td>
                        </tr>
                        <tr>
                          <td height="28">Vacancy Position: </td>
                          <td><?php echo $row_Recordset2['Job_Category']; ?></td>
                          <td>Required Education:</td>
                          <td><?php echo $row_Recordset2['Education_Level']; ?></td>
                        </tr>
                        <tr>
                          <td>Job Salary: </td>
                          <td><?php echo $row_Recordset2['Job_Salary']; ?></td>
                          <td>Required Langauge(s): </td>
                          <td><?php echo $row_Recordset2['Languages']; ?></td>
                        </tr>
                        <tr>
                          <td>Job Description: </td>
                          <td style="padding:10px;"><?php echo $row_Recordset2['Job_Description']; ?></td>
                          <td>Conditions:</td>
                          <td><?php echo $row_Recordset2['Conditions']; ?></td>
                        </tr>
                        <tr>
                          <td>Benefits: </td>
                          <td colspan="3" style="padding:10px;"><?php echo $row_Recordset2['Benefits']; ?></td>
                        </tr>
                      </table>
                        <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
                    </div></div>
			    <div class="content"></div> 
                 <table border="0" align="center" style="width:800px; margin:30px;">
                <tr>
                  <td><?php if ($pageNum_Recordset2 > 0) { // Show if not first page ?>
                      <a href="<?php printf("%s?pageNum_Recordset2=%d%s", $currentPage, 0, $queryString_Recordset2); ?>"><img src="First.gif"></a>
                  <?php } // Show if not first page ?></td>
                  <td><?php if ($pageNum_Recordset2 > 0) { // Show if not first page ?>
                      <a href="<?php printf("%s?pageNum_Recordset2=%d%s", $currentPage, max(0, $pageNum_Recordset2 - 1), $queryString_Recordset2); ?>"><img src="Previous.gif"></a>
                  <?php } // Show if not first page ?></td>
                  <td><?php if ($pageNum_Recordset2 < $totalPages_Recordset2) { // Show if not last page ?>
                      <a href="<?php printf("%s?pageNum_Recordset2=%d%s", $currentPage, min($totalPages_Recordset2, $pageNum_Recordset2 + 1), $queryString_Recordset2); ?>"><img src="Next.gif"></a>
                  <?php } // Show if not last page ?></td>
                  <td><?php if ($pageNum_Recordset2 < $totalPages_Recordset2) { // Show if not last page ?>
                      <a href="<?php printf("%s?pageNum_Recordset2=%d%s", $currentPage, $totalPages_Recordset2, $queryString_Recordset2); ?>"><img src="Last.gif"></a>
                  <?php } // Show if not last page ?></td>
                </tr>
              </table>
     </div>
              
     </div>
  
   </div><?php ;} else {?><h1 align="center">Please Wait for Verification</h1><?php if(!$row_Recordset1['SSM_No']==""){?><h2 align="center">Your account is now under verifying by Admin. Please have patience. If you have any enquiries, please do not hestitate to contact us at jcms5055@gmail.com.</h2><?php ;}else{?><h2 align="center">Please insert your SSM number at the Profile page.</h2><?php ;}}?>
   </div>
<div class="col-md-12 footerlinks footercta" role="main">
					<p style="text-shadow: 2px 2px #000;">&copy; 2016 BusyBee.co. All Rights Reserved</p>
			</div>
            <div id="popup1" class="overlay">
	<div class="popup" style="height:85%;">
		<h2 align="center">Advertise Job</h2>
		<div align="center"><a class="close" href="Employer_JobPage.php#stay1">&times;</a>
	  </div>
		<div class="content">
          <div align="center">
           <form action="<?php echo $editFormAction; ?>" method="POST" name="form1" id="form1">
  <table width="469" height="742" align="center">
    <tr valign="baseline">
      <td height="37" align="right" nowrap="nowrap">Job Title:</td>
      <td><input type="text" placeholder="Eg. IT Admin Vacancy" class="textfield" name="Job_Title" style="color:#000;" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td width="180" height="37" align="right" nowrap="nowrap">Job Availability:</td>
      <td width="427"><input type="date" class="textfield" style="color:#000;" name="Date" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td height="34" align="right" nowrap="nowrap">Time Job Posted:</td>
      <td><input type="hidden" class="textfield" name="Time_Post" value=" <?php echo date("Y-m-d") ?>" size="32" />  <?php echo date("Y-m-d") ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" style="vertical-align:top; " >Job Description:</td>
      <td><textarea placeholder="Eg. Details of job skills, etc" class="textfield" style="color:#000;" name="Job_Description" cols="32" rows="5"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td height="34" align="right" nowrap="nowrap">Job Salary:</td>
      <td><input type="text" placeholder="Eg. 1000, 1500, etc" class="textfield" style="color:#000;" name="Job_Salary" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td height="32" align="right" nowrap="nowrap">Type of Employment:</td>
      <td><select name="TypeOfEmployment">
        <option value="Full Time" <?php if (!(strcmp("Full Time", ""))) {echo "SELECTED";} ?>>Full Time</option>
        <option value="Part Time" <?php if (!(strcmp("Part Time", ""))) {echo "SELECTED";} ?>>Part Time</option>
        <option value="Internship" <?php if (!(strcmp("Internship", ""))) {echo "SELECTED";} ?>>Internship</option>
        <option value="Volunteer" <?php if (!(strcmp("Volunteer", ""))) {echo "SELECTED";} ?>>Volunteer</option>
        <option value="Freelance" <?php if (!(strcmp("Freelance", ""))) {echo "SELECTED";} ?>>Freelance</option>
        <option value="Fresh Graduate" <?php if (!(strcmp("Fresh Graduate", ""))) {echo "SELECTED";} ?>>Fresh Graduate</option>
        </select></td>
    </tr>
    <tr valign="baseline">
      <td height="33" align="right" nowrap="nowrap">Job Position:</td>
      <td><input type="text" placeholder="Eg. Business Accountant, IT Admin, etc" class="textfield" style="color:#000;" name="Job_Category" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td height="32" align="right" nowrap="nowrap">Required Education:</td>
      <td><input type="text" placeholder="Eg. Degree, PHD, etc" class="textfield" name="Education_Level" style="color:#000;" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td height="33" align="right" nowrap="nowrap">Languages:</td>
      <td><input type="text" placeholder="Eg. English, Mandarin, etc" class="textfield" name="Languages" style="color:#000;" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" style="vertical-align:top;" >Benefits:</td>
      <td><textarea placeholder="Eg. Benefits of working" class="textfield" name="Benefits" style="color:#000;" cols="32" rows="5"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td height="120" align="right" nowrap="nowrap" style="vertical-align:top;">Conditions:</td>
      <td><textarea placeholder="Eg. Requirements of job vacancy." class="textfield" name="Conditions" style="color:#000;" cols="32" rows="5"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" class="btn btn-success btn-lg buttonstyle  fontstyle2" value="Post Job" /></td>
    </tr>
  </table>
  <input type="hidden" name="Job_ID" value="" />
  <input type="hidden" name="Employer_ID" value="<?php echo $row_Recordset1['Employer_ID']; ?>" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
          </div>
	    </div>
</div></div>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
