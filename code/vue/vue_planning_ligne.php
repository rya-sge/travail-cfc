<?php
  $titre ='MesActivités-Gestion du planning';

// vue_planning_ligne.php
// Date de création : 12/05/2017
// Auteur : RSA
// Fonction : vue pour gérer un planning précis
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();
?>
<h2>Planning</h2>

  
<article>
</br>
<div id="planning">
<legend>Selectionner un planning</legend>
  
    <form class='form' method='POST' action="index.php?action=vue_planning_ligne">
		<div class="form-group">
			<label for="planning">Selectionner un planning :</label>
			<select class="form-control" name="fSPlanning">
				<?php
				//Affiche la liste des journaux
					foreach ($resultats as $resultat) 
					{
						echo "<option value='".$resultat['nomPlanning']."'>".$resultat['nomPlanning']."</option>";
					}
					?>
			</select>		
			</br>	
			<button type="submit" class="btn btn-primary" name="fBPlanning">Afficher les lignes</button>
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
	
<?php if(isset($_SESSION['nomPlanning']))
	{
		//Affiche les erreurs généréres lors de l'ajout d'une ligne
		//ligne =0 il n'y a pas d'erreur
		//Ligne=1 : il y a une erreur qui doit être affichée
		//Ligne=3 : l'erreur a été affichée
		if(isset($_SESSION['ligne']) AND $_SESSION['ligne']==1)
		{
				?><h2> Erreur </h2>
				 <?=@$_SESSION['erreur'];?>		
		<?php  if(isset($_SESSION['erreur']))
				 {
					  $_SESSION['erreur']="";
				 }
				 $_SESSION['ligne']=3; }
		?>
		<?php echo 	"<h2>Votre planning actuel : ".$_SESSION['nomPlanning'];?></h2>
	 
	<div>
		<table class=" table table-bordered">
			<thead>
				<tr>
					<th>Horaire*</th>
					<th>Description</th>
					<th>Terrain</th>
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
							<td><?= $col['horaire']; ?></td>
							<td><?= $col['descriptLignePlanning']; ?></td>
							<td><?= $col['terrain']; ?></td>
							<td><?= $col['responsable']; ?></td>
							<td>
								<a href="index.php?action=vue_planning_ligne_upd&qIdLignePlanning=<?=$col['idLignePlanning']; ?>"><button class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-pencil"></span></button></a>
								<a href="index.php?action=vue_planning_ligne_del&qIdLignePlanning=<?=$col['idLignePlanning']; ?>" onclick="return confirm('Etes-vous sûr de vouloir supprimer cette ligne');"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>
							</td>
						</tr>
					<?php 
					}  ?>		
					<tr>
					<form class='form' method='POST' action="index.php?action=vue_planning_ligne">
						<td><input type="text" name="fHoraire" required /></td>
						<td><input type="text" name="fDescriptLignePlanning" /></td>
						<td><input type="text" name="fTerrain" /></td>
						<td><input type="text" name="fResponsable" /></td>
						<td><button type="submit" class="btn btn-primary" name="fAddLignePlanning">Ajouter</button>
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
      
      
      