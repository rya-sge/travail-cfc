<?php
  $titre ='MesActivités-erreur';

// vue_erreur_visiteur2.php
// Date de création : 09/03/16
// Auteur : RSA
// Fonction : vue pour l'affichage des erreurs si l'utilisateur n'a pas ouvert de projet. 
//A la différence de vue_erreur que le gabarit utilisé ne contient pas de bouton.
//Utilisé pour les erreurs qui affichent une autre page juste en-dessous __________________________________________

// Tampon de flux stocké en mémoire
ob_start();
?>

<article>
  <header>
    <h2> Erreur </h2>
    <?=@$_SESSION['erreur'];?>
  </header>
</article>
<hr/>

<?php 
  //$contenu = ob_get_clean();
  //require 'gabarit_erreur_visiteur.php';
?>  
      
      
      