<?php

//Démarrer session
session_start();

//Connexion à la base de données
function dbConnect(){
    try{
        $db = new PDO('mysql:host=localhost;dbname=gestStocks;charset=utf8', 'djibril', 'tamou');
        return $db;
    }catch(Exception $e){
        die('Erreur : '.$e->getMessage());
    }
}

//Récupérer tout
function getAll(){
    $db = dbConnect();

    $req = $db->query('CALL lireProduits()');
    return $req;
}

//Récupérer tout
function getAllCategories(){
    $db = dbConnect();

    $req = $db->query('CALL lireCategories()');
    return $req;
}

//Récupérer en fction de l'id
function getInfoById($id){
    $db = dbConnect();

    $req = $db->prepare('CALL recupererProduit(:id)');
    $req->execute(array(':id' => $id));
    return $req;
}

//Réchercher en fction de la designation
function search($q){
    $db = dbConnect();

    $req = $db->prepare('CALL searchProduit(:q)');
    $req->execute(array(':q' => '%' . $q . '%'));
    return $req;
}

//Récupérer les details d'un produit
function details($id){
    $db = dbConnect();

    $req = $db->prepare('CALL detailProduit(?)');
    $req->execute(array($id));
    return $req;
}

//Récupérer les produits d'une catégorie donnée
function checkProduits($id){
    $db = dbConnect();

    $req = $db->prepare('CALL recupererProduitsDeCategorie(?)');
    $req->execute(array($id));
    return $req;
}

//Ajouter à db
function add($designe){
    $db = dbConnect();

    $req = $db->prepare('CALL ajouterProduit(?)');
    
    if($req->execute(array($designe)))
        return true;
    else
        return false;
}

//Ajouter à db
function addEntre($quantite, $designe){
    $db = dbConnect();

    $req = $db->prepare('CALL ajouterEntre(?,?)');

    if($req->execute(array($quantite, $designe)))
        return true;
    else
        return false;
}

//Ajouter à db
function addSortie($quantite, $designe){
    $db = dbConnect();

    $req = $db->prepare('CALL ajouterSortie(?,?)');

    if($req->execute(array($quantite, $designe)))
        return true;
    else
        return false;
}

//Compter le nombre
function countNbre() {
    $db = dbConnect();

    $stmt = $db->query('SELECT COUNT(*) AS nbr_total FROM oeuvre');
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['nbr_total'];
}

//Mouvement de l'infos
function mouvement($designe, $mv_Qt){
    $db = dbConnect();

    $req = $db->prepare('CALL moveProduit(?,?)');

    if($req->execute(array($designe, $mv_Qt)))
        return true;
    else
        return false;
}

//Modifier l'infos
function update($id, $designe){
    $db = dbConnect();

    $req = $db->prepare('CALL modifierProduit(?,?)');

    if($req->execute(array($id, $designe)))
        return true;
    else
        return false;
}

//Supprimer l'nfos
function delete($id){
    $db = dbConnect();

    $req = $db->prepare('CALL supprimerProduit(?)');

    if($req->execute(array($id)))
        return true;
    else
        return false;
}

/* CREATION D'UNE PROCEDURE

    DELIMITER //
    CREATE PROCEDURE recupererProduit(IN p_id int)
    BEGIN
      SELECT * FROM produits
      WHERE id = p_id; 
    END //
    DELIMITER // ou ;

    DELIMITER //
    CREATE PROCEDURE ajouterCategorie(IN p_libelle varchar(50))
    BEGIN
        INSERT INTO categorie VALUES(NULL, p_libelle);
    END //
    DELIMITER ;

*/