document.addEventListener('DOMContentLoaded', function() {
    updateCartCount();

    function updateCartCount() {
        var cart = JSON.parse(localStorage.getItem('cart')) || [];
        var cartCount = cart.reduce((total, item) => total + item.quantity, 0);
        document.querySelectorAll('.cart-count').forEach(function(element) {
            element.textContent = cartCount;
        });
    }
});
