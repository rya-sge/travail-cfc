<?php
  $titre ='MesActivités-Modifier une ligne du planning';

// vue_materiel_ligne_upd.php
// Date de création : 12/05/2017
// Auteur : RSA
// Fonction : vue pour modifier une ligne du planning
// _______________________________

// Tampon de flux stocké en mémoire
ob_start();
?>
<h2>Votre materiel</h2>
<article>
	<div class="row">
		<div class="col-lg-8"> 
			<form class="form" method="POST" action="index.php?action=vue_materiel_ligne_upd&qIdLigneMateriel=<?=$infoLigneMat['idLigneMateriel']; ?>">
				<div class="form-group">
					<label>Nom</label>
					<input class="form-control" type="text" name="fNNomMat" value="<?=$infoLigneMat['nomMat'];?>"/>
				</div>  
				<div class="form-group">
					<label>Description</label>
					<input class="form-control" type="text" name="fNDescriptMat" value="<?=$infoLigneMat['descriptMat'];?>"/>
				</div> 
				<div class="form-group">
					<label>Quantité</label>
					<input class="form-control" type="text" name="fNQuantite" value="<?=$infoLigneMat['quantite'];?>"/>
				</div> 
				<div class="form-group">  
					<label>Responsables</label>
					<input  class="form-control" type="text" name="fNResponsable" value="<?= $infoLigneMat['responsable']; ?>"/>
				</div>
				<div>  
					<input class="btn btn-primary" name="fUpdLigneMat2" type="submit" value="Enregistrer les modifications" />
					<input type="reset" class="btn btn-primary" value="effacer"/>
					<a href='index.php?action=vue_materiel_ligne'> 
					<button type='button' class='btn btn-primary'  >Revenir à la liste de matériel</button> </a>
				</div>
			</form>
		</div>
	</div>
</article>
  <?php
  
    $contenu = ob_get_clean();
    require "gabarit.php";
?>