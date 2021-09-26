<?php
  $titre ='MesActivités-modifier un planning';

// vue_planning_upd.php
// Date de création : 12/05/2017
// Auteur : RSA
// Fonction : vue pour modifier un planning.
// _______________________________

// Tampon de flux stocké en mémoire
ob_start();
?>
<h2>Votre planning</h2>
<article>
	<div class="row">
		<div class="col-lg-8"> 
			<form class="form" method="POST" action="index.php?action=vue_planning_upd&qIdPlanning=<?=$infoPlanning['idPlanning']; ?>">
				<div class="form-group">
					<label>Nom du planning*</label>
					<input class="form-control" type="text" name="fNNomPlanning" value="<?=$infoPlanning['nomPlanning'];?>" required/>
				</div>  
				<div class="form-group">  
					<label>Description du planning </label>
					<input  class="form-control" type="text" name="fNDescriptPlanning" value="<?= $infoPlanning['descriptPlanning']; ?>"/>
				</div>
				<div>  
					<input class="btn btn-primary" name="fUpdPlanning2" type="submit" value="Enregistrer les modifications" />
					<input type="reset" class="btn btn-primary" value="effacer"/>
					<a href='index.php?action=vue_planning_gestion'> 
					<button type='button' class='btn btn-primary'  >Revenir à la gestion des plannings</button> </a>
				</div>
			</form>
		</div>
	</div>
</article>
  <?php
  
    $contenu = ob_get_clean();
    require "gabarit.php";
?>