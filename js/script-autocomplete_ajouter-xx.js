
$(function() {
  $( "#search_second" ).autocomplete({
    minLength: 2,
    source: "requete_autocompletion.php",
    focus: function( event, ui ) {
      $( "#search_second" ).val( ui.item.label );
      return false;
    },
    
    select: function( event, ui ) {
      $( "#search_second" ).val( ui.item.label );
      $( "#search_second-cat" ).val( ui.item.desc );
      return false;
    }
  })
  .autocomplete( "instance" )._renderItem = function( ul, item ) {
    return $( "<li>" )
      .append(item.label+ "<br /><small>Catégorie : " + item.desc + "</small>" )
      .appendTo( ul );
  };
});


$(function() {
  $( "#searchvideo" ).autocomplete({
    minLength: 2,
    source: "requete_autocompletion.php",
    focus: function( event, ui ) {
      $( "#searchvideo" ).val( ui.item.label );
      return false;
    },
    
    select: function( event, ui ) {
      $( "#searchvideo" ).val( ui.item.label );
      $( "#searchvideo-cat" ).val( ui.item.desc );

      return false;
    }
  })
  .autocomplete( "instance" )._renderItem = function( ul, item ) {
    return $( "<li>" )
      .append(item.label+ "<br /><small>Catégorie : " + item.desc + "</small>" )
      .appendTo( ul );
  };
});
