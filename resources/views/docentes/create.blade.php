@extends('layouts.master')

@section('content')

<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header text-center">
            Añadir docente
         </div>
         <div class="card-body" style="padding:30px">

            <form action="{{ url('/docente/create') }}" method="POST">

	            @csrf

	            <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" >
                 </div>

                 <div class="form-group">
                    <label for="apellidos">Apellido</label>
                    <input type="text" name="apellidos" id="apellidos"  >
                 </div>

                 <div class="form-group">
                     <label for="direccion">Direccion</label>
                     <input type="text" name="direccion" id="direccion"  >
                  </div>

                  <div class="form-group">
                     <label for="ciclo">Departamento</label>
                     <input type="text" name="ciclo" id="ciclo"  >
                  </div>

	            <div class="form-group text-center">
	               <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
	                   Añadir docente
	               </button>
	            </div>

            </form>

         </div>
      </div>
   </div>
</div>

@endsection
