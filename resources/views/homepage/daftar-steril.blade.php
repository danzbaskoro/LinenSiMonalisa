@extends('homepage.layout.main')
@section('title', 'Daftar Permintaan Steril')
@section('content')

<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="row gy-5 g-xl-8 pb-7 pt-7">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <span class="card-label fw-bolder fs-3 text-dark mb-2 text-start">DAFTAR PENERIMAAN STERIL</span>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="/dashboard/main" class="text-muted text-hover-primary">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Daftar Penerimaan Steril</li>
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
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-outline ki-magnifier fs-1 position-absolute ms-6"></i>
                    <input type="text" id="search_grid_dataset" data-kt-permissions-table-filter="search"
                        class="form-control form-control-solid w-300px ps-15" placeholder="Cari Data Alat Disini" />
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

@endsection
@section('script-js')
<script src="{{ App\Helpers\VersionJS::Auto('/assets/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
<script src="{{ App\Helpers\VersionJS::Auto('/assets/js/homepage/daftar-steril.js')}}"></script>

@endsection