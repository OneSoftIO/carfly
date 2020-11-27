$(function () {
    CalculatingTotalPrice();
    ServicesPrice();
    NumberOfDays();
    //DeliveryPrice();
});
function CalculatingTotalPrice(){
    var servicesPrice = $(".all-price-list .services > span").html();
    var RentCarPrice = $(".all-price-list .rent-price > span").html();
    var DeliveryPrice = $(".all-price-list .deliver-price > span").html();

    var totalPrice = parseFloat(servicesPrice) + parseFloat(RentCarPrice) + parseFloat(DeliveryPrice);

    $(".all-price-list .total_price > span").html(totalPrice.toFixed(2));
}
function setTermsPrice(terms){
    terms.forEach(function(element) {
        var term_input = $('input.term_input[value="'+element.id+'"]');
        if(term_input && element.price != null){
            term_input.attr('data-price', element.price);
            term_input.parent().find('label span span').html(element.price);
        }
    });
}
function DeliveryPrice(){
    var TotalPrice = 0;
    var pickupPrice = $("#pickup-location option:selected").attr('data-price');
    var DropoffPrice = $("#dropoff-location option:selected").attr('data-price');
    var TotalPrice = parseFloat(pickupPrice) + parseFloat(DropoffPrice);
    var html = $(".deliver-price span").html(TotalPrice.toFixed(2));

    //NumberOfDays();
}
function NumberOfDays(){
    var pickupDate = $('#pickup-datepicker').val();
    var dropoffDate = $("#dropoff-datepicker").val();

    GetPrice(dropoffDate, pickupDate);
}
function GetPrice(dropoffDate, pickupDate){
    var carID = $("#vehicle-id").val();
    // var time = $("#pickup-timepicker").val();

    $.ajax({
        method: 'POST',
        data: {
            'from': pickupDate,
            'until': dropoffDate,
            'id':carID,
            'pickupTime': $("#pickup-timepicker").val(),
            'dropoffTime': $("#dropoff-timepicker").val(),
            'delivery_from': $("#pickup-location").val(),
            'delivery_to': $("#dropoff-location").val()
        },
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
        },
        url: "/vehicle/price",
        success: function(response){
            var rent_price = response.price;
            var delivery_price = response.delivery_price.total;

            $(".rent-price > span").html(rent_price.toFixed(2));
            $(".rent-price > p > span").html(response.days);
            $(".all-price-list .deliver-price span").html(delivery_price.toFixed(2));

            setTermsPrice(response.terms);

            setTimeout(function(){
                CalculatingServicePrice();
                CalculatingTotalPrice();
            },500);
        }
    })
}
function toTimestamp(strDate){
    var datum = Date.parse(strDate);
    return datum/1000;
}

function ServicesPrice(){
    $(".form-extras input").change(function(){
        CalculatingServicePrice();
        CalculatingTotalPrice();
    })
    $("#pickup-timepicker, #dropoff-timepicker, #pickup-location, #dropoff-location").change(function(){
        NumberOfDays();
    });
}
function CalculatingServicePrice(){
    var totPrice = 0;
    var days = $('.all-price-list .rent-price p span').html();
    $(".form-extras input").each(function(){
        var amount = $(this).attr('data-amount');
        var container = $(this).parent().parent().find('.amount-checkbox');

        if($(this).is(':checked')) {
            var price = $(this).attr('data-price');
            if (amount === 'true') {
                var extra = container.find('input').val();
                container.addClass('active');
                price = price * extra;
            }

            if (parseFloat(price) > 0) {
                price = price * parseInt(days);
                totPrice += parseFloat(price);
            }
        } else {
            if (amount === 'true') {
                container.removeClass('active');
            }
        }
    });

    $(".all-price-list .services span").html(totPrice.toFixed(2));
}
