<?php require_once('Connections/busybee.php'); ?>
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

  $insertGoTo = "Employer_JobPage.php";
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
$query_Recordset1 = sprintf("SELECT * FROM employer WHERE Username = %s", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $busybee) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset6 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset6 = $_SESSION['MM_Username'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset6 = sprintf("SELECT Apply_Date, Time, Date, Time_Post, Job_Description, Job_Salary, Job_Title, TypeOfEmployment, Job_Category, Education_Level, Languages, postjob.Benefits, postjob.Conditions, Company_Name, Company_Email, Company_PhoneNumber, Location, employer.Username, jobseeker.First_Name, jobseeker.Last_Name, jobseeker.Jobseeker_PhoneNumber, jobseeker.Jobseeker_Email FROM applyjob natural join jobseeker natural join postjob left outer join employer on postjob.Employer_ID = employer.Employer_ID WHERE employer.Username=%s", GetSQLValueString($colname_Recordset6, "text"));
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
<p><a href="<?php echo $logoutAction ?>">Logout</a><?php echo $row_Recordset1['Username']; ?></p>
<p>&nbsp; </p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Job Availability:</td>
      <td><input type="date" name="Date" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Time Job Posted:</td>
      <td><input type="text" name="Time_Post" value=" <?php echo date("m-d-y") ?>	" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" style="vertical-align:top; " >Job Description:</td>
      <td><textarea placeholder="Eg. Details of job skills, etc" name="Job_Description" cols="32" rows="5"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Job Salary:</td>
      <td><input type="text" placeholder="Eg. 1000, 1500, etc" name="Job_Salary" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Job Role:</td>
      <td><input type="text" placeholder="Eg. positions of job vacancy" name="Job_Title" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Type of Employment:</td>
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
      <td nowrap="nowrap" align="right">Job Industry:</td>
      <td><input type="text" placeholder="Eg. It Industry, Business Industry, etc" name="Job_Category" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Required Education:</td>
      <td><input type="text" placeholder="Eg. Degree, PHD, etc" name="Education_Level" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Languages:</td>
      <td><input type="text" placeholder="Eg. English, Mandarin, etc" name="Languages" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" style="vertical-align:top;" >Benefits:</td>
      <td><textarea placeholder="Eg. Benefits of working" name="Benefits" cols="32" rows="5"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" style="vertical-align:top;">Conditions:</td>
      <td><textarea placeholder="Eg. Requirements of job vacancy." name="Conditions" cols="32" rows="5"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record" /></td>
    </tr>
  </table>
  <input type="hidden" name="Job_ID" value="" />
  <input type="hidden" name="Employer_ID" value="<?php echo $row_Recordset1['Employer_ID']; ?>" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
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
  
<input type="submit" name="btnupdate" class="btn btn-success btn-lg buttonstyle  fontstyle2" style="margin:10px;" onclick="window.location.href='#'" id="btnupdate" value="Viewed">
<?php } while ($row_Recordset6 = mysql_fetch_assoc($Recordset6)); ?>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset6);
?>
