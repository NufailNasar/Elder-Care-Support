<?php
include('header.php');
include('../connection.php'); // adjust path as needed

// Get notifications data
$new_elders = mysqli_query($link, "SELECT home_name, created_at FROM users WHERE role='representative' ORDER BY created_at DESC LIMIT 5");
$new_donors = mysqli_query($link, "SELECT username, email, created_at FROM users WHERE role='donor' ORDER BY created_at DESC LIMIT 5");
$feedbacks = mysqli_query($link, "SELECT name, message, created_at FROM donor_reviews ORDER BY created_at DESC LIMIT 5");
$contacts = mysqli_query($link, "SELECT name, subject, created_at FROM contact_messages ORDER BY created_at DESC LIMIT 5");
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Notifications</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Notifications</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <ul class="list-group list-group-flush mt-3">

          <!-- New Elder Homes -->
          <?php while ($row = mysqli_fetch_assoc($new_elders)) { ?>
          <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
              <div class="fw-bold text-success">Register</div>
              New Elder Home Registered: <strong><?= htmlspecialchars($row['home_name']) ?></strong><br>
              <small class="text-muted"><?= htmlspecialchars($row['home_name']) ?> is awaiting approval.</small>
            </div>
            <span class="text-muted small"><?= date("d M Y h:i A", strtotime($row['created_at'])) ?></span>
          </li>
          <?php } ?>

          <!-- New Donors -->
          <?php while ($row = mysqli_fetch_assoc($new_donors)) { ?>
          <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
              <div class="fw-bold text-primary">Register</div>
              New Donor Registered: <strong><?= htmlspecialchars($row['username']) ?></strong><br>
              <small class="text-muted">Email: <?= htmlspecialchars($row['email']) ?></small>
            </div>
            <span class="text-muted small"><?= date("d M Y h:i A", strtotime($row['created_at'])) ?></span>
          </li>
          <?php } ?>

          <!-- Donor Feedback -->
          <?php while ($row = mysqli_fetch_assoc($feedbacks)) { ?>
          <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
              <div class="fw-bold text-info">Feedback</div>
              Donor Feedback from <strong><?= htmlspecialchars($row['name']) ?></strong><br>
              <small class="text-muted"><?= htmlspecialchars($row['message']) ?></small>
            </div>
            <span class="text-muted small"><?= date("d M Y h:i A", strtotime($row['created_at'])) ?></span>
          </li>
          <?php } ?>

          <!-- Contact Messages -->
          <?php while ($row = mysqli_fetch_assoc($contacts)) { ?>
          <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
              <div class="fw-bold text-warning">Contact</div>
              Message from <strong><?= htmlspecialchars($row['name']) ?></strong><br>
              <small class="text-muted">Subject: <?= htmlspecialchars($row['subject']) ?></small>
            </div>
            <span class="text-muted small"><?= date("d M Y h:i A", strtotime($row['created_at'])) ?></span>
          </li>
          <?php } ?>

        </ul>
      </div>
    </div>
  </section>
</main>

<?php include('footer.php'); ?>
