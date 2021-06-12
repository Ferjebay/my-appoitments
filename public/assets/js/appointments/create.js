let alerta = `<div class="alert alert-danger" role="alert">
                  <strong>Lo sentimos!</strong> No se encontraron horas disponibles para el médico en el dia selecccionado.
              </div>`;
let iRadio;
$(function(){
  var $doctors = $('#doctors');
  var $date    = $('#date');
  var $hours   = $('#hours');

  $('#specialties').change(function(){
    const specialtyId = $(this).val();
    const url = `/specialties/${specialtyId}/doctors`;
    $.getJSON(url, doctors => {
      let htmlOptions = '';
      doctors.forEach(function(doctor){
        htmlOptions += `<option value="${doctor.id}">${doctor.name}</option>`
      })
      $doctors.html(htmlOptions);
      loadHours(); //side-effect
    });
  });   

  $doctors.change(loadHours);

  $date.change(loadHours);

  function loadHours(){
    const selectedDate = $date.val();
    const doctor_id = $doctors.val();
    const url = `/schedule/hours?date=${selectedDate}&doctor_id=${doctor_id}`;
    $.getJSON(url, displayHours);
  }

  function displayHours(data){
    if(!data.morning && !data.afternoon){
      $hours.html(alerta)
      console.log("no hay horarios disponibles");
      return;
    }

    let htmlHours = '';
    iRadio = 0;

    if(data.morning){
      const morning_intervals = data.morning;
      morning_intervals.forEach(interval => {
        htmlHours += getRadioIntervalHtml(interval);
      })
    }
    if(data.afternoon){
      const afternoon_intervals = data.afternoon;
      afternoon_intervals.forEach(interval => {
        htmlHours += getRadioIntervalHtml(interval);
      })
    }
    $hours.html(htmlHours);
  }

  function getRadioIntervalHtml(interval){
    const text = `${interval.start} - ${interval.end} `;
    iRadio += 1;
    return `<div class="custom-control custom-radio mb-3">
              <input type="radio" id="interval${iRadio}" name="scheduled_time" class="custom-control-input" value="${interval.start}" required>
              <label class="custom-control-label" for="interval${iRadio}">${text}</label>
            </div>`;
  }

})