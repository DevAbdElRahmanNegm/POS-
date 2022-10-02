$(document).ready(function () {

    $('.add-product-btn').on('click' , function () {

        var name = $(this).data('name');
        var id = $(this).data('id');
        var price = $(this).data('price');

        $(this).removeClass('btn-success').addClass('btn-default disabled')


        var html = `<tr>
            <td>${name}</td>
            <input type="hidden" name="products[]" value="${id}">
                    <td><input type="number" data-price="${price}" name="quantity[]" class="form-control product-quantity" min="1" value="1"></td>    
                      <td class="product-price">${price}</td>
                      <td><button class="btn btn-danger remove-product-btn" data-id="${id}"><span class="fa fa-trash"></span></button></td>
                   </tr>`;
        $('.order-list').append(html);

        calculateTotal();
    });
});

$('body').on('click' , '.remove-product-btn' , function () {

    var id = $(this).data('id');

    $(this).closest('tr').remove();
$('#product-' + id).removeClass('btn-default disabled').addClass('btn-success');

    calculateTotal();
});

$('body').on('change' , '.product-quantity' , function () {

    var quantity = parseInt($(this).val());
    var productPrice = $(this).data('price');
    $(this).closest('tr').find('.product-price').html(quantity * productPrice);
    calculateTotal();
});


$('body').on('click','.order-products',function () {


        $.ajax({
            url: $(this).data('url'),
            type: "GET",
            success: function (data) {
                $('.table-product').html(data);
            }
        })

} );

function calculateTotal() {

    var price = 0;
    $('.order-list .product-price').each(function (index) {

        price += parseInt($(this).html());
    });
   $('.total-price').html(price);

   if (price > 0){

    $('#add-order-form-btn').removeClass('disabled')
   }else {
       $('#add-order-form-btn').addClass('disabled')
   }
}