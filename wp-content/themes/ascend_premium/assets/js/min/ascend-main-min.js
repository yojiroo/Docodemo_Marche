var kt_isMobile={Android:function(){return navigator.userAgent.match(/Android/i)},BlackBerry:function(){return navigator.userAgent.match(/BlackBerry/i)},iOS:function(){return navigator.userAgent.match(/iPhone|iPad|iPod/i)},Opera:function(){return navigator.userAgent.match(/Opera Mini/i)},Windows:function(){return navigator.userAgent.match(/IEMobile/i)},any:function(){return kt_isMobile.Android()||kt_isMobile.BlackBerry()||kt_isMobile.iOS()||kt_isMobile.Opera()||kt_isMobile.Windows()}};kt_isMobile.any()||function($,t,e,i){function a(t,e){this.element=t,this.options=$.extend({},n,e),this._defaults=n,this._name=s,this.init()}var s="ktstellar",n={scrollProperty:"scroll",positionProperty:"position",horizontalScrolling:!0,verticalScrolling:!0,horizontalOffset:0,verticalOffset:0,responsive:!1,parallaxBackgrounds:!0,parallaxElements:!0,hideDistantElements:!0,hideElement:function(t){t.hide()},showElement:function(t){t.show()}},o={scroll:{getLeft:function(t){return t.scrollLeft()},setLeft:function(t,e){t.scrollLeft(e)},getTop:function(t){return t.scrollTop()},setTop:function(t,e){t.scrollTop(e)}},position:{getLeft:function(t){return-1*parseInt(t.css("left"),10)},getTop:function(t){return-1*parseInt(t.css("top"),10)}},margin:{getLeft:function(t){return-1*parseInt(t.css("margin-left"),10)},getTop:function(t){return-1*parseInt(t.css("margin-top"),10)}},transform:{getLeft:function(t){var e=getComputedStyle(t[0])[c];return"none"!==e?-1*parseInt(e.match(/(-?[0-9]+)/g)[4],10):0},getTop:function(t){var e=getComputedStyle(t[0])[c];return"none"!==e?-1*parseInt(e.match(/(-?[0-9]+)/g)[5],10):0}}},r={position:{setLeft:function(t,e){t.css("left",e)},setTop:function(t,e){t.css("top",e)}},transform:{setPosition:function(t,e,i,a,s){t[0].style[c]="translate3d("+(e-i)+"px, "+(a-s)+"px, 0)"}}},l=function(){var t=/^(Moz|Webkit|Khtml|O|ms|Icab)(?=[A-Z])/,e=$("script")[0].style,i="",a;for(a in e)if(t.test(a)){i=a.match(t)[0];break}return"WebkitOpacity"in e&&(i="Webkit"),"KhtmlOpacity"in e&&(i="Khtml"),function(t){return i+(i.length>0?t.charAt(0).toUpperCase()+t.slice(1):t)}}(),c=l("transform"),d=$("<div />",{style:"background:#fff"}).css("background-position-x")!==i,h=d?function(t,e,i){t.css({"background-position-x":e,"background-position-y":i})}:function(t,e,i){t.css("background-position",e+" "+i)},p=d?function(t){return"50%"==t.css("background-position-y")?($ypos=t.height()/2,[t.css("background-position-x"),$ypos]):[t.css("background-position-x"),t.css("background-position-y")]}:function(t){return t.css("background-position").split(" ")},f=t.requestAnimationFrame||t.webkitRequestAnimationFrame||t.mozRequestAnimationFrame||t.oRequestAnimationFrame||t.msRequestAnimationFrame||function(t){setTimeout(t,1e3/60)};a.prototype={init:function(){this.options.name=s+"_"+Math.floor(1e9*Math.random()),this._defineElements(),this._defineGetters(),this._defineSetters(),this._handleWindowLoadAndResize(),this._detectViewport(),this.refresh({firstLoad:!0}),"scroll"===this.options.scrollProperty?this._handleScrollEvent():this._startAnimationLoop()},_defineElements:function(){this.element===e.body&&(this.element=t),this.$scrollElement=$(this.element),this.$element=this.element===t?$("body"):this.$scrollElement,this.$viewportElement=this.options.viewportElement!==i?$(this.options.viewportElement):this.$scrollElement[0]===t||"scroll"===this.options.scrollProperty?this.$scrollElement:this.$scrollElement.parent()},_defineGetters:function(){var t=this,e=o[t.options.scrollProperty];this._getScrollLeft=function(){return e.getLeft(t.$scrollElement)},this._getScrollTop=function(){return e.getTop(t.$scrollElement)}},_defineSetters:function(){var t=this,e=o[t.options.scrollProperty],i=r[t.options.positionProperty],a=e.setLeft,s=e.setTop;this._setScrollLeft="function"==typeof a?function(e){a(t.$scrollElement,e)}:$.noop,this._setScrollTop="function"==typeof s?function(e){s(t.$scrollElement,e)}:$.noop,this._setPosition=i.setPosition||function(e,a,s,n,o){t.options.horizontalScrolling&&i.setLeft(e,a,s),t.options.verticalScrolling&&i.setTop(e,n,o)}},_handleWindowLoadAndResize:function(){var e=this,i=$(t);e.options.responsive&&i.bind("load."+this.name,function(){e.refresh()}),i.bind("resize."+this.name,function(){e._detectViewport(),e.options.responsive&&e.refresh()})},refresh:function(e){var i=this,a=i._getScrollLeft(),s=i._getScrollTop();e&&e.firstLoad||this._reset(),this._setScrollLeft(0),this._setScrollTop(0),this._setOffsets(),this._findBackgrounds(),e&&e.firstLoad&&/WebKit/.test(navigator.userAgent)&&$(t).load(function(){var t=i._getScrollLeft(),e=i._getScrollTop();i._setScrollLeft(t+1),i._setScrollTop(e+1),i._setScrollLeft(t),i._setScrollTop(e)}),this._setScrollLeft(a),this._setScrollTop(s)},_detectViewport:function(){var t=this.$viewportElement.offset(),e=null!==t&&t!==i;this.viewportWidth=this.$viewportElement.width(),this.viewportHeight=this.$viewportElement.height(),this.viewportOffsetTop=e?t.top:0,this.viewportOffsetLeft=e?t.left:0},_findBackgrounds:function(){var t=this,e=this._getScrollLeft(),a=this._getScrollTop(),s;this.backgrounds=[],this.options.parallaxBackgrounds&&(s=this.$element.find("[data-ktstellar-background-ratio]"),this.$element.data("ktstellar-background-ratio")&&(s=s.add(this.$element)),s.each(function(){var s=$(this),n=p(s),o,r,l,c,d,f,u,g,m,k=0,v=0,b=0,y=0;if(s.data("ktstellar-backgroundIsActive")){if(s.data("ktstellar-backgroundIsActive")!==this)return}else s.data("ktstellar-backgroundIsActive",this);s.data("ktstellar-backgroundStartingLeft")?h(s,s.data("ktstellar-backgroundStartingLeft"),s.data("ktstellar-backgroundStartingTop")):(s.data("ktstellar-backgroundStartingLeft",n[0]),s.data("ktstellar-backgroundStartingTop",n[1])),d="auto"===s.css("margin-left")?0:parseInt(s.css("margin-left"),10),f="auto"===s.css("margin-top")?0:parseInt(s.css("margin-top"),10),u=s.offset().left-d-e,g=s.offset().top-f-a,s.parents().each(function(){var t=$(this);return!0===t.data("ktstellar-offset-parent")?(k=b,v=y,m=t,!1):(b+=t.position().left,void(y+=t.position().top))}),o=s.data("ktstellar-horizontal-offset")!==i?s.data("ktstellar-horizontal-offset"):m!==i&&m.data("ktstellar-horizontal-offset")!==i?m.data("ktstellar-horizontal-offset"):t.horizontalOffset,r=s.data("ktstellar-vertical-offset")!==i?s.data("ktstellar-vertical-offset"):m!==i&&m.data("ktstellar-vertical-offset")!==i?m.data("ktstellar-vertical-offset"):t.verticalOffset,t.backgrounds.push({$element:s,$offsetParent:m,isFixed:"fixed"===s.css("background-attachment"),horizontalOffset:o,verticalOffset:r,startingValueLeft:n[0],startingValueTop:n[1],startingBackgroundPositionLeft:isNaN(parseInt(n[0],10))?0:parseInt(n[0],10),startingBackgroundPositionTop:isNaN(parseInt(n[1],10))?0:parseInt(n[1],10),startingPositionLeft:s.position().left,startingPositionTop:s.position().top,startingOffsetLeft:u,startingOffsetTop:g,parentOffsetLeft:k,parentOffsetTop:v,ktstellarRatio:s.data("ktstellar-background-ratio")===i?1:s.data("ktstellar-background-ratio")})}))},_reset:function(){var t,e,i,a;for(a=this.backgrounds.length-1;a>=0;a--)i=this.backgrounds[a],i.$element.data("ktstellar-backgroundStartingLeft",null).data("ktstellar-backgroundStartingTop",null),h(i.$element,i.startingValueLeft,i.startingValueTop)},destroy:function(){this._reset(),this.$scrollElement.unbind("resize."+this.name).unbind("scroll."+this.name),this._animationLoop=$.noop,$(t).unbind("load."+this.name).unbind("resize."+this.name)},_setOffsets:function(){var e=this,i=$(t);i.unbind("resize.horizontal-"+this.name).unbind("resize.vertical-"+this.name),"function"==typeof this.options.horizontalOffset?(this.horizontalOffset=this.options.horizontalOffset(),i.bind("resize.horizontal-"+this.name,function(){e.horizontalOffset=e.options.horizontalOffset()})):this.horizontalOffset=this.options.horizontalOffset,"function"==typeof this.options.verticalOffset?(this.verticalOffset=this.options.verticalOffset(),i.bind("resize.vertical-"+this.name,function(){e.verticalOffset=e.options.verticalOffset()})):this.verticalOffset=this.options.verticalOffset},_repositionElements:function(){var t=this._getScrollLeft(),e=this._getScrollTop(),i,a,s,n,o,r,l,c=!0,d=!0,p,f,u,g,m;if(this.currentScrollLeft!==t||this.currentScrollTop!==e||this.currentWidth!==this.viewportWidth||this.currentHeight!==this.viewportHeight)for(this.currentScrollLeft=t,this.currentScrollTop=e,this.currentWidth=this.viewportWidth,this.currentHeight=this.viewportHeight,m=this.backgrounds.length-1;m>=0;m--)o=this.backgrounds[m],n=o.isFixed?0:1,r=this.options.horizontalScrolling?(t+o.horizontalOffset-this.viewportOffsetLeft-o.startingOffsetLeft+o.parentOffsetLeft-o.startingBackgroundPositionLeft)*(n-o.ktstellarRatio)+"px":o.startingValueLeft,l=this.options.verticalScrolling?(e+o.verticalOffset-this.viewportOffsetTop-o.startingOffsetTop+o.parentOffsetTop-o.startingBackgroundPositionTop)*(n-o.ktstellarRatio)+"px":o.startingValueTop,h(o.$element,r,l)},_handleScrollEvent:function(){var t=this,e=!1,i=function(){t._repositionElements(),e=!1},a=function(){e||(f(i),e=!0)};this.$scrollElement.bind("scroll."+this.name,a),a()},_startAnimationLoop:function(){var t=this;this._animationLoop=function(){f(t._animationLoop),t._repositionElements()},this._animationLoop()}},$.fn[s]=function(t){var e=arguments;return t===i||"object"==typeof t?this.each(function(){$.data(this,"plugin_"+s)||$.data(this,"plugin_"+s,new a(this,t))}):"string"==typeof t&&"_"!==t[0]&&"init"!==t?this.each(function(){var i=$.data(this,"plugin_"+s);i instanceof a&&"function"==typeof i[t]&&i[t].apply(i,Array.prototype.slice.call(e,1)),"destroy"===t&&$.data(this,"plugin_"+s,null)}):void 0},$[s]=function(e){var i=$(t);return i.ktstellar.apply(i,Array.prototype.slice.call(arguments,0))},$[s].scrollProperty=o,$[s].positionProperty=r,t.Ktstellar=a}(jQuery,this,document),jQuery(document).ready(function($){function t(t,e){return/(png|jpg|jpeg|gif|tiff|bmp)$/.test($(e).attr("href").toLowerCase().split("?")[0].split("#")[0])}function e(){$('a[href]:not(".kt-no-lightbox")').filter(t).attr("data-rel","lightbox")}function i(){$('a[data-rel^="lightbox"]:not(".kt-no-lightbox")').magnificPopup({type:"image"}),$(".kad-light-gallery").each(function(){$(this).find('a[data-rel^="lightbox"]:not(".kt-no-lightbox")').magnificPopup({type:"image",gallery:{enabled:!0},image:{titleSrc:function(t){return t.el.find("img").attr("data-caption")?t.el.find("img").attr("data-caption"):t.el.find("img").attr("alt")}}})})}function a(t){var e=t.data("slider-speed"),i=t.data("slider-fade"),a=t.data("slider-anim-speed"),s=t.data("slider-arrows"),n=t.data("slider-auto"),o=t.data("slider-type"),r=t.data("slider-dots");r=""!=r&&"false"!=r;var l=!1;if($("body.rtl").length>=1&&(l=!0),"carousel"==o){var c=t.data("slides-to-show");null==c&&(c=1),t.slick({slidesToScroll:1,slidesToShow:c,centerMode:!0,variableWidth:!0,arrows:s,speed:a,autoplay:n,autoplaySpeed:e,fade:i,pauseOnHover:!1,rtl:l,dots:!0})}else if("content-carousel"==o){var d=t.data("slider-xxl"),h=t.data("slider-xl"),p=t.data("slider-md"),f=t.data("slider-sm"),u=t.data("slider-xs"),g=t.data("slider-ss"),m=t.data("slider-scroll");if(1!==m)var k=d,v=h,b=p,y=f,_=u,w=g;else var k=1,v=1,b=1,y=1,_=1,w=1;t.slick({slidesToScroll:k,slidesToShow:d,arrows:s,speed:a,autoplay:n,autoplaySpeed:e,fade:i,pauseOnHover:!1,dots:r,rtl:l,responsive:[{breakpoint:1499,settings:{slidesToShow:h,slidesToScroll:v}},{breakpoint:1199,settings:{slidesToShow:p,slidesToScroll:b}},{breakpoint:991,settings:{slidesToShow:f,slidesToScroll:y}},{breakpoint:767,settings:{slidesToShow:u,slidesToScroll:_}},{breakpoint:543,settings:{slidesToShow:g,slidesToScroll:w}}]})}else if("thumb"==o){var S=t.data("slider-thumbid"),x=t.data("slider-thumbs-showing"),C=t.attr("id");t.slick({slidesToScroll:1,slidesToShow:1,arrows:s,speed:a,autoplay:n,autoplaySpeed:e,fade:i,pauseOnHover:!1,adaptiveHeight:!0,dots:!1,rtl:l,asNavFor:S}),$(S).slick({slidesToShow:x,slidesToScroll:1,asNavFor:"#"+C,dots:!1,rtl:l,centerMode:!1,focusOnSelect:!0})}else t.slick({slidesToShow:1,slidesToScroll:1,arrows:s,speed:a,autoplay:n,autoplaySpeed:e,fade:i,pauseOnHover:!1,rtl:l,adaptiveHeight:!0,dots:!0})}function s(){var t=$("#kad-vertical-menu"),e=$(window).height(),i=$("body").hasClass("admin-bar")?32:0,a=$(".kad-scrollable-area").outerHeight(),s=e-i,n=$(window).scrollTop(),o=$(".nav-main .sf-vertical ul").outerHeight();a>s?s+n>=a?(t.css("position","fixed"),t.css("bottom","0"),t.css("top","auto"),t.css("height","auto")):(t.css("position","absolute"),t.css("bottom","auto"),t.css("top","auto"),t.css("height","auto")):(t.css("position","fixed"),t.css("bottom",""),t.css("top",""),t.css("height",""))}function n(){var t=$(window).height(),e=$("body").hasClass("admin-bar")?32:0,i=$(".kad-scrollable-area").outerHeight(),a=t-e;if(i>a)var s=i;else var s=a;$(".kad-relative-vertical-content .sf-vertical > li > ul").each(function(){$(this).outerHeight()+$(this).parent("li").offset().top>s?($(this).css("top","auto"),$(this).css("bottom","0")):($(this).css("top",""),$(this).css("bottom",""))})}function o(){var t=$(window).width();$("#topbar .sf-menu-normal > li > ul").each(function(){$(this).outerWidth()+$(this).parent("li").offset().left>t?$(this).addClass("kt-subright"):$(this).removeClass("kt-subright")})}function r(){var t=$(window).width();$(".kad-header-menu-outer .sf-menu-normal > li > ul").each(function(){$(this).outerWidth()+$(this).parent("li").offset().left>t?$(this).addClass("kt-subright"):$(this).removeClass("kt-subright")}),$(".kad-header-menu-outer .sf-menu-normal > li.kt-lgmenu > ul").each(function(){$(this).outerWidth()/2+$(this).parent("li").offset().left>t?$(this).addClass("kt-subright"):$(this).removeClass("kt-subright")})}function l(){var t=$(window).width();$(".nav-second .sf-menu-normal > li > ul").each(function(){$(this).outerWidth()+$(this).parent("li").offset().left>t?$(this).addClass("kt-subright"):$(this).removeClass("kt-subright")}),$(".nav-second .sf-menu-normal > li.kt-lgmenu > ul").each(function(){$(this).outerWidth()/2+$(this).parent("li").offset().left>t?$(this).addClass("kt-subright"):$(this).removeClass("kt-subright")})}function c(t){var e=$(".kt-header-position-above").attr("data-shrink"),i=$(".kt-header-position-above").attr("data-shrink-height"),a=$(".kt-header-position-above").attr("data-start-height"),s=$(window),n=$("body").hasClass("admin-bar")?32:0,o=0;if("header"==t){var r=$(".kad-header-menu-outer");o=$("#topbar").height();var l=a-i+r.height()}else if("header_top"==t)var r=$(".kad-header-topbar-primary-outer"),l=a-i+r.height();else if("header_all"==t)var r=$(".kt-header-position-above"),l=a-i+r.height();else if("topbar"==t){var r=$(".topbarclass");e=0}else if("secondary"==t){var r=$(".second-navclass");e=0}set_height=function(){var t=s.scrollTop(),e=a;t-=o,t/=2,t<0&&(t=0),a-t>i?(e=a-t,r.removeClass("kt-item-shrunk")):(e=i,r.addClass("kt-item-shrunk")),$(".kad-header-height").each(function(){$(this).css({height:e+"px"})})},1==e?(r.sticky({topSpacing:n,zIndex:1e3}),$("#sticky-wrapper").hasClass("is-sticky")&&$("#sticky-wrapper").css({height:l+"px"}),s.scroll(set_height)):r.sticky({topSpacing:n,zIndex:1e3})}function d(){var t=$("#kad-mobile-banner").height(),e=$("body").hasClass("admin-bar")?32:0,i=$("#kad-mobile-banner").attr("data-mobile-header-sticky");$(window).width()<600&&$("body").hasClass("admin-bar")?e=0:$(window).width()<782&&$("body").hasClass("admin-bar")&&(e=46),1==i&&$("#kad-mobile-banner").sticky({topSpacing:e,zIndex:1e3})}function h(){var t=0;window.innerWidth<992?t=$("#kad-mobile-banner").height():$(".kt-header-position-above").length?t=$(".kt-header-position-above").height():$(".second-navclass").length&&(t=$(".second-navclass").height()),$(".titleclass").css("padding-top",t+"px")}function p(){var t=0;$("#kad-header-menu-sticky-wrapper").length&&(t=$("#kad-header-menu-sticky-wrapper > header").height()),$(".headerclass-outer .sticky-wrapper").length&&(t+=$(".headerclass-outer .sticky-wrapper > div").height()),$(".outside-second .sticky-wrapper").length&&(t+=$(".outside-second .sticky-wrapper > div").height()),$("#kad-mobile-banner-sticky-wrapper").length&&(t+=$("#kad-mobile-banner-sticky-wrapper > div").height()),$("#kad-header-menu, #kad-mobile-banner, #kad-vertical-menu, .outside-second, .kt-mobile-menu, .kad-slider, .kt-local-scroll").localScroll({offset:-t,onBefore:function(t,e){$.magnificPopup.instance.close()},hash:!0})}function f(){$(".kt-custom-row-full-stretch").each(function(){var t=$("#inner-wrap").width()-$(this).parents("#content").width();$(this).css({"margin-left":"-"+t/2+"px"}),$(this).css({"margin-right":"-"+t/2+"px"}),$(this).css({width:+$("#inner-wrap").width()+"px"}),$(this).css({visibility:"visible"}),$(this).css({opacity:"1"})}),$(".kt-custom-row-full").each(function(){var t=$("#inner-wrap").width()-$(this).parents("#content").width();$(this).css({"padding-left":t/2+"px"}),$(this).css({"padding-right":t/2+"px"}),$(this).css({"margin-left":"-"+t/2+"px"}),$(this).css({"margin-right":"-"+t/2+"px"}),$(this).css({visibility:"visible"}),$(this).css({opacity:"1"})})}function u(){y.isotopeb({masonry:{columnWidth:_},transitionDuration:"0s"})}function g(){$(".kt-panel-row-full-stretch .reinit-isotope").length&&$(".kt-panel-row-full-stretch .reinit-isotope").each(function(){var t=$(this),e=$(this).data("iso-selector");t.isotopeb({masonry:{columnWidth:e},transitionDuration:"0s"})})}if(Modernizrc.flexbox||$("body").addClass("kt-no-flex"),kt_isMobile.any()||$("[data-toggle=tooltip]").tooltip(),$("[data-toggle=popover]").popover(),$(".kt-tabs a").click(function(t){t.preventDefault(),$(this).tab("show")}),$(".widget ul ul.children").each(function(){$(this).parent("li").append('<span class="kt-toggle-sub"></span>'),$(this).parent("li").find(".count").length&&$(this).parent("li").addClass("kt-toggle-has-count"),($(this).parent("li").hasClass("current-cat")||$(this).parent("li").hasClass("current-cat-parent"))&&$(this).parent("li").addClass("kt-drop-toggle")}),$(".kt-toggle-sub").click(function(t){t.preventDefault(),$(this).parent("li").hasClass("kt-drop-toggle")?$(this).parent("li").removeClass("kt-drop-toggle"):$(this).parent("li").addClass("kt-drop-toggle")}),$(document).mouseup(function(t){var e=$("#kad-menu-search-popup");e.is(t.target)||0!==e.has(t.target).length||$("#kad-menu-search-popup.in").collapse("hide")}),$("#kad-menu-search-popup").on("shown.bs.collapse",function(){$(".kt-search-container .search-query").focus()}),$(".kt_typed_element").each(function(){var t=$(this).data("first-sentence"),e=$(this).data("second-sentence"),i=$(this).data("third-sentence"),a=$(this).data("fourth-sentence"),s=$(this).data("loop"),n=$(this).data("speed"),o=$(this).data("start-delay"),r=$(this).data("back-delay"),l=$(this).data("sentence-count");if(null==o&&(o=500),null==r&&(r=500),"1"==l)var c={strings:[t],typeSpeed:n,startDelay:o,backDelay:r,loop:s};else if("3"==l)var c={strings:[t,e,i],typeSpeed:n,startDelay:o,backDelay:r,loop:s};else if("4"==l)var c={strings:[t,e,i,a],typeSpeed:n,startDelay:o,backDelay:r,loop:s};else var c={strings:[t,e],typeSpeed:n,startDelay:o,backDelay:r,loop:s};$(this).ascend_appear(function(){$(this).typed(c)},{accX:0,accY:-25})}),$(".videofit").fitVids(),$(".embed-youtube").fitVids(),$(".kt-m-hover").bind("touchend",function(t){$(this).toggleClass("kt-mobile-hover"),$(this).toggleClass("kt-mhover-inactive")}),$(".collapse-next").click(function(t){var e=$(this).siblings(".sf-dropdown-menu");e.hasClass("in")?(e.collapse("toggle"),$(this).removeClass("toggle-active")):(e.collapse("toggle"),$(this).addClass("toggle-active"))}),$("body").hasClass("kt-turnoff-lightbox")||e(),$.extend(!0,$.magnificPopup.defaults,{tClose:"",tLoading:'<div class="kt-ajax-overlay"><div class="kt-ajax-bubbling"><span id="kt-ajax-bubbling_1"></span><span id="kt-ajax-bubbling_2"></span><span id="kt-ajax-bubbling_3"></span></div></div>',gallery:{tPrev:"",tNext:"",tCounter:light_of},mainClass:"mfp-zoom-in",removalDelay:400,image:{markup:'<div class="mfp-figure mfp-with-anim"><div class="mfp-close"></div><div class="mfp-img"></div><div class="mfp-bottom-bar"><div class="mfp-title"></div><div class="mfp-counter"></div></div></div>',tError:light_error,titleSrc:function(t){return t.el.find("img").attr("alt")}}}),$("body").hasClass("kt-turnoff-lightbox")||($('a[data-rel^="lightbox"]:not(".kt-no-lightbox")').magnificPopup({type:"image"}),$(".kad-light-gallery").each(function(){$(this).find('a[data-rel^="lightbox"]:not(".kt-no-lightbox")').magnificPopup({type:"image",gallery:{enabled:!0},image:{titleSrc:function(t){return t.el.find("img").attr("data-caption")?t.el.find("img").attr("data-caption"):t.el.find("img").attr("alt")}},removalDelay:500,callbacks:{beforeOpen:function(){this.st.image.markup=this.st.image.markup.replace("mfp-figure","mfp-figure mfp-with-anim")}}})}),$(".portfolio-grid-light-gallery").each(function(){$(this).find('a[data-rel^="lightbox"]:not(".kt-no-lightbox")').magnificPopup({type:"image",gallery:{enabled:!0},image:{titleSrc:function(t){return t.el.parents(".portfolio_item").attr("data-post-title")}},removalDelay:500,callbacks:{beforeOpen:function(){this.st.image.markup=this.st.image.markup.replace("mfp-figure","mfp-figure mfp-with-anim")}}})}),$(".portfolio-light-gallery").each(function(){$(this).magnificPopup({delegate:"a",type:"image",gallery:{enabled:!0},image:{titleSrc:function(t){return t.el.parents(".portfolio_item").attr("data-post-title")}}})}),$(".portfolio-light-gallery-open").on("click",function(t){t.preventDefault();var e="."+$(this).data("gallery-id"),i=$(e).find(".slick-current").data("slick-index");$(e).magnificPopup("open",i)}),$("#content .gallery").each(function(){$(this).find('a[data-rel^="lightbox"]:not(".kt-no-lightbox")').magnificPopup({type:"image",gallery:{enabled:!0},image:{titleSrc:function(t){return t.el.find("img").attr("alt")}},removalDelay:500,callbacks:{beforeOpen:function(){this.st.image.markup=this.st.image.markup.replace("mfp-figure","mfp-figure mfp-with-anim")}}})}),$(window).on("infintescrollnewelements",function(t){i()}),$(".ktvideolight").magnificPopup({type:"iframe"})),$(".kt-pop-modal").magnificPopup({type:"inline",callbacks:{open:function(){setTimeout(function(){$(".mfp-inline-holder input")[0].focus()},100)}}}),$(".kt-sldr-pop-modal").on("click",function(t){t.preventDefault();var e=$(this).data("pop-sldr-direction"),i=$(this).data("pop-sldr-class"),a=$(this).data("mfp-src");$.magnificPopup.open({items:{type:"inline",src:a},removalDelay:200,mainClass:function(t){return i+" sldr-align-"+e+" mfp-slide"},callbacks:{beforeOpen:function(){$("body").addClass("mag-pop-sldr-open-"+e),$("body").addClass(i)},beforeClose:function(){$("body").removeClass("mag-pop-sldr-open-"+e),$("body").removeClass(i)}},closeBtnInside:!1,closeMarkup:'<div class="sldr-close-container kad-mobile-header-height"><button class="sldr-close"><span></span><span></span><span></span></button></div>'})}),$(".no-lightbox").magnificPopup({disableOn:function(){return!1}}),$(".kad-ascend-parallax").each(function(){var t=$(this).css("background-position-y"),e=$(this).css("background-position-x"),i=$(this);$(".kad-ascend-parallax").ascend_appear(function(){$(window).scroll(function(){var a="calc("+t+" - "+$(window).scrollTop()/5+"px)",s=e+" "+a;i.css({backgroundPosition:s})})},{accX:0,accY:-25},"easeInCubic")}),$(".kt-slickslider").each(function(){var t=$(this),e=t.data("slider-initdelay");null==e||"0"==e?a(t):setTimeout(function(){a(t)},e)}),$("body").hasClass("kt-use-select2")&&$(window).width()>790&&!kt_isMobile.any()&&($("select:not(#rating):not(.kt-no-select2)").select2({minimumResultsForSearch:-1}),$("select.country_select").select2(),$("select.state_select").select2()),$("#kad-vertical-menu").length&&($(this).waitForImages(s()),$(window).scroll(s)),$("#kad-vertical-menu").length&&($(this).waitForImages(n()),$(window).on("debouncedresize",function(t){n()})),$("#topbar .sf-menu-normal").length&&(o(),$(window).on("debouncedresize",function(t){o()})),$(".kad-header-menu-outer .sf-menu-normal").length&&(r(),$(window).on("debouncedresize",function(t){r()})),$(".nav-second .sf-menu-normal").length&&(l(),$(window).on("debouncedresize",function(t){l()})),$(".titleclass").length&&($(".titleclass .entry-title").each(function(){var t=$(this).data("max-size"),e=$(this).data("min-size");$(this).kt_fitText(1.4,{minFontSize:e,maxFontSize:t,maxWidth:1140,minWidth:400})}),$(".titleclass .subtitle").length&&$(".titleclass .subtitle").each(function(){var t=$(this).data("max-size"),e=$(this).data("min-size");$(this).kt_fitText(1.5,{minFontSize:e,maxFontSize:t,maxWidth:1140,minWidth:400})})),$(".kt-ctaw .kt-call-to-action-title").length&&$(".kt-ctaw .kt-call-to-action-title").each(function(){var t=$(this).data("max-size"),e=$(this).data("min-size");$(this).kt_fitText(1.3,{minFontSize:e,maxFontSize:t,maxWidth:1140,minWidth:400})}),$(".kt-ctaw .kt-call-to-action-subtitle").length&&$(".kt-ctaw .kt-call-to-action-subtitle").each(function(){var t=$(this).data("max-size"),e=$(this).data("min-size");$(this).kt_fitText(1.5,{minFontSize:e,maxFontSize:t,maxWidth:1140,minWidth:400})}),$(".kt-ctaw .kt-call-to-action-abovetitle").length&&$(".kt-ctaw .kt-call-to-action-abovetitle").each(function(){var t=$(this).data("max-size"),e=$(this).data("min-size");$(this).kt_fitText(1.5,{minFontSize:e,maxFontSize:t,maxWidth:1140,minWidth:400})}),$(".kt-map").click(function(){$(".kt-map iframe").css("pointer-events","auto")}),$(".kt-map").mouseleave(function(){$(".kt-map iframe").css("pointer-events","none")}),$(".kt-header-position-above").length){var m=$(".kt-header-position-above").attr("data-sticky");"none"!=m&&(c(m),$(window).on("debouncedresize",function(t){c(m)}))}if(($(".kt-header-position-left").length||$(".kt-header-position-right").length)&&$(".second-navclass").length){var m=$(".second-navclass").attr("data-sticky");if("second"==m){var k=$("body").hasClass("admin-bar")?32:0;$(".second-navclass").sticky({topSpacing:k,zIndex:1e3})}}if(d(),$(window).on("debouncedresize",function(t){d()}),$("body.trans-header").length&&(h(),$(window).on("debouncedresize",function(t){h()})),$("ul.sf-menu.sf-menu-normal").ktsuperfish({delay:300,animation:{top:"100%",opacity:"show"},animationOut:{top:"120%",opacity:"hide"},cssArrows:!1,speed:"fast"}),$("ul.sf-menu.sf-vertical").ktsuperfish({delay:300,animation:{left:"100%",opacity:"show"},animationOut:{left:"105%",opacity:"hide"},cssArrows:!1,speed:"fast"}),kt_isMobile.any()&&$("ul.sf-menu li.sf-dropdown > a").on("tap",function(t){t.preventDefault()}),$("body.kt-anchor-scroll").length&&p(),f(),$(window).on("debouncedresize",function(t){f()}),$(window).on("panelsStretchRows",f),$(".siteorigin-panels-stretch").each(function(){$(this).css({visibility:"visible"}),$(this).css({opacity:"1"})}),$(window).width()>790?($(".kt-animate-fade-in-up").each(function(){$(this).ascend_appear(function(){$(this).animate({opacity:1,top:0},900,"swing")},{accX:0,accY:-25},"easeInCubic")}),$(".kt-animate-fade-in-down").each(function(){$(this).ascend_appear(function(){$(this).animate({opacity:1,top:0},900,"swing")},{accX:0,accY:-25},"easeInCubic")}),$(".kt-animate-fade-in-left").each(function(){$(this).ascend_appear(function(){$(this).animate({opacity:1,left:0},900,"swing")},{accX:-25,accY:0},"easeInCubic")}),$(".kt-animate-fade-in-right").each(function(){$(this).ascend_appear(function(){$(this).animate({opacity:1,right:0},900,"swing")},{accX:-25,accY:0},"easeInCubic")}),$(".kt-animate-fade-in").each(function(){$(this).ascend_appear(function(){$(this).animate({opacity:1},900,"swing")})})):($(".kt-animate-fade-in-up").each(function(){$(this).animate({opacity:1,top:0})}),$(".kt-animate-fade-in-down").each(function(){$(this).animate({opacity:1,top:0})}),$(".kt-animate-fade-in-left").each(function(){$(this).animate({opacity:1,left:0})}),$(".kt-animate-fade-in-right").each(function(){$(this).animate({opacity:1,right:0})}),$(".kt-animate-fade-in").each(function(){$(this).animate({opacity:1})})),$(".kt-pb-animation").each(function(){$(this).ascend_appear(function(){$(this).addClass("kt-pb-animate")},{accX:-25,accY:0},"easeInCubic")}),$(".blog_carousel").length){"1"==$(".blog_carousel").data("iso-match-height")&&$(".blog_carousel .blog_item").matchHeight()}if($(".kt-home-iconmenu-container").length){"1"==$(".kt-home-iconmenu-container").data("equal-height")&&$(".kt-home-iconmenu-container .home-icon-item").matchHeight()}if($(".init-tiles-justified").each(function(){if($.fn.justifiedGallery){var t=$(this),e=$(this).data("gallery-height"),i=$(this).data("gallery-lastrow"),a=$(this).data("gallery-margins");t.waitForImages(function(){t.justifiedGallery({rowHeight:e,lastRow:i,captions:!1,margins:a,waitThumbnailsLoad:!1})})}}),$(".init-tiles-justified").each(function(){$(this).on("jg.complete",function(t){$(".kt-slickslider.slick-initialized").each(function(){$(this).slick("refresh")})})}),$(".init-tiles-justified").each(function(){$(this).on("jg.resize",function(t){$(".kt-slickslider.slick-initialized").each(function(){$(this).slick("refresh")})})}),$(".init-isotope").each(function(){var t=$(this),e=$(this).data("iso-selector"),i=$(this).data("iso-style"),a=$(this).data("iso-filter"),s=$(this).data("iso-match-height");if(null==i&&(i="masonry"),null==a&&(a="false"),null==s&&(s="false"),$("body.rtl").length>=1)var n=!1;else var n=!0;t.waitForImages(function(){if("1"==s&&$(".init-isotope .blog_item").matchHeight(),"matchheight"==i){var o=t.find(".kt_item_fade_in");o.each(function(t){$(this).delay(75*t).animate({opacity:1},175)})}else{t.isotopeb({masonry:{columnWidth:e},layoutMode:i,itemSelector:e,transitionDuration:"0.8s",isOriginLeft:n});var o=t.find(".kt_item_fade_in");if(o.each(function(t){$(this).delay(75*t).animate({opacity:1},175)}),1==a){var r=t.parents(".main"),l=r.find("#filters");if(l.length){l.on("click","a",function(e){var i=$(this).attr("data-filter");return t.isotopeb({filter:i}),t.find(".kt-slickslider").each(function(){$(this).slick("setPosition")}),!1});$("#options .option-set").find("a").click(function(){var t=$(this);if(t.hasClass("selected"))return!1;t.parents(".option-set").find(".selected").removeClass("selected"),t.addClass("selected")})}}}})}),$(".init-isotope-intrinsic").each(function(){var t=$(this),e=$(this).data("iso-selector"),i=$(this).data("iso-style"),a=$(this).data("iso-filter");if($("body.rtl").length>=1)var s=!1;else var s=!0;if(t.isotopeb({masonry:{columnWidth:e},layoutMode:i,itemSelector:e,transitionDuration:"0.8s",isOriginLeft:s}),t.find(".kt_item_fade_in").each(function(t){$(this).delay(75*t).animate({opacity:1},175)}),1==a){var n=t.parents(".main"),o=n.find("#filters");o.length&&(o.on("click","a",function(e){e.preventDefault();var i=$(this).attr("data-filter");t.isotopeb({filter:i}),t.find(".kt-slickslider").each(function(){$(this).slick("setPosition")})}),$("#options .option-set").find("a").click(function(){var t=$(this);if(t.hasClass("selected"))return!1;t.parents(".option-set").find(".selected").removeClass("selected"),t.addClass("selected")}))}}),$(".init-mosaic-isotope").each(function(){var t=$(this),e=$(this).data("iso-selector"),i=$(this).data("mosaic-selector"),a=$(this).data("iso-style"),s=$(this).data("iso-filter");if($("body.rtl").length)var n=!1;else var n=!0;if(t.isotopeb({layoutMode:"packery",percentPosition:!0,itemSelector:e,transitionDuration:".8s",packery:{horizontal:!0,columnWidth:i},isOriginLeft:n}),t.find(".kt_item_fade_in").each(function(t){$(this).delay(150*t).animate({opacity:1},350)}),1==s){var o=t.parents(".main"),r=o.find("#filters");r.length&&(r.on("click","a",function(e){e.preventDefault();var i=$(this).attr("data-filter");t.isotopeb({filter:i}),t.find(".kt-slickslider").each(function(){$(this).slick("setPosition")})}),$("#options .option-set").find("a").click(function(){var t=$(this);if(t.hasClass("selected"))return!1;t.parents(".option-set").find(".selected").removeClass("selected"),t.addClass("selected")}))}}),$(".kt_product_toggle_container").length){
var v=$(".kt_product_toggle_container .toggle_list"),b=$(".kt_product_toggle_container .toggle_grid");v.click(function(){if($(this).hasClass("toggle_active"))return!1;if($(this).parents(".kt_product_toggle_container").find(".toggle_active").removeClass("toggle_active"),$(this).addClass("toggle_active"),$(".kad_product_wrapper").length){$(".kad_product_wrapper").addClass("shopcolumn1"),$(".kad_product_wrapper").addClass("tfsinglecolumn");var t=$(".kad_product_wrapper"),e=$(".kad_product_wrapper").data("iso-selector");t.isotopeb({masonry:{columnWidth:e},transitionDuration:".4s"})}return!1}),b.click(function(){if($(this).hasClass("toggle_active"))return!1;if($(this).parents(".kt_product_toggle_container").find(".toggle_active").removeClass("toggle_active"),$(this).addClass("toggle_active"),$(".kad_product_wrapper").length){$(".kad_product_wrapper").removeClass("shopcolumn1"),$(".kad_product_wrapper").removeClass("tfsinglecolumn");var t=$(".kad_product_wrapper"),e=$(".kad_product_wrapper").data("iso-selector");t.isotopeb({masonry:{columnWidth:e},transitionDuration:".4s"})}return!1})}if($(".kt_product_toggle_container_list").length){var v=$(".kt_product_toggle_container_list .toggle_list"),b=$(".kt_product_toggle_container_list .toggle_grid");v.click(function(){if($(this).hasClass("toggle_active"))return!1;if($(this).parents(".kt_product_toggle_container_list").find(".toggle_active").removeClass("toggle_active"),$(this).addClass("toggle_active"),$(".kad_product_wrapper").length){$(".kad_product_wrapper").addClass("shopcolumn1"),$(".kad_product_wrapper").addClass("tfsinglecolumn"),$(".kad_product_wrapper").removeClass("kt_force_grid_three");var t=$(".kad_product_wrapper"),e=$(".kad_product_wrapper").data("iso-selector");t.isotopeb({masonry:{columnWidth:e},transitionDuration:".4s"})}return!1}),b.click(function(){if($(this).hasClass("toggle_active"))return!1;if($(this).parents(".kt_product_toggle_container_list").find(".toggle_active").removeClass("toggle_active"),$(this).addClass("toggle_active"),$(".kad_product_wrapper").length){$(".kad_product_wrapper").removeClass("shopcolumn1"),$(".kad_product_wrapper").removeClass("tfsinglecolumn"),$(".kad_product_wrapper").addClass("kt_force_grid_three");var t=$(".kad_product_wrapper"),e=$(".kad_product_wrapper").data("iso-selector");t.isotopeb({masonry:{columnWidth:e},transitionDuration:".4s"})}return!1})}if($(".woocommerce-tabs .reinit-isotope").length){var y=$(".reinit-isotope"),_=$(".reinit-isotope").data("iso-selector");$(".woocommerce-tabs ul.tabs a").click(function(){setTimeout(u,50)})}if($(".panel-body .reinit-isotope").length){var y=$(".reinit-isotope"),_=$(".reinit-isotope").data("iso-selector");$(".panel-group").on("shown.bs.collapse",function(t){y.isotopeb({masonry:{columnWidth:_},transitionDuration:"0s"})})}$(".tab-pane .reinit-isotope").length&&$(".tab-pane .reinit-isotope").each(function(){var t=$(this),e=$(this).data("iso-selector");$(".kt-sc-tabs").on("shown.bs.tab",function(i){t.isotopeb({masonry:{columnWidth:e},transitionDuration:"0s"})})}),$(window).on("panelsStretchRows",g),$(".tab-pane .kt-slickslider").length&&$(".tab-pane .kt-slickslider").each(function(){var t=$(this);$(".kt-sc-tabs").on("shown.bs.tab",function(e){t.slick("refresh")})}),$(".panel-body .kt-slickslider").length&&$(".panel-body .kt-slickslider").each(function(){var t=$(this);$(".panel-group").on("shown.bs.collapse",function(e){t.slick("refresh")})}),jQuery(".init-infinit").each(function(){var t=$(this),e=$(this).data("nextselector"),i=$(this).data("navselector"),s=$(this).data("itemselector"),n=$(this).data("itemloadselector"),o=$(this).data("iso-match-height");$(e).length&&(t.infiniteScroll({path:e,append:s,checkLastPage:!0,status:".scroller-status",scrollThreshold:400,loadOnScroll:!0,history:!1,hideNav:i}),t.on("append.infiniteScroll",function(e,i,s,r){var l=jQuery(r);l.find("img").each(function(){$(this).attr("data-srcset",$(this).attr("srcset")),$(this).removeAttr("srcset")}),l.find("img").each(function(){$(this).attr("srcset",$(this).attr("data-srcset")),$(this).removeAttr("data-srcset")}),l.waitForImages(function(){l.find(".kt-slickslider").each(function(){var t=$(this),e=t.data("slider-initdelay");null==e||"0"==e?a(t):setTimeout(function(){a(t)},e)}),"1"==o?t.find(".blog_item").matchHeight():t.isotopeb("appended",l),l.each(function(t){$(this).find(n).delay(75*t).animate({opacity:1},175)})})}))}),jQuery(".init-infinit-norm").each(function(){var t=$(this);nextSelector=$(this).data("nextselector"),navSelector=$(this).data("navselector"),itemSelector=$(this).data("itemselector"),itemloadselector=$(this).data("itemloadselector"),infiniteloader=$(this).data("infiniteloader"),$(nextSelector).length&&(t.infiniteScroll({path:nextSelector,append:itemSelector,checkLastPage:!0,status:".scroller-status",scrollThreshold:400,loadOnScroll:!0,history:!1,hideNav:navSelector}),t.on("append.infiniteScroll",function(t,e,i,s){jQuery(window).trigger("infintescrollnewelements");var n=jQuery(s);n.find("img").each(function(){$(this).attr("data-srcset",$(this).attr("srcset")),$(this).removeAttr("srcset")}),n.find("img").each(function(){$(this).attr("srcset",$(this).attr("data-srcset")),$(this).removeAttr("data-srcset")}),n.waitForImages(function(){n.find(".kt-slickslider").each(function(){var t=$(this),e=t.data("slider-initdelay");null==e||"0"==e?a(t):setTimeout(function(){a(t)},e)})})}))})}),kt_isMobile.any()||jQuery(document).ready(function($){jQuery(window).ktstellar({responsive:!1,horizontalScrolling:!1,verticalOffset:150,parallaxElements:!1}),jQuery(window).on("debouncedresize",function(t){jQuery(window).ktstellar("refresh")})}),jQuery(window).load(function(){jQuery(document).on("yith-wcan-ajax-filtered",function(){var t=jQuery(".kad_product_wrapper"),e=t.data("iso-selector"),i=t.data("iso-style"),a=t.data("iso-filter");if(null==i&&(i="fitRows"),null==a&&(a="false"),matchheight="false",jQuery("body.rtl").length>=1)var s=!1;else var s=!0;t.waitForImages(function(){if(t.isotopeb({masonry:{columnWidth:e},layoutMode:i,itemSelector:e,transitionDuration:"0.8s",isOriginLeft:s}),t.find(".kt_item_fade_in").each(function(t){jQuery(this).delay(75*t).animate({opacity:1},175)}),1==a){var n=t.parents(".main"),o=n.find("#filters");o.length&&(o.on("click","a",function(e){var i=jQuery(this).attr("data-filter");return t.isotopeb({filter:i}),!1}),jQuery("#options .option-set").find("a").click(function(){var t=jQuery(this);if(t.hasClass("selected"))return!1;t.parents(".option-set").find(".selected").removeClass("selected"),t.addClass("selected")}))}})}),jQuery(document).on("post-load",function(){var t=jQuery(".kad_product_wrapper"),e=t.data("iso-selector"),i=t.data("iso-style"),a=t.data("iso-filter");null==i&&(i="fitRows"),null==a&&(a="false"),t.isotopeb("destroy"),t.waitForImages(function(){t.isotopeb({masonry:{columnWidth:e},layoutMode:i,itemSelector:e,transitionDuration:"0.8s",isOriginLeft:iso_rtl}),t.find(".kt_item_fade_in").each(function(t){jQuery(this).delay(75*t).animate({opacity:1},175)})})})});