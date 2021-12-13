function catalogAction(action, element_id) {
	var params = "";
	var action_name = "";
	
	switch (action){
		case 'add2basket':
		    var qnt = document.getElementById('item_'+element_id+'_qnt').innerHTML;
			
			var el = document.querySelectorAll("div.product-cart__button--basket[data-id='"+element_id+"']");
			el.forEach(function (el2,index) {
				if( !el2.classList.contains('product-cart__button--active') ){
					el2.className += " product-cart__button--active";
					params = "action=add2basket&quantity="+qnt+"&id="+element_id;
				}else{
					el2.classList.remove("product-cart__button--active");
					params = "action=delete_basket_item&productid="+element_id;
				}
			});
			
			break;
		case 'add2basket_search':			
			params = "action=add2basket&quantity=1&id="+element_id;
			
			break;
		case 'delete_basket_item':
			params = "action=delete_basket_item&productid="+element_id;
			break;
		case 'COMPARE':			
			var el = document.querySelectorAll("div.product-cart__button--compare[data-id='"+element_id+"']");
			el.forEach(function (el2,index) {
				if( !el2.classList.contains('product-cart__button--active') ){
					el2.className += " product-cart__button--active";
					action_name = "compfav";
				}else{
					el2.classList.remove("product-cart__button--active");
					action_name = "compfavdelete";
				}
			});
			
			params = "action="+action_name+"&add=COMPARE&id="+element_id;

			break;
		case 'FAVORITES':
			var el = document.querySelectorAll("div.product-cart__button--favorite[data-id='"+element_id+"']");
			el.forEach(function (el2,index) {
				if( !el2.classList.contains('product-cart__button--active') ){
					el2.className += " product-cart__button--active";
					action_name = "compfav";
				}else{
					el2.classList.remove("product-cart__button--active");
					action_name = "compfavdelete";
				}
			});
			
			params = "action="+action_name+"&add=FAVORITES&id="+element_id;
			
			break;
		case 'compfavdelete':
			params = "action=compfavdelete&add="+action+"&id="+element_id;
			
			break;
		default:
			return false;
			break;
	}
	
	
	
	var request = new XMLHttpRequest();
    request.open('POST', '/local/templates/stroygip/ajax/ajax.php', true);
	request.onreadystatechange = function() {
		if (request.readyState == 4 && request.status == 200) {
			var obj = JSON.parse(request.responseText);
			if( action == "COMPARE" ){
				var compContainer = document.querySelector('.header__button--compare');
				compContainer.querySelector('.header__user-button-count').innerHTML = obj["COMP"];
			}else if( action == "FAVORITES" ){
				var favContainer = document.querySelector('.header__button--favorits');
				favContainer.querySelector('.header__user-button-count').innerHTML = obj["FAV"];
			}else if( action == "add2basket" || action == "add2basket_search" ){
				document.querySelector('.top-basket-count').innerHTML = request.responseText;
				document.querySelector('.mobile-header__basket-count').innerHTML = request.responseText;
			}else if( action == "delete_basket_item" ){
				var bsk_element = document.getElementById('basket_'+element_id+'_item');
				bsk_element.remove();
				
				basketRefresh();
			}
		}
	}
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.send(params);

}


function basketUpdate(basket_id, change) {
	var params = "";
	var qnt =  parseInt( document.getElementById('basket_'+basket_id+'_qnt').innerHTML );
	var qnt_max =  parseInt( document.getElementById('basket_'+basket_id+'_qnt').getAttribute("data-maxqnt") );
	if( change == "minus" ){
		qnt = qnt-1;
	}else{
		qnt = qnt+1;
	}
	
	if( qnt > 0 && qnt <= qnt_max ){
		params = "action=updatebasket&id="+basket_id+"&quantity="+qnt;
		
		var request = new XMLHttpRequest();
		request.open('POST', '/local/templates/stroygip/ajax/ajax.php', true);
		request.onreadystatechange = function() {
			if (request.readyState == 4 && request.status == 200) {
				var obj = JSON.parse(request.responseText);
				
				basketRefresh();
				console.log(request.responseText);
			}
		}
		request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		request.send(params);
		
	}
}


function basketRefresh() {	
	var request = new XMLHttpRequest();
	request.open('GET', '/local/templates/stroygip/ajax/basketupdate.php', true);
	request.onreadystatechange = function() {
		if (request.readyState == 4 && request.status == 200) {
			var resp = request.responseText;
			var temp1 = document.createElement('div');
			temp1.innerHTML = resp;
			var basket_html = temp1.getElementsByClassName("basket")[0].innerHTML;
		
			document.getElementById("basket_ajax_template").innerHTML = basket_html;
		}
	}
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.send();		
}


function dataShowMore() {
	var url = "";
	var url_pathname = window.location.pathname;
	var url_params = window.location.search;
	
    var page = document.getElementById('catalogSectionShowMore').getAttribute("data-next-page");
    var id = document.getElementById('catalogSectionShowMore').getAttribute("data-show-more-catalog");
    var bx_ajax_id = document.getElementById('catalogSectionShowMore').getAttribute("data-ajax-id");
    var block_id = "#comp_"+bx_ajax_id;
	
	url = url_pathname + "?bxajaxid="+bx_ajax_id+"&PAGEN_"+id+"="+page;
	if( url_params.length > 0 ){
		url = url_pathname + url_params + "&bxajaxid="+bx_ajax_id+"&PAGEN_"+id+"="+page;
	}
	
	var request = new XMLHttpRequest();
    request.open('GET', url, true);
	request.onreadystatechange = function() {
		if (request.readyState == 4 && request.status == 200) {			
			var resp = request.responseText;
			
			var temp1 = document.createElement('div');
			temp1.innerHTML = resp;
			var items_html = temp1.getElementsByClassName("catalog-category__items-grid")[0].innerHTML;
			
			var d1 = document.querySelector('div.catalog-category__items-grid');
			d1.insertAdjacentHTML('beforeend', items_html);

			var temp2 = document.createElement('div');
			temp2.innerHTML = resp;
			var pagination_html = temp2.getElementsByClassName("catalog-category__items-footer")[0].innerHTML;
			
			var d2 = document.querySelector('div.catalog-category__items-footer');
			d2.innerHTML = pagination_html;
		}
	}
	request.send();

}


function orderHelpCall() {
	var user_name = document.getElementById('ohf_name').value;
	var user_contact = document.getElementById('ohf_mailphone').value;
		
	if( user_name.length <= 0 || user_contact.length <= 0 ){
		console.log('empty fields');
	}else{
		var params = "name="+user_name+"&mail_phone="+user_contact;
		
		var request = new XMLHttpRequest();
		request.open('POST', '/local/public/call_me2.php', true);
		request.onreadystatechange = function() {
			if (request.readyState == 4 && request.status == 200) {
				//console.log(request.responseText);
				document.getElementById('ohf_name').value = '';
				document.getElementById('ohf_mailphone').value = '';
			}
		}
		request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		request.send(params);
	}
}
	


function buttonFastOrder(element_id) {	
	var user_name = document.getElementById('input_fo_name').value;
	var user_contact = document.getElementById('input_fo_phone').value;
		
	if( user_name.length <= 0 || user_contact.length <= 0 ){
		console.log('empty fields');
	}else{
		var params = "formId=fast_order&name="+user_name+"&phone="+user_contact+"&productId="+element_id+"&_protect=XJuQ52GmKW&ajax=Y"+"&sessid="+app.sessid;
		
		var request = new XMLHttpRequest();
		request.open('POST', '/local/public/fast_order.php', true);
		request.onreadystatechange = function() {
			if (request.readyState == 4 && request.status == 200) {
				//console.log(request.responseText);
				document.getElementById('input_fo_name').value = '';
				document.getElementById('input_fo_phone').value = '';
				modals.close('fastOrderModal');
			}
		}
		request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		request.send(params);
	}
}



function buttonSendReview(element_id) {	
	var user_name = document.getElementById('input_rv_name').value;
	var user_contact = document.getElementById('input_rv_contact').value;
	var user_text = document.getElementById('input_rv_text').value;
	var user_raiting = parseInt( document.getElementById('input_rv_stars').value )+1;
	
	if( user_name.length <= 0 || user_contact.length <= 0 ){
		console.log('empty fields');
	}else{
		let formData = {
			formId: 'product_review',
			_protect: 'XJuQ52GmKW',
			productId: element_id,
			name: user_name,
			email: user_contact,
			text: user_text,
			raiting: user_raiting,
		};

		BX.ajax.runComponentAction('nav:form', 'submit', {
			mode: 'class',
			data: formData,
		}).then(response => {
			if (!response.data) {
				alert('Произошла ошибка, попробуйте ещё раз');
				return;
			}

			if (response.data.status !== 'ok') {
				alert(response.data.error);
				return;
			}

			document.getElementById('input_rv_name').value = '';
			document.getElementById('input_rv_contact').value = '';
			document.getElementById('input_rv_text').value = '';
			
			var el = document.querySelector("div.product-review-form-success");
			el.innerHTML = "Спасибо за отзыв! Мы проверим его и обязательно опубликуем.";

		});
	}
}


function personalFLUpdate() {
	var user_name = document.getElementById('user_fl_name').value;
	var user_phone = document.getElementById('user_fl_phone').value;
	var user_address = document.getElementById('user_fl_address').value;
	
	if( user_name.length <= 0 || user_phone.length <= 0 ){
		console.log('empty fields');
	}else{
		var params = "action=update_data&NAME="+user_name+"&PERSONAL_PHONE="+user_phone+"&PERSONAL_NOTES="+user_address;
		
		var request = new XMLHttpRequest();
		request.open('POST', '/local/templates/stroygip/ajax/personal_data_update.php', true);
		request.onreadystatechange = function() {
			if (request.readyState == 4 && request.status == 200) {
				//console.log(request.responseText);
				document.location.reload();
			}
		}
		request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		request.send(params);
	}
}



function personalORGUpdate() {
	var org_id = document.getElementById('user_org_id').value;
	var org_name = document.getElementById('user_org_name').value;
	var org_iin = document.getElementById('user_org_iin').value;
	var org_address = document.getElementById('user_org_address').value;
	
	if( org_name.length <= 0 || org_iin.length <= 0 ){
		console.log('empty fields');
	}else{
		var params = "action=update_org_data&NAME="+org_name+"&IIN="+org_iin+"&ADDRESS="+org_address+"&id="+org_id;
		
		var request = new XMLHttpRequest();
		request.open('POST', '/local/templates/stroygip/ajax/personal_data_update.php', true);
		request.onreadystatechange = function() {
			if (request.readyState == 4 && request.status == 200) {
				document.location.reload();
			}
		}
		request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		request.send(params);
	}
}


function addEstimate() {
	var params = "";
	var element_id = "";
	var element_qnt = "";
	params = "action=estimate_add";
	
	var el = document.querySelectorAll("div.basket__products-item-desc-del");
	el.forEach(function (el1,index) {
		element_id = el1.getAttribute("data-productid");
		params += "&productid["+index+"]="+element_id;
	});
	
	var el_qnt = document.querySelectorAll("div.basket__products-item-desc-count-value");
	el_qnt.forEach(function (el2,index2) {
		element_qnt = el2.innerHTML;
		params += "&quantity["+index2+"]="+element_qnt;
	});
	
	var request = new XMLHttpRequest();
	request.open('POST', '/local/templates/stroygip/ajax/personal_data_update.php', true);
	request.onreadystatechange = function() {
		if (request.readyState == 4 && request.status == 200) {
			document.querySelector('.user_save_estimate').innerHTML = 'Сохранено';
		}
	}
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.send(params);
}


function fc_basket_add(element_id) {
	var params = "";	
	params = "action=add2basket&quantity=1&id="+element_id;
	
	var request = new XMLHttpRequest();
    request.open('POST', '/local/templates/stroygip/ajax/ajax.php', true);
	request.onreadystatechange = function() {
		if (request.readyState == 4 && request.status == 200) {
			var obj = JSON.parse(request.responseText);

			document.querySelector('.top-basket-count').innerHTML = request.responseText;
			document.querySelector('.mobile-header__basket-count').innerHTML = request.responseText;
			
			document.querySelector("div.compare__slider-item-button[data-id='"+element_id+"']").innerHTML = 'В корзине';
		}
	}
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.send(params);
}


function fc_product_del(action, element_id) {
	var params = "";	
	params = "action=compfavdelete&add="+action+"&id="+element_id;
	
	var request = new XMLHttpRequest();
    request.open('POST', '/local/templates/stroygip/ajax/ajax.php', true);
	request.onreadystatechange = function() {
		if (request.readyState == 4 && request.status == 200) {
			var obj = JSON.parse(request.responseText);
			if( action == "COMPARE" ){
				var compContainer = document.querySelector('.header__button--compare');
				compContainer.querySelector('.header__user-button-count').innerHTML = obj["COMP"];
				
				var cmp_element = document.querySelector('.compare_'+element_id+'_item');
				cmp_element.remove();
			}
			/*else if( action == "FAVORITES" ){
				var favContainer = document.querySelector('.header__button--favorits');
				favContainer.querySelector('.header__user-button-count').innerHTML = obj["FAV"];
			}*/
		}
	}
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.send(params);
}


function clearCompare(ids) {
	var params = "";	
	params = "action=clearCompare&id="+ids;
	
	var request = new XMLHttpRequest();
    request.open('POST', '/local/templates/stroygip/ajax/ajax.php', true);
	request.onreadystatechange = function() {
		if (request.readyState == 4 && request.status == 200) {
			location.href = '/compare/';
		}
	}
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.send(params);
}


const menu_buttons = document.querySelectorAll("div[data-url]");
menu_buttons.forEach(function (el2,index) {
	var foo = "foo_"+el2.getAttribute("data-url");
	var bar = el2.getAttribute("data-url");
	el2.addEventListener('click', event => {		
		window.history.pushState(null, null, el2.getAttribute("data-url"));
		//BX.ajax.history.put(null, el2.getAttribute("data-url"));
	});
});

window.onpopstate = function(event) {    
    if(event.state == null) {
        location.reload(); 
    }
}


document.addEventListener("DOMContentLoaded", function(){
	const search_input = document.querySelectorAll("div.search-hints__hints-results-row-del");
	search_input.forEach(function (el2,index) {
		
		el2.addEventListener('click', event => {
			var sd1 = el2.previousSibling;
			var sd2 = sd1.previousSibling.innerText;
			
			clearSearchHistory(sd2);
			sd1.parentElement.style.display = "none";
		});
		
	});
	
});

document.addEventListener('click',function(e){	
    if( e.target && e.target.parentNode.classList[0] == 'search-hints__product-desc-control-buy' ){
		var product_id = e.target.parentNode.getAttribute("data-product-id");
		
		catalogAction('add2basket_search', product_id);
    }
});
 
function clearSearchHistory(val1) {
	var params = "";	
	params = "action=clearValue&param1="+val1;
	
	var request = new XMLHttpRequest();
    request.open('POST', '/local/templates/stroygip/ajax/search.php', true);
	request.onreadystatechange = function() {
		if (request.readyState == 4 && request.status == 200) {
			console.log(request.responseText);
		}
	}
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.send(params);
}


var search_input = document.getElementById("headerSearchInput");
search_input.addEventListener("keyup", function(event) {
	if (event.keyCode === 13) {
		event.preventDefault();
		if( (search_input.value).length >= 3 ){
			window.location.href = "/catalog/index.php?q="+search_input.value;
		}
	}
});



/*
window.addEventListener('popstate',()=>{
    window.dispatchEvent(new Event('locationchange'))
});
*/


/*
function ajaxUpdate(){
    $.get( "/local/templates/stroygip/ajax/basketupdate.php", function( data ) {
        $('#basket').html(data);
        BX.onCustomEvent('OnBasketChange');
    });
}
function UpdateFavComp() {
    $.ajax({
        url: "/local/templates/stroygip/ajax/basket.php",
        type: "POST",
        dataType: 'json',
        data: {action:'countfavcomp'},
        success: function (data) {

            $('.dds_fav_count').html(data.TEXT);
            $('.dds_fav_quan').attr('data-quantity',data.FAV);
        }
    });
}

const debounce = (func, wait) => {
    let timeout;

    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };

        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
};

$(document).on('click', '[data-show-more]', function(){
    var btn = $(this);
    var page = btn.attr('data-next-page');
    var id = btn.attr('data-show-more');
    var bx_ajax_id = btn.attr('data-ajax-id');
    var block_id = "#comp_"+bx_ajax_id;

    var data = {
        bxajaxid:bx_ajax_id
    };
    data['PAGEN_'+id] = page;

    $.ajax({
        type: "GET",
        url: window.location.href,
        data: data,
        success: function(data) {
            //delete old html
            $("#btn_"+bx_ajax_id).remove();

            if(btn.parent().hasClass('news__button-all')){
                $('.news__pagination').remove();

                let items = $(data).find('.news__item');
                let button = $(data).find($("#btn_"+bx_ajax_id));
                let pagen = $(data).find('.news__pagination');

                $('.news__grid').append(items);
                $('.news__grid').after(button);

                if(button.length>0) {
                    $("#btn_"+bx_ajax_id).after(pagen);
                } else {
                    $('.news__grid').after(pagen);
                }
            }

            if(btn.parent().hasClass('stock__button-all')){
                $('.stock__pagination').remove();

                let items = $(data).find('.stock__item');
                let button = $(data).find($("#btn_"+bx_ajax_id));
                let pagen = $(data).find('.stock__pagination');

                $('.stock__grid').append(items);
                $('.stock__grid').after(button);

                if(button.length>0) {
                    $("#btn_"+bx_ajax_id).after(pagen);
                } else {
                    $('.stock__grid').after(pagen);
                }
            }

            if(btn.parent().hasClass('vacancies__button-all')){
                $('.vacancies__pagination').remove();

                let items = $(data).find('.vacancies__item');
                let button = $(data).find($("#btn_"+bx_ajax_id));
                let pagen = $(data).find('.vacancies__pagination');

                $('.vacancies__grid').append(items);
                $('.vacancies__grid').after(button);

                if(button.length>0) {
                    $("#btn_"+bx_ajax_id).after(pagen);
                } else {
                    $('.vacancies__grid').after(pagen);
                }
            }

        }
    });
});
$(document).on('click', '[data-show-more-catalog]', function(){
    var btn = $(this);
    var page = btn.attr('data-next-page');
    var id = btn.attr('data-show-more-catalog');
    var bx_ajax_id = btn.attr('data-ajax-id');
    var block_id = "#comp_"+bx_ajax_id;

    var data = {
        bxajaxid:bx_ajax_id
    };
    data['PAGEN_'+id] = page;

    $.ajax({
        type: "GET",
        url: window.location.href,
        data: data,
        dataType: 'html',
        timeout: 3000,
        success: function(data) {
            $("#btn_"+bx_ajax_id).html($(data).find("#btn_"+bx_ajax_id).html());
            $(block_id).find('.catalog-category__products-grid').append($(data).find('.catalog-category__products-grid').html());
        }
    });
});
let ajaxaction;
$(document).on('click change submit','[data-action]',function(e){
    var action = $(this).attr('data-action');
    var $this = $(this);
    var data = {};
    data['action'] = action;

    switch (e.type){
        case 'click':
            switch (action){
                case 'add2basket':
                    var id = $this.attr('data-id');
                    data['id'] = id;
                    data['quantity'] = $('.ddsQuantity').val();
					
					if( !$(this).hasClass("product-cart__button--active") ){
						$(this).addClass('product-cart__button--active');
					}
					
					if( $('.imp-item-quantity-value[data-id="'+ id +'"]').length  ){
						data['quantity'] = parseInt( $('.imp-item-quantity-value[data-id="'+ id +'"]').html() );
					}
					
                    break;

                case 'delete':
                    data['id'] = $this.attr('data-id');
					data['productid'] = $this.attr('data-productid');
                    break;
                case 'compfav':
                    data['id'] = $this.attr('data-id');
                    data['add'] = $this.attr('data-add');
					
					if( !$(this).hasClass("product-cart__button--active") ){
						$(this).addClass('product-cart__button--active');
						
						var compare_num = parseInt( $('.header__button--compare .header__user-button-count').html() );
						var favorite_num = parseInt( $('.header__button--favorits .header__user-button-count').html() );
						
						if( $this.attr('data-add') == "COMPARE" ){
							$('.header__button--compare .header__user-button-count').html( compare_num + 1 );
						}else if( $this.attr('data-add') == "FAVORITES" ){
							$('.header__button--favorits .header__user-button-count').html( favorite_num + 1 );
						}
					}
					

                    break;
                case 'compfavdelete':
                    data['id'] = $this.attr('data-id');
                    data['add'] = $this.attr('data-add');
                    break;
                case 'clearCompare':
                    data['id'] = $this.attr('data-id');
                    break;
                case 'setCoupon':
                    data['coupon'] = $('#input-bonuses').val();
                    break;
                default:
                    return false;
                    break;
            }
            break;
        case 'change':
            switch (action){
                case 'updatebasket':
                    data['id'] = $this.attr('data-id');
                    data['quantity'] = $this.val();
                    break;
                default:
                    return false;
                    break;
            }
            break;

        case 'submit':
        default:
            return false;
            break;
            break;
    }
    if(ajaxaction)
        ajaxaction.abort;
    ajaxaction = $.ajax({
        url: "/local/templates/stroygip/ajax/ajax.php",
        type: "POST",
        dataType: 'json',
        data: data,
        success: function (result) {
            switch (action){
                case 'add2basket':
                    //alert('Товар добавлен в корзину');
                    //$this.html('Добавлено');
                    break;
                case 'compfav':
                    $this.attr('data-action','compfavdelete');
                    $this.toggleClass('compfavactive');
                    break;
                case 'compfavdelete':
                    $this.attr('data-action','compfav');
                    $this.toggleClass('compfavactive');
                    let $el = $(e.currentTarget).closest('.catalog-category__item');
                    $el.fadeOut(() => $el.remove());
                    break;
                case 'clearCompare':
                   location.href = '/compare/';
                    break;
                case 'setCoupon':
                    //$.ajax({
                     //   url: "/local/templates/stroygip/ajax/ajax.php",
                     //   type: "POST",
                     //   dataType: 'json',
                     //   data: {action:'getCouponList'},
                     //   success: function (result) {
                     //      console.log(result);
                      //  }
                    //});
                        break;
            }
            ajaxUpdate();
        }
    });
    return false;
});

$(() => {
    $('#ORDER').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: "/local/templates/stroygip/ajax/order.php",
            type: "POST",
            dataType: 'json',
            data: $(this).serialize(),
            success: function (result) {
                if (result.STATUS == "ERROR") {
                    $('.errorcostum').html(result.HTML);
                }
            }
        });
    });

    $('.ddsQuantity').on('change', function () {
        let el = $(this);
        let currency = el.data('currency');
        let price = el.data('price');
        let discount_price = el.data('discount-price');
        let quantity = el.val();
        if(quantity<1) {
            quantity = 1;
        }
        if(price != 'undefined') {
            el.parents('.tqWrap').find('.product-card__price').html((Math.round(discount_price*quantity * 10) / 10) +'<span class="product-card__price-prefix">'+currency+'</span>');
        }
        if(discount_price != 'undefined') {
            el.parents('.tqWrap').find('.product-card__discount').html((Math.round(price*quantity * 10) / 10)+'<span class="product-card__price-prefix">'+currency+'</span>');
        }
    });

    $('select[data-selectmenu]').selectmenu({
        change: (event, ui) => $(event.target).trigger('change'),
    });
});

$(document).on('submit','#personalDataUpdate',function () {;
    $.ajax({
        url: "/local/templates/stroygip/ajax/personal_data_update.php",
        type: "POST",
        data: $(this).serialize(),
        success: function (result) {
            $('#dataUpdated').show();
            $('#dataUpdated').parents('.modal-position').show();
            $('.modal-overlay').show();
        }
    });

    return false;
})

$(document).on('submit','#personalAddressAdd',function () {;
    $.ajax({
        url: "/local/templates/stroygip/ajax/personal_data_update.php",
        type: "POST",
        data: $(this).serialize(),
        success: function (result) {
            $('#dataUpdated').show();
            $('#dataUpdated').parents('.modal-position').show();
            $('.modal-overlay').show();
        }
    });

    return false;
})

$(document).on('click','[data-address]',function () {
    let action = $(this).attr('data-action');
    let id = $(this).attr('data-address');
    $.ajax({
        url: "/local/templates/stroygip/ajax/personal_data_update.php",
        type: "POST",
        data: {action: action, id: id},
        success: function (result) {
            $('#dataUpdated').show();
            $('#dataUpdated').parents('.modal-position').show();
            $('.modal-overlay').show();
            setTimeout(function () {
                location.reload();
            }, 2000);
        }
    });

    return false;
})

$(document).on('click','#buttonRegBasket',function () {
    $('[name=back_url]').val('/order/')
    modalReg.show()
})
$(document).on('click','#buttonReg',function () {
    $('[name=back_url]').val('')
})


function CallPrint(elem) {
    var WinPrint = window.open('','','left=50,top=50,width=800,height=640,toolbar=0,scrollbars=1,status=0');
    var prtCSS = '<link rel="stylesheet" href="/local/templates/stroygip/assets/dist/libs.css" type="text/css" /><link rel="stylesheet" href="/local/templates/stroygip/assets/dist/style.css" type="text/css" /><link rel="stylesheet" href="/local/templates/stroygip/template_styles.css" type="text/css" />';
    WinPrint.document.write('<div class="personal-area__list u-no-transition">');
    WinPrint.document.write(prtCSS);
    WinPrint.document.write(elem.html());
    WinPrint.document.write('</div>');
    WinPrint.document.close();
    WinPrint.focus();
    setTimeout(() => {
        WinPrint.print();
    }, 200);
}

$(document).on('click','.saveEstimate',function () {
    let id = $(this).attr('data-id');
    $.ajax({
        url: "/local/templates/stroygip/ajax/personal_data_update.php",
        type: "POST",
        data: {action: 'estimate_create', order_id: id},
        success: function (result) {

        }
    });
});
//Промокоды
$(document).on('click','#sendPromocode',function () {
    let promocode = $('#input-bonuses').val();
    if(promocode.length >0) {
        $.ajax({
            url: "/local/templates/stroygip/ajax/promocode.php",
            type: "POST",
            dataType:'json',
            data: {promocode: promocode},
            success: function (result) {
                $('.show_messages').removeClass('red');
                if(result.STATUS =='SUCCSESS') {
                  let cur_points = +$('.personal-area__card-scores').text();
                  let promocode_points = +result.POINTS;
                  $('.personal-area__card-scores').text(cur_points+promocode_points);
                } else {
                  $('.show_messages').addClass('red');
                }
                $('.show_messages').text(result.MSG);
            }
        });
    }
    return false;
});

$(document).on('click','#sendPromocode',function () {
    let promocode = $('#input-bonuses').val();
    if(promocode.length >0) {
        $.ajax({
            url: "/local/templates/stroygip/ajax/promocode.php",
            type: "POST",
            dataType:'json',
            data: {promocode: promocode},
            success: function (result) {
                $('.show_messages').removeClass('red');
                if(result.STATUS =='SUCCSESS') {
                    let cur_points = +$('.personal-area__card-scores').text();
                    let promocode_points = +result.POINTS;
                    $('.personal-area__card-scores').text(cur_points+promocode_points);
                } else {
                    $('.show_messages').addClass('red');
                }
                $('.show_messages').text(result.MSG);
            }
        });
    }
    return false;
});
$(document).on('click','.tqTabs',function () {
    let section_id = $(this).data('id');
    $.ajax({
        url: window.location.href,
        type: "POST",
        data: {SECTION_ID:section_id},
        success: function (data) {
            $('.news__content').addClass('news__content--active');
            $('.news__content').html($(data).find('.news__content').html());
        }
    });
});

$(document).on('click','.dds-plus',function () {
    let $input = $('#calculatorSum');
    let step = Math.round(parseFloat($input.attr('data-step')) * 10) / 10;
    $input.val(Math.round(parseFloat(parseFloat($input.val()) + step) * 10) / 10);
    $input.change();
    return false;
});


$(document).on('click','.dds-minus',function () {
    let $input = $('#calculatorSum');
    let step = Math.round(parseFloat($input.attr('data-step')) * 10) / 10;
    let count = parseFloat($input.val()) - step;
    count = count <= 0 ? step : count;
    $input.val(Math.round(parseFloat(count) * 10) / 10);
    $input.change();
    return false;
});

$('.regButton, .js-registration-popup').on('click',function (e) {
    e.preventDefault();

    $(".modal-overlay, .modal-position, .modal-registration-container").show();
    $('.regTab').click();
});

$(document).on('click','.regTab,.authTab',function () {
    let passwordModal = $(".reset-password");
        if(passwordModal.is(":visible")) {
            passwordModal.hide();
        }
    return false;
});

$(() => {
    $('.js-footer-feedback').on('click', (e) => {
        e.preventDefault();

        $('.modal-overlay').show();
        $('.feedback-modal').closest('.modal-position').show();
        $('.feedback-modal').show();
    });

    $('.feedback-modal__button').on('click', function (e) {
        e.preventDefault();
        const $form = $(e.currentTarget).closest('.feedback-modal');

        let formData = {
            formId: 'feedback',
            name: $form.find('[name="name"]').val(),
            phone: $form.find('[name="phone"]').val(),
            email: $form.find('[name="email"]').val(),
            text: $form.find('[name="text"]').val(),
            _protect: 'XJuQ52GmKW',
            ajax: 'Y',
            sessid: app.sessid,
        };

        if (!formData.name) {
            alert('Введите имя');
            return;
        }

        if (!formData.phone) {
            alert('Введите телефон');
            return;
        }

        if (!formData.email) {
            alert('Введите email');
            return;
        }

        if (!formData.text) {
            alert('Введите текст сообщения');
            return;
        }

        $.ajax({
            url: '/local/public/feedback_form.php',
            type: 'post',
            data: formData,
            dataType: 'json',
        }).done((response) => {
            if (response.status === 'error') {
                alert(response.error);
                return;
            }

            $form.find('.feedback-modal__input-box').hide();
            $form.find('.feedback-modal__img-box').hide();
            $form.find('.feedback-modal__title').text('Спасибо!');
        });
    });

    $('input[data-phone-mask]').inputmask({
        'mask': '+\\9\\96 999-999-999'
    });
});


$(document).on('click','#order_help_call ',function () {
    if( $("#order_help_button").hasClass("form-check__button--disabled") ){
		console.log('empty fields');
	}else{
		var user_name = $("#ohf_name").val();
		var user_mail_phone = $("#ohf_mailphone").val();
		
		$.post("/local/public/call_me2.php", {name: user_name, mail_phone: user_mail_phone}, function(data){
			if( data.length > 0 ){
				$("#ohf_name").val("");
				$("#ohf_mailphone").val("");
			}
		});
	}
});
*/
