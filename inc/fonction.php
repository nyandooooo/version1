<?php
require 'co.php';
function connecter($email, $mot_de_passe)
{
    $sql = "SELECT idMembre FROM Membre WHERE Email like '%s' and  Motdepasse like '%s'";
    $sql  = sprintf($sql, $email, $mot_de_passe);
    $connecter = mysqli_query(dbconnect(), $sql);
    if (mysqli_num_rows($connecter) > 0) {
        $compte = mysqli_fetch_assoc($connecter);
        return $compte["idMembre"];
    } else return -1;
}

function inscrire($email, $nom, $date_naissance, $genre, $ville, $mot_de_passe, $mot_de_passe1)
{
    if ($mot_de_passe != $mot_de_passe1) {
        return -3; 
    }
 
    $sql = "SELECT id_membre FROM objets_membre WHERE email = '%s'";
    $sql = sprintf($sql, $email);
    $result = mysqli_query(dbconnect(), $sql);

    if (mysqli_num_rows($result) > 0) {
        return -2; 
    }
    $sql = "INSERT INTO objets_membre (email, nom, date_naissance,genre,  ville , mdp) VALUES ('%s', '%s', '%s', '%s', '%s', '%s')";
    $sql = sprintf($sql, $email, $nom, $date_naissance, $genre, $ville, $mot_de_passe);
    if (mysqli_query(dbconnect(), $sql)) {
        return mysqli_insert_id(dbconnect());
    } else {
        return -1;
    }
}

function login($email, $mot_de_passe)
{
    $sql = "SELECT id_membre FROM objets_membre WHERE email = '%s' AND mdp = '%s'";
    $sql = sprintf($sql, $email, $mot_de_passe);
    $result = mysqli_query(dbconnect(), $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['id_membre'];
    } else {
        return -1; 
    }
}

