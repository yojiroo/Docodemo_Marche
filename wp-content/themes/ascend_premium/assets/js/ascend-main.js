/* Initialize
*/
var kt_isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (kt_isMobile.Android() || kt_isMobile.BlackBerry() || kt_isMobile.iOS() || kt_isMobile.Opera() || kt_isMobile.Windows());
    }
};
if( !kt_isMobile.any() ) {
!function($,t,e,i){function o(t,e){this.element=t,this.options=$.extend({},s,e),this._defaults=s,this._name=n,this.init()}var n="ktstellar",s={scrollProperty:"scroll",positionProperty:"position",horizontalScrolling:!0,verticalScrolling:!0,horizontalOffset:0,verticalOffset:0,responsive:!1,parallaxBackgrounds:!0,parallaxElements:!0,hideDistantElements:!0,hideElement:function(t){t.hide()},showElement:function(t){t.show()}},r={scroll:{getLeft:function(t){return t.scrollLeft()},setLeft:function(t,e){t.scrollLeft(e)},getTop:function(t){return t.scrollTop()},setTop:function(t,e){t.scrollTop(e)}},position:{getLeft:function(t){return parseInt(t.css("left"),10)*-1},getTop:function(t){return parseInt(t.css("top"),10)*-1}},margin:{getLeft:function(t){return parseInt(t.css("margin-left"),10)*-1},getTop:function(t){return parseInt(t.css("margin-top"),10)*-1}},transform:{getLeft:function(t){var e=getComputedStyle(t[0])[f];return"none"!==e?parseInt(e.match(/(-?[0-9]+)/g)[4],10)*-1:0},getTop:function(t){var e=getComputedStyle(t[0])[f];return"none"!==e?parseInt(e.match(/(-?[0-9]+)/g)[5],10)*-1:0}}},a={position:{setLeft:function(t,e){t.css("left",e)},setTop:function(t,e){t.css("top",e)}},transform:{setPosition:function(t,e,i,o,n){t[0].style[f]="translate3d("+(e-i)+"px, "+(o-n)+"px, 0)"}}},l=function(){var t=/^(Moz|Webkit|Khtml|O|ms|Icab)(?=[A-Z])/,e=$("script")[0].style,i="",o;for(o in e)if(t.test(o)){i=o.match(t)[0];break}return"WebkitOpacity"in e&&(i="Webkit"),"KhtmlOpacity"in e&&(i="Khtml"),function(t){return i+(i.length>0?t.charAt(0).toUpperCase()+t.slice(1):t)}}(),f=l("transform"),c=$("<div />",{style:"background:#fff"}).css("background-position-x")!==i,p=c?function(t,e,i){t.css({"background-position-x":e,"background-position-y":i})}:function(t,e,i){t.css("background-position",e+" "+i)},h=c?function(t){return"50%"==t.css("background-position-y")?($ypos=t.height()/2,[t.css("background-position-x"),$ypos]):[t.css("background-position-x"),t.css("background-position-y")]}:function(t){return t.css("background-position").split(" ")},u=t.requestAnimationFrame||t.webkitRequestAnimationFrame||t.mozRequestAnimationFrame||t.oRequestAnimationFrame||t.msRequestAnimationFrame||function(t){setTimeout(t,1e3/60)};o.prototype={init:function(){this.options.name=n+"_"+Math.floor(1e9*Math.random()),this._defineElements(),this._defineGetters(),this._defineSetters(),this._handleWindowLoadAndResize(),this._detectViewport(),this.refresh({firstLoad:!0}),"scroll"===this.options.scrollProperty?this._handleScrollEvent():this._startAnimationLoop()},_defineElements:function(){this.element===e.body&&(this.element=t),this.$scrollElement=$(this.element),this.$element=this.element===t?$("body"):this.$scrollElement,this.$viewportElement=this.options.viewportElement!==i?$(this.options.viewportElement):this.$scrollElement[0]===t||"scroll"===this.options.scrollProperty?this.$scrollElement:this.$scrollElement.parent()},_defineGetters:function(){var t=this,e=r[t.options.scrollProperty];this._getScrollLeft=function(){return e.getLeft(t.$scrollElement)},this._getScrollTop=function(){return e.getTop(t.$scrollElement)}},_defineSetters:function(){var t=this,e=r[t.options.scrollProperty],i=a[t.options.positionProperty],o=e.setLeft,n=e.setTop;this._setScrollLeft="function"==typeof o?function(e){o(t.$scrollElement,e)}:$.noop,this._setScrollTop="function"==typeof n?function(e){n(t.$scrollElement,e)}:$.noop,this._setPosition=i.setPosition||function(e,o,n,s,r){t.options.horizontalScrolling&&i.setLeft(e,o,n),t.options.verticalScrolling&&i.setTop(e,s,r)}},_handleWindowLoadAndResize:function(){var e=this,i=$(t);e.options.responsive&&i.bind("load."+this.name,function(){e.refresh()}),i.bind("resize."+this.name,function(){e._detectViewport(),e.options.responsive&&e.refresh()})},refresh:function(e){var i=this,o=i._getScrollLeft(),n=i._getScrollTop();e&&e.firstLoad||this._reset(),this._setScrollLeft(0),this._setScrollTop(0),this._setOffsets(),this._findBackgrounds(),e&&e.firstLoad&&/WebKit/.test(navigator.userAgent)&&$(t).load(function(){var t=i._getScrollLeft(),e=i._getScrollTop();i._setScrollLeft(t+1),i._setScrollTop(e+1),i._setScrollLeft(t),i._setScrollTop(e)}),this._setScrollLeft(o),this._setScrollTop(n)},_detectViewport:function(){var t=this.$viewportElement.offset(),e=null!==t&&t!==i;this.viewportWidth=this.$viewportElement.width(),this.viewportHeight=this.$viewportElement.height(),this.viewportOffsetTop=e?t.top:0,this.viewportOffsetLeft=e?t.left:0},_findBackgrounds:function(){var t=this,e=this._getScrollLeft(),o=this._getScrollTop(),n;this.backgrounds=[],this.options.parallaxBackgrounds&&(n=this.$element.find("[data-ktstellar-background-ratio]"),this.$element.data("ktstellar-background-ratio")&&(n=n.add(this.$element)),n.each(function(){var n=$(this),s=h(n),r,a,l,f,c,u,d,g,m,k=0,v=0,_=0,b=0;if(n.data("ktstellar-backgroundIsActive")){if(n.data("ktstellar-backgroundIsActive")!==this)return}else n.data("ktstellar-backgroundIsActive",this);n.data("ktstellar-backgroundStartingLeft")?p(n,n.data("ktstellar-backgroundStartingLeft"),n.data("ktstellar-backgroundStartingTop")):(n.data("ktstellar-backgroundStartingLeft",s[0]),n.data("ktstellar-backgroundStartingTop",s[1])),c="auto"===n.css("margin-left")?0:parseInt(n.css("margin-left"),10),u="auto"===n.css("margin-top")?0:parseInt(n.css("margin-top"),10),d=n.offset().left-c-e,g=n.offset().top-u-o,n.parents().each(function(){var t=$(this);return t.data("ktstellar-offset-parent")===!0?(k=_,v=b,m=t,!1):(_+=t.position().left,void(b+=t.position().top))}),r=n.data("ktstellar-horizontal-offset")!==i?n.data("ktstellar-horizontal-offset"):m!==i&&m.data("ktstellar-horizontal-offset")!==i?m.data("ktstellar-horizontal-offset"):t.horizontalOffset,a=n.data("ktstellar-vertical-offset")!==i?n.data("ktstellar-vertical-offset"):m!==i&&m.data("ktstellar-vertical-offset")!==i?m.data("ktstellar-vertical-offset"):t.verticalOffset,t.backgrounds.push({$element:n,$offsetParent:m,isFixed:"fixed"===n.css("background-attachment"),horizontalOffset:r,verticalOffset:a,startingValueLeft:s[0],startingValueTop:s[1],startingBackgroundPositionLeft:isNaN(parseInt(s[0],10))?0:parseInt(s[0],10),startingBackgroundPositionTop:isNaN(parseInt(s[1],10))?0:parseInt(s[1],10),startingPositionLeft:n.position().left,startingPositionTop:n.position().top,startingOffsetLeft:d,startingOffsetTop:g,parentOffsetLeft:k,parentOffsetTop:v,ktstellarRatio:n.data("ktstellar-background-ratio")===i?1:n.data("ktstellar-background-ratio")})}))},_reset:function(){var t,e,i,o;for(o=this.backgrounds.length-1;o>=0;o--)i=this.backgrounds[o],i.$element.data("ktstellar-backgroundStartingLeft",null).data("ktstellar-backgroundStartingTop",null),p(i.$element,i.startingValueLeft,i.startingValueTop)},destroy:function(){this._reset(),this.$scrollElement.unbind("resize."+this.name).unbind("scroll."+this.name),this._animationLoop=$.noop,$(t).unbind("load."+this.name).unbind("resize."+this.name)},_setOffsets:function(){var e=this,i=$(t);i.unbind("resize.horizontal-"+this.name).unbind("resize.vertical-"+this.name),"function"==typeof this.options.horizontalOffset?(this.horizontalOffset=this.options.horizontalOffset(),i.bind("resize.horizontal-"+this.name,function(){e.horizontalOffset=e.options.horizontalOffset()})):this.horizontalOffset=this.options.horizontalOffset,"function"==typeof this.options.verticalOffset?(this.verticalOffset=this.options.verticalOffset(),i.bind("resize.vertical-"+this.name,function(){e.verticalOffset=e.options.verticalOffset()})):this.verticalOffset=this.options.verticalOffset},_repositionElements:function(){var t=this._getScrollLeft(),e=this._getScrollTop(),i,o,n,s,r,a,l,f=!0,c=!0,h,u,d,g,m;if(this.currentScrollLeft!==t||this.currentScrollTop!==e||this.currentWidth!==this.viewportWidth||this.currentHeight!==this.viewportHeight)for(this.currentScrollLeft=t,this.currentScrollTop=e,this.currentWidth=this.viewportWidth,this.currentHeight=this.viewportHeight,m=this.backgrounds.length-1;m>=0;m--)r=this.backgrounds[m],s=r.isFixed?0:1,a=this.options.horizontalScrolling?(t+r.horizontalOffset-this.viewportOffsetLeft-r.startingOffsetLeft+r.parentOffsetLeft-r.startingBackgroundPositionLeft)*(s-r.ktstellarRatio)+"px":r.startingValueLeft,l=this.options.verticalScrolling?(e+r.verticalOffset-this.viewportOffsetTop-r.startingOffsetTop+r.parentOffsetTop-r.startingBackgroundPositionTop)*(s-r.ktstellarRatio)+"px":r.startingValueTop,p(r.$element,a,l)},_handleScrollEvent:function(){var t=this,e=!1,i=function(){t._repositionElements(),e=!1},o=function(){e||(u(i),e=!0)};this.$scrollElement.bind("scroll."+this.name,o),o()},_startAnimationLoop:function(){var t=this;this._animationLoop=function(){u(t._animationLoop),t._repositionElements()},this._animationLoop()}},$.fn[n]=function(t){var e=arguments;return t===i||"object"==typeof t?this.each(function(){$.data(this,"plugin_"+n)||$.data(this,"plugin_"+n,new o(this,t))}):"string"==typeof t&&"_"!==t[0]&&"init"!==t?this.each(function(){var i=$.data(this,"plugin_"+n);i instanceof o&&"function"==typeof i[t]&&i[t].apply(i,Array.prototype.slice.call(e,1)),"destroy"===t&&$.data(this,"plugin_"+n,null)}):void 0},$[n]=function(e){var i=$(t);return i.ktstellar.apply(i,Array.prototype.slice.call(arguments,0))},$[n].scrollProperty=r,$[n].positionProperty=a,t.Ktstellar=o}(jQuery,this,document);}

jQuery(document).ready(function ($) {
		if (!Modernizrc.flexbox) {
		  $('body').addClass('kt-no-flex');
		}
		// Init Vars
		if( !kt_isMobile.any() ) {
			$('[data-toggle=tooltip]').tooltip();
		}
		$("[data-toggle=popover]").popover();
		$('.kt-tabs a').click(function (e) {
			e.preventDefault(); 
			$(this).tab('show'); 
		});
		$('.widget ul ul.children').each(function(){
			$(this).parent('li').append('<span class="kt-toggle-sub"></span>');
			if($(this).parent('li').find('.count').length ) {
				$(this).parent('li').addClass('kt-toggle-has-count');
			}
			if($(this).parent('li').hasClass('current-cat') || $(this).parent('li').hasClass('current-cat-parent') ) {
				$(this).parent('li').addClass('kt-drop-toggle');
			}
		});
		$('.kt-toggle-sub').click(function (e) {
				e.preventDefault(); 
				if($(this).parent('li').hasClass('kt-drop-toggle') ) {
				 	$(this).parent('li').removeClass('kt-drop-toggle'); 
				} else {
				 	$(this).parent('li').addClass('kt-drop-toggle'); 
				}
		});
		$(document).mouseup(function (e) {
			var container = $("#kad-menu-search-popup");
			if (!container.is(e.target) && container.has(e.target).length === 0) {
		        $('#kad-menu-search-popup.in').collapse('hide');
		    }
		});
		$('#kad-menu-search-popup').on('shown.bs.collapse', function () {
			$('.kt-search-container .search-query').focus();
		});
		$('.kt_typed_element').each(function() {
				var first = $(this).data('first-sentence'),
					second = $(this).data('second-sentence'),
					third = $(this).data('third-sentence'),
					fourth = $(this).data('fourth-sentence'),
					loopeffect = $(this).data('loop'),
					speed = $(this).data('speed'),
					startdelay = $(this).data('start-delay'),
					backdelay = $(this).data('back-delay'),
					linecount = $(this).data('sentence-count');
					if(startdelay == null) {startdelay = 500;}
					if(backdelay == null) {backdelay = 500;}
					if(linecount == '1'){
						var options = {
					      strings: [first],
					      typeSpeed: speed,
					      startDelay: startdelay,
					      backDelay: backdelay,
					      loop: loopeffect,
					  }
			    	}else if(linecount == '3'){
						var options = {
					      strings: [first, second, third],
					      typeSpeed: speed,
					      startDelay: startdelay,
					      backDelay: backdelay,
					      loop: loopeffect,
					  }
			    	} else if(linecount == '4'){
			    		var options = {
					      strings: [first, second, third, fourth],
					      typeSpeed: speed,
					      startDelay: startdelay,
					      backDelay: backdelay,
					      loop: loopeffect,
					  }
			    	} else {
			    		var options = {
					      strings: [first, second],
					      typeSpeed: speed,
					      startDelay: startdelay,
					      backDelay: backdelay,
					      loop: loopeffect,
					  }
			    	}
				$(this).ascend_appear(function() {
					$(this).typed(options);
				},{accX: 0, accY: -25});
      	});
		$(".videofit").fitVids();
		$(".embed-youtube").fitVids();
		$('.kt-m-hover').bind('touchend', function(e) {
	        $(this).toggleClass('kt-mobile-hover');
	        $(this).toggleClass('kt-mhover-inactive');
	    });
		$('.collapse-next').click(function (e) {
		    var $target = $(this).siblings('.sf-dropdown-menu');
		     if($target.hasClass('in') ) {
		    	$target.collapse('toggle');
		    	$(this).removeClass('toggle-active');
		    } else {
		    	$target.collapse('toggle');
		    	$(this).addClass('toggle-active');
		    }
		});

		/* Lightbox
		*
		*/

		function kt_check_images( index, element ) {
			return /(png|jpg|jpeg|gif|tiff|bmp)$/.test(
				$( element ).attr( 'href' ).toLowerCase().split( '?' )[0].split( '#' )[0]
			);
		}
		function kt_find_images() {
			$( 'a[href]:not(".kt-no-lightbox")' ).filter( kt_check_images ).attr( 'data-rel', 'lightbox' );
		}
		if(!$('body').hasClass('kt-turnoff-lightbox')) {
			kt_find_images();
		}
		$.extend(true, $.magnificPopup.defaults, {
			tClose: '',
			tLoading: '<div class="kt-ajax-overlay"><div class="kt-ajax-bubbling"><span id="kt-ajax-bubbling_1"></span><span id="kt-ajax-bubbling_2"></span><span id="kt-ajax-bubbling_3"></span></div></div>',
			gallery: {
				tPrev: '', // Alt text on left arrow
				tNext: '', // Alt text on right arrow
				tCounter: light_of // Markup for "1 of 7" counter
			},
			mainClass: 'mfp-zoom-in',
			removalDelay: 400,
			image: {
				markup:'<div class="mfp-figure mfp-with-anim"><div class="mfp-close"></div><div class="mfp-img"></div><div class="mfp-bottom-bar"><div class="mfp-title"></div><div class="mfp-counter"></div></div></div>',
				tError: light_error, // Error message when image could not be loaded
				titleSrc: function(item) {
					return item.el.find('img').attr('alt');
					}
				}
				
		});
		if(!$('body').hasClass('kt-turnoff-lightbox')) {
			$('a[data-rel^="lightbox"]:not(".kt-no-lightbox")').magnificPopup({type:'image'});
			// Theme Gallery
			$('.kad-light-gallery').each(function(){
				$(this).find('a[data-rel^="lightbox"]:not(".kt-no-lightbox")').magnificPopup({
					type: 'image',
					gallery: {
						enabled:true
						},
						image: {
							titleSrc: function(item) {
								if(item.el.find('img').attr('data-caption')) {
									return item.el.find('img').attr('data-caption');
								} else {
									return item.el.find('img').attr('alt');
								}
							}
						},
					removalDelay: 500, //delay removal by X to allow out-animation
					callbacks: {
						    beforeOpen: function() {
						      // just a hack that adds mfp-anim class to markup 
						       this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
						    }
						},
					});
			});
			$('.portfolio-grid-light-gallery').each(function(){
				$(this).find('a[data-rel^="lightbox"]:not(".kt-no-lightbox")').magnificPopup({
					type: 'image',
					gallery: {
						enabled:true
						},
						image: {
							titleSrc: function(item) {
									return item.el.parents('.portfolio_item').attr('data-post-title');
							}
						},
					removalDelay: 500, //delay removal by X to allow out-animation
					callbacks: {
						    beforeOpen: function() {
						      // just a hack that adds mfp-anim class to markup 
						       this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
						    }
						},
					});
			});
			$('.portfolio-light-gallery').each(function(){
				$(this).magnificPopup({
					delegate: 'a',
					type: 'image',
					gallery: {
						enabled:true,
					},
					image: {
							titleSrc: function(item) {
									return item.el.parents('.portfolio_item').attr('data-post-title');
							}
						},
					
				});
			});
			// Portfolio grid
			$('.portfolio-light-gallery-open').on('click', function(e) {
	    		e.preventDefault();
	    		var gallery = '.'+$(this).data('gallery-id');
	    		var index = $(gallery).find('.slick-current').data('slick-index');
	    		$(gallery).magnificPopup('open', index);
		    });
			// Standard Gallery
			$('#content .gallery').each(function(){
				$(this).find('a[data-rel^="lightbox"]:not(".kt-no-lightbox")').magnificPopup({
					type: 'image',
					gallery: {
						enabled:true
						},
						image: {
							titleSrc: function(item) {
							return item.el.find('img').attr('alt');
							}
						},
					removalDelay: 500, //delay removal by X to allow out-animation
					callbacks: {
						    beforeOpen: function() {
						      // just a hack that adds mfp-anim class to markup 
						       this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
						    }
						},
					});
			});
			// re-init-infinte-scroll
			function kad_infintescroll_newelements() {
				$('a[data-rel^="lightbox"]:not(".kt-no-lightbox")').magnificPopup({type:'image'});
				$('.kad-light-gallery').each(function(){
				$(this).find('a[data-rel^="lightbox"]:not(".kt-no-lightbox")').magnificPopup({
					type: 'image',
					gallery: {
						enabled:true
						},
						image: {
							titleSrc: function(item) {
								if(item.el.find('img').attr('data-caption')) {
									return item.el.find('img').attr('data-caption');
								} else {
									return item.el.find('img').attr('alt');
								}
							}
						}
					});
				});
			}
			$(window).on("infintescrollnewelements", function( event ) {
				kad_infintescroll_newelements();
			});
			// Video Lightbox
			$(".ktvideolight").magnificPopup({
				type:'iframe'
			});
		}
		// Modal Lightbox
	    $('.kt-pop-modal').magnificPopup({
	    	type: 'inline',
	    	callbacks: {
				    open: function() {
				    	setTimeout(function() { $('.mfp-inline-holder input')[0].focus() }, 100);
				    }
			},
    	});
    	$('.kt-sldr-pop-modal').on('click', function(e) {
    		e.preventDefault();
    		var direction = $(this).data('pop-sldr-direction');
    		var bodyclass = $(this).data('pop-sldr-class');
    		var popsrc = $(this).data('mfp-src');
	    	$.magnificPopup.open({
	    		items: {
                    type: 'inline',
		    		src:popsrc,
                },
		    	removalDelay: 200,
		    	mainClass: function(item) {
							return bodyclass +' sldr-align-'+ direction + ' mfp-slide';
							},
		    	callbacks: {
				    beforeOpen: function() {
				      $('body').addClass('mag-pop-sldr-open-'+direction);
				      $('body').addClass(bodyclass);
				    },
				    beforeClose: function() {
				       $('body').removeClass('mag-pop-sldr-open-'+direction);
				       $('body').removeClass(bodyclass);
				    },
				  },
				  closeBtnInside: false,
				  closeMarkup: '<div class="sldr-close-container kad-mobile-header-height"><button class="sldr-close"><span></span><span></span><span></span></button></div>',
	    	});
	    });
		$(".no-lightbox").magnificPopup({
			disableOn: function() {
		 		return false;
			}
		});
		/*
		*
		* Header Parallax
		*/
		$('.kad-ascend-parallax').each(function(){
			var $ypos = $(this).css('background-position-y');
			var $xpos = $(this).css('background-position-x');
			var $bgobj = $(this);
			$('.kad-ascend-parallax').ascend_appear(function() {
		        $(window).scroll(function() {
		            var yPos =  'calc(' + $ypos + ' - ' + ($(window).scrollTop() / 5) + 'px)'; 
		            var coords = $xpos + ' ' + yPos;
		            $bgobj.css({ backgroundPosition: coords });
		        });
		    },{accX: 0, accY: -25},'easeInCubic');
	    });  
		
		/*
		*
		* Slider
		*/
	     function kt_slick_slider_init(container) {
		 	var slider_speed = container.data('slider-speed'),
			slider_animation = container.data('slider-fade'),
			slider_animation_speed = container.data('slider-anim-speed'),
			slider_arrows = container.data('slider-arrows'),
			slider_auto = container.data('slider-auto'),
			slider_type = container.data('slider-type'),
			slider_dots = container.data('slider-dots');
			if(slider_dots == '' || slider_dots == 'false') {
				slider_dots = false;
			} else {
				slider_dots = true;
			}
			var slick_rtl = false;
			if($('body.rtl').length >= 1){
				slick_rtl = true;
			} 
			if(slider_type == 'carousel') {
				var sliders_show = container.data('slides-to-show');
				if(sliders_show == null) {sliders_show = 1;}
				container.slick({
					slidesToScroll: 1,
					slidesToShow: sliders_show ,
					centerMode: true,
					variableWidth: true,
					arrows: slider_arrows,
					speed: slider_animation_speed,
					autoplay: slider_auto,
					autoplaySpeed: slider_speed,
					fade: slider_animation,
					pauseOnHover:false,
					rtl:slick_rtl, 
					dots: true,
				});
			}else if(slider_type == 'content-carousel') {
				var xxl = container.data('slider-xxl'),
					xl = container.data('slider-xl'),
					md = container.data('slider-md'),
					sm = container.data('slider-sm'),
					xs = container.data('slider-xs'),
					ss = container.data('slider-ss'),
					scroll = container.data('slider-scroll');
					if(scroll !== 1){
						var scroll_xxl = xxl,
							scroll_xl  = xl,
							scroll_md  = md,
							scroll_sm  = sm,
							scroll_xs  = xs,
							scroll_ss  = ss;
					} else {
						var scroll_xxl = 1,
							scroll_xl  = 1,
							scroll_md  = 1,
							scroll_sm  = 1,
							scroll_xs  = 1,
							scroll_ss  = 1;
					}
				container.slick({
					slidesToScroll: scroll_xxl,
					slidesToShow: xxl,
					arrows: slider_arrows,
					speed: slider_animation_speed,
					autoplay: slider_auto,
					autoplaySpeed: slider_speed,
					fade: slider_animation,
					pauseOnHover:false,
					dots:slider_dots,
					rtl:slick_rtl, 
					responsive: [
							    {
							      breakpoint: 1499,
							      settings: {
							        slidesToShow: xl,
							        slidesToScroll: scroll_xl,
							      }
							    },
							    {
							      breakpoint: 1199,
							      settings: {
							        slidesToShow: md,
							        slidesToScroll: scroll_md,
							      }
							    },
							    {
							      breakpoint: 991,
							      settings: {
							        slidesToShow: sm,
							        slidesToScroll: scroll_sm,
							      }
							    },
							    {
							      breakpoint: 767,
							      settings: {
							        slidesToShow: xs,
							        slidesToScroll: scroll_xs,
							      }
							    },
							    {
							      breakpoint: 543,
							      settings: {
							        slidesToShow: ss,
							        slidesToScroll: scroll_ss,
							      }
							    }
							  ]
				});
			} else if(slider_type == 'thumb') {
				var thumbid = container.data('slider-thumbid'),
					thumbsshowing = container.data('slider-thumbs-showing'),
					sliderid = container.attr('id');
				container.slick({
					slidesToScroll: 1,
					slidesToShow: 1,
					arrows: slider_arrows,
					speed: slider_animation_speed,
					autoplay: slider_auto,
					autoplaySpeed: slider_speed,
					fade: slider_animation,
					pauseOnHover:false,
					adaptiveHeight: true,
					dots: false,
					rtl:slick_rtl, 
					asNavFor: thumbid,
				});
				$(thumbid).slick({
				  	slidesToShow:thumbsshowing,
				  	slidesToScroll: 1,
				  	asNavFor: '#'+sliderid,
				  	dots: false,
				  	rtl:slick_rtl, 
				  	centerMode: false,
				  	focusOnSelect: true
				});
			} else {
			 	container.slick({
			 		slidesToShow: 1,
					slidesToScroll: 1,
					arrows: slider_arrows,
					speed: slider_animation_speed,
					autoplay: slider_auto,
					autoplaySpeed: slider_speed,
					fade: slider_animation,
					pauseOnHover:false,
					rtl:slick_rtl, 
					adaptiveHeight: true,
					dots: true,
				});
			 }
	    }
	    $('.kt-slickslider').each(function(){
	    	var container = $(this);
	    	var slider_initdelay = container.data('slider-initdelay');
	    	if(slider_initdelay == null || slider_initdelay == '0') {
	     	 	kt_slick_slider_init(container);
	    	} else {
	    		setTimeout(function() {
	    			kt_slick_slider_init(container);
	    		}, slider_initdelay);
	    	}
	    });
		
		if($('body').hasClass('kt-use-select2')) {
			if( $(window).width() > 790 && !kt_isMobile.any()) {
				$('select:not(#rating):not(.kt-no-select2)').select2({minimumResultsForSearch: -1 });
				$('select.country_select').select2();
				$('select.state_select').select2();
			}
		}


	// Sidebar Menu
	// Check if the side header is larger than browser window in height and make it scrolling if needed
	function scrollable_vertical_header() {
		var vh = $( '#kad-vertical-menu' );
		var win_height = $(window).height();
		var topOffest = $('body').hasClass('admin-bar') ? 32 : 0;
		var vh_height = $('.kad-scrollable-area').outerHeight();
		var actual_win_height = win_height - topOffest;
		var scrolled = $(window).scrollTop();
		var heightofchild = $('.nav-main .sf-vertical ul').outerHeight();
		if(vh_height > actual_win_height) {
		 	if(actual_win_height + scrolled >= vh_height) {
				vh.css('position','fixed');
				vh.css('bottom','0');
				vh.css('top','auto');
				vh.css('height','auto');
			} else {
				vh.css('position','absolute');
				vh.css('bottom','auto');
				vh.css('top','auto');
				vh.css('height','auto');
			}
		} else {
			vh.css('position','fixed');
			vh.css('bottom','');
			vh.css('top','');
			vh.css('height','');
		}
	}
	if($('#kad-vertical-menu').length) {
		$(this).waitForImages(scrollable_vertical_header());
		$(window).scroll(scrollable_vertical_header);
	}
	// Check that the Submenus don't run off page.
	function scrollable_vertical_header_submenus() {
		var win_height = $(window).height();
		var topOffest = $('body').hasClass('admin-bar') ? 32 : 0;
		var vh_height = $('.kad-scrollable-area').outerHeight();
		var actual_win_height = win_height - topOffest;
		if(vh_height > actual_win_height) {
			var measure = vh_height;
		} else {
			var measure = actual_win_height;
		}
		$('.kad-relative-vertical-content .sf-vertical > li > ul').each(function(){
			var height = $(this).outerHeight();
			var offset = $(this).parent('li').offset().top;

			if(height + offset > measure) {
				$(this).css('top', 'auto');
				$(this).css('bottom', '0');
			} else {
				$(this).css('top', '');
				$(this).css('bottom', '');
			}
		});
	}
	if($('#kad-vertical-menu').length) {
		$(this).waitForImages(scrollable_vertical_header_submenus());
		$(window).on("debouncedresize", function( event ) {scrollable_vertical_header_submenus();});
	}
	// Check that the Submenus don't run off page.
	function topbar_header_submenus() {
		var win_width = $(window).width();
		$('#topbar .sf-menu-normal > li > ul').each(function(){
			var width = $(this).outerWidth();
			var offset = $(this).parent('li').offset().left;

			if(width + offset > win_width) {
				$(this).addClass('kt-subright');
			} else {
				$(this).removeClass('kt-subright');
			}
		});
	}
	if($('#topbar .sf-menu-normal').length) {
		topbar_header_submenus();
		$(window).on("debouncedresize", function( event ) {topbar_header_submenus();});
	}
	// Check that the Submenus don't run off page.
	function main_header_submenus() {
		var win_width = $(window).width();
		$('.kad-header-menu-outer .sf-menu-normal > li > ul').each(function(){
			var width = $(this).outerWidth();
			var offset = $(this).parent('li').offset().left;

			if(width + offset > win_width) {
				$(this).addClass('kt-subright');
			} else {
				$(this).removeClass('kt-subright');
			}
		});
		$('.kad-header-menu-outer .sf-menu-normal > li.kt-lgmenu > ul').each(function(){
			var width = $(this).outerWidth()/2;
			var offset = $(this).parent('li').offset().left;
			if(width + offset > win_width) {
				$(this).addClass('kt-subright');
			} else {
				$(this).removeClass('kt-subright');
			}
		});
	}
	if($('.kad-header-menu-outer .sf-menu-normal').length) {
		main_header_submenus();
		$(window).on("debouncedresize", function( event ) {main_header_submenus();});
	}
	// Check that the Submenus don't run off page.
	function second_header_submenus() {
		var win_width = $(window).width();
		$('.nav-second .sf-menu-normal > li > ul').each(function(){
			var width = $(this).outerWidth();
			var offset = $(this).parent('li').offset().left;

			if(width + offset > win_width) {
				$(this).addClass('kt-subright');
			} else {
				$(this).removeClass('kt-subright');
			}
		});
		$('.nav-second .sf-menu-normal > li.kt-lgmenu > ul').each(function(){
			var width = $(this).outerWidth()/2;
			var offset = $(this).parent('li').offset().left;

			if(width + offset > win_width) {
				$(this).addClass('kt-subright');
			} else {
				$(this).removeClass('kt-subright');
			}
		});
	}
	if($('.nav-second .sf-menu-normal').length) {
		second_header_submenus();
		$(window).on("debouncedresize", function( event ) {second_header_submenus();});
	}
	// Responsive Text for Titles
	if($('.titleclass').length) {
		$('.titleclass .entry-title').each(function(){
			var maxsize = $(this).data('max-size'),
			minsize = $(this).data('min-size');
			$(this).kt_fitText(1.4, { minFontSize: minsize, maxFontSize: maxsize, maxWidth: 1140, minWidth: 400 });
		});
		if($('.titleclass .subtitle').length) {
			$('.titleclass .subtitle').each(function(){
				var sub_maxsize = $(this).data('max-size'),
				sub_minsize = $(this).data('min-size');
				$(this).kt_fitText(1.5, { minFontSize: sub_minsize, maxFontSize: sub_maxsize, maxWidth: 1140, minWidth: 400  });
			});
		}
	}
	// Responsive Text for call To action
	if($('.kt-ctaw .kt-call-to-action-title').length) {
		$('.kt-ctaw .kt-call-to-action-title').each(function(){
			var maxsize = $(this).data('max-size'),
				minsize = $(this).data('min-size');
			$(this).kt_fitText(1.3, { minFontSize: minsize, maxFontSize: maxsize, maxWidth: 1140, minWidth: 400 });
		});
	}
	if($('.kt-ctaw .kt-call-to-action-subtitle').length) {
			$('.kt-ctaw .kt-call-to-action-subtitle').each(function(){
				var sub_maxsize = $(this).data('max-size'),
				sub_minsize = $(this).data('min-size');
				$(this).kt_fitText(1.5, { minFontSize: sub_minsize, maxFontSize: sub_maxsize, maxWidth: 1140, minWidth: 400  });
			});
		}
	if($('.kt-ctaw .kt-call-to-action-abovetitle').length) {
		$('.kt-ctaw .kt-call-to-action-abovetitle').each(function(){
			var sub_maxsize = $(this).data('max-size'),
			sub_minsize = $(this).data('min-size');
			$(this).kt_fitText(1.5, { minFontSize: sub_minsize, maxFontSize: sub_maxsize, maxWidth: 1140, minWidth: 400  });
		});
	}
	// Map
	$('.kt-map').click(function () {
	    $('.kt-map iframe').css("pointer-events", "auto");
	});

	$( ".kt-map" ).mouseleave(function() {
	  $('.kt-map iframe').css("pointer-events", "none"); 
	});

	// Sticky Header
	function kt_sticky_header(item) {
		var shrink = $('.kt-header-position-above').attr('data-shrink'),
		shrink_height = $('.kt-header-position-above').attr('data-shrink-height'),
		startheight = $('.kt-header-position-above').attr('data-start-height'),
		win = $(window),
		topOffest = $('body').hasClass('admin-bar') ? 32 : 0,
		wait_height = 0;
		if(item == 'header') {
			var stickyitem = $('.kad-header-menu-outer');
			wait_height = $('#topbar').height();
			var scrolled_up_height = (startheight - shrink_height) + stickyitem.height();
		} else if(item == 'header_top') {
			var stickyitem = $('.kad-header-topbar-primary-outer');
			var scrolled_up_height = (startheight - shrink_height) + stickyitem.height();
		} else if(item == 'header_all') {
			var stickyitem = $('.kt-header-position-above');
			var scrolled_up_height = (startheight - shrink_height) + stickyitem.height();
		} else if(item == 'topbar') {
			var stickyitem = $('.topbarclass');
			shrink = 0;
		} else if(item == 'secondary') {
			var stickyitem = $('.second-navclass');
			shrink = 0;
		}

		set_height = function() {
				var scrollt = win.scrollTop(),
                newH = startheight;
                scrollt = scrollt - wait_height;
                scrollt = scrollt/2;
                if(scrollt < 0) {
                	scrollt = 0;
                }
                if((startheight - scrollt) > shrink_height) {
                    newH = startheight - scrollt;
                    stickyitem.removeClass('kt-item-shrunk');
                } else {
                    newH = shrink_height;
                    stickyitem.addClass('kt-item-shrunk');
                }
                $('.kad-header-height').each(function(){
                	$(this).css({'height': newH + 'px'});
                });
            };
		if (shrink == 1) {
			stickyitem.sticky({topSpacing:topOffest, zIndex:1000});
			if( $('#sticky-wrapper').hasClass('is-sticky') ) {
				$('#sticky-wrapper').css({'height': scrolled_up_height + 'px'});
			}
			win.scroll(set_height);
		} else {
			stickyitem.sticky({topSpacing:topOffest, zIndex:1000});
		}
	}
	if( $('.kt-header-position-above' ).length ){
		var stickyitem = $('.kt-header-position-above').attr('data-sticky');
		if(stickyitem != 'none') {
			kt_sticky_header(stickyitem);
			$(window).on( "debouncedresize" , function( event ) { kt_sticky_header( stickyitem ); });
		}
	}
	if( ( $('.kt-header-position-left' ).length || $('.kt-header-position-right').length) && $('.second-navclass').length) {
		var stickyitem = $('.second-navclass').attr('data-sticky');
		if(stickyitem == 'second') {
			var topOffest = $('body').hasClass('admin-bar') ? 32 : 0;
			$('.second-navclass').sticky({topSpacing:topOffest, zIndex:1000});
		}
	}
	function kad_mobile_sticky_header() {
		var mobile_header_height = $('#kad-mobile-banner').height(),
			topOffest = $('body').hasClass('admin-bar') ? 32 : 0,
			mobilestickyheader = $('#kad-mobile-banner').attr('data-mobile-header-sticky');

		if($(window).width() < 600 && $('body').hasClass('admin-bar')) {
			topOffest = 0;
		} else if ($(window).width() < 782 && $('body').hasClass('admin-bar')) {
			topOffest = 46;
		}
		if (mobilestickyheader == 1) {
			$('#kad-mobile-banner').sticky({topSpacing:topOffest, zIndex:1000});
		}
	}
	kad_mobile_sticky_header();
	$(window).on("debouncedresize", function( event ) {kad_mobile_sticky_header();});

	function trans_header_padding() {
		var padding_top = 0
		if(window.innerWidth < 992) {
			padding_top = $('#kad-mobile-banner').height();
		} else {
			if($('.kt-header-position-above').length) {
				padding_top = $('.kt-header-position-above').height();
			} else if($('.second-navclass').length) {
				padding_top = $('.second-navclass').height();
			}
		}
		$('.titleclass').css('padding-top', padding_top + 'px');
	}
	if($('body.trans-header').length) {
		trans_header_padding();
		$(window).on("debouncedresize", function( event ) {trans_header_padding();});
	}
	
	//Superfish Menu
	$('ul.sf-menu.sf-menu-normal').ktsuperfish({
		delay:       300,
		animation:   {top:'100%', opacity:'show'},
		animationOut:  {top:'120%',opacity:'hide'}, 
		cssArrows:false,
		speed:       'fast'
	});
	$('ul.sf-menu.sf-vertical').ktsuperfish({
		delay:       300,
		animation:   {left:'100%', opacity:'show'},
		animationOut:  {left:'105%', opacity:'hide'}, 
		cssArrows:false,
		speed:       'fast'
	});
	if(kt_isMobile.any() ) {
		$('ul.sf-menu li.sf-dropdown > a').on("tap",function (e) {
			e.preventDefault();
		});
	}
	function local_scroll_header_offset() {
		var offset = 0;
		if($('#kad-header-menu-sticky-wrapper').length) {
			offset = $('#kad-header-menu-sticky-wrapper > header').height();
		}
		if($('.headerclass-outer .sticky-wrapper').length) {
			offset = offset + $('.headerclass-outer .sticky-wrapper > div').height();
		}
		if($('.outside-second .sticky-wrapper').length) {
			offset = offset + $('.outside-second .sticky-wrapper > div').height();
		}
		if($('#kad-mobile-banner-sticky-wrapper').length) {
			offset = offset + $('#kad-mobile-banner-sticky-wrapper > div').height();
		}
		$('#kad-header-menu, #kad-mobile-banner, #kad-vertical-menu, .outside-second, .kt-mobile-menu, .kad-slider, .kt-local-scroll').localScroll({
			offset: -(offset),
			onBefore: function(target, settings) {
				var magnificPopup = $.magnificPopup.instance; 
				magnificPopup.close(); 
			},
			hash: true,
		});
	}
	if($('body.kt-anchor-scroll').length) {
		local_scroll_header_offset();
	}
	function kad_fullwidth_panel() {
		$('.kt-custom-row-full-stretch').each(function(){
			var margins = $('#inner-wrap').width() - $(this).parents('#content').width();
			$(this).css({'margin-left': '-' + margins/2 + 'px'});
			$(this).css({'margin-right': '-' + margins/2 + 'px'});
			$(this).css({'width': + $('#inner-wrap').width() + 'px'});
			$(this).css({'visibility': 'visible'});
			$(this).css({'opacity': '1'});
		});
		$('.kt-custom-row-full').each(function(){
			var margins = $('#inner-wrap').width() - $(this).parents('#content').width();
			$(this).css({'padding-left': margins/2 + 'px'});
			$(this).css({'padding-right': margins/2 + 'px'});
			$(this).css({'margin-left': '-' + margins/2 + 'px'});
			$(this).css({'margin-right': '-' + margins/2 + 'px'});
			$(this).css({'visibility': 'visible'});
			$(this).css({'opacity': '1'});
		});
	}
	kad_fullwidth_panel();
	$(window).on("debouncedresize", function( event ) {
		kad_fullwidth_panel();
	});
	$( window ).on( 'panelsStretchRows', kad_fullwidth_panel );
	


	$('.siteorigin-panels-stretch').each(function(){
		$(this).css({'visibility': 'visible'});
		$(this).css({'opacity': '1'});
	});
	
    if($(window).width() > 790) {
           //fadein
        $('.kt-animate-fade-in-up').each(function() {
            $(this).ascend_appear(function() {
            	$(this).animate({'opacity' : 1, 'top' : 0},900,'swing');},{accX: 0, accY: -25},'easeInCubic');
        });
        $('.kt-animate-fade-in-down').each(function() {
            $(this).ascend_appear(function() {
            	$(this).animate({'opacity' : 1, 'top' : 0},900,'swing');},{accX: 0, accY: -25},'easeInCubic');
        });
        $('.kt-animate-fade-in-left').each(function() {
            $(this).ascend_appear(function() {
            	$(this).animate({'opacity' : 1, 'left' : 0},900,'swing');},{accX: -25, accY: 0},'easeInCubic');
        });
        $('.kt-animate-fade-in-right').each(function() {
            $(this).ascend_appear(function() {
            	$(this).animate({'opacity' : 1, 'right' : 0},900,'swing');},{accX: -25, accY: 0},'easeInCubic');
        });
        $('.kt-animate-fade-in').each(function() {
            $(this).ascend_appear(function() {
            	$(this).animate({'opacity' : 1 },900,'swing');
            });
        });
    } else {
    	$('.kt-animate-fade-in-up').each(function() {
    		$(this).animate({'opacity' : 1, 'top' : 0});
    	});
    	$('.kt-animate-fade-in-down').each(function() {
    		$(this).animate({'opacity' : 1, 'top' : 0});
    	});
    	$('.kt-animate-fade-in-left').each(function() {
    		$(this).animate({'opacity' : 1, 'left' : 0});
    	});
    	$('.kt-animate-fade-in-right').each(function() {
    		$(this).animate({'opacity' : 1, 'right' : 0});
    	});
    	$('.kt-animate-fade-in').each(function() {
    		$(this).animate({'opacity' : 1});
    	});
    }
    $('.kt-pb-animation').each(function() {
    	 $(this).ascend_appear(function() {
    	 	$(this).addClass('kt-pb-animate');
    	 },{accX: -25, accY: 0},'easeInCubic');
    });
    if ($('.blog_carousel').length) {
		var bmatchheight = $('.blog_carousel').data('iso-match-height');
		if(bmatchheight == '1') {
	 		$('.blog_carousel .blog_item').matchHeight();
	 	}
	}
	if ($('.kt-home-iconmenu-container').length) {
		var equalheight = $('.kt-home-iconmenu-container').data('equal-height');
		if(equalheight == '1') {
	 		$('.kt-home-iconmenu-container .home-icon-item').matchHeight();
	 	}
	}
	// Init tiles
	$('.init-tiles-justified').each(function(){
		if ($.fn.justifiedGallery) { 
	    	var container = $(this),
	    	height = $(this).data('gallery-height'),
	    	lastrow = $(this).data('gallery-lastrow'),
	    	margins = $(this).data('gallery-margins');
	    	container.waitForImages( function(){
		    	container.justifiedGallery({
		    		rowHeight: height,
					lastRow : lastrow,
					captions:false,
					margins:margins,
					//selector:'.g_item',
					waitThumbnailsLoad:false,
				});
		    });
	    }
	});
	
	$('.init-tiles-justified').each(function(){
		$(this).on('jg.complete', function (e) {
		    $('.kt-slickslider.slick-initialized').each(function(){
				$(this).slick('refresh');
			});
		});
	});
	$('.init-tiles-justified').each(function(){
		$(this).on('jg.resize', function (e) {
		    $('.kt-slickslider.slick-initialized').each(function(){
				$(this).slick('refresh');
			});
		});
	});
	
     //init isotope
    $('.init-isotope').each(function(){
    	var isocontainer = $(this),
    	iso_selector = $(this).data('iso-selector'),
    	iso_style = $(this).data('iso-style'),
    	iso_filter = $(this).data('iso-filter'),
    	matchheight = $(this).data('iso-match-height');
    	if(iso_style == null) {iso_style = 'masonry';}
    	if(iso_filter == null) {iso_filter = 'false';}
    	if(matchheight == null) {matchheight = 'false';}
    	if($('body.rtl').length >= 1){
			var iso_rtl = false;
		} else {
			var iso_rtl = true;
		}
		isocontainer.waitForImages( function(){
			if(matchheight == '1') {
	 			$('.init-isotope .blog_item').matchHeight();
	 		}
	 		if(iso_style == 'matchheight') {
				var isochild = isocontainer.find('.kt_item_fade_in');
				isochild.each(function(i){
						$(this).delay(i*75).animate({'opacity':1},175);
				});
	 		} else {
				isocontainer.isotopeb({masonry: {columnWidth: iso_selector}, layoutMode:iso_style, itemSelector: iso_selector, transitionDuration: '0.8s', isOriginLeft: iso_rtl});
					var isochild = isocontainer.find('.kt_item_fade_in');
						isochild.each(function(i){
										$(this).delay(i*75).animate({'opacity':1},175);
						});
				if(iso_filter == true) {
					var thisparent = isocontainer.parents('.main');
					var thisfilters = thisparent.find('#filters');
					if(thisfilters.length) {
					thisfilters.on( 'click', 'a', function( event ) {
							var filtr = $(this).attr('data-filter');
							isocontainer.isotopeb({ filter: filtr });
							isocontainer.find('.kt-slickslider').each(function(){
								$(this).slick('setPosition');
							});
							return false; 
						});
						var $optionSets = $('#options .option-set'),
		          		$optionLinks = $optionSets.find('a');	
						$optionLinks.click(function(){ 
							var $this = $(this); if ( $this.hasClass('selected') ) {return false;}
							var $optionSet = $this.parents('.option-set'); $optionSet.find('.selected').removeClass('selected'); $this.addClass('selected');
						});
					}
				}
			}
		});
				
	});
	//init init-isotope-intrinsic
    $('.init-isotope-intrinsic').each(function(){
    	var isocontainer = $(this),
    	iso_selector = $(this).data('iso-selector'),
    	iso_style = $(this).data('iso-style'),
    	iso_filter = $(this).data('iso-filter');
    	if($('body.rtl').length >= 1){
			var iso_rtl = false;
		} else {
			var iso_rtl = true;
		}
		isocontainer.isotopeb({masonry: {columnWidth: iso_selector}, layoutMode:iso_style, itemSelector: iso_selector, transitionDuration: '0.8s', isOriginLeft: iso_rtl});
			var isochild = isocontainer.find('.kt_item_fade_in');
				isochild.each(function(i){
								$(this).delay(i*75).animate({'opacity':1},175);
				});
		if(iso_filter == true) {
			var thisparent = isocontainer.parents('.main');
			var thisfilters = thisparent.find('#filters');
			if(thisfilters.length) {
				thisfilters.on( 'click', 'a', function( event ) {
						event.preventDefault();
						var filtr = $(this).attr('data-filter');
						isocontainer.isotopeb({ filter: filtr });
						isocontainer.find('.kt-slickslider').each(function(){
							$(this).slick('setPosition');
						});
				});
				var $optionSets = $('#options .option-set'),
          		$optionLinks = $optionSets.find('a');	
				$optionLinks.click(function(){ 
					var $this = $(this); if ( $this.hasClass('selected') ) {return false;}
					var $optionSet = $this.parents('.option-set'); $optionSet.find('.selected').removeClass('selected'); $this.addClass('selected');
				});
			}
		}
				
	});
 $('.init-mosaic-isotope').each(function(){
    	var isocontainer = $(this),
    	iso_selector = $(this).data('iso-selector'),
    	mosaic_selector = $(this).data('mosaic-selector'),
    	iso_style = $(this).data('iso-style'),
    	iso_filter = $(this).data('iso-filter');
    	if($('body.rtl').length){
			var iso_rtl = false;
		} else {
			var iso_rtl = true;
		}
		//init
		isocontainer.isotopeb({
			//masonry: {columnWidth: mosaic_selector},
			layoutMode: 'packery',
			percentPosition: true,
			itemSelector: iso_selector, 
			transitionDuration: '.8s', 
			packery: {
			  horizontal: true,
			  columnWidth: mosaic_selector
			},
			isOriginLeft: iso_rtl
		});
		// fade
			var isochild = isocontainer.find('.kt_item_fade_in');
				isochild.each(function(i){
								$(this).delay(i*150).animate({'opacity':1},350);
				});

		if(iso_filter == true) {
			var thisparent = isocontainer.parents('.main');
			var thisfilters = thisparent.find('#filters');
			if(thisfilters.length) {
				thisfilters.on( 'click', 'a', function( event ) {
					event.preventDefault();
					var filtr = $(this).attr('data-filter');
					isocontainer.isotopeb({ filter: filtr });
					isocontainer.find('.kt-slickslider').each(function(){
						$(this).slick('setPosition');
					});
				});
				var $optionSets = $('#options .option-set'),
          		$optionLinks = $optionSets.find('a');	
				$optionLinks.click(function(){ 
					var $this = $(this); if ( $this.hasClass('selected') ) {return false;}
					var $optionSet = $this.parents('.option-set'); $optionSet.find('.selected').removeClass('selected'); $this.addClass('selected');
				});
			}
		}
				
	});
// Toggle 
if ($('.kt_product_toggle_container').length) {
			var thistoggleon = $('.kt_product_toggle_container .toggle_list'),
			thistoggleoff = $('.kt_product_toggle_container .toggle_grid');
			thistoggleon.click(function(){
					if ( $(this).hasClass('toggle_active') ) {return false;}
					$(this).parents('.kt_product_toggle_container').find('.toggle_active').removeClass('toggle_active');
					$(this).addClass('toggle_active');
					if ($('.kad_product_wrapper').length) { 
						$('.kad_product_wrapper').addClass('shopcolumn1');
						$('.kad_product_wrapper').addClass('tfsinglecolumn');
						var $container = $('.kad_product_wrapper'),
						iso_selector = $('.kad_product_wrapper').data('iso-selector');
						$container.isotopeb({masonry: {columnWidth: iso_selector}, transitionDuration: '.4s'});
					}
					  return false; 
				});
			thistoggleoff.click(function(){
					if ( $(this).hasClass('toggle_active') ) {return false;}
					$(this).parents('.kt_product_toggle_container').find('.toggle_active').removeClass('toggle_active');
					$(this).addClass('toggle_active');
					if ($('.kad_product_wrapper').length) { 
						$('.kad_product_wrapper').removeClass('shopcolumn1');
						$('.kad_product_wrapper').removeClass('tfsinglecolumn');
						var $container = $('.kad_product_wrapper'),
						iso_selector = $('.kad_product_wrapper').data('iso-selector');
						$container.isotopeb({masonry: {columnWidth: iso_selector}, transitionDuration: '.4s'});
					}
					  return false; 
				});
			}
	if ($('.kt_product_toggle_container_list').length) {
			var thistoggleon = $('.kt_product_toggle_container_list .toggle_list'),
			thistoggleoff = $('.kt_product_toggle_container_list .toggle_grid');
			thistoggleon.click(function(){
					if ( $(this).hasClass('toggle_active') ) {return false;}
					$(this).parents('.kt_product_toggle_container_list').find('.toggle_active').removeClass('toggle_active');
					$(this).addClass('toggle_active');
					if ($('.kad_product_wrapper').length) { 
						$('.kad_product_wrapper').addClass('shopcolumn1');
						$('.kad_product_wrapper').addClass('tfsinglecolumn');
						$('.kad_product_wrapper').removeClass('kt_force_grid_three');
						var $container = $('.kad_product_wrapper'),
						iso_selector = $('.kad_product_wrapper').data('iso-selector');
						$container.isotopeb({masonry: {columnWidth: iso_selector}, transitionDuration: '.4s'});
					}
					  return false; 
				});
			thistoggleoff.click(function(){
					if ( $(this).hasClass('toggle_active') ) {return false;}
					$(this).parents('.kt_product_toggle_container_list').find('.toggle_active').removeClass('toggle_active');
					$(this).addClass('toggle_active');
					if ($('.kad_product_wrapper').length) { 
						$('.kad_product_wrapper').removeClass('shopcolumn1');
						$('.kad_product_wrapper').removeClass('tfsinglecolumn');
						$('.kad_product_wrapper').addClass('kt_force_grid_three');
						var $container = $('.kad_product_wrapper'),
						iso_selector = $('.kad_product_wrapper').data('iso-selector');
						$container.isotopeb({masonry: {columnWidth: iso_selector}, transitionDuration: '.4s'});
					}
					  return false; 
				});
	}
if ($('.woocommerce-tabs .reinit-isotope').length) {
		var $container = $('.reinit-isotope'),
		iso_selector = $('.reinit-isotope').data('iso-selector');
		function woo_refreash_iso(){
			$container.isotopeb({masonry: {columnWidth: iso_selector}, transitionDuration: '0s'});
		}
	$('.woocommerce-tabs ul.tabs a' ).click( function() {
		setTimeout(woo_refreash_iso, 50);
	});
}
if ($('.panel-body .reinit-isotope').length) {
		var $container = $('.reinit-isotope'),
		iso_selector = $('.reinit-isotope').data('iso-selector');
		$('.panel-group').on('shown.bs.collapse', function  (e) {
		$container.isotopeb({masonry: {columnWidth: iso_selector}, transitionDuration: '0s'});
		});
	}
if ($('.tab-pane .reinit-isotope').length) {
		$('.tab-pane .reinit-isotope').each(function(){
		var $container = $(this),
		iso_selector = $(this).data('iso-selector');
		$('.kt-sc-tabs').on('shown.bs.tab', function  (e) {
			$container.isotopeb({masonry: {columnWidth: iso_selector}, transitionDuration: '0s'});
		});
	});
}
function kad_re_init_iso() {
	if ($('.kt-panel-row-full-stretch .reinit-isotope').length) {
		$('.kt-panel-row-full-stretch .reinit-isotope').each(function(){
			var $container = $(this),
			iso_selector = $(this).data('iso-selector');
			$container.isotopeb({masonry: {columnWidth: iso_selector}, transitionDuration: '0s'});
		});
	}
}

$( window ).on( 'panelsStretchRows', kad_re_init_iso );
// Carousels and Sliders in Tabs
if ($('.tab-pane .kt-slickslider').length) {
		$('.tab-pane .kt-slickslider').each(function(){
		var $container = $(this);
		$('.kt-sc-tabs').on('shown.bs.tab', function  (e) {
			$container.slick('refresh');
		});
	});
}
// Carousels and Slider in Accordions
if ($('.panel-body .kt-slickslider').length) {
	$('.panel-body .kt-slickslider').each(function(){
		var $container = $(this);
		$('.panel-group').on('shown.bs.collapse', function  (e) {
			$container.slick('refresh');
		});
	});
}

    jQuery('.init-infinit').each(function(){
 		var $container = $(this),
 	  	nextSelector = $(this).data('nextselector'), 
      	navSelector = $(this).data('navselector'), 
      	itemSelector = $(this).data('itemselector'),
      	itemloadselector = $(this).data('itemloadselector'),
      	matchheight = $(this).data('iso-match-height');
      	if( $(nextSelector).length ) {
		  	$container.infiniteScroll({
				path: nextSelector,
				append: itemSelector,
				checkLastPage: true,
				status: '.scroller-status',
				scrollThreshold: 400,
				loadOnScroll: true,
				history: false,
				hideNav: navSelector,
			});
			$container.on( 'append.infiniteScroll', function( event, response, path, items ) {
				var $newElems = jQuery( items );
				// Stupid Hack for Safari
				$newElems.find('img').each( function() {
					$(this).attr('data-srcset', $(this).attr('srcset'));
					$(this).removeAttr('srcset');
				});
				$newElems.find('img').each( function() {
					$(this).attr('srcset', $(this).attr('data-srcset'));
					$(this).removeAttr('data-srcset');
				});
	      		$newElems.waitForImages(function(){
	      			$newElems.find('.kt-slickslider').each(function(){
				    	var container = $(this);
				    	var slider_initdelay = container.data('slider-initdelay');
				    	if(slider_initdelay == null || slider_initdelay == '0') {
				     	 	kt_slick_slider_init(container);
				    	} else {
				    		setTimeout(function() {
				    			kt_slick_slider_init(container);
				    		}, slider_initdelay);
				    	}
				    });
		    		if(matchheight == '1') {
				       	$container.find('.blog_item').matchHeight();
			 		} else {
				    	$container.isotopeb( 'appended', $newElems );
				    }
					//fadeIn items one by one
					$newElems.each(function(i){
						$(this).find(itemloadselector).delay(i*75).animate({'opacity':1},175);
					});
		    	});
			});
        }
	});
	jQuery('.init-infinit-norm').each(function(){
     	var $container = $(this);
     	nextSelector = $(this).data('nextselector'), 
        navSelector = $(this).data('navselector'), 
        itemSelector = $(this).data('itemselector'),
        itemloadselector = $(this).data('itemloadselector'),
        infiniteloader = $(this).data('infiniteloader');
        if( $(nextSelector).length ) {
        	$container.infiniteScroll({
				  path: nextSelector,
				  append: itemSelector,
				  checkLastPage: true,
				  status: '.scroller-status',
				  scrollThreshold: 400,
				  loadOnScroll: true,
				  history: false,
				  hideNav: navSelector,
			});
			$container.on( 'append.infiniteScroll', function( event, response, path, items ) {
				jQuery(window).trigger( "infintescrollnewelements" );
          		var $newElems = jQuery( items );
          		// Stupid Hack for Safari
          		$newElems.find('img').each( function() {
					$(this).attr('data-srcset', $(this).attr('srcset'));
					$(this).removeAttr('srcset');
				});
				$newElems.find('img').each( function() {
					$(this).attr('srcset', $(this).attr('data-srcset'));
					$(this).removeAttr('data-srcset');
				});
          		$newElems.waitForImages(function(){
	      			$newElems.find('.kt-slickslider').each(function(){
				    	var container = $(this);
				    	var slider_initdelay = container.data('slider-initdelay');
				    	if(slider_initdelay == null || slider_initdelay == '0') {
				     	 	kt_slick_slider_init(container);
				    	} else {
				    		setTimeout(function() {
				    			kt_slick_slider_init(container);
				    		}, slider_initdelay);
				    	}
				    });
	      		});
			});
		}
	});

});

if( !kt_isMobile.any() ) {
	jQuery(document).ready(function ($) {
			jQuery(window).ktstellar({
					   	responsive: false,
					   	horizontalScrolling: false,
						verticalOffset: 150,
						parallaxElements: false,
				});
		jQuery(window).on("debouncedresize", function( event ) {
				jQuery(window).ktstellar('refresh');
		});
		
	});
}
jQuery( window ).load(function () {
	jQuery(document).on( "yith-wcan-ajax-filtered", function () {
		var isocontainer = jQuery('.kad_product_wrapper');
		var iso_selector = isocontainer.data('iso-selector'),
    	iso_style = isocontainer.data('iso-style'),
    	iso_filter = isocontainer.data('iso-filter');
    	if(iso_style == null) {iso_style = 'fitRows';}
    	if(iso_filter == null) {iso_filter = 'false';}
    	matchheight = 'false';
    	if(jQuery('body.rtl').length >= 1){
			var iso_rtl = false;
		} else {
			var iso_rtl = true;
		}
		isocontainer.waitForImages( function(){
			isocontainer.isotopeb({masonry: {columnWidth: iso_selector}, layoutMode:iso_style, itemSelector: iso_selector, transitionDuration: '0.8s', isOriginLeft: iso_rtl});
				var isochild = isocontainer.find('.kt_item_fade_in');
					isochild.each(function(i){
									jQuery(this).delay(i*75).animate({'opacity':1},175);
					});
			if(iso_filter == true) {
				var thisparent = isocontainer.parents('.main');
				var thisfilters = thisparent.find('#filters');
				if(thisfilters.length) {
				thisfilters.on( 'click', 'a', function( event ) {
						var filtr = jQuery(this).attr('data-filter');
						isocontainer.isotopeb({ filter: filtr });
						  return false; 
					});
					var $optionSets = jQuery('#options .option-set'),
	          		$optionLinks = $optionSets.find('a');	
					$optionLinks.click(function(){ 
						var $this = jQuery(this); if ( $this.hasClass('selected') ) {return false;}
						var $optionSet = $this.parents('.option-set'); $optionSet.find('.selected').removeClass('selected'); $this.addClass('selected');
					});
				}
			}
		});
	});
	jQuery(document).on( "post-load", function () {
		var isocontainer = jQuery('.kad_product_wrapper');
		var iso_selector = isocontainer.data('iso-selector'),
    	iso_style = isocontainer.data('iso-style'),
    	iso_filter = isocontainer.data('iso-filter');
    	if(iso_style == null) {iso_style = 'fitRows';}
    	if(iso_filter == null) {iso_filter = 'false';}
			isocontainer.isotopeb('destroy');
			isocontainer.waitForImages( function(){
				isocontainer.isotopeb({masonry: {columnWidth: iso_selector}, layoutMode:iso_style, itemSelector: iso_selector, transitionDuration: '0.8s', isOriginLeft: iso_rtl});
					var isochild = isocontainer.find('.kt_item_fade_in');
					isochild.each(function(i){
						jQuery(this).delay(i*75).animate({'opacity':1},175);
					});
			});
	});
});

