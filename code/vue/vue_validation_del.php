<?php
  $titre ='MesActivités - suppression de compte';

// vue_validation_del.php
// Date de création : 26.08/2018
// Auteur : RSA
// Fonction : vue pour confirmer la suppression de compte
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();
?>
<?$_SESSION['error']="";?>
<h1 style="text-align:center">Suppression de compte</h1>

<article>
 <p>
	Votre compte a été supprimé.
</p> 
 
</article>
<hr/>
<?php 
  $contenu = ob_get_clean();
  require 'gabarit_visiteur.php';
?>  
      
      
      