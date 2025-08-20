<!DOCTYPE html>
<html lang="en">
<?php
include('header.php');
include('connection.php');
?>

<body>
<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-4 text-white animated slideInDown mb-4">Donors</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Donors</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- Donors Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">Donor Reviews</div>
            <h1 class="display-6 mb-3">Trusted By Thousands Of People And Nonprofits</h1>
            <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#reviewModal">Give a Review</button>
        </div>

        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
            <?php
            $reviews = mysqli_query($link, "SELECT * FROM donor_reviews ORDER BY created_at DESC");
            while ($row = mysqli_fetch_assoc($reviews)) {
                $image = !empty($row['image']) ? 'uploads/' . $row['image'] : 'img/default.png';
                ?>
                <div class="testimonial-item text-center">
                    <img class="img-fluid bg-light rounded-circle p-2 mx-auto mb-4" src="<?= $image ?>" style="width: 100px; height: 100px;">
                    <div class="testimonial-text rounded text-center p-4">
                        <p>“<?= htmlspecialchars($row['message']) ?>”</p>
                        <h5 class="mb-1"><?= htmlspecialchars($row['name']) ?></h5>
                        <span class="fst-italic"><?= htmlspecialchars($row['city']) ?> | LKR <?= number_format($row['amount_donated'], 2) ?> Donated</span>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- Donors End -->

<!-- Review Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="reviewForm" class="modal-content" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="reviewModalLabel">Submit Your Review</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="name" class="form-label">Full Name</label>
          <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="city" class="form-label">City</label>
          <input type="text" name="city" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="amount" class="form-label">Amount Donated (LKR)</label>
          <input type="number" step="0.01" name="amount" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="message" class="form-label">Your Review</label>
          <textarea name="message" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
          <label for="image" class="form-label">Your Photo (optional)</label>
          <input type="file" name="image" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit Review</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('reviewForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const formData = new FormData(this);

  fetch('submit_review.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.text())
  .then(response => {
    Swal.fire('Thank you!', 'Your review has been submitted.', 'success').then(() => {
      location.reload();
    });
  })
  .catch(() => {
    Swal.fire('Oops!', 'Something went wrong. Please try again.', 'error');
  });
});
</script>
</body>
</html>

<?php include('footer.php'); ?>
