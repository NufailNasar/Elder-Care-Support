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
            <h1 class="display-4 text-white animated slideInDown mb-4">Make a Donation</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item text-primary active" aria-current="page">Support a verified elder home today</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="container py-5">
        <form action="process_donation.php" method="POST">
            <div class="row g-4">
                <div class="col-md-6">
                    <label for="donationType" class="form-label">Donation Type</label>
                    <select name="donation_type" id="donationType" class="form-select" required>
                        <option value="">Select Type</option>
                        <option value="money">Money</option>
                        <option value="item">Item</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="elderHome" class="form-label">Elder Home</label>
                    <select name="elder_home" id="elderHome" class="form-select" required>
                        <option value="">Choose a Home</option>
                        <?php
                        $homes = mysqli_query($link, "SELECT id, name FROM elder_homes WHERE status = 'accepted'");
                        while ($home = mysqli_fetch_assoc($homes)) {
                            echo '<option value="' . $home['id'] . '">' . htmlspecialchars($home['name']) . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-6" id="moneyField">
                    <label for="amount" class="form-label">Amount (LKR)</label>
                    <input type="number" name="amount" id="amount" class="form-control" min="100" placeholder="Enter amount">
                </div>

                <div class="col-md-6" id="itemField" style="display: none;">
                    <label for="item" class="form-label">Item Details</label>
                    <input type="text" name="item_detail" id="item" class="form-control" placeholder="E.g. 10 packs of rice">
                </div>

                <div class="col-12">
                    <label for="donorName" class="form-label">Your Name</label>
                    <input type="text" name="donor_name" id="donorName" class="form-control" required>
                </div>

                <div class="col-12">
                    <label for="donorEmail" class="form-label">Your Email</label>
                    <input type="email" name="donor_email" id="donorEmail" class="form-control" required>
                </div>

                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary px-5 py-2">Donate Now</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.getElementById("donationType").addEventListener("change", function () {
            const type = this.value;
            document.getElementById("moneyField").style.display = type === "money" ? "block" : "none";
            document.getElementById("itemField").style.display = type === "item" ? "block" : "none";
        });
    </script>
</body>

</html>

<?php include('footer.php'); ?>
