<?php
// signin.php
session_start();
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $role     = trim($_POST['role'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // =================== Admin login (no DB) ===================
    if ($role === 'admin') {
        // Dev-only credentials. Replace/remove for production.
        $ADMIN_USER = 'Admin';
        $ADMIN_PASS = 'Admin@123';

        if (hash_equals($ADMIN_USER, $username) && hash_equals($ADMIN_PASS, $password)) {
            $_SESSION['username'] = $ADMIN_USER;
            $_SESSION['role']     = 'admin';
            $_SESSION['email']    = 'admin@goldenhearts.local';
            $_SESSION['contact']  = '';

            echo "<script>
                    alert('Welcome, Admin!');
                    window.location.href = 'Admin/index.php';
                  </script>";
            exit();
        } else {
            echo "<script>alert('Invalid admin credentials.');</script>";
        }
    }
    // =================== End Admin login ===================

    // Donor / Representative via DB
    if ($role === 'donor' || $role === 'representative') {
        $stmt = $link->prepare("SELECT * FROM users WHERE username = ? AND role = ?");
        if ($stmt) {
            $stmt->bind_param("ss", $username, $role);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows === 1) {
                $user = $result->fetch_assoc();

                if (password_verify($password, $user['password'])) {
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role']     = $user['role'];
                    $_SESSION['email']    = $user['email'];
                    $_SESSION['contact']  = $user['contact'];

                    if ($user['role'] === 'representative') {
                        $_SESSION['home_name'] = $user['home_name'];
                    }

                    $redirect = ($user['role'] === 'representative') ? "Elder Home/index.php" : "index.php";
                    echo "<script>
                            alert('Signin Successful!');
                            window.location.href = '$redirect';
                          </script>";
                    exit();
                } else {
                    echo "<script>alert('Incorrect password or username.');</script>";
                }
            } else {
                echo "<script>alert('Incorrect password or username.');</script>";
            }
        } else {
            echo "<script>alert('Database error. Please try again later.');</script>";
        }
    } elseif ($role !== '' && $role !== 'admin') {
        echo "<script>alert('Invalid role selected.');</script>";
    }
}
?>

<?php include 'header.php'; ?>

<style>
  body {
    background: linear-gradient(to right, #d4dde7, #b3c6db);
    min-height: 100vh;
  }

  .signin-container { margin-top: 8rem; }

  .form-section {
    background: #fff;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  }

  .form-title { font-weight: bold; color: #333; }

  .form-control, .form-select { border-radius: 6px; }

  .eye-icon {
    position: absolute;
    top: 70%;
    right: 15px;
    transform: translateY(-50%);
    cursor: pointer;
    color: #aaa;
  }

  .position-relative { position: relative; }
</style>

<div class="container signin-container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="form-section">
        <h2 class="text-center form-title mb-4">Sign in to GoldenHearts</h2>

        <form method="POST" action="signin.php" autocomplete="off">
          <!-- Role -->
          <div class="mb-3">
            <label for="role" class="form-label">User Role</label>
            <select id="role" name="role" class="form-select" required onchange="toggleElderHome()">
              <option value="">-- Select Role --</option>
              <option value="donor">Donor</option>
              <option value="representative">Elder Home</option>
              <option value="admin">Admin</option> <!-- NEW -->
            </select>
          </div>

          <!-- Elder Home Name (Optional / Placeholder) -->
          <div class="mb-3 d-none" id="elderHomeDiv">
            <label for="elder_home" class="form-label">Elder Home Name</label>
            <input type="text" id="elder_home" name="elder_home" class="form-control" placeholder="Enter elder home name">
          </div>

          <!-- Username -->
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" name="username" class="form-control" placeholder="Enter username" required>
          </div>

          <!-- Password with toggle -->
          <div class="mb-3 position-relative">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required>
            <i class="fas fa-eye eye-icon" id="togglePassword" onclick="togglePasswordVisibility()"></i>
          </div>

          <!-- Remember Me -->
          <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">Remember me</label>
          </div>

          <!-- Forgot Password -->
          <div class="mb-3 text-end">
            <a href="#" class="text-decoration-none">Forgot Password?</a>
          </div>

          <!-- Buttons -->
          <div class="d-grid gap-2 mb-3">
            <button type="submit" class="btn btn-primary">Sign In</button>
            <button type="button" class="btn btn-outline-danger">
              <i class="fab fa-google me-2"></i> Sign in with Google
            </button>
          </div>

          <!-- Sign Up -->
          <p class="text-center">Don’t have an account? <a href="signup.php" class="text-decoration-none">Sign up now</a></p>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- JS Script Section -->
<script>
  function toggleElderHome() {
    const role = document.getElementById("role").value;
    const elderHomeDiv = document.getElementById("elderHomeDiv");
    // Show Elder Home field only for representative
    elderHomeDiv.classList.toggle("d-none", role !== "representative");
  }

  function togglePasswordVisibility() {
    const passwordInput = document.getElementById("password");
    const icon = document.getElementById("togglePassword");
    const isPassword = passwordInput.type === "password";
    passwordInput.type = isPassword ? "text" : "password";
    icon.classList.toggle("fa-eye");
    icon.classList.toggle("fa-eye-slash");
  }
</script>

<?php include 'footer.php'; ?>
