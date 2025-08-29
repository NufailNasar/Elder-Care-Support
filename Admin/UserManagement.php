<!DOCTYPE html>
<html lang="en">

<?php
include('header.php');
include('../connection.php');
?>

<body>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>User Management</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">User Management</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="card">
      <div class="card-body pt-4">

        <!-- Filters -->
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
          <div class="d-flex flex-wrap gap-2">
            <select class="form-select" id="filterRole" style="width: 180px;">
              <option selected>All Roles</option>
              <option value="Donor">Donor</option>
              <option value="Admin">Admin</option>
              <option value="Representative">Elder Home</option>
            </select>

            <select class="form-select" id="filterStatus" style="width: 180px;">
              <option selected>All Statuses</option>
              <option value="Active">Active</option>
              <option value="Disabled">Disabled</option>
            </select>
          </div>

          <div class="input-group w-auto">
            <input type="text" id="searchUser" class="form-control" placeholder="Search users...">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
          </div>
        </div>

        <!-- User Table -->
        <table class="table table-hover" id="userTable">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "SELECT username, email, role, status FROM users";
            $result = mysqli_query($link, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $username = htmlspecialchars($row['username']);
                $email = htmlspecialchars($row['email']);
                $role = ucfirst($row['role']);
                $status = $row['status'] === 'Disabled' ? 'Disabled' : 'Active';

                $roleBadge = ($role === 'Admin') ? 'bg-warning text-dark' :
                             (($role === 'Representative') ? 'bg-info' : 'bg-success');

                $statusBadge = ($status === 'Disabled') ? 'bg-danger' : 'bg-success';
                $actionText = ($status === 'Disabled') ? 'Enable' : 'Disable';
                $actionClass = ($status === 'Disabled') ? 'text-success' : 'text-danger';

                echo "<tr>
                        <td>$username</td>
                        <td>$email</td>
                        <td><span class='badge $roleBadge'>$role</span></td>
                        <td><span class='badge $statusBadge'>$status</span></td>
                        <td><a href='#' class='$actionClass'>$actionText</a></td>
                      </tr>";
            }
            ?>
          </tbody>
        </table>

      </div>
    </div>
  </section>

</main>

</body>

</html>

<?php include('footer.php'); ?>

<!-- Client-side filtering script -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const roleFilter = document.getElementById("filterRole");
    const statusFilter = document.getElementById("filterStatus");
    const searchInput = document.getElementById("searchUser");
    const rows = document.querySelectorAll("#userTable tbody tr");

    function filterTable() {
      const role = roleFilter.value.toLowerCase();
      const status = statusFilter.value.toLowerCase();
      const search = searchInput.value.toLowerCase();

      rows.forEach(row => {
        const name = row.cells[0].innerText.toLowerCase();
        const email = row.cells[1].innerText.toLowerCase();
        const roleText = row.cells[2].innerText.toLowerCase();
        const statusText = row.cells[3].innerText.toLowerCase();

        const matchRole = role === "all roles" || roleText.includes(role);
        const matchStatus = status === "all statuses" || statusText.includes(status);
        const matchSearch = name.includes(search) || email.includes(search);

        row.style.display = (matchRole && matchStatus && matchSearch) ? "" : "none";
      });
    }

    roleFilter.addEventListener("change", filterTable);
    statusFilter.addEventListener("change", filterTable);
    searchInput.addEventListener("input", filterTable);
  });
</script>
