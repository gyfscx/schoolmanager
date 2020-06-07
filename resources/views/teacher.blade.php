<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gestion</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
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
    
        <!-- Select2 -->
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
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
  .hvr-shrinks:hover {
    display: inline-block;
    vertical-align: middle;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;   
    -webkit-transform: scale(5.1);
    transform: scale(5.1)
}

 .hvr-shrink:hover {
    display: inline-block;
    vertical-align: middle;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;   
    -webkit-transform: scale(1.1);
    transform: scale(1.1)
}

 .zoom:hover {
    display: inline-block;
    vertical-align: middle;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;   
    -webkit-transform: scale(1.1);
    transform: scale(3.1)
}
</style> 
    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">

        var table;
        $(document).ready(function(){
            
            $('[data-mask]').inputmask()
            table= $('#teacherTable').DataTable({
                "responsive": true,
                "autoWidth":false,
                //"sAjaxSource":"{{route('teachers.index')}}",
                "sAjaxDataProp":"data",
                "oLanguage": {
                    "sLengthMenu": "_MENU_ Enregistrements",
                    "sSearch":"<span class='add-on'><i class='fa fa-search'></i></span>Recherche",
                    "sZeroRecords": "Aucun résultat",
                    "sInfo": "Affichage de _START_ à _END_ sur _TOTAL_",
                    "sInfoEmpty": "Affichage de 0 à 0 sur 0 Enregistrements",
                    "oPaginate": {
                        "sNext": 'Suivant',
                        "sPrevious": 'Précèdent',
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
                    "url" :"{{route('teachers.index')}}",
                    "dataSrc" :""

                },
                "aaSorting": [
                    [0, 'desc'],
                    [1, 'asc']
                ], "columns":[
                    {"data":"dateFormat"},
                    {"data":"image"},
                    {"data":"genre_id"},
                    {"data": "first_name"},
                    {"data":"last_name"},
                    {"data":"category_id"},
                    {"data":"email"},
                    {"data":"phone"},
                    {"data":"adresse"},
                    {"data":"active"},
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
                $("#teacherForm")[0].reset();
                $(".col-md-4").removeClass('has-error').removeClass('has-success');
                $(".text-danger").remove();
                $('#loadingId').hide();
                $(".messages").html("");
                getSchoolYearActive();
                categoryOption();
                genreOption();

            });

            //FONCTION ADD DEVIS
            $("#btnAddteacherId").on('click', function(){
                $(".text-danger").remove();
                $(".col-md-4").removeClass('has-error').removeClass('has-success');
              var form_data = new FormData($('#teacherForm')[0]);
                    $.ajax({
                        url: "{{route('teachers.store')}}",
                        type: 'POST',
                        data:form_data,
                        processData : false,
                        contentType:false,
                        //dataType: "json",
                        /*beforeSend: function() {
                         $('#loadingId').show();
                         },*/
                        success: function (response) {
                            console.log(response);
                            // $('#loadingId').hide();
                            // remove the error
                            $(".form-group").removeClass('has-error').removeClass('has-success');
                            if (response.success === true) {
                                showAddToast();

                                $("#teacherForm")[0].reset();
                                $("#addteacherModal").modal("hide");
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
                        console.log(jqXHR);
                       if(jqXHR.responseJSON.errors.first_name !==undefined){
                             $("#firstNameId").after('<p class="text-danger">'+jqXHR.responseJSON.errors.first_name+'</p>');
                             }
                             
                             if(jqXHR.responseJSON.errors.last_name !==undefined){
                             $("#lastNameId").after('<p class="text-danger">'+jqXHR.responseJSON.errors.last_name+'</p>');
                             }

                        }
                    });
                
            });

            //FIN ADD DEVIS
        });


        //FUNCTION UPDATE DEVIS
        function editTeacher(id){
            if(id) {
                // remove the error
                $(".col-md-4").removeClass('has-error').removeClass('has-success');
                $(".text-danger").remove();
                // empty the message div
                $(".edit-messages").html("");
                // $("#editPicture").val('');
                $('#editLoadingId').hide();
                $("#editSchoolYearActiveId").html("");
                $("#editSchoolYearActive").val("");
                // remove the id
                $("#teacher_edit_id").remove();
                // fetch the member data
                $.ajax({
                    url:"/teachers/"+id,
                    type: 'get',
                    dataType: 'json',
                    success:function(response) {
                        console.log(response);
                         editCategoryOption(response.category_id.id,response.category_id.name);
                         editGenreOption(response.genre_id.id,response.genre_id.name)
                         $("#editFirstNameId").val(response.first_name);
                         $("#editLastNameId").val(response.last_name);
                         //$("#editsexId").val(response.sex);
                         $("#editEmailId").val(response.email);
                         $("#editAdresseId").val(response.adresse);
                         $("#editPhoneId").val(response.phone);
                         $("#editCelId").val(response.cel);
                         $("#editPictureId").html(response.editImage);
                         $("#editSchoolYearActive").val(response.schoolYear.name);
                         $("#editSchoolYearActiveId").append('<option value='+response.schoolYear.id+'>'+response.schoolYear.name+'</option>');



                        $("#editteacherForm").append('<input type="hidden" name="id" id="teacher_edit_id" value="'+response.id+'"/>');
                        // here update the member data
                        $("#btnUpdateteacherId").unbind('click').bind('click', function(){

                            // remove error messages
                            $(".text-danger").remove();
                            var editForm_data = new FormData($('#editteacherForm')[0]);
                                var idteacher =$("#teacher_edit_id").val();
                                  $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                
                                $.ajax({
                                    url:"/teachers/"+idteacher,
                                    type:'POST',
                                    data:editForm_data,//$("#editCustomerForm").serialize(),
                                    processData : false,
                                    contentType:false,
                                    cache: false,
                                    //dataType :"json",
                                    /* beforeSend: function() {
                                     $('#editLoadingId').show();
                                     },*/
                                    success:function(response) {
                                        console.log(response)
                                        if(response.status === true) {
                                            showUpdateToast();

                                            $("#editTeacherModal").modal("hide");
                                            // reload the datatables
                                            table.ajax.reload(null, false);
                                            // remove the error
                                            $(".form-group").removeClass('has-success').removeClass('has-error');
                                            $(".text-danger").remove();

                                            // remove the id
                                            $("#teacher_edit_id").remove();
                                        } else {
                                            showErrorToast();
                                            $(".edit-messages").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                                    '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.message+
                                                    '</div>')
                                        }
                                    },
                                    error: function(jqXHR, textStatus, errorThrown){
                                    console.log(jqXHR);
                                      /*if(jqXHR.responseJSON.errors.name !==undefined){
                                        $("#editNameId").after('<p class="text-danger">'+jqXHR.responseJSON.errors.name+'</p>');
                                        }
                             
                                        if(jqXHR.responseJSON.errors.description !==undefined){
                                        $("#editDescriptionId").after('<p class="text-danger">'+jqXHR.responseJSON.errors.description+'</p>');
                                        }*/                                
                                      }
                                }); // /ajax
                         
                        });

                    }
                }); //fetch selected member info

            } else {
                alert("Error : Refresh the page again");
            }
        }

        //FIN UPDATE DEVIS

        //FUNCTION DELETE COMUNNE

        function removeTeacher(id){
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
                        url: "/teachers/"+id,
                        type: 'DELETE',
                        dataType: 'json',
                        success:function(response) {
                            console.log(response)
                            if(response.status === true) {
                                showDeleteToast();
                                // refresh the table
                                table.ajax.reload(null, false);
                                // close the modal
                                $("#removeTeacherModal").modal('hide');

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

 //LIST Category OPTION
        function categoryOption(){
            $.ajax({
                url:"{{route('categories.index')}}",
                type:'GET',
                dataType :"json",
                success:function(response){
                    console.log(response);
                    $("#categoryId").html('');
                    $("#categoryId").append('<option value='+0+'>'+' '+'</option>');
                    $.each(response, function(key, val){
                       $("#categoryId").append('<option value='+val.id+'>'+val.name+'</option>');
                    });
                }
            });
        }
    //FIN
    
    
      //LIST EDIT product OPTION
        function editCategoryOption(valId, valText){
            $.ajax({
                url:"{{route('categories.index')}}",
                type:'GET',
                dataType :"json",
                success:function(response){
                    console.log(response);
                    $("#editCategoryId").html('');
                    $("#editCategoryId").append('<option value='+valId+'>'+valText+'</option>');
                    $.each(response, function(key, val){
                        if(valId!=val.id){
                        $("#editCategoryId").append('<option value='+val.id+'>'+val.name+'</option>');
                        }
                    });
                }
            });
        }
    //FIN
    //
     //GENRE OPTION
            function genreOption(){
            $.ajax({
                url:"{{route('genres.index')}}",
                type:'GET',
                dataType :"json",
                success:function(response){
                    console.log(response);
                    $("#genreId").html('');
                    $("#genreId").append('<option value='+0+'>'+' '+'</option>');
                    $.each(response, function(key, val){
                       $("#genreId").append('<option value='+val.id+'>'+val.name+'</option>');
                    });
                }
            });
        }
    //FIN
    
    
      //LIST EDIT product OPTION
        function editGenreOption(valId, valText){
            $.ajax({
                url:"{{route('genres.index')}}",
                type:'GET',
                dataType :"json",
                success:function(response){
                    console.log(response);
                    $("#editGenreId").html('');
                    $("#editGenreId").append('<option value='+valId+'>'+valText+'</option>');
                    $.each(response, function(key, val){
                        if(valId!=val.id){
                        $("#editGenreId").append('<option value='+val.id+'>'+val.name+'</option>');
                        }
                    });
                }
            });
        }
    //FIN
    
    //FUNCTION UPDATE DEVIS
        function infoTeacher(id){
            if(id) {
                // remove the error
                $(".col-md-4").removeClass('has-error').removeClass('has-success');
                $(".text-danger").remove();
                // empty the message div
                $(".edit-messages").html("");
                // $("#editPicture").val('');
                $('#editLoadingId').hide();
                // remove the id
                $("#teacher_edit_id").remove();
                // fetch the member data
                $.ajax({
                    url:"/teachers/"+id,
                    type: 'get',
                    dataType: 'json',
                    success:function(response) {
                        console.log(response);
                         //editCategoryOption(response.category_id.id,response.category_id.name);
                         //editGenreOption(response.genre_id.id,response.genre_id.name)
                         $("#editFirstNameIds").html(response.first_name);
                         $("#editLastNameIds").html(response.last_name);
                         //$("#editsexId").val(response.sex);
                         $("#editEmailIds").html(response.email);
                         $("#editAdresseIds").html(response.adresse);
                         $("#editPhoneIds").html(response.phone);
                         $("#editCelIds").html(response.cel);
                         $("#editPictureIds").html(response.infoImage);
                         $("#editDateIds").html(response.dateFormat);
                         $("#editCategoryIds").html(response.category_id.name);
                        

                        $("#editteacherForm").append('<input type="hidden" name="id" id="teacher_edit_id" value="'+response.id+'"/>');
                        
                    }
                }); //fetch selected member info

            } else {
                alert("Error : Refresh the page again");
            }
        }
        
        
          function getSchoolYearActive(){
            $.ajax({
                url:"/getSchoolYearActive",
                type:'GET',
                dataType :"json",
                success:function(response){
                    console.log(response);
                     //$("#schoolYearActiveId").html('');
                     $("#schoolYearActive").val(response.data[0].name);
                     $("#schoolYearActiveId").append('<option value='+response.data[0].id+'>'+response.data[0].name+'</option>');
                },
                error: function(jqXHR, textStatus, errorThrown){
                       console.log(jqXHR);
                 }
            });
        }

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
                        <h1>Liste Professeur</h1>
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
                            <button class="btn btn-success" data-toggle="modal" data-target="#addteacherModal" id="btnAddNew"><i class="fa fa-plus"></i>Ajouter</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="responsive-data-table">
                                <table id="teacherTable"  class="table dt-responsive nowrap table-hover  table-striped" >
                                    <thead>
                                    <tr>
                                        
                                        <th>Date création</th>
                                        <th>Photo</th>
                                        <th>Sexe</th>
                                        <th>Nom</th>
                                        <th>Prenom</th>
                                        <th>Categorie</th>
                                         <th>Email</th>
                                         <th>Téléphone</th>
                                         <th>Adresse</th>
                                         <th data-priority ="1">Statut</th>
                                         <th data-priority ="2">Action</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                       
                                        <th>Date création</th>
                                         <th>Photo</th>
                                        <th>Sexe</th>
                                        <th>Nom</th>
                                        <th>Prenom</th>
                                        <th>Categorie</th>
                                         <th>Email</th>
                                         <th>Téléphone</th>
                                         <th>Adresse</th>
                                         <th data-priority ="1">Statut</th>
                                         <th data-priority ="2">Action</th>
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
<div class="modal fade" id="addteacherModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    NOUVEAU PROFESSEUR</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <!--FORMULIARE-->
                <form id="teacherForm" autocomplete="off" enctype="multipart/form-data">
                    
                     {{csrf_field()}}
                    <div class="messages"></div>
                    
                    <div class="row">
                     <div class="col-sm-6">
                            <label class="control-label col-md-12">Année Scolaire</label>
                            <div class="col-md-12">
                                <input name="schoolYearActive" id="schoolYearActive" class="form-control" type="text" disabled="true">
                            <span class="help-block"></span>
                            </div>
                        </div>
                     </div>   
                  <div class="row">
                        <div class="col-sm-6">
                            <label class="control-label col-md-12">Sexe</label>
                            <div class="col-md-12">
                                <select class="form-control" id="genreId" name="genre">
                                </select>
                            </div>
                        </div>
                      
                      <div class="col-sm-6">
                            <label class="control-label col-md-12">Categorie</label>
                            <div class="col-md-12">
                                <select class="form-control select2" id="categoryId" name="category"></select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <label class="control-label col-md-12">Nom</label>
                            <div class="col-md-12">
                                <input name="firstName" id="firstNameId" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="control-label col-md-12">Prénom</label>
                            <div class="col-md-12">
                                <input name="lastName" id="lastNameId" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <label class="control-label col-md-12">Telephone1</label>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input name="phone" id="phoneId" class="form-control" type="text" data-inputmask='"mask": "+225 99-99-99-99"' data-mask>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <label class="control-label col-md-12">Telephone2</label>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input name="cel" id="celId" class="form-control" type="text" data-inputmask='"mask": "+225 99-99-99-99"' data-mask>
                                <span class="help-block"></span>
                            </div>
                        </div>
                       
                    </div>

                      <div class="row">
                          
                           <div class="col-sm-6">
                            <label class="control-label col-md-12">Email</label>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                </div>
                                <input class="form-control" id="emailId" name="email" type="text" placeholder="Email">
                            </div>
                        </div>
                          
                        <div class="col-sm-6">
                            <label class="control-label col-md-12">Adresse</label>
                            <div class="col-md-12">
                            <input name="adresse" id="adresseId" class="form-control" type="text">

                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div></br></br>

                    <div class="row">
                        <div class="col-sm-6">
                            <label class="control-label col-md-12">Photo </label>
                            <div class="col-md-12">
                                <input type="file" name="file" id="fileId" class="form-control">
                            </div>
                        </div>
                    </div>
                    
                  <select class="form-control" id="schoolYearActiveId" name="schoolYear" hidden="true">
                 </select>
                </form>
            </div>
            
            <div class="modal-footer">
               
                <button class="btn btn-success" id="btnAddteacherId" type="submit"><i class="fa fa-check"></i>Enregistrer</button>
                <button class="btn btn-danger" type="button" data-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin add product -->

<!-- Edit product Modal-->
<div class="modal fade" id="editTeacherModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabels">
                    MODIFIER PROFESSEUR</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <!--FORMULIARE-->
                <form id="editteacherForm" autocomplete="off">
                      {{csrf_field()}}
                    <input type="hidden" name="_method" value="PUT">
                    <div class="messages"></div>
                    
                        <div class="form-group">
                          <div class="" id="editPictureId">
                          </div>
                       </div>
                    
                       <div class="row">
                     <div class="col-sm-6">
                            <label class="control-label col-md-12">Année Scolaire</label>
                            <div class="col-md-12">
                             <input name="editSchoolYearActive" id="editSchoolYearActive" class="form-control" type="text" disabled="true">

                                <span class="help-block"></span>
                            </div>
                        </div>
                           
                           <div class="col-sm-6">
                            <label class="control-label col-md-12">Statut</label>
                            <div class="col-md-12">
                                <select class="form-control select2" id="editStatutId" name="statut">
                                    <option value="1">Actif</option>
                                    <option value="2">inactif</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                     </div>
                    
                  <div class="row">
                        <div class="col-sm-6">
                            <label class="control-label col-md-12">Sexe</label>
                            <div class="col-md-12">
                                <select class="form-control" id="editGenreId" name="genre">
                                </select>
                            </div>
                        </div>
                      
                      <div class="col-sm-6">
                            <label class="control-label col-md-12">Categorie</label>
                            <div class="col-md-12">
                                <select class="form-control select2" id="editCategoryId" name="category"></select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <label class="control-label col-md-12">Nom</label>
                            <div class="col-md-12">
                                <input name="firstName" id="editFirstNameId" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="control-label col-md-12">Prénom</label>
                            <div class="col-md-12">
                                <input name="lastName" id="editLastNameId" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <label class="control-label col-md-12">Telephone1</label>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input name="phone" id="editPhoneId" class="form-control" type="text" data-inputmask='"mask": "+225 99-99-99-99"' data-mask>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <label class="control-label col-md-12">Telephone2</label>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input name="cel" id="editCelId" class="form-control" type="text" data-inputmask='"mask": "+225 99-99-99-99"' data-mask>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                    </div>

                      <div class="row">
                          
                          <div class="col-sm-6">
                            <label class="control-label col-md-12">Email</label>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                </div>
                                <input class="form-control" id="editEmailId" name="email" type="text" placeholder="Email">
                            </div>
                        </div>
                          
                        <div class="col-sm-6">
                            <label class="control-label col-md-12">Adresse</label>
                            <div class="col-md-12">
                            <input name="adresse" id="editAdresseId" class="form-control" type="text">

                                <span class="help-block"></span>
                            </div>
                        </div>
                          
                    </div>
                    
                    </br></br>

                    <div class="row">
                        <div class="col-sm-6">
                            <label class="control-label col-md-12">Photo </label>
                            <div class="col-md-12">
                                <input type="file" name="file" id="editFileId" class="form-control">
                            </div>
                        </div>
                    </div>
                     <select class="form-control" id="editSchoolYearActiveId" name="schoolYear" hidden="true">
                     </select>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="btnUpdateteacherId" type="submit"><i class="fa fa-check"></i>Enregistrer</button>
                <button class="btn btn-danger" type="button" data-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin update product -->

<!-- delete product modal-->
<div class="modal fade" id="removeTeacherModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">
                    SUPPRIMER PROFESSUER</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
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


<!-- Edit product Modal-->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabels">
                    INFORMATION PROFESSEUR</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <div class="" id="editPictureIds">
                          </div>
                </div>

                  <h3 class="profile-username text-center"><label id="editFirstNameIds"></label></h3>

                <p class="text-muted text-center"><label id="editLastNameIds"></label></p>

                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Profile</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Matière</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Programme</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                    
                    
                    <div class="active tab-pane" id="activity">
                    <form class="form-horizontal">
                     <ul class="list-group list-group-unbordered mb-12">
                   <li class="list-group-item">
                    <b>Date d'enregistrement</b> <a class="float-right" id="editDateIds"></a>
                  </li>
                  <li class="list-group-item">
                    <b>Categorie Professionnelle</b> <a class="float-right" id="editCategoryIds"></a>
                  </li>
                  <li class="list-group-item">
                    <b>Téléphone 1</b> <a class="float-right" id="editPhoneIds"></a>
                  </li>
                  <li class="list-group-item">
                    <b>Téléphone 2</b> <a class="float-right" id="editCelIds"></a>
                  </li>
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right" id="editEmailIds"></a>
                  </li>
                  <li class="list-group-item">
                    <b>Addresse</b> <a class="float-right" id="editAdresseIds"></a>
                  </li>
                </ul>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                    </form>
                  </div>
                  
                 
                    <div class="tab-pane" id="timeline">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                        <div class="col-sm-10">	
                          <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                    

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                        <div class="col-sm-10">	
                          <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
                
            </div>
        </div>
    </div>
</div>
<!-- Fin update product -->

</body>
</html>