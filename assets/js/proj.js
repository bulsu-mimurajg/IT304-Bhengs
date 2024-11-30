






    // for increase and decreaseButtons
    const decreaseButtons = document.querySelectorAll('#decrease');
    const increaseButtons = document.querySelectorAll('#increase');
    const qtyInputs = document.querySelectorAll('.qty-input');

    decreaseButtons.forEach((button, index) => {
        button.addEventListener('click', () => {
            let currentValue = parseInt(qtyInputs[index].value);
            if (currentValue > 1) {
                qtyInputs[index].value = currentValue - 1;
            }
        });
    });

    increaseButtons.forEach((button, index) => {
        button.addEventListener('click', () => {
            let currentValue = parseInt(qtyInputs[index].value);
            qtyInputs[index].value = currentValue + 1;
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        const cartButton = document.getElementById('cartButton');
        const cartSide = document.getElementById('cardside');
        const userButton = document.getElementById('userButton'); // User button to hide cart
        const sizeSelector = document.getElementById("sizeSelector");
        const priceDisplay = document.getElementById("priceDisplay");
        const qtyInput = document.querySelector(".qty-input");
        const decreaseBtn = document.getElementById("decrease");
        const increaseBtn = document.getElementById("increase");
        const totalPriceDisplay = document.getElementById("totalPrice"); 
        
        // Show the cart side on page load
        cartSide.classList.add('show');  // Show the cart by default
    
        // Toggle cart visibility when the cart icon is clicked
        cartButton.addEventListener('click', () => {
            cartSide.classList.toggle('show');
        });
    
        // Remove cart when the user icon is clicked
        userButton.addEventListener('click', () => {
            cartSide.classList.remove('show');
        });
    
        // Function to update price based on selected size and quantity
        function updatePrice() {
            const selectedOption = sizeSelector.options[sizeSelector.selectedIndex];
            const basePrice = parseInt(selectedOption.getAttribute("data-price"));
            const quantity = parseInt(qtyInput.value);
            const totalPrice = basePrice * quantity;
    
            priceDisplay.textContent = `Php ${totalPrice}.00`;
        }
    
        // Event listener to update price when size changes
        sizeSelector.addEventListener("change", updatePrice);
    
        // Initial price update call
        updatePrice();
    });
    



    
    //total updatePrice
let totalPrice = 0;

// Function to update the total price display
function updateTotalPrice() {
    const totalPriceElement = document.getElementById("totalPrice");
    totalPriceElement.textContent = `Total: ₱${totalPrice.toFixed(2)}`;
}

// For handling the "Add to Cart" button clicks
const addToCartButtons = document.querySelectorAll('.atcbtn');  // Select all "Add to Cart" buttons

addToCartButtons.forEach((button, index) => {
    button.addEventListener('click', function() {
        const sizeSelector = document.querySelectorAll('.size')[index];  // Get size selector for the specific item
        const qtyInput = document.querySelectorAll('.qty-input')[index]; // Get quantity input for the specific item

        // Get selected size and price
        const selectedOption = sizeSelector.options[sizeSelector.selectedIndex];
        const size = selectedOption.value;  // This will be the size (small, medium, large)
        const sizePrice = parseInt(selectedOption.getAttribute("data-price"));
        
        // Get the selected quantity
        const quantity = parseInt(qtyInput.value);

        // Calculate the price for this item
        const itemPrice = sizePrice * quantity;

        // Update the total price
        totalPrice += itemPrice;

        // Update the displayed total price
        updateTotalPrice();

        // Reset the quantity input to 1 after adding to cart
        qtyInput.value = 1;

        // Add item to cart
        const cartItemsContainer = document.getElementById('cartItems');

        // Create a new cart item element
        const cartItem = document.createElement('div');
        cartItem.classList.add('cartItem');

        // Create a cart item row
        cartItem.innerHTML = `
            <div class="cart-item-row">
            <button class="remove-btn">-</button>
            <span class="cart-item-qty">${quantity}</span>
                <span>${size}</span>  <!-- Display the selected size -->
                <span>${document.querySelectorAll('.menubox h3')[index].innerText}</span> <!-- Product name -->
                <span>₱${itemPrice.toFixed(2)}</span> <!-- Item price with ₱ symbol -->
                
            </div>
        `;

        // Append the item to the cart
        cartItemsContainer.appendChild(cartItem);
    });
});

// ------------------------------------------------------------------------------
 document.addEventListener("DOMContentLoaded", function () {
        const cartButton = document.getElementById('cartButton');
        const cartSide = document.getElementById('cardside');
        const userButton = document.getElementById('userBtn'); // Corrected the ID to match the button ID
        const userSide = document.getElementById('userside'); // The user sidebar element
        
        // Show the cart side on page load
        cartSide.classList.add('show');  // Show the cart by default
        
        // Toggle cart visibility when the cart icon is clicked
        cartButton.addEventListener('click', () => {
            // Close user sidebar if open
            if (userSide.style.right === '0px') {
                userSide.style.right = '-320px';
            }
            
            // Toggle cart sidebar
            cartSide.style.right = cartSide.style.right === '0px' ? '-320px' : '0px';
        });
        
        // Toggle user sidebar visibility when the user icon is clicked
        userButton.addEventListener('click', () => {
            // Close cart sidebar if open
            if (cartSide.style.right === '0px') {
                cartSide.style.right = '-320px';
            }
            
            // Toggle user sidebar
            userSide.style.right = userSide.style.right === '0px' ? '-320px' : '0px';
        });
        
        
    });
    
    
// For handling "Remove" button clicks
const cartItemsContainer = document.getElementById('cartItems');

cartItemsContainer.addEventListener('click', function(event) {
    if (event.target.classList.contains('remove-btn')) {
        // Remove the cart item when the "-" button is clicked
        const cartItem = event.target.closest('.cartItem');
        if (cartItem) {
            // Find the item price and subtract it from the total price
            const itemPriceElement = cartItem.querySelector('span:last-child');  // Assuming the price is the last span
            const itemPrice = parseFloat(itemPriceElement.textContent.replace('₱', '').replace(',', ''));
            
            totalPrice -= itemPrice;  // Subtract the item price from the total price
            updateTotalPrice();  // Update the total price display
            
            // Remove the cart item from the DOM
            cartItemsContainer.removeChild(cartItem);
        }
    }
});