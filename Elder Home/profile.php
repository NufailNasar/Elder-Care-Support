<?php
session_start();
require '../connection.php'; // adjust if your connection file is in a different directory

// Ensure only logged-in representatives can access
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'representative') {
    header("Location: ../signin.php");
    exit();
}

// Get logged-in user details
$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username = ? AND role = 'representative' LIMIT 1";
$stmt = $link->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Assign fallback values if needed
$homeName = htmlspecialchars($user['home_name'] ?? 'Not Available');
$description = htmlspecialchars($user['description'] ?? 'No description provided.');
$contact = htmlspecialchars($user['home_phone'] ?? 'N/A');
$email = htmlspecialchars($user['home_email'] ?? 'N/A');
$address = htmlspecialchars($user['address'] ?? 'N/A');
$contactPerson = htmlspecialchars($user['contact_person'] ?? '');
$document = $user['documents'];
?>

<!DOCTYPE html>
<html lang="en">

<?php include('header.php'); ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Profile Management</h1>
    <p class="text-muted">Edit your elder home details and manage facility images</p>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Profile</li>
      </ol>
    </nav>
  </div>

  <section class="section profile">
    <div class="row">

      <!-- Summary Column -->
      <div class="col-xl-4">
        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            <img src="assets/img/PP1.jpg" alt="Elder Home Image" class="rounded-circle" style="width: 200px; height:200px; object-fit: cover;">
            <h2 id="homeNameDisplay"><?= $homeName ?></h2>
            <p class="text-center small fst-italic" id="homeDescriptionDisplay"><?= $description ?></p>
            <div class="mt-3 w-100">
              <h6><i class="bi bi-geo-alt-fill me-2"></i> Location:</h6>
              <p id="homeLocationDisplay"><?= $address ?></p>
              <h6><i class="bi bi-telephone-fill me-2"></i> Contact:</h6>
              <p id="homeContactDisplay"><?= $contact ?></p>
              <h6><i class="bi bi-envelope-fill me-2"></i> Email:</h6>
              <p id="homeEmailDisplay"><?= $email ?></p>
            </div>
          </div>
        </div>
      </div>

      <!-- Editable Section -->
      <div class="col-xl-8">
        <div class="card">
          <div class="card-body pt-3">
            <ul class="nav nav-tabs nav-tabs-bordered">
              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
              </li>
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-images">Facility Images</button>
              </li>
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-location">Location</button>
              </li>
            </ul>

            <div class="tab-content pt-3">

              <!-- Overview -->
              <div class="tab-pane fade show active" id="profile-overview">
                <h5 class="card-title">Elder Home Information</h5>
                <p><strong>Name:</strong> <?= $homeName ?></p>
                <p><strong>Description:</strong> <?= $description ?></p>
                <p><strong>Contact Number:</strong> <?= $contact ?></p>
                <p><strong>Email:</strong> <?= $email ?></p>
                <p><strong>Address:</strong> <?= $address ?></p>
              </div>

              <!-- Edit Profile (STATIC for now) -->
              <div class="tab-pane fade" id="profile-edit">
                <form id="profileEditForm">
                  <div class="row mb-3">
                    <label for="homeName" class="col-md-4 col-lg-3 col-form-label">Elder Home Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input type="text" class="form-control" id="homeName" value="<?= $homeName ?>" required>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="homeDescription" class="col-md-4 col-lg-3 col-form-label">Description</label>
                    <div class="col-md-8 col-lg-9">
                      <textarea class="form-control" id="homeDescription" rows="4" required><?= $description ?></textarea>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="homeContact" class="col-md-4 col-lg-3 col-form-label">Contact Number</label>
                    <div class="col-md-8 col-lg-9">
                      <input type="text" class="form-control" id="homeContact" value="<?= $contact ?>" required>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="homeEmail" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input type="email" class="form-control" id="homeEmail" value="<?= $email ?>" required>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="homeAddress" class="col-md-4 col-lg-3 col-form-label">Address</label>
                    <div class="col-md-8 col-lg-9">
                      <input type="text" class="form-control" id="homeAddress" value="<?= $address ?>" required>
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes (Coming Soon)</button>
                  </div>
                </form>
              </div>

              <!-- Facility Images -->
              <div class="tab-pane fade" id="profile-images">
                <h5 class="card-title">Manage Facility Images</h5>
                <form id="facilityImagesForm" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label for="imageUpload" class="form-label">Upload Images</label>
                    <input class="form-control" type="file" id="imageUpload" accept="image/*" multiple>
                    <small class="text-muted">You can upload multiple images showcasing your facilities.</small>
                  </div>
                  <div id="imagePreview" class="d-flex flex-wrap gap-3"></div>
                  <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">Upload Images (Coming Soon)</button>
                  </div>
                </form>
              </div>

              <!-- Location -->
              <div class="tab-pane fade" id="profile-location">
                <h5 class="card-title">Update Location</h5>
                <div id="map" style="height: 400px; width: 100%; border-radius: 5px;"></div>
                <form class="mt-3">
                  <div class="row mb-3">
                    <label for="latitude" class="col-md-4 col-lg-3 col-form-label">Latitude</label>
                    <div class="col-md-8 col-lg-9">
                      <input type="text" class="form-control" id="latitude" readonly>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="longitude" class="col-md-4 col-lg-3 col-form-label">Longitude</label>
                    <div class="col-md-8 col-lg-9">
                      <input type="text" class="form-control" id="longitude" readonly>
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="button" class="btn btn-primary">Save Location (Coming Soon)</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
</main>

<!-- JS Dependencies -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY"></script>

<?php include('footer.php'); ?>
