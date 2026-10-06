// var wrapper = document.getElementById("signature-pad"),
//     clearButton = wrapper.querySelector("[data-action=clear]"),
//     saveButton = wrapper.querySelector("[data-action=save]"),
//     input = document.getElementById("Signature"),
//     canvas = wrapper.querySelector("canvas"),
//     signaturePad;


// function resizeCanvas() {
//     var ratio = Math.max(window.devicePixelRatio || 1, 1);
//     canvas.width = canvas.offsetWidth * ratio;
//     canvas.height = canvas.offsetHeight * ratio;
//     canvas.getContext("2d").scale(ratio, ratio);
// }

// window.onresize = resizeCanvas;
// resizeCanvas();

// signaturePad = new SignaturePad(canvas);

// clearButton.addEventListener("click", function (event) {
//     signaturePad.clear();
// });

// signNextProcess.addEventListener("click", function (event) {
//     event.preventDefault();
//     if (!signaturePad.isEmpty()) {
//         var a = signaturePad.toDataURL();
//         $('#signerImage').val(a);
//     }
// });

// TTD Pasien
$('#modal_ttd_pasien').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_pasien");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadPasien = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_pasien').on('hidden.bs.modal', function (e) {
    signaturePadPasien.clear();
});

$(document).on('click', '#modal_ttd_pasien .clear', function () {
    signaturePadPasien.clear();
});

$(document).on('click', '#modal_ttd_pasien .save', function () {
    if (signaturePadPasien.isEmpty()) {
        toastr.error("Pasien belum menginputkan tanda tangan");
    } else {
        let dataURLPasien = signaturePadPasien.toDataURL();
        $('#ttd_pasien').attr('src', dataURLPasien);
        $('#url_ttd_pasien').val(dataURLPasien);
        $('#modal_ttd_pasien').modal('hide');
    }
});

//TTD PERAWAT
$('#modal_ttd_perawat').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_perawat");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();

    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadPerawat = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_perawat').on('hidden.bs.modal', function (e) {
    signaturePadPerawat.clear();
});

$(document).on('click', '#modal_ttd_perawat .clear', function () {
    signaturePadPerawat.clear();
});

$(document).on('click', '#modal_ttd_perawat .save', function () {
    if (signaturePadPerawat.isEmpty()) {
        toastr.error("Perawat belum menginputkan tanda tangan");
    } else {
        let dataURLPerawat = signaturePadPerawat.toDataURL();
        $('#ttd_perawat').attr('src', dataURLPerawat);
        $('#url_ttd_perawat').val(dataURLPerawat);
        $('#modal_ttd_perawat').modal('hide');
    }
});


$('#modal_ttd_perawat_poli').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_perawat_poli");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadPerawatPoli = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_perawat_poli').on('hidden.bs.modal', function (e) {
    signaturePadPerawatPoli.clear();
});

$(document).on('click', '#modal_ttd_perawat_poli .clear', function () {
    signaturePadPerawatPoli.clear();
});

$(document).on('click', '#modal_ttd_perawat_poli .save', function () {
    if (signaturePadPerawatPoli.isEmpty()) {
        toastr.error("Perawat poli belum menginputkan tanda tangan");
    } else {
        let dataURLPerawatPoli = signaturePadPerawatPoli.toDataURL();
        $('#ttd_perawat_poli').attr('src', dataURLPerawatPoli);
        $('#url_ttd_perawat_poli').val(dataURLPerawatPoli);
        $('#modal_ttd_perawat_poli').modal('hide');
    }
});

$('#modal_ttd_perawat_igd').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_perawat_igd");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadPerawatIgd = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_perawat_igd').on('hidden.bs.modal', function (e) {
    signaturePadPerawatIgd.clear();
});

$(document).on('click', '#modal_ttd_perawat_igd .clear', function () {
    signaturePadPerawatIgd.clear();
});

$(document).on('click', '#modal_ttd_perawat_igd .save', function () {
    if (signaturePadPerawatIgd.isEmpty()) {
        toastr.error("Perawat IGD belum menginputkan tanda tangan");
    } else {
        let dataURLPerawatIgd = signaturePadPerawatIgd.toDataURL();
        $('#ttd_perawat_igd').attr('src', dataURLPerawatIgd);
        $('#url_ttd_perawat_igd').val(dataURLPerawatIgd);
        $('#modal_ttd_perawat_igd').modal('hide');
    }
});

//TTD DOKTER IGD
$('#modal_ttd_dok_igd').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_dok_igd");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadDokIgd = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_dok_igd').on('hidden.bs.modal', function (e) {
    signaturePadDokIgd.clear();
});

$(document).on('click', '#modal_ttd_dok_igd .clear', function () {
    signaturePadDokIgd.clear();
});

$(document).on('click', '#modal_ttd_dok_igd .save', function () {
    if (signaturePadDokIgd.isEmpty()) {
        toastr.error("Dokter IGD belum menginputkan tanda tangan");
    } else {
        let dataURLDokIgd = signaturePadDokIgd.toDataURL();
        $('#ttd_dok_igd').attr('src', dataURLDokIgd);
        $('#url_ttd_dok_igd').val(dataURLDokIgd);
        $('#modal_ttd_dok_igd').modal('hide');
    }
});

//dpjp
//TTD DOKTER DPJP
$('#modal_ttd_dokdpjp').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_dokdpjp");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadDokDpjp = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_dokdpjp').on('hidden.bs.modal', function (e) {
    signaturePadDokDpjp.clear();
});

$(document).on('click', '#modal_ttd_dokdpjp .clear', function () {
    signaturePadDokDpjp.clear();
});

$(document).on('click', '#modal_ttd_dokdpjp .save', function () {
    if (signaturePadDokDpjp.isEmpty()) {
        toastr.error("Dokter DPJP belum menginputkan tanda tangan");
    } else {
        let dataURLDokDpjp = signaturePadDokDpjp.toDataURL();
        $('#ttd_dokdpjp').attr('src', dataURLDokDpjp);
        $('#url_ttd_dokdpjp').val(dataURLDokDpjp);
        $('#modal_ttd_dokdpjp').modal('hide');
    }
});

//TTD DOKTER DPJP2
$('#modal_ttd_dokdpjp2').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_dokdpjp2");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadDokDpjp = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_dokdpjp2').on('hidden.bs.modal', function (e) {
    signaturePadDokDpjp.clear();
});

$(document).on('click', '#modal_ttd_dokdpjp2 .clear', function () {
    signaturePadDokDpjp.clear();
});

$(document).on('click', '#modal_ttd_dokdpjp2 .save', function () {
    if (signaturePadDokDpjp.isEmpty()) {
        toastr.error("Dokter DPJP belum menginputkan tanda tangan");
    } else {
        let dataURLDokDpjp = signaturePadDokDpjp.toDataURL();
        $('#ttd_dokdpjp2').attr('src', dataURLDokDpjp);
        $('#url_ttd_dokdpjp2').val(dataURLDokDpjp);
        $('#modal_ttd_dokdpjp2').modal('hide');
    }
});

// TTD Nutrisionis
$('#modal_ttd_nutrisionis').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_nutrisionis");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadNutrisionis = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_nutrisionis').on('hidden.bs.modal', function (e) {
    signaturePadNutrisionis.clear();
});

$(document).on('click', '#modal_ttd_nutrisionis .clear', function () {
    signaturePadNutrisionis.clear();
});

$(document).on('click', '#modal_ttd_nutrisionis .save', function () {
    if (signaturePadNutrisionis.isEmpty()) {
        toastr.error("Pasien belum menginputkan tanda tangan");
    } else {
        let dataURLPasien = signaturePadNutrisionis.toDataURL();
        $('#ttd_nutrisionis').attr('src', dataURLPasien);
        $('#url_ttd_nutrisionis').val(dataURLPasien);
        $('#modal_ttd_nutrisionis').modal('hide');
    }
});

$('#modal_ttd_nutrisionis_harian').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_nutrisionis_harian");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadNutrisionisHarian = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_nutrisionis_harian').on('hidden.bs.modal', function (e) {
    signaturePadNutrisionisHarian.clear();
});

$(document).on('click', '#modal_ttd_nutrisionis_harian .clear', function () {
    signaturePadNutrisionisHarian.clear();
});

$(document).on('click', '#modal_ttd_nutrisionis_harian .save', function () {
    if (signaturePadNutrisionisHarian.isEmpty()) {
        toastr.error("Nutrisionis belum menginputkan tanda tangan");
    } else {
        let dataURLPasien = signaturePadNutrisionisHarian.toDataURL();
        $('#ttd_nutrisionis_harian').attr('src', dataURLPasien);
        $('#url_ttd_nutrisionis_harian').val(dataURLPasien);
        $('#modal_ttd_nutrisionis_harian').modal('hide');
        $('#modal_gizi_harian').modal('show');
    }
});

// Genogram Pengkajian Kesehatan Jiwa
$('#modal_genogram_psikososial').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_genogram");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    genogramPad = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_genogram_psikososial').on('hidden.bs.modal', function (e) {
    genogramPad.clear();
});

$(document).on('click', '#modal_genogram_psikososial .clear', function () {
    genogramPad.clear();
});

$(document).on('click', '#modal_genogram_psikososial .save', function () {
    if (genogramPad.isEmpty()) {
        toastr.error("Perawat belum menginputkan genogram");
    } else {
        let dataURLGenogram = genogramPad.toDataURL();
        $('#genogram_psikososial').attr('src', dataURLGenogram);
        $('#url_genogram_psikososial').val(dataURLGenogram);
        $('#modal_genogram_psikososial').modal('hide');
    }
});

// TTD Perawat Pengkajian Kesehatan Jiwa
$('#modal_ttd_perawat_kesehatan_jiwa').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_perawat_kesehatan_jiwa");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePad = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_perawat_kesehatan_jiwa').on('hidden.bs.modal', function (e) {
    signaturePad.clear();
});

$(document).on('click', '#modal_ttd_perawat_kesehatan_jiwa .clear', function () {
    signaturePad.clear();
});

$(document).on('click', '#modal_ttd_perawat_kesehatan_jiwa .save', function () {
    if (signaturePad.isEmpty()) {
        toastr.error("Perawat belum menginputkan genogram");
    } else {
        let dataURLTTD = signaturePad.toDataURL();
        $('#ttd_perawat_kesehatan_jiwa').attr('src', dataURLTTD);
        $('#url_ttd_perawat_kesehatan_jiwa').val(dataURLTTD);
        $('#modal_ttd_perawat_kesehatan_jiwa').modal('hide');
    }
});

// Genogram Pengkajian Kesehatan Jiwa
$('#modal_genogram_psikososial').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_genogram");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    genogramPad = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_genogram_psikososial').on('hidden.bs.modal', function (e) {
    genogramPad.clear();
});

$(document).on('click', '#modal_genogram_psikososial .clear', function () {
    genogramPad.clear();
});

$(document).on('click', '#modal_genogram_psikososial .save', function () {
    if (genogramPad.isEmpty()) {
        toastr.error("Perawat belum menginputkan genogram");
    } else {
        let dataURLGenogram = genogramPad.toDataURL();
        $('#genogram_psikososial').attr('src', dataURLGenogram);
        $('#url_genogram_psikososial').val(dataURLGenogram);
        $('#modal_genogram_psikososial').modal('hide');
    }
});

// TTD Perawat Pengkajian Kesehatan Jiwa
$('#modal_ttd_perawat_kesehatan_jiwa').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_perawat_kesehatan_jiwa");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePad = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_perawat_kesehatan_jiwa').on('hidden.bs.modal', function (e) {
    signaturePad.clear();
});

$(document).on('click', '#modal_ttd_perawat_kesehatan_jiwa .clear', function () {
    signaturePad.clear();
});

$(document).on('click', '#modal_ttd_perawat_kesehatan_jiwa .save', function () {
    if (signaturePad.isEmpty()) {
        toastr.error("Perawat belum menginputkan genogram");
    } else {
        let dataURLTTD = signaturePad.toDataURL();
        $('#ttd_perawat_kesehatan_jiwa').attr('src', dataURLTTD);
        $('#url_ttd_perawat_kesehatan_jiwa').val(dataURLTTD);
        $('#modal_ttd_perawat_kesehatan_jiwa').modal('hide');
    }
});

// TTD Nutrisionis Gizi Harian
$('#modal_ttd_nutrisionis_gizi_harian').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_nutrisionis_gizi_harian");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadNutrisionis = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_nutrisionis_gizi_harian').on('hidden.bs.modal', function (e) {
    signaturePadNutrisionis.clear();
});

$(document).on('click', '#modal_ttd_nutrisionis_gizi_harian .clear', function () {
    signaturePadNutrisionis.clear();
});

$(document).on('click', '#modal_ttd_nutrisionis_gizi_harian .save', function () {
    if (signaturePadNutrisionis.isEmpty()) {
        toastr.error("Pasien belum menginputkan tanda tangan");
    } else {
        let dataURLPasien = signaturePadNutrisionis.toDataURL();
        $('#ttd_nutrisionis_gizi_harian').attr('src', dataURLPasien);
        $('#url_ttd_nutrisionis_gizi_harian').val(dataURLPasien);
        $('#modal_ttd_nutrisionis_gizi_harian').modal('hide');
    }
});

// TTD Perawat Inap
$('#modal_ttd_perawat_inap').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_perawat_inap");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadPerawatInap = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_perawat_inap').on('hidden.bs.modal', function (e) {
    signaturePadPerawatInap.clear();
});

$(document).on('click', '#modal_ttd_perawat_inap .clear', function () {
    signaturePadPerawatInap.clear();
});

$(document).on('click', '#modal_ttd_perawat_inap .save', function () {
    if (signaturePadPerawatInap.isEmpty()) {
        toastr.error("Pasien belum menginputkan tanda tangan");
    } else {
        let dataURLPerawatInap = signaturePadPerawatInap.toDataURL();
        $('#ttd_perawat_inap').attr('src', dataURLPerawatInap);
        $('#url_ttd_perawat_inap').val(dataURLPerawatInap);
        $('#modal_ttd_perawat_inap').modal('hide');
    }
});

// TTD PASIEN EDUKASI
$('#modal_ttd_pasien_edukasi').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_pasien_edukasi");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadNutrisionis = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_pasien_edukasi').on('hidden.bs.modal', function (e) {
    signaturePadNutrisionis.clear();
});

$(document).on('click', '#modal_ttd_pasien_edukasi .clear', function () {
    signaturePadNutrisionis.clear();
});

$(document).on('click', '#modal_ttd_pasien_edukasi .save', function () {
    if (signaturePadNutrisionis.isEmpty()) {
        toastr.error("Pasien belum menginputkan tanda tangan");
    } else {
        let dataURLPasien = signaturePadNutrisionis.toDataURL();
        $('#ttd_pasien_edukasi').attr('src', dataURLPasien);
        $('#url_ttd_pasien_edukasi').val(dataURLPasien);
        $('#modal_ttd_pasien_edukasi').modal('hide');
    }
});

// TTD EDUKATOR
$('#modal_ttd_edukator').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_edukator");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadEdukator = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_edukator').on('hidden.bs.modal', function (e) {
    signaturePadEdukator.clear();
});

$(document).on('click', '#modal_ttd_edukator .clear', function () {
    signaturePadEdukator.clear();
});

$(document).on('click', '#modal_ttd_edukator .save', function () {
    if (signaturePadEdukator.isEmpty()) {
        toastr.error("Edukator belum menginputkan tanda tangan");
    } else {
        let dataURLPerawatInap = signaturePadEdukator.toDataURL();
        $('#ttd_edukator').attr('src', dataURLPerawatInap);
        $('#url_ttd_edukator').val(dataURLPerawatInap);
        $('#modal_ttd_edukator').modal('hide');
    }
});

// TTD PASIEN INFORMASI EDUKASI
$('#modal_ttd_pasien_informasi_edukasi').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_pasien_edukasi_informasi");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadNutrisionis = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_pasien_informasi_edukasi').on('hidden.bs.modal', function (e) {
    signaturePadNutrisionis.clear();
});

$(document).on('click', '#modal_ttd_pasien_informasi_edukasi .clear', function () {
    signaturePadNutrisionis.clear();
});

$(document).on('click', '#modal_ttd_pasien_informasi_edukasi .save', function () {
    if (signaturePadNutrisionis.isEmpty()) {
        toastr.error("Pasien belum menginputkan tanda tangan");
    } else {
        let dataURLPasien = signaturePadNutrisionis.toDataURL();
        $('#ttd_pasien_edukasi_informasi').attr('src', dataURLPasien);
        $('#url_ttd_pasien_edukasi_informasi').val(dataURLPasien);
        $('#modal_ttd_pasien_informasi_edukasi').modal('hide');
    }
});

// TTD STAF RS INFORMASI EDUKASI
$('#modal_ttd_staf_rs').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_pasien_edukasi_informasi");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadEdukator = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_staf_rs').on('hidden.bs.modal', function (e) {
    signaturePadEdukator.clear();
});

$(document).on('click', '#modal_ttd_staf_rs .clear', function () {
    signaturePadEdukator.clear();
});

$(document).on('click', '#modal_ttd_staf_rs .save', function () {
    if (signaturePadEdukator.isEmpty()) {
        toastr.error("Edukator belum menginputkan tanda tangan");
    } else {
        let dataURLPerawatInap = signaturePadEdukator.toDataURL();
        $('#ttd_staf_rs').attr('src', dataURLPerawatInap);
        $('#url_ttd_staf_rs').val(dataURLPerawatInap);
        $('#modal_ttd_staf_rs').modal('hide');
    }
});

// TTD DPJP 1
$('#modal_ttd_dpjp_1').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_dpjp_1");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadDPJP1 = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_dpjp_1').on('hidden.bs.modal', function (e) {
    signaturePadDPJP1.clear();
});

$(document).on('click', '#modal_ttd_dpjp_1 .clear', function () {
    signaturePadDPJP1.clear();
});

$(document).on('click', '#modal_ttd_dpjp_1 .save', function () {
    if (signaturePadDPJP1.isEmpty()) {
        toastr.error("DPJP belum menginputkan tanda tangan");
    } else {
        let dataURLDPJP1 = signaturePadDPJP1.toDataURL();
        $('#ttd_dpjp_1').attr('src', dataURLDPJP1);
        $('#ttd_dpjp_2').attr('src', dataURLDPJP1);
        $('#url_ttd_dpjp_1').val(dataURLDPJP1);
        $('#modal_ttd_dpjp_1').modal('hide');
    }
});

// TTD DPJP 2
$('#modal_ttd_dpjp_2').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_dpjp_2");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadDPJP2 = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_dpjp_2').on('hidden.bs.modal', function (e) {
    signaturePadDPJP2.clear();
});

$(document).on('click', '#modal_ttd_dpjp_2 .clear', function () {
    signaturePadDPJP2.clear();
});

$(document).on('click', '#modal_ttd_dpjp_2 .save', function () {
    if (signaturePadDPJP2.isEmpty()) {
        toastr.error("DPJP belum menginputkan tanda tangan");
    } else {
        let dataURLDPJP2 = signaturePadDPJP2.toDataURL();
        $('#ttd_dpjp_2').attr('src', dataURLDPJP2);
        $('#url_ttd_dpjp_2').val(dataURLDPJP2);
        $('#modal_ttd_dpjp_2').modal('hide');
    }
});

// TTD STAF RS INFORMASI EDUKASI
$('#modal_ttd_pas_kel').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_pas_kel");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadPasKel = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_pas_kel').on('hidden.bs.modal', function (e) {
    signaturePadPasKel.clear();
});

$(document).on('click', '#modal_ttd_pas_kel .clear', function () {
    signaturePadPasKel.clear();
});

$(document).on('click', '#modal_ttd_pas_kel .save', function () {
    if (signaturePadPasKel.isEmpty()) {
        toastr.error("Pasien / Keluarga belum menginputkan tanda tangan");
    } else {
        let dataURLPerawatInap = signaturePadPasKel.toDataURL();
        $('#ttd_kel_pas').attr('src', dataURLPerawatInap);
        $('#url_ttd_kel_pas').val(dataURLPerawatInap);
        $('#modal_ttd_pas_kel').modal('hide');
    }
});


// TTD PASIEN PASIEN INAP
$('#modal_ttd_pasien_farmasi').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_pasien_farmasi");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadPasienFarmasi = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_pasien_farmasi').on('hidden.bs.modal', function (e) {
    signaturePadPasienFarmasi.clear();
});

$(document).on('click', '#modal_ttd_pasien_farmasi .clear', function () {
    signaturePadPasienFarmasi.clear();
});

$(document).on('click', '#modal_ttd_pasien_farmasi .save', function () {
    if (signaturePadPasienFarmasi.isEmpty()) {
        toastr.error("Pasien belum menginputkan tanda tangan");
    } else {
        let dataURLPasien = signaturePadPasienFarmasi.toDataURL();
        $('#ttd_farmasi_pasien_farmasi').attr('src', dataURLPasien);
        $('#url_ttd_pasien_farmasi').val(dataURLPasien);
        $('#modal_ttd_pasien_farmasi').modal('hide');
    }
});

//TTD PERAWAT FARMASI INAP
$('#modal_ttd_perawat_farmasi').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_perawat_farmasi");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadPerawatFarmasi = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_perawat_farmasi').on('hidden.bs.modal', function (e) {
    signaturePadPerawatFarmasi.clear();
});

$(document).on('click', '#modal_ttd_perawat_farmasi .clear', function () {
    signaturePadPerawatFarmasi.clear();
});

$(document).on('click', '#modal_ttd_perawat_farmasi .save', function () {
    if (signaturePadPerawatFarmasi.isEmpty()) {
        toastr.error("Perawat belum menginputkan tanda tangan");
    } else {
        let dataURLPerawat = signaturePadPerawatFarmasi.toDataURL();
        $('#ttd_perawat_farmasi').attr('src', dataURLPerawat);
        $('#url_ttd_perawat_farmasi').val(dataURLPerawat);
        $('#modal_ttd_perawat_farmasi').modal('hide');
    }
});


//TTD CASE MANAGER INAP
$('#modal_ttd_case_manager').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_case_manager");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadcaseManager = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_case_manager').on('hidden.bs.modal', function (e) {
    signaturePadcaseManager.clear();
});

$(document).on('click', '#modal_ttd_case_manager .clear', function () {
    signaturePadcaseManager.clear();
});

$(document).on('click', '#modal_ttd_case_manager .save', function () {
    if (signaturePadcaseManager.isEmpty()) {
        toastr.error("Perawat belum menginputkan tanda tangan");
    } else {
        let dataURLManager = signaturePadcaseManager.toDataURL();
        $('#ttd_case_manager').attr('src', dataURLManager);
        $('#url_ttd_case_manager').val(dataURLManager);
        $('#modal_ttd_case_manager').modal('hide');
    }
});

// TTD PASIEN PASIEN INAP
$('#modal_ttd_pasien_farmasi').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_pasien_farmasi");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadPasienFarmasi = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_pasien_farmasi').on('hidden.bs.modal', function (e) {
    signaturePadPasienFarmasi.clear();
});

$(document).on('click', '#modal_ttd_pasien_farmasi .clear', function () {
    signaturePadPasienFarmasi.clear();
});

$(document).on('click', '#modal_ttd_pasien_farmasi .save', function () {
    if (signaturePadPasienFarmasi.isEmpty()) {
        toastr.error("Pasien belum menginputkan tanda tangan");
    } else {
        let dataURLPasien = signaturePadPasienFarmasi.toDataURL();
        $('#ttd_farmasi_pasien_farmasi').attr('src', dataURLPasien);
        $('#url_ttd_pasien_farmasi').val(dataURLPasien);
        $('#modal_ttd_pasien_farmasi').modal('hide');
    }
});

//TTD PERAWAT FARMASI INAP
$('#modal_ttd_perawat_farmasi').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_perawat_farmasi");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadPerawatFarmasi = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_perawat_farmasi').on('hidden.bs.modal', function (e) {
    signaturePadPerawatFarmasi.clear();
});

$(document).on('click', '#modal_ttd_perawat_farmasi .clear', function () {
    signaturePadPerawatFarmasi.clear();
});

$(document).on('click', '#modal_ttd_perawat_farmasi .save', function () {
    if (signaturePadPerawatFarmasi.isEmpty()) {
        toastr.error("Perawat belum menginputkan tanda tangan");
    } else {
        let dataURLPerawat = signaturePadPerawatFarmasi.toDataURL();
        $('#ttd_perawat_farmasi').attr('src', dataURLPerawat);
        $('#url_ttd_perawat_farmasi').val(dataURLPerawat);
        $('#modal_ttd_perawat_farmasi').modal('hide');
    }
});


//TTD CASE MANAGER INAP
$('#modal_ttd_case_manager').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_case_manager");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadcaseManager = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_case_manager').on('hidden.bs.modal', function (e) {
    signaturePadcaseManager.clear();
});

$(document).on('click', '#modal_ttd_case_manager .clear', function () {
    signaturePadcaseManager.clear();
});

$(document).on('click', '#modal_ttd_case_manager .save', function () {
    if (signaturePadcaseManager.isEmpty()) {
        toastr.error("Perawat belum menginputkan tanda tangan");
    } else {
        let dataURLManager = signaturePadcaseManager.toDataURL();
        $('#ttd_case_manager').attr('src', dataURLManager);
        $('#url_ttd_case_manager').val(dataURLManager);
        $('#modal_ttd_case_manager').modal('hide');
    }
});

// TTD Pasien DKTR
$('#modal_ttd_pasien_dktr').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_pasien_dktr");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadPasien = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_pasien_dktr').on('hidden.bs.modal', function (e) {
    signaturePadPasien.clear();
});

$(document).on('click', '#modal_ttd_pasien_dktr .clear', function () {
    signaturePadPasien.clear();
});

$(document).on('click', '#modal_ttd_pasien_dktr .save', function () {
    if (signaturePadPasien.isEmpty()) {
        toastr.error("Pasien belum menginputkan tanda tangan");
    } else {
        let dataURLPasien = signaturePadPasien.toDataURL();
        $('#ttd_pasien_dktr').attr('src', dataURLPasien);
        $('#url_ttd_pasien_dktr').val(dataURLPasien);
        $('#modal_ttd_pasien_dktr').modal('hide');
    }
});

//TTD EDUKATOR EDUKASI
$('#modal_ttd_edukator_dktr').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_edukator_dktr");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
        signaturePadEdukator = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_edukator_dktr').on('hidden.bs.modal', function (e) {
    signaturePadEdukator.clear();
});

$(document).on('click', '#modal_ttd_edukator_dktr .clear', function () {
    signaturePadEdukator.clear();
});

$(document).on('click', '#modal_ttd_edukator_dktr .save', function () {
    if (signaturePadEdukator.isEmpty()) {
        toastr.error("Pasien belum menginputkan tanda tangan");
    } else {
        let dataURLEdukator = signaturePadEdukator.toDataURL();
        $('#ttd_edukator_dktr').attr('src', dataURLEdukator);
        $('#url_ttd_edukator_dktr').val(dataURLEdukator);
        $('#modal_ttd_edukator_dktr').modal('hide');
    }
});

// TTD Pasien EDUKASI
$('#modal_ttd_pasien_psikolog').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_pasien_psikolog");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadPasien = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_pasien_psikolog').on('hidden.bs.modal', function (e) {
    signaturePadPasien.clear();
});

$(document).on('click', '#modal_ttd_pasien_psikolog .clear', function () {
    signaturePadPasien.clear();
});

$(document).on('click', '#modal_ttd_pasien_psikolog .save', function () {
    if (signaturePadPasien.isEmpty()) {
        toastr.error("Pasien belum menginputkan tanda tangan");
    } else {
        let dataURLPasien = signaturePadPasien.toDataURL();
        $('#ttd_pasien_psikolog').attr('src', dataURLPasien);
        $('#url_ttd_pasien_psikolog').val(dataURLPasien);
        $('#modal_ttd_pasien_psikolog').modal('hide');
    }
});

//TTD EDUKATOR EDUKASI
$('#modal_ttd_edukator_psikolog').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_edukator_psikolog");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
        signaturePadEdukator = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_edukator_psikolog').on('hidden.bs.modal', function (e) {
    signaturePadEdukator.clear();
});

$(document).on('click', '#modal_ttd_edukator_psikolog .clear', function () {
    signaturePadEdukator.clear();
});

$(document).on('click', '#modal_ttd_edukator_psikolog .save', function () {
    if (signaturePadEdukator.isEmpty()) {
        toastr.error("Pasien belum menginputkan tanda tangan");
    } else {
        let dataURLEdukator = signaturePadEdukator.toDataURL();
        $('#ttd_edukator_psikolog').attr('src', dataURLEdukator);
        $('#url_ttd_edukator_psikolog').val(dataURLEdukator);
        $('#modal_ttd_edukator_psikolog').modal('hide');
    }
});

// TTD Pasien EDUKASI
$('#modal_ttd_pasien_apoteker').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_pasien_apoteker");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadPasien = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_pasien_apoteker').on('hidden.bs.modal', function (e) {
    signaturePadPasien.clear();
});

$(document).on('click', '#modal_ttd_pasien_apoteker .clear', function () {
    signaturePadPasien.clear();
});

$(document).on('click', '#modal_ttd_pasien_apoteker .save', function () {
    if (signaturePadPasien.isEmpty()) {
        toastr.error("Pasien belum menginputkan tanda tangan");
    } else {
        let dataURLPasien = signaturePadPasien.toDataURL();
        $('#ttd_pasien_apoteker').attr('src', dataURLPasien);
        $('#url_ttd_pasien_apoteker').val(dataURLPasien);
        $('#modal_ttd_pasien_apoteker').modal('hide');
    }
});

//TTD EDUKATOR EDUKASI
$('#modal_ttd_edukator_apoteker').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_edukator_apoteker");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
        signaturePadEdukator = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_edukator_apoteker').on('hidden.bs.modal', function (e) {
    signaturePadEdukator.clear();
});

$(document).on('click', '#modal_ttd_edukator_apoteker .clear', function () {
    signaturePadEdukator.clear();
});

$(document).on('click', '#modal_ttd_edukator_apoteker .save', function () {
    if (signaturePadEdukator.isEmpty()) {
        toastr.error("Pasien belum menginputkan tanda tangan");
    } else {
        let dataURLEdukator = signaturePadEdukator.toDataURL();
        $('#ttd_edukator_apoteker').attr('src', dataURLEdukator);
        $('#url_ttd_edukator_apoteker').val(dataURLEdukator);
        $('#modal_ttd_edukator_apoteker').modal('hide');
    }
});

// TTD Pasien EDUKASI
$('#modal_ttd_pasien_nutrisionis').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_pasien_nutrisionis");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadPasien = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_pasien_nutrisionis').on('hidden.bs.modal', function (e) {
    signaturePadPasien.clear();
});

$(document).on('click', '#modal_ttd_pasien_nutrisionis .clear', function () {
    signaturePadPasien.clear();
});

$(document).on('click', '#modal_ttd_pasien_nutrisionis .save', function () {
    if (signaturePadPasien.isEmpty()) {
        toastr.error("Pasien belum menginputkan tanda tangan");
    } else {
        let dataURLPasien = signaturePadPasien.toDataURL();
        $('#ttd_pasien_nutrisionis').attr('src', dataURLPasien);
        $('#url_ttd_pasien_nutrisionis').val(dataURLPasien);
        $('#modal_ttd_pasien_nutrisionis').modal('hide');
    }
});

//TTD EDUKATOR EDUKASI
$('#modal_ttd_edukator_nutrisionis').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_edukator_nutrisionis");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
        signaturePadEdukator = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_edukator_nutrisionis').on('hidden.bs.modal', function (e) {
    signaturePadEdukator.clear();
});

$(document).on('click', '#modal_ttd_edukator_nutrisionis .clear', function () {
    signaturePadEdukator.clear();
});

$(document).on('click', '#modal_ttd_edukator_nutrisionis .save', function () {
    if (signaturePadEdukator.isEmpty()) {
        toastr.error("Pasien belum menginputkan tanda tangan");
    } else {
        let dataURLEdukator = signaturePadEdukator.toDataURL();
        $('#ttd_edukator_nutrisionis').attr('src', dataURLEdukator);
        $('#url_ttd_edukator_nutrisionis').val(dataURLEdukator);
        $('#modal_ttd_edukator_nutrisionis').modal('hide');
    }
});

// TTD Pasien EDUKASI
$('#modal_ttd_pasien_terapis').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_pasien_terapis");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadPasien = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_pasien_terapis').on('hidden.bs.modal', function (e) {
    signaturePadPasien.clear();
});

$(document).on('click', '#modal_ttd_pasien_terapis .clear', function () {
    signaturePadPasien.clear();
});

$(document).on('click', '#modal_ttd_pasien_terapis .save', function () {
    if (signaturePadPasien.isEmpty()) {
        toastr.error("Pasien belum menginputkan tanda tangan");
    } else {
        let dataURLPasien = signaturePadPasien.toDataURL();
        $('#ttd_pasien_terapis').attr('src', dataURLPasien);
        $('#url_ttd_pasien_terapis').val(dataURLPasien);
        $('#modal_ttd_pasien_terapis').modal('hide');
    }
});

//TTD EDUKATOR EDUKASI
$('#modal_ttd_edukator_terapis').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_edukator_terapis");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
        signaturePadEdukator = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_edukator_terapis').on('hidden.bs.modal', function (e) {
    signaturePadEdukator.clear();
});

$(document).on('click', '#modal_ttd_edukator_terapis .clear', function () {
    signaturePadEdukator.clear();
});

$(document).on('click', '#modal_ttd_edukator_terapis .save', function () {
    if (signaturePadEdukator.isEmpty()) {
        toastr.error("Pasien belum menginputkan tanda tangan");
    } else {
        let dataURLEdukator = signaturePadEdukator.toDataURL();
        $('#ttd_edukator_terapis').attr('src', dataURLEdukator);
        $('#url_ttd_edukator_terapis').val(dataURLEdukator);
        $('#modal_ttd_edukator_terapis').modal('hide');
    }
});

// TTD Pasien EDUKASI
$('#modal_ttd_pasien_perawat').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_pasien_perawat");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadPasien = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_pasien_perawat').on('hidden.bs.modal', function (e) {
    signaturePadPasien.clear();
});

$(document).on('click', '#modal_ttd_pasien_perawat .clear', function () {
    signaturePadPasien.clear();
});

$(document).on('click', '#modal_ttd_pasien_perawat .save', function () {
    if (signaturePadPasien.isEmpty()) {
        toastr.error("Pasien belum menginputkan tanda tangan");
    } else {
        let dataURLPasien = signaturePadPasien.toDataURL();
        $('#ttd_pasien_perawat').attr('src', dataURLPasien);
        $('#url_ttd_pasien_perawat').val(dataURLPasien);
        $('#modal_ttd_pasien_perawat').modal('hide');
    }
});

//TTD EDUKATOR EDUKASI
$('#modal_ttd_edukator_perawat').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_edukator_perawat");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
        signaturePadEdukator = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_edukator_perawat').on('hidden.bs.modal', function (e) {
    signaturePadEdukator.clear();
});

$(document).on('click', '#modal_ttd_edukator_perawat .clear', function () {
    signaturePadEdukator.clear();
});

$(document).on('click', '#modal_ttd_edukator_perawat .save', function () {
    if (signaturePadEdukator.isEmpty()) {
        toastr.error("Pasien belum menginputkan tanda tangan");
    } else {
        let dataURLEdukator = signaturePadEdukator.toDataURL();
        $('#ttd_edukator_perawat').attr('src', dataURLEdukator);
        $('#url_ttd_edukator_perawat').val(dataURLEdukator);
        $('#modal_ttd_edukator_perawat').modal('hide');
    }
});

$('#modal_ttd_petugas_radiografer').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_radiografer");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadRadiografer = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_petugas_radiografer').on('hidden.bs.modal', function (e) {
    signaturePadRadiografer.clear();
});

$(document).on('click', '#modal_ttd_petugas_radiografer .clear', function () {
    signaturePadRadiografer.clear();
});

$(document).on('click', '#modal_ttd_petugas_radiografer .save', function () {
    if (signaturePadRadiografer.isEmpty()) {
        toastr.error("Radiografer belum menginputkan tanda tangan");
    } else {
        let dataURLRadiografer = signaturePadRadiografer.toDataURL();
        $('#ttd_radiografer').attr('src', dataURLRadiografer);
        $('#url_ttd_radiografer').val(dataURLRadiografer);
        $('#modal_ttd_petugas_radiografer').modal('hide');
        $('#modal_catat_hasil_rad').modal('show');
    }
});

$('#modal_ttd_psikiater').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_psikiater");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadPsikiater = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_psikiater').on('hidden.bs.modal', function (e) {
    signaturePadPsikiater.clear();
});

$(document).on('click', '#modal_ttd_psikiater .clear', function () {
    signaturePadPsikiater.clear();
});

$(document).on('click', '#modal_ttd_psikiater .save', function () {
    if (signaturePadPsikiater.isEmpty()) {
        toastr.error("Psikiater belum menginputkan tanda tangan");
    } else {
        let dataURLPsikiater = signaturePadPsikiater.toDataURL();
        $('#ttd_psikiater').attr('src', dataURLPsikiater);
        $('#url_ttd_psikiater').val(dataURLPsikiater);
        $('#modal_ttd_psikiater').modal('hide');
    }
});

$('#modal_ttd_perawat_rehab').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_perawat_rehab");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadPerawatRehab = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_perawat_rehab').on('hidden.bs.modal', function (e) {
    signaturePadPerawatRehab.clear();
});

$(document).on('click', '#modal_ttd_perawat_rehab .clear', function () {
    signaturePadPerawatRehab.clear();
});

$(document).on('click', '#modal_ttd_perawat_rehab .save', function () {
    if (signaturePadPerawatRehab.isEmpty()) {
        toastr.error("Perawat Rehabilitasi belum menginputkan tanda tangan");
    } else {
        let dataURLPsikiater = signaturePadPerawatRehab.toDataURL();
        $('#ttd_perawat_rehab').attr('src', dataURLPsikiater);
        $('#url_ttd_perawat_rehab').val(dataURLPsikiater);
        $('#modal_ttd_perawat_rehab').modal('hide');
    }
});

$('#modal_ttd_okupasi_terapis').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_okupasi_terapis");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadOkupasiTerapis = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_okupasi_terapis').on('hidden.bs.modal', function (e) {
    signaturePadOkupasiTerapis.clear();
});

$(document).on('click', '#modal_ttd_okupasi_terapis .clear', function () {
    signaturePadOkupasiTerapis.clear();
});

$(document).on('click', '#modal_ttd_okupasi_terapis .save', function () {
    if (signaturePadOkupasiTerapis.isEmpty()) {
        toastr.error("Okupasi Terapis belum menginputkan tanda tangan");
    } else {
        let dataURLPsikiater = signaturePadOkupasiTerapis.toDataURL();
        $('#ttd_okupasi_terapis').attr('src', dataURLPsikiater);
        $('#url_ttd_okupasi_terapis').val(dataURLPsikiater);
        $('#modal_ttd_okupasi_terapis').modal('hide');
    }
});

$('#modal_ttd_peksos').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_pekerja_sosial");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadPekerjaSosial = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_peksos').on('hidden.bs.modal', function (e) {
    signaturePadPekerjaSosial.clear();
});

$(document).on('click', '#modal_ttd_peksos .clear', function () {
    signaturePadPekerjaSosial.clear();
});

$(document).on('click', '#modal_ttd_peksos .save', function () {
    if (signaturePadPekerjaSosial.isEmpty()) {
        toastr.error("Pekerja Sosial belum menginputkan tanda tangan");
    } else {
        let dataURLPekerjaSosial = signaturePadPekerjaSosial.toDataURL();
        $('#ttd_peksos').attr('src', dataURLPekerjaSosial);
        $('#url_ttd_peksos').val(dataURLPekerjaSosial);
        $('#modal_ttd_peksos').modal('hide');
    }
});

$('#modal_ttd_psikolog').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_psikolog");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadPekerjaSosial = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_psikolog').on('hidden.bs.modal', function (e) {
    signaturePadPekerjaSosial.clear();
});

$(document).on('click', '#modal_ttd_psikolog .clear', function () {
    signaturePadPekerjaSosial.clear();
});

$(document).on('click', '#modal_ttd_psikolog .save', function () {
    if (signaturePadPekerjaSosial.isEmpty()) {
        toastr.error("Psikolog belum menginputkan tanda tangan");
    } else {
        let dataURLPekerjaSosial = signaturePadPekerjaSosial.toDataURL();
        $('#ttd_psikolog').attr('src', dataURLPekerjaSosial);
        $('#url_ttd_psikolog').val(dataURLPekerjaSosial);
        $('#modal_ttd_psikolog').modal('hide');
    }
});

$('#modal_ttd_psikiater_tindakan').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_psikiater_tindakan");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadPsikiater = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_psikiater_tindakan').on('hidden.bs.modal', function (e) {
    signaturePadPsikiater.clear();
});

$(document).on('click', '#modal_ttd_psikiater_tindakan .clear', function () {
    signaturePadPsikiater.clear();
});

$(document).on('click', '#modal_ttd_psikiater_tindakan .save', function () {
    if (signaturePadPsikiater.isEmpty()) {
        toastr.error("Psikiater belum menginputkan tanda tangan");
    } else {
        let dataURLPsikiater = signaturePadPsikiater.toDataURL();
        $('#ttd_psikiater_tindakan').attr('src', dataURLPsikiater);
        $('#url_ttd_psikiater_tindakan').val(dataURLPsikiater);
        $('#modal_ttd_psikiater_tindakan').modal('hide');
    }
});

// TTD PENERIMA UNTUK RINGKASAN PULANG
$('#modal_ttd_penerima').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_penerima");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadPenerima = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_penerima').on('hidden.bs.modal', function (e) {
    signaturePadPenerima.clear();
});

$(document).on('click', '#modal_ttd_penerima .clear', function () {
    signaturePadPenerima.clear();
});

$(document).on('click', '#modal_ttd_penerima .save', function () {
    if (signaturePadPenerima.isEmpty()) {
        toastr.error("Penerima belum menginputkan tanda tangan");
    } else {
        let dataURLPenerima = signaturePadPenerima.toDataURL();
        $('#ttd_penerima').attr('src', dataURLPenerima);
        $('#url_ttd_penerima').val(dataURLPenerima);
        $('#modal_ttd_penerima').modal('hide');
    }
});

$('#modal_ttd_penerima_penjelasan_bedah_ranap').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_penerima_penjelasan_bedah_ranap");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadPenerimaPenjelasan = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_penerima_penjelasan_bedah_ranap').on('hidden.bs.modal', function (e) {
    signaturePadPenerimaPenjelasan.clear();
});

$(document).on('click', '#modal_ttd_penerima_penjelasan_bedah_ranap .clear', function () {
    signaturePadPenerimaPenjelasan.clear();
});

$(document).on('click', '#modal_ttd_penerima_penjelasan_bedah_ranap .save', function () {
    if (signaturePadPenerimaPenjelasan.isEmpty()) {
        toastr.error("Penerima Penjelasan Belum Tanda Tangan");
    } else {
        let dataUrl = signaturePadPenerimaPenjelasan.toDataURL();
        $('#ttd_penerima_penjelasan_ranap_bedah').attr('src', dataUrl);
        $('#url_ttd_penerima_penjelasan_ranap_bedah').val(dataUrl);
        $('#modal_ttd_penerima_penjelasan_bedah_ranap').modal('hide');
    }
});

$('#modal_ttd_perawat_pendaftaran_operasi').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_perawat_pendaftaran_operasi");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadPerawatPendaftaranOperasi = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_perawat_pendaftaran_operasi').on('hidden.bs.modal', function (e) {
    signaturePadPerawatPendaftaranOperasi.clear();
});

$(document).on('click', '#modal_ttd_perawat_pendaftaran_operasi .clear', function () {
    signaturePadPerawatPendaftaranOperasi.clear();
});

$(document).on('click', '#modal_ttd_perawat_pendaftaran_operasi .save', function () {
    if (signaturePadPerawatPendaftaranOperasi.isEmpty()) {
        toastr.error("Perawat belum menginputkan tanda tangan");
    } else {
        let dataURLPenerima = signaturePadPerawatPendaftaranOperasi.toDataURL();
        $('#ttd_perawat_pendaftaran_operasi').attr('src', dataURLPenerima);
        $('#url_ttd_perawat_pendaftaran_operasi').val(dataURLPenerima);
        $('#modal_ttd_perawat_pendaftaran_operasi').modal('hide');
        $('#modal_pendaftaran_operasi').modal('show');
        setTimeout(() => {
            $("#modal_pendaftaran_operasi .modal-body").animate({ scrollTop: $('#modal_pendaftaran_operasi .modal-body').prop("scrollHeight")}, 'slow');
        }, 500);
    }
});

$('#modal_ttd_perawat_edit_pendaftaran_operasi').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_perawat_edit_pendaftaran_operasi");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadPerawatPendaftaranOperasiEdit = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_perawat_edit_pendaftaran_operasi').on('hidden.bs.modal', function (e) {
    signaturePadPerawatPendaftaranOperasiEdit.clear();
});

$(document).on('click', '#modal_ttd_perawat_edit_pendaftaran_operasi .clear', function () {
    signaturePadPerawatPendaftaranOperasiEdit.clear();
});

$(document).on('click', '#modal_ttd_perawat_edit_pendaftaran_operasi .save', function () {
    if (signaturePadPerawatPendaftaranOperasiEdit.isEmpty()) {
        toastr.error("Perawat belum menginputkan tanda tangan");
    } else {
        let dataURLPenerima = signaturePadPerawatPendaftaranOperasiEdit.toDataURL();
        $('#ttd_perawat_edit_pendaftaran_operasi').attr('src', dataURLPenerima);
        $('#url_ttd_perawat_edit_pendaftaran_operasi').val(dataURLPenerima);
        $('#modal_ttd_perawat_edit_pendaftaran_operasi').modal('hide');
        $('#modal_edit_pendaftaran_operasi').modal('show');
        setTimeout(() => {
            $("#modal_edit_pendaftaran_operasi .modal-body").animate({ scrollTop: $('#modal_edit_pendaftaran_operasi .modal-body').prop("scrollHeight")}, 'slow');
        }, 500);
    }
});

$('#modal_ttd_perawat_sirkuler_catatan_perioperatif').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_perawat_sirkuler_catatan_perioperatif");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadPerawatSirkulerPerioperatif = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_perawat_sirkuler_catatan_perioperatif').on('hidden.bs.modal', function (e) {
    signaturePadPerawatSirkulerPerioperatif.clear();
});

$(document).on('click', '#modal_ttd_perawat_sirkuler_catatan_perioperatif .clear', function () {
    signaturePadPerawatSirkulerPerioperatif.clear();
});

$(document).on('click', '#modal_ttd_perawat_sirkuler_catatan_perioperatif .save', function () {
    if (signaturePadPerawatSirkulerPerioperatif.isEmpty()) {
        toastr.error("Perawat belum menginputkan tanda tangan");
    } else {
        let dataURL = signaturePadPerawatSirkulerPerioperatif.toDataURL();
        $('#ttd_perawat_sirkuler_catatan_perioperatif').attr('src', dataURL);
        $('#url_ttd_perawat_sirkuler_catatan_perioperatif').val(dataURL);
        $('#modal_ttd_perawat_sirkuler_catatan_perioperatif').modal('hide');
        $('#modal_catatan_perioperatif').modal('show');
        setTimeout(() => {
            $("#modal_catatan_perioperatif .modal-body").animate({ scrollTop: $('#modal_catatan_perioperatif .modal-body').prop("scrollHeight")}, 'slow');
        }, 500);
    }
});

$('#modal_ttd_perawat_sirkuler_catatan_perioperatif_edit').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_perawat_sirkuler_catatan_perioperatif_edit");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadPerawatSirkulerPerioperatifEdit = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_perawat_sirkuler_catatan_perioperatif_edit').on('hidden.bs.modal', function (e) {
    signaturePadPerawatSirkulerPerioperatifEdit.clear();
});

$(document).on('click', '#modal_ttd_perawat_sirkuler_catatan_perioperatif_edit .clear', function () {
    signaturePadPerawatSirkulerPerioperatifEdit.clear();
});

$(document).on('click', '#modal_ttd_perawat_sirkuler_catatan_perioperatif_edit .save', function () {
    if (signaturePadPerawatSirkulerPerioperatifEdit.isEmpty()) {
        toastr.error("Perawat belum menginputkan tanda tangan");
    } else {
        let dataURL = signaturePadPerawatSirkulerPerioperatifEdit.toDataURL();
        $('#ttd_perawat_sirkuler_catatan_perioperatif_edit').attr('src', dataURL);
        $('#url_ttd_perawat_sirkuler_catatan_perioperatif_edit').val(dataURL);
        $('#modal_ttd_perawat_sirkuler_catatan_perioperatif_edit').modal('hide');
        $('#modal_catatan_perioperatif_edit').modal('show');
        setTimeout(() => {
            $("#modal_catatan_perioperatif_edit .modal-body").animate({ scrollTop: $('#modal_catatan_perioperatif_edit .modal-body').prop("scrollHeight")}, 'slow');
            var username = $('#username').text();
            $('#nama_perawat_sirkuler_catatan_perioperatif_edit').text(username);
        }, 500);
    }
});

$('#modal_ttd_nutrisionis_asuhan_gizi').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_nutrisionis_asuhan_gizi");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadNutrisionisAsuhanGizi = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_nutrisionis_asuhan_gizi').on('hidden.bs.modal', function (e) {
    signaturePadNutrisionisAsuhanGizi.clear();
});

$(document).on('click', '#modal_ttd_nutrisionis_asuhan_gizi .clear', function () {
    signaturePadNutrisionisAsuhanGizi.clear();
});

$(document).on('click', '#modal_ttd_nutrisionis_asuhan_gizi .save', function () {
    if (signaturePadNutrisionisAsuhanGizi.isEmpty()) {
        toastr.error("Nutrisionis belum menginputkan tanda tangan");
    } else {
        let dataURL = signaturePadNutrisionisAsuhanGizi.toDataURL();
        $('#ttd_nutrisionis_asuhan_gizi').attr('src', dataURL);
        $('#url_ttd_nutrisionis_asuhan_gizi').val(dataURL);
        $('#modal_ttd_nutrisionis_asuhan_gizi').modal('hide');
    }
});

$('#modal_ttd_nutrisionis_harian_asuhan_gizi').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_nutrisionis_harian_asuhan_gizi");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadNutrisionisHarianAsuhanGizi = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)',
    });
});

$('#modal_ttd_nutrisionis_harian_asuhan_gizi').on('hidden.bs.modal', function (e) {
    signaturePadNutrisionisHarianAsuhanGizi.clear();
});

$(document).on('click', '#modal_ttd_nutrisionis_harian_asuhan_gizi .clear', function () {
    signaturePadNutrisionisHarianAsuhanGizi.clear();
});

$(document).on('click', '#modal_ttd_nutrisionis_harian_asuhan_gizi .save', function () {
    if (signaturePadNutrisionisHarianAsuhanGizi.isEmpty()) {
        toastr.error("Nutrisionis belum menginputkan tanda tangan");
    } else {
        let dataURL = signaturePadNutrisionisHarianAsuhanGizi.toDataURL();
        $('#ttd_nutrisionis_harian_asuhan_gizi').attr('src', dataURL);
        $('#url_ttd_nutrisionis_harian_asuhan_gizi').val(dataURL);
        $('#modal_ttd_nutrisionis_harian_asuhan_gizi').modal('hide');
    }
});

$('#modal_ttd_nutrisionis_harian_asuhan_gizi_edit').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_nutrisionis_harian_asuhan_gizi_edit");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadNutrisionisHarianAsuhanGiziEdit = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_nutrisionis_harian_asuhan_gizi_edit').on('hidden.bs.modal', function (e) {
    signaturePadNutrisionisHarianAsuhanGiziEdit.clear();
});

$(document).on('click', '#modal_ttd_nutrisionis_harian_asuhan_gizi_edit .clear', function () {
    signaturePadNutrisionisHarianAsuhanGiziEdit.clear();
});

$(document).on('click', '#modal_ttd_nutrisionis_harian_asuhan_gizi_edit .save', function () {
    if (signaturePadNutrisionisHarianAsuhanGiziEdit.isEmpty()) {
        toastr.error("Nutrisionis belum menginputkan tanda tangan");
    } else {
        let dataURL = signaturePadNutrisionisHarianAsuhanGiziEdit.toDataURL();
        $('#ttd_nutrisionis_harian_asuhan_gizi_edit').attr('src', dataURL);
        $('#url_ttd_nutrisionis_harian_asuhan_gizi_edit').val(dataURL);
        $('#modal_ttd_nutrisionis_harian_asuhan_gizi_edit').modal('hide');
        $('#modal_harian_asuhan_gizi_edit').modal('show');
    }
});

$('#modal_ttd_apoteker_formulir').on('shown.bs.modal', function (e) {
    let canvas = $("#canvas_ttd_apoteker");
    let parentWidth = canvas.closest('.modal-body').width();
    let parentHeight = canvas.closest('.modal-body').height();
    canvas.attr("width", parentWidth + 'px')
        .attr("height", parentHeight + 'px');
    signaturePadOkupasiTerapis = new SignaturePad(canvas[0], {
        backgroundColor: 'rgb(255, 255, 255)'
    });
});

$('#modal_ttd_apoteker_formulir').on('hidden.bs.modal', function (e) {
    signaturePadOkupasiTerapis.clear();
});

$(document).on('click', '#modal_ttd_apoteker_formulir .clear', function () {
    signaturePadOkupasiTerapis.clear();
});

$(document).on('click', '#modal_ttd_apoteker_formulir .save', function () {
    if (signaturePadOkupasiTerapis.isEmpty()) {
        toastr.error("Apoteker belum menginputkan tanda tangan");
    } else {
        let dataURLPsikiater = signaturePadOkupasiTerapis.toDataURL();
        $('#ttd_apoteker').attr('src', dataURLPsikiater);
        $('#url_ttd_apoteker').val(dataURLPsikiater);
        $('#modal_ttd_apoteker_formulir').modal('hide');
        $('#modal_isi_formulir_edukasi_farmasi').modal('show');
    }
});