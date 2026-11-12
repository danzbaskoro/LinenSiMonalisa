var header = {
    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
};

KTUtil.onDOMContentLoaded(function() {
    displayDataLinen();
});

function displayDataLinen() {
    $(document).ready(function () {
        var datatable = new DataTable('#data_linen', {
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
            // ajax: "/master-data/list-alat"
            ajax: {
                type: "GET",
                headers: header,
                url: "/master-data/list-linen",
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



function TambahDataLinen() {
    $('#modal_tambah_linen').modal('show');
}

function SaveDataLinen() {
    var namaLinen = $('#input_nama_linen').val();
    var satuanLinen = $('#input_satuan_linen').val();
        var dataLinen = {
            "namaLinen": namaLinen,
            "satuanLinen": satuanLinen
        }

        var model = {
            dataLinen: dataLinen
        };

        $.ajax({
            type: 'POST',
            headers: header,
            url: '/master-data/simpan-list-linen',
            data: model,
            success: function(data) {
                if (data.result) {
                    // console.log(dataLinen);

                    toastr.success("Data Linen Berhasil Disimpan");
                    displayDataLinen();
                    $('#modal_tambah_linen').modal('toggle');
                    // $('#modal_tambah_alat').modal('hide');
                } else {
                    toastr.error("Data Linen Gagal Disimpan");
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

function EditDataLinen(idLinen, dataLinen) {
    
    // var dataLinenArr = dataLinen.split("|");
    // alert(dataAlatArr[1]);
    // console.log(dataAlatArr);
    $('#id_linen').val(idLinen);
    $('#edit_nama_linen').val(dataLinen);
    // $('#edit_nama_linen').val(dataLinenArr[0]);
    // var option4 = '<option value="">Pilih Satuan</option>';
    // if(dataLinenArr[1]=='buah'){
    //     option4 += '<option value="' + dataLinenArr[1] + '" >Buah</option>';
    //     option4 += '<option value="set" >Set</option>';
    // }
    // if(dataLinenArr[1]=='set'){
    //     option4 += '<option value="' + dataLinenArr[1] + '" >Set</option>';
    //     option4 += '<option value="buah" >Buah</option>';
    // }
    
        
    // $('#edit_satuan_linen').html(option4);
    // $('#edit_satuan_linen').val(dataLinenArr[1]);
    $('#modal_edit_linen').modal('show');
}

function UpdateDataLinen() {
    var idLinen = $('#id_linen').val();
    var namaLinen = $('#edit_nama_linen').val();
    // var satuanLinen = $('#edit_satuan_linen').val();
        var dataLinen = {
            "idLinen": idLinen,
            "namaLinen": namaLinen
            // "satuanLinen": satuanLinen
        }

        var model = {
            dataLinen: dataLinen
        };

        $.ajax({
            type: 'POST',
            headers: header,
            url: '/master-data/edit-list-linen',
            data: model,
            success: function(data) {
                if (data.result) {
                    // console.log(dataLinen);

                    toastr.success("Data Linen Berhasil Disimpan");
                    displayDataLinen();
                    $('#modal_edit_linen').modal('toggle');
                } else {
                    toastr.error("Data Linen Gagal Disimpan");
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

function HapusDataLinen(id) {
    $.ajax({
        type: "GET",
        url: '/master-data/hapus-linen/' + id,
        success: function(data) {
            if (data.result === true) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-danger',
                        cancelButton: 'btn btn-info'
                    },
                    buttonsStyling: false
                })
                displayDataLinen();
                swalWithBootstrapButtons.fire(
                    'Dihapus!',
                    'Data Linen telah dihapus.',
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