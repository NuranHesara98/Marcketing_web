<?php

// Enable error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Allow CORS for cross-origin requests
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Update with your receiving email address
$receiving_email_address = 'dresssme2024@gmail.com';

if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
    include($php_email_form);
} else {
    die('Unable to load the "PHP Email Form" Library!');
}

$contact = new PHP_Email_Form;
$contact->ajax = true;

// Set email details
$contact->to = $receiving_email_address;
$contact->from_name = isset($_POST['name']) ? $_POST['name'] : 'Unknown';
$contact->from_email = isset($_POST['email']) ? $_POST['email'] : 'unknown@example.com';
$contact->subject = isset($_POST['subject']) ? $_POST['subject'] : 'No Subject';

// Uncomment below code if you want to use SMTP to send emails
/*
$contact->smtp = array(
    'host' => 'your-smtp-host.com',
    'username' => 'your-smtp-username',
    'password' => 'your-smtp-password',
    'port' => '587'
);
*/

// Add messages from form fields
$contact->add_message($_POST['name'], 'From');
$contact->add_message($_POST['email'], 'Email');
$contact->add_message($_POST['message'], 'Message', 10);

// Send email and return result
if ($contact->send()) {
    echo 'OK';
} else {
    echo 'Form submission failed. Please try again.';
}
?>
