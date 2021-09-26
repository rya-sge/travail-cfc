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
<h1 style="text-align:center">Réintialiser votre mot de passe</h1>

<article>
 <p>
	Un lien permettant la réinitialisation de votre mot de passe vous a été envoyé par email.
</p> 
 
</article>
<hr/>
<?php 
  $contenu = ob_get_clean();
  require 'gabarit_visiteur.php';
?>  
      
      
      