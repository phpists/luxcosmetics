// // Import jQuery module (npm i jquery)
import $ from 'jquery'
window.jQuery = $
window.$ = $

import magnificPopup from 'magnific-popup'
import NativejsSelect from 'nativejs-select'

// // Import vendor jQuery plugin example (not module)
// require('~/app/libs/mmenu/dist/mmenu.js')
require('../js/jquery-ui/jquery-ui')
require('../js/jquery-ui/jquery.ui.touch-punch.min.js')

require('../../node_modules/inputmask/dist/jquery.inputmask.min.js')
require('../../node_modules/slick-carousel/slick/slick.min.js')
require('../../node_modules/jquery-mousewheel/jquery.mousewheel')
require('../../node_modules/malihu-custom-scrollbar-plugin')
require('../js/mmenu/jquery.mmenu.all')

document.addEventListener('DOMContentLoaded', () => {

	$(function() {




		$("#menu").mmenu({
			navbar: {
				title: "Каталог продукции"
			}
		});




		// let scrollFilter = $(".filter__scroll").mCustomScrollbar({
		// 	axis: "y",              // вертикальный скролл
		// 	theme: "dark",  // тема
		// 	scrollInertia: "330",   // продолжительность прокрутки, значение в миллисекундах
		// 	setHeight: "100%",      // высота блока (переписывает CSS)
		// 	mouseWheel: {
		// 	    deltaFactor: 300    // кол-во пикселей на одну прокрутку колёсика мыши
		// 	}
		// });

		$(".filter__all").click(function() {
			if ( $(this).parents(".filter").find(".filter__scroll").hasClass( "is-open" )) {
				$(this).parents(".filter").find(".filter__scroll").mCustomScrollbar('destroy');
			  } else{
				$(this).parents(".filter").find(".filter__scroll").mCustomScrollbar({
					axis: "y",              // вертикальный скролл
					theme: "dark",  // тема
					scrollInertia: "330",   // продолжительность прокрутки, значение в миллисекундах
					setHeight: "100%",      // высота блока (переписывает CSS)
					mouseWheel: {
					    deltaFactor: 300    // кол-во пикселей на одну прокрутку колёсика мыши
					}
				});
			  }
		});


		$(".filters").mCustomScrollbar({
			axis: "y",              // вертикальный скролл
			theme: "dark",  // тема
			scrollInertia: "330",   // продолжительность прокрутки, значение в миллисекундах
			setHeight: "100%",      // высота блока (переписывает CSS)
			mouseWheel: {
				deltaFactor: 300    // кол-во пикселей на одну прокрутку колёсика мыши
			}
		});




		let tag = document.querySelectorAll('.seoblock__tag');
		for (let i = 5; i < tag.length; i++) {
			tag[i].classList.add("is-hidden");
		}

		$(this).text(function(i, text){
			return text === "Свернуть" ? "Выберите категорию" : "Свернуть";
		    })

		let tagHidden = document.querySelectorAll('.seoblock__tag.is-hidden');
		$(".seoblock__moretags").click(function() {
			$(this).text(function(i, text){
				return text === "Свернуть" ? "Развернуть" : "Свернуть";
			 })
			for (let i = 0; i < tagHidden.length; i++) {
				tagHidden[i].classList.toggle("is-hidden");
			}
		});


		$(".seoblock__morecontent").click(function() {
			$(this).text(function(i, text){
				return text === "Свернуть" ? "Развернуть" : "Свернуть";
			 })
			 $("#seohidden").toggleClass("is-hidden");

		});






		// $( "#slider-range" ).slider({
		// 	range: true,
		// 	min: 0,
		// 	max: 750000,
		// 	values: [ 7500, 300000 ],
		// 	slide: function( event, ui ) {
		// 		$( "#amount" ).val( ui.values[ 0 ]);
		// 		$( "#amount2" ).val( ui.values[ 1 ]);
		// 	}
		// });
		// $( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 ) );
		// $( "#amount2" ).val( $( "#slider-range" ).slider( "values", 1 ) );




		$('.slider').slick({
			dots: true,
			speed: 1000,
			infinite: true,
			slidesToShow: 2,
			slidesToScroll: 2,
			prevArrow: '<button type="button" class="btn-slider btn-slider__prev"><svg class="icon"><use xlink:href="/images/dist/sprite.svg#prev"></use></svg></button>',
			nextArrow: '<button type="button" class="btn-slider btn-slider__next"><svg class="icon"><use xlink:href="/images/dist/sprite.svg#next"></use></svg></button>',
			responsive: [
				{
				  breakpoint: 1200,
				  settings: {
				    slidesToShow: 2,
				    slidesToScroll: 1,
				  }
				},
				{
				  breakpoint: 992,
				  settings: {
				    slidesToShow: 2,
				    slidesToScroll: 1,
				    vertical: false
				  }
				},
				{
				  breakpoint: 768,
				  settings: {
				    slidesToShow: 1,
				    slidesToScroll: 1
				  }
				},
				{
				  breakpoint: 576,
				  settings: {
				    slidesToShow: 1,
				    slidesToScroll: 1
				  }
				},
				{
				  breakpoint: 0,
				  settings: {
				    slidesToShow: 1,
				    slidesToScroll: 1
				  }
				}
			]
		 });

		 $('.slider-vert ').slick({
			dots: true,
			speed: 1000,
			infinite: true,
			slidesToShow: 4,
			slidesToScroll: 1,
			prevArrow: '<button type="button" class="btn-slider btn-slider__prev"><svg class="icon"><use xlink:href="/images/dist/sprite.svg#prev"></use></svg></button>',
			nextArrow: '<button type="button" class="btn-slider btn-slider__next"><svg class="icon"><use xlink:href="/images/dist/sprite.svg#next"></use></svg></button>',
			responsive: [
				{
				  breakpoint: 1200,
				  settings: {
				    slidesToShow: 4,
				    slidesToScroll: 1,
				  }
				},
				{
				  breakpoint: 992,
				  settings: {
				    slidesToShow: 3,
				    slidesToScroll: 1,
				    vertical: false
				  }
				},
				{
				  breakpoint: 768,
				  settings: {
				    slidesToShow: 2,
				    slidesToScroll: 1
				  }
				},
				{
				  breakpoint: 576,
				  settings: {
				    slidesToShow: 1,
				    slidesToScroll: 1
				  }
				},
				{
				  breakpoint: 0,
				  settings: {
				    slidesToShow: 1,
				    slidesToScroll: 1
				  }
				}
			]
		 });


		$('.gallery').slick({
			dots: false,
			speed: 1000,
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			asNavFor: '.gallerythumb'
		 });

		$('.gallerythumb').slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			asNavFor: '.gallery',
			focusOnSelect: true,
			vertical: true,
			prevArrow: $("#gallery-up"),
			nextArrow: $("#gallery-down"),
			responsive: [
				{
				  breakpoint: 1200,
				  settings: {
				    slidesToShow: 3,
				    slidesToScroll: 1,
				  }
				},
				{
				  breakpoint: 992,
				  settings: {
				    slidesToShow: 3,
				    slidesToScroll: 1,
				    vertical: false
				  }
				},
				{
				  breakpoint: 768,
				  settings: {
				    slidesToShow: 1,
				    slidesToScroll: 1
				  }
				},
				{
				  breakpoint: 576,
				  settings: {
				    slidesToShow: 1,
				    slidesToScroll: 1
				  }
				},
				{
				  breakpoint: 0,
				  settings: {
				    slidesToShow: 1,
				    slidesToScroll: 1
				  }
				}
			      ]
		});



		if(document.querySelector(".popup-youtube")) {
			$('.popup-youtube').magnificPopup({
				disableOn: 700,
				type: 'iframe',
				mainClass: 'mfp-fade',
				removalDelay: 160,
				preloader: false,

				fixedContentPos: false
			});
		}

			/*Маска телефона*/
			$('.phone-mask').inputmask('+7(999)999-99-99');

			$('.cvv-mask').inputmask('999');
			$('.date-mask').inputmask('99');

			/*Аккордеон*/

			$(".accordeon dd").prev().click(function() {
				$(this).parents(".accordeon").find("dd").not(this).slideUp().prev().removeClass("active");
				$(this).next().not(":visible").slideDown().prev().addClass("active");
			});


			$(".cart-aside__accordeon dd").hide().prev().click(function() {
				$(this).parents(".cart-aside__accordeon").find("dd").not(this).slideUp().prev().removeClass("active");
				$(this).next().not(":visible").slideDown().prev().addClass("active");
			});

			$(".faq-accordeon dd").hide().prev().click(function() {
				$(this).parents(".faq-accordeon").find("dd").not(this).slideUp().prev().removeClass("active");
				$(this).next().not(":visible").slideDown().prev().addClass("active");
			});







			$(".filter__all").click(function() {
				$(this).text(function(i, text){
					return text === "Свернуть" ? "Показать все" : "Свернуть";
				})
				$(this).parents(".filter").find(".filter__wrap").toggleClass("is-open");
			});


			$(".filter__title").click(function() {
				$(this).toggleClass("is-close");
				$(this).parents(".filter").find(".filter__block").slideToggle();
			});


			/*Табы*/
			$(".wrapper .tab_item").not(":first").hide();
			$(".wrapper .tab").click(function() {
				$(".wrapper .tab").removeClass("active").eq($(this).index()).addClass("active");
				$(".wrapper .tab_item").hide().eq($(this).index()).fadeIn()
			}).eq(0).addClass("active");

			/*Табы*/
			$(".product-tabs__tabsitem").not(":first").hide();
			$(".product-tabs__tab").click(function() {
				$(".product-tabs__tab").removeClass("active").eq($(this).index()).addClass("active");
				$(".product-tabs__tabsitem").hide().eq($(this).index()).fadeIn()
			}).eq(0).addClass("active");


			$(".footer__menutitle").click(function() {
				$(this).toggleClass("is-active");
				$(this).parents(".footer__menu").find("ul").slideToggle();
			});

			/*Стилизованный Select*/
			new NativejsSelect({
				selector: '.selectCustom'
			  });


			  $('.products-slider').on('setPosition', function () {
				  $(this).find('.products-slider__item').height('auto');
				  var slickTrack = $(this).find('.slick-track');
				  var slickTrackHeight = $(slickTrack).height();
				  $(this).find('.products-slider__item').css('height', slickTrackHeight + 'px');
			});



			  $( ".productsblock" ).each(function(index) {
				$('.products-slider', $(this)).slick({
					dots: false,
					speed: 1000,
					infinite: true,
					slidesToShow: 4,
					slidesToScroll: 4,
					prevArrow: '<button type="button" class="btn-slider btn-slider__prev"><svg class="icon"><use xlink:href="/images/dist/sprite.svg#prev"></use></svg></button>',
					nextArrow: '<button type="button" class="btn-slider btn-slider__next"><svg class="icon"><use xlink:href="/images/dist/sprite.svg#next"></use></svg></button>',
					responsive: [
						{
						  breakpoint: 1200,
						  settings: {
						    slidesToShow: 3,
						    slidesToScroll: 3,
						    infinite: true,
						  }
						},
						{
						  breakpoint: 992,
						  settings: {
						    slidesToShow: 2,
						    slidesToScroll: 1
						  }
						},
						{
						  breakpoint: 768,
						  settings: {
						    slidesToShow: 2,
						    slidesToScroll: 1
						  }
						},
						{
						  breakpoint: 576,
						  settings: {
						    slidesToShow: 1,
						    slidesToScroll: 1
						  }
						},
						{
						  breakpoint: 0,
						  settings: {
						    slidesToShow: 1,
						    slidesToScroll: 1
						  }
						}
					      ]
				});
			});

			const otherSlider = $('.otherproducts-slider', $(this)).slick({
				dots: false,
				speed: 1000,
				infinite: true,
				slidesToShow: 4,
				slidesToScroll: 4,
				prevArrow: '<button type="button" class="btn-slider btn-slider__prev"><svg class="icon"><use xlink:href="/images/dist/sprite.svg#prev"></use></svg></button>',
				nextArrow: '<button type="button" class="btn-slider btn-slider__next"><svg class="icon"><use xlink:href="/images/dist/sprite.svg#next"></use></svg></button>',
				responsive: [
					{
					  breakpoint: 1200,
					  settings: {
					    slidesToShow: 3,
					    slidesToScroll: 3,
					    infinite: true,
					  }
					},
					{
					  breakpoint: 992,
					  settings: {
					    slidesToShow: 3,
					    slidesToScroll: 1
					  }
					},
					{
					  breakpoint: 768,
					  settings: {
					    slidesToShow: 2,
					    slidesToScroll: 1
					  }
					},
					{
					  breakpoint: 576,
					  settings: {
					    slidesToShow: 1,
					    slidesToScroll: 1
					  }
					},
					{
					  breakpoint: 0,
					  settings: {
					    slidesToShow: 1,
					    slidesToScroll: 1
					  }
					}
				      ]
			});

			$(".tab").click(function() {
				otherSlider.slick('refresh');
			});

			/*SLICK слайдер*/
				$('.brands-slider').slick({
				  dots: false,
				  infinite: false,
				  speed: 1000,
				  infinite: true,
				  slidesToShow: 6,
				  slidesToScroll: 1,
				  prevArrow: '<button type="button" class="btn-slider btn-slider__prev"><svg class="icon"><use xlink:href="/images/dist/sprite.svg#prev"></use></svg></button>',
				  nextArrow: '<button type="button" class="btn-slider btn-slider__next"><svg class="icon"><use xlink:href="/images/dist/sprite.svg#next"></use></svg></button>',
				  responsive: [
				    {
				      breakpoint: 1200,
				      settings: {
				        slidesToShow: 5,
				        slidesToScroll: 1,
				      }
				    },
				    {
				      breakpoint: 992,
				      settings: {
				        slidesToShow: 4,
				        slidesToScroll: 1
				      }
				    },
				    {
				      breakpoint: 768,
				      settings: {
				        slidesToShow: 3,
				        slidesToScroll: 1
				      }
				    },
				    {
				      breakpoint: 576,
				      settings: {
				        slidesToShow: 2,
				        slidesToScroll: 1
				      }
				    },
				    {
				      breakpoint: 0,
				      settings: {
				        slidesToShow: 1,
				        slidesToScroll: 1
				      }
				    }
				    // You can unslick at a given breakpoint now by adding:
				    // settings: "unslick"
				    // instead of a settings object
				  ]
				});
				//$('.slider-nav').slick({
				//  slidesToShow: 4,
				//  slidesToScroll: 1,
				//  asNavFor: '.slider-for',
				//  focusOnSelect: true
				//});

			/*Magnific Фото в модалке
			// $('.popup').magnificPopup({
			// 	type: 'image',
			// 	closeOnContentClick: true,
			// 	closeBtnInside: false,
			// 	fixedContentPos: true,
			// 	mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
			// 	image: {
			// 		verticalFit: true
			// 	},
			// 	zoom: {
			// 		enabled: true,
			// 		duration: 300 // don't foget to change the duration also in CSS
			// 	}
			// });*/

			/*Magnific галерея*/

			var galleries = $('.gallery');

			galleries.each(function() {
				var gallery = $(this);
				gallery.find(':not(.slick-cloned)').children('a').magnificPopup({
					type: 'image',
					gallery: {
						enabled:true,
						tLoading: 'Загрузка изображения #%curr%...',
						mainClass: 'mfp-fade mfp-img-mobile',
						navigateByImgClick: true,
					 },
					 image: {
						tError: '<a href="%url%">Изображение #%curr%</a> не загружено.',
						titleSrc: function(item) {
							return '';
						}
					},
					
					
				});
			});

				$('.popup-gallery').each(function() { // the containers for all your galleries
					$(this).magnificPopup({
						delegate: 'a',
						type: 'image',
						tLoading: 'Загрузка изображения #%curr%...',
						mainClass: 'mfp-fade mfp-img-mobile',
						gallery: {
							enabled: true,
							navigateByImgClick: true,
							preload: [0,1] // Will preload 0 - before current, and 1 after the current image
						},
						image: {
							tError: '<a href="%url%">Изображение #%curr%</a> не загружено.',
							titleSrc: function(item) {
								return '';
							}
						}
					});
				});


			/*Magnific модальное окно */
			if(document.querySelector(".popup-with-form")) {
				$('.popup-with-form').magnificPopup({
					type: 'inline',
					preloader: false,
					focus: '#name',
					mainClass: 'mfp-fade',
					// When elemened is focused, some mobile browsers in some cases zoom in
					// It looks not nice, so we disable it:
					callbacks: {
						beforeOpen: function() {
							if($(window).width() < 700) {
								this.st.focus = false;
							} else {
								this.st.focus = '#name';
							}
						}
					}
				});
			}


			/*Кнопка "Наверх"*/
			$("#top").click(function () {
				$("body, html").animate({
					scrollTop: 0
				}, 800);
				return false;
			});


			$("img, a").on("dragstart", function(event) { event.preventDefault(); });

			$('.minus').click(function () {
				var $input = $(this).parent().find('input');
				var count = parseInt($input.val()) - 1;
				count = count < 1 ? 1 : count;
				$input.val(count);
				$input.change();
				return false;
			});
			$('.plus').click(function () {
				var $input = $(this).parent().find('input');
				$input.val(parseInt($input.val()) + 1);
				$input.change();
				return false;
			});


			/*



				$(this).text(function(i, text){
			          return text === "Свернуть" ? "Выберите категорию" : "Свернуть";
			      })


				$(".main_mnu_button").click(function() {
					$(this).toggleClass("active");
					$("nav > ul").slideToggle();
				});
			*/



			$(".btnfilters").click(function() {
				$("#filters").addClass("is-active");
				$(".filters-overlay").addClass("is-active");
			});

			$(".filters-overlay").click(function() {
				$(this).removeClass("is-active");
				$("#filters").removeClass("is-active");
				$(".sortmobile").removeClass("is-active");
			});

			$(".filters__close").click(function() {
				$(".filters-overlay").removeClass("is-active");
				$("#filters").removeClass("is-active");
			});

			$(".btnsort").click(function() {
				$(".sortmobile").addClass("is-active");
				$(".filters-overlay").addClass("is-active");
			});
			$(".sortmobile__close").click(function() {
				$(".filters-overlay").removeClass("is-active");
				$(".sortmobile").removeClass("is-active");
			});




			$("#new-review").click(function() {
				$(this).addClass("active");
				$("#new-ask").removeClass("active");
				$("#newask-form").hide();
				$("#newreview-form").show();
			});

			$("#new-ask").click(function() {
				$(this).addClass("active");
				$("#new-review").removeClass("active");
				$("#newreview-form").hide();
				$("#newask-form").show();
			});

			$(".product-tabs__formclose").click(function() {
				$(this).parents(".product-tabs__form").hide();
				$(".product-tabs__btn").removeClass("active");
			});

			$(".header__link--search").click(function() {
				$(this).toggleClass("is-active");
				$(".header__search").slideToggle();
			});


			$(".scroll a, .reviews-link").on("click",this, function (event) {
				// исключаем стандартную реакцию браузера
				event.preventDefault();

				// получем идентификатор блока из атрибута href
				var id  = $(this).attr('href'),

				// находим высоту, на которой расположен блок
				    top = $(id).offset().top;

				// анимируем переход к блоку, время: 800 мс
				$('body,html').animate({scrollTop: top}, 800);
			});








		});


})


$(document).ready(function() {
	$('.rulesmenu a[href^="#"]').on('click', function(e) {
	    e.preventDefault();
    
	    var target = this.hash;
	    var $target = $(target);
    
	    // Плавная прокрутка к элементу
	    $('html, body').stop().animate({
		'scrollTop': $target.offset().top
	    }, 900, 'swing', function() {
		window.location.hash = target;
	    });
	});
    });
    