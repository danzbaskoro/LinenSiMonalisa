@extends('homepage.layout.main')
@section('title', 'Sterill')
@section('content')



<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="row gy-5 g-xl-8 pb-7 pt-7">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <span class="card-label fw-bolder fs-3 text-dark mb-2 text-start">STERILL</span>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="/dashboard/main" class="text-muted text-hover-primary">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Sterill</li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Data Sterill</li>
            </ul>
        </div>
    </div>
</div>
<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="card card-flush">
        <div class="card-body">
            <form id="" class="form" action="#">
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">Form Permintaan Steril</h1>
                        <!--end::Title-->
                        <div class="text-muted fw-semibold fs-5">Harap isikan data dengan benar.</div>
                    </div>
                    <!--end::Heading-->
                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <!--begin::Col-->
                        <div class="col-md-4 fv-row">
                            <label class=" fs-6 fw-semibold mb-2">Ruang</label>
                            <select class="form-select form-select-solid"  id="idRuang" name="idRuang" data-control="select2" data-hide-search="true" data-placeholder="Pilih Ruangan" name="idRuang">
                               
                            </select>
                        </div>
                        <!--begin::Col-->
                        <div class="col-md-4 fv-row">
                            <label class="fs-6 fw-semibold mb-2">User Pengirim</label>
                            <input class="form-control form-control-solid " placeholder="" type="text" id="petugas_unit" name="petugas_unit" />
                        </div>
                        <!--end::Col-->
                        <div class="col-md-4 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Tanggal Penyerahan Alat</label>
                            <!--begin::Input-->
                            <div class="position-relative d-flex align-items-center">
                                <!--begin::Icon-->
                                <i class="ki-outline ki-calendar-8 fs-2 position-absolute mx-4"></i>
                                <!--end::Icon-->
                                <!--begin::Datepicker-->
                                <input class="form-control form-control-solid ps-12" type="text" placeholder="Select a date" value="<?= date('Y-m-d') ?>" id="tanggal_penyerahan" name="tanggal_penyerahan" />
                                <!--end::Datepicker-->
                            </div>
                            <!--end::Input-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <div class="row g-9 mb-8">
                        <!--begin::Col-->
                        <div class="col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Catatan</label>
                            <textarea name="keterangan_user_pengirim" id="keterangan_user_pengirim" class="form-control form-control-solid " cols="30" rows="10"></textarea>
                        </div>
                        <!--end::Col-->
                        <div class="col-md-6 fv-row">
                        <label class="fs-6 fw-semibold mb-2">Tandatangan User Pengirim</label>
                            <div class="row">
                                <div id="signature_pad" class="signature-pad">
                                    <div class="signature-pad-body">
                                        <canvas id="canvas_pengiriman_alat" class="border border-2"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="btn btn-sm btn-danger clear" id="btn_clear_canvas_pengiriman_alat">
                                        <i class="fas fa-broom text-white"></i>
                                        CLEAR
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Input group-->
                    <div class="separator d-flex flex-center mb-8"></div>
                    <!--begin::Input group-->
                    <div id="repeater_steril_ajuan">
                        <div data-repeater-list="repeater_steril_ajuan">
                            <div data-repeater-item>
                                <div class="row g-9 mb-8">
                                    <div class="col-md-1 text-center">
                                        <button class="btn btn-icon-danger btn-active-danger mt-8 p-2" data-repeater-delete type="button">
                                            <i class="fas fa-trash fs-2"></i>
                                        </button>
                                    </div>
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <label class=" fs-6 fw-semibold mb-2">Alat</label>
                                        <select class="form-select form-select-solid" id="ajuan_steril" name="alatSterilAjuan" >
                                            
                                        </select>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <label class=" fs-6 fw-semibold mb-2">Jenis Alat</label>
                                        <!--begin::Input-->
                                        <div class="position-relative d-flex align-items-center">
                                            <!--begin::Checkbox-->
                                            <label class="form-check form-check-custom form-check-solid me-10">
                                                <input class="form-check-input h-20px w-20px" type="radio" id="jenisAlatAjuan" name="jenisAlatAjuan" value="Kotor" checked="checked" />
                                                <span class="form-check-label fw-semibold">Kotor</span>
                                            </label>
                                            <!--end::Checkbox-->
                                            <!--begin::Checkbox-->
                                            <label class="form-check form-check-custom form-check-solid">
                                                <input class="form-check-input h-20px w-20px" type="radio" id="jenisAlatAjuan" name="jenisAlatAjuan" value="Kadaluarsa" />
                                                <span class="form-check-label fw-semibold">Kadaluarsa</span>
                                            </label>
                                            <!--end::Checkbox-->
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-3 fv-row">
                                        <label class=" fs-6 fw-semibold mb-2">Jumlah</label>
                                        <!--begin::Input-->
                                        <div class="position-relative d-flex align-items-center">
                                            
                                            <!--begin::Datepicker-->
                                            <input class="form-control form-control-solid " type="text" placeholder="" name="jumlahAlatAjuan" id="jumlahAlatAjuan"/>
                                            <!--end::Datepicker-->
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Col-->
                                    
                                </div>
                                <!--end::Input group-->
                                </div>
                            </div>
                    
                            <div class="row g-9 mb-8">
                                <div class="col-md-3 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Tambah Alat</label>
                                    <!--begin::Input-->
                                    <div class="position-relative d-flex align-items-center">
                                        
                                        <!--begin::Datepicker-->
                                        <button type="button" data-repeater-create class="btn btn-flex btn-primary" >
                                            <i class="ki-outline ki-plus fs-2"></i>
                                        </button>
                                        <!--end::Datepicker-->
                                    </div>
                                    <!--end::Input-->
                                </div>
                            </div>
                    </div>
                    <div class="separator d-flex flex-center mb-8"></div>
                    <!--begin::Actions-->
                    <div class="text-center">
                       
                        <button type="button" id="btn_simpan_ajuan_steril" class="btn btn-primary" >
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait... 
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
        </div>
    </div>
</div>


@endsection

@section('script-js')
<script src="{{ App\Helpers\VersionJS::Auto('/assets/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
<script src="{{ App\Helpers\VersionJS::Auto('/assets/js/homepage/ajuan-steril.js')}}"></script>
<script src="{{ env('APP_URL') }}/assets/plugins/custom/signature/signature_pad.js"></script>
<script src="{{ env('APP_URL') }}/assets/plugins/custom/signature/sign_canvas.js"></script>
@endsection