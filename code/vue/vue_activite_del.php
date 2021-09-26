<?php
  $titre ='MesActivités - Supprimer une activité';

// vue_activite_del.php
// Date de création : 10/05/2017
// Auteur : RSA
// Fonction : vue pour supprimer une activité
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();
?>
<h1 style="text-align:center">Suppresion d'activité</h1>

<article>
  <p>L'activité a bien été supprimé.</p>
  <p><a href='index.php?action=vue_activite_gestion'> 
					<button type='button' class='btn btn-primary'  >Aller à la gestion de vos activités</button> </a>
	</p>
</article>
<hr/>
<?php 
  $contenu = ob_get_clean();
  require 'gabarit_visiteur.php';
?>  
      
      
      