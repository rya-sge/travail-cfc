<?php

// modele.php
// Auteur : RSA
// Fonction : modele avec connexion avec le serveur et la BD
//            exécution des requêtes
// ____________________________________________________________



// -----------------------------------------------------
// Fonctions liées aux utilisateurs

// -----------------------------
// getIdUser($login)
//argument : le login de l'utilisateur
// Fonction : Récupère l'id d'un utilisateur à partir de son login
//Utilisée dans la fonction : ajoutActivite
// Sortie : $idUser['idUser']. Il s'agit de l'id de l'utilisateur
function getIdUser($login)
{
	$db = getBD();
	// Création de la string pour la requête
	$requete = "SELECT idUser FROM tbluser WHERE login='".$login."' OR email='".$login."'";
	// Exécution de la requete
	$resultats = $db->query($requete);
	$idUser = $resultats->fetch();
	return $idUser['idUser'];
}

// -----------------------------
// getIdUser($login)
//argument : le login de l'utilisateur
// Fonction : contient la requête permettant d'avoir toutes les informations de l'utilisateur passé en paramètre
// Sortie : $resultats. Il s'agit d'jeu de résultats retourné en tant qu'objet PDOStatement
function getUser($login)
{
	$db = getBD();
	// Création de la string pour la requête
	$requete = "SELECT idUser FROM tbluser WHERE login='".$login."'";
	// Exécution de la requete
	$resultats = $db->query($requete);
	return $resultats;
}
// -----------------------------
// infoUtilisateur()
// Fonction : Récupère les infos de l'utilisateur
//Utilisée dans la fonction : ajoutActivite
// Sortie : $infoUser
 function infoUtilisateur()
 {
	$db=getBD();
	//Initialisation du tableau qui va contenir les informations de l'utilisateur.
	$infoUser=array(
			'email'=>"",
	);
	$reponse = $db->query('SELECT * FROM tbluser');
	while ($donnees = $reponse->fetch())
	{
		if(isset($_SESSION['login']))
		{
		 
			if ($donnees['login']==$_SESSION['login'] )
			{
			//Insère dans le tableau précédemment crée les informations de l'utilisateur
			$infoUser=array(
			'email'=>$donnees['email'],
		);
			}
		}
		
	}
	return $infoUser;//Retourne le tableau contenant les informations de l'utilisateur
 }
 // -----------------------------
// checkLogin($postArray)
//Argument : les informations passées en POST
// Fonction : Contrôle de login
// Sortie : $infoUser. COntient les informations de base de l'utilisateur (email, id et login)
//SI login faux,$infoUser renvoie false
function checkLogin($postArray)
{
	$db = getBD();
	$username=$postArray ["fLogin"];
	$passwdPost=$postArray["fPasswd"];
	$requete="SELECT * FROM tbluser;";
	$resultats=$db->query($requete);
	$verif=false;
	try
	{
		erreurXss1($username);
		while ($donnees = $resultats->fetch())
		{
			$hash=$donnees['passwd'];
			if ($donnees['login']==$username AND password_verify($passwdPost, $hash))
			{
				$verif=true;//indique que le mot de passe correspond à l'utilisateur
				if ($donnees['actif']==1) //Vérifie que le compte a été activé
				{
					
					//Initialisation du tableau qui va contenir les informations de l'utilisateur.
					$infoUser=array(
					'email'=>$donnees['email'],
					'idUser'=>$donnees['idUser'],
					'login'=>$donnees['login'],
					);
				}
				else
				{
					throw new Exception("Vous devez activer votre compte en cliquant sur le lien reçu par email lors de votre inscription. Il est possible que le mail envoyé soit dans voitre boite SPAM"); 
					$infoUser=false;
				}
				
			}
		}
		if($verif==false)
		{
			throw new Exception("Les données d'authentification sont incorrectes"); 
			$infoUser=false;
		}
	}
	catch (Exception $e)
	{
		$_SESSION['erreur']=$e->getMessage();
		//require "vue/vue_erreur_visiteur2.php";Les erreurs sont gérées depuis gabarit visiteur
		require "vue/vue_login.php";
		
	}
	return @$infoUser;//renvoie certaines infos de l'utilisateur
}
 // -----------------------------
// ajoutUser($post)
//Argument : les informations passées en POST
// Fonction : Ajouter un utilisateur
function ajoutUser($post)
{
	$db=getBD();
	//https://www.grafikart.fr/forum/topics/14831
	$postArray=&$_POST;
	$email = $_POST['fEmail'];
	$login=$postArray ["fLogin"];
	$passwdPost=$postArray["fPasswd"];
	$passwdConf=$postArray['fPasswdConf'];
	$erreur=false;
	$cle = md5(microtime(TRUE)*100000); //Génération aléatoire d'une clé
	//Affiche un message d'erreur si la fonction htmlspecialchars a effectué des remplacements de caractères pour le mot de passe (pour éviter faille xss)
	try
	{
		//Test des formulaires
		 champVide($login,"Login");
		 champVide($email,"Email");
		 champVide($passwdPost,"Mot de passe");
		 champVide($passwdConf,"Confirmer votre mot de passe");
		 erreurXss1($login);
		 erreurXss1($email);
		 verifEmail($email);
		 lengthChamp($email,"Adresse email",45);
		lengthChamp($login,"Nom d'utilisateur/login",45);
		 $erreur=erreurPasswd($passwdConf,$passwdPost);
		 //Source pour le test de la validation d'adresse email : http://php.net/manual/fr/filter.examples.validation.php
				//Hashage mdp
				$passwdHash = password_hash($passwdPost,PASSWORD_DEFAULT);
				$passwd = $passwdHash;
				$dateInscription=date('Y-m-d H:i:s'); //Source : http://www.pontikis.net/tip/?id=18
				// test si le login ou l'email existe déjà pour éviter qu'il y ait deux utilisateurs ayant le même login ou la même adresse email
				$reqSelect ="SELECT * FROM tbluser WHERE login='".$login."'OR email='".$email."';";
				$res=$db->query($reqSelect);
				$ligne = $res->fetch(); // récupère la valeur du login sélectionné s'il y en a un  
				// Test le résultat
				if (empty($ligne['login']))
				{
					// ajout de l'utilisateur
					$req = $db->prepare('INSERT INTO tbluser (login, email, passwd, dateInscription,cle)
						VALUES (:login, :email, :passwd,:dateInscription,:cle)');
					$req->execute(array(
					'login' => $login,
					'email' => $email,
					'passwd' => $passwd,
					'dateInscription'=>$dateInscription,
					'cle'=>$cle
					));
					// Préparation du mail contenant le lien d'activation
					$destinataire = $email;
					$sujet = "Activer votre compte" ;
					$entete = "From: " ;//modifier si besoin
					// Le lien d'activation est composé du login(log) et de la clé(cle)
					$message = 'Bienvenue sur MesActivites.ch,
 
					Pour activer votre compte, veuillez cliquer sur le lien ci dessous
					ou copier/coller dans votre navigateur internet.
					
					http://mesactivites.ch/index.php?action=vue_validation2&log='.urlencode($login).'&cle='.urlencode($cle).'
					---------------
					Si vous n\'avez jamais créee de compte sur ce site, veuillez simplement ignorer cet email
					---------------
					Ceci est un mail automatique, Merci de ne pas y répondre.';
 
 
					mail($destinataire, $sujet, $message, $entete) ; // Envoi du mail
					
					require "vue/vue_validation1.php";
					return true;
				}
				else
				{  
					throw new Exception("L'utilisateur ne peut pas être ajouté car il existe déjà.");   
				}	
		
	}
	//Récupère message d'erreur
	catch (Exception $e)
	{
		$_SESSION['erreur']=$e->getMessage();
		//require "vue/vue_erreur_visiteur2.php";Les erreurs sont gérées depuis gabarit visiteur
		require "vue/vue_inscription.php";
	}  
}
// -----------------------------
// validerUser()
// Fonction : Valider le compte d'un utilisateur grâce à sa clé envoyé par email
function validerUser()
{
	$db = getBD();
	$username=$_GET['log'];
	$cle = $_GET['cle'];
	$requete="SELECT * FROM tbluser;";
	$resultats=$db->query($requete);
	$verif=false;
	try
	{
		while ($donnees = $resultats->fetch())
		{
			if ($donnees['login']==$username AND $donnees['cle']==$cle)
			{
				$verif=true;//indique que la clé correspond au login
				$actif=$donnees['actif'];
				if($actif == '1') // Si le compte est déjà actif on prévient
				{
					throw new Exception("Votre compte est déjà actif !");  
				}
				else
				{
					$req = $db->prepare("update tbluser set actif=:actif    
					WHERE login='".$username."';");
					$req->execute(array(
					'actif' => 1,
				));
				}
				//Initialisation du tableau qui va contenir les informations de l'utilisateur.
				/*/"$infoUser=array(
				'email'=>$donnees['email'],
				'idUser'=>$donnees['idUser'],
				'login'
				);*/
				require "vue/vue_validation2.php";
			}
			
		}
		if($verif==false)
		{
			throw new Exception("Erreur ! Votre compte ne peut être activé...");  
		}
	}
	catch (Exception $e)
	{
		$_SESSION['erreur']=$e->getMessage();
		require "vue/vue_erreur_visiteur.php";
		return false;
	}
}
 // -----------------------------
// oubliPasswd($postArray)
//Argument : les informations passées en POST (login ou adresse email)
// Fonction : Envoie d'un lien de réintialisation du mot de passe
function oubliPasswd($postArray)
{
	$db = getBD();
	$requete="SELECT * FROM tbluser;";
	$resultats=$db->query($requete);
	
	$cle = md5(microtime(TRUE)*100000); //Génération aléatoire d'une clé
	$id=$postArray["fForgetPasswd"];
	$verif=false;
	try
	{
		while ($donnees = $resultats->fetch())
		{
			
			if ($donnees['email']==$id  || $donnees['login'] ==$id)
			{
				
				
				require "vue/vue_passwd_message.php";
				$req = $db->prepare("update tbluser set forgetPasswd=:forgetPasswd 
					WHERE email='".$id."' or login='".$id."';");
					$req->execute(array(
					'forgetPasswd' => $cle,
					));
				$verif=true;
				$email=$donnees['email'];
				// Préparation du mail contenant le lien d'activation
				$destinataire = $email;
				$sujet = "Réintiallisation de votre mot de passe" ;
				$entete = "From: ryan.sauge@mesactivites.ch" ;//modifier si besoin
				// Le lien d'activation est composé du login(log) et de la clé(cle)
				$message = 'Bienvenue sur MesActivites.ch,
 
					Pour réintialliser votre mot de passe, veuillez cliquer sur le lien ci dessous
					ou copier/coller dans votre navigateur internet.
					
					http://mesactivites.ch/index.php?action=vue_passwd_upd&qLog='.urlencode($email).'&qCle='.urlencode($cle).'
 
 
					---------------
					Ceci est un mail automatique, Merci de ne pas y répondre.';
 
 
					mail($destinataire, $sujet, $message, $entete) ; // Envoi du mail
			}
			
		}
		if($verif==false)
			{
				
				throw new Exception("L'adresse email ou le login ne correspond à aucun compte.");
			}
	}
	catch (Exception $e)
	{
		$_SESSION['erreur']=$e->getMessage();
		require "vue/vue_passwd_reset.php";
	}
}
// -----------------------------
// verifCle($cle,$email)
//Argument : les informations passées en POST (cle et email)
// Fonction : Vérifier que lien utilisé pour réintialiser le mot de passe est valide
function verifCle($cle,$email)
{
	$db = getBD();
	$requete="SELECT * FROM tbluser;";
	$resultats=$db->query($requete);
	$verif=false;
	try
	{
		while ($donnees = $resultats->fetch())
		{
			if ($donnees['email']==$email AND $donnees['forgetPasswd']==$cle)
			{
				$verif=true;
				return true;
			}	
		}
		if($verif==false)
			{
				throw new Exception("Le lien n'est pas/plus valide");  
			}
	}
	catch (Exception $e)
	{
		$_SESSION['erreur']=$e->getMessage();
		require "vue/vue_erreur_visiteur.php";
		return false;
	}
	
}
// -----------------------------
// updPasswd($postArray)
//Argument : les informations passées en POST (nouveau mot de passe)
// Fonction : réintialiser le mot de passe
function updPasswd($postArray,$cle,$email)
{
	$db = getBD();
	$requete="SELECT * FROM tbluser;";
	$resultats=$db->query($requete);
	
	//$email=urldecode($_GET['log']);
	//$cle = $_GET['cle'];
	$passwd=$postArray["fPasswdUpd"];
	$passwdConf=$postArray["fPasswdConf"];	
	$verif=false;
	try
	{
		$erreur=erreurPasswd($passwdConf,$passwd);
		$passwdHash = password_hash($passwd,PASSWORD_DEFAULT);
		$passwd = $passwdHash;
		while ($donnees = $resultats->fetch())
		{
			if ($donnees['email']==$email AND $donnees['forgetPasswd']==$cle AND $donnees['forgetPasswd']!=NULL)
			{
				$verif=true;//indique que la clé correspond au login
					$req = $db->prepare("update tbluser set passwd=:passwd,forgetPasswd=:forgetPasswd    
					WHERE email='".$email."';");
					$req->execute(array(
					'passwd' => $passwd,
					'forgetPasswd'=>NULL,
				));
				require "vue/vue_passwd_validation.php";
			}
		}
		if($verif==false)
		{
			throw new Exception("Erreur ! La clé ou l'adresse email ne corresponde pas...");  
		}
	}
	catch (Exception $e)
	{
		$_SESSION['erreur']=$e->getMessage();
		require "vue/vue_erreur_visiteur.php";
	}
}
// -----------------------------
// changePasswd($postArray)
//Argument : les informations passées en POST
// Fonction : Permet de changer le mot de passe
function changePasswd($postArray)
{
	$changePasswd=true;
	$passwdOld=$postArray['fPasswdOld']; 
	$NPasswdPost=$postArray['fNPasswdPost'];
	$NPasswdConf=$postArray['fNPasswdConf'];
	//Hashage mdp
	$db = getBD();
	//Sélection du mot de passe de l'utilisateur dans la BDD
	$requete="SELECT passwd FROM tbluser where login='".$_SESSION['login']."';";
	$resultats = $db->query($requete);
	$passwd = $resultats->fetch();
	$verif=false;
	try
		{
			if($resultats!="")
			{
				//erreurPasswd($NPasswdConf,$NPasswdPost); //Vérifie que les mots de passes correspondent et soient assez long
				$erreur=erreurPasswd($NPasswdConf,$NPasswdPost);
				if($erreur==true)
				{
					return false;
				}
				$hash=$passwd['passwd'];
				if (password_verify($passwdOld,$hash)) //Vérification du mot de passe
				{
					$verif=true;//indique que le mot de passe correspond à l'utilisateur
					$passwdHash = password_hash($NPasswdPost,PASSWORD_DEFAULT); //Hachage du mot de passe
					$passwd = $passwdHash;
					//Mise à jour des informations
					$req = $db->prepare("update tbluser set passwd=:passwd 
					WHERE idUser='".$_SESSION['idUser']."';");
					$req->execute(array(
					'passwd' => $passwd,
					));
					$_SESSION['modif']="Votre mot de passe a bien été modifié";
				return true;
				}
				else
				{
					throw new Exception("Les données d'authentification sont incorrectes"); 
				}
			}
			else
			{
				throw new Exception("Les données d'authentification sont incorrectes"); 
			}
		}
	catch (Exception $e)
	{
		$_SESSION['erreur']=$e->getMessage();
		return false;
		require "vue/vue_erreur_visiteur.php";
	}
}
// -----------------------------
// changeLogin()
// Fonction : Permet de changer le login
function changeLogin()
{
	$db=getBD();
	$postArray=&$_POST;
	try
	{
		$NLogin=$postArray ["fNLogin"];
		champVide($NLogin,"Nom d'utilisateur/login");
		erreurXss1($NLogin);
		lengthChamp($NLogin,"Nom d'utilisateur/login",45);
		if($NLogin!=$_SESSION['login'])
		{
			// test si le login ou l'email existe déjà pour éviter qu'il y ait deux utilisateurs ayant le même login
			$reqSelect ="SELECT * FROM tbluser WHERE login='".$NLogin."' AND login !='".$_SESSION['login']."';";
			$res=$db->query($reqSelect);
			$ligne = $res->fetch(); // récupère la valeur du login sélectionné s'il y en a un  
			// Test le résultat
			if (empty($ligne['login']))
			{
				//Mise à jour des informations
					$req = $db->prepare("update tbluser set login=:login 
				WHERE idUser='".$_SESSION['idUser']."';");
				$req->execute(array(
				'login' => $NLogin,
				));
				$_SESSION['login']=$NLogin;
				$_SESSION['modif']="Votre nom d'utilisateur a bien été modifié";
				return true;
			}
			else
			{  
				throw new Exception("Ce login est déjà utilisé");
				//return false;    
			}
		}
	}
	
	//Récupère message d'erreur
	catch (Exception $e)
	{
		$_SESSION['erreur']=$e->getMessage();
		return false;
		//require "vue/vue_profil.php";
		//require "vue/vue_erreur_visiteur2.php";
	} 
}
// -----------------------------
// changeEmail()
// Fonction : Permet de changer le login
function changeEmail()
{
	$db=getBD();
	$postArray=&$_POST;
	$NEmail = $_POST['fNEmail'];
	$cle = md5(microtime(TRUE)*100000); //Génération aléatoire d'une clé
	try
	{
		champVide($NEmail,"Adresse email");
		erreurXss1($NEmail);
		verifEmail($NEmail);
		lengthChamp($NEmail,"Adresse email",45);
		if($NEmail!=$_SESSION['email'])
		{
			// test si l'email existe déjà pour éviter qu'il y ait deux utilisateurs ayant la même adresse email
			$reqSelect ="SELECT * FROM tbluser WHERE email='".$NEmail."' ;";
			$res=$db->query($reqSelect);
			$ligne = $res->fetch(); // récupère l'utilisateur sélectionné s'il y en a un  
			// Test le résultat
			if (empty($ligne['idUser']))
			{
					$req = $db->prepare("update tbluser set cleUpd=:cleUpd 
					WHERE idUser='".$_SESSION['idUser']."';");
					$req->execute(array(
					'cleUpd' => $cle,
					));
				// Préparation du mail contenant le lien d'activation
					$destinataire = $NEmail;
					$sujet = "Confirmer votre nouvelle adresse email" ;
					$entete = "From: ryan.sauge@mesactivites.ch" ;//modifier si besoin
					// Le lien d'activation est composé du login(log) et de la clé(cle)
					$message = 'Bienvenue sur MesActivites.ch,
 
					Pour confirmer le changement de votre adresse email, veuillez cliquer sur le lien ci-dessous
					ou copier/coller dans votre navigateur internet.
					
					http://mesactivites.ch/index.php?action=vue_validation_email&id='.urlencode($_SESSION["idUser"]).'&email='.urlencode($NEmail).'&cle='.urlencode($cle).'
					---------------
					Si vous n\'avez jamais créee de compte sur ce site, veuillez simplement ignorer cet email
					---------------
					Ceci est un mail automatique, Merci de ne pas y répondre.';
 
 
					mail($destinataire, $sujet, $message, $entete) ; // Envoi du mail
					
					require "vue/vue_validation_email1.php";
					return true;
			}
			else
			{  
				throw new Exception("Cet email est déjà utilisé");
				//return false;    
			}
		}
		
	}
	//Récupère message d'erreur
	catch (Exception $e)
	{
		$_SESSION['erreur']=$e->getMessage();
		return false;
		//require "vue/vue_profil.php";
		//require "vue/vue_erreur_visiteur2.php";
	} 
	
}
// -----------------------------
// validerEmail()
// Fonction : Valider la nouvelle adresse email d'un utilisateur
function validerEmail($email,$cle)
{
	$db = getBD();
	$id=$_GET['id'];
	$requete="SELECT * FROM tbluser;";
	$resultats=$db->query($requete);
	$verif=false;
	$verif2=false;
	try
	{
		while ($donnees = $resultats->fetch())
		{
			//Vérifie que l'adresse email n'est pas déjà utilisée
			if ($donnees['email']==$email)
			{
				$verif=true;
			}
		}
		$resultats=$db->query($requete);
		if ($verif==false)
			{
				while ($donnees = $resultats->fetch())
				{
					if ($donnees['idUser']==$id AND $donnees['cleUpd']==$cle AND $donnees['cleUpd']!=NULL)
					{
						$verif2=true;//indique que la clé correspond au login
						$req = $db->prepare("update tbluser set email=:email,cleUpd=:cleUpd    
						WHERE idUser='".$id."';");
						$req->execute(array(
						'email' => $email,
						'cleUpd'=>NULL,
					));
					$_SESSION['email']=$email;
					require "vue/vue_validation_email2.php";
					}
				}
			}
		if($verif==true)
		{
			throw new Exception("Erreur ! Cette adresse email est déjà utilisée...");  
		}
		else
		{
			if($verif2==false)
			{
				throw new Exception("Erreur ! La clé ne correspond pas...");  
			}
		}
			
	}	
	catch (Exception $e)
	{
		$_SESSION['erreur']=$e->getMessage();
		require "vue/vue_erreur_visiteur.php";
		return false;
	}
}
	 // -----------------------------
// delUser($idUser)
// Fonction : Permet de supprimer un utilisateur
//Argument : L'id de l'utilisateur à supprimer
 function delUser($idUser)
 {	
	erreurUrl($idUser);
	try
	{
		$db=getBD();
		$requete = 'DELETE FROM tblautorisation WHERE idUser ="'.$idUser.'";';
		$db->exec($requete);
		$requete = 'DELETE FROM tbluser WHERE idUser ="'.$idUser.'";';
		$db->exec($requete);
		
	}
	 catch (Exception $e)
		{
				trigger_error($e->getMessage(), E_USER_ERROR);
				$_SESSION['erreur']=$e->getMessage();
		}
 }

