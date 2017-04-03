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

$colname_Recordset6 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset6 = $_SESSION['MM_Username'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset6 = sprintf("SELECT Apply_Date, Time, Date, Time_Post, Job_Description, Job_Salary, Job_Title, TypeOfEmployment, Job_Category, Education_Level, Languages, postjob.Benefits, postjob.Conditions, Company_Name, Company_Email, Company_PhoneNumber, Location, jobseeker.Username FROM applyjob natural join jobseeker natural join postjob left outer join employer on postjob.Employer_ID = employer.Employer_ID WHERE jobseeker.Username=%s", GetSQLValueString($colname_Recordset6, "text"));
$Recordset6 = mysql_query($query_Recordset6, $busybee) or die(mysql_error());
$row_Recordset6 = mysql_fetch_assoc($Recordset6);
$totalRows_Recordset6 = mysql_num_rows($Recordset6);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<a href="<?php echo $logoutAction ?>"></a>
<?php do { ?>
  <table class="tablecolor" style="margin-top:40px;" align="center" width="889" height="262" border="1">
    <tr>
      <td align="center" colspan="3"><h3><?php echo $row_Recordset6['Job_Title']; ?></h3></td>
      <td width="245">Date Posted: <?php echo $row_Recordset6['Time_Post']; ?></td>
    </tr>
    <tr>
      <td width="135">Job Availability:</td>
      <td width="220"><?php echo $row_Recordset6['Date']; ?></td>
      <td width="168">Type of Employment: </td>
      <td><?php echo $row_Recordset6['TypeOfEmployment']; ?></td>
    </tr>
    <tr>
      <td height="28">Vacancy Position: </td>
      <td><?php echo $row_Recordset6['Job_Category']; ?></td>
      <td>Required Education:</td>
      <td><?php echo $row_Recordset6['Education_Level']; ?></td>
    </tr>
    <tr>
      <td>Job Salary: </td>
      <td><?php echo $row_Recordset6['Job_Salary']; ?></td>
      <td>Required Langauge(s): </td>
      <td><?php echo $row_Recordset6['Languages']; ?></td>
    </tr>
    <tr>
      <td>Job Description: </td>
      <td><?php echo $row_Recordset6['Job_Description']; ?></td>
      <td>Conditions:</td>
      <td><?php echo $row_Recordset6['Conditions']; ?></td>
    </tr>
    <tr>
      <td>Benefits: </td>
      <td colspan="3"><?php echo $row_Recordset6['Benefits']; ?></td>
    </tr>
    <tr>
      <td>Date  Applied:</td>
      <td><?php echo $row_Recordset6['Apply_Date']; ?></td>
      <td>Company Name:</td>
      <td><?php echo $row_Recordset6['Company_Name']; ?></td>
    </tr>
    <tr>
      <td>Time Applied:</td>
      <td><?php echo $row_Recordset6['Time']; ?></td>
      <td>Company Email:</td>
      <td><?php echo $row_Recordset6['Company_Email']; ?></td>
    </tr>
  </table>
  <?php } while ($row_Recordset6 = mysql_fetch_assoc($Recordset6)); ?>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset6);
?>
