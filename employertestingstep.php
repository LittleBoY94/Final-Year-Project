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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE employer SET Company_Pictures=%s, Company_Name=%s, SSM_No=%s, Establishment=%s, Industries=%s, Company_Email=%s, Company_PhoneNumber=%s, Company_Address=%s, Post_Code=%s, City=%s, States=%s, Country=%s, Company_Websites=%s, Company_Details=%s WHERE Employer_ID=%s",
                       GetSQLValueString($_POST['Company_Pictures'], "text"),
                       GetSQLValueString($_POST['Company_Name'], "text"),
                       GetSQLValueString($_POST['SSM_No'], "text"),
                       GetSQLValueString($_POST['Establishment'], "date"),
                       GetSQLValueString($_POST['Industries'], "text"),
                       GetSQLValueString($_POST['Company_Email'], "text"),
                       GetSQLValueString($_POST['Company_PhoneNumber'], "text"),
                       GetSQLValueString($_POST['Company_Address'], "text"),
                       GetSQLValueString($_POST['Post_Code'], "int"),
                       GetSQLValueString($_POST['City'], "text"),
                       GetSQLValueString($_POST['States'], "text"),
                       GetSQLValueString($_POST['Country'], "text"),
                       GetSQLValueString($_POST['Company_Websites'], "text"),
                       GetSQLValueString($_POST['Company_Details'], "text"),
                       GetSQLValueString($_POST['Employer_ID'], "int"));

  mysql_select_db($database_busybee, $busybee);
  $Result1 = mysql_query($updateSQL, $busybee) or die(mysql_error());

  $updateGoTo = "Employer_Profile.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form4")) {
  $updateSQL = sprintf("UPDATE employer SET Type_of_Employment=%s, Hiring_Skills=%s, Location=%s, Hiring_Details=%s WHERE Employer_ID=%s",
                       GetSQLValueString($_POST['Type_of_Employment'], "text"),
                       GetSQLValueString($_POST['Hiring_Skills'], "text"),
                       GetSQLValueString($_POST['Location'], "text"),
                       GetSQLValueString($_POST['Hiring_Details'], "text"),
                       GetSQLValueString($_POST['Employer_ID'], "int"));

  mysql_select_db($database_busybee, $busybee);
  $Result1 = mysql_query($updateSQL, $busybee) or die(mysql_error());

  $updateGoTo = "Employer_Profile.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form method="post" name="form2" id="form2">
  <p>&nbsp;<a href="<?php echo $logoutAction ?>">Log out</a></p>
  <p>&nbsp;</p>
</form>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Company_Name:</td>
      <td><input type="text" name="Company_Name" value="<?php echo htmlentities($row_Recordset1['Company_Name'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">SSM_No:</td>
      <td><input type="text" name="SSM_No" value="<?php echo htmlentities($row_Recordset1['SSM_No'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Establishment:</td>
      <td><input type="text" name="Establishment" value="<?php echo htmlentities($row_Recordset1['Establishment'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Industries:</td>
      <td><input type="text" name="Industries" value="<?php echo htmlentities($row_Recordset1['Industries'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Company_Email:</td>
      <td><input type="text" name="Company_Email" value="<?php echo htmlentities($row_Recordset1['Company_Email'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Company_PhoneNumber:</td>
      <td><input type="text" name="Company_PhoneNumber" value="<?php echo htmlentities($row_Recordset1['Company_PhoneNumber'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Company_Address:</td>
      <td><input type="text" name="Company_Address" value="<?php echo htmlentities($row_Recordset1['Company_Address'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Post_Code:</td>
      <td><input type="text" name="Post_Code" value="<?php echo htmlentities($row_Recordset1['Post_Code'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">City:</td>
      <td><input type="text" name="City" value="<?php echo htmlentities($row_Recordset1['City'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">States:</td>
      <td><input type="text" name="States" value="<?php echo htmlentities($row_Recordset1['States'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Country:</td>
      <td><input type="text" name="Country" value="<?php echo htmlentities($row_Recordset1['Country'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Company_Websites:</td>
      <td><input type="text" name="Company_Websites" value="<?php echo htmlentities($row_Recordset1['Company_Websites'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Company_Details:</td>
      <td><input type="text" name="Company_Details" value="<?php echo htmlentities($row_Recordset1['Company_Details'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <p>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="Employer_ID" value="<?php echo $row_Recordset1['Employer_ID']; ?>" />
  </p>
</form>
<p>&nbsp;</p>

<form action="<?php echo $editFormAction; ?>" method="post" name="form3" id="form3">
</form>
<form action="<?php echo $editFormAction; ?>" method="post" name="form4" id="form4">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Type_of_Employment:</td>
      <td><select name="Type_of_Employment">
        <option value="Full Time" <?php if (!(strcmp("Full Time", htmlentities($row_Recordset1['Type_of_Employment'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Full Time</option>
        <option value="Part Time" <?php if (!(strcmp("Part Time", htmlentities($row_Recordset1['Type_of_Employment'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Part Time</option>
        <option value="Internship" <?php if (!(strcmp("Internship", htmlentities($row_Recordset1['Type_of_Employment'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Internship</option>
        <option value="Volunteer" <?php if (!(strcmp("Volunteer", htmlentities($row_Recordset1['Type_of_Employment'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Volunteer</option>
        <option value="Freelance" <?php if (!(strcmp("Freelance", htmlentities($row_Recordset1['Type_of_Employment'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Freelance</option>
        <option value="Fresh Graduate" <?php if (!(strcmp("Fresh Graduate", htmlentities($row_Recordset1['Type_of_Employment'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Fresh Graduate</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Hiring_Skills:</td>
      <td><input type="text" name="Hiring_Skills" value="<?php echo htmlentities($row_Recordset1['Hiring_Skills'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Location:</td>
      <td><input type="text" name="Location" value="<?php echo htmlentities($row_Recordset1['Location'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Hiring_Details:</td>
      <td><input type="text" name="Hiring_Details" value="<?php echo htmlentities($row_Recordset1['Hiring_Details'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form4" />
  <input type="hidden" name="Employer_ID" value="<?php echo $row_Recordset1['Employer_ID']; ?>" />
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
