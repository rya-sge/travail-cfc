<?php
  $titre ='Mes activités - Modifir autorisation';

// vue_autorisation_upd.php
// Date de création : 19/05/2017
// Auteur : RSA
// Fonction : vue pour modifier l'autorisation d'un utilisateur
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();
?>
<h2>Votre utilisateur</h2>
 
</br>
  <article>
  <div class="row">
	<div class="col-lg-8"> 
    
    <table class="table">
	<form class="form" method="POST" action="index.php?action=vue_autorisation_upd&qIdUser=<?=$infoAutori['idUser']; ?>">
      <tr>
        <td>Login l'utilisateur</td>
		<td><?=$infoAutori['login'];?></td>
		<input type='hidden' name='fLogin' value="<?=$infoAutori['login'];?>">
      </tr>  
      <tr>  
        <td>Role de l'utilisateur </td>
		<td>
		<?php if (testR1()==true)
		{ ?>
			<select class="form-control" name="fNSRole">
				<?php
				//Affiche la liste des journaux
					foreach ($listeRoles as $listeRole) 
					{
						echo "<option value='".$listeRole['nomRole']."'";
						if($listeRole['nomRole']==$infoAutori['nomRole']) 
						{ 
							echo "selected='selected'"; 
					    }  
						echo "'>".$listeRole['nomRole']."</option>";
					}
					?>
			</select>
		<?php } 
		else  if (testR2()==true) 
		{ ?>
			<select class="form-control" name="fNSRole">
				<?php
				//Affiche la liste des journaux
					foreach ($listeRolesA as $listeRole) 
					{
						echo "<option value='".$listeRole['nomRole']."'";
						if($listeRole['nomRole']==$infoAutori['nomRole']) 
						{ 
							echo "selected='selected'"; 
					    }  
						echo "'>".$listeRole['nomRole']."</option>";
					}
					?>
			</select>
		<?php } ?>	
		</td>	
      </tr>
     <tr>  
        <td><input class="btn btn-primary" name="fUpdAutori2" type="submit" value="Enregistrer les modifications" /></td>
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
  require 'gabarit.php';
?>  
      
      
      