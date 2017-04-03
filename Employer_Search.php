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

$colname_Recordset2 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset2 = $_SESSION['MM_Username'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset2 = sprintf("SELECT * FROM employer WHERE Username = %s", GetSQLValueString($colname_Recordset2, "text"));
$Recordset2 = mysql_query($query_Recordset2, $busybee) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

$colname_Recordset1 = "-1";
if (isset($_POST['txtsearch'])) {
  $colname_Recordset1 = $_POST['txtsearch'];
}
$colname1_Recordset1 = "-1";
if (isset($_GET['txtsearch'])) {
  $colname1_Recordset1 = $_GET['txtsearch'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset1 = sprintf("SELECT DISTINCT jobseeker.Jobseeker_ID, jobseeker.First_Name, jobseeker.Last_Name, jobseeker.DoB, jobseeker.Gender, jobseeker.Nationality, jobseeker.Salary, jobseeker.Skills_Certificate, jobseeker.Type_Of_Employment, jobseeker.Job_Role FROM jobseeker right outer join education_level on jobseeker.Jobseeker_ID=education_level.Jobseeker_ID WHERE Skills_Certificate LIKE %s OR Education_Level LIKE %s OR Skills_Certificate LIKE %s OR Education_Level LIKE %s OR Salary LIKE %s OR Type_of_Employment LIKE %s OR Nationality LIKE %s ", GetSQLValueString("%" . $colname_Recordset1 . "%", "text"),GetSQLValueString("%" . $colname_Recordset1 . "%", "text"),GetSQLValueString("%" . $colname1_Recordset1 . "%", "text"),GetSQLValueString("%" . $colname1_Recordset1 . "%", "text"),GetSQLValueString("%" . $colname1_Recordset1 . "%", "text"),GetSQLValueString("%" . $colname1_Recordset1 . "%", "text"),GetSQLValueString("%" . $colname1_Recordset1 . "%", "text"));
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $busybee) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
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
	<title>Employer Search</title>
	 
	<link href="css/bootstrap.css" rel="stylesheet">
	 
	<link href="css/main.css" rel="stylesheet">
 
	
 
	<link rel="shortcut icon" href="images\Icons\Batch-master\PNG\32x32\search-2.png">
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
 
			<div class="row"><h1 class= "fontstyle" style="text-shadow: 2px 2px #000;"><?php echo $row_Recordset2['Username']; ?><strong><br></div>
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
	 <div class="section-title">
		  <div class="content">
		    <h2 align="center"> Search any Jobseekers you desire!</h2>
	      </div>
		  <p>&nbsp;</p>
			  <div class="col-md-box" style="margin:auto; position:relative;">
			    <div class="boxheight fontcolor2">
                
			      <div class="content">
                        
                      <div align="center">
                        <form action="Employer_Search.php" method="post" name="searchform">
                          <label for="txtsearch"></label>
                          <input type="text" style="margin:10px" name="txtsearch" id="txtsearch">
                          <input type="submit" style="margin:10px;" class="btn btn-success btn-lg buttonstyle" name="btnsearch" id="btnsearch" value="Search Again">
                        </form>
                    </div>
                  </div> 
                     <div class="content" style="padding:15px;">
                        
                      <div align="center">
                        <?php do { ?>
                        <table style=" float:left; margin-bottom:10px;" width="705" height="130" border="1">
                          <tr>
                            <td  style="padding-left:10px;" width="143">Name: </td>
                            <td width="189"><?php echo $row_Recordset1['First_Name']; ?> <?php echo $row_Recordset1['Last_Name']; ?></td>
                            <td style="padding-left:10px;" width="119">Date of Birth:</td>
                            <td width="226"><?php echo $row_Recordset1['DoB']; ?></td>
                          </tr>
                          <tr>
                            <td style="padding-left:10px;">Gender:</td>
                            <td><?php echo $row_Recordset1['Gender']; ?></td>
                            <td style="padding-left:10px;">Nationality:</td>
                            <td><?php echo $row_Recordset1['Nationality']; ?></td>
                          </tr>
                          <tr>
                            <td style="padding-left:10px;">Expecting Salary:</td>
                            <td><?php echo $row_Recordset1['Salary']; ?></td>
                            <td style="padding-left:10px;">Looking for:</td>
                            <td><?php echo $row_Recordset1['Type_Of_Employment']; ?></td>
                          </tr>
                          <tr>
                            <td style="padding-left:10px;">Skill &amp; Certificate:</td>
                            <td><?php echo $row_Recordset1['Skills_Certificate']; ?></td>
                            <td style="padding-left:10px;">Seeking Position:</td>
                            <td><?php echo $row_Recordset1['Job_Role']; ?></td>
                          </tr>

                        </table>
                          
                        <form name="form1" method="post" action="javascript: void(0)" onclick="window.open('Employer_ViewJobseeker.php?id=<?php echo $row_Recordset1['Jobseeker_ID']; ?>', 
  'windowname1', 
  'width=auto, height=auto'); 
   return false;" style="margin: 43.5px 0 87px 0; position:relative; top:43.5px;">
                              <input type="submit" class="btn btn-success btn-lg buttonstyle" name="btnview" id="btnview" value="View Profile">
                            </form>
                            <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?> 
                      </div>
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
?>
