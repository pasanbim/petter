<?php

function onboardingemail($to, $petname) {
    $subject = 'Your Pet '.$petname.' has been successfully onboarded!';
    $headers = "From: Petter <noreply@petter.pasanb.me>\r\n";
    $headers .= "Content-type: text/html\r\n";
    $message = <<<EMAIL
    <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Simple HTML Email</title>
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
        <p>Hi there</p>
        <p>Sometimes you just want to send a simple HTML email with a simple design and clear call to action. This is it.</p>
        <a href="http://htmlemail.io" target="_blank" class="btn">Call To Action</a>
        <p>This is a really simple email template. It's sole purpose is to get the recipient to click the button with no distractions.</p>
        <p>Good luck! Hope it works.</p>
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
