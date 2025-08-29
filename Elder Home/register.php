<!DOCTYPE html>
<html lang="en">

<?php
include('header.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Elder Home Registration</h1>
    <p class="text-muted">Fill in your elder home details and submit for approval</p>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Elder Home Registration</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="card">
      <div class="card-body pt-4">

        <form id="elderHomeRegistrationForm" novalidate>

          <div class="row mb-3">
            <label for="homeName" class="col-md-3 col-form-label">Elder Home Name <span class="text-danger">*</span></label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="homeName" placeholder="Enter elder home name" required>
              <div class="invalid-feedback">Please enter the elder home name.</div>
            </div>
          </div>

          <div class="row mb-3">
            <label for="contactPerson" class="col-md-3 col-form-label">Contact Person <span class="text-danger">*</span></label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="contactPerson" placeholder="Enter contact person's full name" required>
              <div class="invalid-feedback">Please enter the contact person's name.</div>
            </div>
          </div>

          <div class="row mb-3">
            <label for="contactEmail" class="col-md-3 col-form-label">Contact Email <span class="text-danger">*</span></label>
            <div class="col-md-9">
              <input type="email" class="form-control" id="contactEmail" placeholder="Enter contact email" required>
              <div class="invalid-feedback">Please enter a valid email address.</div>
            </div>
          </div>

          <div class="row mb-3">
            <label for="contactPhone" class="col-md-3 col-form-label">Contact Phone <span class="text-danger">*</span></label>
            <div class="col-md-9">
              <input type="tel" class="form-control" id="contactPhone" placeholder="Enter contact phone number" required pattern="^\+?[0-9\s\-]{7,15}$">
              <div class="invalid-feedback">Please enter a valid phone number.</div>
            </div>
          </div>

          <div class="row mb-3">
            <label for="address" class="col-md-3 col-form-label">Address <span class="text-danger">*</span></label>
            <div class="col-md-9">
              <textarea class="form-control" id="address" rows="2" placeholder="Enter physical address" required></textarea>
              <div class="invalid-feedback">Please enter the address.</div>
            </div>
          </div>

          <div class="row mb-3">
            <label for="description" class="col-md-3 col-form-label">Description</label>
            <div class="col-md-9">
              <textarea class="form-control" id="description" rows="3" placeholder="Brief description of the elder home"></textarea>
            </div>
          </div>

          <div class="row mb-3">
            <label for="registrationDocs" class="col-md-3 col-form-label">Registration Documents</label>
            <div class="col-md-9">
              <input class="form-control" type="file" id="registrationDocs" multiple accept=".pdf,.jpg,.jpeg,.png">
              <small class="text-muted">Upload scanned registration certificates or approvals (PDF, JPG, PNG).</small>
            </div>
          </div>

          <div class="row mb-3">
            <label for="terms" class="col-md-3 col-form-label">Terms & Conditions <span class="text-danger">*</span></label>
            <div class="col-md-9 d-flex align-items-center">
              <input type="checkbox" id="terms" required class="form-check-input me-2">
              <label for="terms" class="form-check-label">I agree to the <a href="#" target="_blank">terms and conditions</a>.</label>
              <div class="invalid-feedback">You must agree before submitting.</div>
            </div>
          </div>

          <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit Registration</button>
          </div>

        </form>

      </div>
    </div>
  </section>

</main>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<script>
  // Bootstrap 5 Form Validation
  (function () {
    'use strict'
    const form = document.getElementById('elderHomeRegistrationForm');

    form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      } else {
        event.preventDefault();
        alert('Registration form submitted successfully! Pending approval.');
        // Here you would implement actual form submission (AJAX or form POST)
        form.reset();
      }
      form.classList.add('was-validated')
    }, false)
  })()
</script>


</html>

<?php
include('footer.php');
?>