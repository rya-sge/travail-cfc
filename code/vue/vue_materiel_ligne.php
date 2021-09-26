<?php
  $titre ='MesActivités-matériel';

// vue_materiel_ligne.php
// Date de création : 18/05/2017
// Auteur : RSA
// Fonction : vue qui liste le matériel et qui permet d'en ajouter
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();
?>
<article>
<h2>Matériel</h2>
</br>
<div id="listeMat">
<legend>Selectionner une liste</legend>
  
    <form class='form' method='POST' action="index.php?action=vue_materiel_ligne">
		<div class="form-group">
			<label for="listeMat">Selectionner une liste :</label>
			<select class="form-control" name="fSListeMat">
				<?php
				//Affiche la liste des journaux
					foreach ($resultats as $resultat) 
					{
						echo "<option value='".$resultat['nomListeMat']."'>".$resultat['nomListeMat']."</option>";
					}
					?>
			</select>		
			</br>	
			<button type="submit" class="btn btn-primary" name="fBListeMat">Afficher les lignes</button>
		</div>
	</form>
	</br>
</br>
<p class="textModif"><?php
	if(isset($_SESSION['modif']))
	{
		echo $_SESSION['modif'];
		echo $_SESSION['modif']="";
	}?>
	</p> 
<?php 



if(isset($_SESSION['nomListeMat']))
	{
		//Affiche les erreurs généréres lors de l'ajout d'une ligne
		//ligne = 0 il n'y a pas d'erreur
		//Ligne = 1 : il y a une erreur qui doit être affichée
		//Ligne = 3 : l'erreur a été affichée
		if(isset($_SESSION['ligne']) AND $_SESSION['ligne']==1)
		{
				?><h2> Erreur </h2>
				 <?=@$_SESSION['erreur'];?>
		<?php  if(isset($_SESSION['erreur']))
				 {
					  $_SESSION['erreur']="";
				 }
		$_SESSION['ligne']=3; }?>
		<?php echo 	"<h2>Votre liste actuelle : ".$_SESSION['nomListeMat'];?></h2>
	<div>
		<table class=" table table-bordered">
			<thead>
				<tr>
					<th>Nom*</th>
					<th>Description</th>
					<th>Quantité</th>
					<th>Responsables</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				
					<?php
					//Affiche la liste des opérations existentes du planning selectionné
					foreach($ligne as $col)
					{ ?>
						<tr>
							<td><?= $col['nomMat']; ?></td>
							<td><?= $col['descriptMat']; ?></td>
							<td><?= $col['quantite']; ?></td>
							<td><?= $col['responsable']; ?></td>
							<td>
								<a href="index.php?action=vue_materiel_ligne_upd&qIdLigneMateriel=<?=$col['idLigneMateriel']; ?>"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
								<a href="index.php?action=vue_materiel_ligne_del&qIdLigneMateriel=<?=$col['idLigneMateriel']; ?>" onclick="return confirm('Etes-vous sûr de vouloir supprimer cette ligne');"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>
							</td>
						</tr>
					<?php 
					}  ?>		
					<tr>
						<form class='form' method='POST' action="index.php?action=vue_materiel_ligne">
							<td><input type="text" name="fNomMat" required/></td>
							<td><input type="text" name="fDescriptMat" /></td>
							<td><input type="text" name="fQuantite" /></td>
							<td><input type="text" name="fResponsable" /></td>
							<td><button type="submit" class="btn btn-primary" name="fAddLigneMat">Ajouter</button>
							<button type="reset" class="btn btn-primary">Effacer</button> </td>
					</form>	
				</tr>
					
		</tbody>
	</table>	
    </div>
 </fieldset>
 <?php } ?>
 </br>
</div> 
</article>
<hr/>
<?php 
  $contenu = ob_get_clean();
  require 'gabarit.php';
?>  
      
      
      