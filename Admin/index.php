<?php
session_start();
include('../connection.php');

// Handle Accept/Reject submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action'], $_POST['id'])) {
    $id = intval($_POST['id']);
    $action = $_POST['action'] === 'accept' ? 'accepted' : 'declined';
    mysqli_query($link, "UPDATE elder_homes SET status='$action' WHERE id=$id");

    $_SESSION['sweet_alert'] = [
        'title' => $action === 'accepted' ? 'Success!' : 'Declined!',
        'text' => $action === 'accepted' ? 'Elder Home Accepted Successfully.' : 'Elder Home Rejected Successfully.',
        'icon' => $action === 'accepted' ? 'success' : 'warning'
    ];

    header("Location: index.php");
    exit;
}

// Fetch elder home records
$allHomes = mysqli_query($link, "SELECT * FROM elder_homes ORDER BY id DESC");

// Get the count of Total Donors
$totalDonors = mysqli_query($link, "SELECT COUNT(*) as total FROM users WHERE role = 'donor'");
$totalDonorsData = mysqli_fetch_assoc($totalDonors);
$totalDonorsCount = $totalDonorsData['total'] ?? 0;

// Get the count of Verified Elder Homes
$verifiedHomes = mysqli_query($link, "SELECT COUNT(*) as total FROM elder_homes WHERE status = 'accepted'");
$verifiedHomesData = mysqli_fetch_assoc($verifiedHomes);
$verifiedHomesCount = $verifiedHomesData['total'] ?? 0;

// Get the count of Ongoing Campaigns
$ongoingCampaigns = mysqli_query($link, "SELECT COUNT(*) as total FROM elder_homes WHERE status = 'accepted'");
$ongoingCampaignsData = mysqli_fetch_assoc($ongoingCampaigns);
$ongoingCampaignsCount = $ongoingCampaignsData['total'] ?? 0;

// Get the Total Donations Amount
$totalDonations = mysqli_query($link, "SELECT SUM(amount) as total FROM donations WHERE status = 'approved'");
$totalDonationsData = mysqli_fetch_assoc($totalDonations);
$totalDonationsAmount = number_format($totalDonationsData['total'] ?? 0, 2);

// Fetch top donors (sorted by donation count)
$topDonors = mysqli_query($link, "
  SELECT donor_name, donor_email,
         COUNT(*) AS donation_count, 
         SUM(CASE WHEN donation_type = 'money' THEN amount ELSE 0 END) AS total_amount
  FROM donations
  WHERE status = 'approved'
  GROUP BY donor_email
  ORDER BY donation_count DESC
");

// Fetch donations data for each month
$donationQuery = "
  SELECT 
    MONTH(created_at) AS month,
    SUM(amount) AS total_donated
  FROM donations
  WHERE status = 'approved'
  GROUP BY MONTH(created_at)
  ORDER BY MONTH(created_at)
";

$donationResults = mysqli_query($link, $donationQuery);
$monthlyDonations = [];
$months = [];

while ($row = mysqli_fetch_assoc($donationResults)) {
    $months[] = date('M', mktime(0, 0, 0, $row['month'], 10)); // Get month name
    $monthlyDonations[] = (float)$row['total_donated']; // Get total donation for the month
}

?>


<!DOCTYPE html>
<html lang="en">

<?php
include('header.php');
?>

<body>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Main Metrics Cards -->
      <div class="col-lg-12">
        <div class="row">

           <!-- Total Donors -->
          <div class="col-xxl-3 col-md-6">
            <div class="card info-card">
              <div class="card-body">
                <h5 class="card-title">Total Donors</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary text-white">
                    <i class="bi bi-person-heart"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?= $totalDonorsCount ?></h6>
                    <span class="text-success small fw-bold">+12%</span>
                    <span class="text-muted small ps-1">since last month</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Verified Elder Homes -->
          <div class="col-xxl-3 col-md-6">
            <div class="card info-card">
              <div class="card-body">
                <h5 class="card-title">Verified Elder Homes</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-secondary text-white">
                    <i class="bi bi-house-check-fill"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?= $verifiedHomesCount ?></h6>
                    <span class="text-success small fw-bold">+8%</span>
                    <span class="text-muted small ps-1">growth</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Ongoing Campaigns -->
          <div class="col-xxl-3 col-md-6">
            <div class="card info-card">
              <div class="card-body">
                <h5 class="card-title">Ongoing Campaigns</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-warning text-white">
                    <i class="bi bi-bullseye"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?= $ongoingCampaignsCount ?></h6>
                    <span class="text-danger small fw-bold">-5%</span>
                    <span class="text-muted small ps-1">drop</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Donations Collected -->
          <div class="col-xxl-3 col-md-6">
            <div class="card info-card">
              <div class="card-body">
                <h5 class="card-title">Total Donations</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success text-white">
                    <i class="bi bi-cash-coin"></i>
                  </div>
                  <div class="ps-3">
                    <h6>LKR <?= $totalDonationsAmount ?></h6>
                    <span class="text-success small fw-bold">+18%</span>
                    <span class="text-muted small ps-1">this quarter</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- Top Donors -->
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Top Donors</h5>
            <table class="table table-striped text-center display" id="topDonorsTable">
              <thead class="table-dark">
                <tr>
                  <th>Rank</th>
                  <th>Donor Name</th>
                  <th>Email</th>
                  <th>Donations</th>
                  <th>Total Donated</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                while ($donor = mysqli_fetch_assoc($topDonors)) {
                  $icon = $i == 1 ? '🥇' : ($i == 2 ? '🥈' : ($i == 3 ? '🥉' : $i));
                ?>
                <tr>
                  <td><?= $icon ?></td>
                  <td><?= htmlspecialchars($donor['donor_name']) ?></td>
                  <td><?= htmlspecialchars($donor['donor_email']) ?></td>
                  <td><?= $donor['donation_count'] ?></td>
                  <td>LKR <?= number_format($donor['total_amount'], 2) ?></td>
                </tr>
                <?php $i++; } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

<!-- Elder Home Submissions Review Section -->
<div class="col-12">
    <?php if (mysqli_num_rows($allHomes) == 0): ?>
        <p class="text-center text-muted">No elder homes found.</p>
    <?php else: ?>
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">Elder Home Submissions</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Home Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($allHomes)): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['name']) ?></td>
                                    <td><?= htmlspecialchars($row['description']) ?></td>
                                    <td>
                                        <?php
                                            $status = $row['status'];
                                            $badgeClass = match($status) {
                                                'accepted' => 'success',
                                                'declined' => 'danger',
                                                default => 'warning'
                                            };
                                        ?>
                                        <span class="badge bg-<?= $badgeClass ?> text-uppercase"><?= $status ?></span>
                                    </td>
                                    <td>
                                        <?php if ($status === 'pending'): ?>
                                            <form method="POST" class="d-inline">
                                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                <button name="action" value="accept" class="btn btn-sm btn-success me-2">Accept</button>
                                                <button name="action" value="decline" class="btn btn-sm btn-danger">Reject</button>
                                            </form>
                                        <?php else: ?>
                                            <p class="text-muted small fst-italic">No further actions available.</p>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Donation Needs Table -->
<div class="col-12">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Donation Needs</h5>
      <table class="table table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th scope="col">Elder Home Name</th>
            <th scope="col">Item Needed</th>
            <th scope="col">Contact Person</th>
            <th scope="col">Needed Quantity</th>
            <th scope="col">Status</th>
            <th scope="col">Timeline</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Sunset Haven</td>
            <td>Monetary Donations</td>
            <td>John Smith</td>
            <td>LKR 50,000 – LKR 100,000</td>
            <td><span class="badge bg-success">Fulfilled</span></td>
            <td>February</td>
          </tr>
          <tr>
            <td>Golden Years Home</td>
            <td>Medical Supplies</td>
            <td>Mary Claude</td>
            <td>25/50 Boxes</td>
            <td><span class="badge bg-danger">Pending</span></td>
            <td>January</td>
          </tr>
          <tr>
            <td>Silver Living Residence</td>
            <td>Non-Perishable Food</td>
            <td>Robert Crane</td>
            <td>8/12 Packs</td>
            <td><span class="badge bg-success">Fulfilled</span></td>
            <td>May</td>
          </tr>
          <tr>
            <td>Tranquil Meadows</td>
            <td>Clothing Donations</td>
            <td>Linda Foster</td>
            <td>LKR 10,000 / LKR 15,000</td>
            <td><span class="badge bg-warning">Partial</span></td>
            <td>April</td>
          </tr>
          <tr>
            <td>Peaceful Haven</td>
            <td>Blankets & Bedsheets</td>
            <td>William Owen</td>
            <td>24 / 50 Kits</td>
            <td><span class="badge bg-success">Fulfilled</span></td>
            <td>March</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>


<div class="col-lg-6">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Donation Trends</h5>

      <!-- Area Chart -->
      <div id="donationAreaChart"></div>

      <script>
        document.addEventListener("DOMContentLoaded", () => {
          new ApexCharts(document.querySelector("#donationAreaChart"), {
            series: [{
              name: "Donations",
              data: <?php echo json_encode($monthlyDonations); ?>  // Pass the dynamic data
            }],
            chart: {
              type: 'area',
              height: 350,
              zoom: { enabled: false }
            },
            dataLabels: { enabled: false },
            stroke: {
              curve: 'smooth',
              width: 2
            },
            title: {
              text: 'Monthly Donation Progress',
              align: 'left'
            },
            xaxis: {
              categories: <?php echo json_encode($months); ?>,  // Pass the dynamic months
              title: { text: 'Month' }
            },
            yaxis: {
              title: { text: 'LKR' }
            },
            tooltip: {
              y: {
                formatter: function (val) {
                  return "LKR " + val.toLocaleString();
                }
              }
            },
            colors: ['#2eca6a']
          }).render();
        });
      </script>
      <!-- End Area Chart -->

    </div>
  </div>
</div>



<div class="col-lg-6">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Sessions by Device</h5>

      <!-- Pie Chart -->
      <div id="devicePieChart" style="min-height: 365px;" class="echart"></div>

      <script>
        document.addEventListener("DOMContentLoaded", () => {
          echarts.init(document.querySelector("#devicePieChart")).setOption({
            title: {
              text: 'Device Usage',
              subtext: 'GoldenHearts Admin',
              left: 'center'
            },
            tooltip: { trigger: 'item' },
            legend: {
              orient: 'vertical',
              left: 'left'
            },
            series: [{
              name: 'Device',
              type: 'pie',
              radius: '50%',
              data: [
                { value: 9652 * 0.542, name: 'Desktop' },
                { value: 9652 * 0.368, name: 'Phones' },
                { value: 9652 * 0.09, name: 'Tablet' }
              ],
              emphasis: {
                itemStyle: {
                  shadowBlur: 10,
                  shadowOffsetX: 0,
                  shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
              }
            }]
          });
        });
      </script>
      <!-- End Pie Chart -->

    </div>
  </div>
</div>


      <!-- Graphs & Tables Row -->
<div class="col-12">
  <div class="row">

    <!-- Real-Time Activity Chart -->
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Real-Time Activity Feed</h5>
          <div id="realTimeChart"></div>

          <script>
            document.addEventListener("DOMContentLoaded", () => {
              new ApexCharts(document.querySelector("#realTimeChart"), {
                chart: {
                  type: 'line',
                  height: 350,
                  animations: {
                    enabled: true,
                    easing: 'linear',
                    dynamicAnimation: {
                      speed: 1000
                    }
                  },
                  toolbar: {
                    show: false
                  },
                  zoom: {
                    enabled: false
                  }
                },
                dataLabels: {
                  enabled: false
                },
                series: [{
                  name: 'Donations per Minute',
                  data: [10, 20, 14, 25, 18, 22, 26, 30, 28, 32, 29, 34]
                }],
                xaxis: {
                  categories: [
                    "10:00", "10:01", "10:02", "10:03", "10:04", "10:05",
                    "10:06", "10:07", "10:08", "10:09", "10:10", "10:11"
                  ],
                  title: { text: "Time" }
                },
                yaxis: {
                  title: { text: "Donations" }
                },
                stroke: {
                  curve: 'smooth',
                  width: 3
                },
                colors: ['#ff771d'],
                tooltip: {
                  x: {
                    format: 'HH:mm'
                  }
                }
              }).render();
            });
          </script>
        </div>
      </div>
    </div>

  </div>
</div>


          




        </div>
      </div>

    </div>
  </section>

</main><!-- End #main -->

<?php if (isset($_SESSION['sweet_alert'])): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        title: '<?= $_SESSION['sweet_alert']['title'] ?>',
        text: '<?= $_SESSION['sweet_alert']['text'] ?>',
        icon: '<?= $_SESSION['sweet_alert']['icon'] ?>',
        confirmButtonText: 'OK'
    });
</script>
<?php unset($_SESSION['sweet_alert']); ?>
<?php endif; ?>


</body>

</html>

<?php
include('footer.php');
?>