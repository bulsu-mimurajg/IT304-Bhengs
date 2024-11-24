//  <?php
//         session_unset(); // Unset all session variables
//         session_destroy(); // Destroy the session
//         echo "Session has been cleared.";
//         ?>

$(document).ready(function () {
    $(document).on('click', '.increment', function () {
        var $row = $(this).closest('tr'); 
        var $quantityInput = $row.find('.quantityInput'); 
        var productId = $row.find('.prodId').val();
        var currentValue = parseInt($quantityInput.val()) || 0;

        if (!isNaN(currentValue)) {
            var newQty = currentValue + 1;
            $quantityInput.val(newQty); 
            updateProductRow(productId, newQty, $row); 
        }
    });

    $(document).on('click', '.decrement', function () {
        var $row = $(this).closest('tr'); 
        var $quantityInput = $row.find('.quantityInput');
        var productId = $row.find('.prodId').val(); //
        var currentValue = parseInt($quantityInput.val()) || 0;

        if (!isNaN(currentValue) && currentValue > 1) {
            var newQty = currentValue - 1;
            $quantityInput.val(newQty); 
            updateProductRow(productId, newQty, $row); 
        }
    });

    $(document).on('blur', '.quantityInput', function () {
        var $row = $(this).closest('tr'); 
        var productId = $row.find('.prodId').val(); 
        var qty = parseInt($(this).val()) || 1; 
    
        if (qty < 1) qty = 1; 
        $(this).val(qty); 
        updateProductRow(productId, qty, $row); 
    });

    function updateProductRow(productId, qty, $row) {
        $.ajax({
            type: "POST",
            url: "orders-function.php",
            data: {
                productIncDec: true,
                ProductID: productId,
                Quantity: qty
            },
            success: function (response) {
                try {
                    var res = JSON.parse(response);
                    if (res.status == 200) {
                        var price = parseFloat($row.find('td:nth-child(2)').text()); 
                        var newTotal = (price * qty).toFixed(2);
                        $row.find('td:nth-child(4)').text(newTotal);
                    } else {
                    }
                } catch (error) {
                    console.error("Parsing error:", error);
                }
            },
            error: function (xhr, status, error) {
                console.error("An error occurred: " + error);
            }
        });
    }

    
});
