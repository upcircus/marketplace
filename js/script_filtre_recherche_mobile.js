$(function() {
$( "#full2" ).click(function() {
  $( "#full2" ).fadeOut();
  $( "#menu-filt-rech" ).toggle( "slide" );
  $("body").css('overflow','auto');
});
});

$(function() {
$( "#btn-filtre-recherche" ).click(function() {
  $( "#full2" ).fadeIn();
  $( "#menu-filt-rech" ).toggle( "slide" );
  $("body").css('overflow','auto');
});
});