<?php
require_once('../models/connexion.php');

$qt = 0;

if(isset($_POST['add'])){

        if (!empty($_POST['designe'])) {

                $designe = htmlspecialchars($_POST['designe']);

                $stmt = add($designe);

                if ($stmt) {

                        $msg= "Ajouté avec succès.";
                        $url="../";		
                        header("location:../msg/message.php?msg=$msg&color=v&url=$url");

                } else {

                        $msg= "Erreur d\'ajout.";
                        $url="../";		
                        header("location:../msg/message.php?msg=$msg&color=r&url=$url");

                }
                
        } else {

                $msg= "Renseignez les champs.";
                $url="../";	
                header("location:../msg/message.php?msg=$msg&color=r&url=$url");

        }
        
}


// add entre
if(isset($_POST['plus'])){

        if (!empty($_POST['designe']) && !empty($_POST['quantite'])) {

                $designe = htmlspecialchars($_POST['designe']);
                $quantite = htmlspecialchars($_POST['quantite']);

                $check = getInfoById($designe);
                $data = $check->fetch();
                $mv_Qt = $data['stock_actuel'] + $quantite;

                if ($quantite <= 0 && $quantite === '') {

                        $msg= "La quantité doit être superieure à 0 et différent de null.";
                        $url="../";		
                        header("location:../msg/message.php?msg=$msg&color=r&url=$url");

                } else {

                        $stmt = addEntre($quantite, $designe);

                        if ($stmt) {

                                mouvement($designe, $mv_Qt);
                                $msg= "Entrée effectuée avec succès.";
                                $url="../";		
                                header("location:../msg/message.php?msg=$msg&color=v&url=$url");

                        } else {

                                $msg= "Erreur d\'entrée.";
                                $url="../";		
                                header("location:../msg/message.php?msg=$msg&color=r&url=$url");

                        }
                        }                
        } else {

                $msg= "Renseignez les champs.";
                $url="../";	
                header("location:../msg/message.php?msg=$msg&color=r&url=$url");

        }
        
}

// add sortie
if(isset($_POST['minus'])){

        if (!empty($_POST['designe']) && !empty($_POST['quantite'])) {

                $designe = htmlspecialchars($_POST['designe']);
                $quantite = htmlspecialchars($_POST['quantite']);

                $check = getInfoById($designe);
                $data = $check->fetch();
                $mv_Qt = $data['stock_actuel'] - $quantite;

                if ($data['stock_actuel'] < $quantite) {

                        $msg= "La quantité démandée est superieure à la quantité en stock.";
                        $url="../";		
                        header("location:../msg/message.php?msg=$msg&color=r&url=$url");

                } else {

                        if ($quantite <= 0 && $quantite === '') {

                                $msg= "La quantité doit être superieure à 0 et différent de null.";
                                $url="../";		
                                header("location:../msg/message.php?msg=$msg&color=r&url=$url");

                        } else {

                                $stmt = addSortie($quantite, $designe);

                                if ($stmt) {

                                        mouvement($designe, $mv_Qt);
                                        $msg= "Sortie effectuée avec succès.";
                                        $url="../";		
                                        header("location:../msg/message.php?msg=$msg&color=v&url=$url");

                                } else {

                                        $msg= "Erreur de sortie.";
                                        $url="../";		
                                        header("location:../msg/message.php?msg=$msg&color=r&url=$url");

                                }
                        } 
                } 
        } else {

                $msg= "Renseignez les champs.";
                $url="../";	
                header("location:../msg/message.php?msg=$msg&color=r&url=$url");

        }
}