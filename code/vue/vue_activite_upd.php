<?php
  $titre ='MesActivités - Modifier une activité';

// vue_activite_upd.php
// Date de création : 22/05/2017
// Auteur : RSA
// Fonction : vue pour gérer une activité précise
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();
?>
<table>
	<tr>
		<td><h2>Votre activité</h2></td>
		<td>
			<?php if (testR1()==true)
			{ ?>
			<form class="form" method="POST" action="index.php?action=vue_activite_del">
				<input type="submit" name="delAct" class='btn btn-danger' onclick="return confirm('Etes-vous sûr de vouloir supprimer l\'activité ? Cette action est irréversible');" value="Supprimer l'activité" /></td>
			</FORM>
			<?php }?>
			
	</tr>
</table>
<article>
</br>
<?php
if(isset($_POST['fUpdAct1']) || isset ($_SESSION['idActivite']) AND testR2()==true) 
{ ?>
  <article>
  <div class="row">
	<div class="col-lg-8"> 
		<form class="form" method="POST" action="index.php?action=vue_activite_upd">
			<div class="form-group"> 
				<label>Nom de l'activité</label>
				<input class="form-control" type="text" name="fNNomAct" value="<?=$infoAct['nomAct'];?>"  />
			</div>  
			<div class="form-group">   
				<label>Description de l'activité</label>
				<input class="form-control" type="text" name="fNDescriptAct" value="<?= $infoAct['descriptAct']; ?>" />
			</div>
			<input class="btn btn-primary" name="fUpdAct2" type="submit" value="Enregistrer les modifications" />
			<input type="reset" class="btn btn-primary" value="effacer"/>
			<a href='index.php?action=vue_activite'> 
					<button type='button' class='btn btn-primary'  >Revenir à l'activité</button> </a>
		</form>
		</div>
	</div>
<?php }
else
{
	//Normalement cette condition n'est jamais sensée s'appliquée.
	?><p>Aucune activité n'est sélectionnée ou vous n'avez pas accès à cette page</p><?php
}?>
</article>
<hr/>
<?php 
  $contenu = ob_get_clean();
  require 'gabarit.php';
?>  
      
      
      