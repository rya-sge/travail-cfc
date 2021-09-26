<?php
  $titre ='Compta Portable - ajouter une autorisation';

// vue_autorisation_add.php
// Date de création : 18/05/2017
// Auteur : RSA
// Fonction : vue pour ajouter une autorisation
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();

?>
<article>
<div>
  <fieldset>
	<legend>Ajouter un utilisateur à l'activité <a href='index.php?action=vue_autorisation_gestion'> 
			<button type='button' class='btn btn-primary btn-sm'  ><strong>Revenir à la gestion des utilisateurs</strong></button> </a></legend>
  <form class='form' method='POST' action="index.php?action=vue_autorisation_add">
	<div class="form-group">
		<label>Login ou adresse email*</label>
        <input class="form-control" type="text" placeholder="Entrez le login de l'utilisateur" name="fLogin" value="<?=@$_POST['fLogin'] ?>" required />
		</br>
		<label for="journal">Rôle de l'utilisateur*</label>
		<?php if (testR1()==true)
		{ ?>
			<select class="form-control" name="fSRole">
				<?php
				//Affiche la liste des journaux
					foreach ($listeRoles as $listeRole) 
					{
						echo "<option value='".$listeRole['nomRole']."'>".$listeRole['nomRole']."</option>";
					}
					?>
			</select>
		<?php } 
		else  if (testR2()==true) 
		{ ?>
			<select class="form-control" name="fSRole">
				<?php
				//Affiche la liste des journaux
					foreach ($listeRolesA as $listeRole) 
					{
						echo "<option value='".$listeRole['nomRole']."'>".$listeRole['nomRole']."</option>";
					}
					?>
			</select>
		<?php } ?>	
			
		</br>
		</br>
		<button type="submit" class="btn btn-primary" name="fAddAutori">Ajouter un utilisateur</button>
		<button type="reset" class="btn btn-primary">Effacer</button>
		
    </div>
  </form>
</fieldset>
</br>
<fieldset>
 
</div> 
</article>
<hr/>
<?php 
  $contenu = ob_get_clean();
  require 'gabarit.php';
?>  
      
      
      