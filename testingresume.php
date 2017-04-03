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
$query_Recordset2 = sprintf("SELECT * FROM education_level natural join jobseeker WHERE Username=%s", GetSQLValueString($colname_Recordset2, "text"));
$Recordset2 = mysql_query($query_Recordset2, $busybee) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$colname_Recordset3 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset3 = $_SESSION['MM_Username'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset3 = sprintf("SELECT * FROM jobseeker_experiences natural join jobseeker WHERE Username=%s", GetSQLValueString($colname_Recordset3, "text"));
$Recordset3 = mysql_query($query_Recordset3, $busybee) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
#mainbox {
	width: 595px;
	height: auto;
	z-index: 1;
}
#border1 {
	position: absolute;
	width: 625px;
	height: 1px;
	z-index: 1;
	padding:0;
	background-color: #f15c5c;
	top: 265px;
	left:9px;
}

#border2 {
	position: absolute;
	width: 625px;
	height: 1px;
	z-index: 1;
	padding:0;
	background-color: #f15c5c;
	top: 475px;
	left:9px;
}
#border3 {
	position: absolute;
	width: 625px;
	height: 1px;
	z-index: 1;
	padding:0;
	background-color: #f15c5c;
	top: 700	px;
	left:9px;
}
</style>
<link href="css/Style1.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php echo $row_Recordset1['Jobseeker_ID']; ?><a href="<?php echo $logoutAction ?>">log out</a>
<div style="border:1px solid #f15c5c; padding:15px;" id="mainbox">
  <div class="content">
                        
                        
  </div>
  <table width="557" height="154" border="0">
    <tr>
      <td width="200" height="200" rowspan="4">
      <?php
						echo '<img height="200" width="200" src=data:image;base64,'.$row_Recordset1['Pictures'];
						?>
                        </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td class="tablefont" style="padding-left: 10px;" colspan="2"><?php echo $row_Recordset1['First_Name']; ?><?php echo $row_Recordset1['Last_Name']; ?></td>
    </tr>
    <tr>
      <td height ="5" class="tablefont2" style="padding-left: 10px;  border-right:1px solid #999;"><?php echo $row_Recordset1['Jobseeker_PhoneNumber']; ?></td>
      <td height ="5" class="tablefont2" style="padding-left: 10px;" ><?php echo $row_Recordset1['Jobseeker_Email']; ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <div id="border1"></div>
  <h2 align="center">Basic Information</h2>
  <table align="center" width="590" border="0">
    <tr>
      <td width="203">Date of Birth: <?php echo $row_Recordset1['DoB']; ?></td>
      <td width="377">Address: <?php echo $row_Recordset1['Jobseeker_Address']; ?></td>
    </tr>
    <tr>
      <td>Gender: <?php echo $row_Recordset1['Gender']; ?></td>
      <td>City: <?php echo $row_Recordset1['City']; ?></td>
    </tr>
    <tr>
      <td>Nationality: <?php echo $row_Recordset1['Nationality']; ?></td>
      <td>State: <?php echo $row_Recordset1['State']; ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Post Code: <?php echo $row_Recordset1['Post_Code']; ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Country: <?php echo $row_Recordset1['Country']; ?></td>
    </tr>
    <tr>
      <td style=" vertical-align:top;">Job Matching Details:</td>
      <td>I am currently looking for <?php echo $row_Recordset1['Job_Role']; ?> position as a <?php echo $row_Recordset1['Type_Of_Employment']; ?> employment  with the salary about RM <?php echo $row_Recordset1['Salary']; ?></td>
    </tr>
  </table>
   <div id="border2"></div>
  <h2 align="center">Education Details  </h2>
  <?php do { ?>
    <table style="margin-top: 15px;" width="592" border="0">
      <tr>
        <td width="205" rowspan="2"><?php echo $row_Recordset2['Year1']; ?> to <?php echo $row_Recordset2['Year2']; ?></td>
        <td width="438" class="tablefont2"><?php echo $row_Recordset2['Institution_Name']; ?></td>
      </tr>
      <tr>
        <td><?php echo $row_Recordset2['Education_Level']; ?> In <?php echo $row_Recordset2['Course_Name']; ?></td>
      </tr>
    </table>
    <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
  <div id="border3"></div>
  <h2 align="center" >Job Experiences</h2>
  <?php do { ?>
    <table  style="margin-top:15px;" width="580" border="0">
      <tr>
        <td><p>I previously worked in <?php echo $row_Recordset3['Ex_Company']; ?> for the duration of <?php echo $row_Recordset3['Ex_Year']; ?> as a <?php echo $row_Recordset3['Positions']; ?> in <?php echo $row_Recordset3['Location']; ?>.
          </p>
          <p>Additional Details: <?php echo $row_Recordset3['Details']; ?></p></td>
      </tr>
    </table>
    <?php } while ($row_Recordset3 = mysql_fetch_assoc($Recordset3)); ?>

</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
?>
