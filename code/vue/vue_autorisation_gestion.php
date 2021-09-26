<?php
  $titre ='MesActivités - Gérer les utilisateurs';

// vue_autorisation_gestion.php
// Date de création : 18/05/2017
// Auteur : RSA
// Fonction : vue pour gérer les droits des utilisateurs de l'activité
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();

?>
<h2>Liste des utilisateurs <a href='index.php?action=vue_autorisation_add'> <button type='button' class='btn btn-primary'  ><strong>Ajouter un utilisateur</strong></button> </a> </h2>

	<p class="textModif"><?php
	if(isset($_SESSION['modif']))
	{
		echo $_SESSION['modif'];
		echo $_SESSION['modif']="";
	}?>
	</p>
  
<article>
<div class="row">
	<div class="col-lg-8"> 
	<table class="table table-bordered">
	<tr>
		<th>Login de l'utilisateur</th>
		<th>Role</th>
		<th>Action</th>		
	</tr>
	<?php
	//Affiche la liste des comptes avec leur catégorie
	foreach ($resultats as $resultat) 
					{
						?>
							<tr>
								<td width="20%"><?php echo $resultat['login'];?></td>
								<td width="33%"><?php echo $resultat['nomRole'];?></td>
								<?php 								
								if ($resultat['idRole']==1 AND $resultat['login']==$_SESSION['login'])
								{
									
								}
								else 
									if ($resultat['idRole']==2 AND testR2B()==true )
									{
									}
									else
									{?>
								<td width="33%">
									<a href="index.php?action=vue_autorisation_upd&qIdUser=<?=$resultat['idUser']; ?>"><button class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-pencil"></span></button></a>
									<a href="index.php?action=vue_autorisation_del&qIdUser=<?=$resultat['idUser']; ?>" onclick="return confirm('Etes-vous sûr de vouloir supprimer l\'autorisation de cet utilisateur ?');"><button class="btn btn-danger btn-xs" ><span class="glyphicon glyphicon-trash"></span></button></a>
								</td> 
							</tr>
							<?php }
					}
	?>
	</table>
	<h2>Liste des rôles </h2>
	Chaque rôle possède également les droits du/des rôles qui le suit. Par exemple, un utilisateur ayant le rôle de super-staff aura également tous les droits détenus par le staff.
	<h3>1.Super-admin</h3>
	<ul>
  <li>Nommer et supprimer des super-admin et des admins</li>
  <li>Supprimer l'activité</li>
	</ul>
	<h3>2.Admin</h3>
	<ul>
  <li>Ajouter/supprimer des super-staff/staffs</li>
  <li>Modifier l'activité</li>
	</ul>
	<h3>3.Super-staff</h3>
	<ul>
  <li>Ajouter/supprimer/modifier un planning</li>
  <li>Ajouter/supprimer/ un lieu</li>
  <li>Ajouter/supprimer/modifier une liste de matériel</li>
  <li>Ajouter/supprimer un participants</li>
  <li>Supprimer des documents</li>
	</ul>
	<h3>4.Staff</h3>
	<ul>
  <li>Modifier des lieux</li>
  <li>Ajouter et modifier un document</li>
  <li>Modifier un participant</li>
  <li>Ajouter/modifier et supprimer une ligne d'un planning</li>
  <li>Ajouter/modifier et supprimer une ligne de matériel</li>
	</ul>
</div>
 </article>
<hr/>
<?php 
  $contenu = ob_get_clean();
  require 'gabarit.php';
?>  
      
      
      