<?php
//Fonctions li�es au planning
function gestionPlanning()
{
    isConnected();
    $resultats = listePlanning();
    require "vue/vue_planning_gestion.php";

}

function addPlanning()
{
    isConnected();
    if (isset($_POST['fAddPlanning'])) //Variable post existe si l'utilisateur a cliqu� sur le bouton modifer de son profil
    {
        $ajout = ajoutPlanning($_POST);
        if ($ajout == true) {
            @header("location: index.php?action=vue_planning_gestion");//redirection ves la page de confirmation de modification
        }
        exit;
    }
    require "vue/vue_planning_add.php";
}

function updatePlanning()
{

    isConnected();
    erreurUrl($_GET['qIdPlanning']);//v�rifie l'url du planning s�lectionn�
    $infoPlanning = infoPlanning($_GET['qIdPlanning']);//R�cup�r les donn�es du planning via le mod�le
    //Variable post existe si l'utilisateur a cliqu� sur le bouton modifer du planning
    if (isset($_POST['fUpdPlanning2']) AND isset($_GET['qIdPlanning']))//Variable post existe si l'utilisateur a cliqu� sur le bouton modifer du planning
    {
        $modif = updPlanning($_POST, $_GET['qIdPlanning']);
        if ($modif == true) {
            unset($_SESSION['nomPlanning']);
            unset($_SESSION['idPlanning']);
            @header("location: index.php?action=vue_planning_gestion");//redirection ves la page de confirmation de modification
            exit;
        } else {
            @header("location: index.php?action=vue_planning_upd&qIdPlanning=" . $_GET['qIdPlanning']);
            exit;
        }
    }
    if ($infoPlanning != "") {
        require "vue/vue_planning_upd.php";
    }

}

function deletePlanning()
{
    isConnected();
    if (isset($_GET['qIdPlanning'])) //Variable post existe si l'utilisateur a cliqu� sur le bouton modifer de son profil
    {
        //D�struction des variables de sessions pour �viter qu'elles contiennent des informations sur un planning inexistant.
        unset($_SESSION['nomPlanning']);
        unset($_SESSION['idPlanning']);
        delPlanning($_GET['qIdPlanning']);//suppression du planning
        @header("location: index.php?action=vue_planning_gestion");//redirection ves la page de confirmation de modification
        exit;
    }
    require "vue/vue_planning_gestion.php";
}

function addLignePlanning()
{
    isConnected();
    $resultats = listePlanning();
    if (isset($_POST['fSPlanning']))//Si un planning est s�lectionn�
    {
        $_SESSION['nomPlanning'] = $_POST['fSPlanning'];
    }
    if (isset($_SESSION['nomPlanning']))//Si la variable de session contenant le nom du planning existe
    {
        if (isset($_POST['fSPlanning'])) {
            $_SESSION['nomPlanning'] = $_POST['fSPlanning'];
        }
        $idPlanning = getIdPlanning($_SESSION['nomPlanning']);//obtenir l'id du planning
        $_SESSION['idPlanning'] = $idPlanning;
        $ligne = listeLignePlanning($idPlanning);
    }
    //Si la variable de session contenant le nom du planning existe
    if (isset($_SESSION['nomPlanning']) && isset($_POST['fAddLignePlanning'])) {

        $idPlanning = getIdPlanning($_SESSION['nomPlanning']);
        $ajout = ajoutLignePlanning($idPlanning, $_POST);
        if ($ajout == true) {
            @header("location: index.php?action=vue_planning_ligne");//header pour que les informations se mettent � jour
        } else {
            @header("location: index.php?action=vue_planning_ligne");
            exit(); //Si on enl�ve le exit, le require plus-bas fait que l'erreur s'affiche en haut de la page.
        }
    }
    require "vue/vue_planning_ligne.php";
}

function updateLignePlanning()
{

    isConnected();
    $infoLignePlanning = infoLignePlanning($_GET['qIdLignePlanning']);//R�cup�r les donn�es de la ligne via le mod�le
    //Variable post existe si l'utilisateur a cliqu� sur le bouton modifer de l'activit�
    if (isset($_POST['fUpdLignePlanning2']) AND isset($_GET['qIdLignePlanning']))//Variable post existe si l'utilisateur a cliqu� sur le bouton modifer de son profil
    {
        updLignePlanning($_POST, $_GET['qIdLignePlanning']);
        @header("location: index.php?action=vue_planning_ligne");//redirection ves la page de confirmation de modification
        exit;
    }
    if ($infoLignePlanning != "") {
        require "vue/vue_planning_ligne_upd.php";
    }
}

function deleteLignePlanning()
{
    isConnected();
    if (isset($_GET['qIdLignePlanning'])) //Variable post existe si l'utilisateur a cliqu� sur le bouton modifer de son profil
    {
        delLignePlanning($_GET['qIdLignePlanning']);
        @header("location: index.php?action=vue_planning_ligne");//redirection ves la page de confirmation de modification
        exit;
    }
    require "vue/vue_planning_ligne.php";
}

?>
