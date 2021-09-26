<?php
  $titre ='Mise à jour de lieu';

// vue_lieu_upd.php
// Date de création : 16/05/2017
// Auteur : RSA
// Fonction : vue pour modifier un lieu.
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();
?>
<h2>Votre lieu</h2>
 
</br>
  <article>
  <div class="row">
	<div class="col-lg-8"> 
	<form class="form" method="POST" action="index.php?action=vue_lieu_upd&qIdLieu=<?=$infoLieu['idLieu']; ?>">
		<div class="form-group">
			<label>Nom du lieu*</label>
			<input type="text" name="fNNomLieu" value="<?=$infoLieu['nomLieu'];?> " class="form-control"/>
		</div>  
		<div class="form-group">  
			<label>Description du lieu </label>
			<input type="text" name="fNDescriptLieu" value="<?= $infoLieu['descriptLieu']; ?>"class="form-control"/>
		</div>
		<div class="form-group">  
			<label>NPA</label>
			<input type="text" name="fNNPA" value="<?= $infoLieu['NPA']; ?>"class="form-control"/>
		</div>
		<div class="form-group">  
			<label>Localité</label>
			<input type="text" name="fNLocalite" value="<?= $infoLieu['localite']; ?>"class="form-control"/>
		</div>
		<div class="form-group">  
			<label>Coordonnees</label>
			<input type="text" name="fNCoordonnee" value="<?= $infoLieu['coordonnee']; ?>"class="form-control"/>
		</div>
		<div class="form-group">  
			<label>Carte Url </label>
			<textarea type="text" name="fNCarteUrl" class="form-control" ><?= $infoLieu['carteUrl']; ?></textarea>
		</div>
		<div class="form-group">
			<label>Changer la carte intégrée</label>
			<textarea class="form-control" type="text" name="fNCarteEmbed" class="form-control"><?php echo "<iframe".$infoLieu['carteEmbed']."></iframe>";?></textarea>
		</div>
		<?php if ($infoLieu['carteEmbed']!="")
		{ ?>
			<div class="form-group">
				<label>Carte actuelle</label>
				<iframe <?= $infoLieu['carteEmbed']; ?>></iframe>
			</div>
		<?php } ?>
		
		<div class="form-group">  
			<input class="btn btn-primary" name="fUpdLieu2" type="submit" value="Enregistrer les modifications" />
			<input type="reset" class="btn btn-primary" value="effacer"/>
			<a href='index.php?action=vue_lieu_gestion'> 
					<button type='button' class='btn btn-primary'  >Revenir à la liste de lieux</button> </a>
		</div>
	  </form>
    </table>
    
	</div>
	</div>
</article>
<hr/>
<?php 
  $contenu = ob_get_clean();
  require 'gabarit.php';
?>  
      
      
      