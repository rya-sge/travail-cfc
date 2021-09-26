<?php
//Fonctions liées aux participants
  function listePart()
 {
	 $db = getBD();
	// Création de la string pour la requête
	$requete = "SELECT * FROM tblparticipant where idActivite='".$_SESSION["idActivite"]."' order by nomPart;";
	// Exécution de la requete
	$listePart = $db->query($requete);
	return $listePart;
 }
  // ajoutActivite($postArray)
//Argument : les informations passées en POST
// Fonction : Ajouter une participant
function ajoutPart($postArray)
{
	$db=getBD();
		//Récupération des données passées en post
	$idActivite=$_SESSION['idActivite'];
	$dateCreation=date('Y-m-d H:i:s'); //Src : http://www.pontikis.net/tip/?id=18
	$nomPart=$postArray["fNomPart"];
	$prenomPart=$postArray["fPrenomPart"];
	$fonction=$postArray["fFonction"];
	$dateNaissance=$postArray["fDateNaissance"];
	$genre=$postArray["fGenre"];
	$NPA=$postArray["fNPA"];
	$localite=$postArray["fLocalite"];
	$email=$postArray["fEmail"];
	$telephone=$postArray["fTelephone"];
	$equipe=$postArray["fEquipe"];
	$remarque=$postArray["fRemarque"];
	
	try
	{	
		champVide($nomPart,"Nom");
		champVide($prenomPart,"Prénom");
		erreurXss1($nomPart);//test erreur
		erreurXss1($prenomPart);//test erreur
		$fonction=erreurText($fonction); 
		erreurXss1($genre); 
		erreurXss1($NPA); 
		erreurXss1($localite); 
		erreurXss1($telephone); 
		erreurXss1($email); 
		$equipe=erreurText($equipe);  
		$remarque=erreurText($remarque); 
		//Début Source : module 151--le test de la partie doublon
		// test si le nom du participant existe déjà pour éviter les doublons sur des activités
		$reqSelect ="SELECT * FROM tblparticipant WHERE nomPart='".$nomPart."';";
		$res=$db->query($reqSelect);
		$ligne = $res->fetch(); // récupère la valeur du participant sélectionné s'il y en a un  
		// Test le résultat
		if (empty($ligne['nomPart']))
			{
				// ajout du participant
				$req = $db->prepare('INSERT INTO tblparticipant (idActivite,dateCreation,nomPart,prenomPart,fonction,dateNaissance,genre,
				NPA,localite,email,telephone,equipe,remarque)
					VALUES (:idActivite,:dateCreation,:nomPart,:prenomPart,:fonction,:dateNaissance,:genre,:NPA,:localite,:email,:telephone,:equipe,:remarque)');
				$req->execute(array(
				'idActivite'=>$idActivite,
				'dateCreation'=>$dateCreation,
				'nomPart' => $nomPart,
				'prenomPart' => $prenomPart,
				'fonction' => $fonction,
				'dateNaissance' => $dateNaissance,
				'genre' => $genre,
				'NPA' => $NPA,
				'localite' => $localite,
				'email' => $email,
				'telephone' => $telephone,
				'equipe' => $equipe,
				'remarque' => $remarque,
				));
			return true;
			}
		else
		{  
			throw new Exception("Le participant ne peut pas être ajouté car il existe déjà.");
      //return false;    
		}
  }
  catch (Exception $e)
  {
    $_SESSION['erreur']=$e->getMessage();
    //require "vue/vue_erreur_visiteur.php";
  }
  //Fin Source : module 151
 }
// -----------------------------
// infoPart($idParticipant) 
//Argument : l'id du participant
// Fonction : Récupérer les informations d'un participant donné
//Sortie $part. Contient les informations du participant
function infoPart($idParticipant) 
{
	erreurUrl($idParticipant);
	$db = getBD();
	// Création de la string pour la requête
	$requete = "SELECT * FROM tblparticipant where idParticipant='".$idParticipant."';";
	// Exécution de la requete
	$resultats = $db->query($requete);
	$part=$resultats->fetch();
	return $part;
 }
 function updPart($postArray,$idParticipant)
 {
	$db=getBD();
	erreurUrl($idParticipant);
	$NNomPart=$postArray["fNNomPart"];
	$NPrenomPart=$postArray["fNPrenomPart"];
	$NFonction=$postArray["fNFonction"];
	$NDateNaissance=$postArray["fNDateNaissance"];
	$NGenre=$postArray["fNGenre"];
	$NNPA=$postArray["fNNPA"];
	$NLocalite=$postArray["fNLocalite"];
	$NEmail=$postArray["fNEmail"];
	$NTelephone=$postArray["fNTelephone"];
	$NEquipe=$postArray["fNEquipe"];
	$NRemarque=$postArray["fNRemarque"];

	try
	{
		champVide($NNomPart,"Nom");
		champVide($NPrenomPart,"Prénom");
		erreurXss1($NNomPart);//test erreur
		erreurXss1($NPrenomPart);//test erreur
		$NFonction=erreurText($NFonction); 
		erreurXss1($NGenre); 
		erreurXss1($NNPA); 
		erreurXss1($NLocalite); 
		erreurXss1($NTelephone); 
		erreurXss1($NEmail); 
		$NEquipe=erreurXss1($NEquipe); 
		$NRemarque=erreurText($NRemarque);
		$reqSelect ="SELECT * FROM tblparticipant WHERE nomPart='".$NNomPart."' AND idParticipant!='".$idParticipant."' AND idActivite='".$_SESSION['idActivite']."';";
		$res=$db->query($reqSelect);
		$ligne = $res->fetch(); // récupère la valeur du projet sélectionné s'il y en a un  
		// Test le résultat
		if (empty($ligne['nomPart']))
			{
				// Modification du participant
					$req = $db->prepare("update tblparticipant set nomPart=:nomPart,prenomPart=:prenomPart,fonction=:fonction,dateNaissance=:dateNaissance,genre=:genre,NPA=:NPA,localite=:localite,email=:email,telephone=:telephone,equipe=:equipe,remarque=:remarque 
					WHERE idParticipant='".$idParticipant."' AND idActivite='".$_SESSION['idActivite']."';");
					$req->execute(array(
					'nomPart' => $NNomPart,
					'prenomPart' => $NPrenomPart,
					'fonction' => $NFonction,
					'dateNaissance' => $NDateNaissance,
					'genre' => $NGenre,
					'NPA' => $NNPA,
					'localite' => $NLocalite,
					'email' => $NEmail,
					'telephone' => $NTelephone,
					'equipe' => $NEquipe,
					'remarque' => $NRemarque,
				));
			$_SESSION['modif']="Le participant a bien été mis à jour";
			return true;
			}
		else
		{  
			throw new Exception("<p>Le participant ne peut pas être modifié car le nom existe déjà.</p>");
			//<a href='index.php?action=vue_participant_gestion'> <button type='button' class='btn btn-primary'  ><strong>Revenir à la gestion des participantx</strong></button> </a> </p>
      //return false;    
		}
	}
	catch (Exception $e)
	{
		$_SESSION['erreur']=$e->getMessage();
		//require "vue/vue_erreur.php";
	}
 }
// -----------------------------
// delPart($idParticipant)
// Fonction : Permet de supprimer un participant
//Argument : L'id du participant à supprimer
 function delPart($idParticipant)
 {	
	erreurUrl($idParticipant);
	try
	{
		$db=getBD();
		$requete = 'DELETE FROM tblparticipant WHERE idParticipant ="'.$idParticipant.'" AND idActivite="'.$_SESSION["idActivite"].'";';
		$db->exec($requete);
	}
	
	 catch (Exception $e)
		{
				trigger_error($e->getMessage(), E_USER_ERROR);
		}
 }
 ?>