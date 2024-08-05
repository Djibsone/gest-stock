$(document).ready(function() {

    //showUrl
    let showUrl = './controllers/show.php';
    let designation = $("#designe_sortie");
    let qtSortie = $("#qt_sortie");

    //edit produit
    $(document).on('click', '.edit', function(e){
        e.preventDefault();
        $('#edit_modal').modal('show');
        var id = $(this).attr('data-id');
        $('.edit_id').val(id);
        getRow(id);
    });

    //description produit
    $(document).on('click', '.description', function(e){
        e.preventDefault();
        $('#desc_modal').modal('show');
        var id = $(this).data('id');

        $.ajax({
            url: showUrl,
            type: 'post',
            data: { id_prod: id },
            dataType: 'json',
            success: function(data) {
                getDetails(data);
            }
        });
        getRow(id);
    });

    //delete produit
    $(document).on('click', '.delete', function(e){
        e.preventDefault();
        $('#delete_modal').modal('show');
        var id = $(this).attr('data-id');
        $('.del_id').val(id);
        getRow(id);
    });

    //fonction getRow produit
    function getRow(id){
        $.ajax({
          type: 'post',
          url: showUrl,
          data: {id:id},
          dataType: 'json',
          success: function(data){
            $('#edit_id').val('P00' + data.id);
            $('#edit_designe').val(data.designation);
            $('.name').html(data.designation);
            $('.stock').html(data.stock_actuel);
          }
        });
    }

    //focntion getDetails
    function getDetails(data) {
        $('#details').empty();      
        $('.error').empty();

        if (data.length > 0) {
            data.forEach(function(item) {
                var row = `
                    <tr>
                        <td>${item.date_entre}</td>
                        <td>${item.date_sortie}</td>
                        <td>${item.quantite_entre}</td>
                        <td>${item.quantite_sortie}</td>
                    </tr>
                `;
        
                $('#details').append(row);
            });
        } else {
            $('.error').append(("<h3>Pas de détails lié à ce produit.</h3>"));
        }
    }

    //search
    $('#searchInput').on('input', function() {
        var q = $(this).val();

        $.ajax({
            url: showUrl,
            type: 'post',
            data: { q: q },
            dataType: 'json',
            success: function(data) {
                updateTable(data);
            }
        });
    });
    
    //focntion updateTable
    function updateTable(data) {
        $('#resultSearch').empty();
        $('.searchError').empty();
        
        if (data.length > 0) {
            data.forEach(function(item) {
                let row = `
                    <tr>
                        <th>${'P00' + item.id}</th>
                        <td>${item.designation}</td>
                        <td>${item.stock_actuel} ${item.stock_actuel <= 10 ? '<span class="bg-danger p-1 rounded-pill">Ravitaillement</span>' : ''}</td>
                        <td>
                            <a href="#" class="btn btn-info btn-edit-delete description"
                                data-id="${item.id}"> 
                                <span class="fa fa-eye"></span>
                            </a>
                            &nbsp
                            <a href="#" class="btn btn-warning btn-edit-delete edit"
                                data-id="${item.id}"> 
                                <span class="fa fa-edit"></span>
                            </a>
                            &nbsp
                            <a href="#" class="btn btn-danger btn-edit-delete delete"
                                data-id="${item.id}">
                                <span class="fa fa-trash"></span>
                            </a>
                        
                        </td>
                    </tr>
                `;
        
                $('#resultSearch').append(row);
            });
        } else {
            $('.searchError').append(("<h2>Aucun résultat trouvé.</h2>"));
        }
    }

    //limitation de la qt à la qt en stock si on desire sortir + que la qt en stock 
    designation.on("change", function () {
        let selectedDesignation = designation.val();
        qtSortie.val(null);

        if (selectedDesignation) {

            $.ajax({
                url: showUrl,
                type: "post",
                data: { id: selectedDesignation },
                dataType:'json',
                success: function (data) {
                    $('#qt_stock').val(data.stock_actuel);

                    qtSortie.on('input', function () {
                        let qt_sortie = $(this).val();
                        let qt_stock = parseInt($('#qt_stock').val());

                        if (qt_sortie > qt_stock) {
                            $('#qt_sortie').val(qt_stock);
                            // console.log(qt_sortie, qt_stock);
                        }
                    });
                },
                error: function () {
                    console.error("Erreur lors de la récupération des communes.");
                }
            });
        }
        
    });

});