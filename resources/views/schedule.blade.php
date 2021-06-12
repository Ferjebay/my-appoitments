@extends('layouts.panel')

@section('content')
  <form action="{{ url('schedule') }}" method="post">
    @csrf
    <div class="card shadow">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">Gestionar Horario</h3>
          </div>
          <div class="col text-right">
            <button type="submit" class="btn btn-sm btn-success">
              Guardar Cambios
            </button>
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
        @if(session('errors'))
          <div class="alert alert-danger" role="alert">
            Los cambios se han guardado pero ten en cuenta que:
            <ul>
              @foreach(session('errors') as $error)
                <strong>
                  <li>{{ $error }}</li>
                </strong> 
              @endforeach              
            </ul>
          </div>
        @endif
      </div>  
      <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col">Dia</th>
              <th scope="col">Activo</th>
              <th scope="col">Turno Mañana</th>
              <th scope="col">Turno Tarde</th>              
            </tr>
          </thead>
          <tbody>
            @foreach($workDays as $key => $workDay)
            <tr>
              <td>{{ $days[$key] }}</td>
              <td>
                <label class="custom-toggle">
                  <input type="checkbox" name="active[]" value="{{ $key }}"
                  @if($workDay->active) checked @endif>
                  <span class="custom-toggle-slider rounded-circle"></span>
                </label>
              </td> 
              <td>
                <div class="row">
                  <div class="col">
                    <select class="form-control" name="morning_start[]">
                      @for($i=5; $i<=11; $i++)
                        <option value="{{($i<10 ? '0' : '').$i}}:00" 
                          @if($workDay->morning_start == "$i:00 AM") selected @endif>
                          {{$i}}:00 am
                        </option>
                        <option value="{{($i<10 ? '0' : '').$i}}:30" 
                          @if($workDay->morning_start == "$i:30 AM") selected @endif>
                          {{$i}}:30 am
                        </option>
                      @endfor                
                    </select>                  
                  </div>
                  <div class="col">
                    <select class="form-control" name="morning_end[]">
                      @for($i=5; $i<=11; $i++)
                        <option value="{{($i<10 ? '0' : '').$i}}:00"
                          @if($workDay->morning_end == "$i:00 AM") selected @endif>
                          {{$i}}:00 am
                        </option>
                        <option value="{{($i<10 ? '0' : '').$i}}:30"
                          @if($workDay->morning_end == "$i:30 AM") selected @endif>
                          {{$i}}:30 am
                        </option>
                      @endfor                
                    </select>                  
                  </div>
                </div>
              </td>
              <td>
                <div class="row">
                  <div class="col">
                    <select class="form-control" name="afternoon_start[]">
                      @for($i=1; $i<=11; $i++)
                        <option value="{{$i+12}}:00"
                          @if($workDay->afternoon_start == "$i:00 PM") selected @endif>
                          {{$i}}:00 pm
                        </option>
                        <option value="{{$i+12}}:30"
                          @if($workDay->afternoon_start == "$i:30 PM") selected @endif>
                          {{$i}}:30 pm
                        </option>
                      @endfor                
                    </select>                  
                  </div>
                  <div class="col">
                    <select class="form-control" name="afternoon_end[]">
                      @for($i=1; $i<=11; $i++)
                        <option value="{{$i+12}}:00"
                          @if($workDay->afternoon_end == "$i:00 PM") selected @endif>
                          {{$i}}:00 pm
                        </option>
                        <option value="{{$i+12}}:30"
                          @if($workDay->afternoon_end == "$i:30 PM") selected @endif>
                          {{$i}}:30 pm
                        </option>
                      @endfor                
                    </select>                  
                  </div>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </form>
@endsection
