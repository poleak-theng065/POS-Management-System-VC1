let currentPage = 1; // Start on the first page
let entriesPerPage = 10; // Number of entries per page
const entries = Array.from(document.querySelectorAll('#switchTableBody tr')); // Get all rows in the table body
const totalEntries = entries.length;

// Function to update the table display based on the current page
function updateTable() {
    // Hide all entries
    entries.forEach((row, index) => {
        row.style.display = 'none';
        if (index < currentPage * entriesPerPage && index >= (currentPage - 1) * entriesPerPage) {
            row.style.display = ''; // Show the current page's entries
        }
    });

    // Update entries info
    const start = (currentPage - 1) * entriesPerPage + 1;
    const end = Math.min(currentPage * entriesPerPage, totalEntries);
    document.getElementById('entriesInfo').innerText = `Showing ${start} to ${end} of ${totalEntries} entries`;

    // Update pagination buttons
    document.getElementById('prevPage').classList.toggle('disabled', currentPage === 1);
    document.getElementById('nextPage').classList.toggle('disabled', currentPage * entriesPerPage >= totalEntries);
    document.querySelectorAll('.page-item').forEach(item => item.classList.remove('active'));
    document.getElementById(`page${currentPage}`).classList.add('active');
}

// Function to change the page
function changePage(page) {
    currentPage = page;
    updateTable();
}

// Event listeners for pagination buttons
document.getElementById('prevPage').addEventListener('click', function (e) {
    e.preventDefault();
    if (currentPage > 1) {
        changePage(currentPage - 1);
    }
});

document.getElementById('nextPage').addEventListener('click', function (e) {
    e.preventDefault();
    if (currentPage * entriesPerPage < totalEntries) {
        changePage(currentPage + 1);
    }
});

// Assuming you have page buttons for page 1 and page 2
document.getElementById('page1').addEventListener('click', function (e) {
    e.preventDefault();
    changePage(1);
});

document.getElementById('page2').addEventListener('click', function (e) {
    e.preventDefault();
    changePage(2);
});

// Initial table update
updateTable();