@extends('layout.main')
@section('title', 'Data Pengambilan Steril')
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
                        <input class="form-control form-control-solid " placeholder="" value="{{ $idSteril }}" type="hidden" id="idSterilPengambilan" name="idSterilPengambilan" />
                        <input class="form-control form-control-solid " placeholder="" value="{{ $kodeSteril }}" type="hidden" id="kodeSteril" name="kodeSterilPengambilan" />
                        <input class="form-control form-control-solid " placeholder="" value="{{ $idRuang }}" type="hidden" id="idRuangDt" name="idRuangDt" />
                        <input class="form-control form-control-solid " placeholder="" value="{{ $id_p_pencucian }}" type="hidden" id="id_p_pencucianPengambilan" name="id_p_pencucianPengambilan" />
                        <input class="form-control form-control-solid " placeholder="" value="{{ $id_p_packing }}" type="hidden" id="id_p_packingPengambilan" name="id_p_packingPengambilan" />
                        <input class="form-control form-control-solid " placeholder="" value="{{ $id_p_operator }}" type="hidden" id="id_p_operatorPengambilan" name="id_p_operatorPengambilan" />
                        <input class="form-control form-control-solid " placeholder="" value="{{ $id_p_check }}" type="hidden" id="id_p_checkPengambilan" name="id_p_checkPengambilan" />
                        <input class="form-control form-control-solid " placeholder="" value="{{ $id_p_cssd_penerimaan }}" type="hidden" id="id_p_cssd_penerimaan_alat" name="id_p_cssd_penerimaan" />
                        {{-- <input class="form-control form-control-solid " placeholder="" value="{{ $id_p_cssd_pengembalian }}" type="hidden" id="id_p_cssd_pengembalian" name="id_p_cssd_pengembalian" /> --}}
                        <div class="position-relative d-flex align-items-center">
                            <select class="form-select form-select-solid" data-dropdown-parent="" id="idRuangPengambilan" name="idRuangPengambilan" data-control="select2" data-hide-search="true" data-placeholder="Pilih Ruangan">
                            </select>
                        </div>
                    </div>
                    <!--begin::Col-->
                    <div class="col-md-4 fv-row">
                        <label class="fs-6 fw-semibold mb-2">User Penerimaan Unit</label>
                        <input class="form-control form-control-solid " placeholder="" value="{{ $p_unit_penerimaan }}" type="text" id="petugas_unit_pengambilan" name="petugas_unit_pengambilan" />
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-4 fv-row">
                        <label class="fs-6 fw-semibold mb-2">User Penerimaan CSSD</label>
                        <!--begin::Input-->
                            {{-- <input class="form-control form-control-solid " placeholder="" type="text" value="{{ $p_cssd_penerimaan }}" id="petugas_cssd" name="petugas_cssd" /> --}}
                            <div class="position-relative d-flex align-items-center">
                                <select class="form-select form-select-solid" data-dropdown-parent="" id="id_p_cssd_terima_pengambilan" name="id_p_cssd_terima_pengambilan" data-control="select2" data-hide-search="true" data-placeholder="Pilih User">
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
                            <input class="form-control form-control-solid ps-12" type="text" placeholder="Select a date" value="{{ $tgl_penyerahan_alat }}" id="tanggal_penyerahan_edit" name="tanggal_penyerahan_pengambilan" />
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
                            <input class="form-control form-control-solid ps-12" type="text" placeholder="Select a date" value="{{ $tgl_steril }}" id="tanggal_steril_edit" name="tanggal_steril_pengambilan" />
                            <!--end::Datepicker-->
                        </div>
                        <!--end::Input-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-2 fv-row">
                        <label class="fs-6 fw-semibold mb-2">Tanggal Kadaluarsa Alat</label>
                        <!--begin::Input-->
                        <div class="position-relative d-flex align-items-center">
                            <!--begin::Icon-->
                            <i class="ki-outline ki-calendar-8 fs-2 position-absolute mx-4"></i>
                            <!--end::Icon-->
                            <!--begin::Datepicker-->
                            <input class="form-control form-control-solid ps-12" type="text" placeholder="Select a date" value="{{ $tgl_kadaluarsa }}" id="tanggal_kadaluarsa_alat_edit" name="tanggal_kadaluarsa_alat_pengambilan" />
                            <!--end::Datepicker-->
                        </div>
                        <!--end::Input-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-2 fv-row">
                        <label class="fs-6 fw-semibold mb-2">Tanggal Pengambilan</label>
                        <!--begin::Input-->
                        <div class="position-relative d-flex align-items-center">
                            <!--begin::Icon-->
                            <i class="ki-outline ki-calendar-8 fs-2 position-absolute mx-4"></i>
                            <!--end::Icon-->
                            <!--begin::Datepicker-->
                            <input class="form-control form-control-solid ps-12" type="text" placeholder="Pilih tanggal" value="{{ $tgl_pengembalian_alat }}" id="tanggal_pengembalian" name="tanggal_pengembalian_alat_pengambilan" />
                            <!--end::Datepicker-->
                        </div>
                        <!--end::Input-->
                    </div>
                    <!--end::Col-->
                    <div class="col-md-2 fv-row">
                        <label class="fs-6 fw-semibold mb-2">Jam Pengambilan</label>
                        <!--begin::Input-->
                        {{-- <div class="position-relative d-flex align-items-center"> --}}
                            
                            <!--begin::Datepicker-->
                            <input class="form-control form-control-solid ps-12" type="text" placeholder="" value="{{ $jam_pengembalian_alat }}" id="jam_pengembalian" name="jam_pengambilan" />
                            <!--end::Datepicker-->
                        {{-- </div> --}}
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
                        <select class="form-select form-select-solid" data-dropdown-parent="" id="petugas_pencucian_pengambilan" name="petugas_pencucian_pengambilan" data-control="select2" data-hide-search="true" data-placeholder="Pilih User" name="target_assign">
                        </select>
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-3 fv-row">
                        <label class="fs-6 fw-semibold mb-2">Petugas Packing</label>
                        <!--begin::Input-->
                        {{-- <div class="position-relative d-flex align-items-center"> --}}
                            
                            {{-- <input class="form-control form-control-solid " placeholder="" value="{{ $p_packing }}" type="text" id="petugas_packing" name="petugas_packing" /> --}}
                            <select class="form-select form-select-solid" data-dropdown-parent="" id="petugas_packing_pengambilan" name="petugas_packing_pengambilan" data-control="select2" data-hide-search="true" data-placeholder="Pilih User" name="target_assign">
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
                            <select class="form-select form-select-solid" data-dropdown-parent="" id="petugas_operator_pengambilan" name="petugas_operator_pengambilan" data-control="select2" data-hide-search="true" data-placeholder="Pilih User" name="target_assign">
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
                            <select class="form-select form-select-solid" data-dropdown-parent="" id="petugas_check_pengambilan" name="petugas_check_pengambilan" data-control="select2" data-hide-search="true" data-placeholder="Pilih User" name="target_assign" >
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
                        <input class="form-control form-control-solid " placeholder="" value="" type="text" id="petugas_unit_pengembalian" name="petugas_unit_pengembalian" />
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
                            <select class="form-select form-select-solid" data-dropdown-parent="" id="petugas_cssd_pengembalian" name="petugas_cssd_pengembalian" data-control="select2" data-hide-search="true" data-placeholder="Pilih User" name="target_assign">
                            </select>
                        {{-- </div> --}}
                        <!--end::Input-->
                    </div>
                    <!--end::Col-->
                    
                </div>
                <div class="row g-9 mb-8">
                <!--begin::Col-->
                    <div class="col-md-6 fv-row">
                        <label class="fs-6 fw-semibold mb-2">Catatan Petugas CSSD</label>
                        <textarea name="keterangan_petugas_cssd" id="keterangan_petugas_cssd" class="form-control form-control-solid " cols="10" rows="10">{{ $catatanCssd }}</textarea>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label class="fs-6 fw-semibold mb-2">Catatan User Pengirim</label>
                        <textarea name="keterangan_petugas_cssd" id="keterangan_petugas_cssd" class="form-control form-control-solid " cols="10" rows="10" disabled>{{ $catatanUnit }}</textarea>
                    </div>
                </div>
                <div class="row g-9 mb-8">
                    <label class="fs-6 fw-semibold mb-2">Tandatangan Unit Pengambilan</label>
                    <div class="row">
                        <div id="signature_pad" class="signature-pad">
                            <div class="signature-pad-body">
                                <canvas id="canvas_pengambilan_alat" class="border border-2"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-sm btn-danger clear" id="btn_clear_canvas_pengambilan_alat">
                                <i class="fas fa-broom text-white"></i>
                                CLEAR
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row g-9 mb-8">
                <div class="text-left">
                    <button type="button" id="btn_update_pengambilan" class="btn btn-primary" >
                        <span class="indicator-label">Submit</span>
                        <span class="indicator-progress">Please wait... 
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
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
                    <table class="table align-middle table-row-dashed fs-6" id="list_alat_steril">
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
            <div class="separator d-flex flex-center mb-8"></div>
            <div class="row g-9 mb-8">
                <div class="col-md-6 fv-row">
                    <h4>Silahkan scan QRCode</h4>
                    {{ $qrCode }}
                </div>
            </div>
            
            <div class="separator d-flex flex-center mb-8"></div>
        </div>
        <!--end::Card body-->
        <!--begin::Modal - New Target-->
			<div class="modal fade" id="modal_edit_alat_steril" tabindex="-1" aria-hidden="true">
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
								<label id="id_steril" name="id_steril" type="text" class="form-control form-control-sm ms-2" value="" hidden></label>
								<!--begin::Heading-->
								<div class="mb-13 text-center">
									<!--begin::Title-->
									<h1 class="mb-3">Edit Data Alat</h1>
									<!--end::Title-->
									
								</div>
								<!--end::Heading-->
								
								<!--begin::Input group-->
								<div class="row g-9 mb-8">
									<!--begin::Col-->
									<label class="required fs-6 fw-semibold mb-2">Nama Alat</label>
									<select class="form-select form-select-solid" data-dropdown-parent="#modal_edit_alat_steril" data-control="select2" data-hide-search="true" data-placeholder="Pilih Alat" name="id_alat_steril" id="id_alat_steril">
										{{-- <option value="set">Set</option>
										<option value="buah">Buah</option> --}}
									</select>
									<!--end::Col-->
								</div>
								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="d-flex flex-column mb-8 fv-row">
									<!--begin::Label-->
									<label class="d-flex align-items-center fs-6 fw-semibold mb-2">
										<span class="required">Jumlah Alat</span>
									</label>
									<!--end::Label-->
									<input type="text" class="form-control form-control-solid" placeholder="Isikan nama alat" id="jml_alat_steril" name="jml_alat_steril" />
								</div>
								<!--end::Input group-->
                                <!--begin::Col-->
                                <div class="col-md-4 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Jenis Alat</label>
                                    <!--begin::Input-->
                                    <div class="position-relative d-flex align-items-center">
                                        <!--begin::Checkbox-->
                                        <label class="form-check form-check-custom form-check-solid me-10">
                                            <input class="form-check-input h-20px w-20px" type="radio" id="jenisAlatSteril" name="jenisAlatSteril" value="Kotor"  />
                                            <span class="form-check-label fw-semibold">Kotor</span>
                                        </label>
                                        <!--end::Checkbox-->
                                        <!--begin::Checkbox-->
                                        <label class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input h-20px w-20px" type="radio" id="jenisAlatSteril" name="jenisAlatSteril" value="Kadaluarsa" />
                                            <span class="form-check-label fw-semibold">Kadaluarsa</span>
                                        </label>
                                        <!--end::Checkbox-->
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
								<!--begin::Actions-->
								<div class="text-center">
									<button type="button" id="kt_modal_new_target_submit " class="btn btn-primary" onclick="UpdateDataAlatSteril()">
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

@endsection

@section('script-js')
<script src="{{ App\Helpers\VersionJS::Auto('/assets/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
<script src="{{ App\Helpers\VersionJS::Auto('/assets/js/steril/steril.js')}}"></script>
<script src="{{ env('APP_URL') }}/assets/plugins/custom/signature/signature_pad.js"></script>
<script src="{{ env('APP_URL') }}/assets/plugins/custom/signature/sign_canvas.js"></script>
    


@endsection