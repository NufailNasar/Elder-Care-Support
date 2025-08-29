<!DOCTYPE html>
<html lang="en">

<?php
include('header.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Contact Us</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Contact</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section contact">
    <div class="row gy-4">

      <!-- Contact Info Boxes -->
      <div class="col-xl-6">
        <div class="row gy-4">

          <div class="col-md-6">
            <div class="info-box card">
              <i class="bi bi-geo-alt"></i>
              <h3>Head Office</h3>
              <p>GoldenHearts Foundation<br>112 Kindness Lane, LA 90210</p>
            </div>
          </div>

          <div class="col-md-6">
            <div class="info-box card">
              <i class="bi bi-telephone"></i>
              <h3>Call Us</h3>
              <p>+1 (800) 555-HELP<br>+1 (800) 555-SAFE</p>
            </div>
          </div>

          <div class="col-md-6">
            <div class="info-box card">
              <i class="bi bi-envelope"></i>
              <h3>Email</h3>
              <p>support@goldenhearts.org<br>care@goldenhearts.org</p>
            </div>
          </div>

          <div class="col-md-6">
            <div class="info-box card">
              <i class="bi bi-clock"></i>
              <h3>Office Hours</h3>
              <p>Mon - Fri: 9:00 AM - 5:00 PM<br>Closed on weekends</p>
            </div>
          </div>

        </div>
      </div>

      <!-- Contact Form -->
      <div class="col-xl-6">
        <div class="card p-4">
          <h5 class="card-title text-center mb-4">Send Us a Message</h5>
          <form action="forms/contact.php" method="post" class="php-email-form">
            <div class="row gy-4">

              <div class="col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Your Full Name" required>
              </div>

              <div class="col-md-6">
                <input type="email" name="email" class="form-control" placeholder="Your Email Address" required>
              </div>

              <div class="col-md-12">
                <input type="text" name="subject" class="form-control" placeholder="Subject" required>
              </div>

              <div class="col-md-12">
                <textarea name="message" class="form-control" rows="6" placeholder="Write your message here..." required></textarea>
              </div>

              <div class="col-md-12 text-center">
                <div class="loading">Loading...</div>
                <div class="error-message"></div>
                <div class="sent-message">Thank you! Your message has been successfully sent.</div>
                <button type="submit" class="btn btn-primary">Send Message</button>
              </div>

            </div>
          </form>
        </div>
      </div>

    </div>
  </section>

</main>




</html>

<?php
include('footer.php');
?>