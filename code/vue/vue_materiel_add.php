<?php
  $titre ='MesActivités - Ajouter une liste';

// vue_materiel_add.php
// Date de création : 16/05/2017
// Auteur : RSA
// Fonction : vue pour ajouter une liste de matériel
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();

?> 
<article>
</br>
<div id="profil">
  <fieldset>
	<h2><legend>Créer une liste de matériel</legend></h2>
  <form class='form' method='POST' action="index.php?action=vue_materiel_add">
	<div class="form-group">
		<label>Nom*</label>
        <input class="form-control" type="text" placeholder="Entrez le nom de la liste de matériel" name="fNomListeMat" value="<?=@$_POST['fNomListeMat'] ?>" required/>
		</br>
		<label>Description</label>
        <input class="form-control" type="text" placeholder="Entrez la description" name="fDescriptListeMat" value="<?=@$_POST['fDescriptListeMat'] ?>"/>
		</br>
		</br>
		<button type="submit" class="btn btn-primary" name="fAddListeMat">Créer la liste</button>
		<button type="reset" class="btn btn-primary">Effacer</button>
    </div>
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
      
      
      