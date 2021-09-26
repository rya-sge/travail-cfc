<?php
  $titre ='MesActiviés - Mon activité';

// vue_activite.php
// Date de création : 15/03/2017
// Auteur : RSA
// Fonction : vue pour gérer une activité précise
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();
?>
<h2>Votre activité</h2>
 
<article>
</br>
  <article>
  <p class="textModif"><?php
	if(isset($_SESSION['modif']))
	{
		echo $_SESSION['modif'];
		echo $_SESSION['modif']="";
	}?>
	</p>
<div class="row">
	<div class="col-lg-8"> 
		<table class="table table-bordered ">
		<thead>
			<tr>
				<th style="width:50%;">Infomations sur l'activité</th>
					<th>
					<!--Ce formulaire permet d'aller sur la page d'édition des informations de compte -->
						<form action="index.php?action=vue_activite_upd" method="Post" >
							<input class="btn  btn-primary"  type="submit" name="fUpdAct1" value="modifier"></input>
						</form>
					</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td style="width:50%;">Nom de l'activite</td>
				<td><?php echo $infoAct['nomAct']; ?></td>
			</tr>
			<tr>
				<td>Description</td>
				<td><?php echo $infoAct['descriptAct'];?></td>
			</tr>
			<tr>
				
			</tr>
		</tbody>
		</table>
	</div>
</div>
</article>
<hr/>
<?php 
  $contenu = ob_get_clean();
  require 'gabarit.php';
?>  
      
      
      