@extends('layouts.panel')

@section('content')
    <div class="card shadow">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">Medicos</h3>
          </div>
          <div class="col text-right">
            <a href="{{ url('doctors/create') }}" class="btn btn-sm btn-success">
              Nuevo medico
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
              <th scope="col">E-mail</th>
              <th scope="col">DNI</th>
              <th scope="col">Opciones</th>              
            </tr>
          </thead>
          <tbody>
            @foreach($doctors as $doctor)
              <tr>
                <th scope="row">
                  {{ $doctor->name }}
                </th>
                <td>
                  {{ $doctor->email }}
                </td>
                <td>
                  -----
                </td>
                <td>
                  <a href="{{ route('doctors.edit', [$doctor->id]) }}" class="btn btn-primary btn-sm">Editar</a>
                  <a href="#" class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('form-delete').submit()">
                    Eliminar
                  </a>
                  <form action="{{ route('doctors.destroy', [$doctor->id]) }}" method="post" 
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
