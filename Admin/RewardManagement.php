<?php
include('header.php');
include('../connection.php');

// Filter logic
$statusFilter = $_GET['filter'] ?? 'all';
$statusClause = "";
if ($statusFilter === 'pending') $statusClause = "WHERE d.status = 'pending'";
elseif ($statusFilter === 'approved') $statusClause = "WHERE d.status = 'approved'";
elseif ($statusFilter === 'rejected') $statusClause = "WHERE d.status = 'rejected'";

// Fetch donation records
$query = "SELECT d.*, e.name AS home_name 
          FROM donations d
          JOIN elder_homes e ON d.elder_home_id = e.id 
          $statusClause
          ORDER BY d.created_at DESC";
$donations = mysqli_query($link, $query);

// Total donations per donor
$totalDonations = mysqli_query($link, "
  SELECT donor_name, donor_email, 
         SUM(CASE WHEN donation_type = 'money' THEN amount ELSE 0 END) AS total_money,
         COUNT(*) AS donation_count
  FROM donations
  GROUP BY donor_email
");

// Top donors sorted by donation count
$topDonors = mysqli_query($link, "
  SELECT donor_name, donor_email, 
         COUNT(*) AS donation_count, 
         SUM(CASE WHEN donation_type = 'money' THEN amount ELSE 0 END) AS total_amount
  FROM donations
  GROUP BY donor_email
  ORDER BY donation_count DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
  <style>
    .bg-purple { background-color: #6f42c1; color: #fff; }
  </style>
</head>
<body>
<main id="main" class="main">

  <div class="pagetitle d-flex justify-content-between align-items-center">
    <div>
      <h1>Reward Management</h1>
      <p class="text-muted">Approve and manage donations</p>
    </div>
  </div>

  <section class="section">

    <!-- Filter Buttons -->
    <div class="mb-3">
      <a href="?filter=all" class="btn btn-sm <?= $statusFilter === 'all' ? 'btn-primary' : 'btn-outline-primary' ?>">Show All</a>
      <a href="?filter=pending" class="btn btn-sm <?= $statusFilter === 'pending' ? 'btn-primary' : 'btn-outline-primary' ?>">Pending</a>
      <a href="?filter=approved" class="btn btn-sm <?= $statusFilter === 'approved' ? 'btn-primary' : 'btn-outline-primary' ?>">Approved</a>
      <a href="?filter=rejected" class="btn btn-sm <?= $statusFilter === 'rejected' ? 'btn-primary' : 'btn-outline-primary' ?>">Rejected</a>
    </div>

    <!-- Donation Table -->
    <div class="card mb-4">
      <div class="card-body pt-3">
        <h5 class="card-title">Donations</h5>
        <table class="table table-hover display" id="donationTable">
          <thead>
            <tr>
              <th>Donor</th>
              <th>Email</th>
              <th>Type</th>
              <th>Amount / Item</th>
              <th>Elder Home</th>
              <th>Date</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = mysqli_fetch_assoc($donations)) { ?>
            <tr>
              <td><?= htmlspecialchars($row['donor_name']) ?></td>
              <td><?= htmlspecialchars($row['donor_email']) ?></td>
              <td><?= htmlspecialchars($row['donation_type']) ?></td>
              <td><?= $row['donation_type'] === 'money' ? 'LKR ' . number_format($row['amount'], 2) : htmlspecialchars($row['item_detail']) ?></td>
              <td><?= htmlspecialchars($row['home_name']) ?></td>
              <td><?= date('Y-m-d', strtotime($row['created_at'])) ?></td>
              <td>
                <?php if ($row['status'] === 'pending'): ?>
                  <button class="btn btn-sm btn-success" onclick="handleAction(<?= $row['id'] ?>, 'approve')">Approve</button>
                  <button class="btn btn-sm btn-danger" onclick="handleAction(<?= $row['id'] ?>, 'reject')">Reject</button>
                <?php elseif ($row['status'] === 'approved'): ?>
                  <span class="badge bg-success">Approved</span>
                <?php elseif ($row['status'] === 'rejected'): ?>
                  <span class="badge bg-danger" title="<?= htmlspecialchars($row['rejection_reason'] ?? '') ?>">Rejected</span>
                <?php endif; ?>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Total Donations Summary -->
    <div class="card">
      <div class="card-body pt-3">
        <h5 class="card-title">Total Donations Per Donor</h5>
        <table class="table table-bordered display" id="summaryTable">
          <thead>
            <tr>
              <th>Donor</th>
              <th>Email</th>
              <th>Total Money Donated (LKR)</th>
              <th>Donation Count</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($sum = mysqli_fetch_assoc($totalDonations)) { ?>
            <tr>
              <td><?= htmlspecialchars($sum['donor_name']) ?></td>
              <td><?= htmlspecialchars($sum['donor_email']) ?></td>
              <td><?= number_format($sum['total_money'], 2) ?></td>
              <td><?= $sum['donation_count'] ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Top Donors by Donation Count -->
    <div class="card mt-4">
      <div class="card-body pt-3">
        <h5 class="card-title">Top Donors (by Donation Count)</h5>
        <table class="table table-bordered display" id="topDonorsTable">
          <thead>
            <tr>
              <th>Rank</th>
              <th>Donor</th>
              <th>Email</th>
              <th>Donations Made</th>
              <th>Total Amount (LKR)</th>
              <th>Tier</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $rank = 1;
            while ($donor = mysqli_fetch_assoc($topDonors)) {
              $count = $donor['donation_count'];
              $tier = "";
              $badgeClass = "";

              if ($count >= 30) { $tier = "Diamond"; $badgeClass = "bg-purple"; }
              elseif ($count >= 25) { $tier = "Platinum"; $badgeClass = "bg-primary"; }
              elseif ($count >= 20) { $tier = "Gold"; $badgeClass = "bg-warning text-dark"; }
              elseif ($count >= 15) { $tier = "Silver"; $badgeClass = "bg-secondary"; }
              elseif ($count >= 10) { $tier = "Bronze"; $badgeClass = "bg-dark"; }
            ?>
            <tr>
              <td><?= $rank++ ?></td>
              <td><?= htmlspecialchars($donor['donor_name']) ?></td>
              <td><?= htmlspecialchars($donor['donor_email']) ?></td>
              <td><?= $count ?></td>
              <td><?= number_format($donor['total_amount'], 2) ?></td>
              <td><?= $tier ? "<span class='badge $badgeClass'>$tier</span>" : "-" ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>

  </section>
</main>

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
  $('#donationTable, #summaryTable, #topDonorsTable').DataTable({
    dom: 'Bfrtip',
    buttons: ['excel', 'pdf', 'print']
  });
});

function handleAction(id, action) {
  const reason = action === 'reject' ? prompt("Enter rejection reason:") : "";
  if (action === 'reject' && !reason) return;

  fetch('process_donation_status.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `id=${id}&action=${action}&reason=${encodeURIComponent(reason)}`
  })
  .then(res => res.text())
  .then(res => {
    alert(res);
    location.reload();
  });
}
</script>
</body>
</html>

<?php include('footer.php'); ?>
