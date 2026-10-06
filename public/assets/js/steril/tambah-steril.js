var header = {
    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
};

KTUtil.onDOMContentLoaded(function() {
 
    $('#tanggal_penyerahan').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        timeFormat: 'HH:mm',
        // endDate: '0',
        // daysOfWeekDisabled: [0, 6],
        orientation: 'bottom'
        
    });
    $('#tanggal_steril').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        // endDate: '0',
        // daysOfWeekDisabled: '0,6',
        orientation: 'bottom'
    });
    $('#jam_steril').timepicker({
        timeFormat: 'HH:mm',
        interval: 30,
        minTime: '6:00',
        maxTime: '23:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });
    $('#tanggal_kadaluarsa_alat').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        // endDate: '0',
        // daysOfWeekDisabled: '0,6',
        orientation: 'bottom'
    });
    $('#tanggal_pengembalian_alat').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        // endDate: '0',
        // daysOfWeekDisabled: '0,6',
        orientation: 'bottom'
    });
    //untuk form edit
    $('#tanggal_penyerahan_edit').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        timeFormat: 'HH:mm',
        // endDate: '0',
        // daysOfWeekDisabled: '0,6',
        orientation: 'bottom'
        
    });
    $('#tanggal_steril_edit').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        // endDate: '0',
        // daysOfWeekDisabled: '0,6',
        orientation: 'bottom'
    });
    $('#tanggal_kadaluarsa_alat_edit').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        // endDate: '0',
        // daysOfWeekDisabled: '0,6',
        orientation: 'bottom'
    });
    $('#tanggal_pengembalian_alat_edit').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        // endDate: '0',
        // daysOfWeekDisabled: '0,6',
        orientation: 'bottom'
    });
    $('#tanggal_pengembalian').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        // endDate: '0',
        // daysOfWeekDisabled: '0,6',
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
    //select dropdown user
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
    //end select dropdown user

    $('#repeater_steril').repeater({
        initEmpty: false,

        ready: function () {
            var elementAlat = 'repeater_steril[0][alatSteril]';
            var elementjenisAlat = 'repeater_steril[0][jenisAlat]';
            var elementjmlAlat = 'repeater_steril[0][jumlahAlat]';

             
            $('#steril[name="' + elementAlat + '"]').select2({
                
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
            
            var elementAlat = 'repeater_steril[' + index + '][alatSteril]';
            var elementjenisAlat = 'repeater_steril[' + index + '][jenisAlat]';
            var elementjmlAlat = 'repeater_steril[' + index + '][jumlahAlat]';

            $(this).slideDown(function () {
                if (index != 0) {
                    $('#steril[name="' + elementAlat + '"]').select2('open');
                }
            });

            $('#steril[name="' + elementAlat + '"]').select2({
                
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

const base64ToArrayBuffer = (data) => {
    const bString = window.atob(data);
    const bLength = bString.length;
    let bytes = new Uint8Array(bLength);
    for (let i = 0; i < bLength; i++) {
        const ascii = bString.charCodeAt(i);
        bytes[i] = ascii;
    }
    return bytes;
}




$(document).on('click', '#btn_simpan_steril', function () {
    SaveDataSteril();
});
function SaveDataSteril() {
   
    var idRuang = $('#idRuang').val();
    var petugasUnit = $('#petugas_unit').val();
    var petugasCssd = $('#petugas_cssd').val();
    var tanggalPenyerahan = $('#tanggal_penyerahan').val();
    var tanggalSteril = $('#tanggal_steril').val();
    var jamSteril = $('#jam_steril').val();
    var tanggalKadaluarsaAlat = $('#tanggal_kadaluarsa_alat').val();
    var tanggalPengembalianAlat = $('#tanggal_pengembalian_alat').val();
    var petugasPencucian = $('#petugas_pencucian').val();
    var petugasPacking = $('#petugas_packing').val();
    var petugasOperator = $('#petugas_operator').val();
    var petugasCheck = $('#petugas_check').val();
    var petugasUnitPengembalian = $('#petugas_unit_pengembalian').val();
    var petugasCssdPengembalian = $('#petugas_cssd_pengembalian').val();
    var keteranganPetugasCssd = $('#keterangan_petugas_cssd').val();
    var alatSterilList = [];
    var dataTableSteril = $('#repeater_steril').repeaterVal().repeater_steril;
    if (dataTableSteril.length > 0) {
        for (var i = 0; i < dataTableSteril.length; i++) {
            var sterilData = {
                "idAlatSteril": dataTableSteril[i].alatSteril,
                "jnsAlat": dataTableSteril[i].jenisAlat,
                "jmlAlat": dataTableSteril[i].jumlahAlat
            };
            alatSterilList.push(sterilData);
        }     
    }
    
    // alert(alatSterilList);
    var dataKirim = {
        "idRuang": idRuang,
        "petugasUnit": petugasUnit,
        "petugasCssd": petugasCssd,
        "tanggalPenyerahan": tanggalPenyerahan,
        "tanggalSteril": tanggalSteril,
        "jamSteril": jamSteril,
        "tanggalKadaluarsaAlat": tanggalKadaluarsaAlat,
        "tanggalPengembalianAlat": tanggalPengembalianAlat,
        "petugasPencucian": petugasPencucian,
        "petugasPacking": petugasPacking,
        "petugasOperator": petugasOperator,
        "petugasCheck": petugasCheck,
        "petugasUnitPengembalian": petugasUnitPengembalian,
        "petugasCssdPengembalian": petugasCssdPengembalian,
        "keteranganPetugasCssd": keteranganPetugasCssd,
        "alatSteril": alatSterilList
    }
    
        $.ajax({
            type: 'POST',
            headers: header,
            url: '/steril/simpan-data-steril',
            data: dataKirim,
            success: function(data) {
                if (data.result) {
                    toastr.success("Data Steril Berhasil Disimpan");
                    window.location.href = '/steril/view-steril';
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

