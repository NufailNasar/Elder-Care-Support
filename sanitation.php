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
        <h1 class="display-4 text-white animated slideInDown">Clean Water & Sanitation</h1>
        <p class="lead text-white-50">Access to safe drinking water and hygienic facilities</p>
    </div>
</div>
<!-- Page Header End -->

<!-- Verified Elder Homes: Clean Water & Sanitation Start -->
<div class="container-xxl bg-light my-2 py-2">
    <div class="container py-5">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">Elder Homes</div>
            <h1 class="display-6 mb-4">Homes Needing Clean Water & Sanitation</h1>
            <p class="text-muted">Support verified elder homes in ensuring access to safe drinking water, hygiene, and proper sanitation facilities.</p>
        </div>
        <div class="row g-4 justify-content-center">

        <?php
        $query = "SELECT * FROM elder_homes WHERE category = 'Clean Water & Sanitation' AND status = 'accepted'";
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
                <p class="text-muted">No elder homes currently listed under "Clean Water & Sanitation".</p>
            </div>
        <?php endif; ?>

        </div>
    </div>
</div>
<!-- Verified Elder Homes: Clean Water & Sanitation End -->

<!-- Service Detail Section Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <!-- Image Section -->
            <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                <img src="img/N5.png" alt="Clean Water & Sanitation" class="img-fluid rounded shadow">
            </div>

            <!-- Content Section -->
            <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">Hygiene & Safety</div>
                <h2 class="display-6 mb-4">Clean Water & Sanitation</h2>
                <p class="mb-4">
                    We prioritize the health and hygiene of our elders by ensuring access to clean drinking water, proper sanitation facilities, and regular maintenance. These efforts significantly reduce the risk of infections and enhance quality of life.
                </p>
                <ul class="list-unstyled mb-4">
                    <li><i class="fa fa-check text-primary me-2"></i> Filtered water systems for daily use</li>
                    <li><i class="fa fa-check text-primary me-2"></i> Routine cleaning and waste disposal</li>
                    <li><i class="fa fa-check text-primary me-2"></i> Installation of accessible and safe washrooms</li>
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
