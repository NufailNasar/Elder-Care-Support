<!DOCTYPE html>
<html lang="en">
<?php
include('header.php');
include('connection.php');
?>
<body>

<!-- Page Header Start -->
<div class="container-fluid page-header py-7 mb-7">
    <div class="container text-center py-5">
        <h1 class="display-4 text-white animated slideInDown">Daily Meals & Nutrition</h1>
        <p class="lead text-white-50">Nourishing elders with balanced and wholesome meals</p>
    </div>
</div>
<!-- Page Header End -->

<!-- Verified Elder Homes: Nutrition Support Start -->
<div class="container-xxl bg-light my-2 py-2">
    <div class="container py-5">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">Nutrition Support</div>
            <h1 class="display-6 mb-4">Elder Homes Needing Food & Meal Support</h1>
            <p class="text-muted">Support verified elder homes in need of meals for their residents. Your donation provides dignity, health, and hope through food.</p>
        </div>
        <div class="row g-4 justify-content-center">

        <?php
        $query = "SELECT * FROM elder_homes WHERE category = 'Daily Meals & Nutrition' AND status = 'accepted'";
        $result = mysqli_query($link, $query);

        if (mysqli_num_rows($result) > 0):
            while ($row = mysqli_fetch_assoc($result)):
                $name = htmlspecialchars($row['name']);
                $description = htmlspecialchars($row['description']);
                $goal = number_format($row['goal_amount'], 2);
                $raised = number_format($row['raised_amount'], 2);
                $progress = ($row['goal_amount'] > 0) ? round(($row['raised_amount'] / $row['goal_amount']) * 100) : 0;
                if ($progress > 100) $progress = 100;
                $image = $row['image_path'];
                $id = $row['id'];
        ?>

        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
            <div class="causes-item d-flex flex-column bg-white border-top border-5 border-primary rounded-top overflow-hidden h-100">
                <div class="text-center p-4 pt-0">
                    <div class="d-inline-block bg-primary text-white rounded-bottom fs-5 pb-1 px-3 mb-4">
                        <small><?= $row['category'] ?></small>
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
                    <div class="causes-overlay">
                        <a class="btn btn-outline-primary" href="home.php?id=<?= $id ?>">
                            Read More
                            <div class="d-inline-flex btn-sm-square bg-primary text-white rounded-circle ms-2">
                                <i class="fa fa-arrow-right"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <?php endwhile; else: ?>
            <div class="col-12 text-center">
                <p class="text-muted">No elder homes found under "Daily Meals & Nutrition" at the moment.</p>
            </div>
        <?php endif; ?>

        </div>
    </div>
</div>
<!-- Verified Elder Homes: Nutrition Support End -->


<!-- Service Detail Section Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <!-- Image -->
            <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                <img src="img/N1.png" alt="Daily Meals and Nutrition for Elders" class="img-fluid rounded shadow">
            </div>

            <!-- Text Content -->
            <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">Service Focus</div>
                <h2 class="display-6 mb-4">Daily Meals & Nutrition</h2>
                <p class="mb-4">
                    We provide three balanced meals every day to ensure elders receive the essential nutrients for maintaining energy, strength, and immunity. 
                    These meals are tailored to meet dietary needs and cultural preferences.
                </p>
                <ul class="list-unstyled mb-4">
                    <li><i class="fa fa-check text-primary me-2"></i> Freshly prepared and hygienically served meals</li>
                    <li><i class="fa fa-check text-primary me-2"></i> Special diets for diabetic and heart patients</li>
                    <li><i class="fa fa-check text-primary me-2"></i> Nutritional assessments and support</li>
                </ul>
                <a href="donate.php" class="btn btn-primary px-4 py-2">
                    Support This Cause
                    <div class="d-inline-flex btn-sm-square bg-white text-primary rounded-circle ms-2">
                        <i class="fa fa-arrow-right"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Service Detail Section End -->

</body>
</html>

<?php include('footer.php'); ?>
