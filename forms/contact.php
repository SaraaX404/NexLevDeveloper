<?php

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Validate the form data
    $errors = array();
    if (empty($name)) {
        $errors[] = "Name is required";
    }
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    if (empty($subject)) {
        $errors[] = "Subject is required";
    }
    if (empty($message)) {
        $errors[] = "Message is required";
    }

    // If the form data is valid, send the email
    if (empty($errors)) {
        // Use the Gmail SMTP server
        $host = 'smtp.gmail.com';
        $port = 587;
        $username = 'nextleveldeveloper.contactme.com';
        $password = 'Saraa123*';

        // Use the PHPMailer library
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        require 'path/to/PHPMailer/src/Exception.php';
        require 'path/to/PHPMailer/src/PHPMailer.php';
        require 'path/to/PHPMailer/src/SMTP.php';

        $mail = new PHPMailer(true);

        try {
            // Set the mail server
            $mail->isSMTP();
            $mail->Host = $host;
            $mail->SMTPAuth = true;
            $mail->Username = $username;
            $mail->Password = $password;
            $mail->SMTPSecure = 'tls';
            $mail->Port = $port;

            // Set the email details
            $mail->setFrom($username);
            $mail->addAddress('recipient@example.com');
            $mail->Subject = $subject;
            $mail->Body = $message;

            // Send the email
            $mail->send();
            $success = "Message sent successfully!";
        } catch (Exception $e) {
            $errors[] = "There was a problem sending the email: {$mail->ErrorInfo}";
        }
    }
}

?>



