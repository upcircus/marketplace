    <div class="container-fluid">
      <h3 class="text-center"><strong>Contactez <?php echo ucfirst($data->nom); ?></strong></h3>
    </div><br />
<?php
$email_to_send=$data->email;

if(isset($_POST['submit']))
{
  $sentfrom=htmlentities($_POST['email']);
  $name=htmlentities($_POST['nom']);
  $com=htmlentities($_POST['message']);
  $headers = 'From: '.$sentfrom.''."\r\n" .
     'Reply-To: '.$sentfrom.'' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();    
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  $html_content = '<html>
      <head>
<style>
body {background-color: #eeeeee;}
a {color:#555555;}
.bloc {background-color:#ffffff;border : 1px solid #999999; width:75%; margin:auto; padding:10px;}

</style>
      </head>
      <body>
       <p>Bonjour '.ucfirst($data->nom).',
       <br />Un visiteur vous a envoy&eacute; le message suivant : <br /><br />
       <div class="bloc"><br />
       '.$com.'
       <br /><br />
       </div><br />
       <div style="text-center">Pour communiquer avec cet utilisateur, vous pouvez r&eacute;pondre directement &agrave; cet email. <br /><br /><br />Merci de votre confiance et &agrave; tr&egrave;s bient&ocirc;t. </div><br /><br /><img src="http://upcircus.fr/img/logo_fond_blanc_pointFR.jpg"><br /></p>
      </body>
     </html>
     ';   
  mail($email_to_send,'Un message via le formulaire Upcircus.fr',$html_content,$headers);
	      
	      echo 'Le formulaire a bien été envoyé';
}
?>
      <div class="form-group">
	<form method="POST" action="">
	  <label>Votre nom : </label>
	  <input type="text" class="form-control" name="nom" placeholder="Jean Dupond">
	  <label>Votre email pour vous répondre : </label>
	  <input type="email" class="form-control" name="email" placeholder="monadresse@fournisseur">
	  <label>Votre message : </label>
	  <textarea class="form-control" name="message" placeholder="mon message..."></textarea>
	  <br />
	  <input type="submit" class="btn btn-primary" value="Envoyer !" name="submit">
	</form>
      </div>
    </div>