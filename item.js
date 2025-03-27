// Retrieve product details from sessionStorage
const productdetcontainer = document.getElementById("productDetails");
const productData = sessionStorage.getItem("selectedProduct");

if (productData) {
    const { title, color, description, price, imageSrc } = JSON.parse(productData);

    // Log the product details to verify
    console.log("Product Data:", { title, color, description, price, imageSrc });

    // Display product details
    productdetcontainer.innerHTML = `
                <img src="${imageSrc}" alt="${title}">
                <h2>${title} (${color})</h2>
                <p>${description}</p>
                <p>Price: ${price}</p>
                <button onclick="addToCart('${title}', '${color}', '${price}', '${imageSrc}')">Add to Cart</button>
            `;
} else {
    productdetcontainer.innerHTML = "<p>No product details found.</p>";
}

// Back button functionality
document.getElementById("backButton").addEventListener("click", () => {
    window.history.back();
});

// Example addToCart function
function addToCart(title, color, price, imageSrc) {
    const cart=JSON.parse(localStorage.getItem("cart")) || [];
    const product={title,color,price,imageSrc};
    cart.push(product);
    localStorage.setItem("cart",JSON.stringify(cart));
    alert(`${title} has been added to your cart!`);
    // Implement cart functionality here
}
const product = JSON.parse(sessionStorage.getItem("selectedProduct"));

//details for the items
    const itemDetails = document.getElementById("item-details");
    itemDetails.innerHTML = `
    <img src="${product.imageSrc}" alt="${product.title}">
    <h2>${product.title}</h2>
    <p>Price: $${product.price}</p>
  `;
//Add to cart button on item page
    document.getElementById("add-to-cart").addEventListener("click", () => {
        const cart = JSON.parse(localStorage.getItem("cart")) || [];
        cart.push(product);
        localStorage.setItem("cart", JSON.stringify(cart));
        alert("Added to cart!");
    });



