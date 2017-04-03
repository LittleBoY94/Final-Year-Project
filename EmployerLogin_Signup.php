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

// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
echo $MM_dupKeyRedirect= '<script language="javascript">;
alert("The Email already Exist");
window.location.href = "EmployerLogin_Signup.php";
</script>';
  $loginUsername = $_POST['txtemailaddress'];
  $LoginRS__query = sprintf("SELECT Company_Email FROM employer WHERE Company_Email=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_busybee, $busybee);
  $LoginRS=mysql_query($LoginRS__query, $busybee) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO employer (Company_Email, Username, Password) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['txtemailaddress'], "text"),
                       GetSQLValueString($_POST['txtusername2'], "text"),
                       GetSQLValueString($_POST['txtpassword2'], "text"));

  mysql_select_db($database_busybee, $busybee);
  $Result1 = mysql_query($insertSQL, $busybee) or die(mysql_error());

  $insertGoTo = "employer_redirectlogin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['txtusername'])) {
  $loginUsername=$_POST['txtusername'];
  $password=$_POST['txtpassword'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "Employer_Homepage.php";
  echo $MM_redirectLoginFailed = '<script language="javascript">;
alert("Wrong Email or Password. Please try again.");
window.location.href = "EmployerLogin_Signup.php";
</script>';
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_busybee, $busybee);
  
  $LoginRS__query=sprintf("SELECT Username, Password FROM employer WHERE Username=%s AND Password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $busybee) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<title>Employer Login &amp; Signup</title>
	 
	<link href="css/bootstrap.css" rel="stylesheet">
	 
	<link href="css/main.css" rel="stylesheet">
 

 
	<link rel="shortcut icon" href="images\Icons\Batch-master\PNG\32x32\user.png">
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
</head>

<body>
	<div class="preloader"></div>
		
<main id="top" class="masthead" role="main">
  <div class="container">
			<div class="logo"> <a href="Homepage.php#"><img class="logotitle" src="images/BusyBee.png" alt="logo"></a>
			</div>
 
			<h1 class= "fontstyle" style="text-shadow: 2px 2px #000;">Welcome<strong> <br>
			Employer!</h1>
 
	<div class="row">
			  <div class="col-md-6 col-sm-12 col-md-offset-3 subscribe mainboxstyle">
			    <section class="row features">
			      <div class="col-sm-6 col-md-3 boxstyle" >
			        <div class="thumbnail"> 
			          <p>&nbsp;</p>
			          <p><img src="images/service_01.png" alt="analytics-icon">
		              </p>
			          <p>&nbsp;</p>
			          <div class="caption">
			            <h3>Login</h3>
			            <form name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
			              <p>
			                <label for="txtusername2"></label>
			                <input type="text" name="txtusername" placeholder="Username" class="boxfontcolor textfield" id="txtusername2">
		                  </p>
			              <p>
			                <label for="txtpassword"></label>
			                <input type="password" name="txtpassword" placeholder="Password" class="boxfontcolor textfield" id="txtpassword">
			              </p>
			              <p>
			                <input type="submit" name="btnsummit" class=" btn btn-success btn-lg buttonstyle1 fontstyle1" id="btnsummit" value="Login">
			              </p>
			              <p>&nbsp;</p>
			            </form>
			          </div>
		            </div>
			        <! --/thumbnail -->
		          </div>
			      <! --/col-sm-6-->
			      <div class="col-sm-6 col-md-3 boxstyle">
			        <div class="thumbnail"> 
			          <p>&nbsp;</p>
			          <p><img src="images/service_02.png" alt="analytics-icon">
		              </p>
			          <p>&nbsp;</p>
			          <div class="caption">
			            <h3>Sign Up</h3>
			            <form name="form2" method="POST" action="<?php echo $editFormAction; ?>">
			              <p>
			                <label for="txtemailaddress"></label>
			                <input type="text" name="txtemailaddress" placeholder="Email Address" class="boxfontcolor textfield" id="txtemailaddress">
		                  </p>
			              <p>
			                <label for="txtusername3"></label>
			                <input type="text" name="txtusername2" placeholder="Username" class="boxfontcolor textfield" id="txtusername3">
			              </p>
			              <p>
			                <label for="txtpassword"></label>
			                <input type="password" name="txtpassword2" placeholder="Password" class="boxfontcolor textfield" id="txtpassword">
			              </p>
			              <p>
			                <input type="submit" name="btnregister" class=" btn btn-success btn-lg buttonstyle1 fontstyle1" id="btnregister" value="Register">
			              </p>
			              <input type="hidden" name="MM_insert" value="form2">
			            </form>
			          </div>
		            </div>
			     
		          </div>
			    
		        </section>
			    </form>
			  </div>
    </div>
  </div>
</main>
   
		<main class="footercta" role="main">
			<div class="container">
				<h1 style="text-shadow: 2px 2px #000;"><strong>The Most Simple & Powerful Way <br>
				  to Post Jobs!</strong></h1>
 
				<div class="row"></div>
			</div>
</main>
 
		<div class="container">
			<section class="row breath">
				<div class="col-md-12 footerlinks">
					<p>&copy; 2016 BusyBee.co. All Rights Reserved</p>
				</div>
			</section>
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

 
</body>
</html>
