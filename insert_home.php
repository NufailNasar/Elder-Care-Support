<?php
include("connection.php");
session_start(); // Start session at the top

// Sanitize inputs
$name = mysqli_real_escape_string($link, $_POST['name']);
$category = mysqli_real_escape_string($link, $_POST['category']);
$goal = floatval($_POST['goal_amount']);
$raised = floatval($_POST['raised_amount']);
$description = mysqli_real_escape_string($link, $_POST['description']);

// Handle image upload
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'img/';
    $imageName = basename($_FILES['image']['name']);
    $ext = pathinfo($imageName, PATHINFO_EXTENSION);
    $newImageName = uniqid('home_', true) . '.' . $ext;
    $targetPath = $uploadDir . $newImageName;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
        // Insert into database with status = 'pending'
        $sql = "INSERT INTO elder_homes (name, description, category, goal_amount, raised_amount, image_path, status) 
                VALUES ('$name', '$description', '$category', $goal, $raised, '$targetPath', 'pending')";

        if (mysqli_query($link, $sql)) {
            $_SESSION['status_message'] = "New Elder Home submitted for approval!";
            echo "success";
        } else {
            echo "Database error: " . mysqli_error($link);
        }
    } else {
        echo "Failed to move uploaded file.";
    }
} else {
    echo "Invalid image file.";
}
?>
