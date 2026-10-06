var header = {
    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
};

KTUtil.onDOMContentLoaded(function() {
    displayDataRuang();
});

function displayDataRuang() {
    $(document).ready(function () {
        var datatable = new DataTable('#data_ruang', {
            responsive: true,
            searching: true,
            destroy: true,
            processing: true,
            serverSide: true,
            pageLength: 10,
            aaSorting: [],
            columnDefs: [{
                targets: [0, 2],
                className: "text-gray-800 fs-6 text-center"
            },{
                targets: [1],
                className: "text-gray-800 fs-6 text-start"
            }],
            ajax: {
                type: "GET",
                headers: header,
                url: "/master-data/list-ruang",
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



function TambahDataRuang() {
    $('#modal_tambah_ruang').modal('show');
}

function SaveDataRuang() {
    var namaRuang = $('#input_nama_ruang').val();
    var satuanRuang = $('#input_satuan_ruang').val();
        var dataRuang = {
            "namaRuang": namaRuang
        }

        var model = {
            dataRuang: dataRuang
        };

        $.ajax({
            type: 'POST',
            headers: header,
            url: '/master-data/simpan-list-ruang',
            data: model,
            success: function(data) {
                if (data.result) {
                    toastr.success("Data Ruang Berhasil Disimpan");
                    displayDataRuang();
                    $('#modal_tambah_ruang').modal('toggle');
                } else {
                    toastr.error("Data Ruang Gagal Disimpan");
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

function EditDataRuang(idRuang, dataRuang) {
    
    
    var dataRuangArr = dataRuang.split("|");
    // alert(dataAlatArr[1]);
    // console.log(dataAlatArr);
    $('#id_ruang').val(idRuang);
    var edit_nama_ruang =$('#edit_nama_ruang').val(dataRuang);
    // alert(dataRuang);
    $('#modal_edit_ruang').modal('show');
}

function UpdateDataRuang() {
    var idRuang = $('#id_ruang').val();
    var namaRuang = $('#edit_nama_ruang').val();
        var dataRuang = {
            "idRuang": idRuang,
            "namaRuang": namaRuang
        }
        
        var model = {
            dataRuang: dataRuang
        };

        $.ajax({
            type: 'POST',
            headers: header,
            url: '/master-data/edit-list-ruang',
            data: model,
            success: function(data) {
                if (data.result) {

                    toastr.success("Data Ruang Berhasil Disimpan");
                    displayDataRuang();
                    $('#modal_edit_ruang').modal('toggle');
                } else {
                    toastr.error("Data Ruang Gagal Disimpan");
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

function HapusDataRuang(id) {
    $.ajax({
        type: "GET",
        url: '/master-data/hapus-data-ruang/' + id,
        success: function(data) {
            if (data.result === true) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-danger',
                        cancelButton: 'btn btn-info'
                    },
                    buttonsStyling: false
                })
                displayDataRuang();
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