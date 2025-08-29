<!DOCTYPE html>
<html lang="en">

<?php
include('header.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Frequently Asked Questions</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Support</li>
        <li class="breadcrumb-item active">FAQs</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section faq">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">General Questions</h5>

            <div class="accordion accordion-flush" id="faq-general">

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq1">
                    What is GoldenHearts?
                  </button>
                </h2>
                <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faq-general">
                  <div class="accordion-body">
                    GoldenHearts is a digital platform that connects generous donors with elder care homes in need. Our mission is to improve the lives of elderly individuals by providing essential resources through transparent and traceable donations.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq2">
                    How can I donate to elder homes?
                  </button>
                </h2>
                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faq-general">
                  <div class="accordion-body">
                    You can donate using our online platform. Simply register, browse the listed needs of elder homes, and choose to donate either in-kind items or monetary contributions. We ensure your donations reach the right hands.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq3">
                    Is my donation tax-deductible?
                  </button>
                </h2>
                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faq-general">
                  <div class="accordion-body">
                    Yes, all eligible monetary donations made via GoldenHearts will receive digital receipts which may be used for tax deductions, depending on your country’s laws. We advise consulting your tax advisor for confirmation.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq4">
                    How is transparency ensured?
                  </button>
                </h2>
                <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faq-general">
                  <div class="accordion-body">
                    Every donation is logged and traceable via your donor dashboard. Additionally, we provide periodic impact reports and real-time updates from elder homes on how donations are utilized.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq5">
                    What kind of items can I donate?
                  </button>
                </h2>
                <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faq-general">
                  <div class="accordion-body">
                    You can donate essential items such as food supplies, hygiene kits, beds, wheelchairs, medicines, and more. Each elder home lists their current needs on their profile for your convenience.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq6">
                    Can I choose the elder home I want to support?
                  </button>
                </h2>
                <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faq-general">
                  <div class="accordion-body">
                    Absolutely. Donors have full control to select the elder care home they wish to support based on location, listed needs, or previous interaction.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq7">
                    How do I know my donation reached the intended recipient?
                  </button>
                </h2>
                <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faq-general">
                  <div class="accordion-body">
                    Once your donation is delivered, the elder home confirms receipt through the platform, and you receive a notification along with optional images or thank-you notes from the recipients.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq8">
                    How can I volunteer or get involved apart from donations?
                  </button>
                </h2>
                <div id="faq8" class="accordion-collapse collapse" data-bs-parent="#faq-general">
                  <div class="accordion-body">
                    We're glad you're interested! You can sign up as a volunteer through the platform to participate in elder care activities, home visits, or event coordination. We also welcome collaboration with NGOs and healthcare professionals.
                  </div>
                </div>
              </div>

            </div>

          </div>
        </div><!-- End FAQ Card -->

      </div>
    </div>
  </section>

</main>


</html>

<?php
include('footer.php');
?>