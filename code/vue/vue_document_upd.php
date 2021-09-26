<?php
  $titre ='MesActivités-modifier un document';

// vue_document_upd.php
// Date de création : 01/06/2017
// Auteur : RSA
// Fonction : vue pour modifier un document
// _______________________________

// Tampon de flux stocké en mémoire
ob_start();
?>
<h2>Votre document</h2>
<article>
	<div class="row">
		<div class="col-lg-8"> 
			<form class="form" method="POST" action="index.php?action=vue_document_upd&qIdDocument=<?=$infoDoc['idDocument']; ?>">
				<div class="form-group">
					<label>Nom du document</label>
					<input class="form-control" type="text" name="fNNomDoc" value="<?=$infoDoc['nomDoc'];?>"/>
				</div>  
				<div class="form-group">  
					<label>Description  </label>
					<input  class="form-control" type="text" name="fNDescriptDoc" value="<?= $infoDoc['descriptDoc']; ?>"/>
				</div>
				<div>  
					<input class="btn btn-primary" name="fUpdDoc2" type="submit" value="Enregistrer les modifications" />
					<input type="reset" class="btn btn-primary" value="effacer"/>
					<a href='index.php?action=vue_document_gestion'> 
					<button type='button' class='btn btn-primary'  >Revenir à la gestion des documents</button> </a>
				</div>
			</form>
		</div>
	</div>
</article>
  <?php
  
    $contenu = ob_get_clean();
    require "gabarit.php";
?>