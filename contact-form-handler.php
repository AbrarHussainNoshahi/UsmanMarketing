<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data and sanitize
    $firstName   = htmlspecialchars(trim($_POST['FirstName']));
    $lastName    = htmlspecialchars(trim($_POST['LastName']));
    $email       = filter_var(trim($_POST['Email']), FILTER_SANITIZE_EMAIL);
    $phone       = htmlspecialchars(trim($_POST['PhoneNumber']));
    $message     = htmlspecialchars(trim($_POST['Message']));

    $fullName = $firstName . ' ' . $lastName;

    // Validate required fields
    if (empty($firstName) || empty($lastName) || empty($email) || empty($message)) {
        die("Please fill in all required fields.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email address.");
    }

    // Email configuration
    $to      = "support@usmandigitalstore.com"; // <-- Replace with your email
    $subject = "New Contact Form Submission";

    // HTML email body
    $email_content = "
    <html>
    <head>
        <style>
            table { font-family: Arial, sans-serif; border-collapse: collapse; width: 100%; }
            th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
            th { background-color: #f2f2f2; }
        </style>
    </head>
    <body>
        <h2>Contact Form Submission</h2>
        <table>
            <tr><th>Full Name</th><td>{$fullName}</td></tr>
            <tr><th>Email</th><td>{$email}</td></tr>
            <tr><th>Phone Number</th><td>{$phone}</td></tr>
            <tr><th>Message</th><td>{$message}</td></tr>
        </table>
    </body>
    </html>
    ";

    // Headers
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: {$fullName} <{$email}>\r\n";
    $headers .= "Reply-To: {$email}\r\n";

    // Send email
    if (mail($to, $subject, $email_content, $headers)) {
        echo "Thank you! Your message has been sent.";
    } else {
        echo "Sorry, something went wrong. Please try again later.";
    }
} else {
    echo "Invalid request method.";
}
?>
