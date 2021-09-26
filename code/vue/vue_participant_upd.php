<?php
  $titre ='MesActivités - Modifier un participant';

// vue_activite.php
// Date de création : 17/05/2017
// Auteur : RSA
// Fonction : vue pour modifier un participant.
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();
?>
<h2>Votre participant</h2>
 
</br>
  <article>
  <div class="row">
	<div class="col-lg-8"> 
	<form class="form" method="POST" action="index.php?action=vue_participant_upd&qIdParticipant=<?=$infoPart['idParticipant']; ?>">
		<div class="form-group"> 
			<label>Nom*</label>
			<input class="form-control" type="text" name="fNNomPart" value="<?=$infoPart['nomPart'];?>"/>
		</div> 
		<div class="form-group"> 
			<label>Prénom*</label>
			<input class="form-control" type="text" name="fNPrenomPart" value="<?=$infoPart['prenomPart'];?>"/>
		</div>
		<div class="form-group"> 
			<label>Date de naissance</label>
			<input class="form-control" type="text" name="fNDateNaissance" value="<?=$infoPart['dateNaissance'];?>"/>
		</div>
		<div> 
        <label>Genre*</label>
		</br>
					<input class="radio-inline" type="radio" name="fNGenre" value="Feminin" id="feminin" <?php if($infoPart['genre']=="Feminin") { ?>  checked="checked" <?php } ?>  /> <label for="feminin">Féminin</label><br />
					<input class="radio-inline" type="radio" name="fNGenre" value="Masculin" id="masculin" <?php if($infoPart['genre']=="Masculin") { ?>  checked="checked" <?php } ?> /> <label for="masculin">Masculin</label><br />
					<input class="radio-inline" type="radio" name="fNGenre" value="Autres" id="autres"<?php if($infoPart['genre']=="Autres") { ?>  checked="checked" <?php } ?>  />  <label for="autres">Autres</label><br />	
		</div>
		<div class="form-group"> 
			<label>Fonction</label>
			<input class="form-control" type="text" name="fNFonction" value="<?=$infoPart['nomPart'];?>"/>
		</div>
		<div class="form-group"> 
			<label>NPA</label>
			<input class="form-control" type="text" name="fNNPA" value="<?=$infoPart['NPA'];?>"/>
		</div>
		<div class="form-group"> 
			<label>Adresse</label>
			<input class="form-control" type="text" name="fNLocalite" value="<?=$infoPart['localite'];?>"/>
		</div>
		<div class="form-group"> 
			<label>Email</label>
			<input class="form-control" type="email" name="fNEmail" value="<?=$infoPart['email'];?>"/>
		</div>
		<div class="form-group"> 
			<label>Téléphone</label>
			<input class="form-control" type="text" name="fNTelephone" value="<?=$infoPart['telephone'];?>"/>
		</div>
		<div class="form-group"> 
			<label>Equipe</label>
			<input class="form-control" type="text" name="fNEquipe" value="<?=$infoPart['equipe'];?>" />
		</div>
		<div class="form-group"> 
			<label>Remarques</label>
			<input class="form-control" type="text" name="fNRemarque" value="<?=$infoPart['remarque'];?>"/>
		</div>
        <input class="btn btn-primary" name="fUpdPart2" type="submit" value="Enregistrer les modifications" />
		<input type="reset" class="btn btn-primary" value="effacer"/>
      </div>
	  </form>
	</div>
	</div>
</article>
<hr/>
<?php 
  $contenu = ob_get_clean();
  require 'gabarit.php';
?>  
      
      
      