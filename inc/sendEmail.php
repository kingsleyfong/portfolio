<?php

$siteOwnersEmail = 'thekingsman2525@gmail.com';

error_reporting(E_ALL);
ini_set('display_errors', 1);


if($_POST) {
    $error = array(); // Initialize an array to hold error messages

    $name = trim(stripslashes($_POST['contactName']));
    $email = trim(stripslashes($_POST['contactEmail']));
    $subject = trim(stripslashes($_POST['contactSubject']));
    $contact_message = trim(stripslashes($_POST['contactMessage']));
    $message = "";

    // Check Name
    if (strlen($name) < 2) {
        $error['name'] = "Please enter your name.";
    }
    // Check Email with filter_var
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['email'] = "Please enter a valid email address.";
    }
    // Subject
    if ($subject == '') { 
        $subject = "Contact Form Submission"; 
    }

    // Set Message
    $message .= "Email from: " . $name . "<br />";
    $message .= "Email address: " . $email . "<br />";
    $message .= "Message: <br />";
    $message .= $contact_message;
    $message .= "<br /> ----- <br /> This email was sent from your site's contact form. <br />";

    // Set From: header
    $from = $name . " <" . $email . ">";

    // Email Headers
    $headers = "From: " . $siteOwnersEmail . "\r\n"; // Use your domain email address
    $headers .= "Reply-To: ". $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";


    if (empty($error)) {

        // Send Email
        $mail = mail($siteOwnersEmail, $subject, $message, $headers);

        if ($mail) { 
            echo "OK"; 
        } else { 
            echo "Something went wrong. Please try again."; 
        }
        
    } else {
        // Output Errors
        foreach ($error as $key => $value) {
            echo $value . "<br/>";
        }
    }

}

?>
