<?php
  $titre ='MesActivités - passwd recup';

// vue_passwd_recup.php
// Date de création : 04/08/2018
// Auteur : RSA
// Fonction : vue pour récupérer son mot de passe
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();

?>
<?$_SESSION['error']="";?>
<h1 style="text-align:center">Mot de passe</h1>
<h3 style="text-align:center">
Demander un lien de réintialisation
</h3>
<article> 
  <form class='form' method='POST' action="index.php?action=vue_passwd_reset">
	<div class="form-group">
		<label>Login ou adresse email</label>
        <input class="form-control" type="text" placeholder="Entrez votre login ou votre adresse email" name="fForgetPasswd" required />
		</br>
		<button type="submit" class="btn btn-primary" name="fLien">Demander le lien</button>
		<button type="reset" class="btn btn-primary">Effacer</button>
    </div>
  </form> 
</article>
<hr/>
<?php 
  $contenu = ob_get_clean();
  require 'gabarit_visiteur.php';
?>  
      
      
      