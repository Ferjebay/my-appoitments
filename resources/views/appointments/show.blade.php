@extends('layouts.panel')

@section('content')
    <div class="card shadow">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">Cita #{{ $appointment->id }}</h3>
          </div>
        </div>
      </div>
      <div class="card-body">
        <ul>
          <li>
            <strong>Fecha:</strong> {{ $appointment->scheduled_date }}
          </li>
          <li>
            <strong>Hora:</strong> {{ $appointment->scheduled_time }}
          </li>         
          @if($role == 'patient' || $role == 'admin')
            <li>
                <strong>Medico:</strong> {{ $appointment->doctor->name }}
            </li>
          @endif
          @if($role == 'doctor' || $role == 'admin')
            <li>
                <strong>Paciente:</strong> {{ $appointment->patient->name }}
            </li>
          @endif
          <li>
            <strong>Tipo:</strong> 
            {{ $appointment->type }}</span>            
          </li>
          <li>
            <strong>Especialidad:</strong> {{ $appointment->specialty->name }}
          </li>
          <li>
            <strong>Estado:</strong> 
            @if($appointment->status == 'Cancelada')
              <span class="badge badge-danger">{{ $appointment->status }}</span>
            @else
              <span class="badge badge-success">{{ $appointment->status }}</span>
            @endif            
          </li>
          @if($appointment->status == 'Cancelada')
            <div class="alert alert-warning">
              <p>Acerca de cancelación:</p>
              <ul>              
                @if($appointment->cancellation)
                  <li>
                    <strong>Motivo de la cancelación</strong>
                    {{ $appointment->cancellation->justification }}
                  </li>
                  <li>
                    <strong>Fecha de Cancelación</strong>
                    {{ $appointment->cancellation->created_at }}
                  </li>
                  <li>
                    <strong>¿Quién canceló la cita?</strong>
                    @if(auth()->user()->id == $appointment->cancellation->cancelled_by_id)
                      Tú
                    @else
                      {{ $appointment->cancellation->cancelled_by->name }}
                    @endif
                  </li>
                @else
                  <li>Esta cita fue cancelada antes de su confirmación.</li>
                @endif            
              </ul>
            </div>
          @endif
        </ul>
        <a href="{{url('appointments')}}" class="btn btn-default">
          Volver
        </a>
      </div>                   
    </div>
@endsection
