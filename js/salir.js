function salir() {
  Swal.fire({
    title: "Salida del Sistema",
    text: "¿Está Seguro que Quiere Salir del Sistema?",
    icon: "question",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si,Deseo Salir!"
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = '../salir.php?s=1';
    }
  });
}