<?php
  $titre ='MesActivités-Créer une activité';

// vue_activite_add.php
// Date de création : 03/05/2017
// Auteur : RSA
// Fonction : vue pour la création d'une activité
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();
?>
<h2>Créer une activité</h2>
<article>
  
  <form class='form' method='POST' action="index.php?action=vue_activite_add">
	<div class="form-group">
		<label>Nom de l'activité*</label>
        <input class="form-control" type="text" placeholder="Entrez le nom de l'activité" name="fNomAct" value="<?=@$_POST['fNomProj'] ?>" required/>
		</br>
		<label>Description</label>
        <input class="form-control" type="text" placeholder="Entrez l'adresse email de l'activité" name="fDescriptAct" value="<?=@$_POST['fDescriptAct'] ?>" />
		</br>
		<button type="submit" class="btn btn-primary" name="fConnexion">Créer l'activité</button>
		<button type="reset" class="btn btn-primary">Effacer</button>
    </div>
  </form> 
</article>
<hr/>
<?php 
  $contenu = ob_get_clean();
  require 'gabarit_visiteur.php';
?>  
      
      
      