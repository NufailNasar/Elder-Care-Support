<?php
session_start();
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Case 1: Logged-in modal donation (from index.php modal)
    if (isset($_SESSION['user_id']) && isset($_POST['elder_home_id'])) {
        $user_id = $_SESSION['user_id'];
        $elder_home_id = intval($_POST['elder_home_id']);
        $amount = floatval($_POST['amount']);
        $payment_method = mysqli_real_escape_string($link, $_POST['payment_method']);
        $note = mysqli_real_escape_string($link, $_POST['note']);
        $anonymous = isset($_POST['anonymous']) ? 1 : 0;

        $insert = "INSERT INTO donations (user_id, elder_home_id, amount, payment_method, note, anonymous, status)
                   VALUES ($user_id, $elder_home_id, $amount, '$payment_method', '$note', $anonymous, 'pending')";
        mysqli_query($link, $insert);

        $update = "UPDATE elder_homes SET raised_amount = raised_amount + $amount WHERE id = $elder_home_id";
        mysqli_query($link, $update);

        echo json_encode(['status' => 'success', 'message' => 'Thank you for your donation!']);
        exit;
    }

    // Case 2: Non-logged donation (from donate.php form)
    if (!empty($_POST['donation_type']) && !empty($_POST['elder_home']) && (!empty($_POST['amount']) || !empty($_POST['item_detail']))) {
        $type = mysqli_real_escape_string($link, $_POST['donation_type']);
        $elder_home_id = intval($_POST['elder_home']);
        $amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;
        $item_detail = isset($_POST['item_detail']) ? mysqli_real_escape_string($link, $_POST['item_detail']) : '';
        $donor_name = mysqli_real_escape_string($link, $_POST['donor_name']);
        $donor_email = mysqli_real_escape_string($link, $_POST['donor_email']);

        $insert = "INSERT INTO donations (donation_type, elder_home_id, amount, item_detail, donor_name, donor_email, status)
                   VALUES ('$type', $elder_home_id, $amount, '$item_detail', '$donor_name', '$donor_email', 'pending')";
        mysqli_query($link, $insert);

        echo "<script>alert('Thank you for your donation!'); window.location.href='index.php';</script>";
        exit;
    }

    echo json_encode(['status' => 'error', 'message' => 'Incomplete donation data.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}
?>
