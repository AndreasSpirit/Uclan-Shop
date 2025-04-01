


document.addEventListener('DOMContentLoaded', function () {
	function shoppingCart() {
		const cartContainer = document.getElementById('cartContainer')
		cartContainer.innerHTML = ''

		const cart = JSON.parse(localStorage.getItem('cart')) || []
		const productIds = cart.map(item => item.product_id);
    document.getElementById('productIds').value = JSON.stringify(productIds);

		cart.forEach((item, index) => {
			const cartItem = document.createElement('div')
			cartItem.classList.add('itemCart')

			const itemDetails = document.createElement('div')
			itemDetails.classList.add('itemDetails')

			const cartName = document.createElement('h3')
			cartName.textContent = item['product_title']

			const cartIndex = document.createElement('div')
			cartIndex.classList.add('index')
			cartIndex.textContent = `${index}`

			const photoItem = document.createElement('img')
			photoItem.src = item['product_image']

			const priceItem = document.createElement('div')
			priceItem.classList.add('price')
			priceItem.textContent = '€ ' + item['product_price']

			const removeButton = document.createElement('button')
			removeButton.textContent = 'Remove'
			removeButton.addEventListener('click', () => removeItem(index))

			itemDetails.appendChild(photoItem)

			cartItem.appendChild(cartIndex)
			cartItem.appendChild(itemDetails)
			cartItem.appendChild(cartName)
			cartItem.appendChild(priceItem)
			cartItem.appendChild(removeButton)
			cartContainer.appendChild(cartItem)
		})
	}

    //function to temove items from cart
	function removeItem(index) {
		const cart = JSON.parse(localStorage.getItem('cart')) || []

		if (index >= 0 && index < cart.length) {
			cart.splice(index, 1)// remove the item
			localStorage.setItem('cart', JSON.stringify(cart))
			shoppingCart()
		}
	}

    //function to clear cart
	function clearCart() {
		localStorage.removeItem('cart')
		shoppingCart()
	}
	
	const clearButton = document.getElementById('clearButton');
    if (clearButton) {
        clearButton.addEventListener('click', function() {
            clearCart();
        });
    }
	
    //function for checkout
	const checkoutButton = document.getElementById('checkoutButton');
    if (checkoutButton) {
        checkoutButton.addEventListener('click', function(e) {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            if (cart.length === 0) {
            alert('In order to proceed you have to choose items!');
            e.preventDefault();
        }
        });

    }

shoppingCart();
})



