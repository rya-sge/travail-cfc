<?php
  $titre ='Compta-Pratique-compte';

// vue_compte.php
// Date de création : 07/03/2017
// Auteur : RSA
// Fonction : vue pour afficher la liste des comptes avec leur catégorie.
// _______________________________

// Tampon de flux stocké en mémoire
ob_start();
?>
<h2>Votre liste</h2>
<article>
	<div class="row">
		<div class="col-lg-8"> 
			<form class="form" method="POST" action="index.php?action=vue_materiel_upd&qIdListeMateriel=<?=$infoListeMat['idListeMateriel']; ?>">
				<div class="form-group">
					<label>Nom de la liste*</label>
					<input class="form-control" type="text" name="fNNomListeMat" value="<?=$infoListeMat['nomListeMat'];?>"/>
				</div>  
				<div class="form-group">  
					<label>Description de la liste </label>
					<input  class="form-control" type="text" name="fNDescriptListeMat" value="<?= $infoListeMat['descriptListeMat']; ?>"/>
				</div>
				<div>  
					<input class="btn btn-primary" name="fUpdListeMat2" type="submit" value="Enregistrer les modifications" />
					<input type="reset" class="btn btn-primary" value="effacer"/>
				</div>
			</form>
		</div>
	</div>
</article>
  <?php
  
    $contenu = ob_get_clean();
    require "gabarit.php";
?>