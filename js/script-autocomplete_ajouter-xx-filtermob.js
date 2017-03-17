
$(function() {
  $( "#searcht_filt" ).autocomplete({
    minLength: 2,
    source: "requete_autocompletion.php",
    focus: function( event, ui ) {
      $( "#searcht_filt" ).val( ui.item.label );
      return false;
    },
    
    select: function( event, ui ) {
      $( "#searcht_filt" ).val( ui.item.label );
      $( "#searcht_filt-cat" ).val( ui.item.desc );

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
  $( "#searcht_filt_mob" ).autocomplete({
    minLength: 2,
    source: "requete_autocompletion.php",
    focus: function( event, ui ) {
      $( "#searcht_filt_mob" ).val( ui.item.label );
      return false;
    },
    
    select: function( event, ui ) {
      $( "#searcht_filt_mob" ).val( ui.item.label );
      $( "#searcht_filt_mob-cat" ).val( ui.item.desc );

      return false;
    }
  })
  .autocomplete( "instance" )._renderItem = function( ul, item ) {
    return $( "<li>" )
      .append(item.label+ "<br /><small>Catégorie : " + item.desc + "</small>" )
      .appendTo( ul );
  };
});

