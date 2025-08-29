<!DOCTYPE html>
<html lang="en">

<?php
include('header.php');
?>

<body>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Needs Listing & Management</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Needs Management</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <!-- Add New Need Button -->
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5>Current Needs</h5>
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNeedModal">
            <i class="bi bi-plus-circle"></i> Add New Need
          </button>
        </div>

        <!-- Needs Table -->
        <div class="card">
          <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
              <input type="text" id="searchNeeds" class="form-control w-50" placeholder="Search Needs by Item or Category" onkeyup="filterNeedsTable()">
              <div>
                <button class="btn btn-outline-success btn-sm me-1" onclick="exportTableToCSV('needs_export.csv')">
                  <i class="bi bi-file-earmark-excel"></i> Export CSV
                </button>
                <button class="btn btn-outline-danger btn-sm" onclick="exportTableToPDF()">
                  <i class="bi bi-file-earmark-pdf"></i> Export PDF
                </button>
              </div>
            </div>

            <table class="table table-hover align-middle" id="needsTable">
              <thead class="table-light">
                <tr>
                  <th scope="col">Item</th>
                  <th scope="col">Category</th>
                  <th scope="col">Quantity Needed</th>
                  <th scope="col">Quantity Received</th>
                  <th scope="col">Status</th>
                  <th scope="col">Urgency</th>
                  <th scope="col" class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Medical Masks</td>
                  <td>Medical Supplies</td>
                  <td>500</td>
                  <td>300</td>
                  <td><span class="badge bg-warning text-dark">Partial</span></td>
                  <td><span class="badge bg-danger">Urgent</span></td>
                  <td class="text-center">
                    <button class="btn btn-sm btn-outline-primary" onclick="openEditModal(this)">Edit</button>
                    <button class="btn btn-sm btn-outline-danger" onclick="deleteNeed(this)">Delete</button>
                  </td>
                </tr>
                <tr>
                  <td>Rice Bags</td>
                  <td>Food</td>
                  <td>1000 kg</td>
                  <td>1000 kg</td>
                  <td><span class="badge bg-success">Fulfilled</span></td>
                  <td><span class="badge bg-info text-dark">Long-term</span></td>
                  <td class="text-center">
                    <button class="btn btn-sm btn-outline-primary" onclick="openEditModal(this)">Edit</button>
                    <button class="btn btn-sm btn-outline-danger" onclick="deleteNeed(this)">Delete</button>
                  </td>
                </tr>
                <tr>
                  <td>Blankets</td>
                  <td>Clothing</td>
                  <td>300</td>
                  <td>0</td>
                  <td><span class="badge bg-danger">Pending</span></td>
                  <td><span class="badge bg-danger">Urgent</span></td>
                  <td class="text-center">
                    <button class="btn btn-sm btn-outline-primary" onclick="openEditModal(this)">Edit</button>
                    <button class="btn btn-sm btn-outline-danger" onclick="deleteNeed(this)">Delete</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Add/Edit Need Modal -->
  <div class="modal fade" id="addNeedModal" tabindex="-1" aria-labelledby="addNeedModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form id="needForm" class="modal-content needs-form" onsubmit="submitNeedForm(event)">
        <div class="modal-header">
          <h5 class="modal-title" id="addNeedModalLabel">Add New Need</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="resetForm()"></button>
        </div>
        <div class="modal-body">

          <div class="mb-3">
            <label for="needItem" class="form-label">Item Name</label>
            <input type="text" class="form-control" id="needItem" required>
          </div>

          <div class="mb-3">
            <label for="needCategory" class="form-label">Category</label>
            <select id="needCategory" class="form-select" required>
              <option value="" disabled selected>Select category</option>
              <option value="Medical Supplies">Medical Supplies</option>
              <option value="Food">Food</option>
              <option value="Clothing">Clothing</option>
              <option value="Furniture">Furniture</option>
              <option value="Others">Others</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="quantityNeeded" class="form-label">Quantity Needed</label>
            <input type="text" class="form-control" id="quantityNeeded" placeholder="e.g., 500 or 1000 kg" required>
          </div>

          <div class="mb-3">
            <label for="quantityReceived" class="form-label">Quantity Received</label>
            <input type="text" class="form-control" id="quantityReceived" placeholder="e.g., 100 or 500 kg" value="0" required>
          </div>

          <div class="mb-3">
            <label for="urgency" class="form-label">Urgency</label>
            <select id="urgency" class="form-select" required>
              <option value="" disabled selected>Select urgency</option>
              <option value="Urgent">Urgent</option>
              <option value="Long-term">Long-term</option>
              <option value="One-time">One-time</option>
            </select>
          </div>

          <input type="hidden" id="editRowIndex" value="">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="resetForm()">Cancel</button>
          <button type="submit" class="btn btn-primary" id="saveNeedBtn">Save Need</button>
        </div>
      </form>
    </div>
  </div>

</main>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<!-- Bootstrap JS Bundle (includes Popper for modals) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // Filter Needs Table by item/category search
  function filterNeedsTable() {
    const input = document.getElementById("searchNeeds");
    const filter = input.value.toLowerCase();
    const table = document.getElementById("needsTable");
    const trs = table.getElementsByTagName("tr");

    for (let i = 1; i < trs.length; i++) {
      const tdItem = trs[i].getElementsByTagName("td")[0];
      const tdCategory = trs[i].getElementsByTagName("td")[1];
      if (tdItem && tdCategory) {
        const textValue = tdItem.textContent.toLowerCase() + " " + tdCategory.textContent.toLowerCase();
        trs[i].style.display = textValue.indexOf(filter) > -1 ? "" : "none";
      }
    }
  }

  // Reset modal form
  function resetForm() {
    document.getElementById('needForm').reset();
    document.getElementById('addNeedModalLabel').textContent = "Add New Need";
    document.getElementById('editRowIndex').value = "";
  }

  // Open modal in Edit mode with row data
  function openEditModal(btn) {
    const row = btn.closest("tr");
    const cells = row.getElementsByTagName("td");
    document.getElementById('needItem').value = cells[0].textContent;
    document.getElementById('needCategory').value = cells[1].textContent;
    document.getElementById('quantityNeeded').value = cells[2].textContent;
    document.getElementById('quantityReceived').value = cells[3].textContent;
    const status = cells[4].textContent.trim();
    const urgency = cells[5].textContent.trim();
    document.getElementById('urgency').value = urgency;

    document.getElementById('editRowIndex').value = row.rowIndex;
    document.getElementById('addNeedModalLabel').textContent = "Edit Need";
    const modal = new bootstrap.Modal(document.getElementById('addNeedModal'));
    modal.show();
  }

  // Delete need row from table with confirmation
  function deleteNeed(btn) {
    if (confirm("Are you sure you want to delete this need?")) {
      const row = btn.closest("tr");
      row.parentNode.removeChild(row);
    }
  }

  // Submit form handler for Add/Edit
  function submitNeedForm(event) {
    event.preventDefault();

    const item = document.getElementById('needItem').value.trim();
    const category = document.getElementById('needCategory').value;
    const qtyNeeded = document.getElementById('quantityNeeded').value.trim();
    const qtyReceived = document.getElementById('quantityReceived').value.trim();
    const urgency = document.getElementById('urgency').value;
    const editRowIndex = document.getElementById('editRowIndex').value;

    // Validate numeric quantities (basic)
    if (!qtyNeeded || !qtyReceived) {
      alert("Please enter valid quantities.");
      return;
    }

    // Calculate status based on quantities
    let statusBadge = "";
    // Extract numeric values for comparison if possible
    const neededNum = parseFloat(qtyNeeded.replace(/[^0-9.]/g, '')) || 0;
    const receivedNum = parseFloat(qtyReceived.replace(/[^0-9.]/g, '')) || 0;

    if (receivedNum >= neededNum && neededNum > 0) {
      statusBadge = '<span class="badge bg-success">Fulfilled</span>';
    } else if (receivedNum > 0 && receivedNum < neededNum) {
      statusBadge = '<span class="badge bg-warning text-dark">Partial</span>';
    } else {
      statusBadge = '<span class="badge bg-danger">Pending</span>';
    }

    // If editing existing row
    if (editRowIndex) {
      const table = document.getElementById("needsTable");
      const row = table.rows[editRowIndex];
      row.cells[0].textContent = item;
      row.cells[1].textContent = category;
      row.cells[2].textContent = qtyNeeded;
      row.cells[3].textContent = qtyReceived;
      row.cells[4].innerHTML = statusBadge;
      row.cells[5].innerHTML = `<span class="badge ${urgencyClass(urgency)}">${urgency}</span>`;
    } else {
      // Add new row
      const tableBody = document.getElementById("needsTable").getElementsByTagName('tbody')[0];
      const newRow = tableBody.insertRow();

      newRow.innerHTML = `
        <td>${item}</td>
        <td>${category}</td>
        <td>${qtyNeeded}</td>
        <td>${qtyReceived}</td>
        <td>${statusBadge}</td>
        <td><span class="badge ${urgencyClass(urgency)}">${urgency}</span></td>
        <td class="text-center">
          <button class="btn btn-sm btn-outline-primary" onclick="openEditModal(this)">Edit</button>
          <button class="btn btn-sm btn-outline-danger" onclick="deleteNeed(this)">Delete</button>
        </td>
      `;
    }

    // Close modal and reset form
    const modal = bootstrap.Modal.getInstance(document.getElementById('addNeedModal'));
    modal.hide();
    resetForm();
  }

  // Helper to assign badge class by urgency
  function urgencyClass(urgency) {
    switch (urgency) {
      case 'Urgent': return 'bg-danger';
      case 'Long-term': return 'bg-info text-dark';
      case 'One-time': return 'bg-warning text-dark';
      default: return 'bg-secondary';
    }
  }

  // Simple CSV export of table data
  function exportTableToCSV(filename) {
    let csv = [];
    const rows = document.querySelectorAll("#needsTable tr");

    for (let i = 0; i < rows.length; i++) {
      const row = [], cols = rows[i].querySelectorAll("td, th");
      for (let j = 0; j < cols.length - 1; j++) { // exclude actions column
        row.push(cols[j].innerText.replace(/,/g, "")); // remove commas for CSV
      }
      csv.push(row.join(","));
    }

    // Download CSV file
    const csvFile = new Blob([csv.join("\n")], { type: "text/csv" });
    const downloadLink = document.createElement("a");
    downloadLink.download = filename;
    downloadLink.href = window.URL.createObjectURL(csvFile);
    downloadLink.style.display = "none";
    document.body.appendChild(downloadLink);
    downloadLink.click();
  }

  // Placeholder for PDF export (can integrate jsPDF or similar)
  function exportTableToPDF() {
    alert("PDF export feature coming soon.");
  }
</script>





</body>

</html>

<?php
include('footer.php');
?>