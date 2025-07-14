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

function getMembre($id_membre){
    $sql = "SELECT * FROM v_membre WHERE id_membre = %d";
    $sql = sprintf($sql, $id_membre);
    $result = tab($sql);

    if (empty($result)) {
        return false;
    }
    return $result[0];
}


function creer_objet($id_membre, $nom_objet, $id_categorie) {
    $db = dbconnect();
    $nom = $nom_objet;
    $sql = "INSERT INTO objets_objet (nom_objet, id_categorie, id_membre) VALUES ('$nom', $id_categorie, $id_membre)";
    if (mysqli_query($db, $sql)) {
        return mysqli_insert_id($db);
    }
    return false;
}

function enregistrer_images_objet($id_objet, $files) {
    $db = dbconnect();
    $uploads_dir = __DIR__ . '/uploads/';
    $count = 0;

    foreach ($files['name'] as $i => $originalName) {
        if ($files['error'][$i] === UPLOAD_ERR_OK) {
            $ext = pathinfo($originalName, PATHINFO_EXTENSION);
            $newName = uniqid("obj_{$id_objet}_") . '.' . $ext;
            if (move_uploaded_file($files['tmp_name'][$i], $uploads_dir . $newName)) {
                $is_princ = ($count === 0) ? 1 : 0;
                $esc = mysqli_real_escape_string($db, $newName);
                $sql = "INSERT INTO objets_images_objet (id_objet, nom_image) VALUES ($id_objet, '$esc')";
                mysqli_query($db, $sql);
                $count++;
            }
        }
    }
    return $count;
}


function get_images_objet(int $id_objet): array
{
    $sql = "
        SELECT nom_image
        FROM objets_images_objet
        WHERE id_objet = $id_objet
    ";
    
    $rows = tab($sql);
    return tab($sql);
}

function emprenter($id_objet, $id_membre, $date_retour)
{
    $db = dbconnect();
    $sql = "
        INSERT INTO objets_emprunt
            (id_objet, id_membre, date_emprunt, date_retour)
        VALUES
            ($id_objet, $id_membre, now(), $date_retour)
    ";

    if (mysqli_query($db, $sql)) {
        return mysqli_insert_id($db);
    }

    return false;
}

