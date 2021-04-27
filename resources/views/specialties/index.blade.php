@extends('layouts.panel')

@section('content')
    <div class="card shadow">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">Especialidades</h3>
          </div>
          <div class="col text-right">
            <a href="{{ url('specialties/create') }}" class="btn btn-sm btn-success">
              Nueva especialidad
            </a>
          </div>
        </div>
      </div>
      <div class="card-body">
        @if(session('notification'))
        <div class="alert alert-success" role="alert">
            <strong>
              {{ session('notification') }}
            </strong> 
        </div>
        @endif
      </div>  
      <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Descripción</th>
              <th scope="col">Opciones</th>              
            </tr>
          </thead>
          <tbody>
            @foreach($specialties as $specialty)
              <tr>
                <th scope="row">
                  {{ $specialty->name }}
                </th>
                <td>
                  {{ $specialty->description }}
                </td>
                <td>
                  <a href="{{ route('specialties.edit', [$specialty->id]) }}" class="btn btn-primary btn-sm">Editar</a>
                  <a href="#" class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('form-delete').submit()">
                    Eliminar
                  </a>
                  <form action="{{ route('specialties.destroy', [$specialty->id]) }}" method="post" 
                    id="form-delete">
                    @csrf
                    @method('DELETE')
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
@endsection
