function setAdress() {	
	var user_adress = document.getElementById('user_selected_adress').value;
	document.getElementById('user_delivery_address').value = user_adress;
	modals.close('delivery-map');
}


function setOrderDelivery(id) {
	BX.ajax.runComponentAction('2quick:tqOrder_sef',
	'getDeliveryPrice', { // Вызывается без постфикса Action
		mode: 'class',
		data: {deliveryId: id}, // ключи объекта data соответствуют параметрам метода
	})
	.then(function (response) {
		//document.getElementById('basket__order-delivery-sum').innerHTML = response.data.delivery_price;
		document.getElementById('basket__order-total-sum').innerHTML = response.data.total;
	});
}

function setOrderPayment(id) {
	BX.ajax.runComponentAction('2quick:tqOrder_sef',
	'getDeliveryPrice', { // Вызывается без постфикса Action
		mode: 'class',
		data: {deliveryId: id}, // ключи объекта data соответствуют параметрам метода
	})
	.then(function (response) {
		//document.getElementById('basket__order-delivery-sum').innerHTML = response.data.delivery_price;
		document.getElementById('basket__order-total-sum').innerHTML = response.data.total;
	});
}

function submitOrderForm() {
	var url = document.getElementById('orderNextTab').getAttribute("data-next");
	var f_tab = document.getElementById('orderNextTab').getAttribute("data-tab");
	
	var user_name, user_phone, user_delivery_id, user_point_id, user_address;
	
	user_name = document.querySelector("input.input[name='NAME']").value;
	user_phone = document.querySelector("input.input[name='PHONE']").value;
	user_delivery_id = document.querySelector('input[name="delivery_id"]:checked').value;
	
	var f_data = [
	  {
		name: "delivery_id",
		value: user_delivery_id
	  },
	  {
		name: "NAME",
		value: user_name
	  },
	  {
		name: "PHONE",
		value: user_phone
	  },
	];
	
	if( user_delivery_id == "2" ){
		user_point_id = document.querySelector('input[name="POINT"]:checked').value;
		f_data.push({name : "POINT", value : user_point_id});
	}else{
		user_address = document.querySelector('input[name="STREET"]').value;
		f_data.push({name : "STREET", value : user_address});
	}

	
	BX.ajax.runComponentAction('2quick:tqOrder_sef',
	'saveForm', { // Вызывается без постфикса Action
		mode: 'class',
		data: {data: f_data, tab: f_tab}, // ключи объекта data соответствуют параметрам метода
	})
	.then(function (response) {
		if (response.data.STATUS == 'ERROR') {
			document.getElementById('tq_errors').innerHTML = response.data.MESSAGE;
		} else {
			document.getElementById('tq_errors').innerHTML = '';
			location.href = url;
		}
	});
	
}


function submitOrderForm2() {
	var url = document.getElementById('orderNextTab').getAttribute("data-next");
	var f_tab = document.getElementById('orderNextTab').getAttribute("data-tab");
	
	var user_payment_id;
	
	user_payment_id = document.querySelector('input[name="payment"]:checked').value;
	
	var f_data = [
	  {
		name: "payment",
		value: user_payment_id
	  },
	];
	
	BX.ajax.runComponentAction('2quick:tqOrder_sef',
	'saveForm', { // Вызывается без постфикса Action
		mode: 'class',
		data: {data: f_data, tab: f_tab}, // ключи объекта data соответствуют параметрам метода
	})
	.then(function (response) {
		if (response.data.STATUS == 'ERROR') {
			document.getElementById('tq_errors').innerHTML = response.data.MESSAGE;
		} else {
			document.getElementById('tq_errors').innerHTML = '';
			location.href = url;
		}
	});
	
}


function submitOrderForm3() {
	var user_comment = document.querySelector("textarea.input[name='comment']").value;
	
	
	BX.ajax.runComponentAction('2quick:tqOrder_sef', 'createOrder', {
        mode: 'class',
        data: {
            comment: user_comment,
        },
    })        
	.then(function (response) {
		if (response.data.STATUS == 'ERROR') {
			document.getElementById('tq_errors').innerHTML = response.data.MESSAGE;
		} else {
			location.href = '?ORDER_ID=' + response.data;
		}
	});
}
