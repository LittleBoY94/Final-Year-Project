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
if (isset($_GET['ID'])) {
  $colname_Recordset1 = $_GET['ID'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset1 = sprintf("SELECT * FROM employer WHERE Employer_ID = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $busybee) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);


?>
<!DOCTYPE html>
<html lang="en">
<head>
 
<head>
 
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="js/styles.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="js/script.js"></script>
    
	<meta name="description" content="">
	<title>Employer's Job Page</title>
	 
	<link href="css/bootstrap.css" rel="stylesheet">
	 
	<link href="css/main.css" rel="stylesheet">
 
	
 
	<link rel="shortcut icon" href="images\Icons\Batch-master\PNG\32x32\search.png">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

	<script src="js/pace.js"></script>
    
    
 
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,600' rel='stylesheet' type='text/css'>
	<style type="text/css">
	#apDiv1 {
	position: absolute;
	width: 200px;
	height: 115px;
	z-index: 1;		
}
	
    </style>
	<link href="css/Style1.css" rel="stylesheet" type="text/css">
	<style type="text/css">
	body,td,th {
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
}
    </style>
</head>
	<style type="text/css">
	body,td,th {
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
}
    </style>
</head>	

<body>	
	<div class="preloader"></div>
<div class="container" id="explore">
  <div class="section-title">
		  <div class="content">
		    <h2 align="center"> <?php echo $row_Recordset1['Username']; ?>'s Profile</h2>
	      </div>
		  <p>&nbsp;</p>
			  <div class="col-md-box" style="margin:auto; position:relative;">
				  <div class="boxheight fontcolor2">
				    <div class="content">
                        <div class="content">
                        <?php
						echo '<img height="200" width="200" src=data:image;base64,'.$row_Recordset1['Company_Pictures'];
						?>
                        </div>
                      <div align="center">
                        <h3>Company's Information</h3>
                          <table class="tablecolor tabletext" width="1092" height="261" border="0" style="font-weight:bold">
  <tr>
    <td width="117" height="59"><div align="right"><strong>Company Name:</strong></div></td>
    <td width="183"><strong><?php echo $row_Recordset1['Company_Name']; ?></strong></td>
    <td width="180"><div align="right"><strong>Company's Email:</strong></div></td>
    <td width="238"><strong><?php echo $row_Recordset1['Company_Email']; ?></strong></td>
    <td width="130"><div align="right"><strong>City:</strong></div></td>
    <td width="233"><strong><?php echo $row_Recordset1['City']; ?></strong></td>
  </tr>
  <tr>
    <td><div align="right"><strong>SSM Number:</strong></div></td>
    <td><strong><?php echo $row_Recordset1['SSM_No']; ?></strong></td>
    <td><div align="right"><strong>Company's Phone Number:</strong></div></td>
    <td><strong><?php echo $row_Recordset1['Company_PhoneNumber']; ?></strong></td>
    <td><div align="right"><strong>State:</strong></div></td>
    <td><strong><?php echo $row_Recordset1['States']; ?></strong></td>
  </tr>
  <tr>
    <td><div align="right"><strong>Establishment:</strong></div></td>
    <td><strong><?php echo $row_Recordset1['Establishment']; ?></strong></td>
    <td><div align="right"><strong>Company's Address:</strong></div></td>
    <td><strong><?php echo $row_Recordset1['Company_Address']; ?></strong></td>
    <td><div align="right"><strong>Country:</strong></div></td>
    <td><strong><?php echo $row_Recordset1['Country']; ?></strong></td>
  </tr>
  <tr>
    <td><div align="right"><strong>Industries:</strong></div></td>
    <td><strong><?php echo $row_Recordset1['Industries']; ?></strong></td>
    <td><div align="right"><strong>Post Code:</strong></div></td>
    <td><strong><?php echo $row_Recordset1['Post_Code']; ?></strong></td>
    <td><div align="right"><strong>Company's Website:</strong></div></td>
    <td><strong><?php echo $row_Recordset1['Company_Websites']; ?></strong></td>
  </tr>
  <tr>
    <td><div align="right"><strong>Company's Detail:</strong></div></td>
    <td colspan="3"><strong><?php echo $row_Recordset1['Company_Details']; ?></strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

                      </div>
                    </div> </div>
                    <div class="content" style="float:none;">
                    <div align="center">
                      <h3>Hiring Information</h3>	
                   <table class="tablecolor tabletext" width="859" height="138"  border="0"  style="font-weight:bold">
  <tr>
    <td width="160" height="43"><div align="right">Looking for:</div></td>
    <td width="291"><?php echo $row_Recordset1['Type_of_Employment']; ?></td>
    <td width="119"><div align="right">Location:</div></td>
    <td width="261"><?php echo $row_Recordset1['Location']; ?></td>
  </tr>
  <tr>
    <td><div align="right">Requirement skills: </div></td>
    <td><?php echo $row_Recordset1['Hiring_Skills']; ?></td>
    <td><div align="right">Hiring Details: </div></td>
    <td><?php echo $row_Recordset1['Hiring_Details']; ?></td>
  </tr>
</table> 
                  </div>
                    </div>
	   </div>                  
     </div>
     
</div>
   </div>
   <p>&nbsp;</p>
</div>
</div>
<?php
mysql_free_result($Recordset1);
?>
