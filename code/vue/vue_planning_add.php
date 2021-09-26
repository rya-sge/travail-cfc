<?php
  $titre ='MesActivites - Ajouter un planning';

// vue_planning_add.php
// Date de création : 10/05/2017
// Auteur : RSA
// Fonction : vue pour ajouter un planning.
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();

?>
<h2>Gestionnaire de planning</h2>

  
<article>
</br>
  <fieldset>
	<legend>Créer un planning</legend>
  <form class='form' method='POST' action="index.php?action=vue_planning_add">
	<div class="form-group">
		<label>Nom*</label>
        <input class="form-control" type="text" placeholder="Entrez le nom du planning" name="fNomPlanning" value="<?=@$_POST['fNomPlanning'] ?>" required/>
	</div>
	<div class="form-group">
		<label>Description</label>
        <input class="form-control" type="text" placeholder="Entrez sa description" name="fDescriptPlanning" value="<?=@$_POST['fDescriptPlanning'] ?>"/>
	</div>
	<button type="submit" class="btn btn-primary" name="fAddPlanning">Créer le planning</button>
	<button type="reset" class="btn btn-primary">Effacer</button>
	<a href='index.php?action=vue_planning_gestion'> 
					<button type='button' class='btn btn-primary'  >Revenir à la gestion des plannings</button> </a>
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
      
      
      