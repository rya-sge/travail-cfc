<?php
// ------------------------------
// listeLieu()
// Fonction : Récupérer l'ensemble des lieux d'une activité
//Sortie lieux : contient les lieux de l'activité
  function listeLieu()
 {
	 $db = getBD();
	// Création de la string pour la requête
	$requete = "SELECT * FROM tbllieu where idActivite='".$_SESSION["idActivite"]."' order by nomLieu;";
	// Exécution de la requete
	$lieux = $db->query($requete);
	return $lieux;
 }
 // -----------------------------
// infoLieu($idLieu)
//Argument : id du lieu
 //Récupère les données d'un lieu en particulier
function infoLieu($idLieu) 
{
	erreurUrl($idLieu);
	$db = getBD();
	// Création de la string pour la requête
	$requete = "SELECT * FROM tbllieu where idLieu='".$idLieu."' AND idActivite='".$_SESSION['idActivite']."';";
	// Exécution de la requete
	$resultats = $db->query($requete);
	$lieu=$resultats->fetch();
	return $lieu;
 }
  // -----------------------------
// ajoutLieu($postArray)
//Argument : les informations passées en POST
// Fonction : Ajouter un lieu
  function ajoutLieu($postArray)
{
	$db=getBD();
	$nomLieu=$postArray ["fNomLieu"];
	$descriptLieu=$postArray ["fDescriptLieu"];
	$carteUrl=$postArray ["fCarteUrl"];
	$carteEmbed=$postArray ["fCarteEmbed"];
	$NPA=$postArray ["fNPA"];
	$localite=$postArray ["fLocalite"];
	$coordonnee=$postArray ["fCoordonnee"]; 
	$dateCreation=date('Y-m-d H:i:s'); //Src : http://www.pontikis.net/tip/?id=18
	$idActivite=$_SESSION['idActivite'];
	try
	{	
		//Récupération des données passées en post
		$carteEmbed=replaceBalise($carteEmbed);
		$carteUrl=replaceChevron($carteUrl);
		
		erreurXss1($nomLieu);//test erreur
		$descriptLieu=erreurText($descriptLieu);
		$coordonnee=erreurText($coordonnee);
		erreurXss1($NPA);
		erreurXss1($localite);
		champVide($nomLieu,"Nom du lieu");
		lengthChamp($nomLieu,"Nom du lieu",32);
		//Début Source : module 151--le test de la partie doublon
		// test si le nom du lieu existe déjà pour éviter les doublons sur des lieux au sein d'une même activité
		$reqSelect ="SELECT * FROM tbllieu WHERE nomLieu='".$nomLieu."' AND idActivite='".$idActivite."';";
		$res=$db->query($reqSelect);
		$ligne = $res->fetch(); // récupère la valeur de l'activité sélectionnée s'il y en a un  
		// Test le résultat
		if (empty($ligne['idLieu']))
			{
				// ajout de l'activité
				$req = $db->prepare('INSERT INTO tbllieu (idActivite,nomLieu,descriptLieu,NPA,localite,coordonnee,carteUrl,carteEmbed,dateCreation)
					VALUES (:idActivite,:nomLieu, :descriptLieu,:NPA,:localite,:coordonnee, :carteUrl, :carteEmbed,:dateCreation )');
				$req->execute(array(
				'idActivite'=>$idActivite,
				'nomLieu' => $nomLieu,
				'descriptLieu' => $descriptLieu,
				'NPA' => $NPA,
				'localite' => $localite,
				'coordonnee' => $coordonnee,
				'carteUrl'=>$carteUrl,
				'carteEmbed'=>$carteEmbed,
				'dateCreation'=>$dateCreation,
				));
			$_SESSION['modif']="Le lieu a bien été ajouté";
			return true;
			}
		else
		{  
			throw new Exception("Le Lieu ne peut pas être ajouté car il existe déjà.");
      //return false;    
		}
  }
  catch (Exception $e)
  {
    $_SESSION['erreur']=$e->getMessage();
    //require "vue/vue_erreur.php";
	require "vue/vue_lieu_add.php";
  }
  //Fin Source : module 151
 }
 // updLieu($postArray,$idLieu)
// Fonction : Mettre à jour un lieu 
//Argument : les informations sur le lieu passées en POST, ainsi que l'id du lieu
 function updLieu($postArray,$idLieu)
 {
	 $db=getBD();
	$NNomLieu=$postArray ["fNNomLieu"];
	$NDescriptLieu=$postArray ["fNDescriptLieu"];
	$NNPA=$postArray ["fNNPA"];
	$NLocalite=$postArray ["fNLocalite"];
	$NCoordonnee=$postArray ["fNCoordonnee"];
	$NCarteUrl=$postArray ["fNCarteUrl"];
	$NCarteEmbed=$postArray ["fNCarteEmbed"];
	try
	{
		erreurXss1($NNomLieu);
		$NDescriptLieu=erreurText($NDescriptLieu);
		erreurXss1($NNPA);
		erreurXss1($NLocalite);
		$NCoordonnee=erreurText($NCoordonnee);
		champVide($NNomLieu,"nom du lieu");
		lengthChamp($NNomLieu,"Nom du lieu",32);
		
		$NCarteEmbed=replaceBalise($NCarteEmbed);
		$NCarteUrl=replaceChevron($NCarteUrl);
		$reqSelect ="SELECT * FROM tbllieu WHERE nomLieu='".$NNomLieu."' AND idLieu!='".$idLieu."' AND idActivite='".$_SESSION['idActivite']."';";
		$res=$db->query($reqSelect);
		$ligne = $res->fetch(); // récupère la valeur du projet sélectionné s'il y en a un  
		// Test le ràsultat
		if (empty($ligne['idLieu']))
			{
				// Modification de l'activité
					$req = $db->prepare("update tbllieu set nomLieu=:nomLieu,descriptLieu=:descriptLieu,NPA=:NPA,localite=:localite,coordonnee=:coordonnee, carteUrl=:carteUrl, carteEmbed=:carteEmbed 
					WHERE idLieu='".$idLieu."' AND idActivite='".$_SESSION['idActivite']."';");
					$req->execute(array(
					'nomLieu' => $NNomLieu,
					'descriptLieu' => $NDescriptLieu,
					'NPA' => $NNPA,
					'localite' => $NLocalite,
					'coordonnee' => $NCoordonnee,
					'carteUrl'=>$NCarteUrl,
					'carteEmbed'=>$NCarteEmbed,
				
				));
			$_SESSION['modif']="Le lieu a bien été mis à jour";
			return true;
			}
		else
		{  
			throw new Exception("<p>Le lieu ne peut pas être modifié car le nom existe déjà.</p><a href='index.php?action=vue_lieu_gestion'> 
			<button type='button' class='btn btn-primary'  ><strong>Revenir à la gestion des lieux</strong></button> </a> </p>");
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
// delLieu($idLieu)
// Fonction : Permet de supprimer un lieu
//Argument : L'id du lieu à supprimer
 function delLieu($idLieu)
 {	
	erreurUrl($idLieu);
	try
	{
		$db=getBD();
		$requete = 'DELETE FROM tbllieu WHERE idLieu ="'.$idLieu.'" AND idActivite="'.$_SESSION["idActivite"].'";';
		$db->exec($requete);
	}
	
	 catch (Exception $e)
		{
				trigger_error($e->getMessage(), E_USER_ERROR);
		}
 }
 ?>