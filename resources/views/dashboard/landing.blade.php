@extends('layout.main')
@section('title', 'Dashboard')
@section('content')



<div id="kt_app_content_container" class="app-container container-fluid">
    <!--begin::Navbar-->
    <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
        <!--begin::Col-->
        <div class="col-xl-3">
            <!--begin::Card widget 3-->
            <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #F1416C;background-image:url('assets/media/svg/shapes/wave-bg-red.svg')">
                <!--begin::Header-->
                <div class="card-header pt-5 mb-3">
                    <!--begin::Icon-->
                    <div class="d-flex flex-center rounded-circle h-80px w-80px" style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #F1416C">
                        <i class="ki-outline ki-call text-white fs-2qx lh-0"></i>
                    </div>
                    <!--end::Icon-->
                </div>
                <!--end::Header-->
                <!--begin::Card body-->
                <div class="card-body d-flex align-items-end mb-3">
                    <!--begin::Info-->
                    <div class="d-flex align-items-center">
                        <span class="fs-4hx text-white fw-bold me-6">{{ $totalAlat }}</span>
                        <div class="fw-bold fs-6 text-white">
                            <span class="d-block">Total </span>
                            <span class="">Alat</span>
                        </div>
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Card body-->
                <!--begin::Card footer-->
                
                <!--end::Card footer-->
            </div>
            <!--end::Card widget 3-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-3">
            <!--begin::Card widget 3-->
            <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #7239EA;background-image:url('assets/media/svg/shapes/wave-bg-purple.svg')">
                <!--begin::Header-->
                <div class="card-header pt-5 mb-3">
                    <!--begin::Icon-->
                    <div class="d-flex flex-center rounded-circle h-80px w-80px" style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #7239EA">
                        <i class="ki-outline ki-call text-white fs-2qx lh-0"></i>
                    </div>
                    <!--end::Icon-->
                </div>
                <!--end::Header-->
                <!--begin::Card body-->
                <div class="card-body d-flex align-items-end mb-3">
                    <!--begin::Info-->
                    <div class="d-flex align-items-center">
                        <span class="fs-4hx text-white fw-bold me-6">{{ $totalKadaluarsa }}</span>
                        <div class="fw-bold fs-6 text-white">
                            <span class="d-block">Alat</span>
                            <span class="">Kadaluarsa</span>
                        </div>
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Card body-->
                <!--begin::Card footer-->
                <div class="card-footer" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                    <!--begin::Progress-->
                    <div class="fw-bold text-white py-2">
                        <span class="fs-1 d-block">{{ $totalSteril }}</span>
                        <span class="opacity-50">Total Steril</span>
                    </div>
                    <!--end::Progress-->
                </div>
                <!--end::Card footer-->
            </div>
            <!--end::Card widget 3-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-6">
            <!--begin::Chart widget 36-->
            <div class="card card-flush overflow-hidden h-lg-100">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-900">Grafik Sterilisasi Bulanan</span>
                        {{-- <span class="text-gray-500 mt-1 fw-semibold fs-6">1,046 Data Steril</span> --}}
                    </h3>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
                        <div class="align-items-center flex-column float-right">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                <input id="bulan_steril" value="<?= date('m-Y') ?>" type="text"
                                    class="form-control form-control-sm" />
                            </div>
                        </div>
                           
                        <!--end::Daterangepicker-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Card body-->
                <div class="card-body d-flex align-items-end p-0">
                    <!--begin::Chart-->
                    {{-- <div id="grafik_steril_bulanan" class="min-h-auto w-100 ps-4 pe-6" style="height: 300px"></div> --}}
                    {{-- <canvas id="grafik_steril_bulanan" class="min-h-auto w-100 ps-4 pe-6" style="height: 300px"></canvas> --}}
                    <canvas id="grafik_steril_bulanan" class="mh-500px"></canvas>
                    <!--end::Chart-->
                </div>
                {{-- <div class="card-body pt-1">
                    <div class="col-12 my-5">
                        <canvas id="grafik_steril_bulanan" class="mh-500px"></canvas><br /><br />
                    </div>
                </div> --}}
                <!--end::Card body-->
            </div>
            <!--end::Chart widget 36-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-12">
            <!--begin::Table widget 15-->
            <div class="card card-flush h-lg-100">
                <!--begin::Header-->
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">Warning Alat Kadaluarsa</span>
                        {{-- <span class="text-gray-500 mt-1 fw-semibold fs-6"></span> --}}
                    </h3>
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-outline ki-magnifier fs-1 position-absolute ms-6"></i>
                            <input type="text" id="search_grid_dataset" data-kt-permissions-table-filter="search"
                                class="form-control form-control-solid w-300px ps-15" placeholder="Cari Data Alat Disini" />
                        </div>
                    </div>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    {{-- <div class="card-toolbar">
                        <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
                        <div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left" class="btn btn-sm btn-light d-flex align-items-center px-4">
                            <!--begin::Display range-->
                            <div class="text-gray-600 fw-bold">Loading date range...</div>
                            <!--end::Display range-->
                            <i class="ki-outline ki-calendar-8 fs-1 ms-2 me-0"></i>
                        </div>
                        <!--end::Daterangepicker-->
                    </div> --}}
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
            
                <!--begin::Body-->
                <div class="card-body pt-6">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-dashed align-middle gs-0 gy-3 my-0" id="data_alat_kadaluarsa">
                            <!--begin::Table head-->
                            <thead>
                                {{-- <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                    <th class="p-0 pb-3 min-w-175px text-start">NO</th>
                                    <th class="p-0 pb-3 min-w-100px text-end">RUANGAN</th>
                                    <th class="p-0 pb-3 min-w-100px text-end">ALAT STERIL</th>
                                    <th class="p-0 pb-3 min-w-150px text-end pe-12">TANGGAL STERIL</th>
                                    <th class="p-0 pb-3 w-125px text-end pe-7">TANGGAL KADALUARSA</th>
                                    <th class="p-0 pb-3 w-50px text-end">AKSI</th>
                                </tr> --}}
                                <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                    <th class="p-0 pb-3 text-start">NO</th>
                                    <th class="p-0 pb-3 text-end">KODE STERIL</th>
                                    <th class="p-0 pb-3 text-end">RUANGAN</th>
                                    <th class="p-0 pb-3 text-end">TANGGAL STERIL</th>
                                    <th class="p-0 pb-3 text-end">TANGGAL KADALUARSA</th>
                                    <th class="p-0 pb-3 text-end">STATUS PENGAMBILAN</th>
                                    <th class="p-0 pb-3 text-end">AKSI</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>

                            </tbody>
                            <!--end::Table body-->
                        </table>
                    </div>
                    <!--end::Table-->
                </div>
                <!--end: Card Body-->
            </div>
            <!--end::Table widget 15-->
        </div>
        <!--end::Col-->
    </div>
</div>

@endsection

@section('script-js')
    <script src="{{ App\Helpers\VersionJS::Auto('/assets/js/dashboard/dashboard.js') }}"></script>
    <script src="{{ App\Helpers\VersionJS::Auto('/assets/plugins/custom/chartjs/chartjs-plugin-datalabels.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- <script src="{{ env('APP_URL') }}/assets/js/dashboard/dashboard.js"></script> --}}
    {{-- <script src="{{ env('APP_URL') }}/assets/plugins/custom/chartjs/chartjs-plugin-datalabels.js"></script> --}}
@endsection