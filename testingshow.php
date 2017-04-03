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

$colname_Recordset2 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset2 = $_SESSION['MM_Username'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset2 = sprintf("SELECT * FROM jobseeker natural join education_level where Username=%s", GetSQLValueString($colname_Recordset2, "text"));
$Recordset2 = mysql_query($query_Recordset2, $busybee) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="385" height="288" border="0">
  <tr>
    <td width="160"><strong>Education Details</strong></td>
    <td width="429"></td>
  </tr>
  <tr>
    <td><strong>Education level: </strong></td>
    <td><?php echo $row_Recordset2['Education_Level']; ?></td>
  </tr>
  <tr>
    <td><strong>Institution name: </strong></td>
    <td><?php echo $row_Recordset2['Institution_Name']; ?></td>
  </tr>
  <tr>
    <td><strong>From:  </strong></td>
    <td><?php echo $row_Recordset2['Year1']; ?> - <?php echo $row_Recordset1['Year2']; ?></td>
  </tr>
  
  
  <tr>
    <td><strong>Course name: </strong></td>
    <td><?php echo $row_Recordset2['Course_Name']; ?></td>
  </tr>
  <tr>
    <td><strong>Languages: </strong></td>
    <td><?php echo $row_Recordset2['Languages']; ?></td>
  </tr>
  <tr>
    <td colspan="2"><form id="form1" name="form1" method="post" action="">
      <div align="center">
        <input type="submit" name="btndone" id="btndone" value="Done" />
        </div>
    </form></td>
  </tr>
</table>
<table width="454" height="481" border="0">
  <tr>
    <td width="178"><div align="right"><strong>Basic Informations</strong></div></td>
    <td width="155">&nbsp;</td>
  </tr>
  <tr>
    <td><div align="right"><strong>First Name:</strong></div></td>
    <td><?php echo $row_Recordset1['First_Name']; ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>Last Name:</strong></div></td>
    <td><?php echo $row_Recordset1['Last_Name']; ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>Date of Birth:</strong></div></td>
    <td><?php echo $row_Recordset1['DoB']; ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>Gender:</strong></div></td>
    <td><?php echo $row_Recordset1['Gender']; ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>Phone Number:</strong></div></td>
    <td><?php echo $row_Recordset1['Jobseeker_PhoneNumber']; ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>Address:</strong></div></td>
    <td><?php echo $row_Recordset1['Jobseeker_Address']; ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>City:</strong></div></td>
    <td><?php echo $row_Recordset1['City']; ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>State:</strong></div></td>
    <td><?php echo $row_Recordset1['State']; ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>Post Code:</strong></div></td>
    <td><?php echo $row_Recordset1['Post_Code']; ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>Country:</strong></div></td>
    <td><?php echo $row_Recordset1['Country']; ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>Nationality:</strong></div></td>
    <td><?php echo $row_Recordset1['Nationality']; ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>About Me:</strong></div></td>
    <td><?php echo $row_Recordset1['About_Me']; ?></td>
  </tr>
  <tr>
    <td height="26" colspan="2"><form id="form4" name="form4" method="post" action="">
      <div align="center">
        <input type="submit" name="btndone4" id="btndone4" value="Submit" />
      </div>
    </form></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="300" height="255" border="0">
  <tr>
    <td colspan="2"><strong>Job Matching Details</strong></td>
  </tr>
  <tr>
    <td><strong>Job role: </strong></td>
    <td><?php echo $row_Recordset1['Job_Role']; ?></td>
  </tr>
  <tr>
    <td><strong>Skills &amp; Certificate: </strong></td>
    <td><?php echo $row_Recordset1['Skills_Certificate']; ?></td>
  </tr>
  <tr>
    <td><strong>Type of Employement: </strong></td>
    <td><?php echo $row_Recordset1['Type_Of_Employment']; ?></td>
  </tr>
  <tr>
    <td><strong>Salary: </strong></td>
    <td>MYR<?php echo $row_Recordset1['Salary']; ?></td>
  </tr>
  <tr>
    <td colspan="2"><form id="form2" name="form1" method="post" action="">
      <div align="center">
        <input type="submit" name="btndone2" id="btndone2" value="Done" />
      </div>
    </form></td>
  </tr>
</table>
<table width="300" height="197" border="0">
  <tr>
    <td colspan="2"><strong>Working Experiences</strong></td>
  </tr>
  <tr>
    <td><strong>Ex Company: </strong></td>
    <td><?php echo $row_Recordset1['Ex_Company']; ?></td>
  </tr>
  <tr>
    <td><strong>Working duration: </strong></td>
    <td><?php echo $row_Recordset1['Ex_Year']; ?></td>
  </tr>
  <tr>
    <td><strong>Worked position: </strong></td>
    <td><?php echo $row_Recordset1['Positions']; ?></td>
  </tr>
  <tr>
    <td><strong>Details: </strong></td>
    <td><?php echo $row_Recordset1['Details']; ?></td>
  </tr>
  <tr>
    <td colspan="2"><form id="form3" name="form1" method="post" action="">
      <div align="center">
        <input type="submit" name="btndone3" id="btndone3" value="Done" />
      </div>
    </form></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
