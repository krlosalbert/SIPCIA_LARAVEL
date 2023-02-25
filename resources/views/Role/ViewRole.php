<?php
    require_once "view/header.php";
?>
<div class="row"> 
    <div class="col-md-3"></div>
    <div class="col-md-5" >
        <div class="card" id="base">
            <div class="card-header" id="head_users">
                <h3>Roles &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    <!-- Button trigger modal paara editar -->
                    <a href="?action=/NewRole" type="button" id="insert" class="btn btn-secondary" data-toggle="" data-target="#exampleModal">
                        Agregar
                    </a>
                <h3>
            </div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="text-center" scope="col">Descripcion</th>
                        <th class="text-center" scope="col">Accion</th>
                    </tr>
                </thead>
                <?php 
                    $x = 0; 
                    while($search = mysqli_fetch_array($resultRole) ){ 
                ?>         
                <tbody>
                    <tr>  
                        <td class="text-center"><?php $x+= 1; echo $x; ?> </td>
                        <td class="text-center"><?php echo $search['RoleDescription']; ?> </td>
                        <td class="text-center">
                            <!-- Button trigger modal paara editar -->
                            <button type="button" id="Update" class="btn btn-warning" data-toggle="" data-target="#exampleModal" data-id=<?php echo $search['RoleId']; ?>>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                            </button>
                            <button onclick="DeleteRole(<?php echo $search['RoleId']; ?>)" type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalLong">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </button>
                        </td>
                    </tr>
                    <?php   }   ?>
                </tbody> 
            </table>
            <script src="static/js/ScriptRole/Delete.js"></script>
        </div>
    </div>
</div>
<!-- Modal agregar rol-->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header btn btn-primary text-white">
                <h5 class="modal-title" id="exampleModalLongTitle">Nuevo Rol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">

                </div>
        </div>
    </div>
</div>
<!-- Modal para editar -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header btn btn-warning text-black">
                <h5 class="modal-title">Editar Rol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
            </div>   
            <div class="modal-footer">      

            </div>      
        </div>
    </div>
</div>

<!-- ===============================================
=FINALIZA TABLA E INICIA EL SCRIPT PARA LAS ALERTAS
================================================== -->

<script>
//modal para agregar rol
    $(document).on("click", "#insert", function(){

    $.ajax({
            
            url: "FormCreateRole.php"
            
        })
        .done(function(data){
            $("#add  .modal-body").html(data);  
        })
        .fail(function(){

            console.log('fallo');
        }); 
        $('#add').modal('toggle');

    });

    //modal para editar
    $(document).on("click", "#Update", function(){
    var id =$(this).data("id");

    $.ajax({
            
            url: "FormUpdateRole.php?codigo="+id
            
        })
        .done(function(data){
            $("#edit  .modal-body").html(data);  
        })
        .fail(function(){

            console.log('fallo');
        }); 
        $('#edit').modal('toggle');

    });
</script> 
<?php
    require_once "view/footer.php";
?>