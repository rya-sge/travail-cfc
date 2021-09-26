<?php
  $titre ='MesActivités - Logout';

// vue_logout.php
// Date de création : 09/05/2017
// Auteur : RSA
// Fonction : vue pour se déconnecter du site
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();
?>
<h1 style="text-align:center">Déconnexion</h1>

<article>
  Vous avez été déconnecté(e).
</article>
<hr/>
<?php 
  $contenu = ob_get_clean();
  require 'gabarit_visiteur.php';
?>  
      
      
      