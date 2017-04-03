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

$currentPage = $_SERVER["PHP_SELF"];

$colname_Recordset1 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset1 = $_SESSION['MM_Username'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset1 = sprintf("SELECT * FROM jobseeker WHERE Username = %s", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $busybee) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$maxRows_Recordset2 = 1;
$pageNum_Recordset2 = 0;
if (isset($_GET['pageNum_Recordset2'])) {
  $pageNum_Recordset2 = $_GET['pageNum_Recordset2'];
}
$startRow_Recordset2 = $pageNum_Recordset2 * $maxRows_Recordset2;

$colname_Recordset2 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset2 = $_SESSION['MM_Username'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset2 = sprintf("Select * FROM jobseeker natural join education_level where Username=%s", GetSQLValueString($colname_Recordset2, "text"));
$query_limit_Recordset2 = sprintf("%s LIMIT %d, %d", $query_Recordset2, $startRow_Recordset2, $maxRows_Recordset2);
$Recordset2 = mysql_query($query_limit_Recordset2, $busybee) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);

if (isset($_GET['totalRows_Recordset2'])) {
  $totalRows_Recordset2 = $_GET['totalRows_Recordset2'];
} else {
  $all_Recordset2 = mysql_query($query_Recordset2);
  $totalRows_Recordset2 = mysql_num_rows($all_Recordset2);
}
$totalPages_Recordset2 = ceil($totalRows_Recordset2/$maxRows_Recordset2)-1;

$maxRows_Recordset3 = 1;
$pageNum_Recordset3 = 0;
if (isset($_GET['pageNum_Recordset3'])) {
  $pageNum_Recordset3 = $_GET['pageNum_Recordset3'];
}
$startRow_Recordset3 = $pageNum_Recordset3 * $maxRows_Recordset3;

$colname_Recordset3 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset3 = $_SESSION['MM_Username'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset3 = sprintf("SELECT * FROM jobseeker natural join jobseeker_experiences WHERE Username=%s", GetSQLValueString($colname_Recordset3, "text"));
$query_limit_Recordset3 = sprintf("%s LIMIT %d, %d", $query_Recordset3, $startRow_Recordset3, $maxRows_Recordset3);
$Recordset3 = mysql_query($query_limit_Recordset3, $busybee) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);

if (isset($_GET['totalRows_Recordset3'])) {
  $totalRows_Recordset3 = $_GET['totalRows_Recordset3'];
} else {
  $all_Recordset3 = mysql_query($query_Recordset3);
  $totalRows_Recordset3 = mysql_num_rows($all_Recordset3);
}
$totalPages_Recordset3 = ceil($totalRows_Recordset3/$maxRows_Recordset3)-1;

$queryString_Recordset3 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset3") == false &&
        stristr($param, "totalRows_Recordset3") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset3 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset3 = sprintf("&totalRows_Recordset3=%d%s", $totalRows_Recordset3, $queryString_Recordset3);

$queryString_Recordset2 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset2") == false &&
        stristr($param, "totalRows_Recordset2") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset2 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset2 = sprintf("&totalRows_Recordset2=%d%s", $totalRows_Recordset2, $queryString_Recordset2);
?>

<?php
  ini_set('mysql.connect_timeout', 300);
  ini_set('default_socket_timeout', 300);
?>
 <?php
    if(isset($_POST['sumit']))
      {
        if(getimagesize($_FILES['Pictures']['tmp_name']) == FALSE)
        {
         echo "<script>alert('Please upload a picture.')</script>";
        }
        else
        {
          $image= addslashes($_FILES['Pictures']['tmp_name']);
          $name= addslashes($_FILES['Pictures']['name']);
          $image= file_get_contents($image);
          $image= base64_encode($image);

        $con=mysql_connect("localhost", "root", "");
        mysql_select_db("busybee",$con);
$var1=$row_Recordset1['Jobseeker_ID'];
$qry="UPDATE jobseeker SET Pictures='$image' WHERE Jobseeker_ID ='".$var1."'";
        $result=mysql_query($qry, $con);
        if($result)
        {
          echo "<script>alert('You have successfully upload your picture.')</script>";
        }
        else
        {
          echo "<script>alert('Fail toupload your picture.')</script>";
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
	<title>Jobseeker's Homepage</title>

	<link href="css/bootstrap.css" rel="stylesheet">

	<link href="css/main.css" rel="stylesheet">



	<link rel="shortcut icon" href="images\Icons\Batch-master\PNG\32x32\paper-roll.png">
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


	<div class="row">
	 <h1 class= "fontstyle" style="text-shadow: 2px 2px #000;"><strong><?php echo $row_Recordset1['Username']; ?>'s Profile<br>
	</h1>
    </div>
  </div>
	</main>



		<main class="footercta" role="main">
        <div class="container" id="explore">
	  <section class="row heroimg breath">
		  <div class="col-md-12 text-center"><div id="cssmenu">
<ul>
   <li class='active'><a href='jobseeker_JobPage.php'>Home</a></li>
   <li><a href='Jobseeker_MainSearch.php'>Search</a></li>
   <li><a href='Jobseeker_ViewProfile.php'>Profile</a></li>
   <li><a href='<?php echo $logoutAction ?>'>LOGOUT</a></li>
</ul>
</div></div></section></div>
			<div class="maincontainer">
           <div id= "stay1" class="price" align="center" style="border: 3px solid #f15c5c; width:20%; padding: 10px; float:none; margin:auto;"><form method="post" enctype="multipart/form-data" class="file-input-wrapper">
                  <div align="center">
                  <h3 style="color:#333;">Please Upload Your picture. </h3>
                    <input type="file" name="Pictures" class=""  data-buttonName="btn-primary" style="color:#333;">
                    <br/>
                    <input type="submit" name="sumit" value="Upload" class="btn btn-success btn-lg buttonstyle" style="width:100px; height:40px; padding:0;"/>
             </div>
               </form></div>
                    <div class="col-md-4">
					<div class="pricing">

						<div id= "stay1" class="price"><input type="submit" name="btnupdate" class="btn btn-success btn-lg buttonstyle btncolor1 fontstyle2 boxwidth" onclick="window.location.href='#popup1'" id="btnupdate" value="Basic Information"></div>

					</div>
				</div>
                <div class="col-md-4">
					<div class="pricing">

						<div id= "stay1" class="price"><input type="submit" name="btnupdate" class="btn btn-success btn-lg buttonstyle btncolor2 fontstyle2 boxwidth" onclick="window.location.href='#popup2'" id="btnupdate" value="Education Details"></div>

					</div>
				</div>
                <div class="col-md-4">
					<div class="pricing">

						<div id= "stay1" class="price"><input type="submit" name="btnupdate" class="btn btn-success btn-lg buttonstyle btncolor3 fontstyle2 boxwidth" onclick="window.location.href='#popup3'" id="btnupdate" value="Job Matching Details"></div>

					</div>
				</div>
                <div class="col-md-4">
					<div class="pricing">

						<div id= "stay1" class="price"><input type="submit" name="btnupdate" class="btn btn-success btn-lg buttonstyle btncolor4 fontstyle2 boxwidth" onclick="window.location.href='#popup4'" id="btnupdate" value="Working Experiences"></div>

					</div>
				</div>

		<div class="container">
			<section class="row breath"><input type="submit" name="btnupdate" class="btn btn-success btn-lg buttonstyle  fontstyle2" onclick="window.location.href='Jobseeker_ViewProfile.php'" id="btnupdate" value="View Profile">
			</section>
		</div></div>
          			<div class="col-md-12 footerlinks footercta" role="main">
					<p style="text-shadow: 2px 2px #000;">&copy; 2016 BusyBee.co. All Rights Reserved</p>
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
<div id="popup1" class="overlay">
	<div class="popup">
		<h2 align="center">Basic Informations</h2>
		<div align="center"><a class="close" href="Jobseeker_Homepage.php#stay1">&times;</a>
	  </div><div class="content">
		  <div align="center">
          </table><table width="453" height="643" border="0">
  <tr>
    <td width="178"><div align="left"><strong>First Name:</strong></div></td>
    <td width="155"><?php echo $row_Recordset1['First_Name']; ?></td>
  </tr>
  <tr>
    <td><div align="left"><strong>Last Name:</strong></div></td>
    <td><?php echo $row_Recordset1['Last_Name']; ?></td>
  </tr>
  <tr>
    <td><div align="left"><strong>Date of Birth:</strong></div></td>
    <td><?php echo $row_Recordset1['DoB']; ?></td>
  </tr>
  <tr>
    <td><div align="left"><strong>Gender:</strong></div></td>
    <td><?php echo $row_Recordset1['Gender']; ?></td>
  </tr>
  <tr>
    <td><div align="left"><strong>Phone Number:</strong></div></td>
    <td><?php echo $row_Recordset1['Jobseeker_PhoneNumber']; ?></td>
  </tr>
  <tr>
    <td><div align="left"><strong>Address:</strong></div></td>
    <td><?php echo $row_Recordset1['Jobseeker_Address']; ?></td>
  </tr>
  <tr>
    <td><div align="left"><strong>City:</strong></div></td>
    <td><?php echo $row_Recordset1['City']; ?></td>
  </tr>
  <tr>
    <td><div align="left"><strong>State:</strong></div></td>
    <td><?php echo $row_Recordset1['State']; ?></td>
  </tr>
  <tr>
    <td><div align="left"><strong>Post Code:</strong></div></td>
    <td><?php echo $row_Recordset1['Post_Code']; ?></td>
  </tr>
  <tr>
    <td><div align="left"><strong>Country:</strong></div></td>
    <td><?php echo $row_Recordset1['Country']; ?></td>
  </tr>
  <tr>
    <td><div align="left"><strong>Nationality:</strong></div></td>
    <td><?php echo $row_Recordset1['Nationality']; ?></td>
  </tr>
  <tr>
    <td height="46"><div align="left"><strong>About Me:</strong></div></td>
    <td><?php echo $row_Recordset1['About_Me']; ?></td>
  </tr>
  <tr>
    <td height="62"><form id="form4" name="form4" method="post" action="Jobseeker_Profile.php#popup1">
      <div align="left">
        <input type="submit" name="btndone4" id="btndone4" class="btn btn-success btn-lg buttonstyle" value="Insert Details" />
      </div>
    </form></td>
    <td height="62"><form name="form7" method="post" action="Jobseeker_ProfileUpdate.php#popup1">
      <div align="right">
        <input type="submit" name="btnedit4" id="btnedit4" class="btn btn-success btn-lg buttonstyle" value="Edit">
      </div>
    </form></td>
  </tr>
</table>
          </div>
	    </div>
</div></div>
    <div id="popup2" class="overlay">
	<div class="popup">
		<h2 align="center">Education Details</h2>
		<div align="center"><a class="close" href="Jobseeker_Homepage.php#stay1">&times;</a>
	  </div>
		<div class="content">
		  <div align="center">
		    <?php do { ?>
	        <table width="450" height="288" border="0">
		        <tr>
		          <td><strong>Education Level: </strong></td>
		          <td><?php echo $row_Recordset2['Education_Level']; ?></td>
	            </tr>
		        <tr>
		          <td><strong>Institution Name: </strong></td>
		          <td><?php echo $row_Recordset2['Institution_Name']; ?></td>
	            </tr>
		        <tr>
		          <td><strong>From: </strong></td>
		          <td><?php echo $row_Recordset2['Year1']; ?> - <?php echo $row_Recordset2['Year2']; ?></td>
	            </tr>
		        <tr>
		          <td><strong>Course Name: </strong></td>
		          <td><?php echo $row_Recordset2['Course_Name']; ?></td>
	            </tr>
		        <tr>
		          <td><strong>Main Language: </strong></td>
		          <td><?php echo $row_Recordset2['Languages']; ?></td>
	            </tr>
		        <tr>
		          <td><form id="form1" name="form1" method="post" action="Jobseeker_Profile.php#popup2">
		            <div align="left">
		              <input type="submit" name="btndone" class="btn btn-success btn-lg buttonstyle" id="btndone" value="Add Education" />
	                </div>
		            </form></td>
		          <td><form name="form8" method="post" action="Jobseeker_ProfileUpdate.php?id=<?php echo $row_Recordset2['Education_ID']; ?>&#popup2">
		            <div align="right">
		              <input type="submit" name="btnedit" class="btn btn-success btn-lg buttonstyle" id="btnedit" value="Edit"/>
	                </div>
		            </form></td>
	            </tr>
	        </table>
		      <table align="center" width="231" border="0">
		        <tr>
		          <td><?php if ($pageNum_Recordset2 > 0) { // Show if not first page ?>
		              <a href="<?php printf("%s?pageNum_Recordset2=%d%s#popup2", $currentPage, 0, $queryString_Recordset2); ?>"><img src="First.gif"></a>
	              <?php } // Show if not first page ?></td>
		          <td><?php if ($pageNum_Recordset2 > 0) { // Show if not first page ?>
		              <a href="<?php printf("%s?pageNum_Recordset2=%d%s#popup2", $currentPage, max(0, $pageNum_Recordset2 - 1), $queryString_Recordset2); ?>"><img src="Previous.gif"></a>
	              <?php } // Show if not first page ?></td>
		          <td><?php if ($pageNum_Recordset2 < $totalPages_Recordset2) { // Show if not last page ?>
		              <a href="<?php printf("%s?pageNum_Recordset2=%d%s#popup2", $currentPage, min($totalPages_Recordset2, $pageNum_Recordset2 + 1), $queryString_Recordset2); ?>"><img src="Next.gif"></a>
	              <?php } // Show if not last page ?></td>
		          <td><?php if ($pageNum_Recordset2 < $totalPages_Recordset2) { // Show if not last page ?>
		              <a href="<?php printf("%s?pageNum_Recordset2=%d%s#popup2", $currentPage, $totalPages_Recordset2, $queryString_Recordset2); ?>"><img src="Last.gif"></a>
	              <?php } // Show if not last page ?></td>
	            </tr>
	        </table>
		      <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
          </div>
	    </div>
</div></div>
    <div id="popup3" class="overlay">
	<div class="popup">
		<h2 align="center">Job Matching Details</h2>
		<div align="center"><a class="close" href="Jobseeker_Homepage.php#stay1">&times;</a>
	  </div>
		<div class="content">
		  <div align="center">
		    <table width="450" height="255" border="0">
		      <tr>
		        <td><strong>Job Role: </strong></td>
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
		        <td><form id="form2" name="form1" method="post" action="Jobseeker_Profile.php#popup3">
		          <div align="left">
		            <input type="submit" name="btndone2" class="btn btn-success btn-lg buttonstyle" id="btndone2" value="Insert Details" />
	              </div>
	            </form></td>
		        <td><form name="form5" method="post" action="Jobseeker_ProfileUpdate.php#popup3">
               <div align="right">
		            <input type="submit" name="btnedit2" class="btn btn-success btn-lg buttonstyle" id="btnedit2" value="Edit">
                    </div>
	            </form></td>
	          </tr>
	        </table>
	      </div>
	    </div>
</div></div>
    <div id="popup4" class="overlay">
      <div class="popup">
	  <h2 align="center">Working Experiences</h2>
		<div align="center"><a class="close" href="Jobseeker_Homepage.php#stay1">&times;</a>
	  </div>
		<div class="content">
		  <div align="center">
		    <table width="450" height="197" border="0">
		      <tr>
		        <td><strong>Previous Company: </strong></td>
		        <td><?php echo $row_Recordset3['Ex_Company']; ?></td>
	          </tr>
		      <tr>
		        <td><strong>Working Duration: </strong></td>
		        <td><?php echo $row_Recordset3['Ex_Year']; ?></td>
	          </tr>
		      <tr>
		        <td><strong>Working Position: </strong></td>
		        <td><?php echo $row_Recordset3['Positions']; ?></td>
	          </tr>
		      <tr>
		        <td><strong>Details: </strong></td>
		        <td><?php echo $row_Recordset3['Details']; ?></td>
	          </tr>
		      <tr>
		        <td><form id="form3" name="form1" method="post" action="Jobseeker_Profile.php#popup4">
		          <div align="left">
		            <input type="submit" name="btndone3" class="btn btn-success btn-lg buttonstyle" id="btndone3" value="Add" />
	              </div>
	            </form></td>
		        <td><form name="form6" method="post" action="Jobseeker_ProfileUpdate.php?id=<?php echo $row_Recordset3['Experience_ID']; ?>#popup4">
                <div align="right">
		          <input type="submit" name="btnedit3" class="btn btn-success btn-lg buttonstyle" id="btnedit3" value="Edit"/>
                  </div>
	            </form></td>
	          </tr>
	        </table>
            <table align="center" width="232" border="0">
              <tr>
                <td><?php if ($pageNum_Recordset3 > 0) { // Show if not first page ?>
                    <a href="<?php printf("%s?pageNum_Recordset3=%d%s#popup4", $currentPage, 0, $queryString_Recordset3); ?>"><img src="First.gif"></a>
                <?php } // Show if not first page ?></td>
                <td><?php if ($pageNum_Recordset3 > 0) { // Show if not first page ?>
                    <a href="<?php printf("%s?pageNum_Recordset3=%d%s#popup4", $currentPage, max(0, $pageNum_Recordset3 - 1), $queryString_Recordset3); ?>"><img src="Previous.gif"></a>
                <?php } // Show if not first page ?></td>
                <td><?php if ($pageNum_Recordset3 < $totalPages_Recordset3) { // Show if not last page ?>
                    <a href="<?php printf("%s?pageNum_Recordset3=%d%s#popup4", $currentPage, min($totalPages_Recordset3, $pageNum_Recordset3 + 1), $queryString_Recordset3); ?>"><img src="Next.gif"></a>
                <?php } // Show if not last page ?></td>
                <td><?php if ($pageNum_Recordset3 < $totalPages_Recordset3) { // Show if not last page ?>
                    <a href="<?php printf("%s?pageNum_Recordset3=%d%s#popup4", $currentPage, $totalPages_Recordset3, $queryString_Recordset3); ?>"><img src="Last.gif"></a>
                <?php } // Show if not last page ?></td>
              </tr>
            </table>
          </div>
	    </div>
</div></div>


</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
?>
