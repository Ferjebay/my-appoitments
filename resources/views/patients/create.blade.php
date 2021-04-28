@extends('layouts.panel')

@section('content')
    <div class="card shadow">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">Nuevo Paciente</h3>
          </div>
          <div class="col text-right">
            <a href="{{ url('patients') }}" class="btn btn-sm btn-default">
              Cancelar y volver
            </a>
          </div>
        </div>
      </div>      
      <div class="card-body">
        @if($errors->any())
          <div class="alert alert-danger pb-0 pt-2" role="alert">
            <ul class="mb-2">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        <form action="{{ route('patients.store') }}" method="post">
          @csrf
          <div class="form-group">
            <label for="name">Nombre del medico</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="name">E-mail</label>
            <input type="text" name="email" class="form-control" value="{{ old('email') }}" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="name">DNI</label>
            <input type="text" name="dni" class="form-control" value="{{ old('dni') }}" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="name">Dirección</label>
            <input type="text" name="address" class="form-control" value="{{ old('address') }}" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="name">Telefono / Movil</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="name">Contraseña</label>
            <input type="text" name="password" class="form-control" value="{{ str_random(6) }}" autocomplete="off">
          </div>
          <button type="submit" class="btn btn-primary">
             Guardar
          </button>
        </form>
      </div>
    </div>
@endsection
