<?php
// Replace with your real receiving email address
$receiving_email_address = 'baaqerfarhat@gmail.com';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

  // Sanitize and validate the input
  $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
  $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
  $subject = filter_var(trim($_POST['subject']), FILTER_SANITIZE_STRING);
  $message = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);

  // Validate the required fields
  if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    die("Please fill out all fields.");
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
  }

  // Email content
  $email_subject = "New Contact Form Submission: $subject";
  $email_body = "You have received a new message from your website contact form:\n\n";
  $email_body .= "Name: $name\n";
  $email_body .= "Email: $email\n";
  $email_body .= "Subject: $subject\n";
  $email_body .= "Message:\n$message\n";

  // Email headers
  $headers = "From: $name <$email>\r\n";
  $headers .= "Reply-To: $email\r\n";

  // Send the email
  if (mail($receiving_email_address, $email_subject, $email_body, $headers)) {
    echo "Your message has been sent successfully!";
  } else {
    echo "Sorry, your message could not be sent. Please try again later.";
  }

} else {
  die("Invalid request method.");
}
?>
