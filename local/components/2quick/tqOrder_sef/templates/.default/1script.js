function initialize() {
    var latlng = new google.maps.LatLng(42.86330569498411, 74.61784422778682);
    var shop  = new google.maps.LatLng(42.86348301510319, 74.61781435590407);
    var bigDelivery = 0;
    var smallDelivery = 0;
    var myOptions = {
        zoom: 15,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("address-map"),
        myOptions);

    var markers = [];
    var address = '';

    google.maps.event.addListener(map, 'click', function (e) {

        var location = e.latLng;
        var clientLocation = new google.maps.LatLng(location.lat(), location.lng())

        new google.maps.Geocoder().geocode({
            'latLng': clientLocation
        }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                address = results[0].formatted_address;
                $('.modal-map__input').val(address);
            }
        });

        var distance = Math.ceil(google.maps.geometry.spherical.computeDistanceBetween(shop, clientLocation) / 1000)
        console.log(distance)
        console.log(deliveryPrice)

        bigDelivery = distance * deliveryPrice.bigDeliveryKm

        if (bigDelivery < deliveryPrice.bigDeliveryKmMinimal) {
            bigDelivery = deliveryPrice.bigDeliveryKmMinimal
        }

        smallDelivery = distance * deliveryPrice.smallDeliveryKm

        if (smallDelivery < deliveryPrice.smallDeliveryKmMinimal) {
            smallDelivery = deliveryPrice.smallDeliveryKmMinimal
        }

        removeMarkers();

        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(location.lat(), location.lng()),
            map: map,
        });

        markers.push(marker);
    });

    function removeMarkers() {
        for (i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
        }
        markers = [];
    }

    $('.modal-map__button').on('click', function () {
        $('[name="CITY"]').val($('.modal-map__input').val());
        $('.price-big-delivery').text(bigDelivery)
        $('.price-small-delivery').text(smallDelivery)
        $('.basket-delivery').show()

        let modalReg = $(".modal-overlay, .modal-position, .modal-map");
        modalReg.hide();
    });

    $('.modal-map__button-cancel').on('click', function () {
        let modalReg = $(".modal-overlay, .modal-position, .modal-map");
        modalReg.hide();
    });
}

$(() => {
    window.deliveryMap = new initialize();
});

$('.open-basket-map').on('click', (e) => {
    e.preventDefault();
    let modalReg = $(".modal-overlay, .modal-position, .modal-map");
    modalReg.show();
});


$(document).on('submit', '#save_order', function (e) {
    let $form = $(e.currentTarget);

    BX.ajax.runComponentAction('2quick:tqOrder_sef', 'createOrder', {
        mode: 'class',
        data: {
            comment: $form.find('[name="comment"]').val(),
        },
    })
        .then(function (response) {
            if (response.data.STATUS === 'ERROR') {
                $('.tq_errors').html(response.data.HTML);
            } else {
                location.href = '?ORDER_ID=' + response.data;
            }
        });
    return false;
});

$(document).on('change', '[name=delivery_id]', function () {
    let id = $(this).val();
    $('[data-delivery] input').attr('disabled', true);
    $('[data-delivery=' + id + '] input').attr('disabled', false);
    if (id > 0) {
        BX.ajax.runComponentAction('2quick:tqOrder_sef',
            'getDeliveryPrice', { // Вызывается без постфикса Action
                mode: 'class',
                data: {deliveryId: id}, // ключи объекта data соответствуют параметрам метода
            })
            .then(function (response) {
                $('#total_delivery').html(response.data.delivery_price);
                $('#total_order').html(response.data.total);
            });
    }
});
$(document).on('change', '[name=payment]', function () {
    let id = $(this).val();
    if (id > 0) {
        BX.ajax.runComponentAction('2quick:tqOrder_sef',
            'updatePrice', { // Вызывается без постфикса Action
                mode: 'class',
                data: {payment_id: id}, // ключи объекта data соответствуют параметрам метода
            })
            .then(function (response) {
                $('#total_delivery').html(response.data.delivery_price);
                $('#total_order').html(response.data.total);
            });
    }

});

$(document).on('submit', '#tq_order', function () {
    let url = $(this).attr('data-next'),
        tab = $(this).attr('data-tab');
    BX.ajax.runComponentAction('2quick:tqOrder_sef',
        'saveForm', { // Вызывается без постфикса Action
            mode: 'class',
            data: {data: $(this).serializeArray(), tab: tab}, // ключи объекта data соответствуют параметрам метода
        })
        .then(function (response) {
            if (response.data.STATUS == 'ERROR') {
                $('.tq_errors').html(response.data.MESSAGE);
            } else {
                $('.tq_errors').html('');
                location.href = url;
            }
        });
    return false;
});
