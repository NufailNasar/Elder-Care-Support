<!DOCTYPE html>
<html lang="en">

<?php
include('header.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>FAQs for Elder Homes</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Support</li>
        <li class="breadcrumb-item active">Elder Home FAQs</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section faq">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Common Questions from Elder Homes</h5>

            <div class="accordion accordion-flush" id="faq-elderhome">

              <!-- Q1 -->
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#eh-faq1">
                    How can I update my Elder Home profile?
                  </button>
                </h2>
                <div id="eh-faq1" class="accordion-collapse collapse" data-bs-parent="#faq-elderhome">
                  <div class="accordion-body">
                    Navigate to your profile page after logging in. Click the "Edit Profile" tab to change your home’s name, contact info, description, and upload new images or update location details.
                  </div>
                </div>
              </div>

              <!-- Q2 -->
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#eh-faq2">
                    How do I add a new donation need?
                  </button>
                </h2>
                <div id="eh-faq2" class="accordion-collapse collapse" data-bs-parent="#faq-elderhome">
                  <div class="accordion-body">
                    Go to the “Needs Management” section in your dashboard. Click "Add New Need" and fill in the item/service name, quantity, urgency level, and deadline. Once submitted, it's visible to all potential donors.
                  </div>
                </div>
              </div>

              <!-- Q3 -->
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#eh-faq3">
                    How will I know when a donation is made?
                  </button>
                </h2>
                <div id="eh-faq3" class="accordion-collapse collapse" data-bs-parent="#faq-elderhome">
                  <div class="accordion-body">
                    You will receive a real-time notification via email and your platform inbox when a donor commits to or fulfills a need. A summary is also visible in your "Donation History" section.
                  </div>
                </div>
              </div>

              <!-- Q4 -->
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#eh-faq4">
                    Can I edit or mark a donation need as fulfilled?
                  </button>
                </h2>
                <div id="eh-faq4" class="accordion-collapse collapse" data-bs-parent="#faq-elderhome">
                  <div class="accordion-body">
                    Yes. In the “Needs Management” panel, click on the relevant need and update its status (In Progress, Fulfilled, or Cancelled). You can also edit partial quantities received if applicable.
                  </div>
                </div>
              </div>

              <!-- Q5 -->
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#eh-faq5">
                    How do I respond to a donor or send a thank you?
                  </button>
                </h2>
                <div id="eh-faq5" class="accordion-collapse collapse" data-bs-parent="#faq-elderhome">
                  <div class="accordion-body">
                    Once a donation is marked as received, you can send a thank-you message or upload images via the “Donation History” entry. Donors appreciate updates and testimonials from the homes they support.
                  </div>
                </div>
              </div>

              <!-- Q6 -->
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#eh-faq6">
                    I need urgent help — how do I escalate?
                  </button>
                </h2>
                <div id="eh-faq6" class="accordion-collapse collapse" data-bs-parent="#faq-elderhome">
                  <div class="accordion-body">
                    You can flag a donation request as "Urgent" when submitting a need. For administrative or emergency support, use the "Contact Support" form, or email <strong>support@goldenhearts.org</strong> directly.
                  </div>
                </div>
              </div>

              <!-- Q7 -->
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#eh-faq7">
                    What reports can I download?
                  </button>
                </h2>
                <div id="eh-faq7" class="accordion-collapse collapse" data-bs-parent="#faq-elderhome">
                  <div class="accordion-body">
                    You can export donation history and needs fulfillment logs as PDF or Excel files from your dashboard. Filters are available by donor, date, or donation type.
                  </div>
                </div>
              </div>

              <!-- Q8 -->
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#eh-faq8">
                    How do I manage my login credentials?
                  </button>
                </h2>
                <div id="eh-faq8" class="accordion-collapse collapse" data-bs-parent="#faq-elderhome">
                  <div class="accordion-body">
                    Go to your “Profile Settings” and select the “Change Password” tab. Make sure your new password meets security requirements. For email updates, contact platform support directly.
                  </div>
                </div>
              </div>

            </div><!-- End Accordion -->

          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->



</html>

<?php
include('footer.php');
?>