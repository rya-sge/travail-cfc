<?php
  $titre ='MesActivités - validation';

// vue_login.php
// Date de création : 07/2018
// Auteur : RSA
// Fonction : vue pour l'affichage la connexion utilisateur
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();
?>
<?$_SESSION['error']="";?>
<h1 style="text-align:center">Validation du compte</h1>

<article>
 <p>
	Félicitation, votre compte a été activé et vous pouvez dès maintenant vous connecter sur le site.
</p> 
 
</article>
<hr/>
<?php 
  $contenu = ob_get_clean();
  require 'gabarit_visiteur.php';
?>  
      
      
      