<?php
// Start session to store messages
session_start();

// Initialize variables
$errors = [];
$success = "";

// Check if form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $firstName = trim(htmlspecialchars($_POST["FirstName"] ?? ''));
    $lastName = trim(htmlspecialchars($_POST["LastName"] ?? ''));
    $email = trim($_POST["Email"] ?? '');
    $phone = trim(htmlspecialchars($_POST["PhoneNumber"] ?? ''));
    $message = trim(htmlspecialchars($_POST["Message"] ?? ''));

    // === Validate fields ===

    if (empty($firstName)) {
        $errors[] = "First Name is required.";
    }

    if (empty($lastName)) {
        $errors[] = "Last Name is required.";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "A valid Email is required.";
    }

    if (empty($phone)) {
        $errors[] = "Phone Number is required.";
    }

    if (empty($message)) {
        $errors[] = "Message cannot be empty.";
    }

    // === If no errors, proceed ===
    if (empty($errors)) {
        $to = "support@usmandigitalstore.com"; // Your support email
        $subject = "New Contact Form Submission";
        $body = "From: $firstName $lastName\nEmail: $email\nPhone: $phone\n\nMessage:\n$message";

        $headers = "From: $email";

        if (mail($to, $subject, $body, $headers)) {
            $success = "Thank you! Your message has been sent successfully.";
        } else {
            $errors[] = "Message failed to send. Please try again later.";
        }
    }
}
?>

<!-- Display messages in your contact.html (embed this block where needed) -->
<?php if (!empty($errors)): ?>
    <div style="color: red; font-weight: bold;">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php elseif (!empty($success)): ?>
    <div style="color: green; font-weight: bold;">
        <?= htmlspecialchars($success) ?>
    </div>
<?php endif; ?>
