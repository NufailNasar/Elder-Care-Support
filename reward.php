<?php
session_start();
include('header.php');
include('connection.php');

// Validate session
$loggedEmail = $_SESSION['email'] ?? null;
if (!$loggedEmail) {
    echo "<script>alert('Please login to view rewards'); window.location.href='signin.php';</script>";
    exit;
}

// User donation stats
$userStats = mysqli_fetch_assoc(mysqli_query($link, "
  SELECT 
    SUM(CASE WHEN donation_type = 'money' THEN amount ELSE 0 END) AS total_money,
    COUNT(*) AS donation_count,
    MIN(created_at) AS first_donation,
    MAX(created_at) AS last_donation
  FROM donations
  WHERE donor_email = '$loggedEmail' AND status = 'approved'
"));

$totalAmount = number_format($userStats['total_money'] ?? 0, 2);
$donationCount = (int)($userStats['donation_count'] ?? 0);
$start = $userStats['first_donation'] ? date('M Y', strtotime($userStats['first_donation'])) : '-';
$end = $userStats['last_donation'] ? date('M Y', strtotime($userStats['last_donation'])) : '-';

// Badge logic
if ($donationCount < 10) $nextBadge = "🎖️ Bronze Donor<br>Donate " . (10 - $donationCount) . " more";
elseif ($donationCount < 15) $nextBadge = "🎖️ Silver Donor<br>Donate " . (15 - $donationCount) . " more";
elseif ($donationCount < 20) $nextBadge = "🎖️ Gold Donor<br>Donate " . (20 - $donationCount) . " more";
elseif ($donationCount < 25) $nextBadge = "🎖️ Platinum Donor<br>Donate " . (25 - $donationCount) . " more";
elseif ($donationCount < 30) $nextBadge = "🎖️ Diamond Donor<br>Donate " . (30 - $donationCount) . " more";
else $nextBadge = "🏆 Diamond Donor<br>You're at the top!";

// Fetch donation history
$history = mysqli_query($link, "
  SELECT d.*, e.name AS home_name
  FROM donations d
  JOIN elder_homes e ON d.elder_home_id = e.id
  WHERE donor_email = '$loggedEmail'
  ORDER BY d.created_at DESC
");

// Top donors
$topDonors = mysqli_query($link, "
  SELECT donor_name, donor_email,
         COUNT(*) AS donation_count,
         SUM(CASE WHEN donation_type = 'money' THEN amount ELSE 0 END) AS total_amount,
         MAX(created_at) AS last_donated
  FROM donations
  WHERE status = 'approved'
  GROUP BY donor_email
  ORDER BY donation_count DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
</head>
<body>

<!-- Page Header -->
<div class="container-fluid page-header py-5 mb-5">
  <div class="container text-center py-5">
    <h1 class="display-4 text-white">Donor Rewards</h1>
    <p class="lead text-white-50">We proudly recognize the hearts that give. Thank you for making a difference.</p>
  </div>
</div>

<!-- Event Highlight -->
<div class="alert alert-warning text-center mb-5">
  🎉 <strong>Next Donor Appreciation Event:</strong> <u>Next Month 25th</u>!<br>
  🌟 Top 10 Donors will be honored!
</div>

<!-- Top Donors -->
<div class="container mb-5">
  <h5 class="text-primary mb-3">Top Donors (by Count)</h5>
  <table class="table table-striped text-center display" id="topDonorsTable">
    <thead class="table-dark">
      <tr>
        <th>Rank</th>
        <th>Donor Name</th>
        <th>Email</th>
        <th>Donations</th>
        <th>Total Donated</th>
        <th>Last Donated</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; while ($donor = mysqli_fetch_assoc($topDonors)) {
        $icon = $i == 1 ? '🥇' : ($i == 2 ? '🥈' : ($i == 3 ? '🥉' : $i));
      ?>
        <tr>
          <td><?= $icon ?></td>
          <td><?= htmlspecialchars($donor['donor_name']) ?></td>
          <td><?= htmlspecialchars($donor['donor_email']) ?></td>
          <td><?= $donor['donation_count'] ?></td>
          <td>LKR <?= number_format($donor['total_amount'], 2) ?></td>
          <td><?= date('Y-m-d', strtotime($donor['last_donated'])) ?></td>
        </tr>
      <?php $i++; } ?>
    </tbody>
  </table>
</div>

<!-- Dashboard -->
<div class="container pb-5">
  <h4 class="mb-4">Welcome Back</h4>
  <div class="row g-4">
    <div class="col-md-4">
      <div class="bg-light p-4 rounded text-center h-100">
        <h6>Total Donations</h6>
        <h4 class="text-primary">Rs. <?= $totalAmount ?> + <?= $donationCount ?> Donations</h4>
      </div>
    </div>
    <div class="col-md-4">
      <div class="bg-light p-4 rounded text-center h-100">
        <h6>Donation Period</h6>
        <p><?= "$start - $end" ?></p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="bg-light p-4 rounded text-center h-100">
        <h6>Next Badge</h6>
        <p><?= $nextBadge ?></p>
      </div>
    </div>
  </div>

  <!-- Badges -->
  <div class="mt-5">
    <h5 class="mb-3">Badges & Milestones</h5>
    <div class="d-flex gap-3 flex-wrap">
      <div class="text-center"><img src="img/R1.png" width="50"><br><small>New</small></div>
      <div class="text-center"><img src="img/R2.png" width="50"><br><small>Bronze</small></div>
      <div class="text-center"><img src="img/R3.png" width="50"><br><small>Silver</small></div>
      <div class="text-center"><img src="img/R4.png" width="50"><br><small>Gold</small></div>
      <div class="text-center"><img src="img/R5.png" width="50"><br><small>Platinum</small></div>
      <div class="text-center"><img src="img/R7.png" width="50"><br><small>Diamond</small></div>
    </div>
  </div>
</div>

<!-- Donation History -->
<div class="container pb-5">
  <h4 class="mb-4">Your Donation History</h4>
  <div class="table-responsive">
    <table class="table table-bordered text-center display" id="historyTable">
      <thead class="table-secondary">
        <tr>
          <th>Date</th>
          <th>Amount</th>
          <th>Beneficiary</th>
          <th>Method</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($history)) { ?>
        <tr>
          <td><?= date('Y-m-d', strtotime($row['created_at'])) ?></td>
          <td><?= $row['donation_type'] === 'money' ? 'Rs. ' . number_format($row['amount'], 2) : htmlspecialchars($row['item_detail']) ?></td>
          <td><?= htmlspecialchars($row['home_name']) ?></td>
          <td><?= isset($row['payment_method']) ? htmlspecialchars($row['payment_method']) : '-' ?></td>
          <td><?= ucfirst($row['status']) ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script>
$(document).ready(function() {
  $('#topDonorsTable, #historyTable').DataTable({
    dom: 'Bfrtip',
    buttons: ['excel', 'pdf', 'print']
  });
});
</script>

</body>
</html>

<?php include('footer.php'); ?>
