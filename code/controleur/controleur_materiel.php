<?php
//Fonction liées à la gestion de matériel
function gestionListeMat()
{
    isConnected();
    $resultats = listeMat();
    require "vue/vue_materiel_gestion.php";

}

function updateListeMat()
{

    isConnected();
    $infoListeMat = infoListeMat($_GET['qIdListeMateriel']);//Récupère les données de l'activité via le modèle
    //Variable post existe si l'utilisateur a cliqué sur le bouton modifer de l'activité
    if (isset($_POST['fUpdListeMat2']) AND isset($_GET['qIdListeMateriel']))
        //Variable post existe si l'utilisateur a cliqué sur le bouton modifer de son profil
    {
        $modif = updListeMat($_POST, $_GET['qIdListeMateriel']);
        if ($modif == true) {
            unset($_SESSION['nomListeMat']);
            unset($_SESSION['idListeMat']);
            @header("location: index.php?action=vue_materiel_gestion&qIdListeMateriel=" . $_GET['qIdListeMateriel']);
            //redirection ves la page de confirmation de modification
            exit;
        } else {
            @header("location: index.php?action=vue_materiel_upd&qIdListeMateriel=" . $_GET['qIdListeMateriel']);
            exit;
        }
    }
    if ($infoListeMat != "") {
        require "vue/vue_materiel_upd.php";
    }
}

function addListeMat()
{
    isConnected();
    if (isset($_POST['fAddListeMat'])) //Variable post existe si l'utilisateur a cliqué sur le bouton modifer de son profil
    {
        $ajout = ajoutListeMat($_POST);
        if ($ajout == true) {
            @header("location: index.php?action=vue_materiel_gestion");//redirection ves la page de confirmation de modification
        }
        exit;
    }
    require "vue/vue_materiel_add.php";
}

function deleteListeMat()
{
    isConnected();
    if (isset($_GET['qIdListeMateriel'])) //Variable post existe si l'utilisateur a cliqué sur le bouton modifer de son profil
    {
        //Destruction des variables de sessions pour éviter qu'elles contiennent des informations sur un planning inexistant.
        unset($_SESSION['nomListeMat']);
        unset($_SESSION['idListeMat']);
        delListeMat($_GET['qIdListeMateriel']);//suppression du planning
        @header("location: index.php?action=vue_materiel_gestion");//redirection ves la page de confirmation de modification
        exit;
    }
    require "vue/vue_materiel_gestion.php";
}

function addLigneMat()
{
    isConnected();
    $resultats = listeMat();
    if (isset($_POST['fSListeMat'])) {
        $_SESSION['nomListeMat'] = $_POST['fSListeMat'];
    }
    if (isset($_SESSION['nomListeMat'])) {
        if (isset($_POST['fSMat'])) {
            $_SESSION['nomListeMat'] = $_POST['fSListeMat'];
        }
        $idListeMateriel = getIdListeMat($_SESSION['nomListeMat']);
        $_SESSION['idListeMateriel'] = $idListeMateriel;
        $ligne = listeLigneMat($idListeMateriel);
    }
    if (isset($_SESSION['nomListeMat']) && isset($_POST['fAddLigneMat'])) {

        $idListeMateriel = getIdListeMat($_SESSION['nomListeMat']);
        $ajout = ajoutLigneMat($idListeMateriel, $_POST);
        if ($ajout == true) {
            @header("location: index.php?action=vue_materiel_ligne");
        } else {
            @header("location: index.php?action=vue_materiel_ligne");
            exit();
        }
    }
    require "vue/vue_materiel_ligne.php";
}

function updateLigneMat()
{

    isConnected();
    $infoLigneMat = infoLigneMat($_GET['qIdLigneMateriel']);//Récupère les données de l'activité via le modèle
    //Variable post existe si l'utilisateur a cliqué sur le bouton modifer de l'activité
    if (isset($_POST['fUpdLigneMat2']) AND isset($_GET['qIdLigneMateriel']))
        //Variable post existe si l'utilisateur a cliqué sur le bouton modifer de son profil
    {
        updLigneMat($_GET['qIdLigneMateriel'], $_POST);
        @header("location: index.php?action=vue_materiel_ligne");//redirection ves la page de confirmation de modification
        exit;
    }
    if ($infoLigneMat != "") {
        require "vue/vue_materiel_ligne_upd.php";
    }
}

function deleteLigneMat()
{
    isConnected();
    if (isset($_GET['qIdLigneMateriel'])) //Variable post existe si l'utilisateur a cliqué sur le bouton modifer de son profil
    {
        delLigneMat($_GET['qIdLigneMateriel']);
        @header("location: index.php?action=vue_materiel_ligne");//redirection ves la page de confirmation de modification
        exit;
    }
    require "vue/vue_materiel_ligne.php";
}

?>
