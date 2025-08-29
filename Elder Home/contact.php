<!DOCTYPE html>
<html lang="en">

<?php
include('header.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Contact Support</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Pages</li>
        <li class="breadcrumb-item active">Contact Admin</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section contact">
    <div class="row gy-4">

      <!-- Elder Home Contact Details -->
      <div class="col-xl-6">
        <div class="row gy-4">

          <div class="col-md-6">
            <div class="info-box card">
              <i class="bi bi-building"></i>
              <h3>Your Elder Home</h3>
              <p>Tranquil Meadows<br>45 Serenity Street, Springfield</p>
            </div>
          </div>

          <div class="col-md-6">
            <div class="info-box card">
              <i class="bi bi-person-lines-fill"></i>
              <h3>Contact Person</h3>
              <p>Linda Foster<br>linda@tranquil.org</p>
            </div>
          </div>

          <div class="col-md-6">
            <div class="info-box card">
              <i class="bi bi-telephone"></i>
              <h3>Phone</h3>
              <p>+1 (555) 345-6789</p>
            </div>
          </div>

          <div class="col-md-6">
            <div class="info-box card">
              <i class="bi bi-clock-history"></i>
              <h3>Support Hours</h3>
              <p>Mon - Fri: 9:00 AM – 6:00 PM</p>
            </div>
          </div>

        </div>
      </div>

      <!-- Contact Admin Form -->
      <div class="col-xl-6">
        <div class="card p-4">
          <h5 class="card-title text-center mb-4">Need Help? Contact Admin</h5>
          <form action="forms/elderhome-contact.php" method="post" class="php-email-form">
            <div class="row gy-4">

              <div class="col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Your Name" required>
              </div>

              <div class="col-md-6">
                <input type="email" name="email" class="form-control" placeholder="Your Email" required>
              </div>

              <div class="col-md-12">
                <input type="text" name="subject" class="form-control" placeholder="Subject (e.g. Donation Update, Technical Issue)" required>
              </div>

              <div class="col-md-12">
                <textarea name="message" class="form-control" rows="6" placeholder="Describe your concern or request here..." required></textarea>
              </div>

              <div class="col-md-12 text-center">
                <div class="loading">Loading...</div>
                <div class="error-message"></div>
                <div class="sent-message">Thank you! Your message has been sent to the GoldenHearts Admin Team.</div>
                <button type="submit" class="btn btn-primary">Send to Admin</button>
              </div>

            </div>
          </form>
        </div>
      </div>

    </div>
  </section>

</main><!-- End #main -->




</html>

<?php
include('footer.php');
?>