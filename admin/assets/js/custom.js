//  <?php
//         session_unset(); // Unset all session variables
//         session_destroy(); // Destroy the session
//         echo "Session has been cleared.";
//         ?>

// Cart item increment and decrement 
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

    //Place Order
    $(document).on('click', '.placeOrder', function(){
        var paymentMode = $('#payment_mode').val();
        var phone = $('#phone').val();
        
        console.log(paymentMode);
        if(paymentMode == ''){
            alert('Please Select Payment Option');
            return false;
        }

        if(phone == '' && !$.isNumeric(phone)){
            alert('Please enter a valid phone number');
            return false;
        }

        var data = {
            'placeOrderBtn': true,
            'phone': phone,
            'paymentMode': paymentMode
        };

        $.ajax({
            type: "POST",
            url: "orders-function.php",
            data: data,
            success: function(response){
                console.log(response);
                var res = JSON.parse(response);
                if(res.status == 200){
                    window.location.href = "order-summary.php";
                }else if (res.status == 404){
                    alert(res.message);
                }else{
                    alert('Something went wrong');
                }
            }
        })
    });
});
