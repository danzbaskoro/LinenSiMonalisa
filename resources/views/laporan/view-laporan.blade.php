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
<div id="kt_app_content_container" class="app-container container-fluid">

<!--begin::Row-->
<div class="row g-6 g-xl-9">
    <!--begin::Col-->
    <div class="col-md-6 col-xl-4">
        <!--begin::Card-->
        <a href="{{ route('laporan-bulan') }}" class="card border-hover-primary">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-9">
                <!--begin::Card Title-->
                <div class="card-title m-0">
                    <!--begin::Avatar-->
                    {{-- <div class="symbol symbol-50px w-50px bg-light">
                        <img src="assets/media/svg/brand-logos/plurk.svg" alt="image" class="p-3" />
                    </div> --}}
                    <!--end::Avatar-->
                </div>
                <!--end::Car Title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    {{-- <span class="badge badge-light-primary fw-bold me-auto px-4 py-3">In Progress</span> --}}
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end:: Card header-->
            <!--begin:: Card body-->
            <div class="card-body p-9">
                <!--begin::Name-->
                <div class="fs-3 fw-bold text-gray-900">Laporan Bulanan</div>
                <!--end::Name-->
                <!--begin::Description-->
                <p class="text-gray-500 fw-semibold fs-5 mt-1 mb-7">Laporan Steril Bulanan</p>
                <!--end::Description-->
                <!--begin::Info-->
                <div class="d-flex flex-wrap mb-5">
                    <!--begin::Due-->
                    {{-- <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
                        <div class="fs-6 text-gray-800 fw-bold">Apr 15, 2024</div>
                        <div class="fw-semibold text-gray-500">Due Date</div>
                    </div> --}}
                    <!--end::Due-->
                    <!--begin::Budget-->
                    {{-- <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
                        <div class="fs-6 text-gray-800 fw-bold">$284,900.00</div>
                        <div class="fw-semibold text-gray-500">Budget</div>
                    </div> --}}
                    <!--end::Budget-->
                </div>
                <!--end::Info-->
                <!--begin::Progress-->
                {{-- <div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title="This project 50% completed">
                    <div class="bg-primary rounded h-4px" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div> --}}
                <!--end::Progress-->
                <!--begin::Users-->
                <div class="symbol-group symbol-hover">
                    <!--begin::User-->
                    {{-- <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Emma Smith">
                        <img alt="Pic" src="assets/media/avatars/300-6.jpg" />
                    </div> --}}
                    <!--begin::User-->
                    <!--begin::User-->
                    {{-- <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Rudy Stone">
                        <img alt="Pic" src="assets/media/avatars/300-1.jpg" />
                    </div> --}}
                    <!--begin::User-->
                    <!--begin::User-->
                    {{-- <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Susan Redwood">
                        <span class="symbol-label bg-primary text-inverse-primary fw-bold">S</span>
                    </div> --}}
                    <!--begin::User-->
                </div>
                <!--end::Users-->
            </div>
            <!--end:: Card body-->
        </a>
        <!--end::Card-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-md-6 col-xl-4">
        <!--begin::Card-->
        <a href="{{ route('laporan-tahun') }}" class="card border-hover-primary">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-9">
                <!--begin::Card Title-->
                <div class="card-title m-0">
                    <!--begin::Avatar-->
                    {{-- <div class="symbol symbol-50px w-50px bg-light">
                        <img src="assets/media/svg/brand-logos/disqus.svg" alt="image" class="p-3" />
                    </div> --}}
                    <!--end::Avatar-->
                </div>
                <!--end::Car Title-->
                <!--begin::Card toolbar-->
                {{-- <div class="card-toolbar">
                    <span class="badge badge-light fw-bold me-auto px-4 py-3">Pending</span>
                </div> --}}
                <!--end::Card toolbar-->
            </div>
            <!--end:: Card header-->
            <!--begin:: Card body-->
            <div class="card-body p-9">
                <!--begin::Name-->
                <div class="fs-3 fw-bold text-gray-900">Laporan Tahunan</div>
                <!--end::Name-->
                <!--begin::Description-->
                <p class="text-gray-500 fw-semibold fs-5 mt-1 mb-7">Laporan Steril Tahunan</p>
                <!--end::Description-->
                <!--begin::Info-->
                <div class="d-flex flex-wrap mb-5">
                    <!--begin::Due-->
                    {{-- <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
                        <div class="fs-6 text-gray-800 fw-bold">May 10, 2021</div>
                        <div class="fw-semibold text-gray-500">Due Date</div>
                    </div> --}}
                    <!--end::Due-->
                    <!--begin::Budget-->
                    {{-- <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
                        <div class="fs-6 text-gray-800 fw-bold">$36,400.00</div>
                        <div class="fw-semibold text-gray-500">Budget</div>
                    </div> --}}
                    <!--end::Budget-->
                </div>
                <!--end::Info-->
                <!--begin::Progress-->
                {{-- <div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title="This project 30% completed">
                    <div class="bg-info rounded h-4px" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                </div> --}}
                <!--end::Progress-->
                <!--begin::Users-->
                <div class="symbol-group symbol-hover">
                    <!--begin::User-->
                    {{-- <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Alan Warden">
                        <span class="symbol-label bg-warning text-inverse-warning fw-bold">A</span>
                    </div> --}}
                    <!--begin::User-->
                    <!--begin::User-->
                    {{-- <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Brian Cox">
                        <img alt="Pic" src="assets/media/avatars/300-5.jpg" />
                    </div> --}}
                    <!--begin::User-->
                </div>
                <!--end::Users-->
            </div>
            <!--end:: Card body-->
        </a>
        <!--end::Card-->
    </div>
    <!--end::Col-->

</div>
<!--end::Row-->
</div>

@endsection