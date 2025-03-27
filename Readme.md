README-UCLan Shop

Overview

The Uclan Shop is a dynamic and responsive e-commerce website designed to view, interact with and purchase and manage products. 
assign.css: stylesheet file
index.html: home page
products.html: products page with products.js for scripting
item.html: items page with item.js for scripting
cart.html: cart page with cart.js for scripting

Features Implementer

Home page:  includes header with containers for products and cart page, video using html file video element tag and youtube embed video using iframe. Also, the footer in the bottom of the page

 Product Listing

•	Products are loaded using JavaScript, products adjust to a grid layout, displaying three items per row with spacing. Products are categorized in Hoodies, Jumpers and T-shirts. 
•	 Read more functionality, each product features a “read more” button, which redirects to the item  page and it is detailed view of the selected product. Also, the products details are passed using sessionStorage to maintain state across pages
•	Buy button which adds items to the shopping cart
          Shopping Cart
•	items are added to the cart and stored using localStorage and cart displays each item with its image, name, color and price
•	Total: calculates and display the total price of items in the cart
•	Remove button: removes items from the cart and the cart updates dynamically  after the removal

 CSS Styling

•	Styling elements and hover effects for interactive elements

How to run

Open the index.html file in any web browser


