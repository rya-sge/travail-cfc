<?php
  $titre ='MesActivités-Ajouter un participant';

// vue_participant_add.php
// Date de création : 17/05/2017
// Auteur : RSA
// Fonction : vue pour ajouter un participant.
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();

?>
<article>
</br>
<div id="profil">
  
	<h2>Ajouter un participant</h2>
	<form class='form' method='POST' action="index.php?action=vue_participant_add">
		<fieldset>
		<legend>Identité</legend>
			<div class="form-group">
				<label>Prénom*</label>
				<input class="form-control" type="text" placeholder="Roger" name="fPrenomPart" value="<?=@$_POST['fPrenom'] ?>" required/>
			</div>
			<div class="form-group">
				<label>Nom*</label>
				<input class="form-control" type="text" placeholder="Entrez le nom" name="fNomPart" value="<?=@$_POST['fNomPart'] ?>" required/>
			</div>
			<div>
			<label>Genre*</label>
			</br>
				<input class="radio-inline" type="radio" name="fGenre" value="Feminin" id="feminin" required /> <label for="feminin">Féminin</label>
				<input class="radio-inline" type="radio" name="fGenre" value="Masculin" id="masculin" required /> <label for="masculin">Masculin</label>
				<input  class="radio-inline" type="radio" name="fGenre" value="Autres" id="autres"required  /> <label for="autres">Autres</label>
			</div>
			<div class="form-group">
				<label>Date de naissance</label>
				<input class="form-control" type="date" placeholder="Entrez la date de naissance" name="fDateNaissance" value="<?=@$_POST['fGenre'] ?>"/>
			</div>
			<div class="form-group">
				<label>Fonction</label>
				<input class="form-control" type="text" placeholder="Entrez la fonction du participant" name="fFonction" value="<?=@$_POST['fFonction'] ?>" />
			</div>
		</fieldset>
		<fieldset>
		<legend>Contact</legend>
			<div class="form-group">
				<label>Code postale(NPA)</label>
				<input class="form-control" type="number" placeholder="1808" name="fNPA" value="<?=@$_POST['fNPA'] ?>"/>
			</div>
			<div class="form-group">
				<label>Localité</label>
				<input class="form-control" type="text" placeholder="Rue des participants 11" name="fLocalite" value="<?=@$_POST['fLocalite'] ?>"/>
			</div>
			<div class="form-group">
				<label>Email</label>
				<input class="form-control" type="email" placeholder="Entrez son adresse email" name="fEmail" value="<?=@$_POST['fEmail'] ?>"/>
			</div>
			<div class="form-group">
				<label>Téléphone(s)</label>
				<input class="form-control" type="texte" placeholder="Entrez son n°de téléphone" name="fTelephone" value="<?=@$_POST['fTelephone'] ?>"/>
			</div>
		</fieldset>
		<fieldset>
		<legend>Divers</legend>
			<div class="form-group">
				<label>Equipe</label>
				<input class="form-control" type="text" placeholder="Entrez son équipe" name="fEquipe" value="<?=@$_POST['fEquipe'] ?>"/>
			</div>
			<div class="form-group">
				<label>Remarques</label>
				<input class="form-control" type="text" placeholder="Entrez une remarques" name="fRemarque" value="<?=@$_POST['fRemarque'] ?>"/>
			</div>
		</fieldset>
		<button type="submit" class="btn btn-primary" name="fAddPart">Créer le participant</button>
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
      
      
      