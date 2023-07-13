<?php

session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $message = $_POST["message"];
        
        $to = 'mail@jirimaly.com'; // replace with your email
        $subject = 'New message from website OneStopIT';
        $body = "From: $name\n\nMessage:\n$message";
        $headers = 'From: ' . $email;
        
        if(mail($to, $subject, $body, $headers)){
            $_SESSION['message'] = "Message was sent successfully";
        } else{
            $_SESSION['message'] = "Failed to send the message";
        }
        header("Location: /");

        exit;
    } else {
        echo "Neplatný požadavek";
    }
?>
