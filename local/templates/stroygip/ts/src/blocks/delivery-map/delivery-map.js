import {Loader} from '@googlemaps/js-api-loader';

let mapDelivery = Array.from(document.querySelectorAll('.order-form__address-button'));

if (mapDelivery.length > 0) {
    const loader = new Loader({
        apiKey: 'AIzaSyAUTKfNeQ5DFQP-g_N8Rg0ulxwWPnyVJq0',
        libraries: ['geometry']
    });

    loader.loadCallback(e => {
        if (e) {
            console.log(e);
        } else {
            mapDeliveryHandler();
        }
    });
}

function mapDeliveryHandler() {
    let $modal = document.getElementById('delivery-map');
    let $modalMap = $modal.querySelector('.delivery-map__item');
    let $modalInput = $modal.querySelector('.delivery-map__form-input input');
    let $saveButton = $modal.querySelector('.delivery-map__form-button-save');
    let $cancelButton = $modal.querySelector('.delivery-map__form-button-cancel');
    let $mainInput = document.querySelector('.order-form__address-input input');
    let $priceResultBlock = document.querySelector('.order-form__address-price');
    let priceResultBlockShowClass = 'order-form__address-price--show';
    let $bigPriceResult = document.querySelector('.order-form__address-price-item-number--big');
    let $smallPriceResult = document.querySelector('.order-form__address-price-item-number--small');
    let bigDelivery = 0;
    let smallDelivery = 0;

    $saveButton.addEventListener('click', () => {
        if ($modalInput.value !== '') {
            $priceResultBlock.classList.add(priceResultBlockShowClass);
            $bigPriceResult.innerText = bigDelivery;
            $smallPriceResult.innerText = smallDelivery;
            $mainInput.value = $modalInput.value;
            modals.close();
        }
    });

    $cancelButton.addEventListener('click', () => {
        modals.close();
    });

    let latlng = new google.maps.LatLng(window.currentLangCenter);
    let shop = new google.maps.LatLng(42.86348301510319, 74.61781435590407);

    let myOptions = {
        zoom: 15,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    let map = new google.maps.Map($modalMap, myOptions);

    let markers = [];
    let address = '';

    google.maps.event.addListener(map, 'click', function (e) {

        let location = e.latLng;
        let clientLocation = new google.maps.LatLng(location.lat(), location.lng());

        new google.maps.Geocoder().geocode({
            'latLng': clientLocation
        }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                address = results[0].formatted_address;

                $modalInput.value = address;
            }
        });

        let distance = Math.ceil(google.maps.geometry.spherical.computeDistanceBetween(shop, clientLocation) / 1000);

        bigDelivery = distance * deliveryPrice.bigDeliveryKm;

        if (bigDelivery < deliveryPrice.bigDeliveryKmMinimal) {
            bigDelivery = deliveryPrice.bigDeliveryKmMinimal;
        }

        smallDelivery = distance * deliveryPrice.smallDeliveryKm;

        if (smallDelivery < deliveryPrice.smallDeliveryKmMinimal) {
            smallDelivery = deliveryPrice.smallDeliveryKmMinimal;
        }

        removeMarkers();

        let marker = new google.maps.Marker({
            position: new google.maps.LatLng(location.lat(), location.lng()),
            map: map,
        });

        markers.push(marker);
    });

    function removeMarkers() {
        for (let i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
        }
        markers = [];
    }
}
