!function(t){function e(n){if(r[n])return r[n].exports;var a=r[n]={i:n,l:!1,exports:{}};return t[n].call(a.exports,a,a.exports,e),a.l=!0,a.exports}var r={};e.m=t,e.c=r,e.i=function(t){return t},e.d=function(t,r,n){e.o(t,r)||Object.defineProperty(t,r,{configurable:!1,enumerable:!0,get:n})},e.n=function(t){var r=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(r,"a",r),r},e.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},e.p="",e(e.s=54)}({13:function(t,e){function r(){if(i)return!1;o.html(""),a.show(),_Http._get(_baseUrl+"/ajax/frontend/popular-article",{},function(t){"success"===t.status&&(_popularArticleContent="",$.each(t.data,function(t,e){_popularArticleContent+='<div class="card horizontal custom-card-horizontal">',_popularArticleContent+='<div class="card-image">',_popularArticleContent+='<img data-original="'+_baseUrlImgPath+"/article-images/100x100/"+e.image+'" class="lazy img-related">',_popularArticleContent+="</div>",_popularArticleContent+='<div class="card-stacked">',_popularArticleContent+='<div class="card-content p-15">',_popularArticleContent+='<p class="left-align"><a href="'+urlDetailArticle.replace(":category",e.category_slug).replace(":article",e.article_slug)+'" class="text-black">'+e.title+"</a></p>",_popularArticleContent+="</div>",_popularArticleContent+="</div>",_popularArticleContent+="</div>"}),i=!0,o.append(_popularArticleContent),n(),_Image.lazy(),a.hide())},function(t){a.hide()})}function n(){setTimeout(function(){i=!1},3e5)}var a=$(".spinner-popular-article"),o=$("#popularArticle"),i=!1;!function(t,e,r){var n,a=t.getElementsByTagName(e)[0];t.getElementById(r)||(n=t.createElement(e),n.id=r,n.src="//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.10&appId=1218744614805599",a.parentNode.insertBefore(n,a))}(document,"script","facebook-jssdk"),$(".fb-xfbml-parse-ignore").click(function(){FB.ui({method:"share",display:"popup",href:currentUrl},function(t){})}),_Image.lazy(),_elm.ready(function(){$(".popular-article").click(function(){r()}),$("#ratting").barrating({theme:"fontawesome-stars-o",initialRating:4.5,readonly:!0})})},54:function(t,e,r){t.exports=r(13)}});