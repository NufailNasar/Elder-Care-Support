<!DOCTYPE html>
<html lang="en">

<?php
include('header.php');
?>

<body>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Recent Activities</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Recent Activities</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Latest Platform Events</h5>

            <!-- Recent Activities Table -->
            <div class="table-responsive">
              <table class="table table-hover align-middle datatable">
                <thead class="table-light">
                  <tr>
                    <th scope="col">Date Changed</th>
                    <th scope="col">Section</th>
                    <th scope="col">Activity</th>
                    <th scope="col">Admin</th>
                    <th scope="col">Email</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>2025 May 10 - 4:20 PM</td>
                    <td>Donors</td>
                    <td>Donor “Nuwan Silva” earned the Gold Donor badge</td>
                    <td>Admin007</td>
                    <td>admin007@goldenheart.lk</td>
                  </tr>
                  <tr>
                    <td>2025 May 09 - 2:45 PM</td>
                    <td>Donations</td>
                    <td>Item donation of "10 Wheelchairs" marked as fulfilled</td>
                    <td>Admin012</td>
                    <td>admin012@goldenheart.lk</td>
                  </tr>
                  <tr>
                    <td>2025 May 08 - 11:10 AM</td>
                    <td>Elder Homes</td>
                    <td>“Sunshine Elderly Care” verified and approved</td>
                    <td>Admin009</td>
                    <td>admin009@goldenheart.lk</td>
                  </tr>
                  <tr>
                    <td>2025 May 07 - 3:30 PM</td>
                    <td>User Management</td>
                    <td>New donor account “kasun.@donor.com” registered</td>
                    <td>Admin004</td>
                    <td>admin004@goldenheart.lk</td>
                  </tr>
                  <tr>
                    <td>2025 May 06 - 10:25 AM</td>
                    <td>Dashboard Alerts</td>
                    <td>Urgent Call for Medical Supplies alert issued</td>
                    <td>Admin001</td>
                    <td>admin001@goldenheart.lk</td>
                  </tr>
                  <tr>
                    <td>2025 May 05 - 6:00 PM</td>
                    <td>Donations</td>
                    <td>Partial donation of “5 out of 12 Oxygen Cylinders” received</td>
                    <td>Admin010</td>
                    <td>admin010@goldenheart.lk</td>
                  </tr>
                  <tr>
                    <td>2025 May 04 - 9:10 AM</td>
                    <td>Reports</td>
                    <td>Monthly donation report for April downloaded</td>
                    <td>Admin015</td>
                    <td>admin015@goldenheart.lk</td>
                  </tr>
                  <tr>
                    <td>2025 May 03 - 1:50 PM</td>
                    <td>Notifications</td>
                    <td>Bulk SMS sent to donors about urgent needs</td>
                    <td>Admin006</td>
                    <td>admin006@goldenheart.lk</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- View More -->
            <div class="text-end mt-3">
              <a href="view-more-activities.php" class="btn btn-outline-primary btn-sm">
                View more <i class="bi bi-arrow-right-circle ms-1"></i>
              </a>
            </div>

          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->



</body>

</html>

<?php
include('footer.php');
?>