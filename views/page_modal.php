<!-- 
    ICI LES MODALS POUR LES FORMULAIRES DU PRODUIT
-->

<!-- Edit Modal -->
<div class="modal fade text-dark" id="edit_modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b>Modification</b></h4>
            </div>

            <div class="modal-body">
                <form action="controllers/update.php" method="post">
                    <input type="hidden" name="id" class="edit_id">
                    <div class="form-row mb-3">
                        <div class="col">
                            <label>Numéro <span>*</span></label>
                            <input type="text" class="form-control" id="edit_id" title="Ce champ n'est pas modifiable" disabled>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">
                            <label>Désignation <span>*</span></label>
                            <input type="text" class="form-control" name="designe" id="edit_designe" placeholder="Désignation">
                        </div>
                    </div>

                    <!-- <div class="form-row mb-3">
                        <div class="col">
                            <label>NOM DU PRODUIT <span>*</span></label>
                            <input type="text" class="form-control" id="edit_nom" name="nom" placeholder="Nom du produit">
                        </div>
                        <div class="col">
                            <label>PRIX DU PRODUIT <span>*</span></label>
                            <input type="number" class="form-control" id="edit_prix" name="prix" placeholder="Prix du produit">
                        </div>
                    </div>

                    <div class="form-row mb-3">
                        <div class="col">
                            <label>DESCRIPTION DU PRODUIT <span>*</span></label>
                            <textarea class="form-control" id="edit_desc" name="desc"  placeholder="Description du produit..."></textarea>
                        </div>
                    </div> -->
                            
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light rounded-pill" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-warning btn-flat rounded-pill" name="update">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Details Modal -->
<div class="modal fade" id="desc_modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="text-center mt-4 mb-2">
                <h5><b>Mouvement de stock du produit : <span class="text-primary name"></span></b></h5>
            </div>
            <div class="separation"></div>
            <div class="ml-3">
                <h3>Stock : <span class="text-dark stock"></span></h3>
            </div>
            <div class="modal-body">
                <table class="table table-striped text-center">

                    <thead>
                        <tr>
                            <th>Date d'entrée</th><th>Date de sortie</th>
                            <th>Quantité Entrée</th><th>Quantité Sortie</th>						
                        </tr>
                    </thead>
    
                    <tbody id="details">
                    </tbody>

                </table>
                <div class="error"></div>
            </div>
            <div class="m-3">
                <button type="button" class="btn btn-light rounded-pill" data-dismiss="modal">Quitter</button>
            </div>
        </div>
    </div>
</div>


<!-- Delete Modal -->
<div class="modal fade text-dark" id="delete_modal" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><b>Suppression...</b></h4>
      </div>
        <div class="modal-body">
            <form class="form-horizontal" method="post" action="controllers/delete.php">
                <input type="hidden" class="del_id" name="id">
                <div class="text-center">
                    <p class="text-danger">SUPPRIMER ?</p>
                    <h2 class="bold name"></h2>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-light rounded-pill" data-dismiss="modal">Non</button>
                    <button type="submit" class="btn btn-danger btn-flat rounded-pill" name="delete">Oui</button>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>



<!-- 
    ICI LES MODALS POUR LES FORMULAIRES DE LA CATEGORIE
-->

<!-- Add Modal -->
<div class="modal fade text-dark" id="addnewcat" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b>Création</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span class="text-dark" aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="controllers/store.php" method="post">
                    <div class="form-row mb-3">
                        <div class="col">
                            <label>NOM DE LA CATEGORIE <span>*</span></label>
                            <input type="text" class="form-control" name="nomcat" placeholder="Nom de la catégorie">
                        </div>
                    </div>
                            
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><span class="fa fa-close"> Annuler</span></button>
                        <button type="submit" class="btn btn-primary btn-flat" name="addcat"><span class="fa fa-save"></span> Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade text-dark" id="edit_modal_cat" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b>Modification</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span class="text-dark" aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="controllers/update.php" method="post">
                    <input type="hidden" class="edit_idcat" name="id">
                    <div class="form-row mb-3">
                        <div class="col">
                            <label>NOM DE LA CATEGORIE <span>*</span></label>
                            <input type="text" class="form-control" name="nomcat" id="edit_nomcat" placeholder="Nom de la catégorie">
                        </div>
                    </div>
                            
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><span class="fa fa-close"></span> Annuler</button>
                        <button type="submit" class="btn btn-success btn-flat" name="updatecat"><span class="fa fa-edit"></span> Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Delete Modal -->
<div class="modal fade text-dark" id="delete_modal_cat" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><b>Suppression...</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="text-dark" aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <form class="form-horizontal" method="POST" action="controllers/delete.php">
                <input type="hidden" class="del_idcat" name="id">
                <div class="text-center">
                    <p class="text-danger">SUPPRIMER ?</p>
                    <h2 class="bold name"></h2>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal"><span class="fa fa-close"> Annuler</button>
                    <button type="submit" class="btn btn-danger btn-flat" name="deletecat"><span class="fa fa-trash"></span> Supprimer</button>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>