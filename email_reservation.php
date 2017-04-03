
<?php 

require_once "Mail.php";

$from = 'busybeefyp@gmail.com';
$to = 'jcms5055@gmail.com';
$subject = 'Reservation Confirmation for SUNFLOWER HOUSE';
$body = "<html>
</head>

<body>
<table>
  <tbody>
    <tr>
      <td><div align='center'><img src='http://s11.postimg.org/ys7x2920z/Untitled.png' alt='' tabindex='0' />
        <p>Customer service: +606-282-1500  </a>   Website: <a href='localhost/Guest_Index.php' target='_blank'>Guest_Index.php</a></p></td>
    </tr>
  </tbody>
</table>
<table>
  <tbody>
    <tr>
      <td><h1>YOUR RESERVATION</h1>
        <h3>Hello, $name .</h3>
        <p>Thank you for making reservation at SUNFLOWER HOUSE. We are pleased to confirm your reservation and the details are listed below.</p></td>
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
      <td>Reservation number</td>
      <td>: $reservenumber</td>
    </tr>
    <tr>
      <td>Date</td>
      <td>: $date</td>
    </tr>
    <tr>
      <td>Time</td>
      <td>: $time</td>
    </tr>
    <tr>
      <td>Type of Homestay</td>
      <td>: $description</td>
    </tr>
    <tr>
      <td>Checkin Date</td>
      <td>: $checkin</td>
    </tr>
    <tr>
      <td>Checkout Date</td>
      <td>: $checkout</td>
    </tr>
    <tr>
      <td>Rate per/night</td>
      <td>: $price</td>
    </tr>
    <tr>
      <td>Total</td>
      <td>: $total</td>
    </tr>
  </tbody>
</table>
<table>
  <tbody>
   <table width='747' height='190' border='0'>
                            
                             <tr>
                               <td><div>
                                 <h2>Bank Transfer</h2>
                               </div>
                                 <div>
                                   <ul>
                                     <li>Account Name: <strong>SUNFLOWER HOUSE</strong></li>
                                     <li>Bank: <strong>CIMB BANK BERHAD</strong></li>
                                     <li>Account Number: <strong>8450 1412 2553</strong></li>
                                     <li>Swift Code: <strong>CBBEMYKL</strong></li>
                                   </ul>
                                   <ol>
                                     <li>Proceed the payment on your preferred bank payable to the bank account stated above.</li>
                                     <li>Make sure upload the bank slip at 'PAYMENT' page within 24hours otherwise the reservation will be cancel.</li>
                                     <li>We will update your reservation to 'PAID' status manually and check your status at 'PAYMENT' page.  </li>
                                     <li>You will able to print reservation at the payment page.</li>
									 <li>Once the payment made, there will no refund or cancel the reservation.</li>
                                   </ol>
                               </div></td>
                             </tr>
                           </table>
  </tbody>
</table>
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
