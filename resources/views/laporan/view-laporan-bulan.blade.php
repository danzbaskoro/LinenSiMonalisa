@extends('layout.main')
@section('title', 'Laporan')
@section('content')


<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="row gy-5 g-xl-8 pb-7 pt-7">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <span class="card-label fw-bolder fs-3 text-dark mb-2 text-start">LAPORAN STERILL</span>
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
                <li class="breadcrumb-item text-muted">Data Laporan Steril</li>
            </ul>
        </div>
    </div>
</div>
<hr>
<div id="kt_app_content_container" class="app-container container-fluid">
    <h3>
        <span class="fw-bold text-dark fs-3">LAPORAN BULANAN</span>
    </h3>
<hr>
<div class="row g-9 mb-8">
    <!--begin::Col-->
    <div class="col-md-3 fv-row">
        <label class="fs-6 fw-semibold mb-2">Bulan - tahun</label>
        <div class="input-group input-group-sm mt-3">
            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
            <input id="bulan_laporan" value="<?= date('m-Y')?>" type="text"
                class="form-control form-control-sm" />
        </div>
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-md-3 fv-row">
        
            <button class="btn  btn-danger mt-11 p-2 "  onclick="CetakLaporanBulan()"><i class="fas fa-file-pdf fs-2"></i></button>
            <button class="btn btn-success mt-11 p-2 "  onclick="ExcelLaporanBulan()"><i class="fas fa-file-excel fs-2"></i></button>
            {{-- <a href="{{ route('export-excel') }}">
                <button class="btn btn-icon-success btn-active-danger mt-11 p-2 " ><i class="fas fa-file-excel fs-2"></i></button>
            </a> --}}
       
        <!--begin::Input-->
        
        <!--end::Input-->
    </div>
    
    <!--end::Col-->

</div>
</div>

@endsection

@section('script-js')
    <script src="{{ App\Helpers\VersionJS::Auto('/assets/js/laporan/laporan-bulan.js') }}"></script>
@endsection