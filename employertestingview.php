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
<p><?php echo $row_Recordset1['Employer_ID']; ?><a href="<?php echo $logoutAction ?>">Logout</a></p>
<p>step 2</p>
<table class="tablecolor tabletext" width="859" height="99" border="0">
  <tr>
    <td width="160" height="43">Looking for:</td>
    <td width="291"><?php echo $row_Recordset1['Type_of_Employment']; ?></td>
    <td width="119">Location:</td>
    <td width="261"><?php echo $row_Recordset1['Location']; ?></td>
  </tr>
  <tr>
    <td>Requirement skills: </td>
    <td><?php echo $row_Recordset1['Hiring_Skills']; ?></td>
    <td>Hiring Details: </td>
    <td><?php echo $row_Recordset1['Hiring_Details']; ?></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table class="tablecolor tabletext" width="1406" border="0	">
  <tr>
    <td width="162"><div align="right">Company Name:</div></td>
    <td width="245"><?php echo $row_Recordset1['Company_Name']; ?></td>
    <td width="196"><div align="right">Company's Email Address:</div></td>
    <td width="310"><?php echo $row_Recordset1['Company_Email']; ?></td>
    <td width="174"><div align="right">City:</div></td>
    <td width="293"><?php echo $row_Recordset1['City']; ?></td>
  </tr>
  <tr>
    <td><div align="right">SSM Number:</div></td>
    <td><?php echo $row_Recordset1['SSM_No']; ?></td>
    <td><div align="right">Company's Phone Number:</div></td>
    <td><?php echo $row_Recordset1['Company_PhoneNumber']; ?></td>
    <td><div align="right">State:</div></td>
    <td><?php echo $row_Recordset1['States']; ?></td>
  </tr>
  <tr>
    <td><div align="right">Establishment:</div></td>
    <td><?php echo $row_Recordset1['Establishment']; ?></td>
    <td><div align="right">Company's Address:</div></td>
    <td><?php echo $row_Recordset1['Company_Address']; ?></td>
    <td><div align="right">Country:</div></td>
    <td><?php echo $row_Recordset1['Country']; ?></td>
  </tr>
  <tr>
    <td><div align="right">Industries:</div></td>
    <td><?php echo $row_Recordset1['Industries']; ?></td>
    <td><div align="right">Post Code:</div></td>
    <td><?php echo $row_Recordset1['Post_Code']; ?></td>
    <td><div align="right">Company's Website:</div></td>
    <td><?php echo $row_Recordset1['Company_Websites']; ?></td>
  </tr>
  <tr>
    <td><div align="right">Company's Detail:</div></td>
    <td colspan="3"><?php echo $row_Recordset1['Company_Details']; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
