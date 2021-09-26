<?php
  $titre ='MesActivites - Gestion des documents';

// vue_document_gestion.php
// Date de création : 01/06/2017
// Auteur : RSA
// Fonction : vue pour gérer les documents dans leur ensemble
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();

?>
<h2>Liste des documents <a href='index.php?action=vue_document_add'> <button type='button' class='btn btn-primary'  ><strong>Ajouter un document</strong></button> </a> </h2>
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
		<th>Nom du document</th>
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
								<td width="20%"><?php echo $resultat['nomDoc'];?></td>
								<td width="20%"><?php echo $resultat['descriptDoc'];?></td>
								<td width="20%"><?php echo $resultat['dateCreation'];?></td>
								<td width="20%">
									<a href="index.php?action=vue_document_open&qFilename=<?=$resultat['filename']?>"><button class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-download-alt"></span></button></a>
									<a href="index.php?action=vue_document_upd&qIdDocument=<?=$resultat['idDocument']; ?>"><button class="btn btn-primary btn-xs"  ><span class="glyphicon glyphicon-pencil"></span></button></a>
									<?php 
									if (testR3()==true):
									?>
										<a href="index.php?action=vue_document_del&qIdDocument=<?=$resultat['idDocument']; ?>" onclick="return confirm('Etes vous sur de vouloir supprimer ce document ?');"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete"  ><span class="glyphicon glyphicon-trash"></span></button>
									<?php endif;?>
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
      
      
      