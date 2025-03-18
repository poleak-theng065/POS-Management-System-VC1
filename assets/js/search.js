
// Search
function searchOrders() {
    const input = document.getElementById('searchOrderInput');
    const filter = input.value.toLowerCase();
    const table = document.getElementById('switchTableBody');
    const rows = table.getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        let rowVisible = false;

        for (let j = 0; j < cells.length - 1; j++) {
            if (cells[j].textContent.toLowerCase().includes(filter)) {
                rowVisible = true;
                break;
            }
        }

        rows[i].style.display = rowVisible ? '' : 'none';
    }
}

/// script.js
document.addEventListener("DOMContentLoaded", function() {
    // Navbar Search (Page Navigation)
    const navbarSearchInput = document.getElementById("navbarSearchInput");
    const searchResults = document.getElementById("searchResults");

    const searchData = [
        {"title": "Category_List", "url": "/category_list"},
        {"title": "Product_List", "url": "/product_list"},
        {"title": "Order_New_Product", "url": "/order_new_product"},
        {"title": "Arrived_Product", "url": "/arrived_product"},
        {"title": "Low_Stock_Product", "url": "/low_stock_product"},
        {"title": "Import_Product", "url": "/import_product"},
        {"title": "Dashboard", "url": "/"}
    ];

    function debounce(func, wait) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }

    const performNavbarSearch = debounce(function() {
        const query = navbarSearchInput.value.trim().toLowerCase();
        if (query.length < 1) {
            searchResults.style.display = "none";
            return;
        }

        const filteredResults = searchData.filter(item => 
            item.title.toLowerCase().includes(query) || 
            item.url.toLowerCase().includes(query)
        );

        if (filteredResults.length > 0) {
            searchResults.innerHTML = filteredResults.map(item => `
                <a href="${item.url}" class="d-block p-2 text-dark text-decoration-none">${item.title}</a>
            `).join("");
            searchResults.style.display = "block";
        } else {
            // searchResults.innerHTML = "<div class='p-2 text-muted'>No results found</div>";
            // searchResults.style.display = "block";
        }
    }, 300);

    navbarSearchInput.addEventListener("input", performNavbarSearch);

    document.addEventListener("keydown", function(event) {
        if (event.ctrlKey && event.key === "k") {
            event.preventDefault();
            navbarSearchInput.focus();
        }
    });

    document.addEventListener("click", function(event) {
        if (!navbarSearchInput.contains(event.target) && !searchResults.contains(event.target)) {
            searchResults.style.display = "none";
        }
    });

    // Table Search (Filter Categories)
    const tableSearchInput = document.getElementById("navbarSearchInput"); // Reuse navbar input for table
    const tableBody = document.getElementById("switchTableBody");
    const noResults = document.getElementById("noResults");

    function searchOrders() {
        const input = tableSearchInput;
        const filter = input.value.toLowerCase();
        const rows = tableBody.getElementsByTagName("tr");
        let found = false;

        for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName("td");
            let rowVisible = false;

            for (let j = 0; j < cells.length - 1; j++) { // Exclude the last column (Action)
                if (cells[j].textContent.toLowerCase().includes(filter)) {
                    rowVisible = true;
                    found = true;
                    break;
                }
            }

            rows[i].style.display = rowVisible ? "" : "none";
        }

        noResults.style.display = found ? "none" : "block";
    }

    tableSearchInput.addEventListener("keyup", searchOrders); // Trigger table search on keyup
});