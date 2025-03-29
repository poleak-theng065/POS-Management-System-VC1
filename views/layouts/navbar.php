<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <!-- <img src="https://img.freepik.com/free-vector/gradient-mobile-store-logo-design_23-2149697771.jpg" alt="Store Logo" class="app-brand-logo demo me-2" width="25" /> -->
            <span class="app-brand-text demo menu-text fw-bolder fs-2 text-capitalize">Heng Heng</span>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Dashboard</span>
            </li>
            <!-- Dashboard -->
            <li class="menu-item active open">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Account Settings">Dashboard</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item active">
                  <a href="/" class="menu-link">
                    <div data-i18n="Account">Dashboard</div>
                  </a>
                </li>
                <li class="menu-item active">
                  <a href="/sale_form" class="menu-link">
                    <div data-i18n="Account">Sale</div>
                  </a>
                </li>
              </ul>
            </li>

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Inventory</span>
            </li>
            <li class="menu-item active open">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cart"></i>
                <div data-i18n="Account Settings">Products</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item active">
                  <a href="/product_list" class="menu-link">
                    <div data-i18n="Account">Product List</div>
                  </a>
                </li>
                
                <!-- <li class="menu-item active">
                  <a href="/category_list" class="menu-link">
                    <div data-i18n="Account">Category List</div>
                  </a>
                </li> -->
                
              </ul>
            </li>

            <li class="menu-item active open">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-import"></i>
                <div data-i18n="Account Settings">Import Product</div>
              </a>
              <ul class="menu-sub">
                <!-- <li class="menu-item active">
                    <a href="/import_product" class="menu-link">
                      <div data-i18n="Account">Import Product</div>
                    </a>
                </li> -->
                <!-- <li class="menu-item active">
                  <a href="/arrived_product" class="menu-link">
                    <div data-i18n="Account">Arrived Product</div>
                  </a>
                </li> -->
                <li class="menu-item active">
                  <a href="/order_new_product" class="menu-link">
                    <div data-i18n="Account">Import Product</div>
                  </a>
                </li>
                
              </ul>
            </li>
            

            <li class="menu-item active open">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-purchase-tag"></i>
                <div data-i18n="Account Settings">Sale Product</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item active">
                  <a href="/sold_product" class="menu-link">
                    <div data-i18n="Account">Sold Product</div>
                  </a>
                </li>
                <!-- <li class="menu-item active">
                  <a href="/low_stock_product" class="menu-link">
                    <div data-i18n="Account">Low Stock</div>
                  </a>
                </li> -->
                <!-- <li class="menu-item active">
                  <a href="/run_out_of_stock" class="menu-link">
                    <div data-i18n="Account">Run Out Of Stock</div>
                  </a>
                </li> -->
              </ul>
            </li>

            <li class="menu-item active open">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-transfer"></i>
                <div data-i18n="Account Settings">Return Product</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item active">
                  <a href="/return_product" class="menu-link">
                    <div data-i18n="Account">Return Product</div>
                  </a>
                </li>
              </ul>
            </li>


            <!-- Components -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Account</span></li>
            <!-- Cards -->
            <li class="menu-item">
                <a href="/create_account" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user-plus"></i> 
                    <div data-i18n="Basic">Create Account</div>
                </a>
            </li>

            <!-- User account  -->
            <li class="menu-item">
                <a href="/user_account" class="menu-link">
                  <i class="bx bx-user"></i>
                  <div data-i18n="Basic" style= "margin-left: 20px;">User Account</div>
                </a>
            </li>



            <li class="menu-item">
              <a href="cards-basic.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Basic">Setting</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="#" class="menu-link log-out" style="color: red; border: 1px solid; width: 150px; height: 35px;">
                <i class="menu-icon tf-icons bx bx-log-out-circle"></i>
                <div data-i18n="Basic">Logout</div>
              </a>
            </li>
          </ul>
        </aside>

 <!-- Log Out Confirmation Modal (Placed outside <li>) -->
        <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="logoutModalLabel">Log out</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Are you sure you want to log out?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" id="confirmLogout">Log out</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
              </div>
            </div>
          </div>

          <style>
            .bg-danger-light {
              background-color: #f8d7da !important; /* Lighter red */
            }

            .bg-warning-light {
              background-color: #fff3cd !important; /* Lighter yellow */
            }
          </style>

          <script>
            document.addEventListener("DOMContentLoaded", function () {
              // Select the logout button that triggers the modal
              const logoutTrigger = document.querySelector(".log-out");

              // Select the modal
              const logoutModal = new bootstrap.Modal(document.getElementById("logoutModal"));

              // Add event listener to open modal when clicking logout button
              logoutTrigger.addEventListener("click", function (event) {
                event.preventDefault(); // Prevent navigation
                logoutModal.show();
              });

              // Handle logout confirmation
              document.getElementById("confirmLogout").addEventListener("click", function () {
                window.location.href = "/logout"; // Redirect to logout
              });
            });
          </script>

        <!-- / Menu -->
         
         <script>
          // Get the current URL path
          var currentPage = window.location.pathname;

          // Get all menu links
          var menuLinks = document.querySelectorAll('.menu-link');

          // Loop through each menu link
          menuLinks.forEach(function(link) {
            // Check if the href of the link matches the current page's URL path
            if (link.getAttribute('href') === currentPage) {
              // Add the 'active' class to the link
              link.classList.add('active');

              // Find the closest menu item and mark it as 'active' and 'open'
              var menuItem = link.closest('.menu-item');
              menuItem.classList.add('active');
              menuItem.classList.add('open');

              // If the link is inside a submenu, ensure the parent item is also 'active' and 'open'
              var parentMenu = menuItem.closest('.menu-sub');
              if (parentMenu) {
                var parentMenuItem = parentMenu.closest('.menu-item');
                parentMenuItem.classList.add('active', 'open');
              }
            } else {
              // Remove the 'active' class from links that don't match the current page
              link.classList.remove('active');
            }
          });

          // Ensure that the main menu item stays active if one of its sub-links is active
          document.querySelectorAll('.menu-item').forEach(function(item) {
            const subMenuLinks = item.querySelectorAll('.menu-sub .menu-link');
            const isAnySubActive = Array.from(subMenuLinks).some(subLink => subLink.classList.contains('active'));
            
            // If a sub-link is active, mark the parent as 'active' and 'open'
            if (isAnySubActive) {
              item.classList.add('active', 'open');
            } else {
              item.classList.remove('active', 'open');
            }
          });

        </script>

        
         
        <style>
            /* Remove underline from all menu links */
          .menu-link {
              text-decoration: none; /* Remove underline */
          }

          /* Remove underline on hover */
          .menu-link:hover {
              text-decoration: none; /* Ensure no underline on hover */
          }

          /* Optionally remove text decoration for the logo as well */
          .app-brand-link {
              text-decoration: none; /* Remove underline from logo link */
          }
          .app-brand-logo {
              width: 40px; /* Increase size of the logo */
              height: auto; /* Maintain aspect ratio */
              border-radius: 5px; /* Rounded corners */
              box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Subtle shadow for depth */
              transition: transform 0.3s; /* Smooth scaling on hover */
          }

          .app-brand-logo:hover {
              transform: scale(1.05); /* Slightly enlarge on hover */
          }
      </style>

        <!-- Layout container -->
        <div class="layout-page">
          

        <!-- Navbar -->
        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                    <i class="bx bx-menu bx-sm"></i>
                </a>
            </div>

            <!-- Search -->
            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center position-relative">
                    <i class="bx bx-search fs-4 lh-0"></i>
                    <input type="text" class="form-control border-0 shadow-none" id="navbarSearchInput" placeholder="Search... [CTRL + K]" aria-label="Search..." />
                    <div id="searchResults" class="position-absolute bg-white border shadow" style="display: none; width: 200px; max-height: 200px; overflow-y: auto;"></div>
                </div>
            </div>
            <script src="/assets/js/search.js"></script>
                <!-- /Search -->

                <ul class="navbar-nav flex-row align-items-center ms-auto">

                    <!-- Light/Dark Mode Toggle -->
                    <li class="nav-item lh-1 me-3">
                        <a class="nav-link" href="javascript:void(0);" id="theme-toggle" title="Toggle Light/Dark Mode">
                            <i class="bx bx-moon fs-4" id="theme-icon"></i> <!-- Default icon for dark mode -->
                        </a>
                    </li>


                    <!-- Notifications -->
                    <li class="nav-item lh-1 me-3">
                        <a class="nav-link" href="javascript:void(0);" title="Notifications">
                            <i class="bx bx-bell fs-4"></i>
                            <span class="badge bg-danger badge-notifications">5</span>
                        </a>
                    </li>

                    <!-- User -->
                    <li class="nav-item navbar-dropdown dropdown-user dropdown">
                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                            <div class="avatar avatar-online">
                                <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar avatar-online">
                                                <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <span class="fw-semibold d-block">John Doe</span>
                                            <small class="text-muted">Admin</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="bx bx-user me-2"></i>
                                    <span class="align-middle">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="bx bx-cog me-2"></i>
                                    <span class="align-middle">Settings</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="auth-login-basic.html">
                                    <i class="bx bx-power-off me-2"></i>
                                    <span class="align-middle">Log Out</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!--/ User -->
                </ul>
            </div>
        </nav>
        <!-- / Navbar -->

        <!-- Path of sidebar -->
         <!-- Breadcrumbs -->
        <!-- <div class="breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" id="breadcrumb-list">
                    
                </ol>
            </nav>
        </div> -->


        <!-- Path -->
         <script>
          document.addEventListener("DOMContentLoaded", function () {
          // Function to update breadcrumbs
          function generateBreadcrumbs() {
              // Get the current path from the URL
              const currentPath = window.location.pathname;

              // Define breadcrumb names for each path
              const breadcrumbs = {
                  "/": "Dashboard",
                  "/sale_form": "Sale",
                  "/product_list": "Product List",
                  "/category_list": "Category List", // Direct route for category list
                  "/order_new_product": "Import Product",
                  "/import_product": "Import Product Form",
                  "/arrived_product": "Arrival Product",
                  "/sold_product": "Sold Product",
                  "/return_product": "Return Product",
                  "/create_account": "Create Account",
                  "/login": "Login"
              };

              // Clear previous breadcrumb items
              const breadcrumbList = document.querySelector('.breadcrumb'); // Adjusted to match your breadcrumb element
              breadcrumbList.innerHTML = '';

              // Create the "Dashboard" breadcrumb
              const dashboardItem = document.createElement('li');
              dashboardItem.classList.add('breadcrumb-item');
              const dashboardLink = document.createElement('a');
              dashboardLink.href = '/';
              dashboardLink.textContent = 'Dashboard';
              dashboardItem.appendChild(dashboardLink);
              breadcrumbList.appendChild(dashboardItem);

              // Handle the current page
              const currentPageName = breadcrumbs[currentPath] || 'Unknown Page';
              const currentItem = document.createElement('li');
              currentItem.classList.add('breadcrumb-item', 'active');
              currentItem.textContent = currentPageName;
              breadcrumbList.appendChild(currentItem);
          }

          // Call the function to generate breadcrumbs on page load
          generateBreadcrumbs();
      });
         </script>

         <!-- /Path of sidebar -->


        <style>
          /* Styling for the breadcrumbs */
          .breadcrumbs {
              margin-top: 25px; /* Adjust this value based on the height of your navbar */
              padding-left: 20px;
              padding-right: 20px;
          }

          .breadcrumb {
              background-color: transparent;
              margin-bottom: 0;
          }

          .breadcrumb-item a {
              color: #007bff; /* Change to your desired link color */
              text-decoration: none;
          }

          .breadcrumb-item.active {
              color: #6c757d; /* Color for the current page */
          }

          .breadcrumb-item + .breadcrumb-item::before {
              content: ">";
              color: #6c757d;
              padding: 0 10px;
          }

        </style>

      


        <script>
          document.addEventListener("DOMContentLoaded", function () {
            var currentPage = window.location.pathname;
            var navbar = document.getElementById("layout-navbar");

            // Check if the URL contains "/edit", "/update", "/create", "/sale_form", or is "/import_product"
            if (currentPage.includes("/edit") || 
                currentPage.includes("/update") || 
                currentPage.includes("/create") ||
                currentPage === "/sale_form" ||
                currentPage === "/import_product") {
              navbar.style.display = "none"; // Hide navbar
            } else {
              navbar.style.display = "block"; // Show navbar
            }
          });
        </script>



    
<script>
  document.addEventListener("DOMContentLoaded", function () {
    let searchInput = document.querySelector("input[placeholder='Search... [CTRL + K]']");
    let productTableBody = document.querySelector("#productTable tbody");
    let categoryTableBody = document.querySelector("#categoriesTable");

    searchInput.addEventListener("keyup", function () {
        let searchValue = searchInput.value.trim();

        if (searchValue.length > 0) {
            fetch(`search.php?query=${encodeURIComponent(searchValue)}`)
                .then(response => response.json())
                .then(data => {
                    // Update product table
                    productTableBody.innerHTML = "";
                    if (data.products.length > 0) {
                        data.products.forEach((product, index) => {
                            productTableBody.innerHTML += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${product.name}</td>
                                    <td>${product.barcode}</td>
                                    <td>${product.brand}</td>
                                    <td>${product.model}</td>
                                    <td>${product.type}</td>
                                    <td>${product.status}</td>
                                    <td>${product.stock_quantity}</td>
                                    <td>
                                        <a class="text-warning me-2 editProductBtn"
                                           data-id="${product.product_id}"
                                           data-name="${product.name}"
                                           data-barcode="${product.barcode}"
                                           data-brand="${product.brand}"
                                           data-model="${product.model}"
                                           data-type="${product.type}"
                                           data-status="${product.status}"
                                           data-stock-quantity="${product.stock_quantity}"
                                           data-bs-toggle="modal"
                                           data-bs-target="#editProductModal">
                                            <i class="bi bi-pencil-square fs-4"></i>
                                        </a>
                                        <a class="text-danger deleteProductBtn"
                                           data-id="${product.product_id}"
                                           data-name="${product.name}"
                                           data-bs-toggle="modal" 
                                           data-bs-target="#deleteProductModal">
                                            <i class="bi bi-trash fs-4"></i>
                                        </a>
                                    </td>
                                </tr>`;
                        });
                    } else {
                        productTableBody.innerHTML = '<tr><td colspan="9" class="text-center text-danger">No products found</td></tr>';
                    }

                    // Update category table
                    categoryTableBody.innerHTML = "";
                    if (data.categories.length > 0) {
                        data.categories.forEach((category, index) => {
                            categoryTableBody.innerHTML += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${category.name}</td>
                                    <td>${category.brand ? category.brand : 'No Brand'}</td>
                                    <td>${category.model ? category.model : 'No Model'}</td>
                                    <td>${category.type ? category.type : 'No Type'}</td>
                                    <td>${category.description}</td>
                                    <td>
                                        <a class="text-warning me-2 editCategoryBtn"
                                           data-id="${category.category_id}"
                                           data-name="${category.name}"
                                           data-description="${category.description}"
                                           data-bs-toggle="modal"
                                           data-bs-target="#editCategoryModal">
                                            <i class="bi bi-pencil-square fs-4"></i>
                                        </a>
                                        <a class="text-danger deleteCategoryBtn"
                                           data-id="${category.category_id}"
                                           data-name="${category.name}"
                                           data-bs-toggle="modal" 
                                           data-bs-target="#deleteCategoryModal">
                                            <i class="bi bi-trash fs-4"></i>
                                        </a>
                                    </td>
                                </tr>`;
                        });
                    } else {
                        categoryTableBody.innerHTML = '<tr><td colspan="7" class="text-center text-danger">No categories found</td></tr>';
                    }
                })
                .catch(error => console.error("Error fetching data:", error));
        }
    });
});


</script>

