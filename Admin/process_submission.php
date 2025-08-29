<?php
include('../connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = intval($_POST['id']);
  $action = $_POST['action'];

  if ($action === 'approve') {
    // Change status to 'accepted' instead of 'approved'
    $sql = "UPDATE elder_homes SET status = 'accepted' WHERE id = $id";
    mysqli_query($link, $sql);

  } elseif ($action === 'reject' && isset($_POST['reason'])) {
    $reason = mysqli_real_escape_string($link, $_POST['reason']);
    $sql = "UPDATE elder_homes SET status = 'rejected', description = CONCAT(description, '\nRejection Reason: ', '$reason') WHERE id = $id";
    mysqli_query($link, $sql);
  }
}
?>
