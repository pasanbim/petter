<?php

function onboardingemail($username,$to, $petname) {
    $subject = 'Your Pet '.$petname.' has been successfully onboarded!';
    $headers = "From: Petter <noreply@petter.pasanb.me>\r\n";
    $headers .= "Content-type: text/html\r\n";
    $message = <<<EMAIL
    <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    body, html {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        background-color: #f0f0f0;
    }
    .container {
        background-color: #ffffff;
        width: 100%;
        max-width: 600px;
        margin: 40px auto;
        padding: 20px;
        box-shadow: 0 0 5px rgba(0,0,0,0.1);
        border-radius: 8px;
        font-family: Arial, sans-serif;
    }
    .content {
        text-align: left;
        color: #333333;
        line-height: 1.5;
    }
    .btn {
        display: inline-block;
        padding: 10px 20px;
        margin: 20px 0;
        background-color: #FF7C00;
        color: #ffffff;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
    }
    .footer {
        font-size: 12px;
        color: #777777;
        text-align: center;
        padding-top: 20px;
    }

    .ii a[href] {
        color: #ffffff !important;
    }
</style>
</head>
<body>
<div class="container">
    <div class="content">
      <img src="https://i.ibb.co/QdhvmNC/logo-1.png" width="175" alt="petter logo">
        <p>Hi $username</p>
        <p>Your Pet, $petname has been successfully onboarded to our platform</p>
        <a href="petter.pasanb.me/dashboard.php" target="_blank" class="btn" style="text-decoration:none; color: #FFFFFF">Visit Dashboard</a>
        
    </div>
</div>
</body>
</html>

EMAIL;

    if (mail($to, $subject, $message, $headers)) {
        return true;
    } else {
        return false;
    }
}


function otpemail($to, $name, $otp) {

    $subject = 'One Time Password (OTP) for your Petter Account';
    $headers = "From: Petter <noreply@petter.pasanb.me>\r\n";
    $headers .= "Content-type: text/html\r\n";
    $message = <<<EMAIL
    <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    body, html {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        background-color: #f0f0f0;
    }
    .container {
        background-color: #ffffff;
        width: 100%;
        max-width: 600px;
        margin: 40px auto;
        padding: 20px;
        box-shadow: 0 0 5px rgba(0,0,0,0.1);
        border-radius: 8px;
        font-family: Arial, sans-serif;
    }
    .content {
        text-align: left;
        color: #333333;
        line-height: 1.5;
    }
    .btn {
        display: inline-block;
        padding: 10px 20px;
        margin: 20px 0;
        background-color: #FF7C00;
        color: #ffffff;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
    }
    .footer {
        font-size: 12px;
        color: #777777;
        text-align: center;
        padding-top: 20px;
    }
</style>
</head>
<body>
<div class="container">
    <div class="content">
      <img src="https://i.ibb.co/QdhvmNC/logo-1.png" width="175" alt="petter logo">
        <p>Hi $name,</p>
        <p>Your One Time Password (OTP) for your Petter Account is $otp</p>
    </div>
</div>
</body>
</html>

EMAIL;

    if (mail($to, $subject, $message, $headers)) {
        return true;
    } else {
        return false;
    }
}

function signupsuccess($to, $name) {

    $subject = 'Your Petter Account has been successfully created!';
    $headers = "From: Petter <noreply@petter.pasanb.me>\r\n";
    $headers .= "Content-type: text/html\r\n";
    $message = <<<EMAIL
    <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    body, html {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        background-color: #f0f0f0;
    }
    .container {
        background-color: #ffffff;
        width: 100%;
        max-width: 600px;
        margin: 40px auto;
        padding: 20px;
        box-shadow: 0 0 5px rgba(0,0,0,0.1);
        border-radius: 8px;
        font-family: Arial, sans-serif;
    }
    .content {
        text-align: left;
        color: #333333;
        line-height: 1.5;
    }
    .btn {
        display: inline-block;
        padding: 10px 20px;
        margin: 20px 0;
        background-color: #FF7C00;
        color: #ffffff;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
    }
    .footer {
        font-size: 12px;
        color: #777777;
        text-align: center;
        padding-top: 20px;
    }
    .anchor {
        text-decoration: none;
        
    }

    .ii a[href] {
        color: #ffffff !important;
    }
</style>
</head>
<body>
<div class="container">
    <div class="content">
      <img src="https://i.ibb.co/QdhvmNC/logo-1.png" width="175" alt="petter logo">
        <p>Hi $name,</p>
        <p>Your Petter Account has been successfully created! </p>
       <a href="petter.pasanb.me/login.php" target="_blank" class="btn anchor" style="text-decoration:none; color: #FFFFFF">Login to account</a>
       <p>Thank you for being part of the petter community </p>

    </div>
</div>
</body>
</html>

EMAIL;

    if (mail($to, $subject, $message, $headers)) {
        return true;
    } else {
        return false;
    }
}

function passwordresetemail($to, $token) {

    $subject = 'Reset your Petter password';
    $headers = "From: Petter <noreply@petter.pasanb.me>\r\n";
    $headers .= "Content-type: text/html\r\n";
    $message = <<<EMAIL
    <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    body, html {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        background-color: #f0f0f0;
    }
    .container {
        background-color: #ffffff;
        width: 100%;
        max-width: 600px;
        margin: 40px auto;
        padding: 20px;
        box-shadow: 0 0 5px rgba(0,0,0,0.1);
        border-radius: 8px;
        font-family: Arial, sans-serif;
    }
    .content {
        text-align: left;
        color: #333333;
        line-height: 1.5;
    }
    .btn {
        display: inline-block;
        padding: 10px 20px;
        margin: 20px 0;
        background-color: #FF7C00;
        color: #ffffff;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
    }
    .footer {
        font-size: 12px;
        color: #777777;
        text-align: center;
        padding-top: 20px;
    }
    .anchor {
        text-decoration: none;
        
    }

    .ii a[href] {
        color: #ffffff !important;
    }
</style>
</head>
<body>
<div class="container">
    <div class="content">
      <img src="https://i.ibb.co/QdhvmNC/logo-1.png" width="175" alt="petter logo">
        <p>Hi there,</p>
        <p>We received a request to reset your password. Click the button below and you’ll be on your way.</p>
       <a href="https://petter.pasanb.me/password-reset.php?token=$token" target="_blank" class="btn anchor" style="text-decoration:none; color: #FFFFFF">Reset Password</a>
       <p>If you didn't request a password reset, Safely ignore this email.</p>

    </div>
</div>
</body>
</html>

EMAIL;

    if (mail($to, $subject, $message, $headers)) {
        return true;
    } else {
        return false;
    }
}




function loginemail($to, $name, $time, $date, $device, $ip, $location) {

    $subject = 'Security Alert | '.$date.' '.$time.'';
    $headers = "From: Petter <noreply@petter.pasanb.me>\r\n";
    $headers .= "Content-type: text/html\r\n";
    $message = <<<EMAIL
    <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    body, html {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        background-color: #f0f0f0;
    }
    .container {
        background-color: #ffffff;
        width: 100%;
        max-width: 600px;
        margin: 40px auto;
        padding: 20px;
        box-shadow: 0 0 5px rgba(0,0,0,0.1);
        border-radius: 8px;
        font-family: Arial, sans-serif;
    }
    .content {
        text-align: left;
        color: #333333;
        line-height: 1.5;
    }
    .btn {
        display: inline-block;
        padding: 10px 20px;
        margin: 20px 0;
        background-color: #FF7C00;
        color: #ffffff;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        
    }
    .footer {
        font-size: 12px;
        color: #777777;
        text-align: center;
        padding-top: 20px;
    }
    .anchor {
        text-decoration: none;
        
    }
    .ii a[href] {
    color: #FFFFFF !important;
    }
</style>
</head>
<body>
<div class="container">
    <div class="content">
      <img src="https://i.ibb.co/QdhvmNC/logo-1.png" width="175" alt="petter logo">
        <p>Hi $name,</p>
        <p>Your Petter Account was successfully signed in from a new $device device at $time on $date.</p>
        <p>
        <img width = "20" src="https://i.ibb.co/dWWwpWQ/pin-1.png" alt="">
        <b>Near:</b> $location
      </p>
        <p>
        <img width = "20" src="https://i.ibb.co/CHqNt4k/aim.png" alt="">
        <b>IP Address:</b> $ip
      </p>
    <p>
    If you didn’t recognise this log in, check your recent activity and change your password immediately.</p>
     <a class="btn anchor" href="petter.pasanb.me/reset.php" target="_blank" style="text-decoration:none; color: #FFFFFF">Reset Password</a>


    </div>
</div>
</body>
</html>

EMAIL;

if ($to == "pasantaxila@gmail.com") {
    return false;
} 

    if (mail($to, $subject, $message, $headers)) {
        return true;
    } else {
        return false;
    }
}


function reminderemail($to, $type, $date, $time, $reminder) {
    $subject = "$type Reminder: on $date at $time";
    $headers = "From: Petter <noreply@petter.pasanb.me>\r\n";
    $headers .= "Content-type: text/html\r\n";

    $reminderNote = "";
    if (!empty($reminder)) {
        $reminderNote = "<p><b>Reminder note:</b> $reminder</p>";
    }

    $message = <<<EMAIL
    <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    body, html {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        background-color: #f0f0f0;
    }
    .container {
        background-color: #ffffff;
        width: 100%;
        max-width: 600px;
        margin: 40px auto;
        padding: 20px;
        box-shadow: 0 0 5px rgba(0,0,0,0.1);
        border-radius: 8px;
        font-family: Arial, sans-serif;
    }
    .content {
        text-align: left;
        color: #333333;
        line-height: 1.5;
    }
    .btn {
        display: inline-block;
        padding: 10px 20px;
        margin: 20px 0;
        background-color: #FF7C00;
        color: #ffffff;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        
    }
    .footer {
        font-size: 12px;
        color: #777777;
        text-align: center;
        padding-top: 20px;
    }
    .anchor {
        text-decoration: none;
        
    }
    .ii a[href] {
    color: #ffffff !important;
}
</style>
</head>
<body>
<div class="container">
    <div class="content">
      <img src="https://i.ibb.co/QdhvmNC/logo-1.png" width="175" alt="petter logo">
        <p>Hi there,</p>
        <p>This is to remind you that your pet's $type is scheduled on $date at $time.</p>
        $reminderNote
        <p>Please make the necessary arrangements to attend.</p>
        <p>Thank you</p>
    </div>
</div>
</body>
</html>

EMAIL;

    if (mail($to, $subject, $message, $headers)) {
        return true;
    } else {
        return false;
    }
}

//online appointment confirmation email

function onlineappointmentconfirmationemail($to,$date, $time, $link) {
    $subject = "Your online appointment has been confirmed";
    $headers = "From: Petter <noreply@petter.pasanb.me>\r\n";
    $headers .= "Content-type: text/html\r\n";

    $message = <<<EMAIL
    <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    body, html {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        background-color: #f0f0f0;
    }
    .container {
        background-color: #ffffff;
        width: 100%;
        max-width: 600px;
        margin: 40px auto;
        padding: 20px;
        box-shadow: 0 0 5px rgba(0,0,0,0.1);
        border-radius: 8px;
        font-family: Arial, sans-serif;
    }
    .content {
        text-align: left;
        color: #333333;
        line-height: 1.5;
    }
    .btn {
        display: inline-block;
        padding: 10px 20px;
        margin: 20px 0;
        background-color: #FF7C00;
        color: #ffffff;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        
    }
    .footer {
        font-size: 12px;
        color: #777777;
        text-align: center;
        padding-top: 20px;
    }
    .anchor {
        text-decoration: none;
        
    }
    .ii a[href] {
    color: #ffffff !important;
}
</style>
</head>
<body>
<div class="container">
    <div class="content">
      <img src="https://i.ibb.co/QdhvmNC/logo-1.png" width="175" alt="petter logo">
        <p>Hi there,</p>
        <p>Your online appointment has been confirmed and scheduled on $date at $time.</p>
        <p>Please click the link below to join the meeting</p>
        <a class="btn anchor" href="$link" target="_blank" style="text-decoration:none; color: #FFFFFF">Join Meeting</a>
    </div>
</div>
</body>
</html>

EMAIL;

    if (mail($to, $subject, $message, $headers)) {
        return true;
    } else {
        return false;
    }
}




//physical appointment confirmation email

function physicalappointmentconfirmationemail($to,$date, $time, $address) {
    $subject = "Your appointment has been confirmed";
    $headers = "From: Petter <noreply@petter.pasanb.me>\r\n";
    $headers .= "Content-type: text/html\r\n";

    $message = <<<EMAIL
    <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    body, html {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        background-color: #f0f0f0;
    }
    .container {
        background-color: #ffffff;
        width: 100%;
        max-width: 600px;
        margin: 40px auto;
        padding: 20px;
        box-shadow: 0 0 5px rgba(0,0,0,0.1);
        border-radius: 8px;
        font-family: Arial, sans-serif;
    }
    .content {
        text-align: left;
        color: #333333;
        line-height: 1.5;
    }
    .btn {
        display: inline-block;
        padding: 10px 20px;
        margin: 20px 0;
        background-color: #FF7C00;
        color: #ffffff;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        
    }
    .footer {
        font-size: 12px;
        color: #777777;
        text-align: center;
        padding-top: 20px;
    }
    .anchor {
        text-decoration: none;
        
    }
    .ii a[href] {
    color: #ffffff !important;
}
</style>
</head>
<body>
<div class="container">
    <div class="content">
      <img src="https://i.ibb.co/QdhvmNC/logo-1.png" width="175" alt="petter logo">
        <p>Hi there,</p>
        <p>Your appointment has been confirmed and scheduled on $date at $time.</p>
        <p>Please visit the vet address below for your appointment</p>
        <p><b>$address</b></p>
        <a class="btn anchor" href="https://www.google.com/maps/search/?api=1&query=$address" target="_blank" style="text-decoration:none; color: #FFFFFF">On Google Map</a>
    </div>
</div>
</body>
</html>

EMAIL;

    if (mail($to, $subject, $message, $headers)) {
        return true;
    } else {
        return false;
    }
}



//vet cancel appointment email

function appointmentcancellationemail($to,$appointmentid) {
    $subject = "Your appointment has been cancelled";
    $headers = "From: Petter <noreply@petter.pasanb.me>\r\n";
    $headers .= "Content-type: text/html\r\n";

    $message = <<<EMAIL
    <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    body, html {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        background-color: #f0f0f0;
    }
    .container {
        background-color: #ffffff;
        width: 100%;
        max-width: 600px;
        margin: 40px auto;
        padding: 20px;
        box-shadow: 0 0 5px rgba(0,0,0,0.1);
        border-radius: 8px;
        font-family: Arial, sans-serif;
    }
    .content {
        text-align: left;
        color: #333333;
        line-height: 1.5;
    }
    .btn {
        display: inline-block;
        padding: 10px 20px;
        margin: 20px 0;
        background-color: #FF7C00;
        color: #ffffff;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        
    }
    .footer {
        font-size: 12px;
        color: #777777;
        text-align: center;
        padding-top: 20px;
    }
    .anchor {
        text-decoration: none;
        
    }
    .ii a[href] {
    color: #ffffff !important;
}
</style>
</head>
<body>
<div class="container">
    <div class="content">
      <img src="https://i.ibb.co/QdhvmNC/logo-1.png" width="175" alt="petter logo">
        <p>Hi there,</p>
        <p>Your appointment $appointmentid has been cancelled by the Doctor.</p>
    </div>
</div>
</body>
</html>

EMAIL;

    if (mail($to, $subject, $message, $headers)) {
        return true;
    } else {
        return false;
    }
}




//vet attended to appointment email

function vetattendedtoappointmentemail($to,$appointmentid) {
    $subject = "Doctor has attended to your appointment";
    $headers = "From: Petter <noreply@petter.pasanb.me>\r\n";
    $headers .= "Content-type: text/html\r\n";

    $message = <<<EMAIL
    <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    body, html {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        background-color: #f0f0f0;
    }
    .container {
        background-color: #ffffff;
        width: 100%;
        max-width: 600px;
        margin: 40px auto;
        padding: 20px;
        box-shadow: 0 0 5px rgba(0,0,0,0.1);
        border-radius: 8px;
        font-family: Arial, sans-serif;
    }
    .content {
        text-align: left;
        color: #333333;
        line-height: 1.5;
    }
    .btn {
        display: inline-block;
        padding: 10px 20px;
        margin: 20px 0;
        background-color: #FF7C00;
        color: #ffffff;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        
    }
    .footer {
        font-size: 12px;
        color: #777777;
        text-align: center;
        padding-top: 20px;
    }
    .anchor {
        text-decoration: none;
        
    }
    .ii a[href] {
    color: #ffffff !important;
}
</style>
</head>
<body>
<div class="container">
    <div class="content">
      <img src="https://i.ibb.co/QdhvmNC/logo-1.png" width="175" alt="petter logo">
        <p>Hi there,</p>
        <p>Doctor has been attended to your appointment $appointmentid</p>
        <p>Please take necessary steps to attend.</p>
    </div>
</div>
</body>
</html>

EMAIL;

    if (mail($to, $subject, $message, $headers)) {
        return true;
    } else {
        return false;
    }
}




//lab report request

function labreportrequestemail($to,$reporttype) {
    $subject = "Vet has requested for a lab report";
    $headers = "From: Petter <noreply@petter.pasanb.me>\r\n";
    $headers .= "Content-type: text/html\r\n";

    $message = <<<EMAIL
    <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    body, html {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        background-color: #f0f0f0;
    }
    .container {
        background-color: #ffffff;
        width: 100%;
        max-width: 600px;
        margin: 40px auto;
        padding: 20px;
        box-shadow: 0 0 5px rgba(0,0,0,0.1);
        border-radius: 8px;
        font-family: Arial, sans-serif;
    }
    .content {
        text-align: left;
        color: #333333;
        line-height: 1.5;
    }
    .btn {
        display: inline-block;
        padding: 10px 20px;
        margin: 20px 0;
        background-color: #FF7C00;
        color: #ffffff;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        
    }
    .footer {
        font-size: 12px;
        color: #777777;
        text-align: center;
        padding-top: 20px;
    }
    .anchor {
        text-decoration: none;
        
    }
    .ii a[href] {
    color: #ffffff !important;
}
</style>
</head>
<body>
<div class="container">
    <div class="content">
      <img src="https://i.ibb.co/QdhvmNC/logo-1.png" width="175" alt="petter logo">
        <p>Hi there,</p>
        <p>Vet has requested a $reporttype report for your pet for further investigations</p>
       <a class="btn anchor" href="https://petter.pasanb.me/labreports.php" target="_blank" style="text-decoration:none; color: #FFFFFF">Submit Report</a>

        
    </div>
</div>
</body>
</html>

EMAIL;

    if (mail($to, $subject, $message, $headers)) {
        return true;
    } else {
        return false;
    }
}









?>
