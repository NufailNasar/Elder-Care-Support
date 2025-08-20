<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $city = mysqli_real_escape_string($link, $_POST['city']);
    $amount = floatval($_POST['amount']);
    $message = mysqli_real_escape_string($link, $_POST['message']);
    
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image = uniqid('donor_', true) . '.' . $ext;
        move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);
    }

    $sql = "INSERT INTO donor_reviews (name, city, amount_donated, message, image) 
            VALUES ('$name', '$city', $amount, '$message', '$image')";
    mysqli_query($link, $sql);
}
