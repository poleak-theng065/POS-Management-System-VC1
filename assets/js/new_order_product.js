document.getElementById('addOrderButton').addEventListener('click', function () {
    const productName = document.getElementById('productName').value;
    const quantity = document.getElementById('quantity').value;
    const orderDate = document.getElementById('orderDate').value;
    const expectedDelivery = document.getElementById('expectedDeliveryInput').value; // Get input from text field
    const supplier = document.getElementById('supplier').value;

    // Implement the logic to add the new order to the table
    const newRow = `<tr class="border-bottom">
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>${productName}</td>
                        <td>${quantity}</td>
                        <td>${orderDate}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="me-2">${expectedDelivery}</span> <!-- Display input value -->
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#" onclick="updateDeliveryStatus(this, 'In Delivery')">In Delivery</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="updateDeliveryStatus(this, 'Arrived')">Arrived</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="updateDeliveryStatus(this, 'Expected Delivery')">Expected Delivery</a></li>
                                </ul>
                            </div>
                        </td>
                        <td>${supplier}</td>
                        <td>
                            <a href="#" class="text-warning me-2"><i class="bi bi-pencil-square fs-4"></i></a>
                            <a href="#" class="text-danger"><i class="bi bi-trash fs-4"></i></a>
                        </td>
                    </tr>`;

    document.querySelector('#orderTable tbody').insertAdjacentHTML('beforeend', newRow);

    // Reset the form after submission
    document.getElementById('newOrderForm').reset();

    // Hide the modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('addOrderModal'));
    modal.hide();
});

function updateDeliveryStatus(item, status) {
    const dropdownButton = item.closest('.dropdown').querySelector('.dropdown-toggle');
    dropdownButton.querySelector('span').textContent = status;
    console.log('Delivery status changed to:', status);
}

// Handle file upload
document.getElementById('uploadButton').addEventListener('click', function() {
    const fileInput = document.getElementById('fileUpload');
    const file = fileInput.files[0];

    if (file) {
        const fileType = file.type;
        if (fileType === 'application/pdf' || fileType === 'application/vnd.ms-excel' || fileType === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
            // Handle file processing here
            console.log('File uploaded:', file.name);
            // Implement logic to read the file and add orders to the table
        } else {
            alert('Please upload a valid PDF or Excel file.');
        }
    } else {
        alert('Please select a file to upload.');
    }
});