<?php
  $titre ='MesActivités - Gestion des lieux';

// vue_lieu_gestion.php
// Date de création : 12/05/2017
// Auteur : RSA
// Fonction : vue pour gérer les lieux dans leur ensemble
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();

?>
<h2>Liste des lieux 
<?php if (testR3()==true)
{?>
	<a href='index.php?action=vue_lieu_add'>
		<button type='button' class='btn btn-primary'  ><strong>Ajouter un lieu</strong></button>
	</a> 
<?php }?>
</h2>
<article>
<div class="row">
	<div class="col-lg-8">
	<p class="textModif"><?php
	if(isset($_SESSION['modif']))
	{
		echo $_SESSION['modif'];
		echo $_SESSION['modif']="";
	}?>	
	<table class="table table-bordered">
	<tr>
		<th>Nom du Lieu</th>
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
								<td width="20%"><?php echo $resultat['nomLieu'];?></td>
								<td width="33%"><?php echo $resultat['descriptLieu'];?></td>
								<td width="33%"><?php echo $resultat['dateCreation'];?></td>
								<td width="33%">
									<a href="index.php?action=vue_lieu&qIdLieu=<?=$resultat['idLieu']; ?>"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
									<?php if (testR3()==true)
										{?>
											<a href="index.php?action=vue_lieu_del&qIdLieu=<?=$resultat['idLieu']; ?>" onclick="return confirm('Etes-vous sûr de vouloir supprimer ce lieu ?');"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete"  ><span class="glyphicon glyphicon-trash"></span></button></a>	
										<?php } ?>
								</td> <!--https://www.w3schools.com/bootstrap/tryit.asp?filename=trybs_ref_glyph_edit&stacked=h --></td>
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
      
      
      