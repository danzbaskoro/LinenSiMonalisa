@extends('layout.main')
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
                <li class="breadcrumb-item text-muted">Tambah Data Sterill</li>
            </ul>
        </div>
    </div>
</div>
<div id="kt_app_content_container" class="app-container container-fluid">
    
        <div class="card-body">
            <div class="row g-9 mb-8">
                <!--begin::Col-->
                <div class="col-md-4 fv-row">
                    <label class=" fs-6 fw-semibold mb-2">Ruang</label>
                    <select class="form-select form-select-solid" id="idRuang" name="idRuang" data-control="select2" data-hide-search="true" data-placeholder="Pilih Ruangan" name="idRuang">
                       
                    </select>
                </div>
                <!--begin::Col-->
                <div class="col-md-4 fv-row">
                    <label class="fs-6 fw-semibold mb-2">User Penerimaan Unit</label>
                    <input class="form-control form-control-solid " placeholder="" type="text" id="petugas_unit" name="petugas_unit" />
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-4 fv-row">
                    <label class="fs-6 fw-semibold mb-2">User Penerimaan CSSD</label>
                    <!--begin::Input-->
                   
                        <select class="form-select form-select-solid" id="petugas_cssd" name="petugas_cssd" data-control="select2" data-hide-search="true" data-placeholder="Pilih User" name="target_assign">
                        </select>
                    
                    <!--end::Input-->
                </div>
                <!--end::Col-->
                <!--end::Col-->
            </div>
            <div class="row g-9 mb-8">
                
                <!--begin::Col-->
                <div class="col-md-3 fv-row">
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
                
                <!--begin::Col-->
                <div class="col-md-2 fv-row">
                    <label class="fs-6 fw-semibold mb-2">Tanggal Steril</label>
                    <!--begin::Input-->
                    <div class="position-relative d-flex align-items-center">
                        <!--begin::Icon-->
                        <i class="ki-outline ki-calendar-8 fs-2 position-absolute mx-4"></i>
                        <!--end::Icon-->
                        <!--begin::Datepicker-->
                        <input class="form-control form-control-solid ps-12" type="text" placeholder="Select a date" value="<?= date('Y-m-d') ?>" id="tanggal_steril" name="tanggal_steril" />
                        <!--end::Datepicker-->
                    </div>
                    <!--end::Input-->
                </div>
                <div class="col-md-1 fv-row">
                    <label class="fs-6 fw-semibold mb-2">Jam Steril</label>
                    <!--begin::Input-->
                    <div class="position-relative d-flex align-items-center">
                        
                        <!--begin::Datepicker-->
                        <input class="form-control form-control-solid" type="text" placeholder="" value="<?= date('H:m') ?>" id="jam_steril" name="jam_steril" />
                        <!--end::Datepicker-->
                    </div>
                    <!--end::Input-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-3 fv-row">
                    <label class="fs-6 fw-semibold mb-2">Tanggal Kadaluarsa Alat</label>
                    <!--begin::Input-->
                    <div class="position-relative d-flex align-items-center">
                        <!--begin::Icon-->
                        <i class="ki-outline ki-calendar-8 fs-2 position-absolute mx-4"></i>
                        <!--end::Icon-->
                        <!--begin::Datepicker-->
                        <input class="form-control form-control-solid ps-12" type="text" placeholder="Select a date" value="" id="tanggal_kadaluarsa_alat" name="tanggal_kadaluarsa_alat" />
                        <!--end::Datepicker-->
                    </div>
                    <!--end::Input-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-3 fv-row">
                    <label class="fs-6 fw-semibold mb-2">Tanggal Pengembalian</label>
                    <!--begin::Input-->
                    <div class="position-relative d-flex align-items-center">
                        <!--begin::Icon-->
                        <i class="ki-outline ki-calendar-8 fs-2 position-absolute mx-4"></i>
                        <!--end::Icon-->
                        <!--begin::Datepicker-->
                        <input class="form-control form-control-solid ps-12" type="text" placeholder="Select a date" value="" id="tanggal_pengembalian_alat" name="tanggal_pengembalian_alat" />
                        <!--end::Datepicker-->
                    </div>
                    <!--end::Input-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row g-9 mb-8">
                <!--begin::Col-->
                <div class="col-md-3 fv-row">
                    <label class="fs-6 fw-semibold mb-2">Petugas Pencucian</label>
                    <select class="form-select form-select-solid"  id="petugas_pencucian" name="petugas_pencucian" data-control="select2" data-hide-search="true" data-placeholder="Pilih User" >
                    </select>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-3 fv-row">
                    <label class="fs-6 fw-semibold mb-2">Petugas Packing</label>
                    <!--begin::Input-->
                        <select class="form-select form-select-solid" id="petugas_packing" name="petugas_packing" data-control="select2" data-hide-search="true" data-placeholder="Pilih User" >
                        </select>
                    <!--end::Input-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-3 fv-row">
                    <label class="fs-6 fw-semibold mb-2">Petugas Operator</label>
                    <!--begin::Input-->
                        <select class="form-select form-select-solid" id="petugas_operator" name="petugas_operator" data-control="select2" data-hide-search="true" data-placeholder="Pilih User" name="target_assign">
                        </select>
                    <!--end::Input-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-3 fv-row">
                    <label class="fs-6 fw-semibold mb-2">Petugas Check Akhir</label>
                    <!--begin::Input-->
                        <select class="form-select form-select-solid"  id="petugas_check" name="petugas_check" data-control="select2" data-hide-search="true" data-placeholder="Pilih User" name="target_assign">
                        </select>
                    <!--end::Input-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row g-9 mb-8">
                <!--begin::Col-->
                <div class="col-md-6 fv-row">
                    <label class="fs-6 fw-semibold mb-2">Petugas Unit Pengambilan</label>
                    <input class="form-control form-control-solid " placeholder="" type="text" id="petugas_unit_pengembalian" name="petugas_unit_pengembalian" />
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6 fv-row">
                    <label class="fs-6 fw-semibold mb-2">Petugas CSSD Pengembalian</label>
                    <!--begin::Input-->
                        <select class="form-select form-select-solid" id="petugas_cssd_pengembalian" name="petugas_cssd_pengembalian" data-control="select2" data-hide-search="true" data-placeholder="Pilih User" name="target_assign">
                        </select>
                    <!--end::Input-->
                </div>
                <!--end::Col-->
            </div>
            <div class="row g-9 mb-8">
                <!--begin::Col-->
                <div class="col-md-6 fv-row">
                    <label class="fs-6 fw-semibold mb-2">Catatan Petugas CSSD</label>
                    <textarea name="keterangan_petugas_cssd" id="keterangan_petugas_cssd" class="form-control form-control-solid " cols="10" rows="10"></textarea>
                </div>
            </div>
            <!--end::Input group-->
            <div class="separator d-flex flex-center mb-8"></div>
            <!--begin::Input group-->
            <div id="repeater_steril">
                <div data-repeater-list="repeater_steril">
                    <div data-repeater-item>
                        <div class="row g-9 mb-8">
                            <div class="col-md-1 text-center">
                                <button class="btn btn-icon-danger btn-active-danger mt-8 p-2" data-repeater-delete
                                    type="button">
                                    <i class="fas fa-trash fs-2"></i>
                                </button>
                            </div>
                            <!--begin::Col-->
                            <div class="col-md-4 fv-row">
                                <label class="repeater_alat fs-6 fw-semibold mb-2">Alat</label>
                                <select class="form-select form-select-solid" id="steril" name="alatSteril" >
                                    
                                </select>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-4 fv-row">
                                <label class="repeater_alat fs-6 fw-semibold mb-2">Jenis Alat</label>
                                <!--begin::Input-->
                                <div class="position-relative d-flex align-items-center">
                                    <!--begin::Checkbox-->
                                    <label class="form-check form-check-custom form-check-solid me-10">
                                        <input class="form-check-input h-20px w-20px" type="radio" id="jenisAlat" name="jenisAlat" value="Kotor" checked="checked" />
                                        <span class="form-check-label fw-semibold">Kotor</span>
                                    </label>
                                    <!--end::Checkbox-->
                                    <!--begin::Checkbox-->
                                    <label class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input h-20px w-20px" type="radio" id="jenisAlat" name="jenisAlat" value="Kadaluarsa" />
                                        <span class="form-check-label fw-semibold">Kadaluarsa</span>
                                    </label>
                                    <!--end::Checkbox-->
                                </div>
                                <!--end::Input-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-3 fv-row">
                                <label class="repeater_alat fs-6 fw-semibold mb-2">Jumlah</label>
                                <!--begin::Input-->
                                <div class="position-relative d-flex align-items-center">
                                    
                                    <!--begin::Datepicker-->
                                    <input class="form-control form-control-solid " type="text" placeholder="" name="jumlahAlat" id="jumlahAlat"/>
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
               
                <button type="button" id="btn_simpan_steril" class="btn btn-primary" >
                    <span class="indicator-label">Submit</span>
                    <span class="indicator-progress">Please wait... 
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>

			
        </div>
    </div>
</div>


@endsection

@section('script-js')
<script src="{{ App\Helpers\VersionJS::Auto('/assets/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
<script src="{{ App\Helpers\VersionJS::Auto('/assets/js/steril/tambah-steril.js')}}"></script>
	{{-- <script src="{{ App\Helpers\VersionJS::Auto('/assets/js/custom/utilities/modals/new-target.js')}}"></script> --}}
    


@endsection