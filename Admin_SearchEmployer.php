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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form3")) {
  $updateSQL = sprintf("UPDATE employer SET Employer_Status=%s WHERE Employer_ID=%s",
                       GetSQLValueString($_POST['Employer_Status'], "text"),
                       GetSQLValueString($_POST['Employer_ID'], "int"));

  mysql_select_db($database_busybee, $busybee);
  $Result1 = mysql_query($updateSQL, $busybee) or die(mysql_error());

  $updateGoTo = "Admin_SearchEmployer.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

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
$query_Recordset1 = sprintf("SELECT * FROM admin WHERE Username = %s", GetSQLValueString($colname_Recordset1, "text"));
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
$query_Recordset2 = sprintf("SELECT * FROM employer WHERE Company_Name LIKE %s OR Company_Email LIKE %s OR Hiring_Skills LIKE %s OR Location LIKE %s OR Type_Of_Employment LIKE %s OR  Hiring_Skills LIKE %s OR Location LIKE %s OR Type_Of_Employment LIKE %s ", GetSQLValueString("%" . $colname_Recordset2 . "%", "text"),GetSQLValueString("%" . $colname_Recordset2 . "%", "text"),GetSQLValueString("%" . $colname_Recordset2 . "%", "text"),GetSQLValueString("%" . $colname_Recordset2 . "%", "text"),GetSQLValueString("%" . $colname_Recordset2 . "%", "text"),GetSQLValueString("%" . $colname1_Recordset2 . "%", "text"),GetSQLValueString("%" . $colname1_Recordset2 . "%", "text"),GetSQLValueString("%" . $colname1_Recordset2 . "%", "text"));
$Recordset2 = mysql_query($query_Recordset2, $busybee) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_busybee, $busybee);
$query_Recordset3 = "SELECT * FROM employer";
$Recordset3 = mysql_query($query_Recordset3, $busybee) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);
?>
<?php
if(isset($_POST['sumit']))
{
$id=$_POST['employer_id'];
$sql2 = mysql_query("DELETE FROM employer WHERE Employer_ID=$id")or die(mysql_error());
$sql3 = mysql_query("DELETE FROM postjob WHERE Employer_ID=$id")or die(mysql_error());
}
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
	<title>Admin Search Employer</title>
	 
	<link href="css/bootstrap.css" rel="stylesheet">
	 
	<link href="css/main.css" rel="stylesheet">
 
	
 
	<link rel="shortcut icon" href="images\Icons\Batch-master\PNG\32x32\zoom-in-2.png">
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
   <li class='active'><a href='Admin_HomePage.php'>Home</a></li>
   <li><a href='Admin_MainSearch.php'>Search</a></li>
   <li><a href='Admin_SearchEmployer.php'>Employer</a></li>
   <li><a href='<?php echo $logoutAction ?>'>LOGOUT</a></li>
</ul>
</div></div>
	  </section></div></main>
<div class="container" id="explore">
	 <div class="section-title">
		  <div class="content">
		    <h2 align="center"> List the Employers you desire!</h2>
	      </div>
		  <p>&nbsp;</p>
			  <div class="col-md-box" style="margin:auto; position:relative;">
			    <div class="boxheight fontcolor2">
                
			      <div class="content">
                        
                    <div align="center">
                        <form action="Admin_SearchEmployer.php" method="post" name="searchform">
                          <label for="txtsearch"></label>
                          <input type="text" style="margin:10px" name="txtsearch" id="txtsearch">
                          <input type="submit" style="margin:10px;" class="btn btn-success btn-lg buttonstyle" name="btnsearch" id="btnsearch" value="Search Again">
                        </form>
                        
                    </div>
                  </div> 
                     <div class="content" style="padding:15px;">
                        
                       <?php do { ?>
                       <div align="center">
                         <table style=" float:left; margin-bottom:10px;" width="1030" height="184" border="1">
                           
                             <td style="padding-left:10px;" width="134" height="43.33333333">Company Name:</td>
                             <td style="padding-left:10px;" width="220"><?php echo $row_Recordset2['Company_Name']; ?></td>
                             <td width="139" height="43.33333333" style="padding-left:10px;">Company Email:</td>
                             <td width="238" style="padding-left:10px;"><?php echo $row_Recordset2['Company_Email']; ?></td>
                           </tr>
                           <tr>
                             <td style="padding-left:10px;"height="43.33333333">Employment Interest:</td>
                             <td style="padding-left:10px;"><?php echo $row_Recordset2['Type_of_Employment']; ?></td>
                             <td style="padding-left:10px;">Hiring Skills:</td>
                             <td style="padding-left:10px;"><?php echo $row_Recordset2['Hiring_Skills']; ?></td>
                           </tr>
                           <tr>
                             <td height="43.33333333" style="padding-left:10px;">Location:</td>
                             <td style="padding-left:10px;"><?php echo $row_Recordset2['Location']; ?></td>
                             <td style="padding-left:10px;">Details:</td>
                             <td style="padding-left:10px;"><?php echo $row_Recordset2['Hiring_Details']; ?></td>
                           </tr>
                           <tr>
                             <td height="43.33333333" colspan="2" align="right" style="padding-left:10px; padding-right:5px;">Status:</td>
                             <td colspan="2" style="padding-left:10px;"><?php echo $row_Recordset2['Employer_Status']; ?></td>
                           </tr>
                         </table>
                         <form name="form1" method="post" action="javascript: void(0)" onclick="window.open('Jobseeker_ViewEmployer.php?ID=<?php echo $row_Recordset3['Employer_ID']; ?>', 
  'windowname1', 
  'width=auto, height=auto'); 
   return false;"  style="margin: 10px 10px 5px 300px; position:relative; float:left;">
                           <input type="submit" class="btn btn-success btn-lg buttonstyle"  name="btnview" id="btnview" value="View Profile" >
                         </form>
                       <form name="form222" method="post" action="Admin_SearchEmployer.php" />
                         <input type="hidden" name="employer_id" value="<?php echo $row_Recordset2['Employer_ID']; ?>" >
                         <input type="submit" class="btn btn-success btn-lg buttonstyle" style="display: inline-block; float:left; margin: 10px 0px 30px 10px;" name="sumit" id="btnview" onclick="return confirm('Are you sure want to delete?')" value="Delete">
                         </form>
                         
                       </div>
                       <?php if ($row_Recordset2['Employer_Status'] == "UNVERIFIED"){?>
                         <form method="POST" name="form3" id="form3" action="<?php echo $editFormAction; ?>" >
                         <input type="hidden" name="Employer_Status" value="VERIFIED" />
                         <input type="hidden" name="Employer_ID" value="<?php echo $row_Recordset2['Employer_ID']; ?>" />
                         <input type="submit" class="btn btn-success btn-lg buttonstyle" style="display: inline-block; float:left; margin: 10px 0px 30px 10px;"  name="btnview" id="btnview" value="VERIFIED" >
                         <input type="hidden" name="MM_update" value="form3" />
                         </form>
                         <?php }  else {};?>
                         
                         <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
                    </div>
                    <div align="center"></div></div>
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
