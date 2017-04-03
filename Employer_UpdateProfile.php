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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form4")) {
  $updateSQL = sprintf("UPDATE employer SET Type_of_Employment=%s, Hiring_Skills=%s, Location=%s, Hiring_Details=%s WHERE Employer_ID=%s",
                       GetSQLValueString($_POST['Type_of_Employment'], "text"),
                       GetSQLValueString($_POST['Hiring_Skills'], "text"),
                       GetSQLValueString($_POST['Location'], "text"),
                       GetSQLValueString($_POST['Hiring_Details'], "text"),
                       GetSQLValueString($_POST['Employer_ID'], "int"));

  mysql_select_db($database_busybee, $busybee);
  $Result1 = mysql_query($updateSQL, $busybee) or die(mysql_error());

  $updateGoTo = "Employer_Homepage.php#popup2";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE employer SET Company_Name=%s, SSM_No=%s, Establishment=%s, Industries=%s, Company_Email=%s, Company_PhoneNumber=%s, Company_Address=%s, Post_Code=%s, City=%s, States=%s, Country=%s, Company_Websites=%s, Company_Details=%s WHERE Employer_ID=%s",
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

  $updateGoTo = "Employer_Homepage.php#popup1";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "";
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
<!DOCTYPE html>
<html lang="en">
<head>
 
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="js/styles.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="js/script.js"></script>
    
	<meta name="description" content="">
	<title>Employer's Update Profile</title>
	 
	<link href="css/bootstrap.css" rel="stylesheet">
	 
	<link href="css/main.css" rel="stylesheet">
 
	<link rel="shortcut icon" href="images\Icons\Batch-master\PNG\32x32\book.png">
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

<body>
<div class="preloader"></div>
	
<main id="top" class="masthead" role="main">
  <div class="container">
			<div class="logo"> <a href="Homepage.php#"><img class="logotitle" src="images/BusyBee.png" alt="logo"></a>
			</div>
 
	<h1 class= "fontstyle" >Welcome <?php echo $row_Recordset1['Username']; ?>!<br>
	</h1>
 
			<div class="row"></div>
  </div>
</main>
 	<main class="footercta" role="main"> 
<div class="container" id="explore">
	  <section class="row heroimg breath">
		  <div class="col-md-12 text-center"><div id="cssmenu">
<ul>
   <li class='active'><a href='#'>Home</a></li>
   <li><a href='#'>Jobs</a></li>
   <li><a href='#'>Profile</a></li>
   <li><a href='<?php echo $logoutAction ?>'>LOGOUT</a></li>
</ul>
</div></div>
	  </section></div></main>
   <div class="container" id="explore">
		<div class="section-title" id="stay1">
 
			<div class="section-title">
				<h2>Steps to be an Employer! </h2>
				<h4>No contract. No risk. No credit card required. </h4>
				<h4>Time for HIRING! </h4>
			</div></div>
           
			<section class="row breath planpricing">
			  <div class="col-md-employer" style="float:none; margin: auto;">
			    <div class="pricing color1  boxheight fontstyle1">
			      <div class="planname">
			        <div align="center">upload your company logo</div>
		          </div>
			      <div class="price">
			        <div align="center"><span class="curr"> logo</span><span class="per"></span></div>
		          </div>
			      <div class="billing">
			        <p align="center">Company Information</p>
		          </div>
			      <div align="center">
			        <input type="submit" name="btnupdate2" class="btn btn-success btn-lg buttonstyle" onclick="window.location.href='#popup1'" id="btnupdate2" value="Submit">
		          </div>
		        </div>
		      </div>
			  <p>&nbsp;</p>
                    		<div class="col-md-employer">
				  <div class="pricing color1  boxheight fontstyle1">
						<div class="planname">
						  <div align="center">Step 1</div>
						</div>
						<div class="price">
						  <div align="center"><span class="curr"> Company Details</span><span class="per"></span></div>
						</div>
						<div class="billing">
						  <p align="center">Company Information</p>
						</div>
			          
				          <div align="center">
				            <input type="submit" name="btnupdate" class="btn btn-success btn-lg buttonstyle" onclick="window.location.href='#popup1'" id="btnupdate" value="Submit">
				            
		              </div>
				  </div>
				</div>
				<div class="col-md-employer">
					<div class="pricing color2 boxheight fontstyle1">
						<div class="planname">
						  <div align="center">Step 2</div>
						</div>
						<div class="price"> 
						  <div align="center"><span class="curr">Hiring Interest </span><span class="per"></span></div>
						</div>
						<div class="billing">
                        <p align="center">Hiring Details</p>
                        </div>
                        
                        <div align="center">
                          <input type="submit" name="btnupdate" class="btn btn-success btn-lg buttonstyle" onclick="window.location.href='#popup2'" id="btnupdate" value="Submit">
                        </div>
					</div>
					<div align="center">
				  </div>
				</div>
				<div align="center">
			  </div>
				<p align="center">&nbsp;</p>
                       
                <p align="center"></p>	
                <div align="center"><a href="Employer_Homepage.php" class="btn btn-success btn-lg gototop buttonstyle">VIEW NOW!</a> 
                  
                </div>
  </section> 

          <div align="center">
             
	          
          </div>
        <section class="row faq breath"></section>
 
</div></div>
<div class="col-md-12 footerlinks footercta" role="main">
					<p>&copy; 2016 BusyBee.co. All Rights Reserved</p>
			</div>
 
 
 
 
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/easing.js"></script>
<script src="js/nicescroll.js"></script>
 
 
<script>


 $(function() {
    $('.scrollto, .gototop').bind('click',function(event){
		 var $anchor = $(this);
		 $('html, body').stop().animate({
         scrollTop: $($anchor.attr('href')).offset().top
          }, 1500,'easeInOutExpo');
     event.preventDefault();
      });
  });
        

</script>
<div id="popup1" class="overlay">
	<div class="popup">
		<h2 align="center">Personal Informations</h2>
		<a class="close" href="Employer_Homepage.php#stay1">&times;</a>
		<div class="content">
			</form>
<form action="<?php echo $editFormAction; ?>" method="POST" name="form1" id="form1">
  <table width="369" height="426" align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Company Name:</td>
      <td><input type="text" name="Company_Name" class="textfield" style="color:#000;" value="<?php echo htmlentities($row_Recordset1['Company_Name'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">SSM No:</td>
      <td><input type="text" name="SSM_No" class="textfield" style="color:#000;" value="<?php echo htmlentities($row_Recordset1['SSM_No'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Year of Establishment:</td>
      <td><input type="text" name="Establishment" class="textfield" style="color:#000;" value="<?php echo htmlentities($row_Recordset1['Establishment'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Industries:</td>
      <td><input type="text" name="Industries" class="textfield" style="color:#000;" value="<?php echo htmlentities($row_Recordset1['Industries'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Company Email:</td>
      <td><input type="text" name="Company_Email" class="textfield" style="color:#000;" value="<?php echo htmlentities($row_Recordset1['Company_Email'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Company Phone Number:</td>
      <td><input type="text" name="Company_PhoneNumber" style="color:#000;" class="textfield" value="<?php echo htmlentities($row_Recordset1['Company_PhoneNumber'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Company Address:</td>
      <td><input type="text" name="Company_Address" style="color:#000;" class="textfield" value="<?php echo htmlentities($row_Recordset1['Company_Address'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Post Code:</td>
      <td><input type="text" name="Post_Code" class="textfield" style="color:#000;" value="<?php echo htmlentities($row_Recordset1['Post_Code'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">City:</td>
      <td><input type="text" name="City" class="textfield" style="color:#000;" value="<?php echo htmlentities($row_Recordset1['City'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">States:</td>
      <td><input type="text" name="States" class="textfield" style="color:#000;" value="<?php echo htmlentities($row_Recordset1['States'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Country:</td>
      <td><input type="text" name="Country" class="textfield" style="color:#000;" value="<?php echo htmlentities($row_Recordset1['Country'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Company Websites:</td>
      <td><input type="text" name="Company_Websites" style="color:#000;" class="textfield" value="<?php echo htmlentities($row_Recordset1['Company_Websites'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td height="31" align="right" nowrap="nowrap">Company Details:</td>
      <td><input type="text" name="Company_Details" style="color:#000;" class="textfield" value="<?php echo htmlentities($row_Recordset1['Company_Details'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" class="btn btn-success btn-lg buttonstyle" value="Update record" /></td>
    </tr>
  </table>
  <p>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="Employer_ID" value="<?php echo $row_Recordset1['Employer_ID']; ?>" />
  </p>
</form>
		</div>
	</div></div>
     <div id="popup2" class="overlay">
	<div class="popup">
		<h2 align="center">Hiring Interest</h2>
		<a class="close" href="Employer_Homepage.php#stay1">&times;</a>
		<div class="content">
		  <form action="<?php echo $editFormAction; ?>" method="POST" name="form4" id="form4">
		    <table width="356" height="187" align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Type of Employment:</td>
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
      <td nowrap="nowrap" align="right">Hiring Skills:</td>
      <td><input type="text" name="Hiring_Skills" style="color:#000;" class="textfield" value="<?php echo htmlentities($row_Recordset1['Hiring_Skills'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Location:</td>
      <td><input type="text" name="Location" class="textfield" style="color:#000;" value="<?php echo htmlentities($row_Recordset1['Location'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td height="34" align="right" nowrap="nowrap">Hiring Details:</td>
      <td><input type="text" name="Hiring_Details" style="color:#000;" class="textfield" value="<?php echo htmlentities($row_Recordset1['Hiring_Details'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" class="btn btn-success btn-lg buttonstyle" value="Update Details" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form4" />
  <input type="hidden" name="Employer_ID" value="<?php echo $row_Recordset1['Employer_ID']; ?>" />
</form>
		</div>
	</div></div>


 
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
