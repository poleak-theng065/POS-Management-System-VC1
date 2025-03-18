
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



// /// script.js
// document.addEventListener("DOMContentLoaded", function() {
//     // Navbar Search (Page Navigation)
//     const navbarSearchInput = document.getElementById("navbarSearchInput");
//     const searchResults = document.getElementById("searchResults");

//     const searchData = [
//         {"title": "Category_List", "url": "/category_list"},
//         {"title": "Order_New_Product", "url": "/order_new_product"},
//         {"title": "Arrived_Product", "url": "/arrived_product"},
//         {"title": "Low_Stock_Product", "url": "/low_stock_product"},
//         {"title": "Product_List", "url": "/product_list"},
//         {"title": "Import_Product", "url": "/import_product"},
//         {"title": "Dashboard", "url": "/"}
//     ];

//     function debounce(func, wait) {
//         let timeout;
//         return function(...args) {
//             clearTimeout(timeout);
//             timeout = setTimeout(() => func.apply(this, args), wait);
//         };
//     }

//     const performNavbarSearch = debounce(function() {
//         const query = navbarSearchInput.value.trim().toLowerCase();
//         if (query.length < 1) {
//             searchResults.style.display = "none";
//             return;
//         }

//         const filteredResults = searchData.filter(item => 
//             item.title.toLowerCase().includes(query) || 
//             item.url.toLowerCase().includes(query)
//         );

//         if (filteredResults.length > 0) {
//             searchResults.innerHTML = filteredResults.map(item => `
//                 <a href="${item.url}" class="d-block p-2 text-dark text-decoration-none">${item.title}</a>
//             `).join("");
//             searchResults.style.display = "block";
//         } else {
//             // searchResults.innerHTML = "<div class='p-2 text-muted'>No results found</div>";
//             // searchResults.style.display = "block";
//         }
//     }, 300);

//     navbarSearchInput.addEventListener("input", performNavbarSearch);

//     document.addEventListener("keydown", function(event) {
//         if (event.ctrlKey && event.key === "k") {
//             event.preventDefault();
//             navbarSearchInput.focus();
//         }
//     });

//     document.addEventListener("click", function(event) {
//         if (!navbarSearchInput.contains(event.target) && !searchResults.contains(event.target)) {
//             searchResults.style.display = "none";
//         }
//     });

//     // Table Search (Filter Categories)
//     const tableSearchInput = document.getElementById("navbarSearchInput"); // Reuse navbar input for table
//     const tableBody = document.getElementById("switchTableBody");
//     const noResults = document.getElementById("noResults");

//     function searchOrders() {
//         const input = tableSearchInput;
//         const filter = input.value.toLowerCase();
//         const rows = tableBody.getElementsByTagName("tr");
//         let found = false;

//         for (let i = 0; i < rows.length; i++) {
//             const cells = rows[i].getElementsByTagName("td");
//             let rowVisible = false;

//             for (let j = 0; j < cells.length - 1; j++) { // Exclude the last column (Action)
//                 if (cells[j].textContent.toLowerCase().includes(filter)) {
//                     rowVisible = true;
//                     found = true;
//                     break;
//                 }
//             }

//             rows[i].style.display = rowVisible ? "" : "none";
//         }

//         noResults.style.display = found ? "none" : "block";
//     }

//     tableSearchInput.addEventListener("keyup", searchOrders); // Trigger table search on keyup





// script.js
document.addEventListener("DOMContentLoaded", function () {
    // Navbar Search (Page Navigation)
    const navbarSearchInput = document.getElementById("navbarSearchInput");
    const searchResults = document.getElementById("searchResults");
    const tableBody = document.getElementById("switchTableBody");
    const noResults = document.getElementById("noResults");

    const searchData = [
        { title: "Category_List", url: "/category_list" },
        { title: "Order_New_Product", url: "/order_new_product" },
        { title: "Arrived_Product", url: "/arrived_product" },
        { title: "Low_Stock_Product", url: "/low_stock_product" },
        { title: "Product_List", url: "/product_list" },
        { title: "Import_Product", url: "/import_product" },
        { title: "Dashboard", url: "/" }
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
            searchOrders(""); // Reset table filtering
            return;
        }

        let filteredResults = [];
        let productFound = false;

        // 1. Search for Pages (direct matches based on title or URL)
        const directPageMatches = searchData.filter(item =>
            item.title.toLowerCase().includes(query) ||
            item.url.toLowerCase().includes(query)
        );
        directPageMatches.forEach(page => {
            filteredResults.push({
                title: page.title,
                url: page.url,
                reason: "direct match"
            });
        });

        // 2. Search for Products in switchTableBody
        if (tableBody) {
            const rows = tableBody.getElementsByTagName("tr");
            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName("td");
                for (let j = 0; j < cells.length - 1; j++) { // Exclude Action column
                    if (cells[j].textContent.toLowerCase().includes(query)) {
                        productFound = true;
                        const productPage = searchData.find(item => item.url === "/product_list");
                        if (productPage && !filteredResults.some(result => result.url === productPage.url)) {
                            filteredResults.push({
                                title: productPage.title,
                                url: productPage.url,
                                reason: `"${query}"`
                            });
                        }
                        break;
                    }
                }
            }
        }

        // 3. Display the results in the searchResults dropdown
        if (filteredResults.length > 0) {
            searchResults.innerHTML = filteredResults.map(item => `
                <a href="${item.url}" class="d-block p-2 text-dark text-decoration-none">
                    📄 ${item.title} (${item.reason})
                </a>
            `).join("");
            searchResults.style.display = "block";
        } else {
            // searchResults.innerHTML = "<div class='p-2 text-muted'>No results found</div>";
            searchResults.style.display = "block";
        }

        // 4. Filter the table
        searchOrders(query);
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

    // Table Search (Filter Products in Table)
    function searchOrders(filter = "") {
        if (!tableBody) return;
        const rows = tableBody.getElementsByTagName("tr");
        let found = false;

        for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName("td");
            let rowVisible = false;

            for (let j = 0; j < cells.length - 1; j++) { // Exclude Action column
                if (cells[j].textContent.toLowerCase().includes(filter.toLowerCase())) {
                    rowVisible = true;
                    found = true;
                    break;
                }
            }

            rows[i].style.display = rowVisible ? "" : "none";
        }

        if (noResults) {
            noResults.style.display = found ? "none" : "block";
        }
    }
});