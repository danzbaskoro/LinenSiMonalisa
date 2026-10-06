var header = {
    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
};

KTUtil.onDOMContentLoaded(function() {
    displayDataAlat();
});

function displayDataAlat() {
    $(document).ready(function () {
        var datatable = new DataTable('#data_alat', {
            responsive: true,
            searching: true,
            destroy: true,
            processing: true,
            serverSide: true,
            pageLength: 10,
            aaSorting: [],
            columnDefs: [{
                targets: [0, 2, 3],
                className: "text-gray-800 fs-6 text-center"
            },{
                targets: [1],
                className: "text-gray-800 fs-6 text-start"
            }],
            // ajax: "/master-data/list-alat"
            ajax: {
                type: "GET",
                headers: header,
                url: "/master-data/list-alat",
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



function TambahDataAlat() {
    $('#modal_tambah_alat').modal('show');
}

function SaveDataAlat() {
    var namaAlat = $('#input_nama_alat').val();
    var satuanAlat = $('#input_satuan_alat').val();
        var dataAlat = {
            "namaAlat": namaAlat,
            "satuanAlat": satuanAlat
        }

        var model = {
            dataAlat: dataAlat
        };

        $.ajax({
            type: 'POST',
            headers: header,
            url: '/master-data/simpan-list-alat',
            data: model,
            success: function(data) {
                if (data.result) {
                    // console.log(dataAlat);

                    toastr.success("Data Alat Berhasil Disimpan");
                    displayDataAlat();
                    $('#modal_tambah_alat').modal('toggle');
                    // $('#modal_tambah_alat').modal('hide');
                } else {
                    toastr.error("Data Alat Gagal Disimpan");
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

function EditDataAlat(idAlat, dataAlat) {
    
    
    var dataAlatArr = dataAlat.split("|");
    // alert(dataAlatArr[1]);
    // console.log(dataAlatArr);
    $('#id_alat').val(idAlat);
    $('#edit_nama_alat').val(dataAlatArr[0]);
    var option4 = '<option value="">Pilih Satuan</option>';
    if(dataAlatArr[1]=='buah'){
        option4 += '<option value="' + dataAlatArr[1] + '" >Buah</option>';
        option4 += '<option value="set" >Set</option>';
    }
    if(dataAlatArr[1]=='set'){
        option4 += '<option value="' + dataAlatArr[1] + '" >Set</option>';
        option4 += '<option value="buah" >Buah</option>';
    }
    
        
    $('#edit_satuan_alat').html(option4);
    $('#edit_satuan_alat').val(dataAlatArr[1]);
    $('#modal_edit_alat').modal('show');
}

function UpdateDataAlat() {
    var idAlat = $('#id_alat').val();
    var namaAlat = $('#edit_nama_alat').val();
    var satuanAlat = $('#edit_satuan_alat').val();
        var dataAlat = {
            "idAlat": idAlat,
            "namaAlat": namaAlat,
            "satuanAlat": satuanAlat
        }

        var model = {
            dataAlat: dataAlat
        };

        $.ajax({
            type: 'POST',
            headers: header,
            url: '/master-data/edit-list-alat',
            data: model,
            success: function(data) {
                if (data.result) {
                    // console.log(dataAlat);

                    toastr.success("Data Alat Berhasil Disimpan");
                    displayDataAlat();
                    $('#modal_edit_alat').modal('toggle');
                } else {
                    toastr.error("Data Alat Gagal Disimpan");
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

function HapusDataAlat(id) {
    $.ajax({
        type: "GET",
        url: '/master-data/hapus/' + id,
        success: function(data) {
            if (data.result === true) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-danger',
                        cancelButton: 'btn btn-info'
                    },
                    buttonsStyling: false
                })
                displayDataAlat();
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