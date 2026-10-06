var header = {
    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
};
let signaturePadparafUser;
KTUtil.onDOMContentLoaded(function() {
    displayDataUser();
    //pad tandatangan
    let canvasLokalisparafUser = $("#canvas_paraf_user");
    let widthLokalisparafUser = "100px";
    let heightLokalisparafUser = "100px"
    canvasLokalisparafUser
        .attr("width", widthLokalisparafUser)
        .attr("height", heightLokalisparafUser);
    signaturePadparafUser = new SignaturePad(canvasLokalisparafUser[0], {
        backgroundColor: 'rgb(255, 255, 255)',
        minWidth: 0.5,
        maxWidth: 1.5
        
    });

    

    $('#btn_clear_canvas_paraf_user').click(function (e) { 
        signaturePadparafUser.clear();
        
    });
    //end
});

function displayDataUser() {
    $(document).ready(function () {
        var datatable = new DataTable('#data_user', {
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
            ajax: {
                type: "GET",
                headers: header,
                url: "/master-data/list-user",
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



function TambahDataUser() {
    $('#modal_tambah_user').modal('show');
}

function SaveDataUser() {
    var namaUser = $('#input_nama_user').val();
    var userName = $('#input_username').val();
    var passwordUser = $('#input_password').val();
    var kodeUser = $('#input_kode_user').val();
    var parafUserPic = null;
    var urlParafUser = signaturePadparafUser.toDataURL();
    parafUserPic = urlParafUser.replace(/^data:image\/[a-z]+;base64,/, "");
        var dataUser = {
            "namaUser": namaUser,
            "userName": userName,
            "passwordUser": passwordUser,
            "kodeUser": kodeUser,
            "parafUser": parafUserPic

        }

        var model = {
            dataUser: dataUser
        };

        $.ajax({
            type: 'POST',
            headers: header,
            url: '/master-data/simpan-list-user',
            data: model,
            success: function(data) {
                if (data.result) {
                    toastr.success("Data User Berhasil Disimpan");
                    displayDataUser();
                    $('#modal_tambah_user').modal('toggle');
                    // $('#modal_tambah_User').modal('hide');
                } else {
                    toastr.error("Data User Gagal Disimpan");
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

function EditDataUser(idUser, dataUser) {
    
    
    var dataUserArr = dataUser.split("|");
    // alert(dataUserArr[1]);
    // console.log(dataUserArr);
    $('#id_user').val(idUser);
    $('#edit_nama_user').val(dataUserArr[0]);
    $('#edit_username').val(dataUserArr[1]);
    $('#edit_kode_user').val(dataUserArr[2]);
    // $('#edit_kode_user').val(dataUserArr[2]);
    $('#gambar_paraf_user').attr('src', 'data:image/png;base64,' + dataUserArr[3]);
    
    $('#modal_edit_user').modal('show');
}

function UpdateDataUser() {
    var idUser = $('#id_user').val();
    var namaUser = $('#edit_nama_user').val();
    var userName = $('#edit_username').val();
    var kodeUser = $('#edit_kode_user').val();
        var dataUser = {
            "idUser": idUser,
            "namaUser": namaUser,
            "userName": userName,
            "kodeUser": kodeUser

        }

        var model = {
            dataUser: dataUser
        };

        $.ajax({
            type: 'POST',
            headers: header,
            url: '/master-data/edit-list-user',
            data: model,
            success: function(data) {
                if (data.result) {
                    // console.log(dataUser);

                    toastr.success("Data User Berhasil Disimpan");
                    displayDataUser();
                    $('#modal_edit_user').modal('toggle');
                } else {
                    toastr.error("Data User Gagal Disimpan");
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

function HapusDataUser(id) {
    $.ajax({
        type: "GET",
        url: '/master-data/hapus-data-user/' + id,
        success: function(data) {
            if (data.result === true) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-danger',
                        cancelButton: 'btn btn-info'
                    },
                    buttonsStyling: false
                })
                displayDataUser();
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

function ResetPasswordUser(id) {
    // var idUser = $('#id_user').val(id);
    var idUser = id;
    
        var dataUser = {
            "idUser": idUser

        }
        // alert(dataUser);
        var model = {
            dataUser: dataUser
        };

        $.ajax({
            type: 'POST',
            headers: header,
            url: '/master-data/reset-password-user',
            data: model,
            success: function(data) {
                if (data.result) {
                    // console.log(dataUser);

                    toastr.success("Data User Berhasil Disimpan");
                    displayDataUser();
                    // $('#modal_edit_user').modal('toggle');
                } else {
                    toastr.error("Data User Gagal Disimpan");
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