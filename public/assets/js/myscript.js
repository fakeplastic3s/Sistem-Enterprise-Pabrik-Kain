const flashData1 = $(".flash-data1").data("flashdata1");
const flashData2 = $(".flash-data2").data("flashdata2");
const flashDataStok = $(".flash-data-stok").data("flashdatastok");
console.log(flashData1);

if (flashData1) {
  //   Swal.fire("", flashData1, "warning");

  Swal.fire({
    position: "center",
    icon: "warning",
    title: "Peringatan",
    text: flashData1,
    showConfirmButton: false,
    timer: 3000,
  });
} else if (flashData2) {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });

  Toast.fire({
    icon: "success",
    title: "Presensi Berhasil",
  });
} else if (flashDataStok) {
  const Toast = Swal.mixin({
    toast: true,
    position: "top",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });

  Toast.fire({
    icon: "warning",
    title: "Data Bahan Mentah Hampir Habis!",
  });
}
