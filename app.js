// فلترة المنتجات بناءً على الفئة المحددة
function filterProducts() {
    var category = document.getElementById('product-category').value;
    var products = document.querySelectorAll('.product');

    products.forEach(function(product) {
        if (category === '' || product.getAttribute('data-category') === category) {
            product.style.display = 'block';
        } else {
            product.style.display = 'none';
        }
    });
}
