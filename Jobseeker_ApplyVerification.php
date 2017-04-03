<meta http-equiv="refresh" content="0; URL='Jobseeker_JobPage.php#explore'" />
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

$colname_Recordset1 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset1 = $_GET['id'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset1 = sprintf("SELECT * FROM jobseeker WHERE Jobseeker_ID = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $busybee) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_GET['Job_ID'])) {
  $colname_Recordset2 = $_GET['Job_ID'];
}
mysql_select_db($database_busybee, $busybee);
$query_Recordset2 = sprintf("SELECT * FROM postjob NATURAL JOIN employer NATURAL JOIN applyjob WHERE Job_ID = %s", GetSQLValueString($colname_Recordset2, "int"));
$Recordset2 = mysql_query($query_Recordset2, $busybee) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>

<?php 

require_once "Mail.php";

$from = 'busybeefyp@gmail.com';
$to = $row_Recordset2['Company_Email'];
$subject = 'Job Application from BusyBee.co';
$body = "<html>
</head>

<body>
<table>
  <tbody>
    <tr>
      <td><h1>Job Application</h1>
        <h3>Hi ".$row_Recordset2['Company_Name']."</h3>
        <p>".$row_Recordset1['First_Name']." ".$row_Recordset1['Last_Name']." has apply for your job posted on BusyBee.co. Following are ".$row_Recordset1['First_Name']."'s details. Please login to BusyBee to manage the applications.</p></td>
    </tr>
  </tbody>
</table>
<table>
  <colgroup>
  <col width='225px' />
  <col />
  </colgroup>
  <tbody>
    <tr>
      <td>Username:</td>
      <td> ".$row_Recordset1['Username']."</td>
    </tr>
    <tr>
      <td>Email Address:</td>
      <td> ".$row_Recordset1['Jobseeker_Email']."</td>
    </tr>
    <tr>
      <td>Phone Number:</td>
      <td> ".$row_Recordset1['Jobseeker_PhoneNumber']."</td>
    </tr>
    <tr>
      <td>Type of Employment:</td>
      <td> ".$row_Recordset1['Type_Of_Employment']."</td>
    </tr>
   <tr>
      <td>Job Applied:</td>
      <td> ".$row_Recordset2['Job_Title']."</td>
    </tr>
	  <tr>
      <td>Time and Date Job Applied:</td>
      <td> ".$row_Recordset2['Time']." on ".$row_Recordset2['Apply_Date']."</td>
    </tr>
  </tbody>
</table>
<table>
  <tbody>
   <p> If you have encounter any problems or changes, please do not hesistate to contant us on jcms5055@gmail.com. <br>
<br>
Best Regards,<br>
BusyBee.Co
</body>
</html>";

$headers = array(
    'From' => $from,
    'Reply-To' => $to,
    'Subject' => $subject,
    'MIME-Version' => "1.0",
  'Content-type' => "text/html; charset=iso-8859-1\r\n\r\n"
);

$smtp = Mail::factory('smtp', array(
        'host' => 'ssl://smtp.gmail.com',
        'port' => '465',
        'auth' => true,
        'username' => 'busybeefyp@gmail.com',
        'password' => 'iloveling1019'
    ));

$mail = $smtp->send($to, $headers, $body);

if (PEAR::isError($mail)) {
    (' echo <p>' . $mail->getMessage() . '</p>');
} else {
    (' echo <p>Message successfully sent!</p>');
}
?>
<body>
</body>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
