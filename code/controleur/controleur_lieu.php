<?php
//Fonctions li�es aux lieux
function lieuGestion()
{
    isConnected();
    $resultats = listeLieu();
    require "vue/vue_lieu_gestion.php";

}

function afficherLieu()
{
    isConnected();
    if (isset($_GET['qIdLieu'])) {
        $infoLieu = infoLieu($_GET['qIdLieu']);
        require "vue/vue_lieu.php";
        exit();
    }
    //R�cup�r les donn�es dvia le mod�le
    require "vue/vue_lieu_gestion.php";
}

function updateLieu()
{

    isConnected();
    $infoLieu = infoLieu($_GET['qIdLieu']);//R�cup�r les donn�es du lieu via le mod�le
    //Variable post existe si l'utilisateur a cliqu� sur le bouton modifer de l'activit�
    if (isset($_POST['fUpdLieu2']) AND isset($_GET['qIdLieu']))//Variable post existe si l'utilisateur a cliqu� sur le bouton modifer de son profil
    {
        updLieu($_POST, $_GET['qIdLieu']);
        @header("location: index.php?action=vue_lieu&qIdLieu=" . $_GET['qIdLieu']);//redirection ves la page de confirmation de modification
        exit;
    }
    require "vue/vue_lieu_upd.php";
}

function addLieu()
{
    isConnected();
    if (isset($_POST['fAddLieu'])) //Variable post existe si l'utilisateur a cliqu� sur le bouton modifer de son profil
    {
        $ajout = ajoutLieu($_POST);
        if ($ajout == true) {
            @header("location: index.php?action=vue_lieu_gestion");//redirection ves la page de confirmation de modification
        }
        exit;
    }
    require "vue/vue_lieu_add.php";

}

function deleteLieu()
{
    isConnected();
    if (isset($_GET['qIdLieu'])) //Variable post existe si l'utilisateur a cliqu� sur le bouton modifer de son profil
    {
        delLieu($_GET['qIdLieu']);
        @header("location: index.php?action=vue_lieu_gestion");//redirection ves la page de confirmation de modification
        exit;
    }
    require "vue/vue_lieu_gestion.php";
}

?>
