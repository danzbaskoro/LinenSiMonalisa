@extends('homepage.layout.main')
@section('title', 'Detail Sterill')
@section('content')



<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="row gy-5 g-xl-8 pb-7 pt-7">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <span class="card-label fw-bolder fs-3 text-dark mb-2 text-start">DETAIL STERILL</span>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="/dashboard/main" class="text-muted text-hover-primary">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Detail Sterill</li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Detail Sterill</li>
            </ul>
        </div>
    </div>
</div>
<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <!--begin::Card header-->
        <div class="card-header cursor-pointer">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">Detail Steril</h3>
            </div>
            <!--end::Card title-->
            <!--begin::Action-->
            {{-- <a href="account/settings.html" class="btn btn-sm btn-primary align-self-center">Edit Profile</a> --}}
            <!--end::Action-->
        </div>
        <!--begin::Card header-->
        <!--begin::Card body-->
        <div class="card-body p-9">
            <form id="" class="form" action="#">
               
                <!--begin::Input group-->
                
                <!--begin::Input group-->
                <div class="row g-9 mb-8">
                    <!--begin::Col-->
                    <div class="col-md-4 fv-row">
                        <label class=" fs-6 fw-semibold mb-2">Ruang</label>
                        <input class="form-control form-control-solid " placeholder="" value="{{ $idSteril }}" type="hidden" id="idSterilEdit" name="idSterilEdit" />
                        <input class="form-control form-control-solid " placeholder="" value="{{ $kodeSteril }}" type="hidden" id="kodeSterilDetail" name="kodeSterilDetail" />
                        <input class="form-control form-control-solid " placeholder="" value="{{ $idRuang }}" type="hidden" id="idRuangDt" name="idRuangDt" />
                        <input class="form-control form-control-solid " placeholder="" value="{{ $id_p_pencucian }}" type="hidden" id="id_p_pencucian" name="id_p_pencucian" />
                        <input class="form-control form-control-solid " placeholder="" value="{{ $id_p_packing }}" type="hidden" id="id_p_packing" name="id_p_packing" />
                        <input class="form-control form-control-solid " placeholder="" value="{{ $id_p_operator }}" type="hidden" id="id_p_operator" name="id_p_operator" />
                        <input class="form-control form-control-solid " placeholder="" value="{{ $id_p_check }}" type="hidden" id="id_p_check" name="id_p_check" />
                        <input class="form-control form-control-solid " placeholder="" value="{{ $id_p_cssd_penerimaan }}" type="hidden" id="id_p_cssd_penerimaan" name="id_p_cssd_penerimaan" />
                        <input class="form-control form-control-solid " placeholder="" value="{{ $id_p_cssd_pengembalian }}" type="hidden" id="id_p_cssd_pengembalian" name="id_p_cssd_pengembalian" />
                        <div class="position-relative d-flex align-items-center">
                            <select class="form-select form-select-solid" data-dropdown-parent="" id="idRuang" name="idRuang" data-control="select2" data-hide-search="true" data-placeholder="Pilih Ruangan" disabled>
                            </select>
                        </div>
                    </div>
                    <!--begin::Col-->
                    <div class="col-md-4 fv-row">
                        <label class="fs-6 fw-semibold mb-2">User Penerimaan Unit</label>
                        <input class="form-control form-control-solid " placeholder="" value="{{ $p_unit_penerimaan }}" type="text" id="petugas_unit_edit" name="petugas_unit_edit" disabled/>
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-4 fv-row">
                        <label class="fs-6 fw-semibold mb-2">User Penerimaan CSSD</label>
                        <!--begin::Input-->
                            {{-- <input class="form-control form-control-solid " placeholder="" type="text" value="{{ $p_cssd_penerimaan }}" id="petugas_cssd" name="petugas_cssd" /> --}}
                            <div class="position-relative d-flex align-items-center">
                                <select class="form-select form-select-solid" data-dropdown-parent="" id="id_p_cssd_penerimaan_home" name="id_p_cssd_penerimaan_home" data-control="select2" data-hide-search="true" data-placeholder="Pilih User" disabled>
                                </select>
                            </div>
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
                            <input class="form-control form-control-solid ps-12" type="text" placeholder="Select a date" value="{{ $tgl_penyerahan_alat }}" id="tanggal_penyerahan_edit" name="tanggal_penyerahan_edit" disabled/>
                            <!--end::Datepicker-->
                        </div>
                        <!--end::Input-->
                    </div>
                    <!--end::Col-->
                    
                    <!--begin::Col-->
                    <div class="col-md-3 fv-row">
                        <label class="fs-6 fw-semibold mb-2">Tanggal Steril</label>
                        <!--begin::Input-->
                        <div class="position-relative d-flex align-items-center">
                            <!--begin::Icon-->
                            <i class="ki-outline ki-calendar-8 fs-2 position-absolute mx-4"></i>
                            <!--end::Icon-->
                            <!--begin::Datepicker-->
                            <input class="form-control form-control-solid ps-12" type="text" placeholder="Select a date" value="{{ $tgl_steril }}" id="tanggal_steril_edit" name="tanggal_steril_edit" disabled/>
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
                            <input class="form-control form-control-solid ps-12" type="text" placeholder="Select a date" value="{{ $tgl_kadaluarsa }}" id="tanggal_kadaluarsa_alat_edit" name="tanggal_kadaluarsa_alat_edit" disabled/>
                            <!--end::Datepicker-->
                        </div>
                        <!--end::Input-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-3 fv-row">
                        <label class="fs-6 fw-semibold mb-2">Tanggal Pengambilan</label>
                        <!--begin::Input-->
                        <div class="position-relative d-flex align-items-center">
                            <!--begin::Icon-->
                            <i class="ki-outline ki-calendar-8 fs-2 position-absolute mx-4"></i>
                            <!--end::Icon-->
                            <!--begin::Datepicker-->
                            <input class="form-control form-control-solid ps-12" type="text" placeholder="Select a date" value="{{ $tgl_pengembalian_alat }}" id="tanggal_pengembalian_alat_edit" name="tanggal_pengembalian_alat_edit" disabled/>
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
                        {{-- <input class="form-control form-control-solid " placeholder="" value="{{ $p_pencucian }}" type="text" id="petugas_pencucian" name="petugas_pencucian" /> --}}
                        <select class="form-select form-select-solid" data-dropdown-parent="" id="petugas_pencucian" name="petugas_pencucian" data-control="select2" data-hide-search="true" data-placeholder="Pilih User" name="target_assign" disabled>
                        </select>
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-3 fv-row">
                        <label class="fs-6 fw-semibold mb-2">Petugas Packing</label>
                        <!--begin::Input-->
                        {{-- <div class="position-relative d-flex align-items-center"> --}}
                            
                            {{-- <input class="form-control form-control-solid " placeholder="" value="{{ $p_packing }}" type="text" id="petugas_packing" name="petugas_packing" /> --}}
                            <select class="form-select form-select-solid" data-dropdown-parent="" id="petugas_packing" name="petugas_packing" data-control="select2" data-hide-search="true" data-placeholder="Pilih User" name="target_assign" disabled>
                            </select>
                        {{-- </div> --}}
                        <!--end::Input-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-3 fv-row">
                        <label class="fs-6 fw-semibold mb-2">Petugas Operator</label>
                        <!--begin::Input-->
                        {{-- <div class="position-relative d-flex align-items-center"> --}}
                            
                            {{-- <input class="form-control form-control-solid " placeholder="" value="{{ $p_operator }}" type="text" id="petugas_operator" name="petugas_operator" /> --}}
                            <select class="form-select form-select-solid" data-dropdown-parent="" id="petugas_operator" name="petugas_operator" data-control="select2" data-hide-search="true" data-placeholder="Pilih User" name="target_assign" disabled>
                            </select>
                        {{-- </div> --}}
                        <!--end::Input-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-3 fv-row">
                        <label class="fs-6 fw-semibold mb-2">Petugas Check Akhir</label>
                        <!--begin::Input-->
                        {{-- <div class="position-relative d-flex align-items-center"> --}}
                            
                            {{-- <input class="form-control form-control-solid " placeholder="" type="text" value="{{ $p_check }}" id="petugas_check" name="petugas_check" /> --}}
                            <select class="form-select form-select-solid" data-dropdown-parent="" id="petugas_check_" name="petugas_check" data-control="select2" data-hide-search="true" data-placeholder="Pilih User" name="target_assign" disabled>
                            </select>
                        {{-- </div> --}}
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
                        <input class="form-control form-control-solid " placeholder="" value="{{ $p_unit_pengembalian }}" type="text" id="petugas_unit_pengembalian_edit" name="petugas_unit_pengembalian_edit" />
                        {{-- <select class="form-select form-select-solid" data-dropdown-parent="#modal_tambah_steril" id="petugas_unit_pengembalian" name="petugas_unit_pengembalian" data-control="select2" data-hide-search="true" data-placeholder="Pilih User" name="target_assign">
                        </select> --}}
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-6 fv-row">
                        <label class="fs-6 fw-semibold mb-2">Petugas CSSD Pengambilan</label>
                        <!--begin::Input-->
                        {{-- <div class="position-relative d-flex align-items-center"> --}}
                            {{-- <input class="form-control form-control-solid " placeholder="" value="{{ $p_cssd_pengembalian }}" type="text" id="petugas_cssd_pengembalian" name="petugas_cssd_pengembalian" /> --}}
                            <select class="form-select form-select-solid" data-dropdown-parent="" id="petugas_cssd_pengembalian" name="petugas_cssd_pengembalian" data-control="select2" data-hide-search="true" data-placeholder="Pilih User" name="target_assign" disabled>
                            </select>
                        {{-- </div> --}}
                        <!--end::Input-->
                    </div>
                    <!--end::Col-->
                    
                </div>
                <div class="row g-9 mb-8">
                    <div class="col-md-6 fv-row">
                        <label class="fs-6 fw-semibold mb-2">Tandatangan Unit Pengambilan</label><br>
                        <img class="img-fluid w-100px h-100px mb-2 text-center border border-2" src="{{ $ttd_unit_pengambilan }}">
                    </div>
                </div>
                
                <!--end::Input group-->
                <div class="separator d-flex flex-center mb-8"></div>
                
                <!--begin::Input group-->
                <div class="card-header pt-7">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-outline ki-magnifier fs-1 position-absolute ms-6"></i>
                            <input type="text" id="search_grid_dataset" data-kt-permissions-table-filter="search"
                                class="form-control form-control-solid w-300px ps-15" placeholder="Cari Data Alat Disini" />
                        </div>
                    </div>
                </div>
                <div class="row g-9 mb-8">
                    <table class="table align-middle table-row-dashed fs-6" id="data_alat_steril">
                        <thead>
                            <tr>
                                <th class="text-dark fw-bold fs-6 text-center align-middle">No.</th>
                                <th class="text-dark fw-bold fs-6 text-start align-middle">Nama Alat</th>
                                <th class="text-dark fw-bold fs-6 text-center align-middle">Satuan</th>
                                <th class="text-dark fw-bold fs-6 text-center align-middle">Jumlah</th>
                                <th class="text-dark fw-bold fs-6 text-center align-middle">Jenis Alat</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="separator d-flex flex-center mb-8"></div>
                
            </form>
        </div>
        <!--end::Card body-->

            
    </div>
</div>

@endsection

@section('script-js')
<script src="{{ App\Helpers\VersionJS::Auto('/assets/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
<script src="{{ App\Helpers\VersionJS::Auto('/assets/js/homepage/daftar-steril.js')}}"></script>
	{{-- <script src="{{ App\Helpers\VersionJS::Auto('/assets/js/custom/utilities/modals/new-target.js')}}"></script> --}}
    


@endsection