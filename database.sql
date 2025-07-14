-- Création des tables

create database objets;
use objets;

CREATE TABLE objets_membre (
    id_membre  int PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    date_naissance DATE,
    genre VARCHAR(10),
    email VARCHAR(100) UNIQUE,
    ville VARCHAR(100),
    mdp VARCHAR(100),
    image_profil VARCHAR(255)
);

CREATE TABLE objets_categorie_objet (
    id_categorie int PRIMARY KEY AUTO_INCREMENT,
    nom_categorie VARCHAR(50) NOT NULL
);

CREATE TABLE  objets_objet (
    id_objet int PRIMARY KEY AUTO_INCREMENT,
    nom_objet VARCHAR(100) NOT NULL,
    id_categorie int,
    id_membre int
);

CREATE TABLE objets_images_objet (
    id_image int PRIMARY KEY AUTO_INCREMENT,
    id_objet int,
    nom_image VARCHAR(255) NOT NULL
);

CREATE TABLE objets_emprunt (
    id_emprunt int PRIMARY KEY AUTO_INCREMENT,
    id_objet int,
    id_membre int,
    date_emprunt DATE NOT NULL,
    date_retour DATE
);




INSERT INTO objets_membre (nom, date_naissance, genre, email, ville, mdp, image_profil) VALUES
('Alice',   '1985-02-10', 'F', 'alice@example.com',   'Paris',     'password1', 'alice.jpg'),
('Bob',     '1990-07-23', 'M', 'bob@example.com',     'Lyon',      'password2', 'bob.jpg'),
('Charlie', '1988-11-05', 'M', 'charlie@example.com', 'Marseille', 'password3', 'charlie.jpg'),
('Diana',   '1992-04-17', 'F', 'diana@example.com',   'Toulouse',  'password4', 'diana.jpg');

-- Catégories
INSERT INTO objets_categorie_objet (nom_categorie) VALUES
('esthétique'),
('bricolage'),
('mécanique'),
('cuisine');


-- Membre 1 (Alice)
INSERT INTO objets_objet (nom_objet, id_categorie, id_membre) VALUES
('Obj_M1_Cat1_1', 1, 1), ('Obj_M1_Cat1_2', 1, 1), ('Obj_M1_Cat1_3', 1, 1),
('Obj_M1_Cat2_1', 2, 1), ('Obj_M1_Cat2_2', 2, 1), ('Obj_M1_Cat2_3', 2, 1),
('Obj_M1_Cat3_1', 3, 1), ('Obj_M1_Cat3_2', 3, 1),
('Obj_M1_Cat4_1', 4, 1), ('Obj_M1_Cat4_2', 4, 1);

-- Membre 2 (Bob)
INSERT INTO objets_objet (nom_objet, id_categorie, id_membre) VALUES
('Obj_M2_Cat1_1', 1, 2), ('Obj_M2_Cat1_2', 1, 2), ('Obj_M2_Cat1_3', 1, 2),
('Obj_M2_Cat2_1', 2, 2), ('Obj_M2_Cat2_2', 2, 2), ('Obj_M2_Cat2_3', 2, 2),
('Obj_M2_Cat3_1', 3, 2), ('Obj_M2_Cat3_2', 3, 2),
('Obj_M2_Cat4_1', 4, 2), ('Obj_M2_Cat4_2', 4, 2);

-- Membre 3 (Charlie)
INSERT INTO objets_objet (nom_objet, id_categorie, id_membre) VALUES
('Obj_M3_Cat1_1', 1, 3), ('Obj_M3_Cat1_2', 1, 3), ('Obj_M3_Cat1_3', 1, 3),
('Obj_M3_Cat2_1', 2, 3), ('Obj_M3_Cat2_2', 2, 3), ('Obj_M3_Cat2_3', 2, 3),
('Obj_M3_Cat3_1', 3, 3), ('Obj_M3_Cat3_2', 3, 3),
('Obj_M3_Cat4_1', 4, 3), ('Obj_M3_Cat4_2', 4, 3);

-- Membre 4 (Diana)
INSERT INTO objets_objet (nom_objet, id_categorie, id_membre) VALUES
('Obj_M4_Cat1_1', 1, 4), ('Obj_M4_Cat1_2', 1, 4), ('Obj_M4_Cat1_3', 1, 4),
('Obj_M4_Cat2_1', 2, 4), ('Obj_M4_Cat2_2', 2, 4), ('Obj_M4_Cat2_3', 2, 4),
('Obj_M4_Cat3_1', 3, 4), ('Obj_M4_Cat3_2', 3, 4),
('Obj_M4_Cat4_1', 4, 4), ('Obj_M4_Cat4_2', 4, 4);

-- Images (une image par objet)
INSERT INTO images_objet (id_objet, nom_image)
SELECT id_objet, 'image_' || id_objet || '.jpg'
FROM objet;

-- Emprunts (10 entrées)
INSERT INTO objets_emprunt (id_emprunt, id_objet, id_membre, date_emprunt, date_retour) VALUES
(1,  1, 2, '2025-06-01', '2025-06-10'),
(2,  5, 3, '2025-06-05', '2025-06-12'),
(3, 10, 4, '2025-06-10', '2025-06-20'),
(4, 15, 1, '2025-06-12', '2025-06-18'),
(5, 20, 2, '2025-06-15', '2025-06-25'),
(6, 25, 3, '2025-06-18', '2025-06-28'),
(7, 30, 4, '2025-06-20', '2025-06-30'),
(8, 35, 1, '2025-06-22', '2025-07-02'),
(9, 40, 2, '2025-06-25', '2025-07-05'),
(10, 8, 4, '2025-07-01', '2025-07-10');

CREATE OR REPLACE VIEW v_objets AS
SELECT
  o.id_objet,
  o.nom_objet,
  o.id_categorie,
  o.id_membre,
  m.nom            AS nom_membre,
  (
    SELECT e.date_retour
    FROM objets_emprunt AS e
    WHERE e.id_objet   = o.id_objet
    LIMIT 1
  )                  AS date_retour
FROM objets_objet AS o
JOIN objets_membre AS m
  ON o.id_membre = m.id_membre
ORDER BY o.id_objet;



CREATE OR REPLACE VIEW objets_emprunt_en_cours AS
SELECT
  o.id_objet,
  o.nom_objet,
  e.date_retour
FROM objets_emprunt AS e
JOIN objets_objet AS o
  ON e.id_objet = o.id_objet
;


CREATE OR REPLACE VIEW v_membre AS
SELECT
  m.id_membre,
  m.nom,
  m.date_naissance,
  m.genre,
  m.email,
  m.ville,
  m.mdp,
  m.image_profil,
  COUNT(o.id_objet) AS nombre_objets
FROM objets_membre AS m
LEFT JOIN objets_objet AS o ON m.id_membre = o.id_membre
GROUP BY m.id_membre, m.nom, m.date_naissance, m.genre, m.email, m.ville, m.mdp, m.image_profil
ORDER BY m.id_membre;