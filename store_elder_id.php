<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['elder_home_id'])) {
    $_SESSION['donating_elder_home_id'] = intval($_POST['elder_home_id']);
}
?>
