<?php require_once('Connections/busybee.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO jobseeker (Jobseeker_ID, Username, Password, Pictures, First_Name, Last_Name, DoB, Gender, Jobseeker_Email, Jobseeker_PhoneNumber, Jobseeker_Address, City, `State`, Post_Code, Country, Nationality, About_Me, Job_Role, Skills_Certificate, Type_Of_Employment, Salary) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Jobseeker_ID'], "int"),
                       GetSQLValueString($_POST['Username'], "text"),
                       GetSQLValueString($_POST['Password'], "text"),
                       GetSQLValueString($_POST['Pictures'], "text"),
                       GetSQLValueString($_POST['First_Name'], "text"),
                       GetSQLValueString($_POST['Last_Name'], "text"),
                       GetSQLValueString($_POST['DoB'], "date"),
                       GetSQLValueString($_POST['Gender'], "text"),
                       GetSQLValueString($_POST['Jobseeker_Email'], "text"),
                       GetSQLValueString($_POST['Jobseeker_PhoneNumber'], "text"),
                       GetSQLValueString($_POST['Jobseeker_Address'], "text"),
                       GetSQLValueString($_POST['City'], "text"),
                       GetSQLValueString($_POST['State'], "text"),
                       GetSQLValueString($_POST['Post_Code'], "int"),
                       GetSQLValueString($_POST['Country'], "text"),
                       GetSQLValueString($_POST['Nationality'], "text"),
                       GetSQLValueString($_POST['About_Me'], "text"),
                       GetSQLValueString($_POST['Job_Role'], "text"),
                       GetSQLValueString($_POST['Skills_Certificate'], "text"),
                       GetSQLValueString($_POST['Type_Of_Employment'], "text"),
                       GetSQLValueString($_POST['Salary'], "double"));

  mysql_select_db($database_busybee, $busybee);
  $Result1 = mysql_query($insertSQL, $busybee) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE jobseeker SET Username=%s, Password=%s, Pictures=%s, First_Name=%s, Last_Name=%s, DoB=%s, Gender=%s, Jobseeker_Email=%s, Jobseeker_PhoneNumber=%s, Jobseeker_Address=%s, City=%s, `State`=%s, Post_Code=%s, Country=%s, Nationality=%s, About_Me=%s, Job_Role=%s, Skills_Certificate=%s, Type_Of_Employment=%s, Salary=%s WHERE Jobseeker_ID=%s",
                       GetSQLValueString($_POST['Username'], "text"),
                       GetSQLValueString($_POST['Password'], "text"),
                       GetSQLValueString($_POST['Pictures'], "text"),
                       GetSQLValueString($_POST['First_Name'], "text"),
                       GetSQLValueString($_POST['Last_Name'], "text"),
                       GetSQLValueString($_POST['DoB'], "date"),
                       GetSQLValueString($_POST['Gender'], "text"),
                       GetSQLValueString($_POST['Jobseeker_Email'], "text"),
                       GetSQLValueString($_POST['Jobseeker_PhoneNumber'], "text"),
                       GetSQLValueString($_POST['Jobseeker_Address'], "text"),
                       GetSQLValueString($_POST['City'], "text"),
                       GetSQLValueString($_POST['State'], "text"),
                       GetSQLValueString($_POST['Post_Code'], "int"),
                       GetSQLValueString($_POST['Country'], "text"),
                       GetSQLValueString($_POST['Nationality'], "text"),
                       GetSQLValueString($_POST['About_Me'], "text"),
                       GetSQLValueString($_POST['Job_Role'], "text"),
                       GetSQLValueString($_POST['Skills_Certificate'], "text"),
                       GetSQLValueString($_POST['Type_Of_Employment'], "text"),
                       GetSQLValueString($_POST['Salary'], "double"),
                       GetSQLValueString($_POST['Jobseeker_ID'], "int"));

  mysql_select_db($database_busybee, $busybee);
  $Result1 = mysql_query($updateSQL, $busybee) or die(mysql_error());
}

mysql_select_db($database_busybee, $busybee);
$query_Recordset1 = "SELECT * FROM jobseeker";
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
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Jobseeker_ID:</td>
      <td><input type="text" name="Jobseeker_ID" value="<?php echo $row_Recordset1['Jobseeker_ID']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Username:</td>
      <td><input type="text" name="Username" value="<?php echo $row_Recordset1['Username']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Password:</td>
      <td><input type="text" name="Password" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Pictures:</td>
      <td><input type="text" name="Pictures" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">First_Name:</td>
      <td><input type="text" name="First_Name" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Last_Name:</td>
      <td><input type="text" name="Last_Name" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">DoB:</td>
      <td><input type="text" name="DoB" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Gender:</td>
      <td><input type="text" name="Gender" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Jobseeker_Email:</td>
      <td><input type="text" name="Jobseeker_Email" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Jobseeker_PhoneNumber:</td>
      <td><input type="text" name="Jobseeker_PhoneNumber" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Jobseeker_Address:</td>
      <td><input type="text" name="Jobseeker_Address" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">City:</td>
      <td><input type="text" name="City" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">State:</td>
      <td><input type="text" name="State" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Post_Code:</td>
      <td><input type="text" name="Post_Code" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Country:</td>
      <td><input type="text" name="Country" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nationality:</td>
      <td><input type="text" name="Nationality" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">About_Me:</td>
      <td><input type="text" name="About_Me" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Job_Role:</td>
      <td><input type="text" name="Job_Role" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Skills_Certificate:</td>
      <td><input type="text" name="Skills_Certificate" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Type_Of_Employment:</td>
      <td><input type="text" name="Type_Of_Employment" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Salary:</td>
      <td><input type="text" name="Salary" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Jobseeker_ID:</td>
      <td><?php echo $row_Recordset1['Jobseeker_ID']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Username:</td>
      <td><input type="text" name="Username" value="<?php echo htmlentities($row_Recordset1['Username'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Password:</td>
      <td><input type="text" name="Password" value="<?php echo htmlentities($row_Recordset1['Password'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Pictures:</td>
      <td><input type="text" name="Pictures" value="<?php echo htmlentities($row_Recordset1['Pictures'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">First_Name:</td>
      <td><input type="text" name="First_Name" value="<?php echo htmlentities($row_Recordset1['First_Name'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Last_Name:</td>
      <td><input type="text" name="Last_Name" value="<?php echo htmlentities($row_Recordset1['Last_Name'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">DoB:</td>
      <td><input type="text" name="DoB" value="<?php echo htmlentities($row_Recordset1['DoB'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Gender:</td>
      <td><input type="text" name="Gender" value="<?php echo htmlentities($row_Recordset1['Gender'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Jobseeker_Email:</td>
      <td><input type="text" name="Jobseeker_Email" value="<?php echo htmlentities($row_Recordset1['Jobseeker_Email'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Jobseeker_PhoneNumber:</td>
      <td><input type="text" name="Jobseeker_PhoneNumber" value="<?php echo htmlentities($row_Recordset1['Jobseeker_PhoneNumber'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Jobseeker_Address:</td>
      <td><input type="text" name="Jobseeker_Address" value="<?php echo htmlentities($row_Recordset1['Jobseeker_Address'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">City:</td>
      <td><input type="text" name="City" value="<?php echo htmlentities($row_Recordset1['City'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">State:</td>
      <td><input type="text" name="State" value="<?php echo htmlentities($row_Recordset1['State'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Post_Code:</td>
      <td><input type="text" name="Post_Code" value="<?php echo htmlentities($row_Recordset1['Post_Code'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Country:</td>
      <td><input type="text" name="Country" value="<?php echo htmlentities($row_Recordset1['Country'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nationality:</td>
      <td><input type="text" name="Nationality" value="<?php echo htmlentities($row_Recordset1['Nationality'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">About_Me:</td>
      <td><input type="text" name="About_Me" value="<?php echo htmlentities($row_Recordset1['About_Me'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Job_Role:</td>
      <td><input type="text" name="Job_Role" value="<?php echo htmlentities($row_Recordset1['Job_Role'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Skills_Certificate:</td>
      <td><input type="text" name="Skills_Certificate" value="<?php echo htmlentities($row_Recordset1['Skills_Certificate'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Type_Of_Employment:</td>
      <td><input type="text" name="Type_Of_Employment" value="<?php echo htmlentities($row_Recordset1['Type_Of_Employment'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Salary:</td>
      <td><input type="text" name="Salary" value="<?php echo htmlentities($row_Recordset1['Salary'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form2" />
  <input type="hidden" name="Jobseeker_ID" value="<?php echo $row_Recordset1['Jobseeker_ID']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
