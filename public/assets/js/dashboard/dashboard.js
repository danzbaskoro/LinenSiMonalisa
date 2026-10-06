"use strict";
// console.log(typeof ChartDataLabels); 
// Chart.register(ChartDataLabels);

var header = {
    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
};

let arrayJumlahSteril = [];
let arrayNamaRuang = [];

KTUtil.onDOMContentLoaded(function () {
    displayDataAlatKadaluarsa();
    displayDataAlatSteril();
    ViewAlatKadaluarsa();
    $("#bulan_steril").datepicker({
        format: "mm-yyyy",
        startView: "months",
        minViewMode: "months"
    });


    // generateGrafik();
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
function displayDataAlatKadaluarsa() {
    $(document).ready(function () {
        var datatable = new DataTable('#data_alat_kadaluarsa', {
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
                url: "/dashboard/list-alat-kadaluarsa",
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

$(document).on("change", "#bulan_steril", function () {
    generateGrafik();
});

function generateGrafik() {
    var tanggalSteril = $('#bulan_steril').val();
    var tanggal = tanggalSteril.split("-");
    // console.log(tanggalSteril);
   
    $.ajax({
        type: "GET",
        headers: header,
        url: '/dashboard/steril-bulanan/data?bulan=' + tanggal[0] + '&tahun=' + tanggal[1],
        success: function (data) {
            if (data.result) {
                arrayJumlahSteril = [];
                arrayNamaRuang = [];
                var datas = data.data;
                if (datas != null) {
                    for (var i = 0; i < datas.length; i++) {
                        var bagian = datas[i].nama_ruang;
                        arrayNamaRuang.push(bagian.replace('KLINIK ', ''));
                        arrayJumlahSteril.push(datas[i].jml);
                       
                    }
                }

               

                grafikSterilBulanan.init();
            } else {
                Swal.fire({
                    title: data.data,
                    icon: "error",
                });
            }
        },
        error: function (jqXHR, exception) {
            if (exception === 'parsererror') {
                toastr.error("Tidak bisa dimuat");
                return false;
            } else if (jqXHR.status == 404) {
                toastr.error("Halaman tidak ditemukan");
                return false;
            } else if (jqXHR.status == 500) {
                toastr.error("Server Error. Hubungi MDSI");
                return false;
            }
        }
    });

}

let chartSterilBulanan;

var grafikSterilBulanan = function () {
    var fontFamily = KTUtil.getCssVariableValue('--bs-font-sans-serif');

    var grafikBulanan = function () {
        var ctx = document.getElementById('grafik_steril_bulanan');

        const data = {
            labels: arrayNamaRuang,
            datasets: [{
                label: 'Jumlah Steril',
                data: arrayJumlahSteril,
                borderColor: 'rgb(54, 162, 235)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderWidth: 1
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: false,
                    },
                    legend: {
                        labels: {
                            font: {
                                size: 15,
                                family: fontFamily
                            }
                        }
                    },
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        formatter: Math.round,
                        font: {
                            weight: 'bold',
                            size: 15,
                            family: fontFamily
                        }
                    }
                }
            }
        };

        if (chartSterilBulanan) chartSterilBulanan.destroy();
        chartSterilBulanan = new Chart(ctx, config);
    }
    return {
        init: function () {
            Chart.defaults.font.size = 12;
            Chart.defaults.font.family = fontFamily;

            grafikBulanan();
        }
    };
}();

function sterilUlang(kodeSteril,dataSteril) {
    var url = '/dashboard/view-steril-ulang/' + kodeSteril;
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
                targets: [0, 2, 3, 4],
                className: "text-gray-800 fs-6 text-center"
            },{
                targets: [1],
                className: "text-gray-800 fs-6 text-start"
            }],
            ajax: {
                type: "GET",
                headers: header,
                url: "/dashboard/detail-alat-steril/" + kodesteril,
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

$(document).on('click', '#btn_update_alat_kadaluarsa', function () {
    UpdateAlatKadaluarsa();
});
function UpdateAlatKadaluarsa() {
   
    var idSteril = $('#idSterilEdit').val();
    var kodeSteril = $('#kodeSterilEdit').val();
    var idRuang = $('#idRuangEdit').val();
    var petugasUnit = $('#petugas_unit_edit').val();
    var petugasCssd = $('#id_p_cssd_penerimaan_select').val();
    var tanggalPenyerahan = $('#tanggal_penyerahan_edit').val();
    var tanggalSteril = $('#tanggal_steril_edit').val();
    var tanggalKadaluarsaAlat = $('#tanggal_kadaluarsa_alat_edit').val();
    var petugasPencucian = $('#petugas_pencucian_edit').val();
    var petugasPacking = $('#petugas_packing_edit').val();
    var petugasOperator = $('#petugas_operator_edit').val();
    var petugasCheck = $('#petugas_check_edit').val();
    var ketPengambilan = $('#keterangan_pengambilan').val();
   
    
    
    
    // alert(alatSterilList);
    var dataSterilAlatKadaluarsa = {
        "idSteril": idSteril,
        "kodeSteril": kodeSteril,
        "idRuang": idRuang,
        "petugasUnit": petugasUnit,
        "petugasCssd": petugasCssd,
        "tanggalPenyerahan": tanggalPenyerahan,
        "tanggalSteril": tanggalSteril,
        "tanggalKadaluarsaAlat": tanggalKadaluarsaAlat,
        "petugasPencucian": petugasPencucian,
        "petugasPacking": petugasPacking,
        "petugasOperator": petugasOperator,
        "petugasCheck": petugasCheck,
        "ketPengambilan": ketPengambilan
        
    }
    // console.log(dataSteril);
    var model = {
        dataSterilAlatKadaluarsa: dataSterilAlatKadaluarsa
    };

    $.ajax({
        type: 'POST',
        headers: header,
        url: '/dashboard/edit-data-steril-alat-kadaluarsa',
        data: model,
        success: function(data) {
            if (data.result) {

                toastr.success("Data Steril Berhasil Disimpan");
                window.location.href = "/dashboard";
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

function ViewAlatKadaluarsa() {
    
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