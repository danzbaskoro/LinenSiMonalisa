var header = {
    "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content"),
};
let signaturePadTtdUnitPengirim;
KTUtil.onDOMContentLoaded(function () {
    $("#tanggal_penyerahan").datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        timeFormat: "HH:mm",
        // endDate: '0',
        // daysOfWeekDisabled: [0, 6],
        orientation: "bottom",
    });
    $("#idRuang")
        .select2()
        .on("change", function () {
            // Revalidate the field when an option is chosen
        });
    // Memuat data ke dropdown
    $.ajax({
        type: "GET", // Metode HTTP
        headers: header,
        url: "/steril/list-ruangan",
        success: function (data) {
            if (data.result == true) {
                // console.log(data.data);
                var option4 = '<option value="">PILIH UNIT</option>';
                for (var i = 0; i < data.data.length; i++) {
                    option4 +=
                        '<option value="' +
                        data.data[i].id_ruang +
                        '">' +
                        data.data[i].nama_ruang +
                        "</option>";
                }
                $("#idRuang").html(option4);
            }
        },
        error: function (xhr, status, error) {
            console.error("Error saat mengambil data:", error);
            alert("Gagal memuat data ruangan.");
        },
    });
    //**belum tau dipake dmn? */
    // $('#petugas_cssd').select2().on('change', function() {
    //     // Revalidate the field when an option is chosen

    // });
    // // Memuat data ke dropdown
    //  $.ajax({
    //     type: 'GET', // Metode HTTP
    //     headers: header,
    //     url: '/steril/list-user-cssd',
    //     success: function(data) {
    //         if (data.result == true) {
    //             // console.log(data.data);
    //             var option4 = '<option value="">PILIH USER</option>';
    //             for (var i = 0; i < data.data.length; i++) {
    //                 option4 += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
    //             }
    //             $('#petugas_cssd').html(option4);
    //         }
    //     },
    //     error: function(xhr, status, error) {
    //         console.error('Error saat mengambil data:', error);
    //         alert('Gagal memuat data ruangan.');
    //     }
    // });

    // $('#petugas_pencucian').select2().on('change', function() {
    //     // Revalidate the field when an option is chosen

    // });
    //  // Memuat data ke dropdown
    //  $.ajax({
    //     type: 'GET', // Metode HTTP
    //     headers: header,
    //     url: '/steril/list-user-cssd',
    //     success: function(data) {
    //         if (data.result == true) {
    //             // console.log(data.data);
    //             var option4 = '<option value="">PILIH USER</option>';
    //             for (var i = 0; i < data.data.length; i++) {
    //                 option4 += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
    //             }
    //             $('#petugas_pencucian').html(option4);
    //         }
    //     },
    //     error: function(xhr, status, error) {
    //         console.error('Error saat mengambil data:', error);
    //         alert('Gagal memuat data ruangan.');
    //     }
    // });

    // $('#petugas_packing').select2().on('change', function() {
    //     // Revalidate the field when an option is chosen

    // });
    //  // Memuat data ke dropdown
    //  $.ajax({
    //     type: 'GET', // Metode HTTP
    //     headers: header,
    //     url: '/steril/list-user-cssd',
    //     success: function(data) {
    //         if (data.result == true) {
    //             // console.log(data.data);
    //             var option4 = '<option value="">PILIH USER</option>';
    //             for (var i = 0; i < data.data.length; i++) {
    //                 option4 += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
    //             }
    //             $('#petugas_packing').html(option4);
    //         }
    //     },
    //     error: function(xhr, status, error) {
    //         console.error('Error saat mengambil data:', error);
    //         alert('Gagal memuat data ruangan.');
    //     }
    // });

    // $('#petugas_operator').select2().on('change', function() {
    //     // Revalidate the field when an option is chosen

    // });
    //  // Memuat data ke dropdown
    //  $.ajax({
    //     type: 'GET', // Metode HTTP
    //     headers: header,
    //     url: '/steril/list-user-cssd',
    //     success: function(data) {
    //         if (data.result == true) {
    //             // console.log(data.data);
    //             var option4 = '<option value="">PILIH USER</option>';
    //             for (var i = 0; i < data.data.length; i++) {
    //                 option4 += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
    //             }
    //             $('#petugas_operator').html(option4);
    //         }
    //     },
    //     error: function(xhr, status, error) {
    //         console.error('Error saat mengambil data:', error);
    //         alert('Gagal memuat data ruangan.');
    //     }
    // });

    // $('#petugas_check').select2().on('change', function() {
    //     // Revalidate the field when an option is chosen

    // });
    //  // Memuat data ke dropdown
    //  $.ajax({
    //     type: 'GET', // Metode HTTP
    //     headers: header,
    //     url: '/steril/list-user-cssd',
    //     success: function(data) {
    //         if (data.result == true) {
    //             // console.log(data.data);
    //             var option4 = '<option value="">PILIH USER</option>';
    //             for (var i = 0; i < data.data.length; i++) {
    //                 option4 += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
    //             }
    //             $('#petugas_check').html(option4);
    //         }
    //     },
    //     error: function(xhr, status, error) {
    //         console.error('Error saat mengambil data:', error);
    //         alert('Gagal memuat data ruangan.');
    //     }
    // });

    // $('#petugas_cssd_pengembalian').select2().on('change', function() {
    //     // Revalidate the field when an option is chosen

    // });
    //  // Memuat data ke dropdown
    //  $.ajax({
    //     type: 'GET', // Metode HTTP
    //     headers: header,
    //     url: '/steril/list-user-cssd',
    //     success: function(data) {
    //         if (data.result == true) {
    //             // console.log(data.data);
    //             var option4 = '<option value="">PILIH USER</option>';
    //             for (var i = 0; i < data.data.length; i++) {
    //                 option4 += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
    //             }
    //             $('#petugas_cssd_pengembalian').html(option4);
    //         }
    //     },
    //     error: function(xhr, status, error) {
    //         console.error('Error saat mengambil data:', error);
    //         alert('Gagal memuat data ruangan.');
    //     }
    // });
    //** END  */

    //pad tandatangan
    let canvasLokalisTtdUnitPengiriman = $("#canvas_pengiriman_linen");
    let widthLokalisTtdUnitPengiriman = "480px";
    let heightLokalisTtdUnitPengiriman = "360px";
    canvasLokalisTtdUnitPengiriman
        .attr("width", widthLokalisTtdUnitPengiriman)
        .attr("height", heightLokalisTtdUnitPengiriman);
    signaturePadTtdUnitPengirim = new SignaturePad(
        canvasLokalisTtdUnitPengiriman[0],
        {
            backgroundColor: "rgb(255, 255, 255)",
            minWidth: 0.5,
            maxWidth: 1.5,
        },
    );

    $("#btn_clear_canvas_pengiriman_linen").click(function (e) {
        signaturePadTtdUnitPengirim.clear();
    });
    //end

    $("#repeat_ajuan_laundry").repeater({
        initEmpty: false,

        ready: function () {
            // Gunakan find untuk baris pertama
            var $firstItem = $("[data-repeater-item]").first();
            initSelect2($firstItem);
        },

        show: function () {
            $(this).slideDown();
            // Inisialisasi Select2 hanya untuk item yang baru dibuat
            initSelect2($(this));
        },

        hide: function (deleteElement) {
            $(this).slideUp(deleteElement);
        },
    });

    // Buat fungsi reusable agar tidak duplikat kode
    function initSelect2($container) {
        // Cari elemen dengan class, bukan ID
        $container.find(".jenis-linen-select").select2({
            placeholder: "Tuliskan nama alat disini",
            allowClear: true,
            minimumInputLength: 2,
            ajax: {
                url: "/laundry/list-linen",
                // ... sisa config ajax tetap sama ...
                dataType: "json",
                type: "POST",
                headers: header,
                delay: 500,
                data: function (kodeLinen) {
                    return {
                        key: kodeLinen.term,
                    };
                },
                processResults: function (data) {
                    var datas = [];
                    if (data.result) {
                        var dataLinen = data.data;
                        datas = $.map(dataLinen, function (item) {
                            return {
                                id: item.id,
                                text: item.nama_linen,
                                nmLinen: item.nama_linen,
                            };
                        });
                        console.log(datas);
                    }

                    return {
                        results: datas,
                    };
                },
                cache: true,
            },
        })
            .on("select2:select", function (e) {
                var kodeBarangLinen = e.params.data;
                $(this).closest('[data-repeater-item]').find('.jenis-linen-select').val(kodeBarangLinen.text);
                // $('input[name="' + elementJenisLinen + '"]').val(
                //     kodeBarangLinen,
                // );
            });
    }


// ready: function () {
//     var elementJenisLinen = 'repeat_ajuan_laundry[0][jenisLinenAjuan]';

//     $('#ajuan_laundry[name="' + elementJenisLinen + '"]').select2({
//         placeholder: "Tuliskan nama linen disini",
//         minimumInputLength: 2,
//         ajax: {
//             url: '/laundry/list-linen',
//             dataType: 'json',
//             type: 'POST',
//             headers: header,
//             delay: 500,
//             data: function (kodeLinen) {
//                 return {
//                     key: kodeLinen.term
//                 };
//             },
//             processResults: function (data) {
//                 var datas = [];
//                 if (data.result) {
//                     var dataLinen = data.data;
//                     datas = $.map(dataLinen, function (item) {
//                         return {
//                             id : item.id_linen,
//                             text : item.nama_linen,
//                             nmLinen: item.nama_linen
//                         }

//                     });
//                     console.log(datas);
//                 }

//                 return {
//                     results: datas
//                 };
//             },
//             cache: true
//         }
//     }).on('select2:select', function (e) {
//         var kodeBarangLinen = e.params.data['nmLinen'];
//         $('input[name="' + elementJenisLinen + '"]').val(kodeBarangLinen);
//     });
// },

// show: function () {
//     var index = $(this).closest('[data-repeater-item]').index();

//     var elementJenisLinen = 'repeat_ajuan_laundry[' + index + '][jenisLinenAjuan]';

//     $(this).slideDown(function () {
//         if (index != 0) {
//             $('#ajuan_laundry[name="' + elementJenisLinen + '"]').select2('open');
//         }
//     });

//     $('#ajuan_laundry[name="' + elementJenisLinen + '"]').select2({
//         placeholder: "Tuliskan nama linen disini",
//         minimumInputLength: 2,
//         ajax: {
//             url: '/laundry/list-linen',
//             dataType: 'json',
//             type: 'POST',
//             headers: header,
//             delay: 500,
//             data: function (kodeLinen) {
//                 return {
//                     key: kodeLinen.term
//                 };
//             },
//             processResults: function (data) {
//                 var datas = [];
//                 if (data.result) {
//                     var dataLinen = data.data;

//                     datas = $.map(dataLinen, function (item) {
//                         return {
//                             id : item.id_linen,
//                             text : item.nama_linen,
//                             nmLinen: item.nama_linen
//                         }
//                     });
//                 }

//                 return {
//                     results: datas
//                 };
//             },
//             cache: true
//         }
//     }).on('select2:select', function (e) {
//         var kodeBarangLinen = e.params.data['nmLinen'];
//         $('input[name="' + elementJenisLinen + '"]').val(kodeBarangLinen);
//     });
// },

// hide: function (deleteElement) {
//     $(this).slideUp(deleteElement);
// }
// });

// $("#repeat_ajuan_laundry").repeater({
//     initEmpty: false,

//     ready: function () {
//         // Cari elemen select pada baris yang sudah ada saat halaman pertama kali dimuat
//         $('[data-repeater-item]').find('.jenis-linen-select').select2({
//             placeholder: "Tuliskan nama linen disini",
//             minimumInputLength: 2,
//             ajax: {
//                 url: '/laundry/list-linen',
//                 dataType: 'json',
//                 type: 'POST',
//                 headers: header,
//                 delay: 500,
//                 data: function (kodeLinen) {
//                     return { key: kodeLinen.term };
//                 },
//                 processResults: function (data) {
//                     var datas = [];
//                     if (data.result) {
//                         datas = $.map(data.data, function (item) {
//                             return {
//                                 // PENTING: Select2 wajib memiliki 'id', pastikan item.id_linen tidak bernilai null dari database
//                                 id: item.id, 
//                                 text: item.nama_linen 
//                             }
//                         });
//                     }
//                     return { results: datas };
//                 },
//                 cache: true
//             }
//         });
//     },

//     show: function () {
//         // $(this) merujuk pada elemen baris (row) baru yang sedang dibuat oleh repeater
//         var $newRow = $(this); 

//         $newRow.slideDown(function () {
//             // Gunakan find() untuk HANYA menginisiasi select2 pada baris baru tersebut
//             $newRow.find('.jenis-linen-select').select2({
//                 placeholder: "Tuliskan nama linen disini",
//                 minimumInputLength: 2,
//                 ajax: {
//                     url: '/laundry/list-linen',
//                     dataType: 'json',
//                     type: 'POST',
//                     headers: header,
//                     delay: 500,
//                     data: function (kodeLinen) {
//                         return { key: kodeLinen.term };
//                     },
//                     processResults: function (data) {
//                         var datas = [];
//                         if (data.result) {
//                             datas = $.map(data.data, function (item) {
//                                 return {
//                                     id: item.id,
//                                     text: item.nama_linen
//                                 }
//                             });
//                         }
//                         return { results: datas };
//                     }
//                 }
//             });

//             // Buka dropdown secara otomatis
//             $newRow.find('.jenis-linen-select').select2('open');
//         });
//     },

//     hide: function (deleteElement) {
//         $(this).slideUp(deleteElement);
//     }
// });

});

$(document).on("click", "#btn_simpan_ajuan_laundry", function () {
    simpanAjuanLaundry();
});
function simpanAjuanLaundry() {
    var idRuang = $("#idRuang").val();
    var petugas_unit = $("#petugas_unit").val();
    var tanggalPenyerahan = $("#tanggal_penyerahan").val();
    var ketUserPengirim = $("#keterangan_user_pengirim").val();

    var ttdUnitPengirimPic = null;
    var urlTtdUnitPengirim = signaturePadTtdUnitPengirim.toDataURL();
    ttdUnitPengirimPic = urlTtdUnitPengirim.replace(
        /^data:image\/[a-z]+;base64,/,
        "",
    );

    var ajuanBarangLaundryList = [];
    var dataTableLaundryAjuan = $("#repeat_ajuan_laundry").repeaterVal().repeat_ajuan_laundry;
    if (dataTableLaundryAjuan.length > 0) {
        // Ambil elemen baris fisik dari repeater untuk kebutuhan mengambil teks label Select2
    var $repeaterItems = $("[data-repeater-item]");
        for (var i = 0; i < dataTableLaundryAjuan.length; i++) {
            // Ambil teks label dari dropdown Select2
        var namaLinenTerpilih = $repeaterItems.eq(i).find('.jenis-linen-select option:selected').text();
            var laundryData = {
                "idLinen": dataTableLaundryAjuan[i].jenisLinenAjuan,
                "jnsLinen": namaLinenTerpilih,
                "jnsBarang": dataTableLaundryAjuan[i].jenisBarangAjuan,
                "jmlBarang": dataTableLaundryAjuan[i].jumlahBarangAjuan,
                "brtBarang": dataTableLaundryAjuan[i].beratBarangAjuan
            };
            ajuanBarangLaundryList.push(laundryData);
        }
    }

    console.log(ajuanBarangLaundryList);
    return false;
    var dataAjuanLaundry = {
        idRuang: idRuang,
        petugas_unit: petugas_unit,
        tanggalPenyerahan: tanggalPenyerahan,
        ketUserPengirim: ketUserPengirim,
        ttdUnitPengirim: ttdUnitPengirimPic,
        barangLaundry: ajuanBarangLaundryList,
    };
    console.log(dataAjuanLaundry);
    
    var model = {
        dataAjuanLaundry: dataAjuanLaundry,
    };

    $.ajax({
        type: "POST",
        headers: header,
        url: "/homepage/tambah-ajuan-laundry",
        data: model,
        success: function (data) {
            if (data.result) {
                toastr.success("Data Linen Berhasil Disimpan");
                window.location.href = "/homepage/view-ajuan-data-linen";
            } else {
                toastr.error("Data Linen Gagal Disimpan");
            }
        },
        error: function (jqXHR, exception) {
            if (exception === "parsererror") {
                toastr.error("Tidak bisa dimuat");
                return false;
            } else if (jqXHR.status == 404) {
                toastr.error("Halaman tidak ditemukan");
                return false;
            } else if (jqXHR.status == 500) {
                toastr.error("Server Error. Hubungi MDSI");
                return false;
            } else if (jqXHR.status == 401) {
                toastr.error("Akses Ditolak. Hubungi MDSI");
                return false;
            }
        },
    });
}
