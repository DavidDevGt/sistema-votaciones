$(document).ready(function () {
  $("#registroForm").on("submit", function (e) {
    e.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
      type: "POST",
      url: "registro/crear",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          window.location.href = "inicio";
        } else {
          alert(response.message);
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(
          "Error en la comunicación con el servidor. Detalles: " +
            textStatus +
            ": " +
            errorThrown
        );
        console.log(jqXHR.responseText); // Añade esta línea
        console.log(jqXHR.status); // Añade esta línea
      },
    });
  });
});
