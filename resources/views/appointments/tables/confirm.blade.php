<div class="table-responsive">
  <!-- Projects table -->
  <table class="table align-items-center table-flush">
    <thead class="thead-light">
      <tr>
        <th scope="col">Descripción</th>
        <th scope="col">Especialidad</th>
        @if($role == 'doctor')
          <th scope="col">Paciente</th>
        @else
          <th scope="col">Medico</th>
        @endif
        <th scope="col">Fecha</th>              
        <th scope="col">Hora</th>              
        <th scope="col">Tipo</th>                                  
        <th scope="col">Opciones</th>              
      </tr>
    </thead>
    <tbody>
      @foreach($confirmedAppointments as $appointment)
        <tr>
          <th scope="row">
            {{ $appointment->description }}
          </th>
          <td>
            {{ $appointment->specialty->name }}
          </td>
          <td>
            @if($role == 'doctor')
              {{ $appointment->patient->name }}
            @else
              {{ $appointment->doctor->name }}
            @endif
          </td>
          <td>
            {{ $appointment->scheduled_date }}
          </td>
          <td>
            {{ $appointment->scheduled_time_12 }}
          </td>
          <td>
            {{ $appointment->type }}
          </td>
          <td>
            @if($role == 'admin')
              <a title="Ver Cita" class="btn btn-primary btn-sm"
                href="{{ url('/appointments/'.$appointment->id) }}">
                Ver
              </a>
            @endif
            <a title="Cancelar Cita" class="btn btn-danger btn-sm"
              href="{{ url('/appointments/'.$appointment->id.'/cancel') }}">
              Cancelar
            </a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="card-body">
  {{ $confirmedAppointments->links() }}        
</div>