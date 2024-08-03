<?php
require_once('../models/connexion.php');

if(isset($_POST['delete'])){

    if (empty($_POST['id'])) {

        $msg= "Selectionnez avant de supprimer.";
        $url="../";		
        header("location:../msg/message.php?msg=$msg&color=r&url=$url");

    } else {

        $id = htmlspecialchars($_POST['id']);
        $stmt = delete($id);

        if ($stmt) {

            $msg= "Supprimé avec succès.";
            $url="../";		
            header("location:../msg/message.php?msg=$msg&color=v&url=$url");

        } else {

            $msg= "Erreur de suppression.";
            $url="../";		
            header("location:../msg/message.php?msg=$msg&color=r&url=$url");

        }    
    }
}


// delete catégorie
/*if(isset($_POST['deletecat'])){

    if (empty($_POST['id'])) {

        $msg= "Selectionnez avant de supprimer.";
        $url="../";		
        header("location:../msg/message.php?msg=$msg&color=r&url=$url");

    } else {

        $id = htmlspecialchars($_POST['id']);
        $checkProduits = checkProduits($id);

        if ($checkProduits->rowCount() > 0) {

            $msg= "Erreur de suppression, supprimez d'abord les produits liés à cette catégorie.";
            $url="../";		
            header("location:../msg/message.php?msg=$msg&color=r&url=$url");

        } else {

            $stmt = deleteCat($id);

            if ($stmt) {

                $msg= "Supprimé avec succès.";
                $url="../";		
                header("location:../msg/message.php?msg=$msg&color=v&url=$url");

            } else {

                $msg= "Erreur de suppression.";
                $url="../";		
                header("location:../msg/message.php?msg=$msg&color=r&url=$url");

            }    
        }
    }
}*/