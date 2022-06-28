<?php

function getData($dataurl){
    
    $curl = curl_init($dataurl);
    curl_setopt($curl, CURLOPT_URL, $dataurl);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  
    $resp = curl_exec($curl);
    curl_close($curl);
    return($resp);
  
  }

$shared = json_decode(getData("http://vakantiewolfheze.nl/admin/api/singletons/get/sharedcontent?token=ae65b98efa82723b2166ed29191b5a"));

$to = $shared->beheerder_email;

$fname = $_POST['fname'];
$sname = $_POST['sname'];
$email = $_POST['email'];
$date = $_POST['date'];
$straat = $_POST['straat'];
$huisnr = $_POST['huisnr'];
$postcode = $_POST['postcode'];
$land = $_POST['land'];
$telnr = $_POST['telnr'];
$peopleamount = $_POST['peopleamount2'];
$message = $_POST['message'];
$price = $_POST['pr'];

$msg1 = "Voornaam: " . $fname . "\r\nachternaam: " . $sname . "\r\nE-mail: " . $email . "\r\nDatum: " . $date . "\r\nStraat: " . $straat . "\r\nHuisnummer: " . $huisnr . "\r\nPostcode: " . $postcode . "\r\nLand: " . $land . "\r\nTelefoonnummer: " . $telnr . "\r\nAantal gasten: " . $peopleamount . "\r\nBericht: " . $message . "\r\nTotaalprijs: " . $price;

$msg2 = "Dear " . $fname . ",\r\n \r\nThank you for you reservation at Chalet Bosrust. Below you can find an overview of your booking. \r\n \r\nPeriod of reservation: " . $date . "\r\nNumber of guests: " . $peopleamount . "\r\nTotal price: " . $price . "\r\n \r\nWithin 7 days you will receive an invoice via e-mail. We hope you have a great stay at Chalet Bosrust.";

$msg1 = wordwrap($msg1,70);
$msg2 = wordwrap($msg2,70);

$headerse = 'From: ' . $email;
$headersk = 'From: ' . $to;

$result = mail($to,"Nieuwe reservering chalet",$msg1,$headerse);//email naar eigenaar
$result2 = mail($email,"Bevestiging van reservering",$msg2,$headersk);//email naar klant
if(!$result || !$result2) {   
    header('Location: error.php');
} else {
    header('Location: bookingsuccess_en.php?name=' . $fname . '&period=' . $date . '&guests=' . $peopleamount . '&price=' . $price);
}