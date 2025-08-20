<!DOCTYPE html>
<html lang="en">

<?php
include('header.php');
?>

<body>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>User Management</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
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
              <option value="Elder Home">Elder Home</option>
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

        <!-- Table -->
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
            <tr>
              <td>John Doe</td>
              <td>john@example.com</td>
              <td><span class="badge bg-success">Donor</span></td>
              <td><span class="badge bg-success">Active</span></td>
              <td><a href="#" class="text-danger">Disable</a></td>
            </tr>
            <tr>
              <td>Mary Clarke</td>
              <td>mary@example.com</td>
              <td><span class="badge bg-success">Donor</span></td>
              <td><span class="badge bg-danger">Disabled</span></td>
              <td><a href="#" class="text-success">Enable</a></td>
            </tr>
            <tr>
              <td>Robert Crane</td>
              <td>robert@example.com</td>
              <td><span class="badge bg-info">Elder Home</span></td>
              <td><span class="badge bg-success">Active</span></td>
              <td><a href="#" class="text-danger">Disable</a></td>
            </tr>
            <tr>
              <td>Linda Foster</td>
              <td>linda@example.com</td>
              <td><span class="badge bg-success">Donor</span></td>
              <td><span class="badge bg-danger">Disabled</span></td>
              <td><a href="#" class="text-success">Enable</a></td>
            </tr>
            <tr>
              <td>William Green</td>
              <td>william@example.com</td>
              <td><span class="badge bg-warning text-dark">Admin</span></td>
              <td><span class="badge bg-success">Active</span></td>
              <td><a href="#" class="text-danger">Disable</a></td>
            </tr>
            <!-- Add more rows as needed -->
          </tbody>
        </table>

      </div>
    </div>
  </section>

</main>



</body>

</html>

<?php
include('footer.php');
?>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const roleFilter = document.getElementById("filterRole");
    const statusFilter = document.getElementById("filterStatus");
    const searchInput = document.getElementById("searchUser");
    const rows = document.querySelectorAll("#userTable tbody tr");

    function filterTable() {
      const role = roleFilter.value;
      const status = statusFilter.value;
      const search = searchInput.value.toLowerCase();

      rows.forEach(row => {
        const roleText = row.cells[2].innerText;
        const statusText = row.cells[3].innerText;
        const nameEmail = (row.cells[0].innerText + " " + row.cells[1].innerText).toLowerCase();

        const matchRole = role === "All Roles" || roleText.includes(role);
        const matchStatus = status === "All Statuses" || statusText.includes(status);
        const matchSearch = nameEmail.includes(search);

        row.style.display = (matchRole && matchStatus && matchSearch) ? "" : "none";
      });
    }

    roleFilter.addEventListener("change", filterTable);
    statusFilter.addEventListener("change", filterTable);
    searchInput.addEventListener("input", filterTable);
  });
</script>
