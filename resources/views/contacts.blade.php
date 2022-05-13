<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Agenda</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >    
    <link  href="https://cdn.datatables.net/v/dt/dt-1.12.0/datatables.min.css" rel="stylesheet">  
</head>
<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Lista de Contatos</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" onClick="add()" href="javascript:void(0)">
                        Criar Contato
                    </a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div class="card-body">
            <table class="table table-bordered" id="crud-datatable">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Ação</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- boostrap model -->
    <div class="modal fade" id="contact-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ContactModal"></h4>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="ContactForm" name="ContactForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">
                                Nome
                            </label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Digite o nome do contato" maxlength="50" required="">
                            </div>
                        </div>  
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">
                                Telefone
                            </label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Digite o telefone do contato" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="btn-save">
                                Salvar
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- end bootstrap model -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-1.12.0/datatables.min.js"></script>
    <script type="text/javascript">
        $(document).ready( function () {
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#crud-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('crud-datatable') }}",
                columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'phone', name: 'phone' },
                {data: 'action', name: 'action', orderable: false},
                ],
                order: [[0, 'desc']]
            });
        });
        function add(){
            $('#ContactForm').trigger("reset");
            $('#ContactModal').html("Adicionar Contato");
            $('#contact-modal').modal('show');
            $('#id').val('');
        }   
        function editFunc(id){
            $.ajax({
            type:"PATCH",
            url: "{{ url('edit-contact') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
                $('#ContactModal').html("Edit Contact");
                $('#contact-modal').modal('show');
                $('#id').val(res.id);
                $('#name').val(res.name);
                $('#phone').val(res.phone);
            }
            });
        }  
        function deleteFunc(id){
            if (confirm("Delete Record?") == true) {
                var id = id;
                // ajax
                $.ajax({
                    type:"DELETE",
                    url: "{{ url('delete-contact') }}",
                    data: { id: id },
                    dataType: 'json',
                    success: function(res){
                        var oTable = $('#crud-datatable').dataTable();
                        oTable.fnDraw(false);
                    }
                });
            }
        }
        $('#ContactForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type:'POST',
                url: "{{ url('store-contact')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $("#contact-modal").modal('hide');
                    var oTable = $('#crud-datatable').dataTable(); 
                    oTable.fnDraw(false);
                    $("#btn-save").html('Submit');
                    $("#btn-save"). attr("disabled", false);
                },
                error: function(data){
                    console.log(data);
                }
            });
        });
    </script>
</body>
</html>