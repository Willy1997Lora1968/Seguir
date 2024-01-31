document.getElementById('formularioPregunta').addEventListener('submit', function (event) {
  // Prevenir la acción por defecto del formulario
  event.preventDefault();

  // Obtener los valores de los campos del formulario
  var nombre = document.getElementById('nombre').value;
  var correo = document.getElementById('correo').value;
  var preguntaElegida = document.getElementById('preguntaElegida').value;

  // Validar que los campos no estén vacíos
  if (!nombre || !correo || !preguntaElegida) {
      alert('Todos los campos son obligatorios');
      return;
  }

  // Crear un objeto FormData para enviar los datos del formulario
  var datos = new FormData();
  datos.append('nombre', nombre);
  datos.append('correo', correo);
  datos.append('preguntaElegida', preguntaElegida);

  // Enviar los datos del formulario a respuestas.php
  fetch('respuestas.php', {
      method: 'POST',
      body: datos,
  })
      .then(function (response) {
          // Convertir la respuesta en texto
          return response.text();
      })
      .then(function (texto) {
          // Mostrar la respuesta en el div de respuestas
          document.getElementById('respuestas').innerHTML = texto;
      });
});