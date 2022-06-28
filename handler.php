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

$subject = "Chalet bosrust contact formulier";
$msg = $_POST['message'];
$name = $_POST['name'];
$email = str_replace(" ", "", $_POST['email']);

$msg1 = "Bericht van: " . $name . "\r\nE-mail: " . $email . "\r\nBericht: " . $msg;
$msg1 = wordwrap($msg1, 70);

$headers = 'From: ' . $email;

$result = mail($to,$subject,$msg1,$headers);
if(!$result) {   
    header('Location: error.php');
} else {
    header('Location: success.php');
}