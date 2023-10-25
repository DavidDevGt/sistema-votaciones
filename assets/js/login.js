$(document).ready(function () {
  $("#loginForm").on("submit", function (e) {
    e.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
      type: "POST",
      url: "login/entrar",
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
        console.log(jqXHR.responseText);
        console.log(jqXHR.status);
      },
    });
  });
});
