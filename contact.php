<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader (Make sure vendor folder is uploaded)
require __DIR__ . '/vendor/autoload.php';

if (isset($_POST['form_submit'])) {

    $name    = $_POST['name'] ?? '';
    $email   = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $message = $_POST['message'] ?? '';

    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'simonmwangi749@gmail.com';           // Your Gmail
        $mail->Password   = 'skya vtep hikp odwi';                // Your App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Sender & Recipient
        $mail->setFrom('simonmwangi749@gmail.com', 'moving-template.vercel.app/index.html');
        $mail->addAddress('simonmwangi749@gmail.com', 'Simon Mwangi');

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = $subject ?: 'New message from personal website';
        $mail->Body    = "
            <h3>Hello Simon,</h3>
            <p>You have received a new message from your website contact form.</p>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Subject:</strong> $subject</p>
            <p><strong>Message:</strong><br>$message</p>";

        // Send
        $mail->send();
        $_SESSION['status'] = 'Thank you for contacting me. I will get back to you soon.';

    } catch (Exception $e) {
        $_SESSION['status'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    // Redirect back
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();

} else {
    header('Location: contact.html');
    exit();
}
