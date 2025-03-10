let currentPage = 1;
    let entriesPerPage = 5; // Set the default entries per page
    const entries = Array.from(document.querySelectorAll('#productTable tbody tr'));
    const totalEntries = entries.length;

    // Sort orders for different columns
    let sortOrders = {
        product: true,
        category: true,
        stock: true,
        sku: true,
        earning: true,
        qty: true,
        status: true
    };

    function updateTable() {
        entries.forEach((row, index) => {
            row.style.display = 'none';
            if (index < currentPage * entriesPerPage && index >= (currentPage - 1) * entriesPerPage) {
                row.style.display = '';
            }
        });

        const startEntry = (currentPage - 1) * entriesPerPage + 1;
        const endEntry = Math.min(currentPage * entriesPerPage, totalEntries);
        document.getElementById('startEntry').innerText = startEntry;
        document.getElementById('endEntry').innerText = endEntry;
        document.getElementById('totalEntries').innerText = totalEntries;

        const totalPages = Math.ceil(totalEntries / entriesPerPage);
        document.getElementById('prevPage').classList.toggle('disabled', currentPage === 1);
        document.getElementById('nextPage').classList.toggle('disabled', currentPage === totalPages);
    }

    function changePage(page) {
        currentPage = page;
        updateTable();
    }

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

    function sortTable(type) {
        entries.sort((a, b) => {
            let aValue, bValue;

            switch (type) {
                case 'product':
                    aValue = parseInt(a.querySelector('.product-count').innerText);
                    bValue = parseInt(b.querySelector('.product-count').innerText);
                    return sortOrders.product ? bValue - aValue : aValue - bValue;
                case 'earning':
                    aValue = parseFloat(a.querySelector('.earning').innerText.replace(/[$,]/g, ''));
                    bValue = parseFloat(b.querySelector('.earning').innerText.replace(/[$,]/g, ''));
                    return sortOrders.earning ? bValue - aValue : aValue - bValue;
                case 'category':
                    aValue = a.querySelector('td:nth-child(3) .badge').innerText;
                    bValue = b.querySelector('td:nth-child(3) .badge').innerText;
                    return sortOrders.category ? aValue.localeCompare(bValue) : bValue.localeCompare(aValue);
                case 'stock':
                    aValue = a.querySelector('td:nth-child(4) input').checked ? 1 : 0;
                    bValue = b.querySelector('td:nth-child(4) input').checked ? 1 : 0;
                    return sortOrders.stock ? bValue - aValue : aValue - bValue;
                case 'sku':
                    aValue = parseInt(a.querySelector('td:nth-child(5)').innerText);
                    bValue = parseInt(b.querySelector('td:nth-child(5)').innerText);
                    return sortOrders.sku ? bValue - aValue : aValue - bValue;
                case 'qty':
                    aValue = parseInt(a.querySelector('.product-count').innerText);
                    bValue = parseInt(b.querySelector('.product-count').innerText);
                    return sortOrders.qty ? bValue - aValue : aValue - bValue;
                case 'status':
                    aValue = a.querySelector('td:nth-child(8) .badge').innerText;
                    bValue = b.querySelector('td:nth-child(8) .badge').innerText;
                    return sortOrders.status ? aValue.localeCompare(bValue) : bValue.localeCompare(aValue);
            }
        });

        // Toggle sort order
        sortOrders[type] = !sortOrders[type];

        // Update sort icons
        updateSortIcons(type);

        // Clear the table and reattach sorted rows
        const tableBody = document.querySelector('#productTable tbody');
        tableBody.innerHTML = '';
        entries.forEach(row => tableBody.appendChild(row));
        updateTable();
    }

    function updateSortIcons(type) {
        const icons = {
            product: document.getElementById('productSortIcon'),
            category: document.getElementById('categorySortIcon'),
            stock: document.getElementById('stockSortIcon'),
            sku: document.getElementById('skuSortIcon'),
            earning: document.getElementById('earningSortIcon'),
            qty: document.getElementById('qtySortIcon'),
            status: document.getElementById('statusSortIcon')
        };

        // Reset all icons
        Object.keys(icons).forEach(key => {
            icons[key].innerText = '';
        });

        // Set the current icon
        icons[type].innerText = sortOrders[type] ? '▲' : '▼';
    }

    updateTable();



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