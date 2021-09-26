<?php
  $titre ='MesActivités - Gérer les listes de matériel';

// vue_materiel_gestion.php
// Date de création : 16/05/2017
// Auteur : RSA
// Fonction : vue pour gérer les listes dans leur ensemble
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();

?>
<h2>Gestionnaire des listes de matériel <a href='index.php?action=vue_materiel_add'> <button type='button' class='btn btn-primary'  ><strong>Ajouter une liste de matériel</strong></button> </a> </h2>

	<p class="textModif"><?php
	if(isset($_SESSION['modif']))
	{
		echo $_SESSION['modif'];
		echo $_SESSION['modif']="";
	}?>
	</p>
  
<article>
<div class="row">
	<div class="col-lg-8"> <!--https://www.w3schools.com/bootstrap/bootstrap_tables.asp  -->
	<table class="table table-bordered">
	<tr>
		<th>Nom de la liste</th>
		<th>Description</th>
		<th>Date de création</th>
		<th>Action</th>		
	</tr>
	<?php
	//Affiche la liste des comptes avec leur catégorie
	foreach ($resultats as $resultat) 
					{
						?>
							<tr>
								<td width="20%"><?php echo $resultat['nomListeMat'];?></td>
								<td width="33%"><?php echo $resultat['descriptListeMat'];?></td>
								<td width="33%"><?php echo $resultat['dateCreation'];?></td>
								<td width="33%">
									<a href="index.php?action=vue_materiel_upd&qIdListeMateriel=<?=$resultat['idListeMateriel']; ?>"><button class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-pencil"></span></button></a>
									<a href="index.php?action=vue_materiel_del&qIdListeMateriel=<?=$resultat['idListeMateriel']; ?>" onclick="return confirm('Etes-vous sûr de vouloir supprimer cette liste ?');"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>
								</td>
							</tr>
					<?php }
	?>
	</table>
</div>
 </article>
<hr/>
<?php 
  $contenu = ob_get_clean();
  require 'gabarit.php';
?>  
      
      
      