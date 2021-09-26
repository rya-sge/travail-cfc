<?php
  $titre ='MesActivités - validation email';

// vue_validation_email2.php
// Date de création : 26/08/2018
// Auteur : RSA
// Fonction : vue pour confirmer la validation de l'adresse email
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();
?>
<?$_SESSION['error']="";?>
<h1 style="text-align:center">Validation de l'adresse email</h1>

<article>
 <p>
	Félicitation, votre adresse email est désormais valide.
</p> 
 
</article>
<hr/>
<?php 
  $contenu = ob_get_clean();
  require 'gabarit_visiteur.php';
?>  
      
      
      