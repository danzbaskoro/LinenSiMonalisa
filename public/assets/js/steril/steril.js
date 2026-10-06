var header = {
    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
};
let signaturePadTtdUnitPengambilan;
KTUtil.onDOMContentLoaded(function() {
    displayDataSteril();
    displayDataAlatSteril();
    listDataAlatSteril();
    ViewEditDataSteril();
    ViewPengambilanDataSteril();
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
    $('#jam_steril_edit').timepicker({
        timeFormat: 'HH:mm',
        interval: 30,
        minTime: '6:00',
        maxTime: '23:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
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
    $('#jam_pengambilan_edit').timepicker({
        timeFormat: 'HH:mm',
        interval: 30,
        minTime: '6:00',
        maxTime: '23:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });
    //pad tandatangan
    let canvasLokalisTtdUnitPengambilan = $("#canvas_pengambilan_alat");
    let widthLokalisTtdUnitPengambilan = "480px";
    let heightLokalisTtdUnitPengambilan = "360px"
    canvasLokalisTtdUnitPengambilan
        .attr("width", widthLokalisTtdUnitPengambilan)
        .attr("height", heightLokalisTtdUnitPengambilan);
    signaturePadTtdUnitPengambilan = new SignaturePad(canvasLokalisTtdUnitPengambilan[0], {
        backgroundColor: 'rgb(250, 250, 250)',
        minWidth: 0.5,
        maxWidth: 1.5
        
    });

    

    $('#btn_clear_canvas_pengambilan_alat').click(function (e) { 
        signaturePadTtdUnitPengambilan.clear();
        
    });
    //end
    $('#repeater_steril').repeater({
        initEmpty: false,

        ready: function () {
            var elementAlat = 'repeater_steril[0][alatSteril]';
            var elementjenisAlat = 'repeater_steril[0][jenisAlat]';
            var elementjmlAlat = 'repeater_steril[0][jumlahAlat]';

             
            $('#steril[name="' + elementAlat + '"]').select2({
                dropdownParent: $('#modal_tambah_steril'),
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
                dropdownParent: $('#modal_tambah_steril'),
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

function displayDataSteril() {

    var datatable = new DataTable('#data_steril', {
        responsive: true,
        searching: true,
        destroy: true,
        processing: true,
        serverSide: true,
        pageLength: 10,
        aaSorting: [],
        columnDefs: [{
            targets: [0, 2, 3, 4, 5, 6],
            className: "text-gray-800 fs-6 text-center"
        },{
            targets: [1],
            className: "text-gray-800 fs-6 text-start"
        }],
        ajax: {
            type: "GET",
            headers: header,
            url: "/steril/list-steril",
            data: function (d) {
                d.tahun = $('#filter_tahun').val();
                d.status = $('#filter_status').val();
            },
            error: function () {
                toastr.error("Data Gagal Dimuat");
            }
        }
    });

    // Search
    $('#search_grid_dataset').keyup(function () {
        datatable.search($(this).val()).draw();
    });

    // Reload jika filter berubah
    $('#filter_tahun').change(function () {
        datatable.ajax.reload();
    });

    $('#filter_status').change(function () {
        datatable.ajax.reload();
    });

}



function TambahDataSteril() {
    // alert("test");
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

    // $.ajax({
    //     type: 'GET', // Metode HTTP
    //     headers: header,
    //     url: '/steril/list-alat',
    //     success: function(data) {
    //         if (data.result == true) {
                
    //             console.log(data.data);
    //             var option4 = '<option value="">PILIH ALA</option>';
    //             for (var i = 0; i < data.data.length; i++) {
    //                 option4 += '<option value="' + data.data[i].id_alat + '">' + data.data[i].nama_alat + '</option>';
    //             }
    //             $('#idAlat').html(option4);
    //         }
    //     },
    //     error: function(xhr, status, error) {
    //         console.error('Error saat mengambil data:', error);
    //         alert('Gagal memuat data ruangan.');
    //     }
    // });
    

    $('#modal_tambah_steril').modal('show');
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
    var tanggalKadaluarsaAlat = $('#tanggal_kadaluarsa_alat').val();
    var tanggalPengembalianAlat = $('#tanggal_pengembalian_alat').val();
    var petugasPencucian = $('#petugas_pencucian').val();
    var petugasPacking = $('#petugas_packing').val();
    var petugasOperator = $('#petugas_operator').val();
    var petugasCheck = $('#petugas_check').val();
    var petugasUnitPengembalian = $('#petugas_unit_pengembalian').val();
    var petugasCssdPengembalian = $('#petugas_cssd_pengembalian').val();
    var keteranganPetugasCssd = $('#keterangan_petugas_cssd').val();
    alert(keteranganCssd);
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
                    displayDataSteril();
                    // $('#modal_tambah_steril').modal('toggle');
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

function DetailDataSteril(kodeSteril, dataSteril) {
    var url = '/steril/detail-data-steril/' + kodeSteril;
    window.open(url, '_blank');
    
}

function displayDataAlatSteril() {
    var kodesteril = $("#kodeSterilEdit").val();

    $(document).ready(function () {
        var datatable = new DataTable('#data_alat_steril', {
            responsive: true,
            searching: true,
            destroy: true,
            processing: true,
            serverSide: true,
            pageLength: 10,
            aaSorting: [],
            columnDefs: [{
                targets: [0, 2, 3, 4, 5],
                className: "text-gray-800 fs-6 text-center"
            },{
                targets: [1],
                className: "text-gray-800 fs-6 text-start"
            }],
            ajax: {
                type: "GET",
                headers: header,
                url: "/steril/detail-alat-steril/" + kodesteril,
                error: function () {
                    toastr.error("Data Gagal Dimuat");
                }
            }
        });
    
        const filterSearch = document.querySelector('[data-kt-permissions-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    });
}
function listDataAlatSteril() {
    var kodeSteril = $("#kodeSteril").val();

    $(document).ready(function () {
        var datatable = new DataTable('#list_alat_steril', {
            responsive: true,
            searching: true,
            destroy: true,
            processing: true,
            serverSide: true,
            pageLength: 10,
            aaSorting: [],
            columnDefs: [{
                targets: [0, 2, 3, 4],
                className: "text-gray-800 fs-6 text-center"
            },{
                targets: [1],
                className: "text-gray-800 fs-6 text-start"
            }],
            ajax: {
                type: "GET",
                headers: header,
                url: "/steril/list-alat-steril-edit/" + kodeSteril,
                error: function () {
                    toastr.error("Data Gagal Dimuat");
                }
            }
        });
    
        const filterSearch = document.querySelector('[data-kt-permissions-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    });
}
function EditDataAlatSteril(idSteril,dataAlat) {
    var dataAlatArr = dataAlat.split("|");
    var id = $('#idSteril').val(idSteril);
    
    // alert(dataAlatArr[1]);
    var idsteril=dataAlatArr[0];
    var idalat=dataAlatArr[1];
    var namaalat=dataAlatArr[2];
    var jmlalat=dataAlatArr[3];
    var jnsalat=dataAlatArr[4];
    console.log(dataAlatArr);
    console.log(id);
    // $('input[name="jenisAlatSteril"]:checked').val(jnsalat);
    $("input[name=jenisAlatSteril][value=" + jnsalat + "]").attr('checked', 'checked');
    $('#jml_alat_steril').val(jmlalat);
    $('#id_steril').val(idsteril);
     $.ajax({
        type: 'POST', // Metode HTTP
        headers: header,
        url: '/steril/list-alat',
        success: function(data) {
            if (data.result == true) {
                
                console.log(data.data);
                var option4 = '<option value="">PILIH ALAT</option>';
                for (var i = 0; i < data.data.length; i++) {
                    if (data.data[i].id_alat == idalat) {
                        option4 += '<option value="' + data.data[i].id_alat + '" selected>' + data.data[i].nama_alat + '</option>';
                    }
                    else{
                        option4 += '<option value="' + data.data[i].id_alat + '" >' + data.data[i].nama_alat + '</option>';
                    }
                    
                }
                $('#id_alat_steril').html(option4);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error saat mengambil data:', error);
            alert('Gagal memuat data Alat.');
        }
    });
    $('#modal_edit_alat_steril').modal('show');
}


function UpdateDataAlatSteril() {
    var idSteril = $('#id_steril').val();
    var idAlatSteril = $('#id_alat_steril').val();
    var jmlAlatSteril = $('#jml_alat_steril').val();
    var jnsAlatSteril = $('#jenisAlatSteril').val();

    
        var dataAlatSteril = {
            "idSteril": idSteril,
            "idAlatSteril": idAlatSteril,
            "jmlAlatSteril": jmlAlatSteril,
            "jnsAlatSteril": jnsAlatSteril
        }
        // console.log(dataAlatSteril);
        var model = {
            dataAlatSteril: dataAlatSteril
        };

        $.ajax({
            type: 'POST',
            headers: header,
            url: '/steril/edit-detail-alat-steril',
            data: model,
            success: function(data) {
                if (data.result) {

                    toastr.success("Data Steril Berhasil Disimpan");
                    displayDataAlatSteril();
                    $('#modal_edit_alat_steril').modal('toggle');
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

function EditDataSteril(kodeSteril,dataSteril) {
    var url = '/steril/view-edit-data-steril/' + kodeSteril;
    window.open(url, '_blank');
}
function EditDataPengambilan(kodeSteril,dataSteril) {
    var url = '/steril/view-data-pengambilan/' + kodeSteril;
    window.open(url, '_blank');
}
function ViewEditDataSteril() {
    
    var kodeSterilEdit = $('#kodeSterilEdit').val();
    var idRuangDt = $('#idRuangDt').val();
    var id_p_pencucian = $('#id_p_pencucian').val();
    var id_p_packing = $('#id_p_packing').val();
    var id_p_operator = $('#id_p_operator').val();
    var id_p_check = $('#id_p_check').val();
    var id_p_cssd_penerimaan = $('#id_p_cssd_penerimaan').val();
    var id_p_cssd_pengembalian = $('#id_p_cssd_pengembalian').val();
    var petugas_unit_edit = $('#petugas_unit_edit').val();
    var petugas_unit_edit = $('#petugas_unit_edit').val();


    $('#idRuangEdit').select2().on('change', function() {
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
                    if (data.data[i].id_ruang == idRuangDt) {
                        option4 += '<option value="' + data.data[i].id_ruang + '" selected>' + data.data[i].nama_ruang + '</option>';
                    }
                    else{
                        option4 += '<option value="' + data.data[i].id_ruang + '">' + data.data[i].nama_ruang + '</option>';
                    }
                    
                }
                $('#idRuangEdit').html(option4);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error saat mengambil data:', error);
            alert('Gagal memuat data ruangan.');
        }
    });

    $('#id_p_cssd_penerimaan_select').select2().on('change', function() {
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
                    if (id_p_cssd_penerimaan == data.data[i].id) {
                        option4 += '<option value="' + data.data[i].id + '" selected>' + data.data[i].name + '</option>';
                    }else{
                        option4 += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
                    }
                    
                }
                $('#id_p_cssd_penerimaan_select').html(option4);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error saat mengambil data:', error);
            alert('Gagal memuat data ruangan.');
        }
    }); 
    $('#petugas_pencucian_edit').select2().on('change', function() {
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
                    if (id_p_pencucian == data.data[i].id) {
                        option4 += '<option value="' + data.data[i].id + '" selected>' + data.data[i].name + '</option>';
                    }else{
                        option4 += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
                    }
                    
                }
                $('#petugas_pencucian_edit').html(option4);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error saat mengambil data:', error);
            alert('Gagal memuat data ruangan.');
        }
    });

    $('#petugas_packing_edit').select2().on('change', function() {
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
                    if (id_p_packing == data.data[i].id) {
                        option4 += '<option value="' + data.data[i].id + '" selected>' + data.data[i].name + '</option>';
                    }else{
                        option4 += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
                    }
                    
                }
                $('#petugas_packing_edit').html(option4);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error saat mengambil data:', error);
            alert('Gagal memuat data ruangan.');
        }
    });

    $('#petugas_operator_edit').select2().on('change', function() {
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
                    if (id_p_operator == data.data[i].id) {
                        option4 += '<option value="' + data.data[i].id + '" selected>' + data.data[i].name + '</option>';
                    }else{
                        option4 += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
                    }
                    
                }
                $('#petugas_operator_edit').html(option4);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error saat mengambil data:', error);
            alert('Gagal memuat data ruangan.');
        }
    });

    $('#petugas_check_edit').select2().on('change', function() {
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
                    if (id_p_check == data.data[i].id) {
                        option4 += '<option value="' + data.data[i].id + '" selected>' + data.data[i].name + '</option>';
                    }else{
                        option4 += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
                    }
                    
                }
                $('#petugas_check_edit').html(option4);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error saat mengambil data:', error);
            alert('Gagal memuat data ruangan.');
        }
    });

    $('#petugas_cssd_pengembalian_edit').select2().on('change', function() {
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
                    if (id_p_cssd_pengembalian == data.data[i].id) {
                        option4 += '<option value="' + data.data[i].id + '" selected>' + data.data[i].name + '</option>';
                    }else{
                        option4 += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
                    }
                    
                }
                $('#petugas_cssd_pengembalian_edit').html(option4);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error saat mengambil data:', error);
            alert('Gagal memuat data ruangan.');
        }
    });
}

function ViewPengambilanDataSteril() {
    
    var kodeSterilEdit = $('#kodeSterilEdit').val();
    var idRuangDt = $('#idRuangDt').val();
    var id_p_pencucian = $('#id_p_pencucianPengambilan').val();
    var id_p_packing = $('#id_p_packingPengambilan').val();
    var id_p_operator = $('#id_p_operatorPengambilan').val();
    var id_p_check = $('#id_p_checkPengambilan').val();
    var id_p_cssd_penerimaan = $('#id_p_cssd_penerimaan_alat').val();
   
    

    $('#idRuangPengambilan').select2().on('change', function() {
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
                    if (data.data[i].id_ruang == idRuangDt) {
                        option4 += '<option value="' + data.data[i].id_ruang + '" selected>' + data.data[i].nama_ruang + '</option>';
                    }
                    else{
                        option4 += '<option value="' + data.data[i].id_ruang + '">' + data.data[i].nama_ruang + '</option>';
                    }
                    
                }
                $('#idRuangPengambilan').html(option4);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error saat mengambil data:', error);
            alert('Gagal memuat data ruangan.');
        }
    });

    $('#id_p_cssd_terima_pengambilan').select2().on('change', function() {
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
                    if (id_p_cssd_penerimaan == data.data[i].id) {
                        option4 += '<option value="' + data.data[i].id + '" selected>' + data.data[i].name + '</option>';
                    }else{
                        option4 += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
                    }
                    
                }
                $('#id_p_cssd_terima_pengambilan').html(option4);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error saat mengambil data:', error);
            alert('Gagal memuat data ruangan.');
        }
    }); 
    $('#petugas_pencucian_pengambilan').select2().on('change', function() {
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
                    if (id_p_pencucian == data.data[i].id) {
                        option4 += '<option value="' + data.data[i].id + '" selected>' + data.data[i].name + '</option>';
                    }else{
                        option4 += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
                    }
                    
                }
                $('#petugas_pencucian_pengambilan').html(option4);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error saat mengambil data:', error);
            alert('Gagal memuat data ruangan.');
        }
    });

    $('#petugas_packing_pengambilan').select2().on('change', function() {
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
                    if (id_p_packing == data.data[i].id) {
                        option4 += '<option value="' + data.data[i].id + '" selected>' + data.data[i].name + '</option>';
                    }else{
                        option4 += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
                    }
                    
                }
                $('#petugas_packing_pengambilan').html(option4);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error saat mengambil data:', error);
            alert('Gagal memuat data ruangan.');
        }
    });

    $('#petugas_operator_pengambilan').select2().on('change', function() {
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
                    if (id_p_operator == data.data[i].id) {
                        option4 += '<option value="' + data.data[i].id + '" selected>' + data.data[i].name + '</option>';
                    }else{
                        option4 += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
                    }
                    
                }
                $('#petugas_operator_pengambilan').html(option4);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error saat mengambil data:', error);
            alert('Gagal memuat data ruangan.');
        }
    });

    $('#petugas_check_pengambilan').select2().on('change', function() {
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
                    if (id_p_check == data.data[i].id) {
                        option4 += '<option value="' + data.data[i].id + '" selected>' + data.data[i].name + '</option>';
                    }else{
                        option4 += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
                    }
                    
                }
                $('#petugas_check_pengambilan').html(option4);
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


}

$(document).on('click', '#btn_update_steril', function () {
    UpdateDataSteril();
});
function UpdateDataSteril() {
   
    var idSteril = $('#idSterilEdit').val();
    var kodeSteril = $('#kodeSterilEdit').val();
    var idRuang = $('#idRuangEdit').val();
    var petugasUnit = $('#petugas_unit_edit').val();
    var petugasCssd = $('#id_p_cssd_penerimaan_select').val();
    var tanggalPenyerahan = $('#tanggal_penyerahan_edit').val();
    var tanggalSteril = $('#tanggal_steril_edit').val();
    var jamSteril = $('#jam_steril_edit').val();
    var tanggalKadaluarsaAlat = $('#tanggal_kadaluarsa_alat_edit').val();
    var tanggalPengembalianAlat = $('#tanggal_pengembalian_alat_edit').val();
    var jamPengambilanAlat = $('#jam_pengambilan_edit').val();
    var petugasPencucian = $('#petugas_pencucian_edit').val();
    var petugasPacking = $('#petugas_packing_edit').val();
    var petugasOperator = $('#petugas_operator_edit').val();
    var petugasCheck = $('#petugas_check_edit').val();
    var petugasUnitPengembalian = $('#petugas_unit_pengembalian_edit').val();
    var petugasCssdPengembalian = $('#petugas_cssd_pengembalian_edit').val();
    var catatanPtgCssd = $('#keterangan_petugas_cssd').val();
    
    
    
    // alert(alatSterilList);
    var dataSteril = {
        "idSteril": idSteril,
        "kodeSteril": kodeSteril,
        "idRuang": idRuang,
        "petugasUnit": petugasUnit,
        "petugasCssd": petugasCssd,
        "tanggalPenyerahan": tanggalPenyerahan,
        "tanggalSteril": tanggalSteril,
        "jamSteril": jamSteril,
        "tanggalKadaluarsaAlat": tanggalKadaluarsaAlat,
        "tanggalPengembalianAlat": tanggalPengembalianAlat,
        "jamPengambilanAlat": jamPengambilanAlat,
        "catatanPtgCssd": catatanPtgCssd,
        "petugasPencucian": petugasPencucian,
        "petugasPacking": petugasPacking,
        "petugasOperator": petugasOperator,
        "petugasCheck": petugasCheck,
        "petugasUnitPengembalian": petugasUnitPengembalian,
        "petugasCssdPengembalian": petugasCssdPengembalian
        
    }
    // console.log(dataSteril);
    var model = {
        dataSteril: dataSteril
    };

    $.ajax({
        type: 'POST',
        headers: header,
        url: '/steril/edit-data-steril',
        data: model,
        success: function(data) {
            if (data.result) {

                toastr.success("Data Steril Berhasil Disimpan");
                window.location.href = "/steril/view-steril";
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

$(document).on('click', '#btn_update_pengambilan', function () {
    UpdateDataPengambilanSteril();
});
function UpdateDataPengambilanSteril() {
   
    var idSteril = $('#idSterilPengambilan').val();
    var kodeSteril = $('#kodeSteril').val();
    var ttdUnitPengambilanPic = null;
    var petugasUnitPengambilan = $('#petugas_unit_pengembalian').val();
    var petugasCssdPengambilan = $('#petugas_cssd_pengembalian').val();
    var tanggalPengambilanAlat = $('#tanggal_pengembalian').val();
    var jamPengambilanAlat = $('#jam_pengembalian').val();
    var urlTtdUnitPengambilan = signaturePadTtdUnitPengambilan.toDataURL();
    ttdUnitPengambilanPic = urlTtdUnitPengambilan.replace(/^data:image\/[a-z]+;base64,/, "");
    
    
    // alert(alatSterilList);
    var dataPengambilanSteril = {
        "idSteril": idSteril,
        "kodeSteril": kodeSteril,
        "petugasUnitPengambilan": petugasUnitPengambilan,
        "petugasCssdPengambilan": petugasCssdPengambilan,
        "tanggalPengambilanAlat": tanggalPengambilanAlat,
        "jamPengambilanAlat": jamPengambilanAlat,
        "ttdUnitPengambilan": ttdUnitPengambilanPic
        
    }
    // console.log(dataSteril);
    var model = {
        dataPengambilanSteril: dataPengambilanSteril
    };

    $.ajax({
        type: 'POST',
        headers: header,
        url: '/steril/edit-data-pengambilan',
        data: model,
        success: function(data) {
            if (data.result) {

                toastr.success("Data Steril Berhasil Disimpan");
                CetakDataSterilCek(kodeSteril);
            
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
function HapusDataSteril(kodeSteril) {
    $.ajax({
        type: "GET",
        url: '/steril/hapus-data-steril/' + kodeSteril,
        success: function(data) {
            if (data.result === true) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-danger',
                        cancelButton: 'btn btn-info'
                    },
                    buttonsStyling: false
                })
                displayDataSteril();
                swalWithBootstrapButtons.fire(
                    'Dihapus!',
                    'Data telah dihpaus.',
                    'success'
                )
            } else {
                toastr.error("Data gagal dihapus!");
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

function HapusDataAlatSteril(idSteril) {
    $.ajax({
        type: "GET",
        url: '/steril/hapus-data-alat-steril/' + idSteril,
        success: function(data) {
            if (data.result === true) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-danger',
                        cancelButton: 'btn btn-info'
                    },
                    buttonsStyling: false
                })
                displayDataAlatSteril();
                swalWithBootstrapButtons.fire(
                    'Dihapus!',
                    'Data telah dihpaus.',
                    'success'
                )
            } else {
                toastr.error("Data gagal dihapus!");
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
function isMobileDevice() {
    return /android|iphone|ipad|iPod|opera mini|iemobile|mobile/i.test(navigator.userAgent.toLowerCase());
}

function CetakDataSterilCek(kodeSteril) {
    $.ajax({
        type: "GET",
        url: '/steril/cetak-form-steril/' + kodeSteril,
        success: function(msg) {
            if (msg.result === true) {
                Swal.fire({
                    title: "Mohon Tunggu Sebentar",
                    text: "Halaman cetak Form Steril akan muncul beberapa saat ...",
                    icon: "info",
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
        
                setTimeout(() => {
                    Swal.close();
                    const content = base64ToArrayBuffer(msg.data);
                    const blob = new Blob([content], { type: "application/pdf" });
                    const url = window.URL.createObjectURL(blob);
        
                    if (isMobileDevice()) {
                        // Mobile → langsung download
                        const link = document.createElement('a');
                        link.href = url;
                        link.download = "form-steril.pdf";
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    } else {
                        // Desktop → tampilkan iframe & cetak
                        const iframe = document.createElement('iframe');
                        iframe.style.display = 'none';
                        iframe.src = url;
                        document.body.appendChild(iframe);
        
                        iframe.onload = () => {
                            setTimeout(() => {
                                iframe.focus();
                                iframe.contentWindow.print();
                            }, 500);
                        };
                    }
                }, 500);
            }
        },
        // success: function(msg) {
        //     if (msg.result === true) {
        //         Swal.fire({
        //             title: "Mohon Tunggu Sebentar",
        //             text: "Halaman cetak Form Steril akan muncul beberapa saat ...",
        //             icon: 'info',
        //             didOpen: () => {
        //                 Swal.showLoading()
        //             }
        //         });
        //         setTimeout(function() {
        //             Swal.close();
        //             const content = base64ToArrayBuffer(msg.data);
        //             const blob = new Blob([content], {
        //                 type: "application/pdf"
        //             });
        //             const url = window.URL.createObjectURL(blob);

        //             const iframe = document.createElement('iframe');
        //             iframe.style.display = 'none';
        //             iframe.src = url;
        //             document.body.appendChild(iframe);
        //             iframe.onload = () => {
        //                 setTimeout(() => {
        //                     iframe.focus();
        //                     iframe.contentWindow.print();
        //                 });
        //             };
        //         }, 500);
        //     } else {
        //         Swal.fire({
        //             title: msg.data,
        //             icon: error
        //         });
        //     }
        // },
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
function CetakDataSteril(kodeSteril) {
    $.ajax({
        type: "GET",
        url: '/steril/cetak-form-steril/' + kodeSteril,
        success: function(msg) {
            if (msg.result === true) {
                Swal.fire({
                    title: "Mohon Tunggu Sebentar",
                    text: "Halaman cetak Form Steril akan muncul beberapa saat ...",
                    icon: "info",
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
        
                setTimeout(() => {
                    Swal.close();
                    const content = base64ToArrayBuffer(msg.data);
                    const blob = new Blob([content], { type: "application/pdf" });
                    const url = window.URL.createObjectURL(blob);
        
                    if (isMobileDevice()) {
                        // Mobile → langsung download
                        const link = document.createElement('a');
                        link.href = url;
                        link.download = "form-steril.pdf";
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    } else {
                        // Desktop → tampilkan iframe & cetak
                        const link = document.createElement('a');
                        link.href = url;
                        link.download = "form-steril.pdf";
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    }
                }, 500);
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
function NewTambahDataSteril() {
    var url = '/steril/tambah-data-steril/';
    window.open(url, '_blank');
    
}

