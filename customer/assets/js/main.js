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

document.addEventListener('DOMContentLoaded', () => {
    let cart = []; // Local cart to store products with quantities

    // Add to Cart Button Handler
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', event => {
            event.preventDefault();

            const productId = button.getAttribute('data-product-id');
            const productName = button.getAttribute('data-product-name');
            const productPrice = button.getAttribute('data-product-price');
            const productImage = button.getAttribute('data-product-image');

            // Check if product is already in the cart
            const existingProduct = cart.find(item => item.id === productId);
            if (existingProduct) {
                existingProduct.quantity++;
            } else {
                cart.push({
                    id: productId,
                    name: productName,
                    price: parseFloat(productPrice),
                    image: productImage,
                    quantity: 1
                });
            }

            updateCartUI();
        });
    });

    // Update Cart UI
    function updateCartUI() {
        const cartContainer = document.querySelector('.offcanvas-body');
        cartContainer.innerHTML = ''; // Clear previous content

        if (cart.length > 0) {
            cart.forEach(product => {
                const item = document.createElement('div');
                item.classList.add('cart-item', 'd-flex', 'align-items-center', 'mb-3');
                item.innerHTML = `
                    <img src="${product.image}" alt="${product.name}" class="img-fluid" style="width: 50px; height: 50px; margin-right: 10px;">
                    <div>
                        <p class="mb-0">${product.name}</p>
                        <small>₱${product.price} x ${product.quantity}</small>
                        <div>
                            <button class="btn btn-sm btn-primary increment" data-product-id="${product.id}">+</button>
                            <button class="btn btn-sm btn-secondary decrement" data-product-id="${product.id}">-</button>
                            <button class="btn btn-sm btn-danger remove" data-product-id="${product.id}">Remove</button>
                        </div>
                    </div>
                `;
                cartContainer.appendChild(item);
            });
        } else {
            cartContainer.innerHTML = '<p>Your cart is empty.</p>';
        }

        addCartButtonsHandlers();
    }

    // Add Handlers for Increment, Decrement, and Remove Buttons
    function addCartButtonsHandlers() {
        document.querySelectorAll('.increment').forEach(button => {
            button.addEventListener('click', event => {
                const productId = button.getAttribute('data-product-id');
                const product = cart.find(item => item.id === productId);
                if (product) {
                    product.quantity++;
                    updateCartUI();
                }
            });
        });

        document.querySelectorAll('.decrement').forEach(button => {
            button.addEventListener('click', event => {
                const productId = button.getAttribute('data-product-id');
                const product = cart.find(item => item.id === productId);
                if (product && product.quantity > 1) {
                    product.quantity--;
                    updateCartUI();
                }
            });
        });

        document.querySelectorAll('.remove').forEach(button => {
            button.addEventListener('click', event => {
                const productId = button.getAttribute('data-product-id');
                cart = cart.filter(item => item.id !== productId);
                updateCartUI();
            });
        });
    }

    document.querySelectorAll('#placeOrder').forEach(function (placeOrderBtn) {
        placeOrderBtn.addEventListener('click', function () {
            if (cart.length === 0) {
                alert('Your cart is empty. Please add items before placing an order.');
                return;
            }
    
            const cartData = JSON.stringify({ cart: cart });
    
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'orders-function.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onload = function () {
                try {
                    var res = JSON.parse(xhr.responseText);
                    if (res.status === 200) {
                        window.location.href = "orders-summary.php"; // Redirect to summary
                    } else {
                        alert(res.message);
                    }
                } catch (error) {
                    alert('Error processing the response.');
                }
            };
            xhr.onerror = function () {
                alert('Error connecting to the server.');
            };
    
            xhr.send(cartData);
        });
    });
    
    
    document.querySelectorAll('#saveOrder').forEach(function (saveOrderBtn) {
        saveOrderBtn.addEventListener('click', function () {
            const receipt = document.getElementById('receipt').innerHTML;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'orders-function.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onload = function () {
                try {
                    var res = JSON.parse(xhr.responseText);
                    if (res.status == 200) {
                        var modalElement = document.getElementById('orderSuccess');
                        var modal = new bootstrap.Modal(modalElement);
                        modal.show();
                    } else {
                        alert(res.message);
                    }
                } catch (e) {
                    alert('Failed to process server response.' + e);
                }
            };
            xhr.onerror = function () {
                alert('Failed to connect to the server.');
            };
    
            // Send JSON data
            xhr.send(JSON.stringify({ saveOrder: true, receipt: receipt }));
        });
    });
    
});    


function toggleFaq(element) {
    const content = element.nextElementSibling; // Get the next sibling, which is the content
    const isOpen = content.style.display === "block";
  
    // Close all open accordion items
    document.querySelectorAll(".faq-content").forEach((item) => {
      item.style.display = "none";
    });
  
    // Toggle the clicked one
    if (!isOpen) {
      content.style.display = "block"; // Open only if it was previously closed
    }
  }

  //notif to sa add cart
document.addEventListener('DOMContentLoaded', function() {
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
  
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevents the default link behavior
  
            // Get product details from data attributes
            const productName = this.getAttribute('data-product-name');
            const productPrice = this.getAttribute('data-product-price');
            const productImage = this.getAttribute('data-product-image');
  
            // Simulate adding the product to the cart (you can also add Ajax here for a real cart)
            // For now, just show an alert
            alert(`${productName} has been added to your cart!\nPrice: ₱${productPrice}`);
  
            // Optionally, you can also handle adding the product to the cart array in localStorage or session
            // cart.push({ productName, productPrice, productImage });
            // localStorage.setItem('cart', JSON.stringify(cart));
        });
    });
});