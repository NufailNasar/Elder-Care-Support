<!DOCTYPE html>
<html lang="en">

<?php
include('header.php');
include('connection.php'); // Ensure DB connection is established
?>

<body>
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center">
            <h1 class="display-4 text-white animated slideInDown mb-4">Elder Homes</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Elder Homes</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

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

                        <!-- Card Payment -->
                        <div id="card-form" style="display:none;">
                            <h5><i class="fa fa-credit-card me-2"></i> Pay with Card</h5>
                            <input type="text" class="form-control mb-2" placeholder="Name on Card">
                            <input type="text" class="form-control mb-2" placeholder="Card Number">
                            <div class="row g-2 mb-3">
                                <div class="col"><input type="text" class="form-control" placeholder="MM/YY"></div>
                                <div class="col"><input type="text" class="form-control" placeholder="CVV"></div>
                            </div>
                            <button class="btn btn-success w-100 mb-2">Pay Now</button>
                            <button class="btn btn-link w-100 go-back-btn">← Back</button>
                        </div>

                        <!-- Bank Slip -->
                        <div id="bank-form" style="display:none;">
                            <h5><i class="fa fa-university me-2"></i> Upload Bank Slip</h5>
                            <input type="text" class="form-control mb-2" placeholder="Full Name">
                            <input type="text" class="form-control mb-2" placeholder="Mobile Number">
                            <input type="file" class="form-control mb-3">
                            <button class="btn btn-success w-100 mb-2">Submit</button>
                            <button class="btn btn-link w-100 go-back-btn">← Back</button>
                        </div>

                        <!-- PayPal -->
                        <div id="paypal-form" style="display:none;">
                            <h5><i class="fab fa-paypal me-2"></i> Pay with PayPal</h5>
                            <input type="email" class="form-control mb-3" placeholder="PayPal Email">
                            <button class="btn btn-success w-100 mb-2">Proceed to PayPal</button>
                            <button class="btn btn-link w-100 go-back-btn">← Back</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Elder Home Modal End -->

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
</script>
