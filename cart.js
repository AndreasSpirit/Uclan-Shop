(function cart () {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    const cartItems = document.getElementById("cart-items");
    const cartTotal = document.getElementById("cart-total");

    // Function to remove items from the cart
    function renderCart() {
        cartItems.innerHTML = "";
        let total = 0;

        cart.forEach((item, index) => {
            const itemDiv = document.createElement("div");
            itemDiv.classList.add("cart-item");

            // Parse price as a number
            const price = parseFloat(item.price.replace(/[^0-9.-]+/g, ''));

            //innerHTML for the cart item
            itemDiv.innerHTML = `
                <img src="${item.imageSrc}" alt="${item.title}" class="cart-image">
                <h4>${item.title} (${item.color})</h4>
                <p>Price: $${price.toFixed(2)}</p>
                <button class="remove-button" data-index="${index}">Remove</button>
            `;

            cartItems.appendChild(itemDiv);

            // Add to the total
            total += isNaN(price) ? 0 : price;
        });

        // Display the total
        cartTotal.textContent = `Total: $${total.toFixed(2)}`;

        const removeitem = document.querySelectorAll(".remove-button");
        removeitem.forEach(button => {
            button.addEventListener("click", (e) => {
                const index = e.target.getAttribute("data-index");
                removeItem(index);
            });
        });
    }

    // Function to remove an item from the cart
    function removeItem(index) {
        cart.splice(index, 1); // Remove the item
        localStorage.setItem("cart", JSON.stringify(cart)); // Update localStorage
        renderCart(); // Re-render the cart
    }

    renderCart();
})();


