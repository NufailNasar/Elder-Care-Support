<?php
session_start();
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $role = $_POST['role'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $contact = $_POST['contact'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $homeName = $_POST['homeName'] ?? null;
  $person = $_POST['person'] ?? null;
  $homeEmail = $_POST['homeEmail'] ?? null;
  $homePhone = $_POST['homePhone'] ?? null;
  $address = $_POST['address'] ?? null;
  $description = $_POST['description'] ?? null;

  $documentPath = null;
  if (isset($_FILES['documents']) && $_FILES['documents']['error'] === 0) {
    $targetDir = "uploads/";
    $documentPath = $targetDir . basename($_FILES["documents"]["name"]);
    move_uploaded_file($_FILES["documents"]["tmp_name"], $documentPath);
  }

  $sql = "INSERT INTO users (role, username, email, contact, password, home_name, contact_person, home_email, home_phone, address, description, documents)
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

  $stmt = $link->prepare($sql);
  $stmt->bind_param("ssssssssssss", $role, $username, $email, $contact, $password, $homeName, $person, $homeEmail, $homePhone, $address, $description, $documentPath);

  if ($stmt->execute()) {
    echo "<script>
            alert('Registration Successful!');
            window.location.href = 'signin.php';
          </script>";
    exit();
  } else {
    echo "<script>alert('Registration Failed. Try again.');</script>";
  }
}
?>

<?php include 'header.php'; ?>

<style>
  body {
    background: linear-gradient(to right, #d4dde7, #b3c6db);
    min-height: 100vh;
  }

  .signup-container {
    margin-top: 10rem;
  }

  .form-title {
    font-weight: bold;
    color: #333;
  }

  .form-section {
    background: #fff;
    border-radius: 10px;
    padding: 30px;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
    max-height: 80vh;
    overflow-y: auto;
    scrollbar-width: thin;
  }

  .form-control, .form-select {
    border-radius: 6px;
  }

  .form-section::-webkit-scrollbar {
    width: 6px;
  }

  .form-section::-webkit-scrollbar-thumb {
    background-color: #999;
    border-radius: 4px;
  }

  .form-section::-webkit-scrollbar-track {
    background-color: #eee;
  }

  .position-relative {
    position: relative;
  }

  .eye-icon {
    position: absolute;
    top: 50px;
    right: 20px;
    transform: translateY(-50%);
    cursor: pointer;
    color: #aaa;
  }
</style>

<div class="container signup-container">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="form-section">

        <h2 class="text-center form-title mb-4">Create a GoldenHearts Account</h2>
        <form method="POST" action="signup.php" enctype="multipart/form-data" novalidate>

          <!-- Role Selection -->
          <div class="mb-3">
            <label for="role" class="form-label">Registering As</label>
            <select id="role" name="role" class="form-select" required onchange="toggleElderFields(this.value)">
              <option value="">-- Select Role --</option>
              <option value="donor">Donor</option>
              <option value="representative">Elder Home Representative</option>
            </select>
          </div>

          <!-- Common Fields -->
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" id="email" name="email" class="form-control" required>
            </div>
          </div>

          <div class="mb-3">
            <label for="contact" class="form-label">Phone Number</label>
            <input type="text" id="contact" name="contact" class="form-control" required>
          </div>

          <!-- Elder Home Fields -->
          <div id="elderFields" style="display: none;">
            <hr class="my-4">
            <h5 class="mb-3">Elder Home Details</h5>
            <div class="mb-3">
              <label for="homeName" class="form-label">Home Name</label>
              <input type="text" id="homeName" name="homeName" class="form-control">
            </div>
            <div class="mb-3">
              <label for="person" class="form-label">Contact Person</label>
              <input type="text" id="person" name="person" class="form-control">
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="homeEmail" class="form-label">Home Email</label>
                <input type="email" id="homeEmail" name="homeEmail" class="form-control">
              </div>
              <div class="col-md-6 mb-3">
                <label for="homePhone" class="form-label">Home Phone</label>
                <input type="text" id="homePhone" name="homePhone" class="form-control">
              </div>
            </div>
            <div class="mb-3">
              <label for="address" class="form-label">Address</label>
              <textarea id="address" name="address" class="form-control" rows="2"></textarea>
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Brief Description</label>
              <textarea id="description" name="description" class="form-control" rows="2"></textarea>
            </div>
            <div class="mb-3">
              <label for="documents" class="form-label">Upload Registration Document</label>
              <input type="file" id="documents" name="documents" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
              <small class="text-muted">PDF or image (max 5MB)</small>
            </div>
          </div>

          <!-- Password Fields -->
          <div class="row">
            <div class="col-md-6 mb-3 position-relative">
              <label for="password" class="form-label">Password</label>
              <input type="password" id="password" name="password" class="form-control" required>
              <i class="fas fa-eye eye-icon" onclick="togglePassword('password', this)"></i>
            </div>
            <div class="col-md-6 mb-3 position-relative">
              <label for="confirm_password" class="form-label">Confirm Password</label>
              <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
              <i class="fas fa-eye eye-icon" onclick="togglePassword('confirm_password', this)"></i>
            </div>
          </div>

          <!-- Terms -->
          <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="terms" required>
            <label class="form-check-label" for="terms">I accept the <a href="#">terms & privacy policy</a>.</label>
          </div>

          <!-- Buttons -->
          <div class="d-grid gap-2 mb-3">
            <button type="submit" class="btn btn-success">Register</button>
            <button type="button" class="btn btn-outline-danger"><i class="fab fa-google me-2"></i>Sign up with Google</button>
          </div>

          <p class="text-center">Already registered? <a href="signin.php">Sign in</a></p>

        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function toggleElderFields(role) {
    document.getElementById('elderFields').style.display = (role === 'representative') ? 'block' : 'none';
  }

  function togglePassword(fieldId, icon) {
    const input = document.getElementById(fieldId);
    const isPassword = input.type === "password";
    input.type = isPassword ? "text" : "password";
    icon.classList.toggle("fa-eye");
    icon.classList.toggle("fa-eye-slash");
  }
</script>

<?php include 'footer.php'; ?>
