<!DOCTYPE html>
<html lang="en">

<?php
include('header.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Admin Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.html">Dashboard</a></li>
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item active">Profile</li>
      </ol>
    </nav>
  </div>

  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            <img src="assets/img/admin-profile.jpg" alt="Admin Profile" class="rounded-circle" style="width: 120px;">
            <h2>Alex Morgan</h2>
            <h3>System Administrator</h3>
            <span class="text-muted small">GoldenHearts Platform</span>
            <div class="social-links mt-2">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>

      </div>

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
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-security">Change Password</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
              </li>

            </ul>

            <div class="tab-content pt-2">

              <!-- Overview Tab -->
              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">Admin Information</h5>
                <div class="row"><div class="col-lg-4 col-md-4 label">Full Name</div><div class="col-lg-8 col-md-8">Alex Morgan</div></div>
                <div class="row"><div class="col-lg-4 col-md-4 label">Email</div><div class="col-lg-8 col-md-8">admin@goldenhearts.org</div></div>
                <div class="row"><div class="col-lg-4 col-md-4 label">Role</div><div class="col-lg-8 col-md-8">System Administrator</div></div>
                <div class="row"><div class="col-lg-4 col-md-4 label">Managed Modules</div><div class="col-lg-8 col-md-8">Users, Rewards, Reports, Donations</div></div>
                <div class="row"><div class="col-lg-4 col-md-4 label">Admin Since</div><div class="col-lg-8 col-md-8">March 15, 2022</div></div>
                <div class="row"><div class="col-lg-4 col-md-4 label">Phone</div><div class="col-lg-8 col-md-8">+1 (555) 123-4567</div></div>
                <div class="row"><div class="col-lg-4 col-md-4 label">Country</div><div class="col-lg-8 col-md-8">USA</div></div>
              </div>

              <!-- Edit Profile Tab -->
              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                <form>
                  <div class="row mb-3"><label class="col-md-4 col-lg-3 col-form-label">Full Name</label><div class="col-md-8 col-lg-9"><input type="text" class="form-control" value="Alex Morgan"></div></div>
                  <div class="row mb-3"><label class="col-md-4 col-lg-3 col-form-label">Email</label><div class="col-md-8 col-lg-9"><input type="email" class="form-control" value="admin@goldenhearts.org"></div></div>
                  <div class="row mb-3"><label class="col-md-4 col-lg-3 col-form-label">Phone</label><div class="col-md-8 col-lg-9"><input type="text" class="form-control" value="+1 (555) 123-4567"></div></div>
                  <div class="row mb-3"><label class="col-md-4 col-lg-3 col-form-label">LinkedIn</label><div class="col-md-8 col-lg-9"><input type="text" class="form-control" value="https://linkedin.com/in/admin"></div></div>
                  <div class="text-center"><button type="submit" class="btn btn-primary">Save Changes</button></div>
                </form>
              </div>

              <!-- Change Password Tab -->
              <div class="tab-pane fade pt-3" id="profile-security">
                <form>
                  <div class="row mb-3"><label class="col-md-4 col-lg-3 col-form-label">Current Password</label><div class="col-md-8 col-lg-9"><input type="password" class="form-control"></div></div>
                  <div class="row mb-3"><label class="col-md-4 col-lg-3 col-form-label">New Password</label><div class="col-md-8 col-lg-9"><input type="password" class="form-control"></div></div>
                  <div class="row mb-3"><label class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label><div class="col-md-8 col-lg-9"><input type="password" class="form-control"></div></div>
                  <div class="text-center"><button type="submit" class="btn btn-primary">Update Password</button></div>
                </form>
              </div>

              <!-- Settings Tab -->
              <div class="tab-pane fade pt-3" id="profile-settings">
                <h5 class="card-title">Site Settings</h5>
                <form>
                  <div class="row mb-3">
                    <label class="col-md-4 col-lg-3 col-form-label">Site Title</label>
                    <div class="col-md-8 col-lg-9">
                      <input type="text" class="form-control" value="GoldenHearts Donation Platform">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-md-4 col-lg-3 col-form-label">Site Language</label>
                    <div class="col-md-8 col-lg-9">
                      <select class="form-control">
                        <option>English</option>
                        <option>Spanish</option>
                        <option>Tamil</option>
                        <option>Sinhalese</option>
                      </select>
                    </div>
                  </div>

                  <h5 class="card-title mt-4">API Keys</h5>
                  <div class="row mb-3">
                    <label class="col-md-4 col-lg-3 col-form-label">Payment API</label>
                    <div class="col-md-8 col-lg-9">
                      <input type="text" class="form-control" value="GD77989HNBGV9698D.JD098KJVD">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-md-4 col-lg-3 col-form-label">Map API</label>
                    <div class="col-md-8 col-lg-9">
                      <input type="text" class="form-control" value="PD77989HNBGVLK32.JD098KJVD">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-md-4 col-lg-3 col-form-label">Notification API</label>
                    <div class="col-md-8 col-lg-9">
                      <input type="text" class="form-control" value="AA77MV84BGV9698D.JD098KJVD">
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </form>
              </div>

            </div><!-- End Tab Content -->
          </div>
        </div>

      </div>
    </div>
  </section>

</main>


</html>

<?php
include('footer.php');
?>