<?php 
include('header.php'); 
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<body>

<!-- Page Header Start -->
<div class="container-fluid page-header py-7 mb-7">
    <div class="container text-center py-5">
        <h1 class="display-4 text-white animated slideInDown">Other Category</h1>
        <p class="lead text-white-50">Elder homes with custom or unique needs categorized as “Other”.</p>
    </div>
</div>
<!-- Page Header End -->

<!-- Verified Elder Homes: Other Start -->
<div class="container-xxl bg-light my-2 py-2">
    <div class="container py-5">
        <div class="text-center mx-auto mb-5" style="max-width: 500px;">
            <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">Other</div>
            <h1 class="display-6 mb-4">Homes Listed Under “Other”</h1>
            <p class="text-muted">These verified elder homes have needs that do not fall under any predefined category.</p>
        </div>

        <div class="row g-4 justify-content-center">
        <?php
        $query = "SELECT * FROM elder_homes WHERE category = 'Other' AND status = 'accepted'";
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
            <div class="col-lg-4 col-md-6">
                <div class="causes-item d-flex flex-column bg-white border-top border-5 border-primary rounded-top overflow-hidden h-100">
                    <div class="text-center p-4 pt-0">
                        <div class="d-inline-block bg-primary text-white rounded-bottom fs-5 pb-1 px-3 mb-4">
                            <small><?= htmlspecialchars($row['category']) ?></small>
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
                <p class="text-muted">No elder homes currently listed under "Other".</p>
            </div>
        <?php endif; ?>
        </div>
    </div>
</div>
<!-- Verified Elder Homes: Other End -->

<?php include('footer.php'); ?>
</body>
</html>
