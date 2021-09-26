<?php
  $titre ='MesActivites-Lieu';

// vue_lieu.php
// Date de création : 16/05/2017
// Auteur : RSA
// Fonction : vue pour afficher les informations d'un lieu en particulier.
// _______________________________

// Tampon de flux stocké en mémoire
ob_start();
?>

<h2>Votre lieu</h2>
 
<article>
</br>
  <div class="row">
	<div class="col-lg-8"> 
    <p class="textModif"><?php
	if(isset($_SESSION['modif']))
	{
		echo $_SESSION['modif'];
		echo $_SESSION['modif']="";
	}?>
	</p>
    <table class="table">
	<form class="form" method="POST" action="index.php?action=vue_lieu_upd&qIdLieu=<?=$infoLieu['idLieu']; ?>">
		<tr>
			<td>Nom du lieu</td>
			<td><?php echo $infoLieu['nomLieu'];?></td>
		</tr>  
		<tr>  
			<td>Description du lieu </td>
			<td><?php echo $infoLieu['descriptLieu'];?></td>
		</tr>
		<tr>  
			<td>NPA</td>
			<td><?php echo $infoLieu['NPA'];?></td>
		</tr>
		<tr>  
			<td>Localité</td>
			<td><?php echo $infoLieu['localite'];?></td>
		</tr>
		<tr>  
			<td>Coordonnées</td>
			<td><?php echo $infoLieu['coordonnee'];?></td>
		</tr>
		<tr>  
			<td>Url de la carte</td>
			<td>
			<?php 
			//Si aucun lien n'est présent dans la BDD
			if($infoLieu['carteUrl']=="")
			{
				echo "Aucun lien";
			}
			else //SI il y en a un
			{
			?>
				<a href="<?php echo $infoLieu['carteUrl'];?>" target="_blank">Lien</a>
			<?php 
			} ?>
			</td>
		</tr>
		<tr>
			<td>Carte intégrée </td>
			<td>
			<?php
			//Si aucun lien n'est présent dans la BDD
			if($infoLieu['carteEmbed']=="")
			{
				echo "Aucune carte";
			}
			else //SI il y en a un
			{
			?>
				<iframe <?= $infoLieu['carteEmbed']; ?>></iframe>
			<?php 
			} ?>
			</td>
		</tr>
		<tr>  
			<td><input class="btn btn-primary" name="fUpdLieu1" type="submit" value="Modifier le lieu" /></td>
			<td><input type="reset" class="btn btn-primary" value="effacer"/>
			<a href='index.php?action=vue_lieu_gestion'> 
					<button type='button' class='btn btn-primary'  >Revenir à la liste de lieux</button> </a>
			</td>
		</tr>
	 </form>
    </table>
    
	</div>
	</div>
</article>
<hr/>
  <?php
  
    $contenu = ob_get_clean();
    require "gabarit.php";
?>