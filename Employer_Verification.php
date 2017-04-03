<meta http-equiv="refresh" content="0; URL='Employer_Homepage.php#popup1'" />
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
$query_Recordset1 = sprintf("SELECT * FROM employer WHERE Employer_ID = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $busybee) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<?php 

require_once "Mail.php";

$from = 'busybeefyp@gmail.com';
$to = $row_Recordset1['Company_Email'];
$subject = 'Account Verification for BusyBee Employers';
$body = "<html>
</head>

<body>
<table>
  <tbody>
    <tr>
      <td><h1>ACCOUNT VERIFICATION</h1>
        <h3>Hi, ".$row_Recordset1['Username']."</h3>
        <p>Thank you for creating an account on BusyBee. Your account will be verified as soon as possible. Please comfirm the details below of your company. </p></td>
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
      <td>Password:</td>
      <td> ".$row_Recordset1['Password']."</td>
    </tr>
    <tr>
      <td>Company Name:</td>
      <td> ".$row_Recordset1['Company_Name']."</td>
    </tr>
    <tr>
      <td>Comapany Email Address:</td>
      <td> ".$row_Recordset1['Company_Email']."</td>
    </tr>
    <tr>
      <td>Company's SSM Number:</td>
      <td> ".$row_Recordset1['SSM_No']."</td>
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
<?php
mysql_free_result($Recordset1);
?>
