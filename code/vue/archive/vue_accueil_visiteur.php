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
<div class="pull-right"  >
		<p>
		Outil en ligne collaboratif, Que ce soit une excursion, un week-end ou un mariage, MesActivites.fr vous permet de préparer et planifier vos activités.              
		</p>
	</div>
</div>	
  
  </article>
  <?php
    $contenu = ob_get_clean();
    require "gabarit.php";