<?php
require_once "view/header.php";
?>
<div class="row"> 
    <div class="col-md-3"></div>
    <div class="col-md-5" >
        <div class="card" id="base">
            <div class="card-header" id="head_users">
                <h3>Nuevo Rol<h3>
            </div>
            <div class="container">
                <div class="form-group row">
                    <form action="?action=/CreateRole" method="post" id="formCreate">
                        <div class="col-md-7" ></br>
                            <label><b>Descripcion</b></label>
                            <input type="text" class="form-control" name="DescripcionRol" placeholder="Escriba el Nombre del rol">
                        </div><br>
                        <button type="submit" value="Enviar" class="btn btn-primary m-2">Guardar Rol</button>
                    </form>   
                </div>
            </div>
        </div>
    </div>
</div>
<script src="static/js/ScriptRole/Role.js"></script>