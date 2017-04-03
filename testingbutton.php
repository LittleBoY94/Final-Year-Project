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
  $updateSQL = sprintf("UPDATE employer SET Employer_Status=%s WHERE Employer_ID=%s",
                       GetSQLValueString($_POST['Employer_Status'], "text"),
                       GetSQLValueString($_POST['Employer_ID'], "int"));

  mysql_select_db($database_busybee, $busybee);
  $Result1 = mysql_query($updateSQL, $busybee) or die(mysql_error());

  $updateGoTo = "testingbutton.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset2 = "-1";
if (isset($_SESSION['txtsearch'])) {
  $colname_Recordset2 = $_SESSION['txtsearch'];
}
$colname1_Recordset2 = "-1";
if (isset($_POST['txtsearch'])) {
  $colname1_Recordset2 = $_POST['txtsearch'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset2 = sprintf("SELECT * FROM employer WHERE Company_Name LIKE %s OR Company_Email LIKE %s OR Hiring_Skills LIKE %s OR Location LIKE %s OR Type_Of_Employment LIKE %s OR  Hiring_Skills LIKE %s OR Location LIKE %s OR Type_Of_Employment LIKE %s ", GetSQLValueString("%" . $colname_Recordset2 . "%", "text"),GetSQLValueString("%" . $colname_Recordset2 . "%", "text"),GetSQLValueString("%" . $colname_Recordset2 . "%", "text"),GetSQLValueString("%" . $colname_Recordset2 . "%", "text"),GetSQLValueString("%" . $colname_Recordset2 . "%", "text"),GetSQLValueString("%" . $colname1_Recordset2 . "%", "text"),GetSQLValueString("%" . $colname1_Recordset2 . "%", "text"),GetSQLValueString("%" . $colname1_Recordset2 . "%", "text"));
$Recordset2 = mysql_query($query_Recordset2, $busybee) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$colname_Recordset1 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset1 = $_SESSION['MM_Username'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset1 = sprintf("SELECT * FROM `admin` WHERE Username = %s", GetSQLValueString($colname_Recordset1, "text"));
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
<a href="<?php echo $logoutAction ?>">logout</a><?php echo $row_Recordset1['Username']; ?>
 <div align="center">
                        <form action="testingbutton.php" method="post" name="searchform">
                          <label for="txtsearch"></label>
                          <input type="text" style="margin:10px" name="txtsearch" id="txtsearch">
                          <input type="submit" style="margin:10px;" class="btn btn-success btn-lg buttonstyle" name="btnsearch" id="btnsearch" value="Search Again">
                        </form>
                        
                    </div>
<div class="content" style="padding:15px;">
      <?php do { ?>
       
  
                       <div align="center">
                         <table style=" float:left; margin-bottom:10px;" width="1030" height="184" border="1">
                           
                             <td style="padding-left:10px;" width="134" height="43.33333333">Company Name:</td>
                             <td style="padding-left:10px;" width="220"><?php echo $row_Recordset2['Company_Name']; ?></td>
                             <td width="139" height="43.33333333" style="padding-left:10px;">Company Email:</td>
                             <td width="238" style="padding-left:10px;"><?php echo $row_Recordset2['Company_Email']; ?></td>
                           </tr>
                           <tr>
                             <td style="padding-left:10px;"height="43.33333333">Employment Interest:</td>
                             <td style="padding-left:10px;"><?php echo $row_Recordset2['Type_of_Employment']; ?></td>
                             <td style="padding-left:10px;">Hiring Skills:</td>
                             <td style="padding-left:10px;"><?php echo $row_Recordset2['Hiring_Skills']; ?></td>
                           </tr>
                           <tr>
                             <td height="43.33333333" style="padding-left:10px;">Location:</td>
                             <td style="padding-left:10px;"><?php echo $row_Recordset2['Location']; ?></td>
                             <td style="padding-left:10px;">Details:</td>
                             <td style="padding-left:10px;"><?php echo $row_Recordset2['Hiring_Details']; ?></td>
                           </tr>
                           <tr>
                             <td height="43.33333333" colspan="2" align="right" style="padding-left:10px; padding-right:5px;">Status:</td>
                             <td colspan="2" style="padding-left:10px;"><?php echo $row_Recordset2['Employer_Status']; ?></td>
                           </tr>
                         </table>
                         <form name="form1" method="post" action="javascript: void(0)" onclick="window.open('Jobseeker_ViewEmployer.php?ID=<?php echo $row_Recordset2['Employer_ID']; ?>', 
  'windowname1', 
  'width=auto, height=auto'); 
   return false;"  style="margin: 10px 10px 5px 300px; position:relative; float:left;">
                           <input type="submit" class="btn btn-success btn-lg buttonstyle"  name="btnview" id="btnview" value="View Profile" >
                         </form>
                       
                         <input type="submit" class="btn btn-success btn-lg buttonstyle" style="display: inline-block; float:left; margin: 10px 0px 30px 10px;"  name="btnview"  onclick="window.location.href='testingdeleteemployer.php?Employer_ID=<?php echo $row_Recordset2['Employer_ID']; ?>'" id="btnview" value="Decline" >
                         
                       </div>
                        
                          
                       <?php if ($row_Recordset2['Employer_Status'] == "UNVERIFIED"){?>
                         <form method="POST" name="form3" id="form3" action="<?php echo $editFormAction; ?>" >
                         <input type="hidden" name="Employer_Status" value="VERIFIED" />
                         <input type="hidden" name="Employer_ID" value="<?php echo $row_Recordset2['Employer_ID']; ?>" />
                         <input type="submit" class="btn btn-success btn-lg buttonstyle" style="display: inline-block; float:left; margin: 10px 0px 30px 10px;"  name="btnview" id="btnview" value="VERIFIED" >
                         <input type="hidden" name="MM_update" value="form3" />
                         </form>
                         <?php }  else {};?>
                       </div>
                         <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
                        
                         
</div>
</body>
</html>
<?php
mysql_free_result($Recordset2);

mysql_free_result($Recordset1);
?>
