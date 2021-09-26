<?php
  $titre ='MesActivités - validation email';

// vue_validation_email3.php
// Date de création : 26/08/2018
// Auteur : RSA
// Fonction : vue pour qui demande à l'utilisateur de se connecter pour valider son adresse email
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();
?>
<?$_SESSION['error']="";?>
<h1 style="text-align:center">Validation de l'adresse email</h1>

<article>
 <p>
	Vous devez être connecté pour valider votre adresse email
</p> 
 
</article>
<hr/>
<?php 
  $contenu = ob_get_clean();
  require 'gabarit_visiteur.php';
?>  
      
      
      