<?php
function sendEmail($to, $subject, $message) {
    $headers = "From: Petter <noreply@petter.pasanb.me>\r\n";
    $headers .= "Reply-To: noreply@petter.pasanb.me\r\n";
    $headers .= "Content-type: text/html\r\n";

    if (mail($to, $subject, $message, $headers)) {
        return true;
    } else {
        return false;
    }
}
?>
