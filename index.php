<!DOCTYPE html>
<html lang="en">

<?php
session_start(); // Must be first
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo "<script>alert('Donation successful! Thank you for your support.');</script>";
}


include('header.php');
include('connection.php'); // Ensure DB connection is established
?>

<body>
    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="img/H1.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7 pt-5">
                                    <h1 class="display-4 text-white mb-3 animated slideInDown">Give Hope. Share Love. Support Our Elders</h1>
                                    <p class="fs-5 text-white-50 mb-5 animated slideInDown">A small act of kindness can brighten a lifetime</p>
                                    <a class="btn btn-primary py-2 px-3 animated slideInDown" href="">
                                        Donate Now
                                        <div class="d-inline-flex btn-sm-square bg-white text-primary rounded-circle ms-2">
                                            <i class="fa fa-arrow-right"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="img/H3.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7 pt-5">
                                    <h1 class="display-4 text-white mb-3 animated slideInDown">Let's Save More Lifes With Our Helping Hand</h1>
                                    <p class="fs-5 text-white-50 mb-5 animated slideInDown">A small act of kindness can brighten a lifetime</p>
                                    <a class="btn btn-primary py-2 px-3 animated slideInDown" href="">
                                        Donate Now
                                        <div class="d-inline-flex btn-sm-square bg-white text-primary rounded-circle ms-2">
                                            <i class="fa fa-arrow-right"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative overflow-hidden h-100" style="min-height: 400px;">
                        <img class="position-absolute w-100 h-100 pt-5 pe-5" src="img/A1.jpg" alt="" style="object-fit: cover;">
                        <img class="position-absolute top-0 end-0 bg-white ps-2 pb-2" src="img/A2.png" alt="" style="width: 200px; height: 200px;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                        <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">About Us</div>
                        <h1 class="display-6 mb-5">We Believe in the Power of Giving</h1>
                        <div class="bg-light border-bottom border-5 border-primary rounded p-4 mb-4">
                            <p class="text-dark mb-2">When technology meets compassion, giving becomes effortless. GoldenHearts isn't just a platform – it's a movement to restore dignity and support to our elders.</p>
                            <span class="text-primary">Nufail Nasar, Founder</span>
                        </div>
                        <p class="mb-5">We understand that many elder care homes struggle in silence due to limited visibility and resources. GoldenHearts was born to address this challenge. Our platform connects verified elder homes with generous donors, ensuring that every contribution – whether food, medicine, money, or time – directly meets a real need. Together, we can build a stronger, more supportive society for those who paved the way for us.</p>
                        <a class="btn btn-primary py-2 px-3 me-3" href="">
                            Donate Now
                            <div class="d-inline-flex btn-sm-square bg-white text-primary rounded-circle ms-2">
                                <i class="fa fa-arrow-right"></i>
                            </div>
                        </a>
                        <a class="btn btn-outline-primary py-2 px-3" href="contact.php">
                            Contact Us
                            <div class="d-inline-flex btn-sm-square bg-primary text-white rounded-circle ms-2">
                                <i class="fa fa-arrow-right"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


<!-- Verified Elder Homes Start -->
<div class="container-xxl bg-light my-5 py-5">
    <div class="container py-5">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">Elder Homes</div>
            <h1 class="display-6 mb-5">Verified Elder Homes</h1>
        </div>
        <div class="row g-4 justify-content-center">
            <?php
            $query = "SELECT * FROM elder_homes WHERE status='accepted' ORDER BY id DESC";
            $result = mysqli_query($link, $query);

            while($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $name = htmlspecialchars($row['name']);
                $category = htmlspecialchars($row['category']);
                $description = htmlspecialchars($row['description']);
                $goal = number_format($row['goal_amount'], 2);
                $raised = number_format($row['raised_amount'], 2);
                $image = htmlspecialchars($row['image_path']);

                $progress = $row['goal_amount'] > 0 ? round(($row['raised_amount'] / $row['goal_amount']) * 100) : 0;
                if ($progress > 100) $progress = 100;
            ?>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="causes-item d-flex flex-column bg-white border-top border-5 border-primary rounded-top overflow-hidden h-100">
                    <div class="text-center p-4 pt-0">
                        <div class="d-inline-block bg-primary text-white rounded-bottom fs-5 pb-1 px-3 mb-4">
                            <small><?= $category ?></small>
                        </div>
                        <h5 class="mb-3"><?= $name ?></h5>
                        <p><?= $description ?></p>
                        <div class="causes-progress bg-light p-3 pt-2">
                            <div class="d-flex justify-content-between">
                                <p class="text-dark">LKR <?= $goal ?> <small class="text-body">Goal</small></p>
                                <p class="text-dark">LKR <?= $raised ?> <small class="text-body">Raised</small></p>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: <?= $progress ?>%;" aria-valuenow="<?= $progress ?>" aria-valuemin="0" aria-valuemax="100">
                                    <span><?= $progress ?>%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="position-relative mt-auto">
                        <img class="img-fluid" src="<?= $image ?>" alt="<?= $name ?>">
                    <div class="causes-overlay d-flex flex-column align-items-center justify-content-center">
    <!-- Donate Now (opens modal) -->
    <a class="btn btn-outline-primary mb-2" href="#"
       data-bs-toggle="modal"
       data-bs-target="#elderHomeModal"
       data-id="<?= $id ?>"
       data-name="<?= $name ?>"
       data-description="<?= $description ?>"
       data-category="<?= $category ?>"
       data-goal="<?= $goal ?>"
       data-raised="<?= $raised ?>"
       data-image="<?= $image ?>">
        Donate Now
        <div class="d-inline-flex btn-sm-square bg-primary text-white rounded-circle ms-2">
            <i class="fa fa-arrow-right"></i>
        </div>
    </a>

    <!-- Donate Another Way (links to donate.php) -->
    <a class="btn btn-outline-primary" href="donate.php">
        Donate Another Way
        <div class="d-inline-flex btn-sm-square bg-primary text-white rounded-circle ms-2">
            <i class="fa fa-arrow-right"></i>
        </div>
    </a>
</div>

                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- Verified Elder Homes End -->

 <!-- Elder Home Modal -->
    <div class="modal fade" id="elderHomeModal" tabindex="-1" aria-labelledby="elderHomeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="elderHomeModalLabel">Elder Home Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row g-4">
                    <!-- Left Side -->
                    <div class="col-md-6">
                        <img id="modalImage" src="" alt="Elder Home Image" class="img-fluid rounded mb-3">
                        <div class="text-center">
                            <h5 class="mb-2" id="modalName"></h5>
                            <small class="badge bg-warning text-dark" id="modalCategory"></small>
                            <p class="mt-3" id="modalDescription"></p>
                        </div>
                        <div class="progress mb-2">
                            <div id="modalProgressBar" class="progress-bar bg-primary" role="progressbar" style="width: 0%">0%</div>
                        </div>
                        <p><strong>Goal:</strong> LKR <span id="modalGoal"></span></p>
                        <p><strong>Raised:</strong> LKR <span id="modalRaised"></span></p>
                    </div>

                    <div class="col-md-6">
                        <!-- Step 1: Donation Info -->
                        <div id="donation-step-1">
                            <h6>Select Donation Amount*</h6>
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <button type="button" class="btn btn-outline-dark amount-btn" data-amount="500">LKR 500.00</button>
                                <button type="button" class="btn btn-outline-dark amount-btn" data-amount="1000">LKR 1,000.00</button>
                                <button type="button" class="btn btn-outline-dark amount-btn" data-amount="5000">LKR 5,000.00</button>
                                <button type="button" class="btn btn-outline-dark amount-btn" data-amount="10000">LKR 10,000.00</button>
                                <button type="button" class="btn btn-outline-dark amount-btn" data-amount="50000">LKR 50,000.00</button>
                                <button type="button" class="btn btn-outline-dark amount-btn" data-amount="100000">LKR 100,000.00</button>
                            </div>

                            <input type="number" class="form-control mb-3" id="customAmount" placeholder="Custom Amount (LKR)">
                            <input type="text" class="form-control mb-3" placeholder="Word of Support">

                            <div class="alert alert-warning small">Disclaimer: Donations made are final and non-refundable.</div>

                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="anonymousDonate">
                                <label class="form-check-label" for="anonymousDonate">Donate Anonymously</label>
                            </div>

                            <h6 class="mt-3">Select Payment Method*</h6>
                            <div class="d-flex gap-2 mb-3">
                                <button type="button" class="btn btn-outline-dark payment-btn" data-method="card"><i class="fa fa-credit-card me-1"></i> Card</button>
                                <button type="button" class="btn btn-outline-dark payment-btn" data-method="bank"><i class="fa fa-university me-1"></i> Bank Slip</button>
                                <button type="button" class="btn btn-outline-dark payment-btn" data-method="paypal"><i class="fab fa-paypal me-1"></i> PayPal</button>
                            </div>

                            <button class="btn btn-primary w-100" id="donateNowBtn">Donate Now</button>
                        </div>

                        <!-- Step 2: Card Form -->
<div id="card-form" style="display: none;">
    <button class="btn btn-link go-back-btn mb-2">&larr; Back</button>
    <div class="card p-3 border">
        <h5 class="text-center">Pay With Card</h5>
        <p class="text-center fw-bold text-danger">Golden Hearts</p>
        <p class="text-center">LKR <span id="selectedCardAmount">0.00</span></p>
        <div class="text-center mb-3">
            <img src="img/visa.webp" style="height:30px" alt="Visa"> &nbsp;
            <img src="img/mastercard.png" style="height:30px" alt="Mastercard">
        </div>
        <form method="POST" action="process_card.php">
            <input type="hidden" name="amount" id="cardAmountInput">
            <div class="form-floating mb-2">
                <input type="text" class="form-control" name="card_name" placeholder="Cardholder Name" required>
                <label>Cardholder Name</label>
            </div>
            <div class="form-floating mb-2">
                <input type="text" class="form-control" name="card_number" placeholder="Card Number" required>
                <label>Card Number</label>
            </div>
            <div class="d-flex gap-2">
                <div class="form-floating mb-2 w-50">
                    <input type="text" class="form-control" name="expiry" placeholder="MM/YY" required>
                    <label>MM/YY</label>
                </div>
                <div class="form-floating mb-2 w-50">
                    <input type="text" class="form-control" name="cvv" placeholder="CVV" required>
                    <label>CVV</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-2">Pay</button>
        </form>
    </div>
</div>

<!-- Step 3: Bank Slip Upload -->
<div id="bank-form" style="display: none;">
    <button class="btn btn-link go-back-btn mb-2">&larr; Back</button>
    <div class="card p-3 border">
        <h5 class="text-center">Upload Bank Slip</h5>
        <form method="POST" action="process_bank.php" enctype="multipart/form-data">
            <input type="hidden" name="amount" id="bankAmountInput">
            <div class="form-floating mb-2">
                <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
                <label>First Name</label>
            </div>
            <div class="form-floating mb-2">
                <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
                <label>Last Name</label>
            </div>
            <div class="form-floating mb-2">
                <input type="tel" class="form-control" name="phone" placeholder="Mobile Number" required>
                <label>Mobile Number</label>
            </div>
            <div class="mb-2">
                <label class="form-label">Bank Slip*</label>
                <input type="file" class="form-control" name="bank_slip" accept=".jpg,.png,.pdf" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-2">Pay Now</button>
        </form>
    </div>
</div>

<!-- Step 4: PayPal -->
<div id="paypal-form" style="display: none;">
    <button class="btn btn-link go-back-btn mb-2">&larr; Back</button>
    <div class="text-center p-4 border">
        <h5>Redirecting to PayPal...</h5>
        <p>Donation Amount: LKR <span id="paypalAmount">0.00</span></p>
        <form action="process_paypal.php" method="POST">
            <input type="hidden" name="amount" id="paypalAmountInput">
            <button type="submit" class="btn btn-primary w-100 mt-3">
                Continue to PayPal
            </button>
        </form>
    </div>
</div>


                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Service Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">What We Do</div>
            <h1 class="display-6 mb-5">Explore How We Make Giving Smarter</h1>
        </div>
        <div class="row g-4 justify-content-center">
            <!-- Verified Elder Homes -->
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item bg-white text-center h-100 p-4 p-xl-5">
                    <img class="img-fluid mb-4" src="img/E1.png" alt="">
                    <h4 class="mb-3">Verified Elder Homes</h4>
                    <p class="mb-4">We verify and partner with registered elder homes across the country to showcase their real-time needs transparently.</p>
                    <a class="btn btn-outline-primary px-3" href="elderhomes.php">
                        View
                        <div class="d-inline-flex btn-sm-square bg-primary text-white rounded-circle ms-2">
                            <i class="fa fa-arrow-right"></i>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Transparent Donations -->
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item bg-white text-center h-100 p-4 p-xl-5">
                    <img class="img-fluid mb-4" src="img/E2.png" alt="">
                    <h4 class="mb-3">Transparent Donations</h4>
                    <p class="mb-4">Our platform ensures all item and money donations are tracked and visibly allocated to their intended causes.</p>
                    <a class="btn btn-outline-primary px-3" href="donate.php">
                        View
                        <div class="d-inline-flex btn-sm-square bg-primary text-white rounded-circle ms-2">
                            <i class="fa fa-arrow-right"></i>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Donor Recognition -->
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item bg-white text-center h-100 p-4 p-xl-5">
                    <img class="img-fluid mb-4" src="img/E3.avif" alt="">
                    <h4 class="mb-3">Donor Rewards</h4>
                    <p class="mb-4">We celebrate generosity! Donors earn badges and are featured on our platform for continued contributions.</p>
                    <a class="btn btn-outline-primary px-3" href="rewards.php">
                        View
                        <div class="d-inline-flex btn-sm-square bg-primary text-white rounded-circle ms-2">
                            <i class="fa fa-arrow-right"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->

<!-- Footer -->
<?php include('footer.php'); ?>

</body>
</html>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const modal = document.getElementById('elderHomeModal');

  let selectedMethod = null;
  let selectedAmount = 0;

  // Handle modal show event
  modal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;

    const elderHomeId = button.getAttribute('data-id');
fetch('store_elder_id.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: 'elder_home_id=' + encodeURIComponent(elderHomeId)
});


    const name = button.getAttribute('data-name');
    const description = button.getAttribute('data-description');
    const category = button.getAttribute('data-category');
    const goal = button.getAttribute('data-goal');
    const raised = button.getAttribute('data-raised');
    const image = button.getAttribute('data-image');

    const progress = Math.min(Math.round((parseFloat(raised.replace(/,/g, '')) / parseFloat(goal.replace(/,/g, ''))) * 100), 100);

    document.getElementById('modalName').textContent = name;
    document.getElementById('modalDescription').textContent = description;
    document.getElementById('modalCategory').textContent = category;
    document.getElementById('modalGoal').textContent = goal;
    document.getElementById('modalRaised').textContent = raised;
    document.getElementById('modalImage').src = image;
    document.getElementById('modalProgressBar').style.width = progress + '%';
    document.getElementById('modalProgressBar').textContent = progress + '%';

    // Reset form
    resetDonationForm();
  });

  // Handle amount button clicks
  document.querySelectorAll('.amount-btn').forEach(button => {
    button.addEventListener('click', function () {
      selectedAmount = this.getAttribute('data-amount');
      document.getElementById('customAmount').value = '';
      document.querySelectorAll('.amount-btn').forEach(btn => btn.classList.remove('active'));
      this.classList.add('active');
    });
  });

  // Handle custom amount input
  document.getElementById('customAmount').addEventListener('input', function () {
    selectedAmount = this.value;
    document.querySelectorAll('.amount-btn').forEach(btn => btn.classList.remove('active'));
  });

  // Handle payment method selection
  document.querySelectorAll('.payment-btn').forEach(button => {
    button.addEventListener('click', function () {
      selectedMethod = this.getAttribute('data-method');
      document.querySelectorAll('.payment-btn').forEach(btn => btn.classList.remove('active'));
      this.classList.add('active');
    });
  });

  // Handle "Donate Now" button click
  document.getElementById('donateNowBtn').addEventListener('click', function () {
    if (!selectedAmount || selectedAmount <= 0) {
      alert("Please select or enter a donation amount.");
      return;
    }

    if (!selectedMethod) {
      alert("Please select a payment method.");
      return;
    }

    document.getElementById('donation-step-1').style.display = 'none';
    document.getElementById('card-form').style.display = selectedMethod === 'card' ? 'block' : 'none';
    document.getElementById('bank-form').style.display = selectedMethod === 'bank' ? 'block' : 'none';
    document.getElementById('paypal-form').style.display = selectedMethod === 'paypal' ? 'block' : 'none';
  });

  // Handle "Back" buttons
  document.querySelectorAll('.go-back-btn').forEach(btn => {
    btn.addEventListener('click', goBackToStep1);
  });

  function goBackToStep1() {
    document.getElementById('donation-step-1').style.display = 'block';
    document.getElementById('card-form').style.display = 'none';
    document.getElementById('bank-form').style.display = 'none';
    document.getElementById('paypal-form').style.display = 'none';

    selectedMethod = null;
    document.querySelectorAll('.payment-btn').forEach(btn => btn.classList.remove('active'));
  }

  function resetDonationForm() {
    selectedMethod = null;
    selectedAmount = 0;

    document.getElementById('customAmount').value = '';
    document.querySelectorAll('.amount-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelectorAll('.payment-btn').forEach(btn => btn.classList.remove('active'));

    document.getElementById('donation-step-1').style.display = 'block';
    document.getElementById('card-form').style.display = 'none';
    document.getElementById('bank-form').style.display = 'none';
    document.getElementById('paypal-form').style.display = 'none';
  }
});

// Inside donateNowBtn click handler
document.getElementById('selectedCardAmount').textContent = parseFloat(selectedAmount).toLocaleString('en-LK', { minimumFractionDigits: 2 });
document.getElementById('paypalAmount').textContent = parseFloat(selectedAmount).toLocaleString('en-LK', { minimumFractionDigits: 2 });

document.getElementById('cardAmountInput').value = selectedAmount;
document.getElementById('paypalAmountInput').value = selectedAmount;
document.getElementById('bankAmountInput').value = selectedAmount;


// Add AJAX call to store selected elder_home_id
fetch('store_elder_id.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: 'elder_home_id=' + encodeURIComponent(button.getAttribute('data-id'))
});

</script>
