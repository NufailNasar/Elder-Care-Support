<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get the current file name (e.g., 'about.php')
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<head>
    <meta charset="utf-8">
    <title>Golden Hearts</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Saira:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Bootstrap & Template Stylesheets -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="top-bar text-white-50 row gx-0 align-items-center d-none d-lg-flex">
            <div class="col-lg-6 px-5 text-start">
                <small><i class="fa fa-map-marker-alt me-2"></i>31, Gelioya Watha Gelioya, Kandy, Sri Lanka</small>
                <small class="ms-4"><i class="fa fa-envelope me-2"></i>goldenhearts@gmail.com</small>
            </div>
            <div class="col-lg-6 px-5 text-end">
                <small>Follow us:</small>
                <a class="text-white-50 ms-3" href="#"><i class="fab fa-facebook-f"></i></a>
                <a class="text-white-50 ms-3" href="#"><i class="fab fa-twitter"></i></a>
                <a class="text-white-50 ms-3" href="#"><i class="fab fa-linkedin-in"></i></a>
                <a class="text-white-50 ms-3" href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-dark py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
            <a href="index.php" class="navbar-brand ms-4 ms-lg-0">
                <h1 class="fw-bold text-primary m-0">Golden<span class="text-white">Hearts</span></h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="index.php" class="nav-item nav-link <?= $currentPage == 'index.php' ? 'active' : '' ?>">Home</a>
                    <a href="about.php" class="nav-item nav-link <?= $currentPage == 'about.php' ? 'active' : '' ?>">About</a>
                    <a href="elderhome.php" class="nav-item nav-link <?= $currentPage == 'elderhome.php' ? 'active' : '' ?>">Elder Homes</a>
                    <a href="service.php" class="nav-item nav-link <?= $currentPage == 'service.php' ? 'active' : '' ?>">Service</a>
                    <a href="reward.php" class="nav-item nav-link <?= $currentPage == 'reward.php' ? 'active' : '' ?>">Reward</a>
                    <a href="testimonial.php" class="nav-item nav-link <?= $currentPage == 'testimonial.php' ? 'active' : '' ?>">Donors</a>
                    <a href="contact.php" class="nav-item nav-link <?= $currentPage == 'contact.php' ? 'active' : '' ?>">Contact</a>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle <?= in_array($currentPage, ['donate.php', 'team.php', '404.php']) ? 'active' : '' ?>" data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu m-0">
                            <a href="donate.php" class="dropdown-item <?= $currentPage == 'donate.php' ? 'active' : '' ?>">Donate</a>
                            <a href="team.php" class="dropdown-item <?= $currentPage == 'team.php' ? 'active' : '' ?>">Our Team</a>
                            <a href="404.php" class="dropdown-item <?= $currentPage == '404.php' ? 'active' : '' ?>">404 Page</a>
                        </div>
                    </div>

                    <!-- User Auth Section -->
                    <?php if (isset($_SESSION['username'])): ?>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle fa-lg text-white me-2"></i>
                                <span><?= htmlspecialchars($_SESSION['username']) ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end m-0">
                                <a href="profile.php" class="dropdown-item <?= $currentPage == 'profile.php' ? 'active' : '' ?>">My Profile</a>
                                <a href="signin.php" class="dropdown-item">Logout</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="signin.php" class="nav-item nav-link <?= $currentPage == 'signin.php' ? 'active' : '' ?>">Signin</a>
                        <a href="signup.php" class="nav-item nav-link <?= $currentPage == 'signup.php' ? 'active' : '' ?>">Signup</a>
                    <?php endif; ?>
                </div>

                <div class="d-none d-lg-flex ms-2">
                    <a class="btn btn-outline-primary py-2 px-3" href="donate.php">
                        Donate Now
                        <div class="d-inline-flex btn-sm-square bg-white text-primary rounded-circle ms-2">
                            <i class="fa fa-arrow-right"></i>
                        </div>
                    </a>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->
