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

<?php
  ini_set('mysql.connect_timeout', 300);
  ini_set('default_socket_timeout', 300);
?>
 <?php
    if(isset($_POST['sumit']))
      {
        if(getimagesize($_FILES['Company_Pictures']['tmp_name']) == FALSE)
        {
          echo "<script>alert('Please upload a picture.')</script>";
        }
        else
        {
          $image= addslashes($_FILES['Company_Pictures']['tmp_name']);
          $name= addslashes($_FILES['Company_Pictures']['name']);
          $image= file_get_contents($image);
          $image= base64_encode($image);
      
        $con=mysql_connect("localhost", "root", "");
        mysql_select_db("busybee",$con);
$var1=$row_Recordset1['Employer_ID'];      
$qry="UPDATE employer SET Company_Pictures='$image' WHERE Employer_ID ='".$var1."'";
        $result=mysql_query($qry, $con);
        if($result)
        {
          echo "<script>alert('You have successfully upload your picture.')</script>";
        }
        else
        {
          echo "<script>alert('Fail upload your picture.')</script>";
        }
		
      }
	  }
      ?>
<!DOCTYPE html>
<html lang="en">
<head>
 
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<title>Employer's Homepage</title>
	 
	<link href="css/bootstrap.css" rel="stylesheet">
	 
	<link href="css/main.css" rel="stylesheet">
 
	<link rel="shortcut icon" href="images\Icons\Batch-master\PNG\32x32\book.png">
	<script src="js/pace.js"></script>
    <link rel="stylesheet" href="js/styles.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="js/script.js"></script>
 
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
    #apDiv2 {
	background-color: #FFF;
	margin: auto;
	padding:auto;
	width: 500px;
}
    </style>
</head>

<body>
<div class="preloader"></div>
	
   	
<main id="top" class="masthead" role="main">
  <div class="container">
			<div class="logo"><img class="logotitle" src="images/BusyBee.png" alt="logo"></a>
			</div>
 
			<h1 style="text-shadow: 2px 2px #000;">The Most Beautiful and <strong>Effective Way</strong> <br>
			to <strong>Post Jobs</strong>.</h1>
 
	<div class="row">
	 <h1 class= "fontstyle" style="text-shadow: 2px 2px #000;"><?php echo $row_Recordset1['Username']; ?><strong>'s Profile<br>
	</h1>
    </div>
  </div>
</main>
  
		<main class="footercta" role="main">
        <div class="container containermargin" id="explore">
	  <section class="row heroimg breath">
		  <div class="col-md-12 text-center"><div id="cssmenu">
<ul>
   <li class='active'><a href='Employer_JobPage.php'>Home</a></li>
   <li><a href='Employer_MainSearch.php'>Search</a></li>
   <li><a href='Employer_ViewProfile.php'>Profile</a></li>
   <li><a href="<?php echo $logoutAction ?>">LOGOUT</a></li>
</ul>
</div></div></section></div>
			<div class="maincontainer">
             <div id= "stay1" class="price" align="center" style="border: 3px solid #f15c5c; width:20%; padding: 10px; float:none; margin:auto;"><form method="post" enctype="multipart/form-data" class="file-input-wrapper">
                  <div align="center">
                  <h3 style="color:#333;">Please Upload Your picture. </h3>
                    <input type="file" name="Company_Pictures" class=""  data-buttonName="btn-primary" style="color:#333;">
                    <br/>
                    <input type="submit" name="sumit" value="Upload" class="btn btn-success btn-lg buttonstyle" style="width:100px; height:40px; padding:0;"/>
             </div>
               </form></div>
                    <div class="col-md-employer">
					<div class="pricing">
						
						<div id= "stay1" class="price"><input type="submit" name="btnupdate" class="btn btn-success btn-lg buttonstyle btncolor1 fontstyle2 boxwidth" onclick="window.location.href='#popup1'" id="btnupdate" value="Company Information"></div>
						
					</div>
				</div>
              <div class="col-md-employer">
					<div class="pricing">
						
						<div id= "stay1" class="price"><input type="submit" name="btnupdate" class="btn btn-success btn-lg buttonstyle btncolor2 fontstyle2 boxwidth" onclick="window.location.href='#popup2'" id="btnupdate" value="Hiring Interest"></div>
						
					</div>
				</div> <input type="submit" name="btnupdate" class="btn btn-success btn-lg buttonstyle  fontstyle2" onclick="window.location.href='Employer_ViewProfile.php'" id="btnupdate" value="View Profile">
			  <div class="row"></div>
			</div>
</main>
 </div>
<div class="col-md-12 footerlinks footercta" role="main">
					<p style="text-shadow: 2px 2px #000;">&copy; 2016 BusyBee.co. All Rights Reserved</p>
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
		<h2 align="center">Company Informations</h2>
		<div align="center"><a class="close" href="Employer_Homepage.php#stay1">&times;</a>
	  </div>
		<div class="content">
          <div align="center">
            <table width="484" height="472" border="0">
  <tr>
    <td width="172">Company Name:</td>
    <td width="244"><?php echo $row_Recordset1['Company_Name']; ?></td>
  </tr>
  <tr>
    <td>SSM Number:</td>
    <td><?php echo $row_Recordset1['SSM_No']; ?></td>
  </tr>
  <tr>
    <td>Establishment:</td>
    <td><?php echo $row_Recordset1['Establishment']; ?></td>
  </tr>
  <tr>
    <td>Industries:</td>
    <td><?php echo $row_Recordset1['Industries']; ?></td>
  </tr>
  <tr>
    <td>Company's Email: </td>
    <td><?php echo $row_Recordset1['Company_Email']; ?></td>
  </tr>
  <tr>
    <td>Company's Phone Number:</td>
    <td><?php echo $row_Recordset1['Company_PhoneNumber']; ?></td>
  </tr>
  <tr>
    <td>Company's Address:</td>
    <td><?php echo $row_Recordset1['Company_Address']; ?></td>
  </tr>
  <tr>
    <td>Post Code:</td>
    <td><?php echo $row_Recordset1['Post_Code']; ?></td>
  </tr>
  <tr>
    <td>City: </td>
    <td><?php echo $row_Recordset1['City']; ?></td>
  </tr>
  <tr>
    <td>State:</td>
    <td><?php echo $row_Recordset1['States']; ?></td>
  </tr>
  <tr>
    <td>Country:</td>
    <td><?php echo $row_Recordset1['Country']; ?></td>
  </tr>
  <tr>
    <td height="25">Company's Website:</td>
    <td><?php echo $row_Recordset1['Company_Websites']; ?></td>
  </tr>
  <tr>
    <td height="50">Company's Details:</td>
    <td><?php echo $row_Recordset1['Company_Details']; ?></td>
  </tr>
   <td><form id="form1" name="form1" method="post" action="Employer_Profile.php#popup1">
      <input type="submit" name="btndone" id="btndone" class="btn btn-success btn-lg buttonstyle" value="Insert Details" />
    </form></td>
    <td><form id="form2" name="form2" method="post" action="Employer_UpdateProfile.php#popup1">
      <div align="right">
        <input type="submit" name="btnedit" id="btnedit" class="btn btn-success btn-lg buttonstyle" value="Edit" />
      </div>
    </form></td>
  </tr>
</table>

          </div>
	    </div>
</div></div>
    <div id="popup2" class="overlay">
      <div class="popup">
	  <h2 align="center">Hiring Interest</h2>
		<div align="center"><a class="close" href="Employer_Homepage.php#stay1">&times;</a>
	  </div>
		<div class="content">
		  <div align="center"><table width="450" height="288" border="0">
              <tr>
                <td width="213">Looking for:</td>
                <td width="227"><?php echo $row_Recordset1['Type_of_Employment']; ?></td>
              </tr>
              <tr>
                <td>Requirement skills: </td>
                <td><?php echo $row_Recordset1['Hiring_Skills']; ?></td>
              </tr>
              <tr>
                <td>Preferred location:</td>
                <td><?php echo $row_Recordset1['Location']; ?></td>
              </tr>
              <tr>
                <td>Hiring details: </td>
                <td><?php echo $row_Recordset1['Hiring_Details']; ?></td>
              </tr>
              <tr>
                <td><form id="form1" name="form1" method="post" action="Employer_Profile.php#popup2">
                  <div align="left">
                    <input type="submit" name="btndone2" class="btn btn-success btn-lg buttonstyle" id="btndone2" value="Insert Details" />
                  </div>
                </form></td>
                <td><form id="form2" name="form2" method="post" action="Employer_UpdateProfile.php#popup2">
                  <div align="right">
                    <input type="submit" name="btnedit" class="btn btn-success btn-lg buttonstyle" id="btnedit" value="Edit" />
                  </div>
                </form></td>
              </tr>
  </table></div>
	    </div>
</div></div>

 
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
