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
Créer un nouveau mot de passe
</h3>
<article> 
  <form class='form' method='POST' action="index.php?action=vue_passwd_upd&qLog=<?=urlencode($email);?>&qCle=<?=urlencode($cle);?>">
	<div class="form-group">
		<label>Mot de passe</label>
        <input class="form-control" placeholder="Entrez votre mot de passe" type="password"  name="fPasswdUpd" required />
		</br>
		<label>Confirmer votre de passe</label>
        <input class="form-control" placeholder="Entrez votre mot de passe" type="password"  name="fPasswdConf" required />
		</br>
		<button type="submit" class="btn btn-primary" name="fUpdPasswd">Créer le mot de passe</button>
		<button type="reset" class="btn btn-primary">Effacer</button>
    </div>
  </form> 
</article>
<hr/>
<?php 
  $contenu = ob_get_clean();
  require 'gabarit_visiteur.php';
?>  
      
      
      