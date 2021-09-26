<?php
  $titre ='MesActivités-Participant';

// vue_participant.php
// Date de création : 17/05/2017
// Auteur : RSA
// Fonction : vue pour afficher les informations d'un participant en particulier
// _______________________________

// Tampon de flux stocké en mémoire
ob_start();
?>

<h2>Votre participant</h2>
 
</br>
  <article>
  <div class="row">
	<div class="col-lg-8"> 
    
    <table class="table">
	<form class="form" method="POST" action="index.php?action=vue_participant_upd&qIdParticipant=<?=$infoPart['idParticipant']; ?>">
		<tr style="width:10%;">
			<th  style="width:10%;">En tête</th>
			<th>Données</th>
		</tr>
		<tr>  
			<td>Prénom</td>
			<td><?php echo $infoPart['prenomPart'];?></td>
		</tr>
		<tr>
			<td>Nom</td>
			<td><?php echo $infoPart['nomPart'];?></td>
		</tr>
		<tr>  
			<td>Fonction</td>
			<td><?php echo $infoPart['fonction'];?></td>
		</tr>
		<tr>  
			<td>Genre</td>
			<td><?php echo $infoPart['genre'];?></td>
		</tr>
		<tr>  
			<td>NPA</td>
			<td><?php echo $infoPart['NPA'];?></td>
		</tr>
		<tr>  
			<td>Localité</td>
			<td><?php echo $infoPart['localite'];?></td>
		</tr>
		<tr>  
			<td>Email</td>
			<td><?php echo $infoPart['email'];?></td>
		</tr>
		<tr>  
			<td>Téléphone</td>
			<td><?php echo $infoPart['telephone'];?></td>
		</tr>
		<tr>  
			<td>Equipe</td>
			<td><?php echo $infoPart['equipe'];?></td>
		</tr>
		<tr>  
			<td>Remarques</td>
			<td><?php echo $infoPart['remarque'];?></td>
		</tr>
		<tr>  
			<td><input class="btn btn-primary" name="fUpdPart1" type="submit" value="Modifier le participant" /></td>
			<td><input type="reset" class="btn btn-primary" value="effacer"/></td>
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