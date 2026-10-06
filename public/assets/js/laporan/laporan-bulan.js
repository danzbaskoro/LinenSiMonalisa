KTUtil.onDOMContentLoaded(function () {
    
    $("#bulan_laporan").datepicker({
        format: "mm-yyyy",
        startView: "months", 
        minViewMode: "months"

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
function isMobileDevice() {
    return /android|iphone|ipad|iPod|opera mini|iemobile|mobile/i.test(navigator.userAgent.toLowerCase());
}
function CetakLaporanBulan() {
    var bulanTahun = $('#bulan_laporan').val();
    var dataBulanTahun = bulanTahun.split("-");
    
    var bulan=dataBulanTahun[0];
    var tahun=dataBulanTahun[1];
    var dataBulan = {
        "bulan": bulan,
        "tahun": tahun
        
    }
    var model = {
        dataBulan: dataBulan
    };
    $.ajax({
        type: "GET",
        url: '/laporan/cetak-laporan-bulan/',
        data: model,
        success: function(msg) {
            if (msg.result === true) {
                Swal.fire({
                    title: "Mohon Tunggu Sebentar",
                    text: "Halaman cetak Form Steril akan muncul beberapa saat ...",
                    icon: 'info',
                    didOpen: () => {
                        Swal.showLoading()
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
                        link.download = "laporan-steril-bulanan.pdf";
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
                // setTimeout(function() {
                //     Swal.close();
                //     const content = base64ToArrayBuffer(msg.data);
                //     const blob = new Blob([content], {
                //         type: "application/pdf"
                //     });
                //     const url = window.URL.createObjectURL(blob);

                //     const iframe = document.createElement('iframe');
                //     iframe.style.display = 'none';
                //     iframe.src = url;
                //     document.body.appendChild(iframe);
                //     iframe.onload = () => {
                //         setTimeout(() => {
                //             iframe.focus();
                //             iframe.contentWindow.print();
                //         });
                //     };
                // }, 500);
            } else {
                Swal.fire({
                    title: msg.data,
                    icon: error
                });
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



function ExcelLaporanBulan() {
    var bulanTahun = $('#bulan_laporan').val();
    var dataBulanTahun = bulanTahun.split("-");
    
    var bulan=dataBulanTahun[0];
    var tahun=dataBulanTahun[1];
     
    window.location.href = '/laporan/export-sterilisasi-bulan/?bulan=' + bulan + '&tahun=' + tahun;
}
function ExcelLaporanTahun() {
    var tahunLaporan = $('#tahun_laporan').val();
   
     
    window.location.href = '/laporan/export-sterilisasi-tahun/?tahun=' + tahunLaporan;
}

function CetakLaporanTahun() {
    var tahunLaporan = $('#tahun_laporan').val();
    // alert(tahunLaporan);
    var dataTahun = {
       
        "tahun": tahunLaporan
        
    }
    var model = {
        dataTahun: dataTahun
    };
    $.ajax({
        type: "GET",
        url: '/laporan/cetak-laporan-tahun/',
        data: model,
        success: function(msg) {
            if (msg.result === true) {
                Swal.fire({
                    title: "Mohon Tunggu Sebentar",
                    text: "Halaman cetak Form Steril akan muncul beberapa saat ...",
                    icon: 'info',
                    didOpen: () => {
                        Swal.showLoading()
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
                        link.download = "Laporan-steril-tahunan.pdf";
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
                // setTimeout(function() {
                //     Swal.close();
                //     const content = base64ToArrayBuffer(msg.data);
                //     const blob = new Blob([content], {
                //         type: "application/pdf"
                //     });
                //     const url = window.URL.createObjectURL(blob);

                //     const iframe = document.createElement('iframe');
                //     iframe.style.display = 'none';
                //     iframe.src = url;
                //     document.body.appendChild(iframe);
                //     iframe.onload = () => {
                //         setTimeout(() => {
                //             iframe.focus();
                //             iframe.contentWindow.print();
                //         });
                //     };
                // }, 500);
            } else {
                Swal.fire({
                    title: msg.data,
                    icon: error
                });
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