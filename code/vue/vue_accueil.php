<?php
  $titre ='MesActivités - Accueil';

// vue_accueil.php
// Date de création : 02/05/17
// Auteur : RSA
// Fonction : vue pour l'affichage page d'accueil
// _______________________________

// Tampon de flux stocké en mémoire
ob_start();
?>

<article>
  <h1>Nos activités</h1>
<div class="cadre">
		<p>
           Bonjour ! Vous êtes connecté en tant que <?php echo $_SESSION['login']; ?>. Sur cette activité vous avez le rôle de <?php echo $_SESSION['nomRole']; ?>
		</p>
	</div>
</div>	
  
  </article>
  <?php
    $contenu = ob_get_clean();
    require "gabarit.php";