!function(e){function t(r){if(n[r])return n[r].exports;var a=n[r]={i:r,l:!1,exports:{}};return e[r].call(a.exports,a,a.exports,t),a.l=!0,a.exports}var n={};t.m=e,t.c=n,t.i=function(e){return e},t.d=function(e,n,r){t.o(e,n)||Object.defineProperty(e,n,{configurable:!1,enumerable:!0,get:r})},t.n=function(e){var n=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(n,"a",n),n},t.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},t.p="",t(t.s=50)}({50:function(e,t,n){e.exports=n(9)},9:function(e,t){var n=[{data:null,orderable:!1,searchable:!1,width:"5%"},{data:"name",name:"name"},{data:"id",name:"id",orderable:!1,searchable:!1,render:function(e){return _BtnDatatable.create(e)}}];_DatatableFactory.build($("#category"),_urlAjaxDatatable,n),_elm=$(document),_elm.on("click",".dt-delete",function(e){e.preventDefault(),confirm("Are you sure ?")&&($(this).html('<i class="fa fa-spinner fa-spin"></i>'),$(this).parent().find("form.action-delete").submit())})}});