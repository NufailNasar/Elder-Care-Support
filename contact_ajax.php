<?php
include('connection.php');
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = mysqli_real_escape_string($link, $_POST['name']);
    $email   = mysqli_real_escape_string($link, $_POST['email']);
    $subject = mysqli_real_escape_string($link, $_POST['subject']);
    $message = mysqli_real_escape_string($link, $_POST['message']);

    $query = "INSERT INTO contact_messages (name, email, subject, message, created_at) 
              VALUES ('$name', '$email', '$subject', '$message', NOW())";

    if (mysqli_query($link, $query)) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Your message has been sent successfully!'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to send your message. Please try again.'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request.'
    ]);
}
?>
