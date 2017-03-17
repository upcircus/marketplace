$(function() {
$( ".inscriptionbtn" ).click(function() {
  $( "#whiteback" ).fadeIn();
  $( "#windowregister" ).fadeIn();
  
});
});

$(function() {
$( ".connexionbtn" ).click(function() {
  $( "#whiteback" ).fadeIn();
  $( "#windowconnect" ).fadeIn();

});
});

$(function() {
$( ".forgetbtn" ).click(function() {
  $( "#windowconnect" ).fadeOut();
  $( "#windowforget" ).fadeIn();
});
});

$(function() {
$( "#cnxoutregisterin" ).click(function() {
  $( "#windowconnect" ).fadeOut();
  $( "#windowregister" ).fadeIn();
});
});

$(function() {
$( ".closepopup" ).click(function() {
  $( "#whiteback" ).fadeOut();
  $( "#windowregister" ).fadeOut();
  $( "#windowconnect" ).fadeOut();
  $( "#windowforget" ).fadeOut();
  $( "#followproduct" ).fadeOut();
  $( "#sellproduct" ).fadeOut();
  $( "#signalproduct" ).fadeOut();
  $( "#windownewsletter" ).fadeOut();
  
});
});

$(function() {
$( ".followproductbtn" ).click(function() {
  $( "#whiteback" ).fadeIn();
  $( "#followproduct" ).fadeIn();
});
});

$(function() {
$( ".sellproductbtn" ).click(function() {
  $( "#whiteback" ).fadeIn();
  $( "#sellproduct" ).fadeIn();
});
});

$(function() {
$( ".selloutregisterin" ).click(function() {
  $( "#sellproduct" ).fadeOut();
  $( "#windowregister" ).fadeIn();
});
});

$(function() {
$( ".signalproduct" ).click(function() {
  $( "#whiteback" ).fadeIn();
  $( "#signalproduct" ).fadeIn();
});
});

$(function() {
$( "#balancetanews" ).click(function() {
  $( "#whiteback" ).fadeIn();
  $( "#windownewsletter" ).fadeIn();

});
});