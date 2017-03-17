
$(function() {
  $( "#search" ).autocomplete({
    minLength: 2,
    source: "requete_autocompletion.php",
    focus: function( event, ui ) {
      $( "#search" ).val( ui.item.label );
      return false;
    },
    
    select: function( event, ui ) {
      $( "#search" ).val( ui.item.label );
      $( "#search-cat" ).val( ui.item.desc );

      return false;
    }
  })
  .autocomplete( "instance" )._renderItem = function( ul, item ) {
    return $( "<li>" )
      .append(item.label+ "<br /><small>Catégorie : " + item.desc + "</small>" )
      .appendTo( ul );
  };
});
