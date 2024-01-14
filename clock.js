var timeDisplay = document.getElementById('time');
var dateDisplay = document.getElementById('date');
var dayOfYearDisplay = document.getElementById('dayOfYear');

function updateClock() {
  var date = new Date();

  var second = date.getSeconds();
  var minute = date.getMinutes();
  var hour = date.getHours();
  var day = date.getDate();
  var month = date.getMonth() + 1; // Los meses en JavaScript comienzan desde 0
  var year = date.getFullYear();

  // Calcular los días transcurridos desde el inicio del año
  var start = new Date(year, 0, 0);
  var diff = date - start;
  var oneDay = 1000 * 60 * 60 * 24;
  var dayOfYear = Math.floor(diff / oneDay);

  // Asegurarse de que las horas, los minutos y los segundos sean de dos dígitos
  if (hour < 10) hour = '0' + hour;
  if (minute < 10) minute = '0' + minute;
  if (second < 10) second = '0' + second;
  if (day < 10) day = '0' + day;
  if (month < 10) month = '0' + month;

  timeDisplay.innerHTML = hour + ':' + minute + ':' + second;
  dateDisplay.innerHTML = day + '/' + month + '/' + year;
  dayOfYearDisplay.innerHTML =   dayOfYear + ' días recorridos del presente año.';
}

setInterval(updateClock, 1000);
