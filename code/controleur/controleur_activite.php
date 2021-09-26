<?php
// ------------ Activité ---------------------
//Fonctions liées aux activités

// -----------------------------
//Pour afficher les activit�s d'un utilisateur
function activiteGestion()
{
    if (isset($_SESSION['idUser']))//Si l'utilisateur est connecté
    {
        $resultats = getActivite($_SESSION['idUser']);//Récupère les activités de l'utilisateur
        require "vue/vue_activite_gestion.php";
    } else //Si l'utilisateur n'est pas connecté
    {
        require "vue/vue_visiteur.php";
    }
}

function addActivite()
{
    if (isset($_POST['fNomAct'])) {
        $resultats = ajoutActivite($_POST);// Envoi des données du POST vers le modèle
        if (isset($_SESSION['nomAct'])) {
            $_SESSION["idRole"] = getIdRole($_SESSION['idUser'], $_SESSION["idActivite"]);
            $_SESSION["nomRole"] = getNomRole($_SESSION["idRole"]);
        }

        if ($resultats) {
            header("location: index.php?action=vue_accueil");
        }
    } else {
        require "vue/vue_activite_add.php";
    }
}

// ------------ Comptes ---------------------
function updateActivite()
{

    isConnected();
    $infoAct = infoActivite();//Récupèr les données de l'activité via le modèle
    //Variable post existe si l'utilisateur a cliqué sur le bouton modifer de l'activité
    if (isset($_POST['fUpdAct2'])) //Variable post existe si l'utilisateur a cliqué sur le bouton modifer de son profil
    {
        $ajout = updActivite($_POST);
        if ($ajout == true) {
            @header("location: index.php?action=vue_activite");//redirection ves la page de confirmation de modification
            exit();
        } else {
            @header("location: index.php?action=vue_activite_upd");
            exit;
        }
        //Pas besoin de redirection pour afficher les erreurs
    }
    require "vue/vue_activite_upd.php";
}

function afficherActivite()
{
    isConnected();
    $infoAct = infoActivite();//Récupèr les données de l'activité via le modèle
    //Variable post existe si l'utilisateur a cliqué sur le bouton modifer de l'activité
    require "vue/vue_activite.php";
}

// -----------------------------
// delListeMat(($idListeMateriel)
// Fonction : Permet de supprimer un planning
//Argument : L'id du planning à supprimer
function deleteActivite()
{
    isConnected();
    IF (isset($_POST['delAct']) AND isset($_SESSION['idActivite'])) {
        delActivite($_SESSION['idActivite']);
        unset($_SESSION['idActivite']);
        unset($_SESSION['nomAct']);
        unset($_SESSION['nomPlanning']);
        unset($_SESSION['idPlanning']);
        unset($_SESSION['nomListeMat']);
        unset($_SESSION['idListeMateriel']);
    }
    require "vue/vue_activite_del.php";
}

?>
