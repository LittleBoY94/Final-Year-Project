<?php require_once('Connections/busybee.php'); ?>
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

$maxRows_Recordset2 = 3;
$pageNum_Recordset2 = 0;
if (isset($_GET['pageNum_Recordset2'])) {
  $pageNum_Recordset2 = $_GET['pageNum_Recordset2'];
}
$startRow_Recordset2 = $pageNum_Recordset2 * $maxRows_Recordset2;

$colname_Recordset2 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset2 = $_SESSION['MM_Username'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset2 = sprintf("SELECT * FROM education_level natural join jobseeker WHERE Username = %s", GetSQLValueString($colname_Recordset2, "int"));
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

$maxRows_Recordset3 = 3;
$pageNum_Recordset3 = 0;
if (isset($_GET['pageNum_Recordset3'])) {
  $pageNum_Recordset3 = $_GET['pageNum_Recordset3'];
}
$startRow_Recordset3 = $pageNum_Recordset3 * $maxRows_Recordset3;

$colname_Recordset3 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset3 = $_SESSION['MM_Username'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset3 = sprintf("SELECT * FROM jobseeker_experiences natural join jobseeker WHERE Username = %s", GetSQLValueString($colname_Recordset3, "int"));
$query_limit_Recordset3 = sprintf("%s LIMIT %d, %d", $query_Recordset3, $startRow_Recordset3, $maxRows_Recordset3);
$Recordset3 = mysql_query($query_limit_Recordset3, $busybee) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);

if (isset($_GET['totalRows_Recordset3'])) {
  $totalRows_Recordset3 = $_GET['totalRows_Recordset3'];
} else {
  $all_Recordset3 = mysql_query($query_Recordset3);
  $totalRows_Recordset3 = mysql_num_rows($all_Recordset3);
}
$totalPages_Recordset3 = ceil($totalRows_Recordset3/$maxRows_Recordset3)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>


<body>
<p><a href="<?php echo $logoutAction ?>">Log Out</a></p>
<p><?php echo $row_Recordset1['Jobseeker_ID']; ?></p>
<p>Basic Information</p>
<table width="319" border="1">
  <tr>
    <td width="176">First Name:</td>
    <td width="127"><?php echo $row_Recordset1['First_Name']; ?></td>
  </tr>
  <tr>
    <td>Last Name:</td>
    <td><?php echo $row_Recordset1['Last_Name']; ?></td>
  </tr>
  <tr>
    <td>Date of Birth:</td>
    <td><?php echo $row_Recordset1['DoB']; ?></td>
  </tr>
  <tr>
    <td>Gender:</td>
    <td><?php echo $row_Recordset1['Gender']; ?></td>
  </tr>
  <tr>
    <td>Email Address: </td>
    <td><?php echo $row_Recordset1['Jobseeker_Email']; ?></td>
  </tr>
  <tr>
    <td>Phone Number:</td>
    <td><?php echo $row_Recordset1['Jobseeker_PhoneNumber']; ?></td>
  </tr>
  <tr>
    <td>Address:</td>
    <td><?php echo $row_Recordset1['Jobseeker_Address']; ?></td>
  </tr>
  <tr>
    <td>City:</td>
    <td><?php echo $row_Recordset1['City']; ?></td>
  </tr>
  <tr>
    <td>State:</td>
    <td><?php echo $row_Recordset1['State']; ?></td>
  </tr>
  <tr>
    <td>Post Code:</td>
    <td><?php echo $row_Recordset1['Post_Code']; ?></td>
  </tr>
  <tr>
    <td>Country:</td>
    <td><?php echo $row_Recordset1['Country']; ?></td>
  </tr>
  <tr>
    <td>Nationality:</td>
    <td><?php echo $row_Recordset1['Nationality']; ?></td>
  </tr>
  <tr>
    <td>About Yourself:</td>
    <td><?php echo $row_Recordset1['About_Me']; ?></td>
  </tr>
</table>
<p>Job Details</p>
<table width="352" border="1">
  <tr>
    <td width="179">Job Role:</td>
    <td width="157"><?php echo $row_Recordset1['Job_Role']; ?></td>
  </tr>
  <tr>
    <td>Skills &amp; Certificate:</td>
    <td><?php echo $row_Recordset1['Skills_Certificate']; ?></td>
  </tr>
  <tr>
    <td>Type of Employment:</td>
    <td><?php echo $row_Recordset1['Type_Of_Employment']; ?></td>
  </tr>
  <tr>
    <td>Salary:</td>
    <td>RM <?php echo $row_Recordset1['Salary']; ?></td>
  </tr>
</table>
<p>Education Details</p>
<p><?php echo $row_Recordset2['Education_ID']; ?> <?php echo $row_Recordset2['Jobseeker_ID']; ?></p>
<?php do { ?>
  <table width="400" height="170" border="1">
    <tr>
      <td width="170">Education Level: </td>
      <td width="199"><?php echo $row_Recordset2['Education_Level']; ?></td>
    </tr>
    <tr>
      <td>Institution Name:</td>
      <td><?php echo $row_Recordset2['Institution_Name']; ?></td>
    </tr>
    <tr>
      <td>From: </td>
      <td><?php echo $row_Recordset2['Year1']; ?> - <?php echo $row_Recordset2['Year2']; ?></td>
    </tr>
    <tr>
      <td>Course Name:</td>
      <td><?php echo $row_Recordset2['Course_Name']; ?></td>
    </tr>
    <tr>
      <td>Main Language Spoken: </td>
      <td><?php echo $row_Recordset2['Languages']; ?></td>
    </tr>
  </table>
  <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
<p>Working Experience</p>
-
<p><?php echo $row_Recordset3['Experience_ID']; ?><?php echo $row_Recordset3['Jobseeker_ID']; ?></p>
<?php do { ?>
  <table width="470" height="180" border="1">
    <tr>
      <td width="178">Previous Company:</td>
      <td width="106"><?php echo $row_Recordset3['Ex_Company']; ?></td>
    </tr>
    <tr>
      <td>Working Duration </td>
      <td><?php echo $row_Recordset3['Ex_Year']; ?></td>
    </tr>
    <tr>
      <td>Working Position:</td>
      <td><?php echo $row_Recordset3['Positions']; ?></td>
    </tr>
    <tr>
      <td>Details:</td>
      <td><?php echo $row_Recordset3['Details']; ?></td>
    </tr>
  </table>
  <?php } while ($row_Recordset3 = mysql_fetch_assoc($Recordset3)); ?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);


mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
?>
