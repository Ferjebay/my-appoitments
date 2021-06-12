@extends('layouts.panel')

@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Registrar Nueva Cita</h3>
        </div>
        <div class="col text-right">
          <a href="{{ url('doctors') }}" class="btn btn-sm btn-default">
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
      <form action="{{ url('/appointments') }}" method="post">
        @csrf
        <div class="form-group">
          <label for="description">Descripción</label>
          <input type="text" id="description" name="description" placeholder="Describe brevemente la consulta" class="form-control" autocomplete="off" value="{{old('description')}}">
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="especialties">Especialidad</label>
            <select class="form-control" id="specialties" name="specialty_id" required>
                <option>Seleccionar especialidad</option>
                @foreach($specialties as $specialty)
                  <option value="{{ $specialty->id }}"
                    @if(old('specialty_id') == $specialty->id) selected @endif>
                    {{ $specialty->name }}
                  </option>
                @endforeach
            </select>         
          </div>
          <div class="form-group col-md-6">
            <label for="doctors">Medico</label>
            <select name="doctor_id" id="doctors" class="form-control" required>            
              @foreach($doctors as $doctor)
                <option value="{{ $doctor->id }}"
                  @if(old('doctor_id') == $doctor->id) selected @endif>
                  {{ $doctor->name }}
                </option>
              @endforeach
            </select>
          </div>
        </div>        
        <div class="form-group">
          <label for="date">Fecha</label>
          <div class="input-group">
              <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
              </div>
              <input class="form-control datepicker" placeholder="Selecciona Fecha" type="text" 
              value="{{ old('scheduled_date', date('Y-m-d')) }}" data-date-format="yyyy-mm-dd" id="date" name="scheduled_date" data-date-start-date="{{ date('Y-m-d') }}" data-date-end-date="+30d">
          </div>
        </div>
        <div class="form-group">
          <label for="name">Hora de Atención</label>
          <div id="hours">
            @if($intervals)
              @foreach($intervals['morning'] as $key => $interval)
                <div class="custom-control custom-radio mb-3">
                  <input type="radio" id="intervalMorning{{$key}}" name="scheduled_time" class="custom-control-input" value="{{$interval['start']}}" required>
                  <label class="custom-control-label" for="intervalMorning{{$key}}">
                    {{$interval['start']}} - {{$interval['end']}}
                  </label>
                </div>
              @endforeach
              @foreach($intervals['afternoon'] as $key => $interval)
                <div class="custom-control custom-radio mb-3">
                  <input type="radio" id="intervalAfternoon{{$key}}" name="scheduled_time" class="custom-control-input" value="{{$interval['start']}}" required>
                  <label class="custom-control-label" for="intervalAfternoon{{$key}}">
                    {{$interval['start']}} - {{$interval['start']}}
                  </label>
                </div>
              @endforeach
            @else
              <div class="alert alert-primary" role="alert">
                  Selecciona un medico y una fecha, para ver sus horas disponibles.
              </div>
            @endif
          </div>          
        </div>
        <div class="form-group">
          <label for="type">Tipo de consulta</label>
          <div class="custom-control custom-radio mb-3">
            <input type="radio" value="Consulta" id="type1" name="type" class="custom-control-input" checked @if(old('type') == 'Consulta') checked @endif>
            <label class="custom-control-label" for="type1">Consulta</label>
          </div>
          <div class="custom-control custom-radio mb-3">
            <input type="radio" id="type2" name="type" class="custom-control-input" value="Examen"
            @if(old('type') == 'Examen') checked @endif>
            <label class="custom-control-label" for="type2">Examen</label>
          </div>
          <div class="custom-control custom-radio mb-3">
            <input type="radio" value="Operación" id="type3" name="type" class="custom-control-input"
            @if(old('type') == 'Operacion') checked @endif>
            <label class="custom-control-label" for="type3">Operacion</label>
          </div>
        </div>
        <button type="submit" class="btn btn-success">
           Guardar
        </button>
      </form>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('assets/js/appointments/create.js') }}"></script>
@endsection