let currentPage = 1;
    let entriesPerPage = 2;
    const entries = Array.from(document.querySelectorAll('#switchTableBody tr'));
    const totalEntries = entries.length;
    let productSortOrder = true; // true for ascending, false for descending
    let earningSortOrder = true;

    function sortTable(type) {
        if (type === 'products') {
            entries.sort((a, b) => {
                const productA = parseInt(a.querySelector('.product-count').innerText);
                const productB = parseInt(b.querySelector('.product-count').innerText);
                return productSortOrder ? productB - productA : productA - productB;
            });
            productSortOrder = !productSortOrder; // Toggle sort order
            document.getElementById('productSortIcon').innerHTML = productSortOrder ? '▲' : '▼';
        } else if (type === 'earning') {
            entries.sort((a, b) => {
                const earningA = parseFloat(a.querySelector('.earning').innerText.replace(/[$,]/g, ''));
                const earningB = parseFloat(b.querySelector('.earning').innerText.replace(/[$,]/g, ''));
                return earningSortOrder ? earningB - earningA : earningA - earningB;
            });
            earningSortOrder = !earningSortOrder; // Toggle sort order
            document.getElementById('earningSortIcon').innerHTML = earningSortOrder ? '▲' : '▼';
        }

        // Reattach sorted rows to the table body
        const tbody = document.getElementById('categoriesTable');
        entries.forEach(row => tbody.appendChild(row));

        // Update the table display after sorting
        updateTable();
    }

    // Initial table update
    updateTable();


    // ----------------------
    // Simulated existing slugs for validation
    const existingSlugs = ['travel', 'smart-phone', 'shoes', 'jewellery', 'home-decor'];

    document.getElementById('addCategoryForm').addEventListener('submit', function(event) {
        const slugInput = document.getElementById('categorySlug');
        const slugError = document.getElementById('slugError');
        const slugValue = slugInput.value.trim().toLowerCase();

        // Check for duplicate slug
        if (existingSlugs.includes(slugValue)) {
            event.preventDefault(); // Prevent form submission
            slugError.style.display = 'block'; // Show error message
        } else {
            slugError.style.display = 'none'; // Hide error message
            existingSlugs.push(slugValue); // Add the new slug to existing slugs
        }
    });

    // Update the file name display when a file is chosen
    const fileInput = document.getElementById('categoryAttachment');
    const fileNameDisplay = document.getElementById('fileName');

    fileInput.addEventListener('change', function() {
        const fileName = fileInput.files.length > 0 ? fileInput.files[0].name : 'No file chosen';
        fileNameDisplay.textContent = fileName;
    });

    