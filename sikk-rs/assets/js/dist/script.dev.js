"use strict";

var base_url = $('#base').val();
console.log(base_url);
rs();
$('#rs-tab').on('click', function () {
  rs();
});
$('#kelas-tab').on('click', function () {
  kelas();
});

function rs() {
  $('#isi-umum-tab').html('');
  $('#isi-puskesmas-tab').html('');
  $('#isi-kelas-tab').html('');
  $('#isi-rs-tab').html("\n    <ul class=\"nav nav-pills justify-content-center\" id=\"pills-tab\" role=\"tablist\">\n        <li class=\"nav-item\" role=\"presentation\">\n            <a class=\"nav-link active\" id=\"umum-tab\" data-bs-toggle=\"pill\" href=\"#isi-rs-tab\" role=\"tab\"aria-selected=\"true\">Rumah Sakit Umum</a>\n        </li>\n        <li class=\"nav-item\" role=\"presentation\">\n            <a class=\"nav-link\" id=\"puskesmas-tab\" data-bs-toggle=\"pill\" href=\"#isi-kelas-tab\" role=\"tab\" aria-controls=\"pills-profile\" aria-selected=\"false\">Puskesmas</a>\n        </li>\n    </ul>\n    <br>\n    <br>\n    <div class=\"tab-content\" id=\"pills-tabContent\">\n        <div class=\"tab-pane fade show active\" role=\"tabpanel\">\n            <div class=\"row\" id=\"isi-umum-tab\">\n                Isi RS Umum\n            </div>\n        </div>\n        <div class=\"tab-pane fade show active\" role=\"tabpanel\">\n            <div class=\"row\" id=\"isi-puskesmas-tab\">\n                Isi Puskesmas\n            </div>\n        </div>\n    </div>\n    ");
  umum();
  $('#umum-tab').on('click', function () {
    umum();
  });
  $('#puskesmas-tab').on('click', function () {
    puskesmas();
  });
}

function umum() {
  var rs = dataRS;
  console.log(rs);
  $('#isi-umum-tab').html('');
  $('#isi-puskesmas-tab').html('');
  rs.forEach(function (data) {
    // console.log(data);
    var persen = data.tersedia / data.kapasitas * 100;
    var bulat = Math.round(persen);
    $('#isi-umum-tab').append("\n            <div class=\"col-md-4\">\n                <div class=\"card bg-teal-200 mb-3\" onclick=\"modalRS('" + data.nama + "', '" + data.alamat + "')\">\n                    <div class=\"card-body\">\n                        <h1 class=\"card-title\">" + data.tersedia + "</h1>\n                        <p class=\"card-text\">Kamar Tersedia</p>\n                        <h2 class=\"card-text fw-lighter\">" + data.nama + "</h2>\n                    </div>\n                    <div class=\"card-footer\">\n                        <h6 class=\"card-subtitle mb-2 text-muted text-center\">" + bulat + "% kamar tersedia dari " + data.kapasitas + " kamar</h6>\n                        <div class=\"progress\">\n                            <div class=\"progress-bar progress-bar-striped bg-info\" role=\"progressbar\" style=\"width: " + persen + "%\"></div>\n                        </div>\n                        <p class=\"card-subtitle mt-2 fs-7 fw-light text-muted text-center\">Update terakhir " + data.update + "</p>\n                    </div>\n                </div>\n            </div>\n        ");
  });
}

function puskesmas() {
  $('#isi-umum-tab').html('');
  $('#isi-puskesmas-tab').html('');
  var puskesmas = dataPuskesmas;
  console.log(puskesmas);
  puskesmas.forEach(function (data) {
    // console.log(data);
    var persen = data.tersedia / data.kapasitas * 100;
    var bulat = Math.round(persen);
    $('#isi-puskesmas-tab').append("\n            <div class=\"col-md-4\">\n                <div class=\"card bg-teal-200 mb-3\">\n                    <div class=\"card-body\">\n                        <h1 class=\"card-title\">" + data.tersedia + "</h1>\n                        <p class=\"card-text\">Kamar Tersedia</p>\n                        <h3 class=\"card-text fw-lighter\">" + data.nama + "</h3>\n                    </div>\n                    <div class=\"card-footer\">\n                        <h6 class=\"card-subtitle mb-2 text-muted text-center\">" + bulat + "% kamar tersedia dari " + data.kapasitas + " kamar</h6>\n                        <div class=\"progress\">\n                            <div class=\"progress-bar progress-bar-striped bg-info\" role=\"progressbar\" style=\"width: " + persen + "%\"></div>\n                        </div>\n                        <p class=\"card-subtitle mt-2 fs-6 fw-light text-muted text-center\">Update terakhir " + data.update + "</p>\n                    </div>\n                </div>\n            </div>\n        ");
  });
}

function kelas() {
  $('#isi-rs-tab').html('');
  $('#isi-umum-tab').html('');
  $('#isi-puskesmas-tab').html('');
  $('#isi-kelas-tab').html('');
  var kelas = dataKelas;
  console.log(kelas);
  kelas.forEach(function (data) {
    var persen = data.tersedia / data.kapasitas * 100;
    var bulat = Math.round(persen);
    $('#isi-kelas-tab').append("\n            <div class=\"col-md-4\">\n                <div class=\"card bg-teal-200 mb-3\" onclick=\"modalKelas('" + data.nama + "')\">\n                    <div class=\"card-body\">\n                        <h1 class=\"card-title\">" + data.tersedia + "</h1>\n                        <p class=\"card-text\">Kamar Tersedia</p>\n                        <h1 class=\"card-text display-6\">" + data.nama + "</h1>\n                    </div>\n                    <div class=\"card-footer\">\n                        <h6 class=\"card-subtitle mb-2 text-muted text-center\">" + bulat + "% kamar tersedia dari " + data.kapasitas + " kamar</h6>\n                        <div class=\"progress\">\n                            <div class=\"progress-bar progress-bar-striped bg-info\" role=\"progressbar\" style=\"width: " + persen + "%\"></div>\n                        </div>\n                        <p class=\"card-subtitle mt-2 fs-6 fw-light text-muted text-center\">Update terakhir " + data.update + "</p>\n                    </div>\n                </div>\n            </div>\n        ");
  });
  var puskesmas = dataJumlahPuskesmas;
  console.log(puskesmas);
  puskesmas.forEach(function (data) {
    var persen = data.tersedia / data.kapasitas * 100;
    var bulat = Math.round(persen);
    $('#isi-kelas-tab').append("\n            <div class=\"col-md-4\">\n                <div class=\"card bg-teal-200 mb-3\">\n                    <div class=\"card-body\">\n                        <h1 class=\"card-title\">" + data.tersedia + "</h1>\n                        <p class=\"card-text\">Kamar Tersedia</p>\n                        <h1 class=\"card-text display-6\">" + data.nama + "</h1>\n                    </div>\n                    <div class=\"card-footer\">\n                        <h6 class=\"card-subtitle mb-2 text-muted text-center\">" + bulat + "% kamar tersedia dari " + data.kapasitas + " kamar</h6>\n                        <div class=\"progress\">\n                            <div class=\"progress-bar progress-bar-striped bg-info\" role=\"progressbar\" style=\"width: " + persen + "%\"></div>\n                        </div>\n                        <p class=\"card-subtitle mt-2 fs-6 fw-light text-muted text-center\">Update terakhir " + data.update + "</p>\n                    </div>\n                </div>\n            </div>\n        ");
  });
}

function modalRS(_nama, _alamat) {
  $('#card-detail').html('');
  $('#title').html(_nama);
  $('#alamat-rs').html("\n                <h6>Alamat Rumah Sakit :</h6>\n                <p>" + _alamat + "</p>");
  console.log(_alamat);
  $.ajax({
    method: 'GET',
    dataType: 'json',
    url: base_url + 'ketersediaan/detailRS',
    data: {
      nama: _nama
    },
    success: function success(response) {
      var rs = response;
      rs.forEach(function (data) {
        console.log(data.nama);
        var startTime = window.performance.now();
        setTimeout(function () {
          var endTime = Date.parse(data.update);
          console.log("Time Elapsed : ", endTime - startTime);
        }, 1); // logs ~2000 milliseconds

        $('#card-detail').append("\n                <div class=\"card bg-teal-200 mb-3\">\n                    <div class=\"card-body\">\n                        <h1 class=\"card-title\">" + data.kelas + "</h1>\n                        <p class=\"card-text\">Kamar Tersedia</p>\n                        <h2 class=\"card-text fw-lighter\" id=\"ketersediaan\">" + data.tersedia + "</h2>\n                        <p class=\"card-subtitle mt-2 fs-6 fw-light text-muted text-end\">Update terakhir " + data.update + "</p>\n                    </div>\n                </div>\n                ");
      });
      $('#modal').modal('show');
    }
  });
}

function modalKelas(_kelas) {
  $('#card-detail').html('');
  $('#alamat-rs').html(''); // console.log(nama);

  $.ajax({
    method: 'GET',
    dataType: 'json',
    url: base_url + 'ketersediaan/detailKelas',
    data: {
      kelas: _kelas
    },
    success: function success(response) {
      var kelas = response;
      $('#title').html(kelas[0].kelas);
      kelas.forEach(function (data) {
        console.log(data.kelas);
        $('#card-detail').append("\n                <div class=\"card bg-teal-200 mb-3\">\n                    <div class=\"card-body\">\n                        <h1 class=\"card-title\">" + data.nama + "</h1>\n                        <p class=\"card-text\">Kamar Tersedia</p>\n                        <h2 class=\"card-text fw-lighter\" id=\"ketersediaan\">" + data.tersedia + "</h2>\n                        <p class=\"card-subtitle mt-2 fs-6 fw-light text-muted text-end\">Update terakhir " + data.update + "</p>\n                    </div>\n                </div>\n                ");
      });
      $('#modal').modal('show');
    }
  });
}