@extends('layout.main')
@section('title', 'Linen')
@section('content')



<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="row gy-5 g-xl-8 pb-7 pt-7">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <span class="card-label fw-bolder fs-3 text-dark mb-2 text-start">DAFTAR LINEN</span>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="/dashboard" class="text-muted text-hover-primary">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Master Data</li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Daftar Linen</li>
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
                        class="form-control form-control-solid w-300px ps-15" placeholder="Cari Data Linen Disini" />
                </div>
            </div>
            <div class="card-toolbar">
                <div class="d-flex justify-content-end">
                    {{-- <button type="button" class="btn btn-flex btn-primary" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_new_target">
                        <i class="ki-outline ki-file fs-2"></i>Tambah Data Alat
                    </button> --}}
					<button type="button" class="btn btn-flex btn-primary" onclick="TambahDataLinen()">
                        <i class="ki-outline ki-file fs-2"></i>Tambah Data Linen
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table align-middle table-row-dashed fs-6" id="data_linen">
                <thead>
                    <tr>
                        <th class="text-dark fw-bold fs-6 text-center align-middle">No.</th>
                        <th class="text-dark fw-bold fs-6 text-start align-middle">Nama Linen</th>
                        <th class="text-dark fw-bold fs-6 text-center align-middle">Satuan Linen</th>
                        <th class="text-dark fw-bold fs-6 text-center align-middle">Aksi</th>
                    </tr>
                </thead>
            </table>
            <!--begin::Modal - New Target-->
			<div class="modal fade" id="modal_tambah_linen" tabindex="-1" aria-hidden="true">
				{{-- <div class="modal fade" id="kt_modal_new_target" id="modal_tambah_alat" tabindex="-1" aria-hidden="true"> --}}
				<!--begin::Modal dialog-->
				<div class="modal-dialog modal-dialog-centered mw-650px">
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
							<form id="kt_modal_new_target_form" class="form" action="#" method="post">
								
								<!--begin::Heading-->
								<div class="mb-13 text-center">
									<!--begin::Title-->
									<h1 class="mb-3">Tambah Data Linen</h1>
									<!--end::Title-->
									
								</div>
								<!--end::Heading-->
								<!--begin::Input group-->
								<div class="d-flex flex-column mb-8 fv-row">
									<!--begin::Label-->
									<label class="d-flex align-items-center fs-6 fw-semibold mb-2">
										<span class="required">Nama Linen</span>
									</label>
									<!--end::Label-->
									<input type="text" class="form-control form-control-solid" placeholder="Isikan nama linen" id="input_nama_linen" name="input_nama_linen" />
								</div>
								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="row g-9 mb-8">
									<!--begin::Col-->
									<label class="required fs-6 fw-semibold mb-2">Satuan</label>
									<select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih Satuan" name="input_satuan_linen" id="input_satuan_linen">
										<option value="set">Set</option>
										<option value="buah">Buah</option>
									</select>
									<!--end::Col-->
								</div>
								<!--end::Input group-->
								
								<!--begin::Actions-->
								<div class="text-center">
									<button type="button" id="kt_modal_new_target_submit " class="btn btn-primary" onclick="SaveDataLinen()">
										<span class="indicator-label">Submit</span>
										<span class="indicator-progress">Please wait... 
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
									</button>
								</div>
								<!--end::Actions-->
							</form>
							<!--end:Form-->
						</div>
						<!--end::Modal body-->
					</div>
					<!--end::Modal content-->
				</div>
				<!--end::Modal dialog-->
			</div>
			<!--end::Modal - New Target-->

			<!--begin::Modal - New Target-->
			<div class="modal fade" id="modal_edit_linen" tabindex="-1" aria-hidden="true">
				{{-- <div class="modal fade" id="kt_modal_new_target" id="modal_tambah_alat" tabindex="-1" aria-hidden="true"> --}}
				<!--begin::Modal dialog-->
				<div class="modal-dialog modal-dialog-centered mw-650px">
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
							<form id="kt_modal_new_target_form" class="form" action="#" method="post">
								<label id="id_linen" name="id_linen" type="text" class="form-control form-control-sm ms-2" value="" hidden></label>
								<!--begin::Heading-->
								<div class="mb-13 text-center">
									<!--begin::Title-->
									<h1 class="mb-3">Edit Data Linen</h1>
									<!--end::Title-->
									
								</div>
								<!--end::Heading-->
								<!--begin::Input group-->
								<div class="d-flex flex-column mb-8 fv-row">
									<!--begin::Label-->
									<label class="d-flex align-items-center fs-6 fw-semibold mb-2">
										<span class="required">Nama Linen</span>
									</label>
									<!--end::Label-->
									<input type="text" class="form-control form-control-solid" placeholder="Isikan nama linen" id="edit_nama_linen" name="edit_nama_linen" />
								</div>
								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="row g-9 mb-8">
									<!--begin::Col-->
									<label class="required fs-6 fw-semibold mb-2">Satuan</label>
									<select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih Satuan" name="edit_satuan_linen" id="edit_satuan_linen">
										{{-- <option value="set">Set</option>
										<option value="buah">Buah</option> --}}
									</select>
									<!--end::Col-->
								</div>
								<!--end::Input group-->
								
								<!--begin::Actions-->
								<div class="text-center">
									<button type="button" id="kt_modal_new_target_submit " class="btn btn-primary" onclick="UpdateDataLinen()">
										<span class="indicator-label">Submit</span>
										<span class="indicator-progress">Please wait... 
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
									</button>
								</div>
								<!--end::Actions-->
							</form>
							<!--end:Form-->
						</div>
						<!--end::Modal body-->
					</div>
					<!--end::Modal content-->
				</div>
				<!--end::Modal dialog-->
			</div>
			<!--end::Modal - New Target-->
        </div>
    </div>
</div>

@endsection

@section('script-js')
    <script src="{{ App\Helpers\VersionJS::Auto('/assets/js/alat/linen.js')}}"></script>
	<script src="{{ App\Helpers\VersionJS::Auto('/assets/js/custom/utilities/modals/new-target.js')}}"></script>
@endsection