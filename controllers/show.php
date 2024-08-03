<?php
	require_once('../models/connexion.php');

    //recuperation produits avec ajax
    if (isset($_POST['id'])){
        $id = htmlspecialchars($_POST['id']);
    
        $data = getInfoById($id);
        echo json_encode($data->fetch(PDO::FETCH_ASSOC));
    }

    //recuperation produit avec ajax
    if (isset($_POST['id_prod'])){
        $id = htmlspecialchars($_POST['id_prod']);
    
        $data = details($id);
        echo json_encode($data->fetchAll(PDO::FETCH_ASSOC));
    }

    //search du produit avec ajax
    if (isset($_POST['q'])){
        $q = htmlspecialchars($_POST['q']);
    
        $data = search($q);
        echo json_encode($data->fetchAll(PDO::FETCH_ASSOC));
    }

    
?>