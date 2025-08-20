<!DOCTYPE html>
<html lang="en">

<?php
include('header.php');
?>

<body>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Notifications Center</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Notifications</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">

            <div class="d-flex justify-content-between align-items-center pt-3">
              <ul class="nav nav-tabs" id="notificationTabs" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">All</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="unread-tab" data-bs-toggle="tab" data-bs-target="#unread" type="button" role="tab" aria-controls="unread" aria-selected="false">Unread</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="read-tab" data-bs-toggle="tab" data-bs-target="#read" type="button" role="tab" aria-controls="read" aria-selected="false">Read</button>
                </li>
              </ul>
              <button class="btn btn-link text-success small fw-bold" id="markAllReadBtn">Mark all as read</button>
            </div>

            <div class="tab-content pt-3" id="notificationTabsContent">

              <!-- All Notifications Tab -->
              <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                <ul class="list-group list-group-flush" id="allNotificationsList">

                  <!-- Sample Notification Item -->
                  <li class="list-group-item d-flex justify-content-between align-items-start notification-item unread" data-type="register" data-id="1">
                    <div class="ms-2 me-auto">
                      <div class="fw-bold text-success">Register</div>
                      New Elder Home Registered: <strong>Serene Life Home</strong><br>
                      <small class="text-muted">Serene Life Home has successfully registered and is pending verification.</small><br>
                      <span class="text-primary small">Serene Life Home</span>
                    </div>
                    <div class="text-end">
                      <span class="text-muted small d-block mb-1">17 Feb 2025 at 8:15 PM</span>
                      <button class="btn btn-sm btn-outline-secondary mark-read-btn" title="Mark as read">Mark read</button>
                    </div>
                  </li>

                  <li class="list-group-item d-flex justify-content-between align-items-start notification-item unread" data-type="donation" data-id="2">
                    <div class="ms-2 me-auto">
                      <div class="fw-bold text-danger">Donation</div>
                      New Donation Received: <strong>John Perera</strong><br>
                      <small class="text-muted">John donated 25 packs of adult diapers to "Graceful Aging Home".</small><br>
                      <span class="text-primary small">John Perera</span>
                    </div>
                    <div class="text-end">
                      <span class="text-muted small d-block mb-1">15 Feb 2025 at 2:15 PM</span>
                      <button class="btn btn-sm btn-outline-secondary mark-read-btn" title="Mark as read">Mark read</button>
                    </div>
                  </li>

                  <li class="list-group-item d-flex justify-content-between align-items-start notification-item read" data-type="request" data-id="3">
                    <div class="ms-2 me-auto">
                      <div class="fw-bold text-warning">Request</div>
                      Item Request Alert: <strong>Sunrise Elders Care</strong><br>
                      <small class="text-muted">Request for "10 Medical Beds". Needs admin approval.</small><br>
                      <span class="text-primary small">Sunrise Elders Care</span>
                    </div>
                    <div class="text-end">
                      <span class="text-muted small d-block mb-1">13 Feb 2025 at 1:30 PM</span>
                      <button class="btn btn-sm btn-outline-secondary mark-unread-btn" title="Mark as unread">Mark unread</button>
                    </div>
                  </li>

                  <!-- Add more notifications similarly -->

                </ul>

                <div class="text-end mt-3">
                  <a href="view-more-notifications.php" class="btn btn-outline-primary btn-sm">
                    View more <i class="bi bi-arrow-right-circle ms-1"></i>
                  </a>
                </div>
              </div>

              <!-- Unread Notifications Tab -->
              <div class="tab-pane fade" id="unread" role="tabpanel" aria-labelledby="unread-tab">
                <ul class="list-group list-group-flush" id="unreadNotificationsList"></ul>
              </div>

              <!-- Read Notifications Tab -->
              <div class="tab-pane fade" id="read" role="tabpanel" aria-labelledby="read-tab">
                <ul class="list-group list-group-flush" id="readNotificationsList"></ul>
              </div>

            </div>

          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // Utility to move notifications between lists and update buttons
  function moveNotification(li, targetList, markAsRead) {
    const allList = document.getElementById('allNotificationsList');
    const unreadList = document.getElementById('unreadNotificationsList');
    const readList = document.getElementById('readNotificationsList');

    // Remove from current parent
    li.parentElement.removeChild(li);

    // Update class and button
    if (markAsRead) {
      li.classList.remove('unread');
      li.classList.add('read');
      // Change button to mark unread
      li.querySelector('.mark-read-btn').classList.add('d-none');
      let unreadBtn = li.querySelector('.mark-unread-btn');
      if (!unreadBtn) {
        unreadBtn = document.createElement('button');
        unreadBtn.className = 'btn btn-sm btn-outline-secondary mark-unread-btn';
        unreadBtn.textContent = 'Mark unread';
        unreadBtn.title = 'Mark as unread';
        unreadBtn.addEventListener('click', () => moveNotification(li, unreadList, false));
        li.querySelector('.text-end').appendChild(unreadBtn);
      } else {
        unreadBtn.classList.remove('d-none');
      }
    } else {
      li.classList.remove('read');
      li.classList.add('unread');
      // Change button to mark read
      li.querySelector('.mark-unread-btn').classList.add('d-none');
      let readBtn = li.querySelector('.mark-read-btn');
      if (!readBtn) {
        readBtn = document.createElement('button');
        readBtn.className = 'btn btn-sm btn-outline-secondary mark-read-btn';
        readBtn.textContent = 'Mark read';
        readBtn.title = 'Mark as read';
        readBtn.addEventListener('click', () => moveNotification(li, readList, true));
        li.querySelector('.text-end').appendChild(readBtn);
      } else {
        readBtn.classList.remove('d-none');
      }
    }

    // Add to target list
    targetList.appendChild(li);
  }

  // Initialize buttons events
  document.querySelectorAll('.mark-read-btn').forEach(btn => {
    btn.addEventListener('click', function () {
      const li = this.closest('li');
      moveNotification(li, document.getElementById('readNotificationsList'), true);
    });
  });

  document.querySelectorAll('.mark-unread-btn').forEach(btn => {
    btn.addEventListener('click', function () {
      const li = this.closest('li');
      moveNotification(li, document.getElementById('unreadNotificationsList'), false);
    });
  });

  // Mark all as read button handler
  document.getElementById('markAllReadBtn').addEventListener('click', () => {
    const unreadItems = document.querySelectorAll('.notification-item.unread');
    unreadItems.forEach(li => {
      moveNotification(li, document.getElementById('readNotificationsList'), true);
    });
  });

  // On page load, populate unread and read tabs from all list
  window.addEventListener('DOMContentLoaded', () => {
    const allItems = document.querySelectorAll('#allNotificationsList .notification-item');
    allItems.forEach(li => {
      if (li.classList.contains('unread')) {
        document.getElementById('unreadNotificationsList').appendChild(li.cloneNode(true));
      } else if (li.classList.contains('read')) {
        document.getElementById('readNotificationsList').appendChild(li.cloneNode(true));
      }
    });
  });
</script>





</body>

</html>

<?php
include('footer.php');
?>