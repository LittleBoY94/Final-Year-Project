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
  $updateSQL = sprintf("UPDATE jobseeker SET Job_Role=%s, Skills_Certificate=%s, Type_Of_Employment=%s, Salary=%s WHERE Jobseeker_ID=%s",
                       GetSQLValueString($_POST['Job_Role'], "text"),
                       GetSQLValueString($_POST['Skills_Certificate'], "text"),
                       GetSQLValueString($_POST['Type_Of_Employment'], "text"),
                       GetSQLValueString($_POST['Salary'], "double"),
                       GetSQLValueString($_POST['Jobseeker_ID'], "int"));

  mysql_select_db($database_busybee, $busybee);
  $Result1 = mysql_query($updateSQL, $busybee) or die(mysql_error());

  $updateGoTo = "Jobseeker_Profile.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form7")) {
  $updateSQL = sprintf("UPDATE jobseeker SET First_Name=%s, Last_Name=%s, DoB=%s, Gender=%s, City=%s, `State`=%s, Post_Code=%s, Country=%s, Nationality=%s, About_Me=%s, Jobseeker_PhoneNumber=%s, Jobseeker_Address=%s WHERE Jobseeker_ID=%s",
                       GetSQLValueString($_POST['First_Name'], "text"),
                       GetSQLValueString($_POST['Last_Name'], "text"),
                       GetSQLValueString($_POST['DoB'], "date"),
                       GetSQLValueString($_POST['Gender'], "text"),
                       GetSQLValueString($_POST['City'], "text"),
                       GetSQLValueString($_POST['State'], "text"),
                       GetSQLValueString($_POST['Post_Code'], "int"),
                       GetSQLValueString($_POST['Country'], "text"),
                       GetSQLValueString($_POST['Nationality'], "text"),
                       GetSQLValueString($_POST['About_Me'], "text"),
                       GetSQLValueString($_POST['Jobseeker_PhoneNumber'], "text"),
                       GetSQLValueString($_POST['Jobseeker_Address'], "text"),
                       GetSQLValueString($_POST['Jobseeker_ID'], "int"));

  mysql_select_db($database_busybee, $busybee);
  $Result1 = mysql_query($updateSQL, $busybee) or die(mysql_error());

  $updateGoTo = "Jobseeker_Profile.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form8")) {
  $updateSQL = sprintf("UPDATE education_level SET Jobseeker_ID=%s, Education_Level=%s, Institution_Name=%s, Year1=%s, Year2=%s, Course_Name=%s, Languages=%s WHERE Education_ID=%s",
                       GetSQLValueString($_POST['Jobseeker_ID'], "int"),
                       GetSQLValueString($_POST['Education_Level'], "text"),
                       GetSQLValueString($_POST['Institution_Name'], "text"),
                       GetSQLValueString($_POST['Year1'], "date"),
                       GetSQLValueString($_POST['Year2'], "date"),
                       GetSQLValueString($_POST['Course_Name'], "text"),
                       GetSQLValueString($_POST['Languages'], "text"),
                       GetSQLValueString($_POST['Education_ID'], "int"));

  mysql_select_db($database_busybee, $busybee);
  $Result1 = mysql_query($updateSQL, $busybee) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form9")) {
  $updateSQL = sprintf("UPDATE education_level SET Jobseeker_ID=%s, Education_Level=%s, Institution_Name=%s, Year1=%s, Year2=%s, Course_Name=%s, Languages=%s WHERE Education_ID=%s",
                       GetSQLValueString($_POST['Jobseeker_ID'], "int"),
                       GetSQLValueString($_POST['Education_Level'], "text"),
                       GetSQLValueString($_POST['Institution_Name'], "text"),
                       GetSQLValueString($_POST['Year1'], "date"),
                       GetSQLValueString($_POST['Year2'], "date"),
                       GetSQLValueString($_POST['Course_Name'], "text"),
                       GetSQLValueString($_POST['Languages'], "text"),
                       GetSQLValueString($_POST['Education_ID'], "int"));

  mysql_select_db($database_busybee, $busybee);
  $Result1 = mysql_query($updateSQL, $busybee) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form10")) {
  $updateSQL = sprintf("UPDATE education_level SET Jobseeker_ID=%s, Education_Level=%s, Institution_Name=%s, Year1=%s, Year2=%s, Course_Name=%s, Languages=%s WHERE Education_ID=%s",
                       GetSQLValueString($_POST['Jobseeker_ID'], "int"),
                       GetSQLValueString($_POST['Education_Level'], "text"),
                       GetSQLValueString($_POST['Institution_Name'], "text"),
                       GetSQLValueString($_POST['Year1'], "date"),
                       GetSQLValueString($_POST['Year2'], "date"),
                       GetSQLValueString($_POST['Course_Name'], "text"),
                       GetSQLValueString($_POST['Languages'], "text"),
                       GetSQLValueString($_POST['Education_ID'], "int"));

  mysql_select_db($database_busybee, $busybee);
  $Result1 = mysql_query($updateSQL, $busybee) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form9")) {
  $updateSQL = sprintf("UPDATE jobseeker_experiences SET Jobseeker_ID=%s, Ex_Company=%s, Ex_Year=%s, Positions=%s, Location=%s, Details=%s WHERE Experience_ID=%s",
                       GetSQLValueString($_POST['Jobseeker_ID'], "int"),
                       GetSQLValueString($_POST['Ex_Company'], "text"),
                       GetSQLValueString($_POST['Ex_Year'], "text"),
                       GetSQLValueString($_POST['Positions'], "text"),
                       GetSQLValueString($_POST['Location'], "text"),
                       GetSQLValueString($_POST['Details'], "text"),
                       GetSQLValueString($_POST['Experience_ID'], "int"));

  mysql_select_db($database_busybee, $busybee);
  $Result1 = mysql_query($updateSQL, $busybee) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form11")) {
  $updateSQL = sprintf("UPDATE jobseeker SET Job_Role=%s, Skills_Certificate=%s, Type_Of_Employment=%s, Salary=%s WHERE Jobseeker_ID=%s",
                       GetSQLValueString($_POST['Job_Role'], "text"),
                       GetSQLValueString($_POST['Skills_Certificate'], "text"),
                       GetSQLValueString($_POST['Type_Of_Employment'], "text"),
                       GetSQLValueString($_POST['Salary'], "double"),
                       GetSQLValueString($_POST['Jobseeker_ID'], "int"));

  mysql_select_db($database_busybee, $busybee);
  $Result1 = mysql_query($updateSQL, $busybee) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form12")) {
  $updateSQL = sprintf("UPDATE jobseeker SET First_Name=%s, Last_Name=%s, DoB=%s, Gender=%s, Jobseeker_Email=%s, Jobseeker_PhoneNumber=%s, Jobseeker_Address=%s, City=%s, `State`=%s, Post_Code=%s, Country=%s, Nationality=%s, About_Me=%s WHERE Jobseeker_ID=%s",
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
                       GetSQLValueString($_POST['Jobseeker_ID'], "int"));

  mysql_select_db($database_busybee, $busybee);
  $Result1 = mysql_query($updateSQL, $busybee) or die(mysql_error());

  $updateGoTo = "Jobseeker_Homepage.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form13")) {
  $updateSQL = sprintf("UPDATE education_level SET Education_Level=%s, Institution_Name=%s, Year1=%s, Year2=%s, Course_Name=%s, Languages=%s WHERE Education_ID=%s",
                       GetSQLValueString($_POST['Education_Level'], "text"),
                       GetSQLValueString($_POST['Institution_Name'], "text"),
                       GetSQLValueString($_POST['Year1'], "date"),
                       GetSQLValueString($_POST['Year2'], "date"),
                       GetSQLValueString($_POST['Course_Name'], "text"),
                       GetSQLValueString($_POST['Languages'], "text"),
                       GetSQLValueString($_POST['Education_ID'], "int"));

  mysql_select_db($database_busybee, $busybee);
  $Result1 = mysql_query($updateSQL, $busybee) or die(mysql_error());

  $updateGoTo = "Jobseeker_Homepage.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form5")) {
  $insertSQL = sprintf("INSERT INTO education_level (Education_ID, Jobseeker_ID, Education_Level, Institution_Name, Year1, Year2, Course_Name, Languages) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Education_ID'], "int"),
                       GetSQLValueString($_POST['Jobseeker_ID'], "int"),
                       GetSQLValueString($_POST['Education_Level'], "text"),
                       GetSQLValueString($_POST['Institution_Name'], "text"),
                       GetSQLValueString($_POST['Year1'], "date"),
                       GetSQLValueString($_POST['Year2'], "date"),
                       GetSQLValueString($_POST['Course_Name'], "text"),
                       GetSQLValueString($_POST['Languages'], "text"));

  mysql_select_db($database_busybee, $busybee);
  $Result1 = mysql_query($insertSQL, $busybee) or die(mysql_error());

  $insertGoTo = "Jobseeker_Profile.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form5")) {
  $insertSQL = sprintf("INSERT INTO education_level (Jobseeker_ID, Education_Level, Institution_Name, Year1, Year2, Course_Name, Languages) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Jobseeker_ID'], "int"),
                       GetSQLValueString($_POST['Education_Level'], "text"),
                       GetSQLValueString($_POST['Institution_Name'], "text"),
                       GetSQLValueString($_POST['Year1'], "date"),
                       GetSQLValueString($_POST['Year2'], "date"),
                       GetSQLValueString($_POST['Course_Name'], "text"),
                       GetSQLValueString($_POST['Languages'], "text"));

  mysql_select_db($database_busybee, $busybee);
  $Result1 = mysql_query($insertSQL, $busybee) or die(mysql_error());

  $insertGoTo = "Jobseeker_Profile.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form6")) {
  $insertSQL = sprintf("INSERT INTO jobseeker_experiences (Experience_ID, Jobseeker_ID, Ex_Company, Ex_Year, Positions, Location, Details) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Experience_ID'], "int"),
                       GetSQLValueString($_POST['Jobseeker_ID'], "int"),
                       GetSQLValueString($_POST['Ex_Company'], "text"),
                       GetSQLValueString($_POST['Ex_Year'], "text"),
                       GetSQLValueString($_POST['Positions'], "text"),
                       GetSQLValueString($_POST['Location'], "text"),
                       GetSQLValueString($_POST['Details'], "text"));

  mysql_select_db($database_busybee, $busybee);
  $Result1 = mysql_query($insertSQL, $busybee) or die(mysql_error());

  $insertGoTo = "Jobseeker_Profile.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form5")) {
  $insertSQL = sprintf("INSERT INTO education_level (Education_ID, Jobseeker_ID, Education_Level, Institution_Name, Year1, Year2, Course_Name, Languages) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Education_ID'], "int"),
                       GetSQLValueString($_POST['Jobseeker_ID'], "int"),
                       GetSQLValueString($_POST['Education_Level'], "text"),
                       GetSQLValueString($_POST['Institution_Name'], "text"),
                       GetSQLValueString($_POST['Year1'], "date"),
                       GetSQLValueString($_POST['Year2'], "date"),
                       GetSQLValueString($_POST['Course_Name'], "text"),
                       GetSQLValueString($_POST['Languages'], "text"));

  mysql_select_db($database_busybee, $busybee);
  $Result1 = mysql_query($insertSQL, $busybee) or die(mysql_error());

  $insertGoTo = "Jobseeker_Profile.php";
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
if (isset($_GET['id'])) {
  $colname_Recordset2 = $_GET['id'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset2 = sprintf("SELECT * FROM education_level WHERE Education_ID = %s", GetSQLValueString($colname_Recordset2, "int"));
$Recordset2 = mysql_query($query_Recordset2, $busybee) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$colname_Recordset3 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset3 = $_GET['id'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset3 = sprintf("SELECT * FROM jobseeker_experiences WHERE Experience_ID = %s", GetSQLValueString($colname_Recordset3, "int"));
$Recordset3 = mysql_query($query_Recordset3, $busybee) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE jobseeker SET Pictures='$image' WHERE Jobseeker_ID=%s",
                      
                       GetSQLValueString($_POST['Jobseeker_ID'], "int"));
$image= addslashes($_FILES['Pictures']['tmp_name']);
					  $name= addslashes($_FILES['Pictures']['name']);
					  $image= file_get_contents($image);
					  $image= base64_encode($image);
  mysql_select_db($database_busybee, $busybee);
  $Result1 = mysql_query($updateSQL, $busybee) or die(mysql_error());

  $updateGoTo = "Jobseeker_Profile.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<style type="text/css">
#apDiv1 {
	margin: auto;
	padding: auto;
	width: 400px;
	height: 115px;
	z-index: 1;
}
</style>

</head>

<body>
<div id="apDiv1">
  <form id="form1" name="form1" method="post" action="">
    <p><a href="<?php echo $logoutAction ?>">Log out</a></p>
    <p>&nbsp;</p>
  </form>
<p>&nbsp;</p>
<form method="post" name="form2" id="form2">
</form>
<form action="<?php echo $editFormAction; ?>" method="post" name="form5" id="form5">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Education_Level:</td>
      <td><select name="Education_Level">
        <option value="Completing High School" <?php if (!(strcmp("Completing High School", ""))) {echo "SELECTED";} ?>>Completing High School</option>
        <option value="Completed High School" <?php if (!(strcmp("Completed High School", ""))) {echo "SELECTED";} ?>>Completed High School</option>
        <option value="Completing Degree/Diploma" <?php if (!(strcmp("Completing Degree/Diploma", ""))) {echo "SELECTED";} ?>>Completing Degree/Diploma</option>
        <option value="Completed Degree/Diploma" <?php if (!(strcmp("Completed Degree/Diploma", ""))) {echo "SELECTED";} ?>>Completed Degree/Diploma</option>
        <option value="Completing Postgraduate Studies" <?php if (!(strcmp("Completing Postgraduate Studies", ""))) {echo "SELECTED";} ?>>Completing Postgraduate Studies</option>
        <option value="Completed Postgraduate Studies" <?php if (!(strcmp("Completed Postgraduate Studies", ""))) {echo "SELECTED";} ?>>Completed Postgraduate Studies</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Institution_Name:</td>
      <td><input type="text" name="Institution_Name" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Year1:</td>
      <td><input type="text" name="Year1" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Year2:</td>
      <td><input type="text" name="Year2" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Course_Name:</td>
      <td><input type="text" name="Course_Name" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Languages:</td>
      <td valign="baseline"><table>
        <tr>
          <td><input type="radio" name="Languages" value="English" />
            English</td>
        </tr>
        <tr>
          <td><input type="radio" name="Languages" value="Bahasa Malaysia" />
            Bahasa Malaysia</td>
        </tr>
        <tr>
          <td><input type="radio" name="Languages" value="Mandarin" />
            Mandarin</td>
        </tr>
      </table></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record" /></td>
    </tr>
  </table>
  <input type="hidden" name="Education_ID" value="" />
  <input type="hidden" name="Jobseeker_ID" value="" />
  <input type="hidden" name="MM_insert" value="form5" />
</form>
<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form13" id="form13">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Education_Level:</td>
      <td><input type="text" name="Education_Level" value="<?php echo htmlentities($row_Recordset2['Education_Level'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Institution_Name:</td>
      <td><input type="text" name="Institution_Name" value="<?php echo htmlentities($row_Recordset2['Institution_Name'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Year1:</td>
      <td><input type="text" name="Year1" value="<?php echo htmlentities($row_Recordset2['Year1'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Year2:</td>
      <td><input type="text" name="Year2" value="<?php echo htmlentities($row_Recordset2['Year2'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Course_Name:</td>
      <td><input type="text" name="Course_Name" value="<?php echo htmlentities($row_Recordset2['Course_Name'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Languages:</td>
      <td valign="baseline"><table>
        <tr>
          <td><input type="radio" name="Languages" value="English" <?php if (!(strcmp(htmlentities($row_Recordset2['Languages'], ENT_COMPAT, 'utf-8'),"English"))) {echo "checked=\"checked\"";} ?> />
            English</td>
        </tr>
        <tr>
          <td><input type="radio" name="Languages" value="Bahasa Malaysia" <?php if (!(strcmp(htmlentities($row_Recordset2['Languages'], ENT_COMPAT, 'utf-8'),"Bahasa Malaysia"))) {echo "checked=\"checked\"";} ?> />
            Bahasa Malaysia</td>
        </tr>
        <tr>
          <td><input type="radio" name="Languages" value="Mandarin" <?php if (!(strcmp(htmlentities($row_Recordset2['Languages'], ENT_COMPAT, 'utf-8'),"Mandarin"))) {echo "checked=\"checked\"";} ?> />
            Mandarin</td>
        </tr>
      </table></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form13" />
  <input type="hidden" name="Education_ID" value="<?php echo $row_Recordset2['Education_ID']; ?>" />
</form>
<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form7" id="form7">
  <table width="462" height="436" align="center">
    <tr valign="baseline">
      <td width="195" align="right" nowrap="nowrap">First Name:</td>
      <td width="255"><input type="text" name="First_Name" value="<?php echo htmlentities($row_Recordset1['First_Name'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Last Name:</td>
      <td><input type="text" name="Last_Name" value="<?php echo htmlentities($row_Recordset1['Last_Name'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Date of Birth:</td>
      <td><input type="text" name="DoB" value="<?php echo htmlentities($row_Recordset1['DoB'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Gender:</td>
      <td valign="baseline"><table>
        <tr>
          <td><input type="radio" name="Gender" value="Male" <?php if (!(strcmp(htmlentities($row_Recordset1['Gender'], ENT_COMPAT, 'utf-8'),"Male"))) {echo "checked=\"checked\"";} ?> />
            Male</td>
        </tr>
        <tr>
          <td><input type="radio" name="Gender" value="Female" <?php if (!(strcmp(htmlentities($row_Recordset1['Gender'], ENT_COMPAT, 'utf-8'),"Female"))) {echo "checked=\"checked\"";} ?> />
            Female</td>
        </tr>
      </table></td>
    </tr>
     <tr valign="baseline">
      <td nowrap="nowrap" align="right">Address:</td>
      <td><input type="text" name="Jobseeker_Address" value="<?php echo htmlentities($row_Recordset1['Jobseeker_Address'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">City:</td>
      <td><p>
        <input type="text" name="City" value="<?php echo htmlentities($row_Recordset1['City'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
      </p></td>
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
      <td nowrap="nowrap" align="right">About Me:</td>
      <td><input type="text" name="About_Me" value="<?php echo htmlentities($row_Recordset1['About_Me'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Phone Number:</td>
      <td><input type="text" name="Jobseeker_PhoneNumber" value="<?php echo htmlentities($row_Recordset1['Jobseeker_PhoneNumber'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
   
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form7" />
  <input type="hidden" name="Jobseeker_ID" value="<?php echo $row_Recordset1['Jobseeker_ID']; ?>" />
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="POST" name="form3" id="form3">
  <table align="center">
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
      <td><select name="Type_Of_Employment">
        <option value="Full Time" <?php if (!(strcmp("Full Time", htmlentities($row_Recordset1['Type_Of_Employment'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Full Time</option>
        <option value="Part Time" <?php if (!(strcmp("Part Time", htmlentities($row_Recordset1['Type_Of_Employment'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Part Time</option>
        <option value="Internship" <?php if (!(strcmp("Internship", htmlentities($row_Recordset1['Type_Of_Employment'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Internship</option>
        <option value="Volunteer" <?php if (!(strcmp("Volunteer", htmlentities($row_Recordset1['Type_Of_Employment'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Volunteer</option>
        <option value="Freelance" <?php if (!(strcmp("Freelance", htmlentities($row_Recordset1['Type_Of_Employment'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Freelance</option>
        <option value="Fresh Graduate" <?php if (!(strcmp("Fresh Graduate", htmlentities($row_Recordset1['Type_Of_Employment'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Fresh Graduate</option>
      </select></td>
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
  <input type="hidden" name="Jobseeker_ID" value="" />
  <input type="hidden" name="MM_update" value="form3" />
</form>
<p>&nbsp;	</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form6" id="form6">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ex_Company:</td>
      <td><input type="text" name="Ex_Company" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ex_Year:</td>
      <td><input type="text" name="Ex_Year" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Positions:</td>
      <td><input type="text" name="Positions" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Location:</td>
      <td><input type="text" name="Location" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Details:</td>
      <td><input type="text" name="Details" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><input type="submit" name="btnadd" id="btnadd" onclick="window.location.href=''" value="Submit" /></td>
      <td><input type="submit" value="Insert record" /></td>
    </tr>
  </table>
  <input type="hidden" name="Experience_ID" value="" />
  <input type="hidden" name="Jobseeker_ID" value="<?php echo htmlentities($row_Recordset1['Jobseeker_ID'], ENT_COMPAT, 'utf-8'); ?>" />
  <input type="hidden" name="MM_insert" value="form6" />
</form>
<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form8" id="form8">
</form>
<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form10" id="form10">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Education_ID:</td>
      <td><?php echo $row_Recordset2['Education_ID']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Jobseeker_ID:</td>
      <td><input type="text" name="Jobseeker_ID" value="<?php echo htmlentities($row_Recordset2['Jobseeker_ID'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Education_Level:</td>
      <td><select name="Education_Level">
        <option value="Completing High School" <?php if (!(strcmp("Completing High School", htmlentities($row_Recordset2['Education_Level'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Completing High School</option>
        <option value="Completed High School" <?php if (!(strcmp("Completed High School", htmlentities($row_Recordset2['Education_Level'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Completed High School</option>
        <option value="Completing Degree/Diploma" <?php if (!(strcmp("Completing Degree/Diploma", htmlentities($row_Recordset2['Education_Level'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Completing Degree/Diploma</option>
        <option value="Completed Degree/Diploma" <?php if (!(strcmp("Completed Degree/Diploma", htmlentities($row_Recordset2['Education_Level'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Completed Degree/Diploma</option>
        <option value="Completing Postgraduate Studies" <?php if (!(strcmp("Completing Postgraduate Studies", htmlentities($row_Recordset2['Education_Level'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Completing Postgraduate Studies</option>
        <option value="Completed Postgraduate Studies" <?php if (!(strcmp("Completed Postgraduate Studies", htmlentities($row_Recordset2['Education_Level'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Completed Postgraduate Studies</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Institution_Name:</td>
      <td><input type="text" name="Institution_Name" value="<?php echo htmlentities($row_Recordset2['Institution_Name'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Year1:</td>
      <td><input type="text" name="Year1" value="<?php echo htmlentities($row_Recordset2['Year1'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Year2:</td>
      <td><input type="text" name="Year2" value="<?php echo htmlentities($row_Recordset2['Year2'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Course_Name:</td>
      <td><input type="text" name="Course_Name" value="<?php echo htmlentities($row_Recordset2['Course_Name'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Languages:</td>
      <td><input type="text" name="Languages" value="<?php echo htmlentities($row_Recordset2['Languages'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form10" />
  <input type="hidden" name="Education_ID" value="<?php echo $row_Recordset2['Education_ID']; ?>" />
</form>
<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form9" id="form9">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Experience_ID:</td>
      <td><?php echo $row_Recordset3['Experience_ID']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Jobseeker_ID:</td>
      <td><input type="text" name="Jobseeker_ID" value="<?php echo htmlentities($row_Recordset3['Jobseeker_ID'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ex_Company:</td>
      <td><input type="text" name="Ex_Company" value="<?php echo htmlentities($row_Recordset3['Ex_Company'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ex_Year:</td>
      <td><input type="text" name="Ex_Year" value="<?php echo htmlentities($row_Recordset3['Ex_Year'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Positions:</td>
      <td><input type="text" name="Positions" value="<?php echo htmlentities($row_Recordset3['Positions'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Location:</td>
      <td><input type="text" name="Location" value="<?php echo htmlentities($row_Recordset3['Location'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Details:</td>
      <td><input type="text" name="Details" value="<?php echo htmlentities($row_Recordset3['Details'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form9" />
  <input type="hidden" name="Experience_ID" value="<?php echo $row_Recordset3['Experience_ID']; ?>" />
</form>
<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form11" id="form11">
  <table align="center">
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
      <td><select name="Type_Of_Employment">
        <option value="Full Time" <?php if (!(strcmp("Full Time", htmlentities($row_Recordset1['Type_Of_Employment'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Fulll Time</option>
        <option value="Part Time" <?php if (!(strcmp("Part Time", htmlentities($row_Recordset1['Type_Of_Employment'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Part Time</option>
        <option value="Internship" <?php if (!(strcmp("Internship", htmlentities($row_Recordset1['Type_Of_Employment'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Internship</option>
        <option value="Volunteer" <?php if (!(strcmp("Volunteer", htmlentities($row_Recordset1['Type_Of_Employment'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Volunteer</option>
        <option value="Freelance" <?php if (!(strcmp("Freelance", htmlentities($row_Recordset1['Type_Of_Employment'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Freelance</option>
        <option value="Fresh Graduate" <?php if (!(strcmp("Fresh Graduate", htmlentities($row_Recordset1['Type_Of_Employment'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Fresh Graduate</option>
      </select></td>
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
  <input type="hidden" name="MM_update" value="form11" />
  <input type="hidden" name="Jobseeker_ID" value="<?php echo $row_Recordset1['Jobseeker_ID']; ?>" />
</form>
<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form12" id="form12">
  <table align="center">
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
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form12" />
  <input type="hidden" name="Jobseeker_ID" value="<?php echo $row_Recordset1['Jobseeker_ID']; ?>" />
</form>
<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form4" id="form4">
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);


?>
