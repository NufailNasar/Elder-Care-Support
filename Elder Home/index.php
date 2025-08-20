<!DOCTYPE html>
<html lang="en">

<?php
include('header.php');
include('../connection.php');
?>

<body>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Elder Home Dashboard</h1>
    <nav>
      <div class="d-flex justify-content-end mb-3">
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addHomeModal">
    <i class="bi bi-plus-lg me-1"></i> Share New Needs
  </button>
</div>

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Registration Status & Profile Completion -->
      <div class="col-lg-4 col-md-6">
        <div class="card info-card">
          <div class="card-body">
            <h5 class="card-title">Registration Status</h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-info text-white">
                <i class="bi bi-file-check"></i>
              </div>
              <div class="ps-3">
                <h6>Approved</h6>
                <span class="text-success small fw-bold">Since April 1, 2023</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="card info-card">
          <div class="card-body">
            <h5 class="card-title">Profile Completion</h5>
            <div class="d-flex align-items-center">
              <div class="progress w-100" style="height: 24px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
              </div>
            </div>
            <small class="text-muted">Complete your profile to attract more donors.</small>
          </div>
        </div>
      </div>

      <!-- Current Needs Summary -->
      <div class="col-lg-4 col-md-12">
        <div class="card info-card">
          <div class="card-body">
            <h5 class="card-title">Active Needs</h5>
            <div class="d-flex justify-content-around">
              <div>
                <h6>Urgent</h6>
                <span class="badge bg-danger">5</span>
              </div>
              <div>
                <h6>Long-term</h6>
                <span class="badge bg-warning text-dark">12</span>
              </div>
              <div>
                <h6>One-time</h6>
                <span class="badge bg-info">7</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Donation Progress Card -->
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Donation Progress Overview</h5>

            <div id="donationProgressChart"></div>

            <script>
              document.addEventListener("DOMContentLoaded", () => {
                new ApexCharts(document.querySelector("#donationProgressChart"), {
                  series: [{
                    name: 'Fulfilled',
                    data: [60, 75, 90, 80, 85]
                  }, {
                    name: 'Pending',
                    data: [40, 25, 10, 20, 15]
                  }],
                  chart: {
                    type: 'bar',
                    height: 350,
                    stacked: true,
                    toolbar: { show: false }
                  },
                  plotOptions: {
                    bar: { horizontal: false, columnWidth: '55%' }
                  },
                  xaxis: {
                    categories: ['Food', 'Medical', 'Clothing', 'Furniture', 'Others'],
                    title: { text: 'Donation Categories' }
                  },
                  yaxis: {
                    title: { text: 'Percentage (%)' },
                    max: 100
                  },
                  fill: {
                    opacity: 1
                  },
                  tooltip: {
                    y: { formatter: (val) => val + "%" }
                  },
                  colors: ['#28a745', '#ffc107']
                }).render();
              });
            </script>
          </div>
        </div>
      </div>

      <!-- Notifications Center -->
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Notifications Center</h5>
            <ul class="list-group list-group-flush">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                New donation received for Medical Supplies
                <span class="badge bg-success rounded-pill">New</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Urgent need added: Winter Blankets
                <span class="badge bg-danger rounded-pill">Urgent</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Donation partially fulfilled: Food Packs
                <span class="badge bg-warning rounded-pill">Partial</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Registration renewal due in 30 days
                <span class="badge bg-info rounded-pill">Info</span>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Current Needs Table -->
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Current Donation Needs</h5>
            <table class="table table-hover align-middle">
              <thead class="table-light">
                <tr>
                  <th scope="col">Item</th>
                  <th scope="col">Category</th>
                  <th scope="col">Quantity Needed</th>
                  <th scope="col">Status</th>
                  <th scope="col">Urgency</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Medical Masks</td>
                  <td>Medical</td>
                  <td>500</td>
                  <td><span class="badge bg-warning text-dark">Partial</span></td>
                  <td><span class="badge bg-danger">Urgent</span></td>
                </tr>
                <tr>
                  <td>Rice Bags</td>
                  <td>Food</td>
                  <td>1000 kg</td>
                  <td><span class="badge bg-success">Fulfilled</span></td>
                  <td><span class="badge bg-info">Long-term</span></td>
                </tr>
                <tr>
                  <td>Blankets</td>
                  <td>Clothing</td>
                  <td>300</td>
                  <td><span class="badge bg-danger">Pending</span></td>
                  <td><span class="badge bg-danger">Urgent</span></td>
                </tr>
                <tr>
                  <td>Wheelchairs</td>
                  <td>Furniture</td>
                  <td>15</td>
                  <td><span class="badge bg-warning text-dark">Partial</span></td>
                  <td><span class="badge bg-warning text-dark">One-time</span></td>
                </tr>
                <tr>
                  <td>Sanitizers</td>
                  <td>Medical</td>
                  <td>200 liters</td>
                  <td><span class="badge bg-success">Fulfilled</span></td>
                  <td><span class="badge bg-info">Long-term</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Donation History Table -->
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Donation History</h5>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">Date</th>
                  <th scope="col">Donor</th>
                  <th scope="col">Item/Amount</th>
                  <th scope="col">Status</th>
                  <th scope="col">Notes</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>2025-04-10</td>
                  <td>Nadeesha Perera</td>
                  <td>500 Medical Masks</td>
                  <td><span class="badge bg-success">Received</span></td>
                  <td>Delivered on time</td>
                </tr>
                <tr>
                  <td>2025-04-15</td>
                  <td>Ravi De Silva</td>
                  <td>LKR 50,000</td>
                  <td><span class="badge bg-warning text-dark">Pending</span></td>
                  <td>Bank transfer verification</td>
                </tr>
                <tr>
                  <td>2025-04-20</td>
                  <td>Shanuki Fernando</td>
                  <td>200 Blankets</td>
                  <td><span class="badge bg-danger">Awaiting Pickup</span></td>
                  <td>Schedule pickup with donor</td>
                </tr>
                <tr>
                  <td>2025-05-01</td>
                  <td>Ruwan Gunasekara</td>
                  <td>10 Wheelchairs</td>
                  <td><span class="badge bg-success">Received</span></td>
                  <td>Delivered partially</td>
                </tr>
                <tr>
                  <td>2025-05-05</td>
                  <td>Dilani Senanayake</td>
                  <td>Sanitizers - 200 liters</td>
                  <td><span class="badge bg-success">Received</span></td>
                  <td>Ongoing monthly support</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </section>

</main><!-- End #main -->

<!-- Include ApexCharts library -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<!-- Include Bootstrap Icons for badges and icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


    <!-- Add Home Modal -->
    <div class="modal fade" id="addHomeModal" tabindex="-1" aria-labelledby="addHomeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <form id="addHomeForm" enctype="multipart/form-data">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add New Elder Home</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row g-3">
              <div class="col-md-6">
                <label class="form-label">Home Name</label>
                <input type="text" name="name" class="form-control" required>
              </div>
              <div class="col-md-6">
  <label class="form-label">Category</label>
  <select name="category" class="form-select" required onchange="toggleOtherCategory(this)">
    <option value="" disabled selected>Select Category</option>
    <option value="Daily Meals & Nutrition">Daily Meals & Nutrition</option>
    <option value="Medical Assistance">Medical Assistance</option>
    <option value="Safe & Clean Shelter">Safe & Clean Shelter</option>
    <option value="Mental Wellness & Companionship">Mental Wellness & Companionship</option>
    <option value="Clean Water & Sanitation">Clean Water & Sanitation</option>
    <option value="Emergency Aid">Emergency Aid</option>
    <option value="Other">Other</option>
  </select>
</div>

<div class="col-md-6 d-none" id="otherCategoryWrapper">
  <label class="form-label">Specify Other Category</label>
  <input type="text" id="otherCategory" class="form-control" placeholder="Enter custom category">
</div>


              <div class="col-md-6">
                <label class="form-label">Goal Amount (LKR)</label>
                <input type="number" name="goal_amount" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Raised Amount (LKR)</label>
                <input type="number" name="raised_amount" class="form-control" value="0" required>
              </div>
              <div class="col-12">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3" required></textarea>
              </div>
              <div class="col-12">
                <label class="form-label">Image</label>
                <input type="file" name="image" accept="image/*" class="form-control" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Add Home</button>
            </div>
          </div>
        </form>
      </div>
    </div>

<script>
document.getElementById("addHomeForm").addEventListener("submit", function(e){
    e.preventDefault();

    let formData = new FormData(this);

    fetch("../insert_home.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(res => {
        let trimmed = res.trim().toLowerCase();
        if(trimmed === "success") {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Elder Home Added Successfully!',
                confirmButtonColor: '#3085d6'
            }).then(() => {
                location.reload();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: res,
                confirmButtonColor: '#d33'
            });
        }
    })
    .catch(err => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An unexpected error occurred. Please try again.',
            confirmButtonColor: '#d33'
        });
    });
});
</script>
<script>
function toggleOtherCategory(selectElement) {
  const wrapper = document.getElementById('otherCategoryWrapper');
  const otherInput = document.getElementById('otherCategory');
  if (selectElement.value === 'Other') {
    wrapper.classList.remove('d-none');
    otherInput.setAttribute('name', 'other_category');
    otherInput.setAttribute('required', 'required');
  } else {
    wrapper.classList.add('d-none');
    otherInput.removeAttribute('name');
    otherInput.removeAttribute('required');
  }
}
</script>




</body>

</html>

<?php
include('footer.php');
?>