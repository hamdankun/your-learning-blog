!function(t){function n(o){if(e[o])return e[o].exports;var r=e[o]={i:o,l:!1,exports:{}};return t[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}var e={};n.m=t,n.c=e,n.i=function(t){return t},n.d=function(t,e,o){n.o(t,e)||Object.defineProperty(t,e,{configurable:!1,enumerable:!0,get:o})},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,n){return Object.prototype.hasOwnProperty.call(t,n)},n.p="",n(n.s=10)}({10:function(t,n,e){t.exports=e("aZpi")},aZpi:function(t,n){var e='<i class="fa fa-spinner fa-spin"></i>';$(document).on("submit",".disabled-when-submit",function(){_buttonForm=$(this).find("button").not("[type=reset]"),_buttonForm.find("button").prop("disabled",!0),_buttonForm.html(e),$(this).submit()}),$(document).on("click",".disabled-when-click",function(t){$(this).html(e)}),$(window).on("load",function(){_Loader.hide()}),$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}})}});