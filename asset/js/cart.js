import Cookies from 'js-cookie';

// $(document).ready(function (e) {
//     $('#showModal').on('click', function (e) {
//         e.preventDefault();
//         $('#authSuggest').modal('show');
//     });
// });


function cart () {
    let $showModal = $('#showModal');
    let $clearCart = $('.clear').filter('input');
    let $removeItem = $('.remove').filter('input');
    let $addToCart = $('.add').filter('input');
    let $quantity = $('.quantity').filter('input');

    //TODO: диалоговое окно, которое непонятно, как работает на образце и используется вместе с Bootstrap,
    //$('[data-toggle="confirmation"]').confirmation();

    $showModal.focus(function (e){
        e.preventDefault();
        $('#authSuggest').modal('show');
    })

    $addToCart.click(function () {

        let productDescription = $(this).closest('.description').filter('div');
        let productId = productDescription.data('id');
        let productPrice = productDescription.parent().find('.price span').text();
        let productQuantity = productDescription.find('.quantity-input').val();

        updateNavbarCart(productQuantity, productPrice);
        updateCartObject(productId, productQuantity);

        return false;
    });


    $removeItem.click(function () {
        let productRecord = $(this).closest('tr');
        productRecord.remove();

        recalculateCart();

        return false;
    });

    $clearCart.click(function () {
        $item.each(function () {
                $(this).remove();
            }
        );
        recalculateCart();

        return false;
    });

    $quantity.bind('keyup change click', function () {
        if (!$(this).data("previousValue") || $(this).data("previousValue") !== $(this).val()) {
            $(this).data("previousValue", $(this).val());

            //if quantity changed
            recalculateCart();
        }
    });

    $quantity.each(function () {
        $(this).data("previousValue", $(this).val());
    });

    function recalculateCart() {
        let $totalSum = 0;
        let $totalQuantity = 0;
        let $cartObject = {};
        let $item = $('.item');

        $item.each(function () {
            let quantityInput = $(this).find('.quantity');

            //get all values
            let productId = quantityInput.data('id');
            let $productQuantity = quantityInput.val();
            let $productPrice = $(this).find('.price span').text();
            let $productSum = $productPrice * $productQuantity;

            let productSumNew = $(this).find('.sum');
            productSumNew.html($productSum);

            //record to obj
            $cartObject[productId] = $productQuantity; // непонятная логика

            $totalSum += $productSum;
            $totalQuantity += $productQuantity;
        });

        //show new total sum
        let totalSumNew = $('.totalsum');
        totalSumNew.html($totalSum);

        updateNavbarCart($totalQuantity, $totalSum);

        Cookies.remove('cart');
        Cookies.set('cart', JSON.stringify($cartObject));
    }

    function updateNavbarCart(quantity, price) {

        let quantitySelector = $('#cart-quantity');
        let sumSelector = $('#cart-sum');

        let newQuantity = quantitySelector + quantity;
        let newSum = sumSelector + (price * quantity);

        quantitySelector.text(newQuantity);
        sumSelector.text(newSum);
    }

    function updateCartObject(product, quantity) {

        let cartObject;

        if (Cookies.get('cart')) {
            cartObject = JSON.parse(Cookies.get('cart'));
        } else {
            cartObject = {};
        }

        if (cartObject[product]) {
            cartObject[product] = cartObject[product] + quantity;
        } else {
            cartObject[product] = quantity;
        }

        Cookies.set('cart', JSON.stringify(cartObject));

    }

}

