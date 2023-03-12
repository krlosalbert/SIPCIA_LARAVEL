@extends('layouts.header')

@section('content')
<div class="row"> 
    <div class="col-md-3"></div>
    <div class="col-md-5" >
        <div class="card" id="base">
            <div class="card-header" id="head_users">
                <h3>Actualizar Rol<h3>
            </div>
            <div class="container">
                <div class="form-group row">
                    <form action="{{ route('UpdateRoles', $role->id) }}" method="post" id="formCreate">
                    @method('PUT')
                    @csrf
                        <div class="col-md-7" ></br>
                            <label><b>Descripcion</b></label>
                            <input type="text" class="form-control" name="name" value="{{ $role->name }}" placeholder="Escriba el Nombre del rol">
                        </div><br>
                        <button type="submit" value="Enviar" class="btn btn-primary m-2">Guardar Rol</button>
                    </form>   
                </div>
            </div>
        </div>
    </div>
</div>
@if(session('success'))
    <script>
        swal("Listo!", "Role Actualizado con Exito!", "success")
            .then((value) => {
                window.location.replace('/ViewRoles'); 
        });
    </script>
@endif
<script src="static/js/ScriptRole/Role.js"></script>
@endsection