<?php
  $titre ='MesActivites - Gestion des plannings';

// vue_planning_gestion.php
// Date de création : 11/05/2017
// Auteur : RSA
// Fonction : vue pour gérer les plannings dans leur ensemble.
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();

?>
<h2>Liste des plannings <a href='index.php?action=vue_planning_add'> <button type='button' class='btn btn-primary'  ><strong>Ajouter un planning</strong></button> </a> </h2>

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
		<th>Nom du planning</th>
		<th>Description</th>
		<th>date de création</th>
		<th>Action</th>		
	</tr>
	<?php
	//Affiche la liste des comptes avec leur catégorie
	foreach ($resultats as $resultat) 
					{
						?>
							<tr>
								<td width="20%"><?php echo $resultat['nomPlanning'];?></td>
								<td width="20%"><?php echo $resultat['descriptPlanning'];?></td>
								<td width="20%"><?php echo $resultat['dateCreation'];?></td>
								<td width="20%">

									<a href="index.php?action=vue_planning_upd&qIdPlanning=<?=$resultat['idPlanning']; ?>"><button class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-pencil"></span></button></a>
									<a href="index.php?action=vue_planning_del&qIdPlanning=<?=$resultat['idPlanning']; ?>" onclick="return confirm('Etes-vous sûr de vouloir supprimer ce planning ? Tous les horaires/lignes qui y sont associés seront également supprimés.');"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete"  ><span class="glyphicon glyphicon-trash"></span></button>	
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
      
      
      