document.addEventListener('DOMContentLoaded', function () {
    let currentPage = 1;
    const entriesPerPage = 10;

    const entries = Array.from(document.querySelectorAll('tbody tr.search'));
    const totalEntries = entries.length;
    const totalPages = Math.ceil(totalEntries / entriesPerPage);

    function updateTable() {
        const start = (currentPage - 1) * entriesPerPage;
        const end = start + entriesPerPage;

        // Show or hide rows based on the current page
        entries.forEach((row, index) => {
            row.style.display = (index >= start && index < end) ? '' : 'none';
        });

        // Update entries information display
        const startEntry = start + 1;
        const endEntry = Math.min(end, totalEntries);
        document.getElementById('entriesInfo').innerText = `Showing ${startEntry} to ${endEntry} of ${totalEntries} entries`;

        // Update pagination buttons
        updatePagination();
    }

    function updatePagination() {
        const pagination = document.getElementById('pagination');
        pagination.innerHTML = ''; // Clear existing pagination buttons

        // Create the "previous" button
        const prevBtn = createPageButton('«', currentPage - 1, currentPage > 1);
        pagination.appendChild(prevBtn);

        // Create the page number buttons dynamically
        for (let i = 1; i <= totalPages; i++) {
            if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
                const pageBtn = createPageButton(i, i, true, i === currentPage);
                pagination.appendChild(pageBtn);
            } else if (i === currentPage - 2 || i === currentPage + 2) {
                const ellipsis = document.createElement('li');
                ellipsis.className = 'page-item disabled';
                ellipsis.innerHTML = '<span class="page-link">...</span>';
                pagination.appendChild(ellipsis);
            }
        }

        // Create the "next" button
        const nextBtn = createPageButton('»', currentPage + 1, currentPage < totalPages);
        pagination.appendChild(nextBtn);
    }

    function createPageButton(text, page, isActive, isCurrent) {
        const pageItem = document.createElement('li');
        pageItem.className = `page-item ${isActive ? '' : 'disabled'} ${isCurrent ? 'active' : ''}`;
        const pageLink = document.createElement('a');
        pageLink.className = 'page-link';
        pageLink.href = '#';
        pageLink.innerText = text;

        pageLink.addEventListener('click', function (e) {
            e.preventDefault();
            if (isActive) {
                currentPage = page;
                updateTable();
            }
        });

        pageItem.appendChild(pageLink);
        return pageItem;
    }

    // Listen to "prev" and "next" button clicks for navigation
    const prevBtn = document.getElementById('prevPage');
    const nextBtn = document.getElementById('nextPage');

    // The prev button should update the currentPage and call updateTable
    if (prevBtn) {
        prevBtn.addEventListener('click', function (e) {
            e.preventDefault();
            if (currentPage > 1) {
                currentPage--;
                updateTable(); // Update the table after changing the page
            }
        });
    }

    // The next button should update the currentPage and call updateTable
    if (nextBtn) {
        nextBtn.addEventListener('click', function (e) {
            e.preventDefault();
            if (currentPage < totalPages) {
                currentPage++;
                updateTable(); // Update the table after changing the page
            }
        });
    }

    // Initial call to populate the table and pagination
    updateTable();
});
