var kt_woo_extra_isMobile={Android:function(){return navigator.userAgent.match(/Android/i)},BlackBerry:function(){return navigator.userAgent.match(/BlackBerry/i)},iOS:function(){return navigator.userAgent.match(/iPhone|iPad|iPod/i)},Opera:function(){return navigator.userAgent.match(/Opera Mini/i)},Windows:function(){return navigator.userAgent.match(/IEMobile/i)},any:function(){return kt_woo_extra_isMobile.Android()||kt_woo_extra_isMobile.BlackBerry()||kt_woo_extra_isMobile.iOS()||kt_woo_extra_isMobile.Opera()||kt_woo_extra_isMobile.Windows()}};jQuery(document).ready(function($){if(0==("function"==typeof $().tooltip)&&!kt_woo_extra_isMobile.any()){if("undefined"==typeof jQuery)throw new Error("Bootstrap's JavaScript requires jQuery");+function(t){"use strict";var e=t.fn.jquery.split(" ")[0].split(".");if(e[0]<2&&e[1]<9||1==e[0]&&9==e[1]&&e[2]<1||e[0]>3)throw new Error("Bootstrap's JavaScript requires jQuery version 1.9.1 or higher, but lower than version 4")}(jQuery),function(t){"use strict";function e(e){return this.each(function(){var o=t(this),n=o.data("bs.tooltip"),r="object"==typeof e&&e;!n&&/destroy|hide/.test(e)||(n||o.data("bs.tooltip",n=new i(this,r)),"string"==typeof e&&n[e]())})}var i=function(t,e){this.type=null,this.options=null,this.enabled=null,this.timeout=null,this.hoverState=null,this.$element=null,this.inState=null,this.init("tooltip",t,e)};i.VERSION="3.3.7",i.TRANSITION_DURATION=150,i.DEFAULTS={animation:!0,placement:"top",selector:!1,template:'<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',trigger:"hover focus",title:"",delay:0,html:!1,container:!1,viewport:{selector:"body",padding:0}},i.prototype.init=function(e,i,o){if(this.enabled=!0,this.type=e,this.$element=t(i),this.options=this.getOptions(o),this.$viewport=this.options.viewport&&t(t.isFunction(this.options.viewport)?this.options.viewport.call(this,this.$element):this.options.viewport.selector||this.options.viewport),this.inState={click:!1,hover:!1,focus:!1},this.$element[0]instanceof document.constructor&&!this.options.selector)throw new Error("`selector` option must be specified when initializing "+this.type+" on the window.document object!");for(var n=this.options.trigger.split(" "),r=n.length;r--;){var a=n[r];if("click"==a)this.$element.on("click."+this.type,this.options.selector,t.proxy(this.toggle,this));else if("manual"!=a){var s="hover"==a?"mouseenter":"focusin",l="hover"==a?"mouseleave":"focusout";this.$element.on(s+"."+this.type,this.options.selector,t.proxy(this.enter,this)),this.$element.on(l+"."+this.type,this.options.selector,t.proxy(this.leave,this))}}this.options.selector?this._options=t.extend({},this.options,{trigger:"manual",selector:""}):this.fixTitle()},i.prototype.getDefaults=function(){return i.DEFAULTS},i.prototype.getOptions=function(e){return e=t.extend({},this.getDefaults(),this.$element.data(),e),e.delay&&"number"==typeof e.delay&&(e.delay={show:e.delay,hide:e.delay}),e},i.prototype.getDelegateOptions=function(){var e={},i=this.getDefaults();return this._options&&t.each(this._options,function(t,o){i[t]!=o&&(e[t]=o)}),e},i.prototype.enter=function(e){var i=e instanceof this.constructor?e:t(e.currentTarget).data("bs."+this.type);return i||(i=new this.constructor(e.currentTarget,this.getDelegateOptions()),t(e.currentTarget).data("bs."+this.type,i)),e instanceof t.Event&&(i.inState["focusin"==e.type?"focus":"hover"]=!0),i.tip().hasClass("in")||"in"==i.hoverState?void(i.hoverState="in"):(clearTimeout(i.timeout),i.hoverState="in",i.options.delay&&i.options.delay.show?void(i.timeout=setTimeout(function(){"in"==i.hoverState&&i.show()},i.options.delay.show)):i.show())},i.prototype.isInStateTrue=function(){for(var t in this.inState)if(this.inState[t])return!0;return!1},i.prototype.leave=function(e){var i=e instanceof this.constructor?e:t(e.currentTarget).data("bs."+this.type);return i||(i=new this.constructor(e.currentTarget,this.getDelegateOptions()),t(e.currentTarget).data("bs."+this.type,i)),e instanceof t.Event&&(i.inState["focusout"==e.type?"focus":"hover"]=!1),i.isInStateTrue()?void 0:(clearTimeout(i.timeout),i.hoverState="out",i.options.delay&&i.options.delay.hide?void(i.timeout=setTimeout(function(){"out"==i.hoverState&&i.hide()},i.options.delay.hide)):i.hide())},i.prototype.show=function(){var e=t.Event("show.bs."+this.type);if(this.hasContent()&&this.enabled){this.$element.trigger(e);var o=t.contains(this.$element[0].ownerDocument.documentElement,this.$element[0]);if(e.isDefaultPrevented()||!o)return;var n=this,r=this.tip(),a=this.getUID(this.type);this.setContent(),r.attr("id",a),this.$element.attr("aria-describedby",a),this.options.animation&&r.addClass("fade");var s="function"==typeof this.options.placement?this.options.placement.call(this,r[0],this.$element[0]):this.options.placement,l=/\s?auto?\s?/i,p=l.test(s);p&&(s=s.replace(l,"")||"top"),r.detach().css({top:0,left:0,display:"block"}).addClass(s).data("bs."+this.type,this),this.options.container?r.appendTo(this.options.container):r.insertAfter(this.$element),this.$element.trigger("inserted.bs."+this.type);var h=this.getPosition(),c=r[0].offsetWidth,d=r[0].offsetHeight;if(p){var u=s,f=this.getPosition(this.$viewport);s="bottom"==s&&h.bottom+d>f.bottom?"top":"top"==s&&h.top-d<f.top?"bottom":"right"==s&&h.right+c>f.width?"left":"left"==s&&h.left-c<f.left?"right":s,r.removeClass(u).addClass(s)}var v=this.getCalculatedOffset(s,h,c,d);this.applyPlacement(v,s);var g=function(){var t=n.hoverState;n.$element.trigger("shown.bs."+n.type),n.hoverState=null,"out"==t&&n.leave(n)};t.support.transition&&this.$tip.hasClass("fade")?r.one("bsTransitionEnd",g).emulateTransitionEnd(i.TRANSITION_DURATION):g()}},i.prototype.applyPlacement=function(e,i){var o=this.tip(),n=o[0].offsetWidth,r=o[0].offsetHeight,a=parseInt(o.css("margin-top"),10),s=parseInt(o.css("margin-left"),10);isNaN(a)&&(a=0),isNaN(s)&&(s=0),e.top+=a,e.left+=s,t.offset.setOffset(o[0],t.extend({using:function(t){o.css({top:Math.round(t.top),left:Math.round(t.left)})}},e),0),o.addClass("in");var l=o[0].offsetWidth,p=o[0].offsetHeight;"top"==i&&p!=r&&(e.top=e.top+r-p);var h=this.getViewportAdjustedDelta(i,e,l,p);h.left?e.left+=h.left:e.top+=h.top;var c=/top|bottom/.test(i),d=c?2*h.left-n+l:2*h.top-r+p,u=c?"offsetWidth":"offsetHeight";o.offset(e),this.replaceArrow(d,o[0][u],c)},i.prototype.replaceArrow=function(t,e,i){this.arrow().css(i?"left":"top",50*(1-t/e)+"%").css(i?"top":"left","")},i.prototype.setContent=function(){var t=this.tip(),e=this.getTitle();t.find(".tooltip-inner")[this.options.html?"html":"text"](e),t.removeClass("fade in top bottom left right")},i.prototype.hide=function(e){function o(){"in"!=n.hoverState&&r.detach(),n.$element&&n.$element.removeAttr("aria-describedby").trigger("hidden.bs."+n.type),e&&e()}var n=this,r=t(this.$tip),a=t.Event("hide.bs."+this.type);return this.$element.trigger(a),a.isDefaultPrevented()?void 0:(r.removeClass("in"),t.support.transition&&r.hasClass("fade")?r.one("bsTransitionEnd",o).emulateTransitionEnd(i.TRANSITION_DURATION):o(),this.hoverState=null,this)},i.prototype.fixTitle=function(){var t=this.$element;(t.attr("title")||"string"!=typeof t.attr("data-original-title"))&&t.attr("data-original-title",t.attr("title")||"").attr("title","")},i.prototype.hasContent=function(){return this.getTitle()},i.prototype.getPosition=function(e){e=e||this.$element;var i=e[0],o="BODY"==i.tagName,n=i.getBoundingClientRect();null==n.width&&(n=t.extend({},n,{width:n.right-n.left,height:n.bottom-n.top}));var r=window.SVGElement&&i instanceof window.SVGElement,a=o?{top:0,left:0}:r?null:e.offset(),s={scroll:o?document.documentElement.scrollTop||document.body.scrollTop:e.scrollTop()},l=o?{width:t(window).width(),height:t(window).height()}:null;return t.extend({},n,s,l,a)},i.prototype.getCalculatedOffset=function(t,e,i,o){return"bottom"==t?{top:e.top+e.height,left:e.left+e.width/2-i/2}:"top"==t?{top:e.top-o,left:e.left+e.width/2-i/2}:"left"==t?{top:e.top+e.height/2-o/2,left:e.left-i}:{top:e.top+e.height/2-o/2,left:e.left+e.width}},i.prototype.getViewportAdjustedDelta=function(t,e,i,o){var n={top:0,left:0};if(!this.$viewport)return n;var r=this.options.viewport&&this.options.viewport.padding||0,a=this.getPosition(this.$viewport);if(/right|left/.test(t)){var s=e.top-r-a.scroll,l=e.top+r-a.scroll+o;s<a.top?n.top=a.top-s:l>a.top+a.height&&(n.top=a.top+a.height-l)}else{var p=e.left-r,h=e.left+r+i;p<a.left?n.left=a.left-p:h>a.right&&(n.left=a.left+a.width-h)}return n},i.prototype.getTitle=function(){var t,e=this.$element,i=this.options;return t=e.attr("data-original-title")||("function"==typeof i.title?i.title.call(e[0]):i.title)},i.prototype.getUID=function(t){do{t+=~~(1e6*Math.random())}while(document.getElementById(t));return t},i.prototype.tip=function(){if(!this.$tip&&(this.$tip=t(this.options.template),1!=this.$tip.length))throw new Error(this.type+" `template` option must consist of exactly 1 top-level element!");return this.$tip},i.prototype.arrow=function(){return this.$arrow=this.$arrow||this.tip().find(".tooltip-arrow")},i.prototype.enable=function(){this.enabled=!0},i.prototype.disable=function(){this.enabled=!1},i.prototype.toggleEnabled=function(){this.enabled=!this.enabled},i.prototype.toggle=function(e){var i=this;e&&((i=t(e.currentTarget).data("bs."+this.type))||(i=new this.constructor(e.currentTarget,this.getDelegateOptions()),t(e.currentTarget).data("bs."+this.type,i))),e?(i.inState.click=!i.inState.click,i.isInStateTrue()?i.enter(i):i.leave(i)):i.tip().hasClass("in")?i.leave(i):i.enter(i)},i.prototype.destroy=function(){var t=this;clearTimeout(this.timeout),this.hide(function(){t.$element.off("."+t.type).removeData("bs."+t.type),t.$tip&&t.$tip.detach(),t.$tip=null,t.$arrow=null,t.$viewport=null,t.$element=null})};var o=t.fn.tooltip;t.fn.tooltip=e,t.fn.tooltip.Constructor=i,t.fn.tooltip.noConflict=function(){return t.fn.tooltip=o,this}}(jQuery)}$(".variations [data-toggle=tooltip]").tooltip();var t=$(".product form.variations_form"),e=$(".variations td.product_value select"),i=t.find(".single_variation_wrap"),o=t.data("product_variations")===!1,n=t.data("product_variations"),r=$(".variations td.product_value").length;t.on("click",".reset_variations",function(){return t.find(".kad_radio_variations .selectedValue").removeClass("selectedValue"),t.find(".kad_radio_variations label").removeClass("kt_disabled "),t.find('.kad_radio_variations input[type="radio"]:checked').prop("checked",!1),!1}),t.on("reset_data",function(){t.find(".single_variation_wrap_kad").find(".quantity").hide(),t.find(".single_variation .price").hide()}),t.on("click",".select-option",function(t){t.preventDefault()}),t.on("change",'.variations input[type="radio"]',function(e){var i=$(this),o=i.closest(".kt-radio-variation-container"),n=o.find("select").first(),r=i.val();n.trigger("focusin"),n.find('option[value="'+r+'"]').length?n.trigger("focusin").val(r).trigger("change"):(t.find(".variations select").val("").change(),t.find(".kad_radio_variations .selectedValue").removeClass("selectedValue"),t.find(".kad_radio_variations label").removeClass("kt_disabled "),$(".variations .kad-select").select2({minimumResultsForSearch:-1}),t.find('.kad_radio_variations input[type="radio"]:checked').prop("checked",!1),t.trigger("reset_data"),t.find('.kad_radio_variations input[type="radio"][value="'+r+'"]').prop("checked",!0),n.trigger("focusin").val(r).trigger("change")),t.find(".kad_radio_variations .selectedValue").removeClass("selectedValue"),t.find('.kad_radio_variations input[type="radio"]:checked').closest("label").addClass("selectedValue")}),t.on("woocommerce_variation_has_changed",function(){if(!o){var e={},i=[];t.find(".variations select").each(function(){$(this).trigger("focusin"),$(this).find("option.enabled").each(function(){i.push($(this).val())})}),t.find(".variations .kad_radio_variations").each(function(t,e){var o=$(e),n=o.data("attribute_name");o.find("input").removeClass("attached"),o.find("input").removeClass("enabled"),o.find("label").removeClass("kt_disabled ");var r;for(r=0;r<i.length;++r)o.find('input[value="'+i[r]+'"]').addClass("attached enabled");o.find("input:not(.attached)").closest("label").addClass("kt_disabled")})}}),t.on("woocommerce_variation_has_changed",function(){$(".kad-select").trigger("update"),o&&$(window).width()>790&&!kt_woo_extra_isMobile.any()&&$(".kad-select").select2({minimumResultsForSearch:-1})}),i.on("hide_variation",function(){$(this).css("height","auto")}),e.on("select2-opening",function(){o||(t.trigger("woocommerce_variation_select_focusin"),t.trigger("check_variations",[$(this).data("attribute_name")||$(this).attr("name"),!0]))}),$(function(){"undefined"!=typeof wc_add_to_cart_variation_params&&$(".variations_form").each(function(){$(this).find('.variations input[type="radio"]:checked').change()})})});