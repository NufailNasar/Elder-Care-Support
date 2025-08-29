<!DOCTYPE html>
<html lang="en">

<?php
include('header.php');
?>

<body>

<main id="main" class="main">

  <div class="pagetitle d-flex justify-content-between align-items-center">
    <div>
      <h1>Reward Management</h1>
      <p class="text-muted">Approve, update, and manage visibility of rewards page content</p>
    </div>
    <div class="form-check form-switch">
      <input class="form-check-input" type="checkbox" id="leaderboardSwitch" checked>
      <label class="form-check-label" for="leaderboardSwitch">Leaderboard Visible on Rewards Page</label>
    </div>
  </div><!-- End Page Title -->

  <section class="section">

    <div class="card mb-4">
      <div class="card-body pt-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="card-title mb-0">Top Donors</h5>
          <button class="btn btn-primary btn-sm">Update Leaderboard</button>
        </div>
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Donor</th>
              <th>Email</th>
              <th>Total Donations</th>
              <th>Tier</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>James Walker</td>
              <td>jamesw@example.com</td>
              <td>LKR 150,000</td>
              <td>Gold Donor</td>
              <td>
                <button class="btn btn-sm btn-primary me-1">Approve</button>
                <button class="btn btn-sm btn-danger">Reject</button>
              </td>
            </tr>
            <tr>
              <td>Ayesha Perera</td>
              <td>ayesha@example.com</td>
              <td>LKR 50,000</td>
              <td>Gold Donor</td>
              <td>
                <button class="btn btn-sm btn-primary me-1">Approve</button>
                <button class="btn btn-sm btn-danger">Reject</button>
              </td>
            </tr>
            <tr>
              <td>Rajiv Fernando</td>
              <td>rajivf@example.com</td>
              <td>LKR 20,000</td>
              <td>Silver Donor</td>
              <td>
                <button class="btn btn-sm btn-primary me-1">Approve</button>
                <button class="btn btn-sm btn-danger">Reject</button>
              </td>
            </tr>
            <tr>
              <td>Mary Clarke</td>
              <td>Mary@example.com</td>
              <td>LKR 10,000</td>
              <td>Silver Donor</td>
              <td>
                <button class="btn btn-sm btn-primary me-1">Approve</button>
                <button class="btn btn-sm btn-danger">Reject</button>
              </td>
            </tr>
            <tr>
              <td>James Walker</td>
              <td>jamesw@example.com</td>
              <td>LKR 5,000</td>
              <td>Bronze Donor</td>
              <td>
                <button class="btn btn-sm btn-primary me-1">Approve</button>
                <button class="btn btn-sm btn-danger">Reject</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Total Donors Section -->
    <div class="card">
      <div class="card-body pt-3">
        <h5 class="card-title">Total Donors</h5>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Donor</th>
              <th>Email</th>
              <th>Total Donations</th>
              <th>Items</th>
              <th>Points</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>James Walker</td>
              <td>jamesw@example.com</td>
              <td>LKR 150,000</td>
              <td>3 Kits</td>
              <td>16000</td>
              <td>
                <button class="btn btn-sm btn-primary me-1">Approve</button>
                <button class="btn btn-sm btn-danger">Reject</button>
              </td>
            </tr>
            <tr>
              <td>Ayesha Perera</td>
              <td>ayesha@example.com</td>
              <td>LKR 50,000</td>
              <td>5 Tables</td>
              <td>12000</td>
              <td>
                <button class="btn btn-sm btn-primary me-1">Approve</button>
                <button class="btn btn-sm btn-danger">Reject</button>
              </td>
            </tr>
            <tr>
              <td>Rajiv Fernando</td>
              <td>rajivf@example.com</td>
              <td>LKR 20,000</td>
              <td>25 Chairs</td>
              <td>11000</td>
              <td>
                <button class="btn btn-sm btn-primary me-1">Approve</button>
                <button class="btn btn-sm btn-danger">Reject</button>
              </td>
            </tr>
            <tr>
              <td>Mary Clarke</td>
              <td>Mary@example.com</td>
              <td>LKR 10,000</td>
              <td>16 Beds</td>
              <td>10000</td>
              <td>
                <button class="btn btn-sm btn-primary me-1">Approve</button>
                <button class="btn btn-sm btn-danger">Reject</button>
              </td>
            </tr>
            <tr>
              <td>James Walker</td>
              <td>jamesw@example.com</td>
              <td>LKR 5,000</td>
              <td>50KG Rice</td>
              <td>9500</td>
              <td>
                <button class="btn btn-sm btn-primary me-1">Approve</button>
                <button class="btn btn-sm btn-danger">Reject</button>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="text-end">
          <a href="#">View more</a>
        </div>
      </div>
    </div>

  </section>
</main>




</body>

</html>

<?php
include('footer.php');
?>