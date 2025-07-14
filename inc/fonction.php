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
function tab($sql)
{
    $membre_req = mysqli_query(dbconnect(), $sql);
    $result = [];
    while ($membre = mysqli_fetch_assoc($membre_req)) {
        $result[] = $membre;
    }

    return $result;
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



function get_objets_encours()
{
    $sql = "SELECT * FROM v_objets
    join objets_membre on v_objets.id_membre = objets_membre.id_membre";
    $result = tab($sql);

    if (empty($result)) {
        return false;
    }
    return $result;
}

function get_objets_notencours()
{
    $sql = "SELECT * FROM v_objets
    join objets_membre on v_objets.id_membre = objets_membre.id_membre
    where id_objet not in (select id_objet from objets_emprunt)";
    $result = tab($sql);

    if (empty($result)) {
        return false;
    }
    return $result;
}

function filtrecategorie($id_categorie)
{
    $sql = "SELECT * FROM v_objets
            WHERE id_categorie = $id_categorie";
    $result = tab($sql);

    if (empty($result)) {
        return false;
    }
    return $result;
}

function get_categories()
{
    $sql = "SELECT * FROM objets_categorie_objet";
    $result = tab($sql);

    if (empty($result)) {
        return false;
    }
    return $result;
}
