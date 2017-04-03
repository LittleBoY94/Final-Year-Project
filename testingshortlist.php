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

$colname_Recordset6 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset6 = $_SESSION['MM_Username'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset6 = sprintf("SELECT Jobseeker_ID, Job_ID, Apply_Date, Time, Date, Time_Post, Job_Description, Job_Salary, Job_Title, TypeOfEmployment, Job_Category, Education_Level, Languages, postjob.Benefits, postjob.Conditions, Company_Name, Company_Email, Company_PhoneNumber, Location, employer.Username, jobseeker.First_Name, jobseeker.Last_Name, jobseeker.Jobseeker_PhoneNumber, jobseeker.Jobseeker_Email FROM applyjob natural join jobseeker natural join shortlisted natural join postjob left outer join employer on postjob.Employer_ID = employer.Employer_ID WHERE employer.Username=%s", GetSQLValueString($colname_Recordset6, "text"));
$Recordset6 = mysql_query($query_Recordset6, $busybee) or die(mysql_error());
$row_Recordset6 = mysql_fetch_assoc($Recordset6);
$totalRows_Recordset6 = mysql_num_rows($Recordset6);$colname_Recordset6 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset6 = $_SESSION['MM_Username'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset6 = sprintf("SELECT Jobseeker_ID, Job_ID, Apply_Date, Time, Date, Time_Post, Job_Description, Job_Salary, Job_Title, TypeOfEmployment, Job_Category, Education_Level, Languages, postjob.Benefits, postjob.Conditions, Company_Name, Company_Email, Company_PhoneNumber, Location, employer.Username, jobseeker.First_Name, jobseeker.Last_Name, jobseeker.Jobseeker_PhoneNumber, jobseeker.Jobseeker_Email FROM applyjob natural join jobseeker natural join shortlisted natural join postjob left outer join employer on postjob.Employer_ID = employer.Employer_ID WHERE employer.Username=%s", GetSQLValueString($colname_Recordset6, "text"));
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
<a href="<?php echo $logoutAction ?>">logout</a>
<div align="center">
		    <?php do { ?>
  <table class="tablecolor" style="margin-top:40px;" align="center" width="889" height="262" border="1">
    <tr>
      <td align="center" colspan="3"><h3><?php echo $row_Recordset6['Job_Title']; ?></h3></td>
      <td width="245">Date Posted: <?php echo $row_Recordset6['Time_Post']; ?></td>
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

  <input type="submit" name="btnupdate" class="btn btn-success btn-lg buttonstyle  fontstyle2" style="margin:10px;" onclick="window.location.href='testingdeletejob.php?Applyjob_ID=<?php echo $row_Recordset6['Applyjob_ID']; ?>'" id="btnupdate" value="Cancel Request">

  <?php } while ($row_Recordset6 = mysql_fetch_assoc($Recordset6)); ?>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset6);
?>
