<?php

    require_once('models/connexion.php');
    global $p, $c;

    $produits = getAll();
    $designe_entrees = getAll();
    $designe_sorties = getAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>INDEX</title>
</head>
<body>
    <div class="container-fluid mt-4">
        <div class="container col-12">
            <div class="row">

                <!-- Début produit -->
                <div class="card col-8 border-start">
                    <h1 class="text-center"> Liste des produits </h1>
                    <nav class="navbar">
                        <div class="container-fluid">
                            <a class="navbar-brand"></a>
                            <form class="d-flex">
                                <i class="fa fa-search m-2"></i>
                                <input class="form-control me-2" type="search" id="searchInput" placeholder="Recherche...">
                            </form>
                        </div>
                    </nav>
                    <table class="table table-striped text-center">

                        <thead>
                            <tr>
                                <th>Numéro</th><th>Désignation</th>
                                <th>Stock</th><th> Actions </th>						
                            </tr>
                        </thead>
                            
                        <tbody id="resultSearch">
                    
                            <?php foreach ($produits as $produit) { ?>

                                <tr>

                                    <th scope="row">P00<?= $produit['id'] ?></th>
                                    <td><?= $produit['designation'] ?></td>
                                    <td><?= $produit['stock_actuel'] ?></td>
                                    <td>
                                        <a href="#" class="btn btn-info btn-edit-delete description"
                                            data-id="<?= $produit['id'] ?>"> 
                                            <span class="fa fa-eye"></span>
                                        </a>
                                        &nbsp
                                        <a href="#" class="btn btn-warning btn-edit-delete edit"
                                            data-id="<?= $produit['id'] ?>"> 
                                            <span class="fa fa-edit"></span>
                                        </a>
                                        &nbsp
                                        <a href="#" class="btn btn-danger btn-edit-delete delete"
                                            data-id="<?= $produit['id'] ?>">
                                            <span class="fa fa-trash"></span>
                                        </a>
                                    
                                    </td>
                                    
                                </tr>

                            <?php } ?>

                        </tbody>

                    </table>
                    <div class="searchError"></div>
                </div>
                <!-- Fin produit -->

                <!-- Début formulaire -->
                <div class="col-4">
                    <div class="card col mb-3">
                        <h1 class="text-center"> Ajout d'un produit </h1>
                        <div class="separation"></div>
                        <!-- <hr> -->
                        <form action="controllers/store.php" method="post">

                            <div class="form-row mb-3">
                                <div class="col">
                                    <label>Désignation <span>*</span></label>
                                    <input type="text" class="form-control" name="designe" placeholder="Désignation">
                                </div>
                            </div>
                                    
                            <div class="mb-3">
                                <button type="submit" class="btn btn-success btn-flat rounded-pill" name="add"><span class="fa fa-save"> Enregistrer</span></button>
                            </div>
                        </form>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card col">
                                    <h1 class="text-center"> Entrée </h1>
                                    <form action="controllers/store.php" method="post">
                                        
                                        <div class="form-row mb-3">
                                            <div class="col">
                                                <!-- <label>Désignation <span>*</span></label> -->
                                                <select class="custom-select" name="designe">
                                                    <option>-- Désignation --</option>
                                                    <?php foreach ($designe_entrees as $designe_entree) { ?>
                                                        <option value="<?= $designe_entree['id'] ?>"><?= $designe_entree['designation'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row mb-3">
                                            <div class="col">
                                                <!-- <label>Quantité <span>*</span></label> -->
                                                <input type="number" class="form-control" name="quantite" min="1" placeholder="Quantité">
                                            </div>
                                        </div>
                                                
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary btn-flat rounded-pill" name="plus"><span class="fa fa-plus"> Ajouter</span></button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card">
                                <div class="card col">
                                    <h1 class="text-center"> Sortie </h1>
                                    <form action="controllers/store.php" method="post">
                                        
                                        <div class="form-row mb-3">
                                            <div class="col">
                                                <!-- <label>Désignation <span>*</span></label> -->
                                                <select class="custom-select" name="designe" id="designe_sortie">
                                                    <option>-- Désignation --</option>
                                                    <?php foreach ($designe_sorties as $designe_sortie) { ?>
                                                        <option value="<?= $designe_sortie['id'] ?>"><?= $designe_sortie['designation'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row mb-3">
                                            <div class="col">
                                                <!-- <label>Quantité <span>*</span></label> -->
                                                <input type="number" class="form-control" name="quantite" id="qt_sortie" min="1" placeholder="Quantité">
                                                <input type="hidden" id="qt_stock">
                                            </div>
                                        </div>
                                                
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary btn-flat rounded-pill" name="minus"><span class="fa fa-minus"> Rétirer</span></button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin formulaire -->

            </div>
        </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/scripts.js"></script>
    <!-- <script>
        $('#designe_sortie').on("change", function () {
        let designation = $('#designe_sortie').val();
        
        if (designation) {

            $.ajax({
                url: './controllers/show.php',
                type: "post",
                data: { id: designation },
                dataType:'json',
                success: function (data) {

                    function limitQtSortie(input) {
                        let qt_sortie = parseInt(input.value);

                        if (qt_sortie > data.stock_actuel) {
                            //input.value = data.stock_actuel;
                            let s = data.stock_actuel;
                            console.log(s);
                        }
                        
                    }

                },
                error: function () {
                    console.error("Erreur lors de la récupération des communes.");
                }
            });
        }
    });
    </script> -->
</body>
</html>

<!-- modal inclusion -->
<?php include 'views/page_modal.php' ?>