<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gestion</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{asset('logincssjs/images/icons/favicon.ico')}}"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- dataTables css -->
    <link href="{{asset('plugins/datatables/dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('plugins/data-tables/datatables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('plugins/data-tables/responsive.datatables.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- jQuery -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- dataTables js -->
    <script src="{{asset('plugins/data-tables/jquery.datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/data-tables/datatables.bootstrap4.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/data-tables/datatables.responsive.min.js')}}" type="text/javascript"></script>
    <!-- SweetAlert2 -->
    <script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- Toastr -->
    <script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('plugins/toast.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('dist/js/demo.js')}}"></script>
    <!-- page script -->
       <style>
        #loadingId {
    width: 100%;
    height: 100%;
    top: 0px;
    left: 0px;
    position: fixed;
    display: block;
    opacity: 0.6;
    background-color: #F8F8F8;
    z-index: 99;
    text-align: center;
 
}

#editLoadingId {
    width: 100%;
    height: 100%;
    top: 0px;
    left: 0px;
    position: fixed;
    display: block;
    opacity: 0.6;
    background-color: #F8F8F8;
    z-index: 99;
    text-align: center;
 
}
    </style>
    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">

        var table;
        $(document).ready(function(){
            $('#loadingId').hide();
            table= $('#typeTable').DataTable({
                "responsive": true,
                "autoWidth":false,
               // "sAjaxSource":window.origin+'/listCivility',
                "sAjaxDataProp":"data",
                "oLanguage": {
                    
                    /*"sProcessing":     "Traitement en cours...",
                        "sSearch":         "Rechercher&nbsp;:",
                    "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
                        "sInfo":           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                        "sInfoEmpty":      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                        "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                        "sInfoPostFix":    "",
                        "sLoadingRecords": "Chargement en cours...",
                    "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                        "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
                        "oPaginate": {
                                "sFirst":      "Premier",
                                "sPrevious":   "Pr&eacute;c&eacute;dent",
                                "sNext":       "Suivant",
                                "sLast":       "Dernier"
                        },
                        "oAria": {
                                "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                                "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                        },*/
                    "sLengthMenu": "_MENU_ Enregistrements",
                    "sSearch":"<span class=add-on><i class=fa fa-search></i></span>Recherche",
                    "sZeroRecords": "Aucun résultat",
                    "sInfo": "Affichage de _START_ à _END_ sur _TOTAL_",
                    "sInfoEmpty": "Affichage de 0 à 0 sur 0 Enregistrements",
                    "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                    "sInfoPostFix":    "",
                    "oPaginate": {
                        "sNext": 'Suivant',
                        "sPrevious": 'Précèdent',
                         "sFirst":      "Premier",
                         "sLast":       "Dernier"
                    },
                    "select": {
                        "rows": {
                            "_": " %d ligne sélectionnée(s)",
                            "1": "1 ligne sélectionnée"
                        }
                    }
                },
                "aLengthMenu": [
                    [10, 25, 100, -1],
                    [10, 25, 100, " Tous"]
                ],
                "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">',

                 "ajax":{
                    "url" :"{{route('genres.index')}}",
                    "dataSrc" :""

                },
                "aaSorting": [
                    [0, 'desc'],
                    [1, 'asc']
                ], "columns":[
                    {"data":"id"},
                    {"data":"dateFormat"},
                    {"data":"name"},
                    {"data":"description"},
                    {"data":"action"}

                ],
                'columnDefs': [{
                    'className': 'select-checkbox',
                    'targets': 0,
                    'checkboxes': {
                        'selectRow': true
                    }
                }],
                'select': {
                    'style': 'multi'
                }

            });
            //FIN DATATABLE

            //IF OPEN MODAL
            $("#btnAddNew").click(function(){
                $("#civilityForm")[0].reset();
                $(".col-md-4").removeClass('has-error').removeClass('has-success');
                $(".text-danger").remove();
                $('#loadingId').hide();
                $(".messages").html("");

            });

            //FONCTION ADD DEVIS
            $("#btnAddcivilityId").on('click', function(){
                $(".text-danger").remove();
                /*$(".col-md-4").removeClass('has-error').removeClass('has-success');
                // validation
                var name = $("#nameId").val();
                var description= $("#descriptionId").val();

                if(name === "") {
                    $("#nameId").closest('.col-md-4').addClass('has-error');
                    $("#nameId").after('<p class="text-danger">Champs vide</p>');
                } else {
                    $("#nameId").closest('.col-md-4').removeClass('has-error');
                    $("#nameId").closest('.col-md-4').addClass('has-success');
                }

                if(description === "") {
                    $("#descriptionId").closest('.col-md-4').addClass('has-error');
                    $("#descriptionId").after('<p class="text-danger">Champs vide</p>');
                }else {
                    $("#descriptionId").closest('.col-md-4').removeClass('has-error');
                    $("#descriptionId").closest('.col-md-4').addClass('has-success');
                }
                if(name && description !="") {*/
                    $.ajax({
                        url:  "{{route('genres.store')}}",
                        type: 'POST',
                        data: $("#civilityForm").serialize(),
                        dataType: "json",
                        beforeSend: function() {
                         $('#loadingId').show();
                         },
                        success: function (response) {
                            console.log(response);
                           $('#loadingId').hide();
                            // remove the error
                            $(".form-group").removeClass('has-error').removeClass('has-success');
                            if (response.status === true) {
                                showAddToast();

                                $("#civilityForm")[0].reset();
                                $("#addcivilityModal").modal("hide");
                                table.ajax.reload(null, false);
                            }else{
                                if (response.data != null) {
                                    showErrorToast();
                                    $(".messages").html('<div class="alert alert-danger alert-dismissable fade show">' +
                                            '<button class="close" data-dismiss="alert" aria-label="Close">×</button><strong>ERREUR!</strong> ' + response.data.cause.serverErrorMessage.detail +
                                            '</div>');

                                }else{
                                    $(".messages").html('<div class="alert alert-danger alert-dismissable fade show">' +
                                            '<button class="close" data-dismiss="alert" aria-label="Close">×</button><strong>ERREUR!</strong> ' + response.message +
                                            '</div>');

                                }
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                         $('#loadingId').hide();
                        console.log(jqXHR);
                         $('#loadingId').hide();
                            if(jqXHR.responseJSON.errors.name !==undefined){
                             $("#nameId").after('<p class="text-danger">'+jqXHR.responseJSON.errors.name+'</p>');
                             }
                             
                             if(jqXHR.responseJSON.errors.description !==undefined){
                             $("#descriptionId").after('<p class="text-danger">'+jqXHR.responseJSON.errors.description+'</p>');
                             }

                        }
                    });
                /*}
                return false;*/

            });

            //FIN ADD DEVIS
        });


        //FUNCTION UPDATE DEVIS
        function editGenre(id){
            if(id) {
                // remove the error
                $(".col-md-4").removeClass('has-error').removeClass('has-success');
                $(".text-danger").remove();
                // empty the message div
                $(".edit-messages").html("");
                // $("#editPicture").val('');
                $('#editLoadingId').hide();
                // remove the id
                $("#genre_edit_id").remove();
                // fetch the member data
                $.ajax({
                    url:"/genres/"+id,
                    type: 'get',
                    dataType: 'json',
                    success:function(response) {
                        console.log(response);

                        $("#editNameId").val(response.name);
                        $("#editDescriptionId").val(response.description);


                        $("#editcivilityForm").append('<input type="hidden" name="id" id="genre_edit_id" value="'+response.id+'"/>');
                        // here update the member data
                        $("#btnUpdatecivilityId").unbind('click').bind('click', function(){

                            // remove error messages
                            $(".text-danger").remove();

                            // validation
                            var editName = $("#editNameId").val();
                            var editDescription= $("#editDescriptionId").val();


                            if(editName === "") {
                                $("#editNameId").closest('.col-md-4').addClass('has-error');
                                $("#editNameId").after('<p class="text-danger">Champs vide</p>');
                            } else {
                                $("#editNameId").closest('.col-md-4').removeClass('has-error');
                                $("#editNameId").closest('.col-md-4').addClass('has-success');
                            }

                            if(editDescription === "") {
                                $("#editDescriptionId").closest('.col-md-4').addClass('has-error');
                                $("#editDescriptionId").after('<p class="text-danger">Champs vide</p>');
                            }else {
                                $("#editDescriptionId").closest('.col-md-4').removeClass('has-error');
                                $("#editDescriptionId").closest('.col-md-4').addClass('has-success');
                            }

                            // var edit_form_data = new FormData($('#editcivilityForm')[0]);
                            if(editName && editDescription !=""){
                                var idcivility =$("#genre_edit_id").val();
                                $.ajax({
                                    url:"/genres/"+idcivility,
                                    type:'PUT',
                                    data:$("#editcivilityForm").serialize(),
                                    dataType :"json",
                                     beforeSend: function() {
                                     $('#editLoadingId').show();
                                     },
                                    success:function(response) {
                                        $('#editLoadingId').hide();
                                        if(response.status === true) {
                                            showUpdateToast();

                                            $("#editGenreModal").modal("hide");
                                            // reload the datatables
                                            table.ajax.reload(null, false);
                                            // remove the error
                                            $(".form-group").removeClass('has-success').removeClass('has-error');
                                            $(".text-danger").remove();

                                            // remove the id
                                            $("#genre_edit_id").remove();
                                        } else {
                                            showErrorToast();
                                            $(".edit-messages").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                                    '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.message+
                                                    '</div>')
                                        }
                                    },
                                    error: function(jqXHR, textStatus, errorThrown){
                                     $('#editLoadingId').hide();
                                        /*  if(jqXHR.status ==403){
                                         window.location = window.origin + "/spring-boot-apps/errorAuthorise";
                                         }else {
                                         window.location = window.origin + "/spring-boot-apps/pageError";
                                         }   */                                 }
                                }); // /ajax
                            } // /if

                            return false;
                        });

                    }
                }); //fetch selected member info

            } else {
                alert("Error : Refresh the page again");
            }
        }

        //FIN UPDATE DEVIS

        //FUNCTION DELETE COMUNNE

        function removeGenre(id){
            if(id) {
                $(".removeMessages").html('');
                // click on remove button
                $("#removeBtn").unbind('click').bind('click', function() {
                    $.ajaxSetup({
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url:'/genres/'+id,
                        type: 'delete',
                        dataType: 'json',
                        success:function(response) {
                            if(response.status === true) {
                                showDeleteToast();
                                // refresh the table
                                table.ajax.reload(null, false);
                                // close the modal
                                $("#removeGenreModal").modal('hide');

                            } else {
                                showErrorToast();
                                $(".removeMessages").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                        '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.message+
                                        '</div>');
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown){
                            showErrorToast();

                            /*if(jqXHR.status ==403){
                             window.location = window.origin + "/spring-boot-apps/errorAuthorise";
                             }else {
                             window.location = window.origin + "/spring-boot-apps/pageError";
                             }*/
                        }
                    });
                }); // click remove btn
            } else {
                alert('Error: Refresh the page again');
            }
        }

        //FIN DELETE DEVIS

        //toast
        /* function showDangerToast(){
         'use strict';
         resetToastPosition();
         $.toast({
         heading: 'info',
         text: 'Donnée enregistrer avec succès',
         position:'top-right',
         icon: 'success',
         stack: false,
         loaderBg: '#FF0000'
         })
         }

         function showUpdateToast() {
         'use strict';
         resetToastPosition();
         $.toast({
         heading: 'info',
         text: 'Donnée mise à jour avec succès',
         position:'top-right',
         icon: 'success',
         stack: false,
         loaderBg: '#FF0000'
         })
         }

         function showDeleteToast() {
         'use strict';
         resetToastPosition();
         $.toast({
         heading: 'info',
         text: 'Donnée supprimée avec succès',
         position:'top-right',
         icon: 'success',
         stack: false,
         loaderBg: '#FF0000'
         })
         }

         function resetToastPosition () {
         $('.jq-toast-wrap').removeClass('bottom-left bottom-right top-left top-right mid-center'); // to remove previous position class
         $(".jq-toast-wrap").css({
         "top": "",
         "left": "",
         "bottom": "",
         "right": ""
         }); //to remove previous position style
         }*/


    </script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    @include('fragment.header');
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
     @include('fragment.nav');

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Liste Genre</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header">
                            <button class="btn btn-success" data-toggle="modal" data-target="#addcivilityModal" id="btnAddNew"><i class="fa fa-plus"></i>Ajouter</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="responsive-data-table">
                                <table id="typeTable" class="table dt-responsive nowrap table-hover table-striped" >
                                    <thead>
                                    <tr>
                                        <th><input name="select_all" value="1" type="checkbox"></th>
                                        <th>Date création</th>
                                        <th>Nom</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Date création</th>
                                        <th>Nom</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
     @include('fragment.footer');

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- Add product Modal-->
<div class="modal fade" id="addcivilityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    NOUVEAU</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <!--FORMULIARE-->
                <form id="civilityForm" autocomplete="off">
                    {{csrf_field()}}
                  <div id="loadingId">
                    <img id="loading-image" src="/images/ajax-loader.gif" alt="Loading..." />
                  </div>
                    <div class="messages"></div>

                    <div class="form-group">
                        <label class="control-label col-md-12">Nom</label>
                        <div class="col-md-12">
                            <input name="name" id="nameId" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-12">Description</label>
                        <div class="col-md-12">
                            <input name="description" id="descriptionId" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="btnAddcivilityId" type="submit"><i class="fa fa-check"></i>Enregistrer</button>
                <button class="btn btn-danger" type="button" data-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin add product -->

<!-- Edit product Modal-->
<div class="modal fade" id="editGenreModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabels">
                    MODIFIER</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <!--FORMULIARE-->
                <form id="editcivilityForm" autocomplete="off">
                     {{csrf_field()}}
                  <div id="editLoadingId">
                    <img id="loading-image" src="/images/ajax-loader.gif" alt="Loading..." />
                  </div>
                    <div class="messages"></div>

                    <div class="form-group">
                        <label class="control-label col-md-12">Nom</label>
                        <div class="col-md-12">
                            <input name="name" id="editNameId" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-12">Description</label>
                        <div class="col-md-12">
                            <input name="description" id="editDescriptionId" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="btnUpdatecivilityId" type="submit"><i class="fa fa-check"></i>Enregistrer</button>
                <button class="btn btn-danger" type="button" data-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin update product -->

<!-- delete product modal-->
<div class="modal fade" id="removeGenreModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header bg-teal">
                <h4 class="modal-title" id="defaultModalLabel">
                    SUPPRIMER</h4>
            </div>
            <div class="modal-body">
                <div class="removeMessages"></div>
                Voulez vous supprimer cette ligne?
            </div>
            <div class="modal-footer">
                <button type="button" id="removeBtn"  class="btn btn-success ">Supprimer</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>
<!--Fin modal delete-->

</body>
</html>
