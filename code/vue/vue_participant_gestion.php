<?php
  $titre ='MesActivités-Participants';

// vue_participant_gestion.php
// Date de création : 14/03/2017
// Auteur : RSA
// Fonction : vue pour gérer les participants dans leur ensemble.
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();

?>
<h2>Gestion des participants 
<?php if (testR3()==true)
{?>
<a href='index.php?action=vue_participant_add'> 
<button type='button' class='btn btn-primary'  ><strong>Ajouter un participant</strong></button> </a>
<?php }?>
 </h2>
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
		<th>Nom</th>
		<th>Prénom</th>
		<th>Action</th>		
	</tr>
	<?php
	//Affiche la liste des comptes avec leur catégorie
	foreach ($resultats as $resultat) 
					{
						?>
							<tr>
								<td width="20%"><?php echo $resultat['nomPart'];?></td>
								<td width="33%"><?php echo $resultat['prenomPart'];?></td>
								<td width="33%">
									<a href="index.php?action=vue_participant_upd&qIdParticipant=<?=$resultat['idParticipant']; ?>"><button class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-pencil"></span></button></a>
									<?php if (testR3()==true)
									{?>
									<a href="index.php?action=vue_participant_del&qIdParticipant=<?=$resultat['idParticipant']; ?>" onclick="return confirm('Etes-vous sûr de vouloir supprimer ce participant');"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>
								    <?php } ?>
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
      
      
      