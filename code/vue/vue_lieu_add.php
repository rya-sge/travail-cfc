<?php
  $titre ='MesActivités - Ajouter un lieu';

// vue_lieu_add.php
// Date de création : 12/05/2017
// Auteur : RSA
// Fonction : vue pour ajouter un lieu
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();

?>
<article>
</br>
<div id="profil">
  <fieldset>
	<legend>Créer un lieu</legend>
  <form class='form' method='POST' action="index.php?action=vue_lieu_add">
	<div class="form-group">
		<label>Nom*</label>
        <input class="form-control" type="text" placeholder="Entrez le nom du lieu" name="fNomLieu" value="<?=@$_POST['fNomLieu'] ?>" required/>
		</br>
		<label>Description</label>
        <input class="form-control" type="text" placeholder="Entrez la description du lieu" name="fDescriptLieu" value="<?=@$_POST['fDescriptLieu'] ?>"/>
		</br>
		<label>NPA</label>
        <input class="form-control" type="text" placeholder="Entrez son NPA" name="fNPA" value="<?=@$_POST['fNPA'] ?>"/>
		</br>
		<label>Localité</label>
        <input class="form-control" type="text" placeholder="Entrez sa localité" name="fLocalite" value="<?=@$_POST['fLocalite'] ?>"/>
		</br> 
		<label>Coordonnées</label>
        <input class="form-control" type="text" placeholder="Entrez ses coordonnées" name="fCoordonnee" value="<?=@$_POST['fCoordonnee'] ?>"/>
		</br>
		<label>Url de la carte</label>
        <input class="form-control" type="text" placeholder="Entrez l'url de la carte (exemple : lien geoadmin" name="fCarteUrl" value="<?=@$_POST['fCarteUrl'] ?>"/>
		</br>
		<label>carte intégré</label>(<a href="https://support.google.com/maps/answer/144361?co=GENIE.Platform%3DDesktop&hl=fr" target="_blank">tutoriel intégrer une carte</a>)
        <input class="form-control" type="text" placeholder="Entrez le code d'intégration de la carte google map" name="fCarteEmbed" value="<?=@$_POST['fCarteUrl'] ?>" title="POur avoir le code : google map : sous partager, intégrer la carte, copier le code donné"/>
		</br>
		</br>
		<button type="submit" class="btn btn-primary" name="fAddLieu">Créer le lieu</button>
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
      
      
      