<?php session_start(); ?>
<?php if (isset($_SESSION['users']) && $_SESSION['users'] === true): ?>
    <?php $today = date('Y-m-d'); ?>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
      var navbar = document.getElementById("layout-navbar");
      if (navbar) navbar.style.display = "none"; // Hide navbar if it exists
    });
    </script>

    <body class="bg-gray-100 p-6">
        <div class="max-w-2xl mx-auto">
            <div class="flex justify-end mb-4 space-x-2">
                <button class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Cancel
                </button>
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" onclick="exportPDF()">
                Export
                </button>
            </div>
            <div class="bg-white p-8 rounded-lg shadow-lg" id="receipt">
                <div class="text-center mb-8">
                    <h1 class="text-4xl font-bold mb-4">
                    HENG HENG
                    </h1>
                    <h2 class="text-3xl font-bold">
                    Receipt
                    </h2>
                    <p class="text-gray-600">
                    Thank you for your purchase!
                    </p>
                </div>
                <div class="mb-6">
                    <h2 class="text-xl font-semibold">
                        Order Details
                    </h2>
                <div class="mt-2">
                    <div class="flex justify-between">
                        <p class="text-gray-600">
                            Order Number:
                        </p>
                        <p class="font-medium">
                            #123456789
                        </p>
                    </div>
                    <div class="flex justify-between mt-2">
                        <p class="text-gray-600">
                            Order Date:
                        </p>
                        <p class="font-medium">
                            October 1, 2023
                        </p>
                    </div>
                    <div class="flex justify-between mt-2">
                        <p class="text-gray-600">
                            Customer Name:
                        </p>
                        <p class="font-medium">
                            John Doe
                        </p>
                    </div>
                    <div class="flex justify-between mt-2">
                        <p class="text-gray-600">
                            Payment Method:
                        </p>
                        <p class="font-medium">
                            Credit Card (Visa ending in 1234)
                        </p>
                    </div>
                </div>
            </div>
            <div class="mb-6">
                <h2 class="text-xl font-semibold">
                Items Purchased
                </h2>
                <div class="mt-2">
                    <div class="grid grid-cols-4 gap-4 border-b py-2">
                        <p class="text-gray-600">
                            Name
                        </p>
                        <p class="text-gray-600">
                            Quantity
                        </p>
                        <p class="text-gray-600">
                            Unit Price
                        </p>
                        <p class="text-gray-600">
                            Total Price
                        </p>
                </div>
                <div class="grid grid-cols-4 gap-4 border-b py-2">
                    <p class="text-gray-600" id="item-name">
                        Item 1
                    </p>
                    <p class="font-medium" id="quantity">
                        1
                    </p>
                    <p class="font-medium">
                        $10.00
                    </p>
                    <p class="font-medium" id="total-price">
                        $10.00
                    </p>
                </div>
            </div>
        </div>
        <div class="mb-6">
            <h2 class="text-xl font-semibold">
            Summary
            </h2>
            <div class="flex justify-between mt-2">
            <p class="text-gray-600">
            Subtotal:
            </p>
            <p class="font-medium" id="subtotal">
            $100.00
            </p>
        </div>
            <div class="flex justify-between mt-2">
                <p class="text-gray-600">
                Dicount :
                </p>
                <p class="font-medium" id="discount">
                $10.00
                </p>
            </div>
            <div class="flex justify-between mt-2">
                <p class="text-gray-600">
                Total:
                </p>
                <p class="font-medium" id="final-total-price">
                $110.00
                </p>
            </div>
        </div>
            <div class="text-center mt-8">
                <p class="text-gray-600">
                1234 Elm Street, Springfield, IL 62704 / (555) 123-4567
                </p>
        </div>
        </div>
        </div>

        <!-- Function export Receipt -->
        <script>
            function exportPDF() {
                const { jsPDF } = window.jspdf;
                const receipt = document.querySelector("#receipt");

                html2canvas(receipt, { scale: 2 }).then(canvas => {
                    const imgData = canvas.toDataURL("image/png");

                    // Define custom receipt size (58mm width, auto height)
                    const receiptWidth = 58; // mm (typical receipt width)
                    const receiptHeight = (canvas.height * receiptWidth) / canvas.width; 

                    const doc = new jsPDF({
                        orientation: "portrait",
                        unit: "mm",
                        format: [receiptWidth, receiptHeight] // Custom size
                    });

                    doc.addImage(imgData, "PNG", 0, 0, receiptWidth, receiptHeight);
                    doc.save("receipt.pdf");
                });
            }

            
        
        </script>

        <script>

        </script>


 </body>

<?php else: ?>
<?php $this->redirect('/login'); ?>
<?php endif; ?>