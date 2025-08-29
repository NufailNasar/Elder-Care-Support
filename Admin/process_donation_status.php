<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../PHPMailer/src/Exception.php';
require_once __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer/src/SMTP.php';

include('../connection.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST['id']);
    $action = $_POST['action'];
    $reason = $_POST['reason'] ?? '';

    $donation = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM donations WHERE id = $id"));
    if (!$donation) {
        echo "Donation not found!";
        exit;
    }

    $email = $donation['donor_email'];
    $name = $donation['donor_name'];
    $type = $donation['donation_type'];
    $detail = $type === 'money' ? "LKR " . number_format($donation['amount'], 2) : $donation['item_detail'];

    if ($action === 'approve') {
        mysqli_query($link, "UPDATE donations SET status = 'approved' WHERE id = $id");
        $subject = "Donation Confirmed - GoldenHearts";
        $body = "Dear $name,\n\nThank you for your generous $type donation ($detail). It has been approved and recorded.\n\n- GoldenHearts Team";
    } elseif ($action === 'reject') {
        mysqli_query($link, "UPDATE donations SET status = 'rejected' WHERE id = $id");
        $subject = "Donation Rejected - GoldenHearts";
        $body = "Dear $name,\n\nUnfortunately, your donation ($detail) was not approved.\nReason: $reason\n\n- GoldenHearts Team";
    }

    // Send email using PHPMailer
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'nufailnasar5367683@gmail.com';       // Your Gmail
        $mail->Password   = 'edtk jhxn qjqx gmqu';                // Your Gmail App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('nufailnasar5367683@gmail.com', 'GoldenHearts');
        $mail->addAddress($email, $name);

        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        echo ucfirst($action) . "d successfully and email sent!";
    } catch (Exception $e) {
        echo "Failed to send email: {$mail->ErrorInfo}";
    }
}
?>
