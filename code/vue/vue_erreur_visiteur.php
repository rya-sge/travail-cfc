<?php
  $titre ='MesActiviés-erreur';

// vue_erreur_visiteur.php
// Date de création : 04/05/17
// Auteur : RSA
// Fonction : vue pour l'affichage des erreurs si l'utilisateur n'a pas ouvert de projet. Affiche un gabarit et non une autre page.
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();
?>

<article>
  <header>
    <!--<h2> Erreur </h2> L'erreur s'affiche grâce au gabarit-->
    <!--<h2> Erreur </h2> L'erreur s'affiche grâce au gabarit-->
    <?//=@$_SESSION['erreur'];?>
  </header>
</article>
<hr/>

<?php 
  $contenu = ob_get_clean();
  require 'gabarit_visiteur.php';
?>  
      
      
      