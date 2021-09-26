<?php
//champ 1 = champ post modifié , champ 2 =champ post initial
function erreurXss1($champ1)
{
    $champ2 = $champ1;
    $champ1 = htmlspecialchars($champ1, ENT_QUOTES);
    //$champ1=addslashes($champ1);
    if ($champ1 != $champ2) {
        throw new Exception("Les chevrons, les guillemets/apostrophes ainsi que certains caractères spéciaux ne sont pas acceptés");
        $erreur = true;
        exit;
    }
}

//Fonction pour les champs contenant du text donc des apostrophes
function erreurText($champ1)
{
    $champ1 = htmlspecialchars($champ1, ENT_QUOTES);
    return $champ1;
}

//Fonction pour vérifier que l'url n'est pas modifié (requête sql)
function erreurUrl($champ1)
{
    $champ2 = $champ1;
    $champ1 = htmlspecialchars($champ1);
    $champ1 = addslashes($champ1);
    if ($champ1 != $champ2) {
        throw new Exception("L'url de l'objet sélectionné est invalide");
        $erreur = true;
        exit;
    }
}

//Fonction pour vérifier le mot de passe
function erreurPasswd($passwdConf, $passwdPost)
{
    $erreur = false;
    if ($passwdConf != $passwdPost) {
        throw new Exception("Les mots de passes ne correspondent pas");
        $erreur = true;
        return true;
    }
    if ($erreur == false) {
        $lengPasswd = strlen($passwdPost);
        if ($lengPasswd < 6) {
            throw new Exception("Le mot de passe est trop court. Il faut au moins 6 caractères");
            $erreur = true;
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function lengthChamp($champ, $nomChamp, $length)
{
    $erreur = false;
    $lengChamp = strlen($champ);
    if ($lengChamp >= $length) {
        throw new Exception("Le champ " . $nomChamp . " est trop long. Il faut le raccourcir");
        $erreur = true;
        exit;
    } else {
        return true;
    }
}

//fonction pour vérifier que le champ est rempli
function champVide($champ, $nomChamp)
{
    if ($champ == "") {
        throw new Exception("Le champ " . $nomChamp . " doit être rempli");
        exit;
    } else {
        return true;
    }
}

function verifEmail($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        throw new Exception("L'adresse email n'est pas valide");
        exit;
    }
}

function replaceBalise($carteEmbed)
{
    $carteEmbed = str_replace("<iframe", "", $carteEmbed);
    $carteEmbed = str_replace("></iframe>", "", $carteEmbed); //src : http://oseox.fr/php/chaine-caractere.html
    $carteEmbed = str_replace("<", "", $carteEmbed);
    return $carteEmbed;
}

function replaceChevron($carteUrl)
{
    $carteUrl = str_replace("<", "", $carteUrl);
    $carteUrl = str_replace("'", "", $carteUrl);
    return $carteUrl;
}

?>
