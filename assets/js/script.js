(function( $ ) {
console.log($(window).width());
if($(window).width()<=700) {
  $(".blog_page a").html("All posts");
}

})( jQuery );
