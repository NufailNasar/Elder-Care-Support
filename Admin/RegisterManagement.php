<?php
include('../connection.php'); // Assumes $conn is defined

$sql = "SELECT * FROM elder_homes WHERE status = 'pending'";
$result = mysqli_query($link, $sql);
?>

<?php
function getRejectionReason($desc) {
    // Extracts rejection reason if appended
    if (strpos($desc, 'Rejection Reason:') !== false) {
        return trim(substr($desc, strpos($desc, 'Rejection Reason:')));
    }
    return 'No reason provided.';
}
?>


<!DOCTYPE html>
<html lang="en">
<?php include('header.php'); ?>
<body>
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Registration Management</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Register Management</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <!-- Pending Registrations -->
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Pending Registrations</h5>

            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Elder Home Name</th>
                  <th>Category</th>
                  <th>Goal Amount</th>
                  <th>Raised</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                  <td><?= htmlspecialchars($row['name']) ?></td>
                  <td><?= htmlspecialchars($row['category']) ?></td>
                  <td><?= htmlspecialchars($row['goal_amount']) ?></td>
                  <td><?= htmlspecialchars($row['raised_amount']) ?></td>
                  <td>
                    <div class="dropdown">
                      <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">Actions</button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item text-success" href="#" onclick="approveHome(<?= $row['id'] ?>)">Approve</a></li>
                        <li><a class="dropdown-item text-danger" href="#" onclick="rejectHome(<?= $row['id'] ?>)">Reject</a></li>
                      </ul>
                    </div>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Registered Elder Home History -->
        <div class="card mt-4">
          <div class="card-body">
            <h5 class="card-title">Registered Elder Home History</h5>

            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Goal</th>
                  <th>Raised</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $history = mysqli_query($link, "SELECT * FROM elder_homes WHERE status IN ('accepted', 'rejected')");

              while ($row = mysqli_fetch_assoc($history)) {
              ?>
                <tr>
                  <td><?= htmlspecialchars($row['name']) ?></td>
                  <td><?= htmlspecialchars($row['category']) ?></td>
                  <td><?= $row['goal_amount'] ?></td>
                  <td><?= $row['raised_amount'] ?></td>
                  <td>
  <?php if ($row['status'] == 'accepted'): ?>
    <span class="badge bg-success">Accepted</span>
  <?php elseif ($row['status'] == 'rejected'): ?>
    <span class="badge bg-danger" title="<?= htmlspecialchars(getRejectionReason($row['description'])) ?>">Rejected</span>
  <?php endif; ?>
</td>

                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function approveHome(id) {
  Swal.fire({
    title: "Approve this Elder Home?",
    icon: "question",
    showCancelButton: true,
    confirmButtonColor: "#28a745",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, Approve"
  }).then((result) => {
    if (result.isConfirmed) {
      fetch('process_submission.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `action=approve&id=${id}`
      })
      .then(res => res.text())
      .then(() => {
        Swal.fire("Approved!", "The elder home has been approved.", "success").then(() => location.reload());
      });
    }
  });
}

function rejectHome(id) {
  Swal.fire({
    title: "Reject Elder Home",
    input: "textarea",
    inputLabel: "Reason for rejection",
    inputPlaceholder: "Enter reason here...",
    inputAttributes: { "aria-label": "Reason" },
    showCancelButton: true,
    confirmButtonColor: "#d33",
    confirmButtonText: "Reject"
  }).then((result) => {
    if (result.isConfirmed && result.value.trim() !== "") {
      const reason = encodeURIComponent(result.value.trim());
      fetch('process_submission.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `action=reject&id=${id}&reason=${reason}`
      })
      .then(res => res.text())
      .then(() => {
        Swal.fire("Rejected!", "The elder home was rejected.", "success").then(() => location.reload());
      });
    } else if (result.isConfirmed) {
      Swal.fire("Error", "Rejection reason is required!", "error");
    }
  });
}
</script>
</body>
</html>

<?php include('footer.php'); ?>
