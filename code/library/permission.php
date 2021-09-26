<?php
//Fonction qui vérifie la connection
function isConnected()
{
    //L'utilisateur est connecté
    if (empty($_SESSION['login'])) {
        require "vue/vue_visiteur.php";
        exit;
    }
    //L'utilisateur est connecté mais il n'a pas choisi d'activité
    if (isset($_SESSION['login']) && empty($_SESSION['idActivite'])) {
        header("location: index.php?action=vue_activite_gestion");
        exit;
    }
    //L'utilisateur est connecté et il a choisi une activité
    if (isset($_SESSION['login']) && isset($_SESSION['idActivite'])) {
        return true;
    }
}

//Cette fonction s'ccupe de vérifier si l'utilisateur est connecté
//POur le profil
function testConnected()
{
    if (empty($_SESSION['login'])) {
        require "vue/vue_visiteur.php";
        return false;
        exit();
    } else {
        return true;
    }
}

//Cette fonction vérifie si l'utilisateur a un grande équivalent a 1 (super-administrateur).
function testR1()
{
    if (isset($_SESSION['idRole']) && $_SESSION['idRole'] == 1) {
        return true;
    }

    return false;
}

//Cette fonction vérifie si l'utilisateur a un idRole équivalent a 1 ou 2 (administrateur)
function testR2()
{
    if (isset($_SESSION['idRole'])) {
        if ($_SESSION['idRole'] == 2 || $_SESSION['idRole'] == 1) {
            return true;
        }
    }

    return false;
}

//Cette fonction vérifie si l'utilisateur a un idRole équivalent a 2. Utilisé pour ajouter d'autres utilisateurs à l'activité
function testR2B()
{
    if (isset($_SESSION['idRole'])) {
        if ($_SESSION['idRole'] == 2) {
            return true;
        }
    }

    return false;
}

//Cette fonction vérifie si l'utilisateur a un idRole équivalent a 1,2 ou 3 (super-staff)
function testR3()
{
    if (isset($_SESSION['idRole'])) {
        if (isset($_SESSION['idRole']) && $_SESSION['idRole'] == 3 || $_SESSION['idRole'] == 2 || $_SESSION['idRole'] == 1) {
            return true;
        }
    }
    return false;
}

//Cette fonction vérifie si l'utilisateur a un idRole équivalent a 1,2,3 ou 4 (staff)
function testR4()
{
    if (isset($_SESSION['idRole'])) {
        if (isset($_SESSION['idRole']) && $_SESSION['idRole'] == 4 || $_SESSION['idRole'] == 3 || $_SESSION['idRole'] == 2 || $_SESSION['idRole'] == 1) {
            return true;
        }
    }
    return false;
}

?>
