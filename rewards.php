<!DOCTYPE html>
<html lang="en">

<?php include('header.php'); ?>

<body>

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container text-center py-5">
            <h1 class="display-4 text-white animated slideInDown">Donor Rewards</h1>
            <p class="lead text-white-50">Recognizing the kindness and commitment of our generous donors.</p>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Event Highlight Start -->
    <div class="container">
        <div class="alert alert-warning text-center mb-5 rounded-4 shadow-sm px-4 py-3" role="alert">
            🎉 <strong>Next Donor Appreciation Event:</strong> 
            <span class="text-dark">Coming up on <u>Next Month 25th</u></span>!<br>
            🌟 We will be honoring our <strong>Top 10 Donors</strong> with special recognition and appreciation.<br>
            ❤️ Keep supporting and secure your place among our heroes of compassion!
        </div>
    </div>
    <!-- Event Highlight End -->

    <!-- Rewards Section Start -->
    <div class="container py-5">
        <div class="text-center mb-5">
            <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">Recognition</div>
            <h2 class="mb-3">Reward Tiers</h2>
            <p class="text-muted">Earn badges and recognition as you support elder care homes with your generosity.</p>
        </div>

        <div class="row g-4 justify-content-center">
            <?php
            $rewards = [
                ['img' => 'R1.png', 'title' => 'New Donor', 'desc' => 'Awarded after your first donation', 'class' => 'text-gold'],
                ['img' => 'R2.png', 'title' => 'Bronze Donor', 'desc' => 'Contribute LKR 5,000 or more', 'class' => 'text-gold'],
                ['img' => 'R3.png', 'title' => 'Silver Donor', 'desc' => 'Contribute LKR 15,000 or more', 'class' => 'text-gold'],
                ['img' => 'R4.png', 'title' => 'Gold Donor', 'desc' => 'Contribute LKR 30,000 or more', 'class' => 'text-gold'],
                ['img' => 'R5.png', 'title' => 'Lifetime Contributor', 'desc' => 'Total lifetime donations exceed LKR 100,000', 'class' => 'text-gold']
            ];

            foreach ($rewards as $reward) {
                echo '
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="card shadow-sm border-0 h-100 p-4 text-center hover-shadow transition">
                        <img src="img/' . htmlspecialchars($reward['img']) . '" class="img-fluid mb-3" alt="' . htmlspecialchars($reward['title']) . '">
                        <h6 class="fw-semibold ' . htmlspecialchars($reward['class']) . '">' . htmlspecialchars($reward['title']) . '</h6>
                        <p class="small text-muted mb-0">' . htmlspecialchars($reward['desc']) . '</p>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>
    <!-- Rewards Section End -->

</body>

<?php include('footer.php'); ?>
</html>
