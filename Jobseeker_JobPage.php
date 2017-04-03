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
  $FormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form10")) {
  $insertSQL = sprintf("INSERT INTO applyjob (Job_ID, Jobseeker_ID, Employer_ID, Apply_Date, `Time`, Expected_Salary) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Job_ID'], "int"),
                       GetSQLValueString($_POST['Jobseeker_ID'], "int"),
                       GetSQLValueString($_POST['Employer_ID'], "int"),
                       GetSQLValueString($_POST['Apply_Date'], "date"),
                       GetSQLValueString($_POST['Time'], "date"),
                       GetSQLValueString($_POST['Expected_Salary'], "double"));

  mysql_select_db($database_busybee, $busybee);
  $Result1 = mysql_query($insertSQL, $busybee) or die(mysql_error());
	$id=$_POST['Jobseeker_ID'];
	$jid=$_POST['Job_ID'];
    $insertGoTo ="Jobseeker_ApplyVerification.php?id=$id&Job_ID=$jid";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
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
	<title>Jobseeker Job Page</title>
	 
	<link href="css/bootstrap.css" rel="stylesheet">
	 
	<link href="css/main.css" rel="stylesheet">
 
	
 
	<link rel="shortcut icon" href="images\Icons\Batch-master\PNG\32x32\home-3.png">
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
		    <h2 align="center"> View any jobs you desire!</h2>
		  </div>
		  <p>&nbsp;</p>
			  <div class="col-md-box" style="margin:auto; position:relative;">
			    <div class="boxheight fontcolor2">
			      <div class="content">
                        
                    <div align="center">
                        <h3>List of Jobs Available</h3>
                    </div>
                      <?php do { ?>
                      <table class="tablecolor" style="margin-top:40px;" align="center" width="889" height="262" border="1">
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
                          <td><?php echo $row_Recordset2['Job_Description']; ?></td>
                          <td>Conditions:</td>
                          <td><?php echo $row_Recordset2['Conditions']; ?></td>
                        </tr>
                        <tr>
                          <td>Benefits: </td>
                          <td colspan="3"><?php echo $row_Recordset2['Benefits']; ?></td>
                        </tr>
                      </table>
                      <form name="form10" id="form10" type="submit" method="POST" action="<?php echo $editFormAction; ?>">
                      <input type="hidden" name="Job_ID" value="<?php echo $row_Recordset2['Job_ID']; ?>">
                      <input type="hidden" name="Apply_Date" value="<?php     echo date('Y-m-d');
 ?>">
                      <input type="hidden" name="Jobseeker_ID" value="<?php echo $row_Recordset1['Jobseeker_ID']; ?>">
                      <input type="hidden" name="Employer_ID" value="<?php echo $row_Recordset2['Employer_ID']; ?>">
                      <input type="hidden" name="Time" value="<?php
					  date_default_timezone_set("Asia/Kuala_Lumpur");     echo date("h:i:s");
 ?>">
                      <input type="hidden" name="Apply_Details" value="">
                      <input type="hidden" name="Expected_Salary" value="<?php echo $row_Recordset1['Salary']; ?>">
                      
                      <input type="submit" name="btnupdate" style="margin:20px 91px 20px 222px; display:inline-block; float:left;" class="btn btn-success btn-lg buttonstyle  fontstyle2" id="btnupdate" value="Apply">
                      <input type="hidden" name="MM_insert" value="form10">
                      </form>
                      <form name="form1" method="post" action="javascript: void(0)" onclick="window.open('Jobseeker_ViewEmployer.php?ID=<?php echo $row_Recordset2['Employer_ID']; ?>', 
  'windowname1', 
  'width=auto, height=auto'); 
   return false;">
                      <input type="submit" name="btnupdate" style="margin:20px 0px 20px 91px; display:inline-block; float:left;" class="btn btn-success btn-lg buttonstyle  fontstyle2" onclick="" id="btnupdate" value=" Company's Profile">
                      </form>
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
     </div>
          			<div class="col-md-12 footerlinks footercta" role="main">
					<p>&copy; 2016 BusyBee.co. All Rights Reserved</p>
			</div>

<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
