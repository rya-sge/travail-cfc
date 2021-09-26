<?php
  $titre ='MesActivites-gestion des activités';

// vue_activite_gestion.php
// Date de création : 03/05/17
// Auteur : RSA
// Fonction : vue pour afficher la liste des activités d'un utilisateur
// _______________________________

// Tampon de flux stocké en mémoire
ob_start();
?>
<article>
  <h1>Mes Activités</h1>
 
 
    <br />
	<div class="row">
	 <div border-width="2px" border-style="solid" width="100px" height="100px">
		<div class="col-lg-12">
			<p>
				 
			Bonjour <?php echo $_SESSION['login']; ?>. Sur cette page, vous pouvez ouvrir l'une de vos activités en cours ou en créer une.
  
				<form method="post" action="index.php?action=vue_accueil">
				<?php 
				//Affiche la liste des projets dans un boutton 
				foreach ($resultats as $resultat) 
					{
						echo '<INPUT TYPE="submit" class="btn btn-primary btn-round-lg btn-lg" NAME="fNomAct" VALUE="'.$resultat['nomAct'].'">';
					}		
				?>
				<!--Boutton renvoyant vers la page de création d'activité -->
<a href="index.php?action=vue_activite_add" target="_blank"> <button type="button" class="btn btn-primary btn-round-lg btn-lg" style="background-color:#000080" ><strong>Créer une activité</strong></button> </a> <!-- http://stylescss.free.fr/couleurs.php -->			
				</form>
			
			</p>

		</div>
    </div>
</div>
 </article>
  <?php
    $contenu = ob_get_clean();
    require "gabarit_visiteur.php";
?>