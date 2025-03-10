<style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 30px;
        }
        .card {
            border: none;
            border-radius: 10px;
            padding: 20px;
        }
        .table th {
            background-color: #ffffff;
            border-bottom: 1px solid #dee2e6;
        }
        .table td {
            border-bottom: 1px solid #dee2e6;
        }
        .action-btn {
            border: none;
            background: none;
            padding: 0;
            font-size: 1.2rem;
            cursor: pointer;
        }
        .category-image {
            width: 40px;
            height: 40px;
            border-radius: 5px;
        }
    </style>

    <div class="container mt-4">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <input type="text" class="form-control w-25" placeholder="Search Category">
                <div class="d-flex align-items-center">
                    <select class="form-select w-auto me-2">
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                    <a href="/add" class="btn btn-primary">+ Add Category</a>
                </div>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="form-check-input"></th>
                        <th>Categories</th>
                        <th>Total Products</th>
                        <th>Total Earning</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>
                            <img src="https://www.zdnet.com/a/img/resize/9f3fcf92f17d47c88823e7f2c0f1454ecd3e5140/2024/09/19/8da68e24-08b1-467a-9062-a90a96c1d879/dsc02198.jpg?auto=webp&fit=crop&height=900&width=1200" class="category-image me-2" alt="Travel">
                            Travel<br><small>Choose from a wide range of travel accessories from popular brands</small>
                        </td>
                        <td>4186</td>
                        <td>$7129.99</td>
                        <td>
                            <button class="action-btn" onclick="editCategory('Travel')"><i class="fas fa-edit"></i></button>
                            <button class="action-btn" onclick="deleteCategory('Travel')"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>
                            <img src="https://m.media-amazon.com/images/I/51Nnp56PlbL.jpg" class="category-image me-2" alt="Smart Phone">
                            Smart Phone<br><small>Choose from a wide range of smartphones from popular brands</small>
                        </td>
                        <td>1947</td>
                        <td>$9919.29</td>
                        <td>
                            <button class="action-btn" onclick="editCategory('Smart Phone')"><i class="fas fa-edit"></i></button>
                            <button class="action-btn" onclick="deleteCategory('Smart Phone')"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>
                            <img src="https://www.zdnet.com/a/img/resize/9f3fcf92f17d47c88823e7f2c0f1454ecd3e5140/2024/09/19/8da68e24-08b1-467a-9062-a90a96c1d879/dsc02198.jpg?auto=webp&fit=crop&height=900&width=1200" class="category-image me-2" alt="Shoes">
                            Shoes<br><small>Explore the latest shoes from top brands</small>
                        </td>
                        <td>4940</td>
                        <td>$3612.98</td>
                        <td>
                            <button class="action-btn" onclick="editCategory('Shoes')"><i class="fas fa-edit"></i></button>
                            <button class="action-btn" onclick="deleteCategory('Shoes')"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>
                            <img src="https://www.zdnet.com/a/img/resize/9f3fcf92f17d47c88823e7f2c0f1454ecd3e5140/2024/09/19/8da68e24-08b1-467a-9062-a90a96c1d879/dsc02198.jpg?auto=webp&fit=crop&height=900&width=1200" class="category-image me-2" alt="Jewellery">
                            Jewellery<br><small>Choose from a wide range of jewellery from popular brands</small>
                        </td>
                        <td>4186</td>
                        <td>$7129.99</td>
                        <td>
                            <button class="action-btn" onclick="editCategory('Jewellery')"><i class="fas fa-edit"></i></button>
                            <button class="action-btn" onclick="deleteCategory('Jewellery')"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>
                            <img src="https://via.placeholder.com/40" class="category-image me-2" alt="Home Decor">
                            Home Decor<br><small>Choose from a wide range of home decor from popular brands</small>
                        </td>
                        <td>9184</td>
                        <td>$8129.99</td>
                        <td>
                            <button class="action-btn" onclick="editCategory('Home Decor')"><i class="fas fa-edit"></i></button>
                            <button class="action-btn" onclick="deleteCategory('Home Decor')"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function editCategory(category) {
            alert("Edit " + category);
            // Add your edit logic here
        }

        function deleteCategory(category) {
            if (confirm("Are you sure you want to delete " + category + "?")) {
                alert(category + " has been deleted.");
                // Add your delete logic here
            }
        }
    </script>