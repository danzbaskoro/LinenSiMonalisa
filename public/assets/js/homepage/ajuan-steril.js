var header = {
    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
};
let signaturePadTtdUnitPengirim;
KTUtil.onDOMContentLoaded(function() {
    $('#tanggal_penyerahan').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        timeFormat: 'HH:mm',
        // endDate: '0',
        // daysOfWeekDisabled: [0, 6],
        orientation: 'bottom'
        
    });
    $('#idRuang').select2().on('change', function() {
        // Revalidate the field when an option is chosen
       
    });
     // Memuat data ke dropdown
     $.ajax({
        type: 'GET', // Metode HTTP
        headers: header,
        url: '/steril/list-ruangan',
        success: function(data) {
            if (data.result == true) {
                // console.log(data.data);
                var option4 = '<option value="">PILIH UNIT</option>';
                for (var i = 0; i < data.data.length; i++) {
                    option4 += '<option value="' + data.data[i].id_ruang + '">' + data.data[i].nama_ruang + '</option>';
                }
                $('#idRuang').html(option4);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error saat mengambil data:', error);
            alert('Gagal memuat data ruangan.');
        }
    });
    $('#petugas_cssd').select2().on('change', function() {
        // Revalidate the field when an option is chosen
       
    });
     // Memuat data ke dropdown
     $.ajax({
        type: 'GET', // Metode HTTP
        headers: header,
        url: '/steril/list-user-cssd',
        success: function(data) {
            if (data.result == true) {
                // console.log(data.data);
                var option4 = '<option value="">PILIH USER</option>';
                for (var i = 0; i < data.data.length; i++) {
                    option4 += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
                }
                $('#petugas_cssd').html(option4);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error saat mengambil data:', error);
            alert('Gagal memuat data ruangan.');
        }
    });

    $('#petugas_pencucian').select2().on('change', function() {
        // Revalidate the field when an option is chosen
       
    });
     // Memuat data ke dropdown
     $.ajax({
        type: 'GET', // Metode HTTP
        headers: header,
        url: '/steril/list-user-cssd',
        success: function(data) {
            if (data.result == true) {
                // console.log(data.data);
                var option4 = '<option value="">PILIH USER</option>';
                for (var i = 0; i < data.data.length; i++) {
                    option4 += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
                }
                $('#petugas_pencucian').html(option4);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error saat mengambil data:', error);
            alert('Gagal memuat data ruangan.');
        }
    });

    $('#petugas_packing').select2().on('change', function() {
        // Revalidate the field when an option is chosen
       
    });
     // Memuat data ke dropdown
     $.ajax({
        type: 'GET', // Metode HTTP
        headers: header,
        url: '/steril/list-user-cssd',
        success: function(data) {
            if (data.result == true) {
                // console.log(data.data);
                var option4 = '<option value="">PILIH USER</option>';
                for (var i = 0; i < data.data.length; i++) {
                    option4 += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
                }
                $('#petugas_packing').html(option4);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error saat mengambil data:', error);
            alert('Gagal memuat data ruangan.');
        }
    });

    $('#petugas_operator').select2().on('change', function() {
        // Revalidate the field when an option is chosen
       
    });
     // Memuat data ke dropdown
     $.ajax({
        type: 'GET', // Metode HTTP
        headers: header,
        url: '/steril/list-user-cssd',
        success: function(data) {
            if (data.result == true) {
                // console.log(data.data);
                var option4 = '<option value="">PILIH USER</option>';
                for (var i = 0; i < data.data.length; i++) {
                    option4 += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
                }
                $('#petugas_operator').html(option4);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error saat mengambil data:', error);
            alert('Gagal memuat data ruangan.');
        }
    });

    $('#petugas_check').select2().on('change', function() {
        // Revalidate the field when an option is chosen
       
    });
     // Memuat data ke dropdown
     $.ajax({
        type: 'GET', // Metode HTTP
        headers: header,
        url: '/steril/list-user-cssd',
        success: function(data) {
            if (data.result == true) {
                // console.log(data.data);
                var option4 = '<option value="">PILIH USER</option>';
                for (var i = 0; i < data.data.length; i++) {
                    option4 += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
                }
                $('#petugas_check').html(option4);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error saat mengambil data:', error);
            alert('Gagal memuat data ruangan.');
        }
    });

    $('#petugas_cssd_pengembalian').select2().on('change', function() {
        // Revalidate the field when an option is chosen
       
    });
     // Memuat data ke dropdown
     $.ajax({
        type: 'GET', // Metode HTTP
        headers: header,
        url: '/steril/list-user-cssd',
        success: function(data) {
            if (data.result == true) {
                // console.log(data.data);
                var option4 = '<option value="">PILIH USER</option>';
                for (var i = 0; i < data.data.length; i++) {
                    option4 += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
                }
                $('#petugas_cssd_pengembalian').html(option4);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error saat mengambil data:', error);
            alert('Gagal memuat data ruangan.');
        }
    });
    //pad tandatangan
    let canvasLokalisTtdUnitPengiriman = $("#canvas_pengiriman_alat");
    let widthLokalisTtdUnitPengiriman = "480px";
    let heightLokalisTtdUnitPengiriman = "360px"
    canvasLokalisTtdUnitPengiriman
        .attr("width", widthLokalisTtdUnitPengiriman)
        .attr("height", heightLokalisTtdUnitPengiriman);
    signaturePadTtdUnitPengirim = new SignaturePad(canvasLokalisTtdUnitPengiriman[0], {
        backgroundColor: 'rgb(255, 255, 255)',
        minWidth: 0.5,
        maxWidth: 1.5
        
    });

    

    $('#btn_clear_canvas_pengiriman_alat').click(function (e) { 
        signaturePadTtdUnitPengirim.clear();
        
    });
    //end
    $('#repeater_steril_ajuan').repeater({
        initEmpty: false,

        ready: function () {
            var elementAlat = 'repeater_steril_ajuan[0][alatSterilAjuan]';
            var elementjenisAlat = 'repeater_steril_ajuan[0][jenisAlatAjuan]';
            var elementjmlAlat = 'repeater_steril_ajuan[0][jumlahAlatAjuan]';

             
            $('#ajuan_steril[name="' + elementAlat + '"]').select2({
                placeholder: "Tuliskan nama alat disini",
                minimumInputLength: 2,
                ajax: {
                    url: '/steril/list-alat',
                    dataType: 'json',
                    type: 'POST',
                    headers: header,
                    delay: 500,
                    data: function (kodealat) {
                        return {
                            key: kodealat.term
                        };
                    },
                    processResults: function (data) {
                        var datas = [];
                        if (data.result) {
                            var dataAlat = data.data;
                            datas = $.map(dataAlat, function (item) {
                                return {
                                    id : item.id_alat,
                                    text : item.nama_alat,
                                    nmAlat: item.nama_alat
                                }

                            });
                            console.log(datas);
                        }

                        return {
                            results: datas
                        };
                    },
                    cache: true
                }
            }).on('select2:select', function (e) {
                var kodeAlatSteril = e.params.data['nmAlat'];
                $('input[name="' + elementAlat + '"]').val(kodeAlatSteril);
            });
        },

        show: function () {
            var index = $(this).closest('[data-repeater-item]').index();
            
            var elementAlat = 'repeater_steril_ajuan[' + index + '][alatSterilAjuan]';
            var elementjenisAlat = 'repeater_steril_ajuan[' + index + '][jenisAlatAjuan]';
            var elementjmlAlat = 'repeater_steril_ajuan[' + index + '][jumlahAlatAjuan]';

            $(this).slideDown(function () {
                if (index != 0) {
                    $('#ajuan_steril[name="' + elementAlat + '"]').select2('open');
                }
            });

            $('#ajuan_steril[name="' + elementAlat + '"]').select2({
                placeholder: "Tuliskan nama alat disini",
                minimumInputLength: 2,
                ajax: {
                    url: '/steril/list-alat',
                    dataType: 'json',
                    type: 'POST',
                    headers: header,
                    delay: 500,
                    data: function (kodealat) {
                        return {
                            key: kodealat.term
                        };
                    },
                    processResults: function (data) {
                        var datas = [];
                        if (data.result) {
                            var dataAlat = data.data;

                            datas = $.map(dataAlat, function (item) {
                                return {
                                    id : item.id_alat,
                                    text : item.nama_alat,
                                    nmAlat: item.nama_alat
                                }
                            });
                        }

                        return {
                            results: datas
                        };
                    },
                    cache: true
                }
            }).on('select2:select', function (e) {
                var kodeAlatSteril = e.params.data['nmAlat'];
                $('input[name="' + elementAlat + '"]').val(kodeAlatSteril);
            });
           
            
        },

        hide: function (deleteElement) {
            $(this).slideUp(deleteElement);
        }
    });
});


$(document).on('click', '#btn_simpan_ajuan_steril', function () {
    simpanAjuanSteril();
});
function simpanAjuanSteril() {
   
    var idRuang = $('#idRuang').val();
    var petugas_unit = $('#petugas_unit').val();
    var tanggalPenyerahan = $('#tanggal_penyerahan').val();
    var cttnUSer = $('#keterangan_user_pengirim').val();

    var ttdUnitPengirimPic = null;
    var urlTtdUnitPengirim = signaturePadTtdUnitPengirim.toDataURL();
    ttdUnitPengirimPic = urlTtdUnitPengirim.replace(/^data:image\/[a-z]+;base64,/, "");

    var ajuanalatSterilList = [];
    var dataTableSterilAjuan = $('#repeater_steril_ajuan').repeaterVal().repeater_steril_ajuan;
    if (dataTableSterilAjuan.length > 0) {
        for (var i = 0; i < dataTableSterilAjuan.length; i++) {
            var sterilData = {
                "idAlatSteril": dataTableSterilAjuan[i].alatSterilAjuan,
                "jnsAlat": dataTableSterilAjuan[i].jenisAlatAjuan,
                "jmlAlat": dataTableSterilAjuan[i].jumlahAlatAjuan
            };
            ajuanalatSterilList.push(sterilData);
        }     
    }
    
    // alert(ajuanalatSterilList);
    var dataAjuanSteril = {
        "idRuang": idRuang,
        "petugas_unit": petugas_unit,
        "tanggalPenyerahan": tanggalPenyerahan,
        "cttnUSer": cttnUSer,
        "ttdUnitPengirim": ttdUnitPengirimPic,
        "alatSteril": ajuanalatSterilList
        
    }
    // console.log(dataSteril);
    var model = {
        dataAjuanSteril: dataAjuanSteril
    };

    $.ajax({
        type: 'POST',
        headers: header,
        url: '/homepage/tambah-ajuan-steril',
        data: model,
        success: function(data) {
            if (data.result) {

                toastr.success("Data Steril Berhasil Disimpan");
                window.location.href = "/homepage/view-ajuan-data-steril";
            } else {
                toastr.error("Data Steril Gagal Disimpan");
            }
        },
        error: function(jqXHR, exception) {
            if (exception === 'parsererror') {
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
        }
    });
}