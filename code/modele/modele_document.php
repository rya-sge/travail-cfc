<?php
// -----------------------------
// listeDoc()
// Fonction : Récupérer l'ensemble des documents d'une activité
//Sortie $listeDoc. Contient les documents de l'activité
  function listeDoc()
 {
	 $db = getBD();
	// Création de la string pour la requête
	$requete = "SELECT * FROM tbldocument where idActivite='".$_SESSION["idActivite"]."' order by nomDoc;";
	// Exécution de la requete
	$listeDoc = $db->query($requete);
	return $listeDoc;
 }
 // -----------------------------
// infoDoc($idDocument)
//Argument : l'id du document
// Fonction : Récupérer les informations d'un document donné
//Sortie document. Contient les informations du document
 function infoDoc($idDocument) 
{
	$db = getBD();
	// Création de la string pour la requête
	erreurUrl($idDocument);
	try
	{
		$requete = "SELECT * FROM tbldocument where idDocument='".$idDocument."' AND idActivite='".$_SESSION['idActivite']."';";
		// Exécution de la requete
		$resultats = $db->query($requete);
		$document=$resultats->fetch();
		if (empty($document['idDocument']))
		{
			throw new Exception("<p>Ce document est inconnu ou vous n'avez pas les droits nécessaires pour le modifier. </p><p><a href='index.php?action=vue_document_gestion'> 
					<button type='button' class='btn btn-primary'  >Revenir à la gestion des documents</button> </a> </p>");
		}
		else
		{
			return $document;
		}
	}
	
	catch (Exception $e)
	{
		$_SESSION['erreur']=$e->getMessage();
		require "vue/vue_erreur.php";
	}
 }
 // -----------------------------
// getFilenameDoc($idDocument)
//argument : L'id du ducoment
// Fonction : Permet d'obtenir le nom de fichier d'un document en fonction de son id
// Sortie : $filename['filename'] : nom du fichier
function getFilenameDoc($idDocument)
{
	erreurUrl($idDocument);
	 $db = getBD();// connexion à la BD
	// Création de la string pour la requête. 
	$requete = "SELECT filename FROM tbldocument where idDocument='".$idDocument."' AND idActivite='".$_SESSION["idActivite"]."'";
	// Exécution de la requete
	$res = $db->query($requete);
	$filename = $res->fetch();
	return $filename['filename'];
}
  // ajoutDoc($postArray)
//Argument : les informations passées en POST
// Fonction : Ajouter un document
function ajoutDoc($postArray)
{
	$db=getBD();
		//Récupération des données passées en post
		
	$idActivite=$_SESSION['idActivite'];
	$dateCreation=date('Y-m-d H:i:s'); //Src : http://www.pontikis.net/tip/?id=18
	$nomDoc=$postArray["fNomDoc"];
	$descriptDoc=$postArray["fDescriptDoc"];
	//Source : le code suivant, permettant d'uploader un fichier est tiré de ce site : http://antoine-herault.developpez.com/tutoriels/php/upload/
	$file=$_FILES['fFilename']['tmp_name'];
	try
	{	
		erreurXss1($nomDoc);//test erreur
		$descriptDoc=erreurText($descriptDoc);
		champVide($nomDoc,"nom du document");
		if(isset($_FILES['fFilename']))
		{ 
			$path = "contenu/documents/".$_SESSION['idActivite']."/";
			if (file_exists($path)==false)
			{
				mkdir($path, 0777, true);
			}
			$filename = basename($_FILES['fFilename']['name']);
			$taille_maxi = 104857600;//100 mo
			$taille = filesize($file);
			$extensions = array('.png','.PNG','.JPG', '.gif', '.jpg', '.jpeg','.pdf','.docx','.doc','.xls','.dot','.mwb','.vsd','.mpp', '.txt');
			$extension = strrchr($_FILES['fFilename']['name'], '.'); 
			//Début des vérifications de sécurité...
			
			if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
			{
				throw new Exception("Vous devez uploader un fichier de type png, gif, JPG, jpg, jpeg, txt ou doc...");	
			}
			if($taille>$taille_maxi)
			{
				throw new Exception("Le fichier est trop gros...");	
			}
			if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
			{
					//On formate le nom du fichier ici...
				$filename = strtr($filename, 
				'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
				'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
				$filename = preg_replace('/([^.a-z0-9]+)/i', '-', $filename);
				if (file_exists($path.$filename)==true)
				{
					throw new Exception("Un fichier du même nom existe déjà");	
					exit();
				}
				else
				{
					if(move_uploaded_file($file, $path . $filename)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
					{
						move_uploaded_file($file, $path . $filename);
					}
					else //Sinon (la fonction renvoie FALSE).
					{
						throw new Exception("Echec de l\'upload !");
					}
				}
			}
		}
		//Fin de la source
		//Début Source : module 151--le test de la partie doublon
		// test si le nom du document existe déjà pour éviter les doublons sur des activités
		$reqSelect ="SELECT * FROM tbldocument WHERE nomDoc='".$nomDoc."' AND idActivite='".$_SESSION['idActivite']."';";
		$res=$db->query($reqSelect);
		$ligne = $res->fetch(); // récupère la valeur du document sélectionné s'il y en a un  
		// Test le résultat
		if (empty($ligne['idDocument']))
			{
				// ajout du document
				$req = $db->prepare('INSERT INTO tbldocument (idActivite,dateCreation,nomDoc,descriptDoc,filename)
					VALUES (:idActivite,:dateCreation,:nomDoc,:descriptDoc,:filename)');
				$req->execute(array(
				'idActivite'=>$idActivite,
				'dateCreation'=>$dateCreation,
				'nomDoc'=>$nomDoc,
				'descriptDoc'=>$descriptDoc,
				'filename'=>$filename,
				));
			return true;
			}
		else
		{  
			throw new Exception("Le document ne peut pas être ajouté car il existe déjà.");
      //return false;    
		}
  }
  catch (Exception $e)
  {
    $_SESSION['erreur']=$e->getMessage();
	require "vue/vue_document_add.php";
    //require "vue/vue_erreur.php";
  }
  //Fin Source : module 151
 }
  // -----------------------------
// ouvrirDoc($filename)
//Argument : Le nom de fichier du document
// Fonction : Vérifie que le document à télécharger/ouvrir fait bien partie de l'activité de l'utilisateur
//Sortie true si c'est bon.
function ouvrirDoc($filename)
{
	$db=getBD();
	try
	{
		$reqSelect ="SELECT * FROM tbldocument WHERE filename='".$filename."' AND idActivite='".$_SESSION['idActivite']."';";
		$res=$db->query($reqSelect);
		$ligne = $res->fetch(); // récupère la valeur du document sélectionné s'il y en a un  
		// Test le résultat
		if (isset($ligne['idDocument']))
		{
			
			return true;
		}
	}
	catch (Exception $e)
	{
		$_SESSION['erreur']=$e->getMessage();
		require "vue/vue_erreur.php";
	}
}
 // -----------------------------
// updDoc($postArray,$idDocument)
//Argument : Les informations passées en post et l'id du document
// Fonction : Mettre à jour les informations du document (nom et description). Attention : le nom du fichier ainsi que le document en lui-même ne peut pas être modifié
 function updDoc($postArray,$idDocument)
 {
	$db=getBD();
	$NNomDoc=$postArray["fNNomDoc"];
	$NDescriptDoc=$postArray["fNDescriptDoc"];
	try
	{
		champVide($NNomDoc,"nom du document");
		erreurXss1($NNomDoc);
		$NDescriptDoc=erreurText($NDescriptDoc);
		$reqSelect ="SELECT * FROM tbldocument WHERE nomDoc='".$NNomDoc."' AND idDocument!='".$idDocument."' AND idActivite='".$_SESSION['idActivite']."';";
		$res=$db->query($reqSelect);
		$ligne = $res->fetch(); // récupère la valeur du document sélectionné s'il y en a un  
		// Test le résultat
		if (empty($ligne['idDocument']))
			{
				// Modification du document
					$req = $db->prepare("update tbldocument set nomDoc=:nomDoc,descriptDoc=:descriptDoc
					WHERE idDocument='".$idDocument."' AND idActivite='".$_SESSION['idActivite']."';");
					$req->execute(array(
					'nomDoc'=>$NNomDoc,
					'descriptDoc'=>$NDescriptDoc,
				));
			$_SESSION['modif']="Le document a bien été mis à jour";
			return true;
			}
		else
		{  
			throw new Exception("<p>Le document ne peut pas être modifié car le nom existe déjà.</p>");
			//<a href='index.php?action=vue_document_gestion'> <button type='button' class='btn btn-primary'  ><strong>Revenir à la gestion des participantx</strong></button> </a> </p>
      //return false;    
		}
	}
	catch (Exception $e)
	{
		$_SESSION['erreur']=$e->getMessage();
		//require "vue/vue_erreur.php";
	}
 }
 //Source : cette fonction est tiré du site web suivant : https://openclassrooms.com/forum/sujet/supprimer-un-dossier-et-tout-son-contenu-1
 function rrmdir($dir)
 {
   if (is_dir($dir)) {
     $objects = scandir($dir);
     foreach ($objects as $object) {
       if ($object != "." && $object != "..") {
         if (filetype($dir."/".$object) == "dir") rmdir($dir."/".$object); else unlink($dir."/".$object);
       }
     }
     reset($objects);
     @rmdir($dir);//Ne fonctionne pas
   }
 }
// -----------------------------
// delDoc($idDocument)
// Fonction : Permet de supprimer un document
//Argument : L'id du document à supprimer
 function delDoc($idDocument)
 {	
	try
	{
		$db=getBD();
		$filename=getFilenameDoc($idDocument);
		$requete = 'DELETE FROM tbldocument WHERE idDocument ="'.$idDocument.'" AND idActivite="'.$_SESSION["idActivite"].'";';
		//Source : https://openclassrooms.com/courses/supprimer-des-fichiers-sur-le-serveur-grace-a-php
		unlink ("contenu/documents/".$_SESSION['idActivite']."/".$filename);
		
		$db->exec($requete);
	}
	 catch (Exception $e)
		{
				trigger_error($e->getMessage(), E_USER_ERROR);
		}
 }
 ?>