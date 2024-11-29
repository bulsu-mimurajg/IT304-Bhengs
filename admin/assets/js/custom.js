//  <?php
//         session_unset(); // Unset all session variables
//         session_destroy(); // Destroy the session
//         echo "Session has been cleared.";
//         ?>

// Cart item increment and decrement 
document.addEventListener("DOMContentLoaded", function () {

    // Increment button functionality
    document.querySelectorAll('.increment').forEach(function (incrementBtn) {
        incrementBtn.addEventListener('click', function () {
            var row = this.closest('tr');
            var quantityInput = row.querySelector('.quantityInput');
            var productId = row.querySelector('.prodId').value;
            var currentValue = parseInt(quantityInput.value) || 0;

            if (!isNaN(currentValue)) {
                var newQty = currentValue + 1;
                quantityInput.value = newQty;
                updateProductRow(productId, newQty, row);
            }
        });
    });

    // Decrement button functionality
    document.querySelectorAll('.decrement').forEach(function (decrementBtn) {
        decrementBtn.addEventListener('click', function () {
            var row = this.closest('tr');
            var quantityInput = row.querySelector('.quantityInput');
            var productId = row.querySelector('.prodId').value;
            var currentValue = parseInt(quantityInput.value) || 0;

            if (!isNaN(currentValue) && currentValue > 1) {
                var newQty = currentValue - 1;
                quantityInput.value = newQty;
                updateProductRow(productId, newQty, row);
            }
        });
    });

    // Quantity input blur event
    document.querySelectorAll('.quantityInput').forEach(function (quantityInput) {
        quantityInput.addEventListener('blur', function () {
            var row = this.closest('tr');
            var productId = row.querySelector('.prodId').value;
            var qty = parseInt(this.value) || 1;

            if (qty < 1) qty = 1;
            this.value = qty;
            updateProductRow(productId, qty, row);
        });
    });

    // Update product row (AJAX call)
    function updateProductRow(productId, qty, row) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'orders-function.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            try {
                var res = JSON.parse(xhr.responseText);
                if (res.status == 200) {
                    var price = parseInt(row.querySelector('td:nth-child(2)').textContent);
                    var newTotal = (price * qty);
                    row.querySelector('td:nth-child(4)').textContent = newTotal;
                }
            } catch (error) {
                console.error("Parsing error:", error);
            }
        };
        xhr.onerror = function () {
            console.error("An error occurred: " + xhr.statusText);
        };
        xhr.send('productIncDec=true&ProductID=' + productId + '&Quantity=' + qty);
    }

    // Place Order functionality
    document.querySelectorAll('.placeOrder').forEach(function (placeOrderBtn) {
        placeOrderBtn.addEventListener('click', function () {
            var paymentMode = document.querySelector('#payment_mode').value;
            var phone = document.querySelector('#phone').value;

            if (paymentMode === '') {
                alert('Please Select Payment Option');
                return false;
            }

            if (phone === '' || isNaN(phone)) {
                alert('Please enter a valid phone number');
                return false;
            }

            var data = 'placeOrderBtn=true&phone=' + phone + '&paymentMode=' + paymentMode;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'orders-function.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                var res = JSON.parse(xhr.responseText);
                if (res.status === 200) {
                    window.location.href = "orders-summary.php";
                } else if (res.status === 404) {
                    alert(res.message);
                } else {
                    alert('Something went wrong');
                }
            };
            xhr.send(data);
        });
    });

    // Save order to database
    document.querySelectorAll('#saveOrder').forEach(function (saveOrderBtn) {
        saveOrderBtn.addEventListener('click', function () {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'orders-function.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                var res = JSON.parse(xhr.responseText);
                if (res.status == 200) {
                    // Initialize and show the modal using Bootstrap 5 Modal API
                    var modalElement = document.getElementById('orderSuccess');
                    var modal = new bootstrap.Modal(modalElement);
                    modal.show();
                } else {
                    alert(res.message);
                }
            };
            xhr.send('saveOrder=true');
        });
    });

});



function printReceipt(){
    var receiptData = document.getElementById("receipt").innerHTML;

    // Create an iframe element dynamically
    var iframe = document.createElement('iframe');
    iframe.style.position = 'absolute';
    iframe.style.width = '0';
    iframe.style.height = '0';
    iframe.style.border = 'none';
    
    // Append the iframe to the body (but keep it hidden)
    document.body.appendChild(iframe);
    
    // Write the receipt content to the iframe's document
    var doc = iframe.contentWindow.document;
    doc.open();
    doc.write('<html><body>');
    doc.write(receiptData);
    doc.write('</body></html>');
    doc.close();
    
    // Print the content of the iframe
    iframe.contentWindow.focus();
    iframe.contentWindow.print();
    
    // Optionally remove the iframe after printing
    setTimeout(function() {
        document.body.removeChild(iframe);
    }, 1000);
}