<?php
  $titre ='MesActivites - Ajouter un document';

// vue_document_add.php
// Date de création : 01/06/2017
// Auteur : RSA
// Fonction : vue pour ajouter un document
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();

?>
<h2>Gestionnaire de planning</h2>

  
<article>
</br>
  <fieldset>
	<legend>Ajouter un document</legend>
  <form class='form' method='POST' action="index.php?action=vue_document_add" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nom*</label>
        <input class="form-control" type="text" placeholder="Entrez le nom du document" name="fNomDoc" value="<?=@$_POST['fNomDoc'] ?>" required/>
	</div>
	<div class="form-group">
		<label>Description</label>
        <input class="form-control" type="text" placeholder="Entrez sa description" name="fDescriptDoc" value="<?=@$_POST['fDescriptDoc'] ?>"/>
	</div>
	<div class="form-group">
		<label>Selectionner votre fichier* </label>
		(extension autorisée : .png,.PNG, .gif, .jpg,.jpeg,.pdf,.docx,.doc,.xls,.dot,.mwb,.vsd,.mpp
		<input type="hidden" name="MAX_FILE_SIZE" value="1000000000">
        <input  type="file" placeholder="Entrez sa description" name="fFilename" value="<?=@$_POST['fFilename'] ?>"/>
	</div>
	<button type="submit" class="btn btn-primary" name="fAddDoc">Ajouter le document</button>
	<button type="reset" class="btn btn-primary">Effacer</button>
	<a href='index.php?action=vue_document_gestion'> 
					<button type='button' class='btn btn-primary'  >Revenir à la gestion des documents</button> </a>
  </form>
</fieldset>
</br>
<fieldset>
 
</div> 
</article>
<hr/>
<?php 
  $contenu = ob_get_clean();
  require 'gabarit.php';
?>  
      
      
      