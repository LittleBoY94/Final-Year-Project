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
  $MM_redirectLoginSuccess = "Admin_Homepage.php";
  $MM_redirectLoginFailed = "Admin_Login.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_busybee, $busybee);
  
  $LoginRS__query=sprintf("SELECT Username, Password FROM `admin` WHERE Username=%s AND Password=%s",
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
	<title>Admin Login</title>
	 
	<link href="css/bootstrap.css" rel="stylesheet">
	 
	<link href="css/main.css" rel="stylesheet">
 
	
 
	<link rel="shortcut icon" href="images\Icons\Batch-master\PNG\32x32\headphones.png">
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

<body style="overflow-x:hidden">
	<div class="preloader"></div>
	
    	
<main id="top" class="masthead" role="main">
  <div class="container">
			<div class="logo"><img class="logotitle" src="images/BusyBee.png" alt="logo"></a>
			</div>
 
			<h1 class= "fontstyle" style="text-shadow: 2px 2px #000;">Welcome<strong> <br>
			Admin!</h1>
 
	<div class="row">
			  <div class="col-md-6 col-sm-12 col-md-offset-3 subscribe mainboxstyle">
			    <section class="row features">
			      <div class="col-sm-6 col-md-3 boxstyle" style="float:none;">
			        <div class="thumbnail box1colour"> 
			          <p>&nbsp;</p>
			          <p><img src="images/service_01.png" alt="analytics-icon">
		              </p>
			          <p>&nbsp;</p>
			          <div class="caption">
			            <h3>Login</h3>
			            <form name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
			              <p>
			                <label for="txtusername2"></label>
			                <input type="text" placeholder="Username" name="txtusername" class="boxfontcolor textfield" id="txtusername2">
		                  </p>
			              <p>
			                <label for="txtpassword"></label>
			                <input type="password" name="txtpassword" placeholder="Password" class="boxfontcolor textfield" id="txtpassword">
			              </p>
			              <p>
			                <input type="submit" name="btnsubmit" class=" btn btn-success btn-lg buttonstyle1 fontstyle1" id="btnsubmit" value="Login">
			              </p>
			              <p>&nbsp;</p>
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
				  to Find Jobs!</strong></h1>
                  </div>
          			<div class="col-md-12 footerlinks footercta" role="main">
					<p style="text-shadow: 2px 2px #000;">&copy; 2016 BusyBee.co. All Rights Reserved</p>
			</div>
 
				<div class="row"></div>
			</div>
</main>

 
 
 
 
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
