<?php
require_once('../models/connexion.php');

if(isset($_POST['update'])){

        if (!empty($_POST['id']) && !empty($_POST['designe'])) {
                
                $id = htmlspecialchars($_POST['id']);
                $designe = htmlspecialchars($_POST['designe']);

                $stmt = update($id, $designe);

                if ($stmt) {

                        $msg= "Modifié avec succès.";
                        $url="../";		
                        header("location:../msg/message.php?msg=$msg&color=v&url=$url");

                } else {

                        $msg= "Erreur de modification.";
                        $url="../";		
                        header("location:../msg/message.php?msg=$msg&color=r&url=$url");

                } 
                
        } else {

                $msg= "Renseignez les champs.";
                $url="../";		
                header("location:../msg/message.php?msg=$msg&color=r&url=$url");

        }
         
}