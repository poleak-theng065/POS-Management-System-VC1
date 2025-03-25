
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

// Function to fetch and display search results
async function searchProducts() {
    const query = document.getElementById("navbarSearchInput").value.toLowerCase().trim();
    const resultsContainer = document.getElementById("searchResults");

    // Clear previous results
    resultsContainer.innerHTML = "";
    resultsContainer.style.display = "none";

    if (query === "") return;

    try {
        // Fetch product data from the server
        const response = await fetch(`/api/search_products?q=${encodeURIComponent(query)}`);
        const products = await response.json();

        // Display results in the dropdown
        if (products.length > 0) {
            products.forEach(product => {
                const resultItem = document.createElement("div");
                resultItem.className = "p-2";
                resultItem.textContent = `${product.name} (${product.barcode}) - ${product.brand}`;
                resultItem.style.cursor = "pointer";
                resultItem.onclick = () => redirectToProductPage(product.product_id, query);
                resultsContainer.appendChild(resultItem);
            });
            resultsContainer.style.display = "block";
        } else {
            resultsContainer.innerHTML = "<div class='p-2'>No results found</div>";
            resultsContainer.style.display = "block";
        }
    } catch (error) {
        // console.error("Error fetching search results:", error);
        // resultsContainer.innerHTML = "<div class='p-2'>Error searching products</div>";
        // resultsContainer.style.display = "block";
    }
}

// Redirect to product page with search query
function redirectToProductPage(productId, query) {
    localStorage.setItem("searchQuery", query);
    localStorage.setItem("selectedProductId", productId);
    window.location.href = "/product_list";
}

// Handle search input events
document.getElementById("navbarSearchInput").addEventListener("input", debounce(searchProducts, 300)); // Debounce to limit requests
document.getElementById("navbarSearchInput").addEventListener("keypress", function (e) {
    if (e.key === "Enter") {
        const query = document.getElementById("navbarSearchInput").value.toLowerCase().trim();
        if (query) redirectToProductPage(null, query); // Redirect with query only if no specific product selected
    }
});

// Hide results when clicking outside
document.addEventListener("click", function (e) {
    const resultsContainer = document.getElementById("searchResults");
    const searchInput = document.getElementById("navbarSearchInput");
    if (!resultsContainer.contains(e.target) && !searchInput.contains(e.target)) {
        resultsContainer.style.display = "none";
    }
});

// Debounce function to limit frequent API calls
function debounce(func, wait) {
    let timeout;
    return function (...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), wait);
    };
}

// On product page, filter or highlight the table based on search
if (window.location.pathname === "/product_list") {
    window.onload = function () {
        const searchQuery = localStorage.getItem("searchQuery");
        const selectedProductId = localStorage.getItem("selectedProductId");
        const tableBody = document.getElementById("switchTableBody");

        if (searchQuery || selectedProductId) {
            const rows = tableBody.getElementsByTagName("tr");

            for (let row of rows) {
                const cells = row.getElementsByTagName("td");
                const productId = row.querySelector(".deleteProductBtn")?.getAttribute("data-id");
                let match = false;

                if (selectedProductId && productId === selectedProductId) {
                    match = true;
                } else if (searchQuery) {
                    for (let cell of cells) {
                        if (cell.textContent.toLowerCase().includes(searchQuery)) {
                            match = true;
                            break;
                        }
                    }
                }

                if (match) {
                    row.style.backgroundColor = "#f0f8ff"; // Highlight matching rows
                } else {
                    row.style.display = "none"; // Hide non-matching rows
                }
            }

            // Clear localStorage after filtering
            localStorage.removeItem("searchQuery");
            localStorage.removeItem("selectedProductId");
        }
    };
}

