var header = {
    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
};
KTUtil.onDOMContentLoaded(function() {
    displayDataSteril();
    displayDataAlatSteril();
    viewDetailSterilisasi();
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
    $(document).ready(function () {
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
                url: "/homepage/daftar-steril-homepage",
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
function isMobileDevice() {
    return /android|iphone|ipad|iPod|opera mini|iemobile|mobile/i.test(navigator.userAgent.toLowerCase());
}
function CetakDataSteril(kodeSteril) {
    $.ajax({
        type: "GET",
        url: '/homepage/cetak-form-steril/' + kodeSteril,
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
                        // const iframe = document.createElement('iframe');
                        // iframe.style.display = 'none';
                        // iframe.src = url;
                        // document.body.appendChild(iframe);
        
                        // iframe.onload = () => {
                        //     setTimeout(() => {
                        //         iframe.focus();
                        //         iframe.contentWindow.print();
                        //     }, 500);
                        // };
                        //langsung donwonload
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
function DetailDataSteril(kodeSteril,dataSteril) {
    var url = '/homepage/view-detail-data-steril/' + kodeSteril;
    window.open(url, '_blank');
}
function displayDataAlatSteril() {
    var kodesteril = $("#kodeSterilDetail").val();
    // alert(kodesteril);
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
                url: "/homepage/detail-alat-steril/" + kodesteril,
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
function viewDetailSterilisasi()
{
    var dataIdRuang = $('#idRuangDt').val();
    var id_p_cssd_penerimaan = $('#id_p_cssd_penerimaan').val();
    var id_p_pencucian = $('#id_p_pencucian').val();
    var id_p_packing = $('#id_p_packing').val();
    var id_p_operator = $('#id_p_operator').val();
    var id_p_check = $('#id_p_check').val();
    var id_p_cssd_pengembalian = $('#id_p_cssd_pengembalian').val();

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
                    if (data.data[i].id_ruang == dataIdRuang) {
                        option4 += '<option value="' + data.data[i].id_ruang + '" selected>' + data.data[i].nama_ruang + '</option>';
                    }
                    
                    
                }
                $('#idRuang').html(option4);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error saat mengambil data:', error);
            alert('Gagal memuat data ruangan.');
        }
    });
    $('#id_p_cssd_penerimaan_home').select2().on('change', function() {
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
                $('#id_p_cssd_penerimaan_home').html(option4);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error saat mengambil data:', error);
            alert('Gagal memuat data ruangan.');
        }
    }); 
    //petugas-petugas
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
                    if (id_p_pencucian == data.data[i].id) {
                        option4 += '<option value="' + data.data[i].id + '" selected>' + data.data[i].name + '</option>';
                    }else{
                        option4 += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
                    }
                    
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
                    if (id_p_packing == data.data[i].id) {
                        option4 += '<option value="' + data.data[i].id + '" selected>' + data.data[i].name + '</option>';
                    }else{
                        option4 += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
                    }
                    
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
                    if (id_p_operator == data.data[i].id) {
                        option4 += '<option value="' + data.data[i].id + '" selected>' + data.data[i].name + '</option>';
                    }else{
                        option4 += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
                    }
                    
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
                    if (id_p_check == data.data[i].id) {
                        option4 += '<option value="' + data.data[i].id + '" selected>' + data.data[i].name + '</option>';
                    }else{
                        option4 += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
                    }
                    
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
                    if (id_p_cssd_pengembalian == data.data[i].id) {
                        option4 += '<option value="' + data.data[i].id + '" selected>' + data.data[i].name + '</option>';
                    }else{
                        option4 += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
                    }
                    
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