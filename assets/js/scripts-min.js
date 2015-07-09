/*----------------------------------------------------------------------------------*/
/*	- Plugins
/*-----------------------------------------------------------------------------------*/
!function(e){e.fn.jflickrfeed=function(i,a){i=e.extend(!0,{flickrbase:"http://api.flickr.com/services/feeds/",feedapi:"photos_public.gne",limit:20,qstrings:{lang:"en-us",format:"json",jsoncallback:"?"},cleanDescription:!0,useTemplate:!0,itemTemplate:"",itemCallback:function(){}},i);var t=i.flickrbase+i.feedapi+"?",c=!0;for(var m in i.qstrings)c||(t+="&"),t+=m+"="+i.qstrings[m],c=!1;return e(this).each(function(){var c=e(this),m=this;e.getJSON(t,function(t){e.each(t.items,function(e,a){if(e<i.limit){if(i.cleanDescription){var t=/<p>(.*?)<\/p>/g,n=a.description;t.test(n)&&(a.description=n.match(t)[2],void 0!=a.description&&(a.description=a.description.replace("<p>","").replace("</p>","")))}if(a.image_s=a.media.m.replace("_m","_s"),a.image_q=a.media.m.replace("_m","_q"),a.image_t=a.media.m.replace("_m","_t"),a.image_m=a.media.m.replace("_m","_m"),a.image=a.media.m.replace("_m",""),a.image_b=a.media.m.replace("_m","_b"),delete a.media,i.useTemplate){var r=i.itemTemplate;for(var l in a){var p=new RegExp("{{"+l+"}}","g");r=r.replace(p,a[l])}c.append(r)}i.itemCallback.call(m,a)}}),e.isFunction(a)&&a.call(m,t)})})}}(jQuery);
/*----------------------------------------------------------------------------------*/
/*	- Widgets
/*-----------------------------------------------------------------------------------*/
function flickrWidget(){"use strict";$j(".uwl-flickr-widget").each(function(){$j(this).jflickrfeed({limit:$j(this).data("num"),qstrings:{id:$j(this).data("id")},itemTemplate:$j(this).next().text()})})}function menuWidget(){"use strict";$j(".uwl_menu_widget ul li.has-sub .uwl-sub-icon, .uwl_menu_widget ul li.has-sub a[href*=#]").on("click",function(s){s.preventDefault(),$j(this).closest("li.has-sub").find("> ul.uwl-sub-menu").is(":visible")?($j(this).closest("li.has-sub").find("> ul.uwl-sub-menu").slideUp(200),$j(this).closest("li.has-sub").removeClass("open-sub")):($j(this).closest("li.has-sub").addClass("open-sub"),$j(this).closest("li.has-sub").find("> ul.uwl-sub-menu").slideDown(200))})}var $j=jQuery.noConflict();$j(document).ready(function(){"use strict";flickrWidget(),menuWidget()});