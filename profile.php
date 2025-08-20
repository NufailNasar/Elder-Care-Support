<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: signin.php");
    exit();
}

include('connection.php');

// Fetch user details from database
$username = $_SESSION['username'];
$query = "SELECT email, contact, role FROM users WHERE username = ?";
$stmt = $link->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    $email = $user['email'];
    $contact = $user['contact'];
    $role = $user['role'];
} else {
    $email = 'Not Available';
    $contact = 'Not Available';
    $role = 'User';
}
?>

<?php include('header.php'); ?>

<style>
    body {
        background: linear-gradient(120deg, rgb(58, 86, 112), #dfe9f3);
        min-height: 100vh;
    }

    .profile-container {
        margin-top: 200px;
        padding-bottom: 60px;
    }

    .profile-card {
        background: #ffffff;
        border-radius: 15px;
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.12);
        padding: 45px 35px;
        text-align: center;
        transition: transform 0.3s ease;
    }

    .profile-card:hover {
        transform: translateY(-5px);
    }

    .profile-icon {
        font-size: 90px;
        color: #0d6efd;
        margin-bottom: 20px;
    }

    .profile-card h4 {
        font-weight: 600;
        margin-bottom: 10px;
        color: #333;
    }

    .profile-card p {
        font-size: 16px;
        color: #6c757d;
        margin-bottom: 8px;
    }

    .btn-custom {
        padding: 10px 22px;
        border-radius: 30px;
        font-weight: 500;
    }
</style>

<div class="container profile-container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-10">
            <div class="profile-card">
                <div class="profile-icon">
                    <i class="fas fa-user-circle"></i>
                </div>

                <h4><?= htmlspecialchars($username) ?></h4>
                <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
                <p><strong>Contact:</strong> <?= htmlspecialchars($contact) ?></p>
                <p><strong>Role:</strong> <?= ucfirst($role) ?></p>

                <div class="mt-4">
                    <a href="index.php" class="btn btn-outline-primary btn-custom">← Back to Home</a>
                    <a href="signin.php" class="btn btn-danger btn-custom ms-2">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
