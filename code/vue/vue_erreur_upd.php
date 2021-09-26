<?php
  $titre ='MesActivités - erreur';

// vue_erreur.php
// Date de création : 04/05/17
// Auteur : RSA
// Fonction : vue pour l'affichage des erreurs pour les upd
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();
?>

<article>
  <header>
    <h2> Erreur </h2>
    <!--<p>L'action demandée est inconnue !</p>-->
    <?=@$_SESSION['erreur'];?>
  </header>
</article>
<hr/>

<?php 
  $contenu = ob_get_clean();
  //require 'gabarit.php';
?>  
      
      
      