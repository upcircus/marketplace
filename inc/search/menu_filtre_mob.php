<div id="menu-filt-rech">

  <link rel="stylesheet" href="css/module_filtre_recherche.css">

  
  <!-- Fin JS -->
    <script>
    $(function() {
      $( "#slider-notations2" ).slider({
	range: true,
	min: 1,
	max: 5,
	values: [ <?php echo isset($_GET['notations-low']) ? $_GET['notations-low'] : 1; ?> , <?php echo isset($_GET['notations-high']) ? $_GET['notations-high'] : 5; ?> ],
	slide: function( event, ui ) {
	  $( "#amount-notations2" ).val("De " + ui.values[ 0 ]+"★ à " + ui.values[ 1 ]+"★" );
	  $("#notations-low2").val(ui.values[ 0 ])
	  $("#notations-high2").val(ui.values[ 1 ]);
	}
      });
      $( "#amount-notations2" ).val("De " + $( "#slider-notations2" ).slider( "values", 0 ) +
	"★ à " + $( "#slider-notations2" ).slider( "values", 1 )+"★" )
      $("#notations-high2").val($( "#slider-notations2" ).slider( "values", 1 ))
      $("#notations-low2").val($( "#slider-notations2" ).slider( "values", 0 ));
    });
    
    </script>
    
    <script>
    $(function() {
      $( "#slider-difficulte2" ).slider({
	range: true,
	min: 1,
	max: 5,
	values: [ <?php echo isset($_GET['difficulte-low']) ? $_GET['difficulte-low'] : 1; ?>, <?php echo isset($_GET['difficulte-high']) ? $_GET['difficulte-high'] : 5; ?> ],
	slide: function( event, ui ) {
	  $( "#amount-difficulte2" ).val("De " + ui.values[ 0 ]+"★" + " à " + ui.values[ 1 ]+"★" );
	  $("#difficulte-low2").val(ui.values[ 0 ])
	  $("#difficulte-high2").val(ui.values[ 1 ]);
	}
      });
      $( "#amount-difficulte2" ).val("De " +  $( "#slider-difficulte2" ).slider( "values", 0 ) +
	"★ à " + $( "#slider-difficulte2" ).slider( "values", 1 )+"★" )
      $("#difficulte-high2").val($( "#slider-difficulte2" ).slider( "values", 1 ))
      $("#difficulte-low2").val($( "#slider-difficulte2" ).slider( "values", 0 ));
    });
    
    </script>
<script src="js/script-autocomplete_ajouter-xx-filtermob.js"></script>
  <?php

  $pdo->query("SET NAMES 'utf8'");
  $req_filtre=$pdo->query("SELECT * FROM famille_contrib");
  ?>

  <br />
  <div class="form-group">
    <div class="col-lg-12 border-filter">
    <br />
    <form method="GET" action="moteur.php">
    <label class="control-label">Affinez votre recherche :</label>
    <input type="text" class="form-control" placeholder="recherche" id="searcht_filt_mob" name="searcht" value="<?php if(isset($_GET['search'])){echo $_GET['search'];} elseif(isset($_GET['searcht'])){echo $_GET['searcht'];}?>" >
    <input type="hidden" name = "cat" id="searcht_filt_mob-cat"><br />
    <label>Tutoriels :</label> 
    <div class="onoffswitch">
	<input type="checkbox" name="tutoswitch" class="onoffswitch-checkbox" id="tutoswitch2" <?php if(isset($_GET['tutoswitch']) && $_GET['tutoswitch']=="on"){echo "checked";} elseif(isset($_GET['search']) && !isset($_GET['tutoswitch'])){echo "checked";} ?>>
	<label class="onoffswitch-label" for="tutoswitch2">
	    <span class="onoffswitch-inner"></span>
	    <span class="onoffswitch-switch"></span>
	</label>
    </div>
    
    <label>Idées : </label> 
    <div class="onoffswitch">
	<input type="checkbox" name="ideeswitch" class="onoffswitch-checkbox" id="ideeswitch2" <?php if(isset($_GET['ideeswitch']) && $_GET['ideeswitch']=="on"){echo "checked";} elseif(isset($_GET['search']) && !isset($_GET['ideeswitch'])){echo "checked";} ?>>
	<label class="onoffswitch-label" for="ideeswitch2">
	    <span class="onoffswitch-inner"></span>
	    <span class="onoffswitch-switch"></span>
	</label>
    </div>
<br />
  <div class="form-group">
      <label>Catégories : </label>
      <select Value="Choisissez une catégorie" name="cat-famille">
	<option value="toutes">Toutes</option>
      <?php    
      foreach ($req_filtre as $post)
	    {
	      echo '<option value="'.$post->label.'"';
	      if(isset($_GET['cat-famille'])&&strtolower($_GET['cat-famille'])==$post->label)
	      {
		echo "selected";
	      }
	      echo '>'.$post->nom_famille.'</option>';
	    }
      ?>
      </select>
  </div>
    <div>
      <label for="amount-notations2">Notations : </label><br />
      <input type="text" id="amount-notations2" readonly style="border:0; color:#f6931f; font-weight:bold;">
    </div>

    <div id="slider-notations2"></div>
    <input type="hidden" id="notations-high2" name="notations-high">
    <input type="hidden" id="notations-low2" name="notations-low">
    <input type="checkbox" value="oui" name="non-note" <?php if(isset($_GET['non-note']) && $_GET['non-note']=="oui"){echo "checked";} elseif(isset($_GET['search']) && !isset($_GET['non-note'])){echo "checked";} ?>><mini><strong>Inclure les non-notés</strong></mini><br /><br />
    
    <div>
      <label for="amount-difficulte2">Difficulté : </label><br />
      <input type="text" id="amount-difficulte2" readonly style="border:0; color:#f6931f; font-weight:bold;" size="9">
    </div>
    
    <div id="slider-difficulte2"></div>
    <input type="hidden" id="difficulte-high2" name="difficulte-high">
    <input type="hidden" id="difficulte-low2" name="difficulte-low">
    
    <div> 
      <br />
      <br />
      <input type="submit" class="btn btn-primary" value="Rechercher" name="rech_filter" onclick="generation()">
      <br /><br />
      </form>
    </div>
  </div>

</div>

</div>