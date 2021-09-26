<?php
  $titre ='MesActivités-Modifier une ligne du planning';

// vue_compte.php
// Date de création : 12/05/2017
// Auteur : RSA
// Fonction : vue pour modifier une ligne du planning.
// _______________________________

// Tampon de flux stocké en mémoire
ob_start();
?>
<h2>Votre planning</h2>
<article>
	<div class="row">
		<div class="col-lg-8"> 
			<form class="form" method="POST" action="index.php?action=vue_planning_ligne_upd&qIdLignePlanning=<?=$infoLignePlanning['idLignePlanning']; ?>">
				<div class="form-group">
					<label>Horaire*</label>
					<input class="form-control" type="text" name="fNHoraire" value="<?=$infoLignePlanning['horaire'];?>"/>
				</div>  
				<div class="form-group">
					<label>Description</label>
					<input class="form-control" type="text" name="fNDescriptLignePlanning" value="<?=$infoLignePlanning['descriptLignePlanning'];?>"/>
				</div> 
				<div class="form-group">
					<label>Terrain</label>
					<input class="form-control" type="text" name="fNTerrain" value="<?=$infoLignePlanning['terrain'];?>"/>
				</div> 
				<div class="form-group">  
					<label>Responsable</label>
					<input  class="form-control" type="text" name="fNResponsable" value="<?= $infoLignePlanning['responsable']; ?>"/>
				</div>
				<div>  
					<input class="btn btn-primary" name="fUpdLignePlanning2" type="submit" value="Enregistrer les modifications" />
					<input type="reset" class="btn btn-primary" value="effacer"/>
					<a href='index.php?action=vue_planning_ligne'> 
					<button type='button' class='btn btn-primary'  >Revenir au planning</button> </a>
				</div>
			</form>
		</div>
	</div>
</article>
  <?php
  
    $contenu = ob_get_clean();
    require "gabarit.php";
?>