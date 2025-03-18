
// // Search
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

// script.js
document.addEventListener("DOMContentLoaded", function () {
    // Navbar Search (Page Navigation)
    const navbarSearchInput = document.getElementById("navbarSearchInput");
    const searchResults = document.getElementById("searchResults");
    const tableBody = document.getElementById("switchTableBody");

    const searchData = [
        { title: "Category_List", url: "/category_list" },
        { title: "Order_Product", url: "/order_new_product" },
        { title: "Arrived_Product", url: "/arrived_product" },
        { title: "LowStock_Product", url: "/low_stock_product" },
        { title: "Product_List", url: "/product_list" },
        { title: "Return_Product", url: "/return_product" },
        { title: "Import_Product", url: "/import_product" },
        { title: "Dashboard", url: "/" },
    ];

    // Map page to table (simplified to Product_List for now)
    const pageTableMap = {
        "/product_list": "switchTableBody"
    };

    function debounce(func, wait) {
        let timeout;
        return function (...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }

    const performNavbarSearch = debounce(function () {
        const query = navbarSearchInput.value.trim().toLowerCase();
        if (query.length < 1) {
            searchResults.style.display = "none";
            return;
        }

        // 1. Search for Products in switchTableBody and redirect if found
        let productFound = false;
        if (tableBody) {
            const rows = tableBody.getElementsByTagName("tr");
            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName("td");
                for (let j = 0; j < cells.length - 1; j++) { // Exclude Action column
                    if (cells[j].textContent.toLowerCase().includes(query)) {
                        productFound = true;
                        break;
                    }
                }
                if (productFound) break;
            }
        }

        // 2. If products are found, redirect to the Product_List page with the query
        if (productFound) {
            const productPageUrl = "/product_list";
            window.location.href = `${productPageUrl}?query=${encodeURIComponent(query)}`;
            return; // Stop further processing since we're redirecting
        }

        // 3. If no products are found, search for Pages (direct matches based on title or URL)
        const filteredResults = searchData.filter(item =>
            item.title.toLowerCase().includes(query) ||
            item.url.toLowerCase().includes(query)
        );

        // 4. Display the results in the searchResults dropdown
        if (filteredResults.length > 0) {
            searchResults.innerHTML = filteredResults.map(item => `
                <a href="${item.url}" class="d-block p-2 text-dark text-decoration-none">
                    📄 ${item.title}
                </a>
            `).join("");
            searchResults.style.display = "block";
        } else {
            searchResults.innerHTML = "<div class='p-2 text-muted'>No results found</div>";
            searchResults.style.display = "block";
        }
    }, 300);

    navbarSearchInput.addEventListener("input", performNavbarSearch);

    document.addEventListener("keydown", function (event) {
        if (event.ctrlKey && event.key === "k") {
            event.preventDefault();
            navbarSearchInput.focus();
        }
    });

    document.addEventListener("click", function (event) {
        if (!navbarSearchInput.contains(event.target) && !searchResults.contains(event.target)) {
            searchResults.style.display = "none";
        }
    });
});