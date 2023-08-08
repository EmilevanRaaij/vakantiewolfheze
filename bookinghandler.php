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

$msg2 = "Beste " . $fname . ",\r\n \r\nBedankt voor je boeking bij Chalet Bosrust. Hieronder vind je een overzicht van je reservering. \r\n \r\nPeriode van reservering: " . $date . "\r\nAantal personen: " . $peopleamount . "\r\nTotaalprijs: " . $price . "\r\n \r\nBinnen 7 dagen ontvang je een verzoek tot betaling via e-mail. We ontvangen je graag van harte in Wolfheze.";

$msg1 = wordwrap($msg1,70);
$msg2 = wordwrap($msg2,70);

$headerse = 'From: ' . $email;
$headersk = 'From: ' . $to;

$result = mail($to,"Nieuwe reservering chalet",$msg1,$headerse);//email naar eigenaar
$result2 = mail($email,"Bevestiging van reservering",$msg2,$headersk);//email naar klant
if($result == false || $result2 == false) {   
    header('Location: error.php');
} else {
    header('Location: bookingsuccess.php?name=' . $fname . '&period=' . $date . '&guests=' . $peopleamount . '&price=' . $price);
}