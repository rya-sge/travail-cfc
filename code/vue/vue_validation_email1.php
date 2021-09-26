<?php
  $titre ='MesActivités - lien email';

// vue_login.php
// Date de création : 26/08/2018
// Auteur : RSA
// Fonction : vue pour l'envoi du lien de confirmation de l'adresse email
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();
?>
<?$_SESSION['error']="";?>
<h1 style="text-align:center">Validation de l'adresse email</h1>

<article>
 <p>
	Un lien vous a été envoyé à votre nouvelle adresse email pour confirmer le changement
</p> 
 
</article>
<hr/>
<?php 
  $contenu = ob_get_clean();
  require 'gabarit_visiteur.php';
?>  
      
      
      