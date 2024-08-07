document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('bizzio-fetch-button').addEventListener('click', function () {
        fetch('https://fakestoreapi.com/products')
            .then(response => response.json())
            .then(data => {
                const productsContainer = document.getElementById('bizzio-products');
                productsContainer.innerHTML = ''; // Clear previous content

                data.forEach(product => {
                    const productDiv = document.createElement('div');
                    productDiv.className = 'product';

                    const productTitle = document.createElement('h2');
                    productTitle.textContent = product.title;

                    const productImage = document.createElement('img');
                    productImage.src = product.image;
                    productImage.alt = product.title;
                    productImage.style.width = '100px';

                    const productPrice = document.createElement('p');
                    productPrice.textContent = `Price: $${product.price}`;

                    const productDescription = document.createElement('p');
                    productDescription.textContent = product.description;

                    productDiv.appendChild(productTitle);
                    productDiv.appendChild(productImage);
                    productDiv.appendChild(productPrice);
                    productDiv.appendChild(productDescription);

                    productsContainer.appendChild(productDiv);
                });
            })
            .catch(error => console.error('Error fetching products:', error));
    });
});
