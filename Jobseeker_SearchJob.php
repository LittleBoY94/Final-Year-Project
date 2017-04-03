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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form10")) {
  $insertSQL = sprintf("INSERT INTO applyjob (Job_ID, Jobseeker_ID, Employer_ID, Apply_Date, `Time`, Apply_Details, Expected_Salary) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Job_ID'], "int"),
                       GetSQLValueString($_POST['Jobseeker_ID'], "int"),
                       GetSQLValueString($_POST['Employer_ID'], "int"),
                       GetSQLValueString($_POST['Apply_Date'], "date"),
                       GetSQLValueString($_POST['Time'], "date"),
                       GetSQLValueString($_POST['Apply_Details'], "text"),
                       GetSQLValueString($_POST['Expected_Salary'], "double"));

  mysql_select_db($database_busybee, $busybee);
  $Result1 = mysql_query($insertSQL, $busybee) or die(mysql_error());

   echo $insertGoTo = '<script language="javascript">;
alert("You have successfully apply the job.");
window.location.href = "Jobseeker_SearchJob.php#explore";
</script>';
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

$colname_Recordset2 = "-1";
if (isset($_POST['txtsearch'])) {
  $colname_Recordset2 = $_POST['txtsearch'];
}
$colname1_Recordset2 = "-1";
if (isset($_GET['txtsearch'])) {
  $colname1_Recordset2 = $_GET['txtsearch'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset2 = sprintf("SELECT * FROM postjob WHERE Job_Salary LIKE %s OR Job_Title LIKE %s OR TypeOfEmployment LIKE %s OR Job_Category LIKE %s OR Education_Level LIKE %s OR Languages LIKE %s OR Job_Salary LIKE %s OR Job_Title LIKE %s OR TypeOfEmployment LIKE %s OR Job_Category LIKE %s OR Education_Level LIKE %s OR Languages LIKE %s ", GetSQLValueString("%" . $colname_Recordset2 . "%", "text"),GetSQLValueString("%" . $colname_Recordset2 . "%", "text"),GetSQLValueString("%" . $colname_Recordset2 . "%", "text"),GetSQLValueString("%" . $colname_Recordset2 . "%", "text"),GetSQLValueString("%" . $colname_Recordset2 . "%", "text"),GetSQLValueString("%" . $colname_Recordset2 . "%", "text"),GetSQLValueString("%" . $colname1_Recordset2 . "%", "text"),GetSQLValueString("%" . $colname1_Recordset2 . "%", "text"),GetSQLValueString("%" . $colname1_Recordset2 . "%", "text"),GetSQLValueString("%" . $colname1_Recordset2 . "%", "text"),GetSQLValueString("%" . $colname1_Recordset2 . "%", "text"),GetSQLValueString("%" . $colname1_Recordset2 . "%", "text"));
$Recordset2 = mysql_query($query_Recordset2, $busybee) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_busybee, $busybee);
$query_Recordset3 = "SELECT * FROM postjob";
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
	<title>Jobseeker Search Job</title>
	 
	<link href="css/bootstrap.css" rel="stylesheet">
	 
	<link href="css/main.css" rel="stylesheet">
 
	
 
	<link rel="shortcut icon" href="images\Icons\Batch-master\PNG\32x32\search.png">
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
 
			<div class="row"><h1 class= "fontstyle" style="text-shadow: 2px 2px #000;">
    <strong><?php echo $row_Recordset1['Username']; ?></div>
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
		    <h2 align="center"> View any Jobs you desire!</h2>
	      </div>
		  <p>&nbsp;</p>
			  <div class="col-md-box" style="margin:auto; position:relative;">
			    <div class="boxheight fontcolor2">
                
			      <div class="content">
                        
                    <div align="center">
                        <form action="Jobseeker_SearchJob.php" method="post" name="searchform">
                          <label for="txtsearch"></label>
                          <input type="text" style="margin:10px" name="txtsearch" id="txtsearch">
                          <input type="submit" style="margin:10px;" class="btn btn-success btn-lg buttonstyle" name="btnsearch" id="btnsearch" value="Search Again">
                        </form>
                        
                    </div>
                  </div> 
                     <div class="content" style="padding:15px;">
                        
                       <?php do { ?>
                       <div align="center">
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
                      <input type="hidden" name="Job_ID" value="<?php echo $row_Recordset3['Job_ID']; ?>">
                      <input type="hidden" name="Apply_Date" value="<?php     echo date('Y-m-d');
 ?>">
                      <input type="hidden" name="Jobseeker_ID" value="<?php echo $row_Recordset1['Jobseeker_ID']; ?>">
                      <input type="hidden" name="Employer_ID" value="<?php echo $row_Recordset3['Employer_ID']; ?>">
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
   return false;"  style="margin:20px 0px 20px 91px; display:inline-block; float:left;">
                           <input type="submit" class="btn btn-success btn-lg buttonstyle"  name="btnview" id="btnview" value="View Profile" >
                         </form>
                       </div>
                         <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
                    </div></div>
			    <div class="content"></div> 
                
     </div>
     
</div>
<p>&nbsp;</p>
</div></div>
          			<div class="col-md-12 footerlinks footercta" role="main">
					<p style="text-shadow: 2px 2px #000;">&copy; 2016 BusyBee.co. All Rights Reserved</p>
			</div>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
?>
