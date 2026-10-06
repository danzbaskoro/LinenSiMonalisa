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
                <li class="breadcrumb-item text-muted">Data Sterill</li>
            </ul>
        </div>
    </div>
</div>
<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="card card-flush">
        <div class="card-header pt-7">
            <div class="card-title">
                {{-- <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-outline ki-magnifier fs-1 position-absolute ms-6"></i>
                    <input type="text" id="search_grid_dataset" data-kt-permissions-table-filter="search"
                        class="form-control form-control-solid w-300px ps-15" placeholder="Cari Data Alat Disini" />
                </div> --}}
                <div class="row g-3 align-items-center">

                    {{-- Search --}}
                    <div class="col-auto">
                        <div class="position-relative">
                            <i class="ki-outline ki-magnifier fs-1 position-absolute ms-6"></i>
                            <input type="text" id="search_grid_dataset" data-kt-permissions-table-filter="search"
                                class="form-control form-control-solid w-300px ps-15" placeholder="Cari Data Alat Disini" />
                        </div>
                    </div>

                    {{-- Tahun --}}
                    <div class="col-auto">
                        <select id="filter_tahun" class="form-select form-select-solid">
                            @foreach($tahunList as $item)
                                <option value="{{ $item->tahun }}"
                                    {{ $item->tahun == date('Y') ? 'selected' : '' }}>
                                    {{ $item->tahun }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Status --}}
                    <div class="col-auto">

                        <select id="filter_status" class="form-select form-select-solid">
                            <option value="Belum diambil" selected>
                                Belum Diambil
                            </option>
                            <option value="Sudah diambil">
                                Sudah Diambil
                            </option>
                            <option value="Kadaluarsa">
                                Kadaluarsa
                            </option>
                            <option value="all">
                                Semua
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-toolbar">
                <div class="d-flex justify-content-end">
                    {{-- <button type="button" class="btn btn-flex btn-primary"  onclick="TambahDataSteril()">
                        <i class="ki-outline ki-plus fs-2"></i>Tambah Data Steril
                    </button> --}}
					<button type="button" class="btn btn-flex btn-primary"  onclick="NewTambahDataSteril()">
                        <i class="ki-outline ki-plus fs-2"></i>Tambah Data Steril
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table align-middle table-row-dashed fs-6" id="data_steril">
                <thead>
                    <tr>
                        <th class="text-dark fw-bold fs-6 text-center align-middle">No.</th>
                        <th class="text-dark fw-bold fs-6 text-start align-middle">Kode Steril</th>
                        <th class="text-dark fw-bold fs-6 text-center align-middle">Ruangan</th>
                        <th class="text-dark fw-bold fs-6 text-center align-middle">Tanggal Penerimaan</th>
                        <th class="text-dark fw-bold fs-6 text-center align-middle">Tanggal Kadaluarsa</th>
                        <th class="text-dark fw-bold fs-6 text-center align-middle">Status Pengambilan</th>
                        <th class="text-dark fw-bold fs-6 text-center align-middle">Aksi</th>
                    </tr>
                </thead>
            </table>

			
        </div>
    </div>
</div>
<!--begin::Modal - New Target-->
<div class="modal fade" id="modal_tambah_steril" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-950px ">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <!--begin:Form-->
                {{-- <form id="" class="form" action="#"> --}}
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">Tambah Data Steril</h1>
                        <!--end::Title-->
                        <div class="text-muted fw-semibold fs-5">Harap isikan data dengan benar.</div>
                    </div>
                    <!--end::Heading-->
                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <!--begin::Col-->
                        <div class="col-md-4 fv-row">
                            <label class=" fs-6 fw-semibold mb-2">Ruang</label>
                            <select class="form-select form-select-solid" data-dropdown-parent="#modal_tambah_steril" id="idRuang" name="idRuang" data-control="select2" data-hide-search="true" data-placeholder="Pilih Ruangan" name="idRuang">
                               
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
                           
                                <select class="form-select form-select-solid" data-dropdown-parent="#modal_tambah_steril" id="petugas_cssd" name="petugas_cssd" data-control="select2" data-hide-search="true" data-placeholder="Pilih User" name="target_assign">
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
                        <div class="col-md-3 fv-row">
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
                            <select class="form-select form-select-solid" data-dropdown-parent="#modal_tambah_steril" id="petugas_pencucian" name="petugas_pencucian" data-control="select2" data-hide-search="true" data-placeholder="Pilih User" >
                            </select>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-3 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Petugas Packing</label>
                            <!--begin::Input-->
                                <select class="form-select form-select-solid" data-dropdown-parent="#modal_tambah_steril" id="petugas_packing" name="petugas_packing" data-control="select2" data-hide-search="true" data-placeholder="Pilih User" >
                                </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-3 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Petugas Operator</label>
                            <!--begin::Input-->
                                <select class="form-select form-select-solid" data-dropdown-parent="#modal_tambah_steril" id="petugas_operator" name="petugas_operator" data-control="select2" data-hide-search="true" data-placeholder="Pilih User" name="target_assign">
                                </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-3 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Petugas Check Akhir</label>
                            <!--begin::Input-->
                                <select class="form-select form-select-solid" data-dropdown-parent="#modal_tambah_steril" id="petugas_check" name="petugas_check" data-control="select2" data-hide-search="true" data-placeholder="Pilih User" name="target_assign">
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
                                <select class="form-select form-select-solid" data-dropdown-parent="#modal_tambah_steril" id="petugas_cssd_pengembalian" name="petugas_cssd_pengembalian" data-control="select2" data-hide-search="true" data-placeholder="Pilih User" name="target_assign">
                                </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Col-->
                        
                    </div>
                    <div class="row g-9 mb-8">
                        <!--begin::Col-->
                        <div class="col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Catatan Petugas CSSD</label>
                            <textarea name="keterangan_petugas_cssd" id="keterangan_petugas_cssd" class="form-control form-control-solid " cols="30" rows="10"></textarea>
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
                                        <select class="form-select form-select-solid" id="steril" name="alatSteril" data-dropdown-parent="#modal_tambah_steril">
                                            
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
                    <!--end::Actions-->
                {{-- </form> --}}
                <!--end:Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - New Target-->

@endsection

@section('script-js')
<script src="{{ App\Helpers\VersionJS::Auto('/assets/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
<script src="{{ App\Helpers\VersionJS::Auto('/assets/js/steril/steril.js')}}"></script>
	{{-- <script src="{{ App\Helpers\VersionJS::Auto('/assets/js/custom/utilities/modals/new-target.js')}}"></script> --}}
    


@endsection