
$(function() {
$( "#menu-xs" ).click(function() {
  $( "#full" ).fadeIn();
  $( "#toggle" ).toggle( "slide" );
  $("body").css('overflow','hidden');
});
});
$(function() {
$( "#full" ).click(function() {
  $( "#full" ).fadeOut();
  $( "#toggle" ).toggle( "slide" );
  $("body").css('overflow','auto');
});
});

$(function() {
$( "#connexion" ).click(function() {
  $( "#full" ).fadeOut();
  $( "#toggle" ).toggle( "slide" );
  $("body").css('overflow','auto');
});
});

$(function() {
$( "#connexion2" ).click(function() {
  $( "#full" ).fadeOut();
  $( "#toggle" ).toggle( "slide" );
  $("body").css('overflow','auto');
});
});
