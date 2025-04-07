
document.addEventListener('DOMContentLoaded', function () {
    let currentPage = 1;
    const entriesPerPage = 5;

    // Make sure you are selecting rows with class 'search'
    const entries = Array.from(document.querySelectorAll('tbody tr.search'));
    const totalEntries = entries.length;
    const totalPages = Math.ceil(totalEntries / entriesPerPage);

    function updateTable() {
        const start = (currentPage - 1) * entriesPerPage;
        const end = start + entriesPerPage;

        entries.forEach((row, index) => {
            if (index >= start && index < end) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        const startEntry = start + 1;
        const endEntry = Math.min(end, totalEntries);
        document.getElementById('entriesInfo').innerText = `Showing ${startEntry} to ${endEntry} of ${totalEntries} entries`;

        // Set active page button
        for (let i = 1; i <= totalPages; i++) {
            const pageBtn = document.getElementById(`page${i}`);
            if (pageBtn) {
                pageBtn.classList.remove('active');
                if (i === currentPage) pageBtn.classList.add('active');
            }
        }

        // Toggle prev/next button disabled state
        document.getElementById('prevPage').classList.toggle('disabled', currentPage === 1);
        document.getElementById('nextPage').classList.toggle('disabled', currentPage === totalPages);
    }

    // Page buttons
    for (let i = 1; i <= totalPages; i++) {
        const pageBtn = document.getElementById(`page${i}`);
        if (pageBtn) {
            pageBtn.addEventListener('click', function (e) {
                e.preventDefault();
                currentPage = i;
                updateTable();
            });
        }
    }

    // Prev button
    const prevBtn = document.getElementById('prevPage');
    if (prevBtn) {
        prevBtn.addEventListener('click', function (e) {
            e.preventDefault();
            if (currentPage > 1) {
                currentPage--;
                updateTable();
            }
        });
    }

    // Next button
    const nextBtn = document.getElementById('nextPage');
    if (nextBtn) {
        nextBtn.addEventListener('click', function (e) {
            e.preventDefault();
            if (currentPage < totalPages) {
                currentPage++;
                updateTable();
            }
        });
    }

    updateTable(); // initial call
});
