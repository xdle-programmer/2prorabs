!function (e) {
    var t = {};

    function o(i) {
        if (t[i]) return t[i].exports;
        var a = t[i] = {i: i, l: !1, exports: {}};
        return e[i].call(a.exports, a, a.exports, o), a.l = !0, a.exports;
    }

    o.m = e, o.c = t, o.d = function (e, t, i) {
        o.o(e, t) || Object.defineProperty(e, t, {enumerable: !0, get: i});
    }, o.r = function (e) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {value: "Module"}), Object.defineProperty(e, "__esModule", {value: !0});
    }, o.t = function (e, t) {
        if (1 & t && (e = o(e)), 8 & t) return e;
        if (4 & t && "object" == typeof e && e && e.__esModule) return e;
        var i = Object.create(null);
        if (o.r(i), Object.defineProperty(i, "default", {enumerable: !0, value: e}), 2 & t && "string" != typeof e) for (var a in e) o.d(i, a, function (t) {
            return e[t];
        }.bind(null, a));
        return i;
    }, o.n = function (e) {
        var t = e && e.__esModule ? function () {
            return e.default;
        } : function () {
            return e;
        };
        return o.d(t, "a", t), t;
    }, o.o = function (e, t) {
        return Object.prototype.hasOwnProperty.call(e, t);
    }, o.p = "", o(o.s = 12);
}([, , , , , , , , , , , , function (e, t, o) {
    o(13), o(14), o(15), o(16), o(17), o(18), o(19), o(20), o(21), o(22), o(23), o(24), o(25), o(26), o(27), o(28), o(29), o(30), o(31), o(32), o(33), o(34), o(35), o(36), o(37), o(38), o(39), o(40), o(41), o(42), o(43), o(44), o(45), o(46), o(47), o(48), o(49), o(50), o(51), o(52), o(53), o(54), o(55), o(56), o(57), o(58), o(59), o(60), o(61), o(62), o(63), o(64), o(65), o(66), o(67), o(68), o(69), o(70), e.exports = o(71);
}, function (e, t) {
    $((function () {
        $(".items-owl-carousel").owlCarousel({dots: !1, nav: !0, arrows: !0, navText: ["", ""], loop: !1, singleItem: !0, items: 1});
    })), $((function () {
        $("#selectArea").selectmenu();
    }));
}, function (e, t) {
    $("#minusSum").click((function () {
        var e = $("#calculatorSum"), t = parseInt(e.val()) - 1;
        return t = t < 1 ? 1 : t, e.val(t), e.change(), !1;
    })), $("#plusSum").click((function () {
        var e = $("#calculatorSum");
        return e.val(parseInt(e.val()) + 1), e.change(), !1;
    }));
}, function (e, t) {
    // Start styled inputs
    $(".basket-products__registration-input").focus(function () {
        $(this).siblings(".basket-products__registration-label").addClass("basket-products__registration-label-color");
    });

    $(".basket-products__registration-input").blur(function (e) {
        if ($(this).val().length > 0 || $(e.currentTarget).attr('placeholder')) {
            $(this).siblings(".basket-products__registration-label").removeClass("basket-products__registration-label-color");
            $(this).siblings(".basket-products__registration-label").addClass("basket-products__registration-label-active");
        } else {
            $(this).siblings(".basket-products__registration-label").removeClass("basket-products__registration-label-color");
            $(this).siblings(".basket-products__registration-label").removeClass("basket-products__registration-label-active");
        }
    });
    // End styled inputs

    // select tabs
    $('.basket-products__delivery-buttons').on('click', '.basket-products__delivery-button:not(.basket-products__delivery-button--active)', function() {
        $(this)
            .addClass('basket-products__delivery-button--active').siblings().removeClass('basket-products__delivery-button--active')
            .closest('.basket-products__container-tabs').find('.basket-products__content').removeClass('basket-products__content--active').eq($(this).index()).addClass('basket-products__content--active');
    });
    // end select tabs

    // close warning
    $('.basket-products__warning-close').click(function (){
        $('.basket-products__warning').hide(200);
    })
    // end close warning

    // combobox
    $( function() {
        $.widget( "custom.combobox", {
            _create: function() {
                this.wrapper = $( "<span>" )
                    .addClass( "custom-combobox" )
                    .insertAfter( this.element );

                this.element.hide();
                this._createAutocomplete();
                // this._createShowAllButton();
            },

            _createAutocomplete: function() {
                var selected = this.element.children( ":selected" ),
                    value = selected.val() ? selected.text() : "";

                this.input = $( "<input>" )
                    .appendTo( this.wrapper )
                    .val( value )
                    .attr( "title", "" )
                    .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
                    .autocomplete({
                        delay: 0,
                        minLength: 0,
                        source: $.proxy( this, "_source" )
                    })
                    .tooltip({
                        classes: {
                            "ui-tooltip": "ui-state-highlight"
                        }
                    });

                this._on( this.input, {
                    autocompleteselect: function( event, ui ) {
                        ui.item.option.selected = true;
                        this._trigger( "select", event, {
                            item: ui.item.option
                        });
                    },

                    autocompletechange: "_removeIfInvalid"
                });
            },

            // _createShowAllButton: function() {
            //     var input = this.input,
            //         wasOpen = false;
            //
            //     $( "<a>" )
            //         .attr( "tabIndex", -1 )
            //         .attr( "title", "Show All Items" )
            //         .tooltip()
            //         .appendTo( this.wrapper )
            //         .button({
            //             icons: {
            //                 primary: "ui-icon-triangle-1-s"
            //             },
            //             text: false
            //         })
            //         .removeClass( "ui-corner-all" )
            //         .addClass( "custom-combobox-toggle ui-corner-right" )
            //         .on( "mousedown", function() {
            //             wasOpen = input.autocomplete( "widget" ).is( ":visible" );
            //         })
            //         .on( "click", function() {
            //             input.trigger( "focus" );
            //
            //             // Close if already visible
            //             if ( wasOpen ) {
            //                 return;
            //             }
            //
            //             // Pass empty string as value to search for, displaying all results
            //             input.autocomplete( "search", "" );
            //         });
            // },

            _source: function( request, response ) {
                var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
                response( this.element.children( "option" ).map(function() {
                    var text = $( this ).text();
                    if ( this.value && ( !request.term || matcher.test(text) ) )
                        return {
                            label: text,
                            value: text,
                            option: this
                        };
                }) );
            },

            _removeIfInvalid: function( event, ui ) {

                // Selected an item, nothing to do
                if ( ui.item ) {
                    return;
                }

                // Search for a match (case-insensitive)
                var value = this.input.val(),
                    valueLowerCase = value.toLowerCase(),
                    valid = false;
                this.element.children( "option" ).each(function() {
                    if ( $( this ).text().toLowerCase() === valueLowerCase ) {
                        this.selected = valid = true;
                        return false;
                    }
                });

                // Found a match, nothing to do
                if ( valid ) {
                    return;
                }

                // Remove invalid value
                this.input
                    .val( "" )
                    .attr( "title", value + " город не найден" )
                    .tooltip( "open" );
                this.element.val( "" );
                this._delay(function() {
                    this.input.tooltip( "close" ).attr( "title", "" );
                }, 2500 );
                this.input.autocomplete( "instance" ).term = "";
            },

            _destroy: function() {
                this.wrapper.remove();
                this.element.show();
            }
        });

        $( "#combobox" ).combobox();
        $( "#toggle" ).on( "click", function() {
            $( "#combobox" ).toggle();
        });
    } );
}, function (e, t) {
    var o, i, a, n;
    o = $(".benefit__carousel"), i = o.find(".buy-item__grid-benefit"), a = o.find(".buy-item"), n = {
        dots: !1,
        nav: !0,
        arrows: !0,
        navText: ["", ""],
        loop: false,
        singleItem: !0,
        items: 1
    }, o.owlCarousel(n);
}, function (e, t) {
    var o, i, a, n;
    o = $(".best-price__carousel"), i = o.find(".best-price__carousel-box"), a = o.find(".best-price__item"), n = {
        dots: !1,
        nav: !0,
        arrows: !0,
        navText: ["", ""],
        loop: false,
        singleItem: !0,
        items: 1
    }, o.owlCarousel(n);

    // if (viewportWidth < mobileWidthSmall) {
    //
    // }

}, function (e, t) {
    $(".best-product__carousel").owlCarousel({
        dots: !1,
        nav: !0,
        arrows: !0,
        navText: ["", ""],
        loop: !0,
        center: !0,
        autoWidth: !0,
        items: 6,
        margin: 16,
        responsive: {766: {center: !0, items: 3, margin: 10}}
    });
}, function (e, t) {
    var o, i, a, n;
    o = $(".bestsellers__carousel"), i = $(".best-price__grid-bestprice"), a = $(".best-price__grid-bestprice").find(".buy-item"), n = {
        dots: !1,
        nav: !0,
        arrows: !0,
        navText: ["", ""],
        loop: !0,
        singleItem: !0,
        items: 1
        // }, viewportWidth < mobileWidthSmall ? (a.detach().appendTo(o), o.owlCarousel(n)) : o.owlCarousel(n);
    }, o.owlCarousel(n);
}, function (e, t) {
    $(document).ready((function () {
        $(".catalog-category__category-name").click((function () {
            $(this).toggleClass("catalog-category__category-name--active").next().slideToggle(100);
        })), $(".catalog-category__see-all").click((function () {
            $(this).toggleClass("catalog-category__see-all--active").prev($(".catalog-category__box-hidden")).slideToggle(100);
        })), $(".catalog-category__range-input").keypress((function () {
            $(this).val().length >= 0 && $(".catalog-category__range-reset").show();
        })), $(".catalog-category__range-input").keyup((function () {
            $(this).val().length <= 0 && $(".catalog-category__range-reset").hide();
        })), $(".catalog-category__range-reset").click((function () {
            $(".catalog-category__range-input").val("").change();
        })), $(".catalog-category__button-filter").click((function () {
            $(".catalog-category__bar").show();
        })), $(".catalog-category__close").click((function () {
            $(".catalog-category__bar").hide();
        })), $((function () {
            $("#slider-range").slider({
                range: !0, min: 0, max: 500, values: [75, 300], slide: function (e, t) {
                    $("#amount").val("$" + t.values[0] + " - $" + t.values[1]);
                }
            }), $("#amount").val("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));
        })), $((function () {
            $("#select1, #select2").selectmenu();
        }));
    }));
}, function (e, t) {


    if ($(window).width() < 1280) {
        var activeClass = 'mobile-open';

        $('.catalog-menu__item-button').on('click', function () {
            var $currentMenu = $(this).closest('.catalog-menu__item').find('.catalog-menu__submenu');
            var $currentButton = $(this).closest('.catalog-menu__item').find('.catalog-menu__item-button');
            if ($currentMenu.hasClass(activeClass)) {
                $('.catalog-menu__submenu').slideUp(300);
                $('.catalog-menu__submenu').removeClass(activeClass);
                $('.catalog-menu__item-button').removeClass(activeClass);
            } else {
                $('.catalog-menu__submenu').slideUp(300);
                $currentMenu.slideDown(300);
                $currentMenu.addClass(activeClass);
                $currentButton.addClass(activeClass);
            }

        });
    }


    var o;
    window.catalogMenu = new menu({
        name: "catalogMenu",
        button: ".catalog__button, .burger-menu",
        buttonActiveClass: "catalog__button--open",
        menuBlock: ".catalog-menu",
        menuActiveClass: "catalog-menu--open",
        background: ".overlay",
        backgroundActiveClass: "overlay--active"
    }), o = $(".catalog-menu__item"), viewportWidth > mobileWidth && (o.on("mouseenter", (function () {
        o.removeClass("catalog-menu__item--open"), $(this).addClass("catalog-menu__item--open");
    })), $(document).on("change_menu", (function (e, t) {
        "catalogMenu" === t && (o.removeClass("catalog-menu__item--open"), o.eq(0).addClass("catalog-menu__item--open"));
    })));
}, function (e, t) {
    $(document).ready((function () {
        $(".choice-buyers__carousel").owlCarousel({dots: !1, nav: !0, arrows: !0, navText: ["", ""], loop: !0, singleItem: !0, items: 1});
    }));
}, function (e, t) {
    $(".clearance-problem__input").focus((function () {
        $(this).siblings(".clearance-problem__label").addClass("clearance-problem__label-color");
    })), $(".clearance-problem__input").blur((function () {
        $(this).val().length >= 1 ? ($(this).siblings(".clearance-problem__label").removeClass("clearance-problem__label-color"), $(this).siblings(".clearance-problem__label").addClass("clearance-problem__label-active")) : ($(this).siblings(".clearance-problem__label").removeClass("clearance-problem__label-color"), $(this).siblings(".clearance-problem__label").removeClass("clearance-problem__label-active"));
    }));
}, function (e, t) {
    $((function () {
        $(".cooperation__tabs").on("click", ".cooperation__button:not(.active)", (function () {
            $(this).addClass("active").siblings().removeClass("active").closest(".cooperation__box").find(".cooperation__content").removeClass("active").eq($(this).index()).addClass("active");
        }));
    }));
}, function (e, t) {
}, function (e, t) {
    setInterval((function () {
        !function () {
            var e = new Date("10 December 2020 16:30:00 GMT+06:00");
            e = Date.parse(e) / 1e3;
            var t = new Date, o = e - (t = Date.parse(t) / 1e3), i = Math.floor(o / 86400), a = Math.floor((o - 86400 * i) / 3600), n = Math.floor((o - 86400 * i - 3600 * a) / 60),
                l = Math.floor(o - 86400 * i - 3600 * a - 60 * n);
            a < "10" && (a = "0" + a), n < "10" && (n = "0" + n), l < "10" && (l = "0" + l), $("#days").html(i), $("#hours").html(a), $("#minutes").html(n), $("#seconds").html(l);
        }();
    }), 1e3);
}, function (e, t) {
}, function (e, t) {
}, function (e, t) {
    var o, i, a, n = $(".favorites__carousel-items"), l = $(".favorites__carousel-item"), s = $(".favorites__characteristics-row");
    a = viewportWidth < mobileWidthSmall ? 0 : 40, n.owlCarousel({
        loop: !1,
        nav: !0,
        responsive: {0: {items: 1, margin: a}, 767: {items: 2, margin: a}, 1024: {items: 3, margin: a}},
        onInitialized: function (e) {
            o = e.item.count, i = l.width() + a, s.css("min-width", o * i + "px"), s.css("max-width", o * i + "px"), $(".favorites__characteristics-box").css("width", i + "px");
        },
        onChanged: function (e) {
            var t = e.item.index, o = -i * t + "px";
            s.css("transform", "translateX(" + o + ")");
        }
    });
}, function (e, t) {
    $((function () {
        $(".feedback-area__input").focus((function () {
            $(this).siblings(".feedback-area__label").addClass("feedback-area__label-color");
        })), $(".feedback-area__input").blur((function () {
            $(this).val().length >= 1 ? ($(this).siblings(".feedback-area__label").removeClass("feedback-area__label-color"), $(this).siblings(".feedback-area__label").addClass("feedback-area__label-active")) : ($(this).siblings(".feedback-area__label").removeClass("feedback-area__label-color"), $(this).siblings(".feedback-area__label").removeClass("feedback-area__label-active"));
        }));
    }));
}, function (e, t) {
    function o(e, t, o) {
        return t in e ? Object.defineProperty(e, t, {value: o, enumerable: !0, configurable: !0, writable: !0}) : e[t] = o, e;
    }

    $((function () {
        var e;
        $(".find-us__carousel").owlCarousel((o(e = {
            items: 3,
            merge: !0,
            loop: !0,
            video: !0,
            lazyLoad: !0,
            dots: !0,
            center: !0,
            autoWidth: !0
        }, "autoWidth", !0), o(e, "responsive", {1201: {items: 3}, 576: {items: 1}}), e));
    }));
}, function (e, t) {
}, function (e, t) {
    $(document).ready((function () {
        $(".happy-help__carousel").owlCarousel({
            dots: !1,
            nav: !0,
            arrows: !0,
            navText: ["", ""],
            loop: !0,
            singleItem: !0,
            items: 4,
            margin: 64,
            responsive: {1276: {margin: 64}, 1023: {items: 3}, 767: {items: 2}, 300: {margin: 30, items: 1}}
        });
    }));
}, function (e, t) {
    // var o, i, a;
    // o = $(".header"), i = o.outerHeight(), a = $(".scroll-panel"), function e() {
    //     var t = $("body, html").scrollTop();
    //     t > i ? (a.addClass("scroll-panel--scroll"), t = i) : (a.removeClass("scroll-panel--scroll"), t = $("body").scrollTop()), a.css("transform", "translateY(" + -t + "px)"), o.css("transform", "translateY(" + -t + "px)"), requestAnimationFrame(e);
    // }();
}, function (e, t) {
}, function (e, t) {
    $(".input-styled__input").focus((function () {
        $(this).siblings(".input-styled__label").addClass("input-styled__label-color");
    })), $(".input-styled__input").blur((function () {
        $(this).val().length >= 1 ? ($(this).siblings(".input-styled__label").removeClass("input-styled__label-color"), $(this).siblings(".input-styled__label").addClass("input-styled__label-active")) : ($(this).siblings(".input-styled__label").removeClass("input-styled__label-color"), $(this).siblings(".input-styled__label").removeClass("input-styled__label-active"));
    }));
}, function (e, t, o) {
    "use strict";
    !function (e, t, o, i) {
        e(".inside__inputfile").each((function () {
            var t = e(this), o = t.next("label"), i = o.html();
            t.on("change", (function (t) {
                var a = "";
                this.files && this.files.length > 1 ? a = (this.getAttribute("data-multiple-caption") || "").replace("{count}", this.files.length) : t.target.value && (a = t.target.value.split("\\").pop(), e(".inside__inputfile-delete").addClass("inside__inputfile-delete--active"), e(".inside__file-block").addClass("inside__file-block--active")), a ? o.find("span").html(a) : (o.html(i), e(".inside__inputfile-delete").removeClass("inside__inputfile-delete--active"), e(".inside__file-block").removeClass("inside__file-block--active"));
            })), t.on("focus", (function () {
                t.addClass("has-focus");
            })).on("blur", (function () {
                t.removeClass("has-focus");
            }));
        }));
    }(jQuery, window, document), $(".inside__inputfile-delete").click((function () {
        $(".inside__inputfile").val("").change();
    }));
}, function (e, t) {
}, function (e, t) {
    $(document).ready((function () {
        $(".main-owl-carousel").owlCarousel({dots: !0, nav: !0, arrows: !0, autoplay: sliderOptions.autoplay, navText: ["", ""], loop: sliderOptions.loop, singleItem: !0, items: 1,autoplayTimeout:sliderOptions.autoplayTimeout});
    }));
}, function (e, t) {
    $(".main-product-carousel").owlCarousel({dots: !0, nav: !0, arrows: !0, navText: ["", ""], loop: !1, singleItem: !0, items: 1});
}, function (e, t) {
    btnCall = $("#fastCall"), modalCall = $(".modal-overlay, .modal-position, .fast-call"), btnCall.on("click", (function () {
        modalCall.show();
    })), $(".fast-call__close, .modal-overlay").click((function () {
        modalCall.hide();
    }));
}, function (e, t) {
    btnOrder = $("#basketOrder"), modalOrder = $(".modal-overlay, .modal-position, .modal-basket"), btnOrder.on("click", (function () {
        modalOrder.show();
    })), $(".modal-basket__close, .modal-overlay").click((function () {
        modalOrder.hide();
    }));
}, function (e, t) {
    $((function () {
        var e = $(".product-card__calculator"), t = $(".modal-calculator, .modal-overlay, .modal-position");
        e.on("click", (function () {
            t.show(100);
        })), $(".modal-calculator__close, .modal-overlay").click((function () {
            t.hide(100);
        }));
    }));
}, function (e, t) {
    $((function () {
        btnCity = $("#select-city"), modalCity = $(".modal-overlay, .modal-position, .modal-city"), btnCity.on("click", (function () {
            modalCity.fadeIn(200);
        })), $(".modal-city__close, .modal-overlay").click((function () {
            modalCity.fadeOut(200);
        })), $(".modal-city__input").focus((function () {
            $(this).siblings(".modal-city__label").addClass("modal-city__label-color");
        })), $(".modal-city__input").blur((function () {
            $(this).val().length >= 1 ? ($(this).siblings(".modal-city__label").removeClass("modal-city__label-color"), $(this).siblings(".modal-city__label").addClass("modal-city__label-active")) : ($(this).siblings(".modal-city__label").removeClass("modal-city__label-color"), $(this).siblings(".modal-city__label").removeClass("modal-city__label-active"));
        }));
    }));
}, function (e, t) {
    btnComplete = $("#buttonComplete"), modalComplete = $(".modal-overlay, .modal-position, .modal-complete"), btnComplete.on("click", (function () {
        modalComplete.show();
    })), $(".modal-complete__close, .modal-overlay").click((function () {
        modalComplete.hide();
    }));
}, function (e, t) {
    btnCompleteCompany = $("#buttonCompleteCompany"), modalCompleteCompany = $(".modal-overlay, .modal-position, .modal-complete-company"), btnCompleteCompany.on("click", (function () {
        modalCompleteCompany.show();
    })), $(".modal-complete__close, .modal-overlay").click((function () {
        modalCompleteCompany.hide();
    }));
}, function (e, t) {
    $((function () {
        btn = $(".open-modal-region"), modal = $(".modal-overlay, .modal-position, .modal-region"), btn.on("click", (function () {
            modal.fadeIn(200);
        })), $(".modal-region__close, .modal-overlay").click((function () {
            modal.fadeOut(200);
        }));
    }));
}, function (e, t) {
    $(".modal-registration__tabs").on("click", ".modal-registration__tab:not(.basket-products__delivery-button--active)", (function () {
        $(this).addClass("modal-registration__tab--active").siblings().removeClass("modal-registration__tab--active").closest(".modal-registration__inner").find(".modal-registration__box").removeClass("modal-registration__box--active").eq($(this).index()).addClass("modal-registration__box--active");
    })), btnReg = $("#buttonReg"), modalReg = $(".modal-overlay, .modal-position, .modal-registration-container"), btnReg.on("click", (function () {
        modalReg.show();
    })), $(".modal-registration__close, .modal-overlay").click((function () {
        modalReg.hide();
    })), $("#addCompany").click((function () {
        $(".modal-registration__add-company-block").toggle();
    })), $("#signEmail").click((function () {
        $(".modal-registration__box").find(".modal-registration__sign-block").removeClass("modal-registration__sign-block--active").next().addClass("modal-registration__sign-block--active");
    })), $("#signTel").click((function () {
        $(".modal-registration__box").find(".modal-registration__sign-block").removeClass("modal-registration__sign-block--active").prev().addClass("modal-registration__sign-block--active");
    }));
}, function (e, t) {
    $("#btnAddAddress").on("click", (function () {
        $(".modal").show();
    })), $(".modal__close, .modal__overlay").click((function () {
        $(".modal").hide();
    }));
}, function (e, t) {
    btnReset = $("#buttonReset"), modalReset = $(".modal-overlay, .modal-position,  .reset-password"), btnReset.on("click", (function () {
        modalReset.show();
    })), $(".reset-password__close, .modal-overlay").click((function () {
        modalReset.hide();
    }));
}, function (e, t) {
    btnChange = $("#buttonChange"), modalChange = $(".modal-overlay, .modal-position,  .reset-password-change"), btnChange.on("click", (function () {
        modalChange.show();
    })), $("#closeChange, .modal-overlay").click((function () {
        modalChange.hide();
    }));
}, function (e, t) {
    btnThanks = $("#buttonThanks"), modalThanks = $(".modal-overlay, .modal-position, .thanks"), btnThanks.on("click", (function () {
        modalThanks.show();
    })), $(".thanks__close, .modal-overlay").click((function () {
        modalThanks.hide();
    }));
}, function (e, t) {
    $(".news__tabs").on("click", ".news__tab:not(.news__tab--active)", (function () {
        $(this).addClass("news__tab--active").siblings().removeClass("news__tab--active").closest(".news__inner").find(".news__content").removeClass("news__content--active").eq($(this).index()).addClass("news__content--active");
    }));
    var o = $("#owl-slider"), i = $("#owl-carousel");
    o.on("click", ".owl-next", (function () {
        i.trigger("next.owl.carousel");
    })), o.on("click", ".owl-prev", (function () {
        i.trigger("prev.owl.carousel");
    })), o.owlCarousel({center: !0, loop: !0, items: 1, margin: 0, nav: !0}).on("dragged.owl.carousel", (function (e) {
        "left" == e.relatedTarget.state.direction ? i.trigger("next.owl.carousel") : i.trigger("prev.owl.carousel");
    })), i.owlCarousel({center: !0, loop: !0, items: 3, margin: 16, arrows: !1, nav: !1}).on("click", ".owl-item", (function () {
        var e = $(this).index() - 4;
        i.trigger("to.owl.carousel", [e, 300, !0]), o.trigger("to.owl.carousel", [e, 300, !0]);
    }));
}, function (e, t) {
}, function (e, t) {
}, function (e, t) {
    $(".personal-area__list-header-detail").click((function () {
        $(this).toggleClass("personal-area__list-header-detail--active"), $(this).closest('.personal-area__list-item').find(".personal-area__history").toggleClass("personal-area__history--show"), $(this).closest('.personal-area__list-item').find(".personal-area__history-box").toggleClass("personal-area__history-box--show");
    }));
    var o = $(".personal-area__menu-button"), i = $(".personal-area__panel-container--mobile");
    o.click((function () {
        i.toggleClass("personal-area__panel-container--show");
    })), $(".personal-area__organizations-input").click((function () {
        1 == $(this).prop("checked") && $(this).parent().children(".personal-area__organizations-hint").show(0, (function () {
            setTimeout((function () {
                $(".personal-area__organizations-hint").hide(500);
            }), 3e3);
        }));
    }));
}, function (e, t) {
}, function (e, t) {
    $(document).ready((function () {
        $("#minusSum").click((function () {
            var e = $("#calculatorSum"), t = parseInt(e.val()) - 1;
            return t = t < 1 ? 1 : t, e.val(t), e.change(), !1;
        })), $("#plusSum").click((function () {
            var e = $("#calculatorSum");
            return e.val(parseInt(e.val()) + 1), e.change(), !1;
        })), $(".slider-for").slick({slidesToShow: 1, slidesToScroll: 1, arrows: !1, fade: !0, asNavFor: ".slider-nav"}), $(".slider-nav").slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            asNavFor: ".slider-for",
            dots: !1,
            focusOnSelect: !0,
            infinite: !1,
            vertical: !0,
            prevArrow: '<div class="slider-prev"></div>',
            nextArrow: '<div class="slider-next"></div>',
            responsive: [{breakpoint: 1280, settings: {vertical: !1, slidesToShow: 3, slidesToScroll: 1}}, {
                breakpoint: 1032,
                settings: {vertical: !1, slidesToShow: 4, slidesToScroll: 1}
            }, {breakpoint: 767, settings: {vertical: !1, slidesToShow: 2, slidesToScroll: 1}}]
        });
    }));
}, function (e, t) {
    $((function () {
        $(".product-description__input").focus((function () {
            $(this).siblings(".product-description__label").addClass("product-description__label-color");
        })), $(".product-description__input").blur((function () {
            $(this).val().length >= 1 ? ($(this).siblings(".product-description__label").removeClass("product-description__label-color"), $(this).siblings(".product-description__label").addClass("product-description__label-active")) : ($(this).siblings(".product-description__label").removeClass("product-description__label-color"), $(this).siblings(".product-description__label").removeClass("product-description__label-active"));
        })), $(".product-description__input").keypress((function () {
            $(this).val().length >= 0 && $(".product-description__input-reset").show();
        })), $(".product-description__input").keyup((function () {
            $(this).val().length <= 0 && $(".product-description__input-reset").hide();
        })), $(".product-description__input-reset").click((function () {
            $(".product-description__input").val("").change();
        })), $(".product-description__tabs").on("click", ".product-description__tab:not(.product-description__tab--active)", (function () {
            $(this).addClass("product-description__tab--active").siblings().removeClass("product-description__tab--active").closest(".product-description__container").find(".product-description__content-box").removeClass("product-description__content-box--active").eq($(this).index()).addClass("product-description__content-box--active");
        }));
    }));
}, function (e, t) {
    $(".read-blogs__carousel").owlCarousel({
        dots: !1,
        nav: !0,
        arrows: !0,
        navText: ["", ""],
        loop: !1,
        margin: 16,
        singleItem: !0,
        items: 4,
        responsive: {1360: {items: 4}, 1050: {items: 3}, 768: {items: 2}, 0: {items: 1, margin: 0}}
    });
}, function (e, t) {
}, function (e, t) {
}, function (e, t) {
    $(".recommends-modal-owl-carousel").owlCarousel({
        dots: !1,
        nav: !0,
        arrows: !0,
        navText: ["", ""],
        loop: !1,
        singleItem: !0,
        items: 4,
        margin: 10,
        responsive: {0: {items: 1}, 767: {items: 2}, 1023: {items: 3}, 1279: {items: 4}, 1401: {items: 4}}
    });
}, function (e, t) {
    $(".recommends-owl-carousel").owlCarousel({
        dots: !1,
        nav: !0,
        arrows: !0,
        navText: ["", ""],
        loop: !1,
        singleItem: !0,
        items: 5,
        margin: 10,
        responsive: {0: {items: 1}, 767: {items: 2}, 1023: {items: 3}, 1279: {items: 4}, 1401: {items: 5}}
    });
}, function (e, t) {
}, function (e, t) {
}, function (e, t) {
    $(".services__carousel").owlCarousel({
        dots: !1,
        nav: !0,
        arrows: !0,
        navText: ["", ""],
        loop: !1,
        margin: 16,
        singleItem: !0,
        items: 4,
        responsive: {1279: {items: 4}, 1023: {items: 3}, 440: {items: 2}, 0: {items: 1}}
    }), $(".services__tabs").on("click", ".services__tab:not(.active)", (function () {
        $(this).addClass("active").siblings().removeClass("active").closest(".services__inner").find(".services__content").removeClass("active").eq($(this).index()).addClass("active");
    }));
}, function (e, t) {
    $(".shop-news__carousel").owlCarousel({dots: !1, nav: !0, arrows: !0, navText: ["", ""], loop: !1, singleItem: !0, items: 1});
}, function (e, t) {
}, function (e, t) {
}, function (e, t) {
    $((function () {
        $(window).scroll((function () {
            $(this).scrollTop() > 50 ? $(".users-panel").addClass("users-panel--sticky") : $(".users-panel").removeClass("users-panel--sticky");
        }));
    }));
}]);


//# sourceMappingURL=main.js.map

// $(document).ready(function(){
//
//     $('.product-card__main-image').zoom({url: 'photo-big.jpg'});
// });
//
// $(document).ready(function () {
//     $('.product-card__main-image-box').zoom({
//         // url: 'this',
//         // callback: function(){
//         //     console.log(this)
//         //
//         //     $(this).colorbox({href: this.src});
//         // }
//
//         onZoomIn: function () {
//             $($(this.offsetParent)[0]).find('.product-card__main-image').css('opacity',0)
//         },
//         onZoomOut: function () {
//             $($(this.offsetParent)[0]).find('.product-card__main-image').css('opacity',1)
//         },
//     });
// });

$(document).ready(function () {

    $('.product-description__pickup-link.product-description__delivery-link').on('click', function () {
        let modalReg = $(".modal-overlay, .modal-position, .modal-delivery");
        modalReg.show();
    });

    headerScroll();

    function headerScroll() {
        let $topHeader = $('.header');
        let topHeaderHeight = $topHeader.innerHeight();
        let $scrollPanel = $('.scroll-panel');
        let scrollClass = 'scroll-panel--scroll';

        checkHeaderPosition();

        function checkHeaderPosition() {
            let translateScrollPanel = $(window).scrollTop();
            // console.log($(window).scrollTop())

            if ($(window).scrollTop() > topHeaderHeight) {
                $scrollPanel.addClass(scrollClass);
                translateScrollPanel = topHeaderHeight;
            } else {
                $scrollPanel.removeClass(scrollClass);
                translateScrollPanel = $(window).scrollTop();
            }

            $scrollPanel.css('transform', 'translateY(' + -translateScrollPanel + 'px)');
            // $topHeader.css('transform', 'translateY(' + -translateScrollPanel + 'px)');

            requestAnimationFrame(checkHeaderPosition);
        }
    }

    $('.product-card__slides-inner').owlCarousel({
        loop: false,
        mouseDrag: false,
        nav: true,
        center: false,
        responsive: {
            0: {
                items: 4,
                margin: 10,
            },
            // 600:{
            //     items:3
            // },
            1280: {
                items: 4,
                margin: 20,
            }
        }
    });

    // $('.catalog-menu__submenu-item-button').on('click', function () {
    //     $(this).siblings(".catalog-menu__submenu-inner").slideToggle(300);
    // });

    $('.catalog-mob__buttons .catalog-mob__btn.btn1').on('click', function () {
        $('.catalog-mob__buttons .catalog-mob__btn').removeClass("active");
        $(this).addClass("active");
        $(".catalog-menu .catalog-item1").attr("hidden", false);
        $(".catalog-menu .catalog-item2").attr("hidden", true);
    });
    $('.catalog-mob__buttons .catalog-mob__btn.btn2').on('click', function () {
        $('.catalog-mob__buttons .catalog-mob__btn').removeClass("active");
        $(this).addClass("active");
        $(".catalog-menu .catalog-item1").attr("hidden", true);
        $(".catalog-menu .catalog-item2").attr("hidden", false);
    });

    $('.product-card__slides .owl-item:nth-child(1)').addClass("active-slide");
    $('.product-card__slides .owl-item').on('click', function () {
        $('.product-card__slides .owl-item').removeClass("active-slide");
        $(this).addClass("active-slide");
    });



    $('.our-shops__inner .shop-item .shop-btn').on('click', function () {
        $(this).toggleClass("active");
        if ($(this).hasClass("active")) {
            $(this).text("Скрыть");
            $(this).siblings(".shop-map-wrap").slideDown();
        } else {
            $(this).text("Показать");
            $(this).siblings(".shop-map-wrap").slideUp();
        }
    });

    $(window).on('load resize', function () {
        if ($(window).width() < 767) {
            $("#del_filter").val("Закрыть");
        } else {
            $("#del_filter").val("Очистить");
        }
    });

    // setTimeout(function(){
    //     $(".preloader").hide();
    // }, 5000);
});

