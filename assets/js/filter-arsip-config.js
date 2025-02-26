$(document).ready(function () {
  var table = $("#table_id").DataTable();

  function parseTanggal(tanggal) {
    var parts = tanggal.split("/");
    if (parts.length === 3) {
      return { year: parts[2], month: parts[1], day: parts[0] };
    }
    return { year: "", month: "", day: "" };
  }

  function getInputTanggal(inputTanggal) {
    if (!inputTanggal) return { year: "", month: "", day: "" };
    var dateParts = inputTanggal.split("-");
    return { year: dateParts[0], month: dateParts[1], day: dateParts[2] };
  }

  function filterData(settings, data, dataIndex) {
    var jenisSurat = (data[1] || "").toLowerCase(); // Jenis Surat
    var kodeSurat = (data[2] || "").toLowerCase(); // Kode Surat
    var waktu = parseTanggal(data[3] || ""); // Waktu (dd/mm/yyyy)
    var nomorSuratData = (data[4] || "").toLowerCase(); // Nomor Surat
    var tanggalSurat = parseTanggal(data[5] || ""); // Tanggal Surat (dd/mm/yyyy)
    var perihal = (data[6] || "").toLowerCase(); // Perihal
    var pengirim = (data[7] || "").toLowerCase(); // Pengirim
    var kepada = (data[8] || "").toLowerCase(); // Kepada

    var tahun = $("#filterTahun").val();
    var bulan = $("#filterBulan").val();
    var inputTanggal = getInputTanggal($("#filterTanggal").val());
    var nomorSurat = $("#filterNomorSurat").val().toLowerCase();
    var perihalFilter = $("#filterPerihal").val().toLowerCase();

    // Filter berdasarkan tahun
    if (tahun && waktu.year !== tahun && tanggalSurat.year !== tahun)
      return false;

    // Filter berdasarkan bulan
    if (bulan && waktu.month !== bulan && tanggalSurat.month !== bulan)
      return false;

    // Filter berdasarkan tanggal
    if (
      inputTanggal.day &&
      waktu.day !== inputTanggal.day &&
      tanggalSurat.day !== inputTanggal.day
    )
      return false;

    // Filter berdasarkan nomor surat
    if (nomorSurat && !nomorSuratData.includes(nomorSurat)) return false;

    // Filter berdasarkan perihal
    if (perihalFilter && !perihal.includes(perihalFilter)) return false;

    return true;
  }

  $("#btnFilter").click(function () {
    $.fn.dataTable.ext.search = [];
    $.fn.dataTable.ext.search.push(filterData);
    table.draw();
  });

  $("#btnReset").click(function () {
    $(
      "#filterTahun, #filterBulan, #filterTanggal, #filterNomorSurat, #filterPerihal"
    ).val("");
    $.fn.dataTable.ext.search = [];
    table.search("").columns().search("").draw();
  });
});
