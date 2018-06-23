!function(e,n,t){function r(e,n){return typeof e===n}function o(){var e,n,t,o,i,s,l;for(var a in g)if(g.hasOwnProperty(a)){if(e=[],n=g[a],n.name&&(e.push(n.name.toLowerCase()),n.options&&n.options.aliases&&n.options.aliases.length))for(t=0;t<n.options.aliases.length;t++)e.push(n.options.aliases[t].toLowerCase());for(o=r(n.fn,"function")?n.fn():n.fn,i=0;i<e.length;i++)s=e[i],l=s.split("."),1===l.length?C[l[0]]=o:(!C[l[0]]||C[l[0]]instanceof Boolean||(C[l[0]]=new Boolean(C[l[0]])),C[l[0]][l[1]]=o),w.push((o?"":"no-")+l.join("-"))}}function i(e,n){return!!~(""+e).indexOf(n)}function s(e){return e.replace(/([a-z])-([a-z])/g,function(e,n,t){return n+t.toUpperCase()}).replace(/^-/,"")}function l(e,n){return function(){return e.apply(n,arguments)}}function a(e,n,t){var o;for(var i in e)if(e[i]in n)return!1===t?e[i]:(o=n[e[i]],r(o,"function")?l(o,t||n):o);return!1}function f(e){return e.replace(/([A-Z])/g,function(e,n){return"-"+n.toLowerCase()}).replace(/^ms-/,"-ms-")}function u(n,t,r){var o;if("getComputedStyle"in e){o=getComputedStyle.call(e,n,t);var i=e.console;if(null!==o)r&&(o=o.getPropertyValue(r));else if(i){var s=i.error?"error":"log";i[s].call(i,"getComputedStyle returning null, its possible modernizrc test results are inaccurate")}}else o=!t&&n.currentStyle&&n.currentStyle[r];return o}function d(){return"function"!=typeof n.createElement?n.createElement(arguments[0]):P?n.createElementNS.call(n,"http://www.w3.org/2000/svg",arguments[0]):n.createElement.apply(n,arguments)}function p(){var e=n.body;return e||(e=d(P?"svg":"body"),e.fake=!0),e}function c(e,t,r,o){var i="modernizrc",s,l,a,f,u=d("div"),c=p();if(parseInt(r,10))for(;r--;)a=d("div"),a.id=o?o[r]:i+(r+1),u.appendChild(a);return s=d("style"),s.type="text/css",s.id="s"+i,(c.fake?c:u).appendChild(s),c.appendChild(u),s.styleSheet?s.styleSheet.cssText=e:s.appendChild(n.createTextNode(e)),u.id=i,c.fake&&(c.style.background="",c.style.overflow="hidden",f=_.style.overflow,_.style.overflow="hidden",_.appendChild(c)),l=t(u,e),c.fake?(c.parentNode.removeChild(c),_.style.overflow=f,_.offsetHeight):u.parentNode.removeChild(u),!!l}function m(n,r){var o=n.length;if("CSS"in e&&"supports"in e.CSS){for(;o--;)if(e.CSS.supports(f(n[o]),r))return!0;return!1}if("CSSSupportsRule"in e){for(var i=[];o--;)i.push("("+f(n[o])+":"+r+")");return i=i.join(" or "),c("@supports ("+i+") { #modernizrc { position: absolute; } }",function(e){return"absolute"==u(e,null,"position")})}return t}function y(e,n,o,l){function a(){u&&(delete E.style,delete E.modElem)}if(l=!r(l,"undefined")&&l,!r(o,"undefined")){var f=m(e,o);if(!r(f,"undefined"))return f}for(var u,p,c,y,h,v=["modernizrc","tspan","samp"];!E.style&&v.length;)u=!0,E.modElem=d(v.shift()),E.style=E.modElem.style;for(c=e.length,p=0;p<c;p++)if(y=e[p],h=E.style[y],i(y,"-")&&(y=s(y)),E.style[y]!==t){if(l||r(o,"undefined"))return a(),"pfx"!=n||y;try{E.style[y]=o}catch(e){}if(E.style[y]!=h)return a(),"pfx"!=n||y}return a(),!1}function h(e,n,t,o,i){var s=e.charAt(0).toUpperCase()+e.slice(1),l=(e+" "+b.join(s+" ")+s).split(" ");return r(n,"string")||r(n,"undefined")?y(l,n,o,i):(l=(e+" "+T.join(s+" ")+s).split(" "),a(l,n,t))}function v(e,n,r){return h(e,t,t,n,r)}var g=[],x={_version:"3.5.0",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(e,n){var t=this;setTimeout(function(){n(t[e])},0)},addTest:function(e,n,t){g.push({name:e,fn:n,options:t})},addAsyncTest:function(e){g.push({name:null,fn:e})}},C=function(){};C.prototype=x,C=new C;var w=[],S="Moz O ms Webkit",b=x._config.usePrefixes?S.split(" "):[];x._cssomPrefixes=b;var T=x._config.usePrefixes?S.toLowerCase().split(" "):[];x._domPrefixes=T;var _=n.documentElement,P="svg"===_.nodeName.toLowerCase(),z={elem:d("modernizrc")};C._q.push(function(){delete z.elem});var E={style:z.elem.style};C._q.unshift(function(){delete E.style}),x.testAllProps=h,x.testAllProps=v,C.addTest("flexbox",v("flexBasis","1px",!0)),C.addTest("flexboxlegacy",v("boxDirection","reverse",!0)),C.addTest("flexboxtweener",v("flexAlign","end",!0)),C.addTest("flexwrap",v("flexWrap","wrap",!0)),o(),delete x.addTest,delete x.addAsyncTest;for(var A=0;A<C._q.length;A++)C._q[A]();e.Modernizrc=C}(window,document);