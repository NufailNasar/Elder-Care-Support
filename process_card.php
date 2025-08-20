<?php
session_start();
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;
    $donor_name = $_SESSION['donor_name'] ?? 'Anonymous Donor';
    $donor_email = $_SESSION['email'] ?? 'anonymous@example.com';
    $elder_home_id = $_SESSION['donating_elder_home_id'] ?? 1;

    $stmt = $link->prepare("INSERT INTO donations (donor_name, donor_email, elder_home_id, donation_type, amount, item_detail, status, created_at) VALUES (?, ?, ?, 'money', ?, NULL, 'approved', NOW())");
    $stmt->bind_param("ssid", $donor_name, $donor_email, $elder_home_id, $amount);
    $stmt->execute();
    $stmt->close();

    $update = $link->prepare("UPDATE elder_homes SET raised_amount = raised_amount + ? WHERE id = ?");
    $update->bind_param("di", $amount, $elder_home_id);
    $update->execute();
    $update->close();

    header("Location: index.php?success=1");
    exit();
}
?>
